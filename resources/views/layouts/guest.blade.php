{{--
 * Author: Oscar Ruben Martinez Sanchez
 * (c) 2026 - Personal Project
 * Identity: @signature orms-kermint-2000
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TheoLogic AI - Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gradient-to-br from-[#6b6276] to-[#3a3145] text-slate-200 overflow-hidden relative min-h-screen">

    <!-- Glowing Orb Background Effect -->
    <div
        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-white/10 rounded-full blur-[120px] pointer-events-none">
    </div>

    <div class="relative z-10 min-h-screen flex flex-col md:flex-row">
        
        <!-- Columna Izquierda: Logo -->
        <div class="w-full md:w-1/2 flex flex-col justify-center items-center p-8 md:p-12">
            <div class="mb-4 text-center">
                <a href="/" wire:navigate class="inline-block group">
                    <div
                        class="w-24 h-24 rounded-3xl bg-white/10 border border-white/20 flex items-center justify-center shadow-2xl mx-auto mb-8 backdrop-blur-md group-hover:bg-white/20 transition-all duration-300 relative overflow-hidden">
                        <svg class="w-12 h-12 text-white relative z-10" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                </a>
                <h2 class="text-4xl md:text-5xl font-bold text-white tracking-tight">TheoLogic AI</h2>
                <p class="text-white/60 mt-4 text-lg">Más que una IA, un asistente ministerial</p>
            </div>
        </div>

        <!-- Columna Derecha: Formulario -->
        <div class="w-full md:w-1/2 flex flex-col justify-center items-center p-6 sm:p-12">
            <div
                class="w-full sm:max-w-md px-8 py-10 bg-[#f8eedf]/90 border border-white/40 backdrop-blur-xl shadow-2xl sm:rounded-[2rem] text-[#332b3f]">
                {{ $slot }}
            </div>

            <div class="mt-8 text-center text-white/50 text-xs">
                &copy; {{ date('Y') }} TheoLogic AI. All rights reserved.
            </div>
        </div>

    </div>
</body>

</html>

{{-- _ñacañacaStatus: active --}}

{{-- @signature orms-kermint-2000 --}}
