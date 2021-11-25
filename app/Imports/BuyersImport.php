<?php

namespace App\Imports;

use App\Buyer;
//use App\Users;
use Maatwebsite\Excel\Concerns\ToModel;

class BuyersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        /*return new User([
           'username'     => $row[0],
           'phone'    => $row[1],
           'city' => $row[2],
           'postalcode' => $row[3],
        ]);
                print_r( $row );
        die();*/
        
        return new Buyer([
           'username'     => $row[0],
           'phone'    => $row[1],
           'city' => $row[2],
           'postalcode' => $row[3],
        ]);
    }
}
