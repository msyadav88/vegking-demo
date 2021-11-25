<?php

use Illuminate\Database\Seeder;

class BroccoliSpecificTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Broccoli = App\Product::firstOrCreate(['name' => 'Broccoli'],[
            'name' => 'Broccoli',
            'name_pl' => '',
            'name_de' => '',
            'status' => '1',
            'image' => 'broccoli_home.jpg',
            'homepage_image' => 'broccoli_home.jpg'
        ]);
        
        $Purpose = App\ProductSpecification::updateOrCreate(['product_id' => $Broccoli->id,'display_name' => 'Purpose'],[
            'product_id' => $Broccoli->id,
            'display_name' => "Purpose",'type_name' => "Purpose",
            'importance' => 1,'order' => 1,'field_type' => 'checkboxes',
            'buyer_hasmany' => 'Yes','buyer_pref_anylogic' => 'Yes','stock_hasmany' => 'No','can_edit' => 'Yes',
            'required' => 'No','parent_id' => NULL,
        ]);
        
        $Purpose_values = array('Supermarket','Processing');
        foreach($Purpose_values as $value)
        {
            $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Broccoli->id,'product_specification_id' => $Purpose->id,'value' => $value],[
                'product_id' => $Broccoli->id,'product_specification_id' => $Purpose->id,
                'parent_id' => NULL,'premium' => NULL,'volume' => NULL,'description' => '','ec'=> 0,'ecbf' => 0,
                'default' => '0','status' => 1,'extra_supply_cost' => NULL,'extra_cost_to_buyer_factor' => NULL,
                'value' => $value,
            ]);
        }
        
    }
}
