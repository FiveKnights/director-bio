<div class="max-w-4xl mx-auto mt-8 space-y-6">

    <div class="border-b border-slate-300 dark:border-slate-800 pb-2 flex justify-between items-center">
        <div>
            <span class="text-xs font-tech text-[#1d6cd8] dark:text-[#00f0ff] font-bold uppercase tracking-widest">// EXTERNAL CHANNELS</span>
            <h2 class="text-xl font-black text-slate-800 dark:text-slate-100 uppercase">NETWORK UPLINKS</h2>
        </div>
        <span class="text-xs font-tech text-slate-500 dark:text-slate-400">TOTAL: {{ count($socials) }} CHANNELS</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach ($socials as $social)
            <a href="{{ $social['url'] }}"
               target="_blank" rel="noopener noreferrer"
               class="group bg-white/90 dark:bg-[#0e1420]/90 backdrop-blur-md border border-slate-300 dark:border-slate-800 hover:border-[#1d6cd8] dark:hover:border-[#00f0ff] p-5 shadow-sm rounded-lg flex items-center gap-4 transition-all">

                <div class="w-12 h-12 shrink-0 bg-[#1d6cd8] dark:bg-[#00f0ff] text-white dark:text-slate-950 flex items-center justify-center font-tech font-bold text-lg clip-corner-tr">
                    <i class="{{ $social['icon'] }} text-xl"></i>
                </div>

                <div class="flex-1 min-w-0">
                    <span class="text-[10px] font-tech text-[#1d6cd8] dark:text-[#00f0ff] font-bold uppercase tracking-widest">{{ $social['name'] }}</span>
                    <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 truncate group-hover:text-[#1d6cd8] dark:group-hover:text-[#00f0ff] transition-colors">{{ $social['handle'] }}</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $social['desc'] }}</p>
                </div>

                <span class="font-tech text-[#1d6cd8] dark:text-[#00f0ff]">→</span>
            </a>
        @endforeach
    </div>

</div>