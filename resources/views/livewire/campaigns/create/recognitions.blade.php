<x-slot name="title">
    {{__('Recognitions ')}} : YoSolidario
</x-slot>
<x-slot  name="seo">

</x-slot>

<x-section-content>
    <x-slot name="header">
        <header class="bg-white shadow pt-2 mb-10"> 
            <div class="sm:flex justify-between items-start max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-6 space-y-2">
                <h2 class="flex items-center font-semibold text-xl text-gray-800 leading-tight pt-4">
                    <a class="underline hover:text-gray-900" href="{{ route('campaign/update', $this->slug_next) }}">
                        {{ __('Details') }}
                    </a>
                    <span class="ml-1 mr-1">/</span>
                    <a class="underline hover:text-gray-900" href="{{ route('campaign/update/questions', $this->slug_next) }}">
                        {{ __('Questions') }}
                    </a>
                    <span class="ml-1 mr-1">/</span>
                    {{ __('Recognitions') }}
                </h2>
                
                @if ($this->status_register == 'COMPLETE')
                <div class="flex items-center leading-tight space-x-2">
                    <x-button wire:click="reviewConfirm" wire:loading.attr="disabled">
                        {{ __('Send to review') }}
                    </x-button>
                    <x-secondary-button wire:click="preview({{$this->campaign_id}})" wire:loading.attr="disabled">
                        {{ __('Preview') }}
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
                    {{ __('Add recognition') }}
                </x-button>
            </x-slot>
            <x-slot name="description">
                <span class="text-base">
                    {{__('Recognitions are the amounts that you suggest to your donor community and that will help them measure the impact of their contribution. Get inspired by the default recognitions and feel free to edit them according to your needs and if you need to add more.')}}
                </span>
            </x-slot>
        </x-section-title>

        <div class="flex flex-wrap sm:-m-4 pt-20 sm:pt-18">
            @foreach ($collection as $item)
            <div class="md:w-1/3 md:mb-6 mb-6 flex flex-col justify-center items-center max-w-sm mx-auto pb-10">
                <!--
                <div class="bg-gray-300 h-56 w-full rounded-lg shadow-md bg-cover bg-center" 
                    style="background-image: url()">
                </div>
                -->
                <div class=" w-full bg-white -mt-10 shadow-lg rounded-lg overflow-hidden p-5">
                
                    <div class="title-post font-semibold text-xl">{{$item->amount}} {{$item->campaign->country->currency_symbol}}</div>
              
                    <!-- collaboratos -->
                    <div class="header-content inline-flex ">
                      <div class="category-title flex-1 text-sm">0 {{__('Collaborators')}}</div>
                    </div>
                    <!-- description -->
                    <div class="summary-post text-base text-justify mt-4">
                        {{$item->description}}
                    </div>
                    <!-- options -->
                    <hr class="mt-2 mb-5">
                    <div class="flex justify-between items-start mt-5 sm:mt-0">
                      <x-button wire:click="editDialog({{$item->id}})" wire:loading.attr="disabled">
                          {{ __('Edit') }}
                      </x-button>
                      <x-danger-button wire:click="deleteDialog({{$item->id}})" wire:loading.attr="disabled">
                          {{ __('Delete') }}
                      </x-danger-button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
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
                <x-danger-button class="ml-2" wire:click="delete({{ $this->reward_id }})" wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
        <!-- Store or Update Modal -->
        <x-dialog-modal wire:model="addOrUpdateDialog">
            <x-slot name="title">
                @if ($this->campaign_reward_id > 0)
                    {{ __('Update recognition') }}
                @else
                    {{ __('New recognition') }}
                @endif
            </x-slot>
                <x-slot name="content">
                    <!-- amount -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="amount" class="text-base" value="{{ __('Amount') }} ({{__('required')}})" />
                        <div class="flex">
                            <x-jet-input id="amount" type="number" class="mt-1 block w-50" wire:model.defer="amount"  autocomplete="off"  minlength="3" maxlength="8"/>
                            <x-jet-input id="amount" disabled type="text" class="mt-1 ml-1 block w-16" placeholder="{{$this->recognition_currency_symbol}}" autocomplete="off"/>
                        </div>
                        <x-input-error for="amount" class="mt-2" />
                    </div>
                    <!-- description -->
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-jet-label for="description" class="text-base" value="{{ __('Description') }} ({{__('required')}})" />
                        <x-textarea id="description" class="mt-1 block w-full" wire:model.defer="description" autocomplete="off"/>
                        <x-jet-input-error for="description" class="mt-2" />
                    </div>
                     <!-- delivery_date -->
                     <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-jet-label for="delivery_date" class="text-base" value="{{ __('Estimated delivery date ( dd / mm / yyyy)') }}" />
                        <x-jet-input id="delivery_date" type="date" class="mt-1 block w-50" wire:model.defer="delivery_date" autocomplete="off" />
                        <x-jet-input-error for="delivery_date" class="mt-2" />
                    </div>
                    <!-- limiter -->
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-label for="limiter" class="text-base" value="{{ __('Limit quantity?') }}" />
                        <div class="flex">
                            <x-select class="block w-36" id="limiter" wire:model="limiter">
                                <x-slot name="option">
                                    <option value="" >{{ __('Chosse') }} </option>
                                    <option value="NO" >{{ __('No') }} </option> <!--selected -->
                                    <option value="YES">{{ __('Yes') }} </option>
                                </x-slot>
                            </x-select>
                            @if ($limiter == 'YES')
                                <x-jet-input id="quantity" type="number" class="ml-2 block w-50" wire:model.defer="quantity" placeholder="{{ __('quantity') }}" autocomplete="off" />
                            @endif
                        </div>
                        <x-input-error for="limiter" class="mt-2" />
                        <x-jet-input-error for="quantity" class="mt-2" />
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
        <x-dialog-modal wire:model="confirmingSendReview">
            <x-slot name="title">
                {{ __('Send for review?') }}
            </x-slot>
            <x-slot name="content">
                <div class="summary-post text-base text-justify mt-4">
                    {{ __('Your campaign will be sent for review, we will contact you in less than 48 hours and your campaign will be published.') }}
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingSendReview')" wire:loading.attr="disabled">
                    {{ __('Nevermind') }}
                </x-secondary-button>
                <x-button class="ml-2" wire:click="sendReview" wire:loading.attr="disabled">
                    {{ __('Send') }}
                </x-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-section-content>
<livewire:footer/>