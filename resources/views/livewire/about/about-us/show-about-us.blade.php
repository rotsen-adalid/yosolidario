<x-slot name="title">
    {{__('About us')}} : YoSolidario
</x-slot>
<x-slot  name="seo">
  
</x-slot>
<x-slot  name="menu">
    <livewire:menu.navigation-app/>
</x-slot>
<div>
<div class="mt-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-4 lg:px-4 mt-20">
        <div class="w-full text-center space-y-5 py-10 sm:py-20">
            <div class="font-bold text-3xl sm:text-4xl">
                {{__('Why YoSolidario')}}
            </div>
            <div class="text-lg sm:text-xl sm:mx-48">
                {{__('YoSolidario is the No.1 and most trusted leader in online fundraising. We’ve built our reputation by serving and supporting our community every step of the way.')}}
            </div>
        </div>
    </div>
</div>
<div class="" style="background-color:#fbf8f6">
    <div class="max-w-6xl mx-auto px-4 sm:px-4 md:px-36 py-20">
        <div class="w-full text-center space-y-5 pb-10">
            <div class="font-bold text-3xl sm:text-4xl">
                {{__('What makes YoSolidario stand out from the rest')}}
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 sm:gap-10 items-center">
            <div class="text-base">
                <span>{{__('Our Trust & Safety team works round the clock to ensure your safety and to protect you against fraud. We also provide the industry’s first and only')}}</span>
                <a href="{{ url('privacy-policy') }}" target="_black" class="text-ys1">{{__('donor protection guarantee')}}</a>
            </div>
            <div class="md:col-span-2 bg-white p-5 rounded text-xl text-gray-700 shadow-md">
               <div class="font-light">
                “
                {{__('The Trust and Safety team inside YoSolidario works with key stakeholders, including government officials, to ensure that funds raised on the platform are verified and that they go to the cause for which the money is being raised')}}
                ”.
               </div>
               <div class="font-bold text-base mt-5">{{__('CEO of YoSolidario')}}</div>
            </div>
            <div class="md:col-span-2 text-lg">
                <img class="rounded-md" src="{{asset('images/about/speed.jpg')}}" alt="">
            </div>
            <div class=" p-5 rounded text-gray-700">
               <div class="font-bold text-2xl">{{__('Speed')}}</div>
               <div class="text-base mt-5">{{__('We have helped families and communities recover quickly. In the first 30 days of the pandemic.')}}</div>
            </div>
            <div class=" p-5 rounded text-gray-700">
                <div class="font-bold text-2xl">{{__('Tools')}}</div>
                <div class="text-base mt-5">{{__('YoSolidario fundraising tools make it easy for you to create, share and raise money for your campaign. From our mobile app to beneficiary management to team fundraising, we are constantly working on ways to improve our organiser and donor experiences – and change the way the world gives.')}}</div>
            </div>
            <div class="md:col-span-2 text-lg">
                <img class="rounded-md" src="{{asset('images/about/tools.jpg')}}" alt="">
            </div>
            <div class="md:col-span-2 text-lg">
                <img src="{{asset('images/about/reach.jpg')}}" alt="">
            </div>
            <div class=" p-5 rounded text-gray-700">
                <div class="font-bold text-2xl">{{__('Reach')}}</div>
                <div class="text-base mt-5">{{__('YoSolidario makes it easy for you to share your story far and wide by email, text and social media to rally support for your cause. We also have a dedicated team looking for great stories to promote and share with the media and our community.')}}</div>
            </div>
            <div class=" p-5 rounded text-gray-700">
                <div class="font-bold text-2xl">{{__('Service')}}</div>
                <div class="text-base mt-5">{{__('Our best-in-class Customer Support team is available round the clock, seven days a week to answer your questions, offer advice and support you every step of the way. We care about your questions, which is why we’re committed to providing a fast and friendly response.')}}</div>
            </div>
            <div class="md:col-span-2 text-lg">
                <img class="rounded-md" src="{{asset('images/about/service.jpg')}}" alt="">
            </div>
        </div>
    </div>
</div>
<!-- Start a campaign -->
<div class="bg-white py-16 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:mt-5">
        <div class="text-center text-xl sm:text-3xl font-bold">{{__('The leader in online fundraising')}}</div>
        <div class="get-app flex space-x-5 mt-2 sm:mt-2 justify-center md:justify-center">
            <button wire:click="createCampaign" wire:loading.attr="disabled" 
            class="font-bold focus:outline-none text-white text-lg font-semibold bg-ys1 shadow-lg px-6 py-3 rounded-md flex items-center space-x-4 hover:text-white mt-4 hover:bg-ys2">
            {{ __('Start a campaign') }}
            </button>
        </div>
    </div>
</div>
<!-- End Start -->
</div>
<livewire:footer/>