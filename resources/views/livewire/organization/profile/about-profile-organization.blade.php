<div class="">
    @if ($this->organization)
        <div class="mb-5 font-bold py-1 text-lg">
            {{__('About')}}
        </div>
        <div class="pb-6 text-justify border-b">
            {!! nl2br(e($this->organization->organizationProfile->about), false) !!}
        </div>
        <div class="py-6 font-bold text-lg">
            {{__('Mission y Vision')}}
        </div>
        <div class="pb-6 text-justify border-b">
            {!! nl2br(e($this->organization->organizationProfile->mission_vision), false) !!}
        </div>
        <div class="py-6 font-bold text-lg">
            {{__('Adress')}}
        </div>
        <div class="pb-6 text-justify border-b">
            {!! nl2br(e($this->organization->organizationProfile->address), false) !!}
        </div>
        <div class="py-6 font-bold text-lg">
            {{__('Contacts')}}
        </div>
        <div class="text-justify mb-4">
            {!! nl2br(e($this->organization->organizationProfile->contacts), false) !!}
        </div>
    @endif
</div>