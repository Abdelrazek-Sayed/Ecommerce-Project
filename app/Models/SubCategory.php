<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name','category_id'];
    public function category()
    {
        return $this->belongsTo(category::class);
    }

    // public function products()
    // {
    //     return  $this->hasMany(Product::class, 'subcategory_id', 'id');
    // }
}
