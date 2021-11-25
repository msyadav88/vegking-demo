<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TransportSeason;
use DataTables;
use Illuminate\Support\Facades\Validator;

class TransportseasonController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $season = TransportSeason::get();
            return Datatables::of($season)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = ' <div class="btn-group btn-group-sm">';
                    $btn .= '<button type="button" class="btn btn-primary viewItem" data-url="'.route('admin.season.view', $row->id).'"><i class="fas fa-eye"></i></button>';
                    $btn .= '<button type="button" class="btn btn-edit editItem" data-url="'.route('admin.season.edit', $row->id).'"><i class="fas fa-edit"></i></button>';
                    $btn .= '<button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.transportseason.index');
    }

    public function show()
    { 

    }

    public function create()
    {
    	return view('backend.transportseason.create');
    }

    public function store(Request $request)
    {
    	$country = $request->input('country');
        $region = $request->input('region');
        $fromTo = $request->input('fromTo');
        $season = $request->input('season');
        $factor = $request->input('factor');

        $validation = Validator::make($request->all(), [
            'country' => 'required',
            'region' => 'required',
            'fromTo' => 'required',
            'season' => 'required',
            'factor' => 'required|integer',
        ]);

        if($validation->fails()){
        	return response()->json(['status' => 'error', 'message' => 'Somethig went wrong!']);	 
        }
                	
        $tra_season = new TransportSeason();
        $tra_season->country = $country;
        $tra_season->region = $region;
        $tra_season->fromTo = $fromTo;
        $tra_season->season = $season;
        $tra_season->factor = $factor;
        $tra_season->save();

        return response()->json(['status' => 'success', 'message' => 'Transport season factor created successfully!']);
    }

    public function edit(Request $request, $id)
    {
    	$season = TransportSeason::where(['id' => $id])->first();
	    if($season){
	    	return view('backend.transportseason.edit',compact('season'));
	    }else{
	        $msg="Route Price is not exist!";
	        return view('backend.transportseason.showallrecords', compact('msg'));
	    } 
    }

     public function update(Request $request, $id)
    {    	
    	$country = $request->input('country');
        $region = $request->input('region');
        $fromTo = $request->input('fromTo');
        $season = $request->input('season');
        $factor = $request->input('factor');
        
    	$validation = Validator::make($request->all(), [
            'country' => 'required',
            'region' => 'required',
            'fromTo' => 'required',
            'season' => 'required',
            'factor' => 'required|integer',
        ]);

        if($validation->fails()){
        	return response()->json(['status' => 'error', 'message' => 'Somethig went wrong!']);	 
        }

        $tra_season = TransportSeason::find($id);
        $tra_season->country = $country;
        $tra_season->region = $region;
        $tra_season->fromTo = $fromTo;
        $tra_season->season = $season;
        $tra_season->factor = $factor;
        $tra_season->save();

        return response()->json(['status' => 'success', 'message' => 'Transport season factor updated successfully!']);
    }

    public function destroy(Request $request, $id)
    {
    	$tra_season = TransportSeason::findorfail($id);
    	$tra_season->delete();

    	return response()->json(['success'=>'Transport season factor record deleted successfully.']);
    }

    public function view(Request $request, $id)
    {
    	$tra_season = TransportSeason::where(['id' => $id])->first();
	    if($tra_season){
	    	return view('backend.transportseason.view',compact('tra_season'));
	    }else{
	        $msg="Transport season factor is not exist!";
	        return view('backend.transportseason.showallrecords', compact('msg'));
	    }
    }
    
}
