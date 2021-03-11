<x-slot name="title">
    {{__('Recognitions ')}} : YoSolidario
</x-slot>
<x-slot  name="seo">

</x-slot>
<x-slot  name="menu">
    @livewire('navigation')
</x-slot>
<div class="bg-gray-50">
<x-section-content>
    <x-slot name="header">
        <header class="bg-white shadow pt-2 mb-10"> 
            <div class="sm:flex justify-between items-start max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-6 space-y-2">
                <h2 class="flex items-center font-semibold text-xl text-gray-800 leading-tight pt-4">
                    <a class="underline hover:text-gray-900" href="{{ route('campaign/update', $this->campaign) }}">
                        {{ __('Details') }}
                    </a>
                    <span class="ml-1 mr-1">/</span>
                    <a class="underline hover:text-gray-900" href="{{ route('campaign/update/questions', $this->campaign) }}">
                        {{ __('Questions') }}
                    </a>
                    <span class="ml-1 mr-1">/</span>
                    {{ __('Rewards') }}
                </h2>
                
                @if ($this->status_register == 'COMPLETE')
                <div class="flex items-center leading-tight space-x-2">
                    <x-button wire:click="reviewConfirm" wire:loading.attr="disabled">
                         <span class="uppercase">{{ __('Publish campaign') }}</span>
                    </x-button>
                    <x-secondary-button wire:click="preview({{$this->campaign_id}})" wire:loading.attr="disabled">
                        <span class="uppercase">{{ __('Preview') }}</span>
                    </x-secondary-button>
                </div>
                @endif
    
            </div>
        </header>
    </x-slot>
    <x-slot  name="content" >
        <x-section-title>
            <x-slot name="title">
                <x-button wire:click="addDialog" wire:loading.attr="disabled">
                    <i class="uil uil-plus text-base"></i>
                    <span class="py-1 px-1  text-base"> 
                        {{ __('Add reward') }}
                    </span>
                </x-button>
            </x-slot>
            <x-slot name="description">
                <span class="text-sm sm:text-base">
                    {{__('Rewards are the amounts that you suggest to your donor community and that will help them measure the impact of their contribution. Get inspired by the default recognitions and feel free to edit them according to your needs and if you need to add more.')}}
                </span>
            </x-slot>
        </x-section-title>
        @if ($collection->count() > 0)
            
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mt-7">
            @foreach ($collection as $item)
            <div class="px-4 sm:px-0 @if($collection->count() == 1) sm:col-start-2 @endif">
            
                @if($item->image_url)
                    <div class="cursor-pointer bg-gray-300 h-56 w-full rounded-lg shadow-md bg-cover bg-center" 
                        style="background-image: url({{ URL::to('/').$item->image_url}})">
                    </div>
                @else
                    <div class="cursor-pointer bg-gray-300 h-56 w-full rounded-lg shadow-md bg-cover bg-center" 
                        style="background-image: url({{asset('images/photo_upload.png')}})">
                    </div>
                @endif
                
                <div class=" w-full bg-white -mt-10 shadow-lg rounded-lg overflow-hidden p-5">
                
                    <div class="title-post font-semibold text-xl">{{$item->amount}} {{$item->campaign->country->currency_symbol}}</div>
              
                    <!-- description -->
                    <div class="summary-post text-base text-justify mt-4">
                        {{$item->description}}
                    </div>
                    <!-- collaboratos -->
                    <div class="header-content inline-flex mt-4">
                        <div class="category-title flex-1 text-sm">
                            @if ($item->limiter == 'YES')
                                <span> 0 / {{$item->quantity}}</span>
                                {{__('Collaborators')}} 
                            @elseif ($item->limiter == 'NO')
                                0 {{__('Collaborators')}} 
                            @endif
                        </div>
                    </div>
                    <!-- delivery_date -->
                    @if ($item->delivery_date)
                        <div class="text-sm text-justify mt-1">
                            {{__('Estimated delivery date')}}
                            <span class="font-semibold">
                                {{ \Carbon\Carbon::parse($item->delivery_date)->toFormattedDateString() }}
                            </span>
                        </div>
                    @endif
                    <!-- options -->
                    <hr class="mt-2 mb-3">
                    <div class="flex justify-between items-start mt-5 sm:mt-0">
                        <i class="uil uil-edit text-xl font-bold cursor-pointer" 
                        wire:click="editDialog({{$item->id}})" wire:loading.attr="disabled"></i>

                        <i class="uil uil-trash text-xl text-red-500 cursor-pointer" 
                        wire:click="deleteDialog({{$item->id}})" wire:loading.attr="disabled"></i>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
          <div> 
            <h2 class="mt-6 text-center text-xl font-light">
                {{ __('Campaign without reward') }}
            </h2>
          </div>
    
        </div>
    </div>
        @endif
        <!-- Delete Confirmation Modal -->
        <x-dialog-modal wire:model="confirmingDeletion">
            <x-slot name="title">
                {{ __('Delete Recognition?') }}
            </x-slot>
            <x-slot name="content">
                <div class="title-post font-semibold text-xl">{{$this->amount}} {{$this->recognition_currency_symbol}}</div>
                <div class="summary-post text-base text-justify mt-4">
                    {{$this->description}}
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingDeletion')" wire:loading.attr="disabled">
                    {{ __('Nevermind') }}
                </x-secondary-button>
                <x-danger-button class="ml-2" wire:click="delete({{ $this->campaign_reward_id }})" wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
        <!-- Store or Update Modal -->
        <x-dialog-modal wire:model="addOrUpdateDialog">
            <x-slot name="title">
              <div class="font-bold">
                @if ($this->campaign_reward_id > 0)
                    {{ __('Update reward') }}
                @else
                    {{ __('New reward') }}
                @endif
              </div>
            </x-slot>
                <x-slot name="content">
                    <!-- amount -->
                    <div class="col-span-6 sm:col-span-4">
                        <div class="sm:flex sm:space-x-2">
                            <div>
                                <x-label for="amount" class="text-base" value="{{ __('Amount') }} ({{__('required')}})" />
                                <div class="flex">
                                    <x-jet-input id="amount" type="number" class="mt-1 block w-50" wire:model.defer="amount"  autocomplete="off"  minlength="3" maxlength="8"/>
                                    <x-jet-input id="amount" disabled type="text" class="mt-1 ml-1 block w-16" placeholder="{{$this->recognition_currency_symbol}}" autocomplete="off"/>
                                </div>
                                <x-input-error for="amount" class="mt-2" />
                            </div>
                            <div class="mt-4 sm:mt-0">
                                <!-- delivery_date -->
                                <x-jet-label for="delivery_date" class="text-base" value="{{ __('Estimated delivery date') }} ({{ __('optional') }})" />
                                <x-jet-input id="delivery_date" type="date" class="mt-1 block w-50" wire:model.defer="delivery_date" autocomplete="off" />
                                <x-jet-input-error for="delivery_date" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <!-- description -->
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-jet-label for="description" class="text-base" value="{{ __('Description') }} ({{__('required')}})" />
                        <x-textarea id="description" class="mt-1 block w-full" wire:model.defer="description" autocomplete="off"/>
                        <x-jet-input-error for="description" class="mt-2" />
                    </div>
                    <!-- limiter -->
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <div class="flex space-x-1">
                            <div class="w-36">
                                <x-label for="limiter" class="text-base" value="{{ __('Limit quantity?') }}" />
                                <x-select class="block w-full" id="limiter" wire:model="limiter">
                                    <x-slot name="option">
                                        <option value="" >{{ __('Chosse') }} </option>
                                        <option value="NO" >{{ __('No') }} </option> <!--selected -->
                                        <option value="YES">{{ __('Yes') }} </option>
                                    </x-slot>
                                </x-select>
                                <x-input-error for="limiter" class="mt-2" />
                            </div>
                            <div class="w-36">
                                @if ($limiter == 'YES')
                                    <x-label for="limiter" class="ml-2 text-base" value="{{ __('Quantity') }}" />
                                    <x-jet-input id="quantity" type="number" class="ml-2 block w-full" wire:model.defer="quantity" placeholder="{{ __('quantity') }}" autocomplete="off" />
                                    <x-jet-input-error for="quantity" class="mt-2" />
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Photo -->
                    <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4 mt-4">
                        <!-- Profile Photo File Input -->
                        <input type="file" class="hidden" accept="image/*"
                            wire:model="photoOne"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                        <x-jet-secondary-button class="mt-2 mr-2 w-60" type="button" x-on:click.prevent="$refs.photo.click()">
                            {{ __('Select A Image') }} ({{ __('optional') }})
                        </x-jet-secondary-button>

                        <!-- Current Profile Photo -->
                        <div class="mt-2" x-show="!photoPreview">
                            @if( $this->image_url)
                            <x-icon-button wire:click="deleteOne" class="absolute m-1 opacity-70">
                                <i class="uil uil-trash text-base"></i>
                            </x-icon-button>
                                <img src="{{ URL::to('/') }}{{$this->image_url}}" alt="" class="rounded-sm h-48 sm:h-full w-56 object-cover">
                            @else 
                                <img src="{{asset('images/photo_upload.png')}}" alt="" class="rounded-sm h-48 sm:h-full w-56 object-cover">
                            @endif
                        </div>
                        <!-- Image Preview -->
                        <div class="mt-2" x-show="photoPreview">
                            @if($this->photoOne)
                                <span class="block rounded-sm h-48 sm:h-full w-56"
                                    x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                    <x-icon-button wire:click="deleteOne" class="m-1 opacity-70">
                                        <i class="uil uil-trash text-base"></i>
                                    </x-icon-button>
                                </span>
                            @else 
                                <img src="{{asset('images/photo_upload.png')}}" alt="" class="rounded-sm h-48 sm:h-full w-56 object-cover">
                            @endif
                        </div>

                        <x-jet-input-error for="photoOne" class="mt-2" />
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <x-secondary-button wire:click="$toggle('addOrUpdateDialog')" wire:loading.attr="disabled">
                        {{ __('Nevermind') }}
                    </x-secondary-button>
                    @if ($this->campaign_reward_id > 0)
                    <x-button class="ml-2" wire:click="StoreOrUpdate" wire:loading.attr="disabled">
                        {{ __('Update') }}
                    </x-button>
                    @else
                    <x-button class="ml-2" wire:click="StoreOrUpdate" wire:loading.attr="disabled">
                        {{ __('Add') }}
                    </x-button>
                    @endif
                </x-slot>
        </x-dialog-modal>
       <!-- Send to review Modal -->
       @include('livewire.campaigns.create.send-to-review')
    </x-slot>
</x-section-content>
</div>
<livewire:footer/>