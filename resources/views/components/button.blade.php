@props([
    'type' => 'submit',
])

<button
    type="{{ $type }}"
    {{
        $attributes->merge([
            'class' => 'px-6 py-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-lg transition disabled:bg-primary-600/50 disabled:cursor-not-allowed focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-600/80 focus-visible:ring-offset-2 inline-flex items-center justify-center leading-none',
        ])
    }}
>
    {{ $slot }}
</button>
