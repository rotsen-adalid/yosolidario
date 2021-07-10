<x-slot name="title">
    {{Auth::user()->name}} : YoSolidario
</x-slot>
<x-slot  name="menu">
    @livewire('menu.navigation-user')
</x-slot>
<div class="pt-20" style="background-color:#fbf8f6">
    <div class="max-w-2xl mx-auto px-4 sm:px-2 py-0 sm:py-10">
        <div class="border border-gray-100 my-5 py-10 px-4 sm:px-20 rounded shadow bg-white">
            <div class="text-center font-bold text-2xl">
                {{__('Your accounts')}}
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-8 rounded-lg mt-10">
                <div wire:click="changePersonal({{Auth::user()->id}})" class="flex flex-col items-center px-4 cursor-pointer">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="h-24 w-24 sm:h-36 sm:w-36 rounded-full  border border-gray-200 shadow">
                            @if (Auth::user()->profile_photo_path)
                                <img class="w-full h-full object-cover rounded-full" src="{{ Auth::user()->profile_photo_path }}" alt="{{ Auth::user()->name }}" />
                            @else 
                                <img class="w-full h-full object-cover rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            @endif
                        </div>
                    @endif
    
                    <div>
                        <div class="font-normal text-base text-gray-800 text-center mt-2 truncate-single-line">{{$this->cutLetter( Auth::user()->name, 20 )}}</div>
                    </div>
                    <x-status-in-process>
                        {{__('User')}}
                    </x-status-in-process>
                </div>

                @foreach (Auth::user()->organizations as $item)
                <div wire:click="changeOrganization({{$item->id}})" class="flex flex-col justify-center items-center px-4 cursor-pointer">
                    <div class="h-24 w-24 sm:h-36 sm:w-36 rounded-full  border border-gray-200 shadow">
                        @if ($item->logo_path)
                            <img class="w-full h-full object-cover rounded-full" src="{{ $item->logo_path }}" alt="{{ $item->name }}" />
                        @else 
                            <img class="w-full h-full object-cover rounded-full" src="{{ $item->logo_path }}" alt="{{ $item->name }}" />
                        @endif
                    </div>
    
                    <div>
                        <div class="font-normal text-base text-gray-800 text-center mt-2 truncate-single-line">{{$this->cutLetter( $item->name, 20) }}</div>
                    </div>
                    @if ($item->type == 'COMPANY')
                        <x-status-in-process>
                            {{__('Business')}}
                        </x-status-in-process>
                    @elseif ($item->type == 'ONG')
                        <x-status-in-process>
                            {{__('ONG')}}
                        </x-status-in-process>
                    @elseif ($item->type == 'FOUNDATION')
                        <x-status-in-process>
                            {{__('Foundation')}}
                        </x-status-in-process>
                    @elseif ($item->type == 'FOUNDATION')
                        <x-status-in-process>
                            {{__('Foundation')}}
                        </x-status-in-process>
                    @endif
                    
                </div>
                @endforeach

                <div wire:click="create({{Auth::user()->id}})" class="flex flex-col items-center px-4 cursor-pointer">
                    <div class="h-24 w-24 sm:h-36 sm:w-36 rounded-full flex items-center justify-center border border-gray-200 shadow">
                        <span class="material-icons-outlined text-4xl">business</span>
                    </div>
    
                    <div>
                        <div class="font-normal text-base text-gray-800 text-center mt-2 truncate-single-line">
                            {{__($this->cutLetter( 'Empresa o fundacion', 20) )}}
                        </div>
                    </div>
                    <x-secondary-button class="flex-1 truncate-single-line text-ys1">
                        {{__('Create account')}}
                    </x-secondary-button>
                </div>

            </div>
        </div>
    </div>
</div>
<x-slot  name="footer">
    @livewire('footer.footer-app')
</x-slot>