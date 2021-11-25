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
use View;
use App\Exports\ProductspecsExport;
use Maatwebsite\Excel\Facades\Excel;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProductspecsController extends Controller{
    
    protected $roles;
    
    function __construct(){
        $this->middleware('permission:view product spec', ['only' => ['index']]);
        $this->middleware('permission:add product spec', ['only' => ['create','store']]);
        $this->middleware('permission:edit product spec', ['only' => ['edit','update']]);
        $this->middleware('permission:delete product spec', ['only' => ['destroy']]);
        $this->middleware('permission:export product spec', ['only' => ['productspecexports']]);
    }
  
    public function index(Request $request){
        
        if ($request->ajax()) {
            $data = ProductSpecification::with('product','parent_spec');
            if($request->has('columns')){
                $columns = $request->get('columns');
                $searchColumns = [];
                foreach($columns as $column){
                    $searchColumns[$column['name']] = $column['search']['value'];
                }
                if (isset($searchColumns['product_name'])) {
                    $data->leftJoin('products', function($leftJoin)use($searchColumns)
                    {
                        $leftJoin->on('products.id', '=', 'product_specifications.product_id');
                    })->where('products.name', DB::raw('LIKE'),DB::raw("'%".$searchColumns['product_name']."%'"));;
                }
            }
            $data = ProductSpecification::with('product','parent_spec')->get();
            //echo "<pre/>"; print_r($data); die;
              return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $view = View::make('backend.includes.action_button', [ 'row' => $row,
                            'show_url' => route('admin.productspecs.show', $row->id),
                            'show_permission' => 'view product spec',
                            'edit_url' => route('admin.productspecs.edit', $row->id),
                            'edit_permission' => 'edit product spec',
                            'delete_permission' => 'delete product spec'
                            ]);
                        $btn = $view->render();
                        return $btn;
                    })
                    ->addColumn('display_name', function($row){
                        return (@$row->parent_spec->display_name?@$row->parent_spec->display_name.":":'').(@$row->display_name?@$row->display_name:'-');
					})
                    ->addColumn('product_name', function($row){
						return (@$row->product->name?@$row->product->name:'-');
					})
                    ->addColumn('default_val', function($row){
						return (@$row->default_val->name?@$row->default_val->name:'-');
					})
					->addColumn('null', function($row){
						return ' ';
					})
                    ->rawColumns(['action','field','display_name','importance','order','hasmany','required'])
                    ->make(true);
        }
        return view('backend.productspecs.index');
    }


    public function getAppHeadValues(Request $request){
          
        $type = $request->get('type');
        $lists = \App\AppHead::orderBy('order','asc')->where('is_active', '1')->where('type', $type)->where('product_id',$request->product_id)->pluck('name', 'id');
        
         //values
        $values = '<option value="">Select Default Value</option>';
        if (count($lists) > 0){
          foreach ($lists as $key => $value) {
              $values .= '<option value="'.$key.'">'.$value.'</option>';
          }
        }
        
        return $values;
    }
    
    public function create(){
        $product_list = Product::all()->pluck('name','id');
        $productspecification_list = ProductSpecification::all();
        $productSpecRel = array();
        foreach($productspecification_list as $spec){
            $productSpecRel[$spec->id] = $spec->display_name;
        }
        $field_types = array('dropdown_switchboxes'=>'Dropdown/Switch Boxes','inputfield'=>'Input Field','optionrange'=>'Option Range','sizerange'=>'Size Range','checkboxes'=>'Checkboxes');
        return view('backend.productspecs.add-edit',compact('product_list','productSpecRel','field_types'));
    }

    public function store(Request $request){
       
        $request->validate([
          'product_id' => 'required',
          'display_name' => 'required',
          'type_name'   => 'required',
          'field_type'   => 'required',
          'importance' => 'integer|nullable',
          'order' => 'integer|nullable',
          'parent_id' => 'integer|nullable',
        ]);
        $tags = array();
        $all = $request->all();
        
        if(isset($all['tags'])){
            $tagsstring = implode(',',$all['tags']);
        } else {
            $tagsstring = '';
        }
       
        $tableArray = array();
        $tableArray['product_id']  = $all['product_id'];
        $tableArray['type_name']   = $all['type_name'];
        $tableArray['display_name']  = $all['display_name'];
        $tableArray['importance']  = $all['importance'];
        $tableArray['order']  = $all['order'];
        $tableArray['order_for_seller']  = $all['order_for_seller'];
        $tableArray['parent_id']  = @$all['parent_id'];
        $tableArray['reference_id']  = @$all['reference_id'];
        $tableArray['field_type']  = @$all['field_type'];
        $tableArray['required']  = $all['required'];
        $tableArray['buyer_hasmany']  = $all['buyer_hasmany'];
        $tableArray['stock_hasmany']  = $all['stock_hasmany'];
        $tableArray['buyer_pref_anylogic']  = $all['buyer_pref_anylogic'];
        $tableArray['display_in_transport']  = $all['display_in_transport'];
        $tableArray['can_edit']  = $all['can_edit'];
        $tableArray['tags']  = $tagsstring;
        $tableArray['shortcode']  = $all['shortcode'];
        $ProductSpecification = ProductSpecification::create($tableArray);
       
        return response()->json(['status' => 'success', 'message' => 'Product specification created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductSpecification  $productspec
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $productspec = ProductSpecification::where(['id' => $id])->first();
        if($productspec){
            $productspec = ProductSpecification::with('product','parent_spec')->where('id',$productspec->id)->first();
            //echo "<pre/>"; print_r($productspec); die;
            return view('backend.productspecs.show',compact('productspec'));
         }else{
           $msg="Unfortunately this Product Specification is not exist!";
          return view('backend.productspecs.index', compact('msg'));
         } 
      }
      public function edit($id){
        $productspec = ProductSpecification::where(['id' => $id])->first();
        if($productspec){
         $createfrom = 'edit seller';
         $product_list = Product::all()->pluck('name','id');
         $type = $productspec->field;
         $product_id = $productspec->product_id;
         $productspecification_list = ProductSpecification::all();
         $productSpecRel = array();
         foreach($productspecification_list as $spec){
             $productSpecRel[$spec->id] = $spec->display_name;
         }
         $field_types = array('dropdown_switchboxes'=>'Dropdown/Switch Boxes','inputfield'=>'Input Field','optionrange'=>'Option Range','sizerange'=>'Size Range','checkboxes'=>'Checkboxes');
         return view('backend.productspecs.add-edit',compact('productspec','productSpecRel','product_list','field_types'));
         }else{
          $msg="Unfortunately this Product Specification is not exist!";
          return view('backend.productspecs.index',compact('msg'));
         } 
      }
    public function update(Request $request, ProductSpecification $productspec){
       
       //echo "<pre/>";print_r($request->all());die;
        $request->validate([
          'product_id' => 'required',
          'display_name' => 'required',
          'type_name'    =>'required',
          'field_type'   => 'required',
          'importance' => 'integer|nullable',
          'order' => 'integer|nullable',
        ]);
        $all = $request->all(); 
        if(isset($all['tags'])){
            $tagsstring = implode(',',$all['tags']);
        } else {
            $tagsstring = '';
        }
        $productspec->product_id  = $all['product_id'];
        $productspec->display_name  = $all['display_name'];
        $productspec->importance  = $all['importance'];
        $productspec->type_name  = $all['type_name'];
        $productspec->order_for_seller  = $all['order_for_seller'];
        $productspec->order  = $all['order'];
        $productspec->parent_id  = $all['parent_id'];
        $productspec->reference_id  = $all['reference_id'];
        $productspec->field_type  = $all['field_type'];
        $productspec->required  = $all['required'];
        $productspec->buyer_hasmany  = $all['buyer_hasmany'];
        $productspec->stock_hasmany  = $all['stock_hasmany'];
        $productspec->can_edit  = $all['can_edit'];
        $productspec->buyer_pref_anylogic  = $all['buyer_pref_anylogic'];
        $productspec->display_in_transport  = $all['display_in_transport'];
        $productspec->tags=$tagsstring;
        $productspec->shortcode=$all['shortcode'];
        $productspec->save();
        
        return response()->json(['status' => 'success', 'success'=>'Product specification updated successfully.']);
    }

    public function destroy(ProductSpecification $productspec){
       $productspec->delete();
       return response()->json(['success'=>'Order deleted successfully.']);
    }
    public function productspecexports() 
    {
        return Excel::download(new ProductspecsExport, 'productspecification.xlsx');
    }
    public function reorder(Request $request){
        $count = 0;
        if (count($request->json()->all())) {
            $ids = $request->json()->all();
            foreach($ids as $i => $key){
                $id = $key['id'];
                $position = $key['position'];
                $mymodel = ProductSpecification::find($id);
                $mymodel->order = $position;
                if($mymodel->save())
                {
                    $count++;
                }
            }
            $response = 'send response records updated goes here';
            return response()->json( $response );
        } else {
            $response = 'send nothing to sort response goes here';
            return response()->json( $response );
        }
    }
}
