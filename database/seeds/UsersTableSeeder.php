<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersCount = max((int) $this->command->ask('Quantos usuarios serão criados?', 20), 1);

        //admin
        factory(User::class)->states('john-doe-admin')->create();
        factory(User::class)->states('john-doe-user')->create();

        factory(User::class, $usersCount)->create();
    }
}
