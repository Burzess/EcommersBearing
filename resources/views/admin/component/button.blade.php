@props(['type' => 'submit', 'variant' => 'primary'])

@php
    $baseClasses = 'inline-flex items-center justify-center px-4 py-2 rounded-lg font-medium text-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';

    $variantClasses = [
        'primary' => 'bg-primary-600 text-white hover:bg-primary-700 focus:ring-primary-500',
        'secondary' => 'bg-gray-600 text-white hover:bg-gray-700 focus:ring-gray-500',
        'success' => 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',
        'warning' => 'bg-yellow-500 text-white hover:bg-yellow-600 focus:ring-yellow-500',
        'info' => 'bg-cyan-600 text-white hover:bg-cyan-700 focus:ring-cyan-500',
        'outline' => 'bg-white border-2 border-primary-600 text-primary-600 hover:bg-primary-50 focus:ring-primary-500',
        'ghost' => 'bg-transparent text-gray-700 hover:bg-gray-100 focus:ring-gray-500',
    ];

    $classes = $baseClasses . ' ' . ($variantClasses[$variant] ?? $variantClasses['primary']);
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>