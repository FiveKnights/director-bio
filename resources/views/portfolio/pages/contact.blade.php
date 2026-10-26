<!-- PAGE 5: DIRECT COMM -->
<section x-show="activeTab === 'contact'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;">
    <div class="max-w-4xl mx-auto bg-white/90 dark:bg-[#0e1420]/90 backdrop-blur-md border border-slate-300 dark:border-slate-800 p-6 md:p-8 shadow-md rounded-lg space-y-6">

        <div class="border-b border-slate-300 dark:border-slate-800 pb-3 flex justify-between items-center">
            <div>
                <span class="text-xs font-tech text-[#1d6cd8] dark:text-[#00f0ff] font-bold uppercase tracking-widest">// ENCRYPTED TRANSMISSION PROTOCOL</span>
                <h2 class="text-xl font-black text-slate-800 dark:text-slate-100 uppercase">DIRECT COMM DISPATCHER</h2>
            </div>
            <span class="text-xs font-tech text-[#10b981] flex items-center space-x-1">
                <span class="w-2 h-2 bg-[#10b981] rounded-full animate-pulse"></span>
                <span>LINE_ONLINE</span>
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

            <form @submit.prevent="dispatchMessage()" class="md:col-span-7 space-y-4">
                <input type="text" x-model="contactForm.website" tabindex="-1" autocomplete="off"
                    aria-hidden="true" style="position:absolute; left:-9999px;">
                <div class="space-y-1">
                    <p x-show="contactForm.errors.name" x-text="contactForm.errors.name"
                        class="text-[11px] font-tech text-[#ef4444]" style="display: none;"></p>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400 font-tech">CALLSIGN</label>
                    <input type="text" x-model="contactForm.name" placeholder="AGENT / CLIENT NAME" class="w-full bg-slate-100 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 focus:border-[#1d6cd8] dark:focus:border-[#00f0ff] text-slate-800 dark:text-slate-100 px-3.5 py-2 text-xs font-bold focus:outline-none transition-colors" required>
                </div>

                <div class="space-y-1">
                    <p x-show="contactForm.errors.name" x-text="contactForm.errors.name"
                        class="text-[11px] font-tech text-[#ef4444]" style="display: none;"></p>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400 font-tech">RETURN EMAIL</label>
                    <input type="email" x-model="contactForm.email" placeholder="SENDER@@DOMAIN.COM" class="w-full bg-slate-100 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 focus:border-[#1d6cd8] dark:focus:border-[#00f0ff] text-slate-800 dark:text-slate-100 px-3.5 py-2 text-xs font-bold focus:outline-none transition-colors" required>
                </div>

                <div class="space-y-1">
                    <p x-show="contactForm.errors.name" x-text="contactForm.errors.name"
                        class="text-[11px] font-tech text-[#ef4444]" style="display: none;"></p>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400 font-tech">TRANSMISSION PAYLOAD</label>
                    <textarea x-model="contactForm.message" rows="4" placeholder="ENTER TRANSMISSION DETAILS..." class="w-full bg-slate-100 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 focus:border-[#1d6cd8] dark:focus:border-[#00f0ff] text-slate-800 dark:text-slate-100 p-3 text-xs font-medium focus:outline-none transition-colors resize-none" required></textarea>
                </div>

                <button type="submit" :disabled="contactForm.isSending" class="w-full bg-[#1d6cd8] dark:bg-[#00f0ff] hover:bg-[#1557b0] dark:hover:bg-[#00c8d6] text-white dark:text-slate-950 font-bold py-3 px-6 text-xs font-tech tracking-widest uppercase transition-colors shadow-md clip-button cursor-pointer disabled:opacity-50">
                    <span x-text="contactForm.isSending ? 'DISPATCHING PAYLOAD...' : 'TRANSMIT MESSAGE PACKET'"></span>
                </button>
            </form>

            <div class="md:col-span-5 bg-slate-900 text-slate-100 p-4 rounded border border-slate-800 font-tech text-[11px] flex flex-col justify-between h-80 md:h-auto">
                <div>
                    <div class="text-[#60a5fa] dark:text-[#00f0ff] border-b border-slate-800 pb-1 mb-2 font-bold flex justify-between">
                        <span>TERMINAL_CONSOLE</span>
                        <span>HK-LOG</span>
                    </div>
                    <div class="space-y-1.5 text-slate-400 overflow-y-auto max-h-52 pr-1" id="console-logs">
                        <div>[SYS] Ready for dispatcher payload...</div>
                        <template x-for="log in contactForm.logs" :key="log.time + log.text">
                            <div class="leading-tight">
                                <span class="text-[#60a5fa] dark:text-[#00f0ff]" x-text="'[' + log.time + ']'"></span>
                                <span x-text="log.text" :class="log.type === 'success' ? 'text-[#10b981]' : log.type === 'warn' ? 'text-[#f59e0b]' : 'text-slate-200'"></span>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('portfolio.partials.network')
</section>