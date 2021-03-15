<x-slot name="title">
    YoSolidario: {{__('Fundraising platform')}}
</x-slot>
<x-slot  name="seo">
  
        <!-- facebook -->
        <meta property="og:url"        content="https://www.yosolidario.com" />
        <meta property="og:type"       content="article" />
        <meta property="og:title"      content="YoSolidario - {{__('The crowdfunding platform')}}" />
        <meta property="og:description"  content="{{__('The most trusted online fundraising platform. Start a crowdfunding campaign. ✓ Read our guarantee!')}}" />
        <meta property="og:image"      content="{{asset('images/logo-ceo.png')}}" />
        <meta property="fb:app_id" content="738141669970459" />

        <!-- twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@yosolidariocom">
        <meta name="twitter:title" content="YoSolidario - {{__('The crowdfunding platform')}}}">
        <meta name="twitter:creator" content="@yosolidariocom">
        <meta name="twitter:description" content="{{__('The most trusted online fundraising platform. Start a crowdfunding campaign. ✓ Read our guarantee!')}}">
        <meta name="twitter:image" content="{{asset('images/logo-ceo.png')}}">
  
</x-slot>
<x-slot  name="menu">
    @livewire('navigation')
</x-slot>
  
<div class="">
 
<livewire:home.hero-home/>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <livewire:home.campaign-urgent-home/>
    <livewire:home.top-fundraising-home/>

    @include('livewire.home.about-ys-home')
    @include('livewire.home.categories-home')
</div>

<!-- Start a campaign -->
<div class=" bg-red-50 py-16 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:mt-5">
        <div class="text-center text-xl sm:text-2xl font-bold">{{__('Ready to start fundraising?')}}</div>
        <div class="get-app flex space-x-5 mt-2 sm:mt-2 justify-center md:justify-center">
            <button wire:click="createCampaign" wire:loading.attr="disabled" 
            class="focus:outline-none text-white text-lg font-semibold bg-ys1 shadow-md px-3 py-2 rounded-md flex items-center space-x-4 hover:text-white mt-4 hover:bg-ys2">
            {{ __('Start a campaign') }}
            </button>
        </div>
    </div>
</div>
<!-- End Start -->

</div>
<livewire:footer/>