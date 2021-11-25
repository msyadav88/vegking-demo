<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PostalCode;
use DataTables;

class PostalCodeController extends Controller{

    public function __construct()
    {
        $this->middleware('permission:view postal code', ['only' => ['index']]);
        $this->middleware('permission:add postal code', ['only' => ['create','store']]);
        $this->middleware('permission:edit postal code', ['only' => ['edit','update']]);
        $this->middleware('permission:delete postal code', ['only' => ['destroy']]);
    }

    public function index(Request $request){
      if ($request->ajax()) {
            if(isset($request->type) && $request->type == 'country'){
              $data = PostalCode::where('type', $request->type)->get();
            }else{
              $data = PostalCode::where('type', 'city')->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        $btn = ' <div class="btn-group btn-group-sm">';
                        if(auth()->user()->can('edit postal code')){
                            $btn .= ' <button type="button" class="btn btn-edit editItem" data-url="'.route('admin.postalcodes.edit', $row->id).'"><i class="fas fa-edit"></i></button>';
                        }
                        if(auth()->user()->can('delete postal code')){
                            $btn .= '<button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>';
                        }
                        $btn .= '</div>';
                        return $btn;
                })
              ->addColumn('status', function($row){
               if ($row->status == '1') {
                return 'Active';
               }else{
                return 'Inactive';
               }
            })
                ->rawColumns(['action'])
                ->make(true);
      }
      return view('backend.postalcodes.index');
    }

    public function create(){
        return view('backend.postalcodes.create');
    }

    public function store(Request $request){
        $request->validate(['name' => 'required|unique:postal_codes']);
        PostalCode::create($request->all());
     
        return response()->json(['status' => 'success', 'message' => 'Postal Code created successfully.']);
    }

    public function show(PostalCode $postalcode){
        //
    }

    public function edit($id){
      $postalcode = PostalCode::where(['id' => $id])->first();
      if($postalcode){
        return view('backend.postalcodes.edit',compact('postalcode'));
       }else{
        
        $msg="Unfortunately this Postal Code is not exist!";
        return view('backend.postalcodes.index',compact('msg'));
       } 
       
    }

    public function update(Request $request, PostalCode $postalcode){
      if($request->name != $postalcode->name){
        $request->validate(['name' => 'required|unique:postal_codes']);
      }
       $postalcode->update($request->all());
    
       return response()->json(['status' => 'success', 'message' => 'Postal Code undated successfully.']);
    }

    public function destroy(PostalCode $postalcode){
      $postalcode->delete();
      return response()->json(['success'=>'Postal Code deleted successfully.']);
    }
}
