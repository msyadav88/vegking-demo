<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\ProductVarieties;
use DataTables;
use App\AppHead;
use App\Stock;
use View;
use App\ProductSpecification;
use App\ProductSpecificationValue;
use App\Exports\ProductExport; 
use Excel;
use App\Imports\ProductImport;
use App\BuyerPref;
use App\BuyerProductPref;
use App\PostalCode;
use DB;

class ProductController extends Controller{

    public function __construct()
    {
        $this->middleware('permission:view products', ['only' => ['index']]);
        $this->middleware('permission:add products', ['only' => ['create','store']]);
        $this->middleware('permission:edit products', ['only' => ['edit','update']]);
        $this->middleware('permission:delete products', ['only' => ['destroy']]);
        $this->middleware('permission:export products', ['only' => ['productsexports']]);
    }

    public function index(Request $request){
      //return $data = Product::with('variety_detail', 'packing_detail')->where('status', '1')->get();
        if ($request->ajax()) {
        $data = Product::get();
        return Datatables::of($data)
             ->addIndexColumn()
             ->addColumn('image', function($row){
                $image = '<a href="'.asset('images/products/').'/'.$row->image.'" data-fancybox data-caption="'.$row->name.'"><img src="'.asset('images/products/').'/'.$row->image.'" onerror=this.src="'.asset('images/products/no_img.png').'" class="mb-2 img-thumbnail list_image" /></a>';
                return $image;
             })
             ->addColumn('homepage_image', function($row){
                $homepage_image = '<a href="'.asset('images/products/').'/'.$row->homepage_image.'" data-fancybox data-caption="'.$row->name.'"><img src="'.asset('images/products/').'/'.$row->homepage_image.'" onerror=this.src="'.asset('images/products/no_img.png').'" class="mb-2 img-thumbnail list_image" /></a>';
                return $homepage_image;
             })
             ->addColumn('status', function($row){
               if($row->status== '1')
                return 'Active';
                else{ return 'Inactive'; }
             })
            ->addColumn('action', function($row){
                $btn = ' <div class="btn-group btn-group-sm">';
                if(auth()->user()->can('edit products')){
                    $btn .= '<button type="button" class="btn btn-edit editItem" data-url="'.route('admin.products.edit', $row->id).'"><i class="fas fa-edit"></i></button>';
                }
                if(auth()->user()->can('delete products')){
                    $btn .= '<button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>';
                }
                $btn .= '</div>';
                return $btn;
             })
             ->rawColumns(['image', 'action','homepage_image'])
             ->make(true);
        }
       return view('backend.products.index');
    }

    public function create(){
        return view('backend.products.create');
    }

    public function store(Request $request){
        //echo "<pre/>"; print_r($request->all()); die;
        $request->validate([
            'name' => 'required',
            'name_pl' => 'required',
            'name_de' => 'required',
            'image' => 'required',
            'homepage_image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'homepage_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'base_price' => 'required',
        ]);

        $image = $request->file('image');
        $name = time().'_1.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('images/products');
        $image->move($destinationPath, $name);

        if($request->required_type == '1')
        {
            $type="Product";
        }else{
            $type = "Service";
        }
        $homepage_image = $request->file('homepage_image');
        $homepage_image_name = time().'_home.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('images/products');
        $homepage_image->move($destinationPath, $homepage_image_name);

        Product::create([
           'name' => $request->name,
           'name_pl' => $request->name_pl,
           'name_de' => $request->name_de,
           'type' => $type,
           'image' => $name,
           'homepage_image' => $homepage_image_name,
           'base_price' => $request->base_price,
           'status' => $request->required
        ]);

        return response()->json(['status' => 'success', 'message' => 'Product created successfully.']);
    }

    public function show(Product $product)
    {
        //
    }
    public function edit($id){
        $product = Product::where(['id' => $id])->first();
        $countries = PostalCode::all();
        //echo "<pre>"; print_r($country);die;
        if($product){
            return view('backend.products.edit',compact('product','countries'));
         }else{
          $msg="Unfortunately this Product is not exist!";
          return view('backend.products.index',compact('msg'));
         } 
         
      }

    public function update(Request $request, Product $product){
       // echo "<pre/>"; print_r($request->all()); die;
        if($request->image){
            $request->validate([
                'name' => 'required',
                'name_pl' => 'required',
                'name_de' => 'required',
                'image' => 'required',
                'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'base_price' => 'required'
            ]);
        }else{
            $request->validate([
                'name' => 'required',
                'name_pl' => 'required',
                'name_de' => 'required',
                'base_price' => 'required'
            ]);
        }

        if($request->image){
            $image = $request->file('image');
            $name = time().'_1.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/products');
            $image->move($destinationPath, $name);
            $product_data['image'] = $name;
            if($request->old_image && file_exists( public_path('images/products/'.$request->old_image))){
                unlink(public_path('images/products/'.$request->old_image));
            }
        }

        if($request->homepage_image){
            $homepage_image = $request->file('homepage_image');
            $homepage_imagename = time().'_home.'.$homepage_image->getClientOriginalExtension();
            $destinationPath = public_path('images/products');
            $homepage_image->move($destinationPath, $homepage_imagename);
            $product_data['homepage_image'] = $homepage_imagename;
            if($request->old_home_image && file_exists( public_path('images/products/'.$request->old_home_image))){
                unlink(public_path('images/products/'.$request->old_home_image));
            }
        }
        if($request->required_type == '1')
        {
            $type="Product";
        }else{
            $type = "Service";
        }

        $product_data['name'] = $request->name;
        $product_data['name_pl'] = $request->name_pl;
        $product_data['name_de'] = $request->name_de;
        $product_data['type'] = $type;
        $product_data['status'] = $request->required;
        $product_data['base_price'] = $request->base_price;

        $product->update($product_data);
        return response()->json(['status' => 'success', 'message' => 'Product updated successfully.']);
    }

    public function destroy(Product $product){
        $product->delete();
        return response()->json(['success'=>'Product deleted successfully.']);
    }

    public function import_product() 
  {
    $products = Product::all()->where('status', '1')->pluck('name', 'id');
    return view('backend.product_import', [ 'products' => $products  ] );
  }

  public function parseImport(Request $request)
  {
      $file_upload = $request->input('file_upload');
      
      if( $file_upload == '1' ){
          
          $file_up = $request->file('csv_file');
          
          if($file_up == ""){
            return response()->json( ['error' => 1, 'msg' => 'Please upload file']);
            exit;
         }
        //  $path1 = $request->file('csv_file')->store('temp'); 
        //  $path=storage_path('app').'/'.$path1;  
         Excel::import(new ProductImport,$request->file('csv_file'));           
            return redirect()->back();

    }
}
    public function SaveProductVariety(Request $request)
    {
        
        $request->validate([
            'product_id' => 'required',
            'URL' => 'required|unique:product_varieties',
            ],['URL.unique' => 'The URL has already been taken',
            'URL.required' => 'The URL field is required',
            ]);

        ProductVarieties::create([
            'user_id' => auth()->user()->id,
            'product_id' => $request->product_id,
            'URL' => $request->URL,
            'higher_taxon' => $request->higher_taxon,
            'genus' => $request->genus,
            'species' =>$request->species,
            'parentage' => $request->parentage,
            'breeder' => $request->breeder,
            'breeder_Agent' => $request->breeder_agent,
            'status' => (@$request->status ? 1 : 0),
         ]);
 
         return response()->json(['status' => 'success', 'message' => 'Product created successfully.']);
    }

    public function getProductAjax(Request $request, Product $product)
    {
        if($request->has('stock_id')){
            $offer = Stock::select('id','product_id')->where('id',$request->get('stock_id'))->first();
            $product_id = $offer->product_id;    

            $offerProperty = $offer->offerProperty()->select('offer_id','product_spec_id','product_spec_val_id','ecs')->get()->toArray();
            $productPrefsMapping = array();
            $ecs = array();
            foreach($offerProperty as $productPref){
                $ecs[$productPref['product_spec_id']][$productPref['product_spec_val_id']] = @$productPref['ecs'];
                $productPrefsMapping[$productPref['product_spec_id']][] = $productPref['product_spec_val_id'];   
               
            }
            //echo $product_id; die;    
        } else {
            $product_id = $request->pid;
        }            
        
        $product = Product::find($product_id);
        $productspecification_list = ProductSpecification::with('options')->where('product_id',$product_id)->where('parent_id',null)->orderBy('order')->get();
        $productspecificationval_list = ProductSpecificationValue::with('product_specification')->where('product_id',$product_id)->whereNotNull('parent_id')->get();
        $productSpecChildRelation = array();
        foreach($productspecificationval_list as $childItem){
            if($childItem->product_specification->reference_id != ''){
               $productSpecChildRelation[$childItem->parent_id]['reference_id'] =  $childItem->product_specification->reference_id;
               $productSpecChildRelation[$childItem->parent_id]['value'] =  $childItem->value;
            }
        }
        //echo "<pre/>"; print_r($productspecification_list); die;
        $productSpecRel = array();
        foreach($productspecification_list as $spec){
            $productSpecRel[$spec->id]['name'] = $spec->display_name;
            $productSpecRel[$spec->id]['hasmany'] = $spec->stock_hasmany;
            $productSpecRel[$spec->id]['can_edit'] = $spec->can_edit;
            $productSpecRel[$spec->id]['required'] = $spec->required;
            $productSpecRel[$spec->id]['field_type'] = $spec->field_type;
            if($spec->stock_hasmany == 'Yes'){
                
                 if($request->has('stock_id')){
                $productSpecRel[$spec->id]['default'] = @$productPrefsMapping[$spec->id];
                 } else {
                     $productSpecRel[$spec->id]['default'] = array();
                 }
            } else {
                if($request->has('stock_id')){
                    $productSpecRel[$spec->id]['default'] = current($productPrefsMapping[$spec->id]??array());
                 } else {
                    $productSpecRel[$spec->id]['default'] = array();
                 }
            }
            $productSpecRel[$spec->id]['options'] = array();
            foreach($spec->options as $option){
                if($option->default == 1){
                    $productSpecRel[$spec->id]['default'][] = $option->id;
                }
                if($spec->stock_hasmany == 'Yes'){
                    $productSpecRel[$spec->id]['options'][$option->id]['name'] = $option->value;
                    $productSpecRel[$spec->id]['options'][$option->id]['premium'] = 0;
                    $productSpecRel[$spec->id]['options'][$option->id]['ec'] = @$option->ec;
                } else {
                    $productSpecRel[$spec->id]['options'][$option->id] = $option->value;
                }
            }
        }
        $data = array('product_id'=> $product_id,'productSpecRel' => $productSpecRel,'productSpecChildRelation' => $productSpecChildRelation);
        //echo "<pre/>"; print_r($productSpecChildRelation); die;
        return response()->view('backend.products.stock-product-pref', $data, 200);
    }
    
    public function getProductAjaxRequest(Request $request)
    {
        if(isset($_POST['productid'])){
            $product_id = @$_POST['productid'];
            $productMappedData = $this->mapProduct($product_id);
            return $productMappedData;
        }
        
    }

    public function getProductStockAjax(Request $request, Product $product)
    {
        
        if(isset($_POST['productid'])){
            $product_id = @$_POST['productid'];
            $productMappedData = $this->mapProduct($product_id);
            return $productMappedData;
        } else {
            $Products = Product::all()->where('status', '1')->pluck('id', 'name');
            $output = [];
            foreach($Products as $pname=>$product_id){
                $productMappedData = $this->mapProduct($product_id);
                $output[$product_id] = $productMappedData;
            }
            return response()->json($output);
        }
        
    }

    public function mapProduct($product_id){
        $request = new  Request ;
        $productPrefsMapping = array();
        if($request->has('stock_id')){
            $offer = Stock::select('id','product_id')->where('id',$request->get('stock_id'))->first();
            $product_id = $offer->product_id;    
            $offerProperty = $offer->offerProperty()->select('offer_id','product_spec_id','product_spec_val_id','ecs')->get()->toArray();
            $ecs = array();
            foreach($offerProperty as $productPref){
                $productPrefsMapping[$productPref['product_spec_id']][] = $productPref['product_spec_val_id'];   
            }
        }
        
        $productspecification_list = ProductSpecification::with('options','options.children')->where('product_id',$product_id)->where('parent_id',null)->whereIn('type_name',['Packing','Purpose','Defects','Size','Extra Services','Color','Sugar Content','Colorful','Quality','MarketProcessing','Soil'])->get();
        $spec_array = array();
        $spec_array2 = $spec_array3 = $spec_array4 = array();
        $spec_ids = array();
        $spec_array_packing = array();
        $spec_array_packing_subs = array();
        foreach($productspecification_list as $productspec){
            $spec_array[$productspec->type_name] = array();
            $spec_array2[$productspec->type_name] = array();
            $spec_ids[$productspec->type_name] = $productspec->id;
          
            foreach($productspec->options as $productspecval){
                if($productspecval->parent_id == NULL){
                   $spec_array[$productspec->type_name][$productspecval->id] =  $productspecval->value;
                   $spec_array2[$productspec->type_name][$productspecval->id]['title'] =  $productspecval->value;
                   $spec_array2[$productspec->type_name][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
                }
                if($productspec->type_name == 'Purpose'){
                    if($productspecval->parent_id == null){
                        $arrayTags = explode(',',@$productspecval->tags);
                        if(in_array('Market',$arrayTags)){
                            $spec_array['PurposeMarket'][$productspecval->id]['title'] =  $productspecval->value;
                            $spec_array['PurposeMarket'][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
                        } else if(in_array('Processing',$arrayTags)){
                            $spec_array['PurposeProcessing'][$productspecval->id]['title'] =  $productspecval->value;
                            $spec_array['PurposeProcessing'][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
                        }
                    } else {
                        
                       
                    }
                    
                }
                else if($productspec->type_name == 'Soil'){
                    $ProductSpecificationValue = ProductSpecificationValue::where('value','Like','Unwashed/Unwashable')->first();
                    if(!empty($ProductSpecificationValue)){
                        $spec_array3[$ProductSpecificationValue->id][$productspecval->id]['title'] =  $productspecval->value;
                        $spec_array3[$ProductSpecificationValue->id][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
                    }
                } else if($productspec->type_name == 'Defects'){
                    
                    $spec_array4['Defects'][$productspecval->id]['title'] =   $productspecval->value;
                    
                    $spec_array4['Defects'][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
                }
               if($productspec->type_name == 'Packing'){
                   $childrens = $productspecval->children;
                    if(count($childrens)){
                       
                        foreach($childrens as $children){
                       $spec_array_packing_subs[$productspecval->id][$children->id] =  $children->value;
                        }
                    }
                   
                    $spec_array_packing[$productspec->type_name][$productspecval->id] =  $productspecval->ec;
               }
            }
        }   
        $productMappedData = ['PurposeMarket' => @$spec_array['PurposeMarket'],
                    'PurposeProcessing' => @$spec_array['PurposeProcessing'],
                    'MarketProcessing' => @$spec_array['MarketProcessing'],
                    'Variety' => @$spec_array['Variety'],
                    'Packing' => @$spec_array['Packing'],
                    'Purpose' => @$spec_array['Purpose'],
                    'Color' => @$spec_array['Color'],
                    'QualityImg' => @$spec_array2['Purpose'],
                    'Defects' => @$spec_array4['Defects'],
                    'ExtraServices' => @$spec_array['Extra Services'],
                    'PurposeChilds' => @$spec_array3,
                    //'Cleaning' => @$spec_array['Cleaning'],
                    'Variety_id' => @$spec_ids['Variety'],
                    'Packing_id' => @$spec_ids['Packing'],
                    'Quality_id' => @$spec_ids['Quality'],
                    'Defects_id' => @$spec_ids['Defects'],
                    //'Cleaning_id' => @$spec_ids['Cleaning'],
                    'Color_id' => @$spec_ids['Color'],
                    'Purpose_id' => @$spec_ids['Purpose'],
                    'Colorful_id' => @$spec_ids['Colorful'],
                    'ExtraServices_id' => @$spec_ids['Extra Services'],
                    'Size_id' => @$spec_ids['Size'],
                    'Sugarcontent_id' => @$spec_ids['Sugar Content'],
                    'productPrefsMapping' => @$productPrefsMapping,
                    'spec_array_packing' => @$spec_array_packing,
                    'spec_array_packing_subs' => @$spec_array_packing_subs,
                ];
        return $productMappedData;            
    }
    public function getProductForBuyerAjax(Request $request, Product $product){
        $product = Product::find($request->pid);

        $productspecification_list = ProductSpecification::with('options')->where('parent_id',null)->orderBy('order')->get();
        $productSpecRel = array();
        foreach($productspecification_list as $spec){
            $productSpecRel[$spec->product_id][$spec->id]['name'] = $spec->display_name;
            $productSpecRel[$spec->product_id][$spec->id]['id'] = $spec->id;
            $productSpecRel[$spec->product_id][$spec->id]['hasmany'] = $spec->buyer_hasmany;
            $productSpecRel[$spec->product_id][$spec->id]['required'] = $spec->required;

            if($spec->buyer_hasmany == 'Yes'){
                $productSpecRel[$spec->product_id][$spec->id]['default'] = array();
            } else {
                $productSpecRel[$spec->product_id][$spec->id]['default'] = array();
            }

            $productSpecRel[$spec->product_id][$spec->id]['options'] = array();
            foreach($spec->options as $option){
                if($option->default == 1){
                    $productSpecRel[$spec->product_id][$spec->id]['default'][] = $option->id;
                }
                if($spec->buyer_hasmany == 'Yes'){
                    $productSpecRel[$spec->product_id][$spec->id]['options'][$option->id]['name'] = $option->value;
                    $productSpecRel[$spec->product_id][$spec->id]['options'][$option->id]['premium'] = 0;
                    $productSpecRel[$spec->product_id][$spec->id]['options'][$option->id]['id'] = $spec->id;
                } else {
                    $productSpecRel[$spec->product_id][$spec->id]['options'][$option->id] = $option->value;
                }
               //     $productSpecRel[$spec->product_id][$spec->id]['id'][$option->id] =$spec->id;
            }
        }

     //   echo "<pre/>"; print_r($productSpecRel); die;
        $data = array('product_id'=> $request->pid,'productSpecRel' => @$productSpecRel[$request->pid]);

        return response()->view('backend.products.product-pref', $data, 200);
    }

    public function getProductAjaxMultiple(Request $request, Product $product)
    {
        $productSpecRel =array();
        $product = Product::find($request->pid);
        $pref_id = $request->pref_id;
        $tabNumber = $request->tabNumber;
        $buyerProductPref = BuyerProductPref::where('buyer_pref_id',$pref_id)->get();
        $productPrefRel = array();
        $productProdRel = array();    
        $productPrefsMapping = array();
        $productPrefsMappingPremiums = array();
        foreach($buyerProductPref as $productPref) {           
            $productPrefsMapping[$productPref['key']][] = $productPref['value'];    
            $productPrefsMappingPremiums[$productPref['key']][$productPref['value']] = $productPref['premium'];
        }

        $buyerPref = BuyerPref::where("id",$pref_id)->first();
        $productProdRel = array();
        if(!empty($buyerPref)){
            $productProdRel[$pref_id]["delivery_street"] = $buyerPref->street;
            $productProdRel[$pref_id]["delivery_city"] = $buyerPref->city;
            $productProdRel[$pref_id]["delivery_country"] = $buyerPref->country;
            $productProdRel[$pref_id]["delivery_postalcode"] = $buyerPref->postalcode;              
        }
          $product_list = Product::all()->where('status',1)->pluck('name','id');
          $productspecification_list = ProductSpecification::with('options')->where('product_id',$request->pid)->where('parent_id',null)->get();
          foreach($productspecification_list as $spec){
           
              $productSpecRel[$spec->id]['name'] = $spec->display_name;
              $productSpecRel[$spec->id]['hasmany'] = $spec->buyer_hasmany;
              $productSpecRel[$spec->id]['buyer_pref_anylogic'] = $spec->buyer_pref_anylogic;
              $productSpecRel[$spec->id]['field_type'] = $spec->field_type;
              if($spec->buyer_hasmany == 'Yes'){
                  $productSpecRel[$spec->id]['default'] = @$productPrefsMapping[$spec->id];
              } else {
                  $productSpecRel[$request->pid][$spec->id]['default'] = current($productPrefsMapping[$spec->id]??array());
              }
              $productSpecRel[$spec->id]['options'] = array();
              foreach($spec->options as $option){
                if($spec->buyer_hasmany == 'Yes'){
                    $productSpecRel[$spec->id]['options'][$option->id]['name'] = $option->value;
                    $productSpecRel[$spec->id]['options'][$option->id]['premium'] = @$productPrefsMappingPremiums[$spec->id][$option->id];
                } else {
                    $productSpecRel[$spec->id]['options'][$option->id] = $option->value;
                }
              }
             
          }
           $data = array('product_id'=> $request->pid,'productProdRel'=>$productProdRel,'productSpecRel' => $productSpecRel,'pref_id' => $pref_id,'tabNumber'=>$tabNumber);
        return response()->view('backend.products.stock-product-multi-pref', $data, 200);
    }
    public function productsexports()
    {
        return Excel::download(new ProductExport, 'product.xlsx');
    }
    
    public function productSpecRelation(Request $request)
    {
    }
    
    public function productSpecRelationCreate(Request $request)
    {
        // echo "<pre/>"; print_r($request->all()); die;
        $specs = \App\ProductSpecification::with(['options' => function($query) {
                        $query->select(['id', 'product_specification_id', 'value']);
                    }])
                    ->select('product_id','id','display_name','parent_id')
                    //->whereNull('parent_id')
                    ->get()->toArray();
        $productSpecRel = [];
        
        foreach($specs as $spec){
            if($spec['parent_id'] == NULL){
                $productSpecRel[$spec['product_id']][$spec['id']]['name'] = $spec['display_name'];
            } else {
                $productSpecRel[$spec['product_id']][$spec['parent_id']]['childs'][$spec['id']]['name'] = $spec['display_name'];
            }
            foreach($spec['options'] as $option){
                if($spec['parent_id'] == NULL){
                    $productSpecRel[$spec['product_id']][$spec['id']]['values'][$option['id']] = $option['value'];
                }
            }
        }
        $products = Product::all()->where('status', '1')->pluck('name', 'id', 'image');
        echo "<pre/>"; print_r($productSpecRel); die;
        $data = array('product_id'=> $request->pid,'productSpecRel' => $productSpecRel,'products' => $products);
        return response()->view('backend.products.product-spec-relation', $data, 200);
    }
    
    public function productSpecRelationStore(Request $request)
    {
        echo "<pre/>"; print_r($request->all()); die;
    }
    
    public function getProductSpec(Request $request, Product $product)
    {
        
    }
    
    public function getProductSpecVals(Request $request, Product $product)
    {
        $product_id = @$request->get('product_id');
        $product_spec_id = @$request->get('product_spec_id');
       
        $productspec = ProductSpecification::with('options')->where('product_id',$product_id)->where('parent_id',null)->where('id',$product_spec_id)->first();
        $spec_array = array();
        $spec_ids = array();
        $spec_array_packing = array();
        foreach($productspec->options as $productspecval){
            $spec_array[$productspecval->id] =  $productspecval->value;
        }
        return response()->json(@$spec_array);
        
    }

     public function getVarity(Request $request)
     {
        $term = @$request->get('search');
        $product_id = @$request->get('product_id');
        $productspec = ProductSpecification::where('type_name','Variety')->where('product_id',$product_id)->first();

        $productspec_id = $productspec->id;
        $productspecs = ProductSpecificationValue::select('id',DB::raw('value as text'))->where('product_specification_id',$productspec_id)->where('value','LIKE',$term.'%')->limit(10)->get()->toArray();
        $result = ['result'=>$productspecs,'pagination'=>['more'=>true]];

        return response()->json(@$result);

      }
}
