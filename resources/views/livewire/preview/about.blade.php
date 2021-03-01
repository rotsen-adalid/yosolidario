<div class="text-base sm:text-lg">

<div class="border-b mt-4 mb-5 font-bold py-1">
    {{__('What is it about?')}}
</div>
<div class="text-justify">
 {!! nl2br(e($this->campaign->campaignQuestion->about), false) !!}
</div>
@if($this->campaign->campaignQuestion->about_url)
    <img src="{{ URL::to('/').$this->campaign->campaignQuestion->about_url}}" alt="placeholder image" class="object-cover w-full my-5">
@endif
<!-- -->
<div class="border-b mt-4 mb-5 font-bold py-1">
    {{__('How will I use the money?')}}
</div>
<div class="text-justify">
 {!! nl2br(e($this->campaign->campaignQuestion->use_of_money), false) !!}
</div>
@if($this->campaign->campaignQuestion->use_of_money_url)
    <img src="{{ URL::to('/').$this->campaign->campaignQuestion->use_of_money_url}}" alt="placeholder image" class="object-cover w-full my-5">
@endif
<!-- -->
<div class="border-b mt-4 mb-5 font-bold py-1">
    {{__('About the promoter')}}
</div>
<div class="text-justify">
 {!! nl2br(e($this->campaign->campaignQuestion->about_organizer), false) !!}
</div>
@if($this->campaign->campaignQuestion->about_organizer_url)
    <img src="{{ URL::to('/').$this->campaign->campaignQuestion->about_organizer_url}}" alt="placeholder image" class="object-cover w-full my-5">
@endif
<!-- -->
<div class="border-b mt-4 mb-5 font-bold py-1">
    {{__('How and when are the awards delivered?')}}
</div>
<div class="text-justify">
 {!! nl2br(e($this->campaign->campaignQuestion->delivery_of_rewards), false) !!}
</div>
@if($this->campaign->campaignQuestion->delivery_of_awards_url)
    <img src="{{ URL::to('/').$this->campaign->campaignQuestion->delivery_of_rewards_url}}" alt="placeholder image" class="object-cover w-full my-5">
@endif
<!-- -->
<div class="border-b mt-4 mb-5 font-bold py-1">
    {{__('Organizer contact details')}}
</div>
<div class="text-justify">
 {!! nl2br(e($this->campaign->campaignQuestion->contact_organizer), false) !!}
</div>
@if($this->campaign->campaignQuestion->contact_organizer_url)
    <img src="{{ URL::to('/').$this->campaign->campaignQuestion->contact_organizer_url}}" alt="placeholder image" class="object-cover w-full my-5">
@endif
<!-- -->
    @if($this->campaign->campaignQuestion->question_title_add)
    <div class="border-b mt-4 mb-5 font-bold py-1">
        {!! nl2br(e($this->campaign->campaignQuestion->question_title_add), false) !!}
    </div>
    <div class="text-justify">
        {!! nl2br(e($this->campaign->campaignQuestion->question_body_add), false) !!}
    </div>
    @if($this->campaign->campaignQuestion->question_url_add)
        <img src="{{ URL::to('/').$this->campaign->campaignQuestion->question_url_add}}" alt="placeholder image" class="object-cover w-full my-5">
    @endif
@endif

</div>