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
                'deleted_at' => null
            ],
        );
        Wallet::create(
            [
                'name' => "Banco Falabella",
                'deleted_at' => null
            ],
        );
    }
}
