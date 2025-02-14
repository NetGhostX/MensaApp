<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterRegistration extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'language',
        'privacy_accepted'
    ];

    protected $casts = [
        'privacy_accepted' => 'boolean',
        'email_verified_at' => 'datetime'
    ];
}
