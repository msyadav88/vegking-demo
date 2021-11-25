<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Stock;
use App\Sale;
use App\Seller;
use App\Buyer;
use App\Match;
use App\MatchesName;
use App\Product;
use App\ProductSpecification;
use App\ProductSpecificationValue;
use App\BuyerPref;
use App\Warehouse;
use DataTables;
use DB;
use DateTime;
use App\AppHead;
use App\Models\Auth\User;
use App\OfferSent;
use App\Offer2;
use Mail;
use App\Exports\MatchesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Events\Backend\StockUpdated;
use App\Events\Backend\BuyerUpdated;
use App\Events\Pushnotification;
use App\Repositories\Backend\Auth\UserRepository;
use App\Roles;
class MatchsController extends Controller{

    function __construct(UserRepository $userRepository){
        $this->middleware('permission:view matches', ['only' => ['index']]);
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
                   // $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', now());
                   // $datetime1 = new DateTime($from);
                   // $hours = 2 * 24;
                   // $pref_created_at = $datetime1->sub(new \DateInterval('PT'.$hours.'H'));
                   // echo $pref_created_at->date;
                   // print_r($pref_created_at->format('Y-m-d H:s:i'));exit;

     $data = Match::with(['product', 'offerSent','buyerPref.buyer', 'buyerPref.productPrefs.productSpecValue', 'stock.seller' ,'stock.offerProperty.productSpecValue'
         , 'stock.sales'=> function ($q) {
              $q->orderBy('sales.id')->limit(3);
            }]);
      if(isset($request->exclude_match_type) && !empty($request->exclude_match_type)){
         $data->with(['matchItem'=>function($q) use($request){
            $q->whereNotIn('product_specification_id', explode(',',$request->exclude_match_type));
         }])
         ->withCount(['matchItem'=>function($q) use($request){
            $q->whereNotIn('product_specification_id', explode(',',$request->exclude_match_type));
         }]);
      }else{
         $data->with('matchItem');
      }
               // echo '<pre>';print_r($data->get()->toArray());exit;
     // echo '<pre>';print_r($data[0]->stock->sales->toArray());exit;
             // echo '<pre>';print_r($data->get()->toArray());exit;
     // echo '<pre>';print_r($data[0]->stock->sales->toArray());exit;
     $data->whereDoesntHave('buyerPref.buyer.user.roles',function($q){ $q->where('name','ignore');  });
     $data->whereHas('buyerPref.buyer.user',function($q){ $q->where('active',1);} );

      if(empty($request->product_id)){
        $product_id = 1;
      }else{
        $product_id = $request->product_id;
      }
     $data->where('matches.product_id', $product_id);

     $buyer_ids = Buyer::select('id');
     if(isset($request->buyer) && !empty($request->buyer)){
       $buyer_ids->where('id',$request->buyer);
     }
     $buyer_ids = $buyer_ids->get();

     $seller_ids = Seller::select('id');
     if(isset($request->seller) && !empty($request->seller)){
       $seller_ids->where('id',$request->seller);
     }
     $seller_ids = $seller_ids->get();


     if(isset($request->pid) && !empty($request->pid)){
         $data->where('buyer_pref_id', $request->pid);
      }else{
         $buyer_pref_ids = BuyerPref::select('id')->whereIn('buyer_id',$buyer_ids);
        $buyer_pref_ids = $buyer_pref_ids->get();
         $data->whereIn('buyer_pref_id',$buyer_pref_ids);
     }

     if(isset($request->sid) && !empty($request->sid)){
        $data->where('stock_id', $request->sid);
     }else{
        $offer_ids = Stock::select('id')->whereIn('seller_id',$seller_ids)->get();
        $data->whereIn('stock_id',$offer_ids);
     }

     if(isset($request->match_type) && !empty($request->match_type)){
        if(@$request->show_matched != 'yes'){
           $match_type_array = explode(',',$request->match_type);
           foreach($match_type_array as $match_type){
              $data->whereDoesntHave('matchItem', function($q) use($match_type) {
                  $q->where('product_specification_id', $match_type);
              });
           }
        }
     }

      $product_specifications = array();
      $product_specifications1 = \App\ProductSpecification::select('id', 'display_name')->where('product_id',$product_id)->whereNull('parent_id')->get();
      foreach ($product_specifications1 as $key => $value) {
         $product_specifications[$value->id] = $value->display_name;
      }

        $ProdSpecArr = array();
        if(isset($request->product_id) && !empty($request->product_id)){
           $ProdSpecArr1 = ProductSpecification::select('id','type_name', 'display_name', 'shortcode')->where('product_id',$request->product_id)->whereNull('parent_id')->orderByRaw('FIELD(type_name,"quality","purpose") desc')->limit(6)->get();
        } else {
           $ProdSpecArr1 = ProductSpecification::select('id','type_name', 'display_name', 'shortcode')->where('product_id',@$product_id)->whereNull('parent_id')->orderByRaw('FIELD(type_name,"quality","purpose") desc')->limit(6)->get();
        }
        foreach ($ProdSpecArr1 as $value) {
          if(!empty($value->shortcode)){
            $d_name = $value->shortcode;
          }else{
            $d_name = $value->display_name;
          }
          $ProdSpecArr[$value->id] = $value->toArray();
          $ProdSpecArr[$value->id]['shortcode'] = $d_name;
        }
        // echo '<pre>';print_r($ProdSpecArr);exit;
      if ($request->ajax()) {
        $search_value = array();
         if(!empty($request['columns'])){
            foreach ($request['columns'] as $value_search) {
               if (!empty($value_search['search']['value'])) {
                   $search_value[$value_search['data']] = $value_search['search']['value'];
               }
            }
            foreach($search_value as $key=>$val){
               if(strpos($key, '-buyer') !== false && $val != ''){
                  $tmp = explode('-',$key);
                 $data->whereHas('buyerPref.productPrefs.productSpecValue',function($q) use($search_value,$tmp,$val){ 
                     // $q->where('id',42);
                     $q->where('product_specification_id',$tmp[1]);
                     $q->where('id',$val);
                  });
               }
               if(strpos($key, '-seller') !== false && $val != ''){
                  $tmp = explode('-',$key);
                 $data->whereHas('stock.offerProperty.productSpecValue',function($q) use($search_value,$tmp,$val){ 
                     // $q->where('id',42);
                     $q->where('product_specification_id',$tmp[1]);
                     $q->where('id',$val);
                  });
               }
            }
         }
         $qualitySpec = ProductSpecification::select('id', 'type_name')->where('product_id',$request->product_id)->whereNull('parent_id')->where('type_name','quality')->first();
         // echo '***'.$qualitySpec->id;exit;
        // echo '<pre>';print_r($request->toArray());exit;
         if($request->show_matched == "loaded" || $request->show_matched == "rejected")
         {
           $status = $request->show_matched;
           $data = Warehouse::with('stock','sale')->whereHas('stock', function($q) use($status){
           $q->where('load_status',  $status);
           });
           if($request->ton){
              $data = $data->get();
              foreach ($data as $pton_key => $row) {
                 if (($request->operator == "less" &&  $row->tons < $request->ton) || ($request->operator == "greater" &&  $row->tons > $request->ton) || ($request->operator == "equal" && $row->tons != $request->ton)) {
                     $data->forget($pton_key);
                 }
             }
           }
           $data = $data->get();
           return Datatables::of($data)
             ->addIndexColumn()
             ->addColumn('action', function($row){
                    $btn = ' <div class="btn-group btn-group-sm">
                             </div>';
                     return $btn;
             })
             ->addColumn('flesh_color', function($row){
               return @$row->stock->flesh_color_detail->name;
             })
             ->addColumn('purposes', function($row){
                $tmp = json_decode(@$row->stock->purposes,true);
                $data = (is_array($tmp) ? implode(',',@$tmp) : '');
               return @$data;
             })
             ->addColumn('defect', function($row){
               $tmp = json_decode(@$row->stock->defect,true);
               $data = (is_array($tmp) ? implode(',',@$tmp) : '');
              return @$data;
            })
            ->addColumn('soil', function($row){
               $tmp = json_decode(@$row->stock->soil,true);
               $data = (is_array($tmp) ? implode(',',@$tmp) : '');
              return @$data;
            })
             ->addColumn('variety_name', function($row){
               return @$row->stock->variety_detail->name;
             })
             ->addColumn('country', function($row){
                   return (@$row->country?@$row->country:'-');
               })
               ->addColumn('city', function($row){
                   return (@$row->city?@$row->city:'-');
               })
               ->addColumn('postcode', function($row){
                   return (@$row->postcode?@$row->postcode:'-');
               })
               ->addColumn('tons', function($row){
                   return (@$row->tons?@$row->tons:'-');
               })
               ->addColumn('product', function($row){
                   return (@$row->product?@$row->product:'-');
               })
               ->addColumn('dateStored', function($row){
                   return (@$row->dateStored?@$row->dateStored:'-');
               })
               ->addColumn('notes', function($row){
                   return (@$row->notes?@$row->notes:'-');
               })
           ->rawColumns(['action'])
           ->make(true);
         }else
         {
             if (isset($request->show_matched) && $request->show_matched=='yes') {
                 // echo 'dfd';exit;
                 $data->where('numofmismatches', 0);
             } elseif(isset($request->show_matched) && $request->show_matched=='no') {
                 $data->where('numofmismatches', '>', 0);
             }
             $base_price_arr = Product::select(['id','base_price'])->get();
             $operators = array(
                'less' => '<',
                'greater' => '>',
                'equal' => '=',
              );
              if(@$request->p_ton != ''){
                $data->where('profit_per_ton', $operators[$request->operator_profit_per_ton], floatval($request->p_ton));
              }
              if(@$request->price_per_ton != ''){
                $price_per_ton = $request->price_per_ton;
                $data->whereHas('stock',function($q) use($price_per_ton,$operators){ $q->where('price',$operators[request()->operator_price_per_ton],floatval($price_per_ton));} );
              }
         // $data->whereHas('stock.offerProperty.productSpecValue',function($q){
         //    $q->where('product_specification_id',20);
         //    $q->where('value', '>', 5);
         // });
              foreach($request->toArray() as $key=>$val){
               // echo '***'.$key;
               if(strpos($key, 'Quality-') === 0  && $val != ''){ // FOR QUALITY
                  $tmp = explode('-',$key);
                  $operator_variable = 'operator_'.$key;
                     // echo $operator_variable;exit;
                  if(strpos($key, '-buyer') !== false){
                     $data->whereHas('buyerPref.productPrefs.productSpecValue',function($q) use($request,$operators,$key,$tmp,$val, $operator_variable){
                           $q->where('product_specification_id',$tmp[1]);
                           $q->where('value', $operators[$request->$operator_variable], floatval($val));
                        });
                  }elseif(strpos($key, '-seller') !== false){
                  // echo 'dfd'.$request->$key.' '.$tmp[1];exit;
                     $data->whereHas('stock.offerProperty.productSpecValue',function($q) use($request,$operators,$key,$tmp,$val, $operator_variable){
                        $q->where('product_specification_id',$tmp[1]);
                        $q->where('value', $operators[$request->$operator_variable], floatval($val));
                     });

                  }

               }
              }
              if(@$request->mm != ''){
                  if(!empty(@$request->exclude_match_type)){
                     $data->having('match_item_count',$operators[$request->operator_numofmismatches],$request->mm);
                  }else{
                     $data->where('numofmismatches', $operators[$request->operator_numofmismatches], $request->mm);
                  }
              }
             if ($request->tsb != '') {
                  $data->whereHas('buyerPref.buyer',function($q) use($request,$operators){
                     $trust_level = \App\AppHead::where('is_active', '1')->where('type', 'trust_level')->where('name',$operators[$request->operator_trust_level_buyer], $request->tsb)->pluck('id');
                     $q->whereIn('trust_level',$trust_level);
                  });
             }
             if ($request->tss != '') {
                  $data->whereHas('stock.seller',function($q) use($request,$operators){
                     $trust_level = \App\AppHead::where('is_active', '1')->where('type', 'trust_level')->where('name',$operators[$request->operator_trust_level_seller],$request->tss)->pluck('id');
                     $q->whereIn('trust_level',$trust_level);
                  });
             }
             if(!empty($request->order)){
                //echo $request->order[0]['dir'];print_r($request->order);exit;
                //echo $request['columns'].$request->order[0]['column'].['name'];exit;
                $fieldname = $request->order[0]['column'];
                $field_type = $request['columns'][$fieldname]['name'];
                $field_order = $request->order[0]['dir'];
                if($field_type == "buyer_show_url"){
                  $data->select('matches.*');
                  $data->join('buyer_prefs', 'matches.buyer_pref_id', 'buyer_prefs.id');
                  $data->join('buyers', 'buyer_prefs.buyer_id', 'buyers.id');
                  $data->orderBy('buyers.username',$field_order);
                }else if($field_type == "seller_show_url"){
                  $data->select('matches.*');
                  $data->join('stocks', 'matches.stock_id', 'stocks.id');
                  $data->join('sellers', 'stocks.seller_id', 'sellers.id');
                  $data->orderBy('sellers.username',$field_order);
                }else if($field_type == "trust_level_buyer"){
                  $data->select('matches.*');
                  $data->where(['type' => 'trust_level','is_active' => '1']);
                  $data->join('buyer_prefs', 'matches.buyer_pref_id', 'buyer_prefs.id');
                  $data->join('buyers', 'buyer_prefs.buyer_id', 'buyers.id');
                  $data->join('app_heads', 'buyers.trust_level', 'app_heads.id');
                  $data->orderBy('app_heads.name',$field_order);
                }else if($field_type == "trust_level_seller"){
                  $data->select('matches.*');
                  $data->where(['type' => 'trust_level','is_active' => '1']);
                  $data->join('stocks', 'matches.stock_id', 'stocks.id');
                  $data->join('sellers', 'stocks.seller_id', 'sellers.id');
                  $data->join('app_heads', 'sellers.trust_level', 'app_heads.id');
                  $data->orderBy('app_heads.name',$field_order);
                }else if($field_type == "stock_show_url"){
                  $data = $data->orderBy('stock_id', $field_order);
                }else if($field_type == "price_per_ton"){
                  $data->select('matches.*');
                  $data->join('stocks', 'matches.stock_id', 'stocks.id');
                  $data->join('sellers', 'stocks.seller_id', 'sellers.id');
                  $data->orderBy('stocks.price',$field_order);
                }else if($field_type == "pref_created_at"){
                  $data->select('matches.*');
                  $data->join('buyer_prefs', 'matches.buyer_pref_id', 'buyer_prefs.id');
                  $data->orderBy('buyer_prefs.created_at',($field_order=='asc'?'desc':'asc'));
                }else if($field_type == "stock_created_at"){
                  $data->select('matches.*');
                  $data->join('stocks', 'matches.stock_id', 'stocks.id');
                  // $data->join('buyer_prefs', 'matches.buyer_pref_id', 'buyer_prefs.id');
                  $data->orderBy('stocks.created_at',($field_order=='asc'?'desc':'asc'));
                }else{
                  $data = $data->orderBy($field_type, $field_order);
                }
             }else{
                $data = $data->orderBy('numofmismatches', 'asc')->orderBy('total_profit', 'desc');
             }
              if(@$request->pref_created_at != ''){
                $data->whereHas('buyerPref', function($q) use($request,$operators){
                   // $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $row->buyerPref->created_at);
                   $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', now());
                   $datetime1 = new DateTime($from);
                   // $datetime2 = new DateTime($to);
                   // $interval = $datetime1->diff($datetime2);
                   // $days = $interval->format('%a');
                   $seconds = floor($request->pref_created_at * 24*3600);
                   $pref_created_at = $datetime1->sub(new \DateInterval('PT'.$seconds.'S'));
                   // $pref_created_at = new DateTime(\Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $pref_created_at2));
                  $q->whereRaw(' "'.$pref_created_at->format('Y-m-d H:i:s').'" '.$operators[$request->operator_pref_created_at]. ' created_at ');
                  // $q->whereRaw('created_at '.$operators[$request->operator_pref_created_at]. ' "'.$pref_created_at->format('Y-m-d H:i:s').'"');
                });
              }
              if(@$request->stock_created_at != ''){
                $data->whereHas('stock', function($q) use($request,$operators){
                   $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', now());
                   $datetime1 = new DateTime($from);
                   $seconds = floor($request->stock_created_at * 24*3600);
                   $stock_created_at = $datetime1->sub(new \DateInterval('PT'.$seconds.'S'));
                  $q->whereRaw(' "'.$stock_created_at->format('Y-m-d H:i:s').'" '.$operators[$request->operator_stock_created_at]. ' created_at ');
                });
              }

            $datatables = Datatables::of($data)
           ->addIndexColumn()
           ->addColumn('checkbox', function($row){
              $btn = ' <div class="btn-group btn-group-sm">
              <input type="checkbox" name="sendmail[]" data-id="'.$row->id.'" />
           </div>
           <div>P</div>';
              return $btn;
           })
            ->addColumn('Test', function($row){
              return "";
           })
            ->addColumn('Test1', function($row){
              return "S";
           })
           ->addColumn('buyer_show_url', function($row){
              //  echo "<pre/>"; print_r($row); die;
           // $all_orders = Sale::select('app_heads.name','stocks.quantity','stocks.street','stocks.country','stocks.price','stocks.postalcode','stocks.size_from','stocks.size_to','offersent.time_sent','offersent.created_at')->join('stocks', 'stocks.id', '=', 'sales.stock_id')->join('app_heads', 'app_heads.id', '=', 'stocks.product_id')->join('offersent', 'offersent.stock_id', '=', 'stocks.id')->where('sales.stock_id',$row->stock_id)->where('offersent.match_id',$row->id)->limit(3)->orderBy('sales.id')->get();

           $data = '<div class="btn-group btn-group-sm"><button class=" btn btn-success expand_row" id_v="'.$row->id.'" style="box-sizing: border-box;"><i class="fa fa-plus" aria-hidden="true"></i></button></div>&nbsp;&nbsp;<a href="'.route('admin.buyers.show', @$row->buyerPref->buyer->id).'" target="_blank">'.@$row->buyerPref->buyer->username.'</a>
           <br>
           <div class="tab_show"  id="tab_show'.$row->id.'" style="display: none;">
              <ul class="nav nav-tabs col-md-12 tabs"  id="tabs'.$row->id.'">
                 <li class="nav-item"><a id="tab1'.$row->id.'" class="nav-link active" href="javascript:void(0)"  role="tab">Orders</a></li>
                 <li class="nav-item"><a id="tab2'.$row->id.'" class="nav-link inactive" href="javascript:void(0)"  role="tab">Offer Sent</a></li>
                 <li class="nav-item"><a id="tab3'.$row->id.'" class="nav-link inactive" href="javascript:void(0)"  role="tab">Both</a></li>
              </ul>
              <div class="containerss" id="tab1'.$row->id.'C" style="display: block;">';
              foreach ($row->stock->sales as $key => $val) {
                 $data .= 'Product Name: '.$row->stock->product->name.'<br>Quantity: '.$row->stock->quantity.'<br>Size_from: '.$row->stock->size_from.'<br>Size_to: '.$row->stock->size_to.'<br>Country: '.$row->stock->country.'<br>Street: '.$row->stock->street.'<br>PostalCode: '.$row->stock->postalcode.'<br><hr>';
              }
              $data .= '</div>
              <div class="containerss" id="tab2'.$row->id.'C" style="display: none;">';
              foreach ($row->stock->sales as $key => $val) {
                 $data .= 'Product Name: '.$row->stock->product->name.'<br>Time Sent: '.@$row->offerSent->time_sent.'<br>created_at: '.@$row->offerSent->created_at.'<br><hr>';
              }


              $data .= '</div>
              <div class="containerss" id="tab3'.$row->id.'C" style="display: none;">';
              foreach ($row->stock->sales as $key => $val) {

                 $data .= 'Product Name: '.$row->stock->product->name.'<br>Quantity: '.$row->stock->quantity.'<br>Size_from: '.$row->stock->size_from.'<br>Size_to: '.$row->stock->size_to.'<br>Country: '.$row->stock->country.'<br>Street: '.$row->stock->street.'<br>PostalCode: '.$row->stock->postalcode.'<br>Time Sent: '.@$row->offerSent->time_sent.'<br><hr>';
              }
              $data .= '</div>
              </div>

           ';
           return $data;
           })
           ->addColumn('seller_show_url', function($row){
           $data = '<a href="'.route('admin.sellers.show', isset($row->stock->seller)?@$row->stock->seller->id:'').'" target="_blank">'.@$row->stock->seller->username.'</a>';
           return $data;
           })
           ->addColumn('stock_show_url', function($row){
           $data = '<a href="javascript:void(0);" data-stockid="'.$row->stock_id.'" class="stockShow">'.$row->stock_id.'</a>';
           return $data;
           })
           ->addColumn('buyer_pref_id', function($row){
           $data = '<a href="javascript:void(0);" data-prefid="'.$row->buyer_pref_id.'" class="buyerPrefs">'.$row->buyer_pref_id.'</a>';
           return $data;
           });
           foreach($ProdSpecArr as $keys => $ProdSpec){
              $specsRawColumns[] = $ProdSpec['shortcode'].'-'.$ProdSpec['id'].'-buyer';
              $datatables->addColumn($ProdSpec['shortcode'].'-'.$ProdSpec['id'].'-buyer', function($row) use ($ProdSpec) {
                $arrFields  = array();
                foreach($row->buyerPref->productPrefs as $prop){
                   $arrFields[@$prop->productSpecValue->product_specification_id][] = (!empty(@$prop->productSpecValue->shortcode) ? @$prop->productSpecValue->shortcode : @$prop->productSpecValue->value);
                   $arrFields[@$prop->productSpecValue->product_specification_id.'-fullname'] = @$prop->productSpecValue->value;
                }
                if(is_array($arrFields)&& !empty($arrFields[@$ProdSpec['id']])){
                   // return implode(', ',@$arrFields[@$ProdSpec['id']]);
                  $data = '<a href="javascript:void(0);" data-original-title="'.$arrFields[@$ProdSpec['id'].'-fullname'].'" data-toggle="tooltip" data-placement="bottom" class="matrisHeader">'.implode(', ',@$arrFields[@$ProdSpec['id']]).'</a>';     
                  return $data;
                } else {
                   return '-';
                }
              });
           }
           foreach($ProdSpecArr as $keys => $ProdSpec){
              $specsRawColumns[] = $ProdSpec['shortcode'].'-'.$ProdSpec['id'].'-seller';
              $datatables->addColumn($ProdSpec['shortcode'].'-'.$ProdSpec['id'].'-seller', function($row) use ($ProdSpec) {
                $arrFields  = array();
                foreach($row->stock->offerProperty as $prop){
                   $arrFields[$prop->product_spec_id][] = (!empty(@$prop->productSpecValue->shortcode) ? @$prop->productSpecValue->shortcode : @$prop->productSpecValue->value) ;
                   $arrFields[$prop->product_spec_id.'-fullname'] = @$prop->productSpecValue->value;
                }
                if(is_array($arrFields)&& !empty($arrFields[@$ProdSpec['id']])){
                   // return implode(', ',@$arrFields[@$ProdSpec['id']]);
                  $data = '<a href="javascript:void(0);" data-original-title="'.$arrFields[@$ProdSpec['id'].'-fullname'].'" data-toggle="tooltip" data-placement="bottom" class="matrisHeader">'.implode(', ',@$arrFields[@$ProdSpec['id']]).'</a>';     
                  return $data;
                } else {
                   return '-';
                }
              });
           }
           $datatables = $datatables->addColumn('profit_per_ton', function($row) use($base_price_arr){
              // dd($row->toArray);
              $pTonCalculation = json_decode($row->pton_calculation);
              // foreach ($base_price_arr as $value) {
              //    if($value->id == $row->product_id){
              //       $base_price = $value->base_price;
              //       break;
              //    }
              // }
              // $pTonCalculation = $this->pTonCalculation($row->stock, $row->buyerPref, $pTonCalculation->global_premium_factor_name, $pTonCalculation->global_premium_factor, $pTonCalculation->bpfs_count, $pTonCalculation->ec, $pTonCalculation->ecbf, @$base_price);
              // $data = '<a href="javascript:;" class="pton">'.$pTonCalculation['profitPerTon'].'</a>';
              // $data .= '<div class="pton_calculation d-none">'.$pTonCalculation['pton_calculation'].'</div>';
               $data = '<a href="javascript:;" class="pton">'.$row->profit_per_ton.'</a>';
               $data .= '<div class="pton_calculation d-none">'.@$pTonCalculation->pton_calculation.'</div>';
              return $data;
           })
           ->addColumn('mismatches', function($row) use($product_specifications){
              if($row->numofmismatches > 0){
                 foreach(@$row->matchItem as $val){
                    // if(!empty($val->value)){
                       $tmp[] = [@$product_specifications[$val->product_specification_id],$val->value];
                    // }
                 }
                 $data = str_replace('],[','] , [',stripslashes(json_encode(@$tmp)));
              }
           // $data = (is_array($row->match_items) ? json_encode($row->match_items) : $row->match_items);
           return @$data;
           })
           ->addColumn('trust_level_buyer', function($row){
              $trust_level = trustlevel_list();
              // echo $row->trust_level;exit;
              foreach(@$trust_level as $val){
                 if($row->buyerPref->buyer->trust_level == $val->id){
                    $data = $val->name;
                    break;
                 }
              }
              // $data = (is_array($row->match_items) ? json_encode($row->match_items) : $row->match_items);
           return @$data;
           })
           ->addColumn('trust_level_seller', function($row){
              $trust_level = trustlevel_list();
              foreach(@$trust_level as $val){
                 if(@$row->stock->seller->trust_level == $val->id){
                    $data = $val->name;
                    break;
                 }
              }
           return @$data;
           })
           ->addColumn('price_per_ton', function($row){
            $data = $row->stock->price;
            return $data;
           })
           ->addColumn('QND', function($row) use($qualitySpec){
            if(isset($row->buyerPref->productPrefs)){
               $tmp = array();
               foreach ($row->buyerPref->productPrefs as $key => $value) {
                  if(!empty(@$value->productSpecValue) && @$value->productSpecValue->product_specification_id == $qualitySpec->id){
                        $qnb = $value->productSpecValue->value;
                     break;
                  }
               }
            }
            if(isset($row->stock->offerProperty)){
               $tmp = array();
               foreach ($row->stock->offerProperty as $key => $value) {
                  if(!empty(@$value->productSpecValue) && @$value->productSpecValue->product_specification_id == $qualitySpec->id){
                        $qns = $value->productSpecValue->value;
                     break;
                  }
               }
            }
            // $data='-';
            if(!empty($qnb) && is_numeric($qnb) && !empty($qns) && is_numeric($qns)){
               $data=$qnb-$qns;
            }else{
               $data = '';
            }
          return @$data;
           })
           ->addColumn('pref_created_at', function($row){
             $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $row->buyerPref->created_at);
             $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', now());
             $datetime1 = new DateTime($from);
             $datetime2 = new DateTime($to);
             // $diff = $datetime2->diff($datetime1);
             // $data = date_default_timezone_get();//print_r($diff,true);
             // $days = $interval->format('%a');
             // $days = round($diff->s / 3600*24 + $diff->i / 60*24 + $diff->h / 24 + $diff->days + $diff->month, 2);
             $days = round(($datetime2->getTimestamp() - $datetime1->getTimestamp()) / 3600/24, 2);
              $data = '<a href="javascript:void(0);" data-original-title="'.$row->buyerPref->created_at.'" data-toggle="tooltip" data-placement="bottom" class="matrisHeader">'.$days.' Days Ago</a>';
              // $data = '<a href="javascript:void(0);" data-original-title="<strong>'.$row->buyerPref->created_at.'" data-toggle="tooltip" data-placement="bottom" class="matrisHeader">'.$row->buyerPref->created_at->diffForHumans().'</strong></a>';
              return @$data;
           })
           ->addColumn('stock_created_at', function($row){
             $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $row->stock->created_at);
             $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', now());
             $datetime1 = new DateTime($from);
             $datetime2 = new DateTime($to);
             // $interval = $datetime1->diff($datetime2);
             // $days = $interval->format('%a');
             $days = round(($datetime2->getTimestamp() - $datetime1->getTimestamp()) / 3600/24, 2);
            // $diff = time() - $row->stock->created_at;
             // return $days;
            // $data     = round($diff / 86400 );
              $data = '<a href="javascript:void(0);" data-original-title="'.$row->stock->created_at.'" data-toggle="tooltip" data-placement="bottom" class="matrisHeader">'.$days.' Days Ago</a>';
            // $data = $days;
           return $data;
           })
           ->addColumn('action', function($row){
           $stock_detail = Stock::find($row->stock_id);
           $btn = ' <div class="btn-group btn-group-sm">
           <button type="button" class="btn btn-success viewItem" title="Make Sale" data-url="'.route('admin.sales.create', ['buyer' => $row->buyerPref->buyer->id, 'stock' => $row->stock_id, 'match' => $row->id]).'" ><img width="30px" src="'.asset('img/sale-icon.png').'" /></button>
           <button type="button" class="btn btn-edit editItem" title="Edit Match" data-url="'.route('admin.matches.edit', $row->id).'" ><i class="fas fa-edit"></i></button>
           <button type="button" class="btn btn-warning sendInvoice" title="Send PDF" data-url="'.route('admin.matches.InvoiceSend', $row->id).'" data-viewurl="'.route('admin.matches.InvoiceView', $row->id).'" data-id="'.$row->id.'"><i class="fas fa-file-invoice"></i></button>
           </div>';
           return $btn;
           })
           ->addColumn('product', function($row){
               $data = $row->product->name;
               return @$data;
           })
           ->addColumn('numofmismatches', function($row) use($request){
            if(isset($request->exclude_match_type) && !empty($request->exclude_match_type)){
               $data = $row->match_item_count;
            }else{
               $data = $row->numofmismatches;
            }
               return @$data;
           })
           ->rawColumns(['product','variety_name','profit_per_ton','pton_calculation','stock_show_url','buyer_pref_id','buyer_show_url','seller_show_url','action','checkbox','numofmismatches','stock_created_at','pref_created_at'])
           ->rawColumns(array_merge(['product','variety_name','profit_per_ton','pton_calculation','stock_show_url','buyer_pref_id','buyer_show_url','seller_show_url','action','checkbox','numofmismatches','stock_created_at','pref_created_at'],$specsRawColumns))
           ->make(true);
           return $datatables;
        }
      }
      // print_r($ProdSpecArr);exit;
      $matches_names = MatchesName::select('id', 'short_names', 'status')->first();
      if($matches_names)
      {
         $matches_names->short_names = json_decode($matches_names->short_names);
      }
      else
      {
         $matches_names = array();
      }
      $rejected_count = Warehouse::with('stock','sale')->whereHas('stock', function($q){
        $q->where('load_status', 'rejected' );
        })->count();
     $warehouse_count = Warehouse::with('stock','sale')->whereHas('stock', function($q){
           $q->where('load_status', 'loaded' );
           })->count();
      $products1 = \App\Product::select('id', 'name')->get();
      $products = array();
      foreach ($products1 as $key => $value) {
         $products[$value->id] = $value->name;
      }
     $product_specification_values = \App\ProductSpecificationValue::select('id','product_specification_id', 'shortcode', 'value')
         ->get()->toArray();
         // echo '<pre>';print_r($product_specification_values);exit;
      $stock_list = Stock::with('seller', 'product')->where('status', 'listed')->get();
      $buyer_pref_list = BuyerPref::with('buyer', 'product')->get();
      $buyers_list = Buyer::select('id', 'username')->has('buyer_prefs')->get();
      $sellers_list = Seller::select('id', 'username')->has('stocks')->get();
      $all_data = clone $data;
      $all_count = $all_data->count();
      $matched_data = clone $data;
      $matched_count = $matched_data->where('numofmismatches', 0)->count();
      $mismatched_data = clone $data;
      $mismatched_count = $mismatched_data->where('numofmismatches','>', 0)->count();
      return view('backend.matches.index', compact('all_count','matched_count','mismatched_count','rejected_count','warehouse_count','stock_list', 'buyers_list','products','ProdSpecArr','product_specifications','matches_names','sellers_list','buyer_pref_list','product_specification_values'));
    }

    public function getSpecsByProduct(Request $request){
      $product_specifications1 = \App\ProductSpecification::select('id', 'display_name')->where('product_id',$request->prd_id)->get();
      if(!empty($product_specifications1->toArray())){
        foreach ($product_specifications1 as $key => $value) {
           $product_specifications[$value->id] = $value->display_name;
        }
        foreach ($product_specifications as $key => $value) {
          echo '<option value="'.$key.'">'.$value.'</option>';
        }
      }
    }

    public function updateShortName(Request $request)
    {
      $response = MatchesName::where('id', 1)->first();
      if($response)
      {
         $objectData = json_encode($request->short_names);
         $status = $request->status;
         $result = MatchesName::where('id', 1)->update(array('short_names' => $objectData, 'status' => $status));
         if($result)
         {
            $response = array(
               'status' => 'success',
               'message' => 'Matches short name updated successfully!',
            );
            return json_encode($response);
         }
         else
         {
            $response = array(
               'status' => 'error',
               'message' => 'Matches not updated error occured!',
            );
            return json_encode($response);
         }
      }
    }

    public function createoffer(Match $Match){

    }
    public function edit($id){
      $match = Match::where(['id' => $id])->first();
      if($match){
         $match = Match::with('stock', 'buyerPref.buyer', 'stock.seller', 'stock.product', 'stock.offerProperty','offerproperty.productspec','offerproperty.productspecvalue')->where('id', $match->id)->first();
         $order_ids=Sale::select('id')->where('match_id',$match->id)->get();
         $stock  = $match->stock;
         $base_price = Product::where('id',$match->product_id)->first();
         $offer = \App\Offer2::where('match_id',$id)->first();
         $offer_price = $offer['offerprice'];
         $pTonCalculation = json_decode(@$match->pton_calculation);
         $pTonCalculation = $this->pTonCalculation($match->stock, $match->buyerPref, @$pTonCalculation->global_premium_factor_name, @$pTonCalculation->global_premium_factor, @$pTonCalculation->bpfs_count, @$pTonCalculation->ec, @$pTonCalculation->ecbf, @$base_price->base_price,$offer_price);

         $seller  = $match->stock->seller;
         $buyer  = $match->buyerPref->buyer;
         $stock_image  = current(json_decode(@$stock->image)??array());
         $available_from_date = date('Y-m-d',strtotime($stock->available_from_date.'+3 days'));
         $salePrice = $pTonCalculation['salePrice'];
         $avgSalePrice = $pTonCalculation['avgSalePrice'];
         //echo "<pre/>"; print_r($match); die;
         return view('backend.matches.editoffer',compact('match','stock','buyer','seller','stock_image','available_from_date','pTonCalculation','salePrice','avgSalePrice','offer','order_ids'));
       }else{
         $stock_list = Stock::with('seller', 'product')->where('status', 'listed')->get();
         $buyers_list = Buyer::select('id', 'username')->get();
         $products1 = \App\Product::select('id', 'name')->get();

         $products = array();
         $product_specifications = array();
         foreach ($products1 as $key => $value) {
            $products[$value->id] = $value->name;
         }
         $product_specifications1 = \App\ProductSpecification::select('id', 'display_name')->get();
         foreach ($product_specifications1 as $key => $value) {
            $product_specifications[$value->id] = $value->display_name;
         }
           if(isset($request->product_id) && !empty($request->product_id)){
              $product_id = $request->product_id;
              $ProdSpecArr = ProductSpecification::where('product_id',$request->product_id)->where('parent_id',NULL)->orderBy('order')->limit(3)->pluck('display_name','id')->toArray();
           } else {
              $product = Product::all()->where('status', '1')->first();
              $product_id = @$product->id;
             // echo "<pre/>"; print_r($product); die;
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
        $msg="Unfortunately this Matches is not exist!";
        return view('backend.matches.index', compact('msg','stock_list', 'buyers_list','products','ProdSpecArr','ProdSpecArrNames','product_specifications'));
       }
    }

   public function reloadOfferPrice(Request $request){
      //print_r($request->toArray());
      $id = $request->matchId;

      if($request->fieldname=="price"){
        $offer_price = $request->fieldvalue;
        $disc = 100-(100*($request->fieldvalue/$request->salePrice));
        $discount = number_format((float)$disc, 2, '.', '');
        $discount_flat_amount = number_format((float)$request->salePrice - $request->fieldvalue, 2, '.', '');
      }else if($request->fieldname=="discount_percent"){
        $discount = $request->fieldvalue;
        $sale_dis = ($request->salePrice * $request->fieldvalue)/100;
        $offer_price = $request->salePrice - $sale_dis;
        $discount_flat_amount = number_format((float)$request->salePrice - $offer_price, 2, '.', '');
      }else if($request->fieldname=="discount_flat_amount"){
        $discount_flat_amount = $request->fieldvalue;
        $offer_price = $request->salePrice - $request->fieldvalue;
        $discount = (100 * $request->fieldvalue)/$request->salePrice;
      }

      $match = Match::where(['id' => $id])->first();
      if($match){
        $match = Match::with('stock', 'buyerPref.buyer', 'stock.seller', 'stock.product', 'stock.offerProperty','offerproperty.productspec','offerproperty.productspecvalue')->where('id', $match->id)->first();
        $stock  = $match->stock;
        $stock->price = $offer_price;

        $base_price = Product::where('id',$match->product_id)->first();
        $pTonCalculation = json_decode(@$match->pton_calculation);
        $pTonCalculation = $this->pTonCalculation($match->stock, $match->buyerPref, @$pTonCalculation->global_premium_factor_name, @$pTonCalculation->global_premium_factor, @$pTonCalculation->bpfs_count, @$pTonCalculation->ec, @$pTonCalculation->ecbf, @$base_price->base_price,$offer_price);
        $pTonCalculation['profitPerTon'] = currency($pTonCalculation['profitPerTon']);
        $pTonCalculation['profit'] = currency($pTonCalculation['profit']);
        $pTonCalculation['profitPerTruck'] = currency($pTonCalculation['profitPerTruck']);
        $pTonCalculation['offerprice'] = number_format((float)$offer_price, 2, '.', '');
        $pTonCalculation['discount'] = number_format((float)$discount, 2, '.', '');
        $pTonCalculation['discount_flat_amount'] = number_format((float)$discount_flat_amount, 2, '.', '');

        return json_encode($pTonCalculation);
      }
   }
  public function notifyMatched($buyerstock)
  {
      // echo 'notifyMatched';exit;
      // echo '<pre>';print_r($buyerstock);exit;
      $query = Match::with('matchItem','stock', 'buyerPref.buyer.prefs.productPrefs.productSpecValue', 'stock.seller', 'stock.product','stock.offerProperty')->where('numofmismatches',0);
      if(class_basename($buyerstock) == 'Offer')
      {
         $data = $query->where('stock_id',@$buyerstock->id)->get();
      }
      elseif(class_basename($buyerstock) == 'BuyerPref')
      {
         $data =  $query->where('buyer_pref_id',@$buyerstock->id)->get();
      }
      elseif(class_basename($buyerstock) == 'Buyer')
      {
         foreach ($buyerstock->prefs as $value)
         {
            $buyer_pref_ids[] = $value['id'];
         }
         if(!empty($buyer_pref_ids))
         {
            $data =  $query->whereIn('buyer_pref_id',$buyer_pref_ids)->get();
         }
      }

      if(isset($data) && @$data->count() > 0)
      {
         $message_data = array();
         foreach ($data as $match)
         {
            if(!isset($match->buyerPref->buyer) || empty($match->buyerPref->buyer))
            {
               continue;
            }
            //start Stock-matched
            \App\Jobs\StockMatched::dispatch(@$match->stock->seller,@$match->buyerPref->buyer,@$match->stock,@$match->buyerPref,@$match);
            //end Stock-matched
            // $order_location = '';
            // foreach (json_decode($match->location_range, true) as $key => $value) {
            //   if($key > 0){
            //     $order_location .= ', ';
            //   }
            //   $order_location = $value['from'].' - '.$value['to'];
            // }
            // echo '<pre>';print_r($traders->toArray());exit;
            $base_price = Product::where('id',$match->product_id)->first();
            $pTonCalculation = json_decode($match->pton_calculation);
            //print_r($match->buyerPref);exit;
            if($pTonCalculation)
            {
               $pTonCalculation = $this->pTonCalculation($match->stock, $match->buyerPref, $pTonCalculation->global_premium_factor_name, $pTonCalculation->global_premium_factor, $pTonCalculation->bpfs_count, $pTonCalculation->ec, $pTonCalculation->ecbf, @$base_price->base_price);
            }
            $tmp['pTonCalculation'] = @$pTonCalculation;
            $tmp['match'] = $match;
            // $tmp['order_location'] = $order_location;
            $message_data[][$pTonCalculation['profitPerTon']] = $tmp;
            //echo "<pre>";echo $pTonCalculation['profitPerTon'];
         }
         //echo count($message_data);//exit;

         krsort($message_data);

         //$traders = User::whereHas('roles', function($q){$q->where('name', 'trader');})->get();
         //$transporters = User::whereHas('roles', function($q){$q->where('name', 'trans');})->get();

         if(User::whereHas('roles', function($q){$q->where('name', 'trader');})->get())
         {
            $roles[] = 'trader';
         }
         if(User::whereHas('roles', function($q){$q->where('name', 'trans');})->get())
         {
            $roles[] = 'trans';
         }
         $traders_transporters = \App\Models\Auth\User::role(@$roles)->get();

         foreach ($traders_transporters as $trader)
         {
            $i = 0;
            $matches = array();
            foreach(@$message_data as $value)
            {
               $i++;
               if($i > 3)
               {
                  break;
               }
               //$value['role'] = 'trader';
               $matchsss = (key($value));
               $match = $value[$matchsss]['match'];
               //$match = $value['match'];
               $pTonCalculation = $value[$matchsss]['pTonCalculation'];

               /*$trader_message = "Dear ".ucfirst($trader->first_name).", \n *Stock: #".$match->stock->id.'* ('.$match->stock->seller->username.') matched to *Buyer: #'.$match->buyerPref->buyer->id.'* ('.$match->buyerPref->buyer->username.') of '.$match->stock->product->name.", \n *Stock Price*: ".$match->stock->price.", \n *Buyer Premiums*: ".$match->buyerPref->buyer->total_prefs."%, \n *P/Ton*: ".$pTonCalculation['profitPerTon'].", \n *Quantity*: ".$match->stock->quantity.", \n *View all matches*: ".route('admin.matches.index');*/
               //echo $trader_message;exit;
               // SendSMS($trader->phone, $trader_message);
               //SendWhatsapp(['phone' => $trader->phone, 'body' => $trader_message,'is_PDF'=>false]);
               $matches[] = $value[$matchsss];
            }
            //echo $trader->phone. ' '.$trader_message;//exit;
            // \Log::info("Stock Matched \n".$trader_message);
         }
      }
   }

   function stockmatched($seller,$buyer,$stock,$pref,$match)
   {
      $locale = \App::getLocale();
      $user = auth()->user();
      $email_content = '';
      $whatsapp_content = '';
      $email_template = get_email_template('STOCK MATCHED');

      if($email_template)
      {
         //----------- The Seller Email Content -----------//
         if( in_array(1001 ,explode(',',$email_template->recipients) ) )
         {
            $sellerlevels = $seller->trust_level == "" ? "1" : $seller->trust_level;
            $user=User::find($seller->user_id);
            $title = $user->gender == 0 ? 'King':'Queen';
            $globalHeader = getHeaderFooter($email_template->id, $locale);
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
            if($email_template->email_content_de != '' || $email_template->email_content_pl != '' || $email_template->email_content != '')
            {




               $email_content = str_replace("[title]", $title, $email_content);
               $email_content = str_replace("[recipient]", $seller->username, $email_content);
               $email_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $email_content);
               $email_content = str_replace("[level]", 'level '.$sellerlevels, $email_content);
               $email_content = str_replace("[role]", 'seller', $email_content);
               $email_content = str_replace("[team_member_name]", $seller->username, $email_content);
               $email_content = str_replace("[view_stock_link]",route('seller.stock.show', $stock->id), $email_content);


               $whatsapp_content = str_replace("[title]", $title, $whatsapp_content);
               $whatsapp_content = str_replace("[recipient]", $seller->username, $whatsapp_content);
               $whatsapp_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $whatsapp_content);
               $whatsapp_content = str_replace("[level]", 'level '.$sellerlevels, $whatsapp_content);
               $whatsapp_content = str_replace("[role]", 'seller', $whatsapp_content);
               $whatsapp_content = str_replace("[team_member_name]", $seller->username, $whatsapp_content);
               $whatsapp_content = str_replace("[view_stock_link]",route('seller.stock.show', $stock->id), $whatsapp_content);

               $whatsapp_unsubscribe_link ='Click here to unsubscribe whatsapp messages ' .  url('unsubscribeWhatsapp', $user->uuid);

               $whatsapp_content = str_replace("[unsubscribe]", $whatsapp_unsubscribe_link, $whatsapp_content);

                if($seller->email_subscription){

                 if($seller->contact_email)
                 {
                    if (isset($seller->email))
                    {
                       $seller_email=$seller->email;

                       Mail::send('backend.mail.default', ['name' => 'Stock Matched on vegking','body'=> $email_content, 'uuid'=> $seller->uuid ], function ($message) use ($seller_email,$email_subject) {
                          $message->subject($email_subject);
                             $message->to($seller_email);
                       });
                    }
                 }
             }

            }
            if($email_template->sms_content != '' || $email_template->sms_content_de != '' || $email_template->sms_content_pl != '')
            {
               if($seller->contact_whatsapp)
               {
                  if(isset($seller->whatsapp_subscription)){
                    //Whatsapp
                    SendWhatsapp(['phone' => $seller->phone, 'body' => $whatsapp_content, 'is_PDF'=>false]);
                  }
               }
            }

            if($seller->contact_sms)
            {
               //Text
               //SendSMS($sellers->phone, $seller_url);
            }
         }
         //----------- The Seller Email Content -----------//

         //----------- The Buyer Email Content -----------//
         if( in_array(1002 ,explode(',',$email_template->recipients)) )
         {
            $buyerlevels = $buyer->trust_level == "" ? "1" : $buyer->trust_level;
            $user=User::find($buyer->user_id);
            $title = $user->gender == 0 ? 'King':'Queen';
            $globalHeader = getHeaderFooter($email_template->id, $locale);
            if($locale == 'de')
            {
               $email_content = $globalHeader['header'];
               $whatsapp_content = $globalHeader['header'];
               $whatsapp_content .= "\r\n";

               $email_content .= $email_template->buyer_email_content_de;
               $whatsapp_content .= $email_template->buyer_sms_content_de;
               $email_subject = $email_template->buyer_subject;

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
               $email_subject = $email_template->buyer_subject;

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
               $email_subject = $email_template->buyer_subject;

               $whatsapp_content .= "\r\n";
               $email_content .= $globalHeader['footer'];
               $whatsapp_content .= $globalHeader['footer'];
            }
            if($email_template->buyer_email_content_de != '' || $email_template->buyer_email_content_pl != '' || $email_template->buyer_email_content != '')
            {
               $email_content = str_replace("[title]", $title, $email_content);
               $email_content = str_replace("[recipient]", $buyer->username, $email_content);
               $email_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $email_content);
               $email_content = str_replace("[level]", 'level '.$buyerlevels, $email_content);
               $email_content = str_replace("[role]", 'buyer', $email_content);
               $email_content = str_replace("[team_member_name]", $buyer->username, $email_content);
               $email_content = str_replace("[view_pref_link]",route('buyer.buyerpref.show', $pref->id), $email_content);

               $whatsapp_content = str_replace("[title]", $title, $whatsapp_content);
               $whatsapp_content = str_replace("[recipient]", $seller->username, $whatsapp_content);
               $whatsapp_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $whatsapp_content);
               $whatsapp_content = str_replace("[level]", 'level '.$buyerlevels, $whatsapp_content);
               $whatsapp_content = str_replace("[role]", 'seller', $whatsapp_content);
               $whatsapp_content = str_replace("[team_member_name]", $seller->username, $whatsapp_content);
               $whatsapp_content = str_replace("[view_pref_link]",route('buyer.buyerpref.show', $pref->id), $whatsapp_content);

               $whatsapp_unsubscribe_link ='Click here to unsubscribe whatsapp messages ' .  url('unsubscribeWhatsapp', $user->uuid);
                $whatsapp_content = str_replace("[unsubscribe]", $whatsapp_unsubscribe_link, $whatsapp_content);

               if($user->email_subscription == 1){
                 if($buyer->contact_email)
                 {
                    if (isset($buyer->email))
                    {
                       $buyer_email=$buyer->email;
                       Mail::send('backend.mail.default', ['name' => 'Stock Matched on vegking','body'=> $email_content], function ($message) use ($buyer_email,$email_subject) {
                          $message->subject($email_subject);
                          $message->to($buyer_email);
                       });
                    }
                 }

                }

            }
            if($email_template->buyer_sms_content != '' || $email_template->buyer_sms_content_de != '' || $email_template->buyer_sms_content_pl != '')
            {
               if($buyer->contact_whatsapp)
               {
                if(isset($user->whatsapp_subscription) == 1){
                    SendWhatsapp(['phone' => $buyer->phone, 'body' => $whatsapp_content, 'is_PDF'=>false]);
                }
                  //Whatsapp

               }
            }

            if($seller->contact_sms)
            {
               //Text
               //SendSMS($sellers->phone, $seller_url);
            }
         }
         //----------- The Buyer Email Content -----------//

         //----------- The Trader Email Content -----------//
         if( in_array(1003 ,explode(',',$email_template->recipients)) )
         {
            $result = $this->userRepository->orderBy('id', 'asc')->get();
            $traders = $result->filter(function ($result, $key) {
               return $result->hasRole('trader');
            });

            if (count($traders)>0)
            {
               foreach ($traders as $tarder)
               {
                  $tarder_emails[] = $tarder->email;
               }
               foreach ($traders as $tarder)
               {
                  $tarder_phones[] = $tarder->phone;
               }

               $traderdata = Auth()->user();
               $traderlevels = isset($traderdata->trust_level) == "" ? "1" : isset($traderdata->trust_level);
               $title = $traderdata->gender == 0 ? 'King':'Queen';
               if($locale == 'de')
               {
                  $email_content = $globalHeader['header'];
                  $whatsapp_content = $globalHeader['header'];
                  $whatsapp_content .= "\r\n";

                  $email_content .= $email_template->trader_email_content_de;
                  $whatsapp_content .= $email_template->trader_sms_content_de;
                  $email_subject = $email_template->trader_subject;

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
                  $email_subject = $email_template->trader_subject;

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
                  $email_subject = $email_template->trader_subject;

                  $whatsapp_content .= "\r\n";
                  $email_content .= $globalHeader['footer'];
                  $whatsapp_content .= $globalHeader['footer'];
               }

               $email_content = str_replace("[recipient]", $traderdata->first_name.' '.$traderdata->last_name, $email_content);
               $email_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $email_content);
               $email_content = str_replace("[role]", 'trader', $email_content);
               $email_content = str_replace("[level]", 'level '.$traderlevels, $email_content);
               $email_content = str_replace("[team_member_name]", $traderdata->first_name.' '.$traderdata->last_name, $email_content);
               $email_content = str_replace("[match_id]",$match->id, $email_content);

               $email_content = str_replace("[stock_id]", $stock->id, $email_content);
               $email_content = str_replace("[seller_username]", $seller->username, $email_content);
               $email_content = str_replace("[buyer_pref_id]", $pref->id, $email_content);
               $email_content = str_replace("[buyer_username]",$buyer->username, $email_content);
               $email_content = str_replace("[product_name]",$stock->product->name, $email_content);
               $email_content = str_replace("[stock_price]", $stock->price, $email_content);
               $email_content = str_replace("[buyer_total_prefs]", $buyer->total_prefs, $email_content);
               $email_content = str_replace("[view_matches_link]",route('admin.matches.index'), $email_content);

               $whatsapp_content = str_replace("[recipient]", $traderdata->first_name.' '.$traderdata->last_name, $whatsapp_content);
               $whatsapp_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $whatsapp_content);
               $whatsapp_content = str_replace("[role]", 'trader', $whatsapp_content);
               $whatsapp_content = str_replace("[level]", 'level '.$traderlevels, $whatsapp_content);

               $whatsapp_unsubscribe_link ='Click here to unsubscribe whatsapp messages ' .  url('unsubscribeWhatsapp', $user->uuid);

               $whatsapp_content = str_replace("[unsubscribe]", $whatsapp_unsubscribe_link, $whatsapp_content);

               foreach ($tarder_emails as $trader_email) {
                  if (isset($trader_email)) {
                     Mail::send('backend.mail.default', ['name' => 'User created','body'=> $email_content], function ($message) use ($trader_email,$email_subject) {
                        $message->subject($email_subject);
                        if ($trader_email != '') {
                           $message->to($trader_email);
                        }
                     });
                  }
               }
               foreach ($tarder_phones as $trader_phone) {
                  if (isset($trader_phone)) {
                  if(isset($user->whatsapp_subscription) == 1){
                        //Whatsapp
                        SendWhatsapp(['phone' => $trader_phone, 'body' => $whatsapp_content, 'is_PDF'=>false]);
                      }
                  }
               }
               foreach ($tarder_phones as $trader_phone) {
                  if (isset($trader_phone)) {
                  //Text
                  //SendSMS($traderdata->phone, $seller_url);
                  }
               }
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
                  $allroles = array();
                  if(Roles::where('name', $role->name)->exists())
                  {
                     $allroles[] = $role->name;
                  }
                  $users = User::role(@$allroles)->get();
                  foreach ($users as $rolesmail)
                  {
                     $titles = $rolesmail->gender == 0 ? 'King':'Queen';
                     $globalHeader = getHeaderFooter($email_template->id, $locale);
                     $email_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $email_content);
                     $whatsapp_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $whatsapp_content);
                     if($locale == 'de')
                     {
                        $email_content = $globalHeader['header'];
                        $whatsapp_content = $globalHeader['header'];
                        $whatsapp_content .= "\r\n";

                        $email_content .= $recipients_template->$rolename->email_content_de;
                        $whatsapp_content .= $recipients_template->$rolename->sms_content_de;
                        $email_subject = $recipients_template->$rolename->subject;

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
                        $email_subject = $recipients_template->$rolename->subject;

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
                        $email_subject = $recipients_template->$rolename->subject;

                        $whatsapp_content .= "\r\n";
                        $email_content .= $globalHeader['footer'];
                        $whatsapp_content .= $globalHeader['footer'];
                     }
                     if($recipients_template->$rolename->email_content != '')
                     {
                        if(isset($rolesmail->email))
                        {
                           if($role->name == 'seller')
                           {
                              $sellertrust = Seller::where('user_id',$rolesmail->id)->first();
                              $levels = @$sellertrust->trust_level == '' ? '1' : @$sellertrust->trust_level;
                              $email_content = str_replace("[title]", $titles, $email_content);
                              $email_content = str_replace("[level]", 'level '.$levels, $email_content);
                              $email_content = str_replace("[role]", 'seller', $email_content);

                              $whatsapp_content = str_replace("[title]", $titles, $whatsapp_content);
                              $whatsapp_content = str_replace("[recipient]", $rolesmail->first_name.' '.$rolesmail->last_name, $whatsapp_content);
                              $whatsapp_content = str_replace("[level]", 'level '.$levels, $whatsapp_content);
                              $whatsapp_content = str_replace("[role]", $role->name, $whatsapp_content);
                           }
                           elseif($role->name == 'buyer')
                           {
                              $buyertrust = Buyer::where('user_id',$rolesmail->id)->first();
                              $levels = @$buyertrust->trust_level == '' ? '1' : @$buyertrust->trust_level;
                              $email_content = str_replace("[title]", $titles, $email_content);
                              $email_content = str_replace("[level]", 'level '.$levels, $email_content);
                              $email_content = str_replace("[role]", 'buyer', $email_content);

                              $whatsapp_content = str_replace("[title]", $titles, $whatsapp_content);
                              $whatsapp_content = str_replace("[recipient]", $rolesmail->first_name.' '.$rolesmail->last_name, $whatsapp_content);
                              $whatsapp_content = str_replace("[level]", 'level '.$levels, $whatsapp_content);
                              $whatsapp_content = str_replace("[role]", $role->name, $whatsapp_content);
                           }
                           else
                           {
                              $email_content = str_replace("[title]", $titles, $email_content);
                              $email_content = str_replace("[level]", 'level 1', $email_content);
                              $email_content = str_replace("[role]", $rolename, $email_content);
                              $email_content = str_replace("[match_id]",$match->id, $email_content);
                              $email_content = str_replace("[stock_id]", $stock->id, $email_content);
                              $email_content = str_replace("[seller_username]", $seller->username, $email_content);
                              $email_content = str_replace("[buyer_pref_id]", $pref->id, $email_content);
                              $email_content = str_replace("[buyer_username]",$buyer->username, $email_content);
                              $email_content = str_replace("[product_name]",$stock->product->name, $email_content);
                              $email_content = str_replace("[stock_price]", $stock->price, $email_content);
                              $email_content = str_replace("[buyer_total_prefs]", $buyer->total_prefs, $email_content);
                              $email_content = str_replace("[view_matches_link]",route('admin.matches.index'), $email_content);

                              $whatsapp_content = str_replace("[title]", $titles, $whatsapp_content);
                              $whatsapp_content = str_replace("[recipient]", $rolesmail->first_name.' '.$rolesmail->last_name, $whatsapp_content);
                              $whatsapp_content = str_replace("[role]", $rolename, $whatsapp_content);
                              $whatsapp_content = str_replace("[level]", 'level 1' , $whatsapp_content);
                              $whatsapp_content = str_replace("[match_id]", $match->id, $whatsapp_content);
                              $whatsapp_content = str_replace("[stock_id]", $stock->id, $whatsapp_content);
                              $whatsapp_content = str_replace("[buyer_pref_id]", $pref->id, $whatsapp_content);

                              $whatsapp_unsubscribe_link ='Click here to unsubscribe whatsapp messages ' .  url('unsubscribeWhatsapp', $user->uuid);
                              $whatsapp_content = str_replace("[unsubscribe]", $whatsapp_unsubscribe_link, $whatsapp_content);
                           }
                           $email_content = str_replace("[recipient]", $rolesmail->first_name.' '.$rolesmail->last_name, $email_content);
                           if($user->email_subscription){
                               Mail::send('backend.mail.default', ['name' => 'Stock Matched', 'body' => $email_content], function ($message) use ($rolesmail,$email_subject) {
                                  $message->subject($email_subject);
                                  if($rolesmail->email != '')
                                  {
                                     $message->to($rolesmail->email);
                                  }

                               });
                          }
                        }
                        $whatsapp_content = str_replace("[recipient]", $rolesmail->first_name.' '.$rolesmail->last_name, $whatsapp_content);
                        $whatsapp_content = str_replace("[role]", $role->name, $whatsapp_content);
                        if(isset($user->whatsapp_subscription) == 1){
                            SendWhatsapp(['phone' => $rolesmail->phone ,'body' => $whatsapp_content,'is_PDF'=>false]);
                          }
                     }
                  }
               }
            }
         }
      }
   }

   function get_string_between($string, $start, $end)
   {
      $string = ' ' . $string;
      $ini = strpos($string, $start);
      if ($ini == 0) return '';
      $ini += strlen($start);
      $len = strpos($string, $end, $ini) - $ini;
      return substr($string, $ini, $len);
   }

   public function CheckMatchesForBuyerPrefId($buyer_pref)
   {
      $matched = $mismatched = array();
      $stocks = Stock::all();
      foreach($stocks as $stock)
      {
         if(class_basename($buyer_pref) == 'BuyerPref')
         {
            $matches = $this->checkMatch($buyer_pref, $stock);
            $this->updateMatchedItems($matches);
         }
         elseif(class_basename($buyer_pref) == 'Buyer')
         {
            foreach($buyer_pref->prefs as $pref)
            {
               $matches = $this->checkMatch($pref, $stock);
               $this->updateMatchedItems($matches);
            }
         }
      }
      $this->notifyMatched($buyer_pref);
      if(isset(request()->url) && request()->url=='link')
      {
         return redirect()->back();
      }
   }

   public function updateMatchedItems($matches)
   {
      // echo ' updateMatchedItems ';
      // if($matches['ismatched'] == 1){
      //    // $row = $matches['matched'];
      //    $numofmismatches = 0;
      //    $matched = 1;
      // }elseif($matches['ismatched'] == 0){
      //    // $row = $matches['mismatched'];
      //    $numofmismatches = count($matches['items']);
      //    $matched = 0;
      // }else{
      //    echo 'empty';exit;
      // }
      $row = $matches;
      // echo '<pre>';print_r($matches);
         // echo ' buyer: '.$row['buyer_id'];
         // echo ' stock: '.$row['stock_id'];
      if(!isset($row['ismatched']))
      {
         $match = Match::where('stock_id',$row['stock_id'])->where('buyer_pref_id',$row['buyer_pref_id'])->delete();
         return;
      }
      $match = \App\Match::updateOrCreate(['stock_id' => $row['stock_id'], 'buyer_pref_id' => $row['buyer_pref_id'], 'product_id' => $row['product_id']], [
         'stock_id' => $row['stock_id'],
         'buyer_pref_id' => $row['buyer_pref_id'],
         'product_id' => $row['product_id'],
         'profit_per_truck' => $row['pton_calculation']['profitPerTruck'],
         'profit_per_ton' => $row['pton_calculation']['profitPerTon'],
         'pton_calculation' => json_encode(is_array($row['pton_calculation']) ? $row['pton_calculation'] : array()),
         'total_profit' => $row['pton_calculation']['profit'],
         'numofmismatches' => $row['numofmismatches']
      ]);
      // echo ' + '.$match->id;
      \App\MatchItem::where('match_id',$match->id)->delete();
      foreach($row['items'] as $key => $val){
         if(is_array($row['ismatched'])){
            //print_r($row['ismatched']);exit;
         }
         // echo ' # '.$key;
         $matchItem = \App\MatchItem::Create([
            'match_id' => $match->id,
            'matched' => $row['ismatched'],
            'product_specification_id' => $key,
            // 'name' => $key,
            'value' => (is_array($val) ? json_encode(array_unique($val)) : $val),
         ]);
      }
      // exit;
   }

   public function CheckMatchesForStockId(Stock $stock)
   {
      $buyers = Buyer::with('prefs.productPrefs.productSpecValue')->get();
      $buyers = buyer::all();
      foreach($buyers as $buyer)
      {
         foreach($buyer->prefs as $pref)
         {
            $matches = $this->checkMatch($pref, $stock);
            $this->updateMatchedItems($matches);
         }
      }
      // echo 'aaaa';exit;
      $this->notifyMatched($stock);
      if(isset(request()->url) && request()->url=='link')
      {
         return redirect()->back();
      }
   }

   public function checkMatch($pref, $stock, $arr=null)
   {
      ob_start();
      $matched  = $mismatched = $matched2= array();
      // if((isset($pref->buyer->user) && $pref->buyer->user->hasRole('ignore')==true) || (isset($stock->seller->user) && $stock->seller->user->hasRole('ignore')==true)){
      //    return null;
      // }
      $product_specifications = \App\ProductSpecification::with('options')->where('product_id',$stock->product_id)->get();
      // dd($product_specifications->toArray());
      // echo '<pre>';print_r($product_specifications->toArray());
      // echo '<pre>';print_r($pref->toArray());
      // dd($buyer->toArray());
      // dd($stock->toArray());
      // print_r($stock->offerProperty->toArray());
      $mismatched_prodspec = $global_premium_factor_name = $global_premium_factor = array();
      $ec = $ecbf = 0;
      if($stock->product_id != $pref->product_id){
         ob_end_clean();
         return ['buyer_pref_id'=>$pref->id, 'stock_id'=>$stock->id];
         // $stock_pref_product_id_mismatched = true;
         // $mismatched_prodspec[$stock->product_id] = '';
      }
      foreach(@$product_specifications as $product_specification){
         // echo ' ^ ';
         $mismatched_prodspec[$product_specification->id] = '';
         // $stock_mismatched = array();
         foreach(@$stock->offerProperty as $offer_property){
            // print_r($mismatched_prodspec);exit;
            // $mismatched_prodspec[$product_specification->id][] = $offer_property->productSpecValue->value;
            // echo ' % ';
            if(@$product_specification->id == @$offer_property->product_spec_id){
               // echo ' - '.$product_specification->id;
               // $stock_mismatched[] = $offer_property->product_spec_value;
            // echo '&';print_r($mismatched);
               // foreach($buyer->prefs as $pref){
                  // if($pref->product_id == $stock->product_id){
                     // $matched['product'] = true;
                     // if(!is_array($pref->productPrefs->toArray())){
                     //    echo 'pref';print_r($pref->productPrefs);echo '</pre>';
                     //    echo 'aaa';exit;
                     // }
                     $bpfs_count = array();
                     foreach(@$pref->productPrefs as $product_pref){
                        $bpfs_count[] = $product_pref->premium;
                        if($product_pref->value == 'all'){
                           // echo '!!!!!!!!!!!!!!! '.$product_specification->id;exit;
                           unset($mismatched_prodspec[$product_pref->key]);   // Consider matched if accept_all is On
                           continue;
                        }
                        // echo '-';print_r($product_pref->productSpecValue->toArray());
                        // print_r($product_pref->productSpecValue->product_specification_id);exit;
                        // print_r($product_pref);exit;
                        // $mismatched[$offer_property->product_spec_id] = array();
                        // print_r($product_spec_value);exit;
                        if(@$product_pref->productSpecValue->product_specification_id == @$offer_property->product_spec_id){
                     // echo ' * '.$product_pref->productSpecValue->value;
                        // $matched[$offer_property->product_spec_id] =
                           if(@$product_pref->productSpecValue->value == @$offer_property->productSpecValue->value){
                        // echo ' $ '.$offer_property->productSpecValue->value.' ! '.$product_specification->id;
                              foreach(@$product_specification->options as $option){
                                 if($option->value == $offer_property->productSpecValue->value){
                                    // echo ' ~ '.$product_pref->premium.'/'.$option->premium;
                                    $global_premium_factor_name[] = $option->value;
                                    // $global_premium_factor[] = 100 + ($option->premium!='' ? $option->premium : 0)/100;
                                    $tmp = $option->premium + $product_pref->premium;
                                    $global_premium_factor[] = ($tmp!='' ? $tmp : '0');
                                 }
                                 if(!empty(@$option->ec)){
                                    // echo ' EC '.@$offer_property->ecs;
                                    $ec = (!empty(@$offer_property->ecs) ? @$offer_property->ecs : @$option->ec);
                                    // $ec = $option->ec;
                                    $ecbf = $option->ecbf;
                                 }
                              }
                              // $matched[$product_specification->id] = $offer_property->productSpecValue->value;
                              // if (($tmpkey = array_search($product_specification->id, $mismatched_prodspec)) !== false) {
                              //    unset($mismatched_prodspec[$tmpkey]);
                              // }
                              if (array_key_exists($product_specification->id, $mismatched_prodspec)) {
                                 unset($mismatched_prodspec[$product_specification->id]);
                              }
                              // $mismatched_prodspec[$product_specification->id] = 'no';
                              // if(array_key_exists($product_specification->id, $mismatched)){
                              //    unset($mismatched[$product_specification->id]);
                              //    echo ' M ';
                              //    print_r($mismatched);
                              // }
                           }else{
                              // echo ' # '.$offer_property->productSpecValue->value;
                              // $mismatched_prodspec[$product_specification->id][] = $offer_property->productSpecValue->value;
                              // if(!array_key_exists($product_specification->id, $mismatched)){
                              //    echo ' MM ';
                              //    $mismatched[$product_specification->id][] = $offer_property->productSpecValue->value;
                              // }
                           }
                        }
                     }
                  // }
               // }
               // if(in_array($offer_property->product_spec_id , $mismatched_prodspec)){
               //    $mismatched[$product_specification->id] = $mismatched;
               // }
            }else{

               // $mismatched[$product_specification->id][] = $offer_property->productSpecValue->value;
            }
         }
         // if(!isset($matched[$product_specification->id]) && !isset($mismatched[$product_specification->id])){
         //    $mismatched[$product_specification->id] =true;
         // }
      }
      $mismatched_prodspec_with_value = array();
      // if($stock->id==4 && $pref->id == 2){
         // echo '<br/>Mismatched Prodspec ';print_r($mismatched_prodspec);
      foreach ($mismatched_prodspec as $key => $value) {
         // echo '<br/>';
         foreach ($stock->offerProperty as $offerProperty) {
            // echo ' dfd '.$offerProperty->productSpecValue->value.'*'.$key;
            if($offerProperty->product_spec_id == $key){
               $mismatched_prodspec_with_value[$key] = @$offerProperty->productSpecValue->value;
            }
         }
      }
      // echo 'ec = '.$ec. ' ecbf = '.$ecbf;
      // }
      if($stock->id==1 && $pref->id == 2){
         // echo '<br/>Mismatched Prodspec with value ';print_r($mismatched_prodspec_with_value);exit;
         // echo 'dfd';exit;
      }
      // echo '<pre>Matched: ';print_r($matched);echo 'Mismatched: ';print_r($mismatched);echo '</pre>';
      // print_r($bpfs_count);
      // $product_specifications = \App\ProductSpecificationValue::where('product_id',$stock->product_id)->get();
      // print_r($global_premium_factor);
      // exit;
      // $pTonCalculation = $this->pTonCalculation($stock, $pref, $global_premium_factor_name, $global_premium_factor, $bpfs_count, $ec, $ecbf);
      $pTonCalculation = $this->pTonCalculation($stock, $pref, $global_premium_factor_name, $global_premium_factor, @$bpfs_count, @$ec, @$ecbf, null, null, $arr);
      // $pTonCalculation = json_encode(['global_premium_factor_name'=>$global_premium_factor_name,'global_premium_factor'=>$global_premium_factor,'bpfs_count'=>@$bpfs_count, 'ec'=>@$ec, 'ecbf'=>@$ecbf]);
      // echo 'aaa';print_r($pTonCalculation);exit;
      // echo $bpfs_count;exit;
      // $etpt = \App\PostalCode::select('price')->where(DB::raw('substr(postal_code,1,2)'),substr($buyer->postalcode,0,2))->orWhere('name',$buyer->city)->first();
      // $price = $stock_price;
      // $transport_base = $stock->product->base_price;
      // $transport_factor = $transport_base * $stock->product->premium / 100;
      // $total_premium = $price * $bpfs_count / 100;
      // $profit_per_ton = number_format($transport_factor + @$etpt->price + $total_premium, 2,'.','');
      // $profit_per_truck = number_format($profit_per_ton * 24, 2,'.','');
      // $total_profit = $profit_per_ton * $stock->quantity * 24;
      // $profit = number_format($total_profit + $total_premium , 2,'.','');
      // if($stock->id==2 && $buyer->id == 10){
      //    echo '*'.$stock->product->premium.' * '.$transport_factor.'* '.@$etpt->price.' * '.$total_premium;exit;
      // }
      $mismatched = $mismatched_prodspec_with_value;
      if(!empty($mismatched)){
         $ismatched = 0;
         $array_name = 'mismatched';
         $numofmismatches = count($mismatched);
      // }elseif(@$stock_pref_product_id_mismatched){
      //    $ismatched = 0;
      //    $array_name = 'mismatched';
      //    $numofmismatches = count($product_specifications);
      }else{
         $ismatched = 1;
         $array_name = 'matched';
         $numofmismatches = 0;
      }
      // if (($key = array_search(1, $mismatched)) !== false) {
      //    unset($mismatched[$key]);
      // }
      $matched2 = [
            'ismatched' => $ismatched,
            'buyer_pref_id'=>$pref->id,
            'stock_id'=>$stock->id,
            'product_id'=>$stock->product_id,
            'profit_per_truck' => '',   // @$pTonCalculation['profitPerTruck'],
            'profit_per_ton' => '',  // @$pTonCalculation['profitPerTon'],
            'pton_calculation' => @$pTonCalculation,
            'total_profit' => '', // @$pTonCalculation['profit'],
            'numofmismatches' => $numofmismatches,
            'items'=>$$array_name
         ];
         // print_r($matched2);exit;
      $tmp = ob_get_contents();
      ob_end_clean();
      return $matched2;
   }

   public function pTonCalculation($stock, $pref, $global_premium_factor_name, $global_premium_factor, $bpfs_count, $ec, $ecbf, $base_price=900, $offer_price=null, $arr=null){
      $str = '';
      $gbpToPln = getCurrencyRate('GBP','PLN');
      $EurToPln = getCurrencyRate('EURO','PLN');
      $stock_price = $stock->price;

      //$sellerData = \App\Seller::select('postalcode', 'country')->where('id',$stock->seller_id)->first();
      //$buyerData = \App\Buyer::select('postalcode', 'country')->where('id',$pref->buyer_id)->first();
      //$kmCharges = getTransportCharges($sellerData->country,$buyerData->country);
      //$distance = getDistance($sellerData->postalcode.','.$sellerData->country, $buyerData->postalcode.','.$buyerData->country);
      $kmCharges = getTransportCharges($stock->country,$pref->country);
      if(!$kmCharges)
      {
         $kmCharges = getTransportCharges($pref->country, $stock->country);
      }
      $distance = getDistance($stock->postalcode.','.$stock->country, $pref->postalcode.','.$pref->country);

      $avgSalePrice  = (!empty($base_price) ? $base_price : 900);
      $baseTransportCostPerTon  = '159.66';  // in EUR
      $err = array();
      $etpt="";
      if($arr != NULL){
        foreach ($arr['postalcode'] as $key => $value) {
          if($value->name==$pref->buyer->city || substr($value->postal_code,1,2) == substr($pref->buyer->postalcode,0,2)){
            $etpt = $value->price;
            break;
          }
        }
      }else{
        $etpt = \App\PostalCode::select('price')->where(DB::raw('substr(postal_code,1,2)'),substr($pref->buyer->postalcode,0,2))->orWhere('name',$pref->buyer->city)->first();
      }
      $extraTransportPerTon = (!empty(@$etpt->price) ? @$etpt->price : "0");
      $premiumFlatCost = array_sum((is_array(@$bpfs_count) ? $bpfs_count : array()));
      $totalPremiumsPct  = array_sum((is_array(@$global_premium_factor) ? $global_premium_factor : array()));
      // $totalPremiumsFactor = ((is_array(@$global_premium_factor) ? $global_premium_factor : array()));
      // $salePrice = $avgSalePrice * $global_premium_factor;
      $totalPremiumsFactor = (100 + $totalPremiumsPct)/100;
      $salePriceWithoutExtraCost = $avgSalePrice * $totalPremiumsFactor;
      $totalExtraCosts = $ec * $ecbf;
      $salePrice = $salePriceWithoutExtraCost + $totalExtraCosts;
      $transportCost = ($baseTransportCostPerTon  + $extraTransportPerTon);

      if(!empty($offer_price)){
        $profitPerTon_after_discount = $offer_price - $stock_price - $transportCost;
        $profitPerTon_after_discount = number_format($profitPerTon_after_discount, 2, '.','');
      }
      $profitPerTon = $salePrice - $stock_price - $transportCost;
      $profitPerTon = number_format($profitPerTon, 2, '.','');
      $totalCharges = intval($distance['distance']) * $kmCharges;

      $str .= '<br/> avgSalePrice = €'.$avgSalePrice;
      if(!empty($offer_price)){
         $pPerTon_afterDiscount = $profitPerTon_after_discount + $totalCharges;
         $str .= '<br/> profitPerTon after discount  = offerPrice - stock->price - transportCost + transportCharges';
         $str .= '<br/> profitPerTon after discount = '.$pPerTon_afterDiscount.' = '.$offer_price.' - '.$stock_price.' - '.$transportCost.' + '.$totalCharges;
      }
      $pPerTonCost = $profitPerTon + $totalCharges;
      $str .= '<br/> profitPerTon = salePrice - stock->price - transportCost + transportCharges';
      $str .= '<br/> profitPerTon = €'.$pPerTonCost.' = '.$salePrice.' - '.$stock_price.' - '.$transportCost.' + '.$totalCharges;
      $str .= '<br/> stock->price = €'.$stock_price.' <br/> baseTransportCostPerTon  = 900/22 = €37.5 = '.$baseTransportCostPerTon .' PLN <br/> extraTransportPerTon = €'.(!empty(@$etpt->price) ? @$etpt->price : "0");
      // $bpfs_count = \App\BuyerPref::where('buyer_id', $buyer->id)->sum('val');
      // $salePrice = $salePrice;
      // $salePrice = $avgSalePrice + ($avgSalePrice * $totalPremiumsFactor / 100);
      // $salePrice += $premiumFlatCost;
      $profitPerTruck = number_format($profitPerTon * 24, 2,'.','');
      $totalProfit = $profitPerTon * $stock->quantity * 24;
      $profit = number_format($totalProfit + $salePrice , 2,'.','');
      // $str .= '<br/> '.$transportCost.' = '.$baseTransportCostPerTon .' + '.$extraTransportPerTon;
      $str .= '<br/> salePrice = avgSalePrice * totalPremiumsFactor';
      // $str .= '<br/> salePrice = avgSalePrice + (avgSalePrice * totalPremiumsFactor / 100)';
      $global_premium_factor_name_str = ($global_premium_factor_name ? implode(' + ',$global_premium_factor_name) : '');
      $global_premium_factor_str = ($global_premium_factor? implode('% + ',$global_premium_factor) : '');
      $str .= '<br/> totalPremiumsPct = '.(!empty($global_premium_factor_name_str) ? $global_premium_factor_name_str : "0");
      $str .= '<br/> totalPremiumsPct = '.$totalPremiumsPct.'% ('.$global_premium_factor_str.'%)';
      $str .= '<br/> totalPremiumsFactor = '.$totalPremiumsFactor;
      $str .= '<br/> salePrice = '.$avgSalePrice.' * '.$totalPremiumsFactor;
      $str .= '<br/> totalExtraCosts = Nets';   // .implode(' * ',$totalExtraCosts);
      $str .= '<br/> totalExtraCosts = '.$ec.' * '.$ecbf.' = €'.$totalExtraCosts;
      $str .= '<br/> salePrice = '.$salePriceWithoutExtraCost.' + '.$totalExtraCosts.' = €'.$salePrice;
      $str .= '<br/> transportCost = €'.$transportCost.' = '.$baseTransportCostPerTon.' + '.$extraTransportPerTon;
      $str .= '<br/> transportLocations = From : '.$distance['destination'].' -- To : '.$distance['origin'];
      $str .= '<br/> transportDurations = '.$distance['durations'];
      $str .= '<br/> transportCompleteCost = €'.$totalCharges.' = '.$distance['distance'].' * '.$kmCharges;
      // $str .= '<br/> totalExtraCosts = 20 * 1.6 = 32';
      $str .= '<br/><br/> PLN per GBP: '.$gbpToPln.' <br/> PLN per EURO: '.$EurToPln;


      // $str .= '<br/> salePrice = '.$avgSalePrice.' + ('.$avgSalePrice.' * '.$totalPremiumsFactor.' / 100)';

      // $str .= '<br/> profitPerTruck = profitPerTon * 24 ';
      // $str .= '<br/> '.$profitPerTruck.' = '.$profitPerTon.' * 24';
      // $str .= '<br/> totalProfit = profitPerTon * stock->quantity * 24 ';
      // $str .= '<br/> '.$totalProfit.' = '.$profitPerTon.' * '.$stock->quantity.' * 24';
      // $str .= '<br/> profit = totalProfit + salePrice ';
      // $str .= '<br/> '.$profit.' = '.$totalProfit.' + '.$salePrice;
      $profitPerTon = $profitPerTon + $totalCharges;
      return ['profitPerTon'=>$profitPerTon, 'profitPerTruck'=>$profitPerTruck, 'profit'=>$profit, 'salePrice'=>$salePrice, 'avgSalePrice'=>$avgSalePrice, 'global_premium_factor_name'=>$global_premium_factor_name, 'global_premium_factor'=>$global_premium_factor, 'pton_calculation'=>$str];
   }
  public function sendNotification(Order $order, Offer $stock)
  {
    return $stock->seller->username;
  }

  public function makeSale(Order $order, Offer $stock)
  {
    return $stock->seller->username;
  }

  public function InvoiceSend(Request $request,Match $match){
      $mpdf = new \Mpdf\Mpdf();
      $user = auth()->user();
      $matches = Match::with('stock', 'stock.seller','buyerPref.buyer', 'stock.product','offerproperty.productspec','offerproperty.productspecvalue')->where('id', $match->id)->first();
      $tmp = json_decode(@$matches->stock->packaging,true);
      $packaging = (is_array($tmp) ? implode(',',@$tmp) : '');
      $purpose_tmp = json_decode(@$matches->stock->purposes,true);
      $purpose = (is_array($purpose_tmp) ? implode(',',@$purpose_tmp) : '');
      $notes=$match->notes;
      $template = utf8_encode(view('backend.matches.invoice',compact('matches','user','packaging','purpose','notes')));
      $mpdf->WriteHTML($template);
      //Buyer send mail
      if($matches->buyerPref->buyer->contact_email)
      {
         if(!empty($user) && !empty($matches))
         {
            if($user->email_subscription == 1){

            $message="Hello ".$matches->buyerPref->buyer->username."/n Please check  invoice sent on mail";
         event(new Pushnotification($message,$matches->buyerPref->buyer->user_id,$url=''));
            $dt = new DateTime();
            DB::table('offersent')->insert(['match_id' => $matches->id,'stock_id' => $matches->stock_id,'buyer_id'=>$matches->buyerPref->buyer->id,'time_sent' => $dt->format('H:i:s'),'created_at'=> $dt->format('Y-m-d H:i:s')]);
            Mail::send('backend.mail.default', ['name' => 'Invoice', 'body' => 'Invoice Message'], function ($message) use ($user, $matches,$mpdf) {
               $message->subject('Invoice of Veg King!');
               if($matches->buyerPref->buyer->email != ''){ $message->to($matches->buyerPref->buyer->email); }
                $message->attachData($mpdf->output("Invoice.pdf",'S'), "Invoice.pdf");

            });
            $message="Hello ".$matches->buyerPref->buyer->username."/n You have received Invoice through E-mail,please check";
            event(new Pushnotification($message,$matches->buyerPref->buyer->user_id));
          }
         }
      }
      if($matches->buyerPref->buyer->contact_sms){
         //SendSMS($matches->buyerPref->buyer->phone, base_path("invoice/invoice.pdf"));
      }
      if($matches->buyerPref->buyer->contact_whatsapp){
         // Implement whats app API to send message
         $content = $mpdf->output("Invoice.pdf",'S');
         $content = chunk_split(base64_encode($content));
         if(isset($user->whatsapp_subscription) == 1){
         SendWhatsapp(['phone' => $matches->buyerPref->buyer->phone, 'body' => "data:application/pdf;base64,".$content,'filename'=>'Invoice.pdf','caption'=>'Invoice','is_PDF'=>true]);
         }
      }

      //Seller send mail
      if($matches->stock->seller->contact_email){
         if(!empty($user) && !empty($matches))
         {
            $dt = new DateTime();
            DB::table('offersent')->insert(['match_id' => $matches->id,'stock_id' => $matches->stock_id,'buyer_id'=>$matches->buyerPref->buyer_id,'time_sent' => $dt->format('H:i:s'),'created_at'=> $dt->format('Y-m-d H:i:s')]);
            Mail::send('backend.mail.default', ['name' => 'Invoice', 'body' => 'Invoice Message'], function ($message) use ($user,$matches,$mpdf) {
                  $message->subject('Invoice of Veg King!');
                  if($matches->stock->seller->email != ''){ $message->to($matches->stock->seller->email); }
                  $message->cc($user->email);
                  $message->attachData($mpdf->output("Invoice.pdf",'S'), "Invoice.pdf");
            });
            $message="Hello ".$matches->stock->seller->username."/n You have received Invoice through E-mail,please check";
            event(new Pushnotification($message,$matches->stock->seller->user_id,$url='',$sound=1));
         }else{
            return redirect()->route('admin.matches.index')->with('error','Invalid Request');
         }
      }
      if($matches->stock->seller->contact_sms){
         SendSMS($matches->buyerPref->buyer->phone, base_path("invoice/invoice.pdf"));
      }
      if($matches->stock->seller->contact_whatsapp){
         // Implement whats app API to send message
         $content = $mpdf->output("Invoice.pdf",'S');
         $content = chunk_split(base64_encode($content));
         if(isset($user->whatsapp_subscription) == 1){
         SendWhatsapp(['phone' => $matches->stock->seller->phone, 'body' => "data:application/pdf;base64,".$content,'filename'=>'Invoice.pdf','caption'=>'Invoice','is_PDF'=>true]);
        }
      }


      return redirect()->route('admin.matches.index')->with('success','Invoice has been send Successfully.');
    }


     /**
   * View Invoice to particular buyer
   */
  public function InvoiceView(Request $request,Match $match){
      $user = auth()->user();
      $url = url('/') .'/img/'. Settings()->site_logo;
      $matches = Match::with('stock', 'stock.seller', 'stock.product','offerproperty.productspec','offerproperty.productspecvalue')->where('id', $match->id)->first();
      $tmp = json_decode(@$matches->stock->packaging,true);
      $packaging = (is_array($tmp) ? implode(',',@$tmp) : '');
      $purpose_tmp = json_decode(@$matches->stock->purposes,true);
      $purpose = (is_array($purpose_tmp) ? implode(',',@$purpose_tmp) : '');
      $notes=$match->notes;
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

   public function store(Request $request)
   {

        $data = $request->all();
        $matches = Match::with('stock', 'buyerPref.buyer', 'stock.seller', 'stock.product')->where('id', $data['match_id'])->first();
        $available_from_date = strtotime($matches->stock->available_from_date.'+3 days');
        if ($available_from_date > strtotime($data['available_from_date'])) {
            return redirect()->back()->withInput($data)->withErrors(['available_from_date'=>"Available from date should not be earlier than current value."]);
        }
        $OfferSent = new OfferSent();
        $OfferSent->match_id = $matches->id;
        $OfferSent->buyer_id = $matches->buyerPref->buyer->id;
        $OfferSent->stock_id = $matches->stock_id;
        $OfferSent->offerprice = $request['price'];
        $OfferSent->order_id = $request->order_id;
        $OfferSent->time_sent = date('Y-m-d H:i:s');
        $OfferSent->save();
        $insertedId = $OfferSent->id;
        $offers2 = offer2::updateOrCreate(['match_id' => $matches->id],[
          'match_id' => $matches->id,
          'pref_id' => $matches->buyer_pref_id,
          'stock_id' => $matches->stock_id,
          'avgsaleprice' => $request->avgsaleprice,
          'saleprice' => $request->saleprice,
          'offerprice' => $request->price,
        ]);

      Stock::find($matches->stock_id)->update(['available_per_day' => $request->available_per_day, 'note' => $request->note]);

         $user = User::find($matches->buyerPref->buyer->user_id);
         $mpdf = new \Mpdf\Mpdf();
         $template = utf8_encode(view('backend.matches.invoice',compact('matches','user')));
         $mpdf->WriteHTML($template);
         $url = url('confirmoffer/'.$insertedId);
         $msg='Offer Message,<br> Please click on link to accept the offer <a href="'.$url.'">Click Here</a>';
         Mail::send('backend.mail.default', ['name' => 'Invoice', 'body' => $msg], function ($message) use ($user,$mpdf) {
            $message->subject('Invoice of Veg King!');
            $message->to($user->email);
            $message->attachData($mpdf->output("Invoice.pdf",'S'), "Invoice.pdf");
         });

       $message="Hello ".$matches->buyerPref->buyer->username."/n You have received Invoice through E-mail,please check and please click";

       event(new Pushnotification($message,$user->id,$url='',$sound=1));
       return redirect()->route('admin.matches.index')->with('success','Invoice has been send Successfully.');
   }

   public function updateAll()
   {
      // echo 'dfd';exit;
      // DB::enableQueryLog();
         // echo request()->start . ' * '.request()->end;exit;
      if(!isset(request()->start) || !isset(request()->end)){
         echo 'Please enter start and end limit';exit;
      }
      ini_set('max_execution_time',120);
      $matched = $mismatched = array();
      $prefs = BuyerPref::with(['productPrefs.productSpecValue','buyer.user'])->whereHas('buyer');
      $prefs->offset(request()->start)->limit(request()->end);
      $prefs = $prefs->get();
      $stocks = Stock::with(['offerProperty.productSpecValue','seller.user'])->whereHas('seller')->get();
      // $stocks = Stock::with('offerProperty.productSpecValue')->where('id',1)->get();
      // dd($prefs->toArray());
      // echo '<pre>';
      // Match::truncate();
      // \App\MatchItem::truncate();
       $postalcode_arr = \App\PostalCode::select('name','price','postal_code')->get();
       $arr['postalcode'] = $postalcode_arr;
         foreach($prefs as $pref){
            foreach($stocks as $stock){
               // echo ' * ';
               $matches = $this->checkMatch($pref, $stock, $arr);
               $this->updateMatchedItems($matches);
            }
         }

      return redirect(route('admin.matches.index'));
   }

   public function add_makesalenotes(Request $request){
      $tableArray['notes'] = $request->notes;
      $offersent = Match::updateOrCreate(['id' => $request->matches_id], $tableArray);
      return response()->json(['status' => 'success', 'message' => 'Added makesales notes successfully.']);
   }

   public function get_makesalenotes(Request $request){
      $makesale_notes = Match::select('notes')->where('id',$request->id)->first();
   return $makesale_notes;
   }

  public function InvoiceSendtoAll(Request $request){
     $all = $request->all();

     foreach($all['array_main'] as $key => $value){

         $user = auth()->user();
         $data = Match::with('stock', 'stock.seller', 'stock.product','buyerPref','offerproperty.productspec','offerproperty.productspecvalue')->where('id',@$value['match_id'])->get();
         foreach($data as $matches)
         {
            $mpdf = new \Mpdf\Mpdf();
            $template = utf8_encode(view('backend.matches.invoice',compact('matches','user')));
            $mpdf->WriteHTML($template);
            //Buyer Send
            if($matches->buyerPref->buyer->contact_email)
            {
               if(!empty($user) && !empty($matches))
               {
                  $dt = new DateTime();
                  DB::table('offersent')->insert(['match_id' => $matches->id,'stock_id' => $matches->stock_id,'buyer_id'=>$matches->buyerPref->buyer->id,'time_sent' => $dt->format('H:i:s'),'created_at'=> $dt->format('Y-m-d H:i:s')]);
                  Mail::send('backend.mail.default', ['name' => 'Invoice', 'body' => 'Invoice Message'], function ($message) use ($user, $matches,$value,$mpdf) {
                     $message->subject('Invoice of Veg King!');
                     if($matches->buyerPref->buyer->email != ''){ $message->to($matches->buyerPref->buyer->email); }
                     $message->attachData($mpdf->output("Invoice.pdf",'S'), "Invoice.pdf");
                  });
                  $push_message="Hello ".$matches->buyerPref->buyer->username."/n You have received Invoice through E-mail,please check";
                  event(new Pushnotification($push_message,$matches->buyerPref->buyer->user_id,$url='',$sound=1));
               }
            }
            if($matches->buyerPref->buyer->contact_sms){
               //SendSMS($matches->buyerPref->buyer->phone, base_path("invoice/invoice.pdf"));
            }

            if($matches->buyerPref->buyer->contact_whatsapp){
               // Implement whats app API to send message
               $content = $mpdf->output("Invoice.pdf",'S');
               $content = chunk_split(base64_encode($content));
               if(isset($user->whatsapp_subscription) == 1){
               SendWhatsapp(['phone' => $matches->buyerPref->buyer->phone, 'body' => "data:application/pdf;base64,".$content,'filename'=>'Invoice.pdf','caption'=>'Invoice','is_PDF'=>true]);
                }
            }
            //Seller Send
            if($matches->stock->seller->contact_email)
            {
               if(!empty($user) && !empty($matches))
               {
                  $dt = new DateTime();
                  DB::table('offersent')->insert(['match_id' => $matches->id,'stock_id' => $matches->stock_id,'buyer_id'=>$matches->stock->seller->id,'time_sent' => $dt->format('H:i:s'),'created_at'=> $dt->format('Y-m-d H:i:s')]);
                  Mail::send('backend.mail.default', ['name' => 'Invoice', 'body' => 'Invoice Message'], function ($message) use ($user, $matches,$value,$mpdf) {
                     $message->subject('Invoice of Veg King!');
                     if($matches->stock->seller->email != ''){ $message->to($matches->stock->seller->email); }
                     $message->attachData($mpdf->output("Invoice.pdf",'S'), "Invoice.pdf");
                  });
                  $push_message="Hello ".$matches->stock->seller->username."/n You have received Invoice through E-mail,please check";
                  event(new Pushnotification($push_message,$matches->stock->seller->user_id,$url='',$sound=1));
               }
            }
            if($matches->stock->seller->contact_sms){
               //SendSMS($matches->buyerPref->buyer->phone, base_path("invoice/invoice.pdf"));
            }

            if($matches->stock->seller->contact_whatsapp){
               // Implement whats app API to send message
               $content = $mpdf->output("Invoice.pdf",'S');
               $content = chunk_split(base64_encode($content));
               SendWhatsapp(['phone' => $matches->stock->seller->phone, 'body' => "data:application/pdf;base64,".$content,'filename'=>'Invoice.pdf','caption'=>'Invoice','is_PDF'=>true]);
            }
         }
      }


    return redirect()->route('admin.matches.index')->with('success','Invoice has been send Successfully.');
  }

  public function matchesexports(Request $request)
  {
     $data = Match::with('matchItem','stock', 'buyerPref.buyer', 'stock.seller', 'stock.product','stock.offerProperty');
      if(isset($request->stock) && !empty($request->stock)){
        $data->where('stock_id', $request->stock);
      }
      if(isset($request->buyer) && !empty($request->buyer)){
         $buyer_pref_ids = BuyerPref::select('id')->where('buyer_id',$request->buyer)->get();
         if(count($buyer_pref_ids)>0){
              $data->where('buyer_pref_id', $buyer_pref_ids);
         }

      }
      if(isset($request->match_type) && !empty($request->match_type)){
         if(@$request->show_matched == 'no'){
            $match_type_array = explode(',',$request->match_type);
            foreach($match_type_array as $match_type){
               $data->whereDoesntHave('matchItem', function($q) use($match_type) {
                      $q->where('name', $match_type);
               });
            }
         }
      }
      if(!isset($request->show_matched) || (isset($request->show_matched) && $request->show_matched=='yes')){
        $data->where('numofmismatches', 0);
      }else{
        $data->where('numofmismatches','>', 0);
      }
      $data = $data->orderBy('numofmismatches', 'asc')->orderBy('total_profit', 'desc')->get();

      return Excel::download(new MatchesExport($data), 'matches.xlsx');
    // return $exporter->download('matches.xlsx');
  }
   public function updatePton(Request $request){
      $data = Match::with(['stock','buyerPref.buyer.prefs'])->get();
      //print_r($data->toArray());exit;
      $base_price_arr = Product::select(['id','base_price'])->get();
       $postalcode_arr = \App\PostalCode::select('name','price','postal_code')->get();
       $arr['postalcode'] = $postalcode_arr;
      $missing_err = array();
      $missing_errs = array();
      foreach ($data as $pton_key => $pton_row) {
        $pTonCalculation_old = json_decode($pton_row->pton_calculation);
        //print_r($pTonCalculation_old);exit;
        if(!array_key_exists("pton_calculation",$pTonCalculation_old)){
          foreach ($base_price_arr as $value) {
              if($value->id == $pton_row->product_id){
                  $base_price = $value->base_price;
                  break;
              }
          }
          $missing_err = array();

          if(empty($pton_row->stock)){
             $missing_err[] = "Failed : Stock ($pton_row->stock_id) not Found";
          }
          if(empty($pton_row->buyerPref)){
            $missing_err[] = "Failed : Buyer Pref ($pton_row->buyer_pref_id) not Found";
          }
          if(empty($pton_row->buyerPref->buyer)){
            $missing_err[] = "Failed : Buyer not Found";
          }

          $missing_errs[$pton_row->id] = implode(', ', $missing_err);

          if(empty($missing_err)){
            $pTonCalculation = $this->pTonCalculation($pton_row->stock, $pton_row->buyerPref, @$pTonCalculation_old->global_premium_factor_name, $pTonCalculation_old->global_premium_factor, $pTonCalculation_old->bpfs_count, $pTonCalculation_old->ec, $pTonCalculation_old->ecbf, $base_price, null, $arr);
            $pTonCalculation_old->pton_calculation = $pTonCalculation['pton_calculation'];
            //print_r(json_encode($pTonCalculation_old));exit;

            Match::updateOrCreate(['id' => $pton_row->id],[
             'profit_per_truck' => $pTonCalculation['profitPerTruck'],
             'total_profit' => $pTonCalculation['profit'],
             'pton_calculation' => json_encode($pTonCalculation_old),
             'profit_per_ton' => $pTonCalculation['profitPerTon'],
            ]);
            $missing_errs[$pton_row->id] = "Success.";
          }
        }
      }
      echo "<pre>";
      //print_r($missing_err);//exit;
      print_r($missing_errs);//exit;
      echo "</pre>";
   }
}
