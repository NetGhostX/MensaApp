<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Benutzer extends Authenticatable
{
    use Notifiable;

    protected $table = 'benutzer';
    public $timestamps = false; // Disable timestamps explicitly

    protected $fillable = [
        'name',
        'email',
        'passwort',
        'admin',
        'anzahlfehler',
        'anzahlanmeldungen',
        'letzteanmeldung',
        'letzterfehler'
    ];

    protected $hidden = [
        'passwort',
    ];

    protected $casts = [
        'admin' => 'boolean',
        'letzteanmeldung' => 'datetime',
        'letzterfehler' => 'datetime'
    ];

    public function getAuthPassword()
    {
        return $this->passwort;
    }
}