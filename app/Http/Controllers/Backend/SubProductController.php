<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\SubProduct;
use DataTables;
use App\Exports\SubProductExport;
use Maatwebsite\Excel\Facades\Excel;

class SubProductController extends Controller{

    public function __construct()
    {
        $this->middleware('permission:view products', ['only' => ['index']]);
        $this->middleware('permission:add products', ['only' => ['create','store']]);
        $this->middleware('permission:edit products', ['only' => ['edit','update']]);
        $this->middleware('permission:delete products', ['only' => ['destroy']]);
        $this->middleware('permission:export products', ['only' => ['productsexports']]);
    }

    public function index(Request $request){
        if ($request->ajax()) {
            $data = SubProduct::with('product')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function($row){
                return $row->product->name;
            })
            ->addColumn('image', function($row){
                $image = '<a  class="image" ><img src="'.asset('images/subproducts/').'/'.@$row->image.'" data-product="'.@$row->product->name.'" data-type="'.@$row->sub_pro_type.'" onerror=this.src="'.asset('images/products/no_img.png').'" class="mb-2 img-thumbnail list_image" /></a>';
                return $image;
            })
            ->addColumn('status', function($row){
               if($row->status== '1')
                return 'Active';
                else{ return 'Inactive'; }
            })
            ->addColumn('action', function($row){
                $btn = ' <div class="btn-group btn-group-sm">';
                if(auth()->user()->can('edit products')){
                    $btn .= '<button type="button" class="btn btn-edit editItem" data-url="'.route('admin.subproducts.edit', $row->id).'"><i class="fas fa-edit"></i></button>';
                }
                if(auth()->user()->can('delete products')){
                    $btn .= '<button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>';
                }
                $btn .= '</div>';
                return $btn;
            })
            ->rawColumns(['image', 'action'])
            ->make(true);
        }
       return view('backend.subproducts.index');
    }

    public function create(){
        $product_list = Product::all()->pluck('name','id');
        $sub_pro_type_list = array(
            'Num of Heads' => 'Num of Heads',
            'Variety' => 'Variety',
            'Color' => 'Color'
        );
        return view('backend.subproducts.create',compact('product_list', 'sub_pro_type_list'));
    }

    public function store(Request $request){
        //echo "<pre/>"; print_r($request->all()); die;
        $request->validate([
            'product_id' => 'required',
            'sub_pro_name_en' => 'required',
            'sub_pro_name_pl' => 'required',
            'sub_pro_name_de' => 'required',
            'sub_pro_type' => 'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
        ]);

        $image = $request->file('image');
        $name = time().'_1.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('images/subproducts');
        $image->move($destinationPath, $name);

        SubProduct::create([
           'product_id'      => $request->product_id,
           'sub_pro_name_en' => $request->sub_pro_name_en,
           'sub_pro_name_pl' => $request->sub_pro_name_pl,
           'sub_pro_name_de' => $request->sub_pro_name_de,
           'sub_pro_type'    => $request->sub_pro_type,
           'image' => $name,
           'status' => $request->status
        ]);

        return response()->json(['status' => 'success', 'message' => 'Sub Product created successfully.']);
    }

    public function show(Product $product)
    {
        //
    }
    public function edit($id){
        $product = SubProduct::where(['id' => $id])->first();
        $product_list = Product::all()->pluck('name','id');
        $sub_pro_type_list = array(
            'Num of Heads' => 'Num of Heads',
            'Variety' => 'Variety',
            'Color' => 'Color'
        );
        if($product){
            return view('backend.subproducts.edit',compact('product', 'product_list', 'sub_pro_type_list'));
        }
        else
        {
            $msg="Unfortunately this Sub Product is not exist!";
            return view('backend.subproducts.index',compact('msg'));
        } 
    }

    public function update(Request $request, $SubProduct=null){
    //    echo "<pre/>"; print_r($request->all()); die;
       $SubProduct = SubProduct::find($SubProduct);
        if($request->image){
            $request->validate([
                'product_id' => 'required',
                'sub_pro_name_en' => 'required',
                'sub_pro_name_pl' => 'required',
                'sub_pro_name_de' => 'required',
                'image' => 'required',
                'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'status' => 'required'
            ]);
        }else{
            $request->validate([
                'product_id' => 'required',
                'sub_pro_name_en' => 'required',
                'sub_pro_name_pl' => 'required',
                'sub_pro_name_de' => 'required',
                'status' => 'required'
            ]);
        }

        if($request->image){
            $image = $request->file('image');
            $name = time().'_1.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/subproducts');
            $image->move($destinationPath, $name);
            $product_data['image'] = $name;
            if($request->old_image && file_exists( public_path('images/subproducts/'.$request->old_image))){
                unlink(public_path('images/subproducts/'.$request->old_image));
            }
        }

        $product_data['product_id'] = $request->product_id;
        $product_data['sub_pro_name_en'] = $request->sub_pro_name_en;
        $product_data['sub_pro_name_pl'] = $request->sub_pro_name_pl;
        $product_data['sub_pro_name_de'] = $request->sub_pro_name_de;
        $product_data['sub_pro_type'] = $request->sub_pro_type;
        $product_data['status'] = $request->status;

        $SubProduct->update($product_data);
        return response()->json(['status' => 'success', 'message' => 'Sub Product updated successfully.']);
    }

    public function destroy($SubProduct = Null){
        $SubProduct = SubProduct::find($SubProduct);      
        $SubProduct->delete();
        return response()->json(['success'=>'Sub Product deleted successfully.']);
    }
	
    public function subproductsexports()
    {
        return Excel::download(new SubProductExport, 'Subproduct.xlsx');
    }
}