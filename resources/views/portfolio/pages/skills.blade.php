<!-- PAGE 3: SKILL MATRIX -->
<section x-show="activeTab === 'skills'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;">
    <div class="space-y-6 max-w-6xl mx-auto">
        
        <div class="flex flex-wrap items-center justify-between gap-3 bg-white/90 dark:bg-[#0e1420]/90 border border-slate-300 dark:border-slate-800 p-3 rounded-lg">
            <span class="text-xs font-tech font-bold text-[#1d6cd8] dark:text-[#00f0ff] uppercase tracking-widest px-2">EVALUATION FILTER:</span>
            <div class="flex flex-wrap gap-2">
                <template x-for="cat in skillCategories" :key="cat.id">
                    <button @click="selectedSkillCategory = cat.id"
                            class="px-3 py-1 text-xs font-bold tracking-wider uppercase font-tech transition-colors cursor-pointer"
                            :class="selectedSkillCategory === cat.id ? 'bg-[#1d6cd8] dark:bg-[#00f0ff] text-white dark:text-slate-950' : 'bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-800'">
                        <span x-text="cat.label"></span>
                    </button>
                </template>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <template x-for="skill in filteredSkills" :key="skill.name">
                <div class="bg-white/90 dark:bg-[#0e1420]/90 backdrop-blur-md border border-slate-300 dark:border-slate-800 p-5 shadow-sm rounded-lg space-y-3 hover:border-[#1d6cd8] dark:hover:border-[#00f0ff] transition-colors">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="text-[10px] font-tech text-[#1d6cd8] dark:text-[#00f0ff] font-bold uppercase tracking-widest" x-text="skill.category"></span>
                            <h3 class="text-base font-bold text-slate-800 dark:text-slate-100" x-text="skill.name"></h3>
                        </div>
                        <span class="font-tech text-sm font-bold text-[#1d6cd8] dark:text-[#00f0ff] bg-slate-100 dark:bg-slate-900 px-2 py-0.5 border border-[#1d6cd8]/30 dark:border-[#00f0ff]/30" x-text="skill.level + '%'"></span>
                    </div>

                    <div class="w-full bg-slate-100 dark:bg-slate-900 h-2.5 border border-slate-300 dark:border-slate-700 rounded-sm overflow-hidden">
                        <div class="bg-[#1d6cd8] dark:bg-[#00f0ff] h-full transition-all duration-700" :style="'width: ' + skill.level + '%'"></div>
                    </div>

                    <p class="text-xs text-slate-500 dark:text-slate-400" x-text="skill.desc"></p>
                </div>
            </template>
        </div>

    </div>
</section>
