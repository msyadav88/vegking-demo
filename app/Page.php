<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['pa_name', 'slug', 'desc', 'seo_tag_title', 'seo_tag_description', 'seo_tag_keywords', 'featured_image', 'is_active'];
}
