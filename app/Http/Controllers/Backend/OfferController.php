<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Stock;
use App\StockProperty;
use App\Product;
use App\Sale;
use App\Seller;
use App\OfferRequest;
use App\ProductSpecification;
use App\ProductSpecificationValue;
use App\Models\Auth\User;
use DataTables;
use App\Events\Backend\StockUpdated;
use App\Exports\StocksExport;
use App\Imports\SellerImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class OfferController extends Controller{
    protected $roles;
    function __construct(){
        $this->middleware('permission:view stock', ['only' => ['index']]);
        $this->middleware('permission:add stock', ['only' => ['create','store']]);
        $this->middleware('permission:edit stock', ['only' => ['edit','update']]);
        $this->middleware('permission:delete stock', ['only' => ['destroy']]);
        $this->middleware('permission:view stock detail', ['only' => ['show']]);
        $this->middleware('permission:export stocks', ['only' => ['stocksexports']]);
    }

    public function index(Request $request){
        $productsimage = Product::select('image','id','type','name')->where('status', '1')->get();
        $productspecification_list = ProductSpecification::with('options')
        ->where('parent_id',null)->whereIn('type_name',['Quality'])->get();
        $qualityGlobalArray = [];
        foreach($productspecification_list as $productspec)
        {
            foreach($productspec->options as $productspecval)
            {
                if($productspecval->parent_id == NULL)
                {
                    if($productspec->tags == 'Conditional')
                    {
                        $qualityGlobalArray[$productspec->product_id][$productspecval->related_spec_val_id][$productspecval->id]['title'] =  $productspecval->value;
                        $qualityGlobalArray[$productspec->product_id][$productspecval->related_spec_val_id][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
                    } 
                    else 
                    {
                        $qualityGlobalArray[$productspec->product_id][$productspecval->id]['title'] =  $productspecval->value;
                        $qualityGlobalArray[$productspec->product_id][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
                    }
                }
            }
        }

        $productByName = Product::all()->where('status', '1')->pluck('id', 'name');
        $productConfiguration = array();
        $productConfiguration[@$productByName['Potato']]['Quality'] = 'Conditional';
        $productConfiguration[@$productByName['Potato']]['Size'] = 'all';
        $productConfiguration[@$productByName['Potato']]['Color'] = 'all';
        $productConfiguration[@$productByName['Potato']]['Skin_Color'] = 'all';
        $productConfiguration[@$productByName['Potato']]['Defects'] = 'Conditional';
        $productConfiguration[@$productByName['Potato']]['Packing'] = 'all';
        
        $productConfiguration[@$productByName['Onion']]['Quality'] = 'all';
        $productConfiguration[@$productByName['Onion']]['Defects'] = 'all';
        $productConfiguration[@$productByName['Onion']]['Color'] = 'all';
        $productConfiguration[@$productByName['Onion']]['Size'] = 'all';
        $productConfiguration[@$productByName['Onion']]['Packing'] = 'all';
        
        $productConfiguration[@$productByName['Carrots']]['Quality'] = 'all';
        $productConfiguration[@$productByName['Carrots']]['Defects'] = 'all';
        $productConfiguration[@$productByName['Carrots']]['Size'] = 'all';
        $productConfiguration[@$productByName['Carrots']]['Packing'] = 'all';
        
        $productConfiguration[@$productByName['Apples']]['Quality'] = 'all';
        $productConfiguration[@$productByName['Apples']]['Size'] = 'all';
        $productConfiguration[@$productByName['Apples']]['Color'] = 'all';
        $productConfiguration[@$productByName['Apples']]['Defects'] = 'all';
        $productConfiguration[@$productByName['Apples']]['Sugar Content'] = 'all';
        $productConfiguration[@$productByName['Apples']]['Colorful'] = 'all';
        $productConfiguration[@$productByName['Apples']]['Packing'] = 'all';
        $productConfiguration[@$productByName['Apples']]['Extra Services'] = 'all';
        
        $potato_specs = array_keys($productConfiguration[$productByName['Potato']]);
        $onion_specs = array_keys($productConfiguration[$productByName['Onion']]);
        $carrots_specs = array_keys($productConfiguration[$productByName['Carrots']]);
        $apple_specs = array_keys($productConfiguration[$productByName['Apples']]);
        
        $products = Product::all()->where('status', '1')->pluck('name', 'id');
        if(isset($request->product_id) && !empty($request->product_id)){
            $product_id = $request->product_id;
            $ProdSpecArr = ProductSpecification::where('product_id',$request->product_id)->where('parent_id',NULL)->orderBy('order')->limit(3)->pluck('display_name','id')->toArray();
        } else {
            $product = Product::all()->where('status', '1')->first();
            $product_id = @$product->id;
            $ProdSpecArr = ProductSpecification::where('product_id',@$product->id)->where('parent_id',NULL)->orderBy('order')->limit(3)->pluck('display_name','id')->toArray();
        }
       
        $ProdSpecArrKeys = array_keys($ProdSpecArr);
        $field1 = current($ProdSpecArrKeys);
        if(count($ProdSpecArrKeys) > 1){
            $field2 = next($ProdSpecArrKeys);
        } else {
            $field2 = '';
        }
       
        if(count($ProdSpecArrKeys) >2){
            $field3 = end($ProdSpecArrKeys);
        } else {
            $field3 = '';
        }

        $ProdSpecArrNames = array();
        $ProdSpecArrNames['field1'] = $field1;
        $ProdSpecArrNames['field2'] = $field2;
        $ProdSpecArrNames['field3'] = $field3;
        
        if ($request->ajax()) {
            $data = Stock::with('product', 'seller','StockProperty','StockProperty.productSpec','StockProperty.productSpecValue')->where('product_id',$product_id)->get();
            if(auth()->user()->hasRole('seller')){
                if(!empty(get_buyer_by_user_id())){
                   $seller_id = get_buyer_by_user_id()->id;
                } else {
                    $seller_id =  auth()->user()->id;
                }
                $data = Stock::with('product', 'seller','StockProperty','StockProperty.productSpec','StockProperty.productSpecValue')->where('seller_id', $seller_id)->where('product_id',$product_id)->get();
            }
            
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                if(in_array('seller', auth_roles())){
                    $route_pre = 'seller';
                }else{
                    $route_pre = 'admin';
                }
                $btn = ' <div class="btn-group btn-group-sm">';
                if(auth()->user()->can('edit stock')){
                    $btn .= '<button type="button" class="btn btn-edit editItem" data-url="'.route($route_pre.'.stock.edit', $row->id).'"><i class="fas fa-edit"></i></button>'; 
                }
                if(auth()->user()->can('view stock detail')){
                    $btn .= '<button type="button" class="btn btn-primary viewItem" data-url="'.route($route_pre.'.stock.show', $row->id).'"><i class="fas fa-eye"></i></button>'; 
                } 
                if(auth()->user()->can('delete stock')){
                    $btn .= '<button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>'; 
                }
                $btn .= '</div>';
                return $btn;
            })
            ->addColumn('price', function($row){
                return  currency($row->price);
            })
            ->addColumn('seller_username', function($row){
                return (@$row->seller->username?@$row->seller->username:'-');
            })
            ->addColumn('field1', function($row) use ($field1) {
                $arrFields  = array();
                foreach($row->StockProperty as $prop){
                    if(@$prop->productSpec->field_type == 'dropdown_switchboxes'){
                        $arrFields[$prop->product_spec_id][] = @$prop->productSpecValue->value;
                    } else {
                        $arrFields[$prop->product_spec_id][] = @$prop->value;
                    }
                }
                if(is_array($arrFields)&& !empty($arrFields[@$field1])){
                    return implode(', ',@$arrFields[@$field1]);
                } else {
                    return '-';
                }
            })
            ->addColumn('field2', function($row) use ($field2){
                $arrFields  = array();
                foreach($row->StockProperty as $prop){
                    if(@$prop->productSpec->field_type == 'dropdown_switchboxes'){
                        $arrFields[$prop->product_spec_id][] = @$prop->productSpecValue->value;
                    } else {
                        $arrFields[$prop->product_spec_id][] = @$prop->value;
                    }
                }
                if(is_array($arrFields)&& !empty($arrFields[@$field2])){
                    return implode(', ',@$arrFields[@$field2]);
                } else {
                    return '-';
                }
            })
            ->addColumn('field3', function($row) use ($field3){
                if($field3 == ''){
                    return '';        
                } else {
                    $arrFields  = array();
                    foreach($row->StockProperty as $prop){
                        if(@$prop->productSpec->field_type == 'dropdown_switchboxes'){
                            $arrFields[$prop->product_spec_id][] = @$prop->productSpecValue->value;
                        } else {
                            $arrFields[$prop->product_spec_id][] = @$prop->value;
                        }
                    }
                    if(is_array($arrFields)&& !empty($arrFields[@$field3])){
                        return implode(', ',@$arrFields[@$field3]);
                    } else {
                        return '-';
                    };
                }
            })
            ->addColumn('product_name', function($row){
                return (@$row->product->name?@$row->product->name:'-');
            })
            ->addColumn('variety_detail_name', function($row){
                return (@$row->variety_detail->name?@$row->variety_detail->name:'-');
            })
           ->addColumn('size', function($row){
                return (@$row->size_from.'-'.@$row->size_to);
            })
            ->addColumn('pallets', function($row){
                if($row->pallets_available == 1) 
                {
                    $pallet = 'Yes';
                }
                else
                {
                    $pallet = 'No';
                }
                return (@$pallet);
            })
            ->rawColumns(['action','price'])
            ->make(true);
        }
        // echo "<pre>"; exit('herr');
        return view('backend.stock.index',compact('ProdSpecArr','ProdSpecArrNames','products','productsimage','apple_specs','productConfiguration','qualityGlobalArray'));
    }

    public function matchingRequests(Request $request,$offer = null){
        $data = Stock::with('product', 'seller','offerProperty','offerProperty.productSpec','offerProperty.productSpecValue')->where('seller_id',$offer)->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            if(in_array('seller', auth_roles())){
                $route_pre = 'seller';
            }else{
                $route_pre = 'admin';
            }
            $btn = ' <div class="btn-group btn-group-sm">
            <button type="button" class="btn btn-primary editItem" data-url="'.route($route_pre.'.stock.edit', $row->id).'"><i class="fas fa-edit"></i></button>
            <button type="button" class="btn btn-success viewItem" data-url="'.route($route_pre.'.stock.show', $row->id).'"><i class="fas fa-eye"></i></button>
            <button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>
            </div>';
            return $btn;
        })
        ->addColumn('price', function($row){
            return  currency($row->price);
        })
        ->addColumn('seller_username', function($row){
            return (@$row->seller->username?@$row->seller->username:'-');
        })
        ->addColumn('product_name', function($row){
            (@$row->product->name?@$row->product->name:'-');
        })        
        ->rawColumns(['action','price'])
        ->make(true);
    }

    public function applyMatchingRequest(Request $request){
        $offer = Stock::find($request->offer_id);
        $offer_request = OfferRequest::find($request->request_id);

        $sale = Sale::updateOrCreate(
            ['offer_id' => $request->offer_id, 'request_id' => $request->request_id],
            ['offer_id' => $request->offer_id, 'request_id' => $request->request_id, 'price' => $offer->price]
        );

        if($sale->wasRecentlyCreated){
            $seller_message = 'Dear '.$offer->seller->first_name.',
            Your offer matched for '.$offer_request->product->name.' ('.$offer_request->variety.'), Flesh Color: '.$offer_request->flesh_color.', Size: '.$offer_request->size_from.' - '.$offer_request->size_to.', QTY: '.$offer_request->quantity.', Price: '.$offer_request->price_from.' - '.$offer_request->price_to.', location: '.$offer_request->location_from.' - '.$offer_request->location_to;
            $buyer_message = 'Dear '.$offer_request->buyer->first_name.',
            Your request matched for '.$offer->product->name.' ('.$offer->variety.'), Flesh Color: '.$offer->flesh_color.', Size: '.$offer->size.', QTY: '.$offer->quantity.', Price: '.$offer->price.', location: '.$offer->location_from.' - '.$offer->location_to;

            SendSMS($offer->seller->phone, $seller_message);
            SendSMS($offer_request->buyer->phone, $buyer_message);
            SendWhatsapp(['phone' => $offer->seller->phone, 'body' => $seller_message,'is_PDF'=>false]);
            SendWhatsapp(['phone' => $offer_request->buyer->phone, 'body' => $buyer_message,'is_PDF'=>false]);
        }
    }

    public function create(){
        if(auth()->user()->confirmed != 1){
            return redirect()->route(home_route());         
        }
        $products = Product::all()->where('status', '1')->pluck('name', 'id', 'image');
        $product_image = Product::where('status', '1')->get();
        $sellers = Seller::where('status', '1')->select('id', 'username', 'name')->get();

        $product = \App\AppHead::where('name','Like','Potato')->where('type', 'product')->select('id', 'image')->first();
        $stock_image = @$product->image;
        
        return view('backend.stock.create',compact('products', 'sellers', 'stock_image', 'product', 'product_image'));
    }

    public function store(Request $request)
    {
        if(auth()->user()->confirmed != 1){
            return redirect()->route(home_route());         
        }
        if($request->city == ''){
            request()->validate([
                'country'=>'required',
                'image'=>'required',  
                'city'=>'required',
                'postalcode'=>'required|min:2|max:8',
                'product_id' => 'required',
                'quantity' => 'required',
                'price' => 'required',
                'seller_id' => 'required',
                'flesh_color' => 'required',
                'available_from_date' => 'required|date',
                'available_per_day' => 'required|integer',
                'pallets_available' => 'required|integer',
            ],[
                'postalcode.required' => 'The postalcode or city field is required.',
            ]);
        }elseif($request->postalcode == ''){
            request()->validate([
                'country'=>'required',
                'image'=>'required',
                'city'=>'required',
                'postalcode'=>'required|min:2|max:8',
                'product_id' => 'required',
                'quantity' => 'required',
                'price' => 'required',
                'flesh_color' => 'required',
                'seller_id' => 'required',
                'available_from_date' => 'required|date',
                'available_per_day' => 'required|integer',
                'pallets_available' => 'required|integer',
            ]);
        } else {
            $request->validate([
                'country'=>'required',
                'image'=>'required',
                'product_id' => 'required',
                'quantity' => 'required',
                'price' => 'required',
                'seller_id' => 'required',
                'available_from_date' => 'required|date',
                'available_per_day' => 'required|integer',
                'pallets_available' => 'required|integer',
                'image' => 'required',
                'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'city'=>'required',
                'postalcode'=>'required|min:2|max:8',
            ],[
                'postalcode.required' => 'The postalcode or city field is required.',
            ]);
        }
          
        if($request->image){
            $imageName2 = array();
            if(count((array)$request->image) > 6){
                return response()->json(['status' => 'error', 'message' => 'Max 6 images can be uploaded!']);
            }
            $i = 0;
            foreach($request->image as $file){
              $i++;
              $tmp = time().'_'.$i.'.'.$file->getClientOriginalExtension();
              $file->move(public_path('images/stock'), $tmp);
              $imageName2[] = $tmp;
            }
        }
        if($request->exp_image){
            $imageName = time().'.'.request()->exp_image->getClientOriginalExtension();
            request()->exp_image->move(public_path('images/stock'), $imageName);
        }

        $json_fields = array('exp_image');
        foreach($request->all() as $key=>$val){
            if (in_array($key, $json_fields)) {
                $tableArray[$key] = $imageName;
            }else{
                $tableArray[$key]=$val;
            }
        }
        if(empty($request->seller_id)){
            $tableArray['seller_id']=get_buyer_by_user_id()->id;
        }
        $tableArray['image'] = json_encode(@$imageName2);
        $tableArray['available_from_date'] = date('Y-m-d',strtotime($tableArray['available_from_date']));
        $tableArray['pallets_available'] = $request->pallets_available;
        $tableArray['stock_status'] = $request->stock_status;
        $tableArray['load_status'] = $request->load_status;
        $tableArray['postalcode'] = $request->postalcode;

        $offer = Stock::create($tableArray);      
      
        $productspecification_list = ProductSpecification::with('options')->where('product_id',$request->get('product_id'))->where('parent_id',null)->pluck('field_type','id')->toArray();
        $all = $request->all();
        $offer_id = $offer->id;
        $specification = @$all['specification'];
        if(is_array($specification) && !empty($specification)){
            foreach(@$specification as $product_spec_id=>$specValue)
            {
                if($productspecification_list[$product_spec_id] == 'dropdown_switchboxes'){
                    if(is_array($specValue))
                    {
                        foreach($specValue as $specValueKey=>$specValueValue){
                            $data = [
                                'offer_id'=>$offer_id,
                                'product_spec_id' => $product_spec_id,
                                'product_spec_val_id' => $specValueValue,
                                'ecs' => @$all['ecs'][$product_spec_id][$specValueKey]
                            ];
                            OfferProperty::create($data);
                        }
                    }  else {
                        $data = [
                            'offer_id'=>$offer_id,
                            'product_spec_id' => $product_spec_id,
                            'product_spec_val_id' => $specValue,
                        ];
                        OfferProperty::create($data);        
                    }
                } else if($productspecification_list[$product_spec_id] == 'inputfield'){
                    $data = [
                        'offer_id'=>$offer_id,
                        'product_spec_id' => $product_spec_id,
                        'value' => $specValue
                    ];
                    OfferProperty::create($data);       
                } else if($productspecification_list[$product_spec_id] == 'optionrange'){
                    $data = [
                        'offer_id'=>$offer_id,
                        'product_spec_id' => $product_spec_id,
                        'value' => $specValue['size_from'].'-'.$specValue['size_to']
                    ];
                    OfferProperty::create($data);
                }           
            }
        }
        
        $stock = Stock::with('offerProperty.productSpecValue')->where('id',$offer_id)->first();
        event(new StockUpdated($stock));
        return response()->json(['status' => 'success', 'message' => 'Stock added successfully!']);
    }

    public function show($id){
        $stock = Stock::where(['id' => $id])->first();
        if($stock){
            $offerProperty = $stock->offerProperty()->with('productSpec','productSpecValue')->get();
            $offerPropertyArr = array();
            foreach($offerProperty as $productPref){
                if(isset($productPref->productspec)){
                    $offerPropertyArr[$productPref->productspec->display_name][] =  (($productPref->productspec->field_type == 'dropdown_switchboxes')?@$productPref->productspecvalue->value:@$productPref->value);
                }
            }
            return view('backend.stock.show',compact('stock','offerProperty','offerPropertyArr'));
        }else{
            $products = Product::all()->where('status', '1')->pluck('name', 'id');
            if(isset($request->product_id) && !empty($request->product_id)){
                $product_id = $request->product_id;
                $ProdSpecArr = ProductSpecification::where('product_id',$request->product_id)->where('parent_id',NULL)->orderBy('order')->limit(3)->pluck('display_name','id')->toArray();
            } else {
                $product = Product::all()->where('status', '1')->first();
                $product_id = @$product->id;
                $ProdSpecArr = ProductSpecification::where('product_id',@$product->id)->where('parent_id',NULL)->orderBy('order')->limit(3)->pluck('display_name','id')->toArray();
            }
           
            $ProdSpecArrKeys = array_keys($ProdSpecArr);
            $field1 = current($ProdSpecArrKeys);
            if(count($ProdSpecArrKeys) > 1){
                $field2 = next($ProdSpecArrKeys);
            } else {
                $field2 = '';
            }
           
            if(count($ProdSpecArrKeys) >2){
                $field3 = end($ProdSpecArrKeys);
            } else {
                $field3 = '';
            }
    
            $ProdSpecArrNames = array();
            $ProdSpecArrNames['field1'] = $field1;
            $ProdSpecArrNames['field2'] = $field2;
            $ProdSpecArrNames['field3'] = $field3;
            $msg="Unfortunately this stock is not exist!";
            return view('backend.stock.index',compact('msg','ProdSpecArr','ProdSpecArrNames','products'));
        } 
    }

    public function edit($id){  
        $stock = Stock::where(['id' => $id])->first();
        if($stock){
            $offerProperty = $stock->offerProperty()->select('stock_id','product_spec_id','product_spec_val_id','ecs')->get()->toArray();
            $productPrefsMapping = array();
            $ecs = array();
            foreach($offerProperty as $productPref){
                $ecs[$productPref['product_spec_id']][$productPref['product_spec_val_id']] = @$productPref['ecs'];
                $productPrefsMapping[$productPref['product_spec_id']][] = $productPref['product_spec_val_id'];    
            }
            $product_list = Product::all()->where('status',1)->pluck('name','id');
            $productspecification_list = ProductSpecification::with('options')->where('product_id',$stock->product_id)->where('parent_id',null)->get();
            $productSpecRel = array();
            foreach($productspecification_list as $spec){
                $productSpecRel[$spec->id]['name'] = $spec->display_name;
                $productSpecRel[$spec->id]['hasmany'] = $spec->stock_hasmany;
                $productSpecRel[$spec->id]['can_edit'] = $spec->can_edit;
                $productSpecRel[$spec->id]['field_type'] = $spec->field_type;
                if($spec->stock_hasmany == 'Yes'){
                    $productSpecRel[$spec->id]['default'] = @$productPrefsMapping[$spec->id];
                } else {
                    $productSpecRel[$spec->id]['default'] = current($productPrefsMapping[$spec->id]??array());
                }
                $productSpecRel[$spec->id]['options'] = array();
                foreach($spec->options as $option){
                   if($spec->stock_hasmany == 'Yes'){
                        $productSpecRel[$spec->id]['options'][$option->id]['name'] = $option->value;
                        $productSpecRel[$spec->id]['options'][$option->id]['premium'] = @$productPrefsMappingPremiums[$spec->id][$option->id];
                        $productSpecRel[$spec->id]['options'][$option->id]['ec'] = $option->ec;
                        $productSpecRel[$spec->id]['options'][$option->id]['ecbf'] = $option->ecbf;
                    } else {
                        $productSpecRel[$spec->id]['options'][$option->id] = $option->value;
                    }
                }
            }
            // echo "<pre>"; print_r($stock); exit('alsal');  
            $productspecificationval_list = ProductSpecificationValue::with('product_specification')->where('product_id',$stock->product_id)->whereNotNull('parent_id')->get();
            $productSpecChildRelation = array();
            foreach($productspecificationval_list as $childItem){
                if($childItem->product_specification->reference_id != ''){
                   $productSpecChildRelation[$childItem->parent_id]['reference_id'] =  $childItem->product_specification->reference_id;
                   $productSpecChildRelation[$childItem->parent_id]['value'] =  $childItem->value;
                }
            }
            
            $products = Product::all()->where('status', '1')->pluck('name', 'id');
            $sellers = Seller::where('status', '1')->select('id', 'username', 'name')->get();
            $product = \App\AppHead::where('name','Like','Potato')->where('type', 'product')->select('id', 'image')->first();
            $stock_image = @$product->image;

            return view('backend.stock.create',compact('products','stock', 'sellers', 'stock_image','product','productSpecRel','ecs','productSpecChildRelation'));
        }else{
            $products = Product::all()->where('status', '1')->pluck('name', 'id');
            if(isset($request->product_id) && !empty($request->product_id)){
                $product_id = $request->product_id;
                $ProdSpecArr = ProductSpecification::where('product_id',$request->product_id)->where('parent_id',NULL)->orderBy('order')->limit(3)->pluck('display_name','id')->toArray();
            } else {
                $product = Product::all()->where('status', '1')->first();
                $product_id = @$product->id;
                $ProdSpecArr = ProductSpecification::where('product_id',@$product->id)->where('parent_id',NULL)->orderBy('order')->limit(3)->pluck('display_name','id')->toArray();
            }
           
            $ProdSpecArrKeys = array_keys($ProdSpecArr);
            $field1 = current($ProdSpecArrKeys);
            if(count($ProdSpecArrKeys) > 1){
                $field2 = next($ProdSpecArrKeys);
            } else {
                $field2 = '';
            }
           
            if(count($ProdSpecArrKeys) >2){
                $field3 = end($ProdSpecArrKeys);
            } else {
                $field3 = '';
            }
    
            $ProdSpecArrNames = array();
            $ProdSpecArrNames['field1'] = $field1;
            $ProdSpecArrNames['field2'] = $field2;
            $ProdSpecArrNames['field3'] = $field3;
            $msg="Unfortunately this stock is not exist!";
            return view('backend.stock.index',compact('msg','ProdSpecArr','ProdSpecArrNames','products'));
        }
    }

    public function update(Request $request, Offer $stock){
        if($request->city == ''){
            request()->validate([
                    'postalcode'=>'required|min:2|max:8',
                    'city' => 'required',
                    'product_id' => 'required',
                    'quantity' => 'required',
                    'price' => 'required',
                    'seller_id' => 'required',
                    'available_from_date' => 'required|date',
                    'available_per_day' => 'required|integer',
                    'pallets_available' => 'required|integer',
                ],[
                    'postalcode.required' => 'The postalcode or city field is required.',
                ]);
        }elseif($request->postalcode == ''){
            request()->validate([
                'postalcode'=>'required|min:2|max:8',
                'city'=>'required',
                'product_id' => 'required',
                'quantity' => 'required',
                'price' => 'required',
                'seller_id' => 'required',
                'available_from_date' => 'required|date',
                'available_per_day' => 'required|integer',
                'pallets_available' => 'required|integer',
            ]);
        } else {
            $request->validate([
                'product_id' => 'required',
                'quantity' => 'required',
                'price' => 'required',
                'seller_id' => 'required',
                'available_from_date' => 'required|date',
                'available_per_day' => 'required|integer',
                'pallets_available' => 'required|integer',
                'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'city'=>'required',
                'postalcode'=>'required|min:2|max:8',
            ],[
                'postalcode.required' => 'The postalcode or city field is required.',
            ]);
        }
        foreach($request->all() as $key=>$val){
            $tableArray[$key]=$val;
        }
        if($request->image){
            if(count((array)$request->image) > 6){
                return response()->json(['status' => 'error', 'message' => 'Max 6 images can be uploaded!']);
            }
            $imageName2 = array();
            $i = 0;
            foreach($request->image as $file){
                $i++;
                $tmp = time().'_'.$i.'.'.$file->getClientOriginalExtension();
                $file->move(public_path('images/stock'), $tmp);
                $imageName2[] = $tmp;
            }

            if($request->exp_image){
                $imageName = time().'.'.request()->exp_image->getClientOriginalExtension();
                request()->exp_image->move(public_path('images/stock'), $imageName);
            }
            $json_fields = array('exp_image');
            
            $tableArray['image'] = json_encode(@$imageName2);
            foreach($request->all() as $key=>$val){
                if (in_array($key, $json_fields)) {
                    $tableArray[$key] = @$imageName;
                }
            }
        }

        $tableArray['available_from_date'] = date('Y-m-d',strtotime($tableArray['available_from_date']));
        $tableArray['pallets_available'] = $request->pallets_available;
        $tableArray['stock_status'] = $request->stock_status;
        $tableArray['postalcode'] = $request->postalcode;

        if($request->load_status){
            $tableArray['load_status'] = $request->load_status;
        }

        $stock->update($tableArray);
        
        $all = $request->all();
        $offer_id = $stock->id;
        $specification = @$all['specification'];
        $offerPropertExists = $stock->offerProperty()->pluck('id','id')->toArray();
        if(is_array($specification) && !empty($specification)){
            foreach($specification as $product_spec_id=>$specValue)
            {
                if(is_array($specValue))
                {
                    foreach($specValue as $specValueKey=>$specValueValue){
                        $buyerPP = OfferProperty::updateOrCreate(
                            ['stock_id' => $offer_id,'product_spec_id' => $product_spec_id,'product_spec_val_id' => $specValueValue],
                            ['stock_id' => $offer_id,'product_spec_id' => $product_spec_id,'product_spec_val_id' => $specValueValue,'ecs' => @$all['ecs'][$product_spec_id][$specValueKey]]
                        );
                        unset($offerPropertExists[$buyerPP->id]);  
                        
                    }
                }  else {
                    $buyerPP = OfferProperty::firstOrCreate(
                        ['stock_id' => $offer_id,'product_spec_id' => $product_spec_id,'product_spec_val_id' => $specValue],
                        ['stock_id' => $offer_id,'product_spec_id' => $product_spec_id,'product_spec_val_id' => $specValue]
                    );
                    unset($offerPropertExists[$buyerPP->id]);  
                }        
            }
        }
        foreach($offerPropertExists as $propId){
            OfferProperty::destroy($propId);
        }
        
        $stock = Stock::with('offerProperty.productSpecValue')->where('id',$stock->id)->first();
        event(new StockUpdated($stock));
        return response()->json(['status' => 'success', 'message' => 'Stock updated successfully!']);
    }

    public function destroy(Stock $stock){
        $stock->delete();
        return response()->json(['success'=>'Stock deleted successfully.']);
    }

    public function getvcolorAjax(Request $request){
        $vcolor = \App\AppHead::where('id', $request->pid)->where('type', 'potato_variety')->select('id', 'color_id')->first();
        return response()->json(['color_id'=>@$vcolor->color_id]);
    }

    public function getproductsampleAjax(Request $request){
        $product = Product::where('id', $request->pid)->first();
        if(!empty($product)){
            $html = '<a href="'.asset('images/products/').'/'.$product->image.'" data-fancybox data-caption="'.$product->name.'"><img src="'.asset('images/products/').'/'.$product->image.'" class="mb-2 img-thumbnail"></a>';
            print_r($html);
            exit;
        }
    }

    public function stocksexports() 
    {
        return Excel::download(new StocksExport, 'stocks.xlsx');
    }

    public function stockimport(Request $request){
        Excel::import(new SellerImport,request()->file('stock_file'));           
        return redirect()->back();
    }

    public function get_city_list(Request $request,$country = null){
        $cities = \App\PostalCode::all()->where('status', '1')->where('type', 'city')->where('country', $country)->pluck('name', 'name');
        return $cities;
    }
    public function get_postal_code(Request $request,$city = null){
        $postal_codes = \App\PostalCode::all()->where('status', '1')->where('type', 'city')->where('name', $city)->pluck('postal_code', 'postal_code');
        return $postal_codes;
    }
    public function rejectedStock(Request $request)
    {
        $products = Product::all()->where('status', '1')->pluck('name', 'id');
        if(isset($request->product_id) && !empty($request->product_id)){
            $product_id = $request->product_id;
            $ProdSpecArr = ProductSpecification::where('product_id',$request->product_id)->where('parent_id',NULL)->orderBy('order')->limit(3)->pluck('display_name','id')->toArray();
        } else {
            $product = Product::all()->where('status', '1')->first();
            $product_id = @$product->id;
            $ProdSpecArr = ProductSpecification::where('product_id',@$product->id)->where('parent_id',NULL)->orderBy('order')->limit(3)->pluck('display_name','id')->toArray();
        }
       
        $ProdSpecArrKeys = array_keys($ProdSpecArr);
        $field1 = current($ProdSpecArrKeys);
        if(count($ProdSpecArrKeys) > 1){
            $field2 = next($ProdSpecArrKeys);
        } else {
            $field2 = '';
        }
       
        if(count($ProdSpecArrKeys) >2){
            $field3 = end($ProdSpecArrKeys);
        } else {
            $field3 = '';
        }

        $ProdSpecArrNames = array();
        $ProdSpecArrNames['field1'] = $field1;
        $ProdSpecArrNames['field2'] = $field2;
        $ProdSpecArrNames['field3'] = $field3;
        
        if ($request->ajax()) {
            $data = Stock::with('product', 'seller','offerProperty','offerProperty.productSpec','offerProperty.productSpecValue')->where('product_id',$product_id)->where('load_status','rejected')->get();
            if(auth()->user()->hasRole('seller')){
                $seller_id =  auth()->user()->id;
                $data = Stock::with('product', 'seller','offerProperty','offerProperty.productSpec','offerProperty.productSpecValue')->where('seller_id', $seller_id)->get();
            }
            
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                if(in_array('seller', auth_roles())){
                    $route_pre = 'seller';
                }else{
                    $route_pre = 'admin';
                }
                $btn = ' <div class="btn-group btn-group-sm">';
                if(auth()->user()->can('edit stock')){
                    $btn .= '<button type="button" class="btn btn-edit editItem" data-url="'.route($route_pre.'.stock.edit', $row->id).'"><i class="fas fa-edit"></i></button>'; 
                }
                if(auth()->user()->can('view stock detail')){
                    $btn .= '<button type="button" class="btn btn-primary viewItem" data-url="'.route($route_pre.'.stock.show', $row->id).'"><i class="fas fa-eye"></i></button>'; 
                } 
                if(auth()->user()->can('delete stock')){
                    $btn .= '<button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>'; 
                }
                $btn .= '</div>';
                return $btn;
            })
            ->addColumn('price', function($row){
                return  currency($row->price);
            })
            ->addColumn('seller_username', function($row){
                return (@$row->seller->username?@$row->seller->username:'-');
            })
            ->addColumn('field1', function($row) use ($field1) {
                $arrFields  = array();
                foreach($row->offerProperty as $prop){
                    if(@$prop->productSpec->field_type == 'dropdown_switchboxes'){
                        $arrFields[$prop->product_spec_id][] = @$prop->productSpecValue->value;
                    } else {
                        $arrFields[$prop->product_spec_id][] = @$prop->value;
                    }
                }
                if(is_array($arrFields)&& !empty($arrFields[@$field1])){
                    return implode(', ',@$arrFields[@$field1]);
                } else {
                    return '-';
                }
            })
            ->addColumn('field2', function($row) use ($field2){
                $arrFields  = array();
                foreach($row->offerProperty as $prop){
                    if(@$prop->productSpec->field_type == 'dropdown_switchboxes'){
                        $arrFields[$prop->product_spec_id][] = @$prop->productSpecValue->value;
                    } else {
                        $arrFields[$prop->product_spec_id][] = @$prop->value;
                    }
                }
                if(is_array($arrFields)&& !empty($arrFields[@$field2])){
                    return implode(', ',@$arrFields[@$field2]);
                } else {
                    return '-';
                }
            })
            ->addColumn('field3', function($row) use ($field3){
                if($field3 == ''){
                    return '';        
                } else {
                    $arrFields  = array();
                    foreach($row->offerProperty as $prop){
                        if(@$prop->productSpec->field_type == 'dropdown_switchboxes'){
                            $arrFields[$prop->product_spec_id][] = @$prop->productSpecValue->value;
                        } else {
                            $arrFields[$prop->product_spec_id][] = @$prop->value;
                        }
                    }
                    if(is_array($arrFields)&& !empty($arrFields[@$field3])){
                        return implode(', ',@$arrFields[@$field3]);
                    } else {
                        return '-';
                    };
                }
            })
            ->addColumn('product_name', function($row){
                return (@$row->product->name?@$row->product->name:'-');
            })
            ->addColumn('variety_detail_name', function($row){
                return (@$row->variety_detail->name?@$row->variety_detail->name:'-');
            })
           ->addColumn('size', function($row){
                return (@$row->size_from.'-'.@$row->size_to);
            })
            ->addColumn('pallets', function($row){
                if($row->pallets_available == 1) 
                {
                    $pallet = 'Yes';
                }
                else
                {
                    $pallet = 'No';
                }
                return (@$pallet);
            })
            ->rawColumns(['action','price'])
            ->make(true);
        }
        return view('backend.stock.rejected_stock',compact('ProdSpecArr','ProdSpecArrNames'));
    }
}
