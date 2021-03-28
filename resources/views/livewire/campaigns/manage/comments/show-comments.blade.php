<x-slot name="title">
    {{__('Comments')}} : YoSolidario
</x-slot>
<x-slot  name="seo">

</x-slot>
<x-slot  name="menu">
    <livewire:menu.navigation-app/>
</x-slot>
<div class="mt-20 bg-red-50">
<x-section-content>
    <x-slot name="header">
        <livewire:campaigns.manage.menu.menu-header :campaign="$campaign"/>
    </x-slot>
    <x-slot  name="content">
        <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
              <div> 
                  <a href="https://www.facebook.com/v7.0/dialog/send?app_id=407682420960&channel_url=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df671437134a888%26domain%3Dwww.gofundme.com%26origin%3Dhttps%253A%252F%252Fwww.gofundme.com%252Ff1e014553c66d74%26relation%3Dopener&display=popup&e2e=%7B%7D&fallback_redirect_uri=https%3A%2F%2Fwww.gofundme.com%2Fshare%2Fs%2Fshare-family-friends%2Fmano-con-mano-por-gaby&link=https%3A%2F%2Fwww.gofundme.com%2Ff%2Fmano-con-mano-por-gaby%3Futm_source%3Dmessenger%26utm_medium%3Dsocial%26utm_campaign%3Dp_cf%2Bshare-flow-1&locale=en_US&next=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Dfc4bc0116622d%26domain%3Dwww.gofundme.com%26origin%3Dhttps%253A%252F%252Fwww.gofundme.com%252Ff1e014553c66d74%26relation%3Dopener%26frame%3Df32a0c8523ea0bc%26result%3D%2522xxRESULTTOKENxx%2522&sdk=joey&version=v7.0">ddd</a>
                <h2 class="mt-4 text-center text-xl font-light">
                    {{ __('No comments') }}
                </h2>
              </div>
            </div>
        </div>
    </x-slot>
</x-section-content>
</div>
<livewire:footer.footer-app/>