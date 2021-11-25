<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Region;
use DataTables;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $region = Region::get();
            return Datatables::of($region)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = ' <div class="btn-group btn-group-sm">';
                    $btn .= '<button type="button" class="btn btn-edit editItem" data-url="'.route('admin.region.edit', $row->id).'"><i class="fas fa-edit"></i></button>';
                    $btn .= '<button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>';
                    $btn .= '</div>';
                    return $btn;
                })
                 ->rawColumns(['action'])
                 ->make(true);
        }
        return view('backend.region.index');
    }
    public function show(){
        $region = Region::get();
    	return view('backend.region.index',compact('region'));
    }
    public function create()
    {
        return view('backend.region.create');
    }
    public function store(Request $request){
        $region_name = $request->input('region_name');
        $validation = Validator::make($request->all(), [
            'region_name' => 'required',
        ]);

        if($validation->fails()){
        	return response()->json(['status' => 'error', 'message' => 'Somethig went wrong!']);	 
        }
        $region = new Region();
        $region->region_name = $region_name;
        $region->save();
        return response()->json(['status' => 'success', 'message' => 'Region created successfully!']);
    }
    public function delete($id){
    $region = Region::findorfail($id);
    $region->delete();
    return response()->json(['success'=>'Region deleted successfully.']);
    }
    public function edit($id)
    {
        $region = Region::where('id',$id)->first();
        return view('backend.region.edit',compact('region'));
    }
    public function update(Request $request,$id){
        $region =Region::find($id);
        $region->region_name = $request->region_name;
        $region->save();
        return response()->json(['status' => 'success', 'message' => 'Region Updated successfully!']);
    }
}