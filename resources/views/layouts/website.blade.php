<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tajded - Flat Renovations</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-papNM8U+...Zz6s==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style type="text/tailwindcss">
        @theme {
            --color-blaze-orange-50: #fff6ed;
            --color-blaze-orange-100: #feebd6;
            --color-blaze-orange-200: #fcd4ac;
            --color-blaze-orange-300: #fab577;
            --color-blaze-orange-400: #f68a41;
            --color-blaze-orange-500: #f36614;
            --color-blaze-orange-600: #e55111;
            --color-blaze-orange-700: #be3c10;
            --color-blaze-orange-800: #973115;
            --color-blaze-orange-900: #792a15;
            --color-blaze-orange-950: #421308;
        }

        body {
            font-family: "Almarai", sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="antialiased bg-gray-50 text-gray-800" dir="rtl">
    <x-web-header />

    @yield('content')

    <x-web-footer />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
