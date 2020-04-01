<?php

use App\Client;
use App\User;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        if ($users->count() === 0) {
            $this->command->info('Nenhum usuario encontrado');
            return;
        }

        $clientCount = (int) $this->command->ask('Quantos clientes por usuario?', 10);

        $users->each(function ($user) use ($clientCount) {
            $user->clients()->saveMany(factory(Client::class, $clientCount)->make());
        });
    }
}
