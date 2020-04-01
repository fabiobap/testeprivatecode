<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, LogsActivity, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected static $logName = 'user';
    protected static $ignoreChangedAttributes = ['email_verified_at', 'remember_token'];

    public function getDescriptionForEvent(string $eventName): string
    {
        if ($eventName == 'created') {
            return "Usuario $this->name foi criado";
        }
        if ($eventName == 'updated') {
            return "Usuario $this->name atualizou campo do seu perfil";
        }
        if ($eventName == 'deleted') {
            return "Usuario $this->name removeu seu proprio usuario";
        }
    }
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

}
