<x-slot name="title">
    {{$this->campaign->title}} : YoSolidario
</x-slot>
<x-slot  name="seo">
    
        <!-- facebook -->
        <meta property="og:url"        content="http://www.yosolidario.com/{{$this->campaign->slug}}" />
        <meta property="og:type"       content="article" />
        <meta property="og:title"      content="{{$this->campaign->title}}" />
        <meta property="og:description"  content="{{$this->campaign->extract}}" />
        <meta property="og:image"      content="https://yosolidario.com{{$this->campaign->image->url}}" />
       <!--  <meta property="og:video"      content="{$this->campaign->video->url}}" /> -->
        <meta property="fb:app_id" content="738141669970459" />

        <!-- twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@yosolidariocom">
        <meta name="twitter:title" content="{{$this->campaign->title}}">
        <meta name="twitter:description" content="{{$this->campaign->extract}}">
        <meta name="twitter:image" content="https://yosolidario.com{{$this->campaign->image->url}}">

</x-slot>
<x-slot name="header">
    
</x-slot>
