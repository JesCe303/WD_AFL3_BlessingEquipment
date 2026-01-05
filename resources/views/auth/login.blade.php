<x-guest-layout>
    <div class="auth-header">
        <h2><i class="bi bi-box-arrow-in-right"></i> Login</h2>
        <p style="margin: 0.5rem 0 0 0; color: #1a2332;">Welcome back! Please login to your account</p>
    </div>

    <div class="auth-body">
        {{-- Error messages --}}
        @if (session('Error'))
            <div class="alert-custom">
                <strong>Error!</strong> {{ session('Error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-custom">
                <strong>Error!</strong> Please check your credentials
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">
                    <i class="bi bi-envelope"></i> Email Address
                </label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">
                    <i class="bi bi-lock"></i> Password
                </label>
                <input type="password" id="password" name="password" class="form-control" required placeholder="Enter your password">
            </div>

            <!-- Remember Me -->
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                <label class="form-check-label" for="remember_me">
                    Remember me
                </label>
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn-auth">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </button>

            <!-- Additional Links -->
            <div class="mt-3 text-center">
                <p class="mb-0">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="auth-link">
                        <i class="bi bi-person-plus"></i> Register here
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
