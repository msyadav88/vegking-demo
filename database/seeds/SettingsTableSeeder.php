<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Setting::updateOrCreate(['site_lang' => 'en'],[
            'site_name' => 'VEG KING EUROPE',
            'email' => 'info@vegking.eu',
            'phone' => '+48 22 122 87 69',
            'address' => 'VK Address<br/> VegKing Europe Sp. Zoo. <br/> ul. Grzybowska 80/82, <br/> 00-844 Warsaw',
            'footer_about' => 'Professional vegetable distributor in Europe. We help to ensure the development of your company thanks to fast and timely deliveries throughout the year.',
            'currency' => '£',
            'site_logo' => 'vegking-logo-1568902551.png',
            'site_favicon' => 'vegking-logo-icon-1568902551.png',
            'site_lang' => 'en',
        ]);
        App\Setting::updateOrCreate(['site_lang' => 'pl'],[
            'site_name' => 'VEG KING EUROPE',
            'email' => 'info@vegking.eu',
            'phone' => '+48 22 122 87 69',
            'address' => 'VK Address<br/>VegKing Europe Sp. z o.o.<br/>ul. Grzybowska 80/82,<br/>00-844 Warszawa',
            'footer_about' => 'Profesjonalny dystrybutor warzyw w Europie. Pomagamy zapewnić rozwój Twojego przedsiębiorstwa dzięki szybkim i terminowym dostawom przez cały rok.',
            'currency' => '£',
            'site_logo' => 'vegking-logo-1568902551.png',
            'site_favicon' => 'vegking-logo-icon-1568902551.png',
            'site_lang' => 'pl',
        ]);
        App\Setting::updateOrCreate(['site_lang' => 'de'],[
            'site_name' => 'VEG KING EUROPE',
            'email' => 'info@vegking.eu',
            'phone' => '+48 22 122 87 69',
            'address' => 'VK Address<br/>VegKing Europe Sp. z o.o.<br/>ul. Grzybowska 80/82,<br/>00-844 Warszawa',
            'footer_about' => 'Experte im Vertrieb von Gemüse in Europa. Wir helfen Ihnen bei der Entwicklung Ihres Unternehmens durch schnelle und fristgerechte Lieferungen das ganze Jahr über.',
            'currency' => '£',
            'site_logo' => 'vegking-logo-1568902551.png',
            'site_favicon' => 'vegking-logo-icon-1568902551.png',
            'site_lang' => 'de',
        ]);
    }
}
