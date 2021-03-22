<x-slot name="title">
    {{__('How it works')}} : YoSolidario
</x-slot>
<x-slot  name="seo">
  
</x-slot>
<x-slot  name="menu">
    <livewire:menu.navigation-app/>
</x-slot>
 <div>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20">
    <div>      
        <div class="bannerFondo bg-gray-50	bg-left-top bg-auto bg-repeat-x"> <!-- style="background-image: url(./img/continuartl_4.png)" -->
        </div>
    
          <div class="-mt-80 ">
            <div class="w-full text-center space-y-2">
                <div class="font-bold text-4xl">
                    {{__('How YoSolidario Works')}}
                </div>
                <div class="text-lg sm:text-xl sm:mx-48">
                    {{__('YoSolidario is the best place to raise funds for a project or social cause.')}}
                </div>
            </div>
                  
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 ">
      
              <div class="p-2 sm:p-10 cursor-pointer">
                  <div class="py-10 max-w-sm rounded overflow-hidden shadow-lg hover:bg-white transition duration-500  bg-white">
                      <div class="space-y-10">
                         <!-- 
                         <span class="py-3 px-4 border border-ys1 text-ys1 rounded-full">1</span>
                        -->
                          <div class="px-6 py-4">
                              <div class="space-y-5">
                                  <div class="font-bold text-xl mb-2">{{__('Start your campaign')}}</div>
                                  <ul class="text-gray-700 text-base  space-y-2">
                                        <li class="flex items-center space-x-2">
                                            <span class="material-icons-outlined text-xs text-ys1">radio_button_checked</span>
                                            <span>{{__('Set your fundraising goal')}}</span>
                                        </li>
                                        <li class="flex items-center space-x-2">
                                            <span class="material-icons-outlined text-xs text-ys1">radio_button_checked</span>
                                            <span>{{__('Answer the questions')}}</span>
                                        </li>
                                        <li class="flex items-center justify-start space-x-2">
                                            <span class="material-icons-outlined text-xs text-ys1">radio_button_checked</span>
                                            <span>{{__('Add a picture or video')}}</span>
                                        </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
      
              <div class="p-2 sm:p-10 cursor-pointer"> 
                  <div class="py-10 max-w-sm rounded overflow-hidden shadow-lg hover:bg-white transition duration-500  bg-white">
                      <div class="space-y-10">
                        <!--
                            <span class="py-3 px-4 border border-ys1 text-ys1 rounded-full">2</span>
                        -->
                          <div class="px-6 py-4">
                              <div class="space-y-5">
                                    <div class="font-bold text-xl mb-2">{{__('Share with family and friends')}}</div>
                                    <ul class="text-gray-700 text-base  space-y-2">
                                        <li class="flex items-center space-x-2">
                                            <span class="material-icons-outlined text-xs text-ys1">radio_button_checked</span>
                                            <span>{{__('Send emails')}}</span>
                                        </li>
                                        <li class="flex items-center space-x-2">
                                            <span class="material-icons-outlined text-xs text-ys1">radio_button_checked</span>
                                            <span>{{__('Send text messages')}}</span>
                                        </li>
                                        <li class="flex items-center justify-start space-x-2">
                                            <span class="material-icons-outlined text-xs text-ys1">radio_button_checked</span>
                                            <span>{{__('Share on social media')}}</span>
                                        </li>
                                    </ul>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
      
              <div class="p-2 sm:p-10  cursor-pointer translate-x-2">
                  <div class="py-10 max-w-sm rounded overflow-hidden shadow-lg hover:bg-white transition duration-500 bg-white ">
                      <div class="space-y-10">
                            <!-- 
                             <span class="py-3 px-4 border border-ys1 text-ys1 rounded-full">3</span>
                            -->
                          
                          <div class="px-6 py-4">
                              <div class="space-y-5">
                                    <div class="font-bold text-xl mb-2">{{__('Manage collaborations')}}</div>
                                    <ul class="text-gray-700 text-base  space-y-2">
                                        <li class="flex items-center space-x-2">
                                            <span class="material-icons-outlined text-xs text-ys1">radio_button_checked</span>
                                            <span>{{__('Accept collaborations')}}</span>
                                        </li>
                                        <li class="flex items-center space-x-2">
                                            <span class="material-icons-outlined text-xs text-ys1">radio_button_checked</span>
                                            <span>{{__('Deliver the rewards')}}</span>
                                        </li>
                                        <li class="flex items-center space-x-2">
                                            <span class="material-icons-outlined text-xs text-ys1">radio_button_checked</span>
                                            <span>{{__('Withdraw funds')}}</span>
                                        </li>
                                    </ul>
                              </div>
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
            height: 400px;
    }
</style>

<!-- ---> 
<div class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-0 py-16">
        <div class="w-full text-center space-y-5 ">
            <div class="font-bold text-4xl">
                {{__('Fast and safe')}}
            </div>
            <div class="text-lg sm:text-xl sm:mx-48">
                {{__('Millions trust YoSolidario as the No.1 online fundraising expert. That’s why more people use YoSolidario than any other platform.')}}
            </div>
        </div>
        <div class="get-app flex space-x-5 mt-2 sm:mt-2 justify-center md:justify-center">
            <button wire:click="createCampaign" wire:loading.attr="disabled" 
            class="font-bold focus:outline-none text-white text-lg font-semibold bg-ys1 shadow-lg px-6 py-3 rounded-md flex items-center space-x-4 hover:text-white mt-4 hover:bg-ys2">
            {{ __('Start a campaign') }}
            </button>
        </div>
    </div>
</div>
<!-- -->
 </div>
<livewire:footer/>