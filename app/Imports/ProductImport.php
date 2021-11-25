<?php

namespace App\Imports;

use App\ProductVarieties;
//use App\Users;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class ProductImport implements ToModel,WithStartRow 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        $user_id=auth()->user()->id;
        return new ProductVarieties([
           'user_id' => $user_id,
           'product_id' => $row[0],
           'URL' => $row[1],
           'higher_taxon' => $row[2],
           'genus' => $row[3],
           'species' => $row[4],
           'parentage' => $row[5],
           'breeder'  => $row[6],
           'breeder_agent' => $row[7],
           'status' => $row[8],
        ]);
    }
}
