<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-ys1 border border-transparent rounded-md font-bold text-sm text-white shadow-md tracking-widest hover:bg-ys2 active:bg-gray-900 focus:outline-none focus:border-green-600 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
