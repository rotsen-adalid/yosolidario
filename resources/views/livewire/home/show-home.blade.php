<x-slot name="title">
    YoSolidario: {{__('Fundraising platform')}}
</x-slot>
<x-slot  name="seo">
  
        <!-- facebook -->
        <meta property="og:url"        content="https://yosolidario.com" />
        <meta property="og:type"       content="article" />
        <meta property="og:title"      content="YoSolidario - {{__('The crowdfunding platform')}}" />
        <meta property="og:description"  content="{{__('The most trusted online fundraising platform. Start a crowdfunding campaign. ✓ Read our guarantee!')}}" />
        <meta property="og:image"      content="{{asset('images/logo-ceo.jpg')}}" />
        <meta property="fb:app_id" content="738141669970459" />

        <!-- twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@yosolidariocom">
        <meta name="twitter:title" content="YoSolidario - {{__('The crowdfunding platform')}}}">
        <meta name="twitter:creator" content="@yosolidariocom">
        <meta name="twitter:description" content="{{__('The most trusted online fundraising platform. Start a crowdfunding campaign. ✓ Read our guarantee!')}}">
        <meta name="twitter:image" content="{{asset('images/logo-ceo.jpg')}}">
  
</x-slot>
<x-slot  name="menu">
    <livewire:menu.navigation-app/>
</x-slot>
  
<div class="mt-20">
 
    <livewire:home.hero-home/>

    <div class="max-w-6xl mx-auto px-4 md:px-4 lg:px-4">
        <livewire:home.campaign-urgent-home/>
        <livewire:home.top-fundraising-home/>

        @include('livewire.home.about-ys-home')
        @include('livewire.home.categories-home')
    </div>
    
    <!-- Start a campaign -->
    <div class=" py-16 sm:py-20" style="background-color:#fbf8f6">
        <div class="max-w-6xl mx-auto px-4 md:px-4 lg:px-4 sm:mt-5">
            <div class="text-center text-xl sm:text-3xl font-bold">{{__('Ready to start fundraising?')}}</div>
            <div class="get-app flex space-x-5 mt-2 sm:mt-2 justify-center md:justify-center">
                <button wire:click="createCampaign" wire:loading.attr="disabled" 
                class="font-bold focus:outline-none text-white text-lg font-semibold bg-ys1 shadow-lg px-6 py-3 rounded-md flex items-center space-x-4 hover:text-white mt-4 hover:bg-ys2">
                {{ __('Start a campaign') }}
                </button>
            </div>
        </div>
    </div>
    <!-- End Start 
    <div class="flex items-end justify-end fixed bottom-0 right-0 mb-4 mr-4 z-10">
        <div>
            <a href="https://telegram.me/yosolidario" target="_blank" title="YoSolidario" class="block w-10 h-10 rounded-full transition-all shadow hover:shadow-lg transform hover:scale-110 hover:rotate-12">
                <img class="object-cover object-center w-full h-full rounded-full" src="data:image/svg+xml;base64,PHN2ZyBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyNCAyNCIgaGVpZ2h0PSI1MTIiIHZpZXdCb3g9IjAgMCAyNCAyNCIgd2lkdGg9IjUxMiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIxMiIgY3k9IjEyIiBmaWxsPSIjMDM5YmU1IiByPSIxMiIvPjxwYXRoIGQ9Im01LjQ5MSAxMS43NCAxMS41Ny00LjQ2MWMuNTM3LS4xOTQgMS4wMDYuMTMxLjgzMi45NDNsLjAwMS0uMDAxLTEuOTcgOS4yODFjLS4xNDYuNjU4LS41MzcuODE4LTEuMDg0LjUwOGwtMy0yLjIxMS0xLjQ0NyAxLjM5NGMtLjE2LjE2LS4yOTUuMjk1LS42MDUuMjk1bC4yMTMtMy4wNTMgNS41Ni01LjAyM2MuMjQyLS4yMTMtLjA1NC0uMzMzLS4zNzMtLjEyMWwtNi44NzEgNC4zMjYtMi45NjItLjkyNGMtLjY0My0uMjA0LS42NTctLjY0My4xMzYtLjk1M3oiIGZpbGw9IiNmZmYiLz48L3N2Zz4=" />
            </a>
        </div>
    </div>
    -->
</div>
<livewire:footer.footer-app/>
