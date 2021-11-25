<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AppHead;
use App\Buyer;
use App\BuyerProductPref;
use App\ProductSpecification;
use App\BuyerPref;
use App\Product;
use App\Models\Auth\User;
use DataTables;
use DB;
use App\Exports\BuyerPrefExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Events\Pushnotification;
use App\Events\Backend\BuyerPrefCreated;
class BuyerprefController extends Controller{
    
    public function index(Request $request){
        $productsimage = Product::select('image','id','type','name')->where('status', '1')->get();
        $productByName = Product::all()->where('status', '1')->pluck('id', 'name');

        $productspecification_list = ProductSpecification::with('options')
        ->where('parent_id',null)->whereIn('type_name',['Quality'])->get();
        $qualityGlobalArray = [];
        foreach($productspecification_list as $productspec){
           
            foreach($productspec->options as $productspecval){
                if($productspecval->parent_id == NULL){
                    if($productspec->tags == 'Conditional'){
                        $qualityGlobalArray[$productspec->product_id][$productspecval->related_spec_val_id][$productspecval->id]['title'] =  $productspecval->value;
                        $qualityGlobalArray[$productspec->product_id][$productspecval->related_spec_val_id][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
                    } else {
                        $qualityGlobalArray[$productspec->product_id][$productspecval->id]['title'] =  $productspecval->value;
                        $qualityGlobalArray[$productspec->product_id][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
                    }
                }
            }
        }

        $productBasicDetail  = get_buyer_popup_product_types();
        $productBasicDetail  = $productBasicDetail['en'];
            
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

        if ($request->ajax()) {
            if(auth()->user()->hasRole('administrator') && request()->segment(1) == 'admin')
            {
                $data = BuyerPref::with('product', 'buyer','productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->get();
            }
            else
            {
                if(!empty(get_buyers_by_user_id()))
                {
                    $buyer_id = get_buyers_by_user_id()->id;
                } 
                else 
                {
                    $buyer_id =  auth()->user()->id;
                }
                
                $data = BuyerPref::with('product', 'buyer','productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->where(['buyer_id' => @$buyer_id])->get();
            }
              
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if(in_array('buyer', auth_roles())){
                        $route_pre = 'buyer';
                    }else{
                        $route_pre = 'admin';
                    }
                
                    $btn = ' <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-edit editItem" data-id="'.$row->id.'" data-url="'.route($route_pre.'.buyerpref.edit', $row->id).'"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-primary viewItem" data-url="'.route($route_pre.'.buyerpref.show', $row->id).'"><i class="fas fa-eye"></i></button>
                            <button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>
                            </div>';
                    return $btn;
                })
                ->addColumn('buyer_name', function($row){
                    return (@$row->buyer->username?@$row->buyer->username:'-');
                })
                ->addColumn('product_name', function($row){
                    return (@$row->product->name?@$row->product->name:'-');
                })
                ->addColumn('image', function($row){
                    $arrFields  = array();
                    foreach($row->productPrefs as $prop){
                        // $arrFields[$prop->product_spec_id][] = @$prop->productSpecValueRel->value;
                        $arrFields[@$prop->productSpec->display_name][] = @$prop->productSpecValue->value;
                    }
                    // dd($arrFields);
                     foreach(@$arrFields as $display_name=>$net){
                          if($display_name== 'Soil'){
                              $soil= $net[0]; 
                          }
                          if($display_name== 'Flesh Color'){
                            $flesh_Color= $net[0]; 
                        }
                        if($display_name== 'Potato Variety'){
                            $potato_variety= $net[0]; 
                        }
                 }
                    $image = '<a class="image"><img src="'.asset('images/products/').'/'.@$row->product->image.'" onerror=this.src="'.asset('images/products/no_img.png').'" data-homepage_image="'.asset('images/products/').'/'.@$row->product->homepage_image.'" name="'.@$row->product->name.'" data-soil="'.@$soil.'" data-fleshcolor="'.@$flesh_Color.'" data-potato_variety="'.@$potato_variety.'" class="mb-2 img-thumbnail list_image" /></a>';
                    return $image;
                 })
                ->rawColumns(['action','image'])
                ->make(true);
        }
        $products = Product::all()->where('status', '1')->pluck('name', 'id', 'image');
        $buyers = Buyer::where('status', '1')->pluck('username','id');
        return view('backend.buyerpref.index',compact('products','productsimage','apple_specs','productByName','productConfiguration','productBasicDetail','qualityGlobalArray','buyers'));
    }

    public function create()
    { 
		$product_list = Product::all()->where('status',1)->pluck('name','id');
        $productspecification_list = ProductSpecification::with('options')->where('parent_id',null)
        ->where('tags',null)
        ->get();

		$productSpecRel = array(); 
        foreach($productspecification_list as $spec)
        {
            $productSpecRel[$spec->product_id][$spec->id]['name'] = $spec->display_name;
            $productSpecRel[$spec->product_id][$spec->id]['hasmany'] = $spec->buyer_hasmany;
            $productSpecRel[$spec->product_id][$spec->id]['required'] = $spec->required;
            
            if($spec->buyer_hasmany == 'Yes')
            {
                $productSpecRel[$spec->product_id][$spec->id]['default'] = array();
            } 
            else 
            {
                $productSpecRel[$spec->product_id][$spec->id]['default'] = array();
            }
            
            $productSpecRel[$spec->product_id][$spec->id]['options'] = array();
            foreach($spec->options as $option)
            {
                if($option->default == 1)
                {
                    $productSpecRel[$spec->product_id][$spec->id]['default'][] = $option->id;
                }
                if($spec->buyer_hasmany == 'Yes')
                {
                    $productSpecRel[$spec->product_id][$spec->id]['options'][$option->id]['name'] = $option->value;
                    $productSpecRel[$spec->product_id][$spec->id]['options'][$option->id]['premium'] = 0;
                } 
                else 
                {
                    $productSpecRel[$spec->product_id][$spec->id]['options'][$option->id] = $option->value;
                }
            }
        }
          
        $buyer_id = auth()->user()->id;
        $buyer = Buyer::select('id')->where('user_id',$buyer_id)->first();
        if(!empty($buyer))
        {
            $buyer_id = $buyer->id;
        }
        
        $first_product = current(array_keys($product_list->toArray()));
		return view('backend.buyerpref.add-edit',compact('product_list','productSpecRel','first_product','buyer_id'));
    }

    public function getPrefCount(Request $request){
            if(!empty(get_buyers_by_user_id())){
                $buyer_id = get_buyers_by_user_id()->id;
             } else {
                 $buyer_id =  auth()->user()->id;
             }
             $buyer_count = BuyerPref::where('buyer_id',$buyer_id)->count();
           
             return response()->json(['buyer_count' => $buyer_count]);
    }

    public function storeajax(Request $request){
		$validate_array = ['product_id' => 'required|not_in:0',
        'country' => 'required',
        'postalcode' => 'required'];
        $all = $request->all();
        //echo"<pre>"; print_r($all); die;
        $buyer = Buyer::select('id')->where('user_id',auth()->user()->id)->first();
		$buyer_id = @$buyer->id;
        $productspecs = ProductSpecification::where('product_id', $all['product_id'])->with('options')->get();
        if(isset($productspecs) && !empty($productspecs)){
            $validationsname = '';
            foreach($productspecs as $required){
                if($required['required'] == 'Yes'){
                    if (count($required->options)){
                        $validate_array['specification'][$required->options[0]->product_specification_id][0] = 'required';
                    }
                }
            }
        }
        //echo "<pre/>"; print_r($all);
        $tableArray = array();
        if(empty($request->buyer_id))
        {
            if(!empty(get_buyers_by_user_id()))
            {
                $tableArray['buyer_id']= get_buyers_by_user_id()->id;
            } 
            else 
            {
                $tableArray['buyer_id']=  auth()->user()->id;
            }
        }
        else 
        {
            $tableArray['buyer_id']=$request->buyer_id;
        }
        $tableArray['product_id']  = $all['product_id'];
        $tableArray['country'] = $request->country;
        $tableArray['postalcode'] = $request->postalcode;
        
        $BuyerPref = BuyerPref::create($tableArray);
        
        $buyer_pref_id = @$BuyerPref->id;
       
        $specification = @$all['fields'];
        $premium = @$all['ecs'];
        $collected_data = array();
		$sizes = @$all['size'];
		$colorful = @$all['colorful'];
		$sugar_content = @$all['sugar_content'];
		$purposetype = @$all['model-mp'];
        $purposetypeid = @$all['model-mp-id'];
		$pSpecialIds = ProductSpecification::where('product_id',$all['product_id'])->where('parent_id',null)->whereIn('type_name',['Size','Colorful','Sugar Content','Purpose','MarketProcessing', 'Soil'])->pluck('id','type_name')->toArray();
       // echo $pSpecialIds['Soil'];
          
        if(isset($pSpecialIds['Soil']))
        {
            $Soil_spec_id = $pSpecialIds['Soil']; 
            if(!empty($all['model-mp-child']))
            {
               $specification[$Soil_spec_id] = $all['model-mp-child'];
            }
        }
        // echo "<pre/>"; print_r($specification);   die;  
            if(isset($pSpecialIds['MarketProcessing']))
            {
                $MarketProcessing_spec_id = $pSpecialIds['MarketProcessing'];
                if(!empty($purposetypeid))
                {
                    $collected_data[] = [
                                'buyer_pref_id'=>$buyer_pref_id,
                                'key' => $MarketProcessing_spec_id,
                                'value' => @$purposetypeid,
                                'premium' => NULL,
                                'created_at' => date('Y-m-d H:i:s')
							];  
                   
                }
            }
          if($purposetype == 'Market')
            {
                
                $purposes = @$all['purposemarketing'];
                if(isset($pSpecialIds['Purpose']))
                { 
                   
                    $product_spec_id = @$pSpecialIds['Purpose']; 
                    if(is_array($purposes) && !empty($purposes))
                    {
                            $collected_data[] = [
                                'buyer_pref_id'=>$buyer_pref_id,
                                'key' => $product_spec_id,
                                'value' => @$purposes,
                                'premium' => NULL,
                                'created_at' => date('Y-m-d H:i:s')
							];  
                        
                    }
                }
            }
            else if($purposetype == 'Processing'){
                $purposes = @$all['purposeprocessing']; 
                if(isset($pSpecialIds['Purpose']))
                { 
                    $product_spec_id = @$pSpecialIds['Purpose'];
                    if(is_array($purposes) && !empty($purposes))
                    {
                        foreach(@$purposes as $purposes_id=>$purposesprocessing)
                        {
                            
                            $collected_data[] = [
                                'buyer_pref_id'=>$buyer_pref_id,
                                'key' => $product_spec_id,
                                'value' => @$purposesprocessing,
                                'premium' => NULL,
                                'created_at' => date('Y-m-d H:i:s')
							];  
                        }
                    }
                }
            }
        
            if(isset($pSpecialIds['Size'])){ 
                
                $product_spec_id = @$pSpecialIds['Size']; 
                if(is_array($sizes) && !empty($sizes)){
                    foreach(@$sizes as $size_id=>$specValue3)
                    {
						$collected_data[] = [
							'buyer_pref_id'=>$buyer_pref_id,
							'key' => $product_spec_id,
							'value' => @$specValue3['from'].'-'.@$specValue3['to'],
							'premium' => NULL,
							'created_at' => date('Y-m-d H:i:s')
							];    
					}
                }
            }
             //echo "<pre/>"; print_r($collected_data); die;
            if(isset($pSpecialIds['Colorful'])){
                $Colorful_spec_id = $pSpecialIds['Colorful']; 
                if(is_array($colorful) && !empty($colorful)){
                    $collected_data[] = [
							'buyer_pref_id'=>$buyer_pref_id,
							'key' => $Colorful_spec_id,
							'value' => @$colorful['from'].'-'.@$colorful['to'],
							'premium' => NULL,
							'created_at' => date('Y-m-d H:i:s')
							];  
                   
                }
            }
            if(isset($pSpecialIds['Sugar Content'])){
                $sugar_content_spec_id = $pSpecialIds['Sugar Content']; 
                if(is_array($sugar_content) && !empty($sugar_content)){
                    $collected_data[] = [
							'buyer_pref_id'=>$buyer_pref_id,
							'key' => $sugar_content_spec_id,
							'value' => @$sugar_content['from'].'-'.@$sugar_content['to'],
							'premium' => NULL,
							'created_at' => date('Y-m-d H:i:s')
							];  
                }
            }
			
		if(is_array($specification) && count($specification) > 0) {	
			foreach($specification as $specKey=>$specValue)
			{
				if(is_array($specValue))
				{
					foreach($specValue as $specValueKey=>$specValueValue){
						$premiumValue = @$premium[$specValueValue];
						if($specValueValue != ''){
							$collected_data[] = [
								'buyer_pref_id'=>$buyer_pref_id,
								'key' => $specKey,
								'value' => $specValueValue,
								'premium' => $premiumValue,
								'created_at' => date('Y-m-d H:i:s')
								];
						}
					}   
				}  else {
					if($specValue != ''){
						$collected_data[] = [
							'buyer_pref_id'=>$buyer_pref_id,
							'key' => $specKey,
							'value' => $specValue,
							'premium' => NULL,
							'created_at' => date('Y-m-d H:i:s')
							];
					}					
				}                
			}
        }
       
        
        $buyerPref = DB::table('buyer_product_prefs')->insert($collected_data);
        $message="Hi,\n You have successfully added your preference product!";
        event(new Pushnotification($message,auth()->user()->id,$url='',$sound=2));
        \App\Jobs\BuyerPrefUpdated::dispatch($BuyerPref->id);
        \Log::info('after BuyerPrefUpdated dispatch');
        // $buyerPref = BuyerPref::with(['buyer','productPrefs.productSpecValue'])->where('id',$BuyerPref->id)->first();
        // event(new BuyerPrefCreated($buyerPref));

        return response()->json(['status' => 'success', 'message' => 'Buyer pref created successfully.']);	
	}
	
    public function updateAjax(Request $request)
    {
        $request->validate([
          'product_id' => 'required',
        ]);
        $all = $request->all();
        
        $buyer = Buyer::select('id')->where('user_id',auth()->user()->id)->first();
		$buyer_id = @$buyer->id;
        $buyerpref = BuyerPref::select('id')->where('id',$all['pref_id'])->first();
        $buyerpref->buyer_id    = $buyer_id;
        $buyerpref->product_id  = $all['product_id'];
        $buyerpref->save();
           
        $buyer_pref_id = $buyerpref->id;
        $specification = @$all['fields'];
        $premium = @$all['premium'];
        
        $buyerExistPrefs = $buyerpref->productPrefs()->pluck('id','id')->toArray();
       
        $pSpecialIds = ProductSpecification::where('product_id',$all['product_id'])->where('parent_id',null)->whereIn('type_name',['Size','Colorful','Sugar Content','Purpose','MarketProcessing', 'Soil'])->pluck('id','type_name')->toArray();
        
        if(isset($pSpecialIds['Soil']) && isset($all['model-mp-child']))
        {
            $specification[$pSpecialIds['Soil']] = $all['model-mp-child'];
        }
        if(isset($pSpecialIds['MarketProcessing']) && isset($all['model-mp-id']))
        {
           $specification[$pSpecialIds['MarketProcessing']] = $all['model-mp-id'];
        }
        $sizes = @$all['size'];
        if(isset($pSpecialIds['Size']))
        {
            $product_spec_id = @$pSpecialIds['Size']; 
            if(is_array($sizes) && !empty($sizes))
            {
                foreach(@$sizes as $size_id=>$specValue3)
                {
                    $specification[$product_spec_id] = @$specValue3['from'].'-'.@$specValue3['to'];
                }
            }
        }
            
        if(isset($specification) && !empty($specification))
        {
            foreach($specification as $specKey=>$specValue)
            {
                if(is_array($specValue))
                {
                    foreach($specValue as $specValueKey=>$specValueValue)
                    {
                        $premiumValue = @$premium[$specValueValue];
                        
                        $buyerPP = BuyerProductPref::updateOrCreate(
                            ['buyer_pref_id' => $buyer_pref_id,'key' => $specKey,'value' => $specValueValue],
                            ['premium' => $premiumValue]
                        );
                        unset($buyerExistPrefs[$buyerPP->id]);   
                    }   
                }
                else
                {
                    $premiumValue = @$premium[$specValueValue];
                    $buyerPP = BuyerProductPref::updateOrCreate(
                        ['buyer_pref_id' => $buyer_pref_id,'key' => $specKey,'value' => $specValue],
                        ['premium' => $premiumValue]
                    );
                    unset($buyerExistPrefs[$buyerPP->id]);       
                }
            }
            $buyerPref = BuyerPref::find($request->pref_id);
            $buyerPref->buyer_id = auth()->user()->id;
            $buyerPref->save();
        }
        
        if(isset($buyerExistPrefs) && !empty($buyerExistPrefs))
        {
            foreach($buyerExistPrefs as $pref)
            {
                BuyerProductPref::destroy($pref);
            }
        }
        \App\Jobs\BuyerPrefUpdated::dispatch($buyer_pref_id);
        return response()->json(['status' => 'success', 'message' => 'Buyerpref updated successfully.']);
    }
    
    public function store(Request $request)
    {
        $validate_array = ['product_id' => 'required|not_in:0',
        'country' => 'required',
        'postalcode' => 'required',
        'buyer_id' => 'required|not_in:0'];
        
        $all = $request->all();
        //echo"<pre>";print_r($all); die;
        $productspecs = ProductSpecification::where('product_id', $all['product_id'])->with('options')->get();
        // $productspecification_list = ProductSpecification::with('options')->where('parent_id',null)->orderBy('order')->get();
        if(isset($productspecs) && !empty($productspecs))
        {
            $validationsname = '';
            foreach($productspecs as $required)
            {
                if($required['required'] == 'Yes')
                {
                    if (count($required->options))
                    {
                        $validate_array['specification'][$required->options[0]->product_specification_id][0] = 'required';
                    }
                }
            }
        }
    
        $this->validate($request, $validate_array );
        
        $tableArray = array();

        if(empty($request->buyer_id))
        {
            if(!empty(get_buyers_by_user_id()))
            {
                $tableArray['buyer_id']= get_buyers_by_user_id()->id;
            } 
            else 
            {
                $tableArray['buyer_id']=  auth()->user()->id;
            }
        }
        else 
        {
            $tableArray['buyer_id']=$request->buyer_id;
        }

        $tableArray['product_id']  = $all['product_id'];
        $BuyerPref = BuyerPref::create($tableArray);
        
        $buyer_pref_id = $BuyerPref->id;
       
        $specification = @$all['specification'];
        $premium = @$all['premium'];
        $collected_data = array();
        if(isset($specification))
        {
            foreach($specification as $specKey=>$specValue)
            {
                if(is_array($specValue))
                {
                    foreach($specValue as $specValueKey=>$specValueValue)
                    {
                        $premiumValue = @$premium[$specValueValue];
                        $collected_data[] = [
                            'buyer_pref_id'=>$buyer_pref_id,
                            'key' => $specKey,
                            'value' => $specValueValue,
                            'premium' => $premiumValue,
                            'created_at' => date('Y-m-d H:i:s')
                        ]; 
                    }   
                }  
                else 
                {
                    $collected_data[] = [
                        'buyer_pref_id'=>$buyer_pref_id,
                        'key' => $specKey,
                        'value' => $specValue,
                        'premium' => NULL,
                        'created_at' => date('Y-m-d H:i:s')
                    ];    
                }                
            }
        }
       
        $buyerPref = DB::table('buyer_product_prefs')->insert($collected_data);

        //variety-soil-flesh_color-packaging-purposes-defects
        /*
        $json_fields = array('size_range','location_range','price_range');
        $collected_data = array();
        foreach($request->all() as $key=>$values){
            if (in_array($key, $json_fields)) {
                foreach($values as $value){
                    if(!empty($value['from']) && !empty($value['to'])){
                        $collected_data[] = [
                            'type'=>$key,
                            'buyer_id'=>$all['buyer_id'],
                            'buyer_product_pref_id'=>$buyer_product_pref_id,
                            'key' => $key,
                            'val' => (!empty( $value ) ? json_encode( $value ) : NULL)
                        ];
                    }
                }
            }
        }
        
        */
        \App\Jobs\BuyerPrefUpdated::dispatch($BuyerPref->id);
        return response()->json(['status' => 'success', 'message' => 'Buyer pref created successfully.']);
    }

    public function show($id){
        $buyerpref = BuyerPref::where(['id' => $id])->first();
        if($buyerpref){
            $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyer', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->where('id',$buyerpref->id)->first();
            //echo "<pre/>";print_r($buyerprefWithproductPrefs->toArray());die;
            $nets = array();
            foreach($buyerprefWithproductPrefs->productPrefs as $pref){
               if($pref->productSpec->display_name  == 'Size')
               {
                    $nets[@$pref->productSpec->display_name][] = @$pref->value;
               } else {
                    $nets[@$pref->productSpec->display_name][] = @$pref->productSpecValue->value;
               }               
            }
            return view('backend.buyerpref.show',compact('buyerprefWithproductPrefs','nets'));
        }else{
           $msg="Unfortunately this BuyerPref is not exist!";
          return view('backend.buyerpref.index', compact('msg'));
        } 
    }

    public function showAjax(Request $request)
    {
        $id = $request->prefsId;
        $buyerpref = BuyerPref::where(['id' => $id])->first();
        if($buyerpref)
        {
            $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyer', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->where('id',$buyerpref->id)->first();
            $nets = array();
            foreach($buyerprefWithproductPrefs->productPrefs as $pref){
                if($pref->productSpec->display_name  == 'Size')
                {
                     $nets[@$pref->productSpec->display_name][] = @$pref->value;
                } else {
                     $nets[@$pref->productSpec->display_name][] = @$pref->productSpecValue->value;
                }               
            }

            $html = '<div class="form-group"><strong>Buyer: </strong>'. @$buyerprefWithproductPrefs->buyer->username ?? 'N/A'. '</div>'.
            '<div class="form-group"><strong>Product: </strong>'. $buyerprefWithproductPrefs->product->name .'</div>';
            foreach($nets as $display_name=>$net)
            {
                $html .= '<div class="form-group"><strong>'. @$display_name .':</strong> '. implode(', ',$net) .'</div>';
            }
            return response()->json(['status' => 'success', 'prefs' => $html]);
        }
        else
        {
           $msg="Unfortunately this BuyerPref is not exist!";
          return view('backend.buyerpref.index', compact('msg'));
        } 
    }
  
      public function edit($id){
        $buyerpref = BuyerPref::where(['id' => $id])->first();
        if($buyerpref){
            $productPrefs = $buyerpref->productPrefs()->select('key','value','premium')->get()->toArray();
            $productPrefsMapping = array();
            $productPrefsMappingPremiums = array();
            foreach($productPrefs as $productPref){
                $productPrefsMapping[$productPref['key']][] = $productPref['value'];
                $productPrefsMappingPremiums[$productPref['key']][$productPref['value']] = $productPref['premium'];
            }
            $product_list = Product::all()->where('status',1)->pluck('name','id');
            $productspecification_list = ProductSpecification::with('options')->where('parent_id',null)->get();
            $productSpecRel = array();
            foreach($productspecification_list as $spec){
                $productSpecRel[$spec->product_id][$spec->id]['name'] = $spec->display_name;
                $productSpecRel[$spec->product_id][$spec->id]['hasmany'] = $spec->buyer_hasmany;
                if($spec->buyer_hasmany == 'Yes'){
                    $productSpecRel[$spec->product_id][$spec->id]['default'] = @$productPrefsMapping[$spec->id];
                } else {
                    $productSpecRel[$spec->product_id][$spec->id]['default'] = current($productPrefsMapping[$spec->id]??array());
                }
                $productSpecRel[$spec->product_id][$spec->id]['options'] = array();
                foreach($spec->options as $option){
                   if($spec->buyer_hasmany == 'Yes'){
                        $productSpecRel[$spec->product_id][$spec->id]['options'][$option->id]['name'] = $option->value;
                        $productSpecRel[$spec->product_id][$spec->id]['options'][$option->id]['premium'] = @$productPrefsMappingPremiums[$spec->id][$option->id];
                        $productSpecRel[$spec->product_id][$spec->id]['options'][$option->id]['id'] = $spec->id;
                    } else {
                        $productSpecRel[$spec->product_id][$spec->id]['options'][$option->id] = $option->value;
    
                    }
                }
            }
            //echo "<pre/>"; print_r($productSpecRel); die;
            $first_product = $buyerpref->product_id;
            $buyer_id = auth()->user()->id;
            $buyer = Buyer::select('id')->where('user_id',$buyer_id)->first();
            if(!empty($buyer)){
                $buyer_id = $buyer->id;
            }
            return view('backend.buyerpref.add-edit',compact('product_list','productSpecRel','first_product','buyerpref', 'buyer_id'));
           
         }else{
          $msg="Unfortunately this BuyerPref is not exist!";
          return view('backend.buyerpref.index',compact('msg'));
         } 
         
      }
  
    public function update(Request $request, BuyerPref $buyerpref){
        $request->validate([
          'buyer_id' => 'required',
          'product_id' => 'required',
        ]);
        
        $all = $request->all();
        $buyerpref->buyer_id  = $all['buyer_id'];
        $buyerpref->product_id  = $all['product_id'];
        $buyerpref->save();
        
        $buyer_pref_id = $buyerpref->id;
        $specification = @$all['specification'];
        $premium = @$all['premium'];
        $collected_data = array();
        
        $buyerExistPrefs = $buyerpref->productPrefs()->pluck('id','id')->toArray();
        
        if(isset($specification) && !empty($specification)){
        foreach($specification as $specKey=>$specValue)
        {
            if(is_array($specValue))
            {
                foreach($specValue as $specValueKey=>$specValueValue){
                    $premiumValue = @$premium[$specValueValue];
                    
                    $buyerPP = BuyerProductPref::updateOrCreate(
                        ['buyer_pref_id' => $buyer_pref_id,'key' => $specKey,'value' => $specValueValue],
                        ['premium' => $premiumValue]
                    );
                    unset($buyerExistPrefs[$buyerPP->id]);   
                }   
            }  else {
                $premiumValue = @$premium[$specValueValue];
                $buyerPP = BuyerProductPref::updateOrCreate(
                        ['buyer_pref_id' => $buyer_pref_id,'key' => $specKey,'value' => $specValue],
                        ['premium' => $premiumValue]
                    );
                unset($buyerExistPrefs[$buyerPP->id]);       
            }
        }
        }
        if(isset($buyerExistPrefs) && !empty($buyerExistPrefs)){
            foreach($buyerExistPrefs as $pref){
                BuyerProductPref::destroy($pref);
            }
        }
        
        $message="Hi,\n You have successfully updated your preference product!";
        event(new Pushnotification($message,auth()->user()->id,$url='',$sound=2));
        \App\Jobs\BuyerPrefUpdated::dispatch($buyerpref->id);

        return response()->json(['status' => 'success', 'message' => 'Buyerpref updated successfully.']);

    }


    public function prefcardview(Request $request) 
    {
        $productsimage = Product::select('image','id','type','name')->where('status', '1')->get();
        $productByName = Product::all()->where('status', '1')->pluck('id', 'name');
        $buyers = Buyer::where('status', '1')->pluck('username','id');

        $productspecification_list = ProductSpecification::with('options')
        ->where('parent_id',null)->whereIn('type_name',['Quality'])->get();
        $qualityGlobalArray = [];
        foreach($productspecification_list as $productspec){
           
            foreach($productspec->options as $productspecval){
                if($productspecval->parent_id == NULL){
                    if($productspec->tags == 'Conditional'){
                        $qualityGlobalArray[$productspec->product_id][$productspecval->related_spec_val_id][$productspecval->id]['title'] =  $productspecval->value;
                        $qualityGlobalArray[$productspec->product_id][$productspecval->related_spec_val_id][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
                    } else {
                        $qualityGlobalArray[$productspec->product_id][$productspecval->id]['title'] =  $productspecval->value;
                        $qualityGlobalArray[$productspec->product_id][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
                    }
                }
            }
        }

        $productBasicDetail  = get_buyer_popup_product_types();
        $productBasicDetail  = $productBasicDetail['en'];
        
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


        $products1 = \App\Product::select('id', 'name')->get();
        $products = array();
        foreach ($products1 as $key => $value) {
            $products[$value->id] = $value->name;
        }
        if(auth()->user()->hasRole('buyer') && request()->segment(1) == 'buyer'){
            if(!empty(get_buyers_by_user_id(auth()->user()->id)))
            {
                $buyer_id = get_buyers_by_user_id()->id;
            } else {
                $buyer_id =  auth()->user()->id;
            }
            $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyername', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->select('id','product_id','buyer_id')->where('buyer_id', $buyer_id);

            if(isset($request->product_id) && !empty($request->product_id)){
                $buyerprefWithproductPrefs->where('product_id', $request->product_id);
            }
            $buyerprefWithproductPrefs = $buyerprefWithproductPrefs->limit(12)->get();
            
            return view('backend.buyerpref.cardview',compact('buyerprefWithproductPrefs','products','productsimage','buyers','productConfiguration','productBasicDetail','qualityGlobalArray'));
        }
        else
        {
            $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyername', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->select('id','product_id', 'buyer_id');
            if(isset($request->product_id) && !empty($request->product_id)){
                $buyerprefWithproductPrefs->where('product_id', $request->product_id);
            }
            $buyerprefWithproductPrefs = $buyerprefWithproductPrefs->limit(12)->get();
            $all_buyers = Buyer::all();
            return view('backend.buyerpref.cardview',compact('buyerprefWithproductPrefs','products','productsimage','buyers','productConfiguration','productBasicDetail','qualityGlobalArray', 'all_buyers'));
        }
    }

    public function loadMorePrefCardView(Request $request) 
    {
        if(auth()->user()->hasRole('buyer') && request()->segment(1) == 'buyer'){
            @$res = $request->all('last_id');
            $last_id = $res['last_id'];
            $buyer_id = get_buyers_by_user_id(auth()->user()->id);
            
            if($request->all('product_id')['product_id'] !='' && $request->all('variety')['variety'] =='' && $request->all('quality')['quality'] ==''){

                $product_id = $request->all('product_id')['product_id'];
                    $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyername', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->select('id','product_id','buyer_id')->where('buyer_id', $buyer_id->id)->where('product_id', $product_id)->where('id','>', @$last_id)->limit(12)->get();
                }
                elseif($request->all('product_id')['product_id'] !='' && $request->all('variety')['variety'] !='' && $request->all('quality')['quality'] ==''){
                    $product_id = $request->all('product_id')['product_id'];
                    $variety = $request->all('variety')['variety'];
                    $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyername', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->select('id','product_id','buyer_id')->where('buyer_id', $buyer_id->id)->where('id','>', @$last_id)->where('product_id', $product_id)->whereHas('productPrefs.productSpecValue', function($q) use ($variety) {  $q->where('id', $variety ); })->limit(12)->get();
                
                }
                elseif($request->all('product_id')['product_id'] !='' && $request->all('variety')['variety'] !='' && $request->all('quality')['quality'] !=''){
                    $variety = $request->all('variety')['variety'];
                    $quality = $request->all('quality')['quality'] ;
                    $product_id = $request->all('product_id')['product_id']; 
                    $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyername', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->select('id','product_id','buyer_id')->where('product_id', $product_id)->where('buyer_id', $buyer_id->id)->where('id','>', @$last_id)->whereHas('productPrefs.productSpecValue', function($q) use ($variety) {  $q->where('id', $variety ); })->whereHas('productPrefs.productSpecValue', function($q) use ($quality) {  $q->where('value', $quality ); })->limit(12)->get();
                }
                elseif($request->all('product_id')['product_id'] =='' && $request->all('variety')['variety'] =='' && $request->all('quality')['quality'] !=''){
                    $quality = $request->all('quality')['quality'] ; 
                    $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyername', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->select('id','product_id','buyer_id')->where('buyer_id', $buyer_id->id)->where('id','>', @$last_id)->whereHas('productPrefs.productSpecValue', function($q) use ($quality) {  $q->where('value', $quality ); })->limit(12)->get();
                }
                else{
                    $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyername', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->select('id','product_id','buyer_id')->where('buyer_id', $buyer_id->id)->where('id','>', @$last_id)->limit(12)->get();
                }    


            if(empty($buyerprefWithproductPrefs->first() )){
                $result = array(
                    'status' => 'false',
                    'msg' => "No more records found" 
                );
            }
            else{
                
                $res = $this->cardviewhtml($buyerprefWithproductPrefs);
                $result = array(
                    'status' => 'success',
                    'data' => $res['cards'],
                    'id' => $res['last_id']
                );
            }
            echo json_encode($result);
            die;
        }
        else{
            $res = $request->all('last_id');
            $last_id = $res['last_id'];
            
                if($request->all('productid')['productid'] !='' && $request->all('variety')['variety'] =='' && $request->all('quality')['quality'] ==''){
                    $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyername', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->select('id','product_id','buyer_id')->where('id', '>', $last_id)->where('product_id', $request->all('productid'))->limit(12)->get();
                }
                elseif($request->all('productid')['productid'] !='' && $request->all('variety')['variety'] !='' && $request->all('quality')['quality'] ==''){
                    $variety = $request->all('variety')['variety'];
                    $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyername', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->select('id','product_id','buyer_id')->where('id', '>', $last_id)->where('product_id', $request->all('productid'))->whereHas('productPrefs.productSpecValue', function($q) use ($variety) {  $q->where('id', $variety ); })->limit(12)->get();
                }
                elseif($request->all('productid')['productid'] !='' && $request->all('variety')['variety'] !='' && $request->all('quality')['quality'] !=''){
                    $variety = $request->all('variety')['variety'];
                    $quality = $request->all('quality')['quality'] ; 
                    $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyername', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->select('id','product_id','buyer_id')->where('id', '>', $last_id)->where('product_id', $request->all('productid'))->whereHas('productPrefs.productSpecValue', function($q) use ($variety) {  $q->where('id', $variety ); })->whereHas('productPrefs.productSpecValue', function($q) use ($quality) {  $q->where('value', $quality ); })->limit(12)->get();
                }
                elseif($request->all('productid')['productid'] =='' && $request->all('variety')['variety'] =='' && $request->all('quality')['quality'] !=''){
                    $quality = $request->all('quality')['quality'] ; 
                    $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyername', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->select('id','product_id','buyer_id')->where('id', '>', $last_id)->whereHas('productPrefs.productSpecValue', function($q) use ($quality) {  $q->where('value', $quality ); })->limit(12)->get();
                }
                else{
                    $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyername', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->select('id','product_id','buyer_id')->where('id', '>', $last_id)->limit(12)->get();
                }   
            
            if(empty($buyerprefWithproductPrefs->first() )){

                $result = array(
                    'status' => 'false',
                    'msg' => "No more records found" 
                );
            }
            else{ 
                $res = $this->cardviewhtml($buyerprefWithproductPrefs);
                $result = array(
                    'status' => 'success',
                    'data' => $res['cards'],
                    'id' => $res['last_id']
                );
            }
            echo json_encode($result);
            die;
        }
       
    }

    public function cardviewhtml($buyerprefWithproductPrefs){
        $cards = array();
        foreach($buyerprefWithproductPrefs as $prefs){
        $html = '<div class="col-xs-12 col-sm-6 col-md-4 removeable">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="stock-gallery">         
                                    <!--Carousel Wrapper-->
                                    <div id="carousel-thumb-{{$prefs->id}}" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
                                        <!--Slides-->
                                        <div class="carousel-inner" role="listbox">
                                            <div class="carousel-item active">
                                                <img class="d-block w-100 no_img" onerror=this.src="'.asset("images/products/no_img.png").'" src="'.asset("images/products/".@$prefs->product->homepage_image).'">
                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block w-100 no_img" onerror=this.src="'.asset("images/products/no_img.png").'" src="'.asset("images/products/".@$prefs->product->image) .'">
                                            </div>';
                                            if(isset($prefs->image) != null)
                                                foreach(json_decode(@$prefs->image, true) as $stock_img){
                                                $html .='<div class="carousel-item">
                                                    <img class="d-block w-100" src="'.asset("images/stock/".@$stock_img).'">
                                                </div>';
                                            }
                                        $html .='</div>
                                        <!--/.Slides-->
                                        <!--Controls-->
                                        <a class="carousel-control-prev" href="#carousel-thumb-'.@$prefs->id.'" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carousel-thumb-'.@$prefs->id.'" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                        <!--/.Controls-->
                                        <ol class="carousel-indicators">
                                            <li data-target="#carousel-thumb-'.@$prefs->id.'" data-slide-to="0" class="active"> <img class="d-block w-100 " onerror=this.src="'.asset("images/products/no_img.png").'" src="'.asset("images/products/".@$prefs->product->homepage_image).'" class="img-fluid"></li>
                                            <li data-target="#carousel-thumb-'.@$prefs->id.'" data-slide-to="1"><img class="d-block w-100 " onerror=this.src="'.asset("images/products/no_img.png").'" src="'.asset("images/products/".@$prefs->product->image).'" class="img-fluid"></li>';
                                            $i=2; 
                                            if(isset($prefs->image) != null){
                                                foreach(json_decode(@$prefs->image, true) as $stock_img){
                                                $html .= '<li data-target="#carousel-thumb-{{$prefs->id}}" data-slide-to="'.$i.'"><img class="d-block w-100" src="'.asset("images/stock/".@$stock_img).'" class="img-fluid"></li>';
                                                    $i++;
                                                }
                                            }
                                        $html .='</ol>
                                    </div>
                                    <!--/.Carousel Wrapper-->        
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <ul class="stock-card-list">
                                    <li><strong>ID: </strong>';
                                        if(auth()->user()->hasRole('administrator')){
                                            $html .='<a href="'.@$prefs->id.'">'.@$prefs->id.'</a>';
                                        }else{
                                            $html .=@$prefs->id;
                                        }
                                        $html .='</li>';
                                    if(auth()->user()->hasRole('administrator')){
                                        $html .='<li><strong>Buyer: </strong><a href="'.url('admin/auth/user').'/'.@$prefs->buyername->user_id.'">'.@$prefs->buyername->username.'</a></li>';
                                    }
                                    $html .='<li><strong>Product: </strong> '.@$prefs->product->name .' </li>';
                                        if(@$prefs->productPrefs){
                                            $nets = array();
                                            foreach(@$prefs->productPrefs as $pref){
                                                if($pref->productSpec->display_name  == 'Size'){
                                                    $nets[@$pref->productSpec->display_name][] = @$pref->value;
                                                }else{
                                                    @$nets[@$pref->productSpec->display_name][] = @$pref->productSpecValue['value'];
                                                }
                                                //$nets[@$pref->productSpec->display_name][] = @$pref->productSpecValue['value']; 
                                            }  
                                            foreach(@$nets as $display_name => $net){
                                            $html .= '<li><strong>'.@$display_name.': </strong>  '.implode(', ',$net) .' </li>';
                                            }
                                        }
                                    $html .='</ul>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">';
                    if(in_array('buyer', auth_roles())){
                        $route_pre = 'buyer';
                    }else{
                        $route_pre = 'admin';
                    }
                    $html .='<button type="button" class="btn btn-edit editItem" data-id="'.$prefs->id.'" data-url="'.route($route_pre.'.buyerpref.edit',$prefs->id).'"><i class="fas fa-edit"></i></button>
                    <button data-toggle="tooltip" data-id="'.$prefs->id.'" data-original-title="Delete" type="button" class="pull-right btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
            </div>';
            array_push($cards, $html);
            $last_id = $prefs->id;
        }
        $data['cards']= $cards;
        $data['last_id']= $last_id;
        return $data;
    }

       public function byyerprefcardviewbyAjax(Request $request) 
        {
            if($request->sortby == 2){
                $sortby = 'buyer_id'; 
                $asc = 'ASC';  }
            elseif($request->sortby == 3){
                $sortby = 'id';   
                $asc = 'DESC';  }
            else{
                $sortby = 'id';
                $asc = 'ASC';  }

            if(auth()->user()->hasRole('buyer') && request()->segment(1) == 'buyer')
            {
                $buyer_id = get_buyers_by_user_id(auth()->user()->id);
                
                if($request->all('productid')['productid'] !='' && $request->all('variety')['variety'] =='' && $request->all('quality')['quality'] ==''){
                    $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyername', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->select('id','product_id','buyer_id')->where('buyer_id', $buyer_id->id)->where('product_id', $request->all('productid'))->orderBy($sortby , $asc)->limit(12)->get();
                }
                elseif($request->all('productid')['productid'] !='' && $request->all('variety')['variety'] !='' && $request->all('quality')['quality'] ==''){
                    $variety = $request->all('variety')['variety'];
                    $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyername', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->select('id','product_id','buyer_id')->where('buyer_id', $buyer_id->id)->where('product_id', $request->all('productid'))->whereHas('productPrefs.productSpecValue', function($q) use ($variety) {  $q->where('id', $variety ); })->orderBy($sortby , $asc)->limit(12)->get();
                    
                    
                }
                elseif($request->all('productid')['productid'] !='' && $request->all('variety')['variety'] !='' && $request->all('quality')['quality'] !=''){
                    $variety = $request->all('variety')['variety'];
                    $quality = $request->all('quality')['quality'] ; 
                    $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyername', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->select('id','product_id','buyer_id')->where('product_id', $request->all('productid'))->where('buyer_id', $buyer_id->id)->whereHas('productPrefs.productSpecValue', function($q) use ($variety) {  $q->where('id', $variety ); })->whereHas('productPrefs.productSpecValue', function($q) use ($quality) {  $q->where('value', $quality ); })->orderBy($sortby , $asc)->limit(12)->get();
                }
                elseif($request->all('productid')['productid'] =='' && $request->all('variety')['variety'] =='' && $request->all('quality')['quality'] !=''){
                    $quality = $request->all('quality')['quality'] ; 
                    $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyername', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->select('id','product_id','buyer_id')->where('buyer_id', $buyer_id->id)->whereHas('productPrefs.productSpecValue', function($q) use ($quality) {  $q->where('value', $quality ); })->orderBy($sortby , $asc)->limit(12)->get();
                }
                else{
                    $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyername', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->select('id','product_id','buyer_id')->where('buyer_id', $buyer_id->id)->orderBy($sortby , $asc)->limit(12)->get();
                }    
            }
            else
            { 
                
                if($request->all('productid')['productid'] !='' && $request->all('variety')['variety'] =='' && $request->all('quality')['quality'] ==''){
                    $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyername', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->select('id','product_id','buyer_id')->where('product_id', $request->all('productid'))->orderBy($sortby , $asc)->limit(12)->get();
                }
                
                elseif($request->all('productid')['productid'] !='' && $request->all('variety')['variety'] !='' && $request->all('quality')['quality'] ==''){
                    $variety = $request->all('variety')['variety'];
                    $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyername', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->select('id','product_id','buyer_id')->where('product_id', $request->all('productid'))->whereHas('productPrefs.productSpecValue', function($q) use ($variety) {  $q->where('id', $variety ); })->orderBy($sortby , $asc)->limit(12)->get();
                    
                    
                }
                elseif($request->all('productid')['productid'] !='' && $request->all('variety')['variety'] !='' && $request->all('quality')['quality'] !=''){
                    $variety = $request->all('variety')['variety'];
                    $quality = $request->all('quality')['quality'] ; 
                    $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyername', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->select('id','product_id','buyer_id')->where('product_id', $request->all('productid'))->whereHas('productPrefs.productSpecValue', function($q) use ($variety) {  $q->where('id', $variety ); })->whereHas('productPrefs.productSpecValue', function($q) use ($quality) {  $q->where('value', $quality ); })->orderBy($sortby , $asc)->limit(12)->get();
                }
                elseif($request->all('productid')['productid'] =='' && $request->all('variety')['variety'] =='' && $request->all('quality')['quality'] !=''){
                    $quality = $request->all('quality')['quality'] ; 
                    $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyername', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->select('id','product_id','buyer_id')->whereHas('productPrefs.productSpecValue', function($q) use ($quality) {  $q->where('value', $quality ); })->orderBy($sortby , $asc)->limit(12)->get();
                }
                else{
                    $buyerprefWithproductPrefs = BuyerPref::with('product', 'buyername', 'productPrefs', 'productPrefs.productSpec', 'productPrefs.productSpecValue')->select('id','product_id','buyer_id')->orderBy($sortby , $asc)->limit(12)->get();
                }    
            }
            if(empty($buyerprefWithproductPrefs->first() )){
                $result = array(
                    'status' => 'false',
                    'msg' => "No more records found" 
                );
            }
            else{
                $res = $this->cardviewhtml($buyerprefWithproductPrefs );
                $result = array(
                    'status' => 'success',
                    'data' => $res['cards'],
                    'id' => $res['last_id']
                );
            }
            echo json_encode($result);
            die;


    }


    public function destroy(BuyerPref $buyerpref){
        $buyerpref->delete();
        return response()->json(['success'=>'Buyerpref deleted successfully.']);
    }

    public function buyerprefexports() 
    {
        return Excel::download(new BuyerPrefExport, 'buyerpref.xlsx');
    }
    public function getPref(Request $request)
    {
        $id = $request->get('buyerPrefId');
        $output = [];
        $buyerpref = BuyerPref::with('productPrefs','productPrefs.productSpec')->where(['id' =>$id])->first();
        //echo "<pre/>"; print_r(); die;
          if($buyerpref){
            $productPrefs = $buyerpref->productPrefs->toArray();
            $productPrefsMapping = array();
            $productPrefsMappingPremiums = array();
            foreach($productPrefs as $productPref){
                
                if(in_array($productPref['product_spec']['type_name'], array('Size', 'Purpose', 'Variety', 'Soil', 'Quality', 'MarketProcessing'))){
                    $productPrefsMapping[$productPref['product_spec']['type_name']] = $productPref['value'];
                } else {
                     $productPrefsMapping[$productPref['product_spec']['type_name']][] = $productPref['value'];
                }
            }
            $output['productPrefsMapping'] = $productPrefsMapping;
            $output['buyerpref'] = $buyerpref;             
            return  response()->json($output);
         }
    }
}
