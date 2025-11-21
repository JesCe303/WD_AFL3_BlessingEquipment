<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Customer Middleware - Protects customer-only routes
 * 
 * Purpose: Ensures only users with role='customer' can access cart features
 * Used for: Shopping cart (view, add, update, remove items)
 * 
 * Registration: Registered in bootstrap/app.php as 'customer' alias
 * Usage in routes: Route::middleware(['auth', 'customer'])->group(...)
 * 
 * Why needed:
 * - Cart is user-specific (each customer has their own cart)
 * - Admin users don't need cart functionality
 * - Guests must register/login before shopping
 * 
 * Flow:
 * 1. Check if user is logged in (Auth::check())
 * 2. Check if user has role='customer' (Auth::user()->role)
 * 3. Allow access if both conditions met
 * 4. Redirect to login if not customer
 */
class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     * Only allow authenticated users with role 'customer' to proceed
     * Used for cart and checkout features
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has customer role
        // Auth::check() = is user logged in?
        // Auth::user()->role = get role from database (must be 'customer')
        // Admin users will be redirected to login (they don't need cart)
        if (Auth::check() && Auth::user()->role === 'customer') {
            return $next($request); // Allow access to cart routes
        }

        // Redirect non-customer users (guest/admin) to login page
        return redirect('/login')->with('Error', 'Please login as customer to access this feature.');
    }
}
