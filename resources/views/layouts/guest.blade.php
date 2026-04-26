<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TaskFlow') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
        
        <!-- Bootstrap 5 & Font Awesome -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                background-attachment: fixed;
                font-family: 'Plus Jakarta Sans', sans-serif;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .auth-card {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.4);
                border-radius: 24px;
                box-shadow: 0 10px 40px rgba(0,0,0,0.08);
                width: 100%;
                max-width: 450px;
                padding: 3rem;
                margin: 1rem;
            }
            .auth-logo {
                margin-bottom: 2.5rem;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            /* Target Breeze Components */
            input[type="text"], input[type="email"], input[type="password"] {
                border-radius: 12px !important;
                padding: 0.75rem 1rem !important;
                border: 1px solid #e5e7eb !important;
                background: rgba(255, 255, 255, 0.5) !important;
                transition: all 0.3s ease !important;
            }
            input:focus {
                background: white !important;
                box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1) !important;
                border-color: #6366f1 !important;
            }
            .btn-primary {
                background: linear-gradient(135deg, #6366f1, #a855f7) !important;
                border: none !important;
                border-radius: 12px !important;
                padding: 0.8rem 1.5rem !important;
                font-weight: 700 !important;
                transition: all 0.3s ease !important;
            }
            .btn-primary:hover {
                transform: translateY(-2px) !important;
                box-shadow: 0 5px 15px rgba(99, 102, 241, 0.4) !important;
            }
            /* Fix for Checkboxes */
            .form-check-input {
                cursor: pointer !important;
                position: relative !important;
                z-index: 5 !important;
            }
            label { cursor: pointer !important; }
            .text-sm { font-size: 0.875rem; }
            .text-gray-600 { color: #4b5563; }
            .hover\:text-gray-900:hover { color: #111827; }
        </style>
    </head>
    <body class="antialiased">
        <div class="auth-card">
            <div class="auth-logo text-center">
                <a href="/">
                    <x-application-logo />
                </a>
            </div>

            {{ $slot }}
        </div>
    </body>
</html>
