<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
  use HasApiTokens,
  HasFactory,
  Notifiable;


  public static $filePath = 'images/';
  
  public static $admin = 1;
  public static $user = 0;
  
  
  protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) =>  (!blank($value))  ? 'https://backend.clickandfixqa.com/'.self::$filePath.$value : config('constant.default_image').$value,
        );
    }
  
  /**
  * The attributes that are mass assignable.
  *
  * @var array<int, string>
  */

    protected $guarded = [];
    /**
    * The attributes that should be hidden for serialization.
    *
    * @var array<int, string>
    */
    protected $hidden = [
      'password',
      'remember_token',
    ];

    /**
    * The attributes that should be cast.
    *
    * @var array<string, string>
    */
    protected $casts = [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];

    public function getJWTIdentifier() {
      return $this->getKey();
    }

    /**
    * Return a key value array, containing any custom claims to be added to the JWT.
    *
    * @return array
    */
    public function getJWTCustomClaims() {
      return [];
    }

  }