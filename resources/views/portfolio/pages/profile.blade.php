<!-- PAGE 2: DOSSIER -->
<section x-show="activeTab === 'profile'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 max-w-6xl mx-auto">

        <!-- ID Card -->
        <div class="lg:col-span-4 bg-white/90 dark:bg-[#0e1420]/90 backdrop-blur-md border border-slate-300 dark:border-slate-800 p-6 shadow-md rounded-lg space-y-6">
            <div class="text-center space-y-3">
                @php $photo = config('portfolio.profile.photo'); @endphp
                <div class="w-40 h-40 mx-auto bg-gradient-to-br from-[#1d6cd8] to-[#0f3c7a] dark:from-[#00f0ff] dark:to-[#1d6cd8] p-1 clip-corner-tr shadow-md">
                    @if ($photo && file_exists(public_path($photo)))
                    <img src="{{ asset($photo) }}" alt="Profile photo of Director Frost"
                        class="w-full h-full object-cover object-top">
                    @else
                    <div class="w-full h-full bg-slate-900 flex flex-col items-center justify-center text-white p-3 relative overflow-hidden">
                        <span class="font-tech text-3xl font-bold tracking-widest text-[#60a5fa] dark:text-[#00f0ff]">DF-09</span>
                        <span class="font-tech text-[9px] text-slate-400 uppercase tracking-widest mt-1">DIRECTOR FROST</span>
                        <div class="absolute -bottom-2 -right-2 text-[40px] font-bold text-white/5 font-tech select-none">HAAVK</div>
                    </div>
                    @endif
                </div>

                <div>
                    <h2 class="text-2xl font-black text-slate-800 dark:text-slate-100 tracking-wider uppercase">DIRECTOR FROST</h2>
                    <span class="text-xs font-tech text-[#1d6cd8] dark:text-[#00f0ff] font-bold uppercase tracking-widest">CLEARANCE LEVEL // OMEGA</span>
                </div>
            </div>

            <div class="border-t border-slate-300 dark:border-slate-800 pt-4 space-y-3 font-tech text-xs">
                <div class="flex justify-between border-b border-slate-100 dark:border-slate-800 pb-1.5">
                    <span class="text-slate-500 dark:text-slate-400">DEPARTMENT:</span>
                    <span class="font-bold text-slate-800 dark:text-slate-200">Non-Essential Personnel</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 dark:border-slate-800 pb-1.5">
                    <span class="text-slate-500 dark:text-slate-400">PRIMARY ROLE:</span>
                    <span class="font-bold text-slate-800 dark:text-slate-200">Web & IoT Architect</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 dark:border-slate-800 pb-1.5">
                    <span class="text-slate-500 dark:text-slate-400">BACKGROUND:</span>
                    <span class="font-bold text-slate-800 dark:text-slate-200">Informatics Engineering</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 dark:border-slate-800 pb-1.5">
                    <span class="text-slate-500 dark:text-slate-400">FOREIGN LANG:</span>
                    <span class="font-bold text-[#1d6cd8] dark:text-[#00f0ff]">Japanese (N5 Pursuit)</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500 dark:text-slate-400">STATUS:</span>
                    <span class="font-bold text-[#10b981]">ACTIVE_DUTY</span>
                </div>
            </div>
        </div>

        <!-- Dossier Content -->
        <div class="lg:col-span-8 bg-white/90 dark:bg-[#0e1420]/90 backdrop-blur-md border border-slate-300 dark:border-slate-800 p-6 shadow-md rounded-lg space-y-6">
            <div class="border-b border-slate-300 dark:border-slate-800 pb-3 flex justify-between items-center">
                <div>
                    <span class="text-xs font-tech text-[#1d6cd8] dark:text-[#00f0ff] font-bold uppercase tracking-widest">// DOSSIER FILE: #00924</span>
                    <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 uppercase">PERSONNEL EXECUTIVE OVERVIEW</h3>
                </div>
                <span class="text-xs font-tech bg-slate-100 dark:bg-slate-900 px-2.5 py-1 text-slate-500 dark:text-slate-400 border border-slate-300 dark:border-slate-700">FILE_CONFIDENTIAL</span>
            </div>

            <div class="space-y-5 text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                <div>
                    <h4 class="text-xs font-bold text-[#1d6cd8] dark:text-[#00f0ff] font-tech uppercase tracking-wider mb-1 flex items-center space-x-1">
                        <span>[SECTION 1.0]</span>
                        <span class="text-slate-800 dark:text-slate-200">WEB ARCHITECTURE & BACKEND ENGINEERING</span>
                    </h4>
                    <p>
                        Director Frost specializes in crafting robust, high-performance web systems using modern PHP frameworks such as <strong>Laravel</strong> and <strong>CodeIgniter 4</strong>. Focusing on clean MVC design patterns, dynamic database ORM integration, and responsive frontend UI frameworks.
                    </p>
                </div>

                <div>
                    <h4 class="text-xs font-bold text-[#1d6cd8] dark:text-[#00f0ff] font-tech uppercase tracking-wider mb-1 flex items-center space-x-1">
                        <span>[SECTION 2.0]</span>
                        <span class="text-slate-800 dark:text-slate-200">EMBEDDED HARDWARE & IOT INTELLIGENCE</span>
                    </h4>
                    <p>
                        Bridging software and physical security, Frost develops microcontroller solutions using <strong>ESP32</strong> and <strong>ESP32-CAM</strong> modules. Projects include IoT home surveillance nodes, sensor integration via HTTP/MQTT protocols, and automated camera streaming pipelines.
                    </p>
                </div>
            </div>
        </div>
    </div>
    @include('portfolio.partials.experience')
</section>