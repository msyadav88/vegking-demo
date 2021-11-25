<?php

use Illuminate\Database\Seeder;

class LanguageContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\LanguageContent::Create([
            'section_1_en' => '<p>Veg King Europe Sp. z o.o. is a leading distributor of vegetables and fruits, operating on international markets, based on knowledge and experience - it provides a full range of high-quality products per 365 days a year.</p>
			<p>For over 10 years we have been cooperating with recognized fruit and vegetable producers, thus guaranteeing the highest level of order fulfillment.</p>
			<p>Competitive experience in global risk and supply chain management Veg King Europe Sp. z o.o. - allows you to meet market expectations and create a package of beneficial products and services, which allows you to constantly increase the scale of quality and sales volume.</p>',
            
            'section_1_pl' =>'<p>Jesteśmy wiodącym dystrybutorem warzyw i owoców. Działamy na międzynarodowych rynkach, w oparciu o wiedzę oraz doświadczenie – dostarczamy pełną gamę wysokiej jakości produktów.</p>
			<p>Od ponad 10 lat współpracujemy z uznanymi na rynku producentami warzyw i owoców, gwarantując tym samym realizację zamówień na najwyższym poziomie.</p>
			<p>Konkurencyjne doświadczenie w  globalnym zarządzaniu ryzykiem i łańcuchem dostaw Veg King Europe Sp. z o.o. - pozwala spełniać oczekiwania rynku.Tworzymy pakiet korzystnych produktów oraz usług, co pozwala na stałe podnoszenie skali jakości jak również - wolumenu sprzedaży.</p>',
            
            'section_1_de' => '<p>Wir sind ein führender Händler von Obst und Gemüse. Wir wirken auf dem internationalen Markt, wo wir unser Wissen und unsere Erfahrung einsetzen – wir liefern eine ganze Palette hochqualitativer Produkte.</p>
			<p>Seit über 10 Jahren arbeiten wir mit auf dem Markt anerkannten Obst- und Gemüseerzeugern zusammen. Damit gewährleisten wir die Ausführung der Aufträge auf hohem Niveau.</p>
			<p>Langjährige Erfahrung im globalen Risikomanagement sowie in Management der Versorgungskette von Veg King Europe GmbH (Sp. z o.o ) lässt uns die Markterwartungen erfüllen. Wir bilden ein Paket vorteilhafter Produkte und Dienstleistungen, das uns erlaubt, die Qualitätsskala sowie das Verkaufsvolumen stets zu erhöhen. </p>' ,
            
            'import_en'=> 'Import',
            'import_pl'=> 'Import',
            'import_de'=> 'Einführen',

            'export_en' => 'Export',
            'export_pl' => 'Eksport',
            'export_de' => 'Export',

            'heading_col_1_en' => '<strong>The best</strong>prices',
            'heading_col_1_pl' => '<strong>Najlepsze</strong>ceny',
            'heading_col_1_de' => '<strong>Die besten</strong> Preise',

            'heading_col_2_en' => '<strong>Qualified</strong>suppliers',
            'heading_col_2_pl' => '<strong>Dostawcy</strong>',
            'heading_col_2_de' => '<strong>Lieferanten</strong>',

            'heading_col_3_en' => '<strong>Full range</strong>of products',
            'heading_col_3_pl' => '<strong>Asortyment</strong>produktów',
            'heading_col_3_de' => '<strong>Produktpalette</strong>',

            'heading_row_1_en' => '<strong>Safe</strong>shipping',
            'heading_row_1_pl' => '<strong>Bezpieczna</strong>dostawa',
            'heading_row_1_de' => '<strong>Sichere </strong>Lieferung',

            'heading_row_2_en' => '<strong>Fast</strong> delivery',
            'heading_row_2_pl' => '<strong>Szybka</strong> dostawa',
            'heading_row_2_de' => '<strong>Schnelle</strong> Lieferung',

            'heading_row_3_en' => '<strong>Worldwide</strong>range',
            'heading_row_3_pl' => '<strong>Światowy</strong>zasięg',
            'heading_row_3_de' => '<strong>Globale</strong>Reichweite',

            'import_col_1_en' => 'We monitor international market to make sure our prices are always competitive. We buy goods at the best prices. It is our goal and advantage.',
            'import_col_2_en' => 'We strongly believe in the power of worldwide known brands and the best quality of the products we trade. We select carefully the sources of our purchase and delivery.',
            'import_col_3_en' => 'We answer to growing market demand for the full range of products. Always looking for novelty and constantly provide vegetables and fruits best sellers.',
            'Export_row_1_en' => 'We care about exported goods. They are shipped quickly and safely all over the world. You always know where your money is and decide about your order conditions.',
            'Export_row_2_en' => 'We understand the needs of our Clients and remember that time is money. Simplified processes, professional Team and prompt actions support delivery standards',
            'Export_row_3_en' => 'We cooperate with our Clients on a global scale. Our experience and knowledge allows us to serve you in comprehensive, effective and professional way all over the world.',

            'import_col_1_pl' => 'Naszą przewagą jest konkurencyjna cena. Monitorujemy międzynarodowy rynek, by zawsze oferować najwyższą jakość w niepowtarzalnej cenie.',
            'import_col_2_pl' => 'Wierzymy w siłę rodzimych producentów oraz najwyższą jakość oferowanych przez nich produktów, którymi handlujemy. Zawsze wybieramy rzetelne źródła naszych zakupów oraz dostaw.',
            'import_col_3_pl' => 'Rosnące zapotrzebowanie na szeroki asortyment produktów to powody, dla których stale się rozwijamy. Szukamy nowości, oferując przy tym najpopularniejsze produkty w kategorii warzyw i owoców.',
            'Export_row_1_pl' => 'Najważniejsze jest dla nas bezpieczeństwo oraz terminowość dostawy. Współpracując z nami masz pewność, że transport produktów odbywa się szybko i bezpiecznie.',
            'Export_row_2_pl' => 'Dla nas ważny jest Twój czas. Nasze standardy dostawy, zespół profesjonalistów oraz szybka reakcja zawsze skutkują zadowoleniem naszych Klientów.',
            'Export_row_3_pl' => 'Świadczymy usługi na arenie międzynarodowej. Nasze doświadczenie oraz wiedza,pozwalają w sposób efektywny oraz zamierzony realizować najbardziej wymagające zlecenia.',
            
            'import_col_1_de' => 'Unser Vorteil sind die wettbewerbsfähigen Preise. Wir behalten den internationalen Markt im Auge, um immer die höchste Qualität zum erschwinglichen Preis anbieten zu können.',
            'import_col_2_de' => 'Wir glauben an die Kraft der einheimischen Erzeuger und die höchste Qualität ihrer angebotenen Produkte, mit den wir handeln. Wir wählen stets zuverlässige Quellen unserer Käufe und Lieferungen.',
            'import_col_3_de' => 'Der wachsende Bedarf an breiter Produktpalette ist der Grund dafür, dass wir uns stets weiterentwickeln. Wir suchen nach Neuheiten und dabei bieten wir die meistbeliebten Produkte in der Kategorie: Obst und Gemüse.',
            'Export_row_1_de' => 'Am wichtigsten sind für uns die Sicherheit und eine fristgerechte Lieferung. Bei der Zusammenarbeit mit uns können Sie sich darauf verlassen, dass der Transport schnell und sicher ist.',
            'Export_row_2_de' => 'Ihre Zeit ist uns wichtig. Unsere Lieferungsstandards, professionelles Team und rasche Reaktion sind Folgen der Zufriedenheit unserer Kunden.',
            'Export_row_3_de' => 'Wir sind auf internationaler Ebene tätig. Unsere Erfahrung und unser Wissen lassen uns effektiv und absichtlich sogar sehr anspruchsvolle Aufträge realisieren.',

            'about_us_en' => 'ABOUT US',
            'about_us_pl' =>'O nas',
            'about_us_de' =>'ÜBER UNS',

            'offer_en' => 'Offer',
            'offer_pl' => 'Oferta',
            'offer_de' => 'Unser Angebot',

            'contact_en' => 'CONTACT',
            'contact_pl' => 'Kontakt',
            'contact_de' => 'KONTAKT',

            'heading_en' => 'THIS WEBSITE USES COOKIES',
            'heading_pl' => 'COOKIES NA STRONIE GŁÓWNEJ',
            'heading_de' => 'DIESE WEBSITE VERWENDET COOKIES',

            'content_en' => '<span id="cookie_pre_text" class="pre">We use cookies to personalise content and ads, to provide social media features and to analyse our traffic.</span> <span id="more_cookies" style="display:none">We also share information about your use of our site with our social media, advertising and analytics partners who may combine it with other information that you’ve provided to them or that they’ve collected from your use of their services. You consent to our cookies if you continue to use our website.</span> <span id="more_cookies_btn">[Read More]</span>',
            'content_pl' => '<span id="cookie_pre_text" class="pre">Nasze Witryny i Aplikacje korzystają z plików cookie w celu dostarczania treści i funkcjonalności, którymi są zainteresowani użytkownicy.</span> <span id="more_cookies" style="display:none">Ponadto używamy plików cookie w celach analitycznych i reklamowych; możesz to zmienić w każdej chwili w ustawieniach swojej przeglądarki internetowej. Więcej informacji w POLITYCE PRYWATNOŚCI i POLITYCE COOKIES.</span> <span id="more_cookies_btn">[Read More]</span>',
            'content_de' => '<span id="cookie_pre_text" class="pre">Wir verwenden Cookies, um Inhalte und Anzeigen zu personalisieren, Funktionen für soziale Medien bereitzustellen und unseren Datenverkehr zu analysieren.</span> <span id="more_cookies" style="display:none">Wir teilen auch Informationen über Ihre Nutzung unserer Website mit unseren Partnern für soziale Medien, Werbung und Analyse, die diese möglicherweise mit anderen Informationen kombinieren, die Sie ihnen zur Verfügung gestellt haben oder die sie aus Ihrer Nutzung ihrer Dienste gesammelt haben. Sie stimmen unseren Cookies zu, wenn Sie unsere Website weiterhin nutzen.</span> <span id="more_cookies_btn">[Weiterlesen]</span>',

            'agreebutton_en' => 'I agree',
            'agreebutton_pl' => 'Zgadzam się',
            'agreebutton_de' => 'Genau',

            'read_more_en' => 'Read more',
            'read_more_pl' => 'Czytaj więcej',
            'read_more_de' => 'Mehr anzeigen',

            'read_more_content_en' => '<p>By buying our products you can be sure that you are buying the highest quality products.</p>
			<p>The main area of our activity is the effective distribution of fresh fruit and vegetables, taking into account both the needs and the satisfaction of our suppliers and customers.</p>
			<p>Our mission and ambition is continuous development and maintaining a strong market position. The highest quality, product safety and timely delivery - these are our priorities.</p>
			<p>We owe our success to experience, professional service and always competitive commercial offer.</p>
			<p>We believe that cooperation work and product quality are the path to success, collaborated success.</p>
			<p>We invite you to cooperation.</p>',
            'read_more_content_pl' => '<p>Kupując nasze produkty masz pewność, że kupujesz produkty najwyższej jakości.</p>
			<p>Głównym obszarem naszej działalności jest efektywna dystrybucja świeżych owoców i warzyw, uwzględniając zarówno potrzeby jak i zadowolenie naszych dostawców oraz klientów.</p>
			<p>Naszą misją i ambicją jest ciągły rozwój oraz utrzymanie silnej pozycji na rynku. Najwyższa jakość,  bezpieczeństwo produktów oraz terminowa dostawa – to nasze priorytety.</p>
			<p>Sukces zawdzięczamy doświadczeniu, profesjonalnej obsłudze, terminowej dostawie oraz zawsze konkurencyjnej ofercie handlowej.</p>
			<p>Wierzymy, że wspólna praca oraz jakość produktów jest drogą do sukcesu, wspólnego sukcesu.</p>
			<p>Zapraszamy do współpracy.</p>',
            'read_more_content_de' => '<p>Durch Kauf unserer Produkte haben Sie die Sicherheit, hochqualitative Produkte zu erhalten. Der Hauptbereich unserer Firma ist ein effektiver Vertrieb von frischem Obst und Gemüse, mit Berücksichtigung sowohl der Bedürfnisse als auch der Zufriedenheit unserer Lieferanten sowie Kunden.</p>
			<p>Stetige Weiterentwicklung und der Erhalt starker Position auf dem Markt sind unsere Mission und Ambition. Höchstqualität, Sicherheit von Produkten und fristgerechte Lieferung gehören zu unseren Prioritäten.</p>
			<p>Unseren Erfolg verdanken wir unserer Erfahrung, Professionalität, Zuverlässigkeit sowie dem immer konkurrierenden Angebot.</p>
			<p>Wir sind uns sicher, dass gemeinsame Arbeit und Qualität der Produkte ein Weg zum Erfolg ist nämlich zum gemeinsamen Erfolg.</p>
            <p>Wir freuen uns auf die Zusammenarbeit mit Ihnen.</p>',
            
            'newsletter_en' => 'NEWSLETTER',
            'newsletter_content_en' => 'Subscribe to our newsletter and stay up to date',
            'newsletter_email_en' => 'Email',
            'poffers_en' => 'New product in our offer',
            'beets_en' => 'POTATOES',
            'beets_content_en' => 'Beets available in our offer are grown in soils rich in calcium.',
            'see_offer_en' => 'SEE OFFER',

            'newsletter_pl' => 'NEWSLETTER',
            'newsletter_content_pl' => 'Zapisz się do naszego newslettera i bądź na bieżąco z najnowszymi ofertami.',
            'newsletter_email_pl' => 'Email',
            'poffers_pl' => 'NOWY PRODUKT W NASZEJ OFERCIE',
            'beets_pl' => 'ZIEMNIAKI',
            'beets_content_pl' => 'Buraki dostępne w naszej ofercie są uprawiane na glebach bogatych w wapń.',
            'see_offer_pl' => 'Zobacz oferty',

            'newsletter_de' => 'Newsletter',
            'newsletter_content_de' => 'Melden Sie sich an, dann sind Sie auf dem Laufenden mit unseren Angeboten',
            'newsletter_email_de' => 'Email',
            'poffers_de' => 'Ein neues Produkt in unserem Angebot',
            'beets_de' => 'Kartoffeln',
            'beets_content_de' => 'Die in unserem Angebot angebotenen Rüben werden auf kalziumreichen Böden angebaut.',
            'see_offer_de' => 'Siehe Angebote',

            'sale_tittle_en' => 'Sales Department',
            'sale_email_en' => 'Sales Email',

            'sale_tittle_pl' => 'Dział Sprzedaży',
            'sale_email_pl' => 'Sprzedaż email',

            'sale_tittle_de' => 'Verkaufsabteilung',
            'sale_email_de' => 'Verkauf-E-Mail',

            'contact_heading_en' => 'CONTACT US',
            'contact_heading_pl' => 'SKONTAKTUJ SIĘ Z NAMI',
            'contact_heading_de' => 'Kontaktieren Sie uns',

            'contact_content_en' => 'Veg King Europe Sp. z o.o. with its registered office in Warsaw (00-844) ul. Grzybowska 80/82, NIP 527-286-9217, REGON 381654284, entered into the Register of Entrepreneurs of the National Court Register, District Court for the Capital City of Warsaw Warsaw in Warsaw, XII Commercial Department number 0000754846.',
            'contact_content_pl' => 'Veg King Europe Sp. z o.o. z siedzibą w Warszawie (00-844) ul. Grzybowska 80/82, NIP 527-286-9217, REGON 381654284, wpisana do rejestru przedsiębiorców Krajowego Rejestru Sądowego,  Sąd Rejonowy dla m.st. Warszawy w Warszawie, XII Wydział Gospodarczy o numerze 0000754846.',
            'contact_content_de' => 'Veg King Europe Sp.z.o.o mit Sitz in Warschau (00-844). Grzybowska 80/82 Straße, NIP-Nummer 5272869217, REGON-Nummer 381654284, wurde in den Unternehmensregister des polnischen Gerichtsregisters eingetragen, Amtsgericht der Hauptstadt Warschau in Warschau, XII Wirtschaftsabteilung Nummer 0000754846',

            'about_property_en' => 'About Property',
            'about_us_footer_en' => 'About Us',
            'privacy_policy_en' => 'Privacy Policy',
            'contact_info_en' => 'Contact Info',
            'terms_en' => 'Terms of service',
            'contact_footer_en' => 'Contact',
            'copyright_en'=>'Copyright',
            'copyright_content_en'=>'All rights Reserved',
            'fulladdress_en'=>'HUB in Poland<br>Veg King Europe Sp. z o.o.<br>ul. Grzybowska 80/82<br>00-844 Warszawa',

            'about_property_pl' => 'O Firmie',
            'about_us_footer_pl' => 'O Nas',
            'privacy_policy_pl' => 'Polityka Prywatności',
            'contact_info_pl' => 'Informacje kontaktowe',
            'terms_pl' => 'Regulamin serwisu',
            'contact_footer_pl' => 'Kontakt',
            'copyright_pl'=>'Prawo autorskie',
            'copyright_content_pl'=>'Wszelkie prawa zastrzeżone',
            'fulladdress_pl'=>'HUB in Poland<br>Veg King Europe Sp. z o.o.<br>ul. Grzybowska 80/82<br>00-844 Warszawa',

            'about_property_de' => 'Über Eigentum',
            'about_us_footer_de' => 'Über uns',
            'privacy_policy_de' => 'Datenschutzerklärung',
            'contact_info_de' => 'Kontaktinformationen',
            'terms_de' => 'Nutzungsbedingungen',
            'contact_footer_de' => 'Kontakt',
            'copyright_de'=>'Urheberrechte',
            'copyright_content_de'=>'Alle Rechte vorbehalten',
            'fulladdress_de'=>'HUB in Polen<br>Veg King Europe Sp. z o.o.<br>ul. Grzybowska 80/82',

            'site_name_en' => 'VEG KING EUROPE',
            'site_name_pl' => 'VEG KING EUROPE',
            'site_name_de' => 'VEG KING EUROPE',

            'footer_about_en' => 'Professional vegetable distributor in Europe. We help to ensure the development of your company thanks to fast and timely deliveries throughout the year.',
            'footer_about_pl' => 'Profesjonalny dystrybutor warzyw w Europie. Pomagamy zapewnić rozwój Twojego przedsiębiorstwa dzięki szybkim i terminowym dostawom przez cały rok.',
            'footer_about_de' => 'Experte im Vertrieb von Gemüse in Europa. Wir helfen Ihnen bei der Entwicklung Ihres Unternehmens durch schnelle und fristgerechte Lieferungen das ganze Jahr über.',
        ]);
    }
}
