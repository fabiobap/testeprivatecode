<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Client extends Model
{
    use LogsActivity;

    protected $fillable = ['name', 'email', 'user_id'];
    protected static $logName = 'client';
    protected static $logAttributes = ['name', 'email', 'user.name'];

    public function getDescriptionForEvent(string $eventName): string
    {
        $user = auth()->user() ?? User::find($this->user_id);
        if ($eventName == 'created'){
            return "$user->name criou um cliente";
        }
        if ($eventName == 'updated'){
            return "$user->name atualizou um cliente";
        }
        if ($eventName == 'deleted'){
            return "$user->name removeu um cliente";
        }
    }

    public function phones()
    {
        return $this->belongsToMany(Phone::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function (Client $client) {
            $client->phones()->detach();
            $client->phones()->delete();
        });
    }
}
