<div>
    <x-banner-session class="top-20"/>
    <x-banner on="saved" style="{{$this->bannerStyle}}">
        {{ __($this->message) }}
    </x-banner>
</div>
