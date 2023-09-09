<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
class BrandCategory extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    public static $filePath = 'images/';
    public static $snakeAttributes = false;
    
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) =>  (!blank($value))  ? config('constant.storage_path').self::$filePath.$value : config('constant.default_image').$value,
        );
    }
    
    public function brands(){
      return $this->belongsToMany(Brand::class, 'brand_category_pivoids', 'brand_category_id', 'brand_id');
    }
}
