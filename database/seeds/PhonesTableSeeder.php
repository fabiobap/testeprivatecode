<?php

use App\Client;
use App\Phone;
use Illuminate\Database\Seeder;

class PhonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = Client::all();

        if ($clients->count() === 0) {
            $this->command->info('Nenhum cliente encontrado');
            return;
        }

        $phoneCount = (int) $this->command->ask('Quantos telefones por clientes?', 3);

        $clients->each(function ($client) use ($phoneCount) {
            $client->phones()->saveMany(factory(Phone::class, $phoneCount)->make());
        });
    }
}
