<?php

namespace App\Imports;

use App\Buyer;
use App\BuyerPref;
use App\BuyerProductPref;
use App\ProductSpecification;
use App\ProductSpecificationValue;
use App\Models\Auth\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Http\Request;

class UsersImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $_product_id;
    public function __construct( $product_id = 0 ){
      $this->_product_id = $product_id;
    }
    public function collection(Collection $rows)
    {
return $rows[0] ;
//die();
//        return array ([0]);

       $product_id = $this->_product_id;//$request->input('product_id'); 
       $user =  [
            'first_name'    => $row[0],
            'last_name'     => $row[1],
            'email'         => $row[3],
            'phone'         => $row[4],
            'password'      => $row[5]
        ];

        $request = new Request( $user );
        $request->validate([
               'email'=>'required|unique:users',
               'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
               'seller2_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
               'transport_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
               'accounts_contact.phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
             ],[
                'email.unique' => 'The email '.$user['email'].' has already be taken',
          'postalcode.required' => 'The postalcode or city field is required.',
          'seller2_contact.phone.regex' => 'The seller 2 contact phone format is invalid.',
          'transport_contact.phone.regex' => 'The Transport contact phone format is invalid.',
          'accounts_contact.phone.regex' => 'The Accounts contact phone format is invalid.',
         ]);

        $tableArray = array(
            'username'    => $row[2],
            'name'    => $row[0],
            'email'    => $row[3],
            'phone'    => $row[4],
            'company'       => $row[6],
            ////'purposes'       => $row[7],
            'size_range'       => $row[8],
            ////'defects'       => $row[9],
            ////'flesh_color'       => $row[10],
            //'skin_color'       => $row[11],
            ////'variety_premium'       => $row[12],
            'city'       => $row[13],
            'postal_code'       => $row[14],
            //'extra_transport_cost_per_ton'       => $row[15],
            'truck_quantity'       => $row[16],
            'credit_limit'       => $row[17],
            'status'       => $row[18],
            'created_at'       => $row[19],
          );

        $request = new Request( $tableArray );
        $request->validate([
               'email'=>'required|unique:buyers',
               'username'=>'required|unique:buyers',
               'phone' => 'required|unique:buyers'
             ]);


      $product_specifications = ProductSpecification::where(['product_id' => $product_id ])->get(); // product id 1 for potato
      if( $product_specifications  ) : 
        $product_specifications_arr = $product_specifications->toArray();
        foreach( $product_specifications_arr as $product_spec ){
          $product_spec_name_arr[ $product_spec['display_name'] ] = $product_spec['id'];
          $product_spec_id_arr[ $product_spec['id'] ] = $product_spec['display_name'];
          $product_specification_values = ProductSpecificationValue::where(['product_specification_id' => $product_spec['id'] ])->get()->toArray();
          foreach( $product_specification_values as $product_spec_val){
            $product_spec_value_name_arr[ $product_spec['display_name'] ][ $product_spec_val['id'] ] = $product_spec_val['value'];
            $product_spec_value_id_arr[ $product_spec['display_name'] ][ trim($product_spec_val['value']) ] = $product_spec_val['id'];
          }

        }  
      endif;
/*      echo "<pre>";  
      print_r( $product_spec_value_id_arr );
      print_r( $product_spec_name_arr );
      echo "<pre>";  */

        // creating Users table record
        $buyer_user = User::create($user);
        $buyer_user->assignRole('buyer');
        $user_id  = $buyer_user->id;

        // creating buyer table record 
        
        $buyer = Buyer::updateOrCreate(['user_id' => $user_id], $tableArray);

        // creating buyerpref table record 
        $tableArray['product_id'] = $product_id;
        $buyer_pref = BuyerPref::updateOrCreate(['buyer_id' => $buyer->id], $tableArray);
        $buyer_pref_id = $buyer_pref->id;
        $pref_valueArr = [];
        if( isset( $product_spec_value_id_arr['Purpose'][$row[7]] ) ){
          array_push( $pref_valueArr, [ 'buyer_pref_id'=>$buyer_pref_id,'key' => $product_spec_name_arr['Purpose'], 'value'=> $product_spec_value_id_arr['Purpose'][ trim($row[7]) ] ] );
        }
        if( isset( $product_spec_value_id_arr['Defects'][$row[9]] ) ){
          array_push( $pref_valueArr, [ 'buyer_pref_id'=>$buyer_pref_id,'key' => $product_spec_name_arr['Defects'], 'value'=> $product_spec_value_id_arr['Defects'][ trim($row[9]) ] ] );
        }
        if( isset( $product_spec_value_id_arr['Flesh Color'][$row[10]] ) ){
          array_push( $pref_valueArr, [ 'buyer_pref_id'=>$buyer_pref_id,'key' => $product_spec_name_arr['Flesh Color'], 'value'=> $product_spec_value_id_arr['Flesh Color'][ trim($row[10]) ] ] );
        }
        if( isset( $product_spec_value_id_arr['Colour of Skin'][$row[11]] ) ){
          array_push( $pref_valueArr, [ 'buyer_pref_id'=>$buyer_pref_id,'key' => $product_spec_name_arr['Colour of Skin'], 'value'=> $product_spec_value_id_arr['Colour of Skin'][ trim($row[9]) ] ] );
        }
        if( isset( $product_spec_value_id_arr['Potato Variety'][$row[12]] ) ){
          array_push( $pref_valueArr, [ 'buyer_pref_id'=>$buyer_pref_id,'key' => $product_spec_name_arr['Potato Variety'], 'value'=> $product_spec_value_id_arr['Potato Variety'][ trim($row[12]) ] ] );
        }
        if( isset( $product_spec_value_id_arr['Soil'][$row[20]] ) ){
          array_push( $pref_valueArr, [ 'buyer_pref_id'=>$buyer_pref_id,'key' => $product_spec_name_arr['Soil'], 'value'=> $product_spec_value_id_arr['Soil'][ trim($row[20]) ] ] );
        }
        if( isset( $product_spec_value_id_arr['Packaging'][$row[21]] ) ){
          array_push( $pref_valueArr, [ 'buyer_pref_id'=>$buyer_pref_id,'key' => $product_spec_name_arr['Packaging'], 'value'=> $product_spec_value_id_arr['Packaging'][ trim($row[21]) ] ] );
        }
        if( isset( $product_spec_value_id_arr['Tuber Shape'][$row[22]] ) ){
          array_push( $pref_valueArr, [ 'buyer_pref_id'=>$buyer_pref_id,'key' => $product_spec_name_arr['Tuber Shape'], 'value'=> $product_spec_value_id_arr['Tuber Shape'][ trim($row[22]) ] ] );
        }
        if( isset( $product_spec_value_id_arr['Depth of Eyes'][$row[23]] ) ){
          array_push( $pref_valueArr, [ 'buyer_pref_id'=>$buyer_pref_id,'key' => $product_spec_name_arr['Depth of Eyes'], 'value'=> $product_spec_value_id_arr['Depth of Eyes'][ trim($row[23]) ] ] );
        }
        if( isset( $product_spec_value_id_arr['Smoothness of Skin'][$row[24]] ) ){
          array_push( $pref_valueArr, [ 'buyer_pref_id'=>$buyer_pref_id,'key' => $product_spec_name_arr['Smoothness of Skin'], 'value'=> $product_spec_value_id_arr['Smoothness of Skin'][ trim($row[24]) ] ] );
        }

        foreach ( $pref_valueArr as $pref_val ){
          BuyerProductPref::create( $pref_val );
        }


        return $buyer_user;
        

    }

/*    public function startRow(): int
    {
        return 2;
    }
*/
}
