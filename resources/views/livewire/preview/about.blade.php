<div class="text-base sm:text-lg">

<div class="border-b mt-4 mb-5 font-bold py-1">
    {{__('What is it about?')}}
</div>
<div class="text-justify">
 {!! nl2br(e($this->campaign->campaignQuestion[0]->about), false) !!}
</div>
@if($this->campaign->campaignQuestion[0]->about_url)
    <img src="{{ URL::to('/').$this->campaign->campaignQuestion[0]->about_url}}" alt="placeholder image" class="object-cover w-full my-5">
@endif
<!-- -->
<div class="border-b mt-4 mb-5 font-bold py-1">
    {{__('How will I use the money?')}}
</div>
<div class="text-justify">
 {!! nl2br(e($this->campaign->campaignQuestion[0]->use_of_money), false) !!}
</div>
@if($this->campaign->campaignQuestion[0]->use_of_money_url)
    <img src="{{ URL::to('/').$this->campaign->campaignQuestion[0]->use_of_money_url}}" alt="placeholder image" class="object-cover w-full my-5">
@endif
<!-- -->
<div class="border-b mt-4 mb-5 font-bold py-1">
    {{__('About the promoter')}}
</div>
<div class="text-justify">
 {!! nl2br(e($this->campaign->campaignQuestion[0]->about_organizer), false) !!}
</div>
@if($this->campaign->campaignQuestion[0]->about_promoter_url)
    <img src="{{ URL::to('/').$this->campaign->campaignQuestion[0]->about_promoter_url}}" alt="placeholder image" class="object-cover w-full my-5">
@endif
<!-- -->
<div class="border-b mt-4 mb-5 font-bold py-1">
    {{__('How and when are the awards delivered?')}}
</div>
<div class="text-justify">
 {!! nl2br(e($this->campaign->campaignQuestion[0]->delivery_of_awards), false) !!}
</div>
@if($this->campaign->campaignQuestion[0]->delivery_of_awards_url)
    <img src="{{ URL::to('/').$this->campaign->campaignQuestion[0]->delivery_of_awards_url}}" alt="placeholder image" class="object-cover w-full my-5">
@endif
<!-- -->
<div class="border-b mt-4 mb-5 font-bold py-1">
    {{__('Organizer contact details')}}
</div>
<div class="text-justify">
 {!! nl2br(e($this->campaign->campaignQuestion[0]->contact_organizer), false) !!}
</div>
@if($this->campaign->campaignQuestion[0]->contact_organizer_url)
    <img src="{{ URL::to('/').$this->campaign->campaignQuestion[0]->contact_organizer_url}}" alt="placeholder image" class="object-cover w-full my-5">
@endif
<!-- -->
    @if($this->campaign->campaignQuestion[0]->question_title_add)
    <div class="border-b mt-4 mb-5 font-bold py-1">
        {!! nl2br(e($this->campaign->campaignQuestion[0]->question_title_add), false) !!}
    </div>
    <div class="text-justify">
        {!! nl2br(e($this->campaign->campaignQuestion[0]->question_body_add), false) !!}
    </div>
    @if($this->campaign->campaignQuestion[0]->question_url_add)
        <img src="{{ URL::to('/').$this->campaign->campaignQuestion[0]->question_url_add}}" alt="placeholder image" class="object-cover w-full my-5">
    @endif
@endif

</div>