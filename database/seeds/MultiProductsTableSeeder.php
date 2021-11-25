<?php

use Illuminate\Database\Seeder;

class MultiProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Product = App\Product::firstOrCreate(['name' => 'Potato'],[
            'name' => 'Potato',
            'name_pl' => 'Ziemniaki',
            'name_de' => 'Kartoffeln',
            'status' => '1',
            'image' => 'potato_home.jpg',
            'homepage_image' => 'potato_home.jpg'
        ]);
        
        //soil - 1
        $Soil = App\ProductSpecification::updateOrCreate(['product_id' => $Product->id,'display_name' => 'Soil'],[
            'product_id' => $Product->id,
            'display_name' => "Soil",
            'type_name' => "Soil",
            'importance' => 1,
            'order' => 1,
            'field_type' => 'dropdown_switchboxes',
            'buyer_hasmany' => 'Yes',
            'buyer_pref_anylogic' => 'Yes',
            'stock_hasmany' => 'No',
            'can_edit' => 'Yes',
            'required' => 'No',
            'parent_id' => NULL,
        ]);
        
        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $Soil->id,'value' => 'Dark'],[
            'product_id' => $Product->id,
            'product_specification_id' => $Soil->id,
            'parent_id' => NULL,
            'value' => "Dark",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
            'ec'=> 30,
            'ecbf' => 1.6
        ]);
        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $Soil->id,'value' => 'Light'],[
            'product_id' => $Product->id,
            'product_specification_id' => $Soil->id,
            'parent_id' => NULL,
            'value' => "Light",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);
        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $Soil->id,'value' => 'Red'],[
            'product_id' => $Product->id,
            'product_specification_id' => $Soil->id,
            'parent_id' => NULL,
            'value' => "Red",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);
        

        /*******1*********/

        //flesh_color - 0
        $FleshColor = App\ProductSpecification::updateOrCreate(['product_id' => $Product->id,'display_name' => 'Flesh Color'],[
            'product_id' => $Product->id,
            'display_name' => "Flesh Color",
            'type_name' => "Flesh Color",
            'importance' => 1,
            'order' => 1,
            'field_type' => 'dropdown_switchboxes',
            'buyer_hasmany' => 'Yes',
            'buyer_pref_anylogic' => 'Yes',
            'stock_hasmany' => 'No',
            'can_edit' => 'No',
            'required' => 'No',
            'parent_id' => NULL,

        ]);
        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColor->id,'value' => 'Yellow'],[
            'product_id' => $Product->id,
            'product_specification_id' => $FleshColor->id,
            'parent_id' => NULL,
            'value' => "Yellow",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);

        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColor->id,'value' => 'Light Yellow'],[
            'product_id' => $Product->id,
            'product_specification_id' => $FleshColor->id,
            'parent_id' => NULL,
            'value' => "Light Yellow",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);

        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColor->id,'value' => 'Creme'],[
            'product_id' => $Product->id,
            'product_specification_id' => $FleshColor->id,
            'parent_id' => NULL,
            'value' => "Creme",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);

        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColor->id,'value' => 'White'],[
            'product_id' => $Product->id,
            'product_specification_id' => $FleshColor->id,
            'parent_id' => NULL,
            'value' => "White",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);

        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColor->id,'value' => 'Medium Yellow'],[
            'product_id' => $Product->id,
            'product_specification_id' => $FleshColor->id,
            'parent_id' => NULL,
            'value' => "Medium Yellow",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);

        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColor->id,'value' => 'Deep Yellow'],[
            'product_id' => $Product->id,
            'product_specification_id' => $FleshColor->id,
            'parent_id' => NULL,
            'value' => "Deep Yellow",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);

        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColor->id,'value' => 'Parti-coloured Red'],[
            'product_id' => $Product->id,
            'product_specification_id' => $FleshColor->id,
            'parent_id' => NULL,
            'value' => "Parti-coloured Red",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);

        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColor->id,'value' => 'Parti-coloured Blue'],[
            'product_id' => $Product->id,
            'product_specification_id' => $FleshColor->id,
            'parent_id' => NULL,
            'value' => "Parti-coloured Blue",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);

        
        // /*******1*********/

        //packaging - 0
        $Packaging =  App\ProductSpecification::updateOrCreate(['product_id' => $Product->id,'display_name' => 'Packaging'],[
            'product_id' => $Product->id,
            'type_name'   => "Packing",
            'display_name' => "Packaging",
            'field_type' => 'dropdown_switchboxes',
            'importance' => 1,
            'order' => 1,
            'buyer_hasmany' => 'Yes',
            'buyer_pref_anylogic' => 'Yes',
            'stock_hasmany' => 'Yes',
            'can_edit' => 'Yes',
            'required' => 'No',
            'parent_id' => NULL,

        ]);
        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $Packaging->id,'value' => '1250 kg (big bags)'],[
            'product_id' => $Product->id,
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

        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $Packaging->id,'value' => '15kg nets'],[
            'product_id' => $Product->id,
            'product_specification_id' => $Packaging->id,
            'parent_id' => NULL,
            'value' => "15kg nets",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);

        /*******1*********/

        //defects - 0
        $Defects =  App\ProductSpecification::updateOrCreate(['product_id' => $Product->id,'display_name' => 'Defects'],[
            'product_id' => $Product->id,
            'type_name'  => "Defects",
            'display_name' => "Defects",
            'field_type' => 'dropdown_switchboxes',
            'importance' => 1,
            'order' => 1,
            'buyer_hasmany' => 'Yes',
            'buyer_pref_anylogic' => 'Yes',
            'stock_hasmany' => 'Yes',
            'can_edit' => 'Yes',
            'required' => 'No',
            'parent_id' => NULL,

        ]);
        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $Defects->id,'value' => 'Scabs'],[
            'product_id' => $Product->id,
            'product_specification_id' => $Defects->id,
            'parent_id' => NULL,
            'value' => "Scabs",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);

        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $Defects->id,'value' => 'Sprouts'],[
            'product_id' => $Product->id,
            'product_specification_id' => $Defects->id,
            'parent_id' => NULL,
            'value' => "Sprouts",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);

        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $Defects->id,'value' => 'Internals'],[
            'product_id' => $Product->id,
            'product_specification_id' => $Defects->id,
            'parent_id' => NULL,
            'value' => "Internals",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);

        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $Defects->id,'value' => 'Bruising'],[
            'product_id' => $Product->id,
            'product_specification_id' => $Defects->id,
            'parent_id' => NULL,
            'value' => "Bruising",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);

        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $Defects->id,'value' => 'Rot'],[
            'product_id' => $Product->id,
            'product_specification_id' => $Defects->id,
            'parent_id' => NULL,
            'value' => "Rot",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);

        /*******1*********/

        //purpose - 0
        $Purpose = App\ProductSpecification::updateOrCreate(['product_id' => $Product->id,'display_name' => 'Purpose'],[
            'product_id' => $Product->id,
            'type_name'  => "Purpose",
            'display_name' => "Purpose",
            'field_type' => 'dropdown_switchboxes',
            'importance' => 1,
            'order' => 1,
            'buyer_hasmany' => 'Yes',
            'buyer_pref_anylogic' => 'Yes',
            'stock_hasmany' => 'Yes',
            'can_edit' => 'Yes',
            'required' => 'No',
            'parent_id' => NULL,

        ]);
        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $Purpose->id,'value' => 'Dirty'],[
            'product_id' => $Product->id,
            'product_specification_id' => $Purpose->id,
            'parent_id' => NULL,
            'value' => "Dirty",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);

        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $Purpose->id,'value' => 'Peeling'],[
            'product_id' => $Product->id,
            'product_specification_id' => $Purpose->id,
            'parent_id' => NULL,
            'value' => "Peeling",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);

        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $Purpose->id,'value' => 'French Fries'],[
            'product_id' => $Product->id,
            'product_specification_id' => $Purpose->id,
            'parent_id' => NULL,
            'value' => "French Fries",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);

        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $Purpose->id,'value' => 'Crisping'],[
            'product_id' => $Product->id,
            'product_specification_id' => $Purpose->id,
            'parent_id' => NULL,
            'value' => "Crisping",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);

        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $Purpose->id,'value' => 'Washed'],[
            'product_id' => $Product->id,
            'product_specification_id' => $Purpose->id,
            'parent_id' => NULL,
            'value' => "Washed",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);

        $ProductSpecificationValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $Purpose->id,'value' => 'Washing'],[
            'product_id' => $Product->id,
            'product_specification_id' => $Purpose->id,
            'parent_id' => NULL,
            'value' => "Washing",
            'premium' => NULL,
            'volume' => NULL,
            'default' => '0',
            'status' => 1,
            'extra_supply_cost' => NULL,
            'extra_cost_to_buyer_factor' => NULL,
            'description' => 'The potato is a root vegetable, a starchy tuber of the plant Solanum tuberosum.',
        ]);

        // /*******1*********/

        //potato_variety - 0
        $PotatoVariety = App\ProductSpecification::updateOrCreate(['product_id' => $Product->id,'display_name' => 'Potato Variety'],[
            'product_id' => $Product->id,
            'display_name' => "Potato Variety",
            'type_name' => "Variety",
            'importance' => 1,
            'order' => 1,
            'field_type' => 'dropdown_switchboxes',
            'buyer_hasmany' => 'No',
            'buyer_pref_anylogic' => 'No',
            'stock_hasmany' => 'No',
            'can_edit' => 'Yes',
            'required' => 'Yes',
            'parent_id' => NULL,
        ]);
        //Variety Flesh Color
        $FleshColorChild = App\ProductSpecification::firstOrCreate(['product_id' => $Product->id,'display_name' => 'Flesh Color','parent_id' => $PotatoVariety->id],[
                'product_id' => $Product->id,
                'display_name' => "Flesh Color",
                'type_name' => "Flesh Color",
                'importance' => 1,
                'order' => 1,
                'buyer_hasmany' => 'Yes',
                'stock_hasmany' => 'No',
                'can_edit' => 'Yes',
                'required' => 'No',
                'reference_id'=> $FleshColor->id,
                'parent_id' => $PotatoVariety->id,
            ]);

        //DryMatter
        $DryMatter = App\ProductSpecification::firstOrCreate(['product_id' => $Product->id,'display_name' => 'Dry Matter','parent_id' => $PotatoVariety->id],[
            'product_id' => $Product->id,
            'display_name' => 'Dry Matter',
            'type_name' => 'Dry Matter',
            'importance' => 2,
            'order' => 2,
            'buyer_hasmany' => 'No',
            'stock_hasmany' => 'No',
            'can_edit' => 'Yes',
            'required' => 'No',
            'parent_id' => $PotatoVariety->id,
        ]);

        //tubershape
        $TuberShape = App\ProductSpecification::firstOrCreate(['product_id' => $Product->id,'display_name' => 'Tuber Shape','parent_id' => $PotatoVariety->id],[
            'product_id' => $Product->id,
            'display_name' => 'Tuber Shape',
            'type_name' => 'Tuber Shape',
            'importance' => 3,
            'order' => 3,
            'buyer_hasmany' => 'No',
            'stock_hasmany' => 'No',
            'can_edit' => 'Yes',
            'required' => 'No',
            'parent_id' => $PotatoVariety->id,
        ]);

        //colour_of_skin
        $ColourOfSkin = App\ProductSpecification::firstOrCreate(['product_id' => $Product->id,'display_name' => 'Colour of Skin','parent_id' => $PotatoVariety->id],[
            'product_id' => $Product->id,
            'display_name' => 'Colour of Skin',
            'type_name' => 'Colour of Skin',
            'importance' => 4,
            'order' => 4,
            'buyer_hasmany' => 'No',
            'stock_hasmany' => 'No',
            'can_edit' => 'Yes',
            'required' => 'No',
            'parent_id' => $PotatoVariety->id,
        ]);

        //depth_of_eyes - 0
        $DepthOfEyes = App\ProductSpecification::firstOrCreate(['product_id' => $Product->id,'display_name' => 'Depth of Eyes','parent_id' => $PotatoVariety->id],[
            'product_id' => $Product->id,
            'display_name' => 'Depth of Eyes',
            'type_name' => 'Depth of Eyes',
            'importance' => 5,
            'order' => 5,
            'buyer_hasmany' => 'No',
            'stock_hasmany' => 'No',
            'can_edit' => 'Yes',
            'required' => 'No',
            'parent_id' => $PotatoVariety->id,
        ]);

        //smoothness_of_skin
        $SmoothnessOfSkin = App\ProductSpecification::firstOrCreate(['product_id' => $Product->id,'display_name' => 'Smoothness of Skin','parent_id' => $PotatoVariety->id],[
            'product_id' => $Product->id,
            'display_name' => 'Smoothness of Skin',
            'type_name' => 'Smoothness of Skin',
            'importance' => 6,
            'order' => 6,
            'buyer_hasmany' => 'No',
            'stock_hasmany' => 'No',
            'can_edit' => 'Yes',
            'required' => 'No',
            'parent_id' => $PotatoVariety->id,
        ]);
        /***************Potato Variety Values ***************/
        
                    $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Accent'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Accent',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Accord'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Accord',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Adora'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Adora',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Agria'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Agria',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Deep yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Deep yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Almera'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Almera',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Alouette'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Alouette',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Alverstone Russet'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Alverstone Russet',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Russet'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Russet',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Amany'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Amany',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Ambassador'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Ambassador',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Ambo'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Ambo',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Deep'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Deep',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Amora'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Amora',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Amorosa'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Amorosa',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Angelique'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Angelique',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Anna'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Anna',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Annabelle'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Annabelle',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Anya'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Anya',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very deep'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very deep',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Apache'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Apache',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium - deep'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium - deep',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Argos'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Argos',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Ariata'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Ariata',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Arizona'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Arizona',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Arran Banner'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Arran Banner',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Round'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Round',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium - deep'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium - deep',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Arran Comet'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Arran Comet',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Arran Pilot'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Arran Pilot',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Arran Victory'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Arran Victory',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Blue'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Blue',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Arsenal'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Arsenal',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Asparges'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Asparges',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium - deep'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium - deep',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Asterix'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Asterix',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Athlete'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Athlete',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Atlantic'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Atlantic',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Avalanche'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Avalanche',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Avondale'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Avondale',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Axona'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Axona',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Ballydoon'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Ballydoon',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Balmoral'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Balmoral',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Bambino'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Bambino',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Banba'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Banba',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Barna'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Barna',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Belle De Fontenay'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Belle De Fontenay',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Betty'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Betty',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Blue Belle'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Blue Belle',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Blue parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Blue parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Blue Danube'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Blue Danube',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Blue'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Blue',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Bonnata'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Bonnata',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Bonnie'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Bonnie',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Bounty'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Bounty',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Bremner'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Bremner',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Bricata'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Bricata',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'British Queen'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'British Queen',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Brooke'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Brooke',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Round'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Round',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Burren'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Burren',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Bute'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Bute',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Cabaret'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Cabaret',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Caesar'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Caesar',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Camel'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Camel',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Camelot'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Camelot',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Cammeo'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Cammeo',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Captain'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Captain',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Capucine'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Capucine',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Deep yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Deep yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Cara'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Cara',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Carlingford'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Carlingford',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Round'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Round',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Carnaval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Carnaval',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Carolus'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Carolus',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Casablanca'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Casablanca',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Catriona'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Catriona',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Blue parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Blue parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Celine'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Celine',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Challenger'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Challenger',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Charlemont'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Charlemont',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Charlotte'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Charlotte',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Charlton'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Charlton',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Chaski'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Chaski',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Chicago'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Chicago',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Chincha'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Chincha',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium - deep'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium - deep',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Chopin'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Chopin',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Churchill'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Churchill',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Clairette'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Clairette',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Claret'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Claret',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Clevna'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Clevna',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Colleen'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Colleen',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Colomba'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Colomba',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Compass'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Compass',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Constance'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Constance',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Corolle'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Corolle',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Cosmos'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Cosmos',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Courage'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Courage',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Round'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Round',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Courlan'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Courlan',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Crisps4all'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Crisps4all',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Cultra'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Cultra',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Daisy'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Daisy',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Desiree'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Desiree',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Divaa'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Divaa',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Dolly'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Dolly',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Round'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Round',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Druid'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Druid',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Duke Of York'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Duke Of York',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Dunbar Rover'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Dunbar Rover',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Dunbar Standard'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Dunbar Standard',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Dundrod'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Dundrod',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Dunluce'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Dunluce',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Edony'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Edony',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Round'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Round',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Edzell Blue'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Edzell Blue',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Blue'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Blue',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Electra'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Electra',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Elisabeth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Elisabeth',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Deep'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Deep',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Elland'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Elland',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Ellie'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Ellie',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Emblem'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Emblem',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Round'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Round',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Emily'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Emily',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Emma'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Emma',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Round'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Round',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Epicure'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Epicure',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Round'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Round',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Deep - very deep'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Deep - very deep',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Erntestolz'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Erntestolz',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Estima'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Estima',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Eurostar'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Eurostar',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Excalibur'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Excalibur',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Fambo'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Fambo',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Fandango'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Fandango',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Fianna'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Fianna',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'FL2339'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'FL2339',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Fontane'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Fontane',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Foremost'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Foremost',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Gabriel'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Gabriel',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Round'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Round',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Deep'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Deep',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Gael'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Gael',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Galactica'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Galactica',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Gatsby'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Gatsby',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Gemson'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Gemson',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Georgina'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Georgina',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Gervioline'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Gervioline',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Blue'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Blue',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Golden Beauty'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Golden Beauty',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Golden Nugget'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Golden Nugget',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Golden Sun'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Golden Sun',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Golden Wonder'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Golden Wonder',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Russet'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Russet',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Gourmandine'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Gourmandine',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Gwenne'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Gwenne',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Habibi'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Habibi',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Harlequin'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Harlequin',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Very long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Harmony'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Harmony',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Round'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Round',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Heraclea'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Heraclea',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Hermes'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Hermes',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Highland Burgundy Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Highland Burgundy Red',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Parti-coloured red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Parti-coloured red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Rough'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Rough',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Home Guard'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Home Guard',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Horizon'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Horizon',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Imagine'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Imagine',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Inca Bella'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Inca Bella',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Inca Dawn'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Inca Dawn',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Deep yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Deep yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium - deep'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium - deep',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Infinity'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Infinity',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Innovator'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Innovator',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Russet'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Russet',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Rough'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Rough',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'International Kidney'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'International Kidney',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Isle Of Jura'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Isle Of Jura',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Ivory Russet'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Ivory Russet',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Jaerla'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Jaerla',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Jazzy'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Jazzy',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Jelly'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Jelly',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Jester'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Jester',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Joshua'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Joshua',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Round'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Round',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very deep'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very deep',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Jubilee'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Jubilee',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Juliette'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Juliette',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Karlena'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Karlena',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Kelly'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Kelly',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Kennebec'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Kennebec',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Kestrel'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Kestrel',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Blue parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Blue parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Kifli'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Kifli',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Kikko'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Kikko',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'King Edward'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'King Edward',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Kingsman'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Kingsman',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Kondor'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Kondor',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'La Strada'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'La Strada',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Lady Amarilla'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Lady Amarilla',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Lady Anna'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Lady Anna',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Lady Balfour'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Lady Balfour',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Lady Christl'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Lady Christl',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Lady Claire'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Lady Claire',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Lady Jo'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Lady Jo',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Lady Olympia'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Lady Olympia',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Lady Rosetta'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Lady Rosetta',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Round'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Round',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Lady Valora'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Lady Valora',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Lanorma'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Lanorma',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Leonata'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Leonata',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Libertie'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Libertie',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Linton'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Linton',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Lionheart'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Lionheart',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Lomond'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Lomond',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Lorimer'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Lorimer',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Lulu'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Lulu',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Round'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Round',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Madingley'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Madingley',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Deep yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Deep yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Round'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Round',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Majestic'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Majestic',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Malin'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Malin',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Malou'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Malou',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Manhattan'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Manhattan',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Manitou'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Manitou',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Marfona'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Marfona',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Maris Bard'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Maris Bard',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Maris Peer'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Maris Peer',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Maris Piper'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Maris Piper',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Maritiema'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Maritiema',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Markies'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Markies',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Marvel'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Marvel',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Marys Rose'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Marys Rose',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Maxine'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Maxine',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Mayan Gold'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Mayan Gold',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Very long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Blue parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Blue parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Mayan Queen'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Mayan Queen',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Deep yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Deep yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Deep'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Deep',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => "Kerr\'s Pink"],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => "Kerr\'s Pink",
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Mayan Rose'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Mayan Rose',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Parti-coloured red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Parti-coloured red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Mayan Star'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Mayan Star',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Parti-coloured red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Parti-coloured red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Mayan Twilight'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Mayan Twilight',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Parti-coloured red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Parti-coloured red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Melody'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Melody',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Merlin'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Merlin',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Milton'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Milton',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Mimi'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Mimi',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Round'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Round',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Mistay'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Mistay',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Morene'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Morene',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Moulin Rouge'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Moulin Rouge',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Very long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium - deep'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium - deep',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Mozart'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Mozart',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Mustang'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Mustang',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Nadine'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Nadine',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Navan'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Navan',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Nectar'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Nectar',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Newton'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Newton',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Nicola'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Nicola',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Nieta'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Nieta',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Nitza'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Nitza',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Olympus'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Olympus',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Orchestra'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Orchestra',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Orla'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Orla',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Orwell'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Orwell',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Osprey'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Osprey',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Panther'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Panther',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Paramount'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Paramount',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Paru'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Paru',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Deep yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Deep yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Pentland Crown'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Pentland Crown',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Pentland Dell'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Pentland Dell',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Pentland Ivory'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Pentland Ivory',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Pentland Javelin'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Pentland Javelin',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Pentland Squire'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Pentland Squire',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Performer'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Performer',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Russet'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Russet',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Rough'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Rough',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Picasso'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Picasso',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Piccolo Star'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Piccolo Star',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Pink Fir Apple'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Pink Fir Apple',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Very long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Deep'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Deep',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Pink Gypsy'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Pink Gypsy',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Pioneer'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Pioneer',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Pippa'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Pippa',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Pixie'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Pixie',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Pizazz'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Pizazz',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Premiere'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Premiere',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Primura'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Primura',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Purple Majesty'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Purple Majesty',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Blue'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Blue',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Radebe'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Radebe',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Raleigh'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Raleigh',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Ramos'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Ramos',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Ranger Russet'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Ranger Russet',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Rough'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Rough',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Record'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Record',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Rough'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Rough',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Red Cara'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Red Cara',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Red Duke Of York'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Red Duke Of York',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Red Emmalie'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Red Emmalie',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Red Pontiac'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Red Pontiac',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Redrobin'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Redrobin',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Reiver'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Reiver',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Remarka'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Remarka',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Rembrandt'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Rembrandt',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Revie'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Revie',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Richhill'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Richhill',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Robinta'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Robinta',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Rock'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Rock',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Rocket'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Rocket',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Round'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Round',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Romano'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Romano',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Rooster'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Rooster',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Roscor'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Roscor',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Roseval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Roseval',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Royal'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Royal',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Royal Kidney'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Royal Kidney',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Rubesse'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Rubesse',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Rudolph'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Rudolph',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Russet Burbank'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Russet Burbank',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Deep'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Deep',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Safari'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Safari',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Safiyah'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Safiyah',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Sagitta'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Sagitta',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Sandpiper'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Sandpiper',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Sante'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Sante',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Saphire'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Saphire',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Sarpo Gwyn'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Sarpo Gwyn',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Sarpo Mira'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Sarpo Mira',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Sarpo Shona'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Sarpo Shona',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Sarpo Una'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Sarpo Una',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Sassy'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Sassy',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Saturna'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Saturna',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium - deep'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium - deep',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Savanna'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Savanna',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Saxon'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Saxon',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Scapa'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Scapa',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Deep yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Deep yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Sebastian'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Sebastian',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Setanta'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Setanta',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Shannon'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Shannon',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Shelford'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Shelford',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Shepody'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Shepody',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Sierra'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Sierra',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Sifra'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Sifra',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Slaney'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Slaney',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Smile'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Smile',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Sofia'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Sofia',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Sorrento'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Sorrento',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Sparkle'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Sparkle',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Spunta'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Spunta',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Stemster'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Stemster',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Strachan'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Strachan',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Stroma'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Stroma',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Sunita'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Sunita',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Sunray'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Sunray',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Sunrise'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Sunrise',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Sunset'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Sunset',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Swift'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Swift',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Sylvana'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Sylvana',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Tabitha'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Tabitha',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Taurus'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Taurus',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Toluca'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Toluca',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Tresdale'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Tresdale',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Tribute'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Tribute',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Triplo'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Triplo',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Trixie'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Trixie',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Blue parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Blue parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'TX 15231'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'TX 15231',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Tyson'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Tyson',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Ulster Chieftain'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Ulster Chieftain',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Ulster Prince'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Ulster Prince',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Ulster Sceptre'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Ulster Sceptre',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium - deep'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium - deep',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Up-to-date'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Up-to-date',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Upmarket'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Upmarket',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Vales Emerald'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Vales Emerald',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Vales Everest'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Vales Everest',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Vales Sovereign'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Vales Sovereign',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Valor'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Valor',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Vanessa'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Vanessa',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Venezia'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Venezia',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Verity'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Verity',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Victoria'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Victoria',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Violet Queen'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Violet Queen',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Parti-coloured blue'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Parti-coloured blue',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Blue parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Blue parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Violetta'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Violetta',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Blue'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Blue',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Virgo'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Virgo',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Vivaldi'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Vivaldi',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Cream'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Cream',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Vizelle'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Vizelle',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Volare'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Volare',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Very shallow - shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Very shallow - shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'VR808'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'VR808',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Round'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Round',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'White Lady'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'White Lady',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Wilja'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Wilja',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Rough'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Rough',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Winston'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Winston',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Wizard'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Wizard',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Yukon Gold'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Yukon Gold',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Red parti-coloured'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Red parti-coloured',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Zahov'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Zahov',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Zohar'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Zohar',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Medium yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow - medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow - medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => "Sharpe\'s Express"],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => "Sharpe\'s Express",
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Creme'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Creme',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Oval - long'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Oval - long',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Shallow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Shallow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => "Smith\'s Comet"],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => "Smith\'s Comet",
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Light Yellow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Light Yellow',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $TuberShape->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Short - oval'],[
               'product_id' => $Product->id,
               'product_specification_id' => $TuberShape->id,
               'value' => 'Short - oval',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $DepthOfEyes->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Medium'],[
               'product_id' => $Product->id,
               'product_specification_id' => $DepthOfEyes->id,
               'value' => 'Medium',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $SmoothnessOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Smooth'],[
               'product_id' => $Product->id,
               'product_specification_id' => $SmoothnessOfSkin->id,
               'value' => 'Smooth',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Alex (2018)'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Alex (2018)',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Andeana'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Andeana',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

            $ProductSpecificationValueVar = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $PotatoVariety->id,'value' => 'Arrow'],[
               'product_id' => $Product->id,
               'product_specification_id' => $PotatoVariety->id,
               'parent_id' => NULL,
               'value' => 'Arrow',
               'premium' => NULL,
               'volume' => NULL,
               'default' => NULL,
               'status' => 1,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $FleshColorChild->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'Any Flesh Color'],[
               'product_id' => $Product->id,
               'product_specification_id' => $FleshColorChild->id,
               'value' => 'Any Flesh Color',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);
            $SubValue = App\ProductSpecificationValue::firstOrCreate(['product_id' => $Product->id,'product_specification_id' => $ColourOfSkin->id,'parent_id' => $ProductSpecificationValueVar->id,'value' => 'White'],[
               'product_id' => $Product->id,
               'product_specification_id' => $ColourOfSkin->id,
               'value' => 'White',
               'status' => 1,
               'parent_id' => $ProductSpecificationValueVar->id,
            ]);

         $Product2 = App\Product::firstOrCreate(['name' => 'Cauliflower'],[
            'name' => 'Cauliflower',
            'name_pl' => 'Kalafior',
            'name_de' => 'Blumenkohl',
            'status' => '1',
            'image' => 'cauliflower_home.jpg',
            'homepage_image' => 'cauliflower_home.jpg'
         ]);

         $Product3 = App\Product::firstOrCreate(['name' => 'Onion'],[
            'name' => 'Onion',
            'name_pl' => 'Cebula',
            'name_de' => 'Zwiebel',
            'status' => '1',
            'image' => 'onion_home.jpg',
            'homepage_image' => 'onion_home.jpg'
         ]);

         $Product4 = App\Product::firstOrCreate(['name' => 'Cabbage'],[
            'name' => 'Cabbage',
            'name_pl' => 'Kapusta',
            'name_de' => 'Kohl',
            'status' => '1',
            'image' => 'cabbage_home.jpg',
            'homepage_image' => 'cabbage_home.jpg'
         ]);

         $Product5 = App\Product::firstOrCreate(['name' => 'Beets'],[
            'name' => 'Beets',
            'name_pl' => 'Buraki',
            'name_de' => 'Rote Bete',
            'status' => '1',
            'image' => 'beets_home.jpg',
            'homepage_image' => 'beets_home.jpg'
         ]);

         $Product6 = App\Product::firstOrCreate(['name' => 'Broccoli'],[
            'name' => 'Broccoli',
            'name_pl' => 'Broccoli',
            'name_de' => 'Brokkoli',
            'status' => '1',
            'image' => 'brocolli_home.jpg',
            'homepage_image' => 'brocolli_home.jpg'
         ]);

         $Product7 = App\Product::firstOrCreate(['name' => 'Apples'],[
            'name' => 'Apples',
            'name_pl' => 'Jablka',
            'name_de' => 'Apfel', 
            'status' => '1',
            'image' => 'apple_home.jpg',
            'homepage_image' => 'apple_home.jpg'
         ]);

    }
}