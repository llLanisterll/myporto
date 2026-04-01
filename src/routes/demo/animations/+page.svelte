<script>
  import { onMount } from 'svelte';

  onMount(() => {

        // Stagger restart logic
        const trigger = document.getElementById('trigger-stagger');
        const container = document.getElementById('stagger-grid');
        
        trigger.addEventListener('click', () => {
            container.classList.remove('active');
            setTimeout(() => {
                container.classList.add('active');
            }, 50); // slight delay to allow layout recalculation
        });
    
  });
</script>

<svelte:head>
  <title>Web Animations Demo — Sarham San</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>

        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; background: #050505; color: #fff; }
        .glass-panel { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); box-shadow: 0 4px 30px rgba(0,0,0,0.5); backdrop-filter: blur(10px); }
        .bg-grid { background-image: radial-gradient(circle, rgba(255,255,255,0.02) 2px, transparent 2px); background-size: 50px 50px; }
        
        /* Keyframe 1: Float */
        @keyframes custom-float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .anim-float { animation: custom-float 4s ease-in-out infinite; }

        /* Keyframe 2: Morph */
        @keyframes custom-morph {
            0% { border-radius: 20%; transform: rotate(0deg); }
            25% { border-radius: 50% 20% 50% 20%; transform: rotate(45deg); }
            50% { border-radius: 50%; transform: rotate(180deg); }
            75% { border-radius: 20% 50% 20% 50%; transform: rotate(225deg); }
            100% { border-radius: 20%; transform: rotate(360deg); }
        }
        .anim-morph { animation: custom-morph 6s ease-in-out infinite; }

        /* Keyframe 3: Pulse Ring */
        @keyframes custom-ring {
            0% { box-shadow: 0 0 0 0 rgba(234,179,8,0.5); }
            100% { box-shadow: 0 0 0 40px rgba(234,179,8,0); }
        }
        .anim-ring { animation: custom-ring 2s ease-out infinite; }
        
        /* Complex Stagger Container */
        .stagger-container > div {
            transform: scale(0);
            opacity: 0;
            transition: transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.6s ease;
        }
        .stagger-container.active > div { transform: scale(1); opacity: 1; }
        .stagger-container.active > div:nth-child(1) { transition-delay: 0.1s; }
        .stagger-container.active > div:nth-child(2) { transition-delay: 0.2s; }
        .stagger-container.active > div:nth-child(3) { transition-delay: 0.3s; }
        .stagger-container.active > div:nth-child(4) { transition-delay: 0.4s; }

    
  </style>
</svelte:head>

<!-- Floating Back Button -->
    <a href="/#skills" class="fixed top-6 left-6 z-50 inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#050505]/80 border border-white/10 shadow-xl backdrop-blur-md text-white/50 hover:text-white hover:bg-white/10 hover:border-white/20 transition-all font-medium text-[13px] group">
        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>

    <!-- Top bg glows -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-[400px] bg-yellow-600/10 blur-[120px] rounded-full pointer-events-none"></div>

    
    <div class="relative z-10 pt-20 pb-24 px-8 sm:px-12 lg:px-16">
        <div class="max-w-4xl mx-auto text-center mb-16">
            <h1 class="text-4xl sm:text-5xl lg:text-5xl font-extrabold leading-tight mb-6">
                Web <span class="text-yellow-400">Animations</span>
            </h1>
            <p class="text-[15px] text-white/40 leading-relaxed max-w-xl mx-auto">
                Implementasi keyframes modern dan transisi halus berbasis CSS murni. Tidak ada pustaka JavaScript eksternal yang digunakan.
            </p>
        </div>

        <div class="max-w-5xl mx-auto grid md:grid-cols-3 gap-6">
            
            <!-- Morphing Shape -->
            <div class="glass-panel rounded-2xl p-8 flex flex-col items-center justify-between h-80">
                <div class="flex-1 flex items-center justify-center w-full relative">
                    <div class="w-24 h-24 bg-gradient-to-br from-yellow-400 to-orange-500 shadow-[0_0_30px_rgba(234,179,8,0.4)] anim-morph"></div>
                </div>
                <div class="w-full text-center mt-6">
                    <h3 class="text-sm font-bold text-white/90">CSS Morphing</h3>
                    <p class="text-[11px] text-white/40 mt-1">Border-radius & Rotation keyframes</p>
                </div>
            </div>

            <!-- Floating Object -->
            <div class="glass-panel rounded-2xl p-8 flex flex-col items-center justify-between h-80">
                <div class="flex-1 flex items-center justify-center w-full relative">
                    <div class="relative anim-float">
                        <div class="w-20 h-28 bg-white/[0.05] border border-white/20 rounded-xl shadow-2xl backdrop-blur-sm flex flex-col p-3 gap-2">
                            <div class="w-full h-2 bg-yellow-400/50 rounded-sm"></div>
                            <div class="w-3/4 h-1.5 bg-white/20 rounded-sm"></div>
                            <div class="w-full h-1.5 bg-white/20 rounded-sm"></div>
                        </div>
                        <!-- Shadow underneath -->
                        <div class="absolute -bottom-10 left-1/2 -translate-x-1/2 w-16 h-2 bg-black/40 blur-[4px] rounded-full" style="animation: shadow-scale 4s ease-in-out infinite;"></div>
                    </div>
                </div>
                <div class="w-full text-center mt-6">
                    <h3 class="text-sm font-bold text-white/90">Smooth Levitation</h3>
                    <p class="text-[11px] text-white/40 mt-1">TranslateY Infinite Easing</p>
                </div>
            </div>

            <!-- Interactive Pulse Element -->
            <div class="glass-panel rounded-2xl p-8 flex flex-col items-center justify-between h-80">
                <div class="flex-1 flex items-center justify-center w-full">
                    <!-- Hover to trigger pulse -->
                    <button class="w-20 h-20 rounded-full bg-white/[0.03] border border-yellow-500/50 text-yellow-500 flex items-center justify-center anim-ring hover:bg-yellow-500 hover:text-black transition-colors cursor-pointer outline-none">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </button>
                </div>
                <div class="w-full text-center mt-6">
                    <h3 class="text-sm font-bold text-white/90">Attention Seeker</h3>
                    <p class="text-[11px] text-white/40 mt-1">Box-shadow expansion</p>
                </div>
            </div>

            <!-- Stagger Reveal -->
            <div class="glass-panel rounded-2xl p-8 md:col-span-3">
                <div class="flex items-center justify-between mb-8 cursor-pointer group" id="trigger-stagger">
                    <div>
                        <h3 class="text-lg font-bold text-white/90">Staggered Reveal</h3>
                        <p class="text-[12px] text-white/40 mt-1">Klik dimanapun di area ini untuk reset animasi</p>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-white/[0.05] border border-white/10 flex items-center justify-center group-hover:bg-yellow-500/20 group-hover:border-yellow-500/40 transition-colors">
                        <svg class="w-4 h-4 text-white/50 group-hover:text-yellow-400 group-hover:rotate-180 transition-all duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 stagger-container active" id="stagger-grid">
                    <div class="h-24 rounded-xl bg-gradient-to-br from-white/[0.05] to-white/[0.01] border border-white/10 flex items-center justify-center text-2xl">⚡</div>
                    <div class="h-24 rounded-xl bg-gradient-to-br from-white/[0.05] to-white/[0.01] border border-white/10 flex items-center justify-center text-2xl">🔥</div>
                    <div class="h-24 rounded-xl bg-gradient-to-br from-white/[0.05] to-white/[0.01] border border-white/10 flex items-center justify-center text-2xl">✨</div>
                    <div class="h-24 rounded-xl bg-gradient-to-br from-white/[0.05] to-white/[0.01] border border-white/10 flex items-center justify-center text-2xl">🚀</div>
                </div>
            </div>

        </div>
    </div>

    <style>
        @keyframes shadow-scale {
            0%, 100% { transform: translateX(-50%) scaleX(1); opacity: 0.6; }
            50% { transform: translateX(-50%) scaleX(0.7); opacity: 0.2; }
        }
    </style>
