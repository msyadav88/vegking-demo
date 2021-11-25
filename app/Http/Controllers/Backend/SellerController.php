<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Buyer;
use App\Seller;
use App\AppHead;
use App\Product;
use Illuminate\Http\Request;
use App\Models\Auth\User;
use DataTables;
use Mail;
use DB;
use View;
use Illuminate\Support\Facades\Crypt;
use App\Exports\SellersExport;
use App\Exports\BuyersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\ProductSpecification;
use App\Imports\UsersImport;
use App\Imports\UsersFirstImport;
use Illuminate\Support\Facades\Validator;
use App\Events\Backend\BuyerSellerImported;
use App\Notifications;

//use App\seller;

use App\Events\Backend\SellerCreated;



class SellerController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view seller', ['only' => ['index']]);
        $this->middleware('permission:add seller', ['only' => ['create','store']]);
        $this->middleware('permission:edit seller', ['only' => ['edit','update']]);
        $this->middleware('permission:delete seller', ['only' => ['destroy']]);
        $this->middleware('permission:export sellers', ['only' => ['exports']]);
        $this->middleware('permission:import sellers', ['only' => ['import_seller']]);
    }

    public function index(Request $request){
        if ($request->ajax()) {
            $data = Seller::select('id','username','name','status','postalcode','email','country','verified','location','created_at')
            ->with(array('stocks'=>function ($query) {
                $query->select('id','seller_id')
                    ->with(array('sales'=>function ($query) {
                        $query->select('id','stock_id')
                            ->with(array('trucks'=>function ($query) {
                                $query->select('id','sale_id','truck_loads');
                            }));
                    }));
                //,'sales.trucks');
            }))
            ->where('status', '1')->get();
           // echo "<pre/>"; print_r($data); die;
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $view = View::make('backend.seller.action_button', [ 'row' => $row,
                    'seller_resend_url' => route('admin.seller.resend.invite', $row->id),
                    'seller_show_url' => route('admin.sellers.show', $row->id),
                    'seller_edit_url' => route('admin.sellers.edit', $row->id) ]);
                    $btn = $view->render();
                    return $btn;
                })
                ->addColumn('location', function($row){
                    return $data = json_decode($row->location, true);
                })
                ->addColumn('stock_count', function($row){
                    return $row->stocks->count();
                })
                ->addColumn('truck_loads_sold', function($row){
                    $load_sold = 0;
                    foreach($row->stocks as $stock){
                        foreach($stock->sales as $sale){
                            foreach($sale->trucks as $truck){
                                $load_sold += (Int)$truck->truck_load;
                            }
                        }
                    }
                    return $load_sold;
                })
                ->addColumn('tss', function($row){
                    return '-';
                })
                ->addColumn('tls28', function($row){
                    return '-';
                })
                ->addColumn('status', function($row){
                    if($row->status == '1'){
                      return 'Active';
                    }
                    else{
                      return 'Inactive';
                    }
                })
                ->rawColumns(['action', 'invite_sent','verified'])
                ->make(true);
        }
        return view('backend.seller.index');
    }

    public function create(){
       $createfrom = 'add seller';
       return view('backend.seller.create',['createfrom' => $createfrom]);
    }

    public function store(Request $request){
       if($request->city == ''){
				request()->validate([
			   'username'=>'required|unique:buyers',
			   'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
         'postalcode'=>'required|min:2|max:8',
         'city'=>'required',
			   'seller2_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
			   'transport_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
			   'accounts_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
			   ],[
            'postalcode.required' => 'The postalcode or city field is required.',
            'seller2_contact.phone.regex' => 'The Buyer 2 contact phone format is invalid.',
            'transport_contact.phone.regex' => 'The Transport contact phone format is invalid.',
            'accounts_contact.phone.regex' => 'The Accounts contact phone format is invalid.',
       ]);
		}elseif($request->postalcode == ''){
			   request()->validate([
			    'username'=>'required|unique:buyers',
			    'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
			    'city'=>'required',
          'seller2_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
          'transport_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
          'accounts_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
			 ],[
          'city.required' => 'The postalcode or city field is required.',
          'seller2_contact.phone.regex' => 'The Buyer 2 contact phone format is invalid.',
          'transport_contact.phone.regex' => 'The Transport contact phone format is invalid.',
          'accounts_contact.phone.regex' => 'The Accounts contact phone format is invalid.',
       ]);
		}elseif($request->postalcode == '' && $request->city == ''){
        $request->validate([
         'username' => 'required',
         'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
         'city'=>'required',
         'seller2_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
         'transport_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
         'accounts_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
       ],[
         'city.required' => 'The city or postalcode field is required.',
          'seller2_contact.phone.regex' => 'The Buyer 2 contact phone format is invalid.',
          'transport_contact.phone.regex' => 'The Transport contact phone format is invalid.',
          'accounts_contact.phone.regex' => 'The Accounts contact phone format is invalid.',
       ]);
      }
        $email = $request->email;
        $buyer = Buyer::where('email','LIKE',$email)->first();
        $seller = Seller::where('email','LIKE',$email)->first();
        $user = User::where('email','LIKE',$email)->first();
        if(!empty($buyer) || !empty($seller) || !empty($user)){
            $response = array("message"=>"The given data was invalid.","errors"=>array("email"=>"Email address should be unique.Email address is already used."));
            $resp = json_encode($response);
            return response($resp, 422)->header('Content-Type', 'application/json');
        }
	    $json_fields = array('seller2_contact', 'transport_contact', 'accounts_contact');
	    foreach($request->all() as $key=>$val){
        if (in_array($key, $json_fields)) {
          $tableArray[$key] = (!empty( $val ) ? json_encode( $val ) : NULL);
        }else{
          $tableArray[$key]=$val;
        }
      }

      $seller_userArray = array();
      $users = User::where('email', $request->email)->orwhere('phone', $request->phone)->first();
      if(!empty($users)){
            $user_id = $users->id;
            $seller_url = url('authorize-seller/'.$users->uuid);
  		}else{
        $seller_userArray['first_name'] = extract_name($request->username)['first_name'];
        $seller_userArray['last_name'] = extract_name($request->username)['last_name'];
        $seller_userArray['email'] = $request->email ? $request->email: str_slug($request->username, '_').'@vegking.au';
        $seller_userArray['phone'] = $request->phone;
        $seller_userArray['active'] = 1;
        $seller_userArray['confirmed'] = 1;
        $password = substr(uniqid(),0,6);
        $seller_userArray['password'] = bcrypt($password);
        //return $seller_userArray;
        $seller_user = User::create($seller_userArray);
        $seller_user->assignRole('seller');
        $user_id = $seller_user->id;
        $seller_url = url('authorize-seller/'.$seller_user->uuid);   
        $seller_user['password'] = $password;     
        $seller_user['seller_url'] = $seller_url;     

        event(new SellerCreated($seller_user));
  		}
      $tableArray['user_id'] = $user_id;
      $tableArray['contact_email']=$request->contact_email ? '1': '0';
      $tableArray['contact_sms']=$request->contact_sms ? '1': '0';
      $tableArray['contact_whatsapp']=$request->contact_whatsapp ? '1': '0';

      $seller = Seller::updateOrCreate(['user_id' => $user_id], $tableArray);

      Seller::where('id', $seller->id)->update(['invite_sent' => '1']);

      return response()->json(['status' => 'success', 'message' => 'New Seller Created!']);
    }

    public function show($id){
      $seller = Seller::where(['id' => $id])->first();
      if($seller){
         return view('backend.seller.show',compact('seller'));
       }else{
         $msg="Unfortunately this seller is not exist!";
        return view('backend.seller.index', compact('msg'));
       } 
    }

    public function edit($id){
      $seller = Seller::where(['id' => $id])->first();
      if($seller){
       $createfrom = 'edit seller';
        return view('backend.seller.create',compact('seller','createfrom'));
       }else{
        $msg="Unfortunately this seller is not exist!";
        return view('backend.seller.index',compact('msg'));
       } 
    }

    public function resendInvite(Seller $seller_id){
        $seller = $seller_id;
        $user = User::find($seller->user_id);
        $seller_url = url('authorize-seller/'.$user->uuid);
        $seller_message = "Hello ".$seller->username.",\n\n
        Welcome to VegKing Europe - an online platform.\n\n
        You can now upload any stock any time from anywhere. Just click the link below and let's do more business! \n\n"
        .$seller_url;
        $seller_message_sms = "Hi ".$seller->username.", welcome to VegKing. Click here to sell your stock: ".$seller_url;

        if($seller->email){
    				Mail::send('backend.mail.default', ['name' => $seller->first_name, 'subject' => 'Upload Stock on Veg King!', 'body' => $seller_message], function ($message) use ($seller) {
    					$message->subject('Upload Stock on Veg King!');
    					//$message->to($seller->email);
              $message->from('team@cotrader.com', 'Veg King');
              $message->to($seller->email);
    				});
        }
        if (strpos($seller->phone, '+') !== false) {
            $seller_phone = $seller->phone;
        }else{
            $seller_phone = '+'.$seller->phone;
        }
        SendSMS($seller_phone, $seller_message_sms);
        //SendWhatsapp(['phone' => $seller_phone, 'body' => $seller_message]);

        Seller::where('id', $seller->id)->update(['invite_sent' => '1']);
        return response()->json(['success'=>'Invite Link has been sent successfully.']);
    }

    public function update(Request $request, Seller $seller){
		 if($request->city == ''){
					request()->validate([
				   'username'=>'required|unique:buyers',
				   'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
           'postalcode'=>'required|min:2|max:8',
           'city'=>'required',
				   'seller2_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
				   'transport_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
				   'accounts_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
				 ],[
				 'postalcode.required' => 'The postalcode or city field is required.',
				 'seller2_contact.phone.regex' => 'The Buyer 2 contact phone format is invalid.',
				 'transport_contact.phone.regex' => 'The Transport contact phone format is invalid.',
				 'accounts_contact.phone.regex' => 'The Accounts contact phone format is invalid.',
		   ]);
			}elseif($request->postalcode == ''){
				   request()->validate([
				   'username'=>'required|unique:buyers',
           'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
           'postalcode'=>'required|min:2|max:8',
				   'city'=>'required',
				   'seller2_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
				   'transport_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
				   'accounts_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
				 ],[
				 'city.required' => 'The postalcode or city field is required.',
				 'seller2_contact.phone.regex' => 'The Buyer 2 contact phone format is invalid.',
				 'transport_contact.phone.regex' => 'The Transport contact phone format is invalid.',
				 'accounts_contact.phone.regex' => 'The Accounts contact phone format is invalid.',
		   ]);
			}elseif($request->postalcode == '' && $request->city == ''){
		   $request->validate([
			 'username' => 'required',
			 'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
			 'city'=>'required',
			 'seller2_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
			 'transport_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
			 'accounts_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
		    ],[
			 'city.required' => 'The city or postalcode field is required.',
			  'seller2_contact.phone.regex' => 'The Buyer 2 contact phone format is invalid.',
			  'transport_contact.phone.regex' => 'The Transport contact phone format is invalid.',
			  'accounts_contact.phone.regex' => 'The Accounts contact phone format is invalid.',
		   ]);
		  }
        $json_fields = array('seller2_contact', 'transport_contact', 'accounts_contact');
        foreach($request->all() as $key=>$val){
            if (in_array($key, $json_fields)) {
              $tableArray[$key] = (!empty( $val ) ? json_encode( $val ) : NULL);
            }else{
              $tableArray[$key]=$val;
            }
         }
         $tableArray['contact_email']=$request->contact_email ? '1': '0';
         $tableArray['contact_sms']=$request->contact_sms ? '1': '0';
         $tableArray['contact_whatsapp']=$request->contact_whatsapp ? '1': '0';

        if($seller->email != $request->email || $seller->phone != $request->phone){
     			User::where('email', $seller->email)->orwhere('phone', $seller->phone)->update(['email' => $request->email, 'phone' => $request->phone]);
     		}

        $seller->update($tableArray);
        return response()->json(['status' => 'success', 'message' => 'Seller updated successfully!']);
        //return redirect()->route('admin.sellers.index')->with('success','Seller created successfully.');
    }

    public function destroy(Seller $seller){
      $seller->delete();
      return response()->json(['success'=>'Seller deleted successfully.']);
    }

    public function sellerexports()
    {
        return Excel::download(new SellersExport, 'sellers.xlsx');
    }

    public function import_seller() {
       //return view('backend.seller_import');
      $products_all = Product::all();
      if( $products_all ){
        $products_all_arr = $products_all->toArray();
        //foreach ( $products_all_arr as $p_key -> $product_arr ){
        foreach ( $products_all_arr as $product_arr ){
          $product_id = $product_arr['id'];
          $product_prefs = ProductSpecification::where( [ 'product_id' => $product_id ] )->get();
          if ( $product_prefs ){
            $product_prefs_arr = $product_prefs->toArray();
          }
        } 


      }
      return view('backend.seller_import', [ 'products_all_arr' => $products_all_arr, "product_prefs_arr" => $product_prefs_arr ] );

    }

    public function seller_import_scrape(Request $request) {
        $scrape_url = 'https://www.virtualmarket.fruitlogistica.de/en/search?cmslanguage=en_GB&categories%5B30%5D%5B0%5D=26299&country%5B0%5D=593851&page=1';
        $scrape_url = $request->seller_scrape_url;

        $parser = new \App\Models\simpleHtmlDom\htmlScraper();
        $parse_user_arr = array();
        $html = $parser->file_get_html( $scrape_url );
        $class = $html->find('div[class=ngn-search-card-contenttype]');
        foreach( $class as $k => $dc ){
          $a = $dc->find('a', 0);
          if( $a ){
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

            if( is_object( $contact_cell->find('bdi[itemprop=telephone]',0) ) ){
              $parse_user_arr[$a->href]['telephone'] = trim( $contact_cell->find('bdi[itemprop=telephone]',0)->innertext ) ;
            }else{
              $parse_user_arr[$a->href]['telephone'] = trim( $contact_cell->find('bdi[itemprop=telephone]',0)->innertext ) ;
            }
            if( is_object( $contact_cell->find('bdi[itemprop=faxNumber]',0) ) ){
              $parse_user_arr[$a->href]['fax'] = trim( $contact_cell->find('bdi[itemprop=faxNumber]',0)->innertext );
            }else{
              $parse_user_arr[$a->href]['fax'] = 'NA';
            }

            $website_cell = $user_section->find("div[class=cell medium-3 ngn-element--block]",2);

            $parse_user_arr[$a->href]['website'] = $website_cell->find('a',0)->href;

            $user_contact_person_section = $user_parser->find('[class=media-object ngn-content-box]',0);

            $parse_user_arr[$a->href]['contact_person_name'] = trim(  strip_tags( $user_contact_person_section->find('bdi[itemprop=name]',0)->innertext ) );
            if( is_object( $user_contact_person_section->find('div[itemprop=jobTitle]',0) ) ){
              $parse_user_arr[$a->href]['contact_person_job_title'] = trim( strip_tags( $user_contact_person_section->find('div[itemprop=jobTitle]',0)->innertext ) );
            }else{
              $parse_user_arr[$a->href]['contact_person_job_title'] = "NA";
            }
////            $parse_user_arr[$a->href]['contact_person_email'] = $user_contact_person_section->find('a',2)->href;

          }
        }

        if( count( $parse_user_arr ) ){
          foreach( $parse_user_arr as $buyer_scrape_row ){
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

    public function storeFromArray( $buyer_row ) {
        if( !isset($buyer_row['email']) || $buyer_row['email'] =='' ){
          $buyer_row['email'] = str_replace( array(" ","+"), "", $buyer_row['phone']."@vegking.com" );

        }

        $buyer_row_ins['email'] = $buyer_row['email'];
        $buyer_row_ins['last_name'] = $buyer_row['last_name'];
        $buyer_row_ins['first_name'] = $buyer_row['first_name'];
        $buyer_row_ins['phone'] = $buyer_row['phone'];
        $buyer_row_ins['password'] = $buyer_row['password'];
        $request = new Request( $buyer_row_ins );
//        $request->setMethod('POST');


        $validator = Validator::make($request->all(), [
           'phone' => 'required|unique:users',
           'password' => 'required|min:6',
       ]);

       if ($validator->fails()) {
             $msg = $validator->messages()->first();
             $error_code = 1;
            //return redirect()->back()->withInput();
       }else{
         $tableArray['size_range'] = '{}';
         $tableArray['variety'] = NULL;
          //return $tableArray;
         $tableArray['postalcode'] = $buyer_row['postalcode'];
         $tableArray['address'] = $buyer_row['address'];
         $tableArray['country'] = $buyer_row['country'];

          $buyer_user = User::create($buyer_row);
          $buyer_user->assignRole('seller');
          $user_id  = $buyer_user->id;

          $tableArray['user_id'] = $user_id;
          $buyer = Seller::updateOrCreate(['user_id' => $user_id], $tableArray);
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
 
    if( $file_upload == '1' ){
      $product_id = $request->input('product_id');

      $file_up = $request->file('csv_file');

      if($file_up == ""){
        return response()->json( ['error' => 1, 'msg' => 'Please upload file']);
        exit;
      }
 
      $path1 = $request->file('csv_file')->store('temp'); 
      $path=storage_path('app').'/'.$path1; 
//      die();
      $product_import_arr = (new UsersFirstImport( [ "row_number" => "1" ] ) )->toArray( $path );
//      print_r( $product_import_arr );
      $product_columns_excel_arr = $product_import_arr['0']['0'];

      $product_specifications = ProductSpecification::where( [ 'product_id' => $product_id ] )->get();
      if ( $product_specifications ){
        $product_specifications_arr = $product_specifications->toArray();
      }

      $user_table = "users";
      $seller_table = "sellers";
      $users_column_arr = DB::getSchemaBuilder()->getColumnListing($user_table);
      $sellers_column_arr = DB::getSchemaBuilder()->getColumnListing($seller_table);
      $unwanted_fields = array('id','uuid', 'last_login_at','last_login_ip','to_be_logged_out','remember_token','created_at','updated_at','deleted_at','product_prefs','credit_limit','dry_matter_content','transportation','price_prefs','size_range','soil','disc_upsc','total_prefs','note','seller2_contact','transport_contact','accounts_contact','status','truck_quantity','trust_level','user_id','all_varieties','extra_transport_cost_per_ton','skin_color');

      foreach ($unwanted_fields as $value) {
        if( ($f_key = array_search( $value, $users_column_arr ) ) !== false ) { 
              unset( $users_column_arr[ $f_key ] );
        }
      }
      foreach ($unwanted_fields as $key => $value) {
        if(  ($f_key = array_search( $value, $sellers_column_arr ) ) !== false )
        {
           unset($sellers_column_arr[$f_key]);
        }
      } 

      return response()->json( ['error' => 0, 'product_columns_excel_arr' => $product_columns_excel_arr, 
        //'product_specifications_arr' => $product_specifications_arr,
        'users_column_arr' =>  $users_column_arr,
        'sellers_column_arr' => $sellers_column_arr,
        'xl_path' => $path 
      ]);
    }else{
      $product_id = $request->input('product_id');
      $update_current = $request->input('update_current')==''?0 : 1;
      $xl_path = $request->input('xl_path');
      $user_mapper = $request->input('users_table');
      $seller_mapper = $request->input('sellers_table');
      //$spec_mapper = $request->input('specification_table');
      $construct_arr = [ 'prodect_id'=>$product_id, 'user_mapper'=>$user_mapper ];
//      print_r( $construct_arr );

      $product_import_arr = (new UsersFirstImport() )->toArray( $xl_path );
//      $column_arr = $product_import_arr[0][0];



      $excel_column_arr = array();
      $excel_value_arr = array();
      foreach( $product_import_arr[0] as $excel_row_num => $excel_row_arr ){
        if( $excel_row_num == 0 ){
          $exel_column_arr = $excel_row_arr;
        }else{
          $value_arr = array();
          foreach( $exel_column_arr as $column_index => $column_name ){
            if( $column_name != null ){
              $value_arr[$column_name] = $excel_row_arr[$column_index];
            }
          }
          $excel_value_arr[ $excel_row_num ] = $value_arr;
        }
      }
      $user_table_values = array();
      $seller_table_values = array();
      $seller_pref_table_values = array();
      foreach( $excel_value_arr as $excel_row_num => $value_arr ){
        $user_table_row = array();
        $seller_table_row = array();
        $spec_table_row = array();
        foreach ($user_mapper as $user_table_field => $excel_column ){
          if( isset( $value_arr[ $excel_column ] ) ){
      //      echo "table field {$user_table_field} and excel column {$excel_column}<br />";
            $user_table_row[ $user_table_field ] = $value_arr[ $excel_column ];
          } 
        }
        foreach ($seller_mapper as $seller_table_field => $excel_column ){
          if( isset( $value_arr[ $excel_column ] ) ){
            $seller_table_row[ $seller_table_field ] = $value_arr[ $excel_column ]; 
          }
        }
       
        /*
        foreach( $spec_mapper as $spec_table_id => $excel_column  ){
          if( isset( $value_arr[ $excel_column ] ) ){
            $product_spec_value_id_obj = ProductSpecificationValue::where( [
              'product_specification_id' => $spec_table_id,
              'value' => $value_arr[ $excel_column ]
            ] )->get() ;
            if( $product_spec_value_id_obj ){
              $product_spec_value_id_arr = $product_spec_value_id_obj->toArray();
              if( is_array( $product_spec_value_id_arr ) && !empty( $product_spec_value_id_arr ) ){
                $spec_table_row[ $spec_table_id ] = $product_spec_value_id_arr['0']['id'];
              }
            }
          }
        } */
        
        $user_table_values[$excel_row_num] = $user_table_row;
        $seller_table_values[$excel_row_num] = $seller_table_row;
        //$seller_pref_table_values[$excel_row_num] = $spec_table_row;
      }
//print_r( $user_table_values );
          //$seller_spec_result = array(); 
          $record_created_result = array();
        foreach( $user_table_values as $key => $user_arr ){
          $seller_created_result = $this->process_imported_seller( [ 'user'=>$user_arr,
          'seller' => $seller_table_values[$key],
          'update_current' => $update_current, 'row_no' => $key
          ]); 
          
          $record_created_result[$key] = $seller_created_result;
          /*if( isset( $buyer_created_result['error'] ) && $buyer_created_result['error'] == 0 ){
            foreach( $buyer_pref_table_values[$key] as $bp_key => $bp_val ){
              $tableArray['product_id'] = $product_id;
              $buyer_pref = BuyerPref::updateOrCreate(['buyer_id' => $buyer_created_result[ 'buyer_id' ] ], $tableArray );
              $buyer_pref_id = $buyer_pref->id;

              $buyer_spec_result[$bp_key][$bp_key] = BuyerProductPref::create( ["product_id"=>$product_id,
                'product_specification_id' => $bp_key ,
                'product_specification_value_id' => $bp_val,
                'buyer_pref_id' => $buyer_pref_id
            ] );
              //$this->insert_buyer_spec(  );

            }
          }*/ 
        }
        

      return response()->json( [ 
        'user_table_values' => $user_table_values, 'seller_table_values' => $seller_table_values,
        //'seller_pref_table_values' => $seller_pref_table_values, 'seller_spec_result' => $seller_spec_result,
        'record_created_result' => $record_created_result
         ]);

    }
  }

    public function process_imported_seller( $seller_import_info ){
   //   print_r( $seller_import_info['user'] );
    if( $seller_import_info['update_current'] == 1 ){
        $validator = Validator::make( $seller_import_info['user'] ,[ 
                 'email'=>'required',
                 'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                 'seller2_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                 'transport_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                 'accounts_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
               ],[
                  'email.required' => 'The email is required: Row No.'.$seller_import_info['row_no'],
                  'email.required' => 'The email for users table is required: Row No.'.$seller_import_info['row_no'],
            'postalcode.required' => 'The postalcode or city field is required.: Row No.'.$seller_import_info['row_no'],
            'seller2_contact.phone.regex' => 'The seller 2 contact phone format is invalid.: Row No.'.$seller_import_info['row_no'],
            'transport_contact.phone.regex' => 'The Transport contact phone format is invalid.: Row No.'.$seller_import_info['row_no'],
            'accounts_contact.phone.regex' => 'The Accounts contact phone format is invalid.: Row No.'.$seller_import_info['row_no'],
           ] );
    }else{
        $validator = Validator::make( $seller_import_info['user'] ,[ 
                 'email'=>'required|unique:users',
                 'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                 'seller2_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                 'transport_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                 'accounts_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
               ],[
                  'email.unique' => 'The email has already be taken: Row No.'.$seller_import_info['row_no'],
                  'email.required' => 'The email for users table is required: Row No.'.$seller_import_info['row_no'],
            'postalcode.required' => 'The postalcode or city field is required.: Row No.'.$seller_import_info['row_no'],
            'seller2_contact.phone.regex' => 'The seller 2 contact phone format is invalid.: Row No.'.$seller_import_info['row_no'],
            'transport_contact.phone.regex' => 'The Transport contact phone format is invalid.: Row No.'.$seller_import_info['row_no'],
            'accounts_contact.phone.regex' => 'The Accounts contact phone format is invalid.: Row No.'.$seller_import_info['row_no'],
           ] );
    }
    
    $error_no = 0;
    if ($validator->fails()) {
        $error_no++;
        $user_err_messages = $validator->messages()->first();
    }
//echo "<hr />";    print_r( $seller_import_info['seller'] );
    if( $seller_import_info['update_current'] == 1 ){
        $validator_seller = Validator::make( $seller_import_info['seller'] , [
               'email'=>'required',
               'username'=>'required',
               'phone' => 'required'
             ],
           [
            'email.required' => 'The email for sellers table is required: Row No.'.$seller_import_info['row_no'],
            'username.required' => 'The username for sellers table is required: Row No.'.$seller_import_info['row_no'],
            'phone.required' => 'The phone for sellers table is required: Row No.'.$seller_import_info['row_no'],
             ]);
    }else{
      $validator_seller = Validator::make( $seller_import_info['seller'] , [
               'email'=>'required|unique:sellers',
               'username'=>'required|unique:sellers',
               'phone' => 'required|unique:sellers'
             ],           [
            'email.required' => 'The email for sellers table is required: Row No.'.$seller_import_info['row_no'],
            'username.required' => 'The username for sellers table is required: Row No.'.$seller_import_info['row_no'],
            'phone.required' => 'The phone for sellers table is required: Row No.'.$seller_import_info['row_no'],
             ]);
    }

    if ($validator_seller->fails()) {
      $error_no++;
      $seller_err_messages = $validator_seller->messages()->first();
    }
    $warn = 0;
    if( $error_no == 0 ){
        $seller_import_info['user']['password'] = bcrypt($seller_import_info['user']['password']);
        if( $seller_import_info['update_current'] == 1 ){
          $user = User::updateOrCreate([
           'email'=>$seller_import_info['user']['email'] ], $seller_import_info['user'] );
          $user->assignRole('seller');
        }else{
          $user = User::Create( $seller_import_info['user'] );
          $user->assignRole('seller');
        
        }
        $user_id  = $user->id;
        $seller_import_info['user']['user_id'] = $user_id;
        $seller = Seller::updateOrCreate(['user_id' => $user_id], $seller_import_info['seller']);
        $seller_url = url('authorize-seller/'.$user->uuid);
        if($seller->email){

        $locale = \App::getLocale();
        $email_content = '';
        $email_template = get_email_template('IMPORT SELLER NOTIFICATION EMAIL');
        \App\EmailTemplate::where('title', 'IMPORT SELLER NOTIFICATION EMAIL')->increment('sent');
        $team_member_name = "admin@cotrader.com";
        // dd($seller->hasRole('testuser'));
        if($email_template){

          $email_content = 'King [username] [env] [role],';
          $whatsapp_content = 'King [username] [env] [role],';
          if($seller->hasRole('testuser')){
            $msg_username = $seller->name." ".live_dev_site_status();            
          }else{
            $msg_username = $seller->name;
          }
          $msg_content = "Hi ".$msg_username.",";

          $upload_stock_link = '<a href="'.$seller_url.'">'.\Lang::get('email.upload_stock_link').'</a>';
          if($locale == 'pl'){
            $email_content .= $email_template->email_content_pl;
            $email_subject = $email_template->subject;
          }else{
            $email_content .= $email_template->email_content;
            $email_subject = $email_template->subject;
          }

          $email_content = str_replace("[env]", env('APP_ENV'), $email_content);
          $email_content = str_replace("[role]", 'seller', $email_content);
          $email_content = $msg_content.str_replace("[username]", $seller->username, $email_content);
          $email_content = str_replace("[password]", $seller_import_info['user']['password'], $email_content);
          $email_content = str_replace("[first_name]", $seller->name, $email_content);
          $email_content = str_replace("[email]", $seller->email, $email_content);
          $email_content = str_replace("[upload_stock_link]", $upload_stock_link, $email_content);
          $email_content = str_replace("[team_member_name]", $team_member_name, $email_content);
          $email_content = str_replace("[english_phone_number]", \Lang::get('inner-content.frontend.contactsec.phone-2'), $email_content);
          $email_details['content'] = $email_content;
          $email_details['subject'] = $email_subject;

          $warn = event(new BuyerSellerImported( $user, $email_details ) );

        }
/*          Mail::Mail::send('frontend.mail.registration_mail', ['user'=> get_buyer_by_user_id($seller->user_id), 
            'email_content' => $email_content,
            'subject' => $email_subject], 
            function ($message) use ($seller,$email_subject) {
            $message->subject($email_subject);
            $message->to($seller->email);
            }); 
*/
      }
        return [ 'error' => 0, 'user_id' => $user_id, 'seller_id' => $seller->id, 'email' => $seller_import_info['user']['email'], 'warn' => $warn ];

    }else{
      $error_arr[ 'error' ] = $error_no;
      if ( isset( $user_err_messages ) ){
        $error_arr['user_error'] = $user_err_messages;
      }
      if ( isset( $seller_err_messages ) ){
        $error_arr['seller_error'] = $seller_err_messages;
      }
      return $error_arr;
    }



  }

    public function editseller($seller=null)
    {
        $user_id = $seller;
      $seller = Seller::where('user_id',$seller)->first();
      $user = User::where('id',$seller)->first();
      $notify = Notifications::where('user_id', $user_id)->get()->all(); 
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
       if(isset($seller)){
        if(auth()->user()->id == $seller->user_id){
          $user = auth()->user();
          $products = Product::all()->where('status', '1')->pluck('name', 'id');
          return view('backend.auth.seller.edit',compact('products','seller','user', 'notifications'))
              ->withUser($user)
              ->withUserRoles($user->roles->pluck('name')->all())
              ->withUserPermissions($user->permissions->pluck('name')->all());
        }else{
          return abort(404);
        }
       }else{
          return abort(404);
       }
    }
    public function updateseller(Request $request, $seller=null){
      
      $seller = Seller::find($seller);
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

            $old_password_validate = User::where('id', $seller->user_id)->select('password')->get()->first(); 
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
              // 'sms_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
              // 'whatsapp_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
          ]);
        }

        if($request->sms_number!=''){
          User::where('id', $seller->user_id)->update(['sms_number' => $request->sms_number]);
        }
        if($request->whatsapp_number){
          User::where('id', $seller->user_id)->update(['whatsapp_number' => $request->whatsapp_number]);
        }
         
        if($request->phone!=''){
          User::where('id', $seller->user_id)->update(['phone' => $request->phone]);
        }
        if(extract_name($request->username)['first_name']!=''){
          $gender = isset($request->gender) && $request->gender == '1' ? '1':'0';
          User::where('id', $seller->user_id)->update(['gender' => $gender, 'first_name' =>  extract_name($request->username)['first_name']]);
        }
        if($request->sale_confirmed !=''){
            if(!empty(Notifications::where('user_id', $seller->user_id)->where('key','sale_confirmed')->get()->all())){
                $res = Notifications::where('user_id', $seller->user_id)->where('key','sale_confirmed')->update(['value'=> $request->sale_confirmed]);    
            }
            else{
                $res = Notifications::create(['user_id'=>$seller->user_id, 'key'=>'sale_confirmed', 'value'=> $request->sale_confirmed ]);
            }
        }
        if($request->delivery_update !=''){

            if(!empty(Notifications::where('user_id', $seller->user_id)->where('key','delivery_update')->get()->all())){
                $res = Notifications::where('user_id', $seller->user_id)->where('key','delivery_update')->update(['value'=> $request->delivery_update]);    
            }
            else{
              
              $res = Notifications::create(['user_id'=>$seller->user_id, 'key'=>'delivery_update', 'value'=> $request->delivery_update ]); 
            }
        }
        if($request->offers_messages !=''){
           if(!empty(Notifications::where('user_id', $seller->user_id)->where('key','offers_messages')->get()->all())){
                $res = Notifications::where('user_id', $seller->user_id)->where('key','offers_messages')->update(['value'=> $request->offers_messages]);    
            }
            else{
              $res = Notifications::create(['user_id'=>$seller->user_id, 'key'=>'offers_messages', 'value'=> $request->offers_messages ]); 
            }
        }


        User::where('id', $seller->user_id)->update(['last_name' => extract_name($request->username)['last_name']]);
        $sellerData = $request->all();
        $contact_email = isset($sellerData['contact_email']) && $sellerData['contact_email'] == '1' ? '1':'0';
        $contact_sms = isset($sellerData['contact_sms']) && $sellerData['contact_sms'] == '1' ? '1':'0';
        $contact_whatsapp = isset($sellerData['contact_whatsapp']) && $sellerData['contact_whatsapp'] == '1' ? '1':'0';
        $sellerData['contact_email'] = $contact_email;
        $sellerData['contact_sms'] = $contact_sms;
        $sellerData['contact_whatsapp'] = $contact_whatsapp;
        $sellerData['nickname'] = @$sellerData['nickname'];
        $seller->update($sellerData);

        User::where('id', $seller->user_id)->update(['email_subscription' => $contact_email, 'whatsapp_subscription' => $contact_whatsapp ]);
        
        if($change_password_flag == true){
            $res = User::where('id', $seller->user_id)->update(['password'=>\Hash::make($request->password)]);
        }

        return response()->json(['status' => 'success', 'message' => 'Seller updated successfully.']);
     }

    public function sellerSearch (Request $request)
    {
        $term = @$request->get('search');
        $sellers = Seller::select('id',DB::raw('CONCAT_WS("-",username,company,nickname) as text'))
        ->where(function ($query) use ($term){
            $query->where('username','LIKE',$term.'%')
                  ->orWhere('company','LIKE',$term.'%')
                  ->orWhere('nickname','LIKE',$term.'%');
        })
        ->limit(10)->get()->toArray();
        $result = ['result'=>$sellers,'pagination'=>['more'=>true]];
        return response()->json(@$result);
    }
    
    public function getSeller(Request $request){
        $sellerid = $request->seller_id;
        $seller = Seller::where('user_id',$sellerid)->select('postalCode','country')->first();
        if(!empty($seller)){
            $seller = (array)($seller);
        }
        return response()->json(@$seller);
    }

}


