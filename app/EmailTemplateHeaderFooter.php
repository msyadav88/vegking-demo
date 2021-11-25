<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplateHeaderFooter extends Model
{
    protected $table = 'template_header';
    protected $fillable = [ 'header_en', 'header_de', 'header_pl', 'footer_en', 'footer_de', 'footer_pl', 'status'];
}
