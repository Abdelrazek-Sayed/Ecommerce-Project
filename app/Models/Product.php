<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'quantity',
        'category_id',
        'subcategory_id',
        'brand_id',
        'size',
        'color',
        'price',
        'details',
        'video_link',
        'main_slider',
        'mid_slider',
        'hot_deal',
        'trend',
        'hot_new',
        'best_rated',
        'image_one',
        'image_two',
        'image_three',
        'status',
        'discount',
    ];

    public function category()
    {
        return  $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function brand()
    {
        return  $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function subcat()
    {
        return  $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }

    public function wishList()
    {
        return  $this->hasMany(WishList::class);
    }
}
