<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $guarded = [];
    public static $snakeAttributes = false;
    public function user(){
      return $this->hasOne(User::class,'id','user_id');
    }
    
    public function carType(){
      return $this->hasOne(CarType::class,'id','carTypeId');
    }
    
    public function carSubType(){
      return $this->hasOne(CarType::class,'id','carSubTypeId');
    }
    
    public function engineType(){
      return $this->hasOne(EngineType::class,'id','engineTypeId');
    }
    
    
}
