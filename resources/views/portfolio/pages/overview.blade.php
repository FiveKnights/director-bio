<!-- PAGE 1: OVERVIEW -->
<section x-show="activeTab === 'overview'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0">
    <div class="space-y-6 max-w-6xl mx-auto">

        <!-- Welcome Banner -->
        <div class="bg-white/90 dark:bg-[#0e1420]/90 backdrop-blur-md border-2 border-[#1d6cd8] dark:border-[#00f0ff] p-6 md:p-8 shadow-md rounded-lg relative overflow-hidden clip-corner-tr transition-colors">
            <div class="absolute -right-10 -bottom-10 text-[140px] font-black text-[#1d6cd8]/5 dark:text-[#00f0ff]/5 select-none font-tech pointer-events-none">HAAVK</div>
            <div class="relative z-10 space-y-3">
                <div class="inline-flex items-center space-x-2 bg-[#1d6cd8]/10 dark:bg-[#00f0ff]/10 text-[#1d6cd8] dark:text-[#00f0ff] border border-[#1d6cd8]/30 dark:border-[#00f0ff]/30 px-3 py-1 font-tech text-xs font-bold">
                    <span class="w-2 h-2 bg-[#10b981] rounded-full animate-pulse"></span>
                    <span>AUTHENTICATED OPERATOR // WELCOME BACK</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-black text-slate-800 dark:text-slate-100 uppercase tracking-wide">
                    DIRECTOR FROST
                </h2>
                <p class="text-sm md:text-base text-slate-600 dark:text-slate-300 max-w-3xl leading-relaxed font-medium">
                    Principal Architect specializing in full-stack web backend systems, embedded hardware integration, and high-reliability IoT infrastructure. Designing scalable frameworks with PHP, Laravel, CodeIgniter 4, and microcontroller sensor nodes.
                </p>
                @if (file_exists(public_path(config('portfolio.resume.file'))))
                <a href="{{ asset(config('portfolio.resume.file')) }}"
                    download="{{ config('portfolio.resume.download_name') }}"
                    class="inline-flex items-center gap-2 mt-1 px-5 py-2.5 bg-[#1d6cd8] dark:bg-[#00f0ff] text-white dark:text-slate-950 font-tech font-bold text-xs tracking-widest uppercase clip-button hover:opacity-90 transition-opacity">
                    <i class="fa-solid fa-download"></i> DOWNLOAD DOSSIER (PDF)
                </a>
                @endif
            </div>
        </div>

        <!-- System Status Widgets -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 font-tech">
            <div class="bg-white/80 dark:bg-[#0e1420]/80 border border-slate-300 dark:border-slate-800 p-4 shadow-sm rounded-lg space-y-1">
                <span class="text-[10px] text-slate-500 dark:text-slate-400 uppercase tracking-widest">SYSTEM INTEGRITY</span>
                <div class="text-2xl font-bold text-[#10b981] flex items-center justify-between">
                    <span>99.8%</span>
                    <span class="text-xs bg-[#10b981]/10 px-2 py-0.5 border border-[#10b981]/30">OPTIMAL</span>
                </div>
                <div class="w-full bg-slate-100 dark:bg-slate-900 h-1.5 mt-2 rounded overflow-hidden">
                    <div class="bg-[#10b981] h-full w-[99.8%]"></div>
                </div>
            </div>

            <div class="bg-white/80 dark:bg-[#0e1420]/80 border border-slate-300 dark:border-slate-800 p-4 shadow-sm rounded-lg space-y-1">
                <span class="text-[10px] text-slate-500 dark:text-slate-400 uppercase tracking-widest">CORE LATENCY</span>
                <div class="text-2xl font-bold text-[#1d6cd8] dark:text-[#00f0ff] flex items-center justify-between">
                    <span>64ms</span>
                    <span class="text-xs bg-[#1d6cd8]/10 dark:bg-[#00f0ff]/10 px-2 py-0.5 border border-[#1d6cd8]/30 dark:border-[#00f0ff]/30">STABLE</span>
                </div>
                <div class="w-full bg-slate-100 dark:bg-slate-900 h-1.5 mt-2 rounded overflow-hidden">
                    <div class="bg-[#1d6cd8] dark:bg-[#00f0ff] h-full w-[85%]"></div>
                </div>
            </div>

            <div class="bg-white/80 dark:bg-[#0e1420]/80 border border-slate-300 dark:border-slate-800 p-4 shadow-sm rounded-lg space-y-1">
                <span class="text-[10px] text-slate-500 dark:text-slate-400 uppercase tracking-widest">ACTIVE NODES</span>
                <div class="text-2xl font-bold text-slate-800 dark:text-slate-200 flex items-center justify-between">
                    <span>Neural Link</span>
                    <span class="text-xs bg-slate-200 dark:bg-slate-800 px-2 py-0.5 border border-slate-300 dark:border-slate-700">ONLINE</span>
                </div>
                <div class="w-full bg-slate-100 dark:bg-slate-900 h-1.5 mt-2 rounded overflow-hidden">
                    <div class="bg-slate-700 dark:bg-slate-300 h-full w-[100%]"></div>
                </div>
            </div>
        </div>

        <!-- Directives -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white/80 dark:bg-[#0e1420]/80 border border-slate-300 dark:border-slate-800 p-5 shadow-sm rounded-lg space-y-3">
                <h3 class="text-xs font-bold text-[#1d6cd8] dark:text-[#00f0ff] font-tech uppercase tracking-widest flex items-center space-x-2">
                    <span>// CORE ARCHITECTURAL DIRECTIVE</span>
                </h3>
                <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                    Deploying robust Web architecture backed by secure REST APIs, clean database schema design, and micro-controller hardware streaming pipelines. Combining structured PHP controllers with lightweight reactive frontends.
                </p>
            </div>

            <div class="bg-white/80 dark:bg-[#0e1420]/80 border border-slate-300 dark:border-slate-800 p-5 shadow-sm rounded-lg space-y-3">
                <h3 class="text-xs font-bold text-[#1d6cd8] dark:text-[#00f0ff] font-tech uppercase tracking-widest flex items-center space-x-2">
                    <span>// EMBEDDED HARDWARE VISION</span>
                </h3>
                <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                    Interfacing physical microcontrollers (ESP32 / ESP32-CAM) directly with cloud/local server instances for low-latency telemetry monitoring, automated security triggers, and remote hardware management.
                </p>
            </div>
        </div>

    </div>
</section>