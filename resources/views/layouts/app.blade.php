<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Medical Store</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- bootstrap files  --}}
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />


    {{-- bootstrap icons  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            z-index: 10000;
        }

        main {
            padding: 20px;
        }

        .cart-badge {
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 3px 8px;
            font-size: 12px;
            vertical-align: super;
            margin-left: 5px;
        }
    </style>

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        <header>
            <div class="logo">
                <a href="{{ route('home') }}"
                    style="text-decoration:none; font-weight:bold; font-size: 20px; color: #333;">
                    Medical Shop
                </a>
            </div>

            <div class="cart">
                <a href="{{ route('cart.all') }}"
                    style="text-decoration:none; color: #333; font-weight: bold; font-size: 18px;">
                    <i class="bi bi-cart-fill"></i> Cart
                    @php
                        $cart = session('cart', []);
                        $count = 0;
                        foreach ($cart as $item) {
                            $count += $item['quantity'];
                        }
                    @endphp
                    @if ($count > 0)
                        <span class="cart-badge">{{ $count }}</span>
                    @endif
                </a>
            </div>
        </header>


        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>


    <script src="{{ asset('assets/js/scripts.js') }}"></script>

</body>

</html>
