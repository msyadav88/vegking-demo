<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\Product::create([
          'name' => 'Potato',
          'variety' => 'White Potatoes',
          'size_from' => '5mm',
          'size_to' => '10mm',
          'packing' => 'Packing',
          'quantity' => '1000kg',
          'flesh_color' => 'Lighter Colored',
          'location' => 'UK',
          'price' => '1000.00'
      ]);

      App\Product::create([
          'name' => 'Potato',
          'variety' => 'Russets',
          'size_from' => '5mm',
          'size_to' => '10mm',
          'packing' => 'Packing',
          'quantity' => '1000kg',
          'flesh_color' => 'Rough Brown',
          'location' => 'UK',
          'price' => '1000.00'
      ]);      

    }
}
