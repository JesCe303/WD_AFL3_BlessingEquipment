<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        /**
         * Register custom middleware aliases for route protection
         * 
         * 'admin' => AdminMiddleware
         * - Protects admin routes (Branch, Category, Product CRUD)
         * - Checks if user has role='admin'
         * - Usage: Route::middleware(['auth', 'admin'])
         * 
         * 'customer' => CustomerMiddleware
         * - Protects customer routes (Shopping Cart)
         * - Checks if user has role='customer'
         * - Usage: Route::middleware(['auth', 'customer'])
         */
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'customer' => \App\Http\Middleware\CustomerMiddleware::class,
        ]);

        /**
         * Exclude Midtrans callback from CSRF verification
         * Midtrans sends POST requests without CSRF token
         */
        $middleware->validateCsrfTokens(except: [
            'midtrans/callback',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
