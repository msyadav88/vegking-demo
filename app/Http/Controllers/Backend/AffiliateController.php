<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Affiliate;
use DataTables;
use Illuminate\Http\Request;

class AffiliateController extends Controller {
	public function index(Request $request){
		if ($request->ajax()) {
			$data =  Affiliate::select('affiliate_data.*', 'users.id as u_id','users.first_name','users.last_name')
							->join('users', 'users.id', '=', 'affiliate_data.u_id')
							->get();
						   
			return Datatables::of($data)
			  ->addIndexColumn()
			  ->addColumn('name', function($row){
					$name = $row->first_name.' '.$row->last_name;
					return $name;
				})
			  
			  ->rawColumns(['name'])   
			  ->make(true);
        } 
		return view('backend.affiliate.index');
    }
}    