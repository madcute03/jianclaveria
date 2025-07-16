<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Allow pushing styles from child views -->
    @stack('styles')

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Figtree', sans-serif;
        }

        .glow-background {
            background: radial-gradient(circle at top left, #0f172a, #000000);
            min-height: 100vh;
            background-attachment: fixed;
            color: #cce4ff;
            box-shadow: inset 0 0 60px rgba(0, 123, 255, 0.1);
        }

        .page-header {
            font-size: 2rem;
            font-weight: 700;
            color: #cce4ff;
            text-shadow: 0 0 10px rgba(0, 123, 255, 0.7);
        }

        header.bg-glow {
            background: rgba(30, 58, 138, 0.6);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #3b82f6;
            box-shadow: 0 0 20px rgba(0, 123, 255, 0.2);
        }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #3b82f6;
            border-radius: 8px;
            background-color: #0f172a;
            color: #ffffff;
            font-size: 14px;
            outline: none;
            box-shadow: 0 0 5px rgba(59, 130, 246, 0.3);
            transition: 0.3s;
        }

        input:focus,
        textarea:focus {
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.7);
            border-color: #60a5fa;
        }

        .submit-button {
            background: linear-gradient(to right, #0ea5e9, #6366f1);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(14, 165, 233, 0.6);
            transition: 0.3s;
        }

        .submit-button:hover {
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.8);
            transform: scale(1.05);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #93c5fd;
        }

        .form-container {
            background: rgba(15, 23, 42, 0.8);
            border-radius: 15px;
            padding: 24px;
            box-shadow: 0 0 20px rgba(0, 123, 255, 0.3);
            border: 1px solid rgba(0, 123, 255, 0.2);
            max-width: 600px;
            margin: auto;
        }

        .back-link {
            color: #60a5fa;
            text-decoration: underline;
            font-size: 0.9rem;
        }

        .back-link:hover {
            color: #93c5fd;
        }
    </style>
</head>
<body class="antialiased">
    <div class="glow-background">

        {{-- Navigation --}}
        @include('layouts.navigation')

        {{-- Page Header --}}
        @hasSection('header')
            <header class="bg-glow shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        {{-- Page Content --}}
        <main class="px-4 py-6 sm:px-6 lg:px-8">
            @yield('content') {{-- For @section --}}
            {{ $slot ?? '' }} {{-- For <x-app-layout> --}}
        </main>

        {{-- Allow pushing scripts from child views --}}
        @stack('scripts')
    </div>
</body>
</html>
