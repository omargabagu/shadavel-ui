<li>
    <a {{ $attributes->twMerge('flex items-center rounded-md hover:bg-gray-100') }}>
        <span class="w-9 h-9 p-2 flex items-center justify-center shrink-0">
            {{ $icon ?? '' }}
        </span>
        <span class="ml-2 font-medium sidebar-label">
            {{ $slot }}
        </span>
    </a>
</li>