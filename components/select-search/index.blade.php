@props([
    'options' => [],            // Array de opciones
    'inputid' => '',            // ID del input (obligatorio)
    'label' => null,            // Label opcional
    'displaycolumn' => 'name',  // Columna para mostrar en opciones
    'nulloption' => false,      // ¿Tiene opción vacía?
    'relationid' => '',         // Valor para el input oculto
    'relationdisplay' => '',    // Valor para mostrar en input visible
    'required' => false,        // ¿Campo requerido?
])

<div class="select-search relative w-full mb-4" data-select-search>
    @if ($label)
        <p class='mb-2 font-semibold leading-none tracking-tight'><small>{{ $label }}</small></p>
    @endif

    @if($relationdisplay)
        <input name="{{ $inputid }}" class="select-search-real-input hidden" readonly
            value="{{ old($inputid, $relationid) }}"
            @if($required) required @endif
        >

        <input class="select-search-display-input flex h-9 w-full rounded-md border border-gray-300 bg-transparent px-3 py-1 text-sm placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-gray-200" 
            placeholder="Select an option:" 
            value="{{ old($inputid.'_display', $relationdisplay) }}"
            readonly @if($required) required @endif
        >
    @else
        <input name="{{ $inputid }}" class="select-search-real-input hidden" readonly @if($required) required @endif>

        <input class="select-search-display-input flex h-9 w-full rounded-md border border-gray-300 bg-transparent px-3 py-1 text-sm placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-gray-200" 
            placeholder="Select an option..." readonly @if($required) required @endif
        >
    @endif

    <div class="select-search-options-container absolute z-50 mt-1 w-full bg-white border border-gray-300 max-h-64 overflow-y-auto hidden">
        <div class="sticky top-0 bg-white p-2 border-b border-gray-200">
            <input type="text" placeholder="Search..."
                class="select-search-input flex h-9 w-full rounded-md border border-gray-300 bg-transparent px-3 py-1 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-200"
                autocomplete="off"
            >
        </div>

        @if ($nulloption)
            <div class="select-search-option px-3 py-2 hover:bg-gray-100 cursor-pointer text-sm text-gray-800" data-value="">Ninguno</div>
        @endif

        @foreach($options as $item)
            <div class="select-search-option px-3 py-2 hover:bg-gray-100 cursor-pointer text-sm text-gray-800"
                 data-value="{{ is_array($item) ? $item['id'] : $item->id }}">
                 {{ is_array($item) ? $item[$displaycolumn] : $item->$displaycolumn }}
            </div>
        @endforeach
    </div>
</div>

<style>
    .select-search-option.active {
        background-color: #e5e7eb; /* Tailwind gray-200 */
        color: #111827; /* Tailwind gray-900 */
    }
</style>
