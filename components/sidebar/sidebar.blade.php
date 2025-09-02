<div class="w-full">
<aside id="sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 border-r border-gray-200 bg-gray-80 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            {{ $sidebar }}
        </ul>
    </div>
</aside>

<div id="sidebar-content" class="p-4 sm:ml-64">
    <div class="flex gap-4">
    <button id="sidebarToggle" type="button"
        class="inline-flex items-center p-2 mb-2 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-panel-left">
            <rect width="18" height="18" x="3" y="3" rx="2"></rect>
            <path d="M9 3v18"></path>
        </svg>
    </button>
    
    </div>
    {{ $content }}
</div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');

    toggleButton.addEventListener('click', function () {
        console.log('clicked');
        sidebar.classList.toggle('-translate-x-full');
    });
});
</script>