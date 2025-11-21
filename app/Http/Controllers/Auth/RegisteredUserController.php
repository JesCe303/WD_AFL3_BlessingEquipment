<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

/**
 * Registered User Controller - Handles user registration
 * 
 * Routes:
 * - GET /register -> create() - Show registration form
 * - POST /register -> store() - Process registration
 * 
 * Flow:
 * 1. User fills registration form (name, email, password)
 * 2. Data validated (email must be unique, password confirmed)
 * 3. User created in database with role='customer' (default from migration)
 * 4. User automatically logged in
 * 5. Redirected to dashboard (which then redirects based on role)
 */
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     * Shows form: name, email, password, password confirmation
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     * Creates new user in database and logs them in
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate registration data
        // Email must be unique (not already in users table)
        // Password must be confirmed (password_confirmation field must match)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create new user in database
        // Role defaults to 'customer' (set in migration)
        // Password is hashed for security (never store plain text passwords)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Fire Registered event (can be used for email verification)
        event(new Registered($user));

        // Log the user in automatically after registration
        Auth::login($user);

        // Redirect to dashboard (dashboard will redirect based on role)
        return redirect(route('dashboard', absolute: false));
    }
}
