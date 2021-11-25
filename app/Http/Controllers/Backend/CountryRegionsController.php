<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CountryRegions;
use DataTables;
use Illuminate\Support\Facades\Validator;

class CountryRegionsController extends Controller
{
    public function index(Request $request)
    {
    	if ($request->ajax()) {
            $countryregions = CountryRegions::get();
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
        return view('backend.countryregions.index');
    }

    public function store(Request $request)
    {
    	$country = $request->input('country');
        $region = $request->input('region');
        $validation = Validator::make($request->all(), [
            'country' => 'required',
            'region' => 'required'
        ]);

        if($validation->fails())
        {
        	return response()->json(['status' => 'error', 'message' => 'Somethig went wrong!']);	 
        }
                	
        $cRegions = new CountryRegions();
        $cRegions->country = $country;
        $cRegions->region = $region;
        $cRegions->save();

        return response()->json(['status' => 'success', 'message' => 'Transport country region added successfully!']);
    }

    public function edit(Request $request)
    {
        $countryRegion = CountryRegions::where('id', $request->input('id'))->first();
        if($countryRegion)
        {
            return response()->json($countryRegion);
        }else
        {
	        return response()->json(['status' => 'error', 'message' => 'Transport country region not exist!']);
	    } 
    }

    public function updateData(Request $request)
    {    	
    	$country = $request->input('country');
        $region = $request->input('region');

        $validation = Validator::make($request->all(), [
            'country' => 'required',
            'region' => 'required',
        ]);

        if($validation->fails())
        {
        	return response()->json(['status' => 'error', 'message' => 'Somethig went wrong!']);
        }

        $cRegions = CountryRegions::find($request->input('rec_id'));
        $cRegions->country = $country;
        $cRegions->region = $region;
        $cRegions->save();

        return response()->json(['status' => 'success', 'message' => 'Transport country region updated successfully!']);
    }

    public function delete(Request $request)
    {
    	$cRegions = CountryRegions::findorfail($request->input('id'));
    	$cRegions->delete();

    	return response()->json(['status' => 'success', 'message'=>'Transport country region deleted successfully.']);
    }

}
