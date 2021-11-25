<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Routepricemodel;
use App\Region;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class RoutepriceController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $routeprices = Routepricemodel::get();
            return Datatables::of($routeprices)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = ' <div class="btn-group btn-group-sm">';
                    $btn .= '<button type="button" class="btn btn-edit editItem" data-url="'.route('admin.routeprices.edit', $row->id).'"><i class="fas fa-edit"></i></button>';
                    $btn .= '<button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>';
                    $btn .= '</div>';
                    return $btn;
                })
                 ->rawColumns(['action'])
                 ->make(true);
        }
        return view('backend.routeprice.index');
    }
  
    public function show(){
        
    }

    public function viewall(){
    	
    }

    public function create()
    {
        $region = Region::get();
    	return view('backend.routeprice.create',compact('region'));
    }

    public function store(Request $request)
    {
    	$from = $request->input('from');
        $to = $request->input('to');
        $kms = $request->input('kms');
        $price = $request->input('price');
        $from_region_id = $request->input('from_region');
        $to_region_id = $request->input('to_region');
        $validation = Validator::make($request->all(), [
            'from' => 'required',
            'to' => 'required',
            'kms' => 'required|integer',
            'price' => 'required|integer',
        ]);

        if($validation->fails()){
        	return response()->json(['status' => 'error', 'message' => 'Somethig went wrong!']);	 
        }
                	
        $routeprice = new Routepricemodel();
        $routeprice->from = $from;
        $routeprice->to = $to;
        $routeprice->kms = $kms;
        $routeprice->price = $price;
        $routeprice->from_region_id = $from_region_id;
        $routeprice->to_region_id = $to_region_id;
        $routeprice->save();

        return response()->json(['status' => 'success', 'message' => 'Route Price created successfully!']);
    }

    public function edit(Request $request, $id)
    {
        $routeprice = Routepricemodel::with('from_region','to_region')->where(['id' => $id])->first();
        $region = Region::get();
	    if($routeprice){
	    	return view('backend.routeprice.edit',compact('routeprice','region'));
	    }else{
	        $msg="Route Price is not exist!";
	        return view('backend.routeprice.showallrouteprice', compact('msg'));
	    } 
    }

    public function update(Request $request, $id)
    {    	
    
    	$validation = Validator::make($request->all(), [
            'from' => 'required',
            'to' => 'required',
            'kms' => 'required',
            'from_region' => 'required',
            'to_region' => 'required',
            'price' => 'required|integer',
        ]);

        if($validation->fails()){
        	return response()->json(['status' => 'error', 'message' => 'Somethig went wrong!']);	 
        }

        $routeprice = Routepricemodel::find($id);
        $routeprice->from = $request->input('from');
        $routeprice->to = $request->input('to');
        $routeprice->from_region_id = $request->input('from_region');
        $routeprice->to_region_id = $request->input('to_region');
        $routeprice->kms = $request->input('kms');
        $routeprice->price = $request->input('price');
        $routeprice->save();

        return response()->json(['status' => 'success', 'message' => 'Route Price updated successfully!']);
    }

    public function destroy(Request $request, $id)
    {
    	$routeprice = Routepricemodel::findorfail($id);
    	$routeprice->delete();

    	return response()->json(['success'=>'Route Price record deleted successfully.']);
    }

    public function view(Request $request, $id)
    {
    	$routeprice = Routepricemodel::where(['id' => $id])->first();
	    if($routeprice){
	    	return view('backend.routeprice.view',compact('routeprice'));
	    }else{
	        $msg="Route Price is not exist!";
	        return view('backend.routeprice.showallrouteprice', compact('msg'));
	    }
    }
}
