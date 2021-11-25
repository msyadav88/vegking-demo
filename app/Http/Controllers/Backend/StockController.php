<?php
    namespace App\Http\Controllers\Backend;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Stock;
    use App\StockProperty;
    use App\Product;
    use App\Seller;
    use App\ProductSpecification;
    use App\ProductSpecificationValue;
    use App\Models\Auth\User;
    use DataTables;
    use App\Events\Backend\StockUpdated;
    use App\Exports\StocksExport;
    use App\Imports\SellerImport;
    use Auth;
    use Maatwebsite\Excel\Facades\Excel;
    use DB;
    use App\Events\Pushnotification;
    class StockController extends Controller{
        protected $roles;

        function __construct()
        {
            $this->middleware('permission:view stock', ['only' => ['index']]);
            $this->middleware('permission:add stock', ['only' => ['create','store']]);
            $this->middleware('permission:edit stock', ['only' => ['edit','update']]);
            $this->middleware('permission:delete stock', ['only' => ['destroy']]);
            $this->middleware('permission:view stock detail', ['only' => ['show']]);
            $this->middleware('permission:export stocks', ['only' => ['stocksexports']]);
        }

        public function index(Request $request){
/*
            $potatoId=1;
$potatoVarietyId=6;
$potatospecificationId=25;
$displayName = array('Flesh Color','Dry Matter','Tuber Shape','Depth of Eyes','Colour of Skin','Smoothness of Skin','Potato Variety');

    $productspec = ProductSpecification::whereIn('display_name', $displayName)->pluck('id','display_name')->toArray();
//echo"<pre>";print_r($productspec);
//flesh color
$fleshColorId = $productspec['Flesh Color']; 

//TuberShape

$TuberShapeId=$productspec['Tuber Shape'];

$DryMatter=$productspec['Dry Matter'];

$ColourOfSkin=$productspec['Colour of Skin']; 
//depth of eyes

$DepthOfEyes=$productspec['Depth of Eyes'];

$SmoothnessOfSkin=$productspec['Smoothness of Skin'];

  //potato_variety - 0
$PotatoVariety =  $productspec['Potato Variety'];
$ProductId=1;
        //Variety Flesh Color
        $CookingType = ProductSpecification::firstOrCreate(['product_id' => $ProductId,'display_name' => 'Cooking type','parent_id' => $PotatoVariety],[
                'product_id' => $ProductId,
                'display_name' => "Cooking type",
                'type_name' => "Potato Variety",
                'importance' => 1,
                'order' => 1,
                'buyer_hasmany' => 'Yes',
                'stock_hasmany' => 'No',
                'can_edit' => 'Yes',
                'required' => 'No',
               'parent_id' => $PotatoVariety,
            ]);
$CookingTypeId = $CookingType->id;
 $AfterCookingBlackening = ProductSpecification::firstOrCreate(['product_id' => $ProductId,'display_name' => 'After cooking blackening','parent_id' => $PotatoVariety],[
                'product_id' => $ProductId,
                'display_name' => "After cooking blackening",
                'type_name' => "Potato Variety",
                'importance' => 1,
                'order' => 1,
                'buyer_hasmany' => 'Yes',
                'stock_hasmany' => 'No',
                'can_edit' => 'Yes',
                'required' => 'No',
               'parent_id' => $PotatoVariety,
            ]);
$StarchContent = ProductSpecification::firstOrCreate(['product_id' => $ProductId,'display_name' => 'Starch content','parent_id' => $PotatoVariety],[
                'product_id' => $ProductId,
                'display_name' => "Starch content",
                'type_name' => "Potato Variety",
                'importance' => 1,
                'order' => 1,
                'buyer_hasmany' => 'Yes',
                'stock_hasmany' => 'No',
                'can_edit' => 'Yes',
                'required' => 'No',
               'parent_id' => $PotatoVariety,
            ]);
*/

            
            /***********final script end**************
            $getUniqueKey = [];
            for($i=161; $i<=170; $i++)
            {
                $doc = new \DOMDocument();
                $document = file_get_contents('https://www.europotato.org/varieties/index/page:'.$i);
                libxml_use_internal_errors(true);
                $doc->loadHTML($document);
                $tables = $doc->getElementsByTagName('table');
                foreach($tables as $table)
                {
                    $trs = $table->getElementsByTagName('tr');
                    foreach($trs as $tr)
                    {
                        $tds = $table->getElementsByTagName('td');
                        
                        foreach($tds as $td)
                        {
                           $hrefs = $table->getElementsByTagName('a');
                           foreach($hrefs as $href)
                            {
                                $doc = new \DOMDocument();
                                $variety = $href->textContent;
                             
                                if (preg_match('/[^A-Za-z\s]/',$variety)){
                                   continue;
                                }
                                //echo $variety."<br/>"; 
                                //continue;
                                
                                
                               
                                $href = $href->getAttribute('href');
                                
                                $varietyName  =  trim($href);
                                $document  =  file_get_contents('https://www.europotato.org'.$varietyName);
                                
                                //$document = file_get_contents('https://www.europotato.org/'.$href);
                                
                                libxml_use_internal_errors(true);

                                $doc->loadHTML($document);
                                
                                $tables = $doc->getElementsByTagName('table');
                                $childData = [];

                                foreach($tables as $table)
                                {
                                    $trs = $table->getElementsByTagName('tr'); 
                                    $lastFillableKey = '';
                                    foreach($trs as $tr)
                                    {
                                        $tds = $tr->getElementsByTagName('td'); 
                                        $key = '';
                                        $firstKey = '';
                                        $secondData = '';
                                        
                                        foreach($tds as $n=>$td)
                                        {
                                            if( $n == '0' )
                                            {
                                               $firstKey =  $td->textContent;
                                                if($td->textContent != ''){
                                                    $lastFillableKey = $td->textContent;
                                                }
                                            }
                                            else if( $n>0 )
                                            {
                                                $secondData = $td->textContent;
                                            }
                                        } 
                                        if($firstKey != ''){
                                            
                                            if(in_array($firstKey, array('Tuber skin colour', 'Primary tuber flesh colour', 'Tuber shape', 'Tuber eye depth', 'Tuber skin texture','Cooking type / 411 Cooked texture','After cooking blackening', 'Dry matter content', 'Starch content'))){
                                                $childData[$firstKey][] =  $secondData;
                                            }
                                           
                                        } else {
                                            if(in_array($lastFillableKey, array('Tuber skin colour', 'Primary tuber flesh colour', 'Tuber shape', 'Tuber eye depth', 'Tuber skin texture','Cooking type / 411 Cooked texture','After cooking blackening', 'Dry matter content', 'Starch content'))){
                                                $childData[$lastFillableKey][] =  $secondData;
                                            }
                                           
                                        }                
                                    }
                                } 
                                $getUniqueKey[$variety] =  $childData;

                                //echo"<pre>";print_r($getUniqueKey);
$potatoId=1;
$PotatoVarietyId=8;


$displayName = array('Flesh Color','Dry Matter','Tuber Shape','Depth of Eyes','Colour of Skin','Smoothness of Skin','Potato Variety','Cooking type','After cooking blackening','Starch content');

$productspec = ProductSpecification::whereIn('display_name', $displayName)->pluck('id','display_name')->toArray();
//echo "<pre>"; print_r($productspec);
$fleshColorId = $productspec['Flesh Color']; 
$TuberShapeId=$productspec['Tuber Shape'];
$DryMatterId=$productspec['Dry Matter'];
$ColourOfSkinId=$productspec['Colour of Skin']; 
$DepthOfEyesId=$productspec['Depth of Eyes'];
$SmoothnessOfSkinId=$productspec['Smoothness of Skin'];
$CookingTypeId=$productspec['Cooking type'];
$AfterCookingBlackeningId=$productspec['After cooking blackening'];
$StarchContentId=$productspec['Starch content'];
$PotatoVariety =  $productspec['Potato Variety'];
            ECHO "<br/>"; 
            echo '$PSVVar  = App\ProductSpecificationValue::firstOrCreate(["product_id" => $potatoId, "product_specification_id" => $PotatoVarietyId, "value" =>"'.$variety.'"], [ "product_id" => $potatoId, "product_specification_id" => $PotatoVarietyId, "parent_id" => NULL, "value" => "'.$variety.'", "premium" => NULL,"volume" => NULL, "default" => NULL, "status" => 1 ]);';
           
            foreach ($getUniqueKey[$variety] as $key => $data) {
                if($key == 'Tuber skin colour'){
                    $childId = '$ColourOfSkinId';
                }  else if($key == 'Primary tuber flesh colour'){
                    $childId = '$fleshColorId';
                } else if($key == 'Tuber shape'){
                    $childId = '$TuberShapeId';
                }  else if($key == 'Tuber eye depth'){
                    $childId = '$DepthOfEyesId';
                }  else if($key == 'Tuber skin texture'){
                    $childId = '$SmoothnessOfSkinId';
                }else if($key == 'Cooking type / 411 Cooked texture'){
                    $childId = '$CookingTypeId';
                }else if($key == 'After cooking blackening'){
                    $childId = '$AfterCookingBlackeningId';
                }else if($key == 'Dry matter content'){
                    $childId = '$DryMatterId';
                }else if($key == 'Starch content'){
                    $childId = '$StarchContentId';
                }

                ECHO "<br/>"; 
                
                $dataStr = implode(',', $data);
                echo '$SubValue = App\ProductSpecificationValue::firstOrCreate(["product_id" => $potatoId, "product_specification_id" => '.$childId.', "parent_id" => $PSVVar->id, "value" => "'.$dataStr.'"], [ "product_id" => $potatoId, "product_specification_id" => '.$childId.', "value" => "'.$dataStr.'", "status" => 1, "parent_id" => $PSVVar->id ]);';
             
            }
ECHO "<br/>";



        
                                /*                         
                                foreach( $childData as $key => $tuberValue )
                                {
                                    
                                    if($tuberValue['Tuber skin colour'])
                                    {
                                        $getUniqueKey['key']    =   $key;
                                        $getUniqueKey['value']  =   $tuberValue;
                                    }
                                    print_r($getUniqueKey);
                                }*/


                                  /*  $varietySpeckey = [];
                                    $varietySpecData = [];
                                    foreach( $childData as $key=>$data )
                                    {
                                        $varietySpeckey['key'] = $key;
                                        $implodeSpecData['data']   =  implode(';',$data);
                                        if(!empty($varietySpeckey['key']) || isset($varietySpeckey['key'])){
                                             $addVaritySpec = DB::table('variety_spec')->insertGetId(
                                                ['variety_id' => $addVarietyId, 'name' => $varietySpeckey['key'],'value' =>$implodeSpecData['data']]
                                             );
                                        }
                                       
                                    }
                                }
                           } 
                        }                        
                    }
                }
                //echo "<pre/>";print_r($getUniqueKey);
            } die;*/  
          
/***********final script end***************/    
        /*$getUniqueKey = [];
                $doc = new \DOMDocument();
                $document = file_get_contents('https://www.europotato.org/varieties/view/Accord-E');
                
                libxml_use_internal_errors(true);

                $doc->loadHTML($document);
                echo $doc->saveHTML();
                $tables = $doc->getElementsByTagName('table');
                $childData = [];
                foreach($tables as $table)
                {
                    $trs = $table->getElementsByTagName('tr'); 
                    $lastFillableKey = '';
                    foreach($trs as $tr)
                    {
                        $tds = $tr->getElementsByTagName('td'); 
                        $key = '';
                        $firstKey = '';
                        $secondData = '';
                        
                        foreach($tds as $n=>$td)
                        {
                            if( $n == '0' )
                            {
                               
                                $firstKey =  $td->textContent;
                                if($td->textContent != ''){
                                    
                                    $lastFillableKey = $td->textContent;
                                    
                                }
                            }
                            else if( $n>0 )
                            {
                                $secondData = $td->textContent;
                            }
                        } 
                        if($firstKey != ''){
                            $childData[$firstKey][] =  $secondData;
                        } else {
                            $childData[$lastFillableKey][] =  $secondData;
                        }                
                    }
                }
                echo "<pre/>";
                print_r($childData);*/
        
       
         //print_r(@$childData['Tuber shape']);
        // print_r(@$childData['Primary tuber flesh colour']);
        // print_r(@$childData['Tuber skin colour']);

        
        /*$varietySpeckey = [];
        $varietySpecData = [];
        foreach( $childData as $key=>$data )
        {
            echo "<pre/>";
           
            $varietySpeckey['key'] = $key;
            $implodeSpecData['data']   =  implode(';',$data);
            print_r($varietySpeckey['key']);
            print_r($implodeSpecData['data']);
            
        }*/
       
        //die;
        
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
                        if($productspec->tags == 'Conditional'){
                            $qualityGlobalArray[$productspec->product_id][$productspecval->related_spec_val_id][$productspecval->id]['title'] =  $productspecval->value;
                            $qualityGlobalArray[$productspec->product_id][$productspecval->related_spec_val_id][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
                            $qualityGlobalArray[$productspec->product_id][$productspecval->related_spec_val_id][$productspecval->id]['class'] =  ($productspecval->tags !='' && $productspecval->tags !=NULL ?$productspecval->tags:'Class1');
                        } else {
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
        
            if($request->has('variety') && !empty($request->variety))
            {
                $columns = $request->get('columns');
                $columns[3]['search']['value'] = $request->variety;
                $request->merge(['columns' => $columns]);
            }
            if($request->has('quality') && !empty($request->quality))
            {
                $columns = $request->get('columns');
                $columns[4]['search']['value'] = $request->quality;
                $request->merge(['columns' => $columns]);
            }
            if ($request['columns']) 
            {
                $search_value = array();
                foreach ($request['columns'] as $value_search) 
                {
                    if (!empty($value_search['search']['value'])) 
                    {
                        $search_value[$value_search['data']] = $value_search['search']['value'];
                    }
                }
                $dataObj = Stock::with('productname', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')
            ->select('id', 'seller_id', 'product_id', 'price', 'size_from', 'size_to', 'stock_status');
                $data = $dataObj->orderBy('id', 'desc');
            
              
            }
           
            if(isset($request->filter_product) && !empty($request->filter_product))
            {
                $product_id = $request->filter_product;
                $ProdSpecArr = ProductSpecification::where('product_id',$product_id)->where('parent_id',NULL)->whereIn('type_name',['Variety','Packing','Quality'])->select('display_name','id','product_id','type_name')->get()->toArray();
            } 
            else 
            {
                $product = Product::all()->where('status', '1')->first();
                $product_id = @$product->id;
                $ProdSpecArr = ProductSpecification::where('parent_id',NULL)->whereIn('type_name',['Variety','Packing','Quality'])->select('display_name','id','product_id','type_name')->get()->toArray();
            }
            
            $ProdSpecArrKeys = array();
            foreach($ProdSpecArr as $type_data)
            {
                $ProdSpecArrKeys[$type_data['product_id']][$type_data['type_name']] = $type_data['id'];
            }
        
            $field1 = @$ProdSpecArrKeys['Variety'];
            $field2 = @$ProdSpecArrKeys['Packing'];
            $field3 = @$ProdSpecArrKeys['Quality'];
            $ProdSpecArrNames = array();
            $ProdSpecArrNames['field1'] = $field1;
            $ProdSpecArrNames['field2'] = $field2;
            $ProdSpecArrNames['field3'] = $field3;
            
            if($request->ajax()) 
            {
               
                if(auth()->user()->hasRole('seller') && request()->segment(1) == 'seller')
                {
                    if(!empty(get_buyer_by_user_id()))
                    {
                        $seller_id = get_buyer_by_user_id()->id;
                    } else {
                        $seller_id = auth()->user()->id;
                    }
                    
                    $dataObj = Stock::with('productname', 'sellername','offerPropertyRel','offerPropertyRel.productSpecRel','offerPropertyRel.productSpecValueRel')
                    ->select('id','seller_id','product_id','price','size_from','size_to','stock_status');
                    if($request->has('filter_product') && !empty($request->filter_product))
                    {
                        $product_id = $request->filter_product;
                        $dataObj->where('product_id',$product_id);
                    }
                    $data = $dataObj->where('seller_id', $seller_id)->orderBy('id','desc');
                } 
                else 
                {
                    $dataObj = Stock::with('productname', 'sellername','offerPropertyRel','offerPropertyRel.productSpecRel','offerPropertyRel.productSpecValueRel')
                    ->select('id','seller_id','product_id','price','size_from','size_to','stock_status');
                    if($request->has('filter_product') && !empty($request->filter_product))
                    {
                        $product_id = $request->filter_product;
                        $dataObj->where('product_id',$product_id);
                    }
                    $data = $dataObj->orderBy('id','desc');
                }
                if (!empty($search_value)) 
                {   
                    $data = $data->get();
                }

                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('stock_id', function($row){
                    if(auth()->user()->hasRole('administrator'))
                    return '<a href="stockv2/'.$row->id.'">'.$row->id.'</a>';
                else
                   return  $row->id;
               
                })
                ->addColumn('action', function($row)
                {
                    if(in_array('seller', auth_roles()))
                    {
                        $route_pre = 'seller';
                    }
                    else
                    {
                        $route_pre = 'admin';
                    }
                    $btn = ' <div class="btn-group btn-group-sm">';
                    if(auth()->user()->can('edit stock'))
                    {
                        $btn .= '<button type="button" class="btn btn-edit editItem stock-edit-btn" data-id="'. $row->id.'"><i class="fas fa-edit"></i></button>'; 
                    }
                if(auth()->user()->can('delete stock'))
                {
                        $btn .= '<button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>'; 
                    }
                    $btn .= '</div>';
                    return $btn;
                })
                ->addColumn('price', function($row)
                {
                    return  currency($row->price);
                })
                ->addColumn('earned', function($row)
                {
                    $earned = 0;
                    if(!empty($row->salesAmount)  && count($row->salesAmount) > 0)
                    {
                        foreach($row->salesAmount as $sale)
                        {
                            $earned += $sale->price;
                        }
                    }
                    return currency($earned);
                }) 
                ->addColumn('raw_price', function($row)
                {
                    return  @$row->price;
                })
                ->addColumn('raw_stock_status', function($row)
                {
                    return  @$row->stock_status;
                })
                ->addColumn('stock_status', function($row)
                {
                    return ucfirst(@$row->stock_status);
                })
                ->addColumn('seller_username', function($row)
                {
                    return (@$row->seller->username?@$row->seller->username:'-');
                })
                ->addColumn('field1', function($row) use ($ProdSpecArrKeys) 
                {
                    $arrFields  = array();
                    $field1 =  @$ProdSpecArrKeys[$row->product_id]['Variety'];
                    foreach($row->offerPropertyRel as $prop)
                    {
                        if(@$prop->productSpecRel->field_type == 'dropdown_switchboxes'  || @$prop->productSpecRel->field_type == 'checkboxes')
                        {
                            $arrFields[$prop->product_spec_id][] = @$prop->productSpecValueRel->value;
                        } 
                        else 
                        {
                            $arrFields[$prop->product_spec_id][] = @$prop->value;
                        }
                    }
                
                    if(is_array($arrFields)&& !empty($arrFields[@$field1]))
                    {
                        return implode(', ',@$arrFields[@$field1]);
                    }
                    else 
                    {
                        return '-';
                    }
                })
                ->addColumn('field2', function($row) use ($ProdSpecArrKeys)
                {
                    $arrFields  = array();
                    $field2 =  @$ProdSpecArrKeys[$row->product_id]['Packing'];
                    foreach($row->offerPropertyRel as $prop)
                    {
                        if(@$prop->productSpecRel->field_type == 'dropdown_switchboxes')
                        {
                            $arrFields[$prop->product_spec_id][] = @$prop->productSpecValueRel->value;
                        }
                        else 
                        {
                            $arrFields[$prop->product_spec_id][] = @$prop->value;
                        }
                    }
                    if(is_array($arrFields)&& !empty($arrFields[@$field2]))
                    {
                        return implode(', ',@$arrFields[@$field2]);
                    }
                    else
                    {
                        return '-';
                    }
                })
                ->addColumn('field3', function($row) use ($ProdSpecArrKeys)
                {
                    $field3 =  @$ProdSpecArrKeys[$row->product_id]['Quality'];
                    if($field3 == '')
                    {
                        return '';
                    }
                    else
                    {
                        $arrFields  = array();
                        foreach($row->offerPropertyRel as $prop)
                        {
                            if(@$prop->productSpecRel->field_type == 'dropdown_switchboxes')
                            {
                                $arrFields[$prop->product_spec_id][] = @$prop->productSpecValueRel->value;
                            }
                            else 
                            {
                                $arrFields[$prop->product_spec_id][] = @$prop->productSpecValueRel->value;
                            }
                        }
                        //echo $field3;
                        //echo "<pre/>"; print_r($arrFields);
                        if(is_array($arrFields)&& !empty($arrFields[@$field3]))
                        {
                            return implode(', ',@$arrFields[@$field3]);
                        } 
                        else 
                        {
                            return '-';
                        }
                    }
                })
                ->addColumn('product_name', function($row){
                    return (@$row->productname->name?@$row->productname->name:'-');
                })
                ->addColumn('image', function($row){
                    //Variety
                    $arrFields  = array();
                    $field1 =  @$ProdSpecArrKeys[$row->product_id]['Variety'];
                    foreach($row->offerPropertyRel as $prop)
                    {
                        if(@$prop->productSpecRel->field_type == 'dropdown_switchboxes'  || @$prop->productSpecRel->field_type == 'checkboxes')
                        {
                            $arrFields[$prop->product_spec_id][] = @$prop->productSpecValueRel->value;
                        } 
                        else 
                        {
                            $arrFields[$prop->product_spec_id][] = @$prop->value;
                        }
                    }
                
                    if(is_array($arrFields)&& !empty($arrFields[@$field1]))
                    {
                        $Variety = implode(', ',@$arrFields[@$field1]);
                    }
                    else 
                    {
                        $Variety = '-';
                    }
                    // packing 
                    $arrFields  = array();
                    $field2 =  @$ProdSpecArrKeys[$row->product_id]['Packing'];
                    foreach($row->offerPropertyRel as $prop)
                    {
                        if(@$prop->productSpecRel->field_type == 'dropdown_switchboxes')
                        {
                            $arrFields[$prop->product_spec_id][] = @$prop->productSpecValueRel->value;
                        }
                        else 
                        {
                            $arrFields[$prop->product_spec_id][] = @$prop->value;
                        }
                    }
                    if(is_array($arrFields)&& !empty($arrFields[@$field2]))
                    {
                         $packing= implode(', ',@$arrFields[@$field2]);
                    }
                    else
                    {
                        $packing='-';
                    }

                    //quality
                    $field3 =  @$ProdSpecArrKeys[$row->product_id]['Quality'];
                    if($field3 == ''){
                        $quality= '';
                    }else{
                        $arrFields  = array();
                        foreach($row->offerPropertyRel as $prop){
                            if(@$prop->productSpecRel->field_type == 'dropdown_switchboxes'){
                                $arrFields[$prop->product_spec_id][] = @$prop->productSpecValueRel->value;
                            }else {
                                $arrFields[$prop->product_spec_id][] = @$prop->value;
                            }
                        }
                        if(is_array($arrFields)&& !empty($arrFields[@$field3])){
                            $quality= implode(', ',@$arrFields[@$field3]);
                        } 
                        else {
                            $quality= '-';
                        }
                    }

                    $image = '<a  class="image" ><img src="'.asset('images/products/').'/'.@$row->productname->image.'" onerror=this.src="'.asset('images/products/no_img.png').'" data-homepage_image="'.asset('images/products/').'/'.@$row->productname->homepage_image.'" name="'.@$row->productname->name.'" data-variety="'.@$Variety.'" data-packing="'.@$packing.'" data-quality="'.@$quality.'" data-size="'.(@$row->size_from.'-'.@$row->size_to).'" data-price="'.@$row->price.'"  class="mb-2 img-thumbnail list_image" /></a>';
                    return $image;
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
                ->rawColumns(['action','price','stock_id','image'])
                ->make(true);
            }
            $products = Product::all()->where('status', '1')->pluck('name', 'id', 'image');
            $seller = Seller::where('status', '1')->pluck('username','id');
            return view('backend.stockv2.index',compact('ProdSpecArr','ProdSpecArrNames','products','productsimage','apple_specs','productConfiguration','qualityGlobalArray','seller'));
        }
        
        public function getStockCount(Request $request)
        {
            if(!empty(get_buyer_by_user_id()))
            {
                $seller_id = get_buyer_by_user_id()->id;
            } 
            else 
            {
                $seller_id =  auth()->user()->id;
            }
            $stock_count = Stock::where('seller_id',$seller_id)->count();
            return response()->json(['stock_count' => $stock_count]);
        }
        
        public function matchingRequests(Request $request,$offer = null)
        {
            $data = Stock::with('product', 'seller','offerProperty','offerProperty.productSpec','offerProperty.productSpecValue')->where('seller_id',$offer)->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row)
            {
                if(in_array('seller', auth_roles()))
                {
                    $route_pre = 'seller';
                }
                else
                {
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
                return (@$row->product->name?@$row->product->name:'-');
            })
            
            ->rawColumns(['action','price'])
            ->make(true);
        }


        public function applyMatchingRequest(Request $request)
        {
            $offer = Stock::find($request->offer_id);
            $offer_request = OfferRequest::find($request->request_id);

            $sale = Sale::updateOrCreate(
                ['offer_id' => $request->offer_id, 'request_id' => $request->request_id],
                ['offer_id' => $request->offer_id, 'request_id' => $request->request_id, 'price' => $offer->price]
            );

            if($sale->wasRecentlyCreated)
            {
                $whatsapp_unsubscribe_link ='Click here to unsubscribe whatsapp messages ' .  url('unsubscribeWhatsapp', $request->uuid);

                $seller_message = 'Dear '.$offer->seller->first_name.',
                Your offer matched for '.$offer_request->product->name.' ('.$offer_request->variety.'), Flesh Color: '.$offer_request->flesh_color.', Size: '.$offer_request->size_from.' - '.$offer_request->size_to.', QTY: '.$offer_request->quantity.', Price: '.$offer_request->price_from.' - '.$offer_request->price_to.', location: '.$offer_request->location_from.' - '.$offer_request->location_to;
                $buyer_message = 'Dear '.$offer_request->buyer->first_name.',
                Your request matched for '.$offer->product->name.' ('.$offer->variety.'), Flesh Color: '.$offer->flesh_color.', Size: '.$offer->size.', QTY: '.$offer->quantity.', Price: '.$offer->price.', location: '.$offer->location_from.' - '.$offer->location_to . ' '. $whatsapp_unsubscribe_link;

                SendSMS($offer->seller->phone, $seller_message);
                SendSMS($offer_request->buyer->phone, $buyer_message);
                SendWhatsapp(['phone' => $offer->seller->phone, 'body' => $seller_message,'is_PDF'=>false]);
                SendWhatsapp(['phone' => $offer_request->buyer->phone, 'body' => $buyer_message,'is_PDF'=>false]);
            }
        }

        public function store(Request $request)
        {
        
            request()->validate([
                'product_id' => 'required',
                'price' => 'required',
                'postalcode' => 'required',
                'country' => 'required',
                'price_currency' => 'required'
            ],[
                'product_id.required' => 'Product field is required.',
            ]);
            $all = $request->all();
            
            $tableArray = array();
            $tableArray['product_id'] = $request->get('product_id');
            $tableArray['city'] = '';
            $tableArray['postalcode'] = $request->get('postalcode');
            $tableArray['street'] = '';
            $tableArray['country'] = $request->get('country');
            $tableArray['price'] = $request->get('price');
            $tableArray['price_currency'] = $request->get('price_currency');
            $tableArray['stock_status'] = @$_POST['stock_status'];
            $tableArray['stock_images'] = '';

            if(empty($request->seller_id))
            {
                if(!empty(get_buyer_by_user_id()))
                {
                    $user_id=auth()->user()->id;
                    $tableArray['seller_id']= get_buyer_by_user_id()->id;
                } 
                else 
                {
                    $user_id=auth()->user()->id;
                    $tableArray['seller_id']=  auth()->user()->id;
                }
            } 
            else 
            {
                $sellers = Seller::where('id', $request->seller_id)->first();
                $user_id=$sellers->user_id;
                $tableArray['seller_id']=$request->seller_id;
            }
        
            $imageName2 = [];
            if($request->image)
            {
                $file = $request->image;
                $files = $request->image;
                $time = 1;
                foreach(@$files as $key=>$file)
                {
                    $tmp = time().$time.'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('images/stock'), $tmp);
                    $imageName2[$key] = $tmp;
                    $time++;
                }
            }
            $order = [];
            
            $imgeOrder = $request->get('image-order');
            if(!empty($imgeOrder)){
                foreach($imgeOrder as $iorder){
                    $order[] = $imageName2[$iorder];
                }
            }
            $tableArray['image'] = json_encode(@$order);
            
            $offer = Stock::create($tableArray);
            $productspecification_list = ProductSpecification::with('options')->where('product_id',$_POST['product_id'])->where('parent_id',null)->pluck('field_type','id')->toArray();
        
            $offer_id = $offer->id;
            $specification = @$all['fields'];
            $sizes = @$all['size'];
            // $purposes = @$all['purposeprocessing'];
            //echo "<pre/>"; print_r($specification); die;
            $purposetype = @$all['model-mp'];
            $purposetypeid = @$all['model-mp-id'];
            $colorful = @$all['colorful'];
            $sugar_content = @$all['sugar_content'];      
            
            $pSpecialIds = ProductSpecification::where('product_id',$_POST['product_id'])->where('parent_id',null)->whereIn('type_name',['Size','Colorful','Soil','Sugar Content','Purpose','MarketProcessing'])->pluck('id','type_name')->toArray();
            if(isset($pSpecialIds['MarketProcessing']))
            {
                $MarketProcessing_spec_id = $pSpecialIds['MarketProcessing']; 
                if(!empty($purposetypeid))
                {
                    $data = [
                                'stock_id'=>$offer_id,
                                'product_spec_id' => $MarketProcessing_spec_id,
                                'product_spec_val_id' => @$purposetypeid
                            ];
                    StockProperty::create($data);
                }
            }
            if(isset($pSpecialIds['Soil']))
            {
                $Soil_spec_id = $pSpecialIds['Soil']; 
                if(!empty($all['model-mp-child']))
                {
                    $data = [
                                'stock_id'=>$offer_id,
                                'product_spec_id' => $Soil_spec_id,
                                'product_spec_val_id' => $all['model-mp-child']
                            ];
                    StockProperty::create($data);
                }
            }
            
            if($purposetype == 'Market')
            {
                $purposes = @$all['purposemarketing'];
                if(isset($pSpecialIds['Purpose']))
                { 
                   $product_spec_id = @$pSpecialIds['Purpose']; 
                    if(!empty($purposes))
                    {
                        $data = [
                                    'stock_id'=>$offer_id,
                                    'product_spec_id' => $product_spec_id,
                                    'product_spec_val_id' => @$purposes
                                ];
                                  
                        StockProperty::create($data);
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
                            $data = [
                                        'stock_id'=>$offer_id,
                                        'product_spec_id' => $product_spec_id,
                                        'product_spec_val_id' => @$purposesprocessing
                                    ];
                                     //echo "<pre/>";print_r($data); 
                            StockProperty::create($data);
                        }
                    }
                }
            }
            
            if(isset($pSpecialIds['Size']))
            { 
                $product_spec_id = @$pSpecialIds['Size']; 
                if(is_array($sizes) && !empty($sizes))
                {
                    foreach(@$sizes as $size_id=>$specValue3)
                    {
                        $data = [
                                    'stock_id'=>$offer_id,
                                    'product_spec_id' => $product_spec_id,
                                    'value' => @$specValue3['from'].'-'.@$specValue3['to']
                                ];
                        StockProperty::create($data);
                    }
                }
            }
            if(isset($pSpecialIds['Colorful']))
            {
                $Colorful_spec_id = $pSpecialIds['Colorful']; 
                if(is_array($colorful) && !empty($colorful))
                {
                    $data = [
                                'stock_id'=>$offer_id,
                                'product_spec_id' => $Colorful_spec_id,
                                'value' => @$colorful['from'].'-'.@$colorful['to']
                            ];
                    StockProperty::create($data);
                }
            }
            if(isset($pSpecialIds['Sugar Content']))
            {
                $sugar_content_spec_id = $pSpecialIds['Sugar Content']; 
                if(is_array($sugar_content) && !empty($sugar_content))
                {                   
                    $data = [
                                'offer_id'=>$offer_id,
                                'product_spec_id' => $sugar_content_spec_id,
                                'value' => @$sugar_content['from'].'-'.@$sugar_content['to']
                            ];
                    StockProperty::create($data);
                }
            }
            
            
            if(is_array($specification) && !empty($specification))
            {
                foreach(@$specification as $product_spec_id=>$specValue)
                {
                    if($productspecification_list[$product_spec_id] == 'dropdown_switchboxes' || $productspecification_list[$product_spec_id] == 'checkboxes')
                    {
                        if(is_array($specValue))
                        {
                            foreach($specValue as $specValueKey=>$specValueValue)
                            {
                                if((int)$specValueValue > 0)
                                {
                                    $data = [
                                        'stock_id'=>$offer_id,
                                        'product_spec_id' => $product_spec_id,
                                        'product_spec_val_id' => $specValueValue,
                                            'ecs' => @$all['ecs'][$product_spec_id][$specValueValue]
                                        ];
                                    StockProperty::create($data);
                                }
                            }
                        } 
                        else
                        {
                            if((int)$specValue > 0)
                            {
                                $data = [
                                    'stock_id'=>$offer_id,
                                    'product_spec_id' => $product_spec_id,
                                    'product_spec_val_id' => $specValue,
                                    ];
                            
                                StockProperty::create($data);
                            }                            
                        }
                    } 
                    else if($productspecification_list[$product_spec_id] == 'inputfield')
                    {
                        $data = [
                                'stock_id'=>$offer_id,
                                'product_spec_id' => $product_spec_id,
                                'value' => $specValue
                                ];
                        StockProperty::create($data);       
                    } 
                    else if($productspecification_list[$product_spec_id] == 'optionrange')
                    {
                        $data = [
                                'offer_id'=>$offer_id,
                                'product_spec_id' => $product_spec_id,
                                'value' => $specValue['size_from'].'-'.$specValue['size_to']
                                ];
                        StockProperty::create($data);
                    }           
                }
            }        

            $message="Hi,\n You have successfully added your stock!";
            event(new Pushnotification($message,$user_id,$url='',$sound=1));
            // event(new StockUpdated($stock));
            \App\Jobs\StockUpdated::dispatch($offer_id);
            \Log::info('after stockUpdated dispatch');
            
            return response()->json(['status' => 'success', 'message' => 'Stock added successfully!']);
        }

        public function show(Stock $stockv2)
        {
            $offerProperty = $stockv2->offerProperty()->with('productSpec','productSpecValue')->get();
            //echo "<pre/>";print_r($offerProperty);die;
            $offerPropertyArr = array();
            foreach($offerProperty as $productPref)
            {
                if(isset($productPref->productspec))
                {
                    $offerPropertyArr[$productPref->productspec->display_name][] =  (($productPref->productspec->field_type == 'dropdown_switchboxes')?@$productPref->productspecvalue->value:@$productPref->value);
                }
            }
            $stock = $stockv2;
            return view('backend.stockv2.show',compact('stock','offerProperty','offerPropertyArr'));
        }

        public function showAjax(Stock $stockv2)
        {
            $offerProperty = $stockv2->offerProperty()->with('productSpec','productSpecValue')->get();
            ///echo "<pre/>";print_r($offerProperty);die;
            $offerPropertyArr = array();
            foreach($offerProperty as $productPref)
            {
                if(isset($productPref->productspec))
                {
                    $offerPropertyArr[$productPref->productspec->display_name][] =  (($productPref->productspec->field_type == 'dropdown_switchboxes')?@$productPref->productspecvalue->value:@$productPref->value);
                }
            }
            $stock = $stockv2;

            $html = '<div class="row">
            <div id="accordion" style="width: 100%;">'.
                '<div class="card">'.
                    '<div class="card-header" id="headingofferDetails" data-toggle="collapse" data-target="#collapseofferDetails" aria-expanded="true" aria-controls="collapseofferDetails">'.
                        '<strong>Stock Details #'. $stock->id .'</strong>'.
                    '</div>
                    <div id="collapseofferDetails" class="collapse show" aria-labelledby="headingofferDetails" data-parent="#accordion">
                    <div class="card-body">';
                        if($stock->image)
                        {
                            $html .='<div class="form-group"><strong>Stock Attachment:</strong>';
                                $images = (isset($stock->image) ? (is_array(json_decode(@$stock->image)) ? json_decode(@$stock->image) : array($stock->image)) : array());
                                foreach(@$images as $img)
                                {
                                    $html .= '<a href="'.asset('images/stock/'.$img).'" data-fancybox data-caption="'.@$stock->product->name.'"><i class="fa fa-paperclip" aria-hidden="true"></i>'. $img .'</a>';
                                }
                            $html .= '</div>';
                        }
                        if($stock->exp_image)
                        {
                            $html .= '<div class="form-group"><strong>Example Attachment: </strong><a href="'.asset('images/stock/'.$stock->exp_image) .'target="_blank" >  <i class="fa fa-paperclip" aria-hidden="true"></i>'. $stock->exp_image .'</a></div>';
                        }

                        $html .= '<div class="form-group"><strong>Stock ID: </strong>'. @$stock->id .'</div>';
                        $html .= '<div class="form-group"><strong>Product Name: </strong>'. @$stock->product->name .'</div>';
                        //$html .= '<div class="form-group"><strong>Size: </strong>'. $stock->size_from.' - '.$stock->size_to .'</div>';
                        foreach($offerPropertyArr as $display_name=>$productPref)
                        {
                            if(is_array($productPref)&& !empty($productPref))
                            {
                                $html .= '<div class="form-group"><strong>'. @$display_name .':'. '</strong>'. implode(', ',@$productPref) .'</div>';
                            }
                        }
                        $html .= '<div class="form-group"><strong>Quantity: </strong>'. $stock->quantity ?? 'N/A' .'</div>';
                        $html .= '<div class="form-group"><strong>Country: </strong>'. $stock->country ?? 'N/A' .'</div>';
                        $html .= '<div class="form-group"><strong>Street: </strong>'.  $stock->street ?? 'N/A' .'</div>';
                        $html .= '<div class="form-group"><strong>City: </strong>'. $stock->city ?? 'N/A' .'</div>';
                        $html .= '<div class="form-group"><strong>Postal code: </strong>'. $stock->postalcode ?? 'N/A' .'</div>';
                        $html .= '<div class="form-group"><strong>Price in GBP: </strong>'. currency($stock->price) ?? 'N/A' .'</div>';
                        $html .= '<div class="form-group"><strong>Note: </strong>'. $stock->note ?? 'N/A' .'</div>';
                        $html .= '<div class="form-group"><strong>Status: </strong>'. $stock->status .'</div>';
                    $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '<div class="card">';
                $html .= '<div class="card-header collapsed" id="headingSellerDetails" data-toggle="collapse" data-target="#collapseSellerDetails" aria-expanded="false" aria-controls="collapseSellerDetails">';
                $html .= '<strong>Seller Details</strong>';
                $html .= '</div>';
                $html .= '<div id="collapseSellerDetails" class="collapse" aria-labelledby="headingSellerDetails" data-parent="#accordion">';
                $html .= '<div class="card-body">';
                $html .= '<div class="form-group"><strong>Seller ID: </strong>'. @$stock->seller->id ?? 'N/A' .'</div>';
                        $html .= '<div class="form-group"><strong>Name: </strong>'. @$stock->seller->username ?? 'N/A' .'</div>';
                        $html .= '<div class="form-group"><strong>Email: </strong>'. @$stock->seller->email ?? 'N/A' .'</div>';
                        $html .= '<div class="form-group"><strong>Phone: </strong>'. @$stock->seller->phone ?? 'N/A' .'</div>';
                        $html .= '</div>';
                    $html .= '</div>';
                $html .= '</div>';
                $html .= '</div></div>';
            return response()->json(['status' => 'success', 'stocks' => $html]);
        }

        public function edit(Stock $stock)
        {   
            $offerProperty = $stock->offerProperty()->select('offer_id','product_spec_id','product_spec_val_id','ecs')->get()->toArray();
            $productPrefsMapping = array();
            $ecs = array();
            foreach($offerProperty as $productPref)
            {
                $ecs[$productPref['product_spec_id']][$productPref['product_spec_val_id']] = @$productPref['ecs'];
                $productPrefsMapping[$productPref['product_spec_id']][] = $productPref['product_spec_val_id'];    
            }
            $product_list = Product::all()->where('status',1)->pluck('name','id');
            $productspecification_list = ProductSpecification::with('options')->where('product_id',$stock->product_id)->where('parent_id',null)->get();
            $productSpecRel = array();
            foreach($productspecification_list as $spec)
            {
                $productSpecRel[$spec->id]['name'] = $spec->display_name;
                $productSpecRel[$spec->id]['hasmany'] = $spec->stock_hasmany;
                $productSpecRel[$spec->id]['can_edit'] = $spec->can_edit;
                $productSpecRel[$spec->id]['field_type'] = $spec->field_type;
                if($spec->stock_hasmany == 'Yes')
                {
                    $productSpecRel[$spec->id]['default'] = @$productPrefsMapping[$spec->id];
                } 
                else 
                {
                    $productSpecRel[$spec->id]['default'] = current($productPrefsMapping[$spec->id]??array());
                }
                $productSpecRel[$spec->id]['options'] = array();
                foreach($spec->options as $option)
                {
                if($spec->stock_hasmany == 'Yes')
                {
                        $productSpecRel[$spec->id]['options'][$option->id]['name'] = $option->value;
                        $productSpecRel[$spec->id]['options'][$option->id]['premium'] = @$productPrefsMappingPremiums[$spec->id][$option->id];
                        $productSpecRel[$spec->id]['options'][$option->id]['ec'] = $option->ec;
                        $productSpecRel[$spec->id]['options'][$option->id]['ecbf'] = $option->ecbf;
                    } 
                    else 
                    {
                        $productSpecRel[$spec->id]['options'][$option->id] = $option->value;
                    }
                }
            }
            $productspecificationval_list = ProductSpecificationValue::with('product_specification')->where('product_id',$stock->product_id)->whereNotNull('parent_id')->get();
            $productSpecChildRelation = array();
            foreach($productspecificationval_list as $childItem)
            {
                if($childItem->product_specification->reference_id != '')
                {
                $productSpecChildRelation[$childItem->parent_id]['reference_id'] =  $childItem->product_specification->reference_id;
                $productSpecChildRelation[$childItem->parent_id]['value'] =  $childItem->value;
                }
            }
            
            $products = Product::all()->where('status', '1')->pluck('name', 'id');
            $sellers = Seller::where('status', '1')->select('id', 'username', 'name')->get();
            $product = \App\AppHead::where('name','Like','Potato')->where('type', 'product')->select('id', 'image')->first();
            $stock_image = @$product->image;
            return view('backend.stock.create',compact('products','stock', 'sellers', 'stock_image','product','productSpecRel','ecs','productSpecChildRelation'));
        }

        public function update(Request $request, Stock $stockv2){
           
            request()->validate([
                    'product_id' => 'required',
                    'price' => 'required',
                    'postalcode' => 'required',
                    'country' => 'required',
                    //'size_to' => 'required',
                   // 'size_from' => 'required'
                ],[
                'product.required' => 'Product is required.',
                ]);
            //echo "<pre>";print_r($request->all());die;
            foreach($request->all() as $key=>$val)
            {
                $tableArray[$key]=$val;
            }
           //echo "<pre/>"; print_r($tableArray); die;
            if($request->image)
            {
                if(count((array)$request->image) > 6)
                {
                    return response()->json(['status' => 'error', 'message' => 'Max 6 images can be uploaded!']);
                }
                $imageName2 = array();
                $i = 0;
                foreach($request->image as $file)
                {
                    $i++;
                    $tmp = time().'_'.$i.'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('images/stock'), $tmp);
                    $imageName2[] = $tmp;
                }

                if($request->exp_image)
                {
                    $imageName = time().'.'.request()->exp_image->getClientOriginalExtension();
                    request()->exp_image->move(public_path('images/stock'), $imageName);
                }
                $json_fields = array('exp_image');
                
                $tableArray['image'] = json_encode(@$imageName2);
                foreach($request->all() as $key=>$val)
                {
                    if (in_array($key, $json_fields)) 
                    {
                        $tableArray[$key] = @$imageName;
                    }
                }
            }

        
            $tableArray['stock_status'] = $request->stock_status;
            $stockv2->update($tableArray);
            
            $all = $request->all();
            
            $offer_id = $stockv2->id;
            $specification = @$all['fields'];
            $sizes = @$all['size'];
            $colorful = @$all['colorful'];
            $sugar_content = @$all['sugar_content'];  
           
            $offerPropertExists = $stockv2->offerProperty()->pluck('id','id')->toArray();
            
            $pSpecialIds = ProductSpecification::where('product_id',$_POST['product_id'])->where('parent_id',null)->whereIn('type_name',['Size','Colorful','Sugar Content','Purpose','Soil','MarketProcessing'])->pluck('id','type_name')->toArray();
            
            if(isset($pSpecialIds['MarketProcessing']) && isset($all['edit-model-mp-id']))
            { 
               $specification[$pSpecialIds['MarketProcessing']] = $all['edit-model-mp-id'];
            }
            if(isset($pSpecialIds['Soil']) && isset($all['edit-model-mp-child']))
            {
                $specification[$pSpecialIds['Soil']] = $all['edit-model-mp-child'];
            }
            //echo "<pre/>"; print_r($specification); die;
            if(isset($pSpecialIds['Size']))
            {
                $product_spec_id = @$pSpecialIds['Size']; 
                if(is_array($sizes) && !empty($sizes))
                {
                    foreach(@$sizes as $size_id=>$specValue3)
                    {
                        $data = [
                                    'stock_id'=>$offer_id,
                                    'product_spec_id' => $product_spec_id,
                                    'value' => @$specValue3['from'].'-'.@$specValue3['to']
                                ];
                                
                                StockProperty::updateOrCreate(['stock_id' => $offer_id,'product_spec_id' => $product_spec_id],$data
                            );
                        StockProperty::create($data);
                    }
                }
            }
            
            
            
            if(is_array($specification) && !empty($specification))
            {
                foreach($specification as $product_spec_id=>$specValue)
                {
                    if(is_array($specValue))
                    {
                        foreach($specValue as $specValueKey=>$specValueValue)
                        {
                            $buyerPP = StockProperty::updateOrCreate(
                                ['stock_id' => $offer_id,'product_spec_id' => $product_spec_id,'product_spec_val_id' => $specValueValue],
                                ['stock_id' => $offer_id,'product_spec_id' => $product_spec_id,'product_spec_val_id' => $specValueValue,'ecs' => @$all['ecs'][$product_spec_id][$specValueValue]]
                            );
                           
                            unset($offerPropertExists[$buyerPP->id]);  
                            
                        }
                    }  
                    else 
                    {
                        $buyerPP = StockProperty::firstOrCreate(
                            ['stock_id' => $offer_id,'product_spec_id' => $product_spec_id,'product_spec_val_id' => $specValue],
                            ['stock_id' => $offer_id,'product_spec_id' => $product_spec_id,'product_spec_val_id' => $specValue]
                        );
                        unset($offerPropertExists[$buyerPP->id]);  
                    }        
                }
            }
            foreach($offerPropertExists as $propId)
            {
                StockProperty::destroy($propId);
            }
                        
            // event(new StockUpdated($stockv2));
            \App\Jobs\StockUpdated::dispatch($stockv2->id);
            \Log::info('after stockUpdated dispatch');
            return response()->json(['status' => 'success', 'message' => 'Stock updated successfully!']);
        }

        public function destroy(Stock $stock)
        {
            $stock->delete();
            return response()->json(['success'=>'Stock deleted successfully.']);
        }

        public function getvcolorAjax(Request $request)
        {
            $vcolor = \App\AppHead::where('id', $request->pid)->where('type', 'potato_variety')->select('id', 'color_id')->first();
            return response()->json(['color_id'=>@$vcolor->color_id]);
        }

        public function getproductsampleAjax(Request $request)
        {
            $product = Product::where('id', $request->pid)->first();
            if(!empty($product))
            {
                $html = '<a href="'.asset('images/products/').'/'.$product->image.'" data-fancybox data-caption="'.$product->name.'"><img src="'.asset('images/products/').'/'.$product->image.'" class="mb-2 img-thumbnail"></a>';
                print_r($html);
                exit;
            }
        }

        public function stocksexports() 
        {
            return Excel::download(new StocksExport, 'stocks.xlsx');
        }

        public function stockimport(Request $request)
        {
            Excel::import(new SellerImport,request()->file('stock_file'));           
            return redirect()->back();
        }

        public function stockcardview(Request $request) 
        {
            
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
                        if($productspec->tags == 'Conditional'){
                            $qualityGlobalArray[$productspec->product_id][$productspecval->related_spec_val_id][$productspecval->id]['title'] =  $productspecval->value;
                            $qualityGlobalArray[$productspec->product_id][$productspecval->related_spec_val_id][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
                            $qualityGlobalArray[$productspec->product_id][$productspecval->related_spec_val_id][$productspecval->id]['class'] =  ($productspecval->tags !='' && $productspecval->tags !=NULL ?$productspecval->tags:'Class1');
                        } else {
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

            $seller = Seller::where('status', '1')->pluck('username','id');

            if(Auth()->user()->hasRole('administrator') && request()->segment(1) == 'admin' )
            {
                $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')->select('id', 'seller_id', 'product_id', 'price', 'price_currency', 'size_from', 'size_to', 'stock_status', 'image')->limit(12)->get();
            }
            else
            {
                if(!empty(get_buyer_by_user_id()))
                {
                $seller_id = get_buyer_by_user_id()->id;
                } 
                else 
                {
                    $seller_id =  auth()->user()->id;
                }
                $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')
            ->select('id', 'seller_id', 'product_id', 'price','price_currency', 'size_from', 'size_to', 'stock_status', 'image')->where('seller_id', $seller_id)->limit(12)->get();
            }
            $products = Product::all()->where('status', '1')->pluck('name', 'id');

            $productspecification_list = ProductSpecification::with('options')
            ->where('parent_id',null)->whereIn('type_name',['Quality'])->get();
            $qualityGlobalArray = [];
            foreach($productspecification_list as $productspec)
            {
                foreach($productspec->options as $productspecval)
                {
                    if($productspecval->parent_id == NULL)
                    {
                        if($productspec->tags == 'Conditional'){
                            $qualityGlobalArray[$productspec->product_id][$productspecval->related_spec_val_id][$productspecval->id]['title'] =  $productspecval->value;
                            $qualityGlobalArray[$productspec->product_id][$productspecval->related_spec_val_id][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
                            $qualityGlobalArray[$productspec->product_id][$productspecval->related_spec_val_id][$productspecval->id]['class'] =  ($productspecval->tags !='' && $productspecval->tags !=NULL ?$productspecval->tags:'Class1');
                        } else {
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

            
            return view('backend.stockv2.cardview',compact('seller', 'stocks', 'productsimage', 'products', 'productConfiguration', 'qualityGlobalArray'));
        }

       
        public function stockcardviewbyAjax(Request $request) 
        {
            
            if($request->sortby == 2){
                $sortby = 'buyer_id'; 
                $asc = 'ASC';  }
            elseif($request->sortby == 3){
                $sortby = 'id';   
                $asc = 'DESC';  }
            elseif($request->sortby == 4){
                $sortby = 'seller_id';   
                $asc = 'ASC';  }    
            else{
                $sortby = 'id';
                $asc = 'ASC';  }
     
            $productsimage = Product::select('image','id','type','name')->where('status', '1')->get();
            if(Auth()->user()->hasRole('administrator') && request()->segment(1) == 'admin' )
            {
                if($request->all('productid')['productid'] !='' && $request->all('variety')['variety'] =='' && $request->all('quality')['quality'] ==''){
                     $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')->select('id', 'seller_id', 'product_id', 'price', 'size_from', 'size_to', 'stock_status', 'image')->where('product_id', $request->all('productid') )->orderBy($sortby, $asc)->limit(12)->get();
                }
                else if($request->all('productid')['productid'] !='' && $request->all('variety')['variety'] !='' && $request->all('quality')['quality'] ==''){
                     $variety = $request->all('variety')['variety'];   
                     $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')->select('id', 'seller_id', 'product_id', 'price', 'size_from', 'size_to', 'stock_status', 'image')->whereHas('offerPropertyRel.productSpecValueRel', function($q) use ($variety) {  $q->where('id', $variety ); })->where('product_id', $request->all('productid') )->orderBy($sortby, $asc)->limit(12)->get();
                }
                else if($request->all('productid')['productid'] !='' && $request->all('variety')['variety'] !='' && $request->all('quality')['quality'] !=''){
                     $variety = $request->all('variety')['variety']; 
                     $quality = $request->all('quality')['quality'] ;   
                     $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')->select('id', 'seller_id', 'product_id', 'price', 'size_from', 'size_to', 'stock_status', 'image')->whereHas('offerPropertyRel.productSpecValueRel', function($q) use ($variety) {  $q->where('id', $variety ); })->whereHas('offerPropertyRel.productSpecValueRel', function($q) use ($quality) {  $q->where('value', $quality ); })->where('product_id', $request->all('productid') )->orderBy($sortby, $asc)->limit(12)->get();
                }
                else if($request->all('productid')['productid'] =='' && $request->all('variety')['variety'] =='' && $request->all('quality')['quality'] !=''){
                     $variety = $request->all('variety')['variety']; 
                     $quality = $request->all('quality')['quality'] ;   
                     $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')->select('id', 'seller_id', 'product_id', 'price', 'size_from', 'size_to', 'stock_status', 'image')->whereHas('offerPropertyRel.productSpecValueRel', function($q) use ($quality) {  $q->where('value', $quality ); })->where('product_id', $request->all('productid') )->limit(12)->get();
                }
                else if($request->all('productid')['productid'] =='' && $request->all('variety')['variety'] =='' && $request->all('quality')['quality'] ==''){
                     $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')->select('id', 'seller_id', 'product_id', 'price', 'size_from', 'size_to', 'stock_status', 'image')->orderBy($sortby, $asc)->limit(12)->get();
                }
                else{
                    $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')
                    ->select('id', 'seller_id', 'product_id', 'price', 'size_from', 'size_to', 'stock_status', 'image')->orderBy($sortby, $asc)->limit(12)->get();
                }
            }
            else
            {
                if(!empty(get_buyer_by_user_id()))
                {
                $seller_id = get_buyer_by_user_id()->id;
                } 
                else 
                {
                    $seller_id =  auth()->user()->id;
                }
                    
                if($request->all('productid')['productid'] !='' && $request->all('variety')['variety'] =='' && $request->all('quality')['quality'] ==''){
                     $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')->select('id', 'seller_id', 'product_id', 'price', 'size_from', 'size_to', 'stock_status', 'image')->where('seller_id', $seller_id)->where('product_id', $request->all('productid') )->orderBy($sortby, $asc)->limit(12)->get();
                }
                else if($request->all('productid')['productid'] !='' && $request->all('variety')['variety'] !='' && $request->all('quality')['quality'] ==''){
                     $variety = $request->all('variety')['variety'];   
                     $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')->select('id', 'seller_id', 'product_id', 'price', 'size_from', 'size_to', 'stock_status', 'image')->where('seller_id', $seller_id)->whereHas('offerPropertyRel.productSpecValueRel', function($q) use ($variety) {  $q->where('id', $variety ); })->where('product_id', $request->all('productid') )->orderBy($sortby, $asc)->limit(12)->get();
                }
                else if($request->all('productid')['productid'] !='' && $request->all('variety')['variety'] !='' && $request->all('quality')['quality'] !=''){
                     $variety = $request->all('variety')['variety']; 
                     $quality = $request->all('quality')['quality'] ;   
                     $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')->select('id', 'seller_id', 'product_id', 'price', 'size_from', 'size_to', 'stock_status', 'image')->whereHas('offerPropertyRel.productSpecValueRel', function($q) use ($variety) {  $q->where('id', $variety ); })->whereHas('offerPropertyRel.productSpecValueRel', function($q) use ($quality) {  $q->where('value', $quality ); })->where('seller_id', $seller_id)->where('product_id', $request->all('productid') )->orderBy($sortby, $asc)->limit(12)->get();
                }
                else if($request->all('productid')['productid'] =='' && $request->all('variety')['variety'] =='' && $request->all('quality')['quality'] !=''){ 
                     $variety = $request->all('variety')['variety']; 
                     $quality = $request->all('quality')['quality'] ;   
                     $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')->select('id', 'seller_id', 'product_id', 'price', 'size_from', 'size_to', 'stock_status', 'image')->whereHas('offerPropertyRel.productSpecValueRel', function($q) use ($quality) {  $q->where('value', $quality ); })->where('seller_id', $seller_id)->where('product_id', $request->all('productid') )->orderBy($sortby, $asc)->limit(12)->get();
                }
                else{

                    $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')
                    ->select('id', 'seller_id', 'product_id', 'price', 'size_from', 'size_to', 'stock_status', 'image')->where('seller_id', $seller_id)->orderBy($sortby, $asc)->limit(12)->get();
                    }    
            }

            if(empty($stocks->first() )){
                $result = array(
                    'status' => 'false',
                    'msg' => "No more records found" 
                );
            }
            else{
                // print_r($stocks->first()); exit('dsdss');
                $res = $this->cardviewhtml($stocks );
                $result = array(
                    'status' => 'success',
                    'data' => $res['cards'],
                    'id' => $res['last_id']
                );
            }
            echo json_encode($result);
            die;

        }
    
        public function stockmorecardview(Request $request) 
        {
            if($request->all('last_id')){

            $res = $request->all('last_id');
            $last_id = $res['last_id'];

            $productsimage = Product::select('image','id','type','name')->where('status', '1')->get();
            if(Auth()->user()->hasRole('administrator') && request()->segment(1) == 'admin' )
            {
               if($request->all('productid')['productid'] !='' && $request->all('variety')['variety'] =='' && $request->all('quality')['quality'] ==''){
                     $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')->select('id', 'seller_id', 'product_id', 'price', 'size_from', 'size_to', 'stock_status', 'image')->where('id', '>', $last_id)->where('product_id', $request->all('productid') )->limit(12)->get();
                }
                else if($request->all('productid')['productid'] !='' && $request->all('variety')['variety'] !='' && $request->all('quality')['quality'] ==''){
                     $variety = $request->all('variety')['variety'];   
                     $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')->select('id', 'seller_id', 'product_id', 'price', 'size_from', 'size_to', 'stock_status', 'image')->whereHas('offerPropertyRel.productSpecValueRel', function($q) use ($variety) {  $q->where('id', $variety ); })->where('id', '>', $last_id)->where('product_id', $request->all('productid') )->limit(12)->get();
                }
                else if($request->all('productid')['productid'] !='' && $request->all('variety')['variety'] !='' && $request->all('quality')['quality'] !=''){
                     $variety = $request->all('variety')['variety']; 
                     $quality = $request->all('quality')['quality'] ;   
                     $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')->select('id', 'seller_id', 'product_id', 'price', 'size_from', 'size_to', 'stock_status', 'image')->whereHas('offerPropertyRel.productSpecValueRel', function($q) use ($variety) {  $q->where('id', $variety ); })->whereHas('offerPropertyRel.productSpecValueRel', function($q) use ($quality) {  $q->where('value', $quality ); })->where('id', '>', $last_id)->where('product_id', $request->all('productid') )->limit(12)->get();
                }
                else if($request->all('productid')['productid'] =='' && $request->all('variety')['variety'] =='' && $request->all('quality')['quality'] !=''){
                     $variety = $request->all('variety')['variety']; 
                     $quality = $request->all('quality')['quality'] ;   
                     $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')->select('id', 'seller_id', 'product_id', 'price', 'size_from', 'size_to', 'stock_status', 'image')->whereHas('offerPropertyRel.productSpecValueRel', function($q) use ($quality) {  $q->where('value', $quality ); })->where('id', '>', $last_id)->where('product_id', $request->all('productid') )->limit(12)->get();
                }
                else{
                    $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')
                    ->select('id', 'seller_id', 'product_id', 'price', 'size_from', 'size_to', 'stock_status', 'image')->where('product_id', $request->all('productid') )->where('id', '>', $last_id)->limit(12)->get();
                }
            }
            else
            {
                if(!empty(get_buyer_by_user_id()))
                {
                $seller_id = get_buyer_by_user_id()->id;
                } 
                else 
                {
                    $seller_id =  auth()->user()->id;
                }

                if($request->all('productid')['productid'] !='' && $request->all('variety')['variety'] =='' && $request->all('quality')['quality'] ==''){
                     $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')->select('id', 'seller_id', 'product_id', 'price', 'size_from', 'size_to', 'stock_status', 'image')->where('seller_id', $seller_id)->where('product_id', $request->all('productid') )->where('id', '>', $last_id)->limit(12)->get();
                }
                else if($request->all('productid')['productid'] !='' && $request->all('variety')['variety'] !='' && $request->all('quality')['quality'] ==''){
                     $variety = $request->all('variety')['variety'];   
                     $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')->select('id', 'seller_id', 'product_id', 'price', 'size_from', 'size_to', 'stock_status', 'image')->where('seller_id', $seller_id)->whereHas('offerPropertyRel.productSpecValueRel', function($q) use ($variety) {  $q->where('id', $variety ); })->where('product_id', $request->all('productid') )->where('id', '>', $last_id)->limit(12)->get();
                }
                else if($request->all('productid')['productid'] !='' && $request->all('variety')['variety'] !='' && $request->all('quality')['quality'] !=''){
                     $variety = $request->all('variety')['variety']; 
                     $quality = $request->all('quality')['quality'] ;   
                     $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')->select('id', 'seller_id', 'product_id', 'price', 'size_from', 'size_to', 'stock_status', 'image')->whereHas('offerPropertyRel.productSpecValueRel', function($q) use ($variety) {  $q->where('id', $variety ); })->whereHas('offerPropertyRel.productSpecValueRel', function($q) use ($quality) {  $q->where('value', $quality ); })->where('seller_id', $seller_id)->where('product_id', $request->all('productid') )->where('id', '>', $last_id)->limit(12)->get();
                }
                else if($request->all('productid')['productid'] =='' && $request->all('variety')['variety'] =='' && $request->all('quality')['quality'] !=''){
                     $variety = $request->all('variety')['variety']; 
                     $quality = $request->all('quality')['quality'] ;   
                     $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')->select('id', 'seller_id', 'product_id', 'price', 'size_from', 'size_to', 'stock_status', 'image')->whereHas('offerPropertyRel.productSpecValueRel', function($q) use ($quality) {  $q->where('value', $quality ); })->where('seller_id', $seller_id)->where('product_id', $request->all('productid') )->where('id', '>', $last_id)->limit(12)->get();
                }
                else{
                    $stocks = Stock::with('product', 'sellername', 'offerPropertyRel', 'offerPropertyRel.productSpecRel', 'offerPropertyRel.productSpecValueRel')
                    ->select('id', 'seller_id', 'product_id', 'price', 'size_from', 'size_to', 'stock_status', 'image')->where('seller_id', $seller_id)->where('id', '>', $last_id)->limit(12)->get();
                    }        
            }

                if(empty($stocks->first() )){
                    $result = array(
                        'status' => 'false',
                        'msg' => "No more records found" 
                    );
                }
                else{
                    
                    $res = $this->cardviewhtml($stocks);

                    $result = array(
                        'status' => 'success',
                        'data' => $res['cards'],
                        'id' => $res['last_id']
                    );
                }
            }else{
                    $result = array(
                        'status' => 'false',
                        'msg' => "No more records found" 
                    );
            }
            echo json_encode($result);
            die;

        }

    public function cardviewhtml($stocks){
      $cards = array(); $last_id;
      if(isset($stocks)){
      foreach($stocks as $stock){
       //print_r($stock); exit('ad');
      $html = '<div class="col-xs-12 col-sm-6 col-md-4 removeable">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="stock-gallery">         
                                        <!--Carousel Wrapper-->
                                        <div id="carousel-thumb-{{$stock->id}}" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
                                            <!--Slides-->
                                            <div class="carousel-inner" role="listbox">
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100 no_img"  onerror=this.src="'.asset('images/products/no_img.png').'" src="'.asset('images/products/'.@$stock->product->homepage_image).'">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100 no_img" onerror=this.src="'.asset('images/products/no_img.png').'" src="'.asset('images/products/'.@$stock->product->image).'">
                                                </div>';
                                                if(@$stock->image != Null){
                                                    $imageN = 1;
                                                    if($stock->image !== '[]'){
                                                        foreach(json_decode(@$stock->image, true) as $stock_img){
                                                        
                                                            if($imageN == 1){ $html .= '<div class="carousel-item active " > ';  }
                                                            
                                                            else{  $html .= '<div class="carousel-item active " >' ;  }
                                                            
                                                            $html .= '<img class="d-block w-100" src="' . asset('images/stock/'.$stock_img).'">
                                                            </div>';
                                                            $imageN++; 
                                                        }
                                                    }else{
                                                        $html .= '<div class="carousel-item active " >' ;
                                                            
                                                        $html .= '<img class="d-block w-100" src="' . asset('images/stock/'.$stock_img).'">
                                                        </div>';
                                                        $imageN++; 
                                                    }
                                                }
                                            $html .='</div>
                                            <!--/.Slides-->
                                            <!--Controls-->
                                            <a class="carousel-control-prev" href="#carousel-thumb-'.$stock->id.'" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carousel-thumb-'.$stock->id.'" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                            <!--/.Controls-->
                                            <ol class="carousel-indicators">
                                                <li data-target="#carousel-thumb-'.$stock->id.'" data-slide-to="0" class="active"><img class="d-block w-100" onerror=this.src="'.asset('images/products/no_img.png').'" src="'. asset('images/products/'.@$stock->product->homepage_image).'" class="img-fluid"></li>
                                                <li data-target="#carousel-thumb-'.$stock->id.'" data-slide-to="1"><img class="d-block w-100" onerror=this.src="'.asset('images/products/no_img.png').'" src="'.asset('images/products/'.@$stock->product->image).'" class="img-fluid"></li>
                                            </ol>
                                        </div>
                                        <!--/.Carousel Wrapper-->        
                                    </div>
                                </div>';
                                $Size = $variety = $packing = ""; 
                                if($stock->offerPropertyRel){              
                                foreach(@$stock->offerPropertyRel as $rel){
                                        if($rel->productSpecRel->type_name== "Variety"){
                                            $variety = @$rel->productSpecValueRel->value; 
                                        }
                                        if($rel->productSpecRel->type_name  == "Packing"){
                                            $packing = @$rel->productSpecValueRel->value;
                                        }
                                        if($rel->productSpecRel->type_name == "Quality"){
                                            $quality = @$rel->productSpecValueRel->value;
                                        }
                                        if($rel->productSpecRel->type_name == "Flesh Color"){
                                            $flesh_color = @$rel->productSpecValueRel->value;
                                        }
                                        if($rel->productSpecRel->type_name == "Size"){
                                            $Size = @$rel->value; 
                                        }
                                    }
                                }
                                $html .='<div class="col-xs-12 col-sm-12 col-md-12">
                                
                                    <ul class="stock-card-list">
                                        <li><strong>ID: </strong>';
                                        if(auth()->user()->hasRole('administrator') ){
                                            $html .='<a href="'.@$stock->id.'">'.@$stock->id.'</a>';
                                        }
                                        else{
                                            $html .= $stock->id;
                                        }
                                        $html .='</li>';
                                        $html .='<li><strong>Seller: </strong>';
                                        if(auth()->user()->hasRole('administrator') ){
                                            $html .='<li><strong>Seller: </strong><a href="'.url('admin/auth/user').'/'.@$stock->sellername->user_id.'">'.@$stock->sellername->username.'</a></li>';
                                        }
                                        $html .='</li>
                                        <li><strong>Product: </strong> '. @$stock->productname->name . ' </li>';
                                        if(@$variety){
                                            $html .='<li><strong>Variety: </strong> '. $variety  .'</li>';
                                        }
                                        else{
                                            $html .='<li><strong>Variety: </strong> "N/A"</li>';
                                        }
                                        if(@$flesh_color){
                                            $html .='<li><strong>Flesh Color: </strong> '. $flesh_color  .'</li>';
                                        }
                                        else{
                                            $html .='<li><strong>Variety: </strong> "N/A"</li>';
                                        }

                                        if(@$quality){
                                            $html .='<li><strong>Quality: </strong> '. $quality  .'</li>';
                                        }
                                        else{
                                            $html .='<li><strong>Quality: </strong> "N/A"</li>';
                                        }

                                        $html .='<li><strong>Size: </strong> '.@$Size.' </li>
                                                <li><strong>Price: </strong> '. currency($stock->price) .'</li>';
                                        $html .='<li><strong>Packing: </strong>'.@$packing.'</li>';            
                                    $html .='</ul>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-muted">
                            <button type="button" class="btn btn-edit stock-edit-btn" data-id="'.$stock->id .'"><i class="fas fa-edit" ></i></button>
                            <button type="button" data-toggle="tooltip" class="pull-right btn btn-danger deleteItem" data-id="'.$stock->id.'" data-original-title="Delete"><i class="fas fa-trash-alt" ></i></button>
                        </div>

                    </div>
                </div>';
               array_push($cards, $html); 
               $last_id = $stock->id;
              }
            }
          $data['cards']= $cards;
          $data['last_id']= $last_id;
          return $data;
    }




    public function getStock(Request $request){
        
        $stock_id = $request->get('stock_id');
        $dataObj = Stock::with('productname', 'sellername','offerPropertyRel','offerPropertyRel.productSpecRel','offerPropertyRel.productSpecValueRel')
            ->select('id','seller_id','product_id','price','size_from','size_to','stock_status','country','postalcode','price_currency','image');
        $dataObj->where('id',$stock_id);
        $data = $dataObj->first()->toArray();
        $output = [];
        $output['product_id'] = $data['product_id'];
        $output['price'] = $data['price'];
        $output['stock_status'] = $data['stock_status'];
        $output['price_currency'] = $data['price_currency'];
        $output['country'] = $data['country'];
        $output['postalcode'] = $data['postalcode'];
        $output['image'] = json_decode(@$data['image']);
        
        foreach($data['offer_property_rel'] as $relation){
            if($relation['product_spec_rel']['type_name'] == 'Size'){
                $exploded = explode('-',$relation['value']);
                $output['Size_From'] = $exploded[0];
                $output['Size_To'] = $exploded[1];
            } else if($relation['product_spec_rel']['type_name'] == 'Variety'){
                $output['Variety'] = $relation['product_spec_value_rel']['id'];
            } else if($relation['product_spec_rel']['type_name'] == 'Soil'){
                $output['Soil'] = $relation['product_spec_value_rel']['id'];
            } else if($relation['product_spec_rel']['type_name'] == 'Color'){
                $output['Color'] = $relation['product_spec_value_rel']['id'];
            } else if($relation['product_spec_rel']['type_name'] == 'Purpose'){
                $output['Purpose'][] = $relation['product_spec_value_rel']['id'];
            } else if($relation['product_spec_rel']['type_name'] == 'Quality'){
                $output['Quality'] = $relation['product_spec_value_rel']['id'];
            } else if($relation['product_spec_rel']['type_name'] == 'Defects'){
                $output['Defects'][] = $relation['product_spec_value_rel']['id'];
            } else if($relation['product_spec_rel']['type_name'] == 'Packing'){
                $output['Packing'][] = $relation['product_spec_value_rel']['id'];
                $output['Packing_ecs'][$relation['product_spec_value_rel']['id']] = $relation['ecs'];
             } else if($relation['product_spec_rel']['type_name'] == 'MarketProcessing'){
                $output['MarketProcessing'] = $relation['product_spec_value_rel']['id'];    
            } else  {
                $output[@$relation['product_spec_value_rel']['type_name']] = $relation['product_spec_value_rel']['id'];
            }
        }
        return response()->json($output);
    }
    

}
