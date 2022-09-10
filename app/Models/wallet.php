<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    //Relacion uno a muchos cartera tiene muchas deudas
    public function debts()
    {
        return $this->hasMany(Debt::class);
    }
}
