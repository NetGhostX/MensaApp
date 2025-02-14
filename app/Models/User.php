<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'benutzer';
    protected $primaryKey = 'id';
    public $timestamps = false; // Disable timestamps

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'passwort',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $attributes = [
        'admin' => false,
        'anzahlfehler' => 0,
        'anzahlanmeldungen' => 0
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string>
     */
    protected $dates = [
        'letzteanmeldung',
        'letzterfehler',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed:sha1', // Use our custom SHA1 hasher
        ];
    }

    public function getAuthPassword()
    {
        return $this->passwort; // Match the German column name in benutzer table
    }
}
