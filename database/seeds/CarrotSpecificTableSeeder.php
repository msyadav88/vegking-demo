<?php

use Illuminate\Database\Seeder;

class CarrotSpecificTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Carrot = App\Product::firstOrCreate(['name' => 'Carrots'],[
            'name' => 'Carrots',
            'name_pl' => '',
            'name_de' => '',
            'status' => '1',
            'image' => 'carrot_home.jpg',
            'homepage_image' => 'carrot_home.jpg'
        ]);
        
        $Variety = App\ProductSpecification::updateOrCreate(['product_id' => $Carrot->id,'display_name' => 'Variety'],[
            'product_id' => $Carrot->id,
            'display_name' => "Variety",'type_name' => "Variety",
            'importance' => 1,'order' => 1,'field_type' => 'checkboxes',
            'buyer_hasmany' => 'Yes','buyer_pref_anylogic' => 'Yes','stock_hasmany' => 'No','can_edit' => 'Yes',
            'required' => 'No','parent_id' => NULL,
        ]);
        $Variety_values = array('Red', 'Orange', 'Purple', 'White');
        foreach($Variety_values as $value)
        {
            $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Carrot->id,'product_specification_id' => $Variety->id,'value' => $value],[
                'product_id' => $Carrot->id,'product_specification_id' => $Variety->id,
                'parent_id' => NULL,'premium' => NULL,'volume' => NULL,'description' => '','ec'=> 0,'ecbf' => 0,
                'default' => '0','status' => 1,'extra_supply_cost' => NULL,'extra_cost_to_buyer_factor' => NULL,
                'value' => $value,
            ]);
        }
        
        //Purpose - 1
        $Purpose = App\ProductSpecification::updateOrCreate(['product_id' => $Carrot->id,'display_name' => 'Purpose'],[
            'product_id' => $Carrot->id,
            'display_name' => "Purpose",'type_name' => "Purpose",
            'importance' => 1,'order' => 1,'field_type' => 'checkboxes',
            'buyer_hasmany' => 'Yes','buyer_pref_anylogic' => 'Yes','stock_hasmany' => 'No','can_edit' => 'Yes',
            'required' => 'No','parent_id' => NULL,
        ]);
        
        $Purpose_values = array('Processing');
        foreach($Purpose_values as $value)
        {
            $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Carrot->id,'product_specification_id' => $Purpose->id,'value' => $value],[
                'product_id' => $Carrot->id,'product_specification_id' => $Purpose->id,
                'parent_id' => NULL,'premium' => NULL,'volume' => NULL,'description' => '','ec'=> 0,'ecbf' => 0,
                'default' => '0','status' => 1,'extra_supply_cost' => NULL,'extra_cost_to_buyer_factor' => NULL,
                'value' => $value,
            ]);
        }
        
        $Quality = App\ProductSpecification::updateOrCreate(['product_id' => $Carrot->id,'display_name' => 'Quality'],[
            'product_id' => $Carrot->id,
            'display_name' => "Quality",'type_name' => "Quality",
            'importance' => 1,'order' => 1,'field_type' => 'checkboxes',
            'buyer_hasmany' => 'Yes','buyer_pref_anylogic' => 'Yes','stock_hasmany' => 'No','can_edit' => 'Yes',
            'required' => 'No','parent_id' => NULL,
        ]);
        
        $Quality_values = array('High', 'Average','Low');
        foreach($Quality_values as $value)
        {
            $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Carrot->id,'product_specification_id' => $Quality->id,'value' => $value],[
                'product_id' => $Carrot->id,'product_specification_id' => $Quality->id,
                'parent_id' => NULL,'premium' => NULL,'volume' => NULL,'description' => '','ec'=> 0,'ecbf' => 0,
                'default' => '0','status' => 1,'extra_supply_cost' => NULL,'extra_cost_to_buyer_factor' => NULL,
                'value' => $value,
            ]);
        }
       
        $Defects = App\ProductSpecification::updateOrCreate(['product_id' => $Carrot->id,'display_name' => 'Defects'],[
            'product_id' => $Carrot->id,
            'display_name' => "Defects",'type_name' => "Defects",
            'importance' => 1,'order' => 1,'field_type' => 'checkboxes',
            'buyer_hasmany' => 'Yes','buyer_pref_anylogic' => 'Yes','stock_hasmany' => 'No','can_edit' => 'Yes',
            'required' => 'No','parent_id' => NULL,
        ]);
        
        $Defects_values = array('Loose Skin', 'Cracking','Soft','Internal Growth (sprouting)','Mechanical Damage','Cracks');
        foreach($Defects_values as $value)
        {
            $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Carrot->id,'product_specification_id' => $Defects->id,'value' => $value],[
                'product_id' => $Carrot->id,'product_specification_id' => $Defects->id,
                'parent_id' => NULL,'premium' => NULL,'volume' => NULL,'description' => '','ec'=> 0,'ecbf' => 0,
                'default' => '0','status' => 1,'extra_supply_cost' => NULL,'extra_cost_to_buyer_factor' => NULL,
                'value' => $value,
            ]);
        }
        
        $Packing = App\ProductSpecification::updateOrCreate(['product_id' => $Carrot->id,'display_name' => 'Packing'],[
            'product_id' => $Carrot->id,
            'display_name' => "Packing",'type_name' => "Packing",
            'importance' => 1,'order' => 1,'field_type' => 'checkboxes',
            'buyer_hasmany' => 'Yes','buyer_pref_anylogic' => 'Yes','stock_hasmany' => 'No','can_edit' => 'Yes',
            'required' => 'No','parent_id' => NULL,
        ]);
        $Packing_values = array('Nets 5 kg', 'Nets 10 kg');
        foreach($Packing_values as $value)
        {
            $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Carrot->id,'product_specification_id' => $Packing->id,'value' => $value],[
                'product_id' => $Carrot->id,'product_specification_id' => $Packing->id,
                'parent_id' => NULL,'premium' => NULL,'volume' => NULL,'description' => '','ec'=> 0,'ecbf' => 0,
                'default' => '0','status' => 1,'extra_supply_cost' => NULL,'extra_cost_to_buyer_factor' => NULL,
                'value' => $value,
            ]);
        }
        
        //Size - 1
        $Size = App\ProductSpecification::updateOrCreate(['product_id' => $Carrot->id,'display_name' => 'Size'],[
            'product_id' => $Carrot->id,
            'display_name' => "Size",'type_name' => "Size",'importance' => 1,'order' => 1,
            'field_type' => 'sizerange','buyer_hasmany' => 'Yes','buyer_pref_anylogic' => 'Yes',
            'stock_hasmany' => 'No','can_edit' => 'Yes','required' => 'No','parent_id' => NULL,
        ]);
        
    }
}
