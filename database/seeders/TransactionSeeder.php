<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Generate 30 transactions, for dates within the last year, with amounts between 10 and 1000,
        // based on existing clients
        for ($i = 0; $i < 30; $i++) {
            Transaction::create([
                'client_id' => rand(1, 5),
                'transaction_date' => $faker->dateTimeBetween('-1 year', 'now'),
                'amount' => $faker->randomFloat(2, 10, 1000),
            ]);
        }
    }
}
