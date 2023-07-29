<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens,
  HasFactory,
  Notifiable;
  protected $appends = ['status_with_name'];
  /**
  * The attributes that are mass assignable.
  *
  * @var array<int, string>
  */
  protected function getStatusWithNameAttribute() {
  
    $status = 'Pending';
    switch ($this->status) {
      case 1:
        $status = 'Approved';
        break;
      default:
        $status = 'Pending';
      }
      return $this->status_with_name = $status;
      
    }

    protected $guarded = [];

    public static $admin = 1;
    public static $pending = 0;
    public static $approved = 1;
    
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
  }