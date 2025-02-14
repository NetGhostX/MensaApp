<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginHistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $history = [
            'total_logins' => $user->anzahlanmeldungen,
            'last_login' => $user->letzteanmeldung,
            'failed_attempts' => $user->anzahlfehler,
            'last_failed' => $user->letzterfehler,
            'is_admin' => $user->admin
        ];

        return view('auth.history', compact('history'));
    }
}
