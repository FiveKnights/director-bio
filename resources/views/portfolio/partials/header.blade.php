<!-- MAIN HEADER HUD & NAV BAR (Visible after authentication) -->
<header x-show="isAuthenticated" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform -translate-y-4"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        class="relative z-30 max-w-7xl w-full mx-auto mb-6" style="display: none;">
    
    <div class="bg-white/90 dark:bg-[#0e1420]/90 backdrop-blur-md border-2 border-[#1d6cd8] dark:border-[#00f0ff] p-4 shadow-md clip-corner-tr flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 transition-colors">
        
        <!-- Left Branding & Telemetry -->
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-[#1d6cd8] dark:bg-[#00f0ff] flex items-center justify-center shrink-0 shadow-sm clip-corner-tr">
                <svg viewBox="0 0 100 100" class="w-8 h-8 text-white dark:text-slate-950 fill-current">
                    <path d="M 20,50 L 50,20 L 50,80 Z" opacity="0.9" />
                    <path d="M 52,10 L 62,10 L 62,90 L 52,90 Z" />
                    <path d="M 64,20 L 90,50 L 64,80 Z" opacity="0.9" />
                </svg>
            </div>
            <div>
                <div class="flex items-center space-x-2 font-tech text-[11px] text-[#1d6cd8] dark:text-[#00f0ff] font-bold tracking-wider">
                    <span class="w-2 h-2 bg-[#10b981] rounded-full animate-pulse"></span>
                    <span>OPERATOR: DIRECTOR FROST</span>
                    <span class="text-slate-400">//</span>
                    <span class="text-slate-500 dark:text-slate-400">RECORD #00924</span>
                </div>
                <h1 class="text-lg md:text-xl font-black text-slate-800 dark:text-slate-100 tracking-wider uppercase leading-none mt-0.5">
                    NON-ESSENTIAL PERSONNEL RETENTION DEPARTMENT
                </h1>
                <p class="text-[11px] text-slate-500 dark:text-slate-400 font-tech font-medium hidden sm:block">
                    Web Architecture & Embedded IoT Systems Division
                </p>
            </div>
        </div>

        <!-- Right Controls: Telemetry Clock, Audio SFX, Theme Switcher & Logout -->
        <div class="flex flex-wrap items-center gap-2.5 w-full lg:w-auto justify-between lg:justify-end border-t lg:border-t-0 border-slate-300 dark:border-slate-800 pt-3 lg:pt-0 font-tech">
            
            <!-- UTC Telemetry Clock -->
            <div class="px-2.5 py-1 bg-slate-100 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 text-xs text-slate-700 dark:text-slate-300 font-bold">
                <span class="text-[#1d6cd8] dark:text-[#00f0ff]">GMT:</span> <span x-text="clockTime"></span>
            </div>

    

            <!-- Clearance Tag -->
            <div class="px-2.5 py-1 bg-[#1d6cd8]/10 dark:bg-[#00f0ff]/10 border border-[#1d6cd8]/30 dark:border-[#00f0ff]/30 text-xs font-bold text-[#1d6cd8] dark:text-[#00f0ff] flex items-center space-x-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                <span>CLEARANCE: OMEGA</span>
            </div>

            
        </div>
    </div>

    <!-- Navigation Tabs Bar -->
    <nav class="mt-3 flex flex-wrap items-center gap-1 md:gap-2 pb-1">
        <template x-for="tab in tabs" :key="tab.id">
            <button @click="switchTab(tab.id)"
                    class="px-4 py-2 text-xs md:text-sm font-bold tracking-wider uppercase transition-all duration-150 flex items-center space-x-2 whitespace-nowrap border-b-2 cursor-pointer font-tech"
                    :class="activeTab === tab.id 
                        ? 'bg-[#1d6cd8] dark:bg-[#00f0ff] text-white dark:text-slate-950 border-[#1d6cd8] dark:border-[#00f0ff] shadow-md' 
                        : 'bg-white/70 dark:bg-[#0e1420]/70 hover:bg-white dark:hover:bg-[#0e1420] text-slate-600 dark:text-slate-400 hover:text-[#1d6cd8] dark:hover:text-[#00f0ff] border-transparent border-b-slate-300 dark:border-b-slate-800'">
                <span class="text-[10px] opacity-75" x-text="tab.code"></span>
                <span x-text="tab.label"></span>
            </button>
        </template>
    </nav>
</header>
