<x-slot name="title">
    @if ($campaign_reward_id)
        {{__('Update reward')}} : YoSolidario
    @else
        {{ __('Register new reward') }} : YoSolidario
    @endif
</x-slot>
<x-slot  name="seo">
   
</x-slot>
<x-slot  name="menu">
    <livewire:menu.navigation-campaign-create :campaign="$campaign"/>
</x-slot>
      
<div class="pt-20 bg-gray-50">
    <div class="max-w-2xl mx-auto px-4 sm:px-2 py-0 sm:py-10">
        <div class="border border-gray-100 my-5 py-4 sm:py-10 px-4 sm:px-20 rounded shadow bg-white">

            <div class="hidden lg:flex space-x-16 items-center">
                <a class="underline hover:text-gray-900" href="{{ route('campaign/rewards/show', $this->campaign) }}">
                    <span class="material-icons-outlined">arrow_back_ios_new</span>
                </a>
                <div class="font-bold text-2xl -mt-1">
                    @if ($campaign_reward_id)
                        {{__('Update reward')}}
                    @else
                        {{ __('Register new reward') }}
                    @endif
                </div>
            </div>
            <!-- Responsive -->
            <div class="lg:hidden">
                <a  href="{{ route('campaign/rewards/show', $this->campaign) }}" class="cursor-pointer border border-gray-300 py-1 px-2 flex space-x-1 w-20">
                    <span class="material-icons-outlined text-sm">arrow_back_ios</span>
                    <span class="font-bold">{{__('Back')}}</span>
                </a>
                <div class="text-center font-bold text-2xl mt-8">
                    {{__('Let’s start with the basics')}}
                </div>
            </div>
            <form wire:submit.prevent="StoreOrUpdate">
                        <!-- amount -->
            <div class="mt-8">
                <div class="sm:flex sm:space-x-2">
                    <div>
                        <x-label for="amount" class="text-base" value="{{ __('Amount') }}" required/>
                        <div class="flex">
                            <x-input id="amount" type="text" class="mt-1 block w-50" wire:model.defer="amount"  autocomplete="off"  minlength="1" maxlength="3" onKeyPress="return validar(event)"/>
                            <x-input id="amount" disabled type="text" class="mt-1 ml-1 block w-16 font-bold" placeholder="{{$currency_symbol}}" autocomplete="off"/>
                        </div>
                        <x-input-error for="amount" class="mt-2" />
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <!-- delivery_date -->
                        <x-label for="delivery_date" class="text-base" value="{{ __('Estimated delivery date') }}" />
                        <x-input id="delivery_date" type="date" class="mt-1 block w-50" wire:model.defer="delivery_date" autocomplete="off" />
                        <x-input-error for="delivery_date" class="mt-2" />
                    </div>
                </div>
            </div>
            <!-- description -->
            <div class="mt-6">
                <x-label for="description" class="text-base" value="{{ __('Description') }}" required/>
                <x-textarea id="description" class="mt-1 block w-full" wire:model.defer="description" autocomplete="off"/>
                <x-input-error for="description" class="mt-2" />
            </div>
            <!-- limiter -->
            <div class="mt-6">
                <div class="flex space-x-1">
                    <div class="w-48">
                        <x-label for="limiter" class="text-base" value="{{ __('Limit quantity?') }}" required/>
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
                            <x-input id="quantity" type="number" class="ml-2 block w-full" wire:model.defer="quantity" placeholder="{{ __('Quantity') }}" autocomplete="off" />
                            <x-input-error for="quantity" class="mt-2" />
                        @endif
                    </div>
                </div>
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
                    <x-label for="description" class="text-base" value="{{ __('Image') }} ({{ __('optional') }})"/>
                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="!photoPreview">
                    @if( $image_url)
                    <x-icon-button wire:click="deleteOne" class="absolute m-1 opacity-70">
                        <span class="material-icons-outlined">delete</span>
                    </x-icon-button>
                        <img src="{{ URL::to('/') }}{{$image_url}}" alt="" class="rounded-sm w-full h-36 sm:h-64 object-cover">
                    @else 
                        <div class="mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-36 sm:h-64">
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
                    @if($photoOne)
                        <span class="block rounded-sm w-full h-36 sm:h-64"
                            x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                            <x-icon-button wire:click="deleteOne" class="m-1 opacity-70">
                                <span class="material-icons-outlined">delete</span>
                            </x-icon-button>
                        </span>
                    @else
                        <div class="mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-36 sm:h-64">
                            <div class="space-y-1 text-center">
                            <span class="material-icons-outlined text-5xl text-gray-500">add_a_photo</span>
                            <p class="text-xs text-gray-500">
                                PNG, JPG up to 2MB
                            </p>
                            </div>
                        </div>
                    @endif
                </div>

                <x-secondary-button class="mt-2 mr-2 w-auto" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A Image') }}
                </x-secondary-button>

                <x-input-error for="photoOne" class="mt-2" />
            </div>
            <!-- button --> 
            <div class="mt-6 flex justify-center">
                <x-button wire:loading.attr="disabled">
                   <div class="my-2 mx-3">
                        <span class="px-2 font-bold sm:text-base"> {{ __('Save') }}</span>
                   </div>
                </x-button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    function validar(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==8) return true; //Tecla de retroceso (para poder borrar)
        if (tecla==44) return true; //Coma ( En este caso para diferenciar los decimales )
        if (tecla==48) return true;
        if (tecla==49) return true;
        if (tecla==50) return true;
        if (tecla==51) return true;
        if (tecla==52) return true;
        if (tecla==53) return true;
        if (tecla==54) return true;
        if (tecla==55) return true;
        if (tecla==56) return true;
        patron = /1/; //ver nota
        te = String.fromCharCode(tecla);
        return patron.test(te);
    }
</script>
<livewire:footer.footer-collaborate/>