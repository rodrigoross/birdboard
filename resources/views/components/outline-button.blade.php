<button
    {{ $attributes->merge(['type' => 'submit','class' =>'inline-flex items-center px-4 py-2 bg-white border border-sky-500 rounded-md font-semibold text-xs text-sky-500 uppercase tracking-widest hover:bg-sky-500 hover:text-white active:bg-teal-900 focus:outline-none focus:border-sky-600 focus:ring ring-sky-300 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
