<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PurchaseOrder;
use App\Stock;
use App\Buyer;
use App\Seller;
use App\SaleTruck;
use App\Loadstatus;
use DataTables;
use App\Invoice;
use App\AppHead;
use App\ProductSpecification;
use App\ProductSpecificationValue;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use DateTime;
use Mail;
use App\Sale;
use App\User;
use App\Repositories\Backend\Auth\UserRepository;
use App\Events\Pushnotification;

class PurchaseOrderController extends Controller{
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function index(Request $request){
     
		 //return $data = PurchaseOrder::with('variety_detail', 'packing_detail')->where('status', '1')->get();
         $data = PurchaseOrder::with('stock','seller', 'buyer')->get();
         if(auth()->user()->hasRole('seller')){
             $seller_id = get_buyer_by_user_id()['id'];
            $data = PurchaseOrder::with('stock','seller', 'buyer')->where('seller_id', $seller_id)->get();
        }
    
		 if ($request->ajax()) {
			return Datatables::of($data)
				->addIndexColumn()
				->addColumn('action', function($row){
                    if(in_array('seller', auth_roles())){
                        $route_pre = 'seller';
                    }else{
                        $route_pre = 'admin';
                    }
              

				   $btn = '<div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-edit editItem" data-url="'.route($route_pre.'.purchaseorder.edit', $row->id).'"><i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-edit editItem" data-url="'.route('admin.purchaseorder.email_send', $row->id).'"><i class="far fa-envelope"></i></button>
								<button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>
                            </div>';
                    // $btn = '<div class="btn-group btn-group-sm">
                    //           <button type="button" class="btn btn-edit editItem" data-url="'.route($route_pre.'.purchaseorder.edit', $row->id).'"><i class="fas fa-edit"></i></button>
                    //           <button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>
                    //           <button type="button" class="btn btn-warning sendInvoice" title="Send PDF" data-url="'.route($route_pre.'.accounts.OrderInvoiceSend', $row->id).'" data-viewurl="'.route($route_pre.'.accounts.OrderInvoiceView', $row->id).'"><i class="fas fa-file-invoice"></i></button>
                    //         </div>';
					return $btn;
				})
				->addColumn('stock_show_url', function($row){
                    if(in_array('seller', auth_roles())){
                        $route_pre = 'seller';
                    }else{
                        $route_pre = 'admin';
                    }
					$data = '<a href="'.route($route_pre.'.stock.show', $row->stock_id).'" target="_blank">'.$row->stock_id.'</a>';
					return $data;
				})
				->addColumn('buyer_name', function($row){
					return (@$row->buyer->username?@$row->buyer->username:'-');
				})
				->addColumn('seller_name', function($row){
					return (@$row->seller->username?@$row->seller->username:'-');
                })
                ->addColumn('confirm', function($row){
					return (@$row->confirm?'Confirmed':'-');
				})
				->rawColumns(['action','stock_show_url','buyer_name','seller_name','confirm'])
				->make(true);
          }

		  return view('backend.purchaseorder.index');
    }
   public function email_send($id){
    $data = PurchaseOrder::with('seller')->where('id', $id)->first();
    $body='Please confirm stock is available 
    <form action="'.route('admin.purchaseorder.confirm',$id).'" method="GET">
      Yes ,Available <input type="radio" id="huey" name="confirm" value="1">
     No ,Not Available <input type="radio" id="huey" name="confirm" value="2">
     <button type="submit">Submit</button>';
 if ($data->seller['email']) {
    $message="Hi ".$data->seller['username']."  Veg-King send you an Email,/n for stock confirmation.Please check";
     event(new Pushnotification($message,$data->seller['user_id']));
     Mail::send('backend.mail.default', ['name' => 'Stock Confirmation', 'body' => $body], function ($message) use ($data) {
         $message->subject('Stock Confirmation Veg King!');
         $message->to($data->seller['email']);
     });
     return redirect()->back()->with('message', "Stock confirmation email has been sent to seller");
     }else{
    return redirect()->back()->with('error', "Seller email address not found");
    }
   }
    public function create(){
        $stockid = Stock::pluck('id','id');           
        $buyers = Buyer::where('status', '1')->pluck('username','id');
        $sellers = Seller::where('status', '1')->select('id', 'username', 'name')->get();
         return view('backend.purchaseorder.create',compact('buyers', 'stockid','sellers'));
    }

    public function store(Request $request){
        if(in_array('seller', auth_roles())){
            $route_pre = 'seller';
        }else{
            $route_pre = 'admin';
        }
        $request->validate([
         'stock_id' => 'required',
         'buyer_id' => 'required',
         'seller_id' => 'required',
         'price' => 'required',
         'delivery_date' => 'required',
        ]);
       $PurchaseOrder = PurchaseOrder::create($request->all());
       $sellers = Seller::where('status', '1')->select('id', 'username','phone', 'name','email','contact_email','contact_sms','contact_whatsapp')->where('id',@$PurchaseOrder->seller_id)->first();
       $user = auth()->user();
       //mail
       $seller_url = url('confirm-order/'.base64_encode(@$PurchaseOrder->id));

        $sellerdata = Seller::with('user')->findOrFail($sellers->id);
        $sellerdata['user']->first_name;        
        $msg_username = "";

        if($sellerdata['user']->hasRole('testuser')){
            $msg_username = $sellerdata['user']->first_name." ".live_dev_site_status();            
        }else{
            $msg_username = $sellers->username;
        }

       $seller_message = "Hi ".$msg_username.",\n\n
       Welcome to VegKing Europe - an online platform.\n\n
       You can now upload any stock any time from anywhere. Just click the link below and let's do more business! \n\n"
       .$seller_url;
       if($sellers->contact_email){
        Mail::send('backend.mail.default', ['name' => 'Invoice',  'body' => $seller_message], function ($message) use ($user,$sellers) {
            $message->subject('Invoice of Veg King!');
			if($sellers->email != ''){ $message->to($sellers->email); }
			$message->cc($user->email);
        });
           event(new Pushnotification($seller_message,$user->id));
       }
       if($sellers->contact_whatsapp){
        if(isset($user->whatsapp_subscription) == 1){
        //Whatsapp
        SendWhatsapp(['phone' => $sellers->phone, 'body' => $seller_message,'is_PDF'=>false]);
         }
       }
       if($sellers->contact_sms){
        //Text
        //SendSMS($sellers->phone, $seller_url);
       }
      return response()->json(['status' => 'success', 'message' => 'Purchase Order created successfully.']);
      
    }

    public function show($id)
    {
        //
    
    }
    public function confirm($id,Request $request){
      $purchaseorder=PurchaseOrder::find($id);
      $purchaseorder->confirm =$request->confirm;
      $purchaseorder->save();
      PurchaseOrder::find($id)->update(['confirm' => $request->confirm]);
      echo "<center>Thanks for your Input";
    }
    public function edit($id){
        $purchaseorder = PurchaseOrder::where(['id' => $id])->first();
        if($purchaseorder){
            $stockid = Stock::select('id')->get();
            $buyers = Buyer::where('status', '1')->select('id', 'username', 'name')->get();
            $sellers = Seller::where('status', '1')->select('id', 'username', 'name')->get();
            $saleTrucks = SaleTruck::where('sale_id', @$purchaseorder->sale_id)->get();
            $loads_status = Loadstatus::get();
            return view('backend.purchaseorder.edit',compact('purchaseorder','buyers', 'stockid','sellers','saleTrucks','loads_status'));
         }else{
          
          $msg="Unfortunately this Purchase Order is not exist!";
          return view('backend.purchaseorder.index',compact('msg'));
         } 
      }

    public function update(Request $request, PurchaseOrder $purchaseorder){
        $all = $request->all();
        //Mail
        if(in_array('seller', auth_roles())){
            $route_pre = 'seller';
        }else{
            $route_pre = 'admin';
            $request->validate([
                'stock_id' => 'required',
                'buyer_id' => 'required',
                'seller_id' => 'required',
            ]);
            $saleTrucks = SaleTruck::where('sale_id', $purchaseorder->sale_id)->get();
            foreach($saleTrucks as $saleTruck){
            	$saleTruck->delete();
            }
            if($request->has('truck')){
                foreach($all['truck'] as $truck){
                    $SaleTruck = SaleTruck::create(['sale_id' => $purchaseorder->sale_id, 'sale_date' => date('Y-m-d',strtotime($truck['sale_date'])), 'delivery_date' => date('Y-m-d',strtotime($truck['delivery_date'])), 'price' => $truck['price'], 'delivery_location' => $truck['delivery_location'], 'truck_loads'=>$truck['truck_loads'], 'load_status'=>$truck['load_status']]);
                }
            }
        }
       
        $PurchaseOrder = $purchaseorder;
        $user = auth()->user();
      
		$url = url('/') .'/img/'. Settings()->site_logo;
		$sales = Sale::with('stock', 'stock.seller', 'stock.product','buyer','trucksone')->where('id', $purchaseorder->sale_id)->first();
        if(isset($all['truck'])){
            
            $alltruck=$all['truck'];
            
            foreach($alltruck as $key => $truck){
                $SaleTrucks[] = ['sale_id'=> $purchaseorder['sale_id'],'sale_date'=>$truck['sale_date'],'delivery_date'=>$truck['delivery_date'],'delivery_location'=>$truck['delivery_location'],'price' => $truck['price'],'truck_loads' => $truck['truck_loads'],'load_status' => $truck['load_status']];
            }
            $sales->trucksone = $SaleTrucks;
        }
         $loads_status = Loadstatus::where('id',$sales->trucksone[0]['load_status'])->pluck('status')->first();

        $mpdf = new \Mpdf\Mpdf();
		$template = utf8_encode(view('backend.sales.invoice',compact('sales','user','PurchaseOrder','loads_status')));
        $mpdf->WriteHTML($template);
		if(isset($sales->stock->seller->contact_email)){
			if(!empty($user) && !empty($sales))
			{
				$dt = new DateTime();
				Mail::send('backend.mail.default', ['name' => 'Invoice', 'body' => 'Sales updated of Veg King'], function ($message) use ($user,$sales,$mpdf) {
					$message->subject('Invoice of Veg King!');
					if($sales->stock->seller->email != ''){ $message->to($sales->stock->seller->email); }
					// $message->cc($user->email);
					$message->attachData($mpdf->output("Invoice.pdf",'S'), "Invoice.pdf");
                });
                $message="Hello ".$sales->stock->seller->username. " \nPlease check Invoice";
                event(new Pushnotification($message,$sales->stock->seller->user_id));
			}else{
				return redirect()->route('admin.sales.index')->with('error','Invalid Request');
			}
        }
        //email send to all trader
        $result = $this->userRepository->orderBy('id', 'asc')->get();
        $traders = $result->filter(function ($result, $key) {
            return $result->hasRole('trader');
        });
        if (count($traders)>0) {
            foreach ($traders as $tarder) {
                $tarder_emails[] = $tarder->email;
            }
      
            foreach ($tarder_emails as $trader_email) {
                if (isset($trader_email)) {
                    Mail::send('backend.sales.invoice', ['sales' => $sales, 'user' => $user,'PurchaseOrder'=> $PurchaseOrder], function ($message) use ($trader_email) {
                        $message->subject('Updated Invoice of Veg King!');
                        if ($trader_email != '') {
                            $message->to($trader_email);
                        }
                    });
                }
            }
        }

        if(isset($sales->stock->seller->contact_whatsapp)){
            //Whatsapp
                $content = $mpdf->output("Invoice.pdf",'S');
                 $content = chunk_split(base64_encode($content));
                 if(isset($user->whatsapp_subscription) == 1){
                 SendWhatsapp(['phone' => $sales->stock->seller->phone, 'body' => "data:application/pdf;base64,".$content,'filename'=>'Invoice.pdf','caption'=>'Invoice','is_PDF'=>true]);
                  }
            }
       
        
        $purchaseorder->update($request->all()); 
        
         return response()->json(['status' => 'success', 'message' => 'Purchase Order updated successfully.']);
    }

    public function destroy(PurchaseOrder $purchaseorder){
       $purchaseorder->delete();
       return response()->json(['success'=>'Purchase Order deleted successfully.']);
    }


	public function getProductAjax(Request $request, PurchaseOrder $purchaseorder)
    {
        $purchaseorder = PurchaseOrder::find($request->pid);
        $productspecification_list = ProductSpecification::with('options')->where('product_id',$request->pid)->where('parent_id',null)->orderBy('order')->get();
        $productspecificationval_list = ProductSpecificationValue::with('product_specification')->where('product_id',$request->pid)->whereNotNull('parent_id')->get();
        $productSpecChildRelation = array();
        foreach($productspecificationval_list as $childItem){
            if($childItem->product_specification->reference_id != ''){
               $productSpecChildRelation[$childItem->parent_id]['reference_id'] =  $childItem->product_specification->reference_id;
               $productSpecChildRelation[$childItem->parent_id]['value'] =  $childItem->value;
            }
        }
        //echo "<pre/>"; print_r($productSpecChildRelation); die;
        $productSpecRel = array();
        foreach($productspecification_list as $spec){
            $productSpecRel[$spec->id]['name'] = $spec->display_name;
            $productSpecRel[$spec->id]['hasmany'] = $spec->stock_hasmany;
            $productSpecRel[$spec->id]['required'] = $spec->required;
            $productSpecRel[$spec->id]['field_type'] = $spec->field_type;
            if($spec->stock_hasmany == 'Yes'){
                $productSpecRel[$spec->id]['default'] = array();
            } else {
                $productSpecRel[$spec->id]['default'] = array();
            }
            $productSpecRel[$spec->id]['options'] = array();
            foreach($spec->options as $option){
                if($option->default == 1){
                    $productSpecRel[$spec->id]['default'][] = $option->id;
                }
                if($spec->stock_hasmany == 'Yes'){
                    $productSpecRel[$spec->id]['options'][$option->id]['name'] = $option->value;
                    $productSpecRel[$spec->id]['options'][$option->id]['premium'] = 0;
                    $productSpecRel[$spec->id]['options'][$option->id]['ec'] = @$option->ec;
                } else {
                    $productSpecRel[$spec->id]['options'][$option->id] = $option->value;
                }
            }
        }
        $data = array('product_id'=> $request->pid,'productSpecRel' => $productSpecRel,'productSpecChildRelation' => $productSpecChildRelation);
        //echo "<pre/>"; print_r($productSpecChildRelation); die;
        return response()->view('backend.products.stock-purchaseorder-pref', $data, 200);
    }
  
    public function getProductForBuyerAjax(Request $request, PurchaseOrder $purchaseorder){
        $purchaseorder = PurchaseOrder::find($request->pid);
       
        $productspecification_list = ProductSpecification::with('options')->where('parent_id',null)->orderBy('order')->get();
        $productSpecRel = array();
        foreach($productspecification_list as $spec){
            $productSpecRel[$spec->product_id][$spec->id]['name'] = $spec->display_name;
            $productSpecRel[$spec->product_id][$spec->id]['hasmany'] = $spec->buyer_hasmany;
            $productSpecRel[$spec->product_id][$spec->id]['required'] = $spec->required;
            
            if($spec->buyer_hasmany == 'Yes'){
                $productSpecRel[$spec->product_id][$spec->id]['default'] = array();
            } else {
                $productSpecRel[$spec->product_id][$spec->id]['default'] = array();
            }
            
            $productSpecRel[$spec->product_id][$spec->id]['options'] = array();
            foreach($spec->options as $option){
                if($option->default == 1){
                    $productSpecRel[$spec->product_id][$spec->id]['default'][] = $option->id;
                }
                if($spec->buyer_hasmany == 'Yes'){
                    $productSpecRel[$spec->product_id][$spec->id]['options'][$option->id]['name'] = $option->value;
                    $productSpecRel[$spec->product_id][$spec->id]['options'][$option->id]['premium'] = 0;
                } else {
                    $productSpecRel[$spec->product_id][$spec->id]['options'][$option->id] = $option->value;
                }
            }
        }
            
        //echo "<pre/>"; print_r($productSpecRel); die;
        $data = array('product_id'=> $request->pid,'productSpecRel' => @$productSpecRel[$request->pid]);
       
        return response()->view('backend.products.purchaseorder-pref', $data, 200);
    }
  
    public function getProductAjaxMultiple(Request $request, PurchaseOrder $purchaseorder)
    {
        $productSpecRel =array();
        $purchaseorder = PurchaseOrder::find($request->pid);
        $pref_id = $request->pref_id;
        $productspecification_list = ProductSpecification::with('options')->where('product_id',$request->pid)->where('parent_id',null)->get();
        foreach($productspecification_list as $spec){
            $productSpecRel[$spec->id]['name'] = $spec->display_name;
            $productSpecRel[$spec->id]['hasmany'] = $spec->buyer_hasmany;
            $productSpecRel[$spec->id]['required'] = $spec->required;
            $productSpecRel[$spec->id]['buyer_pref_anylogic'] = $spec->buyer_pref_anylogic;
            if($spec->buyer_hasmany == 'Yes'){
                $productSpecRel[$spec->id]['default'] = array();
            } else {
                $productSpecRel[$spec->id]['default'] = array();
            }
            $productSpecRel[$spec->id]['options'] = array();
            foreach($spec->options as $option){
                if($option->default == 1){
                    $productSpecRel[$spec->id]['default'][] = $option->id;
                }
                if($spec->buyer_hasmany == 'Yes'){
                    $productSpecRel[$spec->id]['options'][$option->id]['name'] = $option->value;
                    $productSpecRel[$spec->id]['options'][$option->id]['premium'] = 0;
                } else {
                    $productSpecRel[$spec->id]['options'][$option->id] = $option->value;
                }
            }
        }
        //echo "<pre/>"; print_r($productSpecRel); die;
        $data = array('product_id'=> $request->pid,'productSpecRel' => $productSpecRel);
        $data['pref_id'] = $pref_id;
        return response()->view('backend.products.stock-purchaseorder-multi-pref', $data, 200);
    }
    public function productsexports() 
    {
        return Excel::download(new ProductExport, 'purchaseorder.xlsx');
    }
}
