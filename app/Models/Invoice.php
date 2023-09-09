<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    protected $casts = [
    'invoice_date' => 'date:Y-m-d',
    ];

    public function fields(){
      return $this->hasMany(InvoiceField::class,'invoice_id','id')->where('type','Invoice');
    }
}
