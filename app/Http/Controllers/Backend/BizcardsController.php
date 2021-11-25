<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Bizcards;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Carbon\Carbon;
class BizcardsController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data =  Bizcards::orderBy('id','desc')->take(1000);

            if(isset($request->from_date) && !empty($request->from_date)){
                $from_date = $data->whereRaw('date(created_at) >= "'.date('Y-m-d', strtotime($request->from_date)).'"');
            }
            if(isset($request->to_date) && !empty($request->to_date)){
                $to_date   = $data->whereRaw('date(created_at) <= "'.date('Y-m-d', strtotime($request->to_date)).'"');
                // $data = $data->whereBetween('created_at', [$from_date, $to_date])->get();
            $data = $data->get();}
            
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

            ->addColumn('image', function($row){
                return '<a href="'.asset('images/businesscards/').'/'.$row->biz_card_image.'" data-fancybox data-caption="'.$row->id.'"><img src="'.asset('images/businesscards/').'/'.$row->biz_card_image.'" style="width:50%;" class="mb-2 img-thumbnail" /></a>';
                
            })
            
            ->addColumn('status', function($row){
                if($row->status == 1){
                    $status = 'Active';
                }else{
                    $status = 'Inactive';
                }
                return $status;
            })
            ->addColumn('created_at', function($row){
                return date("M-j-Y h:i:s A",strtotime($row->created_at));
            })  
            ->rawColumns(['user_id', 'image', 'status'])
            ->make(true);
        }
    
        return view('backend.bizcards.index');
    }
 

}    