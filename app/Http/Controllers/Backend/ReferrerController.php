<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Referrer;
use DataTables;
use Illuminate\Http\Request;

class ReferrerController extends Controller
{

public function index(Request $request){
    
  if ($request->ajax()) {
        $data =  Referrer::select('referrer.*', 'users.id as u_id','users.first_name','users.last_name')
                        ->join('users', 'users.id', '=', 'referrer.user_id')
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
       return view('backend.referrer.index');
    }

}    