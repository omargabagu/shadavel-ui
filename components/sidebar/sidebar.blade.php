<div class="w-full">
    <aside 
        id="sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full duration-500 border-r border-gray-200 bg-gray-80"
        aria-label="Sidebar"
    >
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50">
            <ul class="space-y-2 font-medium">
                {{ $sidebar }}
            </ul>
        </div>
    </aside>

    <div id="sidebar-content" class="p-4 transition-all duration-500" style="margin-left: 0;">
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
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('sidebar-content');
    const toggleButton = document.getElementById('sidebarToggle');

    toggleButton.addEventListener('click', () => {
        const isHidden = sidebar.classList.contains('-translate-x-full');

        if (isHidden) {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');

            content.style.marginLeft = '16rem';
        } else {
            sidebar.classList.add('-translate-x-full');
            sidebar.classList.remove('translate-x-0');

            content.style.marginLeft = '0';
        }
    });

    if (!sidebar.classList.contains('-translate-x-full')) {
        content.style.marginLeft = '16rem';
    }
});
</script>

