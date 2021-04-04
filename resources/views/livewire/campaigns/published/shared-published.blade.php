<div>
    @if ($buttonShared == 1)
        <button  wire:click="shared" 
            class="flex justify-center items-center w-full text-center px-4  py-1 sm:py-3 bg-white border border-gray-300 rounded-md font-bold text-sm text-black uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
            <span class="material-icons-outlined">share</span>
            {{__('Share')}}
        </button>
    @elseif ($buttonShared == 2)
        <button wire:click="shared" type="button" 
        class="border border-yellow-500 text-black py-1 px-2 font-bold rounded-md text-base
        hover:bg-yellow-100 focus:outline-none focus:border-yellow-500 shadow-sm focus:shadow-outline-yellow active:bg-yelow-400 transition ease-in-out duration-150">
            {{__('Share')}}
        </button>
    @elseif ($buttonShared == 3)
        <button wire:click="shared" class="w-full lg:w-72 px-4 py-2 sm:py-4 text-center border border-yellow-400 border border-yellow-500 rounded-md font-bold text-base text-black uppercase tracking-widest hover:border-yellow-500 active:border-yellow-500 focus:outline-none focus:border-yellow-300 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
            <!-- <img src="{asset('images/icono.png')}}" class="h-7" alt=""> -->
            <span>{{__('Share')}}</span>
        </button>
    @elseif ($buttonShared == 4)
        <button wire:click="shared" class="w-full lg:w-72 px-4 py-2 sm:py-4 text-center border border-yellow-400 border border-yellow-500 rounded-md font-bold text-base text-black uppercase tracking-widest hover:border-yellow-500 active:border-yellow-500 focus:outline-none focus:border-yellow-300 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
            <!-- <img src="{asset('images/icono.png')}}" class="h-7" alt=""> -->
            <span>{{__('Share')}}</span>
        </button>
    @elseif ($buttonShared == 5)
        <button wire:click="shared" class="w-full lg:w-72 px-4 py-2 sm:py-4 text-center border border-yellow-400 border border-yellow-500 rounded-md font-bold text-base text-black uppercase tracking-widest hover:border-yellow-500 active:border-yellow-500 focus:outline-none focus:border-yellow-300 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
            <!-- <img src="{asset('images/icono.png')}}" class="h-7" alt=""> -->
            <span>{{__('Share')}}</span>
        </button>
    @endif
   
    <x-dialog-modal wire:model="shared">
        <x-slot name="title">
            @if(!$embed)
                <div class="font-bold text-2xl">
                    {{ __('Help by sharing') }}
                </div>
            @else
                <div class="flex items-center space-x-2">
                    <div wire:click="emberHTML(0)" class="flex spacex-1 px-2 py-1 bg-red-50 items-center w-20 cursor-pointer rounded-sm">
                        <span class="material-icons-outlined text-2xl">arrow_back_ios</span>
                        <span>{{__('back')}}</span>
                    </div>
                    <div class="font-bold text-2xl">{{__('Ember HTML')}}</div>
                </div>
            @endif
        </x-slot>
        <x-slot name="content">
            @if(!$embed)
            <div class="mt-2 text-sm sm:text-base">
                {{__('Fundraisers shared on social networks raise up to 5x more')}}
            </div>
            <x-section-border />

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-10">
                <div>
                    <a  href="javascript:windowFacebook('{{$campaign->title}}', '{{$campaign->slug}}')">
                        <div class="flex justify-center">
                            <img class="h-10" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE4LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgdmlld0JveD0iMCAwIDExMi4xOTYgMTEyLjE5NiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMTEyLjE5NiAxMTIuMTk2OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8Zz4NCgk8Y2lyY2xlIHN0eWxlPSJmaWxsOiMzQjU5OTg7IiBjeD0iNTYuMDk4IiBjeT0iNTYuMDk4IiByPSI1Ni4wOTgiLz4NCgk8cGF0aCBzdHlsZT0iZmlsbDojRkZGRkZGOyIgZD0iTTcwLjIwMSw1OC4yOTRoLTEwLjAxdjM2LjY3Mkg0NS4wMjVWNTguMjk0aC03LjIxM1Y0NS40MDZoNy4yMTN2LTguMzQNCgkJYzAtNS45NjQsMi44MzMtMTUuMzAzLDE1LjMwMS0xNS4zMDNMNzEuNTYsMjEuODF2MTIuNTFoLTguMTUxYy0xLjMzNywwLTMuMjE3LDAuNjY4LTMuMjE3LDMuNTEzdjcuNTg1aDExLjMzNEw3MC4yMDEsNTguMjk0eiIvPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPC9zdmc+DQo=" />
                        </div>
                        <div class="mt-1 flex justify-center">Facebook</div>
                    </a>
                </div>
                <div>
                    <a  href="javascript:windowMessenger('{{$campaign->title}}', '{{$campaign->slug}}')">
                        <div class="flex justify-center">
                            <img class="h-10" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNTEyLjA1IDUxMi4wNSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyLjA1IDUxMi4wNTsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHBhdGggc3R5bGU9ImZpbGw6IzIxOTZGMzsiIGQ9Ik0yNTYuMDI1LDAuMDVDMTE3LjY3LTIuNjc4LDMuMTg0LDEwNy4wMzgsMC4wMjUsMjQ1LjM4M2MwLjM2MSw3MC40MjMsMzEuNTQ0LDEzNy4xNTcsODUuMzMzLDE4Mi42MTMNCgl2NzMuMzg3YzAsNS44OTEsNC43NzYsMTAuNjY3LDEwLjY2NywxMC42NjdjMS45OTksMCwzLjk1OC0wLjU2Miw1LjY1My0xLjYyMWw1OS40NTYtMzcuMTQxDQoJYzMwLjI5MiwxMS41ODYsNjIuNDU5LDE3LjQ5NCw5NC44OTEsMTcuNDI5YzEzOC4zNTUsMi43MjgsMjUyLjg0MS0xMDYuOTg4LDI1Ni0yNDUuMzMzQzUwOC44NjYsMTA3LjAzOCwzOTQuMzgtMi42NzgsMjU2LjAyNSwwLjA1eg0KCSIvPg0KPHBhdGggc3R5bGU9ImZpbGw6I0ZBRkFGQTsiIGQ9Ik00MjQuNTU4LDE3NC45ODNjLTMuMTc0LTQuMjU0LTguOTkzLTUuNTI3LTEzLjY1My0yLjk4N2wtMTEwLjkzMyw2MC40OGwtNjkuMDEzLTU5LjE3OQ0KCWMtNC4yMzItMy42MjgtMTAuNTQ0LTMuMzg3LTE0LjQ4NSwwLjU1NWwtMTI4LDEyOGMtNC4xNTMsNC4xNzgtNC4xMzMsMTAuOTMyLDAuMDQ2LDE1LjA4NWMzLjM0MSwzLjMyMSw4LjQ2NCw0LjA1NywxMi42MDUsMS44MTENCglsMTEwLjkzMy02MC40OGw2OS4wNzcsNTkuMmM0LjIzMiwzLjYyOCwxMC41NDQsMy4zODcsMTQuNDg1LTAuNTU1bDEyOC0xMjhDNDI3LjM1LDE4NS4xNDgsNDI3Ljc1LDE3OS4yMTUsNDI0LjU1OCwxNzQuOTgzeiIvPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPC9zdmc+DQo=" />
                        </div>
                        <div class="mt-1 flex justify-center text-center">{{__('Messenger')}}</div>
                    </a>
                </div>
                <div>
                    <a  href="javascript:windowTwitter('{{$campaign->title}}', '{{$campaign->slug}}')">
                        <div class="flex justify-center">
                            <img class="h-10" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHBhdGggc3R5bGU9ImZpbGw6IzAzQTlGNDsiIGQ9Ik01MTIsOTcuMjQ4Yy0xOS4wNCw4LjM1Mi0zOS4zMjgsMTMuODg4LTYwLjQ4LDE2LjU3NmMyMS43Ni0xMi45OTIsMzguMzY4LTMzLjQwOCw0Ni4xNzYtNTguMDE2DQoJYy0yMC4yODgsMTIuMDk2LTQyLjY4OCwyMC42NC02Ni41NiwyNS40MDhDNDExLjg3Miw2MC43MDQsMzg0LjQxNiw0OCwzNTQuNDY0LDQ4Yy01OC4xMTIsMC0xMDQuODk2LDQ3LjE2OC0xMDQuODk2LDEwNC45OTINCgljMCw4LjMyLDAuNzA0LDE2LjMyLDIuNDMyLDIzLjkzNmMtODcuMjY0LTQuMjU2LTE2NC40OC00Ni4wOC0yMTYuMzUyLTEwOS43OTJjLTkuMDU2LDE1LjcxMi0xNC4zNjgsMzMuNjk2LTE0LjM2OCw1My4wNTYNCgljMCwzNi4zNTIsMTguNzIsNjguNTc2LDQ2LjYyNCw4Ny4yMzJjLTE2Ljg2NC0wLjMyLTMzLjQwOC01LjIxNi00Ny40MjQtMTIuOTI4YzAsMC4zMiwwLDAuNzM2LDAsMS4xNTINCgljMCw1MS4wMDgsMzYuMzg0LDkzLjM3Niw4NC4wOTYsMTAzLjEzNmMtOC41NDQsMi4zMzYtMTcuODU2LDMuNDU2LTI3LjUyLDMuNDU2Yy02LjcyLDAtMTMuNTA0LTAuMzg0LTE5Ljg3Mi0xLjc5Mg0KCWMxMy42LDQxLjU2OCw1Mi4xOTIsNzIuMTI4LDk4LjA4LDczLjEyYy0zNS43MTIsMjcuOTM2LTgxLjA1Niw0NC43NjgtMTMwLjE0NCw0NC43NjhjLTguNjA4LDAtMTYuODY0LTAuMzg0LTI1LjEyLTEuNDQNCglDNDYuNDk2LDQ0Ni44OCwxMDEuNiw0NjQsMTYxLjAyNCw0NjRjMTkzLjE1MiwwLDI5OC43NTItMTYwLDI5OC43NTItMjk4LjY4OGMwLTQuNjQtMC4xNi05LjEyLTAuMzg0LTEzLjU2OA0KCUM0ODAuMjI0LDEzNi45Niw0OTcuNzI4LDExOC40OTYsNTEyLDk3LjI0OHoiLz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K" />
                        </div>
                        <div class="mt-1 flex justify-center">Twitter</div>
                    </a>
                </div>
                <div>
                    <a  href="javascript:windowWhatsApp('{{$campaign->title}}', '{{$campaign->slug}}')">
                        <div class="flex justify-center">
                            <img class="h-10" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjUxMnB0IiB2aWV3Qm94PSItMSAwIDUxMiA1MTIiIHdpZHRoPSI1MTJwdCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJtMTAuODk0NTMxIDUxMmMtMi44NzUgMC01LjY3MTg3NS0xLjEzNjcxOS03Ljc0NjA5My0zLjIzNDM3NS0yLjczNDM3Ni0yLjc2NTYyNS0zLjc4OTA2My02Ljc4MTI1LTIuNzYxNzE5LTEwLjUzNTE1NmwzMy4yODUxNTYtMTIxLjU0Njg3NWMtMjAuNzIyNjU2LTM3LjQ3MjY1Ni0zMS42NDg0MzctNzkuODYzMjgyLTMxLjYzMjgxMy0xMjIuODk0NTMyLjA1ODU5NC0xMzkuOTQxNDA2IDExMy45NDE0MDctMjUzLjc4OTA2MiAyNTMuODcxMDk0LTI1My43ODkwNjIgNjcuODcxMDk0LjAyNzM0MzggMTMxLjY0NDUzMiAyNi40NjQ4NDQgMTc5LjU3ODEyNSA3NC40MzM1OTQgNDcuOTI1NzgxIDQ3Ljk3MjY1NiA3NC4zMDg1OTQgMTExLjc0MjE4NyA3NC4yODkwNjMgMTc5LjU1ODU5NC0uMDYyNSAxMzkuOTQ1MzEyLTExMy45NDUzMTMgMjUzLjgwMDc4MS0yNTMuODY3MTg4IDI1My44MDA3ODEgMCAwLS4xMDU0NjggMC0uMTA5Mzc1IDAtNDAuODcxMDkzLS4wMTU2MjUtODEuMzkwNjI1LTkuOTc2NTYzLTExNy40Njg3NS0yOC44NDM3NWwtMTI0LjY3NTc4MSAzMi42OTUzMTJjLS45MTQwNjIuMjM4MjgxLTEuODQzNzUuMzU1NDY5LTIuNzYxNzE5LjM1NTQ2OXptMCAwIiBmaWxsPSIjZTVlNWU1Ii8+PHBhdGggZD0ibTEwLjg5NDUzMSA1MDEuMTA1NDY5IDM0LjQ2ODc1LTEyNS44NzEwOTRjLTIxLjI2MTcxOS0zNi44Mzk4NDQtMzIuNDQ1MzEyLTc4LjYyODkwNi0zMi40Mjk2ODctMTIxLjQ0MTQwNi4wNTQ2ODctMTMzLjkzMzU5NCAxMDkuMDQ2ODc1LTI0Mi44OTg0MzggMjQyLjk3NjU2Mi0yNDIuODk4NDM4IDY0Ljk5MjE4OC4wMjczNDQgMTI1Ljk5NjA5NCAyNS4zMjQyMTkgMTcxLjg3MTA5NCA3MS4yMzgyODEgNDUuODcxMDk0IDQ1LjkxNDA2MyA3MS4xMjUgMTA2Ljk0NTMxMyA3MS4xMDE1NjIgMTcxLjg1NTQ2OS0uMDU4NTkzIDEzMy45Mjk2ODgtMTA5LjA2NjQwNiAyNDIuOTEwMTU3LTI0Mi45NzI2NTYgMjQyLjkxMDE1Ny0uMDA3ODEyIDAgLjAwMzkwNiAwIDAgMGgtLjEwNTQ2OGMtNDAuNjY0MDYzLS4wMTU2MjYtODAuNjE3MTg4LTEwLjIxNDg0NC0xMTYuMTA1NDY5LTI5LjU3MDMxM3ptMTM0Ljc2OTUzMS03Ny43NSA3LjM3ODkwNyA0LjM3MTA5M2MzMSAxOC4zOTg0MzggNjYuNTQyOTY5IDI4LjEyODkwNyAxMDIuNzg5MDYyIDI4LjE0ODQzOGguMDc4MTI1YzExMS4zMDQ2ODggMCAyMDEuODk4NDM4LTkwLjU3ODEyNSAyMDEuOTQ1MzEzLTIwMS45MDIzNDQuMDE5NTMxLTUzLjk0OTIxOC0yMC45NjQ4NDQtMTA0LjY3OTY4Ny01OS4wOTM3NS0xNDIuODM5ODQ0LTM4LjEzMjgxMy0zOC4xNjAxNTYtODguODMyMDMxLTU5LjE4NzUtMTQyLjc3NzM0NC01OS4yMTA5MzctMTExLjM5NDUzMSAwLTIwMS45ODQzNzUgOTAuNTY2NDA2LTIwMi4wMjczNDQgMjAxLjg4NjcxOS0uMDE1NjI1IDM4LjE0ODQzNyAxMC42NTYyNSA3NS4yOTY4NzUgMzAuODc1IDEwNy40NDUzMTJsNC44MDQ2ODggNy42NDA2MjUtMjAuNDA2MjUgNzQuNXptMCAwIiBmaWxsPSIjZmZmIi8+PHBhdGggZD0ibTE5LjM0Mzc1IDQ5Mi42MjUgMzMuMjc3MzQ0LTEyMS41MTk1MzFjLTIwLjUzMTI1LTM1LjU2MjUtMzEuMzI0MjE5LTc1LjkxMDE1Ny0zMS4zMTI1LTExNy4yMzQzNzUuMDUwNzgxLTEyOS4yOTY4NzUgMTA1LjI3MzQzNy0yMzQuNDg4MjgyIDIzNC41NTg1OTQtMjM0LjQ4ODI4MiA2Mi43NS4wMjczNDQgMTIxLjY0NDUzMSAyNC40NDkyMTkgMTY1LjkyMTg3NCA2OC43NzM0MzggNDQuMjg5MDYzIDQ0LjMyNDIxOSA2OC42NjQwNjMgMTAzLjI0MjE4OCA2OC42NDA2MjYgMTY1Ljg5ODQzOC0uMDU0Njg4IDEyOS4zMDA3ODEtMTA1LjI4MTI1IDIzNC41MDM5MDYtMjM0LjU1MDc4MiAyMzQuNTAzOTA2LS4wMTE3MTggMCAuMDAzOTA2IDAgMCAwaC0uMTA1NDY4Yy0zOS4yNTM5MDctLjAxNTYyNS03Ny44MjgxMjYtOS44NjcxODgtMTEyLjA4NTkzOC0yOC41MzkwNjN6bTAgMCIgZmlsbD0iIzY0YjE2MSIvPjxnIGZpbGw9IiNmZmYiPjxwYXRoIGQ9Im0xMC44OTQ1MzEgNTAxLjEwNTQ2OSAzNC40Njg3NS0xMjUuODcxMDk0Yy0yMS4yNjE3MTktMzYuODM5ODQ0LTMyLjQ0NTMxMi03OC42Mjg5MDYtMzIuNDI5Njg3LTEyMS40NDE0MDYuMDU0Njg3LTEzMy45MzM1OTQgMTA5LjA0Njg3NS0yNDIuODk4NDM4IDI0Mi45NzY1NjItMjQyLjg5ODQzOCA2NC45OTIxODguMDI3MzQ0IDEyNS45OTYwOTQgMjUuMzI0MjE5IDE3MS44NzEwOTQgNzEuMjM4MjgxIDQ1Ljg3MTA5NCA0NS45MTQwNjMgNzEuMTI1IDEwNi45NDUzMTMgNzEuMTAxNTYyIDE3MS44NTU0NjktLjA1ODU5MyAxMzMuOTI5Njg4LTEwOS4wNjY0MDYgMjQyLjkxMDE1Ny0yNDIuOTcyNjU2IDI0Mi45MTAxNTctLjAwNzgxMiAwIC4wMDM5MDYgMCAwIDBoLS4xMDU0NjhjLTQwLjY2NDA2My0uMDE1NjI2LTgwLjYxNzE4OC0xMC4yMTQ4NDQtMTE2LjEwNTQ2OS0yOS41NzAzMTN6bTEzNC43Njk1MzEtNzcuNzUgNy4zNzg5MDcgNC4zNzEwOTNjMzEgMTguMzk4NDM4IDY2LjU0Mjk2OSAyOC4xMjg5MDcgMTAyLjc4OTA2MiAyOC4xNDg0MzhoLjA3ODEyNWMxMTEuMzA0Njg4IDAgMjAxLjg5ODQzOC05MC41NzgxMjUgMjAxLjk0NTMxMy0yMDEuOTAyMzQ0LjAxOTUzMS01My45NDkyMTgtMjAuOTY0ODQ0LTEwNC42Nzk2ODctNTkuMDkzNzUtMTQyLjgzOTg0NC0zOC4xMzI4MTMtMzguMTYwMTU2LTg4LjgzMjAzMS01OS4xODc1LTE0Mi43NzczNDQtNTkuMjEwOTM3LTExMS4zOTQ1MzEgMC0yMDEuOTg0Mzc1IDkwLjU2NjQwNi0yMDIuMDI3MzQ0IDIwMS44ODY3MTktLjAxNTYyNSAzOC4xNDg0MzcgMTAuNjU2MjUgNzUuMjk2ODc1IDMwLjg3NSAxMDcuNDQ1MzEybDQuODA0Njg4IDcuNjQwNjI1LTIwLjQwNjI1IDc0LjV6bTAgMCIvPjxwYXRoIGQ9Im0xOTUuMTgzNTk0IDE1Mi4yNDYwOTRjLTQuNTQ2ODc1LTEwLjEwOTM3NS05LjMzNTkzOC0xMC4zMTI1LTEzLjY2NDA2My0xMC40ODgyODItMy41MzkwNjItLjE1MjM0My03LjU4OTg0My0uMTQ0NTMxLTExLjYzMjgxMi0uMTQ0NTMxLTQuMDQ2ODc1IDAtMTAuNjI1IDEuNTIzNDM4LTE2LjE4NzUgNy41OTc2NTctNS41NjY0MDcgNi4wNzQyMTgtMjEuMjUzOTA3IDIwLjc2MTcxOC0yMS4yNTM5MDcgNTAuNjMyODEyIDAgMjkuODc1IDIxLjc1NzgxMyA1OC43MzgyODEgMjQuNzkyOTY5IDYyLjc5Mjk2OSAzLjAzNTE1NyA0LjA1MDc4MSA0MiA2Ny4zMDg1OTMgMTAzLjcwNzAzMSA5MS42NDQ1MzEgNTEuMjg1MTU3IDIwLjIyNjU2MiA2MS43MTg3NSAxNi4yMDMxMjUgNzIuODUxNTYzIDE1LjE5MTQwNiAxMS4xMzI4MTMtMS4wMTE3MTggMzUuOTE3OTY5LTE0LjY4NzUgNDAuOTc2NTYzLTI4Ljg2MzI4MSA1LjA2MjUtMTQuMTc1NzgxIDUuMDYyNS0yNi4zMjQyMTkgMy41NDI5NjgtMjguODY3MTg3LTEuNTE5NTMxLTIuNTI3MzQ0LTUuNTY2NDA2LTQuMDQ2ODc2LTExLjYzNjcxOC03LjA4MjAzMi02LjA3MDMxMy0zLjAzNTE1Ni0zNS45MTc5NjktMTcuNzI2NTYyLTQxLjQ4NDM3Ni0xOS43NS01LjU2NjQwNi0yLjAyNzM0NC05LjYxMzI4MS0zLjAzNTE1Ni0xMy42NjAxNTYgMy4wNDI5NjktNC4wNTA3ODEgNi4wNzAzMTMtMTUuNjc1NzgxIDE5Ljc0MjE4Ny0xOS4yMTg3NSAyMy43ODkwNjMtMy41NDI5NjggNC4wNTg1OTMtNy4wODU5MzcgNC41NjY0MDYtMTMuMTU2MjUgMS41MjczNDMtNi4wNzAzMTItMy4wNDI5NjktMjUuNjI1LTkuNDQ5MjE5LTQ4LjgyMDMxMi0zMC4xMzI4MTItMTguMDQ2ODc1LTE2LjA4OTg0NC0zMC4yMzQzNzUtMzUuOTY0ODQ0LTMzLjc3NzM0NC00Mi4wNDI5NjktMy41MzkwNjItNi4wNzAzMTItLjA1ODU5NC05LjA3MDMxMiAyLjY2Nzk2OS0xMi4zODY3MTkgNC45MTAxNTYtNS45NzI2NTYgMTMuMTQ4NDM3LTE2LjcxMDkzNyAxNS4xNzE4NzUtMjAuNzU3ODEyIDIuMDIzNDM3LTQuMDU0Njg4IDEuMDExNzE4LTcuNTk3NjU3LS41MDM5MDYtMTAuNjM2NzE5LTEuNTE5NTMyLTMuMDM1MTU2LTEzLjMyMDMxMy0zMy4wNTg1OTQtMTguNzE0ODQ0LTQ1LjA2NjQwNnptMCAwIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiLz48L2c+PC9zdmc+" />
                        </div>
                        <div class="mt-1 flex justify-center">WhatsApp</div>
                     </a>
                </div>
                <div>
                    <a  href="javascript:windowTelegram('{{$campaign->title}}', '{{$campaign->slug}}')">
                        <div class="flex justify-center">
                             <img class="h-10" src="data:image/svg+xml;base64,PHN2ZyBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyNCAyNCIgaGVpZ2h0PSI1MTIiIHZpZXdCb3g9IjAgMCAyNCAyNCIgd2lkdGg9IjUxMiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIxMiIgY3k9IjEyIiBmaWxsPSIjMDM5YmU1IiByPSIxMiIvPjxwYXRoIGQ9Im01LjQ5MSAxMS43NCAxMS41Ny00LjQ2MWMuNTM3LS4xOTQgMS4wMDYuMTMxLjgzMi45NDNsLjAwMS0uMDAxLTEuOTcgOS4yODFjLS4xNDYuNjU4LS41MzcuODE4LTEuMDg0LjUwOGwtMy0yLjIxMS0xLjQ0NyAxLjM5NGMtLjE2LjE2LS4yOTUuMjk1LS42MDUuMjk1bC4yMTMtMy4wNTMgNS41Ni01LjAyM2MuMjQyLS4yMTMtLjA1NC0uMzMzLS4zNzMtLjEyMWwtNi44NzEgNC4zMjYtMi45NjItLjkyNGMtLjY0My0uMjA0LS42NTctLjY0My4xMzYtLjk1M3oiIGZpbGw9IiNmZmYiLz48L3N2Zz4=" />
                        </div>
                        <div class="mt-1 flex justify-center">Telegram</div>
                     </a>
                </div>
                <div>
                    <a  href="mailto:?subject={{$campaign->title}}  :  yosolidario.com&amp;body=https://www.yosolidario.com/{{$campaign->slug}}" class="keyboard-focusable">
                        <div class=" flex justify-center">
                           <img class="h-10" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNDkwLjY2NyA0OTAuNjY3IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA0OTAuNjY3IDQ5MC42Njc7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwYXRoIHN0eWxlPSJmaWxsOiNGRkQ1NEY7IiBkPSJNNDgwLjQyNywzMi42NDJMMzAxLjAxNCwxNjIuMzQ4bC0yOS40NCwyMS4zMzNjLTE1LjU5NiwxMS41MjItMzYuODg0LDExLjUyMi01Mi40OCwwbC0yOS40NC0yMS4zMzMNCglMMTAuMDI3LDMyLjg1NWM5Ljk5MS0xMy45NzIsMjYuMTMtMjIuMjQxLDQzLjMwNy0yMi4xODdoMzg0QzQ1NC4zODUsMTAuNjgzLDQ3MC40MDEsMTguODUsNDgwLjQyNywzMi42NDJ6Ii8+DQo8Zz4NCgk8cGF0aCBzdHlsZT0iZmlsbDojRkZDMTA3OyIgZD0iTTEwLjAyNywzMi44NTVsMTc5LjYyNywxMjkuNDkzbC0xNzQuMDgsMTc0LjA4QzUuNTc4LDMyNi40MDctMC4wMjUsMzEyLjgyMywwLDI5OC42NjhWNjQuMDAyDQoJCUMtMC4wNDcsNTIuODE4LDMuNDY0LDQxLjkxLDEwLjAyNywzMi44NTV6Ii8+DQoJPHBhdGggc3R5bGU9ImZpbGw6I0ZGQzEwNzsiIGQ9Ik00OTAuNjY3LDY0LjAwMnYyMzQuNjY3YzAuMDI1LDE0LjE1NS01LjU3NywyNy43MzktMTUuNTczLDM3Ljc2bC0xNzQuMDgtMTc0LjA4TDQ4MC40MjcsMzIuNjQyDQoJCUM0ODcuMDg4LDQxLjc0LDQ5MC42NzQsNTIuNzI1LDQ5MC42NjcsNjQuMDAyeiIvPg0KPC9nPg0KPHBhdGggc3R5bGU9ImZpbGw6IzQ1NUE2NDsiIGQ9Ik0zMjAsMzk0LjY2OGMtMTQuMTY1LDAtMjEuMzMzLTEwLjY2Ny0yMS4zMzMtMzJjMC4zNDktMjkuODA3LTIzLjUzMS01NC4yNTItNTMuMzM4LTU0LjYwMQ0KCWMtMjkuODA3LTAuMzQ5LTU0LjI1MiwyMy41MzEtNTQuNjAxLDUzLjMzOGMtMC4zNDksMjkuODA3LDIzLjUzMSw1NC4yNTIsNTMuMzM4LDU0LjYwMWMxNS45NzUsMC4xODcsMzEuMjEyLTYuNzEzLDQxLjYwOS0xOC44NDINCgljNy4wODMsMTIuMTM4LDIwLjI4MiwxOS4zODEsMzQuMzI1LDE4LjgzN2M0Mi42NjcsMCw0Mi42NjctNDAuMTQ5LDQyLjY2Ny01My4zMzNjMC4wMDEtNjQuODAxLTUyLjUzLTExNy4zMzQtMTE3LjMzMS0xMTcuMzM2DQoJUzEyOC4wMDIsMjk3Ljg2MiwxMjgsMzYyLjY2NGMtMC4wMDEsNjQuODAxLDUyLjUzLDExNy4zMzQsMTE3LjMzMSwxMTcuMzM2YzMwLjQ0NSwwLjAwMSw1OS42OTktMTEuODMzLDgxLjU4MS0zMw0KCWM0LjIzNi00LjEyNCw0LjMyNi0xMC45LDAuMjAzLTE1LjEzNmMtNC4xMjQtNC4yMzYtMTAuOS00LjMyNi0xNS4xMzYtMC4yMDNsMCwwYy0zOC4xNjEsMzYuODA3LTk4LjkzNSwzNS43MDktMTM1Ljc0Mi0yLjQ1Mg0KCXMtMzUuNzA5LTk4LjkzNSwyLjQ1Mi0xMzUuNzQyYzM4LjE2MS0zNi44MDcsOTguOTM1LTM1LjcwOSwxMzUuNzQyLDIuNDUyYzE3LjI4NCwxNy45MiwyNi45Myw0MS44NTQsMjYuOTAzLDY2Ljc1DQoJQzM0MS4zMzQsMzg2LjU4MywzMzUuOTU4LDM5NC42NjgsMzIwLDM5NC42Njh6IE0yNDUuMzM0LDM5NC42NjhjLTE3LjY3MywwLTMyLTE0LjMyNy0zMi0zMnMxNC4zMjctMzIsMzItMzJzMzIsMTQuMzI3LDMyLDMyDQoJUzI2My4wMDcsMzk0LjY2OCwyNDUuMzM0LDM5NC42Njh6Ii8+DQo8cGF0aCBzdHlsZT0iZmlsbDojRkZBMDAwOyIgZD0iTTMwMS4wMTQsMTYyLjM0OGwtMjkuNDQsMjEuMzMzYy0xNS41OTYsMTEuNTIyLTM2Ljg4NCwxMS41MjItNTIuNDgsMGwtMjkuNDQtMjEuMzMzbC0xNzQuMDgsMTc0LjA4DQoJYzEwLjAyMSw5Ljk5NiwyMy42MDUsMTUuNTk5LDM3Ljc2LDE1LjU3M0gxMDcuMmM1Ljc3MS03Ni4yODMsNzIuMjg4LTEzMy40NDUsMTQ4LjU3Mi0xMjcuNjc0DQoJYzY4LjI1OSw1LjE2NCwxMjIuNTEsNTkuNDE1LDEyNy42NzQsMTI3LjY3NGg1My44ODhjMTQuMTU1LDAuMDI1LDI3LjczOS01LjU3NywzNy43Ni0xNS41NzNMMzAxLjAxNCwxNjIuMzQ4eiIvPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPC9zdmc+DQo=" />
                        </div>
                        <div class="mt-1 flex justify-center">Email</div>
                    </a>
                </div>
                <div>
                    <div class="cursor-pointer">
                        <a href="{{route('campaign/poster', $campaign->slug)}}" target="_black">
                            <div class="flex justify-center">
                                <img class="h-10" src="data:image/svg+xml;base64,PHN2ZyBpZD0iQ2FwYV8xIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCA1MTIgNTEyIiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHdpZHRoPSI1MTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGc+PHBhdGggZD0ibTQzNyAxMjloLTE0di01NGMwLTQxLjM1NS0zMy42NDUtNzUtNzUtNzVoLTE4NGMtNDEuMzU1IDAtNzUgMzMuNjQ1LTc1IDc1djU0aC0xNGMtNDEuMzU1IDAtNzUgMzMuNjQ1LTc1IDc1djEyMGMwIDQxLjM1NSAzMy42NDUgNzUgNzUgNzVoMTR2NjhjMCAyNC44MTMgMjAuMTg3IDQ1IDQ1IDQ1aDI0NGMyNC44MTMgMCA0NS0yMC4xODcgNDUtNDV2LTY4aDE0YzQxLjM1NSAwIDc1LTMzLjY0NSA3NS03NXYtMTIwYzAtNDEuMzU1LTMzLjY0NS03NS03NS03NXptLTMxOC01NGMwLTI0LjgxMyAyMC4xODctNDUgNDUtNDVoMTg0YzI0LjgxMyAwIDQ1IDIwLjE4NyA0NSA0NXY1NGgtMjc0em0yNzQgMzkyYzAgOC4yNzEtNi43MjkgMTUtMTUgMTVoLTI0NGMtOC4yNzEgMC0xNS02LjcyOS0xNS0xNXYtMTQ4aDI3NHptODktMTQzYzAgMjQuODEzLTIwLjE4NyA0NS00NSA0NWgtMTR2LTUwaDljOC4yODQgMCAxNS02LjcxNiAxNS0xNXMtNi43MTYtMTUtMTUtMTVoLTM1MmMtOC4yODQgMC0xNSA2LjcxNi0xNSAxNXM2LjcxNiAxNSAxNSAxNWg5djUwaC0xNGMtMjQuODEzIDAtNDUtMjAuMTg3LTQ1LTQ1di0xMjBjMC0yNC44MTMgMjAuMTg3LTQ1IDQ1LTQ1aDM2MmMyNC44MTMgMCA0NSAyMC4xODcgNDUgNDV6Ii8+PHBhdGggZD0ibTI5NiAzNTNoLTgwYy04LjI4NCAwLTE1IDYuNzE2LTE1IDE1czYuNzE2IDE1IDE1IDE1aDgwYzguMjg0IDAgMTUtNi43MTYgMTUtMTVzLTYuNzE2LTE1LTE1LTE1eiIvPjxwYXRoIGQ9Im0yOTYgNDE3aC04MGMtOC4yODQgMC0xNSA2LjcxNi0xNSAxNXM2LjcxNiAxNSAxNSAxNWg4MGM4LjI4NCAwIDE1LTYuNzE2IDE1LTE1cy02LjcxNi0xNS0xNS0xNXoiLz48cGF0aCBkPSJtMTI4IDE5M2gtNDhjLTguMjg0IDAtMTUgNi43MTYtMTUgMTVzNi43MTYgMTUgMTUgMTVoNDhjOC4yODQgMCAxNS02LjcxNiAxNS0xNXMtNi43MTYtMTUtMTUtMTV6Ii8+PC9nPjwvc3ZnPg==" />
                            </div>
                            <div class="mt-1 flex justify-center text-center">
                                {{__('Print Poster')}}
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <x-section-border />
            <x-action-message class="mr-3" on="message">
                <div class="flex space-x-1 items-center">
                    <span class="material-icons-outlined text-sm">done</span>
                    <span class="text-ys1">
                        {{ __($message) }}
                    </span>
                </div>
            </x-action-message>

            <p id="p1" class="border p-2">https://yosolidario.com/{{$campaign->slug}}</p>

            <x-secondary-button wire:click="messageCopy" class="mt-2">
                <span class="material-icons-outlined text-sm mr-1">content_copy</span>
                {{__('Copy link')}}
            </x-secondary-button>
            
            <div wire:click="messageCopy" class="mt-3 bg-red-50 p-3 cursor-pointer rounded-sm" onclick="copyToClipboard('p1')">
                <div class="flex justify-center space-x-1">
                    <span class="font-bold">{{__('Tip')}} </span>
                    <span>{{__('Paste this fundraiser link anywhere')}}</span>
                </div>
                <div class="flex justify-center items-center mt-1 space-x-2">
                    <img class="h-9" src="data:image/svg+xml;base64,PHN2ZyBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyNCAyNCIgaGVpZ2h0PSI1MTIiIHZpZXdCb3g9IjAgMCAyNCAyNCIgd2lkdGg9IjUxMiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+PGxpbmVhckdyYWRpZW50IGlkPSJTVkdJRF8xXyIgZ3JhZGllbnRUcmFuc2Zvcm09Im1hdHJpeCgwIC0xLjk4MiAtMS44NDQgMCAtMTMyLjUyMiAtNTEuMDc3KSIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSItMzcuMTA2IiB4Mj0iLTI2LjU1NSIgeTE9Ii03Mi43MDUiIHkyPSItODQuMDQ3Ij48c3RvcCBvZmZzZXQ9IjAiIHN0b3AtY29sb3I9IiNmZDUiLz48c3RvcCBvZmZzZXQ9Ii41IiBzdG9wLWNvbG9yPSIjZmY1NDNlIi8+PHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjYzgzN2FiIi8+PC9saW5lYXJHcmFkaWVudD48cGF0aCBkPSJtMS41IDEuNjMzYy0xLjg4NiAxLjk1OS0xLjUgNC4wNC0xLjUgMTAuMzYyIDAgNS4yNS0uOTE2IDEwLjUxMyAzLjg3OCAxMS43NTIgMS40OTcuMzg1IDE0Ljc2MS4zODUgMTYuMjU2LS4wMDIgMS45OTYtLjUxNSAzLjYyLTIuMTM0IDMuODQyLTQuOTU3LjAzMS0uMzk0LjAzMS0xMy4xODUtLjAwMS0xMy41ODctLjIzNi0zLjAwNy0yLjA4Ny00Ljc0LTQuNTI2LTUuMDkxLS41NTktLjA4MS0uNjcxLS4xMDUtMy41MzktLjExLTEwLjE3My4wMDUtMTIuNDAzLS40NDgtMTQuNDEgMS42MzN6IiBmaWxsPSJ1cmwoI1NWR0lEXzFfKSIvPjxwYXRoIGQ9Im0xMS45OTggMy4xMzljLTMuNjMxIDAtNy4wNzktLjMyMy04LjM5NiAzLjA1Ny0uNTQ0IDEuMzk2LS40NjUgMy4yMDktLjQ2NSA1LjgwNSAwIDIuMjc4LS4wNzMgNC40MTkuNDY1IDUuODA0IDEuMzE0IDMuMzgyIDQuNzkgMy4wNTggOC4zOTQgMy4wNTggMy40NzcgMCA3LjA2Mi4zNjIgOC4zOTUtMy4wNTguNTQ1LTEuNDEuNDY1LTMuMTk2LjQ2NS01LjgwNCAwLTMuNDYyLjE5MS01LjY5Ny0xLjQ4OC03LjM3NS0xLjctMS43LTMuOTk5LTEuNDg3LTcuMzc0LTEuNDg3em0tLjc5NCAxLjU5N2M3LjU3NC0uMDEyIDguNTM4LS44NTQgOC4wMDYgMTAuODQzLS4xODkgNC4xMzctMy4zMzkgMy42ODMtNy4yMTEgMy42ODMtNy4wNiAwLTcuMjYzLS4yMDItNy4yNjMtNy4yNjUgMC03LjE0NS41Ni03LjI1NyA2LjQ2OC03LjI2M3ptNS41MjQgMS40NzFjLS41ODcgMC0xLjA2My40NzYtMS4wNjMgMS4wNjNzLjQ3NiAxLjA2MyAxLjA2MyAxLjA2MyAxLjA2My0uNDc2IDEuMDYzLTEuMDYzLS40NzYtMS4wNjMtMS4wNjMtMS4wNjN6bS00LjczIDEuMjQzYy0yLjUxMyAwLTQuNTUgMi4wMzgtNC41NSA0LjU1MXMyLjAzNyA0LjU1IDQuNTUgNC41NSA0LjU0OS0yLjAzNyA0LjU0OS00LjU1LTIuMDM2LTQuNTUxLTQuNTQ5LTQuNTUxem0wIDEuNTk3YzMuOTA1IDAgMy45MSA1LjkwOCAwIDUuOTA4LTMuOTA0IDAtMy45MS01LjkwOCAwLTUuOTA4eiIgZmlsbD0iI2ZmZiIvPjwvc3ZnPg==" />
                    <img class="h-9" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgdmlld0JveD0iMCAwIDQ3My45MzEgNDczLjkzMSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDczLjkzMSA0NzMuOTMxOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8Y2lyY2xlIHN0eWxlPSJmaWxsOiNENDI0Mjg7IiBjeD0iMjM2Ljk2NiIgY3k9IjIzNi45NjYiIHI9IjIzNi45NjYiLz4NCjxwYXRoIHN0eWxlPSJmaWxsOiNDQzIwMkQ7IiBkPSJNNDA0LjUxOCw2OS4zOGM5Mi41NDEsOTIuNTQ5LDkyLjU0OSwyNDIuNTkzLDAsMzM1LjE0MmMtOTIuNTQxLDkyLjU0MS0yNDIuNTkzLDkyLjU0NS0zMzUuMTQyLDANCglMNDA0LjUxOCw2OS4zOHoiLz4NCjxwYXRoIHN0eWxlPSJmaWxsOiNCQTIwMkU7IiBkPSJNNDY5LjE2OCwyODQuNDI2TDM1MS44ODYsMTY3LjE0OGwtMTM4LjMyMiwxNS43NDlsLTgzLjY2OSwxMjkuNTMybDE1Ni4zNDIsMTU2LjMzOA0KCUMzNzguMTU3LDQ0OS4zMjIsNDUwLjQyMiwzNzYuNjEyLDQ2OS4xNjgsMjg0LjQyNnoiLz4NCjxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNMzYwLjk3MSwxOTEuMjM4YzAtMTkuODY1LTE2LjA5My0zNS45NjYtMzUuOTQ3LTM1Ljk2NkgxNTYuMzcyYy0xOS44NSwwLTM1Ljk0LDE2LjEwNS0zNS45NCwzNS45NjYNCgl2OTYuNDQ0YzAsMTkuODY1LDE2LjA5MywzNS45NjYsMzUuOTQsMzUuOTY2aDE2OC42NDljMTkuODU4LDAsMzUuOTQ3LTE2LjEwNSwzNS45NDctMzUuOTY2di05Ni40NDRIMzYwLjk3MXogTTIxNi42NCwyODAuMTQ2DQoJdi05MC41ODRsNjguNjk1LDQ1LjI5NEwyMTYuNjQsMjgwLjE0NnoiLz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K" />
                    <img class="h-9" src="data:image/svg+xml;base64,PHN2ZyBpZD0iQ2FwYV8xIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCA1MTIgNTEyIiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHdpZHRoPSI1MTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0ibTI1NiAwYy0xNDEuMzYzIDAtMjU2IDExNC42MzctMjU2IDI1NnMxMTQuNjM3IDI1NiAyNTYgMjU2IDI1Ni0xMTQuNjM3IDI1Ni0yNTYtMTE0LjYzNy0yNTYtMjU2LTI1NnptMTI4LjQzIDE5NS44NzN2MzQuNjYzYy0xNi4zNDUuMDA2LTMyLjIyNi0zLjE5Ny00Ny4yMDQtOS41MTYtOS42MzEtNC4wNjYtMTguNjA0LTkuMzA1LTI2LjgxMS0xNS42MzZsLjI0NiAxMDYuNjkzYy0uMTAzIDI0LjAyNS05LjYwOCA0Ni41OTgtMjYuODExIDYzLjYwMS0xNCAxMy44NC0zMS43NCAyMi42NDEtNTAuOTY4IDI1LjQ5LTQuNTE4LjY2OS05LjExNiAxLjAxMi0xMy43NjYgMS4wMTItMjAuNTgzIDAtNDAuMTI0LTYuNjY4LTU2LjEwOS0xOC45Ny0zLjAwOC0yLjMxNi01Ljg4NS00LjgyNy04LjYyNC03LjUzMi0xOC42NDQtMTguNDI3LTI4LjI1OC00My40MDEtMjYuNjM5LTY5LjY3NCAxLjIzNS0xOS45OTkgOS4yNDItMzkuMDcyIDIyLjU5LTU0LjAyMSAxNy42Ni0xOS43ODIgNDIuMzY2LTMwLjc2MiA2OC43ODItMzAuNzYyIDQuNjUgMCA5LjI0OC4zNDkgMTMuNzY2IDEuMDE4djEyLjgxNiAzNS42NTJjLTQuMjg0LTEuNDEzLTguODU5LTIuMTktMTMuNjIzLTIuMTktMjQuMTM0IDAtNDMuNjU5IDE5LjY5LTQzLjI5OCA0My44NDIuMjI5IDE1LjQ1MyA4LjY3IDI4Ljk2MSAyMS4xMiAzNi40MDcgNS44NTEgMy41IDEyLjU4MiA1LjY2OCAxOS43NjUgNi4wNjIgNS42MjguMzA5IDExLjAzMi0uNDc1IDE2LjAzNi0yLjEyNyAxNy4yNDMtNS42OTYgMjkuNjgyLTIxLjg5MiAyOS42ODItNDAuOTk0bC4wNTctNzEuNDQ3di0xMzAuNDRoNDcuNzM2Yy4wNDYgNC43My41MjYgOS4zNDUgMS40MTggMTMuODE3IDMuNjAzIDE4LjEwMSAxMy44MDYgMzMuODA1IDI4LjAwNiA0NC41MTEgMTIuMzgyIDkuMzM5IDI3LjggMTQuODc1IDQ0LjUxMSAxNC44NzUuMDExIDAgLjE0OSAwIC4xMzctLjAxMXYxMi44NjF6Ii8+PC9zdmc+" />
                    <img class="h-9" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgdmlld0JveD0iMCAwIDM4MiAzODIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDM4MiAzODI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwYXRoIHN0eWxlPSJmaWxsOiMwMDc3Qjc7IiBkPSJNMzQ3LjQ0NSwwSDM0LjU1NUMxNS40NzEsMCwwLDE1LjQ3MSwwLDM0LjU1NXYzMTIuODg5QzAsMzY2LjUyOSwxNS40NzEsMzgyLDM0LjU1NSwzODJoMzEyLjg4OQ0KCUMzNjYuNTI5LDM4MiwzODIsMzY2LjUyOSwzODIsMzQ3LjQ0NFYzNC41NTVDMzgyLDE1LjQ3MSwzNjYuNTI5LDAsMzQ3LjQ0NSwweiBNMTE4LjIwNywzMjkuODQ0YzAsNS41NTQtNC41MDIsMTAuMDU2LTEwLjA1NiwxMC4wNTYNCglINjUuMzQ1Yy01LjU1NCwwLTEwLjA1Ni00LjUwMi0xMC4wNTYtMTAuMDU2VjE1MC40MDNjMC01LjU1NCw0LjUwMi0xMC4wNTYsMTAuMDU2LTEwLjA1Nmg0Mi44MDYNCgljNS41NTQsMCwxMC4wNTYsNC41MDIsMTAuMDU2LDEwLjA1NlYzMjkuODQ0eiBNODYuNzQ4LDEyMy40MzJjLTIyLjQ1OSwwLTQwLjY2Ni0xOC4yMDctNDAuNjY2LTQwLjY2NlM2NC4yODksNDIuMSw4Ni43NDgsNDIuMQ0KCXM0MC42NjYsMTguMjA3LDQwLjY2Niw0MC42NjZTMTA5LjIwOCwxMjMuNDMyLDg2Ljc0OCwxMjMuNDMyeiBNMzQxLjkxLDMzMC42NTRjMCw1LjEwNi00LjE0LDkuMjQ2LTkuMjQ2LDkuMjQ2SDI4Ni43Mw0KCWMtNS4xMDYsMC05LjI0Ni00LjE0LTkuMjQ2LTkuMjQ2di04NC4xNjhjMC0xMi41NTYsMy42ODMtNTUuMDIxLTMyLjgxMy01NS4wMjFjLTI4LjMwOSwwLTM0LjA1MSwyOS4wNjYtMzUuMjA0LDQyLjExdjk3LjA3OQ0KCWMwLDUuMTA2LTQuMTM5LDkuMjQ2LTkuMjQ2LDkuMjQ2aC00NC40MjZjLTUuMTA2LDAtOS4yNDYtNC4xNC05LjI0Ni05LjI0NlYxNDkuNTkzYzAtNS4xMDYsNC4xNC05LjI0Niw5LjI0Ni05LjI0Nmg0NC40MjYNCgljNS4xMDYsMCw5LjI0Niw0LjE0LDkuMjQ2LDkuMjQ2djE1LjY1NWMxMC40OTctMTUuNzUzLDI2LjA5Ny0yNy45MTIsNTkuMzEyLTI3LjkxMmM3My41NTIsMCw3My4xMzEsNjguNzE2LDczLjEzMSwxMDYuNDcyDQoJTDM0MS45MSwzMzAuNjU0TDM0MS45MSwzMzAuNjU0eiIvPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPC9zdmc+DQo=" />
                </div>
            </div>

            <!-- embed html -->
            @else 
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-3">
                <div class="py-3 w-full">
                    <div>
                        <input wire:model="widget" name="widget" type="radio" value="large" />
                        <span class="ml-1"> {{__('Large')}}</span>
                    </div>
                    <div class="mt-4">
                        <input wire:model="widget" name="widget" type="radio" value="medium" />
                        <span class="ml-1">{{__('Medium')}}</span>
                    </div>
                    <div class="mt-4">
                        <input wire:model="widget" name="widget" type="radio" value="small" />
                        <span class="ml-1">{{__('Small')}}</span>
                    </div>
                    <x-section-border />
                    <div class="w-full mt-3 sm:mt-0">
                        <x-label for="copyLarge" value="{{ __('Copy and paste the following embed code') }}" />
                        @if($widget == 'large')
                            <x-textarea class="mt-1 block w-full"  rows="5" wire:model.defer="copyLarge"/>
                        @elseif($widget == 'medium')
                            <x-textarea class="mt-1 block w-full"  rows="5" wire:model.defer="copyMedium"/>
                        @elseif($widget == 'small')
                            <x-textarea class="mt-1 block w-full"  rows="5" wire:model.defer="copySmall"/>
                        @endif
                    </div>
                </div>
                <div class="">
                    <div class="text-center font-bold my-2 uppercase text-2xl">{{__("Preview")}}</div>
                    @if($widget == 'large')
                        <iframe src="{{ $host}}/{{$campaign->slug}}/widget/large/?iframe=true" height="420"></iframe>
                    @elseif($widget == 'medium')
                        <iframe src="{{ $host}}/{{$campaign->slug}}/widget/medium/?iframe=true" height="245"></iframe>
                    @elseif($widget == 'small')
                        <iframe src="{{ $host}}/{{$campaign->slug}}/widget/small/?iframe=true" height="60"></iframe>
                    @endif
                </div>
            </div>
            @endif
            <script> 
                var myWidth = 1050;
                var myHeight = 550;
                var left = (screen.width - myWidth) / 2;
                var top = (screen.height - myHeight) / 4;
    
                function windowTwitter (title, slug){ 
                    var myURL = "https://twitter.com/intent/tweet?text="+title+" https://www.yosolidario.com/"+slug+"";
                    windowOpen(myURL, title);
                }
                function windowFacebook(title, slug){ 
                    FB.ui({
                        method: 'share',
                        href: "https://www.yosolidario.com/"+slug,
                        }, function(response){});
                    //var myURL = "https://www.facebook.com/sharer/sharer.php?u=https://www.yosolidario.com/"+slug+"&src=sdkpreparse";
                    windowOpen(myURL, title);
                } 
                function windowWhatsApp(title, slug){ 
                    var myURL = "https://wa.me/?text=https://www.yosolidario.com/"+slug+"";
                    windowOpen(myURL, title);
                }
                function windowTelegram(title, slug){ 
                    var myURL = "https://t.me/share/url?url=https://www.yosolidario.com/"+slug+"&text="+title+"";
                    windowOpen(myURL, title);
                }
                function windowMessenger(title, slug){ 
                    FB.ui({
                        method: 'send',
                        link: "https://www.yosolidario.com/"+slug,
                        });
                    //var myURL = "https://www.facebook.com/v7.0/dialog/send?app_id=407682420960&channel_url=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df671437134a888%26domain%3Dwww.gofundme.com%26origin%3Dhttps%253A%252F%252Fwww.gofundme.com%252Ff1e014553c66d74%26relation%3Dopener&display=popup&e2e=%7B%7D&fallback_redirect_uri=https%3A%2F%2Fwww.gofundme.com%2Fshare%2Fs%2Fshare-family-friends%2Fmano-con-mano-por-gaby&link=https%3A%2F%2Fwww.gofundme.com%2Ff%2Fmano-con-mano-por-gaby%3Futm_source%3Dmessenger%26utm_medium%3Dsocial%26utm_campaign%3Dp_cf%2Bshare-flow-1&locale=en_US&next=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Dfc4bc0116622d%26domain%3Dwww.gofundme.com%26origin%3Dhttps%253A%252F%252Fwww.gofundme.com%252Ff1e014553c66d74%26relation%3Dopener%26frame%3Df32a0c8523ea0bc%26result%3D%2522xxRESULTTOKENxx%2522&sdk=joey&version=v7.0";
                    //var myURL = "http://www.facebook.com/dialog/send?app_id=123456789&amp;link=http://www.nytimes.com/interactive/2015/04/15/travel/europe-favorite-streets.html&amp;redirect_uri=https://www.domain.com/";
                    //windowOpen(myURL, title);
                }
                function windowOpen(myURL, title) {
                    var myWindow = window.open(myURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + myWidth + ', height=' + myHeight + ', top=' + top + ', left=' + left);
                } 
                function copyToClipboard(id_element) {
                    var aux = document.createElement("input");
                    aux.setAttribute("value", document.getElementById(id_element).innerHTML);
                    document.body.appendChild(aux);
                    aux.select();
                    document.execCommand("copy");
                    document.body.removeChild(aux);
                }
            </script>
        </x-slot>
        <x-slot name="footer">
            
        </x-slot>
    </x-dialog-modal>
</div>