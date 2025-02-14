<?php

namespace App\Http\Controllers;

use App\Models\NewsletterRegistration;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:newsletter_registrations,email',
            'language' => 'required|in:de,en',
            'privacy' => 'required|accepted'
        ]);

        NewsletterRegistration::create([
            'full_name' => $validated['fullName'],
            'email' => $validated['email'],
            'language' => $validated['language'],
            'privacy_accepted' => true,
        ]);

        return response()->json([
            'message' => 'Successfully subscribed to newsletter!',
            'count' => NewsletterRegistration::count()
        ]);
    }
}
