
<x-slot name="title">
    {{__('Questions ')}} : YoSolidario
</x-slot>
<x-slot  name="seo">
    
</x-slot>
<x-slot  name="menu">
    <livewire:menu.navigation-campaign-create :campaign="$campaign"/>
    <livewire:campaigns.create.send-review :campaign="$campaign"/>
</x-slot>
<div class="pt-20 bg-gray-50">
    <div class="max-w-2xl mx-auto px-4 sm:px-2 py-0 sm:py-10">
        <div class="border border-gray-100 my-5 py-10 px-4 sm:px-20 rounded shadow bg-white">
            <div class="text-center font-bold text-2xl">
                {{__('Answer the questions')}}
            </div>
            <form wire:submit.prevent="StoreOrUpdate">
             <!-- about -->
             <div class="mt-6">
                <x-label for="about" class="font-semibold" value="{{ __('What is it about?') }}" required/>
                <x-textarea id="about" class="mt-1 block w-full h-36 sm:h-36" wire:model="about" autofocus autocomplete="off"/>
                <x-input-error for="about" class="mt-2"/>
            </div>
            <!-- Photo -->
            <div x-data="{photoName: null, photoPreview: null}" class="mt-6">
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

                <x-label for="photoOne"  class="font-semibold" value="{{ __('Image') }}" />
                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="!photoPreview">
                    @if( $this->about_url)
                        <x-icon-button wire:click="deleteOne" class="absolute flex justify-center m-1 opacity-70">
                            <span class="material-icons-outlined ">delete</span>
                        </x-icon-button>
                        <img src="{{ URL::to('/') }}{{$this->about_url}}" alt="" class="rounded-sm h-48 sm:h-72 w-full object-cover">
                    @else 
                        <div x-on:click.prevent="$refs.photo.click()" class="cursor-pointer mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-48 sm:h-64">
                            <div class="space-y-1 text-center">
                            <span class="material-icons-outlined text-5xl text-gray-500">add_a_photo</span>
                            <p class="text-xs text-gray-500">
                               {{__('PNG, JPG up to 2MB')}}
                            </p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Image Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-sm w-full h-48 sm:h-72"
                        x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                        <x-icon-button @click="photoPreview = null" class="flex justify-center m-1 opacity-70">
                            <span class="material-icons-outlined">delete</span>
                        </x-icon-button>
                    </span>
                </div>
                
                <x-input-error for="photoOne" class="mt-2" />
            </div>
            <!-- use_of_money -->
            <div class="mt-6">
                <x-label for="use_of_money"  class="font-semibold" value="{{ __('How will I use the money?') }}" required/>
                <x-textarea id="use_of_money" class="mt-1 block w-full h-36 sm:h-36" wire:model="use_of_money" autocomplete="off"/>
                <x-input-error for="use_of_money" class="mt-2" />
            </div>
            <!-- Photo -->
            <div x-data="{photoName: null, photoPreview: null}" class="mt-6">
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

                <x-label for="photoTwo"  class="font-semibold" value="{{ __('Image') }}" />
                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="!photoPreview">
                    @if( $this->use_of_money_url)
                    <x-icon-button wire:click="deleteTwo" class="absolute  flex justify-center m-1 opacity-70">
                        <span class="material-icons-outlined">delete</span>
                    </x-icon-button>
                        <img src="{{ URL::to('/') }}{{$this->use_of_money_url}}" alt="" class="rounded-sm h-48 sm:h-72 w-full object-cover">
                    @else 
                        <div x-on:click.prevent="$refs.photo.click()" class="cursor-pointer mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-48 sm:h-64">
                            <div class="space-y-1 text-center">
                            <span class="material-icons-outlined text-5xl text-gray-500">add_a_photo</span>
                            <p class="text-xs text-gray-500">
                            {{__('PNG, JPG up to 2MB')}}
                            </p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Image Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-sm h-48 sm:h-72 w-full"
                        x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                        <x-icon-button @click="photoPreview = null" class=" flex justify-center m-1 opacity-70">
                            <span class="material-icons-outlined">delete</span>
                        </x-icon-button>
                    </span>
                </div>
                
                <x-input-error for="photoTwo" class="mt-2" />
            </div>

            @if ($this->campaign->type_campaign == 'PERSONAL')
            <!-- about_organizer -->
            <div class="mt-6">
                <x-label for="about_organizer"  class="font-semibold" value="{{ __('About the organizer') }}" required/>
                <x-textarea id="about_organizer" class="mt-1 block w-full h-36 sm:h-36" wire:model="about_organizer" autocomplete="off"/>
                <x-input-error for="about_organizer" class="mt-2"/>
            </div>
            <!-- Photo -->
            <div x-data="{photoName: null, photoPreview: null}" class="mt-6">
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

                <x-label for="photoThree"  class="font-semibold" value="{{ __('Image') }}" />
                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="!photoPreview">
                    @if( $this->about_organizer_url)
                    <x-icon-button wire:click="deleteThree" class=" flex justify-center absolute m-1 opacity-70">
                        <span class="material-icons-outlined">delete</span>
                    </x-icon-button>
                        <img src="{{ URL::to('/') }}{{$this->about_organizer_url}}" alt="" class="rounded-sm h-48 sm:h-72 w-full object-cover">
                    @else 
                        <div x-on:click.prevent="$refs.photo.click()" class="cursor-pointer mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-48 sm:h-64">
                            <div class="space-y-1 text-center">
                            <span class="material-icons-outlined text-5xl text-gray-500">add_a_photo</span>
                            <p class="text-xs text-gray-500">
                            {{__('PNG, JPG up to 2MB')}}
                            </p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Image Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-sm w-full h-48 sm:h-72"
                        x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                        <x-icon-button @click="photoPreview = null" class="flex justify-center m-1 opacity-70">
                            <span class="material-icons-outlined">delete</span>
                        </x-icon-button>
                    </span>
                </div>

                <x-input-error for="photoThree" class="mt-2" />
            </div>
            @endif
            <!-- delivery_of_rewards -->
            <div class="mt-6">
                <x-label for="delivery_of_rewards"  class="font-semibold" value="{{ __('How and when are the rewards delivered?') }}" required/>
                <x-textarea id="delivery_of_rewards" class="mt-1 block w-full h-36 sm:h-36" wire:model="delivery_of_rewards" autocomplete="off"/>
                <x-input-error for="delivery_of_rewards" class="mt-2" />
            </div>
            <!-- Photo -->
            <div x-data="{photoName: null, photoPreview: null}" class="mt-6">
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

                <x-label for="photoFour"  class="font-semibold" value="{{ __('Image') }}" />
                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="!photoPreview">
                    @if( $this->delivery_of_rewards_url)
                    <x-icon-button wire:click="deleteFour" class=" flex justify-center absolute m-1 opacity-70">
                        <span class="material-icons-outlined">delete</span>
                    </x-icon-button>
                        <img src="{{ URL::to('/') }}{{$this->delivery_of_rewards_url}}" alt="" class="rounded-sm h-48 sm:h-72 w-full object-cover">
                    @else 
                        <div x-on:click.prevent="$refs.photo.click()" class="cursor-pointer mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-48 sm:h-64">
                            <div class="space-y-1 text-center">
                            <span class="material-icons-outlined text-5xl text-gray-500">add_a_photo</span>
                            <p class="text-xs text-gray-500">
                            {{__('PNG, JPG up to 2MB')}}
                            </p>
                            </div>
                        </div>
                    @endif
                </div>

                 <!-- Image Preview -->
                 <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-sm w-full h-48 sm:h-72"
                        x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                        <x-icon-button @click="photoPreview = null" class="flex justify-center m-1 opacity-70">
                            <span class="material-icons-outlined">delete</span>
                        </x-icon-button>
                    </span>
                </div>
                
                <x-input-error for="photoFour" class="mt-2" />
            </div>
            <!-- contact_organizer -->
            <div class="mt-6">
                @if ($this->campaign->type_campaign == 'PERSONAL')
                    <x-label for="contact_organizer"  class="font-semibold" value="{{ __('Organizer contact details') }}" required/>
                @elseif ($this->campaign->type_campaign == 'ORGANIZATION')
                    <x-label for="contact_organizer"  class="font-semibold" value="{{ __('Contact details') }}" required/>
                @endif
                <x-textarea id="contact_organizer" class="mt-1 block w-full h-36 sm:h-36" wire:model="contact_organizer" autocomplete="off"/>
                <x-input-error for="contact_organizer" class="mt-2" />
            </div>
            <!-- Photo -->
            <div x-data="{photoName: null, photoPreview: null}" class="mt-6">
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

                <x-label for="photoFive"  class="font-semibold" value="{{ __('Image') }}" />
                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="!photoPreview">
                    @if( $this->contact_organizer_url)
                    <x-icon-button wire:click="deleteFive" class=" flex justify-center absolute m-1 opacity-70">
                        <span class="material-icons-outlined">delete</span>
                    </x-icon-button>
                        <img src="{{ URL::to('/') }}{{$this->contact_organizer_url}}" alt="" class="rounded-smh-60 sm:h-72 w-full object-cover">
                    @else 
                        <div x-on:click.prevent="$refs.photo.click()" class="cursor-pointer mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-48 sm:h-64">
                            <div class="space-y-1 text-center">
                            <span class="material-icons-outlined text-5xl text-gray-500">add_a_photo</span>
                            <p class="text-xs text-gray-500">
                            {{__('PNG, JPG up to 2MB')}}
                            </p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Image Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-sm w-full h-48 sm:h-72"
                        x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                        <x-icon-button @click="photoPreview = null" class="flex justify-center m-1 opacity-70">
                            <span class="material-icons-outlined">delete</span>
                        </x-icon-button>
                    </span>
                </div>
                
                <x-input-error for="photoFive" class="mt-2" />
            </div>
            <!-- Title -->
            <div class="mt-6">
                <x-label for="question_title_add"  class="font-semibold" value="{{ __('Question title') }} ({{ __('optional') }})" />
                <x-input id="question_title_add" type="text" class="mt-1 block w-full" wire:model="question_title_add" autocomplete="off" />
                <x-input-error for="question_title_add" class="mt-2" />
            </div>
            <!-- Body -->
            <div class="mt-6">
                <x-label for="question_body_add"  class="font-semibold" value="{{ __('Answer to the question') }} ({{ __('optional') }})" />
                <x-textarea id="question_body_add" class="mt-1 block w-full h-36 sm:h-36" wire:model="question_body_add" autocomplete="off"/>
                <x-input-error for="question_body_add" class="mt-2" />
            </div>
            <!-- Photo -->
            <div x-data="{photoName: null, photoPreview: null}" class="mt-6">
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

                <x-label for="photoSix"  class="font-semibold" value="{{ __('Image') }} ({{ __('optional') }})" />
                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="!photoPreview">
                    @if( $this->question_url_add)
                    <x-icon-button wire:click="deleteSix" class=" flex justify-center absolute m-1 opacity-70">
                        <span class="material-icons-outlined">delete</span>
                    </x-icon-button>
                        <img src="{{ URL::to('/') }}{{$this->question_url_add}}" alt="" class="rounded-sm h-48 sm:h-72 w-full object-cover">
                    @else 
                        <div x-on:click.prevent="$refs.photo.click()" class="cursor-pointer mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-48 sm:h-64">
                            <div class="space-y-1 text-center">
                            <span class="material-icons-outlined text-5xl text-gray-500">add_a_photo</span>
                            <p class="text-xs text-gray-500">
                            {{__('PNG, JPG up to 2MB')}}
                            </p>
                            </div>
                        </div>
                    @endif
                </div>

                 <!-- Image Preview -->
                 <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-sm w-full h-48 sm:h-72"
                        x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                        <x-icon-button @click="photoPreview = null" class="flex justify-center m-1 opacity-70">
                            <span class="material-icons-outlined">delete</span>
                        </x-icon-button>
                    </span>
                </div>
                
                <x-input-error for="photoSix" class="mt-2" />
            </div>
            <!-- button --> 
            <div class="mt-6 flex justify-center">
                <x-button wire:loading.attr="disabled">
                   <div class="my-2 mx-3">
                        <span class="px-2 font-bold sm:text-base"> {{ __('Next') }}</span>
                        <span class="material-icons-outlined ml-1 text-sm">arrow_forward_ios</span>
                   </div>
                </x-button>
            </div>
            </form>
        </div>
    </div>
</div>

<livewire:footer.footer-collaborate/>

