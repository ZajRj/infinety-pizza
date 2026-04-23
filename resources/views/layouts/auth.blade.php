<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Infinety Pizza') }} - Auth</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&family=Epilogue:wght@700;800&display=swap" rel="stylesheet">

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-body bg-brand-neutral">
    
    <div class="min-h-screen flex flex-col">
        <!-- Minimal Header -->
        <div class="absolute top-0 left-0 w-full p-8 z-50">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <span class="text-xl font-bold text-brand-primary tracking-tight font-heading">
                        Infinety <span class="text-gray-900 group-hover:text-brand-primary transition-colors">Pizza Co.</span>
                    </span>
                </a>
                <a href="{{ route('home') }}" class="text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-primary transition-colors flex items-center gap-2">
                    @svg('fas-arrow-left', ['class' => 'w-3 h-3'])
                    Back to Shop
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Minimal Footer -->
        <div class="p-8 text-center">
            <p class="text-[9px] font-black text-gray-300 uppercase tracking-[0.4em]">
                &copy; {{ date('Y') }} Infinety Pizza Co. • Handcrafted in Madrid
            </p>
        </div>
    </div>

</body>
</html>
