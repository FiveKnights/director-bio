<!-- PROJECT MODAL -->
<div x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 dark:bg-black/80 backdrop-blur-sm" style="display: none;">
    <div class="bg-white dark:bg-[#0e1420] border-2 border-[#1d6cd8] dark:border-[#00f0ff] max-w-2xl w-full p-6 shadow-2xl rounded-lg space-y-4 max-h-[90vh] overflow-y-auto" @click.outside="modalOpen = false">
        <div class="border-b border-slate-300 dark:border-slate-800 pb-3 flex justify-between items-start">
            <div>
                <span class="text-xs font-tech text-[#1d6cd8] dark:text-[#00f0ff] font-bold" x-text="activeProject?.code"></span>
                <h3 class="text-xl font-black text-slate-800 dark:text-slate-100 uppercase" x-text="activeProject?.title"></h3>
            </div>
            <button @click="modalOpen = false" class="text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-100 font-bold text-lg font-tech cursor-pointer">[X]</button>
        </div>

        <div class="space-y-3 text-xs text-slate-600 dark:text-slate-300">
            <div x-show="activeProject?.imageUrl"
                class="border border-slate-300 dark:border-slate-800 bg-slate-100 dark:bg-slate-900">
                <img :src="activeProject?.imageUrl" :alt="activeProject?.title"
                    class="w-full h-auto max-h-72 object-contain"
                    x-on:error="$el.parentElement.style.display = 'none'">
            </div>
            <p x-text="activeProject?.fullDesc" class="leading-relaxed"></p>

            <div class="bg-slate-100 dark:bg-slate-900 p-3 border border-slate-300 dark:border-slate-800 space-y-2">
                <span class="font-tech font-bold text-[#1d6cd8] dark:text-[#00f0ff] block">KEY HIGHLIGHTS:</span>
                <ul class="list-disc list-inside space-y-1 font-medium">
                    <template x-for="item in activeProject?.highlights" :key="item">
                        <li x-text="item"></li>
                    </template>
                </ul>
            </div>
            <div class="flex flex-wrap gap-2 pt-1"
                x-show="activeProject?.links?.github || activeProject?.links?.demo">
                <a x-show="activeProject?.links?.github" :href="activeProject?.links?.github"
                    target="_blank" rel="noopener noreferrer"
                    class="px-4 py-2 text-xs font-tech font-bold uppercase border border-[#1d6cd8]/30 dark:border-[#00f0ff]/30 text-[#1d6cd8] dark:text-[#00f0ff] hover:bg-[#1d6cd8] dark:hover:bg-[#00f0ff] hover:text-white dark:hover:text-slate-950 transition-colors">
                    <i class="fa-brands fa-github"></i> SOURCE
                </a>
                <a x-show="activeProject?.links?.demo" :href="activeProject?.links?.demo"
                    target="_blank" rel="noopener noreferrer"
                    class="px-4 py-2 text-xs font-tech font-bold uppercase border border-[#1d6cd8]/30 dark:border-[#00f0ff]/30 text-[#1d6cd8] dark:text-[#00f0ff] hover:bg-[#1d6cd8] dark:hover:bg-[#00f0ff] hover:text-white dark:hover:text-slate-950 transition-colors">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> LIVE DEMO
                </a>
            </div>
        </div>

        <div class="pt-3 border-t border-slate-300 dark:border-slate-800 flex justify-end">
            <button @click="modalOpen = false" class="bg-[#1d6cd8] dark:bg-[#00f0ff] text-white dark:text-slate-950 px-5 py-2 text-xs font-tech font-bold uppercase hover:bg-[#1557b0] dark:hover:bg-[#00c8d6] transition-colors clip-button cursor-pointer">
                CLOSE SPEC
            </button>
        </div>
    </div>
</div>