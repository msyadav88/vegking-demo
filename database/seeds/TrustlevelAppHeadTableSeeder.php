<?php

use Illuminate\Database\Seeder;

class TrustlevelAppHeadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           App\AppHead::firstOrCreate(
                ['unique_hash' => md5('0'.'trust_level')],
                [   'name' => '0',
                    'desc' => 'BLACKLIST @red',
                    'type' => 'trust_level',
                    'order' => 0,
                    'unique_hash' => md5('Yellow'.'trust_level')
            ]);
           App\AppHead::firstOrCreate(
                ['unique_hash' => md5('1'.'trust_level')],
                [   'name' => '1',
                    'desc' => 'Very suspicious @red',
                    'type' => 'trust_level',
                    'order' => 1,
                    'unique_hash' => md5('1'.'trust_level')
            ]);
           App\AppHead::firstOrCreate(
                ['unique_hash' => md5('2'.'trust_level')],
                [   'name' => '2',
                    'desc' => 'Very suspicious @orange',
                    'type' => 'trust_level',
                    'order' => 2,
                    'unique_hash' => md5('2'.'trust_level')
            ]);
           App\AppHead::firstOrCreate(
                ['unique_hash' => md5('3'.'trust_level')],
                [   'name' => '3',
                    'desc' => 'Suspicious @orange',
                    'type' => 'trust_level',
                    'order' => 3,
                    'unique_hash' => md5('3'.'trust_level')
            ]);
           App\AppHead::firstOrCreate(
                ['unique_hash' => md5('4'.'trust_level')],
                [   'name' => '4',
                    'desc' => 'Slightly suspicious @yellow',
                    'type' => 'trust_level',
                    'order' => 4,
                    'unique_hash' => md5('4'.'trust_level')
            ]);
           App\AppHead::firstOrCreate(
                ['unique_hash' => md5('5'.'trust_level')],
                [   'name' => '5',
                    'desc' => 'Normal @yellow',
                    'type' => 'trust_level',
                    'order' => 5,
                    'unique_hash' => md5('5'.'trust_level')
            ]);
           App\AppHead::firstOrCreate(
                ['unique_hash' => md5('6'.'trust_level')],
                [   'name' => '6',
                    'desc' => 'Looks ok @green',
                    'type' => 'trust_level',
                    'order' => 6,
                    'unique_hash' => md5('6'.'trust_level')
            ]);
           App\AppHead::firstOrCreate(
                ['unique_hash' => md5('7'.'trust_level')],
                [   'name' => '7',
                    'desc' => 'Highly Trusted @green',
                    'type' => 'trust_level',
                    'order' => 7,
                    'unique_hash' => md5('7'.'trust_level')
            ]);
    }
}
