@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1 mt-1']) }}>
        @foreach ((array) $messages as $message)
            <li class="flex items-start">
                <i class="fas fa-exclamation-circle mt-0.5 mr-1.5 text-xs"></i>
                <span>{{ $message }}</span>
            </li>
        @endforeach
    </ul>
@endif