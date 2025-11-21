    <style>
        .navbar-custom {
            background: linear-gradient(135deg, #0a0f1a 0%, #151b28 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .navbar-custom .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }

        .navbar-custom .nav-link {
            transition: all 0.3s ease;
            position: relative;
            padding: 8px 15px !important;
            color: white !important;
        }

        .navbar-custom .nav-link:hover {
            color: #FFD700 !important;
        }

        .navbar-custom .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: #FFD700;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .navbar-custom .nav-link:hover::after {
            width: 80%;
        }
    </style>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Blessing Equipment</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    {{-- Public pages - accessible by everyone --}}
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/product">Product</a>
                    </li>

                    {{-- Admin-only menu items --}}
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="/branch">Branch</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/category">Category</a>
                            </li>
                        @endif
                        
                        {{-- Customer-only menu items --}}
                        @if(auth()->user()->role === 'customer')
                            <li class="nav-item">
                                <a class="nav-link" href="/cart">
                                    <i class="bi bi-cart"></i> Cart
                                </a>
                            </li>
                        @endif

                        {{-- Logout button for authenticated users --}}
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="nav-link" style="background: none; border: none; cursor: pointer;">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    @else
                        {{-- Login button for guests --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>

        </div>
    </nav>
