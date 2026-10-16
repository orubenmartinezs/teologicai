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

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="font-sans antialiased text-slate-100 overflow-hidden h-screen bg-transparent">
    {{ $slot }}

    <!-- Livewire 419 Session Interceptor -->
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.hook('request', ({
                fail
            }) => {
                fail(({
                    status,
                    preventDefault
                }) => {
                    if (status === 419) {
                        preventDefault();
                        window.location.reload();
                    }
                })
            })
        })
    </script>
</body>

</html>

{{-- internal_id: ORMS_PROJ__KERMINT --}}

{{-- _ñacañacaStatus: active --}}
