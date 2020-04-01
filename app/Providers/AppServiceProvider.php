<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Blade;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        Blade::component('components.errors', 'errors');
        Blade::component('components.success', 'success');
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $user = auth()->user();

            $event->menu->add([
                'text' => 'Dashboard',
                'url' => '/',
                'icon' => 'fas fa-home',

            ]);
            $event->menu->add([
                'header' => 'Cliente'
            ]);

            $event->menu->add([
                'text'        => ' Cliente',
                'icon'        => 'fas fa-user',
                'active' => ['clients', 'content', 'content/*', 'regex:@^content/[0-9]+$@'],
                'submenu' => [
                    [
                        'icon'        => 'fas fa-plus-square',
                        'icon_color'        => 'green',

                        'text' => 'Adicionar Cliente',
                        'url'  => 'clients/create',
                    ],
                    [
                        'text' => 'DataTable',
                        'icon'        => 'fas fa-table',
                        'url'  => 'clients',
                    ]
                ]
            ]);
            $event->menu->add([
                'text' => 'Configurações do Usário',
                'url' => 'user-settings',
                'icon' => 'fas fa-users-cog',

            ]);
            $event->menu->add([
                'text' => 'Log de Atividades',
                'url' => 'log-activity',
                'icon' => 'fas fa-file-contract'
            ]);
            if ($user->hasRole('Super Admin')) {
                $event->menu->add([
                    'text' => 'Gerenciamento de Grupos',
                    'url' => 'roles',
                    'icon' => 'fas fa-users'
                ]);
            }
        });
    }
}
