<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transportprice;
use App\Region;
use DataTables;
use Illuminate\Support\Facades\Validator;

class TransportpriceController extends Controller
{
    public function index(Request $request)
    {
    	if ($request->ajax()) {
            $transportprice = Transportprice::with('region')->get();
            return Datatables::of($transportprice)
                ->addIndexColumn()
                ->addColumn('region', function($row){
                    $region = $row->region->region_name;
                    return $region;
                })
                ->addColumn('action', function($row){
                    $btn = ' <div class="btn-group btn-group-sm">';
                    $btn .= '<button type="button" class="btn btn-primary viewItem" data-url="'.route('admin.transportprice.view', $row->id).'"><i class="fas fa-eye"></i></button>';
                    $btn .= '<button type="button" class="btn btn-edit editItem" data-url="'.route('admin.transportprice.edit', $row->id).'"><i class="fas fa-edit"></i></button>';
                    $btn .= '<button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['region','action'])
                ->make(true);
        }
        return view('backend.transportprice.index');
    }

    public function show()
    {    	
        $transportprice = Transportprice::with('region')->get();
    	return view('backend.transportprice.showallrecords', compact('transportprice'));
    }

    public function create()
    {
        $region = Region::get();
    	return view('backend.transportprice.create',compact('region'));
    }

    public function store(Request $request)
    {
    	$country = $request->input('country');
        $pricePerKm = $request->input('pricePerKm');
        $region = $request->input('region');
        $validation = Validator::make($request->all(), [
            'country' => 'required',
            'region' => 'required',
            'pricePerKm' => 'required|integer',
        ]);

        if($validation->fails()){
        	return response()->json(['status' => 'error', 'message' => 'Somethig went wrong!']);	 
        }
                	
        $tra_price = new Transportprice();
        $tra_price->country = $country;
        $tra_price->region_id = $region;
        $tra_price->pricePerKm = $pricePerKm;
        $tra_price->save();

        return response()->json(['status' => 'success', 'message' => 'Transport country price created successfully!']);
    }

    public function edit(Request $request, $id)
    {
        $tran_price = Transportprice::with('region')->where(['id' => $id])->first();
        $region = Region::get();
	    if($tran_price){
	    	return view('backend.transportprice.edit',compact('tran_price','region'));
	    }else{
	        $msg="Transport country price is not exist!";
	        return view('backend.transportprice.showallrecords', compact('msg'));
	    } 
    }

    public function update(Request $request, $id)
    {    	
    	$country = $request->input('country');
        $pricePerKm = $request->input('pricePerKm');
        $region = $request->input('region');

        $validation = Validator::make($request->all(), [
            'country' => 'required',
            'pricePerKm' => 'required|integer',
        ]);

        if($validation->fails()){
        	return response()->json(['status' => 'error', 'message' => 'Somethig went wrong!']);	 
        }

        $tra_price = Transportprice::find($id);
        $tra_price->country = $country;
        $tra_price->region_id = $region;
        $tra_price->pricePerKm = $pricePerKm;
        $tra_price->save();

        return response()->json(['status' => 'success', 'message' => 'Transport price updated successfully!']);
    }

    public function destroy(Request $request, $id)
    {
    	$tra_price = Transportprice::findorfail($id);
    	$tra_price->delete();

    	return response()->json(['success'=>'Transport price record deleted successfully.']);
    }

    public function view(Request $request, $id)
    {
    	$tran_price = Transportprice::where(['id' => $id])->first();
	    if($tran_price){
	    	return view('backend.transportprice.view',compact('tran_price'));
	    }else{
	        $msg="Transport country price is not exist!";
	        return view('backend.transportprice.showallrecords', compact('msg'));
	    }
    }
}
