<div class="bg-white overflow-hidden border border-gray-200 shadow-xl sm:rounded-lg w-full">
    @if (isset($head_option))
    <div class=" justify-between items-center sm:flex sm:flex-row block flex-col p-4 sm:space-x-2 space-y-2 sm:space-y-0 ">
        {{ $head_option }}
    </div>
    @endif
    <div class="flex flex-col mt-1">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden border-b border-gray-200 rounded-md shadow-md">
                <table class="min-w-full overflow-x-scroll divide-y divide-gray-200">
                    @if (isset($thead))
                    <thead class="bg-gray-100">
                        <tr>
                            {{$thead}}
                        </tr>
                    </thead>
                    @endif
                <tbody class="bg-white divide-y divide-gray-200">
                    {{$tbody}}
                </tbody>
                </table>
                @if (isset($paginate))
                <div class="mx-6 mb-5 mt-2">
                    {{$paginate}}
                </div>
                @endif
            </div>
            </div>
        </div>
    </div>
</div>