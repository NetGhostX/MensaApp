<?php

namespace App\Services;

use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Facades\Config;

class Sha1Hasher implements Hasher
{
    protected function getSalt()
    {
        return Config::get('auth.password_salt', 'emensa2023');
    }

    public function info($hashedValue)
    {
        return ['algo' => 'sha1'];
    }

    public function make($value, array $options = [])
    {
        return sha1($value . $this->getSalt());
    }

    public function check($value, $hashedValue, array $options = [])
    {
        return $this->make($value) === $hashedValue;
    }

    public function needsRehash($hashedValue, array $options = [])
    {
        return false;
    }
}
