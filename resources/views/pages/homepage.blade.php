@extends('layouts.master')

@section('title', 'Home - Blessing Equipment')

@section('content')
    {{-- Hero Section with Background --}}
    <div class="hero-section">
        <div class="hero-overlay">
            <div class="container">
                <div class="hero-content">
                    <div class="hero-badge">🏆 Trusted Since 2015</div>
                    <h1 class="hero-title">Blessing Equipment</h1>
                    <p class="hero-subtitle">Your Trusted Partner for Quality Spare Parts</p>
                    <p class="hero-description">
                        Providing reliable and high-quality spare parts for bakery and restaurant equipment with professional service and expert support
                    </p>
                    <div class="hero-buttons">
                        <a href="/product" class="btn-hero btn-primary">
                            <i class="bi bi-box-seam me-2"></i>Browse Products
                        </a>
                        <a href="/about" class="btn-hero btn-secondary">
                            <i class="bi bi-info-circle me-2"></i>About Us
                        </a>
                    </div>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <div class="stat-number">1000+</div>
                            <div class="stat-label">Products</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">500+</div>
                            <div class="stat-label">Happy Clients</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">10+</div>
                            <div class="stat-label">Years Experience</div>
                        </div>
                    </div>
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
            min-height: 650px;
            background: linear-gradient(135deg, rgba(10, 15, 26, 0.95) 0%, rgba(26, 35, 50, 0.9) 100%),
                        url('https://images.unsplash.com/photo-1581092160562-40aa08e78837?q=80&w=2070') center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 100px 0 80px;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(255, 215, 0, 0.03) 10px,
                rgba(255, 215, 0, 0.03) 20px
            );
            pointer-events: none;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 200px;
            background: linear-gradient(to bottom, 
                rgba(248, 249, 250, 0) 0%,
                rgba(248, 249, 250, 0.05) 20%,
                rgba(248, 249, 250, 0.15) 40%,
                rgba(248, 249, 250, 0.35) 60%,
                rgba(248, 249, 250, 0.65) 80%,
                rgba(248, 249, 250, 0.90) 92%,
                #f8f9fa 100%
            );
        }

        .hero-overlay {
            position: relative;
            z-index: 1;
            width: 100%;
        }

        .hero-content {
            text-align: center;
            color: white;
        }

        .hero-badge {
            display: inline-block;
            padding: 10px 24px;
            background: rgba(255, 215, 0, 0.15);
            border: 2px solid rgba(255, 215, 0, 0.3);
            border-radius: 30px;
            color: #FFD700;
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(10px);
            letter-spacing: 0.5px;
        }

        .hero-title {
            font-size: 4.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            color: #FFD700;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.4);
            line-height: 1.2;
            letter-spacing: -1px;
        }

        .hero-subtitle {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.95);
            letter-spacing: 0.5px;
        }

        .hero-description {
            font-size: 1.15rem;
            margin-bottom: 2.5rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            opacity: 0.9;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.85);
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-hero {
            padding: 15px 40px;
            font-size: 1.1rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .btn-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-hero:hover::before {
            left: 100%;
        }

        .btn-hero.btn-primary {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            color: #1a2332;
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
        }

        .btn-hero.btn-primary:hover {
            background: linear-gradient(135deg, #FFC700 0%, #FF8C00 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 215, 0, 0.5);
        }

        .btn-hero.btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 2px solid #FFD700;
            backdrop-filter: blur(10px);
        }

        .btn-hero.btn-secondary:hover {
            background: #FFD700;
            color: #1a2332;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
        }

        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin-top: 4rem;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #FFD700;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.8);
            text-transform: uppercase;
            letter-spacing: 1px;
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
            padding: 2.5rem;
            border-radius: 16px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border: 1px solid rgba(0,0,0,0.05);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #FFD700, #FFA500);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.15);
        }

        .feature-icon {
            font-size: 3.5rem;
            color: #FFD700;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .feature-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: #1a2332;
            margin-bottom: 1rem;
        }

        .feature-description {
            color: #6c757d;
            line-height: 1.7;
            font-size: 1.05rem;
        }

        /* Category Cards */
        .category-card {
            background: linear-gradient(135deg, #1a2332 0%, #2c3e50 100%);
            padding: 3.5rem 2.5rem;
            border-radius: 20px;
            text-align: center;
            color: white;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 215, 0, 0.2);
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .category-card:hover::before {
            opacity: 1;
        }

        .category-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        }

        .category-icon {
            font-size: 4.5rem;
            color: #FFD700;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .category-card:hover .category-icon {
            transform: scale(1.15) rotate(-5deg);
        }

        .category-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .category-description {
            font-size: 1.15rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        /* Branch Cards */
        .branch-card {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            border: 2px solid #e9ecef;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            position: relative;
        }

        .branch-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 16px;
            padding: 2px;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .branch-card:hover::after {
            opacity: 1;
        }

        .branch-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
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
            .hero-section {
                min-height: 600px;
                padding: 100px 0 60px;
            }

            .hero-title {
                font-size: 2.8rem;
            }
            
            .hero-subtitle {
                font-size: 1.4rem;
            }

            .hero-description {
                font-size: 1rem;
            }

            .hero-stats {
                gap: 2rem;
                margin-top: 3rem;
            }

            .stat-number {
                font-size: 2rem;
            }
            
            .section-title {
                font-size: 2rem;
            }

            .btn-hero {
                padding: 12px 30px;
                font-size: 1rem;
            }

            .feature-icon {
                font-size: 3rem;
            }

            .category-icon {
                font-size: 3.5rem;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2.2rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .hero-buttons {
                flex-direction: column;
                width: 100%;
            }

            .btn-hero {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endsection