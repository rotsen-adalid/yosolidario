<!-- Help -->
<x-dialog-modal wire:model="helpDialog">
    <x-slot name="title">
        <div class="flex justify-center py-5 border-b border-gray-100">
            <x-application-mark/>
        </div>
    </x-slot>
    <x-slot name="content">
       <div class="px-2 sm:px-20 flex flex-col justify-center py-10">
            <div class="shadow p-5 rounded-lg border border-ys1 bg-gray-50 cursor-pointer">
                <div class="uppercase font-bold">
                    {{__('Contact the organizer')}}
                </div>
                <div>
                    {{__('Your question is related to this fundraiser.')}}
                </div>
            </div>
            <div class="shadow p-5 rounded-lg border border-ys1 my-5 bg-gray-50 cursor-pointer">
                <div class="uppercase font-bold">
                    {{__('Ask YoSolidario a question')}}
                </div>
                <div>
                    {{__('Get your answer at any time of the day, business days and holidays.')}}
                </div>
            </div>
            <div class="shadow p-5 rounded-lg border border-ys1 bg-gray-50 cursor-pointer">
                <div class="uppercase font-bold">
                    {{__('Report fraud')}}
                </div>
                <div>
                    {{__('You know this fundraiser is breaking the law.')}}
                </div>
            </div>
       </div>
    </x-slot>
</x-dialog-modal>