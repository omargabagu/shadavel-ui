<div class="w-full flex">
    <aside 
        id="sidebar"
        class="fixed top-0 left-0 z-40 h-screen border-r border-gray-200 bg-gray-80 transition-all duration-200"
        aria-label="Sidebar"
    >
    
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50">
            <div class="flex justify-between mb-2">
                <span id ="sidebarTitle" class="pt-1.5 whitespace-nowrap overflow-hidden">
                    {{ $title }}
                </span>
                
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
            </div>
            <ul class="space-y-2 font-medium">
                {{ $sidebar }}
            </ul>
        </div>
    </aside>

    <div 
        id="sidebar-backdrop" 
        class="fixed inset-0 z-30 hidden bg-black/50"
    ></div>

    <div id="sidebar-content" class="flex-1 p-4 transition-margin duration-200" style="margin-left: 16rem;">
        <div class="flex gap-4 items-center mb-2">
            <button 
                id="sidebarContentToggle" 
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
    const backdrop = document.getElementById('sidebar-backdrop');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const contentToggle = document.getElementById('sidebarContentToggle');
    const sidebarTitle = document.getElementById('sidebarTitle');
    let is_small = window.matchMedia('(max-width: 639px)').matches;
    let isOpen = true;
    if (is_small) {
        isOpen = false;
    }
    const mediaQuery = window.matchMedia('(max-width: 639px)');


    mediaQuery.addEventListener('change', (e) => {
        if (e.matches) {
            is_small = true;
            isOpen = false;
            handleResize();
        } else {
            is_small = false;
            handleResize();
        }
    });

    
    [sidebarToggle, contentToggle].forEach(btn => {
        btn.addEventListener('click', () => {
            isOpen = !isOpen;
            handleResize();
        });
    });

    handleResize();
    function handleResize() {
        console.log("is small: " + is_small + " is open: " + isOpen);
        sidebarToggle.style.display = 'none';
        sidebar.classList.remove('shadow-lg');
        if (isOpen) {
            sidebarTitle.style.display = 'block';
            backdrop.classList.add('hidden');
            sidebar.classList.remove('w-16', 'sidebar-closed');
            sidebar.classList.add('w-64');
            if (is_small) {
                sidebarToggle.style.display = 'block';
                sidebar.classList.add('fixed', 'top-0', 'left-0', 'z-40', 'shadow-lg');
                backdrop.classList.remove('hidden');
            }else{
                content.style.marginLeft = '16rem';
            }
            
        } else {
            sidebarTitle.style.display = 'none';
            sidebar.classList.remove('w-64');
            backdrop.classList.add('hidden');
            sidebar.classList.add('w-16', 'sidebar-closed');
            content.style.marginLeft = '4rem';
        }
    }

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
