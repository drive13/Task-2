<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Voler Admin Dashboard</title>
    
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    
    
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    
    <link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">
    {{-- Bootstrap Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    
</head>
<body>
    <div id="app">
        {{-- Sidebar --}}
        @include('my-layouts.sidebar')
        <div id="main">
            
            {{-- Navbar --}}
            @include('my-layouts.navbar')
            
            {{-- Content --}}
            @yield('content')

            {{-- Footer --}}
            @include('my-layouts.footer')
        </div>
    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    @yield('scripts')

    <script src="assets/js/main.js"></script>
</body>
</html>

