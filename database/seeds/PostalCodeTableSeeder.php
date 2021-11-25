<?php

use Illuminate\Database\Seeder;

class PostalCodeTableSeeder extends Seeder
{
   /**
   * Run the database seeds.
   *
   * @return void
   */
   public function run()
   {
      App\PostalCode::firstOrCreate(['name' => 'Belgium', 'code' => 'BE', 'ph_code' => '32', 'postal_code' => NULL],
      [
         'name' => 'Belgium',
         'code' => 'BE',
         'ph_code' => '32',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Austria', 'code' => 'AT', 'ph_code' => '43', 'postal_code' => NULL],
      [
         'name' => 'Austria',
         'code' => 'AT',
         'ph_code' => '43',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Bulgaria', 'code' => 'BG', 'ph_code' => '359', 'postal_code' => NULL],
      [
         'name' => 'Bulgaria',
         'code' => 'BG',
         'ph_code' => '359',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Croatia', 'code' => 'HR', 'ph_code' => '385', 'postal_code' => NULL],
      [
         'name' => 'Croatia',
         'code' => 'HR',
         'ph_code' => '385',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Cyprus', 'code' => 'CY', 'ph_code' => '357', 'postal_code' => NULL],
      [
         'name' => 'Cyprus',
         'code' => 'CY',
         'ph_code' => '357',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Czechia', 'code' => 'CZ', 'ph_code' => '420', 'postal_code' => NULL],
      [
         'name' => 'Czechia',
         'code' => 'CZ',
         'ph_code' => '420',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Denmark', 'code' => 'DK', 'ph_code' => '45', 'postal_code' => NULL],
      [
         'name' => 'Denmark',
         'code' => 'DK',
         'ph_code' => '45',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Estonia', 'code' => 'EE', 'ph_code' => '372', 'postal_code' => NULL],
      [
         'name' => 'Estonia',
         'code' => 'EE',
         'ph_code' => '372',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Finland', 'code' => 'FI', 'ph_code' => '358', 'postal_code' => NULL],
      [
         'name' => 'Finland',
         'code' => 'FI',
         'ph_code' => '358',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'France', 'code' => 'FR', 'ph_code' => '33', 'postal_code' => NULL],
      [
         'name' => 'France',
         'code' => 'FR',
         'ph_code' => '33',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Germany', 'code' => 'DE', 'ph_code' => '49', 'postal_code' => NULL],
      [
         'name' => 'Germany',
         'code' => 'DE',
         'ph_code' => '49',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Greece', 'code' => 'GR', 'ph_code' => '30', 'postal_code' => NULL],
      [
         'name' => 'Greece',
         'code' => 'GR',
         'ph_code' => '30',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Hungary', 'code' => 'HU', 'ph_code' => '36', 'postal_code' => NULL],
      [
         'name' => 'Hungary',
         'code' => 'HU',
         'ph_code' => '36',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Ireland', 'code' => 'IE', 'ph_code' => '353', 'postal_code' => NULL],
      [
         'name' => 'Ireland',
         'code' => 'IE',
         'ph_code' => '353',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Italy', 'code' => 'IT', 'ph_code' => '39', 'postal_code' => NULL],
      [
         'name' => 'Italy',
         'code' => 'IT',
         'ph_code' => '39',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Latvia', 'code' => 'LV', 'ph_code' => '371', 'postal_code' => NULL],
      [
         'name' => 'Latvia',
         'code' => 'LV',
         'ph_code' => '371',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Lithuania', 'code' => 'LT', 'ph_code' => '370', 'postal_code' => NULL],
      [
         'name' => 'Lithuania',
         'code' => 'LT',
         'ph_code' => '370',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Luxembourg', 'code' => 'LU', 'ph_code' => '352', 'postal_code' => NULL],
      [
         'name' => 'Luxembourg',
         'code' => 'LU',
         'ph_code' => '352',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Malta', 'code' => 'MT', 'ph_code' => '356', 'postal_code' => NULL],
      [
         'name' => 'Malta',
         'code' => 'MT',
         'ph_code' => '356',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Netherlands', 'code' => 'NL', 'ph_code' => '31', 'postal_code' => NULL],
      [
         'name' => 'Netherlands',
         'code' => 'NL',
         'ph_code' => '31',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Poland', 'code' => 'PL', 'ph_code' => '48', 'postal_code' => NULL],
      [
         'name' => 'Poland',
         'code' => 'PL',
         'ph_code' => '48',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Portugal', 'code' => 'PT', 'ph_code' => '351', 'postal_code' => NULL],
      [
         'name' => 'Portugal',
         'code' => 'PT',
         'ph_code' => '351',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Romania', 'code' => 'RO', 'ph_code' => '40', 'postal_code' => NULL],
      [
         'name' => 'Romania',
         'code' => 'RO',
         'ph_code' => '40',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Slovakia', 'code' => 'SK', 'ph_code' => '421', 'postal_code' => NULL],
      [
         'name' => 'Slovakia',
         'code' => 'SK',
         'ph_code' => '421',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Slovenia', 'code' => 'SI', 'ph_code' => '386', 'postal_code' => NULL],
      [
         'name' => 'Slovenia',
         'code' => 'SI',
         'ph_code' => '386',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Spain', 'code' => 'ES', 'ph_code' => '34', 'postal_code' => NULL],
      [
         'name' => 'Spain',
         'code' => 'ES',
         'ph_code' => '34',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Sweden', 'code' => 'SE', 'ph_code' => '46', 'postal_code' => NULL],
      [
         'name' => 'Sweden',
         'code' => 'SE',
         'ph_code' => '46',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'United Kingdom', 'code' => 'UK', 'ph_code' => '44', 'postal_code' => NULL],
      [
         'name' => 'United Kingdom',
         'code' => 'UK',
         'ph_code' => '44',
         'postal_code' => NULL,
         'postal_code_short' => NULL,
         'country' => NULL,
         'price' => 0,
         'type' => 'country',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Warsaw (west part)', 'code' => '', 'ph_code' => '', 'postal_code' => '00-XXX'],
      [
         'name' => 'Warsaw (west part)',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '00-XXX',
         'postal_code_short' => '00',
         'country' => 'PL',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Warsaw (west part)', 'code' => '', 'ph_code' => '', 'postal_code' => '02-XXX'],
      [
         'name' => 'Warsaw (west part)',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '02-XXX',
         'postal_code_short' => '02',
         'country' => 'PL',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Warsaw (east part)', 'code' => '', 'ph_code' => '', 'postal_code' => '03-XXX'],
      [
         'name' => 'Warsaw (east part)',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '03-XXX',
         'postal_code_short' => '03',
         'country' => 'PL',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Warsaw (east part)', 'code' => '', 'ph_code' => '', 'postal_code' => '04-XXX'],
      [
         'name' => 'Warsaw (east part )',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '04-XXX',
         'postal_code_short' => '04',
         'country' => 'PL',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Warsaw (east part)', 'code' => '', 'ph_code' => '', 'postal_code' => '05-XXX'],
      [
         'name' => 'Warsaw (east  part)',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '05-XXX',
         'postal_code_short' => '05',
         'country' => 'PL',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'PuÅ‚tusk', 'code' => '', 'ph_code' => '', 'postal_code' => '06-100'],
      [
         'name' => 'PuÅ‚tusk',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '06-100',
         'postal_code_short' => '06',
         'country' => 'PL',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'WegrÃ³w', 'code' => '', 'ph_code' => '', 'postal_code' => '07-100'],
      [
         'name' => 'WegrÃ³w',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '07-100',
         'postal_code_short' => '07',
         'country' => 'PL',
         'price' => 10,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Siedlce', 'code' => '', 'ph_code' => '', 'postal_code' => '08-100'],
      [
         'name' => 'Siedlce',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '08-100',
         'postal_code_short' => '08',
         'country' => 'PL',
         'price' => 12,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'PÅ‚oÅ„sk', 'code' => '', 'ph_code' => '', 'postal_code' => '09-100'],
      [
         'name' => 'PÅ‚oÅ„sk',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '09-100',
         'postal_code_short' => '09',
         'country' => 'PL',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Olsztyn', 'code' => '', 'ph_code' => '', 'postal_code' => '10-001'],
      [
         'name' => 'Olsztyn',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '10-001',
         'postal_code_short' => '10',
         'country' => 'PL',
         'price' => 14,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Barczewo', 'code' => '', 'ph_code' => '', 'postal_code' => '11-010'],
      [
         'name' => 'Barczewo',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '11-010',
         'postal_code_short' => '11',
         'country' => 'PL',
         'price' => 16,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Szczytno', 'code' => '', 'ph_code' => '', 'postal_code' => '12-100'],
      [
         'name' => 'Szczytno',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '12-100',
         'postal_code_short' => '12',
         'country' => 'PL',
         'price' => 14,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Nidzica', 'code' => '', 'ph_code' => '', 'postal_code' => '13-100'],
      [
         'name' => 'Nidzica',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '13-100',
         'postal_code_short' => '13',
         'country' => 'PL',
         'price' => 14,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'IÅ‚awa', 'code' => '', 'ph_code' => '', 'postal_code' => '14-200'],
      [
         'name' => 'IÅ‚awa',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '14-200',
         'postal_code_short' => '147',
         'country' => 'PL',
         'price' => 14,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'BiaÅ‚ystok', 'code' => '', 'ph_code' => '', 'postal_code' => '15-001'],
      [
         'name' => 'BiaÅ‚ystok',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '15-001',
         'postal_code_short' => '15',
         'country' => 'PL',
         'price' => 16,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'AugustÃ³w', 'code' => '', 'ph_code' => '', 'postal_code' => '16-300'],
      [
         'name' => 'AugustÃ³w',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '16-300',
         'postal_code_short' => '16',
         'country' => 'PL',
         'price' => 18,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Bielsk Podlaski', 'code' => '', 'ph_code' => '', 'postal_code' => '17-100'],
      [
         'name' => 'Bielsk Podlaski',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '17-100',
         'postal_code_short' => '17',
         'country' => 'PL',
         'price' => 16,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Åapy', 'code' => '', 'ph_code' => '', 'postal_code' => '18-100'],
      [
         'name' => 'Åapy',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '18-100',
         'postal_code_short' => '18',
         'country' => 'PL',
         'price' => 14,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Grajewo', 'code' => '', 'ph_code' => '', 'postal_code' => '19-200'],
      [
         'name' => 'Grajewo',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '19-200',
         'postal_code_short' => '19',
         'country' => 'PL',
         'price' => 18,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Lublin', 'code' => '', 'ph_code' => '', 'postal_code' => '20-001'],
      [
         'name' => 'Lublin',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '20-001',
         'postal_code_short' => '20',
         'country' => 'PL',
         'price' => 16,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'ÅÄ™czna', 'code' => '', 'ph_code' => '', 'postal_code' => '21-010'],
      [
         'name' => 'ÅÄ™czna',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '21-010',
         'postal_code_short' => '21',
         'country' => 'PL',
         'price' => 16,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'CheÅ‚m', 'code' => '', 'ph_code' => '', 'postal_code' => '22-100'],
      [
         'name' => 'CheÅ‚m',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '22-100',
         'postal_code_short' => NULL,
         'country' => 'PL',
         'price' => 20,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'KraÅ›nik', 'code' => '', 'ph_code' => '', 'postal_code' => '23-200'],
      [
         'name' => 'KraÅ›nik',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '23-200',
         'postal_code_short' => '23',
         'country' => 'PL',
         'price' => 18,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'PuÅ‚awy', 'code' => '', 'ph_code' => '', 'postal_code' => '24-100'],
      [
         'name' => 'PuÅ‚awy',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '24-100',
         'postal_code_short' => '24',
         'country' => 'PL',
         'price' => 16,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Kielce', 'code' => '', 'ph_code' => '', 'postal_code' => '25-001'],
      [
         'name' => 'Kielce',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '25-001',
         'postal_code_short' => NULL,
         'country' => 'PL',
         'price' => 12,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'KoÅ„skie', 'code' => '', 'ph_code' => '', 'postal_code' => '26-200'],
      [
         'name' => 'KoÅ„skie',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '26-200',
         'postal_code_short' => '26',
         'country' => 'PL',
         'price' => 12,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'IÅ‚Å¼a', 'code' => '', 'ph_code' => '', 'postal_code' => '27-100'],
      [
         'name' => 'IÅ‚Å¼a',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '27-100',
         'postal_code_short' => '27',
         'country' => 'PL',
         'price' => 14,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Busko-ZdrÃ³j', 'code' => '', 'ph_code' => '', 'postal_code' => '28-100'],
      [
         'name' => 'Busko-ZdrÃ³j',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '28-100',
         'postal_code_short' => '28',
         'country' => 'PL',
         'price' => 12,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'WÅ‚oszczowa', 'code' => '', 'ph_code' => '', 'postal_code' => '29-100'],
      [
         'name' => 'WÅ‚oszczowa',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '29-100',
         'postal_code_short' => '29',
         'country' => 'PL',
         'price' => 10,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'KrakÃ³w', 'code' => '', 'ph_code' => '', 'postal_code' => '30-024'],
      [
         'name' => 'KrakÃ³w',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '30-024',
         'postal_code_short' => '30',
         'country' => 'PL',
         'price' => 12,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'KrakÃ³w .', 'code' => '', 'ph_code' => '', 'postal_code' => '31-999'],
      [
         'name' => 'KrakÃ³w .',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '31-999',
         'postal_code_short' => '31',
         'country' => 'PL',
         'price' => 12,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Wieliczka .', 'code' => '', 'ph_code' => '', 'postal_code' => '32-020'],
      [
         'name' => 'Wieliczka',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '32-020',
         'postal_code_short' => '32',
         'country' => 'PL',
         'price' => 12,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'TarnÃ³w', 'code' => '', 'ph_code' => '', 'postal_code' => '33-110'],
      [
         'name' => 'TarnÃ³w',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '33-110',
         'postal_code_short' => '33',
         'country' => 'PL',
         'price' => 16,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Wadowice', 'code' => '', 'ph_code' => '', 'postal_code' => '34-100'],
      [
         'name' => 'Wadowice',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '34-100',
         'postal_code_short' => '34',
         'country' => 'PL',
         'price' => 14,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'RzeszÃ³w', 'code' => '', 'ph_code' => '', 'postal_code' => '35-000'],
      [
         'name' => 'RzeszÃ³w',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '35-000',
         'postal_code_short' => '35',
         'country' => 'PL',
         'price' => 18,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Kolbuszowa', 'code' => '', 'ph_code' => '', 'postal_code' => '36-100'],
      [
         'name' => 'Kolbuszowa',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '36-100',
         'postal_code_short' => '36',
         'country' => 'PL',
         'price' => 18,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Przeworsk', 'code' => '', 'ph_code' => '', 'postal_code' => '37-200'],
      [
         'name' => 'Przeworsk',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '37-200',
         'postal_code_short' => '37',
         'country' => 'PL',
         'price' => 20,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'StrzyÅ¼Ã³w', 'code' => '', 'ph_code' => '', 'postal_code' => '38-100'],
      [
         'name' => 'StrzyÅ¼Ã³w',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '38-100',
         'postal_code_short' => '38',
         'country' => 'PL',
         'price' => 24,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Ropczyce', 'code' => '', 'ph_code' => '', 'postal_code' => '39-100'],
      [
         'name' => 'Ropczyce',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '39-100',
         'postal_code_short' => '39',
         'country' => 'PL',
         'price' => 14,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Katowice', 'code' => '', 'ph_code' => '', 'postal_code' => '40-001'],
      [
         'name' => 'Katowice',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '40-001',
         'postal_code_short' => '40',
         'country' => 'PL',
         'price' => 10,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Siemianowice ÅšlÄ…skie', 'code' => '', 'ph_code' => '', 'postal_code' => '41-100'],
      [
         'name' => 'Siemianowice ÅšlÄ…skie',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '41-100',
         'postal_code_short' => '41',
         'country' => 'PL',
         'price' => 10,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'KÅ‚obuck', 'code' => '', 'ph_code' => '', 'postal_code' => '42-100'],
      [
         'name' => 'KÅ‚obuck',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '42-100',
         'postal_code_short' => '42',
         'country' => 'PL',
         'price' => 10,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'CzÄ™stochowa', 'code' => '', 'ph_code' => '', 'postal_code' => '42-20x'],
      [
         'name' => 'CzÄ™stochowa',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '42-20x',
         'postal_code_short' => '42',
         'country' => 'PL',
         'price' => 14,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Gliwice', 'code' => '', 'ph_code' => '', 'postal_code' => '44-100'],
      [
         'name' => 'Gliwice',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '44-100',
         'postal_code_short' => '44',
         'country' => 'PL',
         'price' => 10,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Opole', 'code' => '', 'ph_code' => '', 'postal_code' => '45-0xx'],
      [
         'name' => 'Opole',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '45-0xx',
         'postal_code_short' => '45',
         'country' => 'PL',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'NamysÅ‚Ã³w', 'code' => '', 'ph_code' => '', 'postal_code' => '46-100'],
      [
         'name' => 'NamysÅ‚Ã³w',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '46-100',
         'postal_code_short' => '46',
         'country' => 'PL',
         'price' => 6,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Strzelce Opolskie', 'code' => '', 'ph_code' => '', 'postal_code' => '47-100'],
      [
         'name' => 'Strzelce Opolskie',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '47-100',
         'postal_code_short' => '47',
         'country' => 'PL',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'GÅ‚ubczyce', 'code' => '', 'ph_code' => '', 'postal_code' => '48-100'],
      [
         'name' => 'GÅ‚ubczyce',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '48-100',
         'postal_code_short' => '48',
         'country' => 'PL',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Brzeg', 'code' => '', 'ph_code' => '', 'postal_code' => '49-300'],
      [
         'name' => 'Brzeg',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '49-300',
         'postal_code_short' => '49',
         'country' => 'PL',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'WrocÅ‚aw', 'code' => '', 'ph_code' => '', 'postal_code' => '50-xxx'],
      [
         'name' => 'WrocÅ‚aw',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '50-xxx',
         'postal_code_short' => '50',
         'country' => 'PL',
         'price' => 2,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'WrocÅ‚aw1', 'code' => '', 'ph_code' => '', 'postal_code' => '51-xxx'],
      [
         'name' => 'WrocÅ‚aw1',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '51-xxx',
         'postal_code_short' => NULL,
         'country' => 'PL',
         'price' => 2,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'WrocÅ‚aw2', 'code' => '', 'ph_code' => '', 'postal_code' => '52'],
      [
         'name' => 'WrocÅ‚aw2',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '52',
         'postal_code_short' => '52',
         'country' => 'PL',
         'price' => 2,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'WrocÅ‚aw3', 'code' => '', 'ph_code' => '', 'postal_code' => '53'],
      [
         'name' => 'WrocÅ‚aw3',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '53',
         'postal_code_short' => '53',
         'country' => 'PL',
         'price' => 2,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'WrocÅ‚aw4', 'code' => '', 'ph_code' => '', 'postal_code' => '54'],
      [
         'name' => 'WrocÅ‚aw4',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '54',
         'postal_code_short' => '54',
         'country' => 'PL',
         'price' => 2,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'WrocÅ‚aw5', 'code' => '', 'ph_code' => '', 'postal_code' => '55'],
      [
         'name' => 'WrocÅ‚aw5',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '55',
         'postal_code_short' => '55',
         'country' => 'PL',
         'price' => 2,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'OleÅ›nica', 'code' => '', 'ph_code' => '', 'postal_code' => '56-400'],
      [
         'name' => 'OleÅ›nica',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '56-400',
         'postal_code_short' => '56',
         'country' => 'PL',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'OleÅ›nica1', 'code' => '', 'ph_code' => '', 'postal_code' => '57'],
      [
         'name' => 'OleÅ›nica1',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '57',
         'postal_code_short' => '57',
         'country' => 'PL',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'WaÅ‚brzych', 'code' => '', 'ph_code' => '', 'postal_code' => '58'],
      [
         'name' => 'WaÅ‚brzych',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '58',
         'postal_code_short' => '58',
         'country' => 'PL',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'WaÅ‚brzych1', 'code' => '', 'ph_code' => '', 'postal_code' => '59'],
      [
         'name' => 'WaÅ‚brzych1',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '59',
         'postal_code_short' => '59',
         'country' => 'PL',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'PoznaÅ„', 'code' => '', 'ph_code' => '', 'postal_code' => '60-001'],
      [
         'name' => 'PoznaÅ„',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '60-001',
         'postal_code_short' => '60',
         'country' => 'PL',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'PoznaÅ„1', 'code' => '', 'ph_code' => '', 'postal_code' => '61-890'],
      [
         'name' => 'PoznaÅ„1',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '61-890',
         'postal_code_short' => '61',
         'country' => 'PL',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Grodzisk Wielkopolski', 'code' => '', 'ph_code' => '', 'postal_code' => '62-065'],
      [
         'name' => 'Grodzisk Wielkopolski',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '62-065',
         'postal_code_short' => '62',
         'country' => 'PL',
         'price' => 2,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Åšroda Wielkopolska', 'code' => '', 'ph_code' => '', 'postal_code' => '63-000'],
      [
         'name' => 'Åšroda Wielkopolska',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '63-000',
         'postal_code_short' => '63',
         'country' => 'PL',
         'price' => 2,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'KoÅ›cian', 'code' => '', 'ph_code' => '', 'postal_code' => '64-000'],
      [
         'name' => 'KoÅ›cian',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '64-000',
         'postal_code_short' => '64',
         'country' => 'PL',
         'price' => 2,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Zielona GÃ³ra', 'code' => '', 'ph_code' => '', 'postal_code' => '65-0xx'],
      [
         'name' => 'Zielona GÃ³ra',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '65-0xx',
         'postal_code_short' => '65',
         'country' => 'PL',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'GorzÃ³w Wielkopolski', 'code' => '', 'ph_code' => '', 'postal_code' => '66-4xx'],
      [
         'name' => 'GorzÃ³w Wielkopolski',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '66-4xx',
         'postal_code_short' => '66',
         'country' => 'PL',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'GorzÃ³w Wielkopolski1', 'code' => '', 'ph_code' => '', 'postal_code' => '67-4xx'],
      [
         'name' => 'GorzÃ³w Wielkopolski1',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '67-4xx',
         'postal_code_short' => '67',
         'country' => 'PL',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Å»agaÅ„', 'code' => '', 'ph_code' => '', 'postal_code' => '68-100'],
      [
         'name' => 'Å»agaÅ„',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '68-100',
         'postal_code_short' => '68',
         'country' => 'PL',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Å»agaÅ„1', 'code' => '', 'ph_code' => '', 'postal_code' => '69'],
      [
         'name' => 'Å»agaÅ„1',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '69',
         'postal_code_short' => '69',
         'country' => 'PL',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Szczecin', 'code' => '', 'ph_code' => '', 'postal_code' => '70-017'],
      [
         'name' => 'Szczecin',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '70-017',
         'postal_code_short' => '70',
         'country' => 'PL',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Szczecin1', 'code' => '', 'ph_code' => '', 'postal_code' => '71-871'],
      [
         'name' => 'Szczecin1',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '71-871',
         'postal_code_short' => '71',
         'country' => 'PL',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Gmina Police', 'code' => '', 'ph_code' => '', 'postal_code' => '72-009'],
      [
         'name' => 'Gmina Police',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '72-009',
         'postal_code_short' => '72',
         'country' => 'PL',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Stargard SzczeciÅ„ski', 'code' => '', 'ph_code' => '', 'postal_code' => '73-110'],
      [
         'name' => 'Stargard SzczeciÅ„ski',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '73-110',
         'postal_code_short' => '73',
         'country' => 'PL',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Gryfino', 'code' => '', 'ph_code' => '', 'postal_code' => '73-150'],
      [
         'name' => 'Gryfino',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '73-150',
         'postal_code_short' => '73',
         'country' => 'PL',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Koszalin', 'code' => '', 'ph_code' => '', 'postal_code' => '75-900'],
      [
         'name' => 'Koszalin',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '75-900',
         'postal_code_short' => '75',
         'country' => 'PL',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'SÅ‚awno', 'code' => '', 'ph_code' => '', 'postal_code' => '76-100'],
      [
         'name' => 'SÅ‚awno',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '76-100',
         'postal_code_short' => '76',
         'country' => 'PL',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'BytÃ³w', 'code' => '', 'ph_code' => '', 'postal_code' => '77-100'],
      [
         'name' => 'BytÃ³w',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '77-100',
         'postal_code_short' => '77',
         'country' => 'PL',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'KoÅ‚obrzeg', 'code' => '', 'ph_code' => '', 'postal_code' => '78-100'],
      [
         'name' => 'KoÅ‚obrzeg',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '78-100',
         'postal_code_short' => '78',
         'country' => 'PL',
         'price' => 2,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'GdaÅ„sk', 'code' => '', 'ph_code' => '', 'postal_code' => '80-xxx'],
      [
         'name' => 'GdaÅ„sk',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '80-xxx',
         'postal_code_short' => '80',
         'country' => 'PL',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Sopot', 'code' => '', 'ph_code' => '', 'postal_code' => '81-701'],
      [
         'name' => 'Sopot',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '81-701',
         'postal_code_short' => '81',
         'country' => 'PL',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Nowy DwÃ³r GdaÅ„ski', 'code' => '', 'ph_code' => '', 'postal_code' => '82-100'],
      [
         'name' => 'Nowy DwÃ³r GdaÅ„ski',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '82-100',
         'postal_code_short' => '82',
         'country' => 'PL',
         'price' => 10,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Pruszcz GdaÅ„ski', 'code' => '', 'ph_code' => '', 'postal_code' => '83-000'],
      [
         'name' => 'Pruszcz GdaÅ„ski',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '83-000',
         'postal_code_short' => '83',
         'country' => 'PL',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Puck', 'code' => '', 'ph_code' => '', 'postal_code' => '84-100'],
      [
         'name' => 'Puck',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '84-100',
         'postal_code_short' => '84',
         'country' => 'PL',
         'price' => 12,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Bydgoszcz', 'code' => '', 'ph_code' => '', 'postal_code' => '85-001'],
      [
         'name' => 'Bydgoszcz',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '85-001',
         'postal_code_short' => '85',
         'country' => 'PL',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Åšwiecie', 'code' => '', 'ph_code' => '', 'postal_code' => '86-100'],
      [
         'name' => 'Åšwiecie',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '86-100',
         'postal_code_short' => '86',
         'country' => 'PL',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'ToruÅ„', 'code' => '', 'ph_code' => '', 'postal_code' => '87-100'],
      [
         'name' => 'ToruÅ„',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '87-100',
         'postal_code_short' => '87',
         'country' => 'PL',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'InowrocÅ‚aw', 'code' => '', 'ph_code' => '', 'postal_code' => '88-100'],
      [
         'name' => 'InowrocÅ‚aw',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '88-100',
         'postal_code_short' => '88',
         'country' => 'PL',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'NakÅ‚o nad NoteciÄ…', 'code' => '', 'ph_code' => '', 'postal_code' => '89-100'],
      [
         'name' => 'NakÅ‚o nad NoteciÄ…',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '89-100',
         'postal_code_short' => '89',
         'country' => 'PL',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'ÅÃ³dÅº', 'code' => '', 'ph_code' => '', 'postal_code' => '90-001'],
      [
         'name' => 'ÅÃ³dÅº',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '90-001',
         'postal_code_short' => '90',
         'country' => 'PL',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'ÅÃ³dÅº1', 'code' => '', 'ph_code' => '', 'postal_code' => '90-002'],
      [
         'name' => 'ÅÃ³dÅº1',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '90-002',
         'postal_code_short' => '92',
         'country' => 'PL',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'ÅÃ³dÅº2', 'code' => '', 'ph_code' => '', 'postal_code' => '90-003'],
      [
         'name' => 'ÅÃ³dÅº2',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '90-003',
         'postal_code_short' => '93',
         'country' => 'PL',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'ÅÃ³dÅº3', 'code' => '', 'ph_code' => '', 'postal_code' => '90-003'],
      [
         'name' => 'ÅÃ³dÅº3',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '94-413',
         'postal_code_short' => '94',
         'country' => 'PL',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Brzeziny', 'code' => '', 'ph_code' => '', 'postal_code' => '95-060'],
      [
         'name' => 'Brzeziny',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '95-060',
         'postal_code_short' => '95',
         'country' => 'PL',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Skierniewice', 'code' => '', 'ph_code' => '', 'postal_code' => '96-100'],
      [
         'name' => 'Skierniewice',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '96-100',
         'postal_code_short' => '96',
         'country' => 'PL',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Skierniewice', 'code' => '', 'ph_code' => '', 'postal_code' => '96-100'],
      [
         'name' => 'TomaszÃ³w Mazowiecki',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '97-200',
         'postal_code_short' => '97',
         'country' => 'PL',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Åask', 'code' => '', 'ph_code' => '', 'postal_code' => '98-100'],
      [
         'name' => 'Åask',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '98-100',
         'postal_code_short' => '98',
         'country' => 'PL',
         'price' => 6,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'ÅÄ™czyca', 'code' => '', 'ph_code' => '', 'postal_code' => '99-100'],
      [
         'name' => 'ÅÄ™czyca',
         'code' => '',
         'ph_code' => '',
         'postal_code' => '99-100',
         'postal_code_short' => '99',
         'country' => 'PL',
         'price' => 6,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Aberdeen', 'code' => '', 'ph_code' => '', 'postal_code' => 'AB'],
      [
         'name' => 'Aberdeen',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'AB',
         'postal_code_short' => 'AB',
         'country' => 'UK',
         'price' => 20,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'St Albans', 'code' => '', 'ph_code' => '', 'postal_code' => 'AL'],
      [
         'name' => 'St Albans',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'AL',
         'postal_code_short' => 'AL',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Birmingham', 'code' => '', 'ph_code' => '', 'postal_code' => 'B'],
      [
         'name' => 'Birmingham',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'B',
         'postal_code_short' => 'B',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Bath', 'code' => '', 'ph_code' => '', 'postal_code' => 'BA'],
      [
         'name' => 'Bath',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'BA',
         'postal_code_short' => 'BA',
         'country' => 'UK',
         'price' => 2,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Blackburn', 'code' => '', 'ph_code' => '', 'postal_code' => 'BB'],
      [
         'name' => 'Blackburn',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'BB',
         'postal_code_short' => 'BB',
         'country' => 'UK',
         'price' => 6,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Bradford', 'code' => '', 'ph_code' => '', 'postal_code' => 'BD'],
      [
         'name' => 'Bradford',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'BD',
         'postal_code_short' => 'BD',
         'country' => 'UK',
         'price' => 6,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Bournemouth', 'code' => '', 'ph_code' => '', 'postal_code' => 'BH'],
      [
         'name' => 'Bournemouth',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'BH',
         'postal_code_short' => 'BH',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Bolton', 'code' => '', 'ph_code' => '', 'postal_code' => 'BL'],
      [
         'name' => 'Bolton',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'BL',
         'postal_code_short' => 'BL',
         'country' => 'UK',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Brighton', 'code' => '', 'ph_code' => '', 'postal_code' => 'BN'],
      [
         'name' => 'Brighton',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'BN',
         'postal_code_short' => 'BN',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Bromley', 'code' => '', 'ph_code' => '', 'postal_code' => 'BR'],
      [
         'name' => 'Bromley',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'BR',
         'postal_code_short' => 'BR',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Bristol', 'code' => '', 'ph_code' => '', 'postal_code' => 'BS'],
      [
         'name' => 'Bristol',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'BS',
         'postal_code_short' => 'BS',
         'country' => 'UK',
         'price' => 2,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::create(['name' => 'Belfast', 'code' => '', 'ph_code' => '', 'postal_code' => 'BT'],
      [
         'name' => 'Belfast',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'BT',
         'postal_code_short' => 'BT',
         'country' => 'UK',
         'price' => 24,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Carlisle', 'code' => '', 'ph_code' => '', 'postal_code' => 'CA'],
      [
         'name' => 'Carlisle',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'CA',
         'postal_code_short' => 'CA',
         'country' => 'UK',
         'price' => 12,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Cambridge', 'code' => '', 'ph_code' => '', 'postal_code' => 'CB'],
      [
         'name' => 'Cambridge',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'CB',
         'postal_code_short' => 'CB',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Cardiff', 'code' => '', 'ph_code' => '', 'postal_code' => 'CF'],
      [
         'name' => 'Cardiff',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'CF',
         'postal_code_short' => 'CF',
         'country' => 'UK',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Chester', 'code' => '', 'ph_code' => '', 'postal_code' => 'CH'],
      [
         'name' => 'Chester',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'CH',
         'postal_code_short' => 'CH',
         'country' => 'UK',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Chelmsford', 'code' => '', 'ph_code' => '', 'postal_code' => 'CM'],
      [
         'name' => 'Chelmsford',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'CM',
         'postal_code_short' => 'CM',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Colchester', 'code' => '', 'ph_code' => '', 'postal_code' => 'CO'],
      [
         'name' => 'Colchester',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'CO',
         'postal_code_short' => 'CO',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Croydon', 'code' => '', 'ph_code' => '', 'postal_code' => 'CR'],
      [
         'name' => 'Croydon',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'CR',
         'postal_code_short' => 'CR',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Canterbury', 'code' => '', 'ph_code' => '', 'postal_code' => 'CT'],
      [
         'name' => 'Canterbury',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'CT',
         'postal_code_short' => 'CT',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Coventry', 'code' => '', 'ph_code' => '', 'postal_code' => 'CV'],
      [
         'name' => 'Coventry',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'CV',
         'postal_code_short' => 'CV',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Crewe', 'code' => '', 'ph_code' => '', 'postal_code' => 'CW'],
      [
         'name' => 'Crewe',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'CW',
         'postal_code_short' => 'CW',
         'country' => 'UK',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Dartford', 'code' => '', 'ph_code' => '', 'postal_code' => 'DA'],
      [
         'name' => 'Dartford',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'DA',
         'postal_code_short' => 'DA',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Dundee', 'code' => '', 'ph_code' => '', 'postal_code' => 'DD'],
      [
         'name' => 'Dundee',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'DD',
         'postal_code_short' => 'DD',
         'country' => 'UK',
         'price' => 20,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Derby', 'code' => '', 'ph_code' => '', 'postal_code' => 'DE'],
      [
         'name' => 'Derby',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'DE',
         'postal_code_short' => 'DE',
         'country' => 'UK',
         'price' => 2,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Dumfries', 'code' => '', 'ph_code' => '', 'postal_code' => 'DG'],
      [
         'name' => 'Dumfries',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'DG',
         'postal_code_short' => 'DG',
         'country' => 'UK',
         'price' => 16,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Durham', 'code' => '', 'ph_code' => '', 'postal_code' => 'DH'],
      [
         'name' => 'Durham',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'DH',
         'postal_code_short' => 'DH',
         'country' => 'UK',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Darlington', 'code' => '', 'ph_code' => '', 'postal_code' => 'DL'],
      [
         'name' => 'Darlington',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'DL',
         'postal_code_short' => 'DL',
         'country' => 'UK',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Doncaster', 'code' => '', 'ph_code' => '', 'postal_code' => 'DN'],
      [
         'name' => 'Doncaster',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'DN',
         'postal_code_short' => 'DN',
         'country' => 'UK',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Dorchester', 'code' => '', 'ph_code' => '', 'postal_code' => 'DT'],
      [
         'name' => 'Dorchester',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'DT',
         'postal_code_short' => 'DT',
         'country' => 'UK',
         'price' => 2,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Dudley', 'code' => '', 'ph_code' => '', 'postal_code' => 'DY'],
      [
         'name' => 'Dudley',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'DY',
         'postal_code_short' => 'DY',
         'country' => 'UK',
         'price' => 2,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'East London', 'code' => '', 'ph_code' => '', 'postal_code' => 'E'],
      [
         'name' => 'East London',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'E',
         'postal_code_short' => 'E',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'East Central London', 'code' => '', 'ph_code' => '', 'postal_code' => 'EC'],
      [
         'name' => 'East Central London',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'EC',
         'postal_code_short' => 'EC',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Edinburgh', 'code' => '', 'ph_code' => '', 'postal_code' => 'EH'],
      [
         'name' => 'Edinburgh',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'EH',
         'postal_code_short' => 'EH',
         'country' => 'UK',
         'price' => 16,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Enfield', 'code' => '', 'ph_code' => '', 'postal_code' => 'EN'],
      [
         'name' => 'Enfield',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'EN',
         'postal_code_short' => 'EN',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Exeter', 'code' => '', 'ph_code' => '', 'postal_code' => 'EX'],
      [
         'name' => 'Exeter',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'EX',
         'postal_code_short' => 'EX',
         'country' => 'UK',
         'price' => 16,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Falkirk', 'code' => '', 'ph_code' => '', 'postal_code' => 'FK'],
      [
         'name' => 'Falkirk',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'FK',
         'postal_code_short' => 'FK',
         'country' => 'UK',
         'price' => 16,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Blackpoo', 'code' => '', 'ph_code' => '', 'postal_code' => 'FY'],
      [
         'name' => 'Blackpoo',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'FY',
         'postal_code_short' => 'FY',
         'country' => 'UK',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Glasgow', 'code' => '', 'ph_code' => '', 'postal_code' => 'G'],
      [
         'name' => 'Glasgow',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'G',
         'postal_code_short' => 'G',
         'country' => 'UK',
         'price' => 16,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Gloucester', 'code' => '', 'ph_code' => '', 'postal_code' => 'GL'],
      [
         'name' => 'Gloucester',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'GL',
         'postal_code_short' => 'GL',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Guildford', 'code' => '', 'ph_code' => '', 'postal_code' => 'GU'],
      [
         'name' => 'Guildford',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'GU',
         'postal_code_short' => 'GU',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Harrow', 'code' => '', 'ph_code' => '', 'postal_code' => 'HA'],
      [
         'name' => 'Harrow',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'HA',
         'postal_code_short' => 'HA',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Huddersfield', 'code' => '', 'ph_code' => '', 'postal_code' => 'HD'],
      [
         'name' => 'Huddersfield',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'HD',
         'postal_code_short' => 'HD',
         'country' => 'UK',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Harrogate', 'code' => '', 'ph_code' => '', 'postal_code' => 'HG'],
      [
         'name' => 'Harrogate',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'HG',
         'postal_code_short' => 'HG',
         'country' => 'UK',
         'price' => 6,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Hemel Hempstead', 'code' => '', 'ph_code' => '', 'postal_code' => 'HP'],
      [
         'name' => 'Hemel Hempstead',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'HP',
         'postal_code_short' => 'HP',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Hereford', 'code' => '', 'ph_code' => '', 'postal_code' => 'HR'],
      [
         'name' => 'Hereford',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'HR',
         'postal_code_short' => 'HR',
         'country' => 'UK',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Outer Hebrides', 'code' => '', 'ph_code' => '', 'postal_code' => 'HS'],
      [
         'name' => 'Outer Hebrides',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'HS',
         'postal_code_short' => 'HS',
         'country' => 'UK',
         'price' => 34,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Hull', 'code' => '', 'ph_code' => '', 'postal_code' => 'HU'],
      [
         'name' => 'Hull',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'HU',
         'postal_code_short' => 'HU',
         'country' => 'UK',
         'price' => 6,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Halifax', 'code' => '', 'ph_code' => '', 'postal_code' => 'HX'],
      [
         'name' => 'Halifax',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'HX',
         'postal_code_short' => 'HX',
         'country' => 'UK',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Ilford', 'code' => '', 'ph_code' => '', 'postal_code' => 'IG'],
      [
         'name' => 'Ilford',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'IG',
         'postal_code_short' => 'IG',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Ipswich', 'code' => '', 'ph_code' => '', 'postal_code' => 'IP'],
      [
         'name' => 'Ipswich',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'IP',
         'postal_code_short' => 'IP',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Inverness', 'code' => '', 'ph_code' => '', 'postal_code' => 'IV'],
      [
         'name' => 'Inverness',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'IV',
         'postal_code_short' => 'IV',
         'country' => 'UK',
         'price' => 24,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Kilmarnock', 'code' => '', 'ph_code' => '', 'postal_code' => 'KA'],
      [
         'name' => 'Kilmarnock',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'KA',
         'postal_code_short' => 'KA',
         'country' => 'UK',
         'price' => 16,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Kingston upon Thames', 'code' => '', 'ph_code' => '', 'postal_code' => 'KT'],
      [
         'name' => 'Kingston upon Thames',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'KT',
         'postal_code_short' => 'KT',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Kirkwall', 'code' => '', 'ph_code' => '', 'postal_code' => 'KW'],
      [
         'name' => 'Kirkwall',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'KW',
         'postal_code_short' => 'KW',
         'country' => 'UK',
         'price' => 28,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Kirkcaldy', 'code' => '', 'ph_code' => '', 'postal_code' => 'KY'],
      [
         'name' => 'Kirkcaldy',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'KY',
         'postal_code_short' => 'KY',
         'country' => 'UK',
         'price' => 16,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Liverpool', 'code' => '', 'ph_code' => '', 'postal_code' => 'L'],
      [
         'name' => 'Liverpool',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'L',
         'postal_code_short' => 'L',
         'country' => 'UK',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Lancaster', 'code' => '', 'ph_code' => '', 'postal_code' => 'LA'],
      [
         'name' => 'Lancaster',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'LA',
         'postal_code_short' => 'LA',
         'country' => 'UK',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Llandrindod Wells', 'code' => '', 'ph_code' => '', 'postal_code' => 'LD'],
      [
         'name' => 'Llandrindod Wells',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'LD',
         'postal_code_short' => 'LD',
         'country' => 'UK',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Leicester', 'code' => '', 'ph_code' => '', 'postal_code' => 'LE'],
      [
         'name' => 'Leicester',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'LE',
         'postal_code_short' => 'LE',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Llandudno', 'code' => '', 'ph_code' => '', 'postal_code' => 'LL'],
      [
         'name' => 'Llandudno',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'LL',
         'postal_code_short' => 'LL',
         'country' => 'UK',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Lincoln', 'code' => '', 'ph_code' => '', 'postal_code' => 'LN'],
      [
         'name' => 'Lincoln',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'LN',
         'postal_code_short' => 'LN',
         'country' => 'UK',
         'price' => 2,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Leeds', 'code' => '', 'ph_code' => '', 'postal_code' => 'LS'],
      [
         'name' => 'Leeds',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'LS',
         'postal_code_short' => 'LS',
         'country' => 'UK',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Luton', 'code' => '', 'ph_code' => '', 'postal_code' => 'LU'],
      [
         'name' => 'Luton',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'LU',
         'postal_code_short' => 'LU',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Manchester', 'code' => '', 'ph_code' => '', 'postal_code' => 'M'],
      [
         'name' => 'Manchester',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'M',
         'postal_code_short' => 'M',
         'country' => 'UK',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Rochester', 'code' => '', 'ph_code' => '', 'postal_code' => 'ME'],
      [
         'name' => 'Rochester',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'ME',
         'postal_code_short' => 'ME',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Milton Keynes', 'code' => '', 'ph_code' => '', 'postal_code' => 'MK'],
      [
         'name' => 'Milton Keynes',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'MK',
         'postal_code_short' => 'MK',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Motherwell', 'code' => '', 'ph_code' => '', 'postal_code' => 'ML'],
      [
         'name' => 'Motherwell',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'ML',
         'postal_code_short' => 'ML',
         'country' => 'UK',
         'price' => 16,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'North London', 'code' => '', 'ph_code' => '', 'postal_code' => 'N'],
      [
         'name' => 'North London',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'N',
         'postal_code_short' => 'N',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Newcastle upon Tyne', 'code' => '', 'ph_code' => '', 'postal_code' => 'NE'],
      [
         'name' => 'Newcastle upon Tyne',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'NE',
         'postal_code_short' => 'NE',
         'country' => 'UK',
         'price' => 12,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Nottingham', 'code' => '', 'ph_code' => '', 'postal_code' => 'NG'],
      [
         'name' => 'Nottingham',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'NG',
         'postal_code_short' => 'NG',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Northampton', 'code' => '', 'ph_code' => '', 'postal_code' => 'NN'],
      [
         'name' => 'Northampton',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'NN',
         'postal_code_short' => 'NN',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Newport', 'code' => '', 'ph_code' => '', 'postal_code' => 'NP'],
      [
         'name' => 'Newport',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'NP',
         'postal_code_short' => 'NP',
         'country' => 'UK',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate([
         'name' => 'Norwich',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'NR',
         'postal_code_short' => 'NR',
         'country' => 'UK',
         'price' => 2,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'North West London', 'code' => '', 'ph_code' => '', 'postal_code' => 'NW'],
      [
         'name' => 'North West London',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'NW',
         'postal_code_short' => 'NW',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Oldham', 'code' => '', 'ph_code' => '', 'postal_code' => 'OL'],
      [
         'name' => 'Oldham',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'OL',
         'postal_code_short' => 'OL',
         'country' => 'UK',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Oxford', 'code' => '', 'ph_code' => '', 'postal_code' => 'OX'],
      [
         'name' => 'Oxford',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'OX',
         'postal_code_short' => 'OX',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Paisley', 'code' => '', 'ph_code' => '', 'postal_code' => 'PA'],
      [
         'name' => 'Paisley',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'PA',
         'postal_code_short' => 'PA',
         'country' => 'UK',
         'price' => 20,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Peterborough', 'code' => '', 'ph_code' => '', 'postal_code' => 'PE'],
      [
         'name' => 'Peterborough',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'PE',
         'postal_code_short' => 'PE',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Perth', 'code' => '', 'ph_code' => '', 'postal_code' => 'PH'],
      [
         'name' => 'Perth',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'PH',
         'postal_code_short' => 'PH',
         'country' => 'UK',
         'price' => 20,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Plymouth', 'code' => '', 'ph_code' => '', 'postal_code' => 'PL'],
      [
         'name' => 'Plymouth',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'PL',
         'postal_code_short' => 'PL',
         'country' => 'UK',
         'price' => 20,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Portsmouth', 'code' => '', 'ph_code' => '', 'postal_code' => 'PO'],
      [
         'name' => 'Portsmouth',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'PO',
         'postal_code_short' => 'PO',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Preston', 'code' => '', 'ph_code' => '', 'postal_code' => 'PR'],
      [
         'name' => 'Preston',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'PR',
         'postal_code_short' => 'PR',
         'country' => 'UK',
         'price' => 6,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Reading', 'code' => '', 'ph_code' => '', 'postal_code' => 'RG'],
      [
         'name' => 'Reading',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'RG',
         'postal_code_short' => 'RG',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Redhill', 'code' => '', 'ph_code' => '', 'postal_code' => 'RH'],
      [
         'name' => 'Redhill',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'RH',
         'postal_code_short' => 'RH',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Romford', 'code' => '', 'ph_code' => '', 'postal_code' => 'RM'],
      [
         'name' => 'Romford',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'RM',
         'postal_code_short' => 'RM',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Sheffield', 'code' => '', 'ph_code' => '', 'postal_code' => 'S'],
      [
         'name' => 'Sheffield',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'S',
         'postal_code_short' => 'S',
         'country' => 'UK',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Swansea', 'code' => '', 'ph_code' => '', 'postal_code' => 'SA'],
      [
         'name' => 'Swansea',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'SA',
         'postal_code_short' => 'SA',
         'country' => 'UK',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'South East London', 'code' => '', 'ph_code' => '', 'postal_code' => 'SE'],
      [
         'name' => 'South East London',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'SE',
         'postal_code_short' => 'SE',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Stevenage', 'code' => '', 'ph_code' => '', 'postal_code' => 'SG'],
      [
         'name' => 'Stevenage',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'SG',
         'postal_code_short' => 'SG',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Stockport', 'code' => '', 'ph_code' => '', 'postal_code' => 'SK'],
      [
         'name' => 'Stockport',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'SK',
         'postal_code_short' => 'SK',
         'country' => 'UK',
         'price' => 6,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Slough', 'code' => '', 'ph_code' => '', 'postal_code' => 'SL'],
      [
         'name' => 'Slough',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'SL',
         'postal_code_short' => 'SL',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Sutton', 'code' => '', 'ph_code' => '', 'postal_code' => 'SM'],
      [
         'name' => 'Sutton',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'SM',
         'postal_code_short' => 'SM',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Swindon', 'code' => '', 'ph_code' => '', 'postal_code' => 'SN'],
      [
         'name' => 'Swindon',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'SN',
         'postal_code_short' => 'SN',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Southampton', 'code' => '', 'ph_code' => '', 'postal_code' => 'SO'],
      [
         'name' => 'Southampton',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'SO',
         'postal_code_short' => 'SO',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Salisbury', 'code' => '', 'ph_code' => '', 'postal_code' => 'SP'],
      [
         'name' => 'Salisbury',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'SP',
         'postal_code_short' => 'SP',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Sunderland', 'code' => '', 'ph_code' => '', 'postal_code' => 'SR'],
      [
         'name' => 'Sunderland',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'SR',
         'postal_code_short' => 'SR',
         'country' => 'UK',
         'price' => 12,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Southend-on-Sea', 'code' => '', 'ph_code' => '', 'postal_code' => 'SS'],
      [
         'name' => 'Southend-on-Sea',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'SS',
         'postal_code_short' => 'SS',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Stoke-on-Trent', 'code' => '', 'ph_code' => '', 'postal_code' => 'ST'],
      [
         'name' => 'Stoke-on-Trent',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'ST',
         'postal_code_short' => 'ST',
         'country' => 'UK',
         'price' => 2,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'South West London', 'code' => '', 'ph_code' => '', 'postal_code' => 'SW'],
      [
         'name' => 'South West London',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'SW',
         'postal_code_short' => 'SW',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Shrewsbury', 'code' => '', 'ph_code' => '', 'postal_code' => 'SY'],
      [
         'name' => 'Shrewsbury',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'SY',
         'postal_code_short' => 'SY',
         'country' => 'UK',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Taunton', 'code' => '', 'ph_code' => '', 'postal_code' => 'TA'],
      [
         'name' => 'Taunton',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'TA',
         'postal_code_short' => 'TA',
         'country' => 'UK',
         'price' => 6,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Galashiels', 'code' => '', 'ph_code' => '', 'postal_code' => 'TD'],
      [
         'name' => 'Galashiels',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'TD',
         'postal_code_short' => 'TD',
         'country' => 'UK',
         'price' => 16,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Telford', 'code' => '', 'ph_code' => '', 'postal_code' => 'TF'],
      [
         'name' => 'Telford',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'TF',
         'postal_code_short' => 'TF',
         'country' => 'UK',
         'price' => 2,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Tunbridge Wells', 'code' => '', 'ph_code' => '', 'postal_code' => 'TN'],
      [
         'name' => 'Tunbridge Wells',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'TN',
         'postal_code_short' => 'TN',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Torquay', 'code' => '', 'ph_code' => '', 'postal_code' => 'TQ'],
      [
         'name' => 'Torquay',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'TQ',
         'postal_code_short' => 'TQ',
         'country' => 'UK',
         'price' => 16,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Truro', 'code' => '', 'ph_code' => '', 'postal_code' => 'TR'],
      [
         'name' => 'Truro',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'TR',
         'postal_code_short' => 'TR',
         'country' => 'UK',
         'price' => 28,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Cleveland', 'code' => '', 'ph_code' => '', 'postal_code' => 'TS'],
      [
         'name' => 'Cleveland',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'TS',
         'postal_code_short' => 'TS',
         'country' => 'UK',
         'price' => 8,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Twickenham', 'code' => '', 'ph_code' => '', 'postal_code' => 'TW'],
      [
         'name' => 'Twickenham',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'TW',
         'postal_code_short' => 'TW',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Southall', 'code' => '', 'ph_code' => '', 'postal_code' => 'UB'],
      [
         'name' => 'Southall',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'UB',
         'postal_code_short' => 'UB',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'West London', 'code' => '', 'ph_code' => '', 'postal_code' => 'W'],
      [
         'name' => 'West London',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'W',
         'postal_code_short' => 'W',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Warrington', 'code' => '', 'ph_code' => '', 'postal_code' => 'WA'],
      [
         'name' => 'Warrington',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'WA',
         'postal_code_short' => 'WA',
         'country' => 'UK',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Western Central London', 'code' => '', 'ph_code' => '', 'postal_code' => 'WC'],
      [
         'name' => 'Western Central London',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'WC',
         'postal_code_short' => 'WC',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Watford', 'code' => '', 'ph_code' => '', 'postal_code' => 'WD'],
      [
         'name' => 'Watford',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'WD',
         'postal_code_short' => 'WD',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Wakefield', 'code' => '', 'ph_code' => '', 'postal_code' => 'WF'],
      [
         'name' => 'Wakefield',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'WF',
         'postal_code_short' => 'WF',
         'country' => 'UK',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Wigan', 'code' => '', 'ph_code' => '', 'postal_code' => 'WN'],
      [
         'name' => 'Wigan',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'WN',
         'postal_code_short' => 'WN',
         'country' => 'UK',
         'price' => 4,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Worcester', 'code' => '', 'ph_code' => '', 'postal_code' => 'WR'],
      [
         'name' => 'Worcester',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'WR',
         'postal_code_short' => 'WR',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Walsall', 'code' => '', 'ph_code' => '', 'postal_code' => 'WS'],
      [
         'name' => 'Walsall',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'WS',
         'postal_code_short' => 'WS',
         'country' => 'UK',
         'price' => 0,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Wolverhampton', 'code' => '', 'ph_code' => '', 'postal_code' => 'WV'],
      [
         'name' => 'Wolverhampton',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'WV',
         'postal_code_short' => 'WV',
         'country' => 'UK',
         'price' => 2,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'York', 'code' => '', 'ph_code' => '', 'postal_code' => 'YO'],
      [
         'name' => 'York',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'YO',
         'postal_code_short' => 'YO',
         'country' => 'UK',
         'price' => 6,
         'type' => 'city',
         'status' => '1',
      ]);

      App\PostalCode::firstOrCreate(['name' => 'Lerwick', 'code' => '', 'ph_code' => '', 'postal_code' => 'ZE'],
      [
         'name' => 'Lerwick',
         'code' => '',
         'ph_code' => '',
         'postal_code' => 'ZE',
         'postal_code_short' => 'ZE',
         'country' => 'UK',
         'price' => 100,
         'type' => 'city',
         'status' => '1',
      ]);

   }
}
