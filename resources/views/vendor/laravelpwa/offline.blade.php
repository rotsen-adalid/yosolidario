<x-app-layout>
    <x-slot name="title">
        YoSolidario: {{__('Collection platform')}}
    </x-slot>
    <x-slot  name="seo">
  
        <meta property="og:url"                content="http://www.nytimes.com/2015/02/19/arts/international/when-great-minds-dont-think-alike.html" />
        <meta property="og:type"               content="article" />
        <meta property="og:title"              content="When Great Minds Don’t Think Alike" />
        <meta property="og:description"        content="How much does culture influence creative thinking?" />
        <meta property="og:image"              content="http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg" />
        
      </x-slot>
      
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-slot  name="menu">

    </x-slot>
    <!-- component -->
<style>
    /* This example part of kwd-dashboard see https://kamona-wd.github.io/kwd-dashboard/ */
    /* So here we will write some classes to simulate dark mode and tailwind css config in our project */
    :root {
    --light: #edf2f9;
    --dark: #152e4d;
    --darker: #12263f;
    }

    .dark .dark\:text-light {
    color: var(--light);
    }

    .dark .dark\:bg-dark {
    background-color: var(--dark);
    }

    .dark .dark\:bg-darker {
    background-color: var(--darker);
    }

    .dark .dark\:text-gray-300 {
    color: #D1D5DB;
    }
</style>

<div x-data="setup()" x-init="$refs.loading.classList.add('hidden');" :class="{ 'dark': isDark }">
    <main
        aria-labelledby="pageTitle"
        class="flex items-center justify-center h-screen bg-white"
      >
        <div class="p-4 space-y-4">
          <div class="flex flex-col items-start space-y-3 sm:flex-row sm:space-y-0 sm:items-center sm:space-x-3">
            <p class="font-semibold text-red-500 text-9xl dark:text-red-600">404</p>
            <div class="space-y-2">
              <h1 id="pageTitle" class="flex items-center space-x-2">
                <svg
                  aria-hidden="true"
                  class="w-6 h-6 text-red-500 dark:text-red-600"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                  />
                </svg>
                <span class="text-xl font-medium text-gray-600 sm:text-2xl dark:text-light">
                  Oops! {{__('Disconnected')}}
                </span>
              </h1>
              <p class="text-base font-normal text-gray-600 dark:text-gray-300">
                {{__('You do not have an internet connection or access to the platform is blocked')}}
              </p>
              <p class="text-base font-normal text-gray-600 dark:text-gray-300">
                {{__('You can go back to the')}}
                <a href="/" class="text-ys1 hover:underline font-semibold">
                    {{__('home page')}}
                </a> {{__('e intentar')}}
              </p>
            </div>
          </div>
        </div>
    </main>
</div>

</x-app-layout>
