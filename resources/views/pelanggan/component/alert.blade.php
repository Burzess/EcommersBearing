@props([
    'type' => 'success', // success, error, warning, info
    'dismissible' => true,
])

@php
    $types = [
        'success' => [
            'bg' => 'bg-green-100 border-green-400 text-green-700',
            'icon' => 'check-circle',
        ],
        'error' => [
            'bg' => 'bg-red-100 border-red-400 text-red-700',
            'icon' => 'exclamation-circle',
        ],
        'warning' => [
            'bg' => 'bg-yellow-100 border-yellow-400 text-yellow-700',
            'icon' => 'exclamation-triangle',
        ],
        'info' => [
            'bg' => 'bg-primary-100 border-primary-400 text-primary-700',
            'icon' => 'info-circle',
        ],
    ];
    
    $config = $types[$type] ?? $types['info'];
@endphp

<div {{ $attributes->merge(['class' => $config['bg'] . ' border px-4 py-3 rounded-lg mb-6']) }} role="alert">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <i class="fas fa-{{ $config['icon'] }} mr-2"></i>
            <span>{{ $slot }}</span>
        </div>
        @if($dismissible)
            <button type="button" onclick="this.parentElement.parentElement.remove()" class="hover:opacity-70">
                <i class="fas fa-times"></i>
            </button>
        @endif
    </div>
</div>
