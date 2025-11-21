@extends('layouts.master')

@section('title', 'Home - Blessing Equipment')

@section('content')
    {{-- Hero Section with Background --}}
    <div class="hero-section">
        <div class="hero-overlay">
            <div class="hero-content">
                <h1 class="hero-title">Blessing Equipment</h1>
                <p class="hero-subtitle">Your Trusted Partner for Quality Spare Parts</p>
                <p class="hero-description">
                    Providing reliable and high-quality spare parts for bakery and restaurant equipment since 2015
                </p>
                <div class="hero-buttons">
                    <a href="/product" class="btn-hero btn-primary">
                        <i class="bi bi-box-seam me-2"></i>Browse Products
                    </a>
                    <a href="/about" class="btn-hero btn-secondary">
                        <i class="bi bi-info-circle me-2"></i>About Us
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Features Section --}}
    <section class="features-section">
        <div class="container">
            <h2 class="section-title">Why Choose Us?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h3 class="feature-title">Quality Guaranteed</h3>
                        <p class="feature-description">
                            All spare parts are sourced from trusted manufacturers and undergo strict quality control
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-truck"></i>
                        </div>
                        <h3 class="feature-title">Fast Delivery</h3>
                        <p class="feature-description">
                            Quick and reliable delivery service to ensure your business keeps running smoothly
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h3 class="feature-title">Expert Support</h3>
                        <p class="feature-description">
                            Our experienced team is ready to help you find the right spare parts for your equipment
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Product Categories Section --}}
    <section class="categories-section">
        <div class="container">
            <h2 class="section-title">Product Categories</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="bi bi-egg-fried"></i>
                        </div>
                        <h3 class="category-title">Bakery Equipment</h3>
                        <p class="category-description">
                            Spare parts for ovens, mixers, dough machines, and more
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="bi bi-shop"></i>
                        </div>
                        <h3 class="category-title">Restaurant Equipment</h3>
                        <p class="category-description">
                            Parts for cooking equipment, refrigeration, and kitchen tools
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Our Branches Section --}}
    <section class="branches-section">
        <div class="container">
            <h2 class="section-title">Our Locations</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="branch-card">
                        <div class="branch-header">
                            <i class="bi bi-building"></i>
                            <h3>Surabaya Branch</h3>
                        </div>
                        <div class="branch-info">
                            <p><i class="bi bi-geo-alt-fill"></i> Darmo Permai Selatan XIII No.33</p>
                            <p><i class="bi bi-shop"></i> Offline Store</p>
                            <span class="badge-main">Main Branch</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="branch-card">
                        <div class="branch-header">
                            <i class="bi bi-building"></i>
                            <h3>Jakarta Branch</h3>
                        </div>
                        <div class="branch-info">
                            <p><i class="bi bi-geo-alt-fill"></i> Jakarta Pusat</p>
                            <p><i class="bi bi-globe"></i> Online Store</p>
                            <span class="badge-secondary">Branch</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Hero Section */
        .hero-section {
            position: relative;
            height: 600px;
            background: linear-gradient(135deg, #1a2332 0%, #2c3e50 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23FFD700" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') bottom center no-repeat;
            background-size: cover;
        }

        .hero-overlay {
            position: relative;
            z-index: 1;
            text-align: center;
            color: white;
            padding: 0 20px;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #FFD700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero-subtitle {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            font-weight: 300;
        }

        .hero-description {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            opacity: 0.9;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-hero {
            padding: 12px 32px;
            font-size: 1.1rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }

        .btn-hero.btn-primary {
            background: #FFD700;
            color: #1a2332;
        }

        .btn-hero.btn-primary:hover {
            background: #FFC700;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 215, 0, 0.4);
        }

        .btn-hero.btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid #FFD700;
        }

        .btn-hero.btn-secondary:hover {
            background: #FFD700;
            color: #1a2332;
            transform: translateY(-2px);
        }

        /* Sections */
        .features-section, .categories-section, .branches-section {
            padding: 80px 20px;
        }

        .features-section {
            background: #f8f9fa;
        }

        .categories-section {
            background: white;
        }

        .branches-section {
            background: #f8f9fa;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a2332;
            margin-bottom: 3rem;
            position: relative;
            padding-bottom: 1rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: #FFD700;
            border-radius: 2px;
        }

        /* Feature Cards */
        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }

        .feature-icon {
            font-size: 3rem;
            color: #FFD700;
            margin-bottom: 1rem;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1a2332;
            margin-bottom: 1rem;
        }

        .feature-description {
            color: #6c757d;
            line-height: 1.6;
        }

        /* Category Cards */
        .category-card {
            background: linear-gradient(135deg, #1a2332 0%, #2c3e50 100%);
            padding: 3rem 2rem;
            border-radius: 12px;
            text-align: center;
            color: white;
            transition: all 0.3s ease;
            height: 100%;
        }

        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.2);
        }

        .category-icon {
            font-size: 4rem;
            color: #FFD700;
            margin-bottom: 1.5rem;
        }

        .category-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .category-description {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Branch Cards */
        .branch-card {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
            height: 100%;
        }

        .branch-card:hover {
            border-color: #FFD700;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }

        .branch-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            color: #1a2332;
        }

        .branch-header i {
            font-size: 2rem;
            color: #FFD700;
        }

        .branch-header h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }

        .branch-info p {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #6c757d;
            margin-bottom: 0.8rem;
        }

        .branch-info i {
            color: #FFD700;
            font-size: 1.2rem;
        }

        .badge-main {
            display: inline-block;
            padding: 6px 16px;
            background: #FFD700;
            color: #1a2332;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .badge-secondary {
            display: inline-block;
            padding: 6px 16px;
            background: #e9ecef;
            color: #1a2332;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.3rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }
    </style>
@endsection