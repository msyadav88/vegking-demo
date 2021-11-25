<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class LanguageContent extends Model{
    protected $fillable = ['about_us_en','about_us_pl','about_us_de','offer_en','offer_pl','offer_de','contact_en','contact_pl','contact_de','heading_en','heading_pl','heading_de','content_en','content_pl','content_de','agreebutton_en','agreebutton_pl','agreebutton_de','section_1_en','section_1_pl','section_1_de','read_more_en','read_more_pl','read_more_de','read_more_content_en','read_more_content_pl','read_more_content_de','import_en','import_pl','import_de','heading_col_1_en','heading_col_1_pl','heading_col_1_de','heading_col_2_en','heading_col_2_pl','heading_col_2_de','heading_col_3_en','heading_col_3_pl','heading_col_3_de','heading_row_1_en','heading_row_1_pl','heading_row_1_de','heading_row_2_en','heading_row_2_pl','heading_row_2_de','heading_row_3_en','heading_row_3_pl','heading_row_3_de','export_en','export_pl','export_de','import_col_1_en','import_col_1_pl','import_col_1_de','import_col_2_en','import_col_2_pl','import_col_2_de','import_col_3_en','import_col_3_pl','import_col_3_de','Export_row_1_en','Export_row_1_pl','Export_row_1_de','Export_row_2_en','Export_row_2_pl','Export_row_2_de','Export_row_3_en','Export_row_3_pl','Export_row_3_de','newsletter_en','newsletter_pl','newsletter_de','newsletter_content_en','newsletter_content_pl','newsletter_content_de','newsletter_email_en','newsletter_email_pl','newsletter_email_de','poffers_en','poffers_pl','poffers_de','beets_en','beets_pl','beets_de','beets_content_en','beets_content_pl','beets_content_de','see_offer_en','see_offer_pl','see_offer_de','sale_tittle_en','sale_tittle_pl','sale_tittle_de','sale_email_en','sale_email_pl','sale_email_de','contact_heading_en','contact_heading_pl','contact_heading_de','contact_content_en','contact_content_pl','contact_content_de','about_property_en','about_property_pl','about_property_de','about_us_footer_en','about_us_footer_pl','about_us_footer_de','privacy_policy_en','privacy_policy_pl','privacy_policy_de','contact_info_en','contact_info_pl','contact_info_de','terms_en','terms_pl','terms_de','contact_footer_en','contact_footer_pl','contact_footer_de','copyright_en','copyright_pl','copyright_de','copyright_content_en','copyright_content_pl','copyright_content_de','fulladdress_en','fulladdress_pl','fulladdress_de','site_name_en','site_name_pl','site_name_de','footer_about_en','footer_about_pl','footer_about_de'];

    protected $table = 'language_content';
}
