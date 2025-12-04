<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #EDF1F7;
        }

        .auth-card {
            max-width: 450px;
            width: 100%;
            border-radius: 15px;
            overflow: hidden;
        }

        .auth-logo {
            width: 80px;
            height: auto;
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-900">

    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center py-4">

        {{-- Logo Sunib Eats --}}
        <div class="mb-4 text-center">
            <a href="/" class="d-flex flex-column align-items-center text-decoration-none">
                <img src="{{ asset('logo.png') }}" alt="Sunib Eats" class="auth-logo mb-2">
                <h3 class="fw-bold text-dark m-0">Sunib Eats</h3>
            </a>
        </div>

        {{-- Card Container --}}
        <div class="card shadow-sm border-0 auth-card">
            <div class="card-body p-4 p-md-5">
                {{ $slot }}
            </div>
        </div>

        <div class="mt-4 text-muted small">
            &copy; {{ date('Y') }} Sunib Eats. All rights reserved.
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>