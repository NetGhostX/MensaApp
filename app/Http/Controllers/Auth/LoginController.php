<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Benutzer;
use App\Services\Sha1Hasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'destroy']);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $this->logger()->info('Login attempt', ['email' => $credentials['email']]);

        $user = Benutzer::where('email', $credentials['email'])->first();

        // b) Warning for failed login
        if (!$user) {
            $this->logger()->warning('Login failed', ['email' => $credentials['email']]);
            return response()->json([
                'message' => 'Diese E-Mail-Adresse ist nicht registriert.'
            ], 401);
        }

        $hasher = new Sha1Hasher();
        if ($hasher->make($credentials['password']) !== $user->passwort) {
            Benutzer::where('id', $user->id)->update([
                'anzahlfehler' => $user->anzahlfehler + 1,
                'letzterfehler' => now()
            ]);

            $this->logger()->warning('Login failed', ['email' => $credentials['email']]);
            return response()->json([
                'message' => 'Ungültiges Passwort.'
            ], 401);
        }

        Benutzer::where('id', $user->id)->update([
            'anzahlanmeldungen' => $user->anzahlanmeldungen + 1,
            'letzteanmeldung' => now()
        ]);

        $this->guard()->login($user);

        // a) Info for successful login
        $this->logger()->info('Login successful', ['user_id' => $user->id]);

        return response()->json([
            'message' => 'Login erfolgreich',
            'user' => $user
        ]);
    }

    public function destroy(Request $request)
    {
        // a) Info for logout
        $this->logger()->info('User logged out', ['user_id' => Auth::id()]);
        $this->guard()->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home');
    }

    protected function guard()
    {
        return Auth::guard('web');
    }
}
