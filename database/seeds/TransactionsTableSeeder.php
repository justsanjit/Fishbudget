<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Transaction;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::whereEmail('iamsanjit@hotmail.com')->first();

        $attributes = $user ? ['user_id' => $user->id] : [];

        factory(Transaction::class, 5)->create($attributes);

        factory(Transaction::class, 5)->create();
    }
}
