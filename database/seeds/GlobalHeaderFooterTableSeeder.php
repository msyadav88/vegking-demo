<?php

use Illuminate\Database\Seeder;

class GlobalHeaderFooterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\EmailTemplateHeaderFooter::firstOrCreate([
            'header_en' => '[title] [recipient], [env] [role] [level],',
            'header_de' => '[title] [recipient], [env] [role] [level],',
            'header_pl' => '[title] [recipient], [env] [role] [level],',
            'footer_en' => 'Thanks for being part of VegKing',
            'footer_de' => 'Thanks for being part of VegKing',
            'footer_pl' => 'Thanks for being part of VegKing',
            'status' => '1'
        ]);
    }
}
