<x-slot name="title">
    {{__('Comments')}} : YoSolidario
</x-slot>
<x-slot  name="seo">

</x-slot>
<x-slot  name="menu">
    <livewire:menu.navigation-panel-user/>
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
                <a  href="{{ route('campaign/manage', $campaign) }}" class="cursor-pointer my-4  py-1 px-2 flex space-x-1 w-24">
                    <span class="material-icons-outlined text-sm">arrow_back_ios</span>
                </a>
                <div class="flex items-center justify-center text-2xl font-bold -mt-12">{{__('Comments')}}</div>
            </div>
        </div>
    </x-slot>
    <x-slot  name="content">
        @if ($sumCollection->count() > 0)
        
        @php($i = 1)
        @foreach ($collection as $item)
            <div class="@if ($i != $collection->count()) border-b border-gray-200 @php($i++)  @endif py-5">
            <div class="flex justify-between items-center sm:px-0">
                <div class="truncate-single-line flex items-center space-x-2">
                    @if ($item->paymentOrder->show_name == 'NO')
                        <svg class="text-lg" height="2.5em" viewBox="0 0 40 40" width="2.5em" xmlns="http://www.w3.org/2000/svg">
                            <g fill="none" fill-rule="evenodd">
                                <circle cx="20" cy="20" fill="#e6f6ef" fill-rule="nonzero" r="20"/>
                                <path d="m21.4784689 27.5263158c.3488114 0 .6315789.2827675.6315789.6315789 0 .3488115-.2827675.631579-.6315789.631579h-10.6363636c-.3488115 0-.631579-.2827675-.631579-.631579 0-4.357584 3.218387-8.4877122 7.708134-8.4877122.3488114 0 .6315789.2827676.6315789.631579s-.2827675.6315789-.6315789.6315789c-3.5023623 0-6.131254 3.1181392-6.4188175 6.5929706zm-1.2703349-9.075188c-2.3020199 0-4.1698565-1.8555684-4.1698565-4.1466165 0-2.2910482 1.8678366-4.1466166 4.1698565-4.1466166 2.3020198 0 4.1698564 1.8555684 4.1698564 4.1466166 0 2.2910481-1.8678366 4.1466165-4.1698564 4.1466165zm0-1.2631579c1.6062535 0 2.9066985-1.2919035 2.9066985-2.8834586 0-1.5915552-1.300445-2.8834587-2.9066985-2.8834587-1.6062536 0-2.9066986 1.2919035-2.9066986 2.8834587 0 1.5915551 1.300445 2.8834586 2.9066986 2.8834586zm6.1278668 2.4997007c.9266974-.1000586 1.8513824.2091567 2.524651.8454051l.0053819.0051464c.5903617.5712261.92344 1.352408.92344 2.1684225s-.3330783 1.5971964-.9226007 2.1676089l-3.847619 3.7367169c-.2450418.2379787-.6348873.238008-.8799648.0000661l-3.8466971-3.7347009c-.5908074-.5712779-.924171-1.3527646-.924171-2.1691296s.3333636-1.5978517.9294022-2.1741303c.6732686-.6362484 1.5979537-.9454637 2.5246511-.8454051.6591208.0711674 1.2717801.3442662 1.7567632.7713718.484983-.4271056 1.0976423-.7002044 1.7567632-.7713718zm.1355992 1.2558585c-.5590712.0603648-1.0605494.360486-1.3688421.817319-.2503977.3710433-.796643.3710433-1.0470407 0-.3082927-.456833-.8097709-.7569542-1.3688421-.817319-.5599241-.0604569-1.1177102.1260672-1.51623.5026172-.3453662.3339499-.5390662.7880303-.5390662 1.2610597s.1937.9271099.539988 1.2619529l3.4076046 3.3083909 3.408508-3.3102611c.345103-.3339171.5386363-.7878186.5386363-1.2606441 0-.471606-.1925364-.9243856-.5359693-1.2580581-.4035345-.3798243-.9600763-.5653789-1.5187465-.5050574z" fill="#008748"/>
                            </g>
                        </svg> 
                    @else 
                        <svg class="text-lg" height="2.5em" viewBox="0 0 40 40" width="2.5em" xmlns="http://www.w3.org/2000/svg">
                            <g fill="none" fill-rule="evenodd">
                                <circle cx="20" cy="20" fill="#f1f1f1" fill-rule="nonzero" r="20"/>
                                <path d="m21.4784689 27.5263158c.3488114 0 .6315789.2827675.6315789.6315789 0 .3488115-.2827675.631579-.6315789.631579h-10.6363636c-.3488115 0-.631579-.2827675-.631579-.631579 0-4.357584 3.218387-8.4877122 7.708134-8.4877122.3488114 0 .6315789.2827676.6315789.631579s-.2827675.6315789-.6315789.6315789c-3.5023623 0-6.131254 3.1181392-6.4188175 6.5929706zm-1.2703349-9.075188c-2.3020199 0-4.1698565-1.8555684-4.1698565-4.1466165 0-2.2910482 1.8678366-4.1466166 4.1698565-4.1466166 2.3020198 0 4.1698564 1.8555684 4.1698564 4.1466166 0 2.2910481-1.8678366 4.1466165-4.1698564 4.1466165zm0-1.2631579c1.6062535 0 2.9066985-1.2919035 2.9066985-2.8834586 0-1.5915552-1.300445-2.8834587-2.9066985-2.8834587-1.6062536 0-2.9066986 1.2919035-2.9066986 2.8834587 0 1.5915551 1.300445 2.8834586 2.9066986 2.8834586zm6.1278668 2.4997007c.9266974-.1000586 1.8513824.2091567 2.524651.8454051l.0053819.0051464c.5903617.5712261.92344 1.352408.92344 2.1684225s-.3330783 1.5971964-.9226007 2.1676089l-3.847619 3.7367169c-.2450418.2379787-.6348873.238008-.8799648.0000661l-3.8466971-3.7347009c-.5908074-.5712779-.924171-1.3527646-.924171-2.1691296s.3333636-1.5978517.9294022-2.1741303c.6732686-.6362484 1.5979537-.9454637 2.5246511-.8454051.6591208.0711674 1.2717801.3442662 1.7567632.7713718.484983-.4271056 1.0976423-.7002044 1.7567632-.7713718zm.1355992 1.2558585c-.5590712.0603648-1.0605494.360486-1.3688421.817319-.2503977.3710433-.796643.3710433-1.0470407 0-.3082927-.456833-.8097709-.7569542-1.3688421-.817319-.5599241-.0604569-1.1177102.1260672-1.51623.5026172-.3453662.3339499-.5390662.7880303-.5390662 1.2610597s.1937.9271099.539988 1.2619529l3.4076046 3.3083909 3.408508-3.3102611c.345103-.3339171.5386363-.7878186.5386363-1.2606441 0-.471606-.1925364-.9243856-.5359693-1.2580581-.4035345-.3798243-.9600763-.5653789-1.5187465-.5050574z" fill="#333333"/>
                            </g>
                        </svg>
                    @endif 
                    <div class="ml-3 space-y-2">
                        <div class="text-gray-700 text-sm sm:text-base cursor-pointer font-bold"> 
                            @if ($item->paymentOrder->show_name == 'NO')
                                {{$item->paymentOrder->name}}
                                {{$item->paymentOrder->lastname}}
                            @else 
                                {{__('Anonymous')}}
                            @endif
                        </div>
                    </div>
                    <div class="lowercase text-gray-600">
                        {{__('Collaborated')}}
                    </div>
                    <div class="font-bold">
                        {{ number_format($item->paymentOrder->amount_user, 0 ) }}
                        {{$item->paymentOrder->money->currency_symbol}}
                    </div>
                </div>
                <div class="flex items-center flex-row space-x-2">

                    <div class="space-x-2 sm:-my-px sm:ml-5 sm:flex">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="hidden sm:flex inline-flex rounded-md shadow-xs border border-gray-100">
                                    <button type="button" class="flex items-center justify-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        <span>{{ __('Menu') }}</span>
                                        <span class="material-icons-outlined ml-2 -mr-0.5 h-4 w-4 -mt-2">more_vert</span>
                                    </button>
                                </span>
                                <span class="sm:hidden inline-flex rounded-md shadow-xs border-none border-gray-100">
                                    <button type="button" class="flex items-center justify-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        <span class="material-icons-outlined ml-2 -mr-0.5 h-4 w-4 -mt-2">more_vert</span>
                                    </button>
                                </span>
                            </x-slot>
    
                            <x-slot name="content">
                                <div class="w-60">

                                    <div class=" flex space-x-5 px-4 py-3">
                                        @if ($item->paymentOrder->commentary_hidden == 'NO')
                                            <x-danger-button wire:click="commentaryHidden(1, {{ $item->paymentOrder->id }})" wire:loading.attr="disabled"
                                                class="w-full flex justify-center">
                                                {{__('Ocultar')}}
                                            </x-danger-button>
                                        @elseif ($item->paymentOrder->commentary_hidden == 'YES')
                                            <x-secondary-button wire:click="commentaryHidden(0, {{ $item->id }})" wire:loading.attr="disabled"
                                                class="w-full flex justify-center">
                                                {{__('Hacer visible')}}
                                            </x-secondary-button>
                                        @endif
                                    </div>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    
                </div>
            </div>
            <div class="sm:pl-14 space-y-2">
                <div class=" ">
                    {!! nl2br(e($item->paymentOrder->commentary), false) !!}
                </div>
                <div class="flex space-x-2">
                    @if ($item->paymentOrder->commentary_hidden == 'NO')
                        <x-status-suspended>
                            {{__('Visible')}}
                        </x-status-suspended>
                    @elseif ($item->paymentOrder->commentary_hidden == 'YES')
                        <x-status-in-process>
                            {{__('Oculto')}}
                        </x-status-in-process>
                    @endif
                    <div class="font-bold text-2xl flex items-center text-gray-500">
                        <span class="material-icons-outlined text-xs">access_time_filled</span>
                    </div>
                    <div class=" text-gray-500">
                        {{ \Carbon\Carbon::parse($item->date_payment)->diffForHumans() }}
                    </div>
                </div>
            </div>
            </div>

        @endforeach
            <div class="sm:px-20">
                {{$collection->onEachSide(1)->links()}}
            </div>
        @else
        <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <div>
                    <h2 class="mt-4 text-center text-lg font-bold">
                        {{ __('No comments') }}
                    </h2>
                    <h2 class="mt-2 text-center font-light">
                        {{ __('Share your campaign to have collaborations') }}
                    </h2>
                    <div class="flex justify-center mt-10">
                        <x-secondary-button class=" justify-center" wire:click="$emit('sharedOpen')" wire:loading.attr="disabled">
                            <span class="text-base font-bold">{{ __('Share fundraiser') }}</span>
                        </x-secondary-button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </x-slot>
</x-section-content>
</div>
<livewire:footer.footer-app/>