    <style>
        .navbar-custom {
            background: linear-gradient(180deg, 
                rgba(10, 15, 26, 1) 0%, 
                rgba(15, 22, 35, 0.98) 70%,
                rgba(20, 28, 40, 0.95) 100%
            );
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            padding: 0.8rem 0;
            border-bottom: 1px solid rgba(255, 215, 0, 0.1);
        }

        .navbar-custom .navbar-brand {
            font-weight: 700;
            font-size: 1.6rem;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            letter-spacing: 0.5px;
        }

        .navbar-custom .navbar-brand i {
            color: #FFD700;
            font-size: 1.8rem;
        }

        .navbar-custom .nav-link {
            transition: all 0.3s ease;
            position: relative;
            padding: 1.2rem 1.5rem !important;
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            font-size: 1rem;
            display: flex;
            align-items: center;
        }

        .navbar-custom .nav-link:hover {
            color: #FFD700 !important;
        }

        .navbar-custom .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: 0;
            left: 50%;
            background: linear-gradient(90deg, #FFD700, #FFA500);
            transition: all 0.3s ease;
            transform: translateX(-50%);
            border-radius: 2px 2px 0 0;
        }

        .navbar-custom .nav-link:hover::after {
            width: 100%;
        }

        .navbar-custom .nav-link.active::after {
            width: 100%;
        }

        .navbar-custom .container-fluid {
            padding: 0 5%;
        }
    </style>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <i class="bi bi-gear-fill"></i>
                Blessing Equipment
            </a>
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('favorite.index') }}">
                                    <i class="bi bi-heart"></i> Favorites
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
