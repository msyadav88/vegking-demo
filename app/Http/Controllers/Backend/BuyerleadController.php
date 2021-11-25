<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Buyerlead;
use App\Product;
use DB;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use DataTables;
use View;

class BuyerleadController extends Controller{

  /**
     * @var PhpSimpleHtmlDomParser
     */

    /**
     * @param PhpSimpleHtmlDomParser $parser
     */
    public function __construct()
    {
        //$this->parser = $parser;
    }
    public function index(Request $request){
      if ($request->ajax()) {
          $data = Buyerlead::get();
          return Datatables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function($row){
               $view = View::make('backend.buyerlead.action_button', [ 'row' => $row,
                'buyer_show_url' => route('admin.buyerleads.show', $row->id) ]);
               $btn = $view->render();

               return $btn;
          })
          ->rawColumns(['action'])
          ->make(true);
      }
      return view('backend.buyerlead.index');
    }

    public function show($id){
      $buyerlead = Buyerlead::where(['id' => $id])->first();
      if($buyerlead){
         // $detail = Stock::select('buyers.*', 'order2.transport_id','order2.created_at as orderdate','app_heads.name as product_name','offers.price','order2.payment_status','offers.available_from_date')
        //                 ->join('order2', 'order2.stock_id', '=', 'offers.id')
        //                 ->join('buyers', 'buyers.id', '=', 'order2.buyer_id')
        //                 ->join('app_heads', 'app_heads.id', '=', 'offers.product_id')
        //                 ->where('buyers.id',$buyer->id)
        //                 ->get();
        $product = Product::where('id',$buyerlead->product_id)->first();
        // dd($product->toArray());
        return view('backend.buyerlead.show',compact('buyerlead','product'));
       }else{
         $msg="Unfortunately this Buyer Lead is not exist!";
        return view('backend.buyerlead.index', compact('msg'));
       } 
    }

    public function destroy(Buyerlead $buyerlead)
    {
      $buyerlead->delete();
      return response()->json(['success'=>'Buyer Lead deleted successfully.']);
    }
}
