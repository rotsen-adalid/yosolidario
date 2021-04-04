<x-slot name="title">
    {{__('Updates')}} : YoSolidario
</x-slot>
<x-slot  name="seo">

</x-slot>
<x-slot  name="menu">
    <livewire:menu.navigation-panel/>
</x-slot>
<div class="mt-20 bg-white">
<x-section-content>
    <x-slot name="header">
        <div class="hidden lg:flex lg:items-center">
            <livewire:campaigns.manage.menu.menu-header :campaign="$campaign"/>
        </div>
        <!-- Responsive -->
        <div class="lg:hidden px-4 ">
            <div class="border-b border-gray-200 py-5">
                <a  href="{{ route('your/campaigns') }}" class="cursor-pointer my-4  py-1 px-2 flex space-x-1 w-24">
                    <span class="material-icons-outlined text-sm">arrow_back_ios</span>
                </a>
                <div class="flex items-center justify-center text-2xl font-bold -mt-12">{{__('Updates')}}</div>
            </div>
        </div>
    </x-slot>
    <x-slot  name="content">
        @include('livewire.campaigns.manage.updates.modal-updates')
        @if ($collection->count() > 0)
        <x-section-title>
            <x-slot name="title">
                @livewire('campaigns.manage.updates.register-updates', ['campaign' => $campaign, 'campaign_update_id' => null, 'button' => 2])
            </x-slot>
            <x-slot name="description">
            </x-slot>
        </x-section-title>
        @endif
        <div x-data="{ imgModalUpdates : false, imgModalSrcUpdates : '', imgModalDescUpdates : '' }">
            <template @imgu-modal.window="imgModalUpdates = true; imgModalSrcUpdates = $event.detail.imgModalSrcUpdates; imgModalDescUpdates = $event.detail.imgModalDescUpdates;" x-if="imgModalUpdates">
              <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" x-on:click.away="imgModalSrcUpdates = ''" class="p-2 fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center bg-black bg-opacity-75">
                <div @click.away="imgModalUpdates = ''" class="flex flex-col max-w-3xl max-h-full overflow-auto">
                  <div class="z-50">
                    <button @click="imgModalUpdates = ''" class="float-right pt-2 pr-2 outline-none focus:outline-none">
                        <i class=" text-white uil uil-times-circle text-3xl"></i>
                    </button>
                  </div>
                  <div class="p-2">
                    <img :alt="imgModalSrcUpdates" class="object-contain h-1/2-screen" :src="imgModalSrcUpdates">
                    <p x-text="imgModalDescUpdates" class="text-center text-white"></p>
                  </div>
                </div>
              </div>
            </template>
        </div>
    
        @if ($collection->count() > 0)
        <div x-data="{}">
        @php ($i = $collection->count())
        
        <div class="relative mt-8"> <!-- w-1/2 -->
            <div class="border-r-2 border-green-500 absolute h-full top-0" style="left: 15px"></div>
            <ul class="list-none m-0 p-0">
            @foreach ($collection as $item)
                <li class="mb-2 ">
                    <div class="flex mb-1">
                        <div class="z-20 ">
                            <div class="flex items-center bg-green-500 rounded-full h-8 w-8">
                                <span class="mx-auto font-semibold text-lg text-white">{{$i}}</span>
                            </div>
                        </div>
                        <div class="ml-2 sm:ml-12 bg-white border rounded-lg shadow px-2 py-2 sm:px-4 sm:py-4">
                            <div class=" space-y-2 sm:space-y-0 sm:flex justify-between">
                                <div class="flex-1 font-medium">
                                    <span class="capitalize font-bold text-gray-800">
                                        {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                    </span>
                                    <span class="font-bold text-gray-800"> - </span>
                                    <span class="mb-3 font-bold text-gray-800 text-lg">
                                        {{$item->title}}
                                    </span>
                                </div>
                                <div class="flex space-x-2">
                                    @livewire('campaigns.manage.updates.register-updates', ['campaign' => $campaign, 'campaign_update_id' => $item->id, 'button' => 3])
                                    @livewire('campaigns.manage.updates.delete-updates',  ['campaign_update_id' => $item->id, 'agency_id' => $this->campaign->agency->id])
                                </div>
                            </div>
                            @if ($item->video)
                                <div class="flex justify-center items-center mt-5">
                                    <iframe class=" h-40 w-full sm:h-96 sm:w-3/4" src="https://www.youtube.com/embed/{{$this->urlVideo($item->video->url)}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div> 
                            @endif
                            <div class="mt-4 pb-10 sm:pb-5 flex flex-col-reverse sm:flex-col sm:block">
                                @if ($item->image)
                                    <div @click="$dispatch('imgu-modal', {  imgModalSrcUpdates: '{{URL::to('/').$item->image->url}}', imgModalDescUpdates: '' })" class="flex justify-center sm:block">
                                        @if ($item->image->url)
                                            <img class="h-auto w-64 mt-3 sm:mt-0 sm:mr-4 rounded cursor-pointer" src="{{URL::to('/').$item->image->url}}" 
                                            hspace="2" vspace="2" style="float: left;" />
                                        @endif
                                    </div>
                                @endif
                                <div>
                                    <div class="text-justify text-base">
                                    {!! nl2br(e($item->body), false) !!}
                                    </div>
                                </div>
                             </div>
    
                        </div>
                    </div>
                </li>
            @php ($i--)
            @endforeach
            </ul>
        </div>
        </div>
        @else
            <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
                <div class="max-w-md w-full space-y-8">
                <div> 
                    <h2 class="mt-4 text-center text-lg font-bold">
                        {{ __('You haven’t posted an update yet.') }}
                    </h2>
                    <h2 class="mt-2 text-center font-light">
                        {{ __('Keep your supporters up-to-date on your fundraisers!') }}
                    </h2>
                    @livewire('campaigns.manage.updates.register-updates', ['campaign' => $campaign, 'campaign_update_id' => null, 'button' => 1])
                </div>
                </div>
            </div>
        @endif
    </x-slot>
</x-section-content>
</div>
<livewire:footer.footer-app/>

  