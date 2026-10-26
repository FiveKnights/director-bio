<!-- PAGE 4: OPERATIONS -->
<section x-show="activeTab === 'projects'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;">
    <div class="space-y-6 max-w-6xl mx-auto">
        
        <div class="border-b border-slate-300 dark:border-slate-800 pb-2 flex justify-between items-center">
            <div>
                <span class="text-xs font-tech text-[#1d6cd8] dark:text-[#00f0ff] font-bold uppercase tracking-widest">// DEPLOYMENT RECORDS</span>
                <h2 class="text-xl font-black text-slate-800 dark:text-slate-100 uppercase">ACTIVE OPERATIONS & PROJECTS</h2>
            </div>
            <span class="text-xs font-tech text-slate-500 dark:text-slate-400">TOTAL: {{ count($projects) }} OPERATIONS</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <template x-for="proj in projects" :key="proj.code">
                <div class="bg-white/90 dark:bg-[#0e1420]/90 backdrop-blur-md border border-slate-300 dark:border-slate-800 hover:border-[#1d6cd8] dark:hover:border-[#00f0ff] p-5 shadow-sm rounded-lg flex flex-col justify-between transition-all group">
                    <div class="space-y-3">
                        <div x-show="proj.imageUrl"
     class="aspect-video overflow-hidden border border-slate-300 dark:border-slate-800 bg-slate-100 dark:bg-slate-900">
    <img :src="proj.imageUrl" :alt="proj.title" loading="lazy"
         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
         x-on:error="$el.parentElement.style.display = 'none'">
</div>
                        <div class="flex justify-between items-center">
                            <span class="text-xs font-tech font-bold text-[#1d6cd8] dark:text-[#00f0ff]" x-text="proj.code"></span>
                            <span class="text-[10px] font-tech font-bold px-2 py-0.5 border"
                                  :class="statusClass(proj.status)"
                                  x-text="proj.status"></span>
                        </div>

                        <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 uppercase group-hover:text-[#1d6cd8] dark:group-hover:text-[#00f0ff] transition-colors" x-text="proj.title"></h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed" x-text="proj.shortDesc"></p>

                        <div class="flex flex-wrap gap-1.5 pt-2">
                            <template x-for="tech in proj.tags" :key="tech">
                                <span class="text-[10px] font-tech px-2 py-0.5 bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-300 border border-slate-300 dark:border-slate-700" x-text="tech"></span>
                            </template>
                        </div>
                    </div>

                    <button @click="openProjectModal(proj)" 
                            class="mt-6 w-full bg-slate-100 dark:bg-slate-900 hover:bg-[#1d6cd8] dark:hover:bg-[#00f0ff] text-[#1d6cd8] dark:text-[#00f0ff] hover:text-white dark:hover:text-slate-950 font-bold py-2 px-4 text-xs font-tech tracking-wider uppercase transition-colors border border-[#1d6cd8]/30 dark:border-[#00f0ff]/30 flex items-center justify-center space-x-1 cursor-pointer">
                        <span>INSPECT SPEC</span>
                        <span>→</span>
                    </button>
                </div>
            </template>
        </div>

    </div>
</section>
