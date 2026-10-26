<!-- ================= VIEW 1: AUTH GATE (LOGIN) ================= -->
<section x-show="!isAuthenticated" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
    <div class="bg-white/90 dark:bg-[#0e1420]/90 backdrop-blur-md border-2 border-slate-300 dark:border-slate-800 shadow-2xl p-6 md:p-10 max-w-5xl mx-auto rounded-lg relative overflow-hidden transition-colors">



        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">

            <!-- Left: HAAVK Geometric Emblem -->
            <div class="lg:col-span-6 flex flex-col items-center justify-center p-4 border-b lg:border-b-0 lg:border-r border-slate-300 dark:border-slate-800">
                <div class="w-48 h-48 md:w-60 md:h-60 relative flex items-center justify-center group">
                    <svg viewBox="0 0 200 200" class="w-full h-full text-[#1d6cd8] dark:text-[#00f0ff] fill-current drop-shadow-md transition-transform duration-500 group-hover:scale-105">
                        <path d="M 30,100 L 90,40 L 90,160 Z" opacity="0.9" />
                        <path d="M 95,20 L 115,20 L 115,180 L 95,180 Z" />
                        <path d="M 120,40 L 180,100 L 120,160 Z" opacity="0.9" />
                    </svg>
                </div>
                <h2 class="text-3xl font-black tracking-widest text-slate-800 dark:text-slate-100 mt-3 font-tech uppercase">HAAVK</h2>
                <span class="text-xs font-tech text-slate-500 dark:text-slate-400 tracking-widest uppercase mt-0.5">Global Personnel Portal</span>
            </div>

            <!-- Right: Form Inputs -->
            <div class="lg:col-span-6 max-w-md w-full mx-auto space-y-6">

                <div class="flex items-center space-x-3 text-[#1d6cd8] dark:text-[#00f0ff] border-b border-slate-300 dark:border-slate-800 pb-2">
                    <span class="w-2.5 h-2.5 bg-[#1d6cd8] dark:bg-[#00f0ff]"></span>
                    <h3 class="text-sm font-bold tracking-widest uppercase font-tech">GLOBAL NETWORK TERMINAL</h3>
                </div>

                <form @submit.prevent class="space-y-5">
                    <!-- Employee Account Input -->
                    <div class="space-y-1">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400 font-tech">EMPLOYEE ACCOUNT</label>
                        <div class="relative">
                            <input type="text"
                                x-model="loginForm.username"
                                placeholder="ENTER EMPLOYEE ID"
                                class="w-full bg-slate-100 dark:bg-slate-900 border-2 border-[#1d6cd8] dark:border-[#00f0ff] text-slate-800 dark:text-slate-100 px-4 py-2.5 text-sm font-bold tracking-wide focus:outline-none transition-colors font-tech"
                                readonly>
                            <template x-if="loginForm.username.length > 0">
                                <span class="absolute right-3 top-2.5 text-[#10b981] font-bold text-base">✓</span>
                            </template>
                        </div>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 font-tech">Non-Essential Personnel Retention Department</p>
                    </div>

                    <!-- Password Input -->
                    <div class="space-y-1">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400 font-tech">PASSWORD</label>
                        <input type="password"
                            x-model="loginForm.password"
                            placeholder="••••••••••••••••"
                            class="w-full bg-slate-100 dark:bg-slate-900 border-2 border-[#1d6cd8] dark:border-[#00f0ff] text-slate-800 dark:text-slate-100 px-4 py-2.5 text-sm tracking-widest focus:outline-none transition-colors font-tech"
                            readonly>
                    </div>

                    <!-- Action Button & Simulated Auth Log -->
                    <div class="pt-2 space-y-3">
                        <div class="w-full bg-[#1d6cd8] text-white font-bold py-3.5 px-6 text-sm tracking-widest uppercase shadow-md flex items-center justify-center space-x-2 clip-button font-tech select-none"
                            :class="loginForm.isAuthenticating ? 'opacity-50' : ''">
                            <span x-text="loginForm.isAuthenticating ? 'AUTHENTICATING...' : 'ACCESS CAREER'"></span>
                        </div>

                        <!-- Status Log -->
                        <div class="text-[11px] font-tech text-[#1d6cd8] dark:text-[#00f0ff] flex items-center justify-center h-7 bg-slate-100 dark:bg-slate-900 border border-slate-300 dark:border-slate-800 rounded px-2">
                            <span x-show="loginForm.isAuthenticating" class="inline-block w-2 h-2 bg-[#1d6cd8] dark:bg-[#00f0ff] mr-2 animate-ping"></span>
                            <span x-text="loginForm.statusMessage"></span>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>