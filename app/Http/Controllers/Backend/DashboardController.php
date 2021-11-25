<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Buyer;
use App\Sale;
use App\Seller;
use App\Stock;
use App\BuyerPref;
use App\BuyerProductPref;
use App\ProductSpecificationValue;
use App\ProductSpecification;
use App\PostalCode;
use App\Product;
use Illuminate\Http\Request;
use DB;
use App\Models\Auth\User;
use App\Events\Pushnotification;
use App\Notifications;
/**
 * Class DashboardController.
 */

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $roles = \Session::get('roles');
        $path = explode('/',$request->path());
        /*echo $roles;
        exit;*/
        /*if($roles == 'administrator' && $path[0] != 'admin'){
            return redirect('admin/dashboard');
        }elseif($roles != $path[0]){
            return redirect($roles.'/dashboard');
        }*/
        $pushtoken=$request->userId;
     
        if($pushtoken){
            $user_id=auth()->user()->id;
            $user=User::find($user_id);
            $user->push_token=$pushtoken;
            $user->save();
            $user_name=auth()->user()->first_name;
        }
        // event(new Pushnotification($trader_message="hi",auth()->user()->id,$url='',$sound=1));
        $products = Product::all()->where('status', '1')->pluck('name', 'id');
        $productBasicDetail  = get_buyer_popup_product_types();
        $productBasicDetail  = $productBasicDetail['en'];
		//echo "<pre/>"; print_r($productBasicDetail['en']['Potato']); die;
        $productspecification_list = ProductSpecification::with('options')
        ->where('parent_id',null)->whereIn('type_name',['Quality'])->get();
        $qualityGlobalArray = [];
        foreach($productspecification_list as $productspec){
           foreach($productspec->options as $productspecval){
                if($productspecval->parent_id == NULL){
                    if($productspec->tags == 'Conditional'){
                        $qualityGlobalArray[$productspec->product_id][$productspecval->related_spec_val_id][$productspecval->id]['title'] =  $productspecval->value;
                        $qualityGlobalArray[$productspec->product_id][$productspecval->related_spec_val_id][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
                        $qualityGlobalArray[$productspec->product_id][$productspecval->related_spec_val_id][$productspecval->id]['class'] =  ($productspecval->tags !='' && $productspecval->tags !=NULL ?$productspecval->tags:'Class1');
                    } else {
                        $qualityGlobalArray[$productspec->product_id][$productspecval->id]['title'] =  $productspecval->value;
                        $qualityGlobalArray[$productspec->product_id][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
                    }
                }
            }
        }
        $productByName = Product::all()->where('status', '1')->pluck('id', 'name');
        
        $ProductSpecificationConfiguration = ProductSpecification::where('parent_id',null)->get();
        $productConfiguration = array();
        foreach($ProductSpecificationConfiguration as $productConfigData)
        {
            $tags = explode(",",$productConfigData['tags']);
            if(in_array('Conditional',$tags))
            {
                $productConfiguration[@$productConfigData['product_id']][@$productConfigData['type_name']] = 'Conditional'; 
            } else {
                $productConfiguration[@$productConfigData['product_id']][@$productConfigData['type_name']] = 'all';
            }
        }
        //echo "<pre/>"; print_r($qualityGlobalArray); die;
        //echo "<pre/>"; print_r($productConfiguration);die;
        /*$potato_specs = array_keys($productConfiguration[$productByName['Potato']]);
        $onion_specs = array_keys($productConfiguration[$productByName['Onion']]);
        $carrots_specs = array_keys($productConfiguration[$productByName['Carrots']]);
        $apple_specs = array_keys($productConfiguration[$productByName['Apples']]);*/
        
       
        
        //get product image
        $productsimage = Product::select('image','id','type','name')->where('status', '1')->get();
        //echo "<pre/>"; print_r($productsimage); die;
        
		$roles = auth_roles();
    	$user_id = auth()->user()->id;
		$products = Product::where('type', 'product')->where('status', '1')->get();
		$roles = array();
		$role = \Session::get('roles');
		if(!$role){
			$roles = auth_roles();
		}else{
			$roles[] = $role;
		}
		
        if(in_array("administrator", $roles) || in_array("seller", $roles)){
              $traderid = $request->get('traderid');
            $user_id = auth()->user()->id;
            $seller = DB::table('sellers')->where('user_id',$user_id)->first();
            $seller_id = @$seller->id;
            $salesObj = DB::table('sales')
                ->select('sales.id','sales.price','sales.stock_id',DB::raw('concat(month(sales.created_at),"_",year(sales.created_at)) as my'),'stocks.product_id')
                ->join('stocks', 'stocks.id', '=', 'sales.stock_id');
                
            if( $request->has('traderid') ){
                $salesObj->where('trader_id',$traderid);
            }            
            $sales = $salesObj->get();
            $salesByProduct = array();
            $salesByPrice = array();
            foreach($sales as $sale){
                if(isset($salesByPrice[$sale->product_id][$sale->my])){
                   $salesByPrice[$sale->product_id][$sale->my] =  $salesByPrice[$sale->product_id][$sale->my] + $sale->price;
                } else {
                    $salesByPrice[$sale->product_id][$sale->my] = $sale->price;
                }
                //$salesByPrice[$sale->my][$sale->product_id][] = $sale->price;
                $salesByProduct[$sale->my] = @$salesByProduct[$sale->my] + $sale->price;
            }
            $months = array(date('n_Y')=>date('F Y'));
            $monthNames = array(date('M Y'));
            for ($i = 1; $i < 6; $i++) {
              $months[date('n_Y',strtotime("-$i month"))] = date('F Y', strtotime("-$i month"));
              $monthNames[] = date('M Y', strtotime("-$i month"));
            }
            $products = Product::all()->where('status','1')->pluck('name','id');
            $productsColors = [];
            $productsColors['Potato']='rgb(255, 99, 132)';
            $productsColors['Cauliflower']="rgb(54, 162, 235)";
            $productsColors['Onion']='rgb(75, 192, 192)';
            $productsColors['Cabbage']='rgb(54, 162, 235)';
            $productsColors['Beets']='rgb(153, 102, 255)';
            $productsColors['Broccoli']='rgb(153, 102, 255)';
            $salesByPriceArr = array();
            foreach($salesByPrice as $product_id=>$price){
                $salesByPriceArrS = array('label'=>$products[$product_id],'backgroundColor'=>$productsColors[$products[$product_id]]??'rgb(63, 63, 63)');
                foreach($months as $monthKey=>$month){
                    $salesByPriceArrS['data'][] = $price[$monthKey]??0;
                }
                $salesByPriceArr[] = $salesByPriceArrS;
            }
            $salesByPriceArrSsalesByProduct = [];
            foreach($months as $monthKey=>$month){
                
                $salesByPriceArrSsalesByProduct[$monthKey] = @$salesByProduct[$monthKey]??0;
            }
                
            $admins = User::role('administrator')->get(); 
            $traders = User::role('trader')->get();
            $tradersArr = [];
            foreach($traders as $trader){
                $tradersArr[$trader->id] = $trader->first_name." ".$trader->last_name;
            }
            foreach($admins as $admin){
                $tradersArr[$admin->id] = $admin->first_name." ".$admin->last_name;
            }
            //return view('backend.dashboard',compact('products','salesByPriceArr','monthNames','salesByPriceArrSsalesByProduct','tradersArr', 'traderid'));   
            
        }   
           
    	if(in_array("administrator", $roles)){
            
            $buyer = \App\Buyer::where('user_id', auth()->user()->id)->first();
    		return view('backend.dashboard',compact('products','buyer','productsimage','productConfiguration','qualityGlobalArray', 'productBasicDetail','salesByPriceArr','monthNames','salesByPriceArrSsalesByProduct','tradersArr', 'traderid'));
            
            
		}elseif(in_array("seller", $roles)){
		    $seller_id = Seller::select('id')->where('user_id',auth()->user()->id)->get();
			$offer_id = Stock::select('id')->whereIn('seller_id',$seller_id)->get();
			$sales_count = Sale::select('id')->whereIn('stock_id',$offer_id)->count();
            $buyer = \App\Buyer::where('user_id', auth()->user()->id)->first();
    		return view('backend.dashboard',compact('products','buyer','productsimage','productConfiguration','qualityGlobalArray', 'productBasicDetail','sales_count' ,'monthNames','salesByPriceArr','salesByPriceArrSsalesByProduct','tradersArr', 'traderid'));
		}
		elseif(in_array("buyer", $roles)){
			$buyer = \App\Buyer::where('user_id', $user_id)->first();
			if($buyer == NULL)
			{
				$msg="Unfortunately this buyer profile is not exist!";
				return view('backend.dashboard',compact('msg','products','productsimage','productConfiguration','qualityGlobalArray', 'productBasicDetail'));
			} else {
                $sales_count=sale::where('buyer_id',$buyer->id)->count();
            }
			$buyerid = $buyer->id;
	        $buyer = Buyer::where('buyers.id',$buyerid)->with('buyer_prefs','payment_details')->first();

	        $price = PostalCode::select('price')->where(DB::raw('substr(postal_code,1,2)'),substr($buyer->postalcode,0,2))->orWhere('name',$buyer->city)->first();
	        $buyerprefs = BuyerPref::where('buyer_prefs.buyer_id',$buyer->id)->get();
			$productProdRel = array();
			$productPrefRel = array();
	       
	        foreach($buyerprefs as $buyerpref){
	            $productProdRel[$buyerpref->id]['product_id'] = $buyerpref->product_id;
	            $productProdRel[$buyerpref->id]['delivery_city'] = $buyerpref->city;
	            $productProdRel[$buyerpref->id]['delivery_street'] = $buyerpref->street;
	            $productProdRel[$buyerpref->id]['delivery_postalcode'] = $buyerpref->postalcode;
	            $productProdRel[$buyerpref->id]['delivery_country'] = $buyerpref->country;
	            $buyerProductPref = $buyerpref->productPrefs()->select('buyer_pref_id','key','value','premium')->get()->toArray();
	            $productPrefsMapping = array();
	            $productPrefsMappingPremiums = array();
	            foreach($buyerProductPref as $productPref){
	              	$productPrefsMapping[$productPref['key']][] = $productPref['value'];    
	              	$productPrefsMappingPremiums[$productPref['key']][$productPref['value']] = $productPref['premium'];
	            }
	            
	            $product_list = Product::all()->where('status',1)->pluck('name','id');
	            $productspecification_list = ProductSpecification::with('options')
	            ->where('product_id',$buyerpref->product_id)->where('parent_id',null)->orderBy('importance','desc')->get();	            

	            foreach($productspecification_list as $spec){
	                $productPrefRel[$buyerpref->id][$spec->id]['name'] = $spec->display_name;
	                $productPrefRel[$buyerpref->id][$spec->id]['hasmany'] = $spec->buyer_hasmany;
	                $productPrefRel[$buyerpref->id][$spec->id]['buyer_pref_anylogic'] = $spec->buyer_pref_anylogic;
	                $productPrefRel[$buyerpref->id][$spec->id]['field_type'] = $spec->field_type;
	                if($spec->buyer_hasmany == 'Yes'){
	                    $productPrefRel[$buyerpref->id][$spec->id]['default'] = @$productPrefsMapping[$spec->id];
	                } else {
	                    $productPrefRel[$buyerpref->id][$spec->id]['default'] = current($productPrefsMapping[$spec->id]??array());
	                }
	                $productPrefRel[$buyerpref->id][$spec->id]['options'] = array();
	                foreach($spec->options as $option){
						if($spec->buyer_hasmany == 'Yes'){
							$productPrefRel[$buyerpref->id][$spec->id]['options'][$option->id]['name'] = $option->value;
							$productPrefRel[$buyerpref->id][$spec->id]['options'][$option->id]['premium'] = @$productPrefsMappingPremiums[$spec->id][$option->id];
						} else {
							$productPrefRel[$buyerpref->id][$spec->id]['options'][$option->id] = $option->value;
						}
	                }
	            }
	        }
	        $products = Product::all()->where('status', '1')->pluck('name', 'id');   
	        return view('backend.dashboard',compact('buyer','price','products','productPrefRel','productProdRel','productConfiguration','productsimage','qualityGlobalArray', 'productBasicDetail','sales_count'));
		}elseif(in_array("trader", $roles)){
			return view('backend.dashboard');
		}
	}
	
	/**
     * @return \Illuminate\View\View
     */
    public function roleChageDashboard(Request $request)
    {
		\Session::put('roles', $request->role);
    	return response()->json(['status' => 'success', 'redirect' => $request->role]);
    }

    public function getQuotes()
    {
    	$buyer = \App\Buyer::where('user_id', auth()->user()->id)->first();
    	$buyers_data = array(
    		'name' => auth()->user()->name,
    		'buyer_id' => $buyer->id,
    		'phone' => $buyer->phone
    	);    	
    	if(\Spatie\Permission\Models\Role::where('name','trader')->exists()){
            $roles[] = 'trader';
        }
        if(\Spatie\Permission\Models\Role::where('name','trader admin')->exists()){
            $roles[] = 'trader admin';
        }
		$users = \App\Models\Auth\User::role(@$roles)->get();
    	foreach(@$users as $user){
            if($user->email_subscription){
            \to($user->email, $user->first_name.' '.$user->last_name)->send(new \App\Mail\Buyer\GetQuotes($user,$buyers_data));    
            }
         	
         	$locale = \App::getLocale();
  			$email_content = '';
      		$email_template = get_email_template('GET QUOTES');
		 	\App\EmailTemplate::where('title', 'GET QUOTES')->increment('sent');
         	if($email_template){
				if($user->hasRole('testuser')){
				$msg_username = $user->name." ".live_dev_site_status();            
				}else{
				$msg_username = $user->name;
				}

                $whatsapp_unsubscribe_link ='Click here to unsubscribe whatsapp messages ' .  url('unsubscribeWhatsapp', $user->uuid);
                

                $email_content = 'King [username] [env] [role],';
			    $whatsapp_content = 'King [username] [env] [role],';
				if($locale == 'pl'){
					$email_content .= $email_template->sms_content_pl;
				}else{
					$email_content .= $email_template->sms_content;
                }
                $email_content = str_replace("[env]", env('APP_ENV'), $email_content);
			    $email_content = str_replace("[role]", 'buyer', $email_content);
				$email_content = str_replace("[team_member_name]", $user->name, $email_content);
				$email_content = str_replace("[name]", auth()->user()->name, $email_content);
				$email_content = str_replace("[phone]", (substr(trim($buyer->phone),0,1) != '+' ? '+' : '').$buyer->phone, $email_content);
				$email_content = str_replace("[view_buyer_link]", route('admin.buyers.show',$buyer->id), $email_content); 
                
                $email_content = str_replace("[unsubscribe]", $whatsapp_unsubscribe_link, $email_content); 
                if(isset($user->whatsapp_subscription)){
                        SendWhatsapp(['phone' => (!empty(@$user->whatsapp_number)?$user->whatsapp_number:@$user->phone), 'body' => $email_content,'is_PDF'=>false]);  
                }   

				SendSMS(@$user->sms_number,$email_content);
			}
     	}
     	return redirect()->back()->with('success', 'Thank you, Our Sales team will reach you shortly.');
	}


	
}