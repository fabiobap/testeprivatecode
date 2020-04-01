<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->ask('Fazer um refresh na database', 'yes')) {
            $this->command->call('migrate:refresh');
        }
        $this->call(UsersTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(PhonesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
    }
}
