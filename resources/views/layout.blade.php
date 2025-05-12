<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Dancing+Script:wght@600;700&family=Raleway:wght@400;500;600;700&family=Inter:wght@500&family=Mulish:wght@400;600;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="m-0">
    <x-header />
    @if(session('success'))
        <div class="container mx-auto px-4 mt-4">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container mx-auto px-4 mt-4">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4">
                {{ session('error') }}
            </div>
        </div>
    @endif
    @yield('content')
    <x-footer/>
  
    @livewireScripts
    @stack('scripts')
</body>
</html>
