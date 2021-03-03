<x-slot name="title">
    YoSolidario: {{__('Collection platform')}}
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

<div class=" bg-gray-50 py-16 sm:py-20">
 
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:mt-10">
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
           
            <div class="col-span-6 pt-5 sm:py-10">
                <h1 class="text-center sm:text-left font-bold text-2xl sm:text-4xl md:text-5xl max-w-xl text-gray-900 leading-tight">
                {{ __('Raise funds today for the causes that move you the most') }}
                </h1>
               <!-- 
                 <hr class="item-center w-12 h-1 bg-orange-500 rounded-full mt-4 sm:mt-8">
               -->
                <p class="text-center sm:text-left text-gray-800 text-base leading-relaxed mt-6 sm:mt-8 font-semibold">
                {{ __('Transaction fees apply') }}
                </p>
                <div class="get-app flex space-x-5 mt-2 sm:mt-10 justify-center md:justify-start">
                    <button wire:click="createCampaign" wire:loading.attr="disabled" class="focus:outline-none text-white bg-ys1 shadow-md px-3 py-2 rounded-full flex items-center space-x-4 hover:text-white mt-4 hover:bg-ys2">
                    {{ __('Create Campaign') }}
                    </button>
                    
                </div>
            </div>
            <!-- hero image -->
            <div class="hero-image col-span-6">
               <img class="rounded-full  w-full" src="{{asset('images/8.jpg')}}" alt="">
            </div>
        </div>
    </div>
   </div><!-- end hero -->
   
   <div class="max-w-7xl mx-auto px-4 sm:mt-10">      
    <div class="bannerFondo bg-red-50	bg-left-top bg-auto bg-repeat-x">
    </div>
  
        <div class="-mt-72 ">
          <div class="w-full flex flex-wrap flex-col items-center text-center">
            <!-- <p class="text-sm tracking-widest text-gray-900">Subtitle</p> -->
            <h1 class="font-bold text-2xl sm:text-5xl text-gray-900">
              {{__('What is YoSolidario?')}}
            </h1>
            <p class="lg:w-1/2 w-full leading-relaxed text-base mt-2 px-2 pb-5">
              {{__('YoSolidario is the only fundraising platform that connects people who need money to finance their causes, with collaborators who contribute small sums of money to be part of the initiative and receive recognition in return. Together we democratize access to capital!')}}
            </p>
        </div>
                
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 ">
    
            <div class="p-2 sm:p-10 text-center cursor-pointer">
                <div class="py-16 max-w-sm rounded overflow-hidden shadow-lg hover:bg-white transition duration-500  bg-white">
                    <div class="space-y-10">
                        <i class="fa fa-spa" style="font-size:48px;"></i>
                        
                        <div class="px-6 py-4">
                            <div class="space-y-5">
                                <div class="font-bold text-xl mb-2">Spa</div>
                                <p class="text-gray-700 text-base">
                                    Todo tipo de masajes y técnicas
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="p-2 sm:p-10 text-center cursor-pointer"> 
                <div class="py-16 max-w-sm rounded overflow-hidden shadow-lg bg-white transition duration-500">
                    <div class="space-y-10">
                      <i class="fa fa-head-side-mask" style="font-size:48px;"></i>
                        <div class="px-6 py-4">
                            <div class="space-y-5">
                                <div class="font-bold text-xl mb-2">Bioseguridad</div>
                                <p class="text-base">
                                    Altos estandares de bioseguridad
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="p-2 sm:p-10 text-center cursor-pointer translate-x-2">
                <div class="py-16 max-w-sm rounded overflow-hidden shadow-lg hover:bg-white transition duration-500 bg-white ">
                    <div class="space-y-10">
                        <i class="fa fa-swimmer" style="font-size:48px;"></i>
                        
                        <div class="px-6 py-4">
                            <div class="space-y-5">
                                <div class="font-bold text-xl mb-2">Piscina</div>
                                <p class="text-gray-700 text-base">
                                    Piscina temperada
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
        </div>
    
    </div>
    <style>
      .bannerFondo{
              height: 350px;
      }
      </style>

   <livewire:footer/>