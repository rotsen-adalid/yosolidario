<x-app-layout>
    <x-slot name="title">
        YoSolidario: {{__('Collection platform')}}
    </x-slot>
    <x-slot  name="seo">
  
        <meta property="og:url"                content="http://www.nytimes.com/2015/02/19/arts/international/when-great-minds-dont-think-alike.html" />
        <meta property="og:type"               content="article" />
        <meta property="og:title"              content="When Great Minds Don’t Think Alike" />
        <meta property="og:description"        content="How much does culture influence creative thinking?" />
        <meta property="og:image"              content="http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg" />
        
      </x-slot>
      
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
