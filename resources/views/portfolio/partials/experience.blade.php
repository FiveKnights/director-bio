<div class="max-w-6xl mx-auto mt-10 space-y-6">

    <div class="border-b border-slate-300 dark:border-slate-800 pb-2 flex justify-between items-center" data-reveal>
        <div>
            <span class="text-xs font-tech text-[#1d6cd8] dark:text-[#00f0ff] font-bold uppercase tracking-widest">// SERVICE RECORD</span>
            <h2 class="text-xl font-black text-slate-800 dark:text-slate-100 uppercase">EXPERIENCE TIMELINE</h2>
        </div>
        <span class="text-xs font-tech text-slate-500 dark:text-slate-400">TOTAL: {{ count($experience) }} ENTRIES</span>
    </div>

    <div class="relative ml-3 pl-8 space-y-6 border-l-2 border-[#1d6cd8]/30 dark:border-[#00f0ff]/30">
        @foreach ($experience as $item)
            <div class="relative" data-reveal style="--delay: {{ ($loop->index % 3) * 90 }}ms; transition-delay: var(--delay);">

                {{-- Timeline node --}}
                <span class="absolute -left-[45px] top-4 w-6 h-6 rounded-full flex items-center justify-center text-[10px]
                             bg-[#1d6cd8] dark:bg-[#00f0ff] text-white dark:text-slate-950
                             ring-4 ring-slate-100 dark:ring-[#090d16]">
                    <i class="{{ $item['icon'] }}"></i>
                </span>

                <div class="bg-white/90 dark:bg-[#0e1420]/90 backdrop-blur-md border border-slate-300 dark:border-slate-800 hover:border-[#1d6cd8] dark:hover:border-[#00f0ff] p-5 shadow-sm rounded-lg space-y-2 transition-colors">

                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <div class="flex items-center gap-2 font-tech text-[10px] font-bold tracking-widest uppercase">
                            <span class="text-[#1d6cd8] dark:text-[#00f0ff]">{{ $item['type'] }}</span>
                            @if (!empty($item['current']))
                                <span class="flex items-center gap-1 px-2 py-0.5 bg-[#10b981]/10 text-[#10b981] border border-[#10b981]/30">
                                    <span class="w-1.5 h-1.5 bg-[#10b981] rounded-full animate-pulse"></span>
                                    CURRENT
                                </span>
                            @endif
                        </div>
                        <span class="font-tech text-xs text-slate-500 dark:text-slate-400">{{ $item['period'] }}</span>
                    </div>

                    <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 uppercase">{{ $item['title'] }}</h3>
                    <p class="text-xs font-tech text-slate-500 dark:text-slate-400">{{ $item['org'] }}</p>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">{{ $item['desc'] }}</p>

                    @if (!empty($item['tags']))
                        <div class="flex flex-wrap gap-1.5 pt-1">
                            @foreach ($item['tags'] as $tag)
                                <span class="text-[10px] font-tech px-2 py-0.5 bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-300 border border-slate-300 dark:border-slate-700">{{ $tag }}</span>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        @endforeach
    </div>

</div>