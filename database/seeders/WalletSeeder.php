<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Wallet;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Wallet::create(
            [
                'name' => "cmr Falabella",
            ],
        );
        Wallet::create(
            [
                'name' => "Banco Falabella",
            ],
        );
    }
}
