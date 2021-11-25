<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Sale;
use App\ExcelImport;
use App\TransLoad;
use App\Carrier;
use App\CarrierContact;
use App\Transportlist;
use App\Transshipper;
use App\Transconsignee;
use App\Product;
use App\Loadstatus;
use App\SaleTruck;
use App\Buyer;
use App\Seller;
use App\Stock;
use App\Exports\TransportExport;
use File;
use Mail;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;


class TransportlistController extends Controller{
	
	public function __construct(){
        $this->transportwhatsapp = '+91123456789';
        $this->transportmail = 'dev.kretoss@gmail.com';
    }

  public function index(Request $request){
		$transportArr = array();
		  
		  $carrieroptions = Carrier::select('id','name')->get();
		 
	if ($request->ajax()) {
           $data = TransLoad::with('transportdata','salesdata','trucks','product','offerget','buyerget','sellerget')->select('id','salesid','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->get();
			if(auth()->user()->hasRole('seller')){
				$carrieroptions = Carrier::select('id','name')->get();
				$seller_id = Seller::select('id')->where('user_id',auth()->user()->id)->get();
				$offer_id = Stock::select('id')->whereIn('seller_id',$seller_id)->get();
				$sale_id = Sale::select('id')->whereIn('stock_id',$offer_id)->get();
				$data = TransLoad::with('transportdata','salesdata','trucks','product','offerget','buyerget','sellerget')->select('id','salesid','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->whereIn('salesid',$sale_id)->get();
			}

		return Datatables::of($data)
          ->addIndexColumn()
		  
          ->addColumn('action', function($row){
				$btn = ' <div class="btn-group btn-group-sm">
							<button type="button" data-id="'.$row->id.'" class="btn btn-primary editItem" data-url="'.route('admin.transportlist.edit', $row->id).'"><i class="fas fa-edit"></i></button></div>';
                return $btn;
          })
		  
		  ->addColumn('product', function($row){
			  return (@$row->product->name?@$row->product->name:'-');
           })
		  ->addColumn('unloaddate', function($row){
			 return (@$row->trucks->delivery_date?@$row->trucks->delivery_date:'-');
		  })
		   ->addColumn('loadloc', function($row){
			    return (@$row->offerget->country?@$row->offerget->country:'-');
			     
          })
		  ->addColumn('unloadloc', function($row){
			   return (@$row->trucks->delivery_location?@$row->trucks->delivery_location:'-');
		  })
		  ->addColumn('buyer', function($row){
			   return (@$row->buyerget->username?@$row->buyerget->username:'-');
			   
          })
		   ->addColumn('carrier', function($row){
				return (@$row->transportdata->carrier?@$row->transportdata->carrier:'-');
          })
		  ->addColumn('plateno', function($row){
				return (@$row->transportdata->plate_numbers?@$row->transportdata->plate_numbers:'-');				
	      })
		  ->addColumn('seller', function($row){
			  return (@$row->sellerget->username?@$row->sellerget->username:'-');
          })
		  ->rawColumns(['action'])
		  ->make(true);
      }
		
		return view('backend.transport.index',compact('carrieroptions'));
		 
		
	
  }
	public function gettransportloads(Request $request){ 
		
		$transportArr = array();
		$transportlist1 = TransLoad::where('id',$request->transport_id)->get();
		$shipperlist = Transshipper::where('loadid',$request->transport_id)->get();
		$consigneelist = Transconsignee::where('loadid',$request->transport_id)->get();
		$seller_username = ''; 
		foreach($transportlist1 as $transvalue) {
			$sales = Sale::where('id',@$transvalue->salesid)->first();
			$product = Product::select('name')->where('id', @$transvalue['goods'])->first();
			$translist = Transportlist::where('id', @$transvalue->transport_id)->first();
			$productname = (@$product->name?@$product->name:'-');
			$payment_terms = \App\AppHead::where('type', 'payment_terms')->where('id',@$transvalue['payment_term'])->first();
			$payment_type = \App\AppHead::where('type', 'payment_type')->where('id',@$transvalue['payment_type'])->first();
			$saletruck = SaleTruck::select('delivery_date')->where('sale_id',@$transvalue->salesid)->first();
			$buyer = Buyer::where('id',@$sales->buyer_id)->first();
			$offer = Stock::with('seller')->where('id', @$sales->stock_id)->first();
			$seller_username = (@$offer->seller->username?@$offer->seller->username:'-');
			
			$seller_location = @$offer->country;
			$username = (@$buyer->username?$buyer->username:'-');
			
			if(is_null($transvalue['transport_invoice_no'])){
				$invoice_no = '';
			}
			else{
				$invoice_no = $transvalue['transport_invoice_no'];
			}
			
			if(is_null($transvalue['packaging_type'])){
				$packaging_type = '';
			}
			else{
				$packaging_type = $transvalue['packaging_type'];
			}
			
			if(is_null($transvalue['requirements'])){
				$requirements = '';
			}
			else{
				$requirements = $transvalue['requirements'];
			}
			
			if(is_null($transvalue['notes_from_accounting'])){
				$accounting = '';
			}
			else{
				$accounting = $transvalue['notes_from_accounting'];
			}
			if(is_null($transvalue['documents'])){
				$cmr = '';
				$invoicefile = '';
				$weightfile = '';
				$otherfile = '';
			}
			else{
				$docs = json_decode($transvalue['documents']);
				 
				$cmr = $docs->cmr;
				$invoicefile = $docs->invoice;
				$weightfile = $docs->weightbridge;
				$otherfile = $docs->other;
			 	
			}
			if(is_null($transvalue['notes']) || $transvalue['notes'] == 'null'){
			$notesdata = '';	
			}
			else{
			$notesdata = $transvalue['notes'];	
			}
			
			if(is_null($transvalue['customername']) || $transvalue['customername'] == 'null'){
			$customername = '';	
			}
			else{
			$customername = $transvalue['customername'];	
			}
			
			$transportArr['transdata'][]=[
				"id"=>$transvalue['id'],
				"goods"=>$productname,
				"variety"=>$transvalue['variety'],
				"size"=>$transvalue['size_from'].'-'.$transvalue['size_to'],
				"loaded_weight"=>$transvalue['loaded_weight'],
				"unloaded_weight"=>$transvalue['unloaded_weight'],
				"difference"=>$transvalue['difference'],
				"number_of_packing_units"=>$transvalue['number_of_packing_units'],
				"requirements"=>$requirements,
				"freight_cost"=>$transvalue['freight_cost'],
				"payment_term"=>$payment_terms['name'],
				"payment_type"=>$payment_type['name'],
				"payment_status"=>$transvalue['payment_status'],
				"packaging_type"=>$packaging_type,
				"invoice_no"=>$invoice_no,
				"due_date"=>$transvalue['transport_invoice_due_date'],
				"cmr1"=>$cmr,
				"invoice1"=>$invoicefile,
				"weightfile1"=>$weightfile,
				"other1"=>$otherfile,
				"account_note"=>$accounting,
				"carrier" =>$translist['carrier'],
				"salestatus" =>$translist['salestatus'],
				"loaddate"=> date('Y-m-d',strtotime($transvalue['created_at'])),
				"unloaddate"=> $saletruck['delivery_date'],
				"trailer_type" =>$translist['trailer_type'],
				"temperature" =>$translist['temperature'],
				"plate_numbers" =>$translist['plate_numbers'],
				"drivers_name" =>$translist['drivers_name'],
				"drivers_phone_number" =>$translist['drivers_phone_number'],
				"notes" =>$notesdata,
				"buyer"=> $username,
				"seller"=> $seller_username,
				"customername"=> $customername,
			];
		}
		if(count($shipperlist) > 0){
			foreach($shipperlist as $shipperdata){
				if(is_null($shipperdata->shipper_reference))
					$reference = rand();
				else
					$reference = $shipperdata->shipper_reference;
				
				if(is_null($shipperdata->shipper_address))
					$shipper_address = $seller_location;
				else
					$shipper_address = $shipperdata->shipper_address;
				
				$transportArr['shipperdata'][]=[
					"shipperid"=>$shipperdata->id,
					"shipper_loadid"=>$shipperdata->loadid,
					"shipper_name"=>$seller_username,
					"shipper_address"=>$shipper_address,
					"shipper_reference"=>$reference,
					"shipper_date"=>$shipperdata->shipper_date
					
				];
			}
		}else{
			$transportArr ['shipperdata'][] = [
				"shipperid"=>'',
				"shipper_loadid"=>'',
				"shipper_name"=>$seller_username,
				"shipper_address"=>$seller_location,
				"shipper_reference"=>rand(),
				"shipper_date"=>''
				
			];
		}

		if(count($consigneelist) > 0){
			foreach($consigneelist as $consdata){
				if(is_null($consdata->consignee_reference) || $consdata->consignee_reference == ''){
				$reference = rand();
			}
			else{
				$reference = $consdata->consignee_reference;
			}
			if(is_null($consdata->consignee_address) || $consdata->consignee_address == 'null'){
				$consigneeaddress = '';
			}
			else{
				$consigneeaddress = $consdata->consignee_address;
			}
				
				$transportArr['consigneedata'][]=[
					"consigneeid"=>$consdata->id,
					"consignee_loadid"=>$consdata->loadid,
					"consignee_name"=>$consdata->consignee,
					"consignee_address"=>$consigneeaddress,
					"consignee_reference"=>$reference,
					"consignee_date"=>$consdata->consignee_date
					
				];
			}
		}else{
			foreach($transportlist1 as $transvalue) {
				$sales = Sale::where('id',@$transvalue->salesid)->first();
				$buyer = Buyer::where('id',@$sales->buyer_id)->first();
			$username = (@$buyer->username?$buyer->username:'-'); 
			
				
			$transportArr ['consigneedata'][] = [
				"consigneeid"=>'',
				"consignee_loadid"=>'',
				"consignee_name"=>$username,
				"consignee_address"=>'',
				"consignee_reference"=>rand(),
				"consignee_date"=>''
				];
			}
			//$transportArr['consigneedata'] = [];	
		}

		return $transportArr;
	}
	public function downloadzip(Request $request){ 
		
		$transdata = TransLoad::where('id',$request->transport_id)->first();
		$getfiles = $transdata['documents'];
		$filescheck = json_decode($getfiles);
		$cmr = $invoice = $other = $weightbridge = '';
		$files = array();
		if(!empty($filescheck->cmr)){
			$cmr = $filescheck->cmr;
			$files[] = $cmr;
		}
		if(!empty($filescheck->invoice)){
			$invoice = $filescheck->invoice;
			$files[] = $invoice;
		}
		if(!empty($filescheck->other)){
			$other = $filescheck->other;
			$files[] = $other;
		}
		if(!empty($filescheck->weightbridge)){
			$weightbridge = $filescheck->weightbridge;
			$files[] = $weightbridge;
		}
		
		 

		$path = public_path('/images/transportlist/');
		$time = strtotime(now());

		$zipFileName = 'document'.$time.'.zip';
        $zip = new \ZipArchive;
        if ($zip->open($path . '' . $zipFileName, \ZipArchive::CREATE) === TRUE) {    
            foreach($files as $file) {
			 $zip->addFile($path.'/'.$file,$file);
			}        
             $zip->close();
        }
         $headers = array(
                'Content-Type' => 'application/force-download',
				'Content-Disposition: attachment; filename='.$zipFileName
            );
        $filetopath=$path.'/'.$zipFileName;
		   // header("Content-Type: application/force-download");
		  
			header("Content-type: application/zip"); 
			header("Content-Disposition: attachment; filename=$zipFileName");
			header("Pragma: no-cache"); 
			header("Expires: 0"); 
			readfile("$filetopath");
		   
		echo $filetopath;exit;
		//header('Content-Disposition: attachment; filename="'.$zipFileName.'"');
        //readfile($filetopath);
         //return response()->download($filetopath,$zipFileName,$headers);exit;
     

		// return redirect()->back();
		// return response()->download($filetopath);

        // return response()->download($filetopath);
        
		
	}
	public function edit($id){
		$transportlist = Transportlist::where(['id' => $id])->first();
		if($transportlist){
		// dd($transportlist);
		$transportArr = array();
		$getlist = TransLoad::where('id',$id)->first();
		$transportlist1 = TransLoad::where('salesid',$getlist->salesid)->get();
		$id = $id;
		//dd($id);
		foreach($transportlist1 as $transvalue) {
			$sales = Sale::where('id',$transvalue->salesid)->first();
			$product = Product::where('id', $transvalue['goods'])->first();
			$translist = Transportlist::where('salesid', $transvalue['salesid'])->first();
			$productname = @$product->name;
			$payment_terms = \App\AppHead::where('type', 'payment_terms')->where('id',$transvalue['payment_term'])->first();
			$payment_type = \App\AppHead::where('type', 'payment_type')->where('id',$transvalue['payment_type'])->first();
			
			$transportArr []=[
				"id"=>$transvalue['id'],
				"goods"=>$productname,
				"variety"=>$transvalue['variety'],
				"size"=>$transvalue['size_from'].'-'.$transvalue['size_to'],
				"loaded_weight"=>$transvalue['loaded_weight'],
				"unloaded_weight"=>$transvalue['unloaded_weight'],
				"difference"=>$transvalue['difference'],
				"number_of_packing_units"=>$transvalue['number_of_packing_units'],
				"requirements"=>$transvalue['requirements'],
				"freight_cost"=>$transvalue['freight_cost'],
				"payment_term"=>$payment_terms['name'],
				"payment_type"=>$payment_type['name'],
				"payment_status"=>$transvalue['payment_status'],
				"invoice_no"=>$transvalue['transport_invoice_no'],
				"due_date"=>$transvalue['transport_invoice_due_date'],
				"carrier" =>$translist['carrier'],
				"trailer_type" =>$translist['trailer_type'],
				"temperature" =>$translist['temperature'],
				"plat_numbers" =>$translist['plat_numbers'],
				"drivers_name" =>$translist['drivers_name'],
				"drivers_phone_number" =>$translist['drivers_phone_number']
			];
			
		}
		//echo "<pre>";print_r($transportlist);exit;
		return view('backend.transport.edittransport',compact('transportArr','id'));
		 }else{
			$carrieroptions = Carrier::get();
		  $msg="Unfortunately this Transport is not exist!";
		  return view('backend.transport.index',compact('msg','carrieroptions'));	
			 } 
	  }
	public function updatetransportloadsajax(Request $request)
	{
		 
		$all = $request->all();
		$updateArr = array();
		$shipperArr = array();
		$consigneeArr = array();
		$json_arr = $request->editr;
		 //dd($json_arr);
		//echo count($request->editr);
		//echo "<pre>";
		/*for($i=1;$i<=count($request->editr);$i++)
		{
			$updateArr []= $request->editr[$i][$i];
		}*/
		$checkfile = TransLoad::where('id',$request->loadid)->first();
		 
		
		  
		if(is_null($checkfile->documents)){
			$file1 = '';
			$file2 = '';
			$file3 = '';
			$file4 = '';
		}
		else{
			$oldfile = json_decode($checkfile->documents);
			$file1 = $oldfile->cmr;
			$file2 = $oldfile->invoice;
			$file3 = $oldfile->weightbridge;
			$file4 = $oldfile->other;
		} 
		 
		$path = public_path('/images/transportlist');
 
		$cmrfile = $invoicefile = $weightfile = $otherfile = '';
 
		if(isset($json_arr['cmr'])){
			$cmrfile = $json_arr['cmr']->getClientOriginalName();
			$json_arr['cmr']->move($path,$cmrfile);
		}
		else{
			$cmrfile = $file1;	
		}
		if(isset($json_arr['invoice'])){
			$invoicefile = $json_arr['invoice']->getClientOriginalName();
			$json_arr['invoice']->move($path,$invoicefile);
		}
		else{
			$invoicefile = $file2;	
		}
		if(isset($json_arr['weightbridge'])){
			$weightfile = $json_arr['weightbridge']->getClientOriginalName();
			$json_arr['weightbridge']->move($path,$weightfile);
		}
		else{
			$weightfile = $file3;	
		}
		if(isset($json_arr['other'])){
			$otherfile = $json_arr['other']->getClientOriginalName();
			$json_arr['other']->move($path,$otherfile);
		}
		else{
			$otherfile = $file4;	
		}
		$documentarray = array();
		$documentarray['cmr'] = $cmrfile;
		$documentarray['invoice'] = $invoicefile;
		$documentarray['weightbridge'] = $weightfile;
		$documentarray['other'] = $otherfile;
		 
		$alldocuments = json_encode($documentarray);
		  
		
		//dd($path);
		$transportArr []=[
			"loaded_weight"=>$json_arr[1]['loaded_weight'],
			"unloaded_weight"=>$json_arr[1]['unloaded_weight'],
			"difference"=>$json_arr[1]['difference'],
			"packaging_type"=>$json_arr[1]['packaging_type'],
			"number_of_packing_units"=>$json_arr[1]['number_of_packing_units'],
			"requirements"=>$json_arr[1]['requirements'],
			"freight_cost"=>$json_arr[1]['freight_cost'],
			"transport_invoice_no"=>$json_arr[1]['transport_invoice_number'],
			"transport_invoice_due_date"=>$json_arr[1]['transport_invoice_due_date'],
			"payment_status"=>$json_arr[1]['payment_status'],
			"notes_from_accounting"=>$json_arr[1]['notes_from_accounting'],
			"documents"=>$alldocuments,
			"notes"=>$json_arr[1]['notes'],
			"customername"=>$json_arr[1]['customername']
		];
		$checktransupdate = TransLoad::find($request->loadid)->update($transportArr[0]);
		 
		$transportlistArr []=[
			"carrier"=>$json_arr['carrier'],
			"trailer_type"=>$json_arr['trailer_type'],
			"temperature"=>$json_arr['temperature'],
			"plate_numbers"=>$json_arr['plate_numbers'],
			"drivers_name"=>$json_arr['drivers_name'],
			"drivers_phone_number"=>$json_arr['drivers_phone_number'],
			"salestatus"=>$json_arr[1]['status']
		];
		$transload = TransLoad::where('id',$request->loadid)->first();
		$checktransport = Transportlist::where('id',$transload->transport_id)->first();
		if(!empty($checktransport)){
		Transportlist::find($transload->transport_id)->update($transportlistArr[0]);
		}
		if($checktransupdate == true){
		//	 dd($json_arr[1]);
			foreach($json_arr[1] as $key => $val){
				if(is_int($key)){
			   
			  // dd($val);
			   //	Transshipper::create($shipperArr);
			    

			  	 $shipperArr[] = [ 
					"loadid"=>$request->loadid,
					"shipper"=>$val['shipper'],
					"shipper_address"=>$val['shipping_address'],
					"shipper_reference"=>$val['shippers_reference'],
					"shipper_date"=>$val['shipping_date']
				];
				//if(isset($val['consignee'])){
				$consigneeArr[] = [
					"loadid"=> $request->loadid,
					"consignee"=> $val['consignee'],
					"consignee_address"=> $val['consignee_address'],
					"consignee_reference"=> $val['consignee_reference'],
					"consignee_date"=> $val['delivery_date']
				];
			//}

			   }

				
			}
			$checkshipper = Transshipper::where('loadid',$request->loadid)->get();
			$checkconsignee = Transconsignee::where('loadid',$request->loadid)->get();
			   if(count($checkshipper) > 0){
				Transshipper::where('loadid', $request->loadid)->delete();
			   }
			   if(count($checkconsignee) > 0){
				Transconsignee::where('loadid', $request->loadid)->delete();
			   }
				foreach($shipperArr as $addshipper){	
				Transshipper::create([
					"loadid"=>$request->loadid,
					"shipper"=>$addshipper['shipper'],
					"shipper_address"=>$addshipper['shipper_address'],
					"shipper_reference"=>$addshipper['shipper_reference'],
					"shipper_date"=>$addshipper['shipper_date']
				 ]);
				}

				foreach($consigneeArr as $addconsignee){	
					Transconsignee::create([
						"loadid"=>$request->loadid,
						"consignee"=>$addconsignee['consignee'],
						"consignee_address"=>$addconsignee['consignee_address'],
						"consignee_reference"=>$addconsignee['consignee_reference'],
						"consignee_date"=>$addconsignee['consignee_date']
					 ]);
					}
			    
		 }
		 if($json_arr[1]['status'] == 'rejected'){
			 
		$lodatstatusid = Loadstatus::where('status','rejected')->orWhere('status','Rejected')->first();
		 if(!empty($lodatstatusid)){
		$truckupdate =  SaleTruck::where('sale_id',$checkfile->salesid)->update(
         array(
                 'load_status' => $lodatstatusid->id
              )
         );
		 }
		
     	$user = auth()->user();
		$saledata = Sale::with('stock', 'stock.seller', 'stock.product','buyer','trucksone')->where('id', $checkfile->salesid)->first();
		 
		$offer = Stock::with('seller')->where('id', $saledata->stock_id)->first();
		$seller_mobile = $saledata->stock->seller->phone;

		$whatsapp_unsubscribe_link ='Click here to unsubscribe whatsapp messages ' .  url('unsubscribeWhatsapp', $user->uuid);
        if(isset($user->whatsapp_subscription) == 1){
			SendWhatsapp(['phone' => $this->transportwhatsapp,'body' => "Load rejected. Load id ".$request->loadid . ' ' . $whatsapp_unsubscribe_link]);
			SendWhatsapp(['phone' => $seller_mobile,'body' => "Load rejected. Sales id ".$request->loadid . ' ' . $whatsapp_unsubscribe_link]);	
		} 
		
		
		Mail::send('backend.mail.default', ['name' => 'Load rejected', 'body' => '<div stype="color:#000">Load rejected. Load Id '.$request->loadid.'</div>'], function ($message) use ($user,$saledata) {
					$message->subject('Load rejected of Veg King!');
					  $message->to($saledata->stock->seller->email); 
		});
		Mail::send('backend.mail.default', ['name' => 'Load rejected', 'body' => '<div stype="color:#000">Load rejected. Load Id '.$request->loadid.'</div>'], function ($message) use ($user,$saledata) {
					$message->subject('Load rejected Veg King!');
					  $message->to($this->transportmail); 
		}); 
		 }
		  $user = auth()->user();
		$url = url('/') .'/img/'. Settings()->site_logo;
		$sales = Sale::with('stock', 'stock.seller', 'stock.product','buyer','trucksone')->where('id', $checkfile->salesid)->first();
		 
		
	//	$mpdf = new \Mpdf\Mpdf();
	//	$template = utf8_encode(view('backend.transport.invoice',compact('transportArr','user')));
      //	$mpdf->WriteHTML($template);
		//$pdffile = $mpdf->Output();
		$logs = array();
		$logs['action'] = 'Transload Edit';
		\LogActivity::addToLog($logs);
	
		return response()->json(['status' => 'success', 'message' => 'Transport list updated successfully.']);
		exit;
	}

	public function downloaddoc(Request $request){
		$transportArr = array();
		 $transportlist1 = TransLoad::get();
		// $shipperall = Transshipper::get();
		// $consigneeall = Transconsignee::get();
		foreach($transportlist1 as $transvalue) {
			$checktranslist = Transportlist::where('id',$transvalue->transport_id)->first();
			$product = Product::select('name')->where('id', $transvalue->goods)->first();
			$productname = @$product->name;
			$loadstatus = @$checktranslist->salestatus;
			$temperature = @$checktranslist->temperature;
			$trailer = @$checktranslist->trailer_type;
			$truckplate = @$checktranslist->plate_numbers;
			$drivername = @$checktranslist->drivers_name;
			$driverphone = @$checktranslist->drivers_phone_number;
			$payment_terms = \App\AppHead::where('type', 'payment_terms')->where('id',$transvalue['payment_term'])->first();
			$payment_type = \App\AppHead::where('type', 'payment_type')->where('id',$transvalue['payment_type'])->first();
			if($transvalue->salesid != 0){
			$sales = Sale::select('buyer_id','stock_id')->where('id',$transvalue->salesid)->first();
						
			$saletruck = SaleTruck::select('delivery_date','delivery_location','truck_loads')->where('sale_id',$transvalue->salesid)->first();
			$delvrdate = @$saletruck->delivery_date;
			$delvloc = @$saletruck->delivery_location;
			$truckloads = @$saletruck->truck_loads;
			$buyer = Buyer::select('username')->where('id',$sales->buyer_id)->first();
			$offer = Stock::with('seller')->where('id', $sales->stock_id)->first();
			$seller_username = $username = '';
			if(!empty($offer->seller->username)){
				$seller_username = @$offer->seller->username;
			}
			else{
				$seller_username = '';
			}
			$offer_country = '';
			if(!empty($buyer->username)){
				$username = $buyer->username;
			}
			else{
				$username = '';
			}
		 	 
			if(!empty($offer->country)){
				$offer_country = $offer->country;
			}
			}
			else{
			$seller_username = $offer_country = $username = $delvrdate = $delvloc = $truckloads = '';	
			}
			$trans_id = $trans_variety = $trans_size = $trans_loaded_weight = $trans_unloaded_weight = $trans_difference = $trans_number_of_packing_units = $trans_requirements = $trans_freight_cost = $trans_payment_status = $trans_created_at = '-';
			
			if(!empty($checktranslist)){
				$carriername = Carrier::select('name')->where('id', $checktranslist['carrier'])->first();
				$carrier = @$carriername->name;
				$plateno = $checktranslist['plate_numbers'];
			}
			else{
				$carrier = '-';
				$plateno = '-';
			}
			
			
			if(!empty($transvalue['id']))
				$trans_id = $transvalue['id'];
			if(!empty($transvalue['variety']))
				$trans_variety = $transvalue['variety'];
			if((!empty($transvalue['size_from'])) && (!empty($transvalue['size_to'])))
				$trans_size = $transvalue['size_from'].'-'.$transvalue['size_to'];
			if(!empty($transvalue['loaded_weight']))
				$trans_loaded_weight = $transvalue['loaded_weight'];
			if(!empty($transvalue['unloaded_weight']))
				$trans_unloaded_weight = $transvalue['unloaded_weight'];
			if(!empty($transvalue['difference']))
				$trans_difference = $transvalue['difference'];
			if(!empty($transvalue['number_of_packing_units']))
				$trans_number_of_packing_units = $transvalue['number_of_packing_units'];
			if(!empty($transvalue['requirements']))
				$trans_requirements = $transvalue['requirements'];
			if(!empty($transvalue['freight_cost']))
				$trans_freight_cost = $transvalue['freight_cost'];
			if(!empty($transvalue['payment_status']))
				$trans_payment_status = $transvalue['payment_status'];
			if(!empty($transvalue['created_at']))
				$trans_created_at = $transvalue['created_at'];
			 $shipperall = Transshipper::where('loadid',$trans_id)->get();
		 $consigneeall = Transconsignee::where('loadid',$trans_id)->get();
		 
			$transportArr2 []=[ 
				"id"=>$trans_id,
				"loadstatus"=>$loadstatus,
				"goods"=>$productname,
				"variety"=>$trans_variety,
				"size"=>$trans_size,
				"loaded_weight"=>$trans_loaded_weight,
				"unloaded_weight"=>$trans_unloaded_weight,
				"difference"=>$trans_difference,
				"number_of_packing_units"=>$trans_number_of_packing_units,
				"requirements"=>$trans_requirements,
				"freight_cost"=>$trans_freight_cost,
				"payment_term"=>@$payment_terms['name'],
				"payment_type"=>@$payment_type['name'],
				"payment_status"=>$trans_payment_status,
				"loaddate"=> $trans_created_at,
				"unloaddate"=> $delvrdate,
				"loadloc"=> $offer_country,
				"unloadloc"=> $delvloc,
				"buyer"=> $username,
				"carrier"=> $carrier,
				"plateno"=> $plateno,
				"seller"=> $seller_username,
				"shipperall"=> $shipperall,
				"consigneeall"=> $consigneeall,
				"truck_loads"=> @$truckloads,
				"packaging_type"=> $transvalue['packaging_type'],
				"temperature"=> $temperature,
				"trailer"=> $trailer,
				"truckplate"=> $truckplate,
				"drivername"=> $drivername,
				"driverphone"=> $driverphone,
				"notes"=> $transvalue['notes'],
				
			];
			
		}
		$user = auth()->user();
		$url = url('/') .'/img/'. Settings()->site_logo;
		    
		$phpWord = new \PhpOffice\PhpWord\PhpWord();
		$section = $phpWord->addSection();
		
		$template = utf8_encode(view('backend.transport.doc',compact('transportArr2','user','shipperall','consigneeall')));
		
        $section->addtext($template);
		\PhpOffice\PhpWord\Shared\Html::addHtml($section, $template);

		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('transportlist.docx');
		return response()->download(public_path('transportlist.docx'));
		
	}
	
	public function downloadpdf(Request $request){
		$transportArr = array();
		 $transportlist1 = TransLoad::get();
		// $shipperall = Transshipper::get();
		// $consigneeall = Transconsignee::get();
		foreach($transportlist1 as $transvalue) {
			$checktranslist = Transportlist::where('id',$transvalue->transport_id)->first();
			$product = Product::select('name')->where('id', $transvalue->goods)->first();
			$productname = @$product->name;
			$loadstatus = @$checktranslist->salestatus;
			$temperature = @$checktranslist->temperature;
			$trailer = @$checktranslist->trailer_type;
			$truckplate = @$checktranslist->plate_numbers;
			$drivername = @$checktranslist->drivers_name;
			$driverphone = @$checktranslist->drivers_phone_number;
			$payment_terms = \App\AppHead::where('type', 'payment_terms')->where('id',$transvalue['payment_term'])->first();
			$payment_type = \App\AppHead::where('type', 'payment_type')->where('id',$transvalue['payment_type'])->first();
			if($transvalue->salesid != 0){
			$sales = Sale::select('buyer_id','stock_id')->where('id',$transvalue->salesid)->first();
						
			$saletruck = SaleTruck::select('delivery_date','delivery_location','truck_loads')->where('sale_id',$transvalue->salesid)->first();
			$delvrdate = @$saletruck->delivery_date;
			$delvloc = @$saletruck->delivery_location;
			$truckloads = @$saletruck->truck_loads;
			$buyer = Buyer::select('username')->where('id',$sales->buyer_id)->first();
			$offer = Stock::with('seller')->where('id', $sales->stock_id)->first();
			$seller_username = $username = '';
			if(!empty($offer->seller->username)){
				$seller_username = @$offer->seller->username;
			}
			else{
				$seller_username = '';
			}
			$offer_country = '';
			if(!empty($buyer->username)){
				$username = $buyer->username;
			}
			else{
				$username = '';
			}
		 	 
			if(!empty($offer->country)){
				$offer_country = $offer->country;
			}
			}
			else{
			$seller_username = $offer_country = $username = $delvrdate = $delvloc = $truckloads = '';	
			}
			$trans_id = $trans_variety = $trans_size = $trans_loaded_weight = $trans_unloaded_weight = $trans_difference = $trans_number_of_packing_units = $trans_requirements = $trans_freight_cost = $trans_payment_status = $trans_created_at = '-';
			
			if(!empty($checktranslist)){
				$carriername = Carrier::select('name')->where('id', $checktranslist['carrier'])->first();
				$carrier = @$carriername->name;
				$plateno = $checktranslist['plate_numbers'];
			}
			else{
				$carrier = '-';
				$plateno = '-';
			}
			
			
			if(!empty($transvalue['id']))
				$trans_id = $transvalue['id'];
			if(!empty($transvalue['variety']))
				$trans_variety = $transvalue['variety'];
			if((!empty($transvalue['size_from'])) && (!empty($transvalue['size_to'])))
				$trans_size = $transvalue['size_from'].'-'.$transvalue['size_to'];
			if(!empty($transvalue['loaded_weight']))
				$trans_loaded_weight = $transvalue['loaded_weight'];
			if(!empty($transvalue['unloaded_weight']))
				$trans_unloaded_weight = $transvalue['unloaded_weight'];
			if(!empty($transvalue['difference']))
				$trans_difference = $transvalue['difference'];
			if(!empty($transvalue['number_of_packing_units']))
				$trans_number_of_packing_units = $transvalue['number_of_packing_units'];
			if(!empty($transvalue['requirements']))
				$trans_requirements = $transvalue['requirements'];
			if(!empty($transvalue['freight_cost']))
				$trans_freight_cost = $transvalue['freight_cost'];
			if(!empty($transvalue['payment_status']))
				$trans_payment_status = $transvalue['payment_status'];
			if(!empty($transvalue['created_at']))
				$trans_created_at = $transvalue['created_at'];
			 $shipperall = Transshipper::where('loadid',$trans_id)->get();
		 $consigneeall = Transconsignee::where('loadid',$trans_id)->get();
		 
			$transportArr2 []=[ 
				"id"=>$trans_id,
				"loadstatus"=>$loadstatus,
				"goods"=>$productname,
				"variety"=>$trans_variety,
				"size"=>$trans_size,
				"loaded_weight"=>$trans_loaded_weight,
				"unloaded_weight"=>$trans_unloaded_weight,
				"difference"=>$trans_difference,
				"number_of_packing_units"=>$trans_number_of_packing_units,
				"requirements"=>$trans_requirements,
				"freight_cost"=>$trans_freight_cost,
				"payment_term"=>@$payment_terms['name'],
				"payment_type"=>@$payment_type['name'],
				"payment_status"=>$trans_payment_status,
				"loaddate"=> $trans_created_at,
				"unloaddate"=> $delvrdate,
				"loadloc"=> $offer_country,
				"unloadloc"=> $delvloc,
				"buyer"=> $username,
				"carrier"=> $carrier,
				"plateno"=> $plateno,
				"seller"=> $seller_username,
				"shipperall"=> $shipperall,
				"consigneeall"=> $consigneeall,
				"truck_loads"=> @$truckloads,
				"packaging_type"=> $transvalue['packaging_type'],
				"temperature"=> $temperature,
				"trailer"=> $trailer,
				"truckplate"=> $truckplate,
				"drivername"=> $drivername,
				"driverphone"=> $driverphone,
				"notes"=> $transvalue['notes'],
				
			];
			
		}
		$user = auth()->user();
		$url = url('/') .'/img/'. Settings()->site_logo;
		  
		     
		$mpdf = new \Mpdf\Mpdf();
		$template = utf8_encode(view('backend.transport.pdf',compact('transportArr2','user','shipperall','consigneeall')));
      	$htmlfront = '<div style="padding:20px 0;position:fixed;top:35%;width:100%;">';
		$htmlfront .= '<div class="logo" style="width:100%;text-align: center;">
            <img style="background:#000;padding:20px 0;" class="navbar-brand-full" src="img/logokcharles.png" width="200" height="50" alt="" />
        </div>';
		$htmlfront .= '<p style="text-align:center;margin-bottom:20px;">K Charles Haulage LTD.<br>
		1000 Great West Rd.<br>
		Brentford TW8 9HH, UK,<br>
		VAT: GB313177820</p>';
			$htmlfront .= '<p style="text-align:center;margin-bottom:20px;">+44 203 290 2939</p>';
		$htmlfront .= '<p style="text-align:center;margin-bottom:20px;"><a href="mailto:transport@kcharles.co.uk">transport@kcharles.co.uk</a></p>';
		 $htmlfront .= '</div>'; 
		$mpdf->WriteHTML($htmlfront);
		
		$mpdf->AddPage();
		 
		$mpdf->SetHTMLFooter('');
		 
		$mpdf->shrink_tables_to_fit = 1;
		$mpdf->WriteHTML($template);
		
		$mpdf->Output('transportlist.pdf', 'D');
		//$mpdf->Output();
		$logs = array();
		$logs['action'] = 'All Transload PDF Export';
		\LogActivity::addToLog($logs);
	}
	
	public function update(Request $request, Transportlist $transportlist)
	{
		$all = $request->all();
		$updateArr = array();
		$json_arr = json_encode($request->editr);
		//echo count($request->editr);
		//echo "<pre>";
		/*for($i=1;$i<=count($request->editr);$i++)
		{
			$updateArr []= $request->editr[$i][$i];
		}*/
		
		
			//$updateArr []= $all_value[1]['reference'];
			// foreach($all_value as $key => $all_value1)
			// {
				
			// }
			
		//}
		print_r(json_encode($request->editr));
		unset($updateArr);
		
		exit;
	}
	
	public function addtransport(Request $request){
		$sale = Sale::select('stock_id')->distinct()->get();
		$products = Product::get();
		$carrieroptions = Carrier::get();
		return view('backend.transport.addtransport',compact('sale','products','carrieroptions'));
	}
	
	public function savetransportload(Request $request)
	{
		 
		 $request->validate([
				
				'editr.*.variety' => 'required',
				'editr.*.size' => 'required',
				'editr.*.loaded_weight' => 'required',
				'editr.*.unloaded_weight' => 'required',
				'editr.*.difference' => 'required',
				'editr.*.packaging_type' => 'required',
				'editr.*.number_of_packing_units' => 'required',
				'editr.*.freight_cost' => 'required',
				'editr.*.payment_term' => 'required',
				'editr.*.payment_type' => 'required',
				'editr.*.transport_invoice_number' => 'required',
				'editr.*.transport_invoice_due_date' => 'required',
				'editr.*.payment_status' => 'required',
				'editr.*.notes' => 'required',
				'editr.*.trailer_type' => 'required',
				'editr.*.temperature' => 'required',
				'editr.*.plate_numbers' => 'required',
				'editr.*.drivers_name' => 'required',
				'editr.*.drivers_phone_number' => 'required',
				'editr.*.carrier' => 'required',
				'editr.*.requirements' => 'required',
				'editr.*.notes_from_accounting' => 'required',
				],[
				'editr.*.variety.required'=>'This field is required.',
			]); 
		 
		
		$json_arr = $request->editr;
		$updateArr = array();
		$shipperArr = array();
		$consigneeArr = array();
		  
		 
		$path = public_path('/images/transportlist');
 
		
		$addtransport = Transportlist::create([
			"salesid"=>0,
			"carrier"=>$json_arr[0]['carrier'],
			"trailer_type"=>$json_arr[0]['trailer_type'],
			"temperature"=>$json_arr[0]['temperature'],
			"plate_numbers"=>$json_arr[0]['plate_numbers'],
			"drivers_name"=>$json_arr[0]['drivers_name'],
			"drivers_phone_number"=>$json_arr[0]['drivers_phone_number'],
			"salestatus"=>$json_arr[0]['status']
				 ]);
		
		foreach($json_arr as $keyj  => $loads){
			
			$cmrfile = $invoicefile = $weightfile = $otherfile = '';
			
			if(isset($loads['cmr'])){
				$cmrfile = $loads['cmr']->getClientOriginalName();
				$loads['cmr']->move($path,$cmrfile);
			}
			
			if(isset($loads['invoice'])){
				$invoicefile = $loads['invoice']->getClientOriginalName();
				$loads['invoice']->move($path,$invoicefile);
			}
			
			if(isset($loads['weightbridge'])){
				$weightfile = $loads['weightbridge']->getClientOriginalName();
				$loads['weightbridge']->move($path,$weightfile);
			}
			
			if(isset($loads['other'])){
				$otherfile = $loads['other']->getClientOriginalName();
				$loads['other']->move($path,$otherfile);
			}
			
			$documentarray = array();
			$documentarray['cmr'] = $cmrfile;
			$documentarray['invoice'] = $invoicefile;
			$documentarray['weightbridge'] = $weightfile;
			$documentarray['other'] = $otherfile;
			 
			$alldocuments = json_encode($documentarray);
			
			 //dd($loads['variety']);
			$saveload = TransLoad::create([
			"salesid"=>0,
			"transport_id"=>$addtransport->id,
			"goods"=>$loads['goods'],
			"variety"=>$loads['variety'],
			"size_from"=>$loads['size'],
			"size_to"=>$loads['size'],
			"loaded_weight"=>$loads['loaded_weight'],
			"unloaded_weight"=>$loads['unloaded_weight'],
			"difference"=>$loads['difference'],
			"packaging_type"=>$loads['packaging_type'],
			"number_of_packing_units"=>$loads['number_of_packing_units'],
			"requirements"=>$loads['requirements'],
			"freight_cost"=>$loads['freight_cost'],
			"payment_term"=>$loads['payment_term'],
			"payment_type"=>$loads['payment_type'],
			"transport_invoice_no"=>$loads['transport_invoice_number'],
			"transport_invoice_due_date"=>$loads['transport_invoice_due_date'],
			"payment_status"=>$loads['payment_status'],
			"notes_from_accounting"=>$loads['notes_from_accounting'],
			"documents"=>$alldocuments,
			"notes"=>$loads['notes'],
			"customername"=>$json_arr[0]['customername']
			]);
			
			foreach($loads as $key => $val){
				if(is_int($key)){
			   
			  // dd($val);
			   //	Transshipper::create($shipperArr);
			    

			  	Transshipper::create([ 
					"loadid"=>$saveload->id,
					"shipper"=>$val['shipper'],
					"shipper_address"=>$val['shipping_address'],
					"shipper_reference"=>$val['shippers_reference'],
					"shipper_date"=>$val['shipping_date']
				]);
				if(isset($val['consignee'])){
				Transconsignee::create([
					"loadid"=> $saveload->id,
					"consignee"=> $val['consignee'],
					"consignee_address"=> $val['consignee_address'],
					"consignee_reference"=> $val['consignee_reference'],
					"consignee_date"=> $val['delivery_date']
				]);
			}

			   }
			}
			

		}
		$logs = array();
		$logs['action'] = 'New Transload created';
		\LogActivity::addToLog($logs);
				return response()->json(['status' => 'success', 'message' => 'TransLoad created successfully!']); 
		//dd($addtransport);
		// return redirect('admin/transport/transportlist');
	}
	
	public function getsales(Request $request){
		//$sale = Sale::where('id', $request->stock_id)->first();
		
		$Offer = Stock::with('productname')->where('id', $request->stock_id)->first();
		//$seller_username = @$sale->sellerId->product_id;
		
		return response()->json(['variety'=>'','size'=>@$Offer->size_from.'-'.@$Offer->size_to,'goods'=>@$Offer->productname->name]);
	}
 
	public function store(Request $request){
    
    
	}
	
	public function previewpdf($id){
		$transportArr = array();
		$transportArr2 = array();
		$checkfile = TransLoad::where('id',$id)->first();
		$transinfo = Transportlist::where('id',@$checkfile->transport_id)->first();
		$carrierinfo = Carrier::where('id',@$transinfo->carrier)->first();
		$carriercontact = CarrierContact::where('carrierid',@$transinfo->carrier)->first();
		
		
		$checktranslist = Transportlist::where('id',$checkfile->transport_id)->first();
			$product = Product::select('name')->where('id', $checkfile->goods)->first();
			$productname = @$product->name;
			$loadstatus = @$checktranslist->salestatus;
			$temperature = @$checktranslist->temperature;
			$trailer = @$checktranslist->trailer_type;
			$truckplate = @$checktranslist->plate_numbers;
			$drivername = @$checktranslist->drivers_name;
			$driverphone = @$checktranslist->drivers_phone_number;
			 
			$payment_terms = \App\AppHead::where('type', 'payment_terms')->where('id',$checkfile['payment_term'])->first();
			$payment_type = \App\AppHead::where('type', 'payment_type')->where('id',$checkfile['payment_type'])->first();
			if($checkfile->salesid != 0){
			$sales = Sale::select('buyer_id','stock_id')->where('id',$checkfile->salesid)->first();
						
			$saletruck = SaleTruck::select('delivery_date','delivery_location','truck_loads')->where('sale_id',$checkfile->salesid)->first();
			$buyer = Buyer::select('username')->where('id',$sales->buyer_id)->first();
			$offer = Stock::with('seller')->where('id', $sales->stock_id)->first();
			$delvrdate = @$saletruck->delivery_date;
			$delvloc = @$saletruck->delivery_location;
			$truckloads = @$saletruck->truck_loads;
			$seller_username = $username = '';
			if(!empty($offer->seller->username)){
				$seller_username = @$offer->seller->username;
			}
			else{
				$seller_username = '';
			}
			$offer_country = '';
			if(!empty($buyer->username)){
				$username = $buyer->username;
			}
			else{
				$username = '';
			}
		 	 
			if(!empty($offer->country)){
				$offer_country = $offer->country;
			}
			}
			else{
			$seller_username = $offer_country = $username = $delvrdate = $delvloc = $truckloads = '';	
			}
			
			$trans_id = $trans_variety = $trans_size = $trans_loaded_weight = $trans_unloaded_weight = $trans_difference = $trans_number_of_packing_units = $trans_requirements = $trans_freight_cost = $trans_payment_status = $trans_created_at = '-';
			
			if(!empty($checktranslist)){
				$carriername = Carrier::select('name')->where('id', $checktranslist['carrier'])->first();
				$carrier = @$carriername->name;
				$plateno = $checktranslist['plate_numbers'];
			}
			else{
				$carrier = '-';
				$plateno = '-';
			}
			
			
			if(!empty($checkfile['id']))
				$trans_id = $checkfile['id'];
			if(!empty($checkfile['variety']))
				$trans_variety = $checkfile['variety'];
			if((!empty($checkfile['size_from'])) && (!empty($checkfile['size_to'])))
				$trans_size = $checkfile['size_from'].'-'.$checkfile['size_to'];
			if(!empty($checkfile['loaded_weight']))
				$trans_loaded_weight = $checkfile['loaded_weight'];
			if(!empty($checkfile['unloaded_weight']))
				$trans_unloaded_weight = $checkfile['unloaded_weight'];
			if(!empty($checkfile['difference']))
				$trans_difference = $checkfile['difference'];
			if(!empty($checkfile['number_of_packing_units']))
				$trans_number_of_packing_units = $checkfile['number_of_packing_units'];
			if(!empty($checkfile['requirements']))
				$trans_requirements = $checkfile['requirements'];
			if(!empty($checkfile['freight_cost']))
				$trans_freight_cost = $checkfile['freight_cost'];
			if(!empty($checkfile['payment_status']))
				$trans_payment_status = $checkfile['payment_status'];
			if(!empty($checkfile['created_at']))
				$trans_created_at = $checkfile['created_at'];
			 $shipperall = Transshipper::where('loadid',$trans_id)->get();
		 $consigneeall = Transconsignee::where('loadid',$trans_id)->get();
		 
			$transportArr2 []=[ 
				"id"=>$trans_id,
				"loadstatus"=>$loadstatus,
				"goods"=>$productname,
				"variety"=>$trans_variety,
				"size"=>$trans_size,
				"loaded_weight"=>$trans_loaded_weight,
				"unloaded_weight"=>$trans_unloaded_weight,
				"difference"=>$trans_difference,
				"number_of_packing_units"=>$trans_number_of_packing_units,
				"requirements"=>$trans_requirements,
				"freight_cost"=>$trans_freight_cost,
				"payment_term"=>$payment_terms['name'],
				"payment_type"=>$payment_type['name'],
				"payment_status"=>$trans_payment_status,
				"loaddate"=> $trans_created_at,
				"unloaddate"=> $delvrdate,
				"loadloc"=> $offer_country,
				"unloadloc"=> $delvloc,
				"buyer"=> $username,
				"carrier"=> $carrier,
				"plateno"=> $plateno,
				"seller"=> $seller_username,
				"shipperall"=> $shipperall,
				"consigneeall"=> $consigneeall,
				"truck_loads"=> $truckloads,
				"packaging_type"=> $checkfile['packaging_type'],
				"temperature"=> $temperature,
				"trailer"=> $trailer,
				"truckplate"=> $truckplate,
				"drivername"=> $drivername,
				"driverphone"=> $driverphone,
				"notes"=> $checkfile['notes'],
				 
			];
		
		 
		 $user = auth()->user();
		$url = url('/') .'/img/'. Settings()->site_logo;
		$sales = Sale::with('stock', 'stock.seller', 'stock.product','buyer','trucksone')->where('id', $checkfile->salesid)->first();
		     
		$mpdf = new \Mpdf\Mpdf();
		$template = utf8_encode(view('backend.transport.invoice',compact('transportArr2','user','sales','carrierinfo')));
		$htmlfront = '<div style="border:1px solid #000;padding:20px 0;">';
		$htmlfront .= '<div class="logo" style="width:100%;text-align: center;">
            <img style="background:#000;padding:20px 0;" class="navbar-brand-full" src="img/logokcharles.png" width="200" height="50" alt="" />
        </div>';
		$htmlfront .= '<p style="text-align:center;margin-bottom:20px;">K Charles Haulage LTD.<br>
		1000 Great West Rd.<br>
		Brentford TW8 9HH, UK,<br>
		VAT: GB313177820</p>';
			$htmlfront .= '<p style="text-align:center;margin-bottom:20px;">+44 203 290 2939</p>';
		$htmlfront .= '<p style="text-align:center;margin-bottom:20px;"><a href="mailto:transport@kcharles.co.uk">transport@kcharles.co.uk</a></p>';
		
		 
			 
		 if(!empty($carrierinfo)){
			  
			$htmlfront .= '<h3 style="text-align:center;text-decoration:underline;">Carrier Information</h3>';
			
			$htmlfront .= '<p style="text-align:center;"><b>Name :-</b>'.(@$carrierinfo->name?@$carrierinfo->name:'-').'</p>';
			$htmlfront .= '<p style="text-align:center;"><b>Address :-</b>'.@$carrierinfo->address.'</p>';
			$htmlfront .= '<p style="text-align:center;"><b>Email :-</b>'.(@$carriercontact->transportemail?@$carriercontact->transportemail:'-').'</p>';
			$htmlfront .= '<p style="text-align:center;"><b>Phone :-</b>'.@$carriercontact->phone.'</p>';
			$htmlfront .= '<p style="text-align:center;"><b>Vat :-</b>'.@$carrierinfo->vat.'</p>';
		
		 }
		 $htmlfront .= '</div>';
		/*$mpdf->SetHTMLFooter('
		<table width="100%">
			<tr>
				<td width="33%" align="center">transport@kcharles.co.uk</td>
				<td width="33%">+44 203 290 2939</td>
				<td width="33%" style="text-align: right;">K Charles Haulage LTD.
		1000 Great West Rd.
		Brentford TW8 9HH, UK
		VAT: GB313177820</td>
			</tr>
		</table>');*/
		  
		//$mpdf->WriteHTML($htmlfront);
		
		//$mpdf->AddPage();
		 
		//$mpdf->SetHTMLFooter('');
      	$mpdf->WriteHTML($template);
		$mpdf->Output();
		$logs = array();
		$logs['action'] = 'Transload Preview PDF';
		\LogActivity::addToLog($logs);
	}
	
	public function sendloadpdf(Request $request){
		$transportArr = array();
		$transportArr2 = array();
		$checkfile = TransLoad::where('id',$request->id)->first();
		
		 
		$transinfo = Transportlist::where('id',@$checkfile->transport_id)->first();
		$carrierinfo = Carrier::where('id',@$transinfo->carrier)->first();
		$carriercontact = CarrierContact::where('carrierid',@$transinfo->carrier)->first();
		
		$checktranslist = Transportlist::where('id',$checkfile->transport_id)->first();
			$product = Product::select('name')->where('id', $checkfile->goods)->first();
			$productname = @$product->name;
			$loadstatus = @$checktranslist->salestatus;
			$temperature = @$checktranslist->temperature;
			$trailer = @$checktranslist->trailer_type;
			$truckplate = @$checktranslist->plate_numbers;
			$drivername = @$checktranslist->drivers_name;
			$driverphone = @$checktranslist->drivers_phone_number;
			
			$payment_terms = \App\AppHead::where('type', 'payment_terms')->where('id',$checkfile['payment_term'])->first();
			$payment_type = \App\AppHead::where('type', 'payment_type')->where('id',$checkfile['payment_type'])->first();
			if($checkfile->salesid != 0){
			$sales = Sale::select('buyer_id','stock_id')->where('id',$checkfile->salesid)->first();
						
			$saletruck = SaleTruck::select('delivery_date','delivery_location','truck_loads')->where('sale_id',$checkfile->salesid)->first();
			$buyer = Buyer::select('username')->where('id',$sales->buyer_id)->first();
			$offer = Stock::with('seller')->where('id', $sales->stock_id)->first();
			$delvrdate = @$saletruck->delivery_date;
			$delvloc = @$saletruck->delivery_location;
			$truckloads = @$saletruck->truck_loads;
			$seller_username = $username = '';
			if(!empty($offer->seller->username)){
				$seller_username = @$offer->seller->username;
			}
			else{
				$seller_username = '';
			}
			$offer_country = '';
			if(!empty($buyer->username)){
				$username = $buyer->username;
			}
			else{
				$username = '';
			}
		 	 
			if(!empty($offer->country)){
				$offer_country = $offer->country;
			}
			}
			else{
			$seller_username = $offer_country = $username = $delvrdate = $delvloc = '';	
			}
			$trans_id = $trans_variety = $trans_size = $trans_loaded_weight = $trans_unloaded_weight = $trans_difference = $trans_number_of_packing_units = $trans_requirements = $trans_freight_cost = $trans_payment_status = $trans_created_at = '-';
			
			if(!empty($checktranslist)){
				$carriername = Carrier::select('name')->where('id', $checktranslist['carrier'])->first();
				$carrier = @$carriername->name;
				$plateno = $checktranslist['plate_numbers'];
			}
			else{
				$carrier = '-';
				$plateno = '-';
			}
			
			
			if(!empty($checkfile['id']))
				$trans_id = $checkfile['id'];
			if(!empty($checkfile['variety']))
				$trans_variety = $checkfile['variety'];
			if((!empty($checkfile['size_from'])) && (!empty($checkfile['size_to'])))
				$trans_size = $checkfile['size_from'].'-'.$checkfile['size_to'];
			if(!empty($checkfile['loaded_weight']))
				$trans_loaded_weight = $checkfile['loaded_weight'];
			if(!empty($checkfile['unloaded_weight']))
				$trans_unloaded_weight = $checkfile['unloaded_weight'];
			if(!empty($checkfile['difference']))
				$trans_difference = $checkfile['difference'];
			if(!empty($checkfile['number_of_packing_units']))
				$trans_number_of_packing_units = $checkfile['number_of_packing_units'];
			if(!empty($checkfile['requirements']))
				$trans_requirements = $checkfile['requirements'];
			if(!empty($checkfile['freight_cost']))
				$trans_freight_cost = $checkfile['freight_cost'];
			if(!empty($checkfile['payment_status']))
				$trans_payment_status = $checkfile['payment_status'];
			if(!empty($checkfile['created_at']))
				$trans_created_at = $checkfile['created_at'];
			 $shipperall = Transshipper::where('loadid',$trans_id)->get();
		 $consigneeall = Transconsignee::where('loadid',$trans_id)->get();
		 
			$transportArr2 []=[ 
				"id"=>$trans_id,
				"loadstatus"=>$loadstatus,
				"goods"=>$productname,
				"variety"=>$trans_variety,
				"size"=>$trans_size,
				"loaded_weight"=>$trans_loaded_weight,
				"unloaded_weight"=>$trans_unloaded_weight,
				"difference"=>$trans_difference,
				"number_of_packing_units"=>$trans_number_of_packing_units,
				"requirements"=>$trans_requirements,
				"freight_cost"=>$trans_freight_cost,
				"payment_term"=>$payment_terms['name'],
				"payment_type"=>$payment_type['name'],
				"payment_status"=>$trans_payment_status,
				"loaddate"=> $trans_created_at,
				"unloaddate"=> $delvrdate,
				"loadloc"=> $offer_country,
				"unloadloc"=> $delvloc,
				"buyer"=> $username,
				"carrier"=> $carrier,
				"plateno"=> $plateno,
				"seller"=> $seller_username,
				"shipperall"=> $shipperall,
				"consigneeall"=> $consigneeall,
				"truck_loads"=> $truckloads,
				"packaging_type"=> $checkfile['packaging_type'],
				"temperature"=> $temperature,
				"trailer"=> $trailer,
				"truckplate"=> $truckplate,
				"drivername"=> $drivername,
				"driverphone"=> $driverphone,
				"notes"=> $checkfile['notes'],
				
			];
		 $user = auth()->user();
		$url = url('/') .'/img/'. Settings()->site_logo;
		$sales = Sale::with('stock', 'stock.seller', 'stock.product','buyer','trucksone')->where('id', $checkfile->salesid)->first();
		     
		$mpdf = new \Mpdf\Mpdf();
		$template = utf8_encode(view('backend.transport.invoice',compact('transportArr2','user','sales')));
      	//$mpdf->WriteHTML($template);
		$htmlfront = '<div style="border:1px solid #000;padding:20px 0;">';
		$htmlfront .= '<div class="logo" style="width:100%;text-align: center;">
            <img style="background:#000;padding:20px 0;" class="navbar-brand-full" src="img/logokcharles.png" width="200" height="50" alt="" />
        </div>';
		$htmlfront .= '<p style="text-align:center;margin-bottom:20px;">K Charles Haulage LTD.<br>
		1000 Great West Rd.<br>
		Brentford TW8 9HH, UK,<br>
		VAT: GB313177820</p>';
			$htmlfront .= '<p style="text-align:center;margin-bottom:20px;">+44 203 290 2939</p>';
		$htmlfront .= '<p style="text-align:center;margin-bottom:20px;"><a href="mailto:transport@kcharles.co.uk">transport@kcharles.co.uk</a></p>';
		
		 
			 
		 if(!empty($carrierinfo)){
			  
			$htmlfront .= '<h3 style="text-align:center;text-decoration:underline;">Carrier Information</h3>';
			
			$htmlfront .= '<p style="text-align:center;"><b>Name :-</b>'.(@$carrierinfo->name?@$carrierinfo->name:'-').'</p>';
			$htmlfront .= '<p style="text-align:center;"><b>Address :-</b>'.@$carrierinfo->address.'</p>';
			$htmlfront .= '<p style="text-align:center;"><b>Email :-</b>'.(@$carriercontact->transportemail?@$carriercontact->transportemail:'-').'</p>';
			$htmlfront .= '<p style="text-align:center;"><b>Phone :-</b>'.@$carriercontact->phone.'</p>';
			$htmlfront .= '<p style="text-align:center;"><b>Vat :-</b>'.@$carrierinfo->vat.'</p>';
		
		 }
		 $htmlfront .= '</div>';
		  
		$mpdf->WriteHTML($htmlfront);
		
		$mpdf->AddPage();
		 
		$mpdf->SetHTMLFooter('');
      	$mpdf->WriteHTML($template);
		 
		 $logs = array();
		$logs['action'] = 'Transload Save & Preview PDF';
		\LogActivity::addToLog($logs);
		 
		 Mail::send('backend.mail.default', ['name' => 'Invoice', 'body' => '<div stype="color:#000">invoice</div>'], function ($message) use ($user,$sales,$mpdf) {
					$message->subject('Invoice of Veg King!');
					$message->to($this->transportmail);
					$message->attachData($mpdf->output("Invoice.pdf",'S'), "Invoice.pdf");
				});	
	}
	
	 public function transportexports() 
    {
		$logs = array();
		$logs['action'] = 'All Transload Export Excel';
		\LogActivity::addToLog($logs);
        return Excel::download(new TransportExport, 'transportlist.xlsx');
    }



	public function uploadExcel(Request $request) {
		try{
			if($request->hasFile("excelFile")){			
				$transportlist = Excel::toArray(new ExcelImport,request()->file('excelFile'));
				foreach ($transportlist as $transports) {
					foreach ($transports as $transport) {
						//print_r($transport);die;
						$addtransport = Transportlist::create([
							"salesid"=>0,
							"carrier"=>isset($transport['carrier'])? $transport['carrier'] :"",
							"trailer_type"=>"",
							"temperature"=>"",
							"plate_numbers"=>"",
							"drivers_name"=>"",
							"drivers_phone_number"=>"",
							"salestatus"=>isset($transport['status']) ? $transport['status'] :""
					 	]);

					 	$saveload = TransLoad::create([
							"salesid"=>0,
							"transport_id"=>isset($addtransport->id) ? $addtransport->id : 0,
							"goods"=>0,
							"variety"=>isset($transport['variety']) ? $transport['variety']  : 0 ,
							"size_from"=>0,
							"size_to"=>0,
							"loaded_weight"=>isset($transport['loaded_weight']) ? $transport['loaded_weight'] :0,
							"unloaded_weight"=>isset($transport['unloaded_weight']) ? $transport['unloaded_weight'] : 0,
							"difference"=>isset($transport['difference']) ? $transport['difference']: 0,
							"packaging_type"=>"",
							"number_of_packing_units"=>"",
							"requirements"=>"",
							"freight_cost"=>"",
							"payment_term"=>"",
							"payment_type"=>"",
							"transport_invoice_no"=>"",
							"transport_invoice_due_date"=>"",
							"payment_status"=>"",
							"notes_from_accounting"=>"",
							"documents"=>isset($transport['documents']) ? $transport['documents'] : "",
							"notes"=>"",
							"customername"=>isset($transport['customer']) ? $transport['customer'] : ""
						]);

						Transshipper::create([ 
							"loadid"=>$saveload->id,
							"shipper"=>"",
							"shipper_address"=>"",
							"shipper_reference"=>"",
							"shipper_date"=>""
						]);
						if(isset($transport['consignee']))
						{
							Transconsignee::create([
								"loadid"=> $saveload->id,
								"consignee"=> "",
								"consignee_address"=> "",
								"consignee_reference"=> "",
								"consignee_date"=> ""
							]);
						}
					}
				}
				return response()->json(['success'=>true,'message'=>"Successfully upload"]);
			}	
		}
		catch(Exception $e){
			return response()->json(['success'=>false,'message'=>"Something went wrong,Please try again later..."]);
		}
	}
}
