<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
{{-- Your content --}}

<div class="p-8 text-xl text-blue-600">
    Welcome to Tailwind + Blade + Filament!
    {{ $plan}}
</div>
<div class="bg-red-500 text-white p-4 rounded">
    Tailwind شغال داخل Filament ✅
</div>
</body>
</html>
