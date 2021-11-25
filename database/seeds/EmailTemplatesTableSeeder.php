<?php

use Illuminate\Database\Seeder;

class EmailTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\EmailTemplate::updateOrCreate(['title'=>'SELLER REGISTER'],[
          'title' => 'SELLER REGISTER',
          'subject' => 'Confirm email to sell your stock in 1 click',
          'email_content' => '<p>Thanks for signing up with VegKing.<br/><br/>
		  Your account will be activated once successfully verified by one of our team members.<br/><br/>
		  Did you know that on average in <span style="font-size: 18px;font-weight: bold;">2019</span> we increased our suppliers profits by <span style="font-size: 18px;font-weight: bold;">19%</span>?</p>',
          'email_content_de' => '<p>Vielen Dank, dass Sie sich bei VegKing angemeldet haben.<br/><br/></p>
			Ihr Konto wird nach erfolgreicher Bestätigung durch eines unserer Teammitglieder aktiviert.<br/><br/>
			Wussten Sie, dass wir im Durchschnitt <span style="font-size: 18px;font-weight: bold;">2019</span> die Gewinne unserer Lieferanten um <span style="font-size: 18px;font-weight: bold;">19%</span> gesteigert haben?</p>',
          'email_content_pl' => '<p>Dziękujemy za rejestrację w VegKing.<br><br/>
			Twoje konto zostanie aktywowane po pomyślnej weryfikacji przez jednego z członków naszego zespołu.<br/><br/>
			Czy wiesz, że średnio w <span style="font-size: 18px;font-weight: bold;">2019</span> roku zwiększyliśmy zyski naszych dostawców o <span style="font-size: 18px;font-weight: bold;">19%</span>?</p>',
          'sms_content' => '
Please check for a Vegking email to click the confirm link  and sell your stocks now.
Your VegKing Team',
          'sms_content_de' => '
          Bitte sehen sie auf die E-Mail von Firma Vegking, dann klicken sie auf den Bestätigungslink um ihren Lager zu verkaufen
          Das VegKing Team',
          'sms_content_pl' => '
Proszę sprawdzić wiadomość e-mail dla wegetarian, aby kliknąć link potwierdzenia i sprzedać swoje akcje teraz.
Zespół VegKing',
          'shortcodes' => '[name], [first_name], [verification_link], [english_phone_number]',
          'recipients' => '1001,0,0,1,0,0,0,5,0,0',
          'roles_content' => '{"administrator":{"subject":"New Seller Registered!","email_content":"<p><span style=\"font-weight: 400;\">ADMIN member [team_member_name],<\/span><\/p>\r\n<p><span style=\"font-weight: 400;\">[name] just registered.<br \/><\/span><span style=\"font-weight: 400;\">Seller info:<br \/><\/span><span style=\"font-weight: 400;\">Email: [email]<br \/><\/span><span style=\"font-weight: 400;\">Phone: [phone]<br \/><\/span><span style=\"font-weight: 400;\">View Seller: [view_seller_link]<\/span><\/p>","email_content_de":"<p><span style=\"font-weight: 400;\">Hallo ADMINS Mitglied,<\/span><\/p>\r\n<p><span style=\"font-weight: 400;\">[name] Gerade registriert.<br \/><\/span><span style=\"font-weight: 400;\">Verk&auml;uferinformationen:<br \/><\/span><span style=\"font-weight: 400;\">E-Mail-Adresse: [email]<br \/><\/span><span style=\"font-weight: 400;\">Telefonnummer: [phone]<br \/><\/span><span style=\"font-weight: 400;\">Verk&auml;ufer anzeigen: [view_seller_link]<\/span><\/p>","email_content_pl":"<p><span style=\"font-weight: 400;\">ADMINS member [team_member_name],<\/span><\/p>\r\n<p><span style=\"font-weight: 400;\">[name] just registered.<br \/><\/span><span style=\"font-weight: 400;\">Seller info:<br \/><\/span><span style=\"font-weight: 400;\">Email: [email]<br \/><\/span><span style=\"font-weight: 400;\">Phone: [phone]<br \/><\/span><span style=\"font-weight: 400;\">View Seller: [view_seller_link]<\/span><\/p>","sms_content":"\r\nCongrats!\r\nNew seller registerd succesfully on VegKing\r\n\r\nRegards,\r\nVegKing Team","sms_content_de":"\r\nCongrats!\r\nNew seller registerd succesfully on VegKing\r\n\r\nRegards,\r\nVegKing Team","sms_content_pl":"\r\nCongrats!\r\nNew seller registerd succesfully on VegKing\r\n\r\nRegards,\r\nVegKing Team","push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"executive":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"seller":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"buyer":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"trader":{"subject":"New Seller Registered!","email_content":"<p><span style=\"font-weight: 400;\">TRADERS member [team_member_name],<\/span><\/p>\r\n<p><span style=\"font-weight: 400;\">[name] just registered.<br \/><\/span><span style=\"font-weight: 400;\">Seller info:<br \/><\/span><span style=\"font-weight: 400;\">Email: [email]<br \/><\/span><span style=\"font-weight: 400;\">Phone: [phone]<br \/><\/span><span style=\"font-weight: 400;\">View Seller: [view_seller_link]<\/span><\/p>","email_content_de":"<p><span style=\"font-weight: 400;\">Hallo TRADERS Mitglied,<\/span><\/p>\r\n<p><span style=\"font-weight: 400;\">[name] Gerade registriert.<br \/><\/span><span style=\"font-weight: 400;\">Verk&auml;uferinformationen:<br \/><\/span><span style=\"font-weight: 400;\">E-Mail-Adresse: [email]<br \/><\/span><span style=\"font-weight: 400;\">Telefonnummer: [phone]<br \/><\/span><span style=\"font-weight: 400;\">Verk&auml;ufer anzeigen: [view_seller_link]<\/span><\/p>","email_content_pl":"<p><span style=\"font-weight: 400;\">TRADERS member [team_member_name],<\/span><\/p>\r\n<p><span style=\"font-weight: 400;\">[name] just registered.<br \/><\/span><span style=\"font-weight: 400;\">Seller info:<br \/><\/span><span style=\"font-weight: 400;\">Email: [email]<br \/><\/span><span style=\"font-weight: 400;\">Phone: [phone]<br \/><\/span><span style=\"font-weight: 400;\">View Seller: [view_seller_link]<\/span><\/p>","sms_content":"\r\nCongrats!\r\nNew seller registerd succesfully on VegKing\r\n\r\nRegards,\r\nVegKing Team","sms_content_de":"\r\nCongrats!\r\nNew seller registerd succesfully on VegKing\r\n\r\nRegards,\r\nVegKing Team","sms_content_pl":"\r\nCongrats!\r\nNew seller registerd succesfully on VegKing\r\n\r\nRegards,\r\nVegKing Team","push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"trans":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"usermanager":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"}}'
      ]);
      App\EmailTemplate::updateOrCreate(['title'=>'VERIFY EMAIL'],[
          'title' => 'VERIFY EMAIL',
          'subject' => 'Please verify your email',
          'email_content' => '<p><span style="font-weight: 400;" data-mce-style="font-weight: 400;">Hi [name],</span></p><p><span style="font-weight: 400;" data-mce-style="font-weight: 400;">Thanks for signing up with vegking your account will be activated once successfully verified by one of our team members.</span></p>',

          'email_content_de' => '<p>Hallo [name],</p>
          <p>Vielen Dank, dass Sie sich bei vegking angemeldet haben. Ihr Konto wird aktiviert, sobald es von einem unserer Teammitglieder erfolgreich bestätigt wurde.</p>',

          'email_content_pl' => '<p><span style="font-weight: 400;" data-mce-style="font-weight: 400;">Hi [name],</span></p><p><span style="font-weight: 400;" data-mce-style="font-weight: 400;">Dziękujemy za rejestrację w vegking, Twoje konto zostanie aktywowane po pomyślnej weryfikacji przez jednego z członków naszego zespołu.</span></p>',

          'sms_content' => '
          Hi [name],
          Thanks for signing up with vegking your account will be activated once successfully verified by one of our team members.',

          'sms_content_de' => '
          Hallo [name],
          Vielen Dank, dass Sie sich bei vegking angemeldet haben. Ihr Konto wird aktiviert, sobald es von einem unserer Teammitglieder erfolgreich bestätigt wurde.',

          'sms_content_pl' => '
          Cześć [name],
          Dziękujemy za rejestrację w vegking, Twoje konto zostanie aktywowane po pomyślnej weryfikacji przez jednego z członków naszego zespołu.',

            'shortcodes' => '[name], [first_name], [verification_link]'
      ]);
      App\EmailTemplate::updateOrCreate(['title'=>'SELLER REGISTER TO TEAM'],[
          'title' => 'SELLER REGISTER TO TEAM',
          'subject' => 'New Seller Registered!',
          'email_content' => '<p><span style="font-weight: 400;">TRADERS member [team_member_name],</span></p>
            <p><span style="font-weight: 400;">[name] just registered.</span></p>
            <p><span style="font-weight: 400;">Seller info:</span></p>
            <p><span style="font-weight: 400;">Email: [email]</span></p>
            <p><span style="font-weight: 400;">Phone: [phone]</span></p>
            <p><span style="font-weight: 400;">View Seller: [view_seller_link]</span></p>',
          'email_content_de' => '<p><span style="font-weight: 400;">Hallo TRADERS Mitglied,</span></p>
            <p><span style="font-weight: 400;">[name] Gerade registriert.</span></p>
            <p><span style="font-weight: 400;">Verk&auml;uferinformationen:</span></p>
            <p><span style="font-weight: 400;">E-Mail-Adresse: [email]</span></p>
            <p><span style="font-weight: 400;">Telefonnummer: [phone]</span></p>
            <p><span style="font-weight: 400;">Verk&auml;ufer anzeigen: [view_seller_link]</span></p>',
          'email_content_pl' => '<p><span style="font-weight: 400;">TRADERS member [team_member_name],</span></p>
            <p><span style="font-weight: 400;">[name] just registered.</span></p>
            <p><span style="font-weight: 400;">Seller info:</span></p>
            <p><span style="font-weight: 400;">Email: [email]</span></p>
            <p><span style="font-weight: 400;">Phone: [phone]</span></p>
            <p><span style="font-weight: 400;">View Seller: [view_seller_link]</span></p>',
          'sms_content' => '
          TRADERS member [team_member_name],
[name] just registered.
Seller info:
Email: [email]
Phone: [phone]
View Seller: [view_seller_link]',
          'sms_content_de' => '
          TRADERS Mitglied [team_member_name],
[name] Gerade registriert.
Verkäuferinformationen:
E-Mail-Adresse: [email]
Telefonnummer: [phone]
Verkäufer anzeigen: [view_seller_link]',
          'sms_content_pl' => '
          TRADERS member [team_member_name],
[name] just registered.
Seller info:
Email: [email]
Phone: [phone]
View Seller: [view_seller_link]',
         'shortcodes' => '[team_member_name], [name], [email], [phone], [view_seller_link]'
      ]);
      App\EmailTemplate::updateOrCreate(['title'=>'BUYER REGISTER'],[
          'title' => 'BUYER REGISTER',
          'buyer_subject' => 'Confirm email to get the best quotes',
          'buyer_email_content' => '<p>Thanks for signing up with VegKing.<br />Your account will be activated once successfully verified by one of our team members.<br />Did you know that on average in <span style="font-size: 18px; font-weight: bold;">2019</span> we increased our customers saving by <span style="font-size: 18px; font-weight: bold;">16%</span>?</p>',
          'buyer_email_content_de' => '<p>Vielen Dank, dass Sie sich bei VegKing angemeldet haben.<br />Ihr Konto wird nach erfolgreicher Best&auml;tigung durch eines unserer Teammitglieder aktiviert.<br />Wussten Sie, dass wir im Durchschnitt <span style="font-size: 18px; font-weight: bold;">2019</span> die Einsparungen unserer Kunden um <span style="font-size: 18px; font-weight: bold;">16%</span> gesteigert haben?</p>',
          'buyer_email_content_pl' => '<p>Dziękujemy za rejestrację w VegKing.<br />Twoje konto zostanie aktywowane po pomyślnej weryfikacji przez jednego z członk&oacute;w naszego zespołu.<br />Czy wiesz, że średnio w <span style="font-size: 18px; font-weight: bold;">2019</span> roku zwiększyliśmy oszczędności naszych klient&oacute;w o <span style="font-size: 18px; font-weight: bold;">16%</span>?</p>',
          'buyer_sms_content' => '
          Please check for a Vegking email and get the best price quotes.
          Your VegKing Team',
          'buyer_sms_content_de' => '
          Please check for a Vegking email and get the best price quotes.
          Das VegKing Team',
          'buyer_sms_content_pl' => '
          Sprawdź wiadomość e-mail dla wegetarian i uzyskaj najlepsze oferty cenowe.
          Zespół VegKing',
          'shortcodes' => '[name], [email], [phone], [verification_link], [english_phone_number], [contact_preferred_method], [product_name], [product_sub_type], [notes]',
          'recipients' => '0,1002,0,1,0,0,0,5,0,0',
          'roles_content' => '{"administrator":{"subject":"New Buyer registered","email_content":"<p><span style=\"font-weight: 400;\">Hi ADMINS member [team_member_name],<\/span><\/p>\r\n<p><span style=\"font-weight: 400;\">Buyer info:<br \/><\/span><span style=\"font-weight: 400;\">Product: [product_name]<br \/><\/span><span style=\"font-weight: 400;\">Product Sub-type: [product_sub_type]<br \/><\/span><span style=\"font-weight: 400;\">Name: [name]<br \/><\/span><span style=\"font-weight: 400;\">Email: [email]<br \/><\/span><span style=\"font-weight: 400;\">Phone: [phone]<br \/><\/span><span style=\"font-weight: 400;\">View Buyer: [view_buyer_link]<\/span><\/p>","email_content_de":"<p>Hallo ADMINS Mitglied<span style=\"font-weight: 400;\"> [team_member_name]<\/span>,<\/p>\r\n<p>K&auml;uferinformationen:<br \/>Produkt: <span style=\"font-weight: 400;\">[product_name]<br \/><\/span>Produkt-Untertyp: <span style=\"font-weight: 400;\">[product_sub_type]<br \/><\/span>Name: <span style=\"font-weight: 400;\">[name]<br \/><\/span>E-Mail-Adresse: [email]<br \/>Telefonnummer: [phone]<br \/>K&auml;ufer anzeigen: <span style=\"font-weight: 400;\">[view_buyer_link]<\/span><\/p>","email_content_pl":"<p><span style=\"font-weight: 400;\">Cze\u015b\u0107, cz\u0142onkiem ADMINS [team_member_name],<\/span><\/p>\r\n<p><span style=\"font-weight: 400;\">Informacje o kupuj\u0105cym:<br \/><\/span><span style=\"font-weight: 400;\">Produkt: [product_name]<br \/><\/span><span style=\"font-weight: 400;\">Podtyp produktu: [product_sub_type]<br \/><\/span><span style=\"font-weight: 400;\">Imi\u0119: [name]<br \/><\/span><span style=\"font-weight: 400;\">E-mail: [email]<br \/><\/span><span style=\"font-weight: 400;\">Telefon: [phone]<br \/><\/span><span style=\"font-weight: 400;\">Wy\u015bwietl kupuj\u0105cego: [view_buyer_link]<\/span><\/p>","sms_content":"\r\nHi ADMINS member [team_member_name],\r\nBuyer info:\r\nProduct: [product_name]\r\nProduct Sub-type: [product_sub_type]\r\nName: [name]\r\nEmail: [email]\r\nPhone: [phone]\r\nView Buyer: [view_buyer_link]","sms_content_de":"\r\nHallo ADMINS Mitglied [team_member_name],\r\nK\u00e4uferinformationen:\r\nProdukt: [product_name]\r\nProdukt-Untertyp: [product_sub_type]\r\nName: [name]\r\nE-Mail-Adresse: [email]\r\nTelefonnummer: [phone]\r\nK\u00e4ufer anzeigen: [view_buyer_link]","sms_content_pl":"\r\nCze\u015b\u0107, cz\u0142onkiem ADMINS [team_member_name],\r\nInformacje o potencjalnym nabywcy:\r\nProdukt: [product_name]\r\nPodtyp produktu: [product_sub_type]\r\nImi\u0119: [name]\r\nE-mail: [email]\r\nTelefon: [phone]\r\nWy\u015bwietl kupuj\u0105cego: [view_buyer_link]","push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"executive":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"seller":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"buyer":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"trader":{"subject":"New Buyer registered","email_content":"<p><span style=\"font-weight: 400;\">Hi TRADERS member [team_member_name],<\/span><\/p>\r\n<p><span style=\"font-weight: 400;\">Buyer info:<br \/><\/span><span style=\"font-weight: 400;\">Product: [product_name]<br \/><\/span><span style=\"font-weight: 400;\">Product Sub-type: [product_sub_type]<br \/><\/span><span style=\"font-weight: 400;\">Name: [name]<br \/><\/span><span style=\"font-weight: 400;\">Email: [email]<br \/><\/span><span style=\"font-weight: 400;\">Phone: [phone]<br \/><\/span><span style=\"font-weight: 400;\">View Buyer: [view_buyer_link]<\/span><\/p>","email_content_de":"<p>Hallo TRADERS Mitglied<span style=\"font-weight: 400;\"> [team_member_name]<\/span>,<\/p>\r\n<p>K&auml;uferinformationen:<br \/>Produkt: <span style=\"font-weight: 400;\">[product_name]<br \/><\/span>Produkt-Untertyp: <span style=\"font-weight: 400;\">[product_sub_type]<br \/><\/span>Name: <span style=\"font-weight: 400;\">[name]<br \/><\/span>E-Mail-Adresse: [email]<br \/>Telefonnummer: [phone]<br \/>K&auml;ufer anzeigen: <span style=\"font-weight: 400;\">[view_buyer_link]<\/span><\/p>","email_content_pl":"<p><span style=\"font-weight: 400;\">Cze\u015b\u0107, cz\u0142onkiem TRADERS [team_member_name],<\/span><\/p>\r\n<p><span style=\"font-weight: 400;\">Informacje o kupuj\u0105cym:<br \/><\/span><span style=\"font-weight: 400;\">Produkt: [product_name]<br \/><\/span><span style=\"font-weight: 400;\">Podtyp produktu: [product_sub_type]<br \/><\/span><span style=\"font-weight: 400;\">Imi\u0119: [name]<br \/><\/span><span style=\"font-weight: 400;\">E-mail: [email]<br \/><\/span><span style=\"font-weight: 400;\">Telefon: [phone]<br \/><\/span><span style=\"font-weight: 400;\">Wy\u015bwietl kupuj\u0105cego: [view_buyer_link]<\/span><\/p>","sms_content":"\r\nHi TRADERS member [team_member_name],\r\nBuyer info:\r\nProduct: [product_name]\r\nProduct Sub-type: [product_sub_type]\r\nName: [name]\r\nEmail: [email]\r\nPhone: [phone]\r\nView Buyer: [view_buyer_link]","sms_content_de":"\r\nHallo TRADERS Mitglied [team_member_name],\r\nK\u00e4uferinformationen:\r\nProdukt: [product_name]\r\nProdukt-Untertyp: [product_sub_type]\r\nName: [name]\r\nE-Mail-Adresse: [email]\r\nTelefonnummer: [phone]\r\nK\u00e4ufer anzeigen: [view_buyer_link]","sms_content_pl":"\r\nCze\u015b\u0107, cz\u0142onkiem TRADERS [team_member_name],\r\nInformacje o potencjalnym nabywcy:\r\nProdukt: [product_name]\r\nPodtyp produktu: [product_sub_type]\r\nImi\u0119: [name]\r\nE-mail: [email]\r\nTelefon: [phone]\r\nWy\u015bwietl kupuj\u0105cego: [view_buyer_link]","push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"trans":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"usermanager":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"}}'
      ]);
      App\EmailTemplate::updateOrCreate(['title'=>'BUYER REGISTER TO TEAM'],[
          'title' => 'BUYER REGISTER TO TEAM',
          'subject' => 'New Buyer registered',
          'email_content' => '<p><span style="font-weight: 400;">Hi TRADERS member [team_member_name],</span></p>
            <p><span style="font-weight: 400;">Buyer info:</span></p>
            <p><span style="font-weight: 400;">Product: [product_name]</span></p>
            <p><span style="font-weight: 400;">Product Sub-type: [product_sub_type]</span></p>
            <p><span style="font-weight: 400;">Name: [name]</span></p>
            <p><span style="font-weight: 400;">Email: [email]</span></p>
            <p><span style="font-weight: 400;">Phone: [phone]</span></p>
            <p><span style="font-weight: 400;">View Buyer: [view_buyer_link]</span></p>',
          'email_content_de' => '<p>Hallo TRADERS Mitglied<span style="font-weight: 400;"> [team_member_name]</span>,</p>
            <p>K&auml;uferinformationen:</p>
            <p>Produkt: <span style="font-weight: 400;">[product_name]</span></p>
            <p>Produkt-Untertyp: <span style="font-weight: 400;">[product_sub_type]</span></p>
            <p>Name: <span style="font-weight: 400;">[name]</span></p>
            <p>E-Mail-Adresse: [email]</p>
            <p>Telefonnummer: [phone]</p>
            <p>K&auml;ufer anzeigen: <span style="font-weight: 400;">[view_buyer_link]</span></p>',
          'email_content_pl' => '<p><span style="font-weight: 400;">Cześć, członkiem TRADERS [team_member_name],</span></p>
            <p><span style="font-weight: 400;">Informacje o kupującym:</span></p>
            <p><span style="font-weight: 400;">Produkt: [product_name]</span></p>            
            <p><span style="font-weight: 400;">Podtyp produktu: [product_sub_type]</span></p>
            <p><span style="font-weight: 400;">Imię: [name]</span></p>
            <p><span style="font-weight: 400;">E-mail: [email]</span></p>
            <p><span style="font-weight: 400;">Telefon: [phone]</span></p>
            <p><span style="font-weight: 400;">Wyświetl kupującego: [view_buyer_link]</span></p>',
          'sms_content' => '
          Hi TRADERS member [team_member_name],
Buyer info:
Product: [product_name]
Product Sub-type: [product_sub_type]
Name: [name]
Email: [email]
Phone: [phone]
View Buyer: [view_buyer_link]',
          'sms_content_de' => '
          Hallo TRADERS Mitglied [team_member_name],
Käuferinformationen:
Produkt: [product_name]
Produkt-Untertyp: [product_sub_type]
Name: [name]
E-Mail-Adresse: [email]
Telefonnummer: [phone]
Käufer anzeigen: [view_buyer_link]',
          'sms_content_pl' => '
          Cześć, członkiem TRADERS [team_member_name],
Informacje o potencjalnym nabywcy:
Produkt: [product_name]
Podtyp produktu: [product_sub_type]
Imię: [name]
E-mail: [email]
Telefon: [phone]
Wyświetl kupującego: [view_buyer_link]',
'shortcodes' => '[team_member_name], [name], [email], [phone], [product_name], [product_sub_type], [view_buyer_link]'
      ]);
      App\EmailTemplate::updateOrCreate(['title'=>'BUYER CREATED'],[
          'title' => 'BUYER CREATED',
          'subject' => 'You became a buyer now. Get the best quotes',
          'email_content' => '
            <p><span style="font-weight: 400;">Name: [name]</span></p>
            <p><span style="font-weight: 400;">Email: [email]</span></p>
            <p><span style="font-weight: 400;">Password: [password]</span></p>
            <p><span style="font-weight: 400;">Phone: [phone]</span></p>
            <p><span style="font-weight: 400;">The Transport Team</span></p>',
          'email_content_de' => '<p><span style="font-weight: 400;">Name: [name]</span></p>
            <p><span style="font-weight: 400;">E-Mail-Adresse: [email]</span></p>
            <p><span style="font-weight: 400;">Passwort: [password]</span></p>
            <p><span style="font-weight: 400;">Telefonnummer: [phone]</span></p>
            <p><span style="font-weight: 400;">Das Transport-Team</span></p>',
          'email_content_pl' => '
            <p><span style="font-weight: 400;">Imię: [name]</span></p>
            <p><span style="font-weight: 400;">E-mail: [email]</span></p>
            <p><span style="font-weight: 400;">hasło: [password]</span></p>
            <p><span style="font-weight: 400;">Telefon: [phone]</span></p>
            <p><span style="font-weight: 400;">Zespół Transportu</span></p>',
          'sms_content' => '
          Hi [name],
Email: [email]
Password: [password]
Phone: [phone]
Your VegKing Team',
          'sms_content_de' => '
          Hallo [name],
E-Mail-Adresse: [email]
Passwort: [password]
Telefonnummer: [phone]
Das VegKing Team',
          'sms_content_pl' => '
          Cześć [name],
E-mail: [email]
hasło: [password]
Telefon: [phone]
Zespół VegKing',
          'shortcodes' => '[name], [email], [phone], [password]'
      ]);
      App\EmailTemplate::updateOrCreate(['title'=>'SELLER CREATED'],[
          'title' => 'SELLER CREATED',
          'subject' => 'You became a seller now. Sell your stock in 1 click',
          'email_content' => '
            <p><span style="font-weight: 400;">Name: [name]</span></p>
            <p><span style="font-weight: 400;">Email: [email]</span></p>
            <p><span style="font-weight: 400;">Password: [password]</span></p>
            <p><span style="font-weight: 400;">Phone: [phone]</span></p>
            <p><span style="font-weight: 400;">Click here to upload stock: [upload_stock_link]</span></p>
            <p><span style="font-weight: 400;">The Transport Team</span></p>',
          'email_content_de' => '<p><span style="font-weight: 400;">Name: [name]</span></p>
            <p><span style="font-weight: 400;">E-Mail-Adresse: [email]</span></p>
            <p><span style="font-weight: 400;">Passwort: [password]</span></p>
            <p><span style="font-weight: 400;">Telefonnummer: [phone]</span></p>
            <p><span style="font-weight: 400;">Klicken Sie hier, um den Bestand hochzuladen: [upload_stock_link]</span></p>
            <p><span style="font-weight: 400;">Das Transport-Team:</span></p>',
          'email_content_pl' => '
            <p><span style="font-weight: 400;">Imię: [name]</span></p>
            <p><span style="font-weight: 400;">E-mail: [email]</span></p>
            <p><span style="font-weight: 400;">hasło: [password]</span></p>
            <p><span style="font-weight: 400;">Telefon: [phone]</span></p>
            <p><span style="font-weight: 400;">Kliknij tutaj, aby przesłać akcje: [upload_stock_link]</span></p>
            <p><span style="font-weight: 400;">Zespół Transportu</span></p>',
          'sms_content' => '
          Hi [name],
Email: [email]
Password: [password]
Phone: [phone]
Click here to upload stock: [upload_stock_link]
Your VegKing Team',
          'sms_content_de' => '
          Hallo [name],
E-Mail-Adresse: [email]
Passwort: [password]
Telefonnummer: [phone]
Klicken Sie hier, um den Bestand hochzuladen: [upload_stock_link]
Das VegKing-Team',
          'sms_content_pl' => '
          Cześć [name],
E-mail: [email]
hasło: [password]
Telefon: [phone]
Kliknij tutaj, aby przesłać akcje: [upload_stock_link]
Zespół VegKing',
          'shortcodes' => '[name], [email], [phone], [password], [upload_stock_link]'
      ]);
      App\EmailTemplate::updateOrCreate(['title'=>'IMPORT SELLER NOTIFICATION EMAIL'],[
        'title' => 'IMPORT SELLER NOTIFICATION EMAIL',
        'subject' => 'Import Seller Notification Email',
        'email_content' => '<p><span style="font-weight: 400;">User Name [username]</span></p>
          <p><span style="font-weight: 400;">First Name [first_name]</span></p>
          <p><span style="font-weight: 400;">Email [email]</span></p>
          <p><span style="font-weight: 400;">Phone [english_phone_number]</span></p>
          <p><span style="font-weight: 400;">Upload Link [upload_stock_link]</span></p>
          <p><span style="font-weight: 400;">Password [password]</span></p>
          <p><span style="font-weight: 400;">TRADERS member [team_member_name]</span></p>',
        'email_content_de' => '<p><span style="font-weight: 400;">Nutzername [username]</span></p>
          <p><span style="font-weight: 400;">Vorname [first_name]</span></p>
          <p><span style="font-weight: 400;">Telefonnummer [phone]</span></p>
          <p><span style="font-weight: 400;">Link hochladen [upload_stock_link]</span></p>
          <p><span style="font-weight: 400;">Passwort [password]</span></p>
          <p><span style="font-weight: 400;">TRADERS-Mitglied <span style="font-weight: 400;">[team_member_name]</span></p>',
        'email_content_pl' => '<p><span style="font-weight: 400;">User Name [username]</span></p>
          <p><span style="font-weight: 400;">First Name [first_name]</span></p>
          <p><span style="font-weight: 400;">Email [email]</span></p>
          <p><span style="font-weight: 400;">Phone [english_phone_number]</span></p>
          <p><span style="font-weight: 400;">Upload Link [upload_stock_link]</span></p>
          <p><span style="font-weight: 400;">Password [password]</span></p>
          <p><span style="font-weight: 400;">TRADERS member [team_member_name]</span></p>',
        'shortcodes' => '[username], [first_name], [email], [english_phone_number], [upload_stock_link], [password], [team_member_name]'
    ]);
    App\EmailTemplate::updateOrCreate(['title'=>'IMPORT BUYER NOTIFICATION EMAIL'],[
        'title' => 'IMPORT BUYER NOTIFICATION EMAIL',
        'subject' => 'Import Buyer Notification Email',
        'email_content' => '<p><span style="font-weight: 400;">User Name [username]</span></p>
          <p><span style="font-weight: 400;">First Name [first_name]</span></p>
          <p><span style="font-weight: 400;">Email [email]</span></p>
          <p><span style="font-weight: 400;">Phone [english_phone_number]</span></p>
          <p><span style="font-weight: 400;">Upload Link [upload_stock_link]</span></p>
          <p><span style="font-weight: 400;">Password [password]</span></p>
          <p><span style="font-weight: 400;">TRADERS member [team_member_name]</span></p>',
        'email_content_de' => '<p><span style="font-weight: 400;">Nutzername [username]</span></p>
          <p><span style="font-weight: 400;">Vorname [first_name]</span></p>
          <p><span style="font-weight: 400;">Telefonnummer [phone]</span></p>
          <p><span style="font-weight: 400;">Link hochladen [upload_stock_link]</span></p>
          <p><span style="font-weight: 400;">Passwort [password]</span></p>
          <p><span style="font-weight: 400;">TRADERS-Mitglied <span style="font-weight: 400;">[team_member_name]</span></p>',
        'email_content_pl' => '<p><span style="font-weight: 400;">User Name [username]</span></p>
          <p><span style="font-weight: 400;">First Name [first_name]</span></p>
          <p><span style="font-weight: 400;">Email [email]</span></p>
          <p><span style="font-weight: 400;">Phone [english_phone_number]</span></p>
          <p><span style="font-weight: 400;">Upload Link [upload_stock_link]</span></p>
          <p><span style="font-weight: 400;">Password [password]</span></p>
          <p><span style="font-weight: 400;">TRADERS member [team_member_name]</span></p>',
        'shortcodes' => '[username], [first_name], [email], [english_phone_number], [upload_stock_link], [password], [team_member_name]'
    ]);
      App\EmailTemplate::updateOrCreate(['title'=>'GET QUOTES'],[
          'title' => 'GET QUOTES',
          'subject' => 'A Buyer asked for a quote',
          'email_content' => '
            <p><span style="font-weight: 400;">Hi [team_member_name],</span></p>
            <p><span style="font-weight: 400;">Buyer [name] asked for a quote.</span></p>
            <p><span style="font-weight: 400;">Phone: [phone]</span></p>
            <p><span style="font-weight: 400;">Whatsapp : [phone]</span></p>',
          'email_content_de' => '<p>Hallo <span style="font-weight: 400;">[team_member_name],</span></p>
            <p>K&auml;ufer <span style="font-weight: 400;">[name]</span></p>
            <p>Telefonnummer<span style="font-weight: 400;">: [phone]</span></p>
            <p>WhatsApp<span style="font-weight: 400;">: [phone]</span></p>',
          'email_content_pl' => '
            <p><span style="font-weight: 400;">cześć [team_member_name],</span></p>
            <p><span style="font-weight: 400;">Kupujący [name] poprosił o wycenę.</span></p>
            <p><span style="font-weight: 400;">Telefon: [phone]</span></p>
            <p><span style="font-weight: 400;">Whatsapp: [phone]</span></p>',
          'sms_content' => '
          Hi [team_member_name],
Buyer [name] asked for a quote.
Phone: [phone]
Whatsapp : [phone]
View Buyer: [view_buyer_link]
Your VegKing Team',
          'sms_content_de' => '
          Hi [team_member_name],
Buyer [name] asked for a quote.
Phone: [phone]
Whatsapp : [phone]
View Buyer: [view_buyer_link]
Your VegKing Team',
          'sms_content_pl' => '
          Cześć [name],
Kupujący [name] poprosił o wycenę.
Telefon: [phone]
Whatsapp: [phone]
Wyświetl kupującego: [view_buyer_link]
Zespół VegKing',
          'shortcodes' => '[team_member_name], [name], [phone], [view_buyer_link]'
      ]);
      App\EmailTemplate::updateOrCreate(['title'=>'BUYER SHORT REGISTER'],[
          'title' => 'BUYER SHORT REGISTER',
          'subject' => 'Confirm email to get the best quotes',
          'email_content' => '<p><span style="font-weight: 400;">Please click here to confirm your email and get the best price quotes [verification_link]</span></p>
            <p><span style="font-weight: 400;">or Call: [english_phone_number]</span></p>
            <p><span style="font-weight: 400;">Name: [name]</span></p>
            <p><span style="font-weight: 400;">Email: [email]</span></p>
            <p><span style="font-weight: 400;">Phone: [phone]</span></p>
            <p><span style="font-weight: 400;">The Transport Team</span></p>',
          'email_content_de' => '<p>Bitte Klicken Sie hier, um Ihre E-Mail-Adresse zu best&auml;tigen und die besten Preisangebote zu erhalten <span style="font-weight: 400;">[verification_link]</span></p>
            <p><span style="font-weight: 400;">oder anrufen: [english_phone_number]</span></p>
            <p><span style="font-weight: 400;">Name: [name]<br /></span></p>
            <p><span style="font-weight: 400;">E-Mail-Adresse: [email]<br /></span></p>
            <p><span style="font-weight: 400;">Telefonnummer: [phone]</span></p>
            <p><span style="font-weight: 400;">Das Transport-Team:</span></p>',
          'email_content_pl' => '<p><span style="font-weight: 400;">Proszę kliknąć tutaj, aby potwierdzić swój adres e-mail i uzyskać najlepsze oferty cen [verification_link]</span></p>
            <p><span style="font-weight: 400;">albo zadzwoń do nas: [english_phone_number]</span></p>
            <p><span style="font-weight: 400;">Imię: [name]</span></p>
            <p><span style="font-weight: 400;">E-mail: [email]</span></p>
            <p><span style="font-weight: 400;">Telefon: [phone]</span></p>
            <p><span style="font-weight: 400;">Zespół Transportu</span></p>',
          'sms_content' => '
          Hi [name],
Please check for a Vegking email and get the best price quotes.
Your VegKing Team',
          'sms_content_de' => '
          Hallo [name],
Please check for a Vegking email and get the best price quotes.
Das VegKing Team',
          'sms_content_pl' => '
          Cześć [name],
Sprawdź wiadomość e-mail dla wegetarian i uzyskaj najlepsze oferty cenowe.
Zespół VegKing',
          'shortcodes' => '[name], [email], [phone], [verification_link], [english_phone_number]'
      ]);
      App\EmailTemplate::updateOrCreate(['title'=>'BUYER SHORT REGISTER TO TEAM'],[
          'title' => 'BUYER SHORT REGISTER TO TEAM',
          'subject' => 'New Buyer short registered',
          'email_content' => '<p><span style="font-weight: 400;">Hi TRADERS member [team_member_name],</span></p>
            <p><span style="font-weight: 400;">Buyer info:</span></p>
            <p><span style="font-weight: 400;">Name: [name]</span></p>
            <p><span style="font-weight: 400;">Email: [email]</span></p>
            <p><span style="font-weight: 400;">Phone: [phone]</span></p>
            <p><span style="font-weight: 400;">View Buyer: [view_buyer_link]</span></p>',
          'email_content_de' => '<p>Hallo TRADERS Mitglied<span style="font-weight: 400;"> [team_member_name]</span>,</p>
            <p>K&auml;uferinformationen:</p>
            <p>Name: <span style="font-weight: 400;">[name]</span></p>
            <p>E-Mail-Adresse: [email]</p>
            <p>Telefonnummer: [phone]</p>
            <p>K&auml;ufer anzeigen: <span style="font-weight: 400;">[view_buyer_link]</span></p>',
          'email_content_pl' => '<p><span style="font-weight: 400;">Cześć, członkiem TRADERS [team_member_name],</span></p>
            <p><span style="font-weight: 400;">Informacje o kupującym:</span></p>
            <p><span style="font-weight: 400;">Imię: [name]</span></p>
            <p><span style="font-weight: 400;">E-mail: [email]</span></p>
            <p><span style="font-weight: 400;">Telefon: [phone]</span></p>
            <p><span style="font-weight: 400;">Wyświetl kupującego: [view_buyer_link]</span></p>',
          'sms_content' => '
          Hi TRADERS member [team_member_name],
Buyer info:
Name: [name]
Email: [email]
Phone: [phone]
View Buyer: [view_buyer_link]',
          'sms_content_de' => '
          Hallo TRADERS Mitglied [team_member_name],
Käuferinformationen:
Name: [name]
E-Mail-Adresse: [email]
Telefonnummer: [phone]
Käufer anzeigen: [view_buyer_link]',
          'sms_content_pl' => '
          Cześć, członkiem TRADERS [team_member_name],
Informacje o potencjalnym nabywcy:
Imię: [name]
E-mail: [email]
Telefon: [phone]
Wyświetl kupującego: [view_buyer_link]',
'shortcodes' => '[team_member_name], [name], [email], [phone], [view_buyer_link]'
      ]);
      App\EmailTemplate::updateOrCreate(['title'=>'BUYER SHORT REGISTER STEP1'],[
          'title' => 'BUYER SHORT REGISTER STEP1',
          'subject' => 'Thanks for contacting us',
          'email_content' => '
            <p><span style="font-weight: 400;">Thank you for join to us. If you want to complete your registration please go to your profile and complete registration.</span></p>
            <p><span style="font-weight: 400;">Email: [email]</span></p>
            <p><span style="font-weight: 400;">Complete your registration by clicking here: [buyerlead_step1_link]</span></p>',
          'email_content_de' => '<p><span style="font-weight: 400;">Vielen Dank, dass Sie sich uns anschließen. Wenn Sie Ihre Registrierung abschließen möchten, gehen Sie zu Ihrem Profil und schließen Sie die Registrierung ab.</span></p>
            <p><span style="font-weight: 400;">E-mail: [email]</span></p>
            <p><span style="font-weight: 400;">Vervollständigen Sie Ihre Registrierung, indem Sie hier klicken: [buyerlead_step1_link]</span></p>',
          'email_content_pl' => '
            <p><span style="font-weight: 400;">Dziękujemy za dołącz do nas. Jeśli chcesz dokończyć rejestrację, przejdź do swojego profilu i dokończ rejestrację.</span></p>
            <p><span style="font-weight: 400;">E-mail: [email]</span></p>
            <p><span style="font-weight: 400;">Zakończ rejestrację, klikając tutaj: [buyerlead_step1_link]</span></p>',
          'sms_content' => '
          Thank you for join to us. If you want to complete your registration please go to your profile and complete registration.
Email: [email]
Complete your registration by clicking here: [buyerlead_step1_link]
Your VegKing Team',
          'sms_content_de' => '
          Vielen Dank, dass Sie sich uns anschließen. Wenn Sie Ihre Registrierung abschließen möchten, gehen Sie zu Ihrem Profil und schließen Sie die Registrierung ab.
E-mail: [email]
Vervollständigen Sie Ihre Registrierung, indem Sie hier klicken: [buyerlead_step1_link]
Your VegKing Team',
          'sms_content_pl' => '
          Vielen Dank, dass Sie sich uns anschließen. Wenn Sie Ihre Registrierung abschließen möchten, gehen Sie zu Ihrem Profil und schließen Sie die Registrierung ab.
E-mail: [email]
Zakończ rejestrację, klikając tutaj: [buyerlead_step1_link]
Zespół VegKing',
          'shortcodes' => '[email], [buyerlead_step1_link]'
      ]);
      App\EmailTemplate::updateOrCreate(['title'=>'BUYER SHORT REGISTER STEP2'],[
          'title' => 'BUYER SHORT REGISTER STEP2',
          'subject' => 'Thanks for contacting us',
          'email_content' => '
            <p><span style="font-weight: 400;">Thank you for join to us. If you want to complete your registration please go to your profile and complete registration.</span></p>
            <p><span style="font-weight: 400;">Email: [email]</span></p>
            <p><span style="font-weight: 400;">Phone: [phone]</span></p>
            <p><span style="font-weight: 400;">Complete your registration by clicking here: [buyerlead_step2_link]</span></p>',
          'email_content_de' => '<p><span style="font-weight: 400;">Vielen Dank, dass Sie sich uns anschließen. Wenn Sie Ihre Registrierung abschließen möchten, gehen Sie zu Ihrem Profil und schließen Sie die Registrierung ab.</span></p>
            <p><span style="font-weight: 400;">E-mail: [email]</span></p>
            <p><span style="font-weight: 400;">Telefon: [phone]</span></p>
            <p><span style="font-weight: 400;">Vervollständigen Sie Ihre Registrierung, indem Sie hier klicken: [buyerlead_step2_link]</span></p>',
          'email_content_pl' => '
            <p><span style="font-weight: 400;">Dziękujemy za dołącz do nas. Jeśli chcesz dokończyć rejestrację, przejdź do swojego profilu i dokończ rejestrację.</span></p>
            <p><span style="font-weight: 400;">E-mail: [email]</span></p>
            <p><span style="font-weight: 400;">Telefon: [phone]</span></p>
            <p><span style="font-weight: 400;">Zakończ rejestrację, klikając tutaj: [buyerlead_step2_link]</span></p>',
          'sms_content' => '
          Thank you for join to us. If you want to complete your registration please go to your profile and complete registration.
Email: [email]
Phone: [phone]
Complete your registration by clicking here: [buyerlead_step2_link]
Your VegKing Team',
          'sms_content_de' => '
          Vielen Dank, dass Sie sich uns anschließen. Wenn Sie Ihre Registrierung abschließen möchten, gehen Sie zu Ihrem Profil und schließen Sie die Registrierung ab.
E-mail: [email]
Telefon: [phone]
Vervollständigen Sie Ihre Registrierung, indem Sie hier klicken: [buyerlead_step2_link]
Your VegKing Team',
          'sms_content_pl' => '
          Vielen Dank, dass Sie sich uns anschließen. Wenn Sie Ihre Registrierung abschließen möchten, gehen Sie zu Ihrem Profil und schließen Sie die Registrierung ab.
E-mail: [email]
Telefon: [phone]
Zakończ rejestrację, klikając tutaj: [buyerlead_step2_link]
Zespół VegKing',
          'shortcodes' => '[email], [phone], [buyerlead_step2_link]'
      ]);
      App\EmailTemplate::updateOrCreate(['title'=>'BUYER SHORT REGISTER STEP1 TO TEAM'],[
          'title' => 'BUYER SHORT REGISTER STEP1 TO TEAM',
          'subject' => 'New Buyer completed step1',
          'email_content' => '
            <p><span style="font-weight: 400;">Hi TRADERS member [team_member_name],</span></p>
            <p><span style="font-weight: 400;">Buyer info:</span></p>
            <p><span style="font-weight: 400;">Email: [email]</span></p>',
          'email_content_de' => '
            <p><span style="font-weight: 400;">Hallo TRADERS-Mitglied [team_member_name],</span></p>
            <p><span style="font-weight: 400;">Käufer info:</span></p>
            <p><span style="font-weight: 400;">E-mail: [email]</span></p>',
          'email_content_pl' => '<p><span style="font-weight: 400;">Cześć, członkiem TRADERS [team_member_name],</span></p>
            <p><span style="font-weight: 400;">Informacje o kupującym:</span></p>
            <p><span style="font-weight: 400;">E-mail: [email]</span></p>',
          'sms_content' => '
          Hi TRADERS member [team_member_name],
Buyer info:
Email: [email]
Your VegKing Team',
          'sms_content_de' => '
          Cześć, członkiem TRADERS [team_member_name],
Käufer info:
E-mail: [email]
Your VegKing Team',
          'sms_content_pl' => '
          Vielen Dank, dass Sie sich uns anschließen. Wenn Sie Ihre Registrierung abschließen möchten, gehen Sie zu Ihrem Profil und schließen Sie die Registrierung ab.
Informacje o kupującym:
E-mail: [email]
Zespół VegKing',
          'shortcodes' => '[email], [team_member_name]'
      ]);
      App\EmailTemplate::updateOrCreate(['title'=>'BUYER SHORT REGISTER STEP2 TO TEAM'],[
          'title' => 'BUYER SHORT REGISTER STEP2 TO TEAM',
          'subject' => 'New Buyer completed step2',
          'email_content' => '
            <p><span style="font-weight: 400;">Hi TRADERS member [team_member_name],</span></p>
            <p><span style="font-weight: 400;">Buyer info:</span></p>
            <p><span style="font-weight: 400;">Email: [email]</span></p>
            <p><span style="font-weight: 400;">Phone: [phone]</span></p>',
          'email_content_de' => '
            <p><span style="font-weight: 400;">Hallo TRADERS-Mitglied [team_member_name],</span></p>
            <p><span style="font-weight: 400;">Käufer info:</span></p>
            <p><span style="font-weight: 400;">E-mail: [email]</span></p>
            <p><span style="font-weight: 400;">Telefon: [phone]</span></p>',
          'email_content_pl' => '<p><span style="font-weight: 400;">Cześć, członkiem TRADERS [team_member_name],</span></p>
            <p><span style="font-weight: 400;">Informacje o kupującym:</span></p>
            <p><span style="font-weight: 400;">E-mail: [email]</span></p>
            <p><span style="font-weight: 400;">Telefon: [phone]</span></p>',
          'sms_content' => '
          Hi TRADERS member [team_member_name],
Buyer info:
Email: [email]
Phone: [phone]
Your VegKing Team',
          'sms_content_de' => '
          Cześć, członkiem TRADERS [team_member_name],
Käufer info:
E-mail: [email]
Telefon: [phone]
Your VegKing Team',
          'sms_content_pl' => '
          Vielen Dank, dass Sie sich uns anschließen. Wenn Sie Ihre Registrierung abschließen möchten, gehen Sie zu Ihrem Profil und schließen Sie die Registrierung ab.
Informacje o kupującym:
E-mail: [email]
Telefon: [phone]
Zespół VegKing',
          'shortcodes' => '[email], [phone], [team_member_name]'
      ]);
      App\EmailTemplate::updateOrCreate(['title'=>'STOCK MATCHED'],[
          'title' => 'STOCK MATCHED',
      //seller
          'subject' => 'Stock matched on veg king!',
          'email_content' => '<p><span style="font-weight: 400;">Hi SELLERS member [team_member_name],</span></p> 
          <p><span style="font-weight: 400;">Your stock link: [view_stock_link]</span></p>',
          'email_content_de' => '
          <p><span style="font-weight: 400;">Hallo SELLERS Mitglied [team_member_name],</span></p> 
          <p><span style="font-weight: 400;">Lager anzeigen: [view_stock_link]</span></p>',
          
          'email_content_pl' =>'
          <p><span style="font-weight: 400;">cześć SELLERS członek [team_member_name],</span></p> 
          <p><span style="font-weight: 400;">Zbiory mecze: [view_stock_link]</span></p>',


          'sms_content' =>  '
          Hi SELLERS member [team_member_name],
           *Your pref link*: [view_stock_link]
           Regards,
           Your VegKing Team',

            'sms_content_de' =>'
             Hallo SELLERS Mitglied [team_member_name],
             *Lager anzeigen:*: [view_stock_link]
             Regards,
             Your VegKing Team',

            'sms_content_pl' => '
             cześć SELLERS członek [team_member_name],
             *Zbiory mecze*: [view_stock_link]
              Regards,
              Your VegKing Team',

      //The Buyer 
            'buyer_subject' => 'Stock matched on veg king!',

            'buyer_email_content' => ' 
            <p><span style="font-weight: 400;">Hi BUYERS member [team_member_name],</span></p> 
            <p><span style="font-weight: 400;">Your pref link: [view_pref_link]</span></p>',

            'buyer_email_content_de' => '
            <p><span style="font-weight: 400;">Hallo BUYERS Mitglied [team_member_name],</span></p> 
            <p><span style="font-weight: 400;">präferenz anzeigen: [view_pref_link]</span></p>',
            
            'buyer_email_content_pl' => '
            <p><span style="font-weight: 400;">cześć BUYERS członek [team_member_name],</span></p> 
            <p><span style="font-weight: 400;">preferencje mecze: [view_pref_link]</span></p>',

            'buyer_sms_content' => '
             Hi BUYERS member [team_member_name],
             *Your pref link*: [view_pref_link]
             Regards,
             Your VegKing Team',

            'buyer_sms_content_de' => '
            Hallo BUYERS Mitglied [team_member_name],
             *präferenz anzeigen:*: [view_pref_link]
             Regards,
             Your VegKing Team',

            'buyer_sms_content_pl' => '
            cześć BUYERS członek [team_member_name],
              *preferencje mecze*: [view_pref_link]
              Regards,
              Your VegKing Team',

         //The trader

            'trader_subject' => 'Stock matched on veg king!',

            'trader_email_content' => '
            <p><span style="font-weight: 400;">Hi TRADERS member [team_member_name],</span></p> 
            <p><span style="font-weight: 400;">Match Id: [match_id]</span></p>
            <p><span style="font-weight: 400;">Stock Id: [stock_id]</span></p>
            <p><span style="font-weight: 400;">Seller Username: [seller_username]</span></p>
            <p><span style="font-weight: 400;">Buyer Pref Id: [buyer_pref_id]</span></p>
            <p><span style="font-weight: 400;">Buyer: [buyer_username]</span></p>
            <p><span style="font-weight: 400;">Product Name: [product_name]</span></p>
            <p><span style="font-weight: 400;">Stock Price: [stock_price]</span></p>
            <p><span style="font-weight: 400;">View All Matches: [view_matches_link]</span></p>',

            'trader_email_content_de' => '
            <p><span style="font-weight: 400;">Hallo TRADERS Mitglied [team_member_name],</span></p> 
            <p><span style="font-weight: 400;">Übereinstimmungs-ID: [match_id]</span></p>
            <p><span style="font-weight: 400;">Bestands-Id: [stock_id]</span></p>
            <p><span style="font-weight: 400;">Benutzername des Verkäufers: [seller_username]</span></p>
            <p><span style="font-weight: 400;">Käuferpräferenz-ID: [buyer_pref_id]</span></p>
            <p><span style="font-weight: 400;">Käuferin: [buyer_username]</span></p>
            <p><span style="font-weight: 400;">Produktname: [product_name]</span></p>
            <p><span style="font-weight: 400;">Standard Preis: [stock_price]</span></p>
            <p><span style="font-weight: 400;">Alle Übereinstimmungen anzeigen: [view_matches_link]</span></p>',

            'trader_email_content_pl' => '
            <p><span style="font-weight: 400;">cześć TRADERS członek [team_member_name],</span></p> 
            <p><span style="font-weight: 400;">Identyfikator dopasowania: [match_id]</span></p>
            <p><span style="font-weight: 400;">ID towaru: [stock_id]</span></p>
            <p><span style="font-weight: 400;">Nazwa użytkownika sprzedawcy: [seller_username]</span></p>
            <p><span style="font-weight: 400;">Identyfikator prefiksu kupującego: [buyer_pref_id]</span></p>
            <p><span style="font-weight: 400;">Kupujący: [buyer_username]</span></p>
            <p><span style="font-weight: 400;">Nazwa produktu: [product_name]</span></p>
            <p><span style="font-weight: 400;">Cena akcji: [stock_price]</span></p>
            <p><span style="font-weight: 400;">Zobacz wszystkie mecze: [view_matches_link]</span></p>',

            'trader_sms_content' => '
            Hi TRADERS member [team_member_name],
            *Stock: #[stock_id] * ([seller_username]) matched to *Buyer: #[buyer_id] * ([buyer_username]) of [product_name]
            *Buyer Pref ID*: [buyer_pref_id]
            *Stock Price*: [stock_price]
            *View All Matches*: [view_matches_link]',

            'trader_sms_content_de' => '
            Hallo TRADERS Mitglied [team_member_name],
            *Lager: #[stock_id] * ([seller_username]) abgestimmt auf *Käuferin: #[buyer_id] * ([buyer_username]) von [product_name]
            *Käuferpräferenz-ID*: [buyer_pref_id]
            *Standard Preis*: [stock_price]
            *Alle Übereinstimmungen anzeigen*: [view_matches_link]',

            'trader_sms_content_pl' => '
            cześć TRADERS członek [team_member_name],
            *Zbiory: #[stock_id] * ([seller_username]) dopasowane do *Buyer: #[buyer_id] * ([buyer_username]) z [product_name]
            *Identyfikator prefiksu kupującego*: [buyer_pref_id]
            *Cena akcji*: [stock_price]
            *Zobacz wszystkie mecze*: [view_matches_link]',

            'recipients' => '1001,1002,1003,1,0,0,0,0,0,0,0,0',

             'roles_content' => '{"administrator":{"subject":"Stock matched on Veg King!","email_content":"<p><span class=\"im\">You have received this email because the Stock matched.&nbsp;<br \/>For more information :<br \/>Match ID: [match_id]<br \/><\/span>Stock ID: [stock_id]<br \/>Seller: [seller_username]<br \/>Buyer Pref ID: [buyer_pref_id]<br \/>Buyer: [buyer_username]<br \/>Product: [product_name]<br \/>Stock Price: [stock_price]<br \/>View Matches link: [view_matches_link]<\/p>\r\n<p>Best Regards,<br \/>Your VegKing Team<\/p>","email_content_de":"<p><span class=\"im\">You have received this email because the Stock matched.&nbsp;<br \/>For more information :<br \/>Match ID: [match_id]<br \/><\/span>Stock ID: [stock_id]<br \/>Seller: [seller_username]<br \/>Buyer Pref ID: [buyer_pref_id]<br \/>Buyer: [buyer_username]<br \/>Product: [product_name]<br \/>Stock Price: [stock_price]<br \/>View Matches Link: [view_matches_link]<\/p>\r\n<p>Best Regards,<br \/>Your VegKing Team<\/p>","email_content_pl":"<p><span class=\"im\">You have received this email because the Stock matched.&nbsp;<br \/>For more information :<br \/>Match ID: [match_id]<br \/><\/span>Stock ID: [stock_id]<br \/>Seller: [seller_username]<br \/>Buyer Pref ID: [buyer_pref_id]<br \/>Buyer: [buyer_username]<br \/>Product: [product_name]<br \/>Stock Price: [stock_price]<br \/>View Matches Link: [view_matches_link]<\/p>\r\n<p>Best Regards,<br \/>Your VegKing Team<\/p>","sms_content":"\r\nStock Matched on vegking.\r\nMatch ID: [match_id]\r\nStock ID: [stock_id]\r\nBuyer Pref ID: [buyer_pref_id]\r\nRegards,\r\nYour VegKing Team","sms_content_de":"\r\nStock Matched on vegking.\r\nMatch ID: [match_id]\r\nStock ID: [stock_id]\r\nBuyer Pref ID: [buyer_pref_id]\r\nRegards,\r\nYour VegKing Team","sms_content_pl":"\r\nStock Matched on vegking.\r\nMatch ID: [match_id]\r\nStock ID: [stock_id]\r\nBuyer Pref ID: [buyer_pref_id]\r\nRegards,\r\nYour VegKing Team","push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"executive":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"seller":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"buyer":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"trader":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"trans":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"usermanager":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"adminuser":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"user":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"}}',

             'shortcodes' => '[team_member_name], [match_id], [stock_id], [seller_username], [buyer_pref_id], [buyer_id], [buyer_username], [product_name], [stock_price], [buyer_total_prefs], [profit_per_ton], [quantity], [view_matches_link], [startloop], [endloop]'
      ]);

      App\EmailTemplate::updateOrCreate(['title'=>'USER CREATED'],[
          'title' => 'USER CREATED',
          'subject' => 'You became a user now',
          'email_content' => '
            <p><span style="font-weight: 400;">Name: [name]</span></p>
            <p><span style="font-weight: 400;">Email: [email]</span></p>
            <p><span style="font-weight: 400;">Password: [password]</span></p>
            <p><span style="font-weight: 400;">Phone: [phone]</span></p>
            <p><span style="font-weight: 400;">The Transport Team</span></p>',
          'email_content_de' => '<p><span style="font-weight: 400;">Name: [name]</span></p>
            <p><span style="font-weight: 400;">E-Mail-Adresse: [email]</span></p>
            <p><span style="font-weight: 400;">Passwort: [password]</span></p>
            <p><span style="font-weight: 400;">Telefonnummer: [phone]</span></p>
            <p><span style="font-weight: 400;">Das Transport-Team:</span></p>',
          'email_content_pl' => '
            <p><span style="font-weight: 400;">Imię: [name]</span></p>
            <p><span style="font-weight: 400;">E-mail: [email]</span></p>
            <p><span style="font-weight: 400;">hasło: [password]</span></p>
            <p><span style="font-weight: 400;">Telefon: [phone]</span></p>            
            <p><span style="font-weight: 400;">Zespół Transportu</span></p>',
          'sms_content' => '
          Hi [name],
            Email: [email]
            Password: [password]
            Phone: [phone]
            Your VegKing Team',
                      'sms_content_de' => '
                      Hallo [name],
            E-Mail-Adresse: [email]
            Passwort: [password]
            Telefonnummer: [phone]
            Das VegKing-Team',
                      'sms_content_pl' => '
                      Cześć [name],
            E-mail: [email]
            hasło: [password]
            Telefon: [phone]
            Zespół VegKing',
            'trader_subject' => 'User created on Veg King!',
            'trader_email_content' => '<p>&nbsp;</p>
            <p>Congrates! You have created new user successfully.<br /><br />Regards,<br />Your VegKing Team</p>',
            'trader_email_content_de' => '<p>&nbsp;</p>
            <p>Congrates! You have created new user successfully.<br /><br />Regards,<br />Your VegKing Team</p>',
            'trader_email_content_pl' => '<p>&nbsp;</p>
            <p>Congrates! You have created new user successfully.<br /><br />Regards,<br />Your VegKing Team</p>',
            'trader_sms_content' => '
            Congrates! You have created new user successfully.
  
            Regards,
            Your VegKing Team',
            'trader_sms_content_de' => '
            Congrates! You have created new user successfully.
  
            Regards,
            Your VegKing Team',
            'trader_sms_content_pl' => '
            Congrates! You have created new user successfully.
  
            Regards,
            Your VegKing Team',
            'recipients' => '0,0,1003,1,0,0,0,0,0,0,0,0',
            'roles_content' => '{"administrator":{"subject":"User created on Veg King!","email_content":"<p><span class=\"im\">You have received this email because the new user was created.&nbsp;<br \/>For more information about user:<br \/>User: [user]<br \/><\/span>Email: [email]<br \/>Phone: [phone]<\/p>\r\n<p>Best Regards,<br \/>Your VegKing Team<\/p>","email_content_de":"<p><span class=\"im\">You have received this email because the new sale was created.&nbsp;<br \/>For more information about user:<br \/>User: [User]<br \/><\/span>Email: [email]<br \/>Phone: [phone]<\/p>\r\n<p>Best Regards,<br \/>Your VegKing Team<\/p>","email_content_pl":"<p><span class=\"im\">You have received this email because the new user was created.&nbsp;<br \/>For more information about user:<br \/>User: [user]<br \/><\/span>Email: [email]<br \/>Phone: [phone]<\/p>\r\n<p>Best Regards,<br \/>Your VegKing Team<\/p>","sms_content":"\r\nPlease check new user has been generated.\r\nUser: [user]\r\nRegards,\r\nYour VegKing Team","sms_content_de":"\r\nPlease check new user has been generated.\r\nUser: [user_url]\r\nRegards,\r\nYour VegKing Team","sms_content_pl":"\r\nPlease check new user has been generated.\r\nUser: [user]\r\nRegards,\r\nYour VegKing Team","push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"executive":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"seller":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"buyer":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"trader":{"subject":"User created on Veg King!","email_content":"<p><span class=\"im\">You have received this email because the new user was created.&nbsp;<br \/>For more information about user:<br \/>User: [user]<br \/><\/span>Email: [email]<br \/>Phone: [phone]<\/p>\r\n<p>Best Regards,<br \/>Your VegKing Team<\/p>","email_content_de":"<p><span class=\"im\">You have received this email because the new user was created.&nbsp;<br \/>For more information abour user:<br \/>User: [user]<br \/><\/span>Email: [email]<br \/>Phone: [phone]<\/p>\r\n<p>Best Regards,<br \/>Your VegKing Team<\/p>","email_content_pl":"<p><span class=\"im\">You have received this email because the new user was created.&nbsp;<br \/>For more information about user:<br \/>User: [user]<br \/><\/span>Email: [email]<br \/>Phone: [phone]<\/p>\r\n<p>Best Regards,<br \/>Your VegKing Team<\/p>","sms_content":"\r\nPlease check new user has been generated.\r\nUser: [user]\r\nRegards,\r\nYour VegKing Team","sms_content_de":"\r\nPlease check new user has been generated.\r\nUser: [user]\r\nRegards,\r\nYour VegKing Team","sms_content_pl":"\r\nPlease check new user has been generated.\r\nUser: [user]\r\nRegards,\r\nYour VegKing Team","push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"trans":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"usermanager":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"adminuser":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"user":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"}}',
            'shortcodes' => '[name], [email], [phone], [password]'
      ]);

      App\EmailTemplate::updateOrCreate(['title'=>'SALES REQUEST'],[
        'title' => 'SALES REQUEST',
        'subject' => 'Sales created on Veg King!',
        'email_content' => '<div>&nbsp;</div>
        <div>Click here to Confirm Purchase order: [order_cofirm_url]</div>
        <div>Click here to Edit Loads Details: [order_edit_url]</div>
        <div>Transport Id: [transport_id]</div>
        <div>Regards,</div>
        <div>Your VegKing Team</div>
        <div>if you are having troble clicking the Confirm Order button,copy and paste the URL below into your web browser: [order_cofirm_url]</div>',
        'email_content_de' => '<div>&nbsp;</div>
        <div>Click here to Confirm Purchase order: [order_cofirm_url]</div>
        <div>Click here to Edit Loads Details: [order_edit_url]</div>
        <div>Transport Id: [transport_id]</div>
        <div>Regards,</div>
        <div>Your VegKing Team</div>
        <div>if you are having troble clicking the Confirm Order button,copy and paste the URL below into your web browser: [order_cofirm_url]</div>',
        'email_content_pl' => '<div>&nbsp;</div>
        <div>Click here to Confirm Purchase order: [order_cofirm_url]</div>
        <div>Click here to Edit Loads Details: [order_edit_url]</div>
        <div>Transport Id: [transport_id]</div>
        <div>Regards,</div>
        <div>Your VegKing Team</div>
        <div>if you are having troble clicking the Confirm Order button,copy and paste the URL below into your web browser: [order_cofirm_url]</div>',
        
        'sms_content' => '
        Please see attached document sales request
        Regards,
        Your VegKing Team',

        'sms_content_de' => '
        Please see attached document sales request
        Regards,
        Your VegKing Team',

        'sms_content_pl' => '
        Please see attached document sales request
        Regards,
        Your VegKing Team',

        'buyer_subject' => 'Sales created on Veg King!',

        'buyer_email_content' => '<p>&nbsp;</p>
        <p>Congrates! Your order request is in process.<br />VegKing Team will get back to you soon.<br /><br />Regards,<br />Your VegKing Team</p>',
        
        'buyer_email_content_de' => '<p>&nbsp;</p>
        <p>Congrates! Your order request is in process.<br />VegKing Team will get back to you soon.<br /><br />Regards,<br />Your VegKing Team</p>',
        
        'buyer_email_content_pl' => '<p>&nbsp;</p>
        <p>Congrates! Your order request is in process.<br />VegKing Team will get back to you soon.<br /><br />Regards,<br />Your VegKing Team</p>',
       
        'buyer_sms_content' => '
         Congrates! Your order request is in process.
        VegKing Team will get back to you soon.
        
        Regards,
        Your VegKing Team',
        'buyer_sms_content_de' => '
         Congrates! Your order request is in process.
        VegKing Team will get back to you soon.
        
        Regards,
        Your VegKing Team',

        'buyer_sms_content_pl' => '
         Congrates! Your order request is in process.
        VegKing Team will get back to you soon.
        
        Regards,
        Your VegKing Team',

        'trader_subject' => 'Sales created on Veg King!',

        'trader_email_content' => '<p>&nbsp;</p>
        <p>Congrates! You have created new sale successfully.<br /><br />Regards,<br />Your VegKing Team</p>',

        'trader_email_content_de' => '<p>&nbsp;</p>
        <p>Congrates! You have created new sale successfully.<br /><br />Regards,<br />Your VegKing Team</p>',

        'trader_email_content_pl' => '<p>&nbsp;</p>
        <p>Congrates! You have created new sale successfully.<br /><br />Regards,<br />Your VegKing Team</p>',

        'trader_sms_content' => '
        Congrates! You have created new sale successfully.

        Regards,
        Your VegKing Team',

        'trader_sms_content_de' => '
        Congrates! You have created new sale successfully.

        Regards,
        Your VegKing Team',

        'trader_sms_content_pl' => '
        Congrates! You have created new sale successfully.

        Regards,
        Your VegKing Team',

        'recipients' => '1001,1002,1003,1,0,0,0,5,0,0',
        'roles_content' => '{"administrator":{"subject":"Sales created on Veg King!","email_content":"<p><span class=\"im\">You have received this email because the new sale was created.&nbsp;<br \/>For more information please check the link below:<br \/>Order: [order_url]<br \/><\/span>Buyer: [username]<br \/>Seller: [seller_id]<span class=\"im\"><br \/>Product: [product_id]<br \/>You can directly contact clients for update information for this sale.&nbsp;<\/span><\/p>\r\n<p>Best Regards,<br \/>Your VegKing Team<\/p>","email_content_de":"<p><span class=\"im\">You have received this email because the new sale was created.&nbsp;<br \/>For more information please check the link below:<br \/>Order: [order_url]<br \/><\/span>Buyer: [username]<br \/>Seller: [seller_id]<span class=\"im\"><br \/>Product: [product_id]<br \/>You can directly contact clients for update information for this sale.&nbsp;<\/span><\/p>\r\n<p>Best Regards,<br \/>Your VegKing Team<\/p>","email_content_pl":"<p><span class=\"im\">You have received this email because the new sale was created.&nbsp;<br \/>For more information please check the link below:<br \/>Order: [order_url]<br \/><\/span>Buyer: [username]<br \/>Seller: [seller_id]<span class=\"im\"><br \/>Product: [product_id]<br \/>You can directly contact clients for update information for this sale.&nbsp;<\/span><\/p>\r\n<p>Best Regards,<br \/>Your VegKing Team<\/p>","sms_content":"\r\nPlease check new user has been generated.\r\nOrder: [order_url]\r\nRegards,\r\nYour VegKing Team","sms_content_de":"\r\nPlease check new sale has been generated.\r\nOrder: [order_url]\r\nRegards,\r\nYour VegKing Team","sms_content_pl":"\r\nPlease check new sale has been generated.\r\nOrder: [order_url]\r\nRegards,\r\nYour VegKing Team","push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"executive":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"seller":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"buyer":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"trader":{"subject":"Sales created on Veg King!","email_content":"<p><span class=\"im\">You have received this email because the new sale was created.&nbsp;<br \/>For more information please check the link below:<br \/>Order: [order_url]<br \/><\/span>Buyer: [username]<br \/>Seller: [seller_id]<span class=\"im\"><br \/>Product: [product_id]<br \/>You can directly contact clients for update information for this sale.&nbsp;<\/span><\/p>\r\n<p>Best Regards,<br \/>Your VegKing Team<\/p>","email_content_de":"<p><span class=\"im\">You have received this email because the new sale was created.&nbsp;<br \/>For more information please check the link below:<br \/>Order: [order_url]<br \/><\/span>Buyer: [username]<br \/>Seller: [seller_id]<span class=\"im\"><br \/>Product: [product_id]<br \/>You can directly contact clients for update information for this sale.&nbsp;<\/span><\/p>\r\n<p>Best Regards,<br \/>Your VegKing Team<\/p>","email_content_pl":"<p><span class=\"im\">You have received this email because the new sale was created.&nbsp;<br \/>For more information please check the link below:<br \/>Order: [order_url]<br \/><\/span>Buyer: [username]<br \/>Seller: [seller_id]<span class=\"im\"><br \/>Product: [product_id]<br \/>You can directly contact clients for update information for this sale.&nbsp;<\/span><\/p>\r\n<p>Best Regards,<br \/>Your VegKing Team<\/p>","sms_content":"\r\nPlease check new sale has been generated.\r\nOrder: [order_url]\r\nRegards,\r\nYour VegKing Team","sms_content_de":"\r\nPlease check new sale has been generated.\r\nOrder: [order_url]\r\nRegards,\r\nYour VegKing Team","sms_content_pl":"\r\nPlease check new sale has been generated.\r\nOrder: [order_url]\r\nRegards,\r\nYour VegKing Team","push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"trans":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"usermanager":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"}}',
        
        'shortcodes' => '[username], [order_url], [order_cofirm_url], [order_edit_url], [order_id], [buyer_id], [seller_id], [product_id]'
    ]);

    App\EmailTemplate::updateOrCreate(['title'=>'PRICE LIST'],[
      'title' => 'PRICE LIST',
      'subject' => 'Price List',
      'email_content' => '',
      'email_content_de' => '',
      'email_content_pl' => '',
      'buyer_subject' => 'Price List',
      'buyer_email_content' => '<p><span style="font-weight: 400;">Product Name: [product_name]<br /></span><span style="font-weight: 400;">Stock Price: [stock_price]</span></p>',
      'buyer_email_content_de' => '<p><span style="font-weight: 400;">Produktname: [product_name]<br /></span><span style="font-weight: 400;">Standard Preis: [stock_price]</span></p>',
      'buyer_email_content_pl' => '<p><span style="font-weight: 400;">Nazwa produktu: [product_name]<br /></span><span style="font-weight: 400;">Cena akcji: [stock_price]</span></p>',
      'recipients' => '0,1002,0,1,0,0,0,5,0,0',
      'shortcodes' => '[seller_name], [product_name], [stock_price]',
      'roles_content' => '{"administrator":{"subject":"Price List","email_content":"<p><span style=\"font-weight: 400;\">Seller Username: [seller_name]<br \/><\/span><span style=\"font-weight: 400;\">Product Name: [product_name]<br \/><\/span><span style=\"font-weight: 400;\">Stock Price: [stock_price]<\/span><\/p>","email_content_de":"<p><span style=\"font-weight: 400;\">Benutzername des Verk&auml;ufers: [seller_name]<br \/><\/span><span style=\"font-weight: 400;\">Produktname: [product_name]<br \/><\/span><span style=\"font-weight: 400;\">Standard Preis: [stock_price]<\/span><\/p>","email_content_pl":"<p><span style=\"font-weight: 400;\">Nazwa u\u017cytkownika sprzedawcy: [seller_name]<br \/><\/span><span style=\"font-weight: 400;\">Nazwa produktu: [product_name]<br \/><\/span><span style=\"font-weight: 400;\">Cena akcji: [stock_price]<\/span><\/p>","sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"executive":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"seller":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"buyer":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"trader":{"subject":"Price List","email_content":"<p><span style=\"font-weight: 400;\">Seller Username: [seller_name]<br \/><\/span><span style=\"font-weight: 400;\">Product Name: [product_name]<br \/><\/span><span style=\"font-weight: 400;\">Stock Price: [stock_price]<\/span><\/p>","email_content_de":"<p><span style=\"font-weight: 400;\">Benutzername des Verk&auml;ufers: [seller_name]<br \/><\/span><span style=\"font-weight: 400;\">Produktname: [product_name]<br \/><\/span><span style=\"font-weight: 400;\">Standard Preis: [stock_price]<\/span><\/p>","email_content_pl":"<p><span style=\"font-weight: 400;\">Nazwa u\u017cytkownika sprzedawcy: [seller_name]<br \/><\/span><span style=\"font-weight: 400;\">Nazwa produktu: [product_name]<br \/><\/span><span style=\"font-weight: 400;\">Cena akcji: [stock_price]<\/span><\/p>","sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"trans":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"},"usermanager":{"subject":null,"email_content":null,"email_content_de":null,"email_content_pl":null,"sms_content":null,"sms_content_de":null,"sms_content_pl":null,"push_notification_content_en":null,"push_notification_content_de":null,"push_notification_content_pl":null,"status":"1"}}'

    ]);
    }
}
