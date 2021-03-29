<x-slot name="title">
    {{__('Questions ')}} : YoSolidario
</x-slot>
<x-slot  name="seo">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@iconscout/unicons@3.0.6/css/line.css">
</x-slot>
<x-slot  name="menu">
    <livewire:menu.navigation-app/>
</x-slot>
      
<div class="mt-20 bg-gray-50">
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
                    <a class="underline hover:text-gray-900" href="{{ route('campaign/rewards/show',  $this->campaign) }}">
                        {{ __('Rewards') }}
                    </a>
                </h2>
                
                @if ($this->status_register == 'COMPLETE')
                <div class="flex items-center leading-tight space-x-2">
                    <x-button wire:click="reviewConfirm" wire:loading.attr="disabled">
                        <span class="material-icons-outlined pr-1">open_in_new</span>
                        <span class="">{{ __('Publish campaign') }}</span>
                    </x-button>
                    <x-secondary-button wire:click="preview({{$this->campaign_id}})" wire:loading.attr="disabled">
                        <span class="material-icons-outlined pr-1">remove_red_eye</span>
                        <span class="">{{ __('Preview') }}</span>
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
                    {{ __('Explain exactly how you are going to use the funds raised and how you are going to distribute your budget.') }}
                </div>
            </x-slot>
            <x-slot name="form">
                 <!-- about -->
                 <div class="col-span-6 sm:col-span-6">
                    <x-label for="about" value="{{ __('What is it about?') }}" required/>
                    <x-textarea id="about" class="mt-1 block w-full h-48 sm:h-44" wire:model.defer="about" autofocus autocomplete="off"/>
                    <x-input-error for="about" class="mt-2"/>
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

                    <x-label for="photoOne" value="{{ __('Image') }}" />
                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="!photoPreview">
                        @if( $this->about_url)
                            <x-icon-button wire:click="deleteOne" class="absolute m-1 opacity-70">
                                <span class="material-icons-outlined">delete</span>
                            </x-icon-button>
                            <img src="{{ URL::to('/') }}{{$this->about_url}}" alt="" class="rounded-sm h-60 sm:h-72 w-full object-cover">
                        @else 
                            <div class="mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-60 sm:h-64">
                                <div class="space-y-1 text-center">
                                <span class="material-icons-outlined text-5xl text-gray-500">add_a_photo</span>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG up to 2MB
                                </p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Image Preview -->
                    <div class="mt-2" x-show="photoPreview">
                        @if($this->photoOne)
                            <span class="block rounded-sm w-full h-60 sm:h-72"
                                x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                <x-icon-button wire:click="deleteOne" class="m-1 opacity-70">
                                    <span class="material-icons-outlined">delete</span>
                                </x-icon-button>
                            </span>
                        @else 
                            <div class="mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-60 sm:h-64">
                                <div class="space-y-1 text-center">
                                <span class="material-icons-outlined text-5xl text-gray-500">add_a_photo</span>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG up to 2MB
                                </p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A Image') }}
                    </x-secondary-button>
                    
                    <x-input-error for="photoOne" class="mt-2" />
                </div>
            </x-slot>
        </x-input-section>
        <x-section-border />
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
                    <x-label for="use_of_money" value="{{ __('How will I use the money?') }}" required/>
                    <x-textarea id="use_of_money" class="mt-1 block w-full h-48 sm:h-44" wire:model.defer="use_of_money" autocomplete="off"/>
                    <x-input-error for="use_of_money" class="mt-2" />
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

                    <x-label for="photoTwo" value="{{ __('Image') }}" />
                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="!photoPreview">
                        @if( $this->use_of_money_url)
                        <x-icon-button wire:click="deleteTwo" class="absolute m-1 opacity-70">
                            <span class="material-icons-outlined">delete</span>
                        </x-icon-button>
                            <img src="{{ URL::to('/') }}{{$this->use_of_money_url}}" alt="" class="rounded-sm h-60 sm:h-72 w-full object-cover">
                        @else 
                            <div class="mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-60 sm:h-64">
                                <div class="space-y-1 text-center">
                                <span class="material-icons-outlined text-5xl text-gray-500">add_a_photo</span>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG up to 2MB
                                </p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Image Preview -->
                    <div class="mt-2" x-show="photoPreview">
                        @if($this->photoTwo)
                            <span class="block rounded-sm h-60 sm:h-72 w-full"
                                x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                <x-icon-button wire:click="deleteTwo" class="m-1 opacity-70">
                                    <span class="material-icons-outlined">delete</span>
                                </x-icon-button>
                            </span>
                        @else 
                            <div class="mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-60 sm:h-64">
                                <div class="space-y-1 text-center">
                                <span class="material-icons-outlined text-5xl text-gray-500">add_a_photo</span>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG up to 2MB
                                </p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A Image') }}
                    </x-secondary-button>
                    
                    <x-input-error for="photoTwo" class="mt-2" />
                </div>
            </x-slot>
        </x-input-section>
        <x-section-border />
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
                    <x-label for="about_organizer" value="{{ __('About the organizer') }}" required/>
                    <x-textarea id="about_organizer" class="mt-1 block w-full h-48 sm:h-36" wire:model.defer="about_organizer" autocomplete="off"/>
                    <x-input-error for="about_organizer" class="mt-2"/>
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

                    <x-label for="photoThree" value="{{ __('Image') }}" />
                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="!photoPreview">
                        @if( $this->about_organizer_url)
                        <x-icon-button wire:click="deleteThree" class="absolute m-1 opacity-70">
                            <span class="material-icons-outlined">delete</span>
                        </x-icon-button>
                            <img src="{{ URL::to('/') }}{{$this->about_organizer_url}}" alt="" class="rounded-sm h-60 sm:h-72 w-full object-cover">
                        @else 
                            <div class="mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-60 sm:h-64">
                                <div class="space-y-1 text-center">
                                <span class="material-icons-outlined text-5xl text-gray-500">add_a_photo</span>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG up to 2MB
                                </p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Image Preview -->
                    <div class="mt-2" x-show="photoPreview">
                        @if($this->photoThree)
                            <span class="block rounded-sm w-full h-60 sm:h-72"
                                x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                <x-icon-button wire:click="deleteThree" class="m-1 opacity-70">
                                    <span class="material-icons-outlined">delete</span>
                                </x-icon-button>
                            </span>
                        @else 
                            <div class="mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-60 sm:h-64">
                                <div class="space-y-1 text-center">
                                <span class="material-icons-outlined text-5xl text-gray-500">add_a_photo</span>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG up to 2MB
                                </p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A Image') }}
                    </x-secondary-button>
                    
                    <x-input-error for="photoThree" class="mt-2" />
                </div>
            </x-slot>
        </x-input-section>
        <x-section-border />
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
                    <x-label for="delivery_of_rewards" value="{{ __('How and when are the rewards delivered?') }}" required/>
                    <x-textarea id="delivery_of_rewards" class="mt-1 block w-full h-36 sm:h-36" wire:model.defer="delivery_of_rewards" autocomplete="off"/>
                    <x-input-error for="delivery_of_rewards" class="mt-2" />
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

                    <x-label for="photoFour" value="{{ __('Image') }}" />
                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="!photoPreview">
                        @if( $this->delivery_of_rewards_url)
                        <x-icon-button wire:click="deleteFour" class="absolute m-1 opacity-70">
                            <span class="material-icons-outlined">delete</span>
                        </x-icon-button>
                            <img src="{{ URL::to('/') }}{{$this->delivery_of_rewards_url}}" alt="" class="rounded-sm h-60 sm:h-72 w-full object-cover">
                        @else 
                            <div class="mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-60 sm:h-64">
                                <div class="space-y-1 text-center">
                                <span class="material-icons-outlined text-5xl text-gray-500">add_a_photo</span>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG up to 2MB
                                </p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Image Preview -->
                    <div class="mt-2" x-show="photoPreview">
                        @if($this->photoFour)
                            <span class="block rounded-sm w-full h-60 sm:h-726"
                                x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                <x-icon-button wire:click="deleteFour" class="m-1 opacity-70">
                                    <span class="material-icons-outlined">delete</span>
                                </x-icon-button>
                            </span>
                        @else 
                            <div class="mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-60 sm:h-64">
                                <div class="space-y-1 text-center">
                                <span class="material-icons-outlined text-5xl text-gray-500">add_a_photo</span>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG up to 2MB
                                </p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A Image') }}
                    </x-secondary-button>
                    
                    <x-input-error for="photoFour" class="mt-2" />
                </div>
            </x-slot>
        </x-input-section>
        <x-section-border />
        <!-- five -->
        <x-input-section class="mt-10 sm:mt-0">
            <x-slot name="title">
                {{ __('Organizer contact details') }}
            </x-slot>
        
            <x-slot name="description">
                <div class="sm:pt-3">
                    {{ __('Add your name, email and phone where they can reach you') }}
                </div>
            </x-slot>
            <x-slot name="form">
                <!-- contact_organizer -->
                <div class="col-span-6 sm:col-span-6">
                    <x-label for="contact_organizer" value="{{ __('Organizer contact details') }}" required/>
                    <x-textarea id="contact_organizer" class="mt-1 block w-full h-36 sm:h-36" wire:model.defer="contact_organizer" autocomplete="off"/>
                    <x-input-error for="contact_organizer" class="mt-2" />
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

                    <x-label for="photoFive" value="{{ __('Image') }}" />
                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="!photoPreview">
                        @if( $this->contact_organizer_url)
                        <x-icon-button wire:click="deleteFive" class="absolute m-1 opacity-70">
                            <span class="material-icons-outlined">delete</span>
                        </x-icon-button>
                            <img src="{{ URL::to('/') }}{{$this->contact_organizer_url}}" alt="" class="rounded-smh-60 sm:h-72 w-full object-cover">
                        @else 
                            <div class="mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-60 sm:h-64">
                                <div class="space-y-1 text-center">
                                <span class="material-icons-outlined text-5xl text-gray-500">add_a_photo</span>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG up to 2MB
                                </p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Image Preview -->
                    <div class="mt-2" x-show="photoPreview">
                        @if($this->photoFive)
                            <span class="block rounded-sm w-full h-60 sm:h-72"
                                x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                <x-icon-button wire:click="deleteFive" class="m-1 opacity-70">
                                    <span class="material-icons-outlined">delete</span>
                                </x-icon-button>
                            </span>
                        @else 
                            <div class="mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-60 sm:h-64">
                                <div class="space-y-1 text-center">
                                <span class="material-icons-outlined text-5xl text-gray-500">add_a_photo</span>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG up to 2MB
                                </p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A Image') }}
                    </x-secondary-button>
                    
                    <x-input-error for="photoFive" class="mt-2" />
                </div>
            </x-slot>
        </x-input-section>
        <x-section-border />
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
                    <x-label for="question_title_add" value="{{ __('Question title') }} ({{ __('optional') }})" />
                    <x-input id="question_title_add" type="text" class="mt-1 block w-full" wire:model.defer="question_title_add" autocomplete="off" />
                    <x-input-error for="question_title_add" class="mt-2" />
                </div>
                <!-- Body -->
                <div class="col-span-6 sm:col-span-6">
                    <x-label for="question_body_add" value="{{ __('Answer to the question') }} ({{ __('optional') }})" />
                    <x-textarea id="question_body_add" class="mt-1 block w-full h-36 sm:h-36" wire:model.defer="question_body_add" autocomplete="off"/>
                    <x-input-error for="question_body_add" class="mt-2" />
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

                    <x-label for="photoSix" value="{{ __('Image') }} ({{ __('optional') }})" />
                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="!photoPreview">
                        @if( $this->question_url_add)
                        <x-icon-button wire:click="deleteSix" class="absolute m-1 opacity-70">
                            <span class="material-icons-outlined">delete</span>
                        </x-icon-button>
                            <img src="{{ URL::to('/') }}{{$this->question_url_add}}" alt="" class="rounded-sm h-60 sm:h-72 w-full object-cover">
                        @else 
                            <div class="mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-60 sm:h-64">
                                <div class="space-y-1 text-center">
                                <span class="material-icons-outlined text-5xl text-gray-500">add_a_photo</span>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG up to 2MB
                                </p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Image Preview -->
                    <div class="mt-2" x-show="photoPreview">
                        @if($this->photoSix)
                            <span class="block rounded-sm w-full h-60 sm:h-72"
                                x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                <x-icon-button wire:click="deleteSix" class="m-1 opacity-70">
                                    <span class="material-icons-outlined">delete</span>
                                </x-icon-button>
                            </span>
                        @else 
                            <div class="mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-60 sm:h-64">
                                <div class="space-y-1 text-center">
                                <span class="material-icons-outlined text-5xl text-gray-500">add_a_photo</span>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG up to 2MB
                                </p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A Image') }}
                    </x-secondary-button>
                    
                    <x-input-error for="photoSix" class="mt-2" />
                </div>
            </x-slot>
        </x-input-section>
        </x-slot>
        <x-slot name="actions">
            <x-action-message class="mr-3" on="message">
                {{ __($this->message) }}
            </x-action-message>
            <x-button wire:loading.attr="disabled">
                <span class="px-2 font-bold sm:text-base"> {{ __('Next') }}</span>
                <span class="material-icons-outlined ml-1">arrow_forward_ios</span>
            </x-button>
        </x-slot>
        </x-form-section-multiple>
        <!-- Send to review Modal -->
        @include('livewire.campaigns.create.send-to-review')
    </x-slot>
</x-section-content>
</div>
<livewire:footer.footer-app/>