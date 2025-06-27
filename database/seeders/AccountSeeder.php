<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $accounts = [
            ['name' => 'Mpesa_KES_1', 'currency' => 'KES', 'balance' => 100000],
            ['name' => 'Mpesa_KES_2', 'currency' => 'KES', 'balance' => 80000],
            ['name' => 'Bank_USD_1', 'currency' => 'USD', 'balance' => 5000],
            ['name' => 'Bank_USD_2', 'currency' => 'USD', 'balance' => 7500],
            ['name' => 'Wallet_NGN_1', 'currency' => 'NGN', 'balance' => 1000000],
            ['name' => 'Wallet_NGN_2', 'currency' => 'NGN', 'balance' => 900000],
            ['name' => 'Reserve_KES', 'currency' => 'KES', 'balance' => 200000],
            ['name' => 'Reserve_USD', 'currency' => 'USD', 'balance' => 10000],
            ['name' => 'Reserve_NGN', 'currency' => 'NGN', 'balance' => 2000000],
            ['name' => 'Float_USD', 'currency' => 'USD', 'balance' => 3000],
        ];

        foreach ($accounts as $acc) {
            Account::create($acc);
        }
    }
}
