<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    //Relacion uno a muchos inversa varias deudas tiene un cliente
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    //Relacion uno a muchos inversa varias deudas tiene una cartera
    public function wallet()
    {
        return $this->belongsTo('App\Models\Wallet');
    }
}
