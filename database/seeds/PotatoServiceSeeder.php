<?php

use Illuminate\Database\Seeder;

class PotatoServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Product = App\Product::firstOrCreate(['name' => 'Potato']);
       
        //Size - 1
        $Size = App\ProductSpecification::updateOrCreate(['product_id' => $Product->id,'display_name' => 'Size'],[
            'product_id' => $Product->id,
            'display_name' => "Size",
            'type_name' => "Size",
            'importance' => 1,
            'order' => 1,
            'field_type' => 'sizerange',
            'buyer_hasmany' => 'Yes',
            'buyer_pref_anylogic' => 'Yes',
            'stock_hasmany' => 'No',
            'can_edit' => 'Yes',
            'required' => 'No',
            'parent_id' => NULL,
        ]);
        
        //Cleaning - 1
        $Cleaning = App\ProductSpecification::updateOrCreate(['product_id' => $Product->id,'display_name' => 'Extra Services'],[
            'product_id' => $Product->id,
            'display_name' => "Extra Services",
            'type_name' => "Extra Services",
            'importance' => 1,
            'order' => 1,
            'field_type' => 'checkboxes',
            'buyer_hasmany' => 'Yes',
            'buyer_pref_anylogic' => 'Yes',
            'stock_hasmany' => 'No',
            'can_edit' => 'Yes',
            'required' => 'No',
            'parent_id' => NULL,
        ]);
        
        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $Cleaning->id,'value' => 'Wash'],[
            'product_id' => $Product->id,
            'product_specification_id' => $Cleaning->id,
            'parent_id' => NULL,
            'value' => "Wash",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => '',
            'ec'=> 0,
            'ecbf' => 0
        ]);
       
        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $Cleaning->id,'value' => 'Brush'],[
            'product_id' => $Product->id,
            'product_specification_id' => $Cleaning->id,
            'parent_id' => NULL,
            'value' => "Brush",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => '',
            'ec'=> 0,
            'ecbf' => 0
        ]);

    }
}