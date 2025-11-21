@extends('layouts.master')

@section('title', 'About Us - Blessing Equipment')

@section('content')
    {{-- Page Header --}}
    <div class="about-header">
        <div class="container">
            <h1 class="page-title">About Blessing Equipment</h1>
            <p class="page-subtitle">Excellence in Spare Parts Supply Since 2015</p>
        </div>
    </div>

    {{-- Company Overview --}}
    <section class="about-overview">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="about-image-container">
                        <div class="about-image-main">
                            <i class="bi bi-building" style="font-size: 200px; color: #FFD700;"></i>
                        </div>
                        <div class="about-badge">
                            <span class="badge-year">Est. 2015</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content">
                        <h2 class="content-title">Our Story</h2>
                        <p class="content-text">
                            Established in 2015, <strong>Blessing Equipment</strong> has been serving the bakery and restaurant industry with premium quality spare parts and exceptional service. What started as a small shop in Surabaya has grown into a trusted name across Indonesia.
                        </p>
                        <p class="content-text">
                            We understand that equipment downtime means lost revenue. That's why we maintain a comprehensive inventory of spare parts, ensuring quick turnaround times and minimal disruption to your business operations.
                        </p>
                        <div class="stats-grid">
                            <div class="stat-item">
                                <div class="stat-number">9+</div>
                                <div class="stat-label">Years Experience</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">500+</div>
                                <div class="stat-label">Happy Clients</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">2</div>
                                <div class="stat-label">Branch Locations</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- What We Offer --}}
    <section class="about-products">
        <div class="container">
            <h2 class="section-title-alt">What We Supply</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="product-category-box">
                        <div class="category-icon-large">
                            <i class="bi bi-egg-fried"></i>
                        </div>
                        <h3 class="category-name">Bakery Equipment Parts</h3>
                        <ul class="product-list">
                            <li><i class="bi bi-check-circle-fill"></i> Mixer spare parts (belts, motors, gears)</li>
                            <li><i class="bi bi-check-circle-fill"></i> Oven components (heating elements, thermostats)</li>
                            <li><i class="bi bi-check-circle-fill"></i> Dough machine parts</li>
                            <li><i class="bi bi-check-circle-fill"></i> Proofing cabinet accessories</li>
                            <li><i class="bi bi-check-circle-fill"></i> Sheeter and divider components</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-category-box">
                        <div class="category-icon-large">
                            <i class="bi bi-shop"></i>
                        </div>
                        <h3 class="category-name">Restaurant Equipment Parts</h3>
                        <ul class="product-list">
                            <li><i class="bi bi-check-circle-fill"></i> Commercial refrigeration parts</li>
                            <li><i class="bi bi-check-circle-fill"></i> Cooking range components</li>
                            <li><i class="bi bi-check-circle-fill"></i> Deep fryer spare parts</li>
                            <li><i class="bi bi-check-circle-fill"></i> Food prep equipment accessories</li>
                            <li><i class="bi bi-check-circle-fill"></i> Ventilation system parts</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Main Branch Details --}}
    <section class="about-location">
        <div class="container">
            <h2 class="section-title-alt">Our Main Branch</h2>
            <div class="location-card">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <div class="location-image">
                            <div class="location-icon-wrapper">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div class="location-map-placeholder">
                                <i class="bi bi-map" style="font-size: 4rem; color: #FFD700;"></i>
                                <p style="margin-top: 1rem; color: #6c757d;">Surabaya, East Java</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="location-details">
                            <h3 class="location-title">
                                <i class="bi bi-building me-2"></i>Blessing Equipment Surabaya
                            </h3>
                            <div class="detail-item">
                                <i class="bi bi-geo-alt-fill"></i>
                                <div>
                                    <strong>Address:</strong><br>
                                    Darmo Permai Selatan XIII No.33<br>
                                    Surabaya, East Java, Indonesia
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="bi bi-shop"></i>
                                <div>
                                    <strong>Store Type:</strong><br>
                                    Offline Store (Walk-in Welcome)
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="bi bi-clock"></i>
                                <div>
                                    <strong>Operating Hours:</strong><br>
                                    Monday - Friday: 8:00 AM - 5:00 PM<br>
                                    Saturday: 8:00 AM - 2:00 PM<br>
                                    Sunday: Closed
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="bi bi-telephone-fill"></i>
                                <div>
                                    <strong>Contact:</strong><br>
                                    Phone: +62 31 XXXX XXXX<br>
                                    Email: info@blessingequipment.com
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Why Choose Us --}}
    <section class="about-values">
        <div class="container">
            <h2 class="section-title-alt">Our Commitment</h2>
            <div class="row g-4">
                <div class="col-md-3 col-sm-6">
                    <div class="value-card">
                        <i class="bi bi-gem"></i>
                        <h4>Quality</h4>
                        <p>Only genuine and certified parts</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="value-card">
                        <i class="bi bi-lightning-charge"></i>
                        <h4>Fast Service</h4>
                        <p>Quick response and delivery</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="value-card">
                        <i class="bi bi-shield-check"></i>
                        <h4>Reliability</h4>
                        <p>Trusted by hundreds of businesses</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="value-card">
                        <i class="bi bi-people"></i>
                        <h4>Expert Team</h4>
                        <p>Knowledgeable staff ready to help</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Page Header */
        .about-header {
            background: linear-gradient(135deg, #1a2332 0%, #2c3e50 100%);
            padding: 80px 20px 100px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .about-header::before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 60px;
            background: white;
            clip-path: polygon(0 50%, 100% 0, 100% 100%, 0 100%);
        }

        .page-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: #FFD700;
            margin-bottom: 1rem;
        }

        .page-subtitle {
            font-size: 1.3rem;
            opacity: 0.9;
        }

        /* Sections */
        .about-overview, .about-products, .about-location, .about-values {
            padding: 80px 20px;
        }

        .about-overview {
            background: white;
        }

        .about-products {
            background: #f8f9fa;
        }

        .about-location {
            background: white;
        }

        .about-values {
            background: #f8f9fa;
        }

        /* About Image */
        .about-image-container {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .about-image-main {
            width: 350px;
            height: 350px;
            background: linear-gradient(135deg, #1a2332 0%, #2c3e50 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        }

        .about-badge {
            position: absolute;
            top: -20px;
            right: -20px;
            background: #FFD700;
            padding: 15px 25px;
            border-radius: 50px;
            box-shadow: 0 4px 12px rgba(255, 215, 0, 0.4);
        }

        .badge-year {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a2332;
        }

        /* Content */
        .content-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a2332;
            margin-bottom: 1.5rem;
        }

        .content-text {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #6c757d;
            margin-bottom: 1.5rem;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 2rem;
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
            font-size: 0.95rem;
            color: #6c757d;
            font-weight: 600;
        }

        /* Section Title Alt */
        .section-title-alt {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a2332;
            margin-bottom: 3rem;
            position: relative;
            padding-bottom: 1rem;
        }

        .section-title-alt::after {
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

        /* Product Category Box */
        .product-category-box {
            background: white;
            padding: 2.5rem;
            border-radius: 12px;
            height: 100%;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .product-category-box:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }

        .category-icon-large {
            font-size: 4rem;
            color: #FFD700;
            margin-bottom: 1.5rem;
        }

        .category-name {
            font-size: 1.8rem;
            font-weight: 600;
            color: #1a2332;
            margin-bottom: 1.5rem;
        }

        .product-list {
            list-style: none;
            padding: 0;
        }

        .product-list li {
            padding: 0.8rem 0;
            color: #6c757d;
            display: flex;
            align-items: start;
            gap: 0.8rem;
            font-size: 1.05rem;
        }

        .product-list i {
            color: #FFD700;
            font-size: 1.2rem;
            margin-top: 0.1rem;
        }

        /* Location Card */
        .location-card {
            background: white;
            border-radius: 16px;
            padding: 3rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        }

        .location-map-placeholder {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 3rem;
            text-align: center;
            border: 2px dashed #e9ecef;
        }

        .location-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1a2332;
            margin-bottom: 2rem;
        }

        .detail-item {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 2rem;
            align-items: start;
        }

        .detail-item i {
            font-size: 2rem;
            color: #FFD700;
            flex-shrink: 0;
        }

        .detail-item strong {
            color: #1a2332;
            font-size: 1.1rem;
        }

        .detail-item div {
            color: #6c757d;
            line-height: 1.8;
        }

        /* Value Cards */
        .value-card {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            height: 100%;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .value-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }

        .value-card i {
            font-size: 3rem;
            color: #FFD700;
            margin-bottom: 1rem;
        }

        .value-card h4 {
            font-size: 1.3rem;
            font-weight: 600;
            color: #1a2332;
            margin-bottom: 0.5rem;
        }

        .value-card p {
            color: #6c757d;
            margin: 0;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .stats-grid {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .about-image-main {
                width: 280px;
                height: 280px;
            }
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 2.5rem;
            }
            
            .content-title {
                font-size: 2rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .location-card {
                padding: 2rem 1.5rem;
            }
        }
    </style>
@endsection