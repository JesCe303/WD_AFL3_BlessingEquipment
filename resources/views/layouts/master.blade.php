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
        
    <title>Homepage</title>
</head>

<body style="min-height: 100vh; display: flex; flex-direction: column;">

    <!--Navbar -->
    @include('layouts.navbar')

    <!-- Content -->
    {{-- margin top for the fixed navbar --}}
    {{-- margin bottom for the fixed footer --}}
    <div class="container" style="margin-top: 80px; margin-bottom: 50px; flex: 1;">
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
