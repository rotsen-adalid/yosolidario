<div>
    <div class="flex justify-between items-center border-t border-b border-gray-200 py-5">
        <span class="text-base">{{__('Please collaborate and share words of encouragement.')}}</span>
        <x-button class="ml-4">
            <span class="font-bold text-base">{{ __('Continue') }}</span>
        </x-button>
    </div>
    <a href="{{route('fraud/register-campaign', $campaign)}}" class="flex justify-start items-center text-base mt-10 cursor-pointer ">
        <span class="material-icons-outlined">flag</span>
        <span class="underline semibold">{{__('Report fundraiser')}}</span>
    </a>
</div>