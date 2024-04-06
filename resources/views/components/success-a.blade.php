<a {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-cyan-700 border border-transparent rounded font-semibold text-xs text-white uppercase tracking-widest hover:bg-cyan-800 focus:bg-cyan-800 active:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-800 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</a>
