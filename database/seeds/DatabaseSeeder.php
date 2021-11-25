<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        Model::unguard();

        $this->truncateMultiple([
            'cache',
            'jobs',
            'sessions',
        ]);

        $this->call(AuthTableSeeder::class);
        $this->call(push_sounds::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(AppHeadTableSeeder::class);
        $this->call(PostalCodeTableSeeder::class);
        $this->call(TrustlevelAppHeadTableSeeder::class);
        $this->call(EmailTemplatesTableSeeder::class);
        $this->call(LanguageLineTableSeeder::class);
        $this->call(LanguageContentTableSeeder::class);
        $this->call(LoadstatusTableSeeder::class);
        
        $this->call(PotatoServiceSeeder::class);
        $this->call(VegSpecificTableSeeder::class);
        $this->call(CarrotSpecificTableSeeder::class);
        $this->call(AppleSpecificTableSeeder::class);
        $this->call(MatchesNameTableSeeder::class);
       
        Model::reguard();
    }
}
