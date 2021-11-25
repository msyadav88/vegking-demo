<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sale;
use App\SaleTruck;
use App\Roles;
use App\Buyer;
use App\Seller;
use App\Match;
use App\Stock;
use App\Saledelivery;
use App\PurchaseOrder;
use App\Loadstatus;
use App\Product;
use App\TransLoad;
use App\Transportlist;
use App\Models\Auth\User;
use DataTables;
use App\BuyerPaymentDetails;
use App\Exports\SalesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\Backend\Auth\UserRepository;
use DateTime;
use App\UserAction;
use Mail;


class SaleController extends Controller
{
	

	public function __construct()
	{
        $this->middleware('permission:view sales', ['only' => ['index']]);
        $this->middleware('permission:add sales', ['only' => ['create','store']]);
        $this->middleware('permission:edit sales', ['only' => ['edit','update']]);
        $this->middleware('permission:delete sales', ['only' => ['destroy']]);
        $this->middleware('permission:view sales', ['only' => ['show']]);
		$this->middleware('permission:export sales', ['only' => ['show']]);
    }

	public function index(Request $request)
	{
		if ($request->ajax()) 
		{
			$data = Sale::with('buyer', 'stock', 'paymentType', 'paymentTerms', 'currencyId')->get();
			if(auth()->user()->hasRole('seller') && request()->segment(1) == 'seller')
			{
				if (strpos(url()->previous(), 'seller/dashboard') == true ) 
				{
					$seller_id = Seller::select('id')->where('user_id',auth()->user()->id)->get();
					$offer_id = Stock::select('id')->whereIn('seller_id',$seller_id)->get();
					$data = Sale::with('buyer', 'stock', 'paymentType', 'paymentTerms', 'currencyId')->whereIn('stock_id',$offer_id)->orderBy('created_at', 'desc')->limit(3)->get();
				}
				else
				{
					$seller_id = Seller::select('id')->where('user_id',auth()->user()->id)->get();
					$offer_id = Stock::select('id')->whereIn('seller_id',$seller_id)->get();
					$data = Sale::with('buyer', 'stock', 'paymentType', 'paymentTerms', 'currencyId')->whereIn('stock_id',$offer_id)->get();
				}
			}
			return Datatables::of($data)
				->addIndexColumn()
				->addColumn('action', function($row)
				{
                    $checkstatus = Transportlist::where('salesid',$row->id)->where('salestatus','rejected')->first();
					if(!empty($checkstatus))
					{
                        $btn = ' <div class="btn-group btn-group-sm">';
						if(auth()->user()->can('edit sales'))
						{
							$btn .= '<button type="button" class="btn btn-edit editItem" data-url="'.route('admin.sales.edit', $row->id).'"><i class="fas fa-edit"></i></button>';
						}
						if(auth()->user()->can('view sales'))
						{
							$btn .= '<button type="button" class="btn btn-primary viewItem" data-url="'.route('admin.sales.show', $row->id).'"><i class="fas fa-eye"></i></button>';
						}
						if(auth()->user()->can('delete sales'))
						{
							$btn .= '<button data-toggle="tooltip" data-id="'.$row->id.'" title="Delete" data-placement="top" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>';
						}
						if(auth()->user()->can('sales - view PDF'))
						{
							$btn .= '<button type="button" class="btn btn-warning viewInvoice" title="View PDF" data-viewurl="'.route('admin.sales.SaleInvoiceView', $row->id).'"><i class="fas fa-file-invoice"></i></button>';
						}
                            $btn .= '</div>';
						} 
						else
						{
                            $btn = ' <div class="btn-group btn-group-sm">
										<button type="button" class="btn btn-primary viewItem" data-url="'.route('admin.sales.show', $row->id).'"><i class="fas fa-eye"></i></button>
										<button type="button" class="btn btn-warning viewInvoice" title="View PDF" data-viewurl="'.route('admin.sales.SaleInvoiceView', $row->id).'"><i class="fas fa-file-invoice"></i></button>
									</div>';
                        }
                  return $btn;
		  })
		  ->addColumn('image', function($row){
    		  $image = '<a class="image "><img src="'.asset('images/products/').'/'.@$row->stock->product->image.'" onerror=this.src="'.asset('images/products/no_img.png').'" data-homepage_image="'.asset('images/products/').'/'.@$row->stock->product->homepage_image.'" name="'.@$row->stock->product->name.'" data-buyer="'.@$row->buyer->username.'" data-size="'.(@$row->stock->size_from.'-'.@$row->stock->size_to).'" data-price="'.@$row->price.'"  class="mb-2 img-thumbnail list_image" /></a>';
			  return $image;
		   })
			->addColumn('price', function($row){
				return  currency(@$row->price);
			})
			->addColumn('buyer_name', function($row){
				return (@$row->buyer->username?@$row->buyer->username:'-');
			})
			->addColumn('payment_terms_name', function($row){
				return (@$row->paymentTerms->name?@$row->paymentTerms->name:'-');
			})
			->addColumn('payment_type_name', function($row){
				return (@$row->paymentType->name?@$row->paymentType->name:'-');
			})
			->addColumn('currency_name', function($row){
				return (@$row->currencyId->name?@$row->currencyId->name:'-');
			})
          ->rawColumns(['action','image'])
          ->make(true);
      }

      return view('backend.sales.index');
    }

	public function create()
	{
		$stockid = Stock::pluck('id','id');
        $buyers = Buyer::where('status', '1')->pluck('username','id');
		$loads_status = Loadstatus::get();
        $payment_types = \App\AppHead::where('type', 'payment_type')->pluck('name','id');
		$payment_terms = \App\AppHead::where('type', 'payment_terms')->pluck('name','id');
		$currencyIds = \App\AppHead::where('type', 'currency')->pluck('name','id');
		return view('backend.sales.create',compact('buyers','loads_status', 'stockid', 'payment_types', 'payment_terms', 'currencyIds'));
	}

	public function store(Request $request)
	{
		
	
		$arr = array();
		foreach($request->truck as $date)
		{
			$arr[] = $date['delivery_date'];
		}
		
		$all = $request->all();
		if(isset($request->truck))
		{
			foreach($request->truck as $keyMain => $truck)
			{
				if (is_array($truck))
				{
					$valid_array = array();
					foreach($truck as $key => $val)
					{
						if(is_array($val))
						{
							$valid_Val['price'] = 'truck.'.$keyMain.'.'.$key.'.price';
							$valid_Val['sale_date'] = 'truck.'.$keyMain.'.'.$key.'.sale_date';
							$valid_Val['delivery_location'] = 'truck.'.$keyMain.'.'.$key.'.delivery_location';
							$valid_Val['delivery_date'] = 'truck.'.$keyMain.'.'.$key.'.delivery_date';
							$valid_Val['truck_loads'] = 'truck.'.$keyMain.'.'.$key.'.truck_loads';
							array_push($valid_array,$valid_Val);
						}
						
					}
				}
			}
		}
		if(isset($valid_array[0]) && $valid_array[0]!='')
		{
			foreach($valid_array as $key => $value)
			{
				if(isset($value))
				{
					$request->validate([
						'buyer_id' => 'required',
						'stock_id' => 'required',
						'quantity' => 'required',
						'payment_term' => 'required',
						'payment_type' => 'required',
						'payment_currency' => 'required',
						'defect_percentage'=> 'required',
						'truck.*.delivery_date'=>'required',
						'truck.*.number_of_loads'=>'required',
						$value['price']=>'required',
						$value['sale_date']=>'required',
						$value['delivery_location']=>'required',
						$value['delivery_date']=>'required',
						$value['truck_loads']=>'required',
					  ],[
						'truck.*.delivery_date.required' => 'The delivery date field is required.',
						'truck.*.number_of_loads.required' => 'The number of loads field is required.',
						$value['price'].'.required' => 'The price field is required.',
						$value['sale_date'].'.required' => 'The sale date field is required.',
						$value['delivery_location'].'.required' => 'The delivery location field is required.',
						$value['delivery_date'].'.required' => 'The delivery date field is required.',
						$value['truck_loads'].'.required' => 'The truck loads field is required.',
					]);
				}
			}
		}
		else
		{
			$request->validate([
				'buyer_id' => 'required',
				'stock_id' => 'required',
				'quantity' => 'required',
				'payment_term' => 'required',
				'payment_type' => 'required',
				'payment_currency' => 'required',
				'defect_percentage'=> 'required',
				'truck.*.delivery_date'=>'required',
				'truck.*.number_of_loads'=>'required',
			],[
				'truck.*.delivery_date.required' => 'The delivery date field is required.',
				'truck.*.number_of_loads.required' => 'The number of loads field is required.',
			]);
		}
		$total = 0;
		$main_total = 0;
		
		foreach($all['truck'] as $truck)
		{
			if (is_array($truck))
			{
				foreach($truck as $key => $val)
				{
					if(is_array($val))
					{
						$total += $val['price'];
						$main_total += $val['price'];
					}
					
				}
			}
		}
		$user = auth()->user();
		$sale = Sale::create(['buyer_id' => $request->buyer_id, 'match_id' => $request->match_id, 'offer_id' => $request->offer_id,'trader_id' => $user->id, 'stock_id' => $request->stock_id, 'quantity' => $request->quantity, 'price' => $total,'payment_term' => $request->payment_term, 'payment_type' => $request->payment_type, 'payment_currency' => $request->payment_currency, 'status' => $request->status,'defect_percentage'=>$request->defect_percentage]);
        
		if($sale){
            UserAction::create(['trader_id'=>$user->id,'stock_id'=>$request->stock_id,'user_action'=>'SaleCreated','entity'=>'Sale','entity_id'=>$sale->id]);
        }
        
		$index = 1;
		$delay = array();
		
		foreach($all['truck'] as $ky => $delivery)
		{
			if (is_array($delivery))
			{	 
				$deliveryid = Saledelivery::create(['salesid' => $sale->id, 'deliverymain' => date('Y-m-d',strtotime($delivery['delivery_date']))]);
				foreach($delivery as $key => $truck){
					if(is_array($truck))
					{
						$total += $val['price'];
						$SaleTruck = SaleTruck::create(['sale_id' => $sale->id, 'sale_date' => date('Y-m-d',strtotime($truck['sale_date'])), 'delivery_date' => date('Y-m-d',strtotime($truck['delivery_date'])), 'price' => isset($truck['price'])?$truck['price']:'0', 'delivery_location'=>$truck['delivery_location'], 'truck_loads'=> $truck['truck_loads'], 'load_status'=>$truck['load_status'], 'number_delivery'=>$index, 'deliveryid' => $deliveryid->id]);
						$index++;
					}
				}
			}
		}
		
		$checkloadno = Saledelivery::where('salesid',$sale->id)->get();
		foreach($checkloadno as $deleid)
		{
			$countlod = SaleTruck::where('deliveryid',$deleid->id)->count();	
			Saledelivery::where('id',$deleid->id)->update(
				array(
					'loadcount' => $countlod
				)
			);
		}
		
		$SaleTruck = SaleTruck::where('sale_id',$sale->id)->groupBy('number_delivery')->get();
		foreach($SaleTruck as $saletruckvalue)
		{
			$Transportlist = Transportlist::create(['salesid' => $sale->id, 'carrier'=>"0",'trailer_type'=>"0",'temperature'=>"0",'plate_numbers'=>"0",'drivers_name'=>"0",'drivers_phone_number'=>"0",'salestatus'=>"unplanned"])->id;
			
			$SaleTruck_load = SaleTruck::where('sale_id',$sale->id)->where('number_delivery',$saletruckvalue->number_delivery)->get();
			foreach($SaleTruck_load as $saletruckloadvalue)
			{
				$offer = Stock::with('product', 'seller','offerProperty','offerProperty.productSpec','offerProperty.productSpecValue')->where('id', $sale->stock_id)->first();
				if($offer!=NULL)
				{
					$product_name = @$offer->product->id;
					$size_from = @$offer->size_from;
					$size_to = @$offer->size_to;
					
					$offerPropertiesArr = array();
					foreach($offer->offerProperty as $productPref)
					{
						if(isset($productPref->productspec))
						{
							$offerPropertiesArr[$productPref->productspec->display_name][] = (($productPref->productspec->field_type == 'dropdown_switchboxes')?@$productPref->productspecvalue->value:$productPref->value);
						}
					}
					foreach($offerPropertiesArr as $display_name=>$arr)
					{
						$offerProperties[$display_name] = implode(', ',$arr??array());
					}
					$TransLoad = TransLoad::create(['salesid' => isset($sale->id)?$sale->id:'', 'goods'=>isset($product_name)?$product_name:'','variety'=>'0','size_from'=>isset($size_from)?$size_from:'','size_to'=>isset($size_to)?$size_to:'','loaded_weight'=>'0','unloaded_weight'=>'0','difference'=>'0','packaging_type'=>'','number_of_packing_units'=>isset($saletruckloadvalue->truck_loads)?$saletruckloadvalue->truck_loads:'','requirements'=>'','freight_cost'=>isset($saletruckloadvalue->price)?$saletruckloadvalue->price:'','payment_term'=>isset($sale->payment_term)?$sale->payment_term:'','payment_type'=>isset($sale->payment_type)?$sale->payment_type:'','transport_invoice_no'=>'','transport_invoice_due_date'=>'','payment_status'=>isset($sale->payment_status)?$sale->payment_status:'','transport_id'=>isset($Transportlist)?$Transportlist:'']);
				}
			}
		}
		$user = auth()->user();
		//start price-list
		
		\App\Jobs\SalesPriceCreated::dispatch(@$user, @$sale->id, @$request->buyer_id, @$request->delivery_date, @$request->stock_id, $main_total);
		//end price-list
	
		//start invoice-list
		\App\Jobs\SalesInvoiceCreated::dispatch(@$user, @$sale->id, @$request->buyer_id, @$request->delivery_date, @$request->stock_id, $main_total);
		//end invoice-list;

		return response()->json(['status' => 'success', 'message' => 'Sale created successfully!']);
	}

	public function sendInvoiceList($user, $saleid, $buyerid, $deliverydate, $stockid, $main_total)
	{
		$url = url('/') .'/img/'. Settings()->site_logo;
		$sales = Sale::with('stock', 'stock.seller', 'stock.product','buyer','trucksone')->where('id', @$saleid)->first();
		$PurchaseOrder = PurchaseOrder::create(['buyer_id' => $buyerid,'delivery_date'=>@$deliverydate,'seller_id' => @$sales->stock->seller->id,'stock_id' => $stockid,'price' => $main_total,'sale_id' => @$main_total]);
		$loads_status = Loadstatus::where('id',$sales->trucksone[0]->load_status)->pluck('status')->first();
		$mpdf = new \Mpdf\Mpdf();
		$template = utf8_encode(view('backend.sales.invoice',compact('sales','user','PurchaseOrder','loads_status')));
      	$mpdf->WriteHTML($template);
		$sales_url = url('admin/trading/sales/'.@$sales->id);
		$order_link = "<a href='".$sales_url."' class='btn btn-success'>Please check the order!</a>";
		$seller_confirm_url = url('confirm-order/'.encrypt(@$PurchaseOrder->id));
		$seller_confirm_url = "<a href='".$seller_confirm_url."' class='btn btn-success'>Confirm Order</a>";
		$buyerdata = buyer::with('user')->findOrFail($sales->buyer_id);
		
		$seller_edit_loads =route('seller.purchaseorder.edit',@$PurchaseOrder->id);
		$seller_edit_loads ="<a href='".$seller_edit_loads."' class='btn btn-success'>Edit Order</a>";
		
		$sellerdata = Seller::with('user')->findOrFail($sales->stock->seller->id);
		
		$locale = \App::getLocale();

		$email_template = get_email_template('SALES REQUEST');
        \App\EmailTemplate::where('title', 'SALES REQUEST')->increment('sent');
		
		if($email_template)
        {
			$globalHeader = getHeaderFooter($email_template->id, $locale);
			$TransLoadget = TransLoad::where('salesid',$saleid)->get();
			$transport_id = '';
			$whatsapp_msg = '';
			foreach($TransLoadget as $transget)
			{	
				$transport_id .= 'TransLoad Id '.$transget->id.'/n';
				$whatsapp_msg .= 'TransLoad Id '.$transget->id.'';
			}

			//----------- The Seller Email Content -----------//
			if( in_array(1001 ,explode(',',$email_template->recipients) ) )
			{
				if($locale == 'de')
				{
					$email_content = $globalHeader['header'];
					$whatsapp_content = $globalHeader['header'];
					$whatsapp_content .= "\r\n";

					$email_content .= $email_template->email_content_de;
					$whatsapp_content .= $email_template->sms_content_de;
					$email_subject = $email_template->subject;

					$whatsapp_content .= "\r\n";
					$email_content .= $globalHeader['footer'];
					$whatsapp_content .= $globalHeader['footer'];
				}
				elseif($locale == 'pl')
				{
					$email_content = $globalHeader['header'];
					$whatsapp_content = $globalHeader['header'];
					$whatsapp_content .= "\r\n";

					$email_content .= $email_template->email_content_pl;
					$whatsapp_content .= $email_template->sms_content_pl;
					$email_subject = $email_template->subject;
					
					$whatsapp_content .= "\r\n";
					$email_content .= $globalHeader['footer'];
					$whatsapp_content .= $globalHeader['footer'];
				}
				else
				{
					$email_content = $globalHeader['header'];
					$whatsapp_content = $globalHeader['header'];
					$whatsapp_content .= "\r\n";
					
					$email_content .= $email_template->email_content;
					$whatsapp_content .= $email_template->sms_content;
					$email_subject = $email_template->subject;
					
					$whatsapp_content .= "\r\n";
					$email_content .= $globalHeader['footer'];
					$whatsapp_content .= $globalHeader['footer'];
				}
				if($email_template->email_content_pl != '' || $email_template->email_content_de != '' || $email_template->email_content != '')
				{
					$sellerlevels = $sellerdata->trust_level == "" ? "1" : $sellerdata->trust_level;
					$title = $user->gender == 0 ? 'King':'Queen';
					$email_content = str_replace("[title]", $title, $email_content);
					$email_content = str_replace("[level]", 'level '.$sellerlevels, $email_content);
					$email_content = str_replace("[recipient]", $sellerdata->username, $email_content);
					$email_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $email_content);
					$email_content = str_replace("[role]", 'seller', $email_content);
					$email_content = str_replace("[username]", $sellerdata->username, $email_content);
					$email_content = str_replace("[order_cofirm_url]", $seller_confirm_url, $email_content);
					$email_content = str_replace("[order_edit_url]", $seller_edit_loads, $email_content);
					$email_content = str_replace("[transport_id]", $transport_id, $email_content);
					$email_content = str_replace("[unsubscribe]", '', $email_content); 

					$whatsapp_content = str_replace("[title]", $title, $whatsapp_content);
					$whatsapp_content = str_replace("[recipient]", $sellerdata->username, $whatsapp_content);
					$whatsapp_content = str_replace("[level]", 'level '.$sellerlevels, $whatsapp_content);
					$whatsapp_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $whatsapp_content);
					$whatsapp_content = str_replace("[role]", 'seller', $whatsapp_content);
					$whatsapp_content = str_replace("[recipient]", $sellerdata->username, $whatsapp_content);
					$whatsapp_content = str_replace("[username]", $sellerdata->username, $whatsapp_content);
					$whatsapp_content = str_replace("[order_cofirm_url]", $seller_confirm_url, $whatsapp_content);
					$whatsapp_content = str_replace("[order_edit_url]", $seller_edit_loads, $whatsapp_content);
					$whatsapp_content = str_replace("[transport_id]", $transport_id, $whatsapp_content);

					$whatsapp_unsubscribe_link ='Click here to unsubscribe whatsapp messages ' .  url('unsubscribeWhatsapp', $user->uuid);
                    $whatsapp_content = str_replace("[unsubscribe]", $whatsapp_unsubscribe_link, $whatsapp_content); 

					if($sales->stock->seller->contact_email)
					{
						if(!empty($user) && !empty($sales))
						{
							if($user->email_subscription){
								$dt = new DateTime();
								Mail::send('backend.mail.default', ['name' => 'Invoice', 'body' => $email_content, 'uuid'=> $user->uuid], function ($message) use ($user,$sales,$mpdf,$email_subject) {
									$message->subject($email_subject);
									if($sales->stock->seller->email != ''){ $message->to($sales->stock->seller->email); }
									$message->attachData($mpdf->output("Invoice.pdf",'S'), "Invoice.pdf");
								});
							}
						}
						else
						{
							return redirect()->route('admin.sales.index')->with('error','Invalid Request');
						}
					}
				}
				if($email_template->sms_content != '' || $email_template->sms_content_de != '' || $email_template->sms_content_pl != '')
				{
					if($sales->stock->seller->contact_whatsapp)
					{
						//Whatsapp
						$content = $mpdf->output("Invoice.pdf",'S');
						$content = chunk_split(base64_encode($content));
						SendWhatsapp(['phone' => $sales->stock->seller->phone, 'body' => $whatsapp_content, 'is_PDF'=>false]);
						SendWhatsapp(['phone' => $sales->stock->seller->phone, 'body' => "data:application/pdf;base64,".$content, 'filename'=>'Invoice.pdf', 'caption'=>'Invoice', 'is_PDF'=>true]);
					}
				}
				if($sales->stock->seller->contact_sms)
				{
					//Text
					//SendSMS($sellers->phone, $seller_url);
				}
			}
			//----------- The Seller Email Content -----------//

			//----------- The Buyer Email Content -----------//
			if( in_array(1002 ,explode(',',$email_template->recipients)) )
			{
				if($locale == 'de')
				{
					$email_content = $globalHeader['header'];
					$whatsapp_content = $globalHeader['header'];
					$whatsapp_content .= "\r\n";

					$email_content .= $email_template->buyer_email_content_de;
					$whatsapp_content .= $email_template->buyer_sms_content_de;
					$email_subject = $email_template->subject;
					
					$whatsapp_content .= "\r\n";
					$email_content .= $globalHeader['footer'];
					$whatsapp_content .= $globalHeader['footer'];
				}
				elseif($locale == 'pl')
				{
					$email_content = $globalHeader['header'];
					$whatsapp_content = $globalHeader['header'];
					$whatsapp_content .= "\r\n";

					$email_content .= $email_template->buyer_email_content_pl;
					$whatsapp_content .= $email_template->buyer_sms_content_pl;
					$email_subject = $email_template->subject;

					$whatsapp_content .= "\r\n";
					$email_content .= $globalHeader['footer'];
					$whatsapp_content .= $globalHeader['footer'];
				}
				else
				{
					$email_content = $globalHeader['header'];
					$whatsapp_content = $globalHeader['header'];
					$whatsapp_content .= "\r\n";
					
					$email_content .= $email_template->buyer_email_content;
					$whatsapp_content .= $email_template->buyer_sms_content;
					$email_subject = $email_template->subject;
					
					$whatsapp_content .= "\r\n";
					$email_content .= $globalHeader['footer'];
					$whatsapp_content .= $globalHeader['footer'];
				}
				if($email_template->buyer_email_content_de != '' || $email_template->buyer_email_content_pl != '' || $email_template->buyer_email_content != '')
				{
					$buyerlevels = $sales->buyer->trust_level == "" ? "1" : $sales->buyer->trust_level;
					$title = $user->gender == 0 ? 'King':'Queen';
					$email_content = str_replace("[title]", $title, $email_content);
					$email_content = str_replace("[recipient]", $sales->buyer->username, $email_content);
					$email_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $email_content);
					$email_content = str_replace("[role]", 'buyer', $email_content);
					$email_content = str_replace("[level]", 'level '.$buyerlevels, $email_content);
					$email_content = str_replace("[username]", $sales->buyer->username, $email_content);

					$whatsapp_content = str_replace("[title]", $title, $whatsapp_content);
					$whatsapp_content = str_replace("[recipient]", $sales->buyer->username, $whatsapp_content);
					$whatsapp_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $whatsapp_content);
					$whatsapp_content = str_replace("[role]", 'buyer', $whatsapp_content);
					$whatsapp_content = str_replace("[level]", 'level '.$buyerlevels, $whatsapp_content);
					$whatsapp_content = str_replace("[username]", $sales->buyer->username, $whatsapp_content);

					$whatsapp_unsubscribe_link ='Click here to unsubscribe whatsapp messages ' .  url('unsubscribeWhatsapp', $user->uuid);
                    $whatsapp_content = str_replace("[unsubscribe]", $whatsapp_unsubscribe_link, $whatsapp_content); 

					if($sales->buyer->contact_email)
					{
						if(!empty($user) && !empty($sales))
						{
							$dt = new DateTime();
							Mail::send('backend.mail.default', ['name' => 'Invoice', 'body' => $email_content], function ($message) use ($user,$sales,$mpdf,$email_subject) {
								$message->subject($email_subject);
								if($sales->buyer->email != ''){ $message->to($sales->buyer->email); }
								$message->attachData($mpdf->output("Invoice.pdf",'S'), "Invoice.pdf");
							});
						}
					}
				}
				if($email_template->buyer_sms_content != '' || $email_template->buyer_sms_content_de != '' || $email_template->buyer_sms_content_pl != '')
				{
					if($sales->buyer->contact_whatsapp)
					{
						//Whatsapp
						$content = $mpdf->output("Invoice.pdf",'S');
						$content = chunk_split(base64_encode($content));
						SendWhatsapp(['phone' => $sales->buyer->phone, 'body' => $whatsapp_content, 'is_PDF'=>false]);
						SendWhatsapp(['phone' => $sales->buyer->phone, 'body' => "data:application/pdf;base64,".$content, 'filename'=>'Invoice.pdf', 'caption'=>'Invoice', 'is_PDF'=>true]);
					}
				}
				if($sales->buyer->contact_sms)
				{
					//Text
					//SendSMS($sales->buyer->phone, $seller_url);
				}
			}
			//----------- The Buyer Email Content -----------//

			//----------- The Trader Email Content -----------//
			if( in_array(1003 ,explode(',',$email_template->recipients)) )
			{
				$traderdata = Auth()->user();			
				if($locale == 'de')
				{
					$email_content = $globalHeader['header'];
					$whatsapp_content = $globalHeader['header'];
					$whatsapp_content .= "\r\n";

					$email_content .= $email_template->trader_email_content_de;
					$whatsapp_content .= $email_template->trader_sms_content_de;
					$email_subject = $email_template->subject;
					
					$whatsapp_content .= "\r\n";
					$email_content .= $globalHeader['footer'];
					$whatsapp_content .= $globalHeader['footer'];
				}
				elseif($locale == 'pl')
				{
					$email_content = $globalHeader['header'];
					$whatsapp_content = $globalHeader['header'];
					$whatsapp_content .= "\r\n";

					$email_content .= $email_template->trader_email_content_pl;
					$whatsapp_content .= $email_template->trader_sms_content_pl;
					$email_subject = $email_template->subject;

					$whatsapp_content .= "\r\n";
					$email_content .= $globalHeader['footer'];
					$whatsapp_content .= $globalHeader['footer'];
				}
				else
				{
					$email_content = $globalHeader['header'];
					$whatsapp_content = $globalHeader['header'];
					$whatsapp_content .= "\r\n";

					$email_content .= $email_template->trader_email_content;
					$whatsapp_content .= $email_template->trader_sms_content;
					$email_subject = $email_template->subject;
					
					$whatsapp_content .= "\r\n";
					$email_content .= $globalHeader['footer'];
					$whatsapp_content .= $globalHeader['footer'];
				}

				if($email_template->trader_email_content_de != '' || $email_template->trader_email_content_pl != '' || $email_template->trader_sms_content != '')
				{
					$traderlevels = isset($traderdata->trust_level) == "" ? "1" : isset($traderdata->trust_level);
					$title = $traderdata->gender == 0 ? 'King':'Queen';

					$email_content = str_replace("[title]", $title, $email_content);
					$email_content = str_replace("[recipient]", $traderdata->first_name.' '.$traderdata->last_name, $email_content);
					$email_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $email_content);
					$email_content = str_replace("[role]", 'trader', $email_content);
					$email_content = str_replace("[level]", 'level '.$traderlevels, $email_content);
					$email_content = str_replace("[username]", $traderdata->first_name.' '.$traderdata->last_name, $email_content);

					$whatsapp_content = str_replace("[title]", $title, $whatsapp_content);
					$whatsapp_content = str_replace("[recipient]", $traderdata->first_name.' '.$traderdata->last_name, $whatsapp_content);
					$whatsapp_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $whatsapp_content);
					$whatsapp_content = str_replace("[role]", 'trader', $whatsapp_content);
					$whatsapp_content = str_replace("[level]", 'level '.$traderlevels, $whatsapp_content);
					$whatsapp_content = str_replace("[username]", $traderdata->first_name.' '.$traderdata->last_name, $whatsapp_content);
					$whatsapp_unsubscribe_link ='Click here to unsubscribe whatsapp messages ' .  url('unsubscribeWhatsapp', $user->uuid);
                    $whatsapp_content = str_replace("[unsubscribe]", $whatsapp_unsubscribe_link, $whatsapp_content); 

					if($traderdata->email)
					{
						$dt = new DateTime();
						Mail::send('backend.mail.default', ['name' => 'Invoice', 'body' => $email_content], function ($message) use ($user,$traderdata,$mpdf,$email_subject) {
							$message->subject($email_subject);
							if($traderdata->email != ''){ $message->to($traderdata->email); }
							$message->attachData($mpdf->output("Invoice.pdf",'S'), "Invoice.pdf");
						});
					}
				}
				if($email_template->trader_sms_content != '' || $email_template->trader_sms_content_de != '' || $email_template->trader_sms_content_pl != '')
				{
					if($traderdata->phone)
					{
						//Whatsapp
						$content = $mpdf->output("Invoice.pdf",'S');
						$content = chunk_split(base64_encode($content));
						SendWhatsapp(['phone' => $sales->buyer->phone, 'body' => $whatsapp_content, 'is_PDF'=>false]);
						SendWhatsapp(['phone' => $sales->buyer->phone, 'body' => "data:application/pdf;base64,".$content, 'filename'=>'Invoice.pdf', 'caption'=>'Invoice', 'is_PDF'=>true]);
					}
				}
				if($traderdata->phone)
				{
					//Text
					//SendSMS($traderdata->phone, $seller_url);
				}
			}
			//----------- The Trader Email Content -----------//

			if(isset($email_template->roles_content))
			{
				$roles = Roles::get();
				$recipients_template = json_decode($email_template->roles_content);
				foreach($roles as $role)
				{
					$rolename = $role->name;
					if( in_array($role->id ,explode(',',$email_template->recipients)) )
					{
						$loads_status = Loadstatus::where('id',$sales->trucksone[0]->load_status)->pluck('status')->first();
						$mpdf = new \Mpdf\Mpdf();
						$template = view('backend.sales.invoice',compact('sales','user','PurchaseOrder','loads_status'));
						$mpdf->WriteHTML($template->render());
						$allroles = array();
						if(Roles::where('name', $role->name)->exists())
						{
							$allroles[] = $role->name;
						}
						$users = User::role(@$allroles)->get();
						
						foreach ($users as $rolesmail) 
						{
							$titles = $user->gender == 0 ? 'King':'Queen';
							
							if($locale == 'de')
							{
								$email_content = $globalHeader['header'];
								$whatsapp_content = $globalHeader['header'];
								$whatsapp_content .= "\r\n";

								$email_content .= $recipients_template->$rolename->email_content_de;
								$whatsapp_content .= $recipients_template->$rolename->sms_content_de;
								$email_subject = $email_template->subject;
								
								$whatsapp_content .= "\r\n";
								$email_content .= $globalHeader['footer'];
								$whatsapp_content .= $globalHeader['footer'];
							}
							elseif($locale == 'pl')
							{
								$email_content = $globalHeader['header'];
								$whatsapp_content = $globalHeader['header'];
								$whatsapp_content .= "\r\n";

								$email_content .= $recipients_template->$rolename->email_content_pl;
								$whatsapp_content .= $recipients_template->$rolename->sms_content_pl;
								$email_subject = $email_template->subject;
								
								$whatsapp_content .= "\r\n";
								$email_content .= $globalHeader['footer'];
								$whatsapp_content .= $globalHeader['footer'];
							}
							else
							{
								$email_content = $globalHeader['header'];
								$whatsapp_content = $globalHeader['header'];
								$whatsapp_content .= "\r\n";

								$email_content .= $recipients_template->$rolename->email_content;
								$whatsapp_content .= $recipients_template->$rolename->sms_content;
								$email_subject = $email_template->subject;
								
								$whatsapp_content .= "\r\n";
								$email_content .= $globalHeader['footer'];
								$whatsapp_content .= $globalHeader['footer'];
							}
							
							$email_content = str_replace("[title]", $titles, $email_content);
							$email_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $email_content);
							$email_content = str_replace("[role]", $role->name, $email_content);
							$email_content = str_replace("[order_id]", $sales->id, $email_content);
							$email_content = str_replace("[buyer_id]", $sales->buyer->id, $email_content);
							$email_content = str_replace("[seller_id]", $sellerdata->id, $email_content);
							$email_content = str_replace("[product_id]", $sales->stock->product_id, $email_content);
							$email_content = str_replace("[username]", $sales->buyer->username, $email_content);
							$email_content = str_replace("[order_cofirm_url]", $seller_confirm_url, $email_content);
							$email_content = str_replace("[order_edit_url]", $seller_edit_loads, $email_content);

							$whatsapp_content = str_replace("[title]", $titles, $whatsapp_content);
							$whatsapp_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $whatsapp_content);
							$whatsapp_content = str_replace("[role]", $role->name, $whatsapp_content);
							$whatsapp_content = str_replace("[role]", $role->name, $whatsapp_content);
							$whatsapp_content = str_replace("[order_id]", $sales->id, $whatsapp_content);
							$whatsapp_content = str_replace("[buyer_id]", $sales->buyer->id, $whatsapp_content);
							$whatsapp_content = str_replace("[seller_id]", $sellerdata->id, $whatsapp_content);
							$whatsapp_content = str_replace("[product_id]", $sales->stock->product_id, $whatsapp_content);
							$whatsapp_content = str_replace("[username]", $sales->buyer->username, $whatsapp_content);
							$whatsapp_content = str_replace("[order_cofirm_url]", $seller_confirm_url, $whatsapp_content);
							$whatsapp_content = str_replace("[order_edit_url]", $seller_edit_loads, $whatsapp_content);
							if(isset($rolesmail->email))
							{
								if($role->name == 'seller')
								{
									$sellertrust = Seller::where('user_id',$rolesmail->id)->first();
									$levels = isset($sellertrust->trust_level) == '' ? '1' : $sellertrust->trust_level;
									$email_content = str_replace("[level]", 'level '.$levels, $email_content);
									$whatsapp_content = str_replace("[level]", 'level '.$levels, $whatsapp_content);
								}
								elseif($role->name == 'buyer')
								{
									$buyertrust = Buyer::where('user_id',$rolesmail->id)->first();
									$levels = isset($buyerdata->trust_level) == '' ? '1' : $buyertrust->trust_level;
									$email_content = str_replace("[level]", 'level '.$levels, $email_content);
									$whatsapp_content = str_replace("[level]", 'level '.$levels, $whatsapp_content);
								}
								else
								{
									$email_content = str_replace("[level]", 'level 1', $email_content);
									$whatsapp_content = str_replace("[level]", 'level 1', $whatsapp_content);
								}
								if($recipients_template->$rolename->email_content_de != '' || $recipients_template->$rolename->email_content_pl != '' || $recipients_template->$rolename->email_content != '')
								{
									$email_content = str_replace("[recipient]", $rolesmail->first_name.' '.$rolesmail->last_name, $email_content);
									$email_content = str_replace("[order_url]", $order_link, $email_content);
									Mail::send('backend.mail.default', ['name' => 'Invoice', 'body' => $email_content], function ($message) use ($rolesmail,$mpdf,$email_subject) {
										$message->subject($email_subject);
										if($rolesmail->email != '')
										{
											$message->to($rolesmail->email); 
										}
										$message->attachData($mpdf->output("Invoice.pdf",'S'), "Invoice.pdf");
									});
								}
							}
							$whatsapp_content = str_replace("[order_url]", $sales_url, $whatsapp_content);
							$whatsapp_content = str_replace("[recipient]", $rolesmail->first_name.' '.$rolesmail->last_name, $whatsapp_content);
							$whatsapp_unsubscribe_link ='Click here to unsubscribe whatsapp messages ' .  url('unsubscribeWhatsapp', $user->uuid);
                    		$whatsapp_content = str_replace("[unsubscribe]", $whatsapp_unsubscribe_link, $whatsapp_content); 
							if($recipients_template->$rolename->sms_content != '' || $recipients_template->$rolename->sms_content_de != '' || $recipients_template->$rolename->sms_content_pl != '')
							{
								SendWhatsapp(['phone' => $rolesmail->phone,'body' => $whatsapp_content,'is_PDF'=>false]);
							}
						}
					}
				}
			}
		}
	}

	public function sendPriceList($user, $saleid, $buyerid, $deliverydate, $stockid, $main_total)
	{
		$sales = Sale::with('stock', 'stock.seller', 'stock.product','buyer','trucksone')->where('id', @$saleid)->first();
		$PurchaseOrder = PurchaseOrder::create(['buyer_id' => @$buyerid,'delivery_date'=>@$deliverydate,'seller_id' => @$sales->stock->seller->id,'stock_id' => $stockid,'price' => $main_total,'sale_id' => @$saleid]);
		$mpdf = new \Mpdf\Mpdf();
		$template = utf8_encode(view('backend.sales.price_list',compact('sales','user','PurchaseOrder')));
		$mpdf->WriteHTML($template);
		$sellerdata = Seller::with('user')->findOrFail($sales->stock->seller->id);
		$buyerdata = buyer::with('user')->findOrFail($sales->buyer_id);
		$email_template = get_email_template('PRICE LIST');
		\App\EmailTemplate::where('title', 'PRICE LIST')->increment('sent');
		
		$locale = \App::getLocale();
		
		if($email_template->roles_content)
        {
			$email_content = '';
			$email_subject = '';
			$globalHeader = getHeaderFooter($email_template->id, $locale);
			$roles = Roles::get();
			foreach($roles as $role)
			{
				if($role->name == 'seller' || $role->name == 'buyer' || $role->name == 'executive' || $role->name == 'trans' || $role->name == 'usermanager')
				{
					continue;
				}
				else
				{
					$allroles = array();
					if(Roles::where('name', $role->name)->exists())
					{
						$allroles[] = $role->name;
					}
					$rolename = $role->name;
					$users = User::role(@$allroles)->get();
					$recipients_template = json_decode($email_template->roles_content);
					if(@$recipients_template->$rolename)
					{
						foreach ($users as $rolesmail) 
						{
							$title = $user->gender == 0 ? 'King':'Queen';
							if($locale == 'de')
							{
								$email_content = $globalHeader['header'];
								
								$email_content .= $recipients_template->$rolename->email_content_de;
								$email_subject = $recipients_template->$rolename->subject;

								$email_content .= $globalHeader['footer'];
							}
							elseif($locale == 'pl')
							{
								$email_content = $globalHeader['header'];

								$email_content .= $recipients_template->$rolename->email_content_pl;
								$email_subject = $recipients_template->$rolename->subject;

								$email_content .= $globalHeader['footer'];
							}
							else
							{
								$email_content = $globalHeader['header'];

								$email_content .= $recipients_template->$rolename->email_content;
								$email_subject = $recipients_template->$rolename->subject;

								$email_content .= $globalHeader['footer'];
							}

							$email_content = str_replace("[title]", $title, $email_content);
							$email_content = str_replace("[seller_name]", $sellerdata->username, $email_content);
							$email_content = str_replace("[product_name]", $sales->stock->product->name, $email_content);
							$email_content = str_replace("[stock_price]", $sales->price, $email_content);
							$email_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $email_content);
							if(isset($rolesmail->email))
							{
								$email_content = str_replace("[recipient]", $rolesmail->first_name.' '.$rolesmail->last_name, $email_content);
								$email_content = str_replace("[level]", 'level 1', $email_content);
								$email_content = str_replace("[role]", $rolename, $email_content);
								
								Mail::send('backend.mail.default', ['name' => 'price_list', 'body' => $email_content], function ($message) use ($rolesmail,$mpdf,$email_subject) {
									$message->subject($email_subject);	
									if($rolesmail != '')
									{ 
										$message->to($rolesmail->email); 
									}
									$message->attachData($mpdf->output("pricelist.pdf",'S'), "pricelist.pdf");
								});
							}
						}
					}
				}
			}

			//----------- The Buyer Email Content -----------//
			if( in_array(1002 ,explode(',',$email_template->recipients)) )
			{
				if($locale == 'de')
				{
					$email_content = $globalHeader['header'];

					$email_content .= $email_template->buyer_email_content_de;

					$email_content .= $globalHeader['footer'];
				}
				elseif($locale == 'pl')
				{
					$email_content = $globalHeader['header'];

					$email_content .= $email_template->buyer_email_content_pl;

					$email_content .= $globalHeader['footer'];
				}
				else
				{
					$email_content = $globalHeader['header'];

					$email_content .= $email_template->buyer_email_content;

					$email_content .= $globalHeader['footer'];
				}
				$email_content = str_replace("[recipient]", $buyerdata->username, $email_content);
				$levels = isset($buyerdata->trust_level) == '' ? '1' : $buyerdata->trust_level;
				$email_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $email_content);
				$email_content = str_replace("[role]", 'buyer', $email_content);
				$email_content = str_replace("[level]", 'level '.$levels, $email_content);
				$email_content = str_replace("[product_name]", $sales->stock->product->name, $email_content);
				$email_content = str_replace("[stock_price]", $sales->price, $email_content);
				$email_subject = $email_template->subject;
			

				$send=0;
				$next_date=get_next_date($buyerdata->user_id, $message_type='sale_confirmed');
				$digest=get_next_date($buyerdata->user_id, $message_type='sale_confirmed');
				if($next_date)
				{
					if($next_date==date("Y-m-d"))
					{
						$send=1;
						update_next_date($buyerdata->user_id, $message_type='sale_confirmed',$next_date);
					}else{
						return true;
					}  
				}

				if(!empty($user) && !empty($sales))
				{
					Mail::send('backend.mail.default', ['name' => 'price_list', 'body' => $email_content], function ($message) use ($buyerdata,$mpdf,$email_subject) {
						if(	$send==0){
							$message->subject($email_subject);	
						}else{
							$message->subject($email_subject.' Digest for'.$digest.' days');
						}
					
						if($buyerdata->email != '')
						{ 
							$message->to($buyerdata->email); 
						}
						$message->attachData($mpdf->output("pricelist.pdf",'S'), "pricelist.pdf");
					});
				}
			}
		}
	}

	public function show($id)
	{
		$sale = Sale::where(['id' => $id])->first();
		if($sale)
		{
			$sale = Sale::with('buyer', 'stock', 'paymentType', 'paymentTerms', 'currencyId')->where('id', $sale->id)->first();
			$offer = Stock::with('product', 'seller')->where('id', @$sale->stock_id)->first();
			$saleTrucks = SaleTruck::where('sale_id', $sale->id)->get();
			return view('backend.sales.show',compact('sale','offer','saleTrucks'));
		}
		else
		{
		   	$msg="Unfortunately this sales is not exist!";
			return view('backend.sales.index', compact('msg'));
		} 
	}

	public function edit($id)
	{
		$sale = Sale::where(['id' => $id])->first();
		if($sale)
		{
			$stockid = Stock::pluck('id','id');
			$buyers = Buyer::where('status', '1')->pluck('username','id');
			$matches = Match::pluck('id','id');
			$payment_types = \App\AppHead::where('type', 'payment_type')->pluck('name','id');
			$payment_terms = \App\AppHead::where('type', 'payment_terms')->pluck('name','id');
			$currencyIds = \App\AppHead::where('type', 'currency')->pluck('name','id');
			$saleTrucks = SaleTruck::where('sale_id', $sale->id)->get();
			$saledelivery = Saledelivery::where('salesid', $sale->id)->get();
			$loads_status = Loadstatus::get();
			$currentsaleTrucks = current($saleTrucks);
		
			return view('backend.sales.edit',compact( 'buyers','loads_status' ,'matches', 'payment_types', 'payment_terms', 'currencyIds', 'sale', 'saleTrucks','saledelivery','stockid'));
		}
		else
		{
			$msg="Unfortunately this sales is not exist!";
		  	return view('backend.sales.index',compact('msg'));
		} 
	}

	public function update(Request $request, Sale $sale)
	{
		$all = $request->all();
		if(isset($request->truck))
		{
			$valid_array = array();
			foreach($request->truck as $keyMain => $truck)
			{
				if (is_array($truck))
				{	
					foreach($truck as $key => $val)
					{
						if(is_array($val))
						{		
							$valid_Val['price'] = 'truck.'.$keyMain.'.'.$key.'.price';
							$valid_Val['sale_date'] = 'truck.'.$keyMain.'.'.$key.'.sale_date';
							$valid_Val['delivery_location'] = 'truck.'.$keyMain.'.'.$key.'.delivery_location';
							$valid_Val['delivery_date'] = 'truck.'.$keyMain.'.'.$key.'.delivery_date';
							$valid_Val['truck_loads'] = 'truck.'.$keyMain.'.'.$key.'.truck_loads';
							array_push($valid_array,$valid_Val);
						}
					}
				}
			}
		}
		if(isset($valid_array[0]) && $valid_array[0]!='')
		{			
			foreach($valid_array as $key => $value)
			{
				if(isset($value))
				{
					$request->validate([
						'buyer_id' => 'required',
						'match_id' => 'required',
						'stock_id' => 'required',
						'quantity' => 'required',
						'payment_term' => 'required',
						'payment_type' => 'required',
						'payment_currency' => 'required',
						'defect_percentage'=> 'required',
						'truck.*.delivery_date'=>'required',
						'truck.*.number_of_loads'=>'required',
						$value['price']=>'required',
						$value['sale_date']=>'required',
						$value['delivery_location']=>'required',
						$value['delivery_date']=>'required',
						$value['truck_loads']=>'required',
					  ],[
						'truck.*.delivery_date.required' => 'The delivery date field is required.',
						'truck.*.number_of_loads.required' => 'The number of loads field is required.',
						$value['price'].'.required' => 'The price field is required.',
						$value['sale_date'].'.required' => 'The sale date field is required.',
						$value['delivery_location'].'.required' => 'The delivery location field is required.',
						$value['delivery_date'].'.required' => 'The delivery date field is required.',
						$value['truck_loads'].'.required' => 'The truck loads field is required.',
					]);
				}
			}
		}
		else
		{
			$request->validate([
				'buyer_id' => 'required',
				'match_id' => 'required',
				'stock_id' => 'required',
				'quantity' => 'required',
				'payment_term' => 'required',
				'payment_type' => 'required',
				'payment_currency' => 'required',
				'defect_percentage'=> 'required',
				'truck.*.delivery_date'=>'required',
				'truck.*.number_of_loads'=>'required',
			],[
				'truck.*.delivery_date.required' => 'The delivery date field is required.',
				'truck.*.number_of_loads.required' => 'The number of loadssss field is required.',
			]);
		}
		
		$total = 0;

		if($request->has('truck'))
		{
			foreach($all['truck'] as $truck)
			{
				$total += (isset($truck['price'])) ? $truck['price'] : 0;
			}
        }
		$tableArray = ['buyer_id' => $request->buyer_id, 'match_id' => $request->match_id, 'stock_id' => $request->stock_id, 'quantity' => $request->quantity, 'price' => $total,'payment_term' => $request->payment_term, 'payment_type' => $request->payment_type, 'payment_currency' => $request->payment_currency, 'status' => $request->status,'defect_percentage'=>$request->defect_percentage];

		$sale->update($tableArray);
		$saleTrucks = SaleTruck::where('sale_id', $sale->id)->get();
		foreach($saleTrucks as $saleTruck)
		{
			$saleTruck->delete();
		}
		$Saledelivery = Saledelivery::where('salesid', $sale->id)->get();
		foreach($Saledelivery as $Saledelivery)
		{
			$Saledelivery->delete();
		}
		if($request->has('truck'))
		{
			$index = 1;
			foreach($all['truck'] as $ky => $delivery)
			{
				if (is_array($delivery))
				{
					$deliveryid = Saledelivery::create(['salesid' => $sale->id, 'deliverymain' => date('Y-m-d',strtotime($delivery['delivery_date'])),'loadcount' => $delivery['number_of_loads']]);
					foreach($delivery as $key => $truck)
					{
						if(is_array($truck))
						{
							$total += $val['price'];
							$SaleTruck = SaleTruck::create(['sale_id' => $sale->id, 'sale_date' => date('Y-m-d',strtotime($truck['sale_date'])), 'delivery_date' => date('Y-m-d',strtotime($truck['delivery_date'])), 'price' => isset($truck['price'])?$truck['price']:'0', 'delivery_location'=>$truck['delivery_location'], 'truck_loads'=> $truck['truck_loads'], 'load_status'=>$truck['load_status'], 'number_delivery'=>$index, 'deliveryid' => $deliveryid->id]);
							$index++;
						}
					}
				}
			}
		}
		$sale->update($request->all());
		return response()->json(['status' => 'success', 'message' => 'Sale updated successfully!']);
    }

	public function destroy(Sale $sale)
	{
        $sale->delete();
        return response()->json(['success'=>'Sale deleted successfully.']);
    }

	public function getbuyerpaymentprefAjax(Request $request)
	{
        $buyers = BuyerPaymentDetails::with('paymentType','paymentTerms','currencyId')->where('buyer_id', $request->buyer_id)->get();
		$payment_options = '<option value="">Select</option>';
		foreach($buyers as $buyer)
		{
			$option = '<option value="'.@$buyer->payment_type.'_'.@$buyer->payment_terms.'_'.@$buyer->currency.'">'.ucfirst(@$buyer->paymentType->name).", ".@$buyer->paymentTerms->name." days, ".@$buyer->currencyId->name.'</option>';
			$payment_options .= $option;
		}
        return response()->json(['payment_options'=>$payment_options]);
	}
	
	public function getdeliveryaddressAjax(Request $request)
	{
		$buyer=Buyer::where('id',$request->buyer_id)->first();
		$buyer_address=$buyer->address.', '. $buyer->country.', '. $buyer->city.', '. $buyer->postalcode;
		return response()->json(['buyer_address'=>$buyer_address]);
	}

	public function getmatchAjax(Request $request)
	{
        $match = Match::where('id', $request->match_id)->first();
		$offer = Stock::with('product', 'seller', 'variety_detail', 'packing_detail', 'flesh_color_detail')->where('id', @$match->stock_id)->first();

		$seller_username = @$offer->seller->username;
		$product_name = @$offer->product->name;
		$variety_detail_name = @$offer->variety_detail->name;
		$packing_detail_name = @$offer->packing_detail->name;
		$size_from = @$offer->size_from;
		$size_to = @$offer->size_to;
		$flesh_color_detail_name = @$offer->flesh_color_detail->name;
		return response()->json(['stock_id'=>@$match->stock_id,'seller_username'=>$seller_username,'product_name'=>$product_name,'variety_detail_name'=>$variety_detail_name,'packing_detail_name'=>$packing_detail_name,'size_from'=>$size_from,'size_to'=>$size_to,'flesh_color_detail_name'=>$flesh_color_detail_name,'location'=>$offer->country,'postalcode'=>$offer->postalcode]);
    }

	public function getStockAjax(Request $request)
	{
        $offer = Stock::with('product', 'seller','offerProperty','offerProperty.productSpec','offerProperty.productSpecValue')->where('id', @$request->stock_id)->first();
		if($offer!=NULL)
		{
			$seller_username = @$offer->seller->username;
			$product_name = @$offer->product->name;
			$size_from = @$offer->size_from;
			$size_to = @$offer->size_to;
			$offerProperties = ['Seller'=>$seller_username,'Product'=>$product_name,'Size From'=>$size_from,'Size To'=>$size_to,'Location'=>$offer->country,'Postal Code'=>$offer->postalcode,'Price'=>@$offer->price];

			$offerPropertiesArr = array();
			foreach($offer->offerProperty as $productPref)
			{
				if(isset($productPref->productspec))
				{
					$offerPropertiesArr[$productPref->productspec->display_name][] = (($productPref->productspec->field_type == 'dropdown_switchboxes')?@$productPref->productspecvalue->value:$productPref->value);
				}
			}
			foreach($offerPropertiesArr as $display_name=>$arr)
			{
				$offerProperties[$display_name] = implode(', ',$arr??array());
			}
			return response()->json($offerProperties);
		}
		else
		{
			return "";
		}
    }

	public function saleexports()
    {
        return Excel::download(new SalesExport, 'sales.xlsx');
    }

	public function saletotran()
    {
		$TransLoadq = TransLoad::get();
		$trans_arr = array();

		foreach($TransLoadq as $TransLoadv)
		{
			$trans_arr []= $TransLoadv->salesid;
		}

		$sales = Sale::whereNotIn('id',$trans_arr)->get();
		
		foreach($sales as $sale)
		{
			$SaleTruck = SaleTruck::where('sale_id',$sale->id)->groupBy('number_delivery')->get();
			foreach($SaleTruck as $saletruckvalue)
			{
				$Transportlist = Transportlist::create(['salesid' => $sale->id, 'carrier'=>"0",'trailer_type'=>"0",'temperature'=>"0",'plate_numbers'=>"0",'drivers_name'=>"0",'drivers_phone_number'=>"0",'salestatus'=>"unplanned"])->id;	
				$SaleTruck_load = SaleTruck::where('sale_id',$sale->id)->where('number_delivery',$saletruckvalue->number_delivery)->get();
				foreach($SaleTruck_load as $saletruckloadvalue)
				{
					 $offer = Stock::with('product', 'seller','offerProperty','offerProperty.productSpec','offerProperty.productSpecValue')->where('id', $sale->stock_id)->first();
					if($offer!=NULL)
					{
						$product_name = @$offer->product->id;
						$size_from = @$offer->size_from;
						$size_to = @$offer->size_to;
						
						$offerPropertiesArr = array();
						foreach($offer->offerProperty as $productPref)
						{
							if(isset($productPref->productspec))
							{
								$offerPropertiesArr[$productPref->productspec->display_name][] = (($productPref->productspec->field_type == 'dropdown_switchboxes')?@$productPref->productspecvalue->value:$productPref->value);
							}
						}
						foreach($offerPropertiesArr as $display_name=>$arr)
						{
							$offerProperties[$display_name] = implode(', ',$arr??array());
						}
						
						$TransLoad = TransLoad::create(['salesid' => isset($sale->id)?$sale->id:'', 'goods'=>isset($product_name)?$product_name:'','variety'=>'0','size_from'=>isset($size_from)?$size_from:'','size_to'=>isset($size_to)?$size_to:'','loaded_weight'=>'0','unloaded_weight'=>'0','difference'=>'0','packaging_type'=>'','number_of_packing_units'=>isset($saletruckloadvalue->truck_loads)?$saletruckloadvalue->truck_loads:'','requirements'=>'','freight_cost'=>isset($saletruckloadvalue->price)?$saletruckloadvalue->price:'','payment_term'=>isset($sale->payment_term)?$sale->payment_term:'','payment_type'=>isset($sale->payment_type)?$sale->payment_type:'','transport_invoice_no'=>'','transport_invoice_due_date'=>'','payment_status'=>isset($sale->payment_status)?$sale->payment_status:'','transport_id'=>isset($Transportlist)?$Transportlist:'']);
						
						$salesdata = Sale::with('stock', 'stock.seller', 'stock.product','buyer','trucksone')->where('id', @$sale->id)->first();
						
						SendWhatsapp(['phone' => $salesdata->stock->seller->phone,'body' => "New Sale create. Transload id ".$TransLoad->id]);
						
						Mail::send('backend.mail.default', ['name' => 'Sales created', 'body' => '<div stype="color:#000">New Sale created. TransLoad Id '.$TransLoad->id.'</div>'], function ($message) use ($user,$sales) {
							$message->subject('Sales created of Veg King!');
							$message->to($salesdata->stock->seller->email); 
						});
					}
				}
			}
		}
		return response()->json(['status' => 'success', 'message' => 'Send to transport successfully.']);
	}

	public function InvoiceView(Request $request,Sale $sale)
	{
		$user = auth()->user();
		$url = url('/') .'/img/'. Settings()->site_logo;
		$sales = Sale::with('stock', 'stock.seller', 'stock.product','buyer','trucksone')->where('id', @$sale->id)->first();
		$PurchaseOrder = PurchaseOrder::where('sale_id', @$sale->id)->select('id')->first();
		if(!empty($user) && !empty($sales))
		{
			$loads_status = Loadstatus::where('id',$sales->trucksone[0]->load_status)->pluck('status')->first();
			$mpdf = new \Mpdf\Mpdf();
			$template = view('backend.sales.invoice',compact('sales','user','PurchaseOrder','loads_status'));
			$mpdf->WriteHTML($template->render());
			$mpdf->Output();
		}
		else
		{
			return redirect()->route('admin.sales.index')->with('error','Invalid Request');
		}
	}
}
