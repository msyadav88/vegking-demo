<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Buyer;
use App\Seller;
use App\Sale;
use App\Stock;
use App\Match;
use App\AppHead;
use App\BuyerPref;
use App\BuyerProductPref;
use App\ProductSpecificationValue;
use App\ProductSpecification;
use App\PostalCode;
use App\Product;
use DB;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;
use View;
// use App\Events\Backend\CheckMatchesForBuyer;
use App\Events\Backend\BuyerCreated;
use App\Events\Backend\BuyerUpdated;
use App\Exports\BuyersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BuyersImport;
use App\Imports\UsersImport;
use App\Imports\UsersFirstImport;
use App\Events\Backend\BuyerSellerImported;
use Illuminate\Validation\Rule;
use App\Notifications;
class BuyerController extends Controller
{

  /**
  * @var PhpSimpleHtmlDomParser
  **/

  /**
  * @param PhpSimpleHtmlDomParser $parser
  **/
  public function __construct()
  {
    $this->middleware('permission:view buyer', ['only' => ['index']]);
    $this->middleware('permission:add buyer', ['only' => ['create','store']]);
    $this->middleware('permission:edit buyer', ['only' => ['edit','update']]);
    $this->middleware('permission:delete buyer', ['only' => ['destroy']]);
    $this->middleware('permission:export buyers', ['only' => ['exports']]);
    $this->middleware('permission:import buyers', ['only' => ['import_buyer']]);
  }

  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = Buyer::select('id','username','name','status','postalcode','transportation','truck_quantity','created_at')->where('status', '1')->get();
      return Datatables::of($data)
      ->addIndexColumn()
      ->addColumn('action', function($row){
        $view = View::make('backend.buyer.action_button', [ 'row' => $row,
            'buyer_show_url' => route('admin.buyers.show', $row->id),
            'buyer_edit_url' => route('admin.buyers.edit', $row->id) ]);
        $btn = $view->render();
        return $btn;
      })
      ->addColumn('balance', function($row){
        if($row->balanceitems){
          $credit_limit = $row->credit_limit;
          $unpaid = $row->balanceitems->sum('price');
          $balance = $credit_limit - $unpaid;
          return $balance;
        } else{
          return '-';
        }
      })
      ->addColumn('status', function($row){
        if($row->status == '1'){
          $status = 'Active';
        } else {
          $status = 'Inactive';
        }
        return $status;
      })
      ->rawColumns(['action', 'company'])
      // -> parameters([
      //   'dom' => 'Bfrtip',
      //   'buttons' => ['csv', 'excel', 'pdf', 'print', 'reset', 'reload'],
      //   ])
      ->make(true);
    }
    return view('backend.buyer.index');
  }

  public function create()
  {
    $products = Product::all()->where('status', '1')->pluck('name', 'id');
    return view('backend.buyer.create', compact('products'));
  }

  public function store(Request $request)
  {
    request()->validate([
      'username'=>['required','string','max:191'],
      'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|unique:users|unique:buyers',
      'city'=>'required',
      'email'=>['required','string','email','max:191',Rule::unique('users'),Rule::unique('buyers')],
      'postalcode'=>'required|min:2|max:8',
      'city'=>'required',
      'buyer2_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
      'transport_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
      'accounts_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
    ],[
        'buyer2_contact.phone.regex' => 'The seller 2 contact phone format is invalid.',
        'transport_contact.phone.regex' => 'The Transport contact phone format is invalid.',
        'accounts_contact.phone.regex' => 'The Accounts contact phone format is invalid.',
    ]);

    $email = $request->email;
    $buyer = Buyer::where('email','LIKE',$email)->first();
    $seller = Seller::where('email','LIKE',$email)->first();
    $user = User::where('email','LIKE',$email)->first();
    if(!empty($buyer) || !empty($seller) || !empty($user)){
      $response = array("message"=>"The given data was invalid.","errors"=>array("email"=>"Email address should be unique.Email address is already used."));
      $resp = json_encode($response);
      return response($resp, 422)->header('Content-Type', 'application/json');
    }

    $tableArray['size_range'] = '{}';
    $json_fields = array('buyer2_contact', 'transport_contact', 'accounts_contact','delivery_address','soil','soil_premium','flesh_color_premium','packaging_premium', 'purposes_premium','size_range');
    foreach($request->all() as $key=>$val)
    {
      if (in_array($key, $json_fields))
      {
        $tableArray[$key] = (!empty( $val ) ? json_encode( $val ) : NULL);
      }
      else
      {
        $tableArray[$key]=$val;
      }
    }
    $buyer_userArray = array();
    $users = User::where('email', $request->email)->orwhere('phone', $request->phone)->first();
    if(!empty($users))
    {
      $user_id = $users->id;
    }
    else
    {
      $buyer_userArray['first_name'] = extract_name($request->username)['first_name'];
      $buyer_userArray['last_name'] = extract_name($request->username)['last_name'];
      $buyer_userArray['email'] = $request->email ? $request->email: str_slug($request->username, '_').'@vegking.au';
      $buyer_userArray['phone'] = $request->phone;
      $buyer_userArray['active'] = 1;
      $buyer_userArray['confirmed'] = 1;
      $password = substr(uniqid(),0,6);
      $buyer_userArray['password'] = bcrypt($password);
      $buyer_user = User::create($buyer_userArray);
      $buyer_user->assignRole('buyer');
      $user_id  = $buyer_user->id;
    }

    $tableArray['user_id'] = $user_id;
    if(isset($tableArray['product'])){
      $products = $tableArray['product'];
      unset($tableArray['product']);
    }else{
      $products = array();
    }
    if(isset($tableArray['specification'])){
      $specification = $tableArray['specification'];
      unset($tableArray['specification']);
    }else{
      $specification = array();
    }
    if($tableArray['payment_details']){
      $payment_details = $tableArray['payment_details'];
      unset($tableArray['payment_details']);
    }else{
      $payment_details = array();
    }
    $buyer = Buyer::updateOrCreate(['user_id' => $user_id], $tableArray);
    $buyer_id = $buyer->id;
    $total_pref = 0;
    if(!empty($payment_details)){
      foreach($payment_details as $value){
        $payment_details_data[] =[
          'payment_type'=>$value['payment_type'],
          'buyer_id'=>$buyer_id,
          'payment_terms' => $value['payment_terms'],
          'currency' => $value['currency'],
        ];
      }
      $buyer_payment_details = DB::table('buyer_payment_details')->insert($payment_details_data);
    }

    $all = $request->all();

    if(!empty($products[1]['product_name'])){
      foreach($products as $productKey=>$product){
        $products_data =[
          'buyer_id'=>$buyer_id,
          'product_id' => $product['product_name'],
          'street' => $all['delivery_street'][$productKey],
          'city' => $all['delivery_city'][$productKey],
          'country' => $all['delivery_country'][$productKey],
          'postalcode' => $all['delivery_postalcode'][$productKey],
        ];
        $buyer_prefs_data = BuyerPref::create($products_data);
        $buyer_pref_id = $buyer_prefs_data->id;
        $specification = @$all['specification'][$productKey];
        $premium = @$all['premium'][$productKey];
        $collected_data = array();

        $accept_all = array_keys(isset($request->accept_all[@$productKey]) ? $request->accept_all[@$productKey] : array());
        foreach($accept_all as $accept_all_value){
          $buyerPP = BuyerProductPref::Create(['buyer_pref_id' => $buyer_pref_id,'key' => $accept_all_value,'value' => 'all']);
        }
        if(!empty(@$specification)){
          foreach($specification as $specKey=>$specValue)
          {
            if(is_array($specValue))
            {
              foreach($specValue as $specValueKey=>$specValueValue){
                if(isset($request->premium_single[@$productKey][@$specKey])){
                  $premiumValue = @$request->premium_single[$productKey][$specKey];
                }else{
                  $premiumValue = @$premium[$specValueValue];
                }
                $collected_data[] = [
                  'buyer_pref_id'=>$buyer_pref_id,
                  'key' => $specKey,
                  'value' => $specValueValue,
                  'premium' => $premiumValue,
                  'created_at' => date('Y-m-d H:i:s')
                ];
              }
            }  else {
              $collected_data[] = [
                'buyer_pref_id'=>$buyer_pref_id,
                'key' => $specKey,
                'value' => $specValue,
                'premium' => NULL,
                'created_at' => date('Y-m-d H:i:s')
              ];
            }
          }
        }
        $buyerPref = DB::table('buyer_product_prefs')->insert($collected_data);
      }
    }
    $buyer = Buyer::with(['prefs.productPrefs.productSpecValue','user'])->where('id',$buyer_id)->first();
    event(new BuyerCreated($buyer,$password));
    Buyer::where('id', $buyer_id)->update(['total_prefs' => $total_pref]);
    return response()->json(['status' => 'success', 'message' => 'Buyer created successfully.']);
  }

  public function show($id)
  {
    $buyer = Buyer::where(['id' => $id])->first();
    if($buyer)
    {
      $sales = Sale::select('sales.*', 'stocks.product_id', 'stocks.price', 'stocks.available_from_date', 'products.name as product_name')
                      ->join('stocks', 'stocks.id', '=', 'sales.stock_id')
                      ->join('products', 'products.id', '=', 'stocks.product_id')
                      ->where('sales.buyer_id',$buyer->id)
                      ->get();
      $buyerprefs = BuyerPref::where('buyer_prefs.buyer_id',$buyer->id)->with('product','productPrefs','productPrefs.productSpec','productPrefs.productSpecValue')->get();
      $matches = Match::select('matches.*')->join('buyer_prefs', 'buyer_prefs.id', '=', 'matches.buyer_pref_id')->where('buyer_prefs.buyer_id',$buyer->id)->where('matches.numofmismatches','0')->get();

      return view('backend.buyer.show',compact('buyer','sales','buyerprefs','matches'));
    }
    else
    {
      $msg="Unfortunately this buyer is not exist!";
      return view('backend.buyer.index',compact('msg'));
    }
  }

  public function edit($id)
  {
    $buyer = Buyer::where(['id' => $id])->first();
    if($buyer)
    {
      $buyer = Buyer::where('buyers.id',$buyer->id)->with('buyer_prefs','payment_details')->first();
      $price = PostalCode::select('price')->where(DB::raw('substr(postal_code,1,2)'),substr($buyer->postalcode,0,2))->orWhere('name',$buyer->city)->first();
      $buyerprefs = BuyerPref::where('buyer_prefs.buyer_id',$buyer->id)->get();
      $productPrefRel = array();
      $productProdRel = array();

      foreach($buyerprefs as $buyerpref)
      {
        $productProdRel[$buyerpref->id]['product_id'] = $buyerpref->product_id;
        $productProdRel[$buyerpref->id]['delivery_city'] = $buyerpref->city;
        $productProdRel[$buyerpref->id]['delivery_street'] = $buyerpref->street;
        $productProdRel[$buyerpref->id]['delivery_postalcode'] = $buyerpref->postalcode;
        $productProdRel[$buyerpref->id]['delivery_country'] = $buyerpref->country;
        $buyerProductPref = $buyerpref->productPrefs()->select('buyer_pref_id','key','value','premium')->get()->toArray();
        $productPrefsMapping = array();
        $productPrefsMappingPremiums = array();
        foreach($buyerProductPref as $productPref)
        {
          $productPrefsMapping[$productPref['key']][] = $productPref['value'];
          $productPrefsMappingPremiums[$productPref['key']][$productPref['value']] = $productPref['premium'];
        }

        $product_list = Product::all()->where('status',1)->pluck('name','id');
        $productspecification_list = ProductSpecification::with('options')->where('product_id',$buyerpref->product_id)->where('parent_id',null)->get();
        foreach($productspecification_list as $spec)
        {
          $productPrefRel[$buyerpref->id][$spec->id]['name'] = $spec->display_name;
          $productPrefRel[$buyerpref->id][$spec->id]['hasmany'] = $spec->buyer_hasmany;
          $productPrefRel[$buyerpref->id][$spec->id]['buyer_pref_anylogic'] = $spec->buyer_pref_anylogic;
          $productPrefRel[$buyerpref->id][$spec->id]['field_type'] = $spec->field_type;
          if($spec->buyer_hasmany == 'Yes')
          {
            $productPrefRel[$buyerpref->id][$spec->id]['default'] = @$productPrefsMapping[$spec->id];
          }
          else
          {
            $productPrefRel[$buyerpref->id][$spec->id]['default'] = current($productPrefsMapping[$spec->id]??array());
          }
          $productPrefRel[$buyerpref->id][$spec->id]['options'] = array();
          foreach($spec->options as $option)
          {
            if($spec->buyer_hasmany == 'Yes')
            {
              $productPrefRel[$buyerpref->id][$spec->id]['options'][$option->id]['name'] = $option->value;
              $productPrefRel[$buyerpref->id][$spec->id]['options'][$option->id]['premium'] = @$productPrefsMappingPremiums[$spec->id][$option->id];
            }
            else
            {
              $productPrefRel[$buyerpref->id][$spec->id]['options'][$option->id] = $option->value;
            }
          }
        }
      }
      $products = Product::all()->where('status', '1')->pluck('name', 'id');
      return view('backend.buyer.edit',compact('buyer','price','products','productPrefRel','productProdRel'));
    }
    else
    {
      $msg="Unfortunately this buyer is not exist!";
      return view('backend.buyer.index',compact('msg'));
    }
  }

  public function update(Request $request, Buyer $buyer)
  {
    $buyer_id = $buyer->id;
    request()->validate([
        'username'=>['required','string','max:191',Rule::unique('buyers')->ignore($buyer_id)],
        'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'city'=>'required',
        'email'=>['required','string','email','max:191',Rule::unique('buyers')->ignore($buyer_id)],
        'postalcode'=>'required|min:2|max:8',
        'city'=>'required',
        'buyer2_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'transport_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'accounts_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
    ],[
        'buyer2_contact.phone.regex' => 'The seller 2 contact phone format is invalid.',
        'transport_contact.phone.regex' => 'The Transport contact phone format is invalid.',
        'accounts_contact.phone.regex' => 'The Accounts contact phone format is invalid.',
    ]);

    $tableArray['size_range'] = '{}';
    $json_fields = array('buyer2_contact', 'transport_contact', 'accounts_contact','delivery_address','size_range');
    foreach($request->all() as $key=>$val)
    {
      if (in_array($key, $json_fields))
      {
        $tableArray[$key] = (!empty( $val ) ? json_encode( $val ) : NULL);
      }
      else
      {
        $tableArray[$key]=$val;
      }
    }
    if(!$request->product_prefs)
    {
      $tableArray['product_prefs']= '0';
    }
    if(!$request->all_varieties)
    {
      $tableArray['all_varieties']= 0;
    }
    if(!$request->delivery_same)
    {
      $tableArray['delivery_same']= '0';
    }

    if($buyer->email != $request->email)
    {
      User::where('email', $buyer->email)->update(['email' => $request->email]);
    }
    if($buyer->phone != $request->phone)
    {
      User::where('phone', $buyer->phone)->update(['phone' => $request->phone]);
    }
    $old_products = $request->get('old_product');
    $products = $request->get('product');

    unset($tableArray['old_product']);
    unset($tableArray['product']);
    unset($tableArray['premium']);
    unset($tableArray['specification']);
    $buyer->update($tableArray);

    $old_products = $request->get('old_product');
    $products = $request->get('product');
    $all = $request->all();
    if(!empty($products) && isset($buyer->id))
    {
      foreach($products as $productKey=>$product)
      {
        if(isset($product['product_name']))
        {
          $products_data =[
            'buyer_id'=> $buyer->id,
            'product_id' => $product['product_name'],
            'street' => isset($all['delivery_street'][$productKey]) ? $all['delivery_street'][$productKey] : '',
            'city' => isset($all['delivery_city'][$productKey]) ? $all['delivery_city'][$productKey] : '',
            'country'  => isset($all['delivery_country'][$productKey]) ? $all['delivery_country'][$productKey] : '' ,
            'postalcode'  => isset($all['delivery_postalcode'][$productKey]) ? $all['delivery_postalcode'][$productKey] : '',
          ];
          $buyer_prefs_data = BuyerPref::create($products_data);
          $buyer_pref_id = $buyer_prefs_data->id;
          $specification = @$all['specification'][$productKey];
          $premium = @$all['premium'][$productKey];
          $collected_data = array();

          $accept_all = array_keys(isset($request->accept_all[@$productKey]) ? $request->accept_all[@$productKey] : array());
          foreach($accept_all as $accept_all_value)
          {
            $buyerPP=BuyerProductPref::Create(['buyer_pref_id' => $buyer_pref_id,'key' => $accept_all_value,'value' => 'all']);
          }
          if(!empty(@$specification))
          {
            foreach($specification as $specKey=>$specValue)
            {
              if(is_array($specValue))
              {
                foreach($specValue as $specValueKey=>$specValueValue)
                {
                  if(isset($request->premium_single[@$productKey][@$specKey]))
                  {
                    $premiumValue = @$request->premium_single[$productKey][$specKey];
                  }
                  else
                  {
                    $premiumValue = @$premium[$specValueValue];
                  }
                  $collected_data[] = [
                    'buyer_pref_id'=>$buyer_pref_id,
                    'key' => $specKey,
                    'value' => $specValueValue,
                    'premium' => $premiumValue,
                    'created_at' => date('Y-m-d H:i:s')
                  ];
                }
              }
              else
              {
                $collected_data[] = [
                  'buyer_pref_id'=>$buyer_pref_id,
                  'key' => $specKey,
                  'value' => $specValue,
                  'premium' => NULL,
                  'created_at' => date('Y-m-d H:i:s')
                ];
              }
            }
          }
          $buyerPref = DB::table('buyer_product_prefs')->insert($collected_data);
        }
      }
    }

    if(!empty($old_products))
    {
      foreach($old_products as $productKey=>$product)
      {
        $buyerpref = BuyerPref::all()->where('id',$productKey)->first();
        $buyerpref->product_id  = $product['product_name'];
        $buyerpref->street  = $all['delivery_street'][$productKey];
        $buyerpref->city  = $all['delivery_city'][$productKey];
        $buyerpref->country  = $all['delivery_country'][$productKey];
        $buyerpref->postalcode = $all['delivery_postalcode'][$productKey];
        $buyerpref->save();
        $buyer_pref_id = $buyerpref->id;
        $specification = @$all['specification'][$productKey];
        $premium = @$all['premium'][$productKey];

        $collected_data = array();
        $buyerExistPrefs = $buyerpref->productPrefs()->pluck('id','id')->toArray();
        $accept_all = array_keys(isset($request->accept_all[@$productKey]) ? $request->accept_all[@$productKey] : array());
        BuyerProductPref::where('buyer_pref_id',$buyer_pref_id)->whereNotIn('key',$accept_all)->where('value','all')->delete();
        foreach($accept_all as $accept_all_value)
        {
          $buyerPP = BuyerProductPref::Create(['buyer_pref_id' => $buyer_pref_id,'key' => $accept_all_value,'value' => 'all']);
        }
        if(!empty(@$specification))
        {
          foreach($specification as $specKey=>$specValue)
          {
            if(is_array($specValue))
            {
              foreach($specValue as $specValueKey=>$specValueValue)
              {
                if(isset($request->premium_single[@$productKey][@$specKey]))
                {
                  $premiumValue = @$request->premium_single[$productKey][$specKey];
                }
                else
                {
                  $premiumValue = @$premium[$specValueValue];
                }

                $buyerPP = BuyerProductPref::updateOrCreate(
                  ['buyer_pref_id' => $buyer_pref_id,'key' => $specKey,'value' => $specValueValue],
                  ['premium' => $premiumValue]
                );
                unset($buyerExistPrefs[$buyerPP->id]);
              }
            }
            else
            {
              $premiumValue = @$premium[$specValueValue];
              $buyerPP = BuyerProductPref::updateOrCreate(
                ['buyer_pref_id' => $buyer_pref_id,'key' => $specKey,'value' => $specValue],
                ['premium' => $premiumValue]
              );
              unset($buyerExistPrefs[$buyerPP->id]);
            }
          }
        }
        foreach($buyerExistPrefs as $pref)
        {
          BuyerProductPref::destroy($pref);
        }
      }
    }
    $buyer = Buyer::with('prefs.productPrefs.productSpecValue')->where('id',$buyer->id)->first();
    event(new BuyerUpdated($buyer));
    $total_pref = 0;
    Buyer::where('id', $buyer_id)->update(['total_prefs' => $total_pref]);
    return response()->json(['status' => 'success', 'message' => 'Buyer updated successfully.']);
  }

  public function destroy(Buyer $buyer)
  {
    $buyer->delete();
    return response()->json(['success'=>'Buyer deleted successfully.']);
  }

  public function getBuyerAjax(Request $request)
  {
    $buyer = Buyer::find($request->pid);
    $prodect_id  = $buyer->product;
    $variety_id  = $buyer->variety;
    $size  = $buyer->size_range;
    $obj = json_decode($size, true);
    $size_id_from = $obj[0]['from'];
    $size_id_to = $obj[0]['to'];
    $packing_id  = $buyer->packing;
    $flesh_color_id  = $buyer->flesh_color;
    $delivery_address = json_decode($buyer->delivery_address, true);
    $delivery = $delivery_address[0];

    $data = array(
      'prodect_id'=>$prodect_id,
      'variety_id'=>$variety_id,
      'packing'=>$packing_id,
      'flesh_color_id'=>$flesh_color_id,
      'size_id_from'=>$size_id_from,
      'size_id_to'=>$size_id_to,
      'delivery_to'=>$delivery,
    );
    return $data;
  }

  public function import_buyer()
  {
    $products_all = Product::all();
    if( $products_all )
    {
      $products_all_arr = $products_all->toArray();
      foreach ( $products_all_arr as $product_arr )
      {
        $product_id = $product_arr['id'];
        $product_prefs = ProductSpecification::where( [ 'product_id' => $product_id ] )->get();
        if ( $product_prefs )
        {
          $product_prefs_arr = $product_prefs->toArray();
        }
      }
    }
    return view('backend.buyer_import', [ 'products_all_arr' => $products_all_arr, "product_prefs_arr" => $product_prefs_arr ] );
  }

  /** For scraping user from vitualmarket.com */
  public function buyer_import_scrape(Request $request)
  {
    $scrape_url = 'https://www.virtualmarket.fruitlogistica.de/en/search?cmslanguage=en_GB&categories%5B30%5D%5B0%5D=26299&country%5B0%5D=593851&page=1';
    $scrape_url = $request->buyer_scrape_url;

    $parser = new \App\Models\simpleHtmlDom\htmlScraper();
    $parse_user_arr = array();
    $html = $parser->file_get_html( $scrape_url );
    $class = $html->find('div[class=ngn-search-card-contenttype]');
    foreach( $class as $k => $dc )
    {
      $a = $dc->find('a', 0);
      if( $a )
      {
        $parse_user_arr[$a->href] = array();
        $user_url = "https://www.virtualmarket.fruitlogistica.de".$a->href;
        $parse_user_arr[$a->href]['url'] = $user_url;
        $user_parser = $parser->file_get_html( $user_url );
        $user_section = $user_parser->find('[class=ngn-detail-section--box]',0);//->outertext;
        $address_cell = $user_section->find("div[class=cell medium-3 ngn-element--block]",0);

        $parse_user_arr[$a->href]['streetaddress'] = trim( $address_cell->find('span[itemprop=streetAddress]',0)->innertext );
        $parse_user_arr[$a->href]['postalcode'] = trim( $address_cell->find('span[itemprop=postalCode]',0)->innertext );
        $parse_user_arr[$a->href]['locality'] = trim( $address_cell->find('span[itemprop=addressLocality]',0)->innertext ) ;

        $parse_user_arr[$a->href]['region'] = trim( $address_cell->find('span[itemprop=addressRegion]',0)->innertext );
        $parse_user_arr[$a->href]['country'] = trim( $address_cell->find('span[itemprop=addressCountry]',0)->innertext );

        $contact_cell = $user_section->find("div[class=cell medium-3 ngn-element--block]",1);

        if( is_object( $contact_cell->find('bdi[itemprop=telephone]',0) ) )
        {
          $parse_user_arr[$a->href]['telephone'] = trim( $contact_cell->find('bdi[itemprop=telephone]',0)->innertext ) ;
        }
        else
        {
          $parse_user_arr[$a->href]['telephone'] = trim( $contact_cell->find('bdi[itemprop=telephone]',0)->innertext ) ;
        }
        if( is_object( $contact_cell->find('bdi[itemprop=faxNumber]',0) ) )
        {
          $parse_user_arr[$a->href]['fax'] = trim( $contact_cell->find('bdi[itemprop=faxNumber]',0)->innertext );
        }
        else
        {
          $parse_user_arr[$a->href]['fax'] = 'NA';
        }

        $website_cell = $user_section->find("div[class=cell medium-3 ngn-element--block]",2);
        $parse_user_arr[$a->href]['website'] = $website_cell->find('a',0)->href;
        $user_contact_person_section = $user_parser->find('[class=media-object ngn-content-box]',0);
        $parse_user_arr[$a->href]['contact_person_name'] = trim(  strip_tags( $user_contact_person_section->find('bdi[itemprop=name]',0)->innertext ) );
        if( is_object( $user_contact_person_section->find('div[itemprop=jobTitle]',0) ) )
        {
          $parse_user_arr[$a->href]['contact_person_job_title'] = trim( strip_tags( $user_contact_person_section->find('div[itemprop=jobTitle]',0)->innertext ) );
        }
        else
        {
          $parse_user_arr[$a->href]['contact_person_job_title'] = "NA";
        }
        //// $parse_user_arr[$a->href]['contact_person_email'] = $user_contact_person_section->find('a',2)->href;
      }
    }

    if( count( $parse_user_arr ) )
    {
      foreach( $parse_user_arr as $buyer_scrape_row )
      {
        $name_arr = explode( " ",$buyer_scrape_row['contact_person_name'], 2 );
        $row['first_name'] = $name_arr['0'];
        $row['last_name'] = isset( $name_arr['1'] )? $name_arr['1'] :' ';
        $row['phone'] = $buyer_scrape_row['telephone'];
        $row['password'] = $buyer_scrape_row['telephone']; // for now using its phone number as the password
        $row['postalcode'] = $buyer_scrape_row['postalcode'];
        $row['address'] = $buyer_scrape_row['streetaddress'].' '.$buyer_scrape_row['locality'].' '.$buyer_scrape_row['region'];
        $row['country'] = $buyer_scrape_row['country'];
        $resp[ $row['phone'] ] = $this->storeFromArray( $row );
      }
      return response()->json( [ "error" => 0,"status"=>"success", "data" => print_r($parse_user_arr), "buyer_scrape_url"=>$scrape_url , 'storeResp' => $resp ]  );
    }
  }


  public function storeFromArray( $buyer_row )
  {
    if( !isset($buyer_row['email']) || $buyer_row['email'] =='' )
    {
      $buyer_row['email'] = str_replace( array(" ","+"), "", $buyer_row['phone']."@vegking.com" );
    }
    $buyer_row_ins['email'] = $buyer_row['email'];
    $buyer_row_ins['last_name'] = $buyer_row['last_name'];
    $buyer_row_ins['first_name'] = $buyer_row['first_name'];
    $buyer_row_ins['phone'] = $buyer_row['phone'];
    $buyer_row_ins['password'] = $buyer_row['password'];
    $request = new Request( $buyer_row_ins );

    $validator = Validator::make($request->all(), [
      'phone' => 'required|unique:users',
      'password' => 'required|min:6'
    ]);

    if ($validator->fails())
    {
      $msg = $validator->messages()->first();
      $error_code = 1;
    }
    else
    {
      $tableArray['size_range'] = '{}';
      $tableArray['variety'] = NULL;
      //return $tableArray;
      $tableArray['postalcode'] = $buyer_row['postalcode'];
      $tableArray['address'] = $buyer_row['address'];
      $tableArray['country'] = $buyer_row['country'];

      $buyer_user = User::create($buyer_row);
      $buyer_user->assignRole('buyer');
      $user_id  = $buyer_user->id;

      $tableArray['user_id'] = $user_id;
      $buyer = Buyer::updateOrCreate(['user_id' => $user_id], $tableArray);
      $error_code = 0;
      $msg = "success";
    }

    return [ "error" => $error_code, "msg" => $msg ];
  }

  /** Use for export Excel data */
  public function exports()
  {
    return Excel::download(new BuyersExport, 'buyers.xlsx');
  }

  public function parseImport(Request $request)
  {
    $file_upload = $request->input('file_upload');
    if( $file_upload == '1' )
    {
      $product_id = $request->input('product_id');
      $file_up = $request->file('csv_file');

      if($file_up == "")
      {
        return response()->json( ['error' => 1, 'msg' => 'Please upload file']);
        exit;
      }
      $path1 = $request->file('csv_file')->store('temp');
      $path=storage_path('app').'/'.$path1;

      $product_import_arr = (new UsersFirstImport( [ "row_number" => "1" ] ) )->toArray( $path );

      $product_columns_excel_arr = $product_import_arr['0']['0'];

      $product_specifications = ProductSpecification::where( [ 'product_id' => $product_id ] )->get();
      if ( $product_specifications )
      {
        $product_specifications_arr = $product_specifications->toArray();
      }
      $user_table = "users";
      $buyer_table = "buyers";
      $users_column_arr = DB::getSchemaBuilder()->getColumnListing($user_table);
      $buyers_column_arr = DB::getSchemaBuilder()->getColumnListing($buyer_table);
      $unwanted_fields = array('id','uuid', 'last_login_at','last_login_ip','to_be_logged_out','remember_token','created_at','updated_at','deleted_at','product_prefs','credit_limit','dry_matter_content','transportation','price_prefs','size_range','soil','disc_upsc','total_prefs','note','buyer2_contact','transport_contact','accounts_contact','status','truck_quantity','trust_level','user_id','all_varieties','extra_transport_cost_per_ton','skin_color');

      foreach ($unwanted_fields as $value)
      {
        if( ($f_key = array_search( $value, $users_column_arr ) ) !== false )
        {
          unset( $users_column_arr[ $f_key ] );
        }
      }

      foreach ($unwanted_fields as $key => $value)
      {
        if(  ($f_key = array_search( $value, $buyers_column_arr ) ) !== false )
        {
          unset($buyers_column_arr[$f_key]);
        }
      }
      return response()->json( [ 'product_columns_excel_arr' => $product_columns_excel_arr,
        'product_specifications_arr' => $product_specifications_arr,
        'users_column_arr' =>  $users_column_arr,
        'buyers_column_arr' => $buyers_column_arr,
        'xl_path' => $path
      ]);
    }
    else
    {
      $product_id = $request->input('product_id');
      $update_current = $request->input('update_current')==''?0 : 1;
      $xl_path = $request->input('xl_path');
      $user_mapper = $request->input('users_table');
      $buyer_mapper = $request->input('buyers_table');
      $spec_mapper = $request->input('specification_table');
      $construct_arr = [ 'prodect_id'=>$product_id, 'user_mapper'=>$user_mapper ];

      $product_import_arr = (new UsersFirstImport() )->toArray( $xl_path );

      $excel_column_arr = array();
      $excel_value_arr = array();
      foreach( $product_import_arr[0] as $excel_row_num => $excel_row_arr )
      {
        if( $excel_row_num == 0 )
        {
          $exel_column_arr = $excel_row_arr;
        }
        else
        {
          $value_arr = array();
          foreach( $exel_column_arr as $column_index => $column_name )
          {
            if( $column_name != null )
            {
              $value_arr[$column_name] = $excel_row_arr[$column_index];
            }
          }
          $excel_value_arr[ $excel_row_num ] = $value_arr;
        }
      }
      $user_table_values = array();
      $buyer_table_values = array();
      $buyer_pref_table_values = array();
      foreach( $excel_value_arr as $excel_row_num => $value_arr )
      {
        $user_table_row = array();
        $buyer_table_row = array();
        $spec_table_row = array();
        foreach ($user_mapper as $user_table_field => $excel_column )
        {
          if( isset( $value_arr[ $excel_column ] ) )
          {
            $user_table_row[ $user_table_field ] = $value_arr[ $excel_column ];
          }
        }
        foreach ($buyer_mapper as $buyer_table_field => $excel_column )
        {
          if( isset( $value_arr[ $excel_column ] ) )
          {
            $buyer_table_row[ $buyer_table_field ] = $value_arr[ $excel_column ];
          }
        }
        foreach( $spec_mapper as $spec_table_id => $excel_column  )
        {
          if( isset( $value_arr[ $excel_column ] ) )
          {
            $product_spec_value_id_obj = ProductSpecificationValue::where( [
              'product_specification_id' => $spec_table_id,
              'value' => $value_arr[ $excel_column ]
            ] )->get() ;
            if( $product_spec_value_id_obj )
            {
              $product_spec_value_id_arr = $product_spec_value_id_obj->toArray();
              if( is_array( $product_spec_value_id_arr ) && !empty( $product_spec_value_id_arr ) )
              {
                $spec_table_row[ $spec_table_id ] = $product_spec_value_id_arr['0']['id'];
              }
            }
          }
        }

        $user_table_values[$excel_row_num] = $user_table_row;
        $buyer_table_values[$excel_row_num] = $buyer_table_row;
        $buyer_pref_table_values[$excel_row_num] = $spec_table_row;
      }
      $buyer_spec_result = array();
      $record_created_result = array();
      foreach( $user_table_values as $key => $user_arr )
      {
        $buyer_created_result = $this->process_imported_buyer( [ 'user'=>$user_arr,
          'buyer' => $buyer_table_values[$key],
          'update_current' => $update_current, 'row_no' => $key
        ]);
        $record_created_result[$key] = $buyer_created_result;
        if( isset( $buyer_created_result['error'] ) && $buyer_created_result['error'] == 0 )
        {
          $tableArray['product_id'] = $product_id;
          $buyer_pref = BuyerPref::updateOrCreate(['buyer_id' => $buyer_created_result[ 'buyer_id' ] ], $tableArray );
          foreach( $buyer_pref_table_values[$key] as $bp_key => $bp_val )
          {
            $buyer_pref_id = $buyer_pref->id;
            $buyer_spec_result[$bp_key][$bp_key] = BuyerProductPref::create( ["product_id"=>$product_id,
              'key' => $bp_key ,
              'value' => $bp_val,
              'buyer_pref_id' => $buyer_pref_id
            ]);
          }
        }
      }

      return response()->json( [
        'user_table_values' => $user_table_values, 'buyer_table_values' => $buyer_table_values,
        'buyer_pref_table_values' => $buyer_pref_table_values, 'buyer_spec_result' => $buyer_spec_result,
        'record_created_result' => $record_created_result
      ]);
    }
  }

  public function process_imported_buyer( $buyer_import_info )
  {
    if( $buyer_import_info['update_current'] == 1 )
    {
      $validator = Validator::make( $buyer_import_info['user'] ,[
                 'email'=>'required',
                 'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                 'seller2_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                 'transport_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                 'accounts_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                ],[
                  'email.required' => 'The email is required: Row No.'.$buyer_import_info['row_no'],
                  'email.required' => 'The email for users table is required: Row No.'.$buyer_import_info['row_no'],
                  'postalcode.required' => 'The postalcode or city field is required.: Row No.'.$buyer_import_info['row_no'],
                  'seller2_contact.phone.regex' => 'The seller 2 contact phone format is invalid.: Row No.'.$buyer_import_info['row_no'],
                  'transport_contact.phone.regex' => 'The Transport contact phone format is invalid.: Row No.'.$buyer_import_info['row_no'],
                  'accounts_contact.phone.regex' => 'The Accounts contact phone format is invalid.: Row No.'.$buyer_import_info['row_no'],
                ] );
    }
    else
    {
      $validator = Validator::make( $buyer_import_info['user'] ,[
                 'email'=>'required|unique:users',
                 'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                 'seller2_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                 'transport_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                 'accounts_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                ],[
                  'email.unique' => 'The email has already be taken: Row No.'.$buyer_import_info['row_no'],
                  'email.required' => 'The email for users table is required: Row No.'.$buyer_import_info['row_no'],
                  'postalcode.required' => 'The postalcode or city field is required.: Row No.'.$buyer_import_info['row_no'],
                  'seller2_contact.phone.regex' => 'The seller 2 contact phone format is invalid.: Row No.'.$buyer_import_info['row_no'],
                  'transport_contact.phone.regex' => 'The Transport contact phone format is invalid.: Row No.'.$buyer_import_info['row_no'],
                  'accounts_contact.phone.regex' => 'The Accounts contact phone format is invalid.: Row No.'.$buyer_import_info['row_no'],
            ]);
    }

    $error_no = 0;
    if ($validator->fails())
    {
      $error_no++;
      $user_err_messages = $validator->messages()->first();
    }
    if( $buyer_import_info['update_current'] == 1 )
    {
      $validator_buyer = Validator::make( $buyer_import_info['buyer'] , [
               'email'=>'required',
               'username'=>'required',
               'phone' => 'required'
              ],[
                'email.required' => 'The email for buyers table is required: Row No.'.$buyer_import_info['row_no'],
                'username.required' => 'The username for buyers table is required: Row No.'.$buyer_import_info['row_no'],
                'phone.required' => 'The phone for buyers table is required: Row No.'.$buyer_import_info['row_no'],
              ]);
    }
    else
    {
      $validator_buyer = Validator::make( $buyer_import_info['buyer'] , [
               'email'=>'required|unique:buyers',
               'username'=>'required|unique:buyers',
               'phone' => 'required|unique:buyers'
              ],[
                'email.required' => 'The email for buyers table is required: Row No.'.$buyer_import_info['row_no'],
                'username.required' => 'The username for buyers table is required: Row No.'.$buyer_import_info['row_no'],
                'phone.required' => 'The phone for buyers table is required: Row No.'.$buyer_import_info['row_no'],
              ]);
    }

    if ($validator_buyer->fails())
    {
      $error_no++;
      $buyer_err_messages = $validator_buyer->messages()->first();
    }
    $warn = 0;
    $warn_arr = array();
    if( $error_no == 0 )
    {
      $buyer_import_info['user']['password'] = bcrypt($buyer_import_info['user']['password']);
      if( $buyer_import_info['update_current'] == 1 )
      {
        $user = User::updateOrCreate(['email'=>$buyer_import_info['user']['email'] ], $buyer_import_info['user'] );
        $user->assignRole('buyer');
      }
      else
      {
        $user = User::Create( $buyer_import_info['user'] );
      }
      $user_id  = $user->id;
      $buyer_import_info['user']['user_id'] = $user_id;
      $buyer = Buyer::updateOrCreate(['user_id' => $user_id], $buyer_import_info['buyer']);

      $buyer_url = url('authorize-buyer/'.$user->uuid);

      if($buyer->email)
      {
        $warn = 0;
        $locale = \App::getLocale();
        $email_content = '';
        $email_template = get_email_template('IMPORT BUYER NOTIFICATION EMAIL');
        \App\EmailTemplate::where('title', 'IMPORT BUYER NOTIFICATION EMAIL')->increment('sent');

        $team_member_name = "admin@cotrader.com";
        if($email_template)
        {
          if($buyer->hasRole('testuser'))
          {
            $msg_username = $buyer->name." ".live_dev_site_status();
          }
          else
          {
            $msg_username = $buyer->name;
          }
          $msg_content = "Hi ".$msg_username.",";

          $upload_stock_link = '<a href="'.$buyer_url.'">'.\Lang::get('email.upload_stock_link').'</a>';
          $email_content = 'King [username] [env] [role],';
			    $whatsapp_content = 'King [username] [env] [role],';
          if($locale == 'pl')
          {
            $email_content .= $email_template->email_content_pl;
            $email_subject = $email_template->subject;
          }
          else
          {
            $email_content .= $email_template->email_content;
            $email_subject = $email_template->subject;
          }
          $email_content = str_replace("[env]", env('APP_ENV'), $email_content);
			    $email_content = str_replace("[role]", 'buyer', $email_content);
          $email_content = $msg_content.str_replace("[username]", $buyer->username, $email_content);
          $email_content = str_replace("[password]", $buyer_import_info['user']['password'], $email_content);
          $email_content = str_replace("[first_name]", $buyer->name, $email_content);
          $email_content = str_replace("[email]", $buyer->email, $email_content);
          $email_content = str_replace("[upload_stock_link]", $upload_stock_link, $email_content);
          $email_content = str_replace("[team_member_name]", $team_member_name, $email_content);
          $email_content = str_replace("[english_phone_number]", \Lang::get('inner-content.frontend.contactsec.phone-2'), $email_content);
        }
        $email_details['content'] = $email_content;
        $email_details['subject'] = $email_subject;

        $ret[$buyer->email] = event( new BuyerSellerImported( $user, $email_details ) );
      }
      return [ 'error' => 0, 'user_id' => $user_id, 'buyer_id' => $buyer->id, 'email' => $buyer_import_info['user']['email'], 'warn'=> $warn, 'warn_arr' => $ret ];
    }
    else
    {
      $error_arr[ 'error' ] = $error_no;
      if ( isset( $user_err_messages ) )
      {
        $error_arr['user_error'] = $user_err_messages;
      }
      if ( isset( $buyer_err_messages ) )
      {
        $error_arr['buyer_error'] = $buyer_err_messages;
      }
      return $error_arr;
    }
  }

  public function updateBuyerPref(Request $request)
  {
    $buyer = \App\Buyer::where('user_id', auth()->user()->id)->first();
    $buyer_id = $buyer->id;

    $tableArray['size_range'] = '{}';
    $json_fields = array('buyer2_contact', 'transport_contact', 'accounts_contact','delivery_address','size_range');
    foreach($request->all() as $key=>$val)
    {
      if (in_array($key, $json_fields))
      {
        $tableArray[$key] = (!empty( $val ) ? json_encode( $val ) : NULL);
      }
      else
      {
        $tableArray[$key]=$val;
      }
    }

    if(!$request->product_prefs)
    {
      $tableArray['product_prefs']= '0';
    }
    if(!$request->all_varieties)
    {
      $tableArray['all_varieties']= 0;
    }

    $old_products = $request->get('old_product');
    $products = $request->get('product');
    unset($tableArray['old_product']);
    unset($tableArray['product']);
    unset($tableArray['premium']);
    unset($tableArray['specification']);
    $buyer->update($tableArray);

    $old_products = $request->get('old_product');
    $products = $request->get('product');
    $all = $request->all();
    if(!empty($products))
    {
      foreach($products as $productKey=>$product)
      {
        $products_data =[
          'buyer_id'=>$buyer->id,
          'product_id' => $product['product_name'],
          'street' => @$all['delivery_street'][$productKey],
          'city' => @$all['delivery_city'][$productKey],
          'country'  => @$all['delivery_country'][$productKey],
          'postalcode'  => @$all['delivery_postalcode'][$productKey],
        ];
        $buyer_prefs_data = BuyerPref::create($products_data);
        $buyer_pref_id = $buyer_prefs_data->id;
        $specification = @$all['specification'][$productKey];
        $premium = @$all['premium'][$productKey];
        $collected_data = array();

        $accept_all = array_keys(isset($request->accept_all[@$productKey]) ? $request->accept_all[@$productKey] : array());
        foreach($accept_all as $accept_all_value)
        {
          echo ' - '.$accept_all_value;
          DB::enableQueryLog();
          $buyerPP = BuyerProductPref::Create(['buyer_pref_id' => $buyer_pref_id,'key' => $accept_all_value,'value' => 'all']);
          print_r(DB::getQueryLog());
        }
        if(!empty(@$specification))
        {
          foreach($specification as $specKey=>$specValue)
          {
            if(is_array($specValue))
            {
              foreach($specValue as $specValueKey=>$specValueValue)
              {
                if(isset($request->premium_single[@$productKey][@$specKey]))
                {
                  $premiumValue = @$request->premium_single[$productKey][$specKey];
                }
                else
                {
                  $premiumValue = @$premium[$specValueValue];
                }
                $collected_data[] = [
                                  'buyer_pref_id'=>$buyer_pref_id,
                                  'key' => $specKey,
                                  'value' => $specValueValue,
                                  'premium' => $premiumValue,
                                  'created_at' => date('Y-m-d H:i:s')
                                ];
              }
            }
            else
            {
              $collected_data[] = [
                              'buyer_pref_id'=>$buyer_pref_id,
                              'key' => $specKey,
                              'value' => $specValue,
                              'premium' => NULL,
                              'created_at' => date('Y-m-d H:i:s')
                            ];
            }
          }
        }
        $buyerPref = DB::table('buyer_product_prefs')->insert($collected_data);
      }
    }

    if(!empty($old_products))
    {
      foreach($old_products as $productKey=>$product)
      {
        $buyerpref = BuyerPref::all()->where('id',$productKey)->first();
        $buyerpref->product_id  = $product['product_name'];
        $buyerpref->street  = $all['delivery_street'][$productKey];
        $buyerpref->city  = $all['delivery_city'][$productKey];
        $buyerpref->country  = $all['delivery_country'][$productKey];
        $buyerpref->postalcode = $all['delivery_postalcode'][$productKey];
        $buyerpref->save();

        $buyer_pref_id = $buyerpref->id;
        $specification = @$all['specification'][$productKey];
        $premium = @$all['premium'][$productKey];
        $collected_data = array();
        $buyerExistPrefs = $buyerpref->productPrefs()->pluck('id','id')->toArray();
        $accept_all = array_keys(isset($request->accept_all[@$productKey]) ? $request->accept_all[@$productKey] : array());
        BuyerProductPref::where('buyer_pref_id',$buyer_pref_id)->whereNotIn('key',$accept_all)->where('value','all')->delete();
        foreach($accept_all as $accept_all_value)
        {
          $buyerPP = BuyerProductPref::Create(['buyer_pref_id' => $buyer_pref_id,'key' => $accept_all_value,'value' => 'all']);
        }
        if(!empty(@$specification))
        {
          foreach(@$specification as $specKey=>$specValue)
          {
            if(is_array($specValue))
            {
              foreach($specValue as $specValueKey=>$specValueValue)
              {
                if(isset($request->premium_single[@$productKey][@$specKey]))
                {
                  $premiumValue = @$request->premium_single[$productKey][$specKey];
                }
                else
                {
                  $premiumValue = @$premium[$specValueValue];
                }

                $buyerPP = BuyerProductPref::updateOrCreate(
                              ['buyer_pref_id' => $buyer_pref_id,'key' => $specKey,'value' => $specValueValue],
                              ['premium' => $premiumValue]
                            );
                            unset($buyerExistPrefs[$buyerPP->id]);
              }
            }
            else
            {
              $premiumValue = @$premium[$specValueValue];
              $buyerPP = BuyerProductPref::updateOrCreate(
                      ['buyer_pref_id' => $buyer_pref_id,'key' => $specKey,'value' => $specValue],
                      ['premium' => $premiumValue]
                  );
              unset($buyerExistPrefs[$buyerPP->id]);
            }
          }
        }
        foreach($buyerExistPrefs as $pref)
        {
          BuyerProductPref::destroy($pref);
        }
      }
    }
    $buyer = Buyer::with('prefs.productPrefs.productSpecValue')->where('id',$buyer->id)->first();
    event(new BuyerUpdated($buyer));
    $total_pref = 0;
    Buyer::where('id', $buyer_id)->update(['total_prefs' => $total_pref]);
    return response()->json(['status' => 'success', 'message' => 'Buyer updated successfully.']);
  }

  public function editbuyer($buyer=null)
  {
    $buyer = Buyer::where('user_id',$buyer)->first();
    if(isset($buyer))
    {
      if(auth()->user()->id == $buyer->user_id)
      {
        $notify = Notifications::where('user_id', $buyer->user_id)->get()->all();
        $notifications = [] ;
        if(!empty($notify)){
          foreach ($notify as $not) {
            if($not->key == 'sale_confirmed' ){
             $notifications['sale_confirmed'] = $not->value;
            }
            if($not->key == 'delivery_update' ){
             $notifications['delivery_update'] = $not->value;
            }
            if($not->key == 'offers_messages' ){
             $notifications['offers_messages'] = $not->value;
            }
          }
        }

        $user = auth()->user();
        $products = Product::all()->where('status', '1')->pluck('name', 'id');
        return view('backend.auth.buyer.edit',compact('products','buyer', 'notifications'))
            ->withUser($user)
            ->withUserRoles($user->roles->pluck('name')->all())
            ->withUserPermissions($user->permissions->pluck('name')->all());
      }
      else
      {
        return abort(404);
      }
    }
    else
    {
      return abort(404);
    }
  }

  public function updatebuyer(Request $request, $buyer=null)
  {
      $buyer = Buyer::find($buyer);
      $change_password_flag = false;
      if(!empty($request->old_password) || !empty($request->password) || !empty($request->password_confirmation))
      {
          request()->validate([
              'username' => 'required',
              'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
              'city' => 'required',
              'postalcode'=>'required|min:2|max:8',
              'address' => 'required',
              'country' => 'required',
              'old_password' => 'required',
              'password' => ['required', 'string', 'min:6', 'confirmed']]);   

          $old_password_validate = User::where('id', $buyer->user_id)->select('password')->get()->first(); 
          if(!\Hash::check($request->old_password, $old_password_validate->password)){
              return response()->json(['status' => 'error', 'message' => 'The old password does not match our records.']);
          }
          else{
              $change_password_flag = true;    
          }
      }
      else
      {
        $request->validate([
          'username' => 'required',
          'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
          'city' => 'required',
          'postalcode'=>'required|min:2|max:8',
          'address' => 'required',
          'country' => 'required',
        ]);
      }

    if($request->phone!='')
    {
      User::where('id', $buyer->user_id)->update(['phone' => $request->phone]);
    }
    if(extract_name($request->username)['first_name']!='')
    {
      User::where('id', $buyer->user_id)->update(['first_name' =>  extract_name($request->username)['first_name']]);
    }
    if($request->sale_confirmed !=''){
        if(!empty(Notifications::where('user_id', $buyer->user_id)->where('key','sale_confirmed')->get()->all())){
            $res = Notifications::where('user_id', $buyer->user_id)->where('key','sale_confirmed')->update(['value'=> $request->sale_confirmed]);
        }
        else{
            $res = Notifications::create(['user_id'=>$buyer->user_id, 'key'=>'sale_confirmed', 'value'=> $request->sale_confirmed ]);
        }
    }
    if($request->delivery_update !=''){

        if(!empty(Notifications::where('user_id', $buyer->user_id)->where('key','delivery_update')->get()->all())){
            $res = Notifications::where('user_id', $buyer->user_id)->where('key','delivery_update')->update(['value'=> $request->delivery_update]);
        }
        else{

          $res = Notifications::create(['user_id'=>$buyer->user_id, 'key'=>'delivery_update', 'value'=> $request->delivery_update ]);
        }
    }
    if($request->offers_messages !=''){
       if(!empty(Notifications::where('user_id', $buyer->user_id)->where('key','offers_messages')->get()->all())){
            $res = Notifications::where('user_id', $buyer->user_id)->where('key','offers_messages')->update(['value'=> $request->offers_messages]);
        }
        else{
          $res = Notifications::create(['user_id'=>$buyer->user_id, 'key'=>'offers_messages', 'value'=> $request->offers_messages ]);
        }
    }


    $gender = isset($request->gender) && $request->gender == '1' ? '1':'0';
    User::where('id', $buyer->user_id)->update(['gender' => $gender, 'last_name' => extract_name($request->username)['last_name']]);
    $buyerData = $request->all();
    $contact_email = isset($buyerData['contact_email']) && $buyerData['contact_email'] == '1' ? '1':'0';
    $contact_sms = isset($buyerData['contact_sms']) && $buyerData['contact_sms'] == '1' ? '1':'0';
    $contact_whatsapp = isset($buyerData['contact_whatsapp']) && $buyerData['contact_whatsapp'] == '1' ? '1':'0';
    $buyerData['contact_email'] = $contact_email;
    $buyerData['contact_sms'] = $contact_sms;
    $buyerData['contact_whatsapp'] = $contact_whatsapp;
    $buyerData['nickname'] = @$buyerData['nickname'];
    $buyer->update($buyerData);

    User::where('id', $buyer->user_id)->update(['email_subscription' => $contact_email, 'whatsapp_subscription' => $contact_whatsapp, 'whatsapp_number'=> $request->whatsapp_number ]);
    
    if($change_password_flag == true){
        $res = User::where('id', $buyer->user_id)->update(['password'=>\Hash::make($request->password)]);    
      }

    return response()->json(['status' => 'success', 'message' => 'Buyer updated successfully.']);
  }

    public function buyerSearch (Request $request)
    {
        $term = @$request->get('search');
        $sellers = Buyer::select('id',DB::raw('CONCAT_WS("-",username,company,nickname) as text'))
        ->where(function ($query) use ($term){
             $query->where('username','LIKE',$term.'%')
                  ->orWhere('company','LIKE',$term.'%')
                  ->orWhere('nickname','LIKE',$term.'%');
        })
        ->limit(10)->get()->toArray();
        $result = ['result'=>$sellers,'pagination'=>['more'=>true]];
        return response()->json(@$result);
    }

}
