@props([
    'type' => 'text',
    'description' => null,
    'label' => null
])
@php
    $inputId = $attributes->get('id') ?? 'input-' . uniqid();
    $passwordBtn = $type == 'password' && $attributes->get('id');
    $classes = 'flex h-9 w-full rounded-md border border-gray-300 bg-transparent px-3
    py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium 
    placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-gray-200 disabled:cursor-not-allowed disabled:opacity-50
    ';
    if ($passwordBtn) $classes .= ' rounded-r-none';
@endphp

<div class="mb-4">
@if ($label)
    <p class='mb-2 font-semibold leading-none tracking-tight'><small>
        {{ $label }}
    </small>
    </p>
@endif
<div class="p-0 m-0 flex">
<input
    id="{{ $inputId }}"
    type="{{ $type }}"
    
    {{ $attributes->merge(['class' => $classes]) }}
/>

@if ($passwordBtn)
    <x-button type="button" class="rounded-l-none shadow m-0 pl-3 pr-3 w-fit-content" onclick="togglePassword('{{ $inputId }}')">
        <svg  class ="" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path class="hidden {{ $inputId }}-icon" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
        <path class="hidden {{ $inputId }}-icon" d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
        <path class="hidden {{ $inputId }}-icon" d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
        <line class="hidden {{ $inputId }}-icon" x1="2" x2="22" y1="2" y2="22"></line>
        <path class="block  {{ $inputId }}-eye" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
        <circle class="block  {{ $inputId }}-eye" cx="12" cy="12" r="3"></circle> 
        </svg>
    </x-button>
    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            const icons = document.getElementsByClassName(`${id}-icon`);
            const eyes = document.getElementsByClassName(`${id}-eye`);
            if (!input) return;
            const showPassword = input.type === "password";
            input.type = showPassword ? "text" : "password";
            Array.from(icons).forEach(el => {
                el.classList.toggle("hidden", !showPassword);
            });
            Array.from(eyes).forEach(el => {
                el.classList.toggle("hidden", showPassword);
            });
        }
    </script>
@endif
</div>
@if ($description)
    <p class='text-[0.8rem] text-muted-foreground text-gray-500 mt-2'>
        {{ $description }}
    </p>
@endif
</div>
