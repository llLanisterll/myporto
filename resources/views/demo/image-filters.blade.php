<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Filters Demo — Sarham San</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; background: #050505; color: #fff; }
        .glass-panel { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); box-shadow: 0 4px 30px rgba(0,0,0,0.5); backdrop-filter: blur(10px); }
        .bg-grid { background-image: radial-gradient(circle, rgba(255,255,255,0.03) 1px, transparent 1px); background-size: 32px 32px; }
        
        #art-image { transition: filter 0.5s ease; width: 100%; height: 100%; object-fit: cover; }
    </style>
</head>
<body class="antialiased min-h-screen bg-grid relative overflow-x-hidden p-8 sm:p-12 lg:p-16 flex flex-col items-center justify-center">
    <!-- Floating Back Button -->
    <a href="/#skills" class="fixed top-6 left-6 z-50 inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#050505]/80 border border-white/10 shadow-xl backdrop-blur-md text-white/50 hover:text-white hover:bg-white/10 hover:border-white/20 transition-all font-medium text-[13px] group">
        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>

    <!-- Top bg glows -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-[400px] bg-purple-600/10 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="relative z-10 w-full max-w-5xl">
        <div class="text-center mb-12">
            <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight mb-4">
                Image <span class="text-purple-500">Filters</span>
            </h1>
            <p class="text-white/40 text-sm">Coba berbagai filter CSS secara real-time pada gambar statis.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 items-center cursor-default">
            
            <!-- Filter Controls -->
            <div class="glass-panel rounded-3xl p-8 space-y-6">
                <div>
                    <div class="flex justify-between mb-2">
                        <label class="text-[13px] font-semibold text-white/80">Grayscale</label>
                        <span id="val-gray" class="text-xs text-purple-400">0%</span>
                    </div>
                    <input type="range" id="grayscale" min="0" max="100" value="0" class="w-full accent-purple-500 h-1 bg-white/10 rounded-lg appearance-none cursor-pointer">
                </div>
                
                <div>
                    <div class="flex justify-between mb-2">
                        <label class="text-[13px] font-semibold text-white/80">Sepia</label>
                        <span id="val-sepia" class="text-xs text-purple-400">0%</span>
                    </div>
                    <input type="range" id="sepia" min="0" max="100" value="0" class="w-full accent-purple-500 h-1 bg-white/10 rounded-lg appearance-none cursor-pointer">
                </div>

                <div>
                    <div class="flex justify-between mb-2">
                        <label class="text-[13px] font-semibold text-white/80">Blur</label>
                        <span id="val-blur" class="text-xs text-purple-400">0px</span>
                    </div>
                    <input type="range" id="blur" min="0" max="20" value="0" class="w-full accent-purple-500 h-1 bg-white/10 rounded-lg appearance-none cursor-pointer">
                </div>

                <div>
                    <div class="flex justify-between mb-2">
                        <label class="text-[13px] font-semibold text-white/80">Brightness</label>
                        <span id="val-bright" class="text-xs text-purple-400">100%</span>
                    </div>
                    <input type="range" id="brightness" min="0" max="200" value="100" class="w-full accent-purple-500 h-1 bg-white/10 rounded-lg appearance-none cursor-pointer">
                </div>

                <div>
                    <div class="flex justify-between mb-2">
                        <label class="text-[13px] font-semibold text-white/80">Contrast</label>
                        <span id="val-contrast" class="text-xs text-purple-400">100%</span>
                    </div>
                    <input type="range" id="contrast" min="0" max="200" value="100" class="w-full accent-purple-500 h-1 bg-white/10 rounded-lg appearance-none cursor-pointer">
                </div>

                <div>
                    <div class="flex justify-between mb-2">
                        <label class="text-[13px] font-semibold text-white/80">Hue Rotate</label>
                        <span id="val-hue" class="text-xs text-purple-400">0deg</span>
                    </div>
                    <input type="range" id="hue" min="0" max="360" value="0" class="w-full accent-purple-500 h-1 bg-white/10 rounded-lg appearance-none cursor-pointer">
                </div>

                <div class="pt-4 border-t border-white/[0.05]">
                    <button id="reset-btn" class="w-full py-3 rounded-xl bg-purple-500/10 border border-purple-500/30 text-purple-400 text-sm font-semibold hover:bg-purple-500 hover:text-white transition-all">Reset All Filters</button>
                </div>
            </div>

            <!-- Image Target -->
            <div class="relative rounded-3xl overflow-hidden shadow-[0_0_50px_rgba(168,85,247,0.15)] aspect-[4/5] md:aspect-auto md:h-full group border border-white/10">
                <!-- Using an abstract placeholder gradient instead of external url to guarantee it works seamlessly -->
                <div id="art-image" class="w-full h-full bg-gradient-to-tr from-purple-800 via-pink-700 to-amber-500" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,0.1) 10px, rgba(255,255,255,0.1) 20px);">
                    <div class="w-full h-full backdrop-blur-3xl flex items-center justify-center">
                        <div class="w-32 h-32 rounded-full border-[10px] border-white/80 bg-black/20 mix-blend-overlay shadow-2xl"></div>
                        <div class="absolute w-40 h-40 bg-white/20 mix-blend-overlay rotate-45"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        const qs = id => document.getElementById(id);
        const inputs = ['grayscale', 'sepia', 'blur', 'brightness', 'contrast', 'hue'];
        const image = qs('art-image');

        const updateFilters = () => {
            let filterStr = `
                grayscale(${qs('grayscale').value}%)
                sepia(${qs('sepia').value}%)
                blur(${qs('blur').value}px)
                brightness(${qs('brightness').value}%)
                contrast(${qs('contrast').value}%)
                hue-rotate(${qs('hue').value}deg)
            `;
            image.style.filter = filterStr;

            qs('val-gray').textContent = qs('grayscale').value + '%';
            qs('val-sepia').textContent = qs('sepia').value + '%';
            qs('val-blur').textContent = qs('blur').value + 'px';
            qs('val-bright').textContent = qs('brightness').value + '%';
            qs('val-contrast').textContent = qs('contrast').value + '%';
            qs('val-hue').textContent = qs('hue').value + 'deg';
        }

        inputs.forEach(id => {
            qs(id).addEventListener('input', updateFilters);
        });

        qs('reset-btn').addEventListener('click', () => {
            qs('grayscale').value = 0;
            qs('sepia').value = 0;
            qs('blur').value = 0;
            qs('brightness').value = 100;
            qs('contrast').value = 100;
            qs('hue').value = 0;
            updateFilters();
        });
    </script>
</body>
</html>
