<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-slate-800 hover:bg-slate-900 text-white text-sm font-medium px-4 py-2 rounded shadow']) }}>
    {{ $slot }}
</button>
