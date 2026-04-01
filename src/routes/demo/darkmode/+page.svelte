<script>
  import { onMount } from 'svelte';

  onMount(() => {

        const toggle = document.getElementById('theme-toggle');
        const modeLabel = document.getElementById('mode-label');
        const toggleIcon = document.getElementById('toggle-icon');

        toggle.addEventListener('click', () => {
            document.body.classList.toggle('light');
            const isLight = document.body.classList.contains('light');
            modeLabel.textContent = isLight ? 'Light Mode' : 'Dark Mode';
            toggleIcon.textContent = isLight ? '☀️' : '🌙';
        });
    
  });
</script>

<svelte:head>
  <title>Dark/Light Mode Demo — Sarham San</title>
  <meta name="description" content="Demo interaktif Dark/Light Mode — Sarham San Portfolio" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <style>

        body { font-family: 'Inter', system-ui, sans-serif; }
        .font-heading { font-family: 'Syne', system-ui, sans-serif; }

        /* Theme transition */
        * { transition: background-color 0.4s ease, color 0.4s ease, border-color 0.4s ease, box-shadow 0.4s ease; }

        /* Dark theme (default) */
        :root {
            --bg-primary: #050505;
            --bg-card: #0f0f0f;
            --bg-input: #1a1a1a;
            --border: rgba(255,255,255,0.08);
            --text-primary: #ffffff;
            --text-secondary: rgba(255,255,255,0.5);
            --text-muted: rgba(255,255,255,0.25);
            --accent: #ffffff;
            --accent-bg: rgba(255,255,255,0.08);
            --shadow: 0 4px 24px rgba(0,0,0,0.5);
        }

        /* Light theme */
        .light {
            --bg-primary: #fafafa;
            --bg-card: #ffffff;
            --bg-input: #f3f4f6;
            --border: rgba(0,0,0,0.08);
            --text-primary: #111111;
            --text-secondary: rgba(0,0,0,0.5);
            --text-muted: rgba(0,0,0,0.25);
            --accent: #111111;
            --accent-bg: rgba(0,0,0,0.05);
            --shadow: 0 4px 24px rgba(0,0,0,0.08);
        }

        body { background: var(--bg-primary); color: var(--text-primary); }

        .demo-card { background: var(--bg-card); border: 1px solid var(--border); box-shadow: var(--shadow); }
        .demo-input { background: var(--bg-input); border: 1px solid var(--border); color: var(--text-primary); }
        .demo-text-secondary { color: var(--text-secondary); }
        .demo-text-muted { color: var(--text-muted); }
        .demo-border { border-color: var(--border); }
        .demo-accent-bg { background: var(--accent-bg); }
        .demo-btn-primary { background: var(--accent); color: var(--bg-primary); }
        .demo-btn-outline { border: 1px solid var(--border); color: var(--text-primary); background: transparent; }

        /* Toggle switch */
        .toggle-track {
            width: 64px;
            height: 32px;
            border-radius: 999px;
            background: var(--bg-input);
            border: 1px solid var(--border);
            position: relative;
            cursor: pointer;
        }
        .toggle-thumb {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--accent);
            position: absolute;
            top: 3px;
            left: 3px;
            transition: left 0.3s cubic-bezier(0.22, 1, 0.36, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }
        .light .toggle-thumb { left: 35px; }

        /* Grid bg for dark */
        .grid-bg-demo {
            background-image:
                linear-gradient(var(--border) 1px, transparent 1px),
                linear-gradient(90deg, var(--border) 1px, transparent 1px);
            background-size: 60px 60px;
        }
    
  </style>
</svelte:head>

<!-- Floating Back Button -->
    <a href="../../#skills" class="fixed top-6 left-6 z-50 inline-flex items-center gap-2 px-5 py-2.5 rounded-full shadow-lg backdrop-blur-md transition-all font-medium text-[13px] group" style="background: var(--bg-secondary); border: 1px solid var(--border); color: var(--text-muted);">
        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>

    
    <div class="fixed top-0 left-0 right-0 z-40 px-8 sm:px-12 lg:px-16" style="background: var(--bg-primary); border-bottom: 1px solid var(--border);">
        <div class="flex items-center justify-end h-16">

            <div class="flex items-center gap-4">
                <span class="text-xs demo-text-muted uppercase tracking-widest" id="mode-label">Dark Mode</span>
                <div class="toggle-track" id="theme-toggle">
                    <div class="toggle-thumb" id="toggle-thumb">
                        <span id="toggle-icon">🌙</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="pt-28 pb-20 px-8 sm:px-12 lg:px-16">
        <div class="max-w-5xl mx-auto">
            
            <div class="mb-16 text-center">
                <span class="inline-block px-4 py-1.5 rounded-full text-xs demo-text-muted demo-accent-bg demo-border border mb-6 uppercase tracking-widest">Interactive Demo</span>
                <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight">
                    Dark / Light Mode
                </h1>
                <p class="mt-4 demo-text-secondary text-base max-w-lg mx-auto">
                    Coba toggle tombol di atas untuk melihat semua komponen berubah tema secara real-time.
                </p>
            </div>

            
            <div class="grid md:grid-cols-2 gap-6">

                
                <div class="demo-card rounded-2xl p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl demo-accent-bg flex items-center justify-center">
                            <span class="text-lg">📋</span>
                        </div>
                        <div>
                            <h3 class="font-heading font-bold text-base">Card Component</h3>
                            <p class="text-xs demo-text-muted">Komponen dasar UI</p>
                        </div>
                    </div>
                    <p class="text-sm demo-text-secondary leading-relaxed">
                        Card adalah kontainer visual yang mengelompokkan informasi terkait.
                        Lihat bagaimana shadow, border, dan background berubah sesuai tema.
                    </p>
                    <div class="mt-4 flex gap-2">
                        <span class="px-3 py-1 text-[11px] rounded-full demo-accent-bg demo-text-secondary">UI</span>
                        <span class="px-3 py-1 text-[11px] rounded-full demo-accent-bg demo-text-secondary">Component</span>
                    </div>
                </div>

                
                <div class="demo-card rounded-2xl p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl demo-accent-bg flex items-center justify-center">
                            <span class="text-lg">🔘</span>
                        </div>
                        <div>
                            <h3 class="font-heading font-bold text-base">Button Styles</h3>
                            <p class="text-xs demo-text-muted">Variasi tombol</p>
                        </div>
                    </div>
                    <div class="space-y-3 mt-4">
                        <button class="demo-btn-primary px-5 py-2.5 rounded-full text-sm font-semibold w-full">Primary Button</button>
                        <button class="demo-btn-outline px-5 py-2.5 rounded-full text-sm w-full hover:opacity-70">Outline Button</button>
                    </div>
                </div>

                
                <div class="demo-card rounded-2xl p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl demo-accent-bg flex items-center justify-center">
                            <span class="text-lg">📝</span>
                        </div>
                        <div>
                            <h3 class="font-heading font-bold text-base">Form Input</h3>
                            <p class="text-xs demo-text-muted">Elemen formulir</p>
                        </div>
                    </div>
                    <div class="space-y-3 mt-4">
                        <input type="text" class="demo-input w-full rounded-xl px-4 py-3 text-sm outline-none" placeholder="Nama Anda...">
                        <input type="email" class="demo-input w-full rounded-xl px-4 py-3 text-sm outline-none" placeholder="email@contoh.com">
                        <textarea class="demo-input w-full rounded-xl px-4 py-3 text-sm outline-none resize-none" rows="2" placeholder="Pesan..."></textarea>
                    </div>
                </div>

                
                <div class="demo-card rounded-2xl p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl demo-accent-bg flex items-center justify-center">
                            <span class="text-lg">🔤</span>
                        </div>
                        <div>
                            <h3 class="font-heading font-bold text-base">Typography</h3>
                            <p class="text-xs demo-text-muted">Hierarki teks</p>
                        </div>
                    </div>
                    <div class="space-y-3 mt-4">
                        <h4 class="font-heading text-2xl font-extrabold">Heading Bold</h4>
                        <h5 class="font-heading text-lg font-semibold demo-text-secondary">Subheading Medium</h5>
                        <p class="text-sm demo-text-secondary leading-relaxed">Body text — teks paragraf biasa yang menjelaskan konten dengan detail yang cukup untuk dibaca dengan nyaman.</p>
                        <p class="text-xs demo-text-muted">Caption — teks kecil untuk metadata</p>
                    </div>
                </div>

                
                <div class="demo-card rounded-2xl p-6 md:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl demo-accent-bg flex items-center justify-center">
                            <span class="text-lg">📊</span>
                        </div>
                        <div>
                            <h3 class="font-heading font-bold text-base">Stats & Metrics</h3>
                            <p class="text-xs demo-text-muted">Dashboard style</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <div class="demo-accent-bg rounded-xl p-4 text-center">
                            <span class="block font-heading text-3xl font-extrabold">2+</span>
                            <span class="text-xs demo-text-muted mt-1 block">Proyek</span>
                        </div>
                        <div class="demo-accent-bg rounded-xl p-4 text-center">
                            <span class="block font-heading text-3xl font-extrabold">8</span>
                            <span class="text-xs demo-text-muted mt-1 block">Tech Stack</span>
                        </div>
                        <div class="demo-accent-bg rounded-xl p-4 text-center">
                            <span class="block font-heading text-3xl font-extrabold">1+</span>
                            <span class="text-xs demo-text-muted mt-1 block">Tahun</span>
                        </div>
                        <div class="demo-accent-bg rounded-xl p-4 text-center">
                            <span class="block font-heading text-3xl font-extrabold">∞</span>
                            <span class="text-xs demo-text-muted mt-1 block">Dedikasi</span>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="mt-12 demo-card rounded-2xl p-6 overflow-hidden">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl demo-accent-bg flex items-center justify-center">
                        <span class="text-lg">💻</span>
                    </div>
                    <div>
                        <h3 class="font-heading font-bold text-base">Cara Implementasi</h3>
                        <p class="text-xs demo-text-muted">CSS custom properties + JS toggle</p>
                    </div>
                </div>
                <pre class="mt-4 text-xs demo-text-secondary overflow-x-auto leading-relaxed"><code>// Toggle dark/light mode
const toggle = document.getElementById('theme-toggle');
toggle.addEventListener('click', () =&gt; {'{'} 
    document.body.classList.toggle('light');
    // Semua komponen otomatis berubah
    // karena menggunakan CSS custom properties
{'}'});

:root {'{'} 
    --bg-primary: #050505;     /* Dark */
    --text-primary: #ffffff;
{'}'}
.light {'{'} 
    --bg-primary: #fafafa;     /* Light */
    --text-primary: #111111;
{'}'}</code></pre>
            </div>
        </div>
    </div>
