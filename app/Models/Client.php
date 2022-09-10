<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    //Relacion uno a muchos cliente tiene muchas deudas
    public function debts()
    {
        return $this->hasMany(Debt::class);
    }
}
