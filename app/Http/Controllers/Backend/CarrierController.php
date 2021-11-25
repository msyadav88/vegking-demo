<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sale;
use App\SaleTruck;
use App\Buyer;
use App\Match;
use App\Stock;
use App\Saledelivery;
use App\PurchaseOrder;
use App\Carrier;
use App\CarrierContact;
use App\Loadstatus;
use App\Product;
use App\TransLoad;
use App\Transportlist;
use DataTables;
use App\BuyerPaymentDetails;
use App\Exports\SalesExport;
use Maatwebsite\Excel\Facades\Excel;
use DateTime;
use Mail;

class CarrierController extends Controller{
	
	public $transportwhatsapp;
	public $transportmail;
    public function __construct(){
         
    }

    public function index(Request $request){
      if ($request->ajax()) {
            $data = Carrier::get(); 
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                       $btn = ' <div class="btn-group btn-group-sm">
                                  <button type="button" class="btn btn-edit editItem" data-url="'.route('admin.carrier.edit', $row->id).'"><i class="fas fa-edit"></i></button>
                                  <button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>
                                </div>';
                        return $btn;
                })
              
                ->rawColumns(['action'])
                ->make(true);
      }
      return view('backend.carrier.index');
    }

    public function create(){
		 $buyers = 'title';
		return view('backend.carrier.create',compact('buyers'));
	}

    public function store(Request $request){
		$request->validate([
          'name' => 'required',
          'vat' => 'required',
		  'country' => 'required',
          'city' => 'required',
          'address' => 'required',
          'postal_code' => 'required'
        ]);
		
		foreach($request->addmore as $value){
			if(isset($value['email'])){
		$checkcontact = CarrierContact::where('transportemail',$value['email'])->orWhere('phone',$value['phone'])->get();
		      if(count($checkcontact) > 0){
				return response()->json(['status' => 'error', 'message' => 'Email or phone already exist!']);	  
			  }
			}
		}
		
		$carrier = Carrier::create(['name' => $request->name, 'vat' => $request->vat, 'country' => $request->country, 'city' => $request->city, 'address' => $request->address,'postal' => $request->postal_code]);
		
		foreach($request->addmore as $value){
		
		CarrierContact::create(['carrierid' => $carrier->id,'type' => $value['type'],'transportname' => $value['personname'],'transportemail' => $value['email'],'phone' => $value['phone']]);
			 
		}
		
		if($carrier->id > 0){ 
		return response()->json(['status' => 'success', 'message' => 'Carrier created successfully!']);
		}
		else{
		return response()->json(['status' => 'error', 'message' => 'Somethig went wrong!']);	
		}
    }
    public function show($id){
      $carrier = Carrier::where(['id' => $id])->first();
      if($carrier){
        $carrier = Carrier::get();
        return view('backend.carrier.show',compact('carrier'));
       }else{
         $msg="Unfortunately this Carrier is not exist!";
        return view('backend.carrier.index', compact('msg'));
       } 
    }

    public function edit($id){
      $carrier = Carrier::where(['id' => $id])->first();
      if($carrier){
      	$carrier = Carrier::where('id', $carrier->id)->first();
        $carriercontact = CarrierContact::where('carrierid', $carrier->id)->get();
        //echo "<pre/>"; print_r($sale->id); die;
		    return view('backend.carrier.edit',compact( 'carrier','carriercontact'));
       }else{
        $msg="Unfortunately this Carrier is not exist!";
        return view('backend.carrier.index',compact('msg'));
       } 
    }
    public function update(Request $request, Carrier $carrier){
		$all = $request->all();
		$request->validate([
          'name' => 'required',
          'vat' => 'required',
          'city' => 'required',
          'address' => 'required',
          'postal_code' => 'required'
        ]);
		$total = 0;

		 
		$tableArray = ['name' => $request->name, 'vat' => $request->vat, 'country' => $request->country, 'city' => $request->city, 'address' => $request->address,'postal' => $request->postal_code];

		if($carrier->update($tableArray)){
			 CarrierContact::where('carrierid', $carrier->id)->delete();
			 foreach($request->addmore as $value){
		
		CarrierContact::create(['carrierid' => $carrier->id,'type' => $value['type'],'transportname' => $value['personname'],'transportemail' => $value['email'],'phone' => $value['phone']]);
			 
		}
			
			return response()->json(['status' => 'success', 'message' => 'Carrier updated successfully!']);
		}
		else{
		return response()->json(['status' => 'error', 'message' => 'Somethig went wrong!']);	
		}
		 
		 
    }

    public function destroy(Carrier $carrier){
        $carrier->delete();
        return response()->json(['success'=>'Carrier deleted successfully.']);
    }

    
 
	 
}
