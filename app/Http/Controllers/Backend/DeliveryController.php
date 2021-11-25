<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductSpecification;
use App\ProductSpecificationValue;
use App\Sale;
use App\Seller;
use App\Stock;
use App\SaleTruck;
use App\Transportlist;
use App\TransLoad;
use App\Product;
use App\Buyer;
use DataTables;
use DB;
use Validator;

class DeliveryController extends Controller
{
  public function __construct()
  {
    $this->transportwhatsapp = '+91123456789';
    $this->transportmail = 'dev.kretoss@gmail.com';
  }

  public function index(Request $request)
  {

    DB::connection()->enableQueryLog();
    $roles = auth_roles();
    $path = explode('/', $request->path());

    $data = array();
    if(auth()->user()->hasRole('administrator') && request()->segment(1) == 'admin' || auth()->user()->hasRole('trader') && request()->segment(1) == 'trader')
    {
      $data = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at');
    }
    elseif(auth()->user()->hasRole('buyer') && request()->segment(1) == 'buyer')
    {
      $buyer_id = Buyer::where('user_id',auth()->user()->id)->get(); 
      $sale_id = Sale::select('id')->whereIn('buyer_id',$buyer_id)->get();
      $data = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->whereIn('salesid',$sale_id);
    }
    elseif(auth()->user()->hasRole('seller') && request()->segment(1) == 'seller')
    {
      $seller_id = Seller::select('id')->where('user_id',auth()->user()->id)->get();
      $offer_id = Stock::select('id')->whereIn('seller_id',$seller_id)->get();
      $sale_id = Sale::select('id')->whereIn('stock_id',$offer_id)->get();
      $data = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->whereIn('salesid',$sale_id);
    }
    if(isset($data->delivery_date))
    {
      $data->delivery_date = '-';
    }

    if ($request->ajax()) 
    {
		return   Datatables::of($data)
      ->addIndexColumn()
      ->addColumn('product', function($row)
      {
        return (@$row->product->name?@$row->product->name:'-');
      })
      ->addColumn('image', function($row){
        if($row->productspecvalue != Null)
        {
            $variety=$row->productspecvalue->value;
        } else { 
            $variety= "-";
        }
        $image = '<a class="image"><img src="'.asset('images/products/').'/'.@$row->product->image.'" onerror=this.src="'.asset('images/products/no_img.png').'" data-homepage_image="'.asset('images/products/').'/'.@$row->product->homepage_image.'" name="'.@$row->product->name.'" data-variety="'.@$variety.'" data-buyer="'.@$row->buyerget->username.'" data-seller="'.@$row->sellerget->username.'" data-transportid="'.@$row->transportdata->id.'" data-delivery_loaction="'.@$row->trucks->delivery_location.'" data-delivery_date="'.@$row->trucks->delivery_date.'" class="mb-2 img-thumbnail image-deliveries list_image" /></a>';
        return $image;
     })
      ->addColumn('seller_show_url', function($row)  use ($roles) 
      {
       // $seller=Seller::select('id')->where('username',@$row->sellerget->username)->first();
        //if($seller != Null )
        //{
        if($row->sellerget != Null && in_array('administrator', $roles))
        {
          $data = '<a href="'.route('admin.sellers.show', $row->sellerget->id).'" target="_blank">'.@$row->sellerget->id.'</a>';
          // $data .= '<a href="'.route('admin.sellers.show', $row->sellerget->id).'" target="_blank">'.@$row->sellerget->id.'</a>';
          return $data;
        }
        else
        {
          return "-";
        }
      })
      ->addColumn('buyer_show_url', function($row)  use ($roles) 
      {
        //echo "<pre/>"; print_r($row); die;
        //$buyer=Buyer::select('id')->where('username',@$row->buyerget->username)->first();
        if($row->buyerget != Null  && in_array('administrator', $roles))
        {
          $data = '<a href= "'.route('admin.buyers.show', $row->buyerget->id).'" target="_blank">'.@$row->buyerget->id.'</a>';
          return $data;
        }
        else
        {
          return "-";
        }
      })

      ->addColumn('variety', function($row)
      {
        if($row->productspecvalue != Null)
        {
            return $row->productspecvalue->value;
        } else { 
            return "-";
        }
      })
      
      ->addColumn('uploadedfiles', function($row)
      { 
        
        
        $res = DB::table('trans_loads')->where('id', $row->id )->select('uploadedfiles')->get();

        if($res[0]->uploadedfiles != ''){
          if(file_exists(public_path("images/uploadedfiles/".$row->id."_transload.pdf") )){
                $data = '
                    <form id = "formuploadedfiles_'. $row->id .'" role="form" enctype="multipart/form-data"> 
                        <input type="hidden" name="transload_id_files"  id="transload_id_files" value="'.$row->id.'">
                        <input type="file" class="hidden" name="uploadedfiles" value = "'.$row->id.'.pdf" id="uploadedfiles_'. $row->id .'" />
                        <a href="javascript:void(0);" style = "margin: 1px;" class="btn btn-primary edituploadedfiles" id= "'.$row->id .'" class="btn btn-success btn-block">Save</a>
                    </form>
                    <input type = "button" style = "margin: 1px;" class = "btn btn-primary view" id = "'.$row->id.'" value = "View file"> ' ;
              return $data;          
          }
        }
        else{
         
            $data = '<form id = "formuploadedfiles_'. $row->id .'" role="form" enctype="multipart/form-data"> 
                      <input type="hidden" name="transload_id_files" id="transload_id_files" value="'.$row->id.'">
                      <input type="file" class="hidden " name="uploadedfiles" id="uploadedfiles_'. $row->id .'" />
                      <a href="javascript:void(0);"  style = "margin: 1px;" class="btn btn-primary edituploadedfiles" id= "'.$row->id .'" class="btn btn-success btn-block">Save</a>
                    </form>' ;
          return $data;  
       
        }
      })



      ->addColumn('loaded_weight', function($row)
      {
        return (@$row->loaded_weight?@$row->loaded_weight:'-');			
      })
      ->addColumn('unloaded_weight', function($row)
      {
        return (@$row->unloaded_weight?@$row->unloaded_weight:'-');			
      })
      ->addColumn('packaging_type', function($row)
      {
        return (@$row->packaging_type?@$row->packaging_type:'-');			
      })
      ->addColumn('number_of_packing', function($row)
      {
        return (@$row->number_of_packing_units?@$row->number_of_packing_units:'-');			
      })
      ->addColumn('pickupdate', function($row)
      {
        return @$row->trucks->delivery_date?date('Y-m-d', strtotime("-4 day", strtotime($row->trucks->delivery_date))):'-';
      })
      ->addColumn('unloaddate', function($row)
      {
        return (@$row->trucks->delivery_date?@$row->trucks->delivery_date:'-');
      })
      ->addColumn('delivery_address', function($row)
      {
        return (@$row->trucks->delivery_location?@$row->trucks->delivery_location:'-');
      })
      ->addColumn('plateno', function($row)
      {
        return (@$row->transportdata->plate_numbers?@$row->transportdata->plate_numbers:'-');				
      })
      ->addColumn('container_id', function($row)
      {
        return (@$row->transportdata->carrier?@$row->transportdata->carrier:'-');
      })
      ->addColumn('transport_id', function($row)
      {
        return (@$row->transport_id?@$row->transport_id:'-');				
      })
     
      ->addColumn('action', function($row)
      {
        $view = \View::make('backend.delivery.action_button', [ 'row' => $row ]);
        return $view;
      })
		  ->rawColumns(['action','seller_show_url','buyer_show_url','image', 'uploadedfiles'])
      ->make(true);
    }
    
		return view('backend.delivery.index',compact('data'));
  }
  
  public function edit($id)
  {
    $product=Product::get();
    $buyer=Buyer::get();
    $seller=Seller::get();
    $data = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->where('id',$id)->get();
     
   
     return view('backend.delivery.edit',compact('data','product','buyer','seller'));
  }

  public function update(Request $r)
  {
   
    $transload=TransLoad::find($r->main_id);
    $transload->loaded_weight=$r->loaded_weight;
    $transload->unloaded_weight=$r->unloaded_weight;
    $transload->packaging_type=$r->packagin_type;
    $transload->number_of_packing_units=$r->number_of_packing;
    $transload->save();
    $trucks=SaleTruck::find($r->trucks_id);
    if(isset($trucks)){
      $trucks->delivery_date=$r->delivery_date;
      $trucks->delivery_location=$r->delivery_location;
      $trucks->save();
    }
    $transport=Transportlist::find($r->transport_id);
    if(isset($transport)){
      $transport->carrier=$r->Container_id;
      $transport->plate_numbers=$r->truck_plates;
      $transport->save();
    }
    return response()->json( ["error" => 0, "status" => 'success', 'message' => 'Delivery updated successfully' ]);
  }

  public function getTransload(Request $request)
  {
    $transload = TransLoad::where( [ "id" => $request->edit_id ] )->get()->toArray();
    if( $transload && is_array( $transload[0] ) )
    {
      return response()->json( ["error" => 0, "status" => 'success', 'message' => 'Record Found', 'transload' => $transload[0] ]);
    }
    else
    {
      return response()->json( ["error" => 1, "status" => 'failed', 'message' => 'Could not found the specified language line for id '.$request->edit_id ]);
    }
  }

  public function Saveuploadedfiles(Request $request)
  { 
    
    $validation = Validator::make($request->file(), [
      'file' => 'required|mimes:pdf|max:10000'
     ]);

     if($validation->passes())
     {
        $transload_data = $request->all();
          
        $file = $request->file('file');
          
        $new_name = $transload_data['transload_id_files'] . '_transload.' . $file->getClientOriginalExtension();
          
        $save_path = public_path().'/images/uploadedfiles/';
          
        $file->move($save_path,$new_name);
        $updated =  TransLoad::where('id',$transload_data['transload_id_files'])->update(
          array(
            'uploadedfiles' => $new_name,
          )
        );

        $action = 'update';
        if( $updated )
        {
          $error = 0;
          $status = 'success';
          $msg = 'File Updated Successfully.';
          return response()->json( [ "error" => $error, 'action' => $action, 'status' => $status, 'message' => $msg, 'class_name'  => 'alert-success' ] );
        }
        else
        {
          $error = 1;
          $status = 'failed';
          $msg = 'Failed to Update File';
          return response()->json( [ "error" => $error, 'action' => $action, 'status' => $status, 'message' => $msg , 'class_name'  => 'alert-danger'] );
        }
        
    }
    else{
       return response()->json(['message'   => $validation->errors()->all(),'uploaded_image' => '','class_name'  => 'alert-danger']);
    }
  }

  public function Savetransload(Request $request,TransLoad $transLoad)
  {
    $request->validate([
      'loaded_weight' => 'required',
      'unloaded_weight' => 'required',
    ]);
    $transload_data = $request->all();
    $updated =  TransLoad::where('id',$transload_data['transload_id'])->update(
      array(
        'loaded_weight' => $transload_data['loaded_weight'],
        'unloaded_weight' => $transload_data['unloaded_weight'],
      )
    );

    $action = 'update';
    if( $updated )
    {
      $error = 0;
      $status = 'success';
      $msg = 'Weight Updated Successfully.';
    }
    else
    {
      $error = 1;
      $status = 'failed';
      $msg = 'Failed to Updated Weight';
    }
    return response()->json( [ "error" => $error, 'action' => $action, 'status' => $status, 'message' => $msg ] );
  }

  public function buyerdeliveries(Request $request) 
  {
 
    if(Auth()->user()->hasRole('buyer') && request()->segment(1) == 'buyer')
    {
      $buyer_id = Buyer::where('user_id',auth()->user()->id)->get(); 
      $sale_id = Sale::select('id')->whereIn('buyer_id',$buyer_id)->get();
      $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->whereIn('salesid',$sale_id)->get();
    }
    else
    {
      $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->get();
    }
    $products = Product::all()->where('status', '1')->pluck('name', 'id', 'image');
    return view('backend.delivery.buyerdeliveries',compact('deliveries','products'));
  }

  public function sellerdeliveries(Request $request) 
  {
    if(Auth()->user()->hasRole('seller') && request()->segment(1) == 'seller')
    {
      $seller_id = Seller::select('id')->where('user_id',auth()->user()->id)->get();
      $offer_id = Stock::select('id')->whereIn('seller_id',$seller_id)->get();
      $sale_id = Sale::select('id')->whereIn('stock_id',$offer_id)->get();
      $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->whereIn('salesid',$sale_id)->limit(12)->get();
    }
    else
    {
      $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->limit(12)->get();
    }
    $products = Product::all()->where('status', '1')->pluck('name', 'id', 'image');
    return view('backend.delivery.sellerdeliveries',compact('deliveries', 'products'));
  }

  public function traderdeliveries(Request $request) 
  {
    if(Auth()->user()->hasRole('trader') && request()->segment(1) == 'trader')
    {
      $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->limit(12)->get();
    }
    $products = Product::all()->where('status', '1')->pluck('name', 'id', 'image');
    return view('backend.delivery.traderdeliveries',compact('deliveries', 'products'));
  }

  public function admindeliveries(Request $request) 
  {
    if(Auth()->user()->hasRole('administrator') && request()->segment(1) == 'admin')
    {
      $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->limit(12)->get();
    }
    $products = Product::all()->where('status', '1')->pluck('name', 'id', 'image');
    // echo "<pre>"; print_r($deliveries); exit('all'); 
    return view('backend.delivery.admindeliveries',compact('deliveries', 'products'));
  }

  public function getDeliveriesByAjax(Request $request) 
  {
    if($request->sortby == 2){
        $sortby = 'buyer_id'; 
        $asc = 'ASC';  }
    elseif($request->sortby == 3){
        $sortby = 'created_at';   
        $asc = 'DESC';  }
    elseif($request->sortby == 4){
        $sortby = 'salesid';   
        $asc = 'ASC';  }    
    else{
        $sortby = 'id';
        $asc = 'ASC';  }
    
    @$product = $request->all('productid')['productid'];
    if(@$product){
    if(Auth()->user()->hasRole('administrator') && request()->segment(1) == 'admin')
    {
      $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->orderBy($sortby , $asc)->where('goods', $product)->limit(12)->get();
    }
    elseif(Auth()->user()->hasRole('seller') && request()->segment(1) == 'buyer')
    {  
      $buyer_id = Buyer::where('user_id',auth()->user()->id)->get(); 
      $sale_id = Sale::select('id')->whereIn('buyer_id',$buyer_id)->get();
      $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->whereIn('salesid',$sale_id)->orderBy($sortby , $asc)->where('goods', $product)->limit(12)->get(); 
    } 
    elseif(Auth()->user()->hasRole('seller') && request()->segment(1) == 'seller')
    {
      $seller_id = Seller::select('id')->where('user_id',auth()->user()->id)->get();
      $offer_id = Stock::select('id')->whereIn('seller_id',$seller_id)->get();
      $sale_id = Sale::select('id')->whereIn('stock_id',$offer_id)->get();
      $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->whereIn('salesid',$sale_id)->orderBy($sortby , $asc)->where('goods', $product)->limit(12)->get(); 
    }
    elseif(Auth()->user()->hasRole('seller') && request()->segment(1) == 'trader')
    {
      $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->where('goods', $product)->orderBy($sortby , $asc)->limit(12)->get(); 
    }
    else
      {
        $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->where('goods', $product)->orderBy($sortby , $asc)->limit(12)->get(); 
      }
    }
    else{
      $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->orderBy($sortby , $asc)->limit(12)->get(); 
    // echo "<pre>"; print_r($deliveries[1]); exit('huhu');  
    }
    if(empty($deliveries->first() ) ) {
                $result = array(
                    'status' => 'false',
                    'msg' => "No more records found" 
                );
            }
            else{
                
                $res = $this->cardviewhtml($deliveries);
                $result = array(
                    'status' => 'success',
                    'data' => $res['cards'],
                    'id' => $res['last_id']
                );
            }
            echo json_encode($result);
            die;
    

  }

  public function adminmoredeliveries(Request $request) 
  {

    $last_id = 0;
    if($request->all('last_id')){
      $res = $request->all('last_id');  
      $last_id = $res['last_id'];
    }
    
    if(Auth()->user()->hasRole('administrator') && request()->segment(1) == 'admin')
    {
      if(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] =='' && $request->all('quality')['quality'] ==''){
        $productid = $request->all('productid')['productid'];
        $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->where('id', '>', $last_id)->where('goods', @$productid)->limit(12)->get(); 

      }
      elseif(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] !='' && $request->all('quality')['quality'] ==''){
        
        $productid = $request->all('productid')['productid'];
        $variety = $request->all('variety')['variety'];

        $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->where('variety', $variety)->where('goods', @$productid)->where('id', '>', @$last_id)->limit(12)->get(); 
      }

      //elseif(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] !='' && $request->all('quality')['quality'] ==''){ }
      
      else{
      $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->where('id', '>', $last_id)->limit(12)->get();
       }
      if(empty($deliveries->first() )){
                $result = array(
                    'status' => 'false',
                    'msg' => "No more records found" 
                );
            }
            else{
                
                $res = $this->cardviewhtml($deliveries);
                $result = array(
                    'status' => 'success',
                    'data' => $res['cards'],
                    'id' => $res['last_id']
                );
            }
            echo json_encode($result);
            die;
    }

    if(Auth()->user()->hasRole('seller') && request()->segment(1) == 'seller')
    { 
      $last_id = 0;
      if($request->all('last_id')['last_id']){
          $res = $request->all('last_id');  
          $last_id = $res['last_id'];  
      }
      // echo $last_id; exit('ds');
       
      $seller_id = Seller::select('id')->where('user_id',auth()->user()->id)->get();
      $offer_id = Stock::select('id')->whereIn('seller_id',$seller_id)->get();
      $sale_id = Sale::select('id')->whereIn('stock_id',$offer_id)->get();

      if(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] =='' && $request->all('quality')['quality'] ==''){
          $productid = $request->all('productid')['productid'];
          $variety = $request->all('variety')['variety'];
          $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->whereIn('salesid',$sale_id)->where('goods', @$productid)->where('id', '>', @$last_id)->limit(12)->get();
       }

      else if(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] !='' && $request->all('quality')['quality'] ==''){
        $variety = $request->all('variety')['variety'];
        $productid = $request->all('productid')['productid'];
        $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->whereIn('salesid',$sale_id)->where('goods', @$productid)->where('variety', @$variety)->where('id', '>', $last_id)->limit(12)->get();
      }
      // else if(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] !='' && $request->all('quality')['quality'] !=''){}
      else{ 
      $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->whereIn('salesid',$sale_id)->where('id', '>', @$last_id)->limit(12)->get();
        }
        
        if(empty($deliveries->first() )){
                $result = array(
                    'status' => 'false',
                    'msg' => "No more records found" 
                );
            }
            else{
                
                $res = $this->cardviewhtml($deliveries);
                $result = array(
                    'status' => 'success',
                    'data' => $res['cards'],
                    'id' => $res['last_id']
                );
            }
            echo json_encode($result);
            die;
        
    }
    if(Auth()->user()->hasRole('trader') && request()->segment(1) == 'trader')
    {
      $last_id = 0;
        if($request->all('last_id')['last_id'] != ''){
          $res = $request->all('last_id');  
          $last_id = $res['last_id'];  
        }

      if(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] =='' && $request->all('quality')['quality'] ==''){
        $productid = $request->all('productid')['productid'];
        $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->where('id', '>', $last_id)->where('goods', @$productid)->limit(12)->get();

      }
      elseif(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] !='' && $request->all('quality')['quality'] ==''){
        $variety = $request->all('variety')['variety'];
        $productid = $request->all('productid')['productid'];
        $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->where('id', '>', @$last_id)->where('goods', @$productid)->where('variety', @$variety)->limit(12)->get();
      }
      // elseif(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] !='' && $request->all('quality')['quality'] !=''){}
      else{  
      $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->where('id', '>', @$last_id)->limit(12)->get();
      }
        if(empty($deliveries->first() )){
                $result = array(
                    'status' => 'false',
                    'msg' => "No more records found" 
                );
            }
            else{
                
                $res = $this->cardviewhtml($deliveries);
                $result = array(
                    'status' => 'success',
                    'data' => $res['cards'],
                    'id' => $res['last_id']
                );
            }
            echo json_encode($result);
            die;  
    }

   if(Auth()->user()->hasRole('buyer') && request()->segment(1) == 'buyer')
    {
      if(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] =='' && $request->all('quality')['quality'] ==''){
          $buyer_id = Buyer::where('user_id',auth()->user()->id)->get(); 
          $sale_id = Sale::select('id')->whereIn('stock_id',$offer_id)->get();
          $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->whereIn('salesid',$sale_id)->limit(12)->get();
      }
      elseif(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] !='' && $request->all('quality')['quality'] ==''){
          $buyer_id = Buyer::where('user_id',auth()->user()->id)->get(); 
          $sale_id = Sale::select('id')->whereIn('stock_id',$offer_id)->get();
          $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->whereIn('salesid',$sale_id)->where('goods', @$productid)->where('variety', @$variety)->limit(12)->get();
      }
      // elseif(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] !='' && $request->all('quality')['quality'] ==''){ }
      else{
          $sale_id = Sale::select('id')->whereIn('stock_id',$offer_id)->get();
          $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->whereIn('salesid',$sale_id)->limit(12)->get();
      }
      if(empty($deliveries->first() )){
                $result = array(
                    'status' => 'false',
                    'msg' => "No more records found" 
                );
            }
            else{
                
                $res = $this->cardviewhtml($deliveries);
                $result = array(
                    'status' => 'success',
                    'data' => $res['cards'],
                    'id' => $res['last_id']
                );
            }
            echo json_encode($result);
            die;              
    }
  
  }

  public function cardviewhtml($deliveries){
      $cards = array();
      if(isset($deliveries)){
            foreach($deliveries as $delivery){
              $html = '<div class="col-xs-12 col-sm-6 col-md-4 removeable">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="stock-gallery">         
                                        <!--Carousel Wrapper-->
                                        <div id="carousel-thumb-{{$delivery->id}}" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
                                        <!--Slides-->
                                            <div class="carousel-inner" role="listbox">
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100 no_img"  onerror=this.src="'.asset('images/products/no_img.png').'" src="'.asset('images/products/'.@$delivery->product->homepage_image).'">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100 no_img" onerror=this.src="'.asset('images/products/no_img.png').'" src="'.asset('images/products/'.@$delivery->product->image).'">
                                                </div>
                                            </div>
                                            <!--/.Slides-->
                                            <!--Controls-->
                                            <a class="carousel-control-prev" href="#carousel-thumb-'.$delivery->id.'" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carousel-thumb-'.$delivery->id.'" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                            <!--/.Controls-->
                                            <ol class="carousel-indicators">
                                                <li data-target="#carousel-thumb-'.$delivery->id.'" data-slide-to="0" class="active"><img class="d-block w-100" onerror=this.src="'.asset('images/products/no_img.png').'" src="'.asset('images/products/'.@$delivery->product->homepage_image).'" class="img-fluid"></li>
                                                <li data-target="#carousel-thumb-'.$delivery->id.'" data-slide-to="1"><img class="d-block w-100" onerror=this.src="'.asset('images/products/no_img.png').'" src="'.asset('images/products/'.@$delivery->product->image).'" class="img-fluid"></li>
                                            </ol>
                                        </div>
                                        <!--/.Carousel Wrapper-->        
                                    </div>
                                </div>
                
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <ul class="stock-card-list">
                                        <li><strong>Product: </strong> '. @$delivery->product->name .' </li>
                                        <li><strong>Variety: </strong> '. @$delivery->productspecvalue->value .' </li>
                                        <li><strong>Buyer: </strong> '. @$delivery->buyerget->username .' </li>
                                        <li><strong>Seller: </strong> '. @$delivery->sellerget->username .' </li>
                                        <li><strong>Transport Id: </strong> '. @$delivery->transportdata->id .' </li>
                                        <li><strong>Delivery Location: </strong> '. @$delivery->trucks->delivery_location .' </li>
                                        <li><strong>Delivery Date: </strong> '. @$delivery->trucks->delivery_date .' </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-muted">
                        <a class="btn btn-edit" href="'. route('admin.deliveries.edit', $delivery->id) .'"> <i class="fas fa-edit"></i></a>
                        </div>
                    </div>
                </div>';
                $last_id = $delivery->id;
                array_push($cards, $html);
            }
            
          }
          $data['cards']= $cards;
          $data['last_id']= $last_id;
          return $data;
    }






    public function getProductStockAjax(Request $request, Product $product)
    {
        
        if(isset($_POST['productid'])){
            $product_id = @$_POST['productid'];
            $productMappedData = $this->mapProduct($product_id);
            return $productMappedData;
        } else {
            $Products = Product::all()->where('status', '1')->pluck('id', 'name');
            $output = [];
            foreach($Products as $pname=>$product_id){
                $productMappedData = $this->mapProduct($product_id);
                $output[$product_id] = $productMappedData;
            }
            return response()->json($output);
        }
        
    }

    public function mapProduct($product_id){
        $request = new  Request ;
        $productPrefsMapping = array();
        if($request->has('stock_id')){
            $offer = Stock::select('id','product_id')->where('id',$request->get('stock_id'))->first();
            $product_id = $offer->product_id;    
            $offerProperty = $offer->offerProperty()->select('offer_id','product_spec_id','product_spec_val_id','ecs')->get()->toArray();
            $ecs = array();
            foreach($offerProperty as $productPref){
                $productPrefsMapping[$productPref['product_spec_id']][] = $productPref['product_spec_val_id'];   
            }
        }
        
        $productspecification_list = ProductSpecification::with('options','options.children')->where('product_id',$product_id)->where('parent_id',null)->whereIn('type_name',['Variety','Packing','Purpose','Defects','Size','Extra Services','Color','Sugar Content','Colorful','Quality','MarketProcessing','Soil'])->get();
        $spec_array = array();
        $spec_array2 = $spec_array3 = $spec_array4 = array();
        $spec_ids = array();
        $spec_array_packing = array();
        $spec_array_packing_subs = array();
        foreach($productspecification_list as $productspec){
            $spec_array[$productspec->type_name] = array();
            $spec_array2[$productspec->type_name] = array();
            $spec_ids[$productspec->type_name] = $productspec->id;
          
            foreach($productspec->options as $productspecval){
                if($productspecval->parent_id == NULL){
                   $spec_array[$productspec->type_name][$productspecval->id] =  $productspecval->value;
                   $spec_array2[$productspec->type_name][$productspecval->id]['title'] =  $productspecval->value;
                   $spec_array2[$productspec->type_name][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
                }
                if($productspec->type_name == 'Purpose'){
                    if($productspecval->parent_id == null){
                        $arrayTags = explode(',',@$productspecval->tags);
                        if(in_array('Market',$arrayTags)){
                            $spec_array['PurposeMarket'][$productspecval->id]['title'] =  $productspecval->value;
                            $spec_array['PurposeMarket'][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
                        } else if(in_array('Processing',$arrayTags)){
                            $spec_array['PurposeProcessing'][$productspecval->id]['title'] =  $productspecval->value;
                            $spec_array['PurposeProcessing'][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
                        }
                    } else {
                        
                       
                    }
                    
                }
                else if($productspec->type_name == 'Soil'){
                    $ProductSpecificationValue = ProductSpecificationValue::where('value','Like','Unwashed/Washable')->first();
                    if(!empty($ProductSpecificationValue)){
                        $spec_array3[$ProductSpecificationValue->id][$productspecval->id]['title'] =  $productspecval->value;
                        $spec_array3[$ProductSpecificationValue->id][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
                    }
                } else if($productspec->type_name == 'Defects'){
                    
                    $spec_array4['Defects'][$productspecval->id]['title'] =   $productspecval->value;
                    
                    $spec_array4['Defects'][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
                }
               if($productspec->type_name == 'Packing'){
                   $childrens = $productspecval->children;
                    if(count($childrens)){
                       
                        foreach($childrens as $children){
                       $spec_array_packing_subs[$productspecval->id][$children->id] =  $children->value;
                        }
                    }
                   
                    $spec_array_packing[$productspec->type_name][$productspecval->id] =  $productspecval->ec;
               }
            }
        }   
        $productMappedData = ['PurposeMarket' => @$spec_array['PurposeMarket'],
                    'PurposeProcessing' => @$spec_array['PurposeProcessing'],
                    'MarketProcessing' => @$spec_array['MarketProcessing'],
                    'Variety' => @$spec_array['Variety'],
                    'Packing' => @$spec_array['Packing'],
                    'Purpose' => @$spec_array['Purpose'],
                    'Color' => @$spec_array['Color'],
                    'QualityImg' => @$spec_array2['Purpose'],
                    'Defects' => @$spec_array4['Defects'],
                    'ExtraServices' => @$spec_array['Extra Services'],
                    'PurposeChilds' => @$spec_array3,
                    //'Cleaning' => @$spec_array['Cleaning'],
                    'Variety_id' => @$spec_ids['Variety'],
                    'Packing_id' => @$spec_ids['Packing'],
                    'Quality_id' => @$spec_ids['Quality'],
                    'Defects_id' => @$spec_ids['Defects'],
                    //'Cleaning_id' => @$spec_ids['Cleaning'],
                    'Color_id' => @$spec_ids['Color'],
                    'Purpose_id' => @$spec_ids['Purpose'],
                    'Colorful_id' => @$spec_ids['Colorful'],
                    'ExtraServices_id' => @$spec_ids['Extra Services'],
                    'Size_id' => @$spec_ids['Size'],
                    'Sugarcontent_id' => @$spec_ids['Sugar Content'],
                    'productPrefsMapping' => @$productPrefsMapping,
                    'spec_array_packing' => @$spec_array_packing,
                    'spec_array_packing_subs' => @$spec_array_packing_subs,
                ];
        return $productMappedData;            
    }

    public function deliverycardviewbyAjax(Request $request) 
    {
      if(Auth()->user()->hasRole('administrator') && request()->segment(1) == 'admin')
        {
          if(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] =='' && $request->all('quality')['quality'] ==''){
            $productid = $request->all('productid')['productid'];
            $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->where('goods', @$productid)->limit(12)->get(); 

          }
          elseif(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] !='' && $request->all('quality')['quality'] ==''){
            
            $productid = $request->all('productid')['productid'];
            $variety = $request->all('variety')['variety'];

            $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->where('variety', $variety)->where('goods', @$productid)->limit(12)->get(); 
          }
          else{
          $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->limit(12)->get();
           }
          if(empty($deliveries->first() )){
                    $result = array(
                        'status' => 'false',
                        'msg' => "No more records found" 
                    );
                }
                else{
                    
                    $res = $this->cardviewhtml($deliveries);
                    $result = array(
                        'status' => 'success',
                        'data' => $res['cards'],
                        'id' => $res['last_id']
                    );
                }
                echo json_encode($result);
                die;
        }

        if(Auth()->user()->hasRole('seller') && request()->segment(1) == 'seller')
        { 
          $last_id = 0;
          if($request->all('last_id')['last_id']){
              $res = $request->all('last_id');  
              $last_id = $res['last_id'];  
          }
          // echo $last_id; exit('ds');
           
          $seller_id = Seller::select('id')->where('user_id',auth()->user()->id)->get();
          $offer_id = Stock::select('id')->whereIn('seller_id',$seller_id)->get();
          $sale_id = Sale::select('id')->whereIn('stock_id',$offer_id)->get();

          if(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] =='' && $request->all('quality')['quality'] ==''){
              $productid = $request->all('productid')['productid'];
              $variety = $request->all('variety')['variety'];
              $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->whereIn('salesid',$sale_id)->where('goods', @$productid)->limit(12)->get();
           }

          else if(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] !='' && $request->all('quality')['quality'] ==''){
            $variety = $request->all('variety')['variety'];
            $productid = $request->all('productid')['productid'];
            $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->whereIn('salesid',$sale_id)->where('goods', @$productid)->where('variety', @$variety)->limit(12)->get();
          }
          // else if(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] !='' && $request->all('quality')['quality'] !=''){}
          else{ 
          $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->whereIn('salesid',$sale_id)->limit(12)->get();
            }
            
            if(empty($deliveries->first() )){
                    $result = array(
                        'status' => 'false',
                        'msg' => "No more records found" 
                    );
                }
                else{
                    
                    $res = $this->cardviewhtml($deliveries);
                    $result = array(
                        'status' => 'success',
                        'data' => $res['cards'],
                        'id' => $res['last_id']
                    );
                }
                echo json_encode($result);
                die;
            
        }
        if(Auth()->user()->hasRole('trader') && request()->segment(1) == 'trader')
        {
          $last_id = 0;
            if($request->all('last_id')['last_id'] != ''){
              $res = $request->all('last_id');  
              $last_id = $res['last_id'];  
            }

          if(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] =='' && $request->all('quality')['quality'] ==''){
            $productid = $request->all('productid')['productid'];
            $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->where('goods', @$productid)->limit(12)->get();

          }
          elseif(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] !='' && $request->all('quality')['quality'] ==''){
            $variety = $request->all('variety')['variety'];
            $productid = $request->all('productid')['productid'];
            $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->where('goods', @$productid)->where('variety', @$variety)->limit(12)->get();
          }
          // elseif(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] !='' && $request->all('quality')['quality'] !=''){}
          else{  
          $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->limit(12)->get();
          }
            if(empty($deliveries->first() )){
                    $result = array(
                        'status' => 'false',
                        'msg' => "No more records found" 
                    );
                }
                else{
                    
                    $res = $this->cardviewhtml($deliveries);
                    $result = array(
                        'status' => 'success',
                        'data' => $res['cards'],
                        'id' => $res['last_id']
                    );
                }
                echo json_encode($result);
                die;  
        }

       if(Auth()->user()->hasRole('buyer') && request()->segment(1) == 'buyer')
        {
          if(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] =='' && $request->all('quality')['quality'] ==''){
              $buyer_id = Buyer::where('user_id',auth()->user()->id)->get(); 
              $sale_id = Sale::select('id')->whereIn('stock_id',$offer_id)->get();
              $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->whereIn('salesid',$sale_id)->limit(12)->get();
          }
          elseif(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] !='' && $request->all('quality')['quality'] ==''){
              $buyer_id = Buyer::where('user_id',auth()->user()->id)->get(); 
              $sale_id = Sale::select('id')->whereIn('stock_id',$offer_id)->get();
              $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->whereIn('salesid',$sale_id)->where('goods', @$productid)->where('variety', @$variety)->limit(12)->get();
          }
          // elseif(@$request->all('productid')['productid'] !='' && @$request->all('variety')['variety'] !='' && $request->all('quality')['quality'] ==''){ }
          else{
              $sale_id = Sale::select('id')->whereIn('stock_id',$offer_id)->get();
              $deliveries = TransLoad::with('product','productspecvalue','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->whereIn('salesid',$sale_id)->limit(12)->get();
          }
          if(empty($deliveries->first() )){
                    $result = array(
                        'status' => 'false',
                        'msg' => "No more records found" 
                    );
                }
                else{
                    
                    $res = $this->cardviewhtml($deliveries);
                    $result = array(
                        'status' => 'success',
                        'data' => $res['cards'],
                        'id' => $res['last_id']
                    );
                }
                echo json_encode($result);
                die;              
        }


    }  


}
