<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TransportCosts;
use DataTables;
use Illuminate\Support\Facades\Validator;

class TransportCostsController extends Controller
{
    public function index(Request $request)
    {
    	if ($request->ajax()) {
            $countryregions = TransportCosts::get();
            return Datatables::of($countryregions)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = ' <div class="btn-group btn-group-sm">';
                    $btn .= '<button type="button" class="btn btn-edit editItem" data-url="'. $row->id.'"><i class="fas fa-edit"></i></button>';
                    $btn .= '<button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.transportcosts.index');
    }

    public function store(Request $request)
    {
    	$country = $request->input('country');
        $region = $request->input('region');
        $cost = $request->input('cost');
        $validation = Validator::make($request->all(), [
            'country' => 'required',
            'region' => 'required',
            'cost' => 'required'
        ]);

        if($validation->fails())
        {
        	return response()->json(['status' => 'error', 'message' => 'Somethig went wrong!']);	 
        }
                	
        $cRegions = new TransportCosts();
        $cRegions->country = $country;
        $cRegions->region = $region;
        $cRegions->cost = $cost;
        $cRegions->save();

        return response()->json(['status' => 'success', 'message' => 'Transport cost added successfully!']);
    }

    public function edit(Request $request)
    {
        $transportCost = TransportCosts::where('id', $request->input('id'))->first();
        if($transportCost)
        {
            return response()->json($transportCost);
        }else
        {
	        return response()->json(['status' => 'error', 'message' => 'Transport cost not exist!']);
	    } 
    }

    public function updateData(Request $request)
    {    	
    	$country = $request->input('country');
        $region = $request->input('region');
        $cost = $request->input('cost');

        $validation = Validator::make($request->all(), [
            'country' => 'required',
            'region' => 'required',
            'cost' => 'required'
        ]);

        if($validation->fails())
        {
        	return response()->json(['status' => 'error', 'message' => 'Somethig went wrong!']);
        }

        $cRegions = TransportCosts::find($request->input('rec_id'));
        $cRegions->country = $country;
        $cRegions->region = $region;
        $cRegions->cost = $cost;
        $cRegions->save();

        return response()->json(['status' => 'success', 'message' => 'Transport country region updated successfully!']);
    }

    public function delete(Request $request)
    {
    	$cRegions = TransportCosts::findorfail($request->input('id'));
    	$cRegions->delete();

    	return response()->json(['status' => 'success', 'message'=>'Transport cost deleted successfully.']);
    }

}