<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Part extends Model
{
    use HasFactory;
    public static $snakeAttributes = false;
    protected $guarded = [];
    public static $filePath = 'images/';
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) =>  (!blank($value))  ? config('constant.storage_path').self::$filePath.$value : config('constant.default_image').$value,
        );
    }
    
    public function brandCategories(){
      return $this->belongsToMany(BrandCategory::class, 'part_brand_catoru_pivods', 'part_id', 'brand_category_id');
    }
    
}
