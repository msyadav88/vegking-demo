<?php

use Illuminate\Database\Seeder;

class AppleSpecificTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Apple = App\Product::firstOrCreate(['name' => 'Apples']);
        
        $Variety = App\ProductSpecification::updateOrCreate(['product_id' => $Apple->id,'display_name' => 'Variety'],[
            'product_id' => $Apple->id,
            'display_name' => "Variety",'type_name' => "Variety",
            'importance' => 1,'order' => 1,'field_type' => 'checkboxes',
            'buyer_hasmany' => 'Yes','buyer_pref_anylogic' => 'Yes','stock_hasmany' => 'No','can_edit' => 'Yes',
            'required' => 'No','parent_id' => NULL,
        ]);
        $Variety_values = array('Gala Royal');
        foreach($Variety_values as $value)
        {
            $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Apple->id,'product_specification_id' => $Variety->id,'value' => $value],[
                'product_id' => $Apple->id,'product_specification_id' => $Variety->id,
                'parent_id' => NULL,'premium' => NULL,'volume' => NULL,'description' => '','ec'=> 0,'ecbf' => 0,
                'default' => '0','status' => 1,'extra_supply_cost' => NULL,'extra_cost_to_buyer_factor' => NULL,
                'value' => $value,
            ]);
        }
        
         //Purpose - 1
        $Purpose = App\ProductSpecification::updateOrCreate(['product_id' => $Apple->id,'display_name' => 'Purpose'],[
            'product_id' => $Apple->id,
            'display_name' => "Purpose",'type_name' => "Purpose",
            'importance' => 1,'order' => 1,'field_type' => 'checkboxes',
            'buyer_hasmany' => 'Yes','buyer_pref_anylogic' => 'Yes','stock_hasmany' => 'No','can_edit' => 'Yes',
            'required' => 'No','parent_id' => NULL,
        ]);
        
        $Purpose_values = array('Market', 'Industry');
        foreach($Purpose_values as $value)
        {
            $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Apple->id,'product_specification_id' => $Purpose->id,'value' => $value],[
                'product_id' => $Apple->id,'product_specification_id' => $Purpose->id,
                'parent_id' => NULL,'premium' => NULL,'volume' => NULL,'description' => '','ec'=> 0,'ecbf' => 0,
                'default' => '0','status' => 1,'extra_supply_cost' => NULL,'extra_cost_to_buyer_factor' => NULL,
                'value' => $value,
            ]);
        }
        
        $Quality = App\ProductSpecification::updateOrCreate(['product_id' => $Apple->id,'display_name' => 'Quality'],[
            'product_id' => $Apple->id,
            'display_name' => "Quality",'type_name' => "Quality",
            'importance' => 1,'order' => 1,'field_type' => 'checkboxes',
            'buyer_hasmany' => 'Yes','buyer_pref_anylogic' => 'Yes','stock_hasmany' => 'No','can_edit' => 'Yes',
            'required' => 'No','parent_id' => NULL,
        ]);
        
        $Quality_values = array('High', 'Average','Low');
        foreach($Quality_values as $value)
        {
            $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Apple->id,'product_specification_id' => $Quality->id,'value' => $value],[
                'product_id' => $Apple->id,'product_specification_id' => $Quality->id,
                'parent_id' => NULL,'premium' => NULL,'volume' => NULL,'description' => '','ec'=> 0,'ecbf' => 0,
                'default' => '0','status' => 1,'extra_supply_cost' => NULL,'extra_cost_to_buyer_factor' => NULL,
                'value' => $value,
            ]);
        }
        
        $Color = App\ProductSpecification::updateOrCreate(['product_id' => $Apple->id,'display_name' => 'Color'],[
            'product_id' => $Apple->id,
            'display_name' => "Color",'type_name' => "Color",
            'importance' => 1,'order' => 1,'field_type' => 'checkboxes',
            'buyer_hasmany' => 'Yes','buyer_pref_anylogic' => 'Yes','stock_hasmany' => 'No','can_edit' => 'Yes',
            'required' => 'No','parent_id' => NULL,
        ]);
        $Color_values = array('Red/Pink', 'Yellow/Brown');
        foreach($Color_values as $value)
        {
            $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Apple->id,'product_specification_id' => $Color->id,'value' => $value],[
                'product_id' => $Apple->id,'product_specification_id' => $Color->id,
                'parent_id' => NULL,'premium' => NULL,'volume' => NULL,'description' => '','ec'=> 0,'ecbf' => 0,
                'default' => '0','status' => 1,'extra_supply_cost' => NULL,'extra_cost_to_buyer_factor' => NULL,
                'value' => $value,
            ]);
        }
        
        
        
        
        $Defects = App\ProductSpecification::updateOrCreate(['product_id' => $Apple->id,'display_name' => 'Defects'],[
            'product_id' => $Apple->id,
            'display_name' => "Defects",'type_name' => "Defects",
            'importance' => 1,'order' => 1,'field_type' => 'checkboxes',
            'buyer_hasmany' => 'Yes','buyer_pref_anylogic' => 'Yes','stock_hasmany' => 'No','can_edit' => 'Yes',
            'required' => 'No','parent_id' => NULL,
        ]);
        
        $Defects_values = array('Loose Skin', 'Cracking','Soft','Internal Growth (sprouting)','Mechanical Damage','Cracks');
        foreach($Defects_values as $value)
        {
            $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Apple->id,'product_specification_id' => $Defects->id,'value' => $value],[
                'product_id' => $Apple->id,'product_specification_id' => $Defects->id,
                'parent_id' => NULL,'premium' => NULL,'volume' => NULL,'description' => '','ec'=> 0,'ecbf' => 0,
                'default' => '0','status' => 1,'extra_supply_cost' => NULL,'extra_cost_to_buyer_factor' => NULL,
                'value' => $value,
            ]);
        }
        
        $Packing = App\ProductSpecification::updateOrCreate(['product_id' => $Apple->id,'display_name' => 'Packing'],[
            'product_id' => $Apple->id,
            'display_name' => "Packing",'type_name' => "Packing",
            'importance' => 1,'order' => 1,'field_type' => 'checkboxes',
            'buyer_hasmany' => 'Yes','buyer_pref_anylogic' => 'Yes','stock_hasmany' => 'No','can_edit' => 'Yes',
            'required' => 'No','parent_id' => NULL,
        ]);
        $Packing_values = array('Bushel', 'Carton Box', 'Wooden Box', 'Bulk');
        foreach($Packing_values as $value)
        {
            $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Apple->id,'product_specification_id' => $Packing->id,'value' => $value],[
                'product_id' => $Apple->id,'product_specification_id' => $Packing->id,
                'parent_id' => NULL,'premium' => NULL,'volume' => NULL,'description' => '','ec'=> 0,'ecbf' => 0,
                'default' => '0','status' => 1,'extra_supply_cost' => NULL,'extra_cost_to_buyer_factor' => NULL,
                'value' => $value,
            ]);
        }
        
        //Size
        $Size = App\ProductSpecification::updateOrCreate(['product_id' => $Apple->id,'display_name' => 'Size'],[
            'product_id' => $Apple->id,
            'display_name' => "Size",'type_name' => "Size",'importance' => 1,'order' => 1,
            'field_type' => 'sizerange','buyer_hasmany' => 'Yes','buyer_pref_anylogic' => 'Yes',
            'stock_hasmany' => 'No','can_edit' => 'Yes','required' => 'No','parent_id' => NULL,
        ]);
        
        //Sugar Content
        $SugarContent = App\ProductSpecification::updateOrCreate(['product_id' => $Apple->id,'display_name' => 'Sugar Content'],[
            'product_id' => $Apple->id,
            'display_name' => "Sugar Content",'type_name' => "Sugar Content",'importance' => 1,'order' => 1,
            'field_type' => 'rangeslider','buyer_hasmany' => 'Yes','buyer_pref_anylogic' => 'Yes',
            'stock_hasmany' => 'No','can_edit' => 'Yes','required' => 'No','parent_id' => NULL,
        ]);
        
        //Colorful
        $Colorful = App\ProductSpecification::updateOrCreate(['product_id' => $Apple->id,'display_name' => 'Colorful'],[
            'product_id' => $Apple->id,
            'display_name' => "Colorful",'type_name' => "Colorful",'importance' => 1,'order' => 1,
            'field_type' => 'rangeslider','buyer_hasmany' => 'Yes','buyer_pref_anylogic' => 'Yes',
            'stock_hasmany' => 'No','can_edit' => 'Yes','required' => 'No','parent_id' => NULL,
        ]);
        
        
        $Extra_Services = App\ProductSpecification::updateOrCreate(['product_id' => $Apple->id,'display_name' => 'Extra Services'],[
            'product_id' => $Apple->id,
            'display_name' => "Extra Services",'type_name' => "Extra Services",
            'importance' => 1,'order' => 1,'field_type' => 'checkboxes',
            'buyer_hasmany' => 'Yes','buyer_pref_anylogic' => 'Yes','stock_hasmany' => 'No','can_edit' => 'Yes',
            'required' => 'No','parent_id' => NULL,
        ]);
        $Extra_Services_values = array('Waxed');
        foreach($Extra_Services_values as $value)
        {
            $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Apple->id,'product_specification_id' => $Extra_Services->id,'value' => $value],[
                'product_id' => $Apple->id,'product_specification_id' => $Extra_Services->id,
                'parent_id' => NULL,'premium' => NULL,'volume' => NULL,'description' => '','ec'=> 0,'ecbf' => 0,
                'default' => '0','status' => 1,'extra_supply_cost' => NULL,'extra_cost_to_buyer_factor' => NULL,
                'value' => $value,
            ]);
        }
        
    }
}
