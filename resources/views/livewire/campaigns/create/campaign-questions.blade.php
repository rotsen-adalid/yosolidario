<x-slot name="title">
    {{__('Questions ')}} : YoSolidario
</x-slot>
<x-slot  name="seo">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@iconscout/unicons@3.0.6/css/line.css">
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
                        {{ __('Questions') }}
                    <span class="ml-1 mr-1">/</span>
                    <a class="underline hover:text-gray-900" href="{{ route('campaign/update/rewards',  $this->campaign) }}">
                        {{ __('Rewards') }}
                    </a>
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
    <x-slot  name="content">
        <x-form-section-multiple submit="StoreOrUpdate">
        <x-slot name="form">
        <!-- One -->
        <x-input-section>
            <x-slot name="title">
                {{ __('What is it about?') }}
            </x-slot>
        
            <x-slot name="description">
                <div class="sm:pt-3">
                    {{ __('Describe in detail the objective of your collection, present the problem you want to address and why it is important to solve it. Do not forget to add an image to accompany the text, it is MANDATORY.') }}
                </div>
            </x-slot>
            <x-slot name="form">
                 <!-- about -->
                 <div class="col-span-6 sm:col-span-6">
                    <x-jet-label for="about" value="{{ __('What is it about?') }}" />
                    <x-textarea id="about" class="mt-1 block w-full h-48 sm:h-44" wire:model.defer="about" autofocus autocomplete="off"/>
                    <x-jet-input-error for="about" class="mt-2"/>
                </div>
                <!-- Photo -->
                <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
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

                    <x-jet-label for="photoOne" value="{{ __('Image') }}" />
                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="!photoPreview">
                        @if( $this->about_url)
                        <x-icon-button wire:click="deleteOne" class="absolute m-1 opacity-70">
                            <i class="uil uil-trash text-base"></i>
                        </x-icon-button>
                            <img src="{{ URL::to('/') }}{{$this->about_url}}" alt="" class="rounded-sm h-60 sm:h-72 w-full object-cover">
                        @else 
                            <img src="{{asset('images/photo_upload.png')}}" alt="" class="rounded-sm h-60 sm:h-72 w-full object-cover">
                        @endif
                    </div>

                    <!-- Image Preview -->
                    <div class="mt-2" x-show="photoPreview">
                        @if($this->photoOne)
                            <span class="block rounded-sm w-full h-60 sm:h-72"
                                x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                <x-icon-button wire:click="deleteOne" class="m-1 opacity-70">
                                    <i class="uil uil-trash text-base"></i>
                                </x-icon-button>
                            </span>
                        @else 
                            <img src="{{asset('images/photo_upload.png')}}" alt="" class="rounded-sm h-60 sm:h-72 w-full object-cover">
                        @endif
                    </div>
                    <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A Image') }}
                    </x-jet-secondary-button>
                    
                    <x-jet-input-error for="photoOne" class="mt-2" />
                </div>
            </x-slot>
        </x-input-section>
        <x-jet-section-border />
        <!-- Two -->
        <x-input-section class="mt-10 sm:mt-0">
            <x-slot name="title">
                {{ __('How will I use the money?') }}
            </x-slot>
        
            <x-slot name="description">
                <div class="sm:pt-3">
                    {{ __('Explica puntualmente cómo vas a utilizar los fondos recaudados y cómo vas a distribuir tu presupuesto.') }}
                </div>
            </x-slot>
            <x-slot name="form">
                <!-- use_of_money -->
                <div class="col-span-6 sm:col-span-6">
                    <x-jet-label for="use_of_money" value="{{ __('How will I use the money?') }}" />
                    <x-textarea id="use_of_money" class="mt-1 block w-full h-48 sm:h-44" wire:model.defer="use_of_money" autocomplete="off"/>
                    <x-jet-input-error for="use_of_money" class="mt-2" />
                </div>
                <!-- Photo -->
                <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden" accept="image/*"
                        wire:model="photoTwo"
                        x-ref="photo"
                        x-on:change="
                                photoName = $refs.photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.photo.files[0]);
                        " />

                    <x-jet-label for="photoTwo" value="{{ __('Image') }}" />
                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="!photoPreview">
                        @if( $this->use_of_money_url)
                        <x-icon-button wire:click="deleteTwo" class="absolute m-1 opacity-70">
                            <i class="uil uil-trash text-base"></i>
                        </x-icon-button>
                            <img src="{{ URL::to('/') }}{{$this->use_of_money_url}}" alt="" class="rounded-sm h-60 sm:h-72 w-full object-cover">
                        @else 
                            <img src="{{asset('images/photo_upload.png')}}" alt="" class="rounded-sm h-60 sm:h-72 w-full object-cover">
                        @endif
                    </div>

                    <!-- Image Preview -->
                    <div class="mt-2" x-show="photoPreview">
                        @if($this->photoTwo)
                            <span class="block rounded-sm h-60 sm:h-72 w-full"
                                x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                <x-icon-button wire:click="deleteTwo" class="m-1 opacity-70">
                                    <i class="uil uil-trash text-base"></i>
                                </x-icon-button>
                            </span>
                        @else 
                            <img src="{{asset('images/photo_upload.png')}}" alt="" class="rounded-sm h-60 sm:h-72 w-full object-cover">
                        @endif
                    </div>
                    <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A Image') }}
                    </x-jet-secondary-button>
                    
                    <x-jet-input-error for="photoTwo" class="mt-2" />
                </div>
            </x-slot>
        </x-input-section>
        <x-jet-section-border />
        <!-- three -->
        <x-input-section class="mt-10 sm:mt-0">
            <x-slot name="title">
                {{ __('About the organizer') }}
            </x-slot>

            <x-slot name="description">
                <div class="sm:pt-3">
                    {{ __('Introduce yourself, tell a little about yourself and / or your team. Do not forget to add an image to present yourself, it is MANDATORY.') }}
                </div>
            </x-slot>
            <x-slot name="form">
                <!-- about_organizer -->
                <div class="col-span-6 sm:col-span-6">
                    <x-jet-label for="about_organizer" value="{{ __('About the organizer') }}" />
                    <x-textarea id="about_organizer" class="mt-1 block w-full h-48 sm:h-36" wire:model.defer="about_organizer" autocomplete="off"/>
                    <x-jet-input-error for="about_organizer" class="mt-2"/>
                </div>
                <!-- Photo -->
                <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden" accept="image/*"
                        wire:model="photoThree"
                        x-ref="photo"
                        x-on:change="
                                photoName = $refs.photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.photo.files[0]);
                        " />

                    <x-jet-label for="photoThree" value="{{ __('Image') }}" />
                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="!photoPreview">
                        @if( $this->about_organizer_url)
                        <x-icon-button wire:click="deleteThree" class="absolute m-1 opacity-70">
                            <i class="uil uil-trash text-base"></i>
                        </x-icon-button>
                            <img src="{{ URL::to('/') }}{{$this->about_organizer_url}}" alt="" class="rounded-sm h-60 sm:h-72 w-full object-cover">
                        @else 
                            <img src="{{asset('images/photo_upload.png')}}" alt="" class="rounded-sm h-60 sm:h-72 w-full object-cover">
                        @endif
                    </div>

                    <!-- Image Preview -->
                    <div class="mt-2" x-show="photoPreview">
                        @if($this->photoThree)
                            <span class="block rounded-sm w-full h-60 sm:h-72"
                                x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                <x-icon-button wire:click="deleteThree" class="m-1 opacity-70">
                                    <i class="uil uil-trash text-base"></i>
                                </x-icon-button>
                            </span>
                        @else 
                            <img src="{{asset('images/photo_upload.png')}}" alt="" class="rounded-sm h-60 sm:h-72 w-full object-cover">
                        @endif
                    </div>
                    <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A Image') }}
                    </x-jet-secondary-button>
                    
                    <x-jet-input-error for="photoThree" class="mt-2" />
                </div>
            </x-slot>
        </x-input-section>
        <x-jet-section-border />
        <!-- four -->
        <x-input-section class="mt-10 sm:mt-0">
            <x-slot name="title">
                {{ __('How and when are the rewards delivered?') }}
            </x-slot>
        
            <x-slot name="description">
                <div class="sm:pt-3">
                    {{ __('The rewards that you will offer to your collaborators can be material or digital. We suggest you mention if the delivery, in case they are material, will have a shipping cost. ') }}
                </div>
            </x-slot>
            <x-slot name="form">
               <!-- delivery_of_rewards -->
               <div class="col-span-6 sm:col-span-6">
                    <x-jet-label for="delivery_of_rewards" value="{{ __('How and when are the rewards delivered?') }}" />
                    <x-textarea id="delivery_of_rewards" class="mt-1 block w-full h-36 sm:h-36" wire:model.defer="delivery_of_rewards" autocomplete="off"/>
                    <x-jet-input-error for="delivery_of_rewards" class="mt-2" />
                </div>
                <!-- Photo -->
                <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden" accept="image/*"
                        wire:model="photoFour"
                        x-ref="photo"
                        x-on:change="
                                photoName = $refs.photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.photo.files[0]);
                        " />

                    <x-jet-label for="photoFour" value="{{ __('Image') }}" />
                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="!photoPreview">
                        @if( $this->delivery_of_rewards_url)
                        <x-icon-button wire:click="deleteFour" class="absolute m-1 opacity-70">
                            <i class="uil uil-trash text-base"></i>
                        </x-icon-button>
                            <img src="{{ URL::to('/') }}{{$this->delivery_of_rewards_url}}" alt="" class="rounded-sm h-60 sm:h-72 w-full object-cover">
                        @else 
                            <img src="{{asset('images/photo_upload.png')}}" alt="" class="rounded-sm h-60 sm:h-72 w-full object-cover">
                        @endif
                    </div>

                    <!-- Image Preview -->
                    <div class="mt-2" x-show="photoPreview">
                        @if($this->photoFour)
                            <span class="block rounded-sm w-full h-60 sm:h-726"
                                x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                <x-icon-button wire:click="deleteFour" class="m-1 opacity-70">
                                    <i class="uil uil-trash text-base"></i>
                                </x-icon-button>
                            </span>
                        @else 
                            <img src="{{asset('images/photo_upload.png')}}" alt="" class="rounded-sm h-60 sm:h-72 w-full object-cover">
                        @endif
                    </div>
                    <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A Image') }}
                    </x-jet-secondary-button>
                    
                    <x-jet-input-error for="photoFour" class="mt-2" />
                </div>
            </x-slot>
        </x-input-section>
        <x-jet-section-border />
        <!-- five -->
        <x-input-section class="mt-10 sm:mt-0">
            <x-slot name="title">
                {{ __('Organizers contact details') }}
            </x-slot>
        
            <x-slot name="description">
                <div class="sm:pt-3">
                    {{ __('TAdd your name, email and phone where they can reach you') }}
                </div>
            </x-slot>
            <x-slot name="form">
                <!-- contact_organizer -->
                <div class="col-span-6 sm:col-span-6">
                    <x-jet-label for="contact_organizer" value="{{ __('Organizers contact details') }}" />
                    <x-textarea id="contact_organizer" class="mt-1 block w-full h-36 sm:h-36" wire:model.defer="contact_organizer" autocomplete="off"/>
                    <x-jet-input-error for="contact_organizer" class="mt-2" />
                </div>
                <!-- Photo -->
                <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden" accept="image/*"
                        wire:model="photoFive"
                        x-ref="photo"
                        x-on:change="
                                photoName = $refs.photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.photo.files[0]);
                        " />

                    <x-jet-label for="photoFive" value="{{ __('Image') }}" />
                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="!photoPreview">
                        @if( $this->contact_organizer_url)
                        <x-icon-button wire:click="deleteFive" class="absolute m-1 opacity-70">
                            <i class="uil uil-trash text-base"></i>
                        </x-icon-button>
                            <img src="{{ URL::to('/') }}{{$this->contact_organizer_url}}" alt="" class="rounded-smh-60 sm:h-72 w-full object-cover">
                        @else 
                            <img src="{{asset('images/photo_upload.png')}}" alt="" class="rounded-sm h-60 sm:h-72 w-full object-cover">
                        @endif
                    </div>

                    <!-- Image Preview -->
                    <div class="mt-2" x-show="photoPreview">
                        @if($this->photoFive)
                            <span class="block rounded-sm w-full h-60 sm:h-72"
                                x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                <x-icon-button wire:click="deleteFive" class="m-1 opacity-70">
                                    <i class="uil uil-trash text-base"></i>
                                </x-icon-button>
                            </span>
                        @else 
                            <img src="{{asset('images/photo_upload.png')}}" alt="" class="rounded-sm h-60 sm:h-72 w-full object-cover">
                        @endif
                    </div>
                    <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A Image') }}
                    </x-jet-secondary-button>
                    
                    <x-jet-input-error for="photoFive" class="mt-2" />
                </div>
            </x-slot>
        </x-input-section>
        <x-jet-section-border />
        <!-- six -->
        <x-input-section class="mt-10 sm:mt-0">
            <x-slot name="title">
                {{ __('Add your question') }} ({{ __('optional') }})
            </x-slot>
        
            <x-slot name="description">
                <div class="sm:pt-3">
                    {{ __(' ') }}
                </div>
            </x-slot>
            <x-slot name="form">
                <!-- Title -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="question_title_add" value="{{ __('Question title') }} ({{ __('optional') }})" />
                    <x-jet-input id="question_title_add" type="text" class="mt-1 block w-full" wire:model.defer="question_title_add" autocomplete="off" />
                    <x-jet-input-error for="question_title_add" class="mt-2" />
                </div>
                <!-- Body -->
                <div class="col-span-6 sm:col-span-6">
                    <x-jet-label for="question_body_add" value="{{ __('Answer to the question') }} ({{ __('optional') }})" />
                    <x-textarea id="question_body_add" class="mt-1 block w-full h-36 sm:h-36" wire:model.defer="question_body_add" autocomplete="off"/>
                    <x-jet-input-error for="question_body_add" class="mt-2" />
                </div>
                <!-- Photo -->
                <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden" accept="image/*"
                        wire:model="photoSix"
                        x-ref="photo"
                        x-on:change="
                                photoName = $refs.photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.photo.files[0]);
                        " />

                    <x-jet-label for="photoSix" value="{{ __('Image') }} ({{ __('optional') }})" />
                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="!photoPreview">
                        @if( $this->question_url_add)
                        <x-icon-button wire:click="deleteSix" class="absolute m-1 opacity-70">
                            <i class="uil uil-trash text-base"></i>
                        </x-icon-button>
                            <img src="{{ URL::to('/') }}{{$this->question_url_add}}" alt="" class="rounded-sm h-60 sm:h-72 w-full object-cover">
                        @else 
                            <img src="{{asset('images/photo_upload.png')}}" alt="" class="rounded-sm h-60 sm:h-72 w-full object-cover">
                        @endif
                    </div>

                    <!-- Image Preview -->
                    <div class="mt-2" x-show="photoPreview">
                        @if($this->photoSix)
                            <span class="block rounded-sm w-full h-60 sm:h-72"
                                x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                <x-icon-button wire:click="deleteSix" class="m-1 opacity-70">
                                    <i class="uil uil-trash text-base"></i>
                                </x-icon-button>
                            </span>
                        @else 
                            <img src="{{asset('images/photo_upload.png')}}" alt="" class="rounded-sm h-60 sm:h-72 w-full object-cover">
                        @endif
                    </div>
                    <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A Image') }}
                    </x-jet-secondary-button>
                    
                    <x-jet-input-error for="photoSix" class="mt-2" />
                </div>
            </x-slot>
        </x-input-section>
        </x-slot>
        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="message">
                {{ __($this->message) }}
            </x-jet-action-message>
            <x-button wire:loading.attr="disabled">
                <span class="py-1 px-1"> {{ __('next') }}</span>
            </x-button>
        </x-slot>
        </x-form-section-multiple>
         <!-- Send to review Modal -->
        @include('livewire.campaigns.create.send-to-review')
    </x-slot>
</x-section-content>
</div>
<livewire:footer/>