<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Admin Middleware - Protects admin-only routes
 * 
 * Purpose: Ensures only users with role='admin' can access protected routes
 * Used for: Branch CRUD, Category CRUD, Product CRUD operations
 * 
 * Registration: Registered in bootstrap/app.php as 'admin' alias
 * Usage in routes: Route::middleware(['auth', 'admin'])->group(...)
 * 
 * Flow:
 * 1. Check if user is logged in (Auth::check())
 * 2. Check if user has role='admin' (Auth::user()->role)
 * 3. Allow access if both conditions met
 * 4. Redirect to homepage if not admin
 */
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     * Only allow users with role 'admin' to proceed
     * Redirect others to homepage
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has admin role
        // Auth::check() = is user logged in?
        // Auth::user()->role = get the role column value from database
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Allow access to protected route
        }

        // Show 404 error for non-admin users (customer/guest)
        // Makes admin routes invisible to customers
        abort(404);
    }
}
