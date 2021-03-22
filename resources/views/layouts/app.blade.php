<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}</title>
        <link rel="icon" type="image/png" href="{{asset('images/icono.png')}}" />
        
        <!-- seo  -->
        {{$seo}}

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- https://material.io/resources/icons/?style=baseline -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons"
            rel="stylesheet">

        <!-- https://material.io/resources/icons/?style=outline -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined"
            rel="stylesheet">

        <!-- https://material.io/resources/icons/?style=round -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Round"
            rel="stylesheet">

        <!-- https://material.io/resources/icons/?style=sharp -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp"
            rel="stylesheet">

        <!-- https://material.io/resources/icons/?style=twotone -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Two+Tone"
            rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        
        <!-- pwa -->
        @laravelPWA
    </head>
    <body class="font-sans antialiased text-sm">
        <x-jet-banner />
        <div class="min-h-screen">
            {{$menu}}
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
