
<div>
    <div x-data="{ imgModal : false, imgModalSrc : '', imgModalDesc : '' }">
        <template @img-modal.window="imgModal = true; imgModalSrc = $event.detail.imgModalSrc; imgModalDesc = $event.detail.imgModalDesc;" x-if="imgModal">
          <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" x-on:click.away="imgModalSrc = ''" class="p-2 fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center bg-black bg-opacity-75">
            <div @click.away="imgModal = ''" class="flex flex-col max-w-3xl max-h-full overflow-auto">
              <div class="z-50">
                <button @click="imgModal = ''" class="float-right pt-2 pr-2 outline-none focus:outline-none">
                    <i class=" text-white uil uil-times-circle text-3xl"></i>
                </button>
              </div>
              <div class="p-2">
                <img :alt="imgModalSrc" class="object-contain h-1/2-screen" :src="imgModalSrc">
                <p x-text="imgModalDesc" class="text-center text-white"></p>
              </div>
            </div>
          </div>
        </template>
      </div>
      
      <div x-data="{}" class="mt-0">
    
        <div class="flex flex-col text-base sm:text-base">
    
            <!-- -->
            <div class="mb-5 font-bold text-lg">
                {{__('What is it about?')}}
            </div>
            <div class="mt-0 pb-10 sm:pb-5 flex flex-col-reverse sm:flex-col sm:block">
                <div @click="$dispatch('img-modal', {  imgModalSrc: '{{URL::to('/').$this->campaign->campaignQuestion->about_url}}', imgModalDesc: '' })" class="flex justify-center sm:block">
                    @if($this->campaign->campaignQuestion->about_url)
                        <img class="h-auto w-80 mt-3 sm:mt-0 sm:mr-4 rounded cursor-pointer" src="{{URL::to('/').$this->campaign->campaignQuestion->about_url}}" 
                        hspace="2" vspace="2" style="float: left;" />
                    @endif
                </div>
                <div class="text-justify">
                    {!! nl2br(e($this->campaign->campaignQuestion->about), false) !!}
                </div>
            </div>
            <!-- -->
            <div class="mb-5 font-bold py-1 text-lg">
                @if ($this->campaign->type_campaign == 'ORGANIZATION')
                    {{__('Como se usara el dinero?')}}
                @else 
                    {{__('How will I use the money?')}}
                @endif
            </div>
            <div class="pb-10 sm:pb-5 flex flex-col-reverse sm:flex-col sm:block">
                <div @click="$dispatch('img-modal', {  imgModalSrc: '{{URL::to('/').$this->campaign->campaignQuestion->use_of_money_url}}', imgModalDesc: '' })" class="flex justify-center sm:block">
                    @if($this->campaign->campaignQuestion->use_of_money_url)
                        <img class="h-auto w-80 mt-3 sm:mt-0 sm:mr-4 rounded cursor-pointer" src="{{URL::to('/').$this->campaign->campaignQuestion->use_of_money_url}}" 
                        hspace="2" vspace="2" style="float: left;" />
                    @endif
                </div>
                <div class="text-justify">
                    {!! nl2br(e($this->campaign->campaignQuestion->use_of_money), false) !!}
                </div>
            </div>
               
            <!-- -->
            @if ($this->campaign->type_campaign == 'PERSONAL' or $this->campaign->type_campaign == 'PERSONAL_ORGANIZATION')
            <div class="mb-5 font-bold py-1 text-lg">
                {{__('About the organizer')}}
            </div>
            <div class="pb-10 sm:pb-5 flex flex-col-reverse sm:flex-col sm:block">
                <div @click="$dispatch('img-modal', {  imgModalSrc: '{{URL::to('/').$this->campaign->campaignQuestion->about_organizer_url}}', imgModalDesc: '' })" class="flex justify-center sm:block">
                    @if($this->campaign->campaignQuestion->about_organizer_url)
                        <img class="h-auto w-80 mt-3 sm:mt-0 sm:mr-4 rounded cursor-pointer" src="{{URL::to('/').$this->campaign->campaignQuestion->about_organizer_url}}" 
                        hspace="2" vspace="2" style="float: left;" />
                    @endif
                </div>
                <div class="text-justify">
                    {!! nl2br(e($this->campaign->campaignQuestion->about_organizer), false) !!}
                </div>
            </div>
            @endif
            <!-- -->
            @if($this->campaign->campaignReward->count() > 0)
            <div class=" mb-5 font-bold py-1 text-lg">
                {{__('How and when are the rewards delivered?')}}
            </div>
            <div class="pb-10 sm:pb-5 flex flex-col-reverse sm:flex-col sm:block">
               <div @click="$dispatch('img-modal', {  imgModalSrc: '{{URL::to('/').$this->campaign->campaignQuestion->delivery_of_rewards_url}}', imgModalDesc: '' })" class="flex justify-center sm:block">
                    @if($this->campaign->campaignQuestion->delivery_of_rewards_url)
                        <img class="h-auto w-80 mt-3 sm:mt-0 sm:mr-4 rounded cursor-pointer" src="{{URL::to('/').$this->campaign->campaignQuestion->delivery_of_rewards_url}}" 
                        hspace="2" vspace="2" style="float: left;" />
                    @endif
               </div>
               <div class="text-justify">
                    {!! nl2br(e($this->campaign->campaignQuestion->delivery_of_rewards), false) !!}
                </div>
            </div>
            @endif
            <!-- -->
            @if($this->campaign->campaignQuestion->question_title_add)
            <div class="mb-5 font-bold py-1 text-lg">
                {!! nl2br(e($this->campaign->campaignQuestion->question_title_add), false) !!}
            </div>
                <div class="pb-10 sm:pb-5 flex flex-col-reverse sm:flex-col sm:block">
                   <div @click="$dispatch('img-modal', {  imgModalSrc: '{{URL::to('/').$this->campaign->campaignQuestion->question_url_add}}', imgModalDesc: '' })" class="flex justify-center sm:block">
                        @if($this->campaign->campaignQuestion->question_url_add)
                            <img class="h-auto w-80 mt-3 sm:mt-0 sm:mr-4 rounded cursor-pointer" src="{{ URL::to('/').$this->campaign->campaignQuestion->question_url_add}}" 
                            hspace="2" vspace="2" style="float: left;" />
                        @endif
                   </div>
                   <div class="text-justify">
                        {!! nl2br(e($this->campaign->campaignQuestion->question_body_add), false) !!}
                    </div>
                </div>
            @endif
            <!-- -->
            <div class="mb-5 font-bold py-1 text-lg">
                @if ($this->campaign->type_campaign == 'ORGANIZATION')
                    {{__('Contact details')}}
                @else 
                    {{__('Organizer contact details')}}
                @endif
            </div>
            <div class="pb-5 flex flex-col-reverse sm:flex-col sm:block">
                <div @click="$dispatch('img-modal', {  imgModalSrc: '{{URL::to('/').$this->campaign->campaignQuestion->contact_organizer_url}}', imgModalDesc: '' })" class="flex justify-center sm:block">
                    @if($this->campaign->campaignQuestion->contact_organizer_url)
                        <img class="h-auto w-80 mt-3 sm:mt-0 sm:mr-4 rounded cursor-pointer" src="{{ URL::to('/').$this->campaign->campaignQuestion->contact_organizer_url}}" 
                        hspace="2" vspace="2" style="float: left;" />
                    @endif
                </div>
                <div class="text-justify">
                    {!! nl2br(e($this->campaign->campaignQuestion->contact_organizer), false) !!}
                </div>
            </div>
        </div>
    
    </div>

    <div class=" flex sm:justify-center sm:items-center mt-5 sm:mt-5 sm:mb-5 space-x-4">
        <button
            wire:click="$emit('backThisCampaign', {{$campaign->id}})" wire:loading.attr="disabled"   
            class="w-full shadow-lg lg:w-72 px-4 py-2 sm:py-3 text-center bg-yellow-400 border border-yellow-500 rounded-md font-bold text-base text-black uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-500 focus:outline-none focus:border-gray-100 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
            <!-- <img src="{asset('images/icono.png')}}" class="h-7" alt=""> -->
            <span>{{__('Back this campaign')}}</span>
        </button>
        <button wire:click="$emit('sharedOpen', {{$this->campaign->id}})" wire:loading.attr="disabled" 
            class="w-full lg:w-72 px-4 py-2 sm:py-3 text-center border border-yellow-400 border border-yellow-500 rounded-md font-bold text-base text-black uppercase tracking-widest hover:border-yellow-300 active:border-yellow-500 focus:outline-none focus:border-yellow-300 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
            <!-- <img src="{asset('images/icono.png')}}" class="h-7" alt=""> -->
            <span>{{__('Share')}}</span>
        </button>
    </div>

    @if ($this->campaign->type_campaign == 'ORGANIZATION')
        <div class="hidden mb-5 font-bold pb-3 text-2xl border-b border-gray-200">
            {{__('Organizer')}}
        </div>
        <div class="hidden justify-start mt-5">
            <div class="flex items-center ">
                @if($this->campaign->user->profile_photo_path)
                <div wire:click="viewUser({{$this->campaign->user->id}})" wire:loading.attr="disabled" class="flex-shrink-0 w-12 h-12 cursor-pointer">
                    <img class="h-full w-full rounded-full object-cover"
                        src="{{ URL::to('/') }}{{$this->campaign->user->profile_photo_path}}"
                        alt="" />
                </div>
                @else 
                <div wire:click="viewUser({{$this->campaign->user->id}})" class="flex-shrink-0 w-14 h-14 cursor-pointer">
                    <img class="h-14 w-14 rounded-full object-cover"
                        src="{{ $this->campaign->user->profile_photo_url }}" alt="{{ $this->campaign->user->name }}" />
                </div>
                @endif
                <div class="ml-3">
                    <div wire:click="viewUser({{$this->campaign->user->id}})" class="text-gray-900 text-sm sm:text-base cursor-pointer"> 
                        {{$this->campaign->user->name}}
                    </div>
                    <div class="text-xs text-gray-600">
                        {{__('Recaudador de fondos')}}
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>