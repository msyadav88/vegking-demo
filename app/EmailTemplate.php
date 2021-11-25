<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $fillable = [ 'title', 'subject', 'email_content', 'email_content_de', 'email_content_pl', 'sms_content', 'sms_content_de', 'sms_content_pl', 'whatsapp_content', 'recipients', 'roles_content', 'sent', 'status','push_content_en','push_content_de','push_content_pl', 'buyer_subject', 'buyer_email_content', 'buyer_email_content_de', 'buyer_email_content_pl', 'buyer_sms_content', 'buyer_sms_content_de', 'buyer_sms_content_pl', 'buyer_status','buyer_push_content','buyer_push_content_de','buyer_push_content_pl', 'trader_subject', 'trader_email_content', 'trader_email_content_de', 'trader_email_content_pl', 'trader_sms_content', 'trader_sms_content_de', 'trader_sms_content_pl', 'trader_status','trader_push_content','trader_push_content_de','trader_push_content_pl','header_en','header_de','header_pl','footer_en','footer_de','footer_pl','global_header'];
}
