<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class UsersFirstImport implements ToModel
{
    use Importable;
    
    public $_row_number;
    /**
    * @param array $no_of_row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function __construct( $no_of_row = array ( "row_number" => "all" ) ){
      $this->_row_number = $no_of_row['row_number'];// == 1;

    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model( $rows )
    {
//      return 1;
    }
}
