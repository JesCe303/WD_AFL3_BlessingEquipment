<x-guest-layout>
    <div class="auth-header">
        <h2><i class="bi bi-person-plus"></i> Register</h2>
        <p style="margin: 0.5rem 0 0 0; color: #1a2332;">Create a new customer account</p>
    </div>

    <div class="auth-body">
        {{-- Error messages --}}
        @if ($errors->any())
            <div class="alert-custom">
                <strong>Error!</strong> Please check your input
                <ul style="margin: 0.5rem 0 0 0; padding-left: 1.5rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">
                    <i class="bi bi-person"></i> Full Name
                </label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required autofocus placeholder="John Doe">
            </div>

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">
                    <i class="bi bi-envelope"></i> Email Address
                </label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="john@example.com">
                <small class="text-muted">Use valid email format</small>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">
                    <i class="bi bi-lock"></i> Password
                </label>
                <input type="password" id="password" name="password" class="form-control" required placeholder="Minimum 8 characters">
                <small class="text-muted">Must be at least 8 characters</small>
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">
                    <i class="bi bi-lock-fill"></i> Confirm Password
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required placeholder="Re-enter password">
            </div>

            <!-- Register Button -->
            <button type="submit" class="btn-auth">
                <i class="bi bi-person-plus"></i> Register as Customer
            </button>

            <!-- Additional Links -->
            <div class="mt-3 text-center">
                <p class="mb-0">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="auth-link">
                        <i class="bi bi-box-arrow-in-right"></i> Login here
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
