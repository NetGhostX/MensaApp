<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Benutzer;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:200'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:benutzer'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $salt = 'emensa2023'; // Using the same salt as in beispiele/passwort.php
        return Benutzer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'passwort' => sha1($data['password'] . $salt),
            'admin' => false,
            'anzahlfehler' => 0,
            'anzahlanmeldungen' => 0
        ]);
    }

    public function register(Request $request)
    {
        $this->logger()->info('Registration attempt', ['email' => $request->email]);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $this->logger()->info('Registration successful', [
            'user_id' => $user->id,
            'email' => $user->email
        ]);

        return redirect()->route('login');
    }
}
