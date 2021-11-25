<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Auth\User;
use App\Models\Auth\UserTracking;
use App\Mail\Frontend\Contact\SendBusinessCard;
use App\ProductSpecification;
use App\ProductSpecificationValue;
use App\Events\Backend\StockUpdated;
use App\Seller;
use App\Sale;
use App\OfferSent;
use App\SaleTruck;
use App\Loadstatus;
use App\PurchaseOrder;
use App\Invoice;
use App\Stock;
use App\Buyer;
use App\Product;
use Carbon\Carbon;
use App\Referrer;
use DateTime;
use App\LanguageContent;
use Mail;
use App\Subscriber;
use App\UserIps;
use App\UserVisis;
use App\Bizcards;
use Auth;
use Cookie;
use GuzzleHttp\Client;
use App\CurrencyRate;
use App\UserVisits;
use App\Helpers\Auth\SocialiteHelper;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
  /**
   * @return \Illuminate\View\View
   */
  public function index(Request $request){
    
       $push_token='';
        if($request->userId)
        {
            $push_token=$request->userId;
        }
    if(request()->has('r')){

      $ref_val = request()->r;
      $user_id = decrypt($ref_val);

    }else{
      $user_id='';
    }
      $data = [
          'phone' => '919125368261', // Receivers phone
          'body' => 'WhatsApp API on chat-api.com works good', // Message
      ];
      //wa_send($data);

      $products = Product::where('type', 'product')->where('status', '1')->get();
 
      $LanguageContent = LanguageContent::where('id',1)->first();
      if(isset(request()->product)){ // FOR BUY POPUP
        $active_lang = \App::getLocale();
        $product = request()->product;
        $productTypeManualData = get_buyer_popup_product_types();
        $lang_of_url_product = get_lang_from_product(ucfirst(request()->product), $productTypeManualData);
        
        if(!empty($lang_of_url_product) && $active_lang != $lang_of_url_product){
          return redirect('/lang/'.$lang_of_url_product);
        }
      }
      //return view('frontend.index', compact('products','user_id','LanguageContent','push_token'));
      return view('frontend.home-new', compact('products','user_id','LanguageContent'));
    }
    function confirmoffer($request)
    {
      $OfferSent = OfferSent::find($request);
      $OfferSent->email_confirm=1;
      $OfferSent->save();
    
      return redirect('/')->with('message','Thank you for confirmation');
    }
    function  ExpoRegistration(Request $request){
      $data = $request->data;
  
      $response = array();
      $temp = array();
      foreach($data as   $d){
       $temp[$d['name']] = $d['value'];
       array_push($response, $temp);
      } 
      $final_respose=end($response);
      $random_password=Str::random(12);
      $seller_data=Seller::where('email',$final_respose['stock-email'])->first();

      if (!isset($seller_data)) {
          $user= new User();
          $user->email=$final_respose['stock-email'];
          $user->phone=$final_respose['stock-phone'];
          $user->password=$random_password;
          $user->company_name=$final_respose['stock-company'];
          $user->first_name=strtok($final_respose['stock-name'], ' ');
          $user->last_name= strtok('');
          $user->save();
          $insertedId = $user->id;
          $seller= new Seller();
          $seller->email=$final_respose['stock-email'];
          $seller->user_id=$insertedId;
          $seller->name=$final_respose['stock-name'];
          $seller->company=$final_respose['stock-company'];
          $seller->postalcode=$final_respose['stock-postal-code'];
          $seller->country=$final_respose['stock-country'];
          $seller->phone=$final_respose['stock-phone'];
          $seller->save();
      }
      $emailid=$final_respose['stock-email'];
      $email_content="Dear".$final_respose['stock-name']."<br> Your password is". $random_password;
      if($request->email_subscription){
          \Mail::send('frontend.mail.general', ['email_content' => $email_content], function ($message) use ($emailid) {
          $message->subject("Password of your account");
          $message->to($emailid);
        });
      }
      

      $tableArray = array();
      $tableArray['product_id'] =$final_respose['product_id'];
      $tableArray['city'] = '';
      $tableArray['postalcode'] = '';
      $tableArray['street'] = '';
      $tableArray['country'] = '';
      $tableArray['price'] = $final_respose['price'];
      $tableArray['price_currency'] = $final_respose['price_currency'];
      $tableArray['stock_status'] = $final_respose['stock_status'];
      $tableArray['image'] = '';
      $tableArray['seller_id']=$seller_data['id'];
      $imageName2 = [];
      if($request->image){
          $file = $final_respose['image'];
          $files = $final_respose['image'];

  $time = 1;
  foreach(@$files as $file){
    $tmp = time().$time.'.'.$file->getClientOriginalExtension();
    $file->move(public_path('images/stock'), $tmp);
    $imageName2[] = $tmp;
    $time++;
  }
      }
      $tableArray['image'] = json_encode(@$imageName2);
      $offer = Stock::create($tableArray);
      $productspecification_list = ProductSpecification::with('options')->where('product_id',$final_respose['product_id'])->where('parent_id',null)->pluck('field_type','id')->toArray();
  
      $offer_id = $offer->id;
      $specification = @$all[$final_respose['fields']];
      $sizes = @$all[$final_respose['size']];
      $colorful =@$all[$final_respose['colorful']];
      $sugar_content =@$all[$final_respose['sugar_content']]; 
 
    
     
      $pSpecialIds = ProductSpecification::where('product_id',$final_respose['product_id'])->where('parent_id',null)->whereIn('type_name',['Size','Colorful','Sugar Content'])->pluck('id','type_name')->toArray();
      if(isset($pSpecialIds['Colorful'])){ 
          $product_spec_id = @$pSpecialIds['Size']; 
          if(is_array($sizes) && !empty($sizes)){
              foreach(@$sizes as $size_id=>$specValue3)
              {
                  $data = [
                              'offer_id'=>$offer_id,
                              'product_spec_id' => $product_spec_id,
                              'value' => @$specValue3['from'].'-'.@$specValue3['to']
                          ];
                  StockProperty::create($data);
              }
          }
      }
      if(isset($pSpecialIds['Colorful'])){
          $Colorful_spec_id = $pSpecialIds['Colorful']; 
          if(is_array($colorful) && !empty($colorful)){
              
              $data = [
                          'offer_id'=>$offer_id,
                          'product_spec_id' => $Colorful_spec_id,
                          'value' => @$colorful['from'].'-'.@$colorful['to']
                      ];
              StockProperty::create($data);
          }
      }
      if(isset($pSpecialIds['Sugar Content'])){
          $sugar_content_spec_id = $pSpecialIds['Sugar Content']; 
          if(is_array($sugar_content) && !empty($sugar_content)){
              
              $data = [
                          'offer_id'=>$offer_id,
                          'product_spec_id' => $sugar_content_spec_id,
                          'value' => @$sugar_content['from'].'-'.@$sugar_content['to']
                      ];
              StockProperty::create($data);
          }
      }
      
     
      //$productspecification_list = ProductSpecification::where('product_id',$_POST['product_id'])->where('parent_id',null)->pluck('field_type','id')->toArray();

      if(is_array($specification) && !empty($specification)){
          foreach(@$specification as $product_spec_id=>$specValue)
          {
              if($productspecification_list[$product_spec_id] == 'dropdown_switchboxes' || $productspecification_list[$product_spec_id] == 'checkboxes'){
                  if(is_array($specValue))
                  {
                      foreach($specValue as $specValueKey=>$specValueValue){
                          if((int)$specValueValue > 0){
                              $data = [
                                  'offer_id'=>$offer_id,
                                  'product_spec_id' => $product_spec_id,
                                  'product_spec_val_id' => $specValueValue,
                                   'ecs' => @$all[$final_respose['ecs']]
                                  
                                  
                                  ];
                                  
                              StockProperty::create($data);
                          }
                      }
                  }  else {
                      if((int)$specValue > 0){
                          $data = [
                              'offer_id'=>$offer_id,
                              'product_spec_id' => $product_spec_id,
                              'product_spec_val_id' => $specValue,
                              ];
                     
                          StockProperty::create($data);
                      }                            
                  }
              } else if($productspecification_list[$product_spec_id] == 'inputfield'){
                  $data = [
                          'offer_id'=>$offer_id,
                          'product_spec_id' => $product_spec_id,
                          'value' => $specValue
                          ];
                  StockProperty::create($data);       
              } else if($productspecification_list[$product_spec_id] == 'optionrange'){
                  $data = [
                          'offer_id'=>$offer_id,
                          'product_spec_id' => $product_spec_id,
                          'value' => $specValue['size_from'].'-'.$specValue['size_to']
                          ];
                  StockProperty::create($data);
              }           
          }
      }
  
    
  $stock = Offer::with('offerProperty.productSpecValue')->where('id',$offer_id)->first();
  
  event(new StockUpdated($stock));
  
  return response()->json(['status' => 'success', 'message' => 'Stock added successfully!']); 


    }     
    function getUserIP()
    {
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
                  $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                  $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        return $ip;
    }

    public function referrer(Request $request){
      // code for check userips
      Cookie::queue('IP', $request->ip);
     
      $location_detail = \Location::get($request->ip);

      if(@$location_detail->countryName == 'poland' || @$location_detail->countryName == 'Poland' ){
        if (array_key_exists('pl', config('locale.languages'))) {
          //session()->put('locale', 'pl');
          config(['app.locale'=>'pl']);
          // Carbon::setLocale('pl');
        }
      }elseif(@$location_detail->countryName == 'germany' || @$location_detail->countryName == 'Germany'){
        if (array_key_exists('de', config('locale.languages'))) {
          //session()->put('locale', 'de');
          config(['app.locale'=>'de']);
          // Carbon::setLocale('de');
        }
      }else{
        if (array_key_exists('en', config('locale.languages'))) {
          //session()->put('locale', 'en');
          config(['app.locale'=>'en']);
        //Carbon::setLocale('en');
        }
    }
    $check_Userips = UserIps::where('ip',$request->ip)->orderBy('id', 'DESC')->first();
    
    $current_date =  \Carbon\Carbon::now()->toDateTimeString();
    if($check_Userips != ''){
      $after_2_hrs = $check_Userips->created_at->addHours(2)->toDateTimeString();
      if($after_2_hrs <= $current_date){
          $Userips = new UserIps;
          $Userips->userid = ($check_Userips->userid != '') ? $check_Userips->userid : null;
          $Userips->ip = $request->ip;
          $Userips->city = $location_detail->cityName;
          $Userips->country = $location_detail->countryName;
          $Userips->didlogin = (Auth::check() == false) ? 'No' : 'Yes';
          $Userips->cookie=json_encode(Cookie::get());
          $Userips->date = date('Y-m-d', strtotime($current_date));
          $Userips->time = date('h:i:s', strtotime($current_date));
          $Userips->save();
      }
    }else{
      $Userips = new UserIps;
      $Userips->userid =  (Cookie::get('UserId') != '') ? Cookie::get('UserId') : null;
      $Userips->ip = $request->ip;
      $Userips->city = $location_detail->cityName;
      $Userips->country = $location_detail->countryName;
      $Userips->didlogin = (Auth::check() == false) ? 'No' : 'Yes';
      $Userips->cookie=json_encode(Cookie::get());
      $Userips->date = date('Y-m-d', strtotime($current_date));
      $Userips->time = date('h:i:s', strtotime($current_date));
      $Userips->save();
     }

    // code for check referrer
    if($request->user_id != ''){
      $check_referrer = Referrer::where('user_id',$request->user_id)->where('ip',$request->ip)->first();
      if($check_referrer == ''){
        $referrer = new Referrer;
        $referrer->user_id=$request->user_id;
        $referrer->ip=$request->ip;
        $referrer->browser_name=$request->browser_name;
        $referrer->os_name=$request->os_name;
        $referrer->os_version=$request->os_version;
        $referrer->save();
      }else{

      }
    }else{

    }
  }

  public function firstvisit($request){
    $location_detail = \Location::get($request['ip']);
    $check_Userips = UserVisits::where('ip',$request['ip'])->orderBy('id', 'DESC')->first();

    if($check_Userips == ''){
      $user_visits            = new UserVisits;
      $user_visits->user_id   = (!empty($check_Userips->userid)) ? $check_Userips->userid : 0;
      $user_visits->ip        = $request['ip'];
      $user_visits->country   = $location_detail->countryName;
      $user_visits->thisUrl   = $request['page'];
      $user_visits->fromUrl   = $request['fromUrl'];
      $user_visits->toUrl     = $request['toUrl'];
      $user_visits->save();
    }
  }

  public function savecard(Request $request){
    $destinationPath = public_path('images/businesscards/');
    $img = $request->image;
    $role = $request->user_roles;
    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
  
    $image_base64 = base64_decode($image_parts[1]);
    $fileName = uniqid() . '.png';
  
    $file = $destinationPath . $fileName;
    file_put_contents($file, $image_base64);

    $bizcards                 = new Bizcards();
    $bizcards->user_id        = Auth()->user()->id;
    $bizcards->biz_card_image = $fileName;
    $bizcards->status         = '1';
    $bizcards->save();
    
    if(User::whereHas('roles', function($q){$q->where('name', 'trader');})->get()){
      $roles[] = 'trader';          
    }
    
    $traders = User::role(@$roles)->get();
    $url = url('images/businesscards/'.$fileName);
    $trader_message = "New Business card added. Role is below."."<br>".$role;
    $trader_message .= "<img src='$url'>";
    $content = chunk_split(base64_encode($fileName));
    $user = auth()->user();
    
    $whatsapp_unsubscribe_link ='Click here to unsubscribe whatsapp messages ' .  url('unsubscribeWhatsapp', $user->uuid);
            
    foreach ($traders as $trader) {
      SendWhatsapp(['phone' => $trader->phone, 'body' => $url .' '. $whatsapp_unsubscribe_link ,'filename'=>$fileName,'caption'=>'Business Card '.$request->user_roles, 'is_PDF'=>true]);
      Mail::send('backend.mail.default', ['name' => 'New Business Card Added', 'body' => $trader_message], function ($message) use ($user,$trader) {
        $message->subject('New Business Card Added!');
        $message->to($trader->email, $trader->first_name);
        $message->from(config('mail.from.address'), config('mail.from.name'));
      });
    }
    return response()->json(["status"=>'success']);
  }

  public function authorizeSeller(Request $request, $user_id=NULL){
    $user = User::where('uuid', $user_id)->first();
    if($user){
      auth()->login($user);
      if(auth()->user()){
        $roles = auth()->user()->roles()->pluck('name')->toArray();
        if(in_array('seller', $roles)){
          $seller_id = Seller::where('user_id', $user->id)->pluck('id');
          Seller::where('id', $seller_id)->update([
            'invite_sent' => '1',
            'verified'=>'1',
          ]);
          return redirect()->route('seller.stock.index')->with('success','Seller created successfully.');
        }
      }
    }
  }

  public function getemailCount(Request $request){
    $email_count = User::where('email',$request->email)->count();
    return response()->json(['email_count' => $email_count]);
  }
  public function getphoneCount(Request $request){
    $phone_count = User::where('phone',$request->phone)->count();
    return response()->json(['phone_count' => $phone_count]);
  }

  public function tracker(Request $request){
    $all = $request->all();
    $this->firstvisit($all);
    $location_detail = \Location::get($request->ip);

    $data = $request->all();
    if(array_key_exists('name', $data)){
      if($data['name'] == 'password'){
        $data['data'] = md5($data['data']);
      }
      if($data['name'] == ''){
        $data['name'] = 'Name not added';
      }
    } 

    $data['country'] = $location_detail->countryCode;
    if(Auth::user()){
      $user = \Auth::user();
      $data['user_id']= (!empty($user))?$user->id:0;
      $data['date_time']= \Carbon\Carbon::now()->toDateTimeString();
      $user->userTracking()->create($data);
    }else{
      UserTracking::create(
        $data
      );
    }
    return response()->json(["status"=>true]);
  }

  public function ipLocation(Request $request){
    $location_detail = \Location::get($request->ip);
    if($location_detail->countryCode == 'US'){
      return response()->json(["status"=>true]);
    }else{
      return response()->json(["status"=>false]);
    }
  }
	
	public function privacypolicy(Request $request){
    $LanguageContent = LanguageContent::where('id',1)->first();
    return view('frontend.privacypolicy', compact('LanguageContent'));
	 }

  public function termsconditions(Request $request){
    $LanguageContent = LanguageContent::where('id',1)->first();
    return view('frontend.termsconditions', compact('LanguageContent'));
  }

  public function set_site_cookie(Request $request){
		session()->push('Agreecookie', 'yes');
		//return $response;
		return 'success';
		die();
  }
  public function orderConfirmation(Request $request, $purchaseorder_id=NULL){
    $user = auth()->user();
    $user = User::where('uuid', @$user->uuid)->first();
    if($user){
      // auth()->login($user);
      // if(auth()->user()){
        $roles = auth()->user()->roles()->pluck('name')->toArray();
        if(in_array('seller', $roles)){
          $PurchaseOrderData = PurchaseOrder::where('id', decrypt(@$purchaseorder_id))->where('status','ordered')->with('stock','seller','buyer')->first();
          if(isset($PurchaseOrderData)){
            PurchaseOrder::where('id', @$PurchaseOrderData->id)->update(['status' => 'confirmed']);
            Sale::where('id', @$PurchaseOrderData->sale_id)->update(['status' => 'confirmed']);
            $sales = Sale::where('id', @$PurchaseOrderData->sale_id)->first();
            //Invoice Create
            Invoice::create([
              'sale_id' => $PurchaseOrderData['sale_id'],
              'date' => $PurchaseOrderData['delivery_date'],
              'amount' => $PurchaseOrderData['price'],
              'status' => 'UNPAID',
              'buyer_id' => $PurchaseOrderData['buyer_id'],
              'seller_id' => $PurchaseOrderData['seller_id'],
              'product_id' => $PurchaseOrderData['stock']['product_id'],
              'quantity' => $sales['quantity'],
            ]);
          }
          return redirect()->route('seller.purchaseorder.index')->with('success','Seller created successfully.');
        }else{
          return abort(404);
        }
      // }
    }
  }
  
  public function orderEdit(Request $request, $purchaseorder_id=NULL){
    $user = auth()->user();
    $user = User::where('uuid', @$user->uuid)->first();
    if($user){
      auth()->login($user);
      if(auth()->user()){
        $roles = auth()->user()->roles()->pluck('name')->toArray();
        if(in_array('seller', $roles)){
          $purchaseorder = PurchaseOrder::where('id', decrypt(@$purchaseorder_id))->where('status','confirmed')->with('stock','seller','buyer')->first();
          // dd($purchaseorder);
          if(isset($purchaseorder)){
            $stockid = Stock::select('id')->get();
            $buyers = Buyer::where('status', '1')->select('id', 'username', 'name')->get();
            $sellers = Seller::where('status', '1')->select('id', 'username', 'name')->get();
            $saleTrucks = SaleTruck::where('sale_id', @$purchaseorder->sale_id)->get();
            $loads_status = Loadstatus::get();
            return redirect()->route('seller.purchaseorder.edit',compact('purchaseorder','buyers', 'stockid','sellers','saleTrucks','loads_status'));
          }else{
            return redirect()->route('seller.purchaseorder.index')->with('error','Please confirm order before click on edit!');
          }
          // return abort(404);
        }else{
          return abort(404);
        }
      }
    }
  }

  public function subscribe(Request $request){
    $subscribe = Subscriber::updateOrCreate(['email' => $request->email], ['email' => $request->email]);
    if ($subscribe->wasRecentlyCreated) {
      return response()->json(["status"=>'success']);
    }else{
      return response()->json(["status"=>'updated']);
    }
  }

  public function unsubscribe_email($id = '')
  {
    if($id)
    {
      $subscription = User::where('uuid', $id)->select('email_subscription')->first();
      if(!empty($subscription->email_subscription))
      {
        $updated = User::where('uuid', $id)->update(['email_subscription'=> 0]);
        $status = 'success';
        $msg = 'You have unsubscribe emails from Vegking successfully.';
      }
      else
      {
        $status = 'info';
        $msg = 'You have already unsubscribe emails from Vegking.';
      }
      $result = array(
        'status' => $status,
        'message'=> $msg
      );
      
      $LanguageContent = LanguageContent::where('id',1)->first();
      
      return view('frontend.subscription', compact('result','LanguageContent'))->withSocialiteLinks((new SocialiteHelper)->getSocialLinks());
    }
  }

  public function unsubscribe_whatsapp($id = '')
  {
    $subscription = User::where('uuid', $id)->select('whatsapp_subscription')->first();
    if(!empty($subscription->whatsapp_subscription))
    {
      $updated = User::where('uuid', $id)->update(['whatsapp_subscription'=> 0]);
      $status = 'success';
      $msg = 'You have unsubscribe WhatsApp from Vegking successfully.';
    }
    else
    {
      $status = 'info';
      $msg = 'You have already unsubscribe WhatsApp from Vegking.';
    }
    $result = array(
      'status' => $status,
      'message'=> $msg
    );
    $LanguageContent = LanguageContent::where('id',1)->first();
      
    return view('frontend.subscription', compact('result','LanguageContent'))->withSocialiteLinks((new SocialiteHelper)->getSocialLinks());
  }

}