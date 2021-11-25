<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LanguageContent;

class LanguageContentController extends Controller{

    public function index(Request $request){
        $LanguageContent = LanguageContent::where('id',1)->first();
        return view('backend.LanguageContent.index',compact('LanguageContent'));
      
    }
    public function update(Request $request, LanguageContent $languagecontent)
    {
        request()->validate([
            'about_us_en'=>'required',
            'about_us_pl'=>'required',
            'about_us_de'=>'required',

            'offer_en'=>'required',
            'offer_pl'=>'required',
            'offer_de'=>'required',

            'contact_en'=>'required',
            'contact_pl'=>'required',
            'contact_de'=>'required',

            'heading_en'=>'required',
            'heading_pl'=>'required',
            'heading_de'=>'required',

            'content_en'=>'required',
            'content_pl'=>'required',
            'content_de'=>'required',

            'agreebutton_en'=>'required',
            'agreebutton_pl'=>'required',
            'agreebutton_de'=>'required',

            'section_1_en'=>'required',
            'section_1_pl'=>'required',
            'section_1_de'=>'required',

            'read_more_en'=>'required',
            'read_more_pl'=>'required',
            'read_more_de'=>'required',

            'read_more_content_en'=>'required',
            'read_more_content_pl'=>'required',
            'read_more_content_de'=>'required',

            'import_en'=>'required',
            'import_pl'=>'required',
            'import_de'=>'required',

            'heading_col_1_en'=>'required',
            'heading_col_1_pl'=>'required',
            'heading_col_1_de'=>'required',

            'heading_col_2_en'=>'required',
            'heading_col_2_pl'=>'required',
            'heading_col_2_de'=>'required',

            'heading_col_3_en'=>'required',
            'heading_col_3_pl'=>'required',
            'heading_col_3_de'=>'required',

            'import_col_1_en'=>'required',
            'import_col_1_pl'=>'required',
            'import_col_1_de'=>'required',

            'import_col_2_en'=>'required',
            'import_col_2_pl'=>'required',
            'import_col_2_de'=>'required',

            'import_col_3_en'=>'required',
            'import_col_3_pl'=>'required',
            'import_col_3_de'=>'required',

            'export_en'=>'required',
            'export_pl'=>'required',
            'export_de'=>'required',

            'heading_row_1_en'=>'required',
            'heading_row_1_pl'=>'required',
            'heading_row_1_de'=>'required',

            'heading_row_2_en'=>'required',
            'heading_row_2_pl'=>'required',
            'heading_row_2_de'=>'required',

            'heading_row_3_en'=>'required',
            'heading_row_3_pl'=>'required',
            'heading_row_3_de'=>'required',

            'heading_row_3_en'=>'required',
            'heading_row_3_pl'=>'required',
            'heading_row_3_de'=>'required',
            
            'Export_row_1_en'=>'required',
            'Export_row_1_pl'=>'required',
            'Export_row_1_de'=>'required',

            'Export_row_2_en'=>'required',
            'Export_row_2_pl'=>'required',
            'Export_row_2_de'=>'required',

            'Export_row_3_en'=>'required',
            'Export_row_3_pl'=>'required',
            'Export_row_3_de'=>'required',

            'newsletter_en'=>'required',
            'newsletter_pl'=>'required',
            'newsletter_de'=>'required',

            'newsletter_content_en'=>'required',
            'newsletter_content_pl'=>'required',
            'newsletter_content_de'=>'required',

            'newsletter_email_en'=>'required',
            'newsletter_email_pl'=>'required',
            'newsletter_email_de'=>'required',

            'poffers_en'=>'required',
            'poffers_pl'=>'required',
            'poffers_de'=>'required',

            'beets_en'=>'required',
            'beets_pl'=>'required',
            'beets_de'=>'required',
            
            'beets_content_en'=>'required',
            'beets_content_pl'=>'required',
            'beets_content_de'=>'required',

            'see_offer_en'=>'required',
            'see_offer_pl'=>'required',
            'see_offer_de'=>'required',

            'sale_tittle_en'=>'required',
            'sale_tittle_pl'=>'required',
            'sale_tittle_de'=>'required',

            'sale_email_en'=>'required',
            'sale_email_pl'=>'required',
            'sale_email_de'=>'required',

            'contact_heading_en'=>'required',
            'contact_heading_pl'=>'required',
            'contact_heading_de'=>'required',
            
            'contact_content_en'=>'required',
            'contact_content_pl'=>'required',
            'contact_content_de'=>'required',

            'about_property_en'=>'required',
            'about_property_pl'=>'required',
            'about_property_de'=>'required',

            'about_us_footer_en'=>'required',
            'about_us_footer_pl'=>'required',
            'about_us_footer_de'=>'required',

            'privacy_policy_en'=>'required',
            'privacy_policy_pl'=>'required',
            'privacy_policy_de'=>'required',

            'contact_info_en'=>'required',
            'contact_info_pl'=>'required',
            'contact_info_de'=>'required',

            'terms_en'=>'required',
            'terms_pl'=>'required',
            'terms_de'=>'required',

            'contact_footer_en'=>'required',
            'contact_footer_pl'=>'required',
            'contact_footer_de'=>'required',

            'copyright_en'=>'required',
            'copyright_pl'=>'required',
            'copyright_de'=>'required',

            'copyright_content_en'=>'required',
            'copyright_content_pl'=>'required',
            'copyright_content_de'=>'required',

            'fulladdress_en'=>'required',
            'fulladdress_pl'=>'required',
            'fulladdress_de'=>'required',

            'site_name_en'=>'required',
            'site_name_pl'=>'required',
            'site_name_de'=>'required',

            'footer_about_en'=>'required',
            'footer_about_pl'=>'required',
            'footer_about_de'=>'required',
           
        ]);
        $languagecontent->update($request->all());
        return response()->json(['status' => 'success', 'message' => 'Language content updated successfully.']);
    }
}
