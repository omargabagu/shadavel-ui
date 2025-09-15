
@props(['active' => false, 'id' => ''])

<div class = "
    @if($active) bg-white shadow-sm @endif
    tab focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:outline-ring 
    text-foreground inline-flex h-[calc(100%_-_1px)] flex-1 
    items-center justify-center gap-1.5 rounded-md border border-transparent px-2 py-1 
    text-sm font-medium whitespace-nowrap transition-[color,box-shadow] focus-visible:ring-[3px] 
    focus-visible:outline-1 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none 
    [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4 cursor-default"
    @if ($id) id="{{ $id }}" @endif
    @if ($active) active @endif>
    {{ $slot }}
</div>