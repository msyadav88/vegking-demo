<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AppHead;
use App\Buyer;
use App\BuyerProductPref;
use App\ProductSpecification;
use App\ProductSpecificationValue;
use App\BuyerPref;
use App\Product;
use App\Models\Auth\User;
use DataTables;
use DB;
use View;
use App\Exports\ProductspecsvaluesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class ProductspecvaluesController extends Controller{
    function __construct(){
        $this->middleware('permission:view product spec values', ['only' => ['index']]);
        $this->middleware('permission:add product spec values', ['only' => ['create','store']]);
        $this->middleware('permission:edit product spec values', ['only' => ['edit','update']]);
        $this->middleware('permission:delete product spec values', ['only' => ['destroy']]);
        $this->middleware('permission:export product spec values', ['only' => ['productspecvaluesexports']]);
    }
    public function index(Request $request){
        $products = Product::all()->where('status', '1')->pluck('name', 'id');
        // $ProductSpecificationList = ProductSpecification::with('product','parent_spec')->get();
        $product_list_main = [];
        if(isset($request->product_id) && !empty($request->product_id)){
            $product_list_main = ProductSpecification::where('reference_id', NULL)->where('product_id', $request->product_id);
            if(isset($request->typename) && !empty($request->typename)){
                $product_specval = ProductSpecification::where('display_name', $_GET['typename'])->where('product_id', $request->product_id)->where('reference_id', NULL)->first();
                $data = ProductSpecificationValue::with('product','product_specification','children')->where('product_id',$request->product_id)->where('product_specification_id', $product_specval->id);
            }else{
                $data = ProductSpecificationValue::with('product','product_specification','children')->where('product_id',$request->product_id);
            }
        }else{
            $data = ProductSpecificationValue::select('product_specification_values.*')->with('product','product_specification','children');
        }
        DB::connection()->enableQueryLog();

        if($request->has('columns')){
            $columns = $request->get('columns');
            $searchColumns = [];
            foreach($columns as $column){
                $searchColumns[$column['name']] = $column['search']['value'];
            }
            if (isset($searchColumns['product_name'])) {
                $data->leftJoin('products', function($leftJoin)use($searchColumns)
                {
                    $leftJoin->on('products.id', '=', 'product_specification_values.product_id');
                })->where('products.name', DB::raw('LIKE'),DB::raw("'%".$searchColumns['product_name']."%'"));;
            }
            if (isset($searchColumns['product_spec'])) {
                $data->leftJoin('product_specifications', function($leftJoin)use($searchColumns)
                {
                    $leftJoin->on('product_specifications.id', '=', 'product_specification_values.product_specification_id');
                })->where('product_specifications.display_name', DB::raw('LIKE'),DB::raw("'%".$searchColumns['product_spec']."%'"));;
            }
        }
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                   $view = View::make('backend.includes.action_button', [ 'row' => $row,
                            'show_url' => route('admin.productspecvalues.show', $row->id),
                            'show_permission' => 'view product spec values',
                            'edit_url' => route('admin.productspecvalues.edit', $row->id),
                            'edit_permission' => 'edit product spec values',
                            'delete_permission' => 'delete product spec values'
                            ]);
                    $btn = $view->render();        
                    return $btn;
                })
                ->addColumn('product_spec', function($row){
                    return (@$row->product_specification->display_name?@$row->product_specification->display_name:'-');
                })
                ->addColumn('product_name', function($row){
                    return (@$row->product->name?@$row->product->name:'-');
                })
                ->addColumn('status', function($row){
                   if($row->status == '1'){
                    return 'Active';
                   }else{
                    return 'Inactive';
                   }
                })
                ->rawColumns(['action','value'])
                ->make(true);
        }
        if(!empty($product_list_main)){
            $product_list_main = $product_list_main->get();
        }
        return view('backend.productspecvalues.index',compact('product_list_main','data','products'));
    }
    
    public function create(){
        
        $product_list = Product::all()->pluck('name','id');
        $productspecification_list = ProductSpecification::with('children')->where('parent_id',null)->get();
        $productSpecRel = array();
        $product_specification_children = [];
        foreach($productspecification_list as $spec){
            $productSpecRel[$spec->product_id][$spec->id]['name'] = $spec->display_name;
            
            foreach($spec->children as $children){
               $is_found_productspecification = ProductSpecification::with('children')->where([
                    ['reference_id', '!=', NULL],
                ])->get();
                foreach($is_found_productspecification as $dataVal){
                    $productspecification_value = ProductSpecificationValue::with('product','product_specification','children')->where('product_specification_id',$dataVal->reference_id)->get();
                    $productspecification_value['children_id']=$children->id;
                    if($children->display_name==$dataVal->display_name){
                        $productSpecRel[$spec->product_id][$spec->id]['children'][$dataVal->display_name] = $productspecification_value;
                    } else {
                        $productSpecRel[$spec->product_id][$spec->id]['children'][$children->id] = $children->display_name;
                    }  
                }
            }
        }
        // dd($is_found_productspecification->display_name);
        // $productSpecReljson = json_encode($productSpecRel);
        // echo "<pre/>"; print_r($productSpecRel);
        // echo "<pre/>"; print_r($productSpecRel); die;
        return view('backend.productspecvalues.add-edit',compact('product_list','productSpecRel','product_specification_children'));
    }

    public function store(Request $request){
        /*echo "<pre/>";
        print_r($request->all());
        die;*/
        $request->validate([
          'product_id' => 'required',
          'product_specification_id' => 'required',
          'value' => 'required',
          'related_spec_id' =>'numeric|nullable',
          'related_spec_val_id' =>'numeric|nullable'
        ]);
        $image_name = '';
        if($request->file('image')){
            $image = $request->file('image');
            $image_name = time().'_1.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/productspec/');
            $image->move($destinationPath, $image_name);
        }
        $all = $request->all();
        foreach($all['tags'] as $tag)
        {
            $tags[] = $tag;
        }
        $tagsstring = implode(',',$tags);
        $tableArray = array();
        $tableArray['product_id']  = $all['product_id'];
        $tableArray['product_specification_id']  = $all['product_specification_id'];
        $tableArray['value']  = $all['value'];
        $tableArray['premium']  = $all['premium'];
        $tableArray['volume']  = $all['volume'];
        $tableArray['default']  = @$all['default'];
        $tableArray['status']  = $all['status'];
        $tableArray['description']  = $all['description'];
        $tableArray['parent_id']  = @$all['parent_id'];
        $tableArray['image']  = $image_name;
        $tableArray['extra_cost_to_buyer_factor']  = $all['extra_cost_to_buyer_factor'];
        $tableArray['related_spec_id']  = $all['related_spec_id'];
        $tableArray['related_spec_val_id']  = $all['related_spec_val_id'];
        $tableArray['tags']  = $tagsstring;
        $tableArray['shortcode']  = $all['shortcode'];
        
        
        //echo "<pre/>"; print_r($all); die;
		if(isset($all['enable_extra_supply_cost']) && $all['enable_extra_supply_cost'] == 1){
            $tableArray['extra_supply_cost'] = @$all['extra_supply_cost'];
        } else {
            $tableArray['extra_supply_cost'] = NULL;
        }
        $tableArray['ec']  = $all['ec'];
        $tableArray['ecbf']  = $all['ecbf'];
		$ProductSpecificationValue = ProductSpecificationValue::create($tableArray);
        $parent_id = $ProductSpecificationValue->id;
		if(isset($all['child_items'])){
			foreach($all['child_items'] as $child_key=>$child_item){
				if($child_item != ''){
                    $tableArray = array();
					$tableArray['product_id']  = $all['product_id'];
					$tableArray['product_specification_id']  = $child_key;
					$tableArray['value']  = $child_item;
					$tableArray['parent_id']  = $parent_id;
					$ProductSpecificationValueChild = ProductSpecificationValue::create($tableArray);
				}
			}
		}

     
        $mytableArray = array();
        foreach ( $request->all('childs') as $childs )
        {
            if(count($childs)>=0){
                foreach($childs as $child){
                    if($child['name'] != ''){
                        $image_name = '';
                        if(!empty($child['image'])){    
                            $image = @$child['image'];
                            $image_name = time().'_1.'.$image->getClientOriginalExtension();
                            $destinationPath = public_path('images/productspec/');
                            $image->move($destinationPath, $image_name);
                        }
                        $mytableArray['parent_id']     =  $ProductSpecificationValue->id;
                        $mytableArray['product_id']  = $all['product_id'];
                        $mytableArray['product_specification_id']  = $all['product_specification_id'];
                        $mytableArray['value']         =  $child['name'];
                        $mytableArray['numeric_value'] =  $child['numeric_value'];
                        $mytableArray['image']         = $image_name;
                        ProductSpecificationValue::create($mytableArray);
                    }
                }    
                  
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Product specification value created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductSpecificationValue  $productspecvalue
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $productspecvalue = ProductSpecificationValue::where(['id' => $id])->first();
        if($productspecvalue){
            $product = $productspecvalue->product()->first();
        return view('backend.productspecvalues.show',compact('productspecvalue','product'));
         }else{
            $products = Product::all()->where('status', '1')->pluck('name', 'id');
            $ProductSpecificationList = ProductSpecification::with('product','parent_spec')->get();
            $product_list_main = [];
            if(isset($request->product_id) && !empty($request->product_id)){
                $product_list_main = ProductSpecification::where('reference_id', NULL)->where('product_id', $request->product_id)->get();
                if(isset($request->typename) && !empty($request->typename)){
                    $product_specval = ProductSpecification::where('display_name', $_GET['typename'])->where('reference_id', NULL)->first();
                    $data = ProductSpecificationValue::with('product','product_specification','children')->where('product_id',$request->product_id)->where('product_specification_id', $product_specval->id)->get();
                }else{
                    $data = ProductSpecificationValue::with('product','product_specification','children')->where('product_id',$request->product_id)->get();
                }
            }else{
                $data = ProductSpecificationValue::with('product','product_specification','children')->get();
            }
           $msg="Unfortunately this Product Specification Value is not exist!";
           return view('backend.productspecvalues.index',compact('msg','product_list_main','data','products'));
         } 
      }
    public function edit($id){
            $productspecvalue = ProductSpecificationValue::where(['id' => $id])->first();
        //echo "<pre>";
        //print_r($productspecvalue);
        //echo "</pre>";
       // die;

        $productschildvalue = ProductSpecificationValue::where(['parent_id' => $productspecvalue['id']])->get();

        //echo "<pre/>"; print_r($productschildvalue); die;

        if($productspecvalue){
            $type = $productspecvalue->name;
            $product_specification_id = $productspecvalue->product_specification_id;
            $product_specification_childrens = $productspecvalue->children()->get();
            $product_specification_children = array();
            foreach($product_specification_childrens as $child){
                $product_specification_children[$child->product_specification_id] = $child->value;
            }
            //echo "<pre/>"; print_r($product_specification_children); die;
            $product_list = Product::all()->pluck('name','id');
            $productspecification_list = ProductSpecification::with('children')->where('parent_id',null)->get();
            $productSpecRel = array();
            foreach($productspecification_list as $spec){
                $productSpecRel[$spec->product_id][$spec->id]['name'] = $spec->display_name;
                foreach($spec->children as $children){
                   $is_found_productspecification = ProductSpecification::with('children')->where([
                        ['reference_id', '!=', NULL],
                    ])->get();
                    foreach($is_found_productspecification as $dataVal){
                        $productspecification_value = ProductSpecificationValue::with('product','product_specification','children')->where('product_specification_id',$dataVal->reference_id)->get();
                        $productspecification_value['children_id']=$children->id;
                        if($children->display_name==$dataVal->display_name){
                            $productSpecRel[$spec->product_id][$spec->id]['children'][$dataVal->display_name] = $productspecification_value;
                        } else {
                            $productSpecRel[$spec->product_id][$spec->id]['children'][$children->id] = $children->display_name;
                        }
                    }
                }
            }
            // echo "<pre/>"; print_r($productschildvalue); die;
            return view('backend.productspecvalues.add-edit',compact('productspecvalue','product_list','productSpecRel','product_specification_children','productschildvalue'));
         }else{
            $products = Product::all()->where('status', '1')->pluck('name', 'id');
            $ProductSpecificationList = ProductSpecification::with('product','parent_spec')->get();
            $product_list_main = [];
            if(isset($request->product_id) && !empty($request->product_id)){
                $product_list_main = ProductSpecification::where('reference_id', NULL)->where('product_id', $request->product_id)->get();
                if(isset($request->typename) && !empty($request->typename)){
                    $product_specval = ProductSpecification::where('display_name', $_GET['typename'])->where('reference_id', NULL)->first();
                    $data = ProductSpecificationValue::with('product','product_specification','children')->where('product_id',$request->product_id)->where('product_specification_id', $product_specval->id)->get();
                }else{
                    $data = ProductSpecificationValue::with('product','product_specification','children')->where('product_id',$request->product_id)->get();
                }
            }else{
                $data = ProductSpecificationValue::with('product','product_specification','children')->get();
            }
          $msg="Unfortunately this Product Specification Value is not exist!";
          return view('backend.productspecvalues.index',compact('msg','product_list_main','data','products'));
         } 
      }
    public function update(Request $request, ProductSpecificationValue $productspecvalue){       
        $request->validate([
          'product_id' => 'required',
          'product_specification_id' => 'required',
          'value' => 'required'
        ]);
        $all = $request->all();
        
        $image_name = $productspecvalue->image;
        if($request->file('image')){
            $image = $request->file('image');
            $image_name = time().'_1.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/productspec/');
            $image->move($destinationPath, $image_name);
        }
        
        $all = $request->all();
        if(isset($all['tags'])){
            $tagsstring = implode(',',$all['tags']);
        } else {
            $tagsstring = '';
        }
        $productspecvalue->product_id  = $all['product_id'];
        $productspecvalue->product_specification_id  = $all['product_specification_id'];
        $productspecvalue->premium  = $all['premium'];
        $productspecvalue->volume  = $all['volume'];
        $productspecvalue->default  = @$all['default'];
        $productspecvalue->status  = @$all['status'];
        $productspecvalue->value  = $all['value'];
        $productspecvalue->extra_supply_cost  = @$all['extra_supply_cost'];
        $productspecvalue->extra_cost_to_buyer_factor  = @$all['extra_cost_to_buyer_factor'];
        $productspecvalue->ec  = $all['ec'];
        $productspecvalue->ecbf  = $all['ecbf'];
        $productspecvalue->image  = $image_name;
        $productspecvalue->related_spec_id  = $all['related_spec_id'];
        $productspecvalue->related_spec_val_id  = $all['related_spec_val_id'];
        $productspecvalue->tags  = $tagsstring;
        $productspecvalue->shortcode  = $all['shortcode'];
        
        $productspecvalue->save();
        $parent_id = $productspecvalue->id;
		if(isset($all['child_items'])){
			foreach($all['child_items'] as $child_key=>$child_item){
				if($child_item != ''){
					$tableArray = array();
					$tableArray['product_id']  = $all['product_id'];
					$tableArray['product_specification_id']  = $child_key;
					$tableArray['value']  = $child_item;
					$tableArray['parent_id']  = $parent_id;
					//$ProductSpecificationValueChild = ProductSpecificationValue::create($tableArray);
				}
			}
		} 
        
       /*foreach($all['childs'] as $key => $value)
        {
            //print_r($value);

            //print_r($value['numeric_value']);
            

            if(!empty($value['id'])){

                 //echo "uner amin if";
                 if(isset($value['image'])){

                    $image = $value['image'];
                    $image_name = time().'_1.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('images/productspec/');
                    $image->move($destinationPath, $image_name);
                    $ProductSpecificationValue = ProductSpecificationValue::find($value['id']);
                    $ProductSpecificationValue->value = $value['name'];
                    $ProductSpecificationValue->numeric_value = $value['numeric_value'];
                    $ProductSpecificationValue->image = $image_name;
                    $ProductSpecificationValue->save();

                } else {

                    $ProductSpecificationValue = ProductSpecificationValue::find($value['id']);
                    $ProductSpecificationValue->value = $value['name'];
                    $ProductSpecificationValue->numeric_value = $value['numeric_value'];
                    $ProductSpecificationValue->save();

                }
            }
            else{
                //echo "<pre/>"; print_r($request->all());
                ProductSpecificationValue::create($request->all());
            }    

        }*/
        return response()->json(['status' => 'success', 'success'=>'Product specification value updated successfully.']);
    }

    public function destroy(ProductSpecificationValue $productspecvalue){
        $productspecvalue->delete();
        return response()->json(['success'=>'Productspecvalue deleted successfully.']);
    }
    public function productspecvaluesexports(Request $request) 
    {
        if(isset($request->product_id) && !empty($request->product_id)){
            if(isset($request->typename) && !empty($request->typename)){
                $product_specval = ProductSpecification::where('display_name', $_GET['typename'])->where('reference_id', NULL)->first();
                $data = ProductSpecificationValue::with('product','product_specification','children')->where('product_id',$request->product_id)->where('product_specification_id', $product_specval->id)->get();
            }else{
                $data = ProductSpecificationValue::with('product','product_specification','children')->where('product_id',$request->product_id)->get();
            }
        }else{
            $data = ProductSpecificationValue::with('product','product_specification','children')->get();
        }
        return Excel::download(new ProductspecsvaluesExport($data), 'productspecificationvalues.xlsx');
    }

}
