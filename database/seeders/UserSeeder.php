<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create(
            [
                'name' => "Max Riquelme",
                'email' => "maximo20162016@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('adl9984.maxAdmin#'), // password
                'remember_token' => Str::random(10),
            ],
        );

        User::create(
            [
                'name' => "Richar Diaz",
                'email' => "rdiaz@acobro.cl",
                'email_verified_at' => now(),
                'password' => Hash::make('Fal874.rdiaz#'), // password
                'remember_token' => Str::random(10),
            ],
        );
    }
}
