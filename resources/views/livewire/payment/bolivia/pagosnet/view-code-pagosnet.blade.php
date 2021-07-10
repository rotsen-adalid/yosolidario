<x-slot name="title">
    {{__('Collection number')}}: {{$paymentOrder->code_collection}}
</x-slot>
<x-slot  name="seo">
</x-slot>
<x-slot  name="menu">
    <x-banner-session class="top-0"/>
    <!-- livewire:menu.navigation-collaborate/> -->
</x-slot>

<div>
    <div class="bg-white">
        <div class="max-w-5xl mx-auto py-4 px-4 sm:py-10 sm:px-20">
            <div class="flex justify-between items-center">
                <div  wire:click="home" wire:loading.attr="disabled" class="cursor-pointer">
                    <img src="{{asset('images/logo-page.png')}}" class="h-10 lg:h-12" alt="">
                </div>
                <div>
                    <img src="{{asset('images/pagosnet.png')}}" class="h-14 lg:h-24" alt="">
                </div>
            </div>
            <div class="text-center text-gray-700 py-5 px-0 sm:px-5">
                <div class="font-bold text-xl sm:text-2xl">{{__('You are about to end your collaboration!')}}</div>
                <div class="sm:font-bold text-base sm:text-lg">{{__('Appear at any point on PagosNet and report the following information to end your collaboration')}}</div>
            </div>

            <div class="mt-0 sm:mt-5">
                <div class="border border-gray-100 shadow rounded-lg">
                    <div class="bg-gray-100 text-center py-4 space-y-2">
                        <div class="font-bold text-lg uppercase">{{__('Collection code')}}</div>
                        <div class="font-bold text-3xl">{{$paymentOrder->code_collection}}</div>
                    </div>
                    <div class="grid grid-cols-3 gap-5 p-4 font-bold">
                        <div class="text-right">
                            {{__('Service')}}
                        </div>
                        <div class="col-span-2">
                            <span class="bg-gray-100 py-1 px-2">PagosNet</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-5 p-4 border-t border-gray-100 font-bold">
                        <div class="text-right">
                            {{__('Amount payable')}}
                        </div>
                        <div class="col-span-2">
                            <span class="bg-gray-100 py-1 px-2">
                                {{ number_format($paymentOrder->amount_total, 2 ) }}
                                {{$paymentOrder->money->currency_symbol}}
                            </span>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3 p-4 border-t border-gray-100 font-bold">
                        @if ($paymentOrder->type == 'CAMPAIGN')
                            <div class="text-right">
                                <span>{{__('Campaign')}}</span>
                            </div>
                            <div class="col-span-2">
                                <span class="bg-gray-100 py-1 px-2">
                                    {{$paymentOrder->paymentOrderCampaign->campaign->title}}
                                </span>
                            </div>
                        @elseif ($paymentOrder->type == 'ORGANIZATION')
                            <div class="text-right">
                                @if ($paymentOrder->paymentOrderOrganization->organization->type == "FOUNDATION")
                                    <span>{{__('Foundation')}}</span>
                                @elseif ($paymentOrder->paymentOrderOrganization->organization->type == "COMPANY")
                                    <span>{{__('Company')}}</span>
                                @elseif ($paymentOrder->paymentOrderOrganization->organization->type == "ONG")
                                    <span>{{__('ONG')}}</span>
                                @elseif ($paymentOrder->paymentOrderOrganization->organization->type == "SOCIAL_ORGANIZATION")
                                    <span>{{__('Social organization')}}</span>
                                @endif
                            </div>
                            <div class="col-span-2">
                                <span class="bg-gray-100 py-1 px-2">
                                    {{$paymentOrder->paymentOrderOrganization->organization->name}}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div>
                <div class="flex justify-center space-x-2 items-center py-5">
                    <img class="h-6 sm:h-10" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGc+DQoJPGc+DQoJCTxwYXRoIGQ9Ik0xNzIuNTUsMzkxLjkwMmMtMC4xMy0wLjY0LTAuMzItMS4yNy0wLjU3LTEuODhjLTAuMjUtMC42LTAuNTYtMS4xOC0wLjkyLTEuNzJjLTAuMzYtMC41NS0wLjc4LTEuMDYtMS4yNC0xLjUyDQoJCQljLTAuNDYtMC40Ni0wLjk3LTAuODgtMS41Mi0xLjI0Yy0wLjU0LTAuMzYtMS4xMi0wLjY3LTEuNzMtMC45MmMtMC42LTAuMjUtMS4yMy0wLjQ1LTEuODctMC41N2MtMS4yOS0wLjI2LTIuNjItMC4yNi0zLjksMA0KCQkJYy0wLjY0LDAuMTItMS4yNywwLjMyLTEuODgsMC41N2MtMC42LDAuMjUtMS4xOCwwLjU2LTEuNzIsMC45MmMtMC41NSwwLjM2LTEuMDYsMC43OC0xLjUyLDEuMjRjLTAuNDYsMC40Ni0wLjg4LDAuOTctMS4yNCwxLjUyDQoJCQljLTAuMzcsMC41NC0wLjY3LDEuMTItMC45MiwxLjcyYy0wLjI1LDAuNjEtMC40NSwxLjI0LTAuNTcsMS44OGMtMC4xMywwLjY0LTAuMiwxLjMtMC4yLDEuOTVjMCwwLjY1LDAuMDcsMS4zMSwwLjIsMS45NQ0KCQkJYzAuMTIsMC42NCwwLjMyLDEuMjcsMC41NywxLjg3YzAuMjUsMC42MSwwLjU1LDEuMTksMC45MiwxLjczYzAuMzYsMC41NSwwLjc4LDEuMDYsMS4yNCwxLjUyYzAuNDYsMC40NiwwLjk3LDAuODgsMS41MiwxLjI0DQoJCQljMC41NCwwLjM2MSwxLjEyLDAuNjcxLDEuNzIsMC45MjFjMC42MSwwLjI1LDEuMjQsMC40NSwxLjg4LDAuNTdjMC42NCwwLjEzLDEuMywwLjIsMS45NSwwLjJjMC42NSwwLDEuMzEtMC4wNywxLjk1LTAuMg0KCQkJYzAuNjQtMC4xMiwxLjI3LTAuMzIsMS44Ny0wLjU3YzAuNjEtMC4yNSwxLjE5LTAuNTYxLDEuNzMtMC45MjFjMC41NS0wLjM2LDEuMDYtMC43OCwxLjUyLTEuMjRjMC40Ni0wLjQ2LDAuODgtMC45NywxLjI0LTEuNTINCgkJCWMwLjM2LTAuNTQsMC42Ny0xLjEyLDAuOTItMS43M2MwLjI1LTAuNiwwLjQ0LTEuMjMsMC41Ny0xLjg3czAuMi0xLjMsMC4yLTEuOTVTMTcyLjY4LDM5Mi41NDIsMTcyLjU1LDM5MS45MDJ6Ii8+DQoJPC9nPg0KPC9nPg0KPGc+DQoJPGc+DQoJCTxwYXRoIGQ9Ik00NTkuOTkzLDM5NC45ODJjLTAuMDM5LTAuMS0wLjA3OS0wLjE5OS0wLjEyMS0wLjI5N2MtOS4yMDQtMjEuNTM3LTMwLjc5LTI5LjQ5Ny01Ni4zMzYtMjAuNzcybC02OS42NjgsMTkuMjY2DQoJCQljLTQuMDI4LTEyLjE5OC0xNC4wNzUtMjIuNTc4LTI4LjI4MS0yNy44NWMtMC4wODgtMC4wMzItMC4xNzYtMC4wNjQtMC4yNjUtMC4wOTRsLTc2LjU4MS0yNS45OTINCgkJCWMtNi4zNzQtOC4yMzktMjYuMzQtMjkuMzIxLTYzLjcyMy0yOS4zMjFjLTI2LjEyNSwwLTQ5LjIzNiwxNy45MjItNjIuNDU4LDM3LjQ1N0gxMGMtNS41MjMsMC0xMCw0LjQ3Ny0xMCwxMHYxMjYuMDc3DQoJCQljMCw1LjUyMyw0LjQ3NywxMCwxMCwxMGg1OS40NTdjNS41MjMsMCwxMC00LjQ3NywxMC0xMHYtOC42MzRoMjcuODgzYzUuNTIzLDAsMTAtNC40NzcsMTAtMTB2LTIuODc4DQoJCQljMTYuMjU0LDEuNDE4LDIxLjYsNC41MDEsMzYuNTI4LDEzLjEwOWMxMS40OCw2LjYyLDI4LjgzMSwxNi42MjUsNjAuMDc3LDMwLjY3NGMwLjE0NSwwLjA2NSwwLjI5MiwwLjEyNywwLjQzOSwwLjE4NQ0KCQkJYzUuOTk3LDIuMzU5LDE3LjcyLDYuMDY1LDMyLjE3Myw2LjA2NWMxMC4wNiwwLDIxLjQ0NS0xLjc5NywzMy4xMzEtNy4wOTRsMTUzLjk5MS01NS4xMzZjMC4yNzQtMC4wOTgsMC41NDQtMC4yMDgsMC44MDgtMC4zMw0KCQkJQzQ0OS4yMDQsNDQyLjY0Niw0NzEuMTM1LDQyMy41NjMsNDU5Ljk5MywzOTQuOTgyeiBNNTkuNDU3LDQ3My40NTVIMjBWMzY3LjM3OGgzOS40NTdWNDczLjQ1NXogTTk3LjM0LDQ1NC44MjFINzkuNDU3di04Ny40NDMNCgkJCUg5Ny4zNFY0NTQuODIxeiBNNDI2LjQ5Niw0MzEuMDc0bC0xNTMuOTIyLDU1LjExMWMtMC4xMzUsMC4wNDgtMC4zMTgsMC4xMi0wLjQ1MSwwLjE3NGMtMC4xMzUsMC4wNTUtMC4yNywwLjExMy0wLjQwMywwLjE3NA0KCQkJYy0yMS40MzcsOS44NTItNDEuODE0LDMuOTU0LTQ5LjgsMC44NDljLTMwLjE4Mi0xMy41ODEtNDYuMjkxLTIyLjg3LTU4LjA2MS0yOS42NTdjLTE2LjM2NC05LjQzNi0yNC4yNDktMTMuOTg0LTQ2LjUxOS0xNS44MjMNCgkJCVYzNjEuMzZjOS40NzktMTUuNTM2LDI3Ljg2MS0zMS40MzksNDcuNjc5LTMxLjQzOWMzMy45ODYsMCw0OC4zODcsMjIuMTA1LDQ4Ljk1MywyMi45OTdjMS4yMjEsMS45ODYsMy4wOTgsMy40ODMsNS4zMDUsNC4yMzINCgkJCWw3OS40NzUsMjYuOTc0YzEyLjY5Myw0Ljc2NCwxOS40MDEsMTUuNjM0LDE2LjMxOCwyNi40NzRjLTEuNDIzLDUuMDA2LTQuNzExLDkuMTU4LTkuMjU3LDExLjY5MQ0KCQkJYy00LjUwNywyLjUxMS05LjcxNywzLjEzMi0xNC42ODMsMS43NThsLTg5LjU5My0yOC4zOTJjLTUuMjY4LTEuNjY5LTEwLjg4NiwxLjI0Ny0xMi41NTQsNi41MTINCgkJCWMtMS42NjksNS4yNjUsMS4yNDcsMTAuODg1LDYuNTEyLDEyLjU1NGw4OS43NDksMjguNDQxYzAuMDk1LDAuMDMsMC4xOSwwLjA1OSwwLjI4NiwwLjA4NmMzLjU4MywxLjAxOSw3LjIzMSwxLjUyMywxMC44NTcsMS41MjMNCgkJCWM2LjYzOCwwLDEzLjIwMy0xLjY5MSwxOS4xNjEtNS4wMTFjOS4yMTMtNS4xMzMsMTUuODc1LTEzLjU0NywxOC43NTktMjMuNjkyYzAuMjMtMC44MSwwLjQzNC0xLjYyLDAuNjExLTIuNDNsNzUuMDgzLTIwLjgNCgkJCWMxMC44NDQtMy43MDQsMjUuMDc5LTUuMDM5LDMxLjQxNyw5LjU1OEM0NDcuOTc4LDQxOS41MzMsNDMwLjkyOCw0MjguOTYsNDI2LjQ5Niw0MzEuMDc0eiIvPg0KCTwvZz4NCjwvZz4NCjxnPg0KCTxnPg0KCQk8cGF0aCBkPSJNMzU5LjA2LDEzMS41NDNjLTAuMTMtMC42NC0wLjMyLTEuMjctMC41OC0xLjg4Yy0wLjI1LTAuNi0wLjU1LTEuMTgtMC45Mi0xLjcyYy0wLjM2LTAuNTUtMC43OC0xLjA2LTEuMjQtMS41Mg0KCQkJYy0wLjQ2LTAuNDYtMC45Ny0wLjg4LTEuNTItMS4yNGMtMC41NC0wLjM2LTEuMTItMC42Ny0xLjcyLTAuOTJjLTAuNjEtMC4yNS0xLjI0LTAuNDUtMS44Ny0wLjU3Yy0xLjI5LTAuMjYtMi42Mi0wLjI2LTMuOTEsMA0KCQkJYy0wLjY0LDAuMTItMS4yNywwLjMyLTEuODcsMC41N2MtMC42MSwwLjI1LTEuMTksMC41Ni0xLjczLDAuOTJjLTAuNTUsMC4zNi0xLjA2LDAuNzgtMS41MiwxLjI0Yy0wLjQ2LDAuNDYtMC44OCwwLjk3LTEuMjQsMS41Mg0KCQkJYy0wLjM2LDAuNTQtMC42NywxLjEyLTAuOTIsMS43MmMtMC4yNSwwLjYxLTAuNDUsMS4yNC0wLjU3LDEuODhjLTAuMTMsMC42NC0wLjIsMS4zLTAuMiwxLjk1YzAsMC42NSwwLjA3LDEuMzEsMC4yLDEuOTUNCgkJCWMwLjEyLDAuNjQsMC4zMiwxLjI3LDAuNTcsMS44N2MwLjI1LDAuNjEsMC41NiwxLjE5LDAuOTIsMS43M2MwLjM2LDAuNTUsMC43OCwxLjA2LDEuMjQsMS41MmMwLjQ2LDAuNDYsMC45NywwLjg4LDEuNTIsMS4yNA0KCQkJYzAuNTQsMC4zNiwxLjEyLDAuNjcsMS43MywwLjkyYzAuNiwwLjI1LDEuMjMsMC40NCwxLjg3LDAuNTdzMS4zLDAuMiwxLjk1LDAuMmMwLjY1LDAsMS4zMS0wLjA3LDEuOTYtMC4yDQoJCQljMC42My0wLjEzLDEuMjYtMC4zMiwxLjg3LTAuNTdjMC42LTAuMjUsMS4xOC0wLjU2LDEuNzItMC45MmMwLjU1LTAuMzYsMS4wNi0wLjc4LDEuNTItMS4yNGMwLjQ2LTAuNDYsMC44OC0wLjk3LDEuMjQtMS41Mg0KCQkJYzAuMzctMC41NCwwLjY3LTEuMTIsMC45Mi0xLjczYzAuMjYtMC42LDAuNDUtMS4yMywwLjU4LTEuODdjMC4xMy0wLjY0LDAuMTktMS4zLDAuMTktMS45NQ0KCQkJQzM1OS4yNSwxMzIuODQzLDM1OS4xOSwxMzIuMTgzLDM1OS4wNiwxMzEuNTQzeiIvPg0KCTwvZz4NCjwvZz4NCjxnPg0KCTxnPg0KCQk8cGF0aCBkPSJNNTAyLDMzLjg5MWgtNTkuNDU3Yy01LjUyMywwLTEwLDQuNDc3LTEwLDEwdjguNjM0SDQwNC42NmMtNS41MjMsMC0xMCw0LjQ3Ny0xMCwxMHYyLjg3OA0KCQkJYy0xNi4yNTQtMS40MTktMjEuNi00LjUwMS0zNi41MjctMTMuMTA5Yy0xMS40OC02LjYyLTI4LjgzMS0xNi42MjUtNjAuMDc4LTMwLjY3NGMtMC4xNDUtMC4wNjYtMC4yOTEtMC4xMjctMC40NC0wLjE4NQ0KCQkJYy0xMC4xNzEtNC4wMDItMzYuODI4LTExLjg3Ni02NS4yOTksMS4wMjdsLTQwLjI0LDE0LjQwOEwxNTguMTU3LDIuOTUyYy0zLjkwNS0zLjkwNS0xMC4yMzctMy45MDUtMTQuMTQyLDBMMzIuNjU3LDExNC4zMDkNCgkJCWMtMy42MDIsMy42MDMtNC4yOTMsOS44NSwwLDE0LjE0M2wxOTAuMjg3LDE5MC4yODdjMy4wNDUsMy4wNDYsMTAuMTc1LDMuOTY3LDE0LjE0MywwbDEwMS42NjUtMTAxLjY2NA0KCQkJYzIuNjQzLDAuMjI4LDUuMzg2LDAuMzUxLDguMjI5LDAuMzUxYzI2LjEyNiwwLDQ5LjIzNi0xNy45MjIsNjIuNDU3LTM3LjQ1Nkg1MDJjNS41MjMsMCwxMC00LjQ3NywxMC0xMFY0My44OTENCgkJCUM1MTIsMzguMzY4LDUwNy41MjMsMzMuODkxLDUwMiwzMy44OTF6IE0xNTEuMDg1LDI0LjE2NWwyMi43OTIsMjIuNzkyYy02Ljc3NSw0LjE5LTE0LjYwOCw2LjQzMi0yMi43OTIsNi40MzINCgkJCWMtOC4xODUsMC0xNi4wMTctMi4yNDEtMjIuNzkyLTYuNDMyTDE1MS4wODUsMjQuMTY1eiBNNzYuNjYzLDE0NC4xNzNMNTMuODcxLDEyMS4zOGwyMi43OTItMjIuNzkyDQoJCQljNC4xOSw2Ljc3NSw2LjQzMiwxNC42MDgsNi40MzIsMjIuNzkyQzgzLjA5NSwxMjkuNTY0LDgwLjg1NCwxMzcuMzk3LDc2LjY2MywxNDQuMTczeiBNMjMwLjAxNiwyOTcuNTI1bC0yMi43ODgtMjIuNzg4DQoJCQljMTMuOTEzLTguNTg2LDMxLjY2MS04LjU4Niw0NS41NzUsMEwyMzAuMDE2LDI5Ny41MjV6IE0yNjcuMjExLDI2MC4zMzFjLTIyLjA5OC0xNi4wMy01Mi4yOTItMTYuMDMtNzQuMzksMEw5MS4wNywxNTguNTc5DQoJCQljNy44MDktMTAuNzQsMTIuMDI1LTIzLjY0MSwxMi4wMjUtMzcuMTk5YzAtMTMuNTU5LTQuMjE1LTI2LjQ1OS0xMi4wMjUtMzcuMTk5bDIyLjgxNy0yMi44MTYNCgkJCWMxMC43NCw3LjgwOSwyMy42NCwxMi4wMjUsMzcuMTk5LDEyLjAyNWMxMy41NTksMCwyNi40NTktNC4yMTYsMzcuMTk5LTEyLjAyNWwyMS42MjksMjEuNjI5DQoJCQljLTQuNjY3LDAuNjg5LTkuMjE4LDIuMjI3LTEzLjQ2Miw0LjU5MmMtNy4xNjgsMy45OTQtMTIuNzkyLDkuOTc1LTE2LjI5NCwxNy4yMTFjLTExLjI4LDIuMDg5LTIxLjcyMyw3LjU1LTI5LjkxNSwxNS43NDENCgkJCWMtMjIuMjI1LDIyLjIyNi0yMi4yMjUsNTguMzg5LDAuMDAxLDgwLjYxNWMxMS4xMTIsMTEuMTEyLDI1LjcwOSwxNi42NjksNDAuMzA3LDE2LjY2OWMxNC41OTcsMCwyOS4xOTUtNS41NTYsNDAuMzA4LTE2LjY2OQ0KCQkJYzcuMjMtNy4yMywxMi4yOTUtMTYuMTE2LDE0LjgzMi0yNS44bDMzLjc2NCwxMS40NTljLTMuODAxLDE3LjYwOCwwLjA5MiwzNi4xMzIsMTAuNTkzLDUwLjY4MkwyNjcuMjExLDI2MC4zMzF6IE0yMDYuNDEzLDE2Mi4wMTgNCgkJCWMwLjA4OCwwLjAzMiwwLjE3NiwwLjA2NCwwLjI2NSwwLjA5NGwxOS45OTYsNi43ODdjLTEuNTEsNi44MTUtNC45MjcsMTMuMDgxLTkuOTU3LDE4LjExMmMtMTQuNDI4LDE0LjQyNi0zNy45MDQsMTQuNDI4LTUyLjMzLDANCgkJCWMtMTQuNDI4LTE0LjQyNy0xNC40MjgtMzcuOTAyLDAtNTIuMzNjMy40OC0zLjQ4Miw3LjU4Ny02LjIwMywxMi4wNjItOC4wNDhDMTc4LjI5NSwxNDEuOTk1LDE4OS4zNTYsMTU1LjY4OCwyMDYuNDEzLDE2Mi4wMTh6DQoJCQkgTTMwNC40NTcsMjIzLjA4NGMtMy44Ni02LjI5LTYuMDQ0LTEzLjQ2OS02LjM4OS0yMC43OTZjNC43OSwzLjQ2MywxMC42NDQsNi44NTYsMTcuNjM2LDkuNTQ5TDMwNC40NTcsMjIzLjA4NHogTTM5NC42NTksMTY1Ljk4Mw0KCQkJYy05LjQ3OCwxNS41MzgtMjcuODYsMzEuNDQxLTQ3LjY3OCwzMS40NDFjLTMuNzA4LDAtNy4xODMtMC4yNjQtMTAuNDMyLTAuNzM0Yy0wLjAxMy0wLjAwMi0wLjAyNi0wLjAwNC0wLjAzOS0wLjAwNg0KCQkJYy0yMS41OTYtMy4xMzctMzMuMjEzLTE1LjQxMS0zNy4wNDItMjAuMjcxYy0wLjIwNC0wLjMtMS4wNzMtMS40MzctMS4yMDItMS42MjZjLTEuMTY1LTIuMDgyLTMuMDc1LTMuNzU2LTUuNTExLTQuNTgzDQoJCQlsLTc5LjUwOC0yNi45ODVjLTEyLjY4OC00Ljc2Mi0xOS4zOTUtMTUuNjI3LTE2LjMyMS0yNi40NjNjMC4wMDItMC4wMDcsMC4wMDQtMC4wMTQsMC4wMDYtMC4wMjENCgkJCWMwLjAwMy0wLjAwOCwwLjAwNS0wLjAxNywwLjAwNy0wLjAyNWMxLjQyOS00Ljk5LDQuNzExLTkuMTI5LDkuMjQ3LTExLjY1NmM0LjUwNi0yLjUxMSw5LjcxNS0zLjEzNCwxNC42ODMtMS43NTdsODkuNTkzLDI4LjM5MQ0KCQkJYzUuMjY2LDEuNjcxLDEwLjg4Ni0xLjI0NywxMi41NTQtNi41MTJjMS42NjgtNS4yNjUtMS4yNDctMTAuODg1LTYuNTEyLTEyLjU1NGwtNzEuMjU1LTIyLjU4bC0wLjYyMi0wLjYyMg0KCQkJYy0wLjAwNi0wLjAwNi0wLjAxMi0wLjAxMy0wLjAxOS0wLjAxOWwtMzYuODktMzYuODlsMzEuNzA4LTExLjM1NGMwLjEwNy0wLjAzOSwwLjIzOS0wLjA4OCwwLjM0NS0wLjEzMQ0KCQkJYzAuMDI3LTAuMDExLDAuMDc5LTAuMDMxLDAuMTA1LTAuMDQyYzAuMTM2LTAuMDU1LDAuMjctMC4xMTMsMC40MDMtMC4xNzRjMjEuNDM2LTkuODUyLDQxLjgxMi0zLjk1NSw0OS43OTktMC44NDkNCgkJCWMzMC4xODMsMTMuNTgxLDQ2LjI5MywyMi44Nyw1OC4wNjMsMjkuNjU3YzE2LjM2NCw5LjQzNywyNC4yNDksMTMuOTg0LDQ2LjUxOCwxNS44MjNWMTY1Ljk4M3ogTTQzMi41NDMsMTU5Ljk2OEg0MTQuNjZWNzIuNTI1DQoJCQloMTcuODgzVjE1OS45Njh6IE00OTIsMTU5Ljk2OGgtMzkuNDU3VjUzLjg5MUg0OTJWMTU5Ljk2OHoiLz4NCgk8L2c+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8L3N2Zz4NCg==" />
                    <span class="font-bold text-base sm:text-xl text-gray-800">{{__('Cash payment points')}}</span>
                </div>
            </div>

            <div class="grid grid-cols-4 gap-2 sm:gap-5 font-bold">
                <div class="flex justify-start">
                    <img src="{{asset('images/banco-bo/banco-fie.png')}}" class="h-6 sm:h-10" alt="">
                </div>
                <div class="flex justify-center">
                    <img src="{{asset('images/banco-bo/banco-ecofuturo.png')}}" class="h-6 sm:h-10" alt="">
                </div>
                <div class="flex justify-center">
                    <img src="{{asset('images/banco-bo/banco-facil.png')}}" class="h-6 sm:h-8" alt="">
                </div>
                <div class="flex justify-end">
                    <img src="{{asset('images/banco-bo/banco-visa.png')}}" class="h-6 sm:h-12" alt="">
                </div>
                <div class="flex justify-start">
                    <img src="{{asset('images/banco-bo/banco-laprimera.png')}}" class="h-6 sm:h-12" alt="">
                </div>
                <div class="flex justify-center">
                    <img src="{{asset('images/banco-bo/farmacorp.png')}}" class="h-6 sm:h-9" alt="">
                </div>
                <div class="flex justify-center">
                    <img src="{{asset('images/banco-bo/hipermaxi-farmacias.png')}}" class="h-6 sm:h-12" alt="">
                </div>
                <div class="flex justify-end">
                    <img src="{{asset('images/banco-bo/banco-prodem.png')}}" class="h-6 sm:h-10" alt="">
                </div>
            </div>
            <div class="text-center py-5">
                <div class="font-bold text-base sm:text-xl text-gray-800">{{__('And many other establishments')}}</div>
                <div class="flex justify-center items-center space-x-1">
                    <a class="text-sm text-ys1 hover:text-ys2 flex items-center space-x-1 sm:font-bold" href="https://pagosnet.com.bo" target="_blank">
                        <span class="material-icons-outlined">map</span>
                        <span class="underline">{{__('Find the closest payment center here')}}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<livewire:footer.footer-collaborate/>