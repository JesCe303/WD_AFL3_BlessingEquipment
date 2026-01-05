<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Bootstrap Icons -->
    <!-- Used in: footer.blade (whatsapp, envelope, clock, geo-alt)
        show.blade (plus-circle, exclamation-triangle, x-circle, trash)
        add.blade (box-seam, tag, card-text, x-circle, check-circle)
        edit.blade (box-seam, tag, card-text, x-circle, check-circle) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Custom Product Styles -->
    <link rel="stylesheet" href="{{ asset('css/product-styles.css') }}">
    

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f8f9fa;
            color: #1a2332;
        }

        .pagination p {
            display: none !important;
        }

        /* Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Global Button Styles */
        .btn {
            font-weight: 600;
            transition: all 0.3s ease;
            border-radius: 8px;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        /* Card Improvements */
        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border-radius: 12px;
        }

        .card:hover {
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }

        /* Alert Improvements */
        .alert {
            border-radius: 12px;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        /* Table Improvements */
        .table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        /* Form Control Improvements */
        .form-control, .form-select {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #FFD700;
            box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.15);
        }

        /* Responsive Typography */
        @media (max-width: 768px) {
            .page-header-title, .product-page-title, .hero-title {
                font-size: 2.5rem !important;
            }

            .page-header-subtitle, .product-page-subtitle, .hero-subtitle {
                font-size: 1.1rem !important;
            }
        }
    </style>
        
    <title>Homepage</title>
</head>

<body style="min-height: 100vh; display: flex; flex-direction: column;">

    <!--Navbar -->
    @include('layouts.navbar')

    <!-- Content -->
    {{-- Full width for pages with custom headers, container for others --}}
    <div style="margin-top: 80px; flex: 1;">
        <!-- content content -->
        @yield ('content')
    </div>

    <!--Footer -->
    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
