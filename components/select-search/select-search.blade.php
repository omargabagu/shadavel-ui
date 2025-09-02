@props([
    'options' => [],
    'inputid',
    'label',
    'relation',
    'displaycolumn' => 'name',
    'nulloption'=> false,
    'relationid'=> '',
    'relationdisplay'=> '',
    'required' => false
])

<div id="{{ $inputid }}-autocomplete" class="relative w-full mb-4">
    <label for="{{ $inputid }}" class="mb-2 font-semibold leading-none tracking-tight">{{ $label }}</label>

    @if($relationdisplay)
        <input name="{{ $inputid }}" id="{{ $inputid }}" class="hidden" readonly
            value="{{ old($inputid, $relationid) }}"
            @if($required) required @endif
        >

        <input id="{{ $inputid }}_display" placeholder="Select an option:"
            value="{{ old($inputid.'_display', $relationdisplay) }}"
            class="flex h-9 w-full rounded-md border border-gray-300 bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-gray-200 disabled:cursor-not-allowed disabled:opacity-50"
            readonly @if($required) required @endif
        >
    @else
        <input name="{{ $inputid }}" id="{{ $inputid }}" class="hidden" readonly @if($required) required @endif>

        <input id="{{ $inputid }}_display" placeholder="Select an option..."
            class="flex h-9 w-full rounded-md border border-gray-300 bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-gray-200 disabled:cursor-not-allowed disabled:opacity-50"
            readonly @if($required) required @endif
        >
    @endif

    <!-- Dropdown options -->
    <div id="{{ $inputid }}-options-container"
        class="absolute z-50 mt-1 w-full bg-white border border-gray-300 shadow-md max-h-64 overflow-y-auto hidden"
    >
        <div class="sticky top-0 bg-white p-2 border-b border-gray-200">
            <input type="text" id="{{ $inputid }}searchInput" placeholder="Search..."
                class="flex h-9 w-full rounded-md border border-gray-300 bg-transparent px-3 py-1 text-sm shadow-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-200"
                autocomplete="off"
            >
        </div>

        @if ($nulloption)
            <div class="{{ $inputid }}-option px-3 py-2 hover:bg-gray-100 cursor-pointer text-sm text-gray-800" data-value="">Ninguno</div>
        @endif

        @foreach($options as $item)
            <div class="{{ $inputid }}-option px-3 py-2 hover:bg-gray-100 cursor-pointer text-sm text-gray-800"
                 data-value="{{ is_array($item) ? $item['id'] : $item->id }}">
                {{ is_array($item) ? $item[$displaycolumn] : $item->$displaycolumn }}
            </div>
        @endforeach
    </div>
</div>

<style>
    .{{ $inputid }}-option.active {
        background-color: #e5e7eb; /* Tailwind gray-200 */
        color: #111827; /* Tailwind gray-900 */
    }
</style>

<script>
(() => {
    const container = document.getElementById('{{ $inputid }}-autocomplete');
    const displayInput = container.querySelector('#{{ $inputid }}_display');
    const realInput = container.querySelector('#{{ $inputid }}');
    const searchInput = container.querySelector('#{{ $inputid }}searchInput');
    const optionsContainer = container.querySelector('#{{ $inputid }}-options-container');
    const optionsSelector = '.{{ $inputid }}-option';

    optionsContainer.addEventListener('mouseover', (event) => {
        const option = event.target.closest(optionsSelector);
        if (!option) return;
        clearActive();
        option.classList.add('active');
    });

    optionsContainer.addEventListener('click', (event) => {
        const option = event.target.closest(optionsSelector);
        if (!option) return;
        selectOption(option);
    });

    function removeAccents(text) {
        const sustitutions = {
            'àáâãäå': "a", 'ÀÁÂÃÄÅ': "A", 'èéêë': "e", 'ÈÉÊË': "E",
            'ìíîï': "i", 'ÌÍÎÏ': "I", 'òóôõö': "o", 'ÒÓÔÕÖ': "O",
            'ùúûü': "u", 'ÙÚÛÜ': "U", 'ýÿ': "y", 'ÝŸ': "Y",
            'ß': "ss", 'ñ': "n", 'Ñ': "N"
        };
        function getLetterReplacement(letter, replacements) {
            return Object.keys(replacements).find(key => key.includes(letter)) ?
                replacements[Object.keys(replacements).find(key => key.includes(letter))] :
                letter;
        }
        return text.split("").map(letter => getLetterReplacement(letter, sustitutions)).join("");
    }

    document.addEventListener('click', function(event) {
        if ([displayInput, searchInput].includes(event.target)) {
            optionsContainer.classList.remove('hidden');
            searchInput.focus();
        } else if (!container.contains(event.target)) {
            optionsContainer.classList.add('hidden');
            clearActive();
        }
    });

    searchInput.addEventListener('input', () => {
        const input = removeAccents(searchInput.value.toLowerCase());
        const options = container.querySelectorAll(optionsSelector);
        options.forEach(option => {
            const optionText = removeAccents(option.textContent.toLowerCase());
            option.style.display = optionText.includes(input) ? '' : 'none';
        });
        clearActive();
    });

    function clearActive() {
        container.querySelectorAll(optionsSelector).forEach(o => o.classList.remove('active'));
    }

    function setActive(offset) {
        const options = Array.from(container.querySelectorAll(optionsSelector)).filter(o => o.style.display !== 'none');
        if (options.length === 0) return;

        let currentIndex = options.findIndex(opt => opt.classList.contains('active'));
        let newIndex = currentIndex + offset;

        if (currentIndex === -1) {
            newIndex = offset > 0 ? 0 : options.length - 1;
        } else {
            if (newIndex < 0) newIndex = options.length - 1;
            if (newIndex >= options.length) newIndex = 0;
        }

        clearActive();
        options[newIndex].classList.add('active');

        const optionRect = options[newIndex].getBoundingClientRect();
        const containerRect = optionsContainer.getBoundingClientRect();
        if (optionRect.top < containerRect.top || optionRect.bottom > containerRect.bottom) {
            options[newIndex].scrollIntoView({ block: "nearest" });
        }
    }

    function selectOption(option) {
        clearActive();
        option.classList.add('active');
        displayInput.value = option.textContent;
        realInput.value = option.dataset.value;
        realInput.dispatchEvent(new Event('change'));
        optionsContainer.classList.add('hidden');
        justSelected = true;
        setTimeout(() => justSelected = false, 200);
        displayInput.focus();
    }

    searchInput.addEventListener('keydown', (e) => {
        const visibleOptions = Array.from(container.querySelectorAll(optionsSelector)).filter(o => o.style.display !== 'none');
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            setActive(1);
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            setActive(-1);
        } else if (e.key === 'Enter') {
            e.preventDefault();
            const active = visibleOptions.find(o => o.classList.contains('active'));
            if (active) selectOption(active);
        } else if (e.key === 'Escape') {
            e.preventDefault();
            optionsContainer.classList.add('hidden');
            clearActive();
            displayInput.focus();
        }
    });

    let justSelected = false;

    displayInput.addEventListener('focus', () => {
        if (!justSelected) {
            optionsContainer.classList.remove('hidden');
            searchInput.focus();
        }
    });
})();
</script>
