<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Stock;
use App\Product;
use App\Sale;
use App\OfferRequest;
use App\Models\Auth\User;
use DataTables;
use App\Events\Backend\RequestMatched;

class OfferRequestController extends Controller{

  public function index(Request $request){
      if ($request->ajax()) {
            $data = OfferRequest::with('product', 'buyer')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                       $btn = ' <div class="btn-group btn-group-sm">
                                  <button type="button" class="btn btn-edit editItem" data-url="'.route('admin.requests.edit', $row->id).'"><i class="fas fa-edit"></i></button>
                                  <button type="button" class="btn btn-primary viewItem" data-url="'.route('admin.requests.show', $row->id).'"><i class="fas fa-eye"></i></button>
                                  <button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>
                                </div>';
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
      }
      //return view('backend.offers.users');
      $offers = OfferRequest::with('product')->get();
      return view('backend.requests.index',compact('offers'));
  }

  public function matchingOffers(Request $request, OfferRequest $offer_request){
    $data = Stock::with('product', 'seller')
    ->where('product_id', $offer_request->product_id)
    ->where('variety', $offer_request->variety)
    ->where('packing', $offer_request->packing)
    ->where('flesh_color', $offer_request->flesh_color)
    ->where('location_from', $offer_request->location_from)
    ->where('location_to', $offer_request->location_to)
    ->whereBetween('price', [$offer_request->price_from, $offer_request->price_to])
    ->get();
    return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
             $btn = '<div class="btn-group btn-group-sm">
                        <button data-toggle="tooltip" data-request_id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-success ApplyItem">Apply</button>
                      </div>';
              return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
  }

  public function applyMatchingOffer(Request $request){
    $offer = Stock::find($request->offer_id);
    $offer_request = OfferRequest::find($request->request_id);
    $sale = Sale::updateOrCreate(
        ['offer_id' => $request->offer_id, 'request_id' => $request->request_id],
        ['offer_id' => $request->offer_id, 'request_id' => $request->request_id, 'price' => $offer->price]
    );
    if($sale->wasRecentlyCreated){
      $seller_message = 'Dear '.$offer->seller->first_name.',
      Your offer matched for '.$offer_request->product->name.' ('.$offer_request->variety.'), Flesh Color: '.$offer_request->flesh_color.', Size: '.$offer_request->size_from.' - '.$offer_request->size_to.', QTY: '.$offer_request->quantity.', Price: '.$offer_request->price_from.' - '.$offer_request->price_to.', location: '.$offer_request->location_from.' - '.$offer_request->location_to;
      $buyer_message = 'Dear '.$offer_request->buyer->first_name.',
      Your request matched for '.$offer->product->name.' ('.$offer->variety.'), Flesh Color: '.$offer->flesh_color.', Size: '.$offer->size.', QTY: '.$offer->quantity.', Price: '.$offer->price.', location: '.$offer->location_from.' - '.$offer->location_to;

      SendSMS($offer->seller->phone, $seller_message);
      SendSMS($offer_request->buyer->phone, $buyer_message);
      SendWhatsapp(['phone' => $offer->seller->phone, 'body' => $seller_message,'is_PDF'=>false]);
      SendWhatsapp(['phone' => $offer_request->buyer->phone, 'body' => $buyer_message,'is_PDF'=>false]);
    }

    $data = OfferRequest::with('product', 'buyer')->where('product_id', $offer->product_id)->get();
    return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
             $btn = '<div class="btn-group btn-group-sm">
                        <button data-toggle="tooltip" data-request_id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger ApplyItem">Apply</button>
                      </div>';
              return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
  }

  public function create(){
      $products = Product::all()->where('status', '1')->pluck('name', 'id');
      $buyers = User::whereHas('roles', function($q){
            $q->where('name', 'buyer');
      })->get();
      return view('backend.requests.create',compact('products','buyers'));
  }

  public function store(Request $request){
    $request->validate([
      'product_id' => 'required',
      'buyer_id' => 'required',
    ]);
    $offer_request = OfferRequest::create($request->all());
    event(new RequestMatched($offer_request));
    return redirect()->route('admin.requests.index')->with('success','Request created successfully.');
  }


    public function show(OfferRequest $offer_request){
        //$offer_request = $request;
        return view('backend.requests.show',compact('offer_request'));
    }


    public function edit(OfferRequest $offer_request){
      $products = Product::all()->where('status', '1')->pluck('name', 'id');
      $buyers = User::whereHas('roles', function($q){
            $q->where('name', 'buyer');
      })->get();
      return view('backend.requests.edit',compact('products','offer_request', 'buyers'));
    }

    public function update(Request $request, OfferRequest $offer_request){
      $request->validate([
        'buyer_id' => 'required',
        'product_id' => 'required',
      ]);
      $offer_request->update($request->all());
      event(new RequestMatched($offer_request));
      return redirect()->route('admin.requests.index')->with('success','Request undated successfully.');
    }

    public function destroy(OfferRequest $offer_request){
      $offer_request->delete();
      return response()->json(['success'=>'Request deleted successfully.']);
    }
}
