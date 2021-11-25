<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\UserVisits;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Carbon\Carbon;
class UserVisitsController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data =  UserVisits::orderBy('id','desc')->take(1000);

            if(isset($request->from_date) && !empty($request->from_date)){
                $from_date = $data->whereRaw('date(created_at) >= "'.date('Y-m-d', strtotime($request->from_date)).'"');
            }
            if(isset($request->to_date) && !empty($request->to_date)){
                $to_date   = $data->whereRaw('date(created_at) <= "'.date('Y-m-d', strtotime($request->to_date)).'"');
                // $data = $data->whereBetween('created_at', [$from_date, $to_date])->get();
            }
            $data = $data->get();
            return Datatables::of($data)
            ->addIndexColumn()
            
                ->addColumn('user_id', function($row){
                    if($row->user_id != 0){
                        $user_id = '<a href="auth/user/'.$row->user_id.'" target="_blank">'.$row->user_id.'</a>';
                    }else{
                        $user_id = $row->user_id;
                    }
                    return $user_id;
                })
            
            ->addColumn('ip', function($row){
                return $row->ip;
            })
            ->addColumn('country', function($row){
                return $row->country;
            })  
            ->addColumn('thisUrl', function($row){
                return $row->thisUrl;
            })  
            ->addColumn('fromUrl', function($row){
                return $row->fromUrl;
            })  
            ->addColumn('toUrl', function($row){
                return $row->toUrl;
            })  
            ->addColumn('created_at', function($row){
                return date("M-j-Y h:i:s A",strtotime($row->created_at));
            })  
            ->rawColumns(['user_id'])
            ->make(true);
        }
    
        return view('backend.UserIps.uservisits');
    }
 

}    