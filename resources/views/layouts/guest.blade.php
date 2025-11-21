<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Authentication</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

        <style>
            body {
                background: linear-gradient(135deg, #0a0f1a 0%, #1a2332 50%, #2a3545 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }

            .auth-container {
                width: 100%;
                max-width: 450px;
                padding: 20px;
            }

            .auth-card {
                background: white;
                border-radius: 15px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
                overflow: hidden;
            }

            .auth-header {
                background: linear-gradient(135deg, #FFD700 0%, #FFC700 100%);
                padding: 2rem;
                text-align: center;
            }

            .auth-header h2 {
                color: #1a2332;
                font-weight: 700;
                margin: 0;
            }

            .auth-body {
                padding: 2rem;
            }

            .form-label {
                color: #1a2332;
                font-weight: 600;
                margin-bottom: 0.5rem;
            }

            .form-control {
                border: 2px solid #1a2332;
                border-radius: 8px;
                padding: 0.75rem;
                transition: all 0.3s;
            }

            .form-control:focus {
                border-color: #FFD700;
                box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25);
            }

            .btn-auth {
                background: linear-gradient(135deg, #1a2332 0%, #2a3545 100%);
                color: #FFD700;
                border: none;
                padding: 0.75rem;
                font-weight: 700;
                border-radius: 8px;
                width: 100%;
                transition: all 0.3s;
            }

            .btn-auth:hover {
                background: linear-gradient(135deg, #FFD700 0%, #FFC700 100%);
                color: #1a2332;
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
            }

            .auth-link {
                color: #1a2332;
                text-decoration: none;
                font-weight: 600;
                transition: color 0.3s;
            }

            .auth-link:hover {
                color: #FFD700;
            }

            .brand-logo {
                text-align: center;
                margin-bottom: 2rem;
            }

            .brand-logo h1 {
                color: #FFD700;
                font-weight: 700;
                font-size: 2rem;
                text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            }

            .alert-custom {
                background-color: #FFD700;
                border: 2px solid #1a2332;
                color: #1a2332;
                border-radius: 8px;
                padding: 1rem;
                margin-bottom: 1rem;
            }
        </style>
    </head>
    <body>
        <div class="auth-container">
            <div class="brand-logo">
                <a href="/" style="text-decoration: none;">
                    <h1><i class="bi bi-gear-fill"></i> Blessing Equipment</h1>
                </a>
            </div>

            <div class="auth-card">
                {{ $slot }}
            </div>

            <div class="text-center mt-3">
                <a href="/" class="auth-link" style="color: #FFD700;">
                    <i class="bi bi-arrow-left"></i> Back to Homepage
                </a>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
