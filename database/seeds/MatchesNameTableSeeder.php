<?php

use Illuminate\Database\Seeder;

class MatchesNameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\MatchesName::firstOrCreate([
            'short_names' => '["P\/Ton","QTS","QNS","TSB","TSS","Buyer","Seller","PID","SID","Size","Flesh Color","Packaging","Defects","Purpose","Potato Variety","Flesh Color","Dry Matter","Tuber Shape","Color Of Skin","Depth Of Eyes","Smoothness Of Skin","Quality Size","Size","Cleaning","Extra Services","Market Processing","#MM","MM","Added","Actions","ID"]',
            'status' => '1'
        ]);
    }
}
