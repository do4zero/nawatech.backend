@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block px-4 py-1 bg-slate-100 border-l-4 border-slate-800 border rounded-md'
            : 'block pl-3 pr-4 py-1 border-transparent text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
