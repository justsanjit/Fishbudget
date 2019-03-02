<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return factory(User::class)->create([
            'email' => 'iamsanjit@hotmail.com'
        ]);
    }
}
