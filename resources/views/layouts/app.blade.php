<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}</title>
        <link rel="icon" type="image/png" href="{{asset('images/icono.png')}}" />
        
        <!-- seo  -->
        @if (isset($seo))
            {{$seo}}
        @endif
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

        <script>
            window.fbAsyncInit = function() {
              FB.init({
                appId            : '738141669970459',
                autoLogAppEvents : true,
                xfbml            : true,
                version          : 'v10.0'
              });
            };
          </script>
          <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

        <meta name="globalsign-domain-verification" content="jpcnVg6kuHYyEz5op6ZzxI2E53gePoVqca7RgL0aNq">

        <!-- Google Site Verification -->
        <meta name="google-site-verification" content="GIdvoXEWAacQdvns1qHKxS_am1-4tQdidcoJUFj2aOY">
        <script type="application/ld+json">
            {
                "@context": "http://schema.org",
                "@type": "Organization",
                "url": "http://www.yosolidario.com",
                "logo": "https://febc376daf6131a28181-3721cc30b0d63259b2211381d1431a50.ssl.cf1.rackcdn.com/gfm-logo-single-2016@2x.png",
                "name": "GoFundMe",
                "alternateName": "Gofundme",
                "sameAs": [
                    "https://www.facebook.com/gofundme/",
                    "https://twitter.com/gofundme",
                    "https://www.instagram.com/gofundme/",
                    "https://www.youtube.com/user/gofundme",
                    "https://www.linkedin.com/company-beta/1271240"
                ]
            }
        </script>

    </head>
    <body class="font-sans antialiased text-sm">

        <div class="min-h-screen">
            <div>
                {{$menu}}
            </div>
            <div>
                @livewire('banner.view-banner')
            </div>
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            <!-- Footer page -->
            @if (isset($footer))
                {{$footer}}
            @endif
        </div>

        @stack('modals')

        @livewireScripts
        
    </body>
</html>
