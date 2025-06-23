
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded shadow']) }}>
    {{ $slot }}
</button>

