<?php

use Illuminate\Database\Seeder;

class CauliflowerSpecificTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Cauliflower = App\Product::firstOrCreate(['name' => 'Cauliflower'],[
            'name' => 'Cauliflower',
            'name_pl' => '',
            'name_de' => '',
            'status' => '1',
            'image' => 'cauliflower_home.jpg',
            'homepage_image' => 'cauliflower_home.jpg'
        ]);
        
        $Variety = App\ProductSpecification::updateOrCreate(['product_id' => $Cauliflower->id,'display_name' => 'Variety'],[
            'product_id' => $Cauliflower->id,
            'display_name' => "Variety",'type_name' => "Variety",
            'importance' => 1,'order' => 1,'field_type' => 'checkboxes',
            'buyer_hasmany' => 'Yes','buyer_pref_anylogic' => 'Yes','stock_hasmany' => 'No','can_edit' => 'Yes',
            'required' => 'No','parent_id' => NULL,
        ]);
        $Variety_values = array('6 heads', '8 heads');
        foreach($Variety_values as $value)
        {
            $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Cauliflower->id,'product_specification_id' => $Variety->id,'value' => $value],[
                'product_id' => $Cauliflower->id,'product_specification_id' => $Variety->id,
                'parent_id' => NULL,'premium' => NULL,'volume' => NULL,'description' => '','ec'=> 0,'ecbf' => 0,
                'default' => '0','status' => 1,'extra_supply_cost' => NULL,'extra_cost_to_buyer_factor' => NULL,
                'value' => $value,
            ]);
        }
        
        //Purpose - 1
        $Purpose = App\ProductSpecification::updateOrCreate(['product_id' => $Cauliflower->id,'display_name' => 'Purpose'],[
            'product_id' => $Cauliflower->id,
            'display_name' => "Purpose",'type_name' => "Purpose",
            'importance' => 1,'order' => 1,'field_type' => 'checkboxes',
            'buyer_hasmany' => 'Yes','buyer_pref_anylogic' => 'Yes','stock_hasmany' => 'No','can_edit' => 'Yes',
            'required' => 'No','parent_id' => NULL,
        ]);
        
        $Purpose_values = array('Supermarket','Processing');
        foreach($Purpose_values as $value)
        {
            $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Cauliflower->id,'product_specification_id' => $Purpose->id,'value' => $value],[
                'product_id' => $Cauliflower->id,'product_specification_id' => $Purpose->id,
                'parent_id' => NULL,'premium' => NULL,'volume' => NULL,'description' => '','ec'=> 0,'ecbf' => 0,
                'default' => '0','status' => 1,'extra_supply_cost' => NULL,'extra_cost_to_buyer_factor' => NULL,
                'value' => $value,
            ]);
        }
        
    }
}
