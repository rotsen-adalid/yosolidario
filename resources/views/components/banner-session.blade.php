@props(['style' => session('flash.bannerStyle', 'success'), 'message' => session('flash.banner'), ])

<div  
    {{ $attributes->merge(['class' => 'fixed w-full']) }}
        x-data="{{ json_encode(['show' => true, 'style' => $style, 'message' => $message, 'timeout' => null]), }}"
        :class="{ 'bg-green-500': style == 'success', 'bg-red-700': style == 'danger' }"
        style="display: none;"
        
        x-show.transition.opacity.out.duration.1500ms="show && message"
        x-init="
            () => { clearTimeout(timeout); show = true; timeout = setTimeout(() => { show = false }, 2000);  }
            "
            >
    <div class="max-w-screen-xl mx-auto py-2 px-3 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between flex-wrap">
            <div class="w-0 flex-1 flex items-center min-w-0">
                <span class="flex p-2 rounded-lg" :class="{ 'bg-green-600': style == 'success', 'bg-red-600': style == 'danger' }">
                    <span class="material-icons-outlined text-white ">check_circle</span>
                </span>

                <p class="ml-3 font-medium text-base text-white truncate">
                    {{__(session('flash.banner'))}}
                </p>
            </div>

            <div class="flex-shrink-0 sm:ml-3">
                <button
                    type="button"
                    class="-mr-1 flex p-2 rounded-md focus:outline-none sm:-mr-2 transition ease-in-out duration-150"
                    :class="{ 'hover:bg-green-600 focus:bg-green-600': style == 'success', 'hover:bg-red-600 focus:bg-red-600': style == 'danger' }"
                    aria-label="Dismiss"
                    x-on:click="show = false">
                    <span class="material-icons-outlined text-white">clear</span>
                </button>
            </div>
        </div>
    </div>
</div>
