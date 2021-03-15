<div>
    <div class="flex justify-end sm:mt-0">
        <div class="flex items-center ">
            @if($this->campaign->user->profile_photo_path)
            <div wire:click="viewUser({{$this->campaign->user->id}})" wire:loading.attr="disabled" class="flex-shrink-0 w-12 h-12 cursor-pointer">
                <img class="w-full h-full rounded-full"
                    src="{{ URL::to('/') }}{{$this->campaign->user->profile_photo_path}}"
                    alt="" />
            </div>
            @else 
            <div wire:click="viewUser({{$this->campaign->user->id}})" class="flex-shrink-0 w-12 h-12 cursor-pointer">
                <img class="w-full h-full rounded-full"
                    src="{{ $this->campaign->user->profile_photo_url }}" alt="{{ $this->campaign->user->name }}" />
            </div>
            @endif
            <div class="ml-3 space-y-2">
                <div wire:click="viewUser({{$this->campaign->user->id}})" class="text-gray-700 text-sm sm:text-base cursor-pointer"> 
                    <span class="font-bold">{{__('Organizator')}}: </span>
                    {{$this->campaign->user->name}}
                </div>

                @if($this->campaign->user->profile)
                    <div>
                        {{$this->campaign->user->profile->country->name}},
                        {{$this->campaign->user->profile->locality}}
                    </div> 
                @endif
                
                @if($this->campaign->user->profile)
                <div class="flex item-center space-x-3">
                    @if($this->campaign->user->profile->facebook)
                    <a href="https://www.facebook.com/{{$this->campaign->user->profile->facebook}}" target="_blank">
                        <i class="text-black uil uil-facebook-f text-2xl"></i>
                    </a>
                    @endif
                    @if($this->campaign->user->profile->twitter)
                    <a href="https://www.twitter.com/{{$this->campaign->user->profile->twitter}}" target="_blank">
                        <i class="text-black uil uil-twitter text-2xl"></i>
                    </a>
                    @endif
                    @if($this->campaign->user->profile->instagram)
                    <a href="https://www.instagram.com/{{$this->campaign->user->profile->instagram}}" target="_blank">
                        <i class="text-black uil uil-instagram text-2xl"></i>
                    </a>
                    @endif
                    @if($this->campaign->user->country)
                    <a href="https://api.whatsapp.com/send?phone={{$this->campaign->user->country->telephone_prefix}}{{$this->campaign->user->profile->whatsapp}}" target="_blank">
                        <i class="text-black uil uil-whatsapp text-2xl"></i>
                    </a>
                    @endif
                    @if($this->campaign->user->profile->telegram)
                    <a href="https://telegram.me/{{$this->campaign->user->profile->telegram}}" target="_blank">
                        <i class="text-black uil uil-telegram text-2xl"></i>
                    </a>
                    @endif
                    @if($this->campaign->user->profile->website)
                    <a href="{{$this->campaign->user->profile->website}}" target="_blank">
                        <i class="text-black uil uil-globe text-2xl"></i>
                    </a>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
    @if ($this->campaign->organization_id > 0)
    <div>
        <div class="flex justify-start sm:mt-2">
            <div class="flex items-center ">
                @if($this->campaign->organization->logo_path)
                <div wire:click="viewUser({{$this->campaign->user->id}})" wire:loading.attr="disabled" class="flex-shrink-0 w-12 h-12 cursor-pointer">
                    <img class="w-full h-full rounded-full"
                        src="{{ $host}}{{$this->campaign->organization->logo_path}}"
                        alt="" />
                </div>
                @else 
                <div wire:click="viewUser({{$this->campaign->user->id}})" class="flex-shrink-0 w-12 h-12 cursor-pointer">
                    <img class="w-full h-full rounded-full"
                        src="{{ $this->campaign->user->profile_photo_url }}" alt="{{ $this->campaign->user->name }}" />
                </div>
                @endif
                <div class="ml-3 space-y-2">
                    <div wire:click="viewUser({{$this->campaign->user->id}})" class="text-gray-700 text-sm sm:text-base cursor-pointer"> 
                        <span class="font-bold">{{__('For')}}: </span>
                        {{$this->campaign->organization->name}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
