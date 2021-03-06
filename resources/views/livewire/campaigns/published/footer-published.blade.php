<div>
    <div class="flex justify-between items-center border-none border-none border-gray-200 py-0">
        <span class="text-base">{{__('Please collaborate and share words of encouragement.')}}</span>
        <x-secondary-button wire:click="backThisCampaign({{$campaign->id}})" wire:loading.attr="disabled"  class="ml-4">
            <span class="font-bold text-base">{{ __('Continue') }}</span>
        </x-secondary-button>
    </div>

    @if ($campaign->type_campaign == 'PERSONAL' or $campaign->type_campaign == 'PERSONAL_ORGANIZATION')
    <a href="{{route('fraud/register-campaign', $campaign)}}" class="flex justify-start items-center text-base mt-10 cursor-pointer ">
        <span class="material-icons-outlined">flag</span>
        <span class="underline semibold">{{__('Report fundraiser')}}</span>
    </a>
    @endif
</div>