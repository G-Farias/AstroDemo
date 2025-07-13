<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-red-600 text-white text-sm font-medium px-4 py-2 rounded shadow']) }}{{ $disabled ?? false ? ' disabled' :'' }}>
    {{ $slot }}
</button>
