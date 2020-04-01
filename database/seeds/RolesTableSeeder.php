<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Super Admin']);
        Permission::create(['name' => 'Visualizar Telefones']);
        Permission::create(['name' => 'Editar Telefones']);
        Permission::create(['name' => 'Excluir Telefone']);
        Permission::create(['name' => 'Visualizar Logs' ]);

        $johnAdmin = User::where('email', '=', 'john.admin@laravel.test')->first();
        $johnRegular = User::where('email', '=', 'john.regular@laravel.test')->first();

        $johnAdmin->assignRole('Super Admin');
    }
}
