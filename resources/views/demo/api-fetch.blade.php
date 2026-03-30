<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Realtime Fetch Demo — Sarham San</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; background: #050505; color: #fff; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .glass-panel { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); box-shadow: 0 4px 30px rgba(0,0,0,0.5); backdrop-filter: blur(10px); }
        .pulse-dot { animation: pulse 2s infinite; }
        @keyframes pulse { 0% { box-shadow: 0 0 0 0 rgba(6,182,212,0.4); } 70% { box-shadow: 0 0 0 10px rgba(6,182,212,0); } 100% { box-shadow: 0 0 0 0 rgba(6,182,212,0); } }
        /* Dot grid bg */
        .bg-grid { background-image: radial-gradient(circle, rgba(255,255,255,0.05) 1px, transparent 1px); background-size: 32px 32px; }
        
        .shimmer {
            background: linear-gradient(90deg, rgba(255,255,255,0.02) 25%, rgba(255,255,255,0.08) 50%, rgba(255,255,255,0.02) 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite linear;
        }
        @keyframes shimmer { to { background-position: -200% 0; } }
    </style>
</head>
<body class="antialiased min-h-screen bg-grid relative overflow-x-hidden flex flex-col items-center justify-center p-8 sm:p-12 lg:p-16">
    <!-- Floating Back Button -->
    <a href="/#skills" class="fixed top-6 left-6 z-50 inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#050505]/80 border border-white/10 shadow-xl backdrop-blur-md text-white/50 hover:text-white hover:bg-white/10 hover:border-white/20 transition-all font-medium text-[13px] group">
        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>

    <!-- Top bg glows -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-[400px] bg-cyan-600/10 blur-[120px] rounded-full pointer-events-none"></div>

    {{-- Content --}}
    <div class="relative z-10 pt-20 pb-24 px-8 sm:px-12 lg:px-16">
        <div class="max-w-4xl mx-auto text-center mb-16">
            <h1 class="text-4xl sm:text-5xl lg:text-5xl font-extrabold leading-tight mb-6">
                API Fetching & <span class="text-cyan-400">Async State</span>
            </h1>
            <p class="text-[15px] text-white/40 leading-relaxed max-w-xl mx-auto">
                Demonstrasi pengambilan data tiruan dari endpoint API dengan manipulasi DOM asynchronous, penanganan loading state (shimmer UI), dan interpolasi data secara real-time.
            </p>
        </div>

        <div class="max-w-5xl mx-auto grid lg:grid-cols-2 gap-8">
            <!-- UI Panel -->
            <div class="glass-panel rounded-2xl p-6 sm:p-8 flex flex-col h-[500px]">
                <div class="flex items-center justify-between mb-6 pb-6 border-b border-white/[0.05]">
                    <div>
                        <h2 class="text-lg font-bold text-white/90">User Directory</h2>
                        <p class="text-xs text-white/30 mt-1">Fetching data dari jsonplaceholder</p>
                    </div>
                    <button id="fetch-btn" class="px-5 py-2.5 rounded-xl bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 text-sm font-semibold hover:bg-cyan-500 hover:text-black transition-all shadow-[0_0_20px_rgba(6,182,212,0.15)] flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Fetch Users
                    </button>
                </div>
                
                <div id="data-container" class="flex-1 overflow-y-auto pr-2 space-y-3 scrollbar-thin scrollbar-thumb-white/10 scrollbar-track-transparent">
                    <div class="h-full flex flex-col items-center justify-center text-center opacity-50">
                        <svg class="w-12 h-12 text-white/20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        <p class="text-sm text-white/40">Klik tombol Fetch Users untuk memuat data</p>
                    </div>
                </div>
            </div>

            <!-- Terminal / Code Panel -->
            <div class="glass-panel rounded-2xl flex flex-col overflow-hidden h-[500px]">
                <div class="h-12 bg-black/40 border-b border-white/[0.05] flex items-center px-4 gap-2">
                    <div class="w-3 h-3 rounded-full bg-red-500/50"></div>
                    <div class="w-3 h-3 rounded-full bg-yellow-500/50"></div>
                    <div class="w-3 h-3 rounded-full bg-green-500/50"></div>
                    <span class="ml-4 text-[11px] text-white/30 font-mono">console.log & network</span>
                </div>
                <div id="log-container" class="flex-1 p-5 overflow-y-auto font-mono text-[11px] sm:text-xs text-white/50 space-y-2 leading-relaxed">
                    <div class="text-cyan-500/70">> Ready. Waiting for fetch command...</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const fetchBtn = document.getElementById('fetch-btn');
        const container = document.getElementById('data-container');
        const logger = document.getElementById('log-container');

        const log = (msg, type = 'info') => {
            const colors = { info: 'text-white/50', success: 'text-emerald-400', warning: 'text-yellow-400', error: 'text-red-400' };
            const time = new Date().toISOString().split('T')[1].slice(0, 8);
            logger.innerHTML += `<div class="${colors[type]}"><span class="text-white/20">[${time}]</span> > ${msg}</div>`;
            logger.scrollTop = logger.scrollHeight;
        };

        const renderShimmer = () => {
            container.innerHTML = Array(4).fill(0).map(() => `
                <div class="p-4 rounded-xl border border-white/[0.04] bg-white/[0.01] flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full shimmer"></div>
                    <div class="flex-1 space-y-2">
                        <div class="w-1/3 h-4 rounded shimmer"></div>
                        <div class="w-1/2 h-3 rounded shimmer"></div>
                    </div>
                </div>
            `).join('');
        };

        const renderUsers = (users) => {
            container.innerHTML = users.slice(0, 6).map(u => `
                <div class="p-4 rounded-xl border border-white/[0.04] bg-white/[0.01] hover:bg-white/[0.03] hover:border-white/10 transition-colors flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-500/20 to-blue-500/20 border border-cyan-500/30 flex items-center justify-center text-cyan-300 font-bold text-sm">
                        ${u.name.charAt(0)}
                    </div>
                    <div class="flex-1">
                        <h3 class="text-sm font-semibold text-white/80">${u.name}</h3>
                        <p class="text-xs text-white/40 mt-0.5">@${u.username} • ${u.email}</p>
                    </div>
                </div>
            `).join('');
        };

        fetchBtn.addEventListener('click', async () => {
            log('Initiating GET request to https://jsonplaceholder.typicode.com/users', 'warning');
            fetchBtn.disabled = true;
            fetchBtn.innerHTML = `<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Fetching...`;
            renderShimmer();

            try {
                // Simulate network delay for dramatic effect
                await new Promise(r => setTimeout(r, 1500)); 
                log('Response received. Status: 200 OK', 'success');
                
                const response = await fetch('https://jsonplaceholder.typicode.com/users');
                const data = await response.json();
                
                log(`Parsing JSON... successfully parsed ${data.length} records.`, 'info');
                renderUsers(data);
                log('DOM updated successfully.', 'success');

            } catch (err) {
                log(`Fetch failed: ${err.message}`, 'error');
                container.innerHTML = `<div class="p-4 text-red-400 text-sm text-center bg-red-500/10 rounded-xl border border-red-500/20">Error fetching data</div>`;
            } finally {
                fetchBtn.disabled = false;
                fetchBtn.innerHTML = `<svg class="w-4 h-4" fill="none" class="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Fetch Again`;
            }
        });
    </script>
</body>
</html>
