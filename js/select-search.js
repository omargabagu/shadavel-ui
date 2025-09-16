document.addEventListener('DOMContentLoaded', () => {
    const selectSearches = document.querySelectorAll('[data-select-search]');

    selectSearches.forEach(container => {
        const displayInput = container.querySelector('.select-search-display-input');
        const realInput = container.querySelector('.select-search-real-input');
        const searchInput = container.querySelector('.select-search-input');
        const optionsContainer = container.querySelector('.select-search-options-container');
        const optionsSelector = '.select-search-option';

        function clearActive() {
            container.querySelectorAll(optionsSelector).forEach(o => o.classList.remove('active'));
        }

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

        searchInput.addEventListener('input', () => {
            const input = removeAccents(searchInput.value.toLowerCase());
            const options = container.querySelectorAll(optionsSelector);
            options.forEach(option => {
                const optionText = removeAccents(option.textContent.toLowerCase());
                option.style.display = optionText.includes(input) ? '' : 'none';
            });
            clearActive();
        });

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

        let justSelected = false;

        displayInput.addEventListener('focus', () => {
            if (!justSelected) {
                optionsContainer.classList.remove('hidden');
                searchInput.focus();
            }
        });

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
    });
});
