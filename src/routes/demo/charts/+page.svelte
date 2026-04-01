<svelte:head>
  <title>Data Visualization Demo — Sarham San</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>

        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; background: #050505; color: #fff; }
        .glass-panel { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); box-shadow: 0 4px 30px rgba(0,0,0,0.5); backdrop-filter: blur(10px); }
        .bg-grid { background-image: radial-gradient(circle, rgba(255,255,255,0.05) 1px, transparent 1px); background-size: 32px 32px; }
        
        /* Bar chart animations */
        .bar { transform-origin: bottom; animation: grow 1.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; transform: scaleY(0); }
        @keyframes grow { to { transform: scaleY(1); } }
    
  </style>
</svelte:head>

<!-- Floating Back Button -->
    <a href="../../#skills" class="fixed top-6 left-6 z-50 inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#050505]/80 border border-white/10 shadow-xl backdrop-blur-md text-white/50 hover:text-white hover:bg-white/10 hover:border-white/20 transition-all font-medium text-[13px] group">
        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>

    <!-- Top bg glows -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-[400px] bg-blue-600/10 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="relative z-10 w-full max-w-4xl text-center mb-16">
        <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight mb-4">
            Data <span class="text-blue-500">Visualization</span>
        </h1>
        <p class="text-white/40">Grafik interaktif menggunakan CSS murni. Hover bar untuk detail data.</p>
    </div>

    <!-- Chart Panel -->
    <div class="glass-panel w-full max-w-3xl rounded-3xl p-8 relative z-10">
        <div class="flex items-end justify-between h-64 gap-3 sm:gap-6 border-b border-white/[0.05] pb-4 px-4 sm:px-8">
            <div class="relative w-full h-[60%] bar" style="animation-delay: 0.1s;">
                <div class="absolute inset-0 bg-white/5 hover:bg-white/10 border-t border-white/20 rounded-t-lg transition-colors group cursor-pointer">
                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity bg-white/10 px-3 py-1 rounded text-xs">Jun</div>
                </div>
            </div>
            <div class="relative w-full h-[80%] bar" style="animation-delay: 0.2s;">
                <div class="absolute inset-x-0 bottom-0 top-[20%] bg-blue-500/20 hover:bg-blue-500/30 border-t border-blue-500/40 rounded-t-lg transition-colors group cursor-pointer shadow-[0_0_15px_rgba(59,130,246,0.2)]">
                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity bg-blue-500/20 text-blue-300 font-bold px-3 py-1 rounded text-xs border border-blue-500/30">Jul</div>
                </div>
                <!-- Stacked -->
                <div class="absolute inset-x-0 bottom-[80%] top-0 bg-white/10 border-t border-white/20 rounded-t-lg border-b border-black/50"></div>
            </div>
            <div class="relative w-full h-[45%] bar" style="animation-delay: 0.3s;">
                <div class="absolute inset-0 bg-white/5 hover:bg-white/10 border-t border-white/20 rounded-t-lg transition-colors group cursor-pointer">
                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity bg-white/10 px-3 py-1 rounded text-xs">Aug</div>
                </div>
            </div>
            <div class="relative w-full h-[95%] bar" style="animation-delay: 0.4s;">
                <div class="absolute inset-x-0 bottom-0 top-[40%] bg-blue-500/80 hover:bg-blue-400 border-t border-blue-300 rounded-t-lg transition-colors group cursor-pointer shadow-[0_0_20px_rgba(59,130,246,0.6)]">
                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity bg-blue-500 px-3 py-1 rounded text-xs font-bold text-white shadow-lg">Sep</div>
                </div>
                <!-- Stacked -->
                <div class="absolute inset-x-0 bottom-[60%] top-0 bg-white/20 border-t border-white/40 rounded-t-lg border-b border-black/50"></div>
            </div>
            <div class="relative w-full h-[65%] bar" style="animation-delay: 0.5s;">
                <div class="absolute inset-0 bg-white/5 hover:bg-white/10 border-t border-white/20 rounded-t-lg transition-colors group cursor-pointer">
                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity bg-white/10 px-3 py-1 rounded text-xs">Oct</div>
                </div>
            </div>
        </div>
        <div class="mt-6 flex justify-between px-4 sm:px-8 text-[11px] text-white/30 uppercase tracking-widest font-semibold">
            <span>Server 1</span>
            <span>Server 2</span>
            <span>Server 3</span>
            <span class="text-blue-400 font-bold">Main DB</span>
            <span>Cache</span>
        </div>
    </div>
