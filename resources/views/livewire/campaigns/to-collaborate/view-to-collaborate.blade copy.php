<x-slot name="title">
    {{__('Your campaigns')}} : YoSolidario
</x-slot>
<x-slot  name="seo">
</x-slot>
<x-slot  name="menu">

</x-slot>

<div>
    @include('livewire.campaigns.to-collaborate.navigation-to-collaborate')
    @include('livewire.campaigns.to-collaborate.modal-to-collaborate')
    <div class="bg-gray-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-2 pt-20 pb-10">
            <div class=" bg-white shadow p-5 rounded-lg">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 sm:gap-10 rounded-lg sm:pt-2">
                    <div class="lg:col-span-2 px-10">
                        <div class="text-center font-bold text-2xl">
                            {{__('Indicate your collaboration')}}
                        </div>
                        <div class="mt-10 flex justify-between items-center">
                            <div class="m-4 flex w-full">
                                <input type="text" 
                                class="rounded-l-lg p-4 border-t mr-0 border-b border-l text-gray-800 border-gray-200 bg-white
                                border-yellow-500 border-t border-b border-l font-bold
                                focus:border-yellow-500 focus:ring focus:ring-yellow-50 focus:ring-opacity-50 w-full" 
                                placeholder="" maxlength="5"/>
                                <div class="px-8 rounded-r-lg bg-yellow-400 text-gray-800 font-bold p-4 uppercase border-yellow-500 border-t border-b border-r">
                                    {{$this->campaign->agency->agencySetting->money->currency_symbol}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        b
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none; 
    margin: 0; 
    }
</style>