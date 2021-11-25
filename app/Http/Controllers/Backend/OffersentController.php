<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Stock;
use App\Seller;
use App\Buyer;
use App\Match;
use App\Sale;
use App\PurchaseOrder;
use App\OfferSent;
use DataTables;
use DB;
use DateTime;
use App\AppHead;
use App\Product;
use App\Notifications;
use App\ProductSpecification;
use App\ProductSpecificationValue;
use Mail;
use App\Models\Auth\User;
use App\Exports\OfferSentExport;
use Maatwebsite\Excel\Facades\Excel;

class OffersentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(){
        $this->middleware('permission:view offer sent', ['only' => ['index']]);
    }

    public function index(Request $request)
    {
        $data = OfferSent::with('stock','match', 'buyer', 'stock.seller', 'stock.product', 'stock.offerProperty')->get();

        $stock_list = OfferSent::with('buyer', 'stock', 'match')->get();
        $buyers_list = Buyer::select('id', 'username')->get();
        $sellers_list = Seller::select('id', 'username')->get();
        $products = Product::all()->where('status', '1')->pluck('name', 'id');
        if(isset($request->product_id) && !empty($request->product_id)){
            $product_id = $request->product_id;
            $ProdSpecArr = ProductSpecification::where('product_id',$request->product_id)->where('parent_id',NULL)->orderBy('order')->limit(3)->pluck('display_name','id')->toArray();
        } else {
            $product = Product::all()->where('status', '1')->first();
            $product_id = @$product->id;
            $ProdSpecArr = ProductSpecification::where('product_id',@$product->id)->where('parent_id',NULL)->orderBy('order')->limit(3)->pluck('display_name','id')->toArray();
        }
        $ProdSpecArrKeys = array_keys($ProdSpecArr);
        $field1 = current($ProdSpecArrKeys);
        if(count($ProdSpecArrKeys) > 1){
            $field2 = next($ProdSpecArrKeys);
        } else {
            $field2 = '';
        }
        if(count($ProdSpecArrKeys) >2){
            $field3 = end($ProdSpecArrKeys);
        } else {
            $field3 = '';
        }
        $ProdSpecArrNames = array();
        $ProdSpecArrNames['field1'] = $field1;
        $ProdSpecArrNames['field2'] = $field2;
        $ProdSpecArrNames['field3'] = $field3;
        $product_spec_values_arr = array();
        foreach($ProdSpecArrKeys as $id){
            $ProductSpecificationValues = ProductSpecificationValue::where('product_specification_id',@$id)->where('parent_id',NULL)->pluck('value','id')->toArray();
            $product_spec_values_arr[$id] = $ProductSpecificationValues;
        }
        if ($request->ajax()) {

            $data = OfferSent::with('stock','match', 'buyer', 'stock.seller', 'stock.product', 'stock.offerProperty')->get();

            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                     $btn = ' <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-success sendInvoice" title="Send PDF" data-url-send="'.route('admin.matchestemp.send_Invoice', $row->id).'" data-viewurl="'.route('admin.matchestemp.view_Invoice', $row->id).'" data-id="'.$row->id.'"><i class="fas fa-file-invoice"></i></button>
                              </div>';
                      return $btn;
              })
            ->addColumn('id', function($row){
                return (@$row->id?@$row->id:'-');
            })
            ->addColumn('confirmation', function($row){
                if($row->email_confirm==1){
                    $confirm="Offer Confirm";
                }
                return (@$confirm?@$confirm:'-');
            })
            ->addColumn('buyer_name', function($row){
                    return (@$row->buyer->username?@$row->buyer->username:'-');
            })
            ->addColumn('seller_name', function($row){
                    return (@$row->stock->id?@$row->stock->id:'-');
            })
            ->addColumn('product_name', function($row){
                    return (@$row->stock->product->name?@$row->stock->product->name:'-');
            })
            ->addColumn('image', function($row){
                $image = '<a class="image"><img  src="'.asset('images/products/').'/'.@$row->stock->product->image.'" onerror=this.src="'.asset('images/products/no_img.png').'" data-homepage_image="'.asset('images/products/').'/'.@$row->stock->product->homepage_image.'" name="'.@$row->stock->product->name.'" data-buyer="'.@$row->buyer->username.'" data-seller="'.@$row->stock->seller->username.'" data-price="'.@$row->offerprice.'" data-size="'.(@$row->stock->size_from.'-'.@$row->stock->size_to).'"   class="mb-2 img-thumbnail list_image" /></a>';
                return $image;
           })
            ->addColumn('field1', function($row) use ($field1) {
                    return (@$row->match->profit_per_ton?@$row->match->profit_per_ton:'-');
            })
            ->addColumn('field2', function($row) use ($field2){
                    $arrFields  = array();
                    if(!empty($row->stock)){
                        foreach($row->stock->offerProperty as $prop){
                            $arrFields[$prop->product_spec_id][] = @$prop->productSpecValue->value;
                        }
                    }
                    if(is_array($arrFields)&& !empty($arrFields[@$field2])){
                        return implode(', ',@$arrFields[@$field2]);
                    } else {
                        return '-';
                    }
                })
            ->addColumn('field3', function($row) use ($field3){
                    if($field3 == ''){
                        return '';
                    } else {
                        $arrFields  = array();
                        if(!empty($row->stock)){
                            foreach($row->stock->offerProperty as $prop){
                                $arrFields[$prop->product_spec_id][] = @$prop->productSpecValue->value;
                            }
                        }
                        if(is_array($arrFields)&& !empty($arrFields[@$field3])){
                            return implode(', ',@$arrFields[@$field3]);
                        } else {
                            return '-';
                        };
                    }
                })
            ->addColumn('size_from', function($row){
                    return (@$row->stock->size_from?@$row->stock->size_from:'-');
                })
            ->addColumn('size_to', function($row){
                    return (@$row->stock->size_to?@$row->stock->size_to:'-');
                })
            ->addColumn('quantity', function($row){
                    return (@$row->stock->quantity?@$row->stock->quantity:'-');
                })
            ->addColumn('offerprice', function($row){
                    return (@$row->offerprice?@$row->offerprice:'-');
                })


          ->rawColumns(['action','image'])
          ->make(true);
          }

        return view('backend.offersent.index', compact('stock_list', 'buyers_list','sellers_list','ProdSpecArr','ProdSpecArrNames','ProdSpecArrKeys','product_spec_values_arr','products'));
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $offer_sent = OfferSent::with('buyer','stock')->find(['id'=>$id])->first();
        $stock = $offer_sent->stock;
        $buyer = $offer_sent->buyer;
        return view('backend.offersent.show', compact('offer_sent','stock','buyer'));

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

     /**
     * Send Invoice to partoicular buyer
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function send_Invoice(Request $request,$id){
   

        $OfferSent = OfferSent::where('id', @$id)->with('buyer')->first();
        $user = auth()->user();
        $url = url('/') .'/img/'. Settings()->site_logo;
        $matches = Match::with('buyerPref.buyer','stock', 'stock.seller', 'stock.product','offerproperty.productspec','offerproperty.productspecvalue')->where('id', $OfferSent->match_id)->first();
        $tmp = json_decode(@$matches->stock->packaging,true);
        $user_id=$matches->buyerPref->buyer_id;

        //to check offersent date
        $buyer_info=Buyer::find($user_id);
        $user_id=$buyer_info->user_id;
        $send=0;
        $next_date=get_next_date($user_id, $message_type='offers_messages');
        $digest=get_next_date($user_id, $message_type='offers_messages');
        if($next_date)
        {
            if($next_date==date("Y-m-d"))
            {
                $send=1;
                update_next_date($user_id, $message_type,$next_date);
            }else{
                return redirect()->route('admin.offersent.index')->with('success','Invoice not send because user not want receive on this date.');
            }  
        }
        $packaging = (is_array($tmp) ? implode(',',@$tmp) : '');
        $purpose_tmp = json_decode(@$matches->stock->purposes,true);
        $purpose = (is_array($purpose_tmp) ? implode(',',@$purpose_tmp) : '');
        $notes=$OfferSent->notes;
        if(!empty($user) && !empty($matches))
        {
            $mpdf = new \Mpdf\Mpdf();
            $template = utf8_encode(view('backend.matches.invoice',compact('matches','user','packaging','purpose','OfferSent','notes')));
            $mpdf->WriteHTML($template);
            if($OfferSent->buyer->contact_email){
              if($user->email_subscription == 1){
                Mail::send('backend.mail.default', ['name' => 'Invoice', 'body' => 'Invoice Message'], function ($message) use ($matches,$user,$OfferSent,$mpdf) {
                    if($send==0){
                        $message->subject('Invoice of Veg King!');
                    }else{
                        $message->subject('Invoice of Veg King! Digest for '.$digest. ' days');
                    }
                    

                    if($OfferSent->buyer->email != ''){ $message->to($OfferSent->buyer->email); }
                    $message->cc($user->email);
                    $message->attachData($mpdf->output("Invoice.pdf",'S'), "Invoice.pdf");
                });
            }
          }
        }
        return redirect()->route('admin.offersent.index')->with('success','Invoice send Successfully.');
    }

     /**
     * View Invoice to partoicular buyer
     */
    public function view_Invoice(Request $request, $id){
        $OfferSent = OfferSent::where('id', @$id)->first();
        $user = auth()->user();
        $url = url('/') .'/img/'. Settings()->site_logo;
        $matches = Match::with('stock', 'stock.seller', 'stock.product','offerproperty.productspec','offerproperty.productspecvalue')->where('id', $OfferSent->match_id)->first();
        $tmp = json_decode(@$matches->stock->packaging,true);
        $packaging = (is_array($tmp) ? implode(',',@$tmp) : '');
        $purpose_tmp = json_decode(@$matches->stock->purposes,true);
        $purpose = (is_array($purpose_tmp) ? implode(',',@$purpose_tmp) : '');
        $notes=$OfferSent->notes;
        if(!empty($user) && !empty($matches))
        {
            $mpdf = new \Mpdf\Mpdf();
            $template = view('backend.matches.invoice',compact('matches','user','packaging','purpose','notes'));
            $mpdf->WriteHTML($template->render());
            $mpdf->Output();
        }else{
            return redirect()->route('admin.matches.index')->with('error','Invalid Request');
        }
    }

    public function add_offersentnotes(Request $request){
        $tableArray['notes'] = $request->notes;
        $offersent = OfferSent::updateOrCreate(['id' => $request->offersent_id], $tableArray);
        return response()->json(['status' => 'success', 'message' => 'Added offersent notes successfully.']);
    }

    public function get_offersentnotes(Request $request){
        $offersent_notes = OfferSent::select('notes')->where('id',$request->id)->first();
       return $offersent_notes;
    }

      /** Use for export Excel data */
  public function offersentexports()
  {
      return Excel::download(new OfferSentExport, 'offersent.xlsx');
  }
}
