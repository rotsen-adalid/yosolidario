<x-slot name="title">
    {{$campaign->title}} : YoSolidario
</x-slot>
<x-slot  name="seo">
    
        <!-- facebook -->
        <meta property="og:site_name" content="NOMBRE_DEL_SITIO">
        <meta property="og:url" content="http://www.yosolidario.com/f/{{$campaign->slug}}">
        <meta property="og:type" content="video">
        <meta property="og:title" content="{{$campaign->title}}">
        <meta property="og:description" content="{{$campaign->extract}}">
        <meta property="og:image" content="https://yosolidario.com{{$campaign->image->url}}">
        <meta property="og:image:type" content="image/jpg">
        <meta property="og:image:width" content="1280">
        <meta property="og:image:height" content="720">
        <meta property="og:video:url" content="https://player.vimeo.com/video/491927546?autoplay=1">
        <meta property="og:video:secure_url" content="https://player.vimeo.com/video/491927546?autoplay=1">
        <meta property="og:video:type" content="text/html">
        <meta property="og:video:width" content="1280">
        <meta property="og:video:height" content="720">
        <meta property="og:video:url" content="https://vimeo.com/moogaloop.swf?clip_id=491927546&amp;autoplay=1">
        <meta property="og:video:secure_url" content="https://vimeo.com/moogaloop.swf?clip_id=491927546&amp;autoplay=1">
        <meta property="og:video:type" content="application/x-shockwave-flash">
        <meta property="og:video:width" content="1280">
        <meta property="og:video:height" content="720">
        <meta property="fb:app_id" content="738141669970459" />
        <!-- twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@yosolidariocom">
        <meta name="twitter:title" content="{{$campaign->title}}">
        <meta name="twitter:description" content="{{$campaign->extract}}">
        <meta name="twitter:image" content="https://yosolidario.com{{$campaign->image->url}}">

</x-slot>
<x-slot name="header">
    
</x-slot>
