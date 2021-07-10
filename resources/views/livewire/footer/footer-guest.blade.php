<div class="md:flex md:items-center md:justify-center md:fixed bottom-0 mb-4 mr-4 z-10 border-t bg-white w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class=" md:flex md:justify-start md:justify-between flex-col md:flex-row md:space-x-20 space-y-2 my-5 md:items-center">
            <div class="flex flex-row space-x-5">
                <div class="text-sm sm:text-base md:mt-2 text-gray-800">
                    © Copyright 2021 - {{ __('All Rights Reserved.') }}
                </div>
            </div>
            <div class="flex flex-row justify-center space-x-5">
                <span><a href="{{ route('set_language', 'es') }}" class="text-gray-800  text-md hover:text-gray-900">Español</a></span>
                <span><a href="{{ route('set_language', 'en') }}" class="text-gray-800  text-md hover:text-gray-900">English</a></span>
                <span><a href="{{ route('set_language', 'pt_BR') }}" class="text-gray-800  text-md hover:text-gray-900">Português</a></span>
            </div>
            <div class="flex flex-row justify-center space-x-2">
                <a href="https://facebook.com/yosolidariocom" target="_blank" class="w-6 mx-1">
                    <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE4LjEuMSwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgMTU1LjEzOSAxNTUuMTM5IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAxNTUuMTM5IDE1NS4xMzk7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxwYXRoIGlkPSJmXzFfIiBzdHlsZT0iZmlsbDojMDEwMDAyOyIgZD0iTTg5LjU4NCwxNTUuMTM5Vjg0LjM3OGgyMy43NDJsMy41NjItMjcuNTg1SDg5LjU4NFYzOS4xODQNCgkJYzAtNy45ODQsMi4yMDgtMTMuNDI1LDEzLjY3LTEzLjQyNWwxNC41OTUtMC4wMDZWMS4wOEMxMTUuMzI1LDAuNzUyLDEwNi42NjEsMCw5Ni41NzcsMEM3NS41MiwwLDYxLjEwNCwxMi44NTMsNjEuMTA0LDM2LjQ1Mg0KCQl2MjAuMzQxSDM3LjI5djI3LjU4NWgyMy44MTR2NzAuNzYxSDg5LjU4NHoiLz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K" />
                </a>
                <a href="https://twitter.com/yosolidariocom" target="_blank" class="w-6 mx-1">
                    <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGc+DQoJPGc+DQoJCTxwYXRoIGQ9Ik01MTIsOTcuMjQ4Yy0xOS4wNCw4LjM1Mi0zOS4zMjgsMTMuODg4LTYwLjQ4LDE2LjU3NmMyMS43Ni0xMi45OTIsMzguMzY4LTMzLjQwOCw0Ni4xNzYtNTguMDE2DQoJCQljLTIwLjI4OCwxMi4wOTYtNDIuNjg4LDIwLjY0LTY2LjU2LDI1LjQwOEM0MTEuODcyLDYwLjcwNCwzODQuNDE2LDQ4LDM1NC40NjQsNDhjLTU4LjExMiwwLTEwNC44OTYsNDcuMTY4LTEwNC44OTYsMTA0Ljk5Mg0KCQkJYzAsOC4zMiwwLjcwNCwxNi4zMiwyLjQzMiwyMy45MzZjLTg3LjI2NC00LjI1Ni0xNjQuNDgtNDYuMDgtMjE2LjM1Mi0xMDkuNzkyYy05LjA1NiwxNS43MTItMTQuMzY4LDMzLjY5Ni0xNC4zNjgsNTMuMDU2DQoJCQljMCwzNi4zNTIsMTguNzIsNjguNTc2LDQ2LjYyNCw4Ny4yMzJjLTE2Ljg2NC0wLjMyLTMzLjQwOC01LjIxNi00Ny40MjQtMTIuOTI4YzAsMC4zMiwwLDAuNzM2LDAsMS4xNTINCgkJCWMwLDUxLjAwOCwzNi4zODQsOTMuMzc2LDg0LjA5NiwxMDMuMTM2Yy04LjU0NCwyLjMzNi0xNy44NTYsMy40NTYtMjcuNTIsMy40NTZjLTYuNzIsMC0xMy41MDQtMC4zODQtMTkuODcyLTEuNzkyDQoJCQljMTMuNiw0MS41NjgsNTIuMTkyLDcyLjEyOCw5OC4wOCw3My4xMmMtMzUuNzEyLDI3LjkzNi04MS4wNTYsNDQuNzY4LTEzMC4xNDQsNDQuNzY4Yy04LjYwOCwwLTE2Ljg2NC0wLjM4NC0yNS4xMi0xLjQ0DQoJCQlDNDYuNDk2LDQ0Ni44OCwxMDEuNiw0NjQsMTYxLjAyNCw0NjRjMTkzLjE1MiwwLDI5OC43NTItMTYwLDI5OC43NTItMjk4LjY4OGMwLTQuNjQtMC4xNi05LjEyLTAuMzg0LTEzLjU2OA0KCQkJQzQ4MC4yMjQsMTM2Ljk2LDQ5Ny43MjgsMTE4LjQ5Niw1MTIsOTcuMjQ4eiIvPg0KCTwvZz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K" />
                </a>
                <!-- 
                <a href="#" class="w-6 mx-1">
                    <i class="uil uil-youtube"></i>
                </a>
                <a href="#" class="w-6 mx-1">
                    <i class="uil uil-linkedin"></i>
                </a>
                --->
                <a href="https://instagram.com/yosolidariocom" target="_blank" class="w-6 mx-1">
                    <img class="ml-2" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjUxMnB0IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB0IiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxwYXRoIGQ9Im0zMDEgMjU2YzAgMjQuODUxNTYyLTIwLjE0ODQzOCA0NS00NSA0NXMtNDUtMjAuMTQ4NDM4LTQ1LTQ1IDIwLjE0ODQzOC00NSA0NS00NSA0NSAyMC4xNDg0MzggNDUgNDV6bTAgMCIvPjxwYXRoIGQ9Im0zMzIgMTIwaC0xNTJjLTMzLjA4NTkzOCAwLTYwIDI2LjkxNDA2Mi02MCA2MHYxNTJjMCAzMy4wODU5MzggMjYuOTE0MDYyIDYwIDYwIDYwaDE1MmMzMy4wODU5MzggMCA2MC0yNi45MTQwNjIgNjAtNjB2LTE1MmMwLTMzLjA4NTkzOC0yNi45MTQwNjItNjAtNjAtNjB6bS03NiAyMTFjLTQxLjM1NTQ2OSAwLTc1LTMzLjY0NDUzMS03NS03NXMzMy42NDQ1MzEtNzUgNzUtNzUgNzUgMzMuNjQ0NTMxIDc1IDc1LTMzLjY0NDUzMSA3NS03NSA3NXptODYtMTQ2Yy04LjI4NTE1NiAwLTE1LTYuNzE0ODQ0LTE1LTE1czYuNzE0ODQ0LTE1IDE1LTE1IDE1IDYuNzE0ODQ0IDE1IDE1LTYuNzE0ODQ0IDE1LTE1IDE1em0wIDAiLz48cGF0aCBkPSJtMzc3IDBoLTI0MmMtNzQuNDM3NSAwLTEzNSA2MC41NjI1LTEzNSAxMzV2MjQyYzAgNzQuNDM3NSA2MC41NjI1IDEzNSAxMzUgMTM1aDI0MmM3NC40Mzc1IDAgMTM1LTYwLjU2MjUgMTM1LTEzNXYtMjQyYzAtNzQuNDM3NS02MC41NjI1LTEzNS0xMzUtMTM1em00NSAzMzJjMCA0OS42MjUtNDAuMzc1IDkwLTkwIDkwaC0xNTJjLTQ5LjYyNSAwLTkwLTQwLjM3NS05MC05MHYtMTUyYzAtNDkuNjI1IDQwLjM3NS05MCA5MC05MGgxNTJjNDkuNjI1IDAgOTAgNDAuMzc1IDkwIDkwem0wIDAiLz48L3N2Zz4=" />
                </a>
            </div>
        </div>
    </div>
</div>