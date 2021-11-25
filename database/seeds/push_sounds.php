<?php

use Illuminate\Database\Seeder;

class push_sounds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Pushsounds::firstOrCreate(['android_sound' => 'f8377f70-c4c1-419a-ada3-3dab056731a7', 'ios_sound' => 'sound_one.wav', 'status' => '0'],
        [
            'android_sound' => 'f8377f70-c4c1-419a-ada3-3dab056731a7',
            'ios_sound' => 'sound_one.wav',
            'status' => '0',
        ]);
        App\Pushsounds::firstOrCreate(['android_sound' => '7dd7dfc4-e290-4fac-979e-b3631bc41f89', 'ios_sound' => 'sound_two.wav', 'status' => '1'],
        [
            'android_sound' => '7dd7dfc4-e290-4fac-979e-b3631bc41f89',
            'ios_sound' => 'sound_two.wav',
            'status' => '1',
        ]);
    }
}
