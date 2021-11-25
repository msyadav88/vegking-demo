<?php

  if (! function_exists('camelcase_to_word')) 
  {
    /**
     * @param $str
     *
     * @return string
     */
    function camelcase_to_word($str)
    {
      return implode(' ', preg_split('/
        (?<=[a-z])
        (?=[A-Z])
      | (?<=[A-Z])
        (?=[A-Z][a-z])
      /x', $str));
    }
  }

  if (! function_exists('SendWhatsapp')) 
  {
    function SendWhatsapp($data)
    {
      $json = json_encode($data);
      $config = config('services.chatapi');
      if(isset($data['is_PDF']) && $data['is_PDF']==true)
      {
        $url = $config['api_url']."sendFile";
      }
      else
      {
        $url = $config['api_url']."sendMessage";;
      }
      $url = $url.'?token='.$config['token'];
      $options = stream_context_create(['http' => [
          'method'  => 'POST',
          'header'  => 'Content-type: application/json',
          'content' => $json
        ]
      ]);
      return @file_get_contents($url, false, $options);
    }
  }

  if (! function_exists('SendSMS')) 
  {
    function SendSMS($to, $message)
    {
      $to = str_replace("+", "", trim($to));
      $client = new \GuzzleHttp\Client();
      $res = $client->request('POST', 'https://api.smsglobal.com/http-api.php', [
        'form_params' => [
          'action' => 'sendsms',
          'user' => env('SMS_GLOBAL_USER'),
          'password' => env('SMS_GLOBAL_PASSWORD'),
          'from' => app_name(),
          'to' => $to,
          'text' => $message
        ]
      ]);
      return $res;
    }
  }

  if (! function_exists('currency')) 
  {
    function currency($price=0)
    {
      $price = Settings()->currency.number_format($price, '2');
      return $price;
    }
  }
  
  if (! function_exists('getDistance')) 
  {
    function getDistance($origin , $destination)
    {
      $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".urlencode($origin)."&destinations=".urlencode($destination)."&mode=bicycling&language=en-EN&key=".env('GOOGLE_KEY');
      $result_string = file_get_contents($url);
      $results = json_decode($result_string);
      if(!empty($results->destination_addresses[0]) && !empty($results->origin_addresses[0]) && $results->status != 'REQUEST_DENIED' )
      {
        $result['destination'] = $results->destination_addresses[0];
        $result['origin'] = $results->origin_addresses[0];
        $result['durations'] = $results->rows[0]->elements[0]->duration->text;
        $result['distance'] = $results->rows[0]->elements[0]->distance->text;
        return $result;
      }
      else
      {
        $result['destination'] = 'N/A';
        $result['origin'] = 'N/A';
        $result['durations'] = 'N/A';
        $result['distance'] = '0';
        return $result;
      }
    }
  }

  if (! function_exists('products_list')) 
  {
    function products_list()
    {
      $lang = \App::getLocale();
      if($lang == 'pl')
      {
        $products = \App\Product::where('status', '1')->orderBy('name_pl', 'asc')->pluck('name_pl', 'id')->toArray();
      }
      else
      {
        $products = \App\Product::where('status', '1')->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
      }
      return $products;
    }
  }

  if (! function_exists('get_user_stock')) 
  {
    function get_user_stock()
    {
      if(get_buyer_by_user_id() == Null)
      {
        return 0;
      }
      $seller_id =  get_buyer_by_user_id()->id;
      $stock = \App\Stock::orderBy('id','asc')->where('seller_id', $seller_id)->get();
      return count($stock);
    }
  }

  if (! function_exists('get_user_deliveris')) 
  {
    function get_user_deliveris()
    {
      $seller_id = \App\Seller::select('id')->where('user_id',auth()->user()->id)->get();
      $offer_id = \App\Stock::select('id')->whereIn('seller_id',$seller_id)->get();
      $sale_id = \App\Sale::select('id')->whereIn('stock_id',$offer_id)->get();
      
      $delivery = \App\TransLoad::with('product','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->whereIn('salesid',$sale_id)->get();
      return count($delivery);
    }
  }

  if (! function_exists('get_user_buyer_deliveris')) 
  {
    function get_user_buyer_deliveris()
    {
      $buyer_id = \App\Buyer::where('user_id',auth()->user()->id)->get(); 
      $sale_id = \App\Sale::select('id')->whereIn('buyer_id',$buyer_id)->get();
      $buyerdelivery = \App\TransLoad::with('product','transportdata','trucks','sellerget','buyerget')->select('id','salesid','packaging_type','number_of_packing_units','transport_id','goods','customername','variety','size_from','size_to','loaded_weight','unloaded_weight','difference','freight_cost','payment_status','created_at')->whereIn('salesid',$sale_id)->get();
      return count($buyerdelivery);
    }
  }

  if (! function_exists('get_seller_account')) 
  {
    function get_seller_account()
    {
      $seller_id = get_buyer_by_user_id()['id'];
      $invoice = \App\Invoice::with('product','seller', 'buyer')->where('seller_id', $seller_id)->get();
      return count($invoice);
    }
  }

  if (! function_exists('variety_list')) 
  {
    function variety_list()
    {
      $variety = \App\AppHead::orderBy('order','asc')->where('is_active', '1')->where('type', 'potato_variety')->pluck('name', 'id');
      return $variety;
    }
  }

  if (! function_exists('color_list')) 
  {
    function color_list($onlyChild = false)
    {
      if($onlyChild == true)
      {
        $type = 'flesh_color';
        $colors = \App\AppHead::with('children')->select('name','id','parent_ref')
          ->where('is_active', '1')
          ->where('type', $type)
          ->where('parent_ref',null)
          ->orderBy('order','asc')->get();
        $color = array();
        foreach($colors as $colorItem)
        {
          $explodename = explode(':',$colorItem->name);
          if(end($explodename) != 'AnyLogic' && count($colorItem->children) == 0)
          {
            $color[$colorItem->id] = $colorItem->name;
          } 
          else if(count($colorItem->children) > 0)
          {
            foreach($colorItem->children as $childColor)
            {
              $color[$childColor->id] = $childColor->name;
            }
          }
        }
      } 
      else 
      {
        $color = \App\AppHead::orderBy('order','asc')->where('is_active', '1')->where('type', 'flesh_color')->pluck('name', 'id');
      }
      return $color;
    }
  }

  if (! function_exists('packaging_list')) 
  {
    function packaging_list()
    {
      $packaging = \App\AppHead::orderBy('order','asc')->where('is_active', '1')->where('type', 'packaging')->pluck('name', 'id');
      return $packaging;
    }
  }

  if (! function_exists('purpose_list')) 
  {
    function purpose_list()
    {
      $purpose = \App\AppHead::orderBy('order','asc')->where('is_active', '1')->where('type', 'purpose')->pluck('name','id');
      return $purpose;
    }
  }

  if (! function_exists('head_default')) 
  {
    function head_default($head='soil')
    {
      $anyField = \App\AppHead::select('name','id','default')->where('is_active', '1')->where('default', '1')->where('type', $head)->where('name', 'LIKE','%:AnyLogic')->first();
      if(@$anyField->default == 1)
      {
        $defaults = \App\AppHead::all()->where('is_active', '1')->where('type', $head)->pluck('name')->toArray();
      } 
      else 
      {
        $defaults = \App\AppHead::all()->where('is_active', '1')->where('default', '1')->where('type', $head)->pluck('name')->toArray();
      }
      $def = array();
      foreach($defaults as $default)
      {
        $def[] = str_slug($default, '_');
      }
      return $def;
    }
  }

  if (! function_exists('head_default_keys')) 
  {
    function head_default_keys($head='soil')
    {
      $anyField = \App\AppHead::select('name','id','default')->where('is_active', '1')->where('default', '1')->where('type', $head)->where('name', 'LIKE','%:AnyLogic')->first();
      if(@$anyField->default == 1)
      {
        $defaults = \App\AppHead::all()->where('is_active', '1')->where('type', $head)->pluck('id')->toArray();
      } 
      else 
      {
        $defaults = \App\AppHead::all()->where('is_active', '1')->where('default', '1')->where('type', $head)->pluck('id')->toArray();
      }
      $def = array();
      foreach($defaults as $default)
      {
        $def[] = str_slug($default, '_');
      }
      return $def;
    }
  }

  if (! function_exists('soil_list')) 
  {
    function soil_list()
    {
      $purpose = \App\AppHead::orderBy('order','asc')->where('is_active', '1')->where('type', 'soil')->pluck('name', 'id');
      return $purpose;
    }
  }

  if (! function_exists('soil_list_without_anylogic')) 
  {
    function soil_list_without_anylogic()
    {
      $purpose = \App\AppHead::orderBy('order','asc')->where('name','NOT LIKE', '%:AnyLogic')->where('is_active', '1')->where('type', 'soil')->pluck('name', 'id');
      return $purpose;
    }
  }

  if (! function_exists('defects_list')) 
  {
    function defects_list()
    {
      $defects = \App\AppHead::orderBy('order','asc')->where('is_active', '1')->where('type', 'defects')->pluck('name', 'id');
      return $defects;
    }
  }

  if (! function_exists('sellers_list')) 
  {
    function sellers_list()
    {
      $sellers = \App\Seller::where('status', '1')->select('id', 'username', 'name')->get();
      return $sellers;
    }
  }

  if (! function_exists('buyers_list')) 
  {
    function buyers_list()
    {
      $buyers = \App\Buyer::where('status', '1')->select('id', 'username', 'name')->get();
      return $buyers;
    }
  }

  if (! function_exists('country_list')) 
  {
    function country_list()
    {
      $countries = \App\PostalCode::all()->where('status', '1')->where('type', 'country')->pluck('name', 'code');
      return $countries;
    }
  }

  if (! function_exists('country_with_ext_list')) 
  {
    function country_with_ext_list()
    {
      $country_codes = \App\PostalCode::all()->where('status', '1')->where('type', 'country')->pluck('code','ph_code');
      return $country_codes;
    }
  }

  if (! function_exists('get_all_product_name')) 
  {
    function get_all_product_name()
    {
      $products = \App\Product::where('type', 'product')->where('status', '1')->pluck('name');
      return $products;
    }
  }

  if (! function_exists('country_with_code_list')) 
  {
    function country_with_code_list()
    {
      $country_codes = \App\PostalCode::all()->where('status', '1')->where('type', 'country')->pluck('name','ph_code');
      return $country_codes;
    }
  }

  if (! function_exists('city_list')) 
  {
    function city_list()
    {
      $cities = \App\PostalCode::all()->where('status', '1')->where('type', 'city')->pluck('name', 'name');
      return $cities;
    }
  }

  if (! function_exists('postcode_list')) 
  {
    function postcode_list()
    {
      $cities = \App\PostalCode::all()->where('status', '1')->where('type', 'city')->pluck('postal_code', 'postal_code');
      return $cities;
    }
  }

  if (! function_exists('Settings')) 
  {
    $locator = session()->get('locale');
    function Settings()
    {
      $locator = session()->get('locale');
      $id = 'pl';
      if($locator == 'en')
      {
        $id = 'en';
      }
      elseif($locator == 'pl')
      {
        $id = 'pl';
      }
      elseif($locator == 'de')
      {
        $id = 'de';
      }
      $settings = \App\Setting::where('site_lang',$id)->first();
      return $settings;
    }
  }

  if (! function_exists('extract_name')) 
  {
    function extract_name($name=null) 
    {
      if(empty($name))
      {
        $name = Auth::user()->name;
      }
      $names = explode( ' ', $name, 2 );
      $fullname = array();
      if(isset($names[0]))
      {
        $fullname['first_name'] = $names[0];
      }
      else
      {
        $fullname['first_name'] = '';
      }

      if(isset($names[1]))
      {
        $fullname['last_name'] = $names[1];
      }
      else
      {
        $fullname['last_name'] = '';
      }
      return $fullname;
    }
  }

  if (! function_exists('auth_roles')) 
  {
    function auth_roles() 
    {
      if(\Auth::check())
      {
        $roles = auth()->user()->roles()->pluck('name')->toArray();
        return $roles;
      }
      else
      {
        return array();
      }
    }
  }

  if (! function_exists('get_buyer_by_user_id')) 
  {
    function get_buyer_by_user_id($user_id = NULL) 
    {
      if(empty($user_id))
      {
        $user_id = auth()->user()->id;
      }
      $sellers = \App\Seller::where('user_id', $user_id)->first();
      return @$sellers;
    }
  }

  if (! function_exists('get_buyers_by_user_id')) 
  {
    function get_buyers_by_user_id($user_id = NULL) 
    {
      if(empty($user_id))
      {
        $user_id = auth()->user()->id;
      }
      $buyer = \App\Buyer::where('user_id', $user_id)->first();
      return @$buyer;
    }
  }

  if (! function_exists('trustlevel_list')) 
  {
    function trustlevel_list()
    {
      $res = \App\AppHead::where('is_active', '1')->where('type', 'trust_level')->select('name', 'id','desc')->get();
      return $res;
    }
  }

  if (! function_exists('app_heads_relation')) 
  {
    function app_heads_relation($type='',$product_id='')
    {
      $appHeads = \App\AppHead::with('children')->select('name','id','parent_ref')->where('is_active', '1')->where('type', $type)->where('parent_ref',null);
      if($product_id != '')
      {
        $appHeads = $appHeads->where('product_id',$product_id);
      }
      $appHeads = $appHeads->orderBy('order','asc')->get();
      return $appHeads;
    }
  }

  if(! function_exists('payment_type_list')) 
  {
    function payment_type_list() 
    {
      $res = \App\AppHead::all()->where('is_active', '1')->where('type', 'payment_type')->pluck('name', 'id');
      return $res;
    }
  }

  if (! function_exists('currency_list')) 
  {
    function currency_list() 
    {
      $currency = \App\AppHead::all()->where('is_active', '1')->where('type', 'currency')->pluck('name', 'id');
      return $currency;
    }
  }

  if (! function_exists('payment_terms_list')) 
  {
    function payment_terms_list() 
    {
      $res = \App\AppHead::all()->where('is_active', '1')->where('type', 'payment_terms')->pluck('name', 'id');
      return $res;
    }
  }

  if (! function_exists('fields_list')) 
  {
    function fields_list() 
    {
      $types = array(""=>"Select Field","potato_variety" => "Potato Variety","packaging" => "Packaging","purpose" => "Purpose","defects" => "Defects","flesh_color" => "Flesh color","soil" => "Soil");
      return $types;
    }
  }

  if (! function_exists('stock_status_list')) 
  {
    function stock_status_list() 
    {
      $res = array('unavailable' => 'Unavailable','available' => 'Available','upcoming_stock' => "Upcoming Stock");
      return $res;
    }
  }

  if (! function_exists('load_status_list')) 
  {
    function load_status_list() 
    {
      $res = array('ready_for_collection' => 'Ready for Collection','unplanned' => 'Unplanned','planned' => "Planned",'loaded' => 'Loaded','unloaded' => 'Unloaded','in_store' => 'In Store','rejected' => 'Rejected' , 'other' => 'Other');
      return $res;
    }
  }

  if (! function_exists('getAutoVersion')) 
  {
    function getAutoVersion($file)
    {
      $filePath =  public_path() . DS . $file;
      if (!file_exists($filePath)) 
      {
        return '';
      }
      $version = filemtime($filePath);
      return '?v=' . $version;
    }
  }

  if (! function_exists('getCurrencyRate')) 
  {
    function getCurrencyRate($from, $to)
    {
      $rate = \App\CurrencyRate::where('from',$from)->where('to',$to)->first();
      // echo '*'.$rate->rate;exit;
      // print_r($rate->toArray());exit;
      // $return = $value * $rate->rate;
      return (@$rate->rate ? $rate->rate : 0);
    }
  }

  if (! function_exists('getTransportCharges')) 
  {
    function getTransportCharges($from, $to)
    {
      //DB::enableQueryLog();
      $rate = \App\TransportCosts::where('country',$from)->where('region',$to)->first();
      //dd(DB::getQueryLog());
      return (@$rate->cost ? $rate->cost : 0);
    }
  }

  if (! function_exists('getproductIdbyName')) 
  {
    function getproductIdbyName($name)
    {
      $product = \App\Product::where('name',$name)->value('id');
      // echo '*'.$rate->rate;exit;
      // print_r($rate->toArray());exit;
      // $return = $value * $rate->rate;
      return $product;
    }
  }

  if (! function_exists('get_email_template')) 
  {
    function get_email_template($title = NULL) 
    {
      $template = \App\EmailTemplate::where('title', $title)->first();
      return $template;
    }
  }


  if (! function_exists('get_email_header')) 
  {
    function get_email_header() 
    {
      $headerFooter = \App\EmailTemplateHeaderFooter::where('id', 1)->where('status', 1)->first();
      return $headerFooter;
    }
  }

  if (! function_exists('getHeaderFooter')) 
  {
    function getHeaderFooter($id, $locale) 
    {
      $email_template = \App\EmailTemplate::where('id', $id)->first();
      $globalHeader = \App\EmailTemplateHeaderFooter::where('id', 1)->where('status', 1)->first();
      if($email_template->global_header)
      {
        if($locale == 'de')
        {
          $content['header'] = $email_template->header_de;
          $content['footer'] = $email_template->footer_de;
        }
        elseif($locale == 'pl')
        {
          $content['header'] = $email_template->header_pl;
          $content['footer'] = $email_template->footer_pl;
        }
        else
        {
          $content['header'] = $email_template->header_en;
          $content['footer'] = $email_template->footer_en;
        }
      }
      else
      {
        $content['header'] = '';
        $content['footer'] = '';
        if(!empty($globalHeader))
        {
          if($locale == 'de')
          {
            $content['header'] = $globalHeader->header_de;
            $content['footer'] = $globalHeader->footer_de;
          }
          elseif($locale == 'pl')
          {
            $content['header'] = $globalHeader->header_pl;
            $content['footer'] = $globalHeader->footer_pl;
          }
          else
          {
            $content['header'] = $globalHeader->header_en;
            $content['footer'] = $globalHeader->footer_en;
          }
        }
      }
      return $content;
    }
  }

  if (! function_exists('get_buyer_popup_product_types')) {
    function get_buyer_popup_product_types() {
      $locale = App::getLocale();
        //if($locale == 'pl'){
      $productTypeManualData['pl']  = array('Ziemniaki'=>
                                      array('type'=>'Purpose',
                                          'values'=>array(array('name'=>'Jadalne','image'=>'potato_table.jpeg'),array('name'=>'Chipsowe','image'=>'potato_crisping.jpeg'),array('name'=>'Frytkowe','image'=>'potato_chipping.jpeg'),array('name'=>'Sadzeniaki','image'=>'potato_seed.jpeg'))
                                      ),'Kalafior'=>
                                      array('type'=>'Num of Heads',
                                          'values'=>array(array('name'=>'szóstka','image'=>'cauliflower_6heads.png'),array('name'=>'ósemka','image'=>'cauliflower_8heads.png'))
                                      ),'Cebula'=>
                                      array('type'=>'Color',
                                          'values'=>array(array('name'=>'Czerwona','image'=>'onion_red.jpeg'),array('name'=>'Żółta','image'=>'onion_yellow.jpeg'))
                                      ),'Kapusta'=>
                                      array('type'=>'Color',
                                          'values'=>array(array('name'=>'Biała','image'=>'cabbage_white.jpeg'),array('name'=>'Czerwona','image'=>'cabbage_red.jpeg'))
                                      ),'Jablka'=>
                                      array('type'=>'Variety',
                                        'values'=>array(array('name' =>'Gala Królewska','image'=>'gala_royal.jpeg'))
                                      ),'Buraki'=>'Beets','Broccoli'=>'Broccoli'
                                  );
      //}elseif($locale == 'de'){
      $productTypeManualData['de']  = array('Kartoffeln'=>
                                    array('type'=>'Purpose',
                                        'values'=>array(array('name'=>'Peisekartoffeln','image'=>'potato_table.jpeg'),array('name'=>'Pommes frites','image'=>'potato_crisping.jpeg'),array('name'=>'Chips','image'=>'potato_chipping.jpeg'),array('name'=>'Pflanzkartoffeln','image'=>'potato_seed.jpeg'))
                                    ),'Blumenkohl'=>
                                    array('type'=>'Num of Heads',
                                        'values'=>array(array('name'=>'6 Stück','image'=>'cauliflower_6heads.png'),array('name'=>' Stück','image'=>'cauliflower_8heads.png'))
                                    ),'Zwiebel'=>
                                    array('type'=>'Color',
                                        'values'=>array(array('name'=>'rote Zwiebel','image'=>'onion_red.jpeg'),array('name'=>'gelbe Zwiebel','image'=>'onion_yellow.jpeg'))
                                    ),'Kohl'=>
                                    array('type'=>'Color',
                                        'values'=>array(array('name'=>'Weißkohl','image'=>'cabbage_white.jpeg'),array('name'=>'Rotkohl','image'=>'cabbage_red.jpeg'))
                                    ),'Apfel'=>
                                    array('type'=>'Variety',
                                      'values'=>array(array('name' =>'Gala Royal','image'=>'gala_royal.jpeg'))
                                    ),'Rote Bete'=>'Beets','Broccoli'=>'Broccoli'
                                );
      //}else{
      $productTypeManualData['en']  = array('Potato'=>
                                      array('type'=>'Purpose',
                                          'values'=>array(array('name'=>'Table','image'=>'potato_table.jpeg'),array('name'=>'Crisping','image'=>'potato_crisping.jpeg'),array('name'=>'Chipping','image'=>'potato_chipping.jpeg'),array('name'=>'Seed','image'=>'potato_seed.jpeg'))
                                      ),'Cauliflower'=>
                                      array('type'=>'Num of Heads',
                                          'values'=>array(array('name'=>'6 heads','image'=>'cauliflower_6heads.png'),array('name'=>'8 heads','image'=>'cauliflower_8heads.png'))
                                      ),'Onion'=>
                                      array('type'=>'Color',
                                          'values'=>array(array('name'=>'Red','image'=>'onion_red.jpeg'),array('name'=>'Yellow','image'=>'onion_yellow.jpeg'))
                                      ),'Cabbage'=>
                                      array('type'=>'Color',
                                          'values'=>array(array('name'=>'White','image'=>'cabbage_white.jpeg'),array('name'=>'Red','image'=>'cabbage_red.jpeg'))
                                      ),'Apples'=>
                                      array('type'=>'Variety',
                                          'values'=>array(array('name' =>'Gala Royal','image'=>'gala_royal.jpeg'))
                                      ),'Beets'=>'Beets','Broccoli'=>'Broccoli'
                                  );
      //}
      return $productTypeManualData;
    }
  }

  if (! function_exists('get_products')) 
  {
    function get_products()
    {
      $locale = App::getLocale();
      if($locale == 'pl')
      {
        $products = App\Product::select('id','name_pl as name','status','created_at','updated_at','image','homepage_image')->where('type', 'product')->where('status', '1')->get();
      }
      elseif($locale == 'de')
      {
        $products = App\Product::select('id','name_de as name','status','created_at','updated_at','image','homepage_image')->where('type', 'product')->where('status', '1')->get();
      }
      else
      {
        $products = App\Product::select('id','name','status','created_at','updated_at','image','homepage_image')->where('type', 'product')->where('status', '1')->get();
      }
      return $products;
    }
  }

  if (! function_exists('get_lang_from_product')) 
  {
    function get_lang_from_product($product, $productTypeManualData = null)
    {
      if($productTypeManualData == null)
      {
        $productTypeManualData = get_buyer_popup_product_types();   
      }

      if(isset($productTypeManualData['en'][ucfirst($product)]))
      {
        $lang = 'en';
      }
      elseif(isset($productTypeManualData['pl'][ucfirst($product)]))
      {
        $lang = 'pl';
      }
      elseif(isset($productTypeManualData['de'][ucfirst($product)]))
      {
        $lang = 'de';
      }
      return @$lang;
    }
  }

  if (! function_exists('get_country_code_dropdown')) 
  {
    function get_country_code_dropdown($defaultCountry = "")
    {
      $countries = \App\PostalCode::where('status', '1')->where('type', 'country')->get();
      $output = '';
      foreach($countries as $country)
      {
        $countryName = ucwords(strtolower($country->name));
        $ph_code = $country->ph_code;
        $code = $country->code;
        $output .= "<option value='".$ph_code."' ".(($code==strtoupper($defaultCountry))?"selected":"").">".$code." - ".$countryName." (+".$ph_code.")</option>";
      }
      return $output;
    }
  }

  if (! function_exists('get_country_short_code_dropdown')) 
  {
    function get_country_short_code_dropdown($defaultCountry = "")
    {
      $countries = \App\PostalCode::where('status', '1')->where('type', 'country')->get();
      $output = '';
      foreach($countries as $country)
      {
        $countryName = ucwords(strtolower($country->name));
        $code = $country->code;
        $output .= "<option value='".$code."' ".(($code==strtoupper($defaultCountry))?"selected":"").">$countryName</option>";
      }
      return $output;
    }
  }

  if (! function_exists('get_string_between')) 
  {
    function get_string_between($string, $start, $end)
    {
      $string = ' ' . $string;
      $ini = strpos($string, $start);
      if ($ini == 0) return '';
      $ini += strlen($start);
      $len = strpos($string, $end, $ini) - $ini;
      return substr($string, $ini, $len);
    }
  }

  if (! function_exists('get_order_count_for_seller')) 
  {
    function get_order_count_for_seller()
    {
      $seller_id = App\Seller::select('id')->where('user_id',auth()->user()->id)->get();
			$offer_id = App\Stock::select('id')->whereIn('seller_id',$seller_id)->get();
			$sales_count = App\Sale::select('id')->whereIn('stock_id',$offer_id)->count();
      return $sales_count;
    }
  }
  
  if (! function_exists('get_product_configuration')) 
  {
    function get_product_configuration()
    {
      $ProductSpecificationConfiguration = App\ProductSpecification::where('parent_id',null)->get();
      $productConfiguration = array();
      foreach($ProductSpecificationConfiguration as $productConfigData)
      {
        $tags = explode(",",$productConfigData['tags']);
        if(in_array('Conditional',$tags))
        {
          $productConfiguration[@$productConfigData['product_id']][@$productConfigData['type_name']] = 'Conditional'; 
        } 
        else 
        {
          $productConfiguration[@$productConfigData['product_id']][@$productConfigData['type_name']] = 'all';
        }
      }
      return $productConfiguration;
    }
  }
  
  if (! function_exists('get_quality_global_array')) 
  {
    function get_quality_global_array()
    {
      $productspecification_list = App\ProductSpecification::with('options')
        ->where('parent_id',null)->whereIn('type_name',['Quality'])->get();
        $qualityGlobalArray = [];
      foreach($productspecification_list as $productspec)
      {        
        foreach($productspec->options as $productspecval)
        {
          if($productspecval->parent_id == NULL)
          {
            if($productspec->tags == 'Conditional')
            {
              $qualityGlobalArray[$productspec->product_id][$productspecval->related_spec_val_id][$productspecval->id]['title'] =  $productspecval->value;
              $qualityGlobalArray[$productspec->product_id][$productspecval->related_spec_val_id][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
              $qualityGlobalArray[$productspec->product_id][$productspecval->related_spec_val_id][$productspecval->id]['class'] =  ($productspecval->tags !='' && $productspecval->tags !=NULL ?$productspecval->tags:'Class1');
            } 
            else 
            {
              $qualityGlobalArray[$productspec->product_id][$productspecval->id]['title'] =  $productspecval->value;
              $qualityGlobalArray[$productspec->product_id][$productspecval->id]['image'] =  ($productspecval->image !=''?$productspecval->image:'no_img.png');
            }
          }
        }
      }
      return $qualityGlobalArray;
    }
  }
  
  if(! function_exists('chanel_confirmation'))
  {
    function chanel_confirmation($confirmation)
    {
      if($confirmation == 'email-confirmed')
      {
        $res = Auth()->user()->confirmed;
        return $res;
      }
    }
  }
  if (! function_exists('get_next_date')) {
    function get_next_date($user_id, $message_type) {
      $offer_sent_notification= App\Notifications::where('user_id', $user_id)->where('key',$message_type)->first();
      if($offer_sent_notification)
        {
           $next_date=$offer_sent_notification->next_date;
           return $next_date; 
        }else{
          return NULL;
        }
       
    }
}
if (! function_exists('get_digest_value')) {
  function get_digest_value($user_id, $message_type) {
    $offer_sent_notification= App\Notifications::where('user_id', $user_id)->where('key',$message_type)->first();
    if($offer_sent_notification)
      {
         $next_date=$offer_sent_notification->value;
         return $next_date; 
      }else{
        return NULL;
      }
     
  }
}
if (! function_exists('update_next_date')) {
  function  update_next_date($user_id, $message_type,$next_date) {
    $offer_sent_notification= App\Notifications::where('user_id', $user_id)->where('key',$message_type)->first();
  
    if($offer_sent_notification)
      {
         $value=$offer_sent_notification->value;
         $next_finaldate=date('Y-m-d', strtotime($next_date. ' + '.$value.' days'));
         App\Notifications::where('user_id', $user_id)->where('key',$message_type)->update(['next_date'=> $next_finaldate]); 
         return $next_date; 
      }else{
        return NULL;
      }
     
  }
}