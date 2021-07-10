
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
  
  <div x-data="{}">

    <div class="flex flex-col text-base sm:text-base">

        <!-- -->
        <div class="mt-4 pb-10 sm:pb-5 flex flex-col-reverse sm:flex-col sm:block border-b">
           <div @click="$dispatch('img-modal', {  imgModalSrc: '{{URL::to('/').$this->campaign->campaignQuestion->about_url}}', imgModalDesc: '' })" class="flex justify-center sm:block">
                @if($this->campaign->campaignQuestion->about_url)
                    <img class="h-auto w-80 mt-3 sm:mt-0 sm:mr-4 rounded cursor-pointer" src="{{URL::to('/').$this->campaign->campaignQuestion->about_url}}" 
                    hspace="2" vspace="2" style="float: left;" />
                @endif
           </div>
            <div>
                <div class="mb-5 font-bold py-1 text-lg">
                    {{__('What is it about?')}}
                </div>
                <div class="text-justify">
                    {!! nl2br(e($this->campaign->campaignQuestion->about), false) !!}
                </div>
            </div>
        </div>
        <!-- -->
        <div class="pt-6 pb-10 sm:pb-5 flex flex-col-reverse sm:flex-col sm:block border-b">
            <div @click="$dispatch('img-modal', {  imgModalSrc: '{{URL::to('/').$this->campaign->campaignQuestion->use_of_money_url}}', imgModalDesc: '' })" class="flex justify-center sm:block">
                @if($this->campaign->campaignQuestion->use_of_money_url)
                    <img class="h-auto w-80 mt-3 sm:mt-0 sm:mr-4 rounded cursor-pointer" src="{{URL::to('/').$this->campaign->campaignQuestion->use_of_money_url}}" 
                    hspace="2" vspace="2" style="float: left;" />
                @endif
            </div>
            <div>
                <div class="mb-5 font-bold py-1 text-lg">
                    {{__('Como se usara el dinero?')}}
                </div>
                <div class="text-justify">
                    {!! nl2br(e($this->campaign->campaignQuestion->use_of_money), false) !!}
                </div>
            </div>
        </div>
           
        <!-- 
        <div class="pt-6 pb-10 sm:pb-5 flex flex-col-reverse sm:flex-col sm:block border-b">
            <div @click="$dispatch('img-modal', {  imgModalSrc: '{{URL::to('/').$this->campaign->campaignQuestion->about_organizer_url}}', imgModalDesc: '' })" class="flex justify-center sm:block">
                @if($this->campaign->campaignQuestion->about_organizer_url)
                    <img class="h-auto w-80 mt-3 sm:mt-0 sm:mr-4 rounded cursor-pointer" src="{{URL::to('/').$this->campaign->campaignQuestion->about_organizer_url}}" 
                    hspace="2" vspace="2" style="float: left;" />
                @endif
            </div>
            <div>
                <div class="mb-5 font-bold py-1 text-lg">
                    {{__('About the organizer')}}
                </div>
                <div class="text-justify">
                    {!! nl2br(e($this->campaign->campaignQuestion->about_organizer), false) !!}
                </div>
            </div>
        </div>
        -->
        <!-- -->
        <div class="pt-6 pb-10 sm:pb-5 flex flex-col-reverse sm:flex-col sm:block border-b">
           <div @click="$dispatch('img-modal', {  imgModalSrc: '{{URL::to('/').$this->campaign->campaignQuestion->delivery_of_rewards_url}}', imgModalDesc: '' })" class="flex justify-center sm:block">
                @if($this->campaign->campaignQuestion->delivery_of_rewards_url)
                    <img class="h-auto w-80 mt-3 sm:mt-0 sm:mr-4 rounded cursor-pointer" src="{{URL::to('/').$this->campaign->campaignQuestion->delivery_of_rewards_url}}" 
                    hspace="2" vspace="2" style="float: left;" />
                @endif
           </div>
            <div class="">
                <div class=" mb-5 font-bold py-1 text-lg">
                    {{__('How and when are the rewards delivered?')}}
                </div>
                <div class="text-justify">
                    {!! nl2br(e($this->campaign->campaignQuestion->delivery_of_rewards), false) !!}
                </div>
            </div>
        </div>
        <!-- -->
        @if($this->campaign->campaignQuestion->question_title_add)
            <div class="pt-6 pb-10 sm:pb-5 flex flex-col-reverse sm:flex-col sm:block border-b">
               <div @click="$dispatch('img-modal', {  imgModalSrc: '{{URL::to('/').$this->campaign->campaignQuestion->question_url_add}}', imgModalDesc: '' })" class="flex justify-center sm:block">
                    @if($this->campaign->campaignQuestion->question_url_add)
                        <img class="h-auto w-80 mt-3 sm:mt-0 sm:mr-4 rounded cursor-pointer" src="{{ URL::to('/').$this->campaign->campaignQuestion->question_url_add}}" 
                        hspace="2" vspace="2" style="float: left;" />
                    @endif
               </div>
                <div>
                    <div class="mb-5 font-bold py-1 text-lg">
                        {!! nl2br(e($this->campaign->campaignQuestion->question_title_add), false) !!}
                    </div>
                    <div class="">
                        <div class="text-justify">
                            {!! nl2br(e($this->campaign->campaignQuestion->question_body_add), false) !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- -->
        <div class="pt-6 pb-5 flex flex-col-reverse sm:flex-col sm:block">
           <div @click="$dispatch('img-modal', {  imgModalSrc: '{{URL::to('/').$this->campaign->campaignQuestion->contact_organizer_url}}', imgModalDesc: '' })" class="flex justify-center sm:block">
                @if($this->campaign->campaignQuestion->contact_organizer_url)
                    <img class="h-auto w-80 mt-3 sm:mt-0 sm:mr-4 rounded cursor-pointer" src="{{ URL::to('/').$this->campaign->campaignQuestion->contact_organizer_url}}" 
                    hspace="2" vspace="2" style="float: left;" />
                @endif
           </div>
            <div class="">
                <div class="mb-5 font-bold py-1 text-lg">
                    {{__('Contact details')}}
                </div>
                <div class="text-justify">
                    {!! nl2br(e($this->campaign->campaignQuestion->contact_organizer), false) !!}
                </div>
            </div>
        </div>
    </div>

  </div>