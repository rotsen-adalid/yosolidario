<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white rounded-md font-bold text-sm text-gray-900 tracking-widest hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
