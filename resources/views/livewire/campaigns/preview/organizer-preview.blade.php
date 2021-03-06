<div>
    @if ($this->campaign->type_campaign == 'PERSONAL' or $this->campaign->type_campaign == 'PERSONAL_ORGANIZATION')
    <div class="flex justify-end mt-5 sm:mt-0">
        <div class="flex items-center ">
            @if($this->campaign->user->profile_photo_path)
            <div wire:click="viewUser({{$this->campaign->user->id}})" wire:loading.attr="disabled" class="flex-shrink-0 w-14 h-14 cursor-pointer">
                <img class="h-14 w-14 rounded-full object-cover"
                    src="{{ URL::to('/') }}{{$this->campaign->user->profile_photo_path}}"
                    alt="" />
            </div>
            @else 
            <div wire:click="viewUser({{$this->campaign->user->id}})" class="flex-shrink-0 w-14 h-14 cursor-pointer">
                <img class="h-14 w-14 rounded-full object-cover"
                    src="{{ $this->campaign->user->profile_photo_url }}" alt="{{ $this->campaign->user->name }}" />
            </div>
            @endif
            <div class="ml-3 space-y-2">
                <div wire:click="viewUser({{$this->campaign->user->id}})" class="text-gray-900 text-sm sm:text-base cursor-pointer"> 
                    <span class="font-bold">{{__('Organizator')}}: </span>
                    {{$this->campaign->user->name}}
                </div>

                @if($this->campaign->user->profile)
                <div class="flex item-center space-x-3">
                    @if($this->campaign->user->profile->facebook)
                    <a href="https://www.facebook.com/{{$this->campaign->user->profile->facebook}}" target="_blank">
                        <img class="h-5" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE4LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgdmlld0JveD0iMCAwIDExMi4xOTYgMTEyLjE5NiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMTEyLjE5NiAxMTIuMTk2OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8Zz4NCgk8Y2lyY2xlIHN0eWxlPSJmaWxsOiMzQjU5OTg7IiBjeD0iNTYuMDk4IiBjeT0iNTYuMDk4IiByPSI1Ni4wOTgiLz4NCgk8cGF0aCBzdHlsZT0iZmlsbDojRkZGRkZGOyIgZD0iTTcwLjIwMSw1OC4yOTRoLTEwLjAxdjM2LjY3Mkg0NS4wMjVWNTguMjk0aC03LjIxM1Y0NS40MDZoNy4yMTN2LTguMzQNCgkJYzAtNS45NjQsMi44MzMtMTUuMzAzLDE1LjMwMS0xNS4zMDNMNzEuNTYsMjEuODF2MTIuNTFoLTguMTUxYy0xLjMzNywwLTMuMjE3LDAuNjY4LTMuMjE3LDMuNTEzdjcuNTg1aDExLjMzNEw3MC4yMDEsNTguMjk0eiIvPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPC9zdmc+DQo=" />
                    </a>
                    @endif
                    @if($this->campaign->user->profile->twitter)
                    <a href="https://www.twitter.com/{{$this->campaign->user->profile->twitter}}" target="_blank">
                        <img class="h-5" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHBhdGggc3R5bGU9ImZpbGw6IzAzQTlGNDsiIGQ9Ik01MTIsOTcuMjQ4Yy0xOS4wNCw4LjM1Mi0zOS4zMjgsMTMuODg4LTYwLjQ4LDE2LjU3NmMyMS43Ni0xMi45OTIsMzguMzY4LTMzLjQwOCw0Ni4xNzYtNTguMDE2DQoJYy0yMC4yODgsMTIuMDk2LTQyLjY4OCwyMC42NC02Ni41NiwyNS40MDhDNDExLjg3Miw2MC43MDQsMzg0LjQxNiw0OCwzNTQuNDY0LDQ4Yy01OC4xMTIsMC0xMDQuODk2LDQ3LjE2OC0xMDQuODk2LDEwNC45OTINCgljMCw4LjMyLDAuNzA0LDE2LjMyLDIuNDMyLDIzLjkzNmMtODcuMjY0LTQuMjU2LTE2NC40OC00Ni4wOC0yMTYuMzUyLTEwOS43OTJjLTkuMDU2LDE1LjcxMi0xNC4zNjgsMzMuNjk2LTE0LjM2OCw1My4wNTYNCgljMCwzNi4zNTIsMTguNzIsNjguNTc2LDQ2LjYyNCw4Ny4yMzJjLTE2Ljg2NC0wLjMyLTMzLjQwOC01LjIxNi00Ny40MjQtMTIuOTI4YzAsMC4zMiwwLDAuNzM2LDAsMS4xNTINCgljMCw1MS4wMDgsMzYuMzg0LDkzLjM3Niw4NC4wOTYsMTAzLjEzNmMtOC41NDQsMi4zMzYtMTcuODU2LDMuNDU2LTI3LjUyLDMuNDU2Yy02LjcyLDAtMTMuNTA0LTAuMzg0LTE5Ljg3Mi0xLjc5Mg0KCWMxMy42LDQxLjU2OCw1Mi4xOTIsNzIuMTI4LDk4LjA4LDczLjEyYy0zNS43MTIsMjcuOTM2LTgxLjA1Niw0NC43NjgtMTMwLjE0NCw0NC43NjhjLTguNjA4LDAtMTYuODY0LTAuMzg0LTI1LjEyLTEuNDQNCglDNDYuNDk2LDQ0Ni44OCwxMDEuNiw0NjQsMTYxLjAyNCw0NjRjMTkzLjE1MiwwLDI5OC43NTItMTYwLDI5OC43NTItMjk4LjY4OGMwLTQuNjQtMC4xNi05LjEyLTAuMzg0LTEzLjU2OA0KCUM0ODAuMjI0LDEzNi45Niw0OTcuNzI4LDExOC40OTYsNTEyLDk3LjI0OHoiLz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K" />
                    </a>
                    @endif
                    @if($this->campaign->user->profile->instagram)
                    <a href="https://www.instagram.com/{{$this->campaign->user->profile->instagram}}" target="_blank">
                        <img class="h-5" src="data:image/svg+xml;base64,PHN2ZyBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyNCAyNCIgaGVpZ2h0PSI1MTIiIHZpZXdCb3g9IjAgMCAyNCAyNCIgd2lkdGg9IjUxMiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+PGxpbmVhckdyYWRpZW50IGlkPSJTVkdJRF8xXyIgZ3JhZGllbnRUcmFuc2Zvcm09Im1hdHJpeCgwIC0xLjk4MiAtMS44NDQgMCAtMTMyLjUyMiAtNTEuMDc3KSIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSItMzcuMTA2IiB4Mj0iLTI2LjU1NSIgeTE9Ii03Mi43MDUiIHkyPSItODQuMDQ3Ij48c3RvcCBvZmZzZXQ9IjAiIHN0b3AtY29sb3I9IiNmZDUiLz48c3RvcCBvZmZzZXQ9Ii41IiBzdG9wLWNvbG9yPSIjZmY1NDNlIi8+PHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjYzgzN2FiIi8+PC9saW5lYXJHcmFkaWVudD48cGF0aCBkPSJtMS41IDEuNjMzYy0xLjg4NiAxLjk1OS0xLjUgNC4wNC0xLjUgMTAuMzYyIDAgNS4yNS0uOTE2IDEwLjUxMyAzLjg3OCAxMS43NTIgMS40OTcuMzg1IDE0Ljc2MS4zODUgMTYuMjU2LS4wMDIgMS45OTYtLjUxNSAzLjYyLTIuMTM0IDMuODQyLTQuOTU3LjAzMS0uMzk0LjAzMS0xMy4xODUtLjAwMS0xMy41ODctLjIzNi0zLjAwNy0yLjA4Ny00Ljc0LTQuNTI2LTUuMDkxLS41NTktLjA4MS0uNjcxLS4xMDUtMy41MzktLjExLTEwLjE3My4wMDUtMTIuNDAzLS40NDgtMTQuNDEgMS42MzN6IiBmaWxsPSJ1cmwoI1NWR0lEXzFfKSIvPjxwYXRoIGQ9Im0xMS45OTggMy4xMzljLTMuNjMxIDAtNy4wNzktLjMyMy04LjM5NiAzLjA1Ny0uNTQ0IDEuMzk2LS40NjUgMy4yMDktLjQ2NSA1LjgwNSAwIDIuMjc4LS4wNzMgNC40MTkuNDY1IDUuODA0IDEuMzE0IDMuMzgyIDQuNzkgMy4wNTggOC4zOTQgMy4wNTggMy40NzcgMCA3LjA2Mi4zNjIgOC4zOTUtMy4wNTguNTQ1LTEuNDEuNDY1LTMuMTk2LjQ2NS01LjgwNCAwLTMuNDYyLjE5MS01LjY5Ny0xLjQ4OC03LjM3NS0xLjctMS43LTMuOTk5LTEuNDg3LTcuMzc0LTEuNDg3em0tLjc5NCAxLjU5N2M3LjU3NC0uMDEyIDguNTM4LS44NTQgOC4wMDYgMTAuODQzLS4xODkgNC4xMzctMy4zMzkgMy42ODMtNy4yMTEgMy42ODMtNy4wNiAwLTcuMjYzLS4yMDItNy4yNjMtNy4yNjUgMC03LjE0NS41Ni03LjI1NyA2LjQ2OC03LjI2M3ptNS41MjQgMS40NzFjLS41ODcgMC0xLjA2My40NzYtMS4wNjMgMS4wNjNzLjQ3NiAxLjA2MyAxLjA2MyAxLjA2MyAxLjA2My0uNDc2IDEuMDYzLTEuMDYzLS40NzYtMS4wNjMtMS4wNjMtMS4wNjN6bS00LjczIDEuMjQzYy0yLjUxMyAwLTQuNTUgMi4wMzgtNC41NSA0LjU1MXMyLjAzNyA0LjU1IDQuNTUgNC41NSA0LjU0OS0yLjAzNyA0LjU0OS00LjU1LTIuMDM2LTQuNTUxLTQuNTQ5LTQuNTUxem0wIDEuNTk3YzMuOTA1IDAgMy45MSA1LjkwOCAwIDUuOTA4LTMuOTA0IDAtMy45MS01LjkwOCAwLTUuOTA4eiIgZmlsbD0iI2ZmZiIvPjwvc3ZnPg==" />
                    </a>
                    @endif
                    @if($this->campaign->user->country)
                    <a href="https://api.whatsapp.com/send?phone={{$this->campaign->user->country->telephone_prefix}}{{$this->campaign->user->profile->whatsapp}}" target="_blank">
                        <img class="h-5" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjUxMnB0IiB2aWV3Qm94PSItMSAwIDUxMiA1MTIiIHdpZHRoPSI1MTJwdCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJtMTAuODk0NTMxIDUxMmMtMi44NzUgMC01LjY3MTg3NS0xLjEzNjcxOS03Ljc0NjA5My0zLjIzNDM3NS0yLjczNDM3Ni0yLjc2NTYyNS0zLjc4OTA2My02Ljc4MTI1LTIuNzYxNzE5LTEwLjUzNTE1NmwzMy4yODUxNTYtMTIxLjU0Njg3NWMtMjAuNzIyNjU2LTM3LjQ3MjY1Ni0zMS42NDg0MzctNzkuODYzMjgyLTMxLjYzMjgxMy0xMjIuODk0NTMyLjA1ODU5NC0xMzkuOTQxNDA2IDExMy45NDE0MDctMjUzLjc4OTA2MiAyNTMuODcxMDk0LTI1My43ODkwNjIgNjcuODcxMDk0LjAyNzM0MzggMTMxLjY0NDUzMiAyNi40NjQ4NDQgMTc5LjU3ODEyNSA3NC40MzM1OTQgNDcuOTI1NzgxIDQ3Ljk3MjY1NiA3NC4zMDg1OTQgMTExLjc0MjE4NyA3NC4yODkwNjMgMTc5LjU1ODU5NC0uMDYyNSAxMzkuOTQ1MzEyLTExMy45NDUzMTMgMjUzLjgwMDc4MS0yNTMuODY3MTg4IDI1My44MDA3ODEgMCAwLS4xMDU0NjggMC0uMTA5Mzc1IDAtNDAuODcxMDkzLS4wMTU2MjUtODEuMzkwNjI1LTkuOTc2NTYzLTExNy40Njg3NS0yOC44NDM3NWwtMTI0LjY3NTc4MSAzMi42OTUzMTJjLS45MTQwNjIuMjM4MjgxLTEuODQzNzUuMzU1NDY5LTIuNzYxNzE5LjM1NTQ2OXptMCAwIiBmaWxsPSIjZTVlNWU1Ii8+PHBhdGggZD0ibTEwLjg5NDUzMSA1MDEuMTA1NDY5IDM0LjQ2ODc1LTEyNS44NzEwOTRjLTIxLjI2MTcxOS0zNi44Mzk4NDQtMzIuNDQ1MzEyLTc4LjYyODkwNi0zMi40Mjk2ODctMTIxLjQ0MTQwNi4wNTQ2ODctMTMzLjkzMzU5NCAxMDkuMDQ2ODc1LTI0Mi44OTg0MzggMjQyLjk3NjU2Mi0yNDIuODk4NDM4IDY0Ljk5MjE4OC4wMjczNDQgMTI1Ljk5NjA5NCAyNS4zMjQyMTkgMTcxLjg3MTA5NCA3MS4yMzgyODEgNDUuODcxMDk0IDQ1LjkxNDA2MyA3MS4xMjUgMTA2Ljk0NTMxMyA3MS4xMDE1NjIgMTcxLjg1NTQ2OS0uMDU4NTkzIDEzMy45Mjk2ODgtMTA5LjA2NjQwNiAyNDIuOTEwMTU3LTI0Mi45NzI2NTYgMjQyLjkxMDE1Ny0uMDA3ODEyIDAgLjAwMzkwNiAwIDAgMGgtLjEwNTQ2OGMtNDAuNjY0MDYzLS4wMTU2MjYtODAuNjE3MTg4LTEwLjIxNDg0NC0xMTYuMTA1NDY5LTI5LjU3MDMxM3ptMTM0Ljc2OTUzMS03Ny43NSA3LjM3ODkwNyA0LjM3MTA5M2MzMSAxOC4zOTg0MzggNjYuNTQyOTY5IDI4LjEyODkwNyAxMDIuNzg5MDYyIDI4LjE0ODQzOGguMDc4MTI1YzExMS4zMDQ2ODggMCAyMDEuODk4NDM4LTkwLjU3ODEyNSAyMDEuOTQ1MzEzLTIwMS45MDIzNDQuMDE5NTMxLTUzLjk0OTIxOC0yMC45NjQ4NDQtMTA0LjY3OTY4Ny01OS4wOTM3NS0xNDIuODM5ODQ0LTM4LjEzMjgxMy0zOC4xNjAxNTYtODguODMyMDMxLTU5LjE4NzUtMTQyLjc3NzM0NC01OS4yMTA5MzctMTExLjM5NDUzMSAwLTIwMS45ODQzNzUgOTAuNTY2NDA2LTIwMi4wMjczNDQgMjAxLjg4NjcxOS0uMDE1NjI1IDM4LjE0ODQzNyAxMC42NTYyNSA3NS4yOTY4NzUgMzAuODc1IDEwNy40NDUzMTJsNC44MDQ2ODggNy42NDA2MjUtMjAuNDA2MjUgNzQuNXptMCAwIiBmaWxsPSIjZmZmIi8+PHBhdGggZD0ibTE5LjM0Mzc1IDQ5Mi42MjUgMzMuMjc3MzQ0LTEyMS41MTk1MzFjLTIwLjUzMTI1LTM1LjU2MjUtMzEuMzI0MjE5LTc1LjkxMDE1Ny0zMS4zMTI1LTExNy4yMzQzNzUuMDUwNzgxLTEyOS4yOTY4NzUgMTA1LjI3MzQzNy0yMzQuNDg4MjgyIDIzNC41NTg1OTQtMjM0LjQ4ODI4MiA2Mi43NS4wMjczNDQgMTIxLjY0NDUzMSAyNC40NDkyMTkgMTY1LjkyMTg3NCA2OC43NzM0MzggNDQuMjg5MDYzIDQ0LjMyNDIxOSA2OC42NjQwNjMgMTAzLjI0MjE4OCA2OC42NDA2MjYgMTY1Ljg5ODQzOC0uMDU0Njg4IDEyOS4zMDA3ODEtMTA1LjI4MTI1IDIzNC41MDM5MDYtMjM0LjU1MDc4MiAyMzQuNTAzOTA2LS4wMTE3MTggMCAuMDAzOTA2IDAgMCAwaC0uMTA1NDY4Yy0zOS4yNTM5MDctLjAxNTYyNS03Ny44MjgxMjYtOS44NjcxODgtMTEyLjA4NTkzOC0yOC41MzkwNjN6bTAgMCIgZmlsbD0iIzY0YjE2MSIvPjxnIGZpbGw9IiNmZmYiPjxwYXRoIGQ9Im0xMC44OTQ1MzEgNTAxLjEwNTQ2OSAzNC40Njg3NS0xMjUuODcxMDk0Yy0yMS4yNjE3MTktMzYuODM5ODQ0LTMyLjQ0NTMxMi03OC42Mjg5MDYtMzIuNDI5Njg3LTEyMS40NDE0MDYuMDU0Njg3LTEzMy45MzM1OTQgMTA5LjA0Njg3NS0yNDIuODk4NDM4IDI0Mi45NzY1NjItMjQyLjg5ODQzOCA2NC45OTIxODguMDI3MzQ0IDEyNS45OTYwOTQgMjUuMzI0MjE5IDE3MS44NzEwOTQgNzEuMjM4MjgxIDQ1Ljg3MTA5NCA0NS45MTQwNjMgNzEuMTI1IDEwNi45NDUzMTMgNzEuMTAxNTYyIDE3MS44NTU0NjktLjA1ODU5MyAxMzMuOTI5Njg4LTEwOS4wNjY0MDYgMjQyLjkxMDE1Ny0yNDIuOTcyNjU2IDI0Mi45MTAxNTctLjAwNzgxMiAwIC4wMDM5MDYgMCAwIDBoLS4xMDU0NjhjLTQwLjY2NDA2My0uMDE1NjI2LTgwLjYxNzE4OC0xMC4yMTQ4NDQtMTE2LjEwNTQ2OS0yOS41NzAzMTN6bTEzNC43Njk1MzEtNzcuNzUgNy4zNzg5MDcgNC4zNzEwOTNjMzEgMTguMzk4NDM4IDY2LjU0Mjk2OSAyOC4xMjg5MDcgMTAyLjc4OTA2MiAyOC4xNDg0MzhoLjA3ODEyNWMxMTEuMzA0Njg4IDAgMjAxLjg5ODQzOC05MC41NzgxMjUgMjAxLjk0NTMxMy0yMDEuOTAyMzQ0LjAxOTUzMS01My45NDkyMTgtMjAuOTY0ODQ0LTEwNC42Nzk2ODctNTkuMDkzNzUtMTQyLjgzOTg0NC0zOC4xMzI4MTMtMzguMTYwMTU2LTg4LjgzMjAzMS01OS4xODc1LTE0Mi43NzczNDQtNTkuMjEwOTM3LTExMS4zOTQ1MzEgMC0yMDEuOTg0Mzc1IDkwLjU2NjQwNi0yMDIuMDI3MzQ0IDIwMS44ODY3MTktLjAxNTYyNSAzOC4xNDg0MzcgMTAuNjU2MjUgNzUuMjk2ODc1IDMwLjg3NSAxMDcuNDQ1MzEybDQuODA0Njg4IDcuNjQwNjI1LTIwLjQwNjI1IDc0LjV6bTAgMCIvPjxwYXRoIGQ9Im0xOTUuMTgzNTk0IDE1Mi4yNDYwOTRjLTQuNTQ2ODc1LTEwLjEwOTM3NS05LjMzNTkzOC0xMC4zMTI1LTEzLjY2NDA2My0xMC40ODgyODItMy41MzkwNjItLjE1MjM0My03LjU4OTg0My0uMTQ0NTMxLTExLjYzMjgxMi0uMTQ0NTMxLTQuMDQ2ODc1IDAtMTAuNjI1IDEuNTIzNDM4LTE2LjE4NzUgNy41OTc2NTctNS41NjY0MDcgNi4wNzQyMTgtMjEuMjUzOTA3IDIwLjc2MTcxOC0yMS4yNTM5MDcgNTAuNjMyODEyIDAgMjkuODc1IDIxLjc1NzgxMyA1OC43MzgyODEgMjQuNzkyOTY5IDYyLjc5Mjk2OSAzLjAzNTE1NyA0LjA1MDc4MSA0MiA2Ny4zMDg1OTMgMTAzLjcwNzAzMSA5MS42NDQ1MzEgNTEuMjg1MTU3IDIwLjIyNjU2MiA2MS43MTg3NSAxNi4yMDMxMjUgNzIuODUxNTYzIDE1LjE5MTQwNiAxMS4xMzI4MTMtMS4wMTE3MTggMzUuOTE3OTY5LTE0LjY4NzUgNDAuOTc2NTYzLTI4Ljg2MzI4MSA1LjA2MjUtMTQuMTc1NzgxIDUuMDYyNS0yNi4zMjQyMTkgMy41NDI5NjgtMjguODY3MTg3LTEuNTE5NTMxLTIuNTI3MzQ0LTUuNTY2NDA2LTQuMDQ2ODc2LTExLjYzNjcxOC03LjA4MjAzMi02LjA3MDMxMy0zLjAzNTE1Ni0zNS45MTc5NjktMTcuNzI2NTYyLTQxLjQ4NDM3Ni0xOS43NS01LjU2NjQwNi0yLjAyNzM0NC05LjYxMzI4MS0zLjAzNTE1Ni0xMy42NjAxNTYgMy4wNDI5NjktNC4wNTA3ODEgNi4wNzAzMTMtMTUuNjc1NzgxIDE5Ljc0MjE4Ny0xOS4yMTg3NSAyMy43ODkwNjMtMy41NDI5NjggNC4wNTg1OTMtNy4wODU5MzcgNC41NjY0MDYtMTMuMTU2MjUgMS41MjczNDMtNi4wNzAzMTItMy4wNDI5NjktMjUuNjI1LTkuNDQ5MjE5LTQ4LjgyMDMxMi0zMC4xMzI4MTItMTguMDQ2ODc1LTE2LjA4OTg0NC0zMC4yMzQzNzUtMzUuOTY0ODQ0LTMzLjc3NzM0NC00Mi4wNDI5NjktMy41MzkwNjItNi4wNzAzMTItLjA1ODU5NC05LjA3MDMxMiAyLjY2Nzk2OS0xMi4zODY3MTkgNC45MTAxNTYtNS45NzI2NTYgMTMuMTQ4NDM3LTE2LjcxMDkzNyAxNS4xNzE4NzUtMjAuNzU3ODEyIDIuMDIzNDM3LTQuMDU0Njg4IDEuMDExNzE4LTcuNTk3NjU3LS41MDM5MDYtMTAuNjM2NzE5LTEuNTE5NTMyLTMuMDM1MTU2LTEzLjMyMDMxMy0zMy4wNTg1OTQtMTguNzE0ODQ0LTQ1LjA2NjQwNnptMCAwIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiLz48L2c+PC9zdmc+" />
                    </a>
                    @endif
                    @if($this->campaign->user->profile->telegram)
                    <a href="https://telegram.me/{{$this->campaign->user->profile->telegram}}" target="_blank">
                        <img class="h-5" src="data:image/svg+xml;base64,PHN2ZyBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyNCAyNCIgaGVpZ2h0PSI1MTIiIHZpZXdCb3g9IjAgMCAyNCAyNCIgd2lkdGg9IjUxMiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIxMiIgY3k9IjEyIiBmaWxsPSIjMDM5YmU1IiByPSIxMiIvPjxwYXRoIGQ9Im01LjQ5MSAxMS43NCAxMS41Ny00LjQ2MWMuNTM3LS4xOTQgMS4wMDYuMTMxLjgzMi45NDNsLjAwMS0uMDAxLTEuOTcgOS4yODFjLS4xNDYuNjU4LS41MzcuODE4LTEuMDg0LjUwOGwtMy0yLjIxMS0xLjQ0NyAxLjM5NGMtLjE2LjE2LS4yOTUuMjk1LS42MDUuMjk1bC4yMTMtMy4wNTMgNS41Ni01LjAyM2MuMjQyLS4yMTMtLjA1NC0uMzMzLS4zNzMtLjEyMWwtNi44NzEgNC4zMjYtMi45NjItLjkyNGMtLjY0My0uMjA0LS42NTctLjY0My4xMzYtLjk1M3oiIGZpbGw9IiNmZmYiLz48L3N2Zz4=" />
                    </a>
                    @endif
                    @if($this->campaign->user->profile->website)
                    <a href="{{$this->campaign->user->profile->website}}" target="_blank">
                        <img class="h-5" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHBhdGggc3R5bGU9ImZpbGw6IzY1QjFGQzsiIGQ9Ik00ODEuOTAxLDMzOS4zOTlDNDIwLjA5OSw0NjguOTk5LDMyNSw0OTcsMjU2LDQ5N2MtNzcuNzAxLDAtMTUwLjkwMS0zOC44LTE5NS45MDEtMTAyLjENCgljLTQ1LjI5OC02My45LTU2LjEtMTQ0LjktMzAtMjIyLjMwMUwzNC45LDE2Mi43QzcxLjQ5OSw3NS4zOTksMTYwLjMsMTUsMjU2LDE1Yzc3LjcwMSwwLDE1MC45MDEsMzguOCwxOTUuOTAxLDEwMi4xDQoJQzQ5Ny4xOTksMTgxLDUwOC4wMDEsMjYyLDQ4MS45MDEsMzM5LjM5OXoiLz4NCjxwYXRoIHN0eWxlPSJmaWxsOiMxNjg5RkM7IiBkPSJNNDgxLjkwMSwzMzkuMzk5QzQyMC4wOTksNDY4Ljk5OSwzMjUsNDk3LDI1Niw0OTdWMTVjNzcuNzAxLDAsMTUwLjkwMSwzOC44LDE5NS45MDEsMTAyLjENCglDNDk3LjE5OSwxODEsNTA4LjAwMSwyNjIsNDgxLjkwMSwzMzkuMzk5eiIvPg0KPHBhdGggc3R5bGU9ImZpbGw6Izk2RUJFNjsiIGQ9Ik00NjQuMiwxMDguMzk5QzQxNi4yMDEsNDEuMTk5LDMzOC41LDAsMjU2LDBDMTUzLjEsMCw1OC45LDY0LjYsMjAuMiwxNTkuNjk5TDE1LjA5OSwxNzAuMg0KCUMtMTIuNDQ2LDI1NC4wNzYtMS43MjEsMzMzLjUyMyw0Ny44LDQwMy41OTlDOTUuNzk5LDQ3MC43OTksMTczLjUsNTEyLDI1Niw1MTJjMTAxLjcsMCwxOTQuNy02My4xLDIzNC42LTE1Ni4xMDFsNC40OTktOQ0KCUM1MjUuMDg1LDI2MS41OCw1MTQuNTgxLDE3OS42MTgsNDY0LjIsMTA4LjM5OXogTTcyLjQsMzg2LjE5OWMtNDIuNTk5LTYwLTUyLjUtMTM1Ljg5OS0yNy45LTIwOC43OTlsMy45LTguMTAxDQoJQzcyLjcsMTExLjA5OSwxMjEsNjYsMTc4LjU5OSw0NC4zOTljLTM2LjI5OSw0Ny40MDEtNTguMiwxMzkuNi01NS40OTksMTY5LjZjLTAuMywwLjkwMS0wLjYwMSwxLjgtMC42MDEsMy4wMDENCgljLTcuOCwxMDAuNDk5LDE1LDE5Ny41LDU3LjksMjUxLjhDMTM3LjUsNDUzLjE5OSw5OS40MDEsNDI0LjMsNzIuNCwzODYuMTk5eiBNMjQxLDQ3OS4yOTljLTEwLjQ5OS0zLjYtMjEtMTEuNDk5LTMwLjkwMS0yMg0KCUMxNjguMSw0MTIsMTQ1LDMxNi4zLDE1Mi41LDIxOS4zOTlWMjE2LjdjMC0wLjkwMSwwLjMtMi4xLDAuMy0zLjAwMWM4LjY5OS05My4zLDQ1LjMtMTY2Ljg5OSw4OC4yLTE4MVY0NzkuMjk5eiBNMjcxLDQ3OC45OTkNCgl2LTQ0Ni4zYzQ2LjE5OSwxNS4zLDg0LjkwMSwxMDAuMyw4OS4zOTksMjAxLjdjNC4yLDkzLjYtMTkuMTk5LDE4MS41LTU5LjcsMjI0LjEwMUMyOTEuMDk5LDQ2OC4zOTksMjgxLjIwMSw0NzUuNjk5LDI3MSw0NzguOTk5eg0KCSBNNDY3LjUsMzM0LjZjLTMzLjYsNzAuOC04MSwxMTQuMzk5LTEzNS44OTksMTMzLjljNDAuMTk5LTUwLjcsNjIuOTk5LTE0MS4xLDU4Ljc5OC0yMzUuM2MtMy42LTc5LjgwMS0yNi4xLTE0OC41OTktNTguNzk5LTE5MA0KCWM0Mi45LDE1LjU5OSw4MC45OTksNDQuNSwxMDcuOTk5LDgyLjU5OUM0ODIuMTk5LDE4NS43OTksNDkyLjEsMjYxLjcsNDY3LjUsMzM0LjZ6Ii8+DQo8cGF0aCBzdHlsZT0iZmlsbDojMDBDOEM4OyIgZD0iTTQ2NC4yLDEwOC4zOTlDNDE2LjIwMSw0MS4xOTksMzM4LjUsMCwyNTYsMHY1MTJjMTAxLjcsMCwxOTQuNy02My4xLDIzNC42LTE1Ni4xMDFsNC40OTktOQ0KCUM1MjUuMDg1LDI2MS41OCw1MTQuNTgxLDE3OS42MTgsNDY0LjIsMTA4LjM5OXogTTI3MSw0NzguOTk5di00NDYuM2M0Ni4xOTksMTUuMyw4NC45MDEsMTAwLjMsODkuMzk5LDIwMS43DQoJYzQuMiw5My42LTE5LjE5OSwxODEuNS01OS43LDIyNC4xMDFDMjkxLjA5OSw0NjguMzk5LDI4MS4yMDEsNDc1LjY5OSwyNzEsNDc4Ljk5OXogTTQ2Ny41LDMzNC42DQoJYy0zMy42LDcwLjgtODEsMTE0LjM5OS0xMzUuODk5LDEzMy45YzQwLjE5OS01MC43LDYyLjk5OS0xNDEuMSw1OC43OTgtMjM1LjNjLTMuNi03OS44MDEtMjYuMS0xNDguNTk5LTU4Ljc5OS0xOTANCgljNDIuOSwxNS41OTksODAuOTk5LDQ0LjUsMTA3Ljk5OSw4Mi41OTlDNDgyLjE5OSwxODUuNzk5LDQ5Mi4xLDI2MS43LDQ2Ny41LDMzNC42eiIvPg0KPHBhdGggc3R5bGU9ImZpbGw6IzAwNTNCRjsiIGQ9Ik00NjYsMTUxSDQ2Yy0yNC45MDEsMC00NiwyMC4wOTktNDYsNDV2MTIwYzAsMjQuODk5LDIxLjA5OSw0NSw0Niw0NWg0MjBjMjQuOTAxLDAsNDYtMjAuMTAxLDQ2LTQ1DQoJVjE5NkM1MTIsMTcxLjA5OSw0OTAuOTAxLDE1MSw0NjYsMTUxeiIvPg0KPHBhdGggc3R5bGU9ImZpbGw6IzA1Mzc3RjsiIGQ9Ik01MTIsMTk2djEyMGMwLDI0Ljg5OS0yMS4wOTksNDUtNDYsNDVIMjU2VjE1MWgyMTBDNDkwLjkwMSwxNTEsNTEyLDE3MS4wOTksNTEyLDE5NnoiLz4NCjxwYXRoIHN0eWxlPSJmaWxsOiNFMUYxRkE7IiBkPSJNMzI5LjUsMjMyLjU5OWwtMzAsNjBDMjk2LjgsMjk3LjcsMjkxLjcsMzAxLDI4NiwzMDFzLTEwLjgtMy4zLTEzLjUtOC40MDFMMjU2LDI1OS42bC0xNi41LDMyLjk5OQ0KCWMtNS4wOTksMTAuMjAxLTIxLjkwMSwxMC4yMDEtMjcuMDAxLDBsLTMwLTYwYy0zLjYtNy4yLTAuNTk5LTE2LjE5OSw2LjkwMS0yMC4wOTljNy4yLTMuNiwxNi4xOTktMC42MDEsMjAuMDk5LDYuODk5TDIyNiwyNTIuNA0KCWwxNi41LTMzLjAwMWMyLjcwMS01LjA5OSw4LjEwMS03LjgsMTMuNS03LjhjNS4zOTksMCwxMC44LDIuNzAxLDEzLjUsNy44TDI4NiwyNTIuNGwxNi41LTMzLjAwMWMzLjktNy41LDEyLjktMTAuNDk5LDIwLjA5OS02Ljg5OQ0KCUMzMzAuMDk5LDIxNi40LDMzMy4xLDIyNS4zOTksMzI5LjUsMjMyLjU5OXoiLz4NCjxwYXRoIHN0eWxlPSJmaWxsOiNCRkUxRkY7IiBkPSJNNDM2LDMwMWMtNS42ODQsMC0xMC44NjktMy4yMDgtMTMuNDE4LTguMjkxTDQwNiwyNTkuNTQ1bC0xNi41ODIsMzMuMTY0DQoJYy01LjA5OCwxMC4xNjYtMjEuNzM4LDEwLjE2Ni0yNi44MzYsMGwtMjguNzQtNTcuNDk1Yy0xLjg2LTIuMjg1LTMuMDYyLTUuMTEyLTMuMjY3LTguMjE4Yy0wLjUyNy04LjI2Miw1LjI4OC0xNS4zNjYsMTMuNTQ5LTE1LjkwOA0KCWM2LjI3LTAuMTQ2LDEyLjU5OCwyLjgxMywxNS4yOTMsOC4yMDNMMzc2LDI1Mi40NTVsMTYuNTgyLTMzLjE2NGM1LjA5OC0xMC4xNjYsMjEuNzM4LTEwLjE2NiwyNi44MzYsMEw0MzYsMjUyLjQ1NWwxNi41ODItMzMuMTY0DQoJYzMuNzIxLTcuNDI3LDEyLjcyOS0xMC4zNzEsMjAuMTI3LTYuNzA5YzcuNDEyLDMuNzA2LDEwLjQxNSwxMi43MTUsNi43MDksMjAuMTI3bC0zMCw2MEM0NDYuODY5LDI5Ny43OTIsNDQxLjY4NCwzMDEsNDM2LDMwMXoiLz4NCjxwYXRoIHN0eWxlPSJmaWxsOiNFMUYxRkE7IiBkPSJNMTY2Ljk2NywyMTEuMDI5Yy01LjkwMy0wLjA1OS0xMS42ODksMi44NzEtMTQuMzg1LDguMjYyTDEzNiwyNTIuNDU1bC0xNi41ODItMzMuMTY0DQoJYy01LjQwMy0xMC43NjktMjEuNDkyLTEwLjY4OC0yNi44MzYsMEw3NiwyNTIuNDU1bC0xNi41ODItMzMuMTY0Yy0zLjcyMS03LjQyNy0xMi43NDQtMTAuMzcxLTIwLjEyNy02LjcwOQ0KCWMtNy40MTIsMy43MDYtMTAuNDE1LDEyLjcxNS02LjcwOSwyMC4xMjdsMzAsNjBDNjUuMTMxLDI5Ny43OTIsNzAuMzE2LDMwMSw3NiwzMDFzMTAuODY5LTMuMjA4LDEzLjQxOC04LjI5MUwxMDYsMjU5LjU0NQ0KCWwxNi41ODIsMzMuMTY0QzEyNS4xMzEsMjk3Ljc5MiwxMzAuMzE2LDMwMSwxMzYsMzAxczEwLjg2OS0zLjIwOCwxMy40MTgtOC4yOTFsMjguMjU3LTU2LjUxNGMyLjEzOS0yLjQzMiwzLjUxNi01LjY0LDMuNzUtOS4xOTkNCglDMTgxLjk1MiwyMTguNzM0LDE3NS4yMjksMjExLjU3MSwxNjYuOTY3LDIxMS4wMjl6Ii8+DQo8cGF0aCBzdHlsZT0iZmlsbDojQkZFMUZGOyIgZD0iTTMyOS41LDIzMi41OTlsLTMwLDYwQzI5Ni44LDI5Ny43LDI5MS43LDMwMSwyODYsMzAxcy0xMC44LTMuMy0xMy41LTguNDAxTDI1NiwyNTkuNnYtNDguMDAxDQoJYzUuNCwwLDEwLjgsMi43MDEsMTMuNSw3LjhMMjg2LDI1Mi40bDE2LjUtMzMuMDAxYzMuOS03LjUsMTIuOS0xMC40OTksMjAuMDk5LTYuODk5QzMzMC4wOTksMjE2LjQsMzMzLjEsMjI1LjM5OSwzMjkuNSwyMzIuNTk5eiIvPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPC9zdmc+DQo=" />
                    </a>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
    @if ($this->campaign->organization)
    <div class="hidden">
        <div class="flex justify-start sm:mt-2">
            <div class="flex items-center ">
                @if($this->campaign->organization->logo_path)
                <div wire:click="viewOrganizer({{$this->campaign->id}})" wire:loading.attr="disabled" class="flex-shrink-0 w-12 h-12 cursor-pointer">
                    <img class="w-full h-full rounded-full"
                        src="{{ $host}}{{$this->campaign->organization->logo_path}}"
                        alt="{{$this->campaign->organization->name}}" />
                </div>
                @endif
                <div class="ml-3 space-y-2">
                    <div wire:click="viewOrganizer({{$this->campaign->id}})" class="text-gray-700 text-sm sm:text-base cursor-pointer"> 
                        <span class="font-bold">{{__('For')}}: </span>
                        {{$this->campaign->organization->name}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!--- end personal personal_organization -->
    @elseif ($this->campaign->type_campaign == 'ORGANIZATION')
    <div class="flex justify-start mt-5 sm:mt-5">
        <div class="flex items-center ">
            @if($this->campaign->user->profile_photo_path)
            <div wire:click="viewUser({{$this->campaign->user->id}})" wire:loading.attr="disabled" class="flex-shrink-0 w-12 h-12 cursor-pointer">
                <img class="h-full w-full rounded-full object-cover"
                    src="{{ URL::to('/') }}{{$this->campaign->user->profile_photo_path}}"
                    alt="" />
            </div>
            @else 
            <div wire:click="viewUser({{$this->campaign->user->id}})" class="flex-shrink-0 w-14 h-14 cursor-pointer">
                <img class="h-14 w-14 rounded-full object-cover"
                    src="{{ $this->campaign->user->profile_photo_url }}" alt="{{ $this->campaign->user->name }}" />
            </div>
            @endif
            <div class="ml-3">
                <div wire:click="viewUser({{$this->campaign->user->id}})" class="text-gray-900 text-sm sm:text-base cursor-pointer"> 
                    {{$this->campaign->user->name}}
                </div>
                <div class="text-xs text-gray-600">
                    {{__('Recaudador de fondos')}}
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="flex justify-start sm:mt-2">
            <div class="flex items-center ">
                @if($this->campaign->organization->logo_path)
                <div wire:click="viewOrganizer({{$this->campaign->id}})" wire:loading.attr="disabled" class="flex-shrink-0 w-12 h-12 cursor-pointer">
                    <img class="w-full h-full rounded-full"
                        src="{{ $host}}{{$this->campaign->organization->logo_path}}"
                        alt="{{$this->campaign->organization->name}}" />
                </div>
                @endif
                <div class="ml-3">
                    <div wire:click="viewUser({{$this->campaign->user->id}})" class="text-gray-900 text-sm sm:text-base cursor-pointer"> 
                        {{$this->campaign->organization->name}}
                    </div>
                    <div class="text-xs text-gray-600">
                        {{__('Beneficiario')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    @endif
</div>
