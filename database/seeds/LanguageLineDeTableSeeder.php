<?php

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;
class LanguageLineDeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LanguageLine::updateOrCreate(['group'=>'email','key'=>'confirm_email'],[
            'group' => 'email',
            'key' => 'confirm_email',
            'text' => ["en" => "Confirm Email","pl" => "Potwierdź email","de" => "Bestätigungs-E-Mail"]
        ]);
    }
}
