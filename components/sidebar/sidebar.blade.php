<div class="w-full flex">
    <aside 
        id="sidebar"
        class="fixed top-0 left-0 z-40 h-screen border-r border-gray-200 bg-gray-80 transition-all duration-200"
        aria-label="Sidebar"
    >
        <div class="bg-gray-50 h-screen flex flex-col">
            <div class="p-2 flex justify-between mb-2 bg-gray-50 z-10">
                <div class="w-full whitespace-nowrap overflow-hidden">
                    <x-sidebar.title href="/">
                        <x-slot name="icon">
                            <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"
                                stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d='M6.133 21C4.955 21 4 20.02 4 18.81v-8.802c0-.665.295-1.295.8-1.71l5.867-4.818a2.09 2.09 0 0 1 2.666 0l5.866 4.818c.506.415.801 1.045.801 1.71v8.802c0 1.21-.955 2.19-2.133 2.19z' />
                                <path d='M9.5 21v-5.5a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2V21' />
                            </svg>
                        </x-slot>
                        {{ $title }}
                    </x-sidebar.title>
                </div>
            </div>
            <div class="flex-1 overflow-y-auto p-2" style="scrollbar-width: thin;">
                <ul class="space-y-1 font-medium">
                    {{ $sidebar }}
                </ul>
            </div>
        </div>
    </aside>

    <div 
        id="sidebar-backdrop" 
        class="fixed inset-0 z-30 hidden bg-black/50"
    ></div>

    <div id="sidebar-content" class="transition-margin duration-200 w-full" style="margin-left: 16rem;">
        <div class="z-10 w-full flex gap-4 items-center p-2 mb-2 border-b border-gray-200 sticky top-0 bg-white">
            <button 
                id="sidebarContentToggle" 
                type="button"
                class="inline-flex items-center p-2 text-sm text-gray-800 rounded-lg hover:bg-gray-100 w-8 h-8 cursor-pointer"
            >
                <span class="sr-only">Toggle sidebar</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-panel-left">
                    <rect width="18" height="18" x="3" y="3" rx="2"></rect>
                    <path d="M9 3v18"></path>
                </svg>
            </button>
            {{ $title }}
        </div>
        <div class="flex justify-center overflow-y-auto">
            <div class="p-2 max-w-6xl w-full">
                {{ $content }}
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('sidebar-content');
    const backdrop = document.getElementById('sidebar-backdrop');
    const contentToggle = document.getElementById('sidebarContentToggle');
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

    
    [backdrop, contentToggle].forEach(btn => {
        btn.addEventListener('click', () => {
            isOpen = !isOpen;
            handleResize();
        });
    });

    handleResize();
    function handleResize() {
        console.log("is small: " + is_small + " is open: " + isOpen);
        sidebar.classList.remove('shadow-lg');
        
        if (isOpen) {
            backdrop.classList.add('hidden');
            sidebar.classList.remove('w-16', 'sidebar-closed');
            sidebar.classList.add('w-64');
            if (is_small) {
                sidebar.classList.add('fixed', 'top-0', 'left-0', 'z-40', 'shadow-lg');
                backdrop.classList.remove('hidden');
            }else{
                content.style.marginLeft = '16rem';
            }
            
        } else {
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
    .bg-backdrop {
        background-color: #000 !important;
    }

</style>
