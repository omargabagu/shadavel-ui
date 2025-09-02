@props([
    'type' => 'text',
    'description' => null,
    'label' => null
])
<div class="mb-4">
@if ($label)
    <p class='mb-2 font-semibold leading-none tracking-tight'>
        {{ $label }}
    </p>
@endif

<input
    type="{{ $type }}"
    {{ $attributes->twMerge('flex h-9 w-full rounded-md border border-gray-300 bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-gray-200 disabled:cursor-not-allowed disabled:opacity-50') }}
/>
@if ($description)
    <p class='text-[0.8rem] text-muted-foreground text-gray-500 mt-2'>
        {{ $description }}
    </p>
@endif
</div>