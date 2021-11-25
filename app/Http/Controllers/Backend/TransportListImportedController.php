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
use App\TransportListImported;
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



class TransportListImportedController extends Controller{	
	public function __construct(){
    }
  	public function index(Request $request){
		$transportArr = array();
	    $carrieroptions = Carrier::select('id','name')->get();
		return view('backend.transportlistimport.index',compact('carrieroptions'));	
 	}
 	public function getTransportList(Request $request){
		if ($request->ajax()) {
            $data = TransportListImported::get();
			return Datatables::of($data)->make(true);
      	}
 	}
	public function uploadExcelFile(Request $request) {
		try{
			if($request->hasFile("excelFile")){			
				$transportlist = Excel::toArray(new ExcelImport,request()->file('excelFile'));
				foreach ($transportlist as $transports) {
					foreach ($transports as $transport) {
						if(isset($transport["reference"])){
							if(!empty($transport["reference"])) {
							$transportListImported = TransportListImported::where("reference",$transport["reference"])->first();
							if(empty($transportListImported))
							{
								$data = array(
									"reference" => isset($transport["reference"]) ? $transport["reference"] : "",
									"loading_date" => isset($transport["loading_date"]) ? $transport["loading_date"] : "",
									"unloading_date" => isset($transport["unloading_date"]) ? $transport["unloading_date"] : "",
									"consignorloadercustomer" => isset($transport["consignorloadercustomer"]) ? $transport["consignorloadercustomer"] : "",
									"loading_point" => isset($transport["loading_point"]) ? $transport["loading_point"] : "",
									"unloading_point" => isset($transport["unloading_point"]) ? $transport["unloading_point"] : "",
									"customer" => isset($transport["customer"]) ? $transport["customer"] : "",
									"gross_weight" => isset($transport["gross_weight"]) ? $transport["gross_weight"] : "",
									"nett_weight" => isset($transport["nett_weight"]) ? $transport["nett_weight"] : "",
									"unloaded_weight" => isset($transport["unloaded_weight"]) ? $transport["unloaded_weight"] : "",
									"payweight" => isset($transport["payweight"]) ? $transport["payweight"] : "",
									"diff" => isset($transport["diff"]) ? $transport["diff"] : "",
									"no_pack" => isset($transport["no_pack"]) ? $transport["no_pack"] : "",
									"temp" => isset($transport["temp"]) ? $transport["temp"] : "",
									"kind_of_trailer" => isset($transport["kind_of_trailer"]) ? $transport["kind_of_trailer"] : "",
									"truck_plates" => isset($transport["truck_plates"]) ? $transport["truck_plates"] : "",
									"container_no" => isset($transport["container_no"]) ? $transport["container_no"] : "",
									"load_eta" => isset($transport["load_eta"]) ? $transport["load_eta"] : "",
									"del_eta" => isset($transport["del_eta"]) ? $transport["del_eta"] : "",
									"driver_phone_number" => isset($transport["driver_phone_number"]) ? $transport["driver_phone_number"] : "",
									"carrier" => isset($transport["carrier"]) ? $transport["carrier"] : "",
									"variety" => isset($transport["variety"]) ? $transport["variety"] : "",
									"kind_of_cargo" => isset($transport["kind_of_cargo"]) ? $transport["kind_of_cargo"] : "",
									"kind_of_payment_for_transport" => isset($transport["kind_of_payment_for_transport"]) ? $transport["kind_of_payment_for_transport"] : "",
									"transport_cost" => isset($transport["transport_cost"]) ? $transport["transport_cost"] : "",
									"pln_transport" => isset($transport["pln_transport"]) ? $transport["pln_transport"] : "",
									"notices" => isset($transport["notices"]) ? $transport["notices"] : "",
									"cmr" => isset($transport["cmr"]) ? $transport["cmr"] : "",
									"transport_invoice" => isset($transport["transport_invoice"]) ? $transport["transport_invoice"] : "",
									"transport_invoice_uk" => isset($transport["transport_invoice_uk"]) ? $transport["transport_invoice_uk"] : "",
									"sales_invoice" => isset($transport["sales_invoice"]) ? $transport["sales_invoice"] : "",
									"sales_price" => isset($transport["sales_price"]) ? $transport["sales_price"] : "",
									"payment_period" => isset($transport["payment_period"]) ? $transport["payment_period"] : "",
									"purchase_invoice" => isset($transport["purchase_invoice"]) ? $transport["purchase_invoice"] : "",
									"paid" => isset($transport["paid"]) ? $transport["paid"] : "",
									"purchase_rate" => isset($transport["purchase_rate"]) ? $transport["purchase_rate"] : "",
									"date_od_purchase_invoice" => isset($transport["date_od_purchase_invoice"]) ? $transport["date_od_purchase_invoice"] : "",
									"transport_payment_term" => isset($transport["transport_payment_term"]) ? $transport["transport_payment_term"] : "",
									"carrier_documents" => isset($transport["carrier_documents"]) ? $transport["carrier_documents"] : "",
									"order" => isset($transport["order"]) ? $transport["order"] : "",
									"status" => isset($transport["status"]) ? $transport["status"] : "");	
	    							TransportListImported::create($data);				
	    					}
	    				}}	
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
