<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-ys1 border border-transparent rounded-md font-semibold text-sm text-white tracking-widest hover:bg-ys2 active:bg-ys2 focus:outline-none focus:border-ys2 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
