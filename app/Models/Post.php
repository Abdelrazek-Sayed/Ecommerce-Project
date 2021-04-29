<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title_en','title_ar','image','details_en','details_ar','category_id'];

    public function blogcat()
    {
        return $this->belongsTo(PostCategory::class,'id','category_id');
    }
}
