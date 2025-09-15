@props(['id' => ''])
<div class="flex flex-col gap-2" @if ($id) id="{{ $id }}" @endif>
    {{ $slot }}
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs_container = document.getElementById('{{ $id }}');
    if (!tabs_container) return;

    const tabs = tabs_container.querySelectorAll('.tab');
    const tabpanels = document.querySelectorAll('[tabs-id="{{ $id }}"]');

    // Initial setup: show/hide panels and update classes based on active tab
    tabs.forEach(tab => {
        const tabId = tab.getAttribute('id');
        const tabPanel = document.querySelector(`[panel-id="${tabId}"]`);

        if (tabPanel) {
            if (!tab.hasAttribute('active')) {
                tabPanel.style.display = 'none';
                tab.classList.remove('bg-white', 'shadow-sm');
            } else {
                tabPanel.style.display = '';
                tab.classList.add('bg-white', 'shadow-sm');
            }
        }
    });

    // Click event to switch tabs
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Remove active attribute and classes from all tabs
            tabs.forEach(t => {
                t.removeAttribute('active');
                t.classList.remove('bg-white', 'shadow-sm');
            });

            // Hide all tab panels
            tabpanels.forEach(panel => {
                panel.style.display = 'none';
            });

            // Activate clicked tab
            tab.setAttribute('active', '');
            tab.classList.add('bg-white', 'shadow-sm');

            // Show associated tab panel
            const tabId = tab.getAttribute('id');
            const tabPanel = document.querySelector(`[panel-id="${tabId}"]`);
            if (tabPanel) {
                tabPanel.style.display = '';
            }
        });
    });
});
</script>

