<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Phone extends Model
{
    use LogsActivity;

    protected $fillable = ['phoneNumber'];
    protected static $logName = 'phone';
    protected static $logAttributes = ['phoneNumber'];

    public function getDescriptionForEvent(string $eventName): string
    {

        if ($eventName == 'created') {
            return "Telefone adicionado ao cliente";
        }
        if ($eventName == 'updated') {
            return "Telefone do cliente foi atualizado";
        }
        if ($eventName == 'deleted') {
            return "Telefone do cliente foi removido";
        }
    }
    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }
    public static function boot()
    {
        parent::boot();

        static::deleting(function (Phone $phone) {
            $phone->clients()->detach();
        });
    }
}
