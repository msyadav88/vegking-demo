<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sale;
use App\SaleTruck;
use App\Buyer;
use App\Match;
use App\Stock;
use App\OfferRequest;
use App\Product;
use DataTables;
use App\BuyerPaymentDetails;

class AccountController extends Controller{

    public function index(Request $request){
      
       $data = Sale::with('buyer', 'stock', 'paymentType', 'paymentTerms', 'currencyId')->get();
	   echo "<pre/>"; print_r($data); die;
    }
	
	public function buyer_templates(Request $request){
      
		$sale = Sale::with('buyer', 'stock', 'paymentType', 'paymentTerms', 'currencyId')->first();
		$buyer = Buyer::select('name','phone','company','address','country','city','postalcode')->where('id','=',$sale->buyer_id)->first();
		 
		$stock = Stock::with('product', 'seller')->first();
		echo "<pre/>"; print_r($stock->product->name); 
		echo "<pre/>size_from:"; print_r($stock->size_from); 
		echo "<pre/>size_to:"; print_r($stock->size_to); 
		echo "<pre/>size_to:"; print_r($stock->size_to); 
		
		echo "<pre/>"; print_r($stock); 
		echo "<pre/>"; print_r($buyer); 
		echo "<pre/>"; print_r($stock->seller); 
		echo "<pre/>"; print_r(@$stock->seller->name); die;
		echo "<pre/>"; print_r($buyer); die;
    }
	
	  public function buyer_invoice_history(Request $request){
      
       $data = Sale::with('buyer', 'stock', 'paymentType', 'paymentTerms', 'currencyId')->get();
	   echo "<pre/>"; print_r($data); die;
    }
	

   
}
