<?php

use Illuminate\Database\Seeder;

class updateReocrdProductSpecificationValSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_specification_values')->update(['ec' => '30','ecbf'=>'1.6']);
    }
}