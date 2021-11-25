<?php

use Illuminate\Database\Seeder;

class product_specificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $Packaging->id,'value' => '1250 kg (big bags)'],[
            'product_id' => $Product->id,
            'type_name' =>  
            'product_specification_id' => $Packaging->id,
            'parent_id' => NULL,
            'value' => "1250 kg (big bags)",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);
    }
}
