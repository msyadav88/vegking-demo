<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\UserIps;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use App\Models\Auth\UserTracking;
use DataTables;
use DB;
use Carbon\Carbon;
class UserIpsController extends Controller
{

public function index(Request $request){
		
	  if ($request->ajax()) {
        $data =  UserIps::select('userips.*', 'users.id as u_id','users.first_name','users.last_name')
                     ->leftjoin('users', 'users.id', '=', 'userips.userid')
                     ->get();
        return Datatables::of($data)
          ->addIndexColumn()
          ->addColumn('name', function($row){
          	if($row->first_name != ''){
                if(strtoupper($row->didLogin) == 'YES'){
                  $name = '<a href="auth/user/'.$row->u_id.'" target="_blank">'.$row->first_name.' '.$row->last_name.'</a>';
                }else{
                    $name = '<a href="auth/user/'.$row->u_id.'" target="_blank">'.$row->first_name.' '.$row->last_name.'</a>';
                }
          	}else{
          		 $name = 'Guest User';
          	}
                return $name;
            })
          ->addColumn('City', function($row){
                return $row->city;
            })
          ->addColumn('Country', function($row){
                return $row->country;
            })
          ->addColumn('didlogin', function($row){
                if($row->first_name != ''){
                  return ucfirst($row->didlogin);  
                }else{
                  return 'No';
                }
                
            })
            ->addColumn('date', function($row){
              //$time = Carbon::create($row); 
            return date("M-j-Y",strtotime($row->date));
               
           })
         ->addColumn('time', function($row){
               //$time = Carbon::create($row); 
               return date("h:i:s A",strtotime($row->time));
           }) 
          ->rawColumns(['name','city', 'country','time','date'])  
          ->make(true);
        }
    
      return view('backend.UserIps.index');
    }
    public function usertracking(Request $request){
      if ($request->ajax()) {
         DB::enableQueryLog();
         // $data = \App\Buyer::with('user')->get();
         $data =  UserTracking::with('userdata')->orderBy('id','desc')->take(1000);
         if(isset($request->from_date) && !empty($request->from_date)){
           $from_date = $data->whereRaw('date(date_time) >= "'.date('Y-m-d', strtotime($request->from_date)).'"');
         }
         if(isset($request->to_date) && !empty($request->to_date)){
           $to_date   = $data->whereRaw('date(date_time) <= "'.date('Y-m-d', strtotime($request->to_date)).'"');
           // $data = $data->whereBetween('date_time', [$from_date, $to_date])->get();
         }
         $data = $data->get();
         // dd(DB::getQueryLog());
         return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('user_id', function($row){
          $user_id = '<a href="auth/user/'.$row->user_id.'" target="_blank">'.$row->user_id.'</a>';
          // return @$row->userdata->first_name.' '.@$row->userdata->last_name;
          return $user_id;
        })
        ->addColumn('ip', function($row){
          //$time = Carbon::create($row); 
          return $row->ip;
        })
        ->addColumn('date', function($row){
          //$time = Carbon::create($row); 
          return date("M-j-Y h:i:s A",strtotime($row->date_time));
        })  
        ->addColumn('fromUrl', function($row){
          //$time = Carbon::create($row); 
          return $row->fromUrl;
        })  
        ->addColumn('toUrl', function($row){
          //$time = Carbon::create($row); 
          return $row->toUrl;
        })  
        ->rawColumns(['user_id'])
        ->make(true);
      }
    
      return view('backend.UserIps.usertracking');
    }

}    