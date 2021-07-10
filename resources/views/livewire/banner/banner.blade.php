<div>
    <x-banner-session/>
    <x-banner on="saved" style="{{$this->bannerStyle}}">
        {{ __($this->message) }}
    </x-banner>
</div>
