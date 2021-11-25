<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguageContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('language_content');
        Schema::create('language_content', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('section_1_en')->nullable();
            $table->text('section_1_pl')->nullable();
            $table->text('section_1_de')->nullable();

            $table->text('import_col_1_en')->nullable();
            $table->text('import_col_1_pl')->nullable();
            $table->text('import_col_1_de')->nullable();
            $table->text('import_col_2_en')->nullable();
            $table->text('import_col_2_pl')->nullable();
            $table->text('import_col_2_de')->nullable();
            $table->text('import_col_3_en')->nullable();
            $table->text('import_col_3_pl')->nullable();
            $table->text('import_col_3_de')->nullable();

            $table->text('Export_row_1_en')->nullable();
            $table->text('Export_row_1_pl')->nullable();
            $table->text('Export_row_1_de')->nullable();
            $table->text('Export_row_2_en')->nullable();
            $table->text('Export_row_2_pl')->nullable();
            $table->text('Export_row_2_de')->nullable();
            $table->text('Export_row_3_en')->nullable();
            $table->text('Export_row_3_pl')->nullable();
            $table->text('Export_row_3_de')->nullable();

            $table->text('import_en')->nullable();
            $table->text('import_pl')->nullable();
            $table->text('import_de')->nullable();

            $table->text('export_en')->nullable();
            $table->text('export_pl')->nullable();
            $table->text('export_de')->nullable();

            $table->text('heading_col_1_en')->nullable();
            $table->text('heading_col_1_pl')->nullable();
            $table->text('heading_col_1_de')->nullable();

            $table->text('heading_col_2_en')->nullable();
            $table->text('heading_col_2_pl')->nullable();
            $table->text('heading_col_2_de')->nullable();

            $table->text('heading_col_3_en')->nullable();
            $table->text('heading_col_3_pl')->nullable();
            $table->text('heading_col_3_de')->nullable();

            $table->text('heading_row_1_en')->nullable();
            $table->text('heading_row_1_pl')->nullable();
            $table->text('heading_row_1_de')->nullable();

            $table->text('heading_row_2_en')->nullable();
            $table->text('heading_row_2_pl')->nullable();
            $table->text('heading_row_2_de')->nullable();

            $table->text('heading_row_3_en')->nullable();
            $table->text('heading_row_3_pl')->nullable();
            $table->text('heading_row_3_de')->nullable();

            $table->text('about_us_en')->nullable();
            $table->text('about_us_pl')->nullable();
            $table->text('about_us_de')->nullable();

            $table->text('offer_en')->nullable();
            $table->text('offer_pl')->nullable();
            $table->text('offer_de')->nullable();

            $table->text('contact_en')->nullable();
            $table->text('contact_pl')->nullable();
            $table->text('contact_de')->nullable();

            $table->text('heading_en')->nullable();
            $table->text('heading_pl')->nullable();
            $table->text('heading_de')->nullable();

            $table->text('content_en')->nullable();
            $table->text('content_pl')->nullable();
            $table->text('content_de')->nullable();

            $table->text('agreebutton_en')->nullable();
            $table->text('agreebutton_pl')->nullable();
            $table->text('agreebutton_de')->nullable();

            $table->text('read_more_en')->nullable();
            $table->text('read_more_pl')->nullable();
            $table->text('read_more_de')->nullable();

            $table->text('read_more_content_en')->nullable();
            $table->text('read_more_content_pl')->nullable();
            $table->text('read_more_content_de')->nullable();

            $table->text('newsletter_en')->nullable();
            $table->text('newsletter_content_en')->nullable();
            $table->text('newsletter_email_en')->nullable();
            $table->text('poffers_en')->nullable();
            $table->text('beets_en')->nullable();
            $table->text('beets_content_en')->nullable();
            $table->text('see_offer_en')->nullable();

            $table->text('newsletter_pl')->nullable();
            $table->text('newsletter_content_pl')->nullable();
            $table->text('newsletter_email_pl')->nullable();
            $table->text('poffers_pl')->nullable();
            $table->text('beets_pl')->nullable();
            $table->text('beets_content_pl')->nullable();
            $table->text('see_offer_pl')->nullable();
          
            $table->text('newsletter_de')->nullable();
            $table->text('newsletter_content_de')->nullable();
            $table->text('newsletter_email_de')->nullable();
            $table->text('poffers_de')->nullable();
            $table->text('beets_de')->nullable();
            $table->text('beets_content_de')->nullable();
            $table->text('see_offer_de')->nullable();
            
            $table->text('sale_tittle_en')->nullable();
            $table->text('sale_email_en')->nullable();
           
            $table->text('sale_tittle_pl')->nullable();
            $table->text('sale_email_pl')->nullable();

            $table->text('sale_tittle_de')->nullable();
            $table->text('sale_email_de')->nullable();
           
            $table->text('contact_heading_en')->nullable();
            $table->text('contact_heading_pl')->nullable();
            $table->text('contact_heading_de')->nullable();

            $table->text('contact_content_en')->nullable();
            $table->text('contact_content_pl')->nullable();
            $table->text('contact_content_de')->nullable();

            $table->text('about_property_en')->nullable();
            $table->text('about_us_footer_en')->nullable();
            $table->text('privacy_policy_en')->nullable();
            $table->text('contact_info_en')->nullable();
            $table->text('terms_en')->nullable();
            $table->text('contact_footer_en')->nullable();
            $table->text('copyright_en')->nullable();
            $table->text('copyright_content_en')->nullable();
            $table->text('fulladdress_en')->nullable();
          
            $table->text('about_property_pl')->nullable();
            $table->text('about_us_footer_pl')->nullable();
            $table->text('privacy_policy_pl')->nullable();
            $table->text('contact_info_pl')->nullable();
            $table->text('terms_pl')->nullable();
            $table->text('contact_footer_pl')->nullable();
            $table->text('copyright_pl')->nullable();
            $table->text('copyright_content_pl')->nullable();
            $table->text('fulladdress_pl')->nullable();

            $table->text('about_property_de')->nullable();
            $table->text('about_us_footer_de')->nullable();
            $table->text('privacy_policy_de')->nullable();
            $table->text('contact_info_de')->nullable();
            $table->text('terms_de')->nullable();
            $table->text('contact_footer_de')->nullable();
            $table->text('copyright_de')->nullable();
            $table->text('copyright_content_de')->nullable();
            $table->text('fulladdress_de')->nullable();

            $table->text('site_name_en')->nullable();
            $table->text('site_name_pl')->nullable();
            $table->text('site_name_de')->nullable();

            $table->text('footer_about_en')->nullable();
            $table->text('footer_about_pl')->nullable();
            $table->text('footer_about_de')->nullable();

            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('language_content');
    }
}
   