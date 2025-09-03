<div class="w-full flex">
    <aside 
        id="sidebar"
        class="fixed top-0 left-0 z-40 h-screen border-r border-gray-200 bg-gray-80 transition-[width] duration-200 w-64"
        aria-label="Sidebar"
    >
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50">
            <ul class="space-y-2 font-medium">
                {{ $sidebar }}
            </ul>
        </div>
    </aside>

    <div id="sidebar-content" class="flex-1 p-4 transition-margin duration-200" style="margin-left: 16rem;">
        <div class="flex gap-4 items-center mb-2">
            <button 
                id="sidebarToggle" 
                type="button"
                class="inline-flex items-center p-2 text-sm text-gray-800 rounded-lg hover:bg-gray-100"
            >
                <span class="sr-only">Toggle sidebar</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-panel-left">
                    <rect width="18" height="18" x="3" y="3" rx="2"></rect>
                    <path d="M9 3v18"></path>
                </svg>
            </button>
            {{ $title }}
        </div>
        {{ $content }}
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('sidebar-content');
    const toggleButton = document.getElementById('sidebarToggle');

    let isOpen = true; // start closed (thin)

    toggleButton.addEventListener('click', () => {
        if (isOpen) {
            // Close sidebar (thin)
            sidebar.classList.remove('w-64');
            sidebar.classList.add('w-16', 'sidebar-closed');
            content.style.marginLeft = '4rem';
        } else {
            // Open sidebar (wide)
            sidebar.classList.remove('w-16', 'sidebar-closed');
            sidebar.classList.add('w-64');
            content.style.marginLeft = '16rem';
        }
        isOpen = !isOpen;
    });

});

</script>

<style>
    .sidebar-label {
        white-space: nowrap;
    }

    .sidebar-closed .sidebar-label {
        pointer-events: none;
        width: 0;
        overflow: hidden;
        display: none;
    }

</style>
