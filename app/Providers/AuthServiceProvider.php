<?php

namespace App\Providers;

use App\Services\Sha1Hasher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    // ...existing code...

    public function boot(): void
    {
        // This extends Laravel's Hash facade to add a custom hashing driver
        // The 'extend' method takes two parameters:
        // 1. 'sha1' - the name of the custom driver
        // 2. A callback function that returns a new instance of Sha1Hasher
        
        // After this is registered, you can use Hash::driver('sha1')->make('password')
        // to hash passwords using SHA1 algorithm
        Hash::extend('sha1', function () {
            return new Sha1Hasher();
        });
    }
}