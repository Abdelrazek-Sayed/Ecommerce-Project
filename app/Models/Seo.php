<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;
    protected $fillable = ['meta_title', 'meta_auther', 'meta_tag', 'meta_description', 'google_analytics', 'bing_analytics'];
}
