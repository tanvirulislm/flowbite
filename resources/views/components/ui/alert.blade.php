@props([
    'type' => 'info',
    'message'
])

@php
$styles = [
    'success' => 'text-fg-success-strong bg-success-soft border-success-subtle',
    'danger'  => 'text-fg-danger-strong bg-danger-soft border-danger-subtle',
    'warning' => 'text-fg-warning bg-warning-soft border-warning-subtle',
    'info'    => 'text-fg-brand-strong bg-brand-softer border-brand-subtle',
];
@endphp

<div
    role="alert"
    {{-- I want it in the right side --}}
    class="fixed top-6 right-6 z-[9999]
           flex items-center gap-2 px-5 py-3 text-sm rounded-base border shadow-lg
           {{ $styles[$type] }}
           transition-all duration-300"
>
    <svg class="w-4 h-4 shrink-0"
         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
              stroke-width="2"
              d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
    </svg>

    <span>
        <span class="font-medium capitalize">{{ $type }}:</span>
        {{ $message }}
    </span>
</div>
