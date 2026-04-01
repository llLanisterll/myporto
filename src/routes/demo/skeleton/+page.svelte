<script>
  import { onMount } from 'svelte';

  onMount(() => {

        const container = document.getElementById('card-container');
        const btn = document.getElementById('reload-btn');

        const mockData = [
            { id: 1, title: 'Menulis Kode Clean', thumb: 'bg-gradient-to-br from-indigo-500/20 to-purple-500/20', avatar: '😎', name: 'Sarham San', role: 'Fullstack Dev' },
            { id: 2, title: 'Optimasi Web Perf', thumb: 'bg-gradient-to-br from-emerald-500/20 to-teal-500/20', avatar: '🚀', name: 'UI Engineer', role: 'Frontend' }
        ];

        const generateSkeleton = () => {
            return `
                <div class="glass-panel p-5 rounded-2xl flex flex-col gap-4">
                    <div class="skeleton w-full h-32 rounded-xl"></div>
                    <div class="flex gap-3 items-center">
                        <div class="skeleton w-10 h-10 rounded-full shrink-0"></div>
                        <div class="flex-1 space-y-2">
                            <div class="skeleton h-4 w-3/4 rounded-sm"></div>
                            <div class="skeleton h-3 w-1/2 rounded-sm"></div>
                        </div>
                    </div>
                </div>
            `;
        }

        const generateContent = (data) => {
            return `
                <div class="glass-panel p-5 rounded-2xl flex flex-col gap-4 fade-in cursor-pointer hover:-translate-y-1 transition-transform duration-300 hover:border-white/20">
                    <div class="w-full h-32 rounded-xl ${data.thumb} border border-white/10 flex items-center justify-center text-4xl shadow-inner"></div>
                    <div class="flex gap-3 items-center">
                        <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center border border-white/20">${data.avatar}</div>
                        <div>
                            <h3 class="font-bold text-sm text-white/90">${data.title}</h3>
                            <p class="text-[11px] text-white/40 mt-0.5">${data.name} • ${data.role}</p>
                        </div>
                    </div>
                </div>
            `;
        }

        const loadContent = () => {
            // State 1: Skeleton
            container.innerHTML = generateSkeleton() + generateSkeleton();
            btn.disabled = true;
            btn.classList.add('opacity-50');

            // State 2: Content loaded after 2 seconds
            setTimeout(() => {
                container.innerHTML = mockData.map(d => generateContent(d)).join('');
                btn.disabled = false;
                btn.classList.remove('opacity-50');
            }, 2000);
        }

        btn.addEventListener('click', loadContent);
        // Initial load
        loadContent();
    
  });
</script>

<svelte:head>
  <title>Skeleton Loading Demo — Sarham San</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>

        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; background: #050505; color: #fff; }
        .glass-panel { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); box-shadow: 0 4px 30px rgba(0,0,0,0.5); backdrop-filter: blur(10px); text-align: left; }
        .bg-grid { background-image: radial-gradient(circle, rgba(255,255,255,0.03) 1px, transparent 1px); background-size: 32px 32px; }
        
        .skeleton { position: relative; overflow: hidden; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); }
        .skeleton::after {
            content: ""; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.08), transparent);
            transform: translateX(-100%);
            animation: shimmer 1.5s infinite linear;
        }
        @keyframes shimmer { 100% { transform: translateX(100%); } }

        .fade-in { animation: fadeIn 0.8s ease forwards; opacity: 0; }
        @keyframes fadeIn { to { opacity: 1; } }
    
  </style>
</svelte:head>

<!-- Floating Back Button -->
    <a href="../../#skills" class="fixed top-6 left-6 z-50 inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#050505]/80 border border-white/10 shadow-xl backdrop-blur-md text-white/50 hover:text-white hover:bg-white/10 hover:border-white/20 transition-all font-medium text-[13px] group">
        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>

    <!-- Top bg glows -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-[400px] bg-slate-600/10 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="relative z-10 w-full max-w-3xl mx-auto">
        <div class="flex items-end justify-between mb-8">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight mb-2">
                    Skeleton <span class="text-slate-400">Loading</span>
                </h1>
                <p class="text-[13px] text-white/40 leading-relaxed max-w-sm">Placeholder shimmer UI sebelum konten aktual dimuat untuk mencegah layout shift.</p>
            </div>
            <button id="reload-btn" class="px-4 py-2 text-sm font-semibold border border-white/20 rounded-lg hover:bg-white/10 transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                Reload
            </button>
        </div>

        <div class="grid sm:grid-cols-2 gap-6" id="card-container">
            <!-- Dynamic Injection -->
        </div>

    </div>
