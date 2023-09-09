<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Brand extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public static $filePath = 'images/';

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) =>  (!blank($value))  ? config('constant.storage_path').self::$filePath.$value : config('constant.default_image').$value,
        );
    }
    
    public function fields(){
      return $this->hasOne(Field::class,'itemId','id')->where('type','Brand');
    }
}
