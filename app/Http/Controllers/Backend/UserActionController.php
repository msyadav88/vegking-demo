<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\UserAction;
use DataTables;
use App\Models\Auth\User;
use App\Notifications;
use App\Product;
class UserActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = UserAction::with('trader')->get();
            //echo "<pre/>"; print_r($data); die;
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('trader', function($row){
                    $trader = @$row->trader->first_name." ".@$row->trader->last_name;
                    return @$trader;
                })
                ->addColumn('stock_link', function($row){
                    $stock_link = "<a href='".route('admin.stock.show', @$row->stock_id)."'/>".$row->stock_id."</a>";
                    return @$stock_link;
                }) 
                ->addColumn('details', function($row){
                    if(@$row->entity == 'Sale'){
                        $sale_link = "<a href='".route('admin.sales.show', @$row->entity_id)."'/>".$row->entity_id."</a>";
                        $trader = @$row->entity.":".@$sale_link;
                    } else {
                        $trader = @$row->entity.":".@$row->entity_id;
                    }
                    return @$trader;
                    
                })
                ->rawColumns(['stock_link','details'])
                ->make(true);
        }
        return view('backend.user_actions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function editAdmin($admin=null)
    {   
        $buyer = User::where('id',$admin)->first();
        if(isset($buyer))
        {
          if(auth()->user()->id == $buyer->id)
          {
            $notify = Notifications::where('user_id', $buyer->id)->get()->all(); 
            $notifications = [] ;
            if(!empty($notify)){
              foreach ($notify as $not) {
                if($not->key == 'sale_confirmed' ){
                 $notifications['sale_confirmed'] = $not->value;
                }
                if($not->key == 'delivery_update' ){
                 $notifications['delivery_update'] = $not->value;
                }
                if($not->key == 'offers_messages' ){
                 $notifications['offers_messages'] = $not->value;
                }
              }
            }
            $user = auth()->user();
            $products = Product::all()->where('status', '1')->pluck('name', 'id');
            return view('backend.auth.admin.edit',compact('products','buyer', 'notifications'))
                ->withUser($user)
                ->withUserRoles($user->roles->pluck('name')->all())
                ->withUserPermissions($user->permissions->pluck('name')->all());
          }
          else
          {
            return abort(404);
          }
        }
        else
        {
          return abort(404);
        }
    }
    public function updateAdmin(Request $request,$user)
      {

        $user_id = $user;
        $current_date=date("Y-m-d");
        $change_password_flag = false;
        if(!empty($request->old_password) || !empty($request->password) || !empty($request->password_confirmation))
        {
            request()->validate([
                'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'old_password' => 'required',
                'password' => ['required', 'string', 'min:6', 'confirmed'],]);   
            $old_password_validate = User::where('id', $user_id)->select('password')->get()->first(); 
            if(!\Hash::check($request->old_password, $old_password_validate->password)){
                return response()->json(['status' => 'error', 'message' => 'The old password does not match our records.']);
            }
            else{
                $change_password_flag = true;
            }
        }
        else
        {
            request()->validate([
                'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
            ]);    
        }
        
        $email_subscription = 0;
        $whatsapp_subscription = 0;   
        if(isset($request->email_subscription)){
            $email_subscription = $request->email_subscription;   
        }
        if(isset($request->whatsapp_subscription)){
            $whatsapp_subscription = $request->whatsapp_subscription;   
        }

        if($request->username){
            $sol = explode(' ', $request->username, 2);
            if (sizeof($sol)>1) {
                $first_name = $sol[0];
                $last_name = $sol[1];
            }else{
                $first_name=$request->username;
                $last_name=$request->username;
            }
        }
        if($request->gender){
            $update = array(
                'first_name'            =>$first_name,
                'last_name'             =>$last_name, 
                'phone'                 =>$request->phone,
                'gender'                =>$request->gender,
                'email_subscription'    =>$email_subscription,
                'whatsapp_subscription' =>$whatsapp_subscription,
                'whatsapp_number'       =>$request->whatsapp_number

            ); 
        }
        else{
            $update = array(
                'first_name'            =>$first_name,
                'last_name'             =>$last_name,
                'phone'                 =>$request->phone,
                'gender'                =>0,
                'email_subscription'    =>$email_subscription,
                'whatsapp_subscription' =>$whatsapp_subscription,
                'whatsapp_number'       =>$request->whatsapp_number
            );            
        }

        
         $res = User::where('id', $user_id)->update($update);    
         $next_saledate= $next_date=date('Y-m-d', strtotime($current_date. ' + '.$request->sale_confirmed.' days'));
         $next_deliverydate= $next_date=date('Y-m-d', strtotime($current_date. ' + '.$request->delivery_update.' days'));
         $next_offerdate=date('Y-m-d', strtotime($current_date. ' + '.$request->offers_messages.' days'));
    
        if($request->sale_confirmed !=''){
            if(!empty(Notifications::where('user_id', $user_id)->where('key','sale_confirmed')->get()->all())){
                $res = Notifications::where('user_id', $user_id)->where('key','sale_confirmed')->update(['value'=> $request->sale_confirmed,'next_date'=> $next_saledate ]);    
            }
            else{
                $res = Notifications::create(['user_id'=>$user_id, 'key'=>'sale_confirmed', 'value'=> $request->sale_confirmed,'next_date'=> $next_saledate]);
                $res = Notifications::where('user_id', $user_id)->where('key','sale_confirmed')->update(['next_date'=> $next_saledate]);

            }
        }
        if($request->delivery_update !=''){

            if(!empty(Notifications::where('user_id', $user_id)->where('key','delivery_update')->get()->all())){
                $res = Notifications::where('user_id', $user_id)->where('key','delivery_update')->update(['value'=> $request->delivery_update,'next_date'=> $next_deliverydate ]);    
            }
            else{
              
              $res = Notifications::create(['user_id'=>$user_id, 'key'=>'delivery_update', 'value'=> $request->delivery_update,'next_date'=> $next_deliverydate ]); 
              $res = Notifications::where('user_id', $user_id)->where('key','delivery_update')->update(['next_date'=> $next_deliverydate]);
            }
        }
        if($request->offers_messages !=''){
           if(!empty(Notifications::where('user_id', $user_id)->where('key','offers_messages')->get()->all())){
                $res = Notifications::where('user_id', $user_id)->where('key','offers_messages')->update(['value'=> $request->offers_messages,'next_date'=> $next_offerdate]);    
            }
            else{
              $res = Notifications::create(['user_id'=>$user_id, 'key'=>'offers_messages', 'value'=> $request->offers_messages,'next_date'=>$next_offerdate ]); 
              $res = Notifications::where('user_id', $user_id)->where('key','offers_messages')->update(['next_date'=> $next_offerdate]);  
            }
        }            

        if($change_password_flag == true){
            $res = User::where('id', $user_id)->update(['password'=>\Hash::make($request->password)]);    
        }

        return response()->json(['status' => 'success', 'message' => 'Profile updated successfully.']);
      }
}
