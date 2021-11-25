<?php
use App\Loadstatus;
use Illuminate\Database\Seeder;

class LoadstatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Loadstatus::create([
            'status' => 'Unplanned'
        ]);
		
		Loadstatus::create([
            'status' => 'Planned'
        ]);

        Loadstatus::create([
            'status' => 'Loaded'
        ]);

        Loadstatus::create([
            'status' => 'Unloaded'
        ]);

        Loadstatus::create([
            'status' => 'Rejected'
        ]);

        Loadstatus::create([
            'status' => 'In Store'
        ]);

        Loadstatus::create([
            'status' => 'Other'
        ]);
 
    }
}
