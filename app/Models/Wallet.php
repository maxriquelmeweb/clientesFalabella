<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    //Relacion uno a muchos cartera tiene muchas deudas
    public function debts()
    {
        return $this->hasMany(Debt::class);
    }
}
