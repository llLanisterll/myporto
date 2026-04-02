<script>
  import { onMount } from 'svelte';

  let isLight = $state(false);

  onMount(() => {
    // Svelte 5 state handles the UI updates gracefully
    const body = document.body;
    
    // Check initial preference from localStorage if we had one, but default to dark for demo
    isLight = body.classList.contains('light');

    document.getElementById('theme-toggle-btn').addEventListener('click', () => {
        body.classList.toggle('light');
        isLight = body.classList.contains('light');
    });
  });
</script>

<svelte:head>
  <title>Dark/Light Mode Theme Architecture — Sarham San</title>
  <meta name="description" content="Eksplorasi Dark & Light mode premium" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :global(body) { 
        font-family: 'Plus Jakarta Sans', sans-serif;
        /* Default Dark Theme Variables */
        --bg-base: #050505;
        --bg-surface: #0a0a0a;
        --bg-glass: rgba(20, 20, 20, 0.6);
        --border-color: rgba(255, 255, 255, 0.08);
        --border-highlight: rgba(255, 255, 255, 0.15);
        --text-primary: #ffffff;
        --text-secondary: rgba(255, 255, 255, 0.6);
        --accent: #ffffff;
        --accent-muted: rgba(255, 255, 255, 0.1);
        --shadow-elevation: 0 20px 40px -10px rgba(0, 0, 0, 0.5);
        --glow: radial-gradient(circle at 50% 0%, rgba(255, 255, 255, 0.03) 0%, transparent 60%);
        transition: background-color 0.6s cubic-bezier(0.22, 1, 0.36, 1), 
                    color 0.6s cubic-bezier(0.22, 1, 0.36, 1);
        background-color: var(--bg-base);
        color: var(--text-primary);
    }

    /* Light Theme Variables */
    :global(body.light) {
        --bg-base: #f4f6f8;
        --bg-surface: #ffffff;
        --bg-glass: rgba(255, 255, 255, 0.7);
        --border-color: rgba(0, 0, 0, 0.08);
        --border-highlight: rgba(0, 0, 0, 0.15);
        --text-primary: #0f172a;
        --text-secondary: #64748b;
        --accent: #0f172a;
        --accent-muted: rgba(0, 0, 0, 0.05);
        --shadow-elevation: 0 20px 40px -10px rgba(0, 0, 0, 0.05);
        --glow: radial-gradient(circle at 50% 0%, rgba(0, 0, 0, 0.02) 0%, transparent 60%);
    }

    .font-outfit { font-family: 'Outfit', sans-serif; }

    .theme-transition {
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .surface-card {
        background: var(--bg-surface);
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-elevation);
    }

    .glass-header {
        background: var(--bg-glass);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-bottom: 1px solid var(--border-color);
    }

    .custom-input {
        background: var(--bg-base);
        border: 1px solid var(--border-color);
        color: var(--text-primary);
    }
    
    .custom-input:focus {
        border-color: var(--border-highlight);
        outline: none;
    }

    /* Animated Toggle Button */
    .toggle-wrapper {
        width: 72px;
        height: 36px;
        border-radius: 100px;
        background: var(--bg-surface);
        border: 1px solid var(--border-color);
        position: relative;
        cursor: pointer;
        padding: 4px;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
    }

    .toggle-thumb {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: var(--accent);
        position: absolute;
        top: 50%;
        transform: translateY(-50%) translateX(0);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1), background-color 0.4s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }

    body.light .toggle-thumb {
        transform: translateY(-50%) translateX(36px);
    }

    .toggle-icon {
        color: var(--bg-base);
        width: 14px;
        height: 14px;
        transition: transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    body.light .toggle-icon {
        transform: rotate(180deg);
    }

    /* Ambient Background Glow */
    .ambient-glow {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: var(--glow);
        pointer-events: none;
        z-index: -1;
    }
  </style>
</svelte:head>

<div class="ambient-glow theme-transition"></div>

<!-- Back Navigation -->
<a href="/#skills" class="fixed top-6 left-6 z-50 inline-flex items-center gap-2 px-5 py-2.5 rounded-full shadow-lg backdrop-blur-md theme-transition font-medium text-[13px] group" style="background: var(--bg-glass); border: 1px solid var(--border-color); color: var(--text-secondary);">
    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
    Kembali
</a>

<!-- Glass Header Navigation -->
<header class="fixed top-0 left-0 right-0 z-40 px-8 sm:px-12 lg:px-16 glass-header theme-transition">
    <div class="flex items-center justify-end h-20">
        <div class="flex items-center gap-4">
            <span class="text-xs font-semibold tracking-[0.2em] uppercase theme-transition" style="color: var(--text-secondary);">
                {isLight ? 'Light Mode' : 'Dark Mode'}
            </span>
            <div class="toggle-wrapper theme-transition" id="theme-toggle-btn">
                <div class="toggle-thumb">
                    {#if isLight}
                        <svg class="toggle-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 4.22a1 1 0 011.415 0l.708.708a1 1 0 01-1.414 1.414l-.708-.708a1 1 0 010-1.414zM16 10a1 1 0 011-1h1a1 1 0 110 2h-1a1 1 0 01-1-1zm-4.22 4.22a1 1 0 010 1.415l-.708.708a1 1 0 01-1.414-1.414l.708-.708a1 1 0 011.415 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22-4.22a1 1 0 01-1.415 0l-.708-.708a1 1 0 011.414-1.414l.708.708a1 1 0 010 1.414zM4 10a1 1 0 01-1-1H2a1 1 0 110 2h1a1 1 0 011-1zM6.34 6.34a1 1 0 010-1.414l.708-.708a1 1 0 011.414 1.414l-.708.708a1 1 0 01-1.414 0zM10 5a5 5 0 100 10 5 5 0 000-10z" clip-rule="evenodd" />
                        </svg>
                    {:else}
                        <svg class="toggle-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                        </svg>
                    {/if}
                </div>
            </div>
        </div>
    </div>
</header>

<main class="pt-32 pb-24 px-6 sm:px-12 xl:px-8 max-w-6xl mx-auto min-h-screen">
    
    <!-- Hero Section -->
    <div class="text-center mb-20">
        <div class="inline-flex items-center justify-center px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase mb-6 theme-transition" style="background: var(--accent-muted); color: var(--text-secondary); border: 1px solid var(--border-color);">
            Theme Architecture
        </div>
        <h1 class="font-outfit text-5xl sm:text-6xl lg:text-7xl font-bold tracking-tight mb-6 theme-transition">
            Fluid <span style="color: var(--text-secondary);">Transitions</span>
        </h1>
        <p class="text-base sm:text-lg max-w-2xl mx-auto leading-relaxed theme-transition" style="color: var(--text-secondary);">
            Sistem desain adaptif yang bereaksi seketika terhadap preferensi pengguna. Dirancang dengan variabel CSS untuk skalabilitas tak terbatas dan animasi 60fps yang sempurna.
        </p>
    </div>

    <!-- UI Components Showcase -->
    <div class="grid lg:grid-cols-12 gap-8">
        
        <!-- Left Column: Typography & Cards -->
        <div class="lg:col-span-7 space-y-8">
            
            <!-- Component: Typography -->
            <div class="surface-card rounded-[2rem] p-8 sm:p-10 theme-transition">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center theme-transition" style="background: var(--accent-muted);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--text-primary);"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-outfit font-bold text-xl theme-transition">Typography Hierarchy</h3>
                        <p class="text-sm theme-transition" style="color: var(--text-secondary);">Harmoni visual untuk kenyamanan membaca</p>
                    </div>
                </div>
                
                <div class="space-y-6">
                    <div>
                        <h1 class="font-outfit text-4xl font-bold theme-transition">Heading Display</h1>
                        <p class="text-xs mt-1 theme-transition" style="color: var(--text-secondary);">Format: Outfit Bold, 36px, Murni</p>
                    </div>
                    <div class="h-px w-full theme-transition" style="background: var(--border-color);"></div>
                    <div>
                        <h3 class="font-outfit text-xl font-medium theme-transition">Subheading Medium</h3>
                        <p class="text-sm mt-3 leading-relaxed theme-transition" style="color: var(--text-secondary);">Body text ini menggunakan font Plus Jakarta Sans. Paragraf dirancang dengan line-height 1.6 untuk memastikan legibilitas maksimal baik di mode gelap maupun mode terang.</p>
                    </div>
                </div>
            </div>

            <!-- Component: Form Interactive -->
            <div class="surface-card rounded-[2rem] p-8 sm:p-10 theme-transition">
                 <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center theme-transition" style="background: var(--accent-muted);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--text-primary);"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <h3 class="font-outfit font-bold text-xl theme-transition">Input States</h3>
                </div>

                <div class="space-y-5">
                    <div>
                        <label class="block text-xs font-semibold mb-2 uppercase tracking-wide theme-transition" style="color: var(--text-secondary);">Email Address</label>
                        <input type="email" class="custom-input theme-transition w-full rounded-2xl px-5 py-4 text-sm transition-all focus:ring-4 focus:ring-opacity-20" style="focus:ring-color: var(--accent);" placeholder="nama@perusahaan.com">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <button class="w-full py-4 rounded-2xl font-bold text-sm theme-transition hover:scale-[0.98]" style="background: var(--accent); color: var(--bg-base);">Primary Action</button>
                        <button class="w-full py-4 rounded-2xl font-bold text-sm theme-transition hover:scale-[0.98]" style="background: transparent; color: var(--text-primary); border: 1px solid var(--border-color);">Secondary Form</button>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column: Code & Widgets -->
        <div class="lg:col-span-5 space-y-8">
            
            <!-- Statistics Widget -->
            <div class="surface-card rounded-[2rem] p-8 theme-transition relative overflow-hidden group">
                <div class="absolute -right-6 -top-6 w-32 h-32 rounded-full blur-3xl opacity-20 theme-transition" style="background: var(--text-primary);"></div>
                <div class="flex items-center justify-between mb-8">
                    <h3 class="font-outfit font-bold text-lg theme-transition">Performance</h3>
                    <span class="px-3 py-1 text-xs rounded-full theme-transition" style="background: rgba(34, 197, 94, 0.1); color: #22c55e;">Excellent</span>
                </div>
                
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <div class="text-4xl font-outfit font-bold theme-transition mb-1">60<span class="text-xl text-gray-400">fps</span></div>
                        <p class="text-xs theme-transition" style="color: var(--text-secondary);">Animation Framerate</p>
                    </div>
                    <div>
                        <div class="text-4xl font-outfit font-bold theme-transition mb-1">100<span class="text-xl text-gray-400">%</span></div>
                        <p class="text-xs theme-transition" style="color: var(--text-secondary);">Lighthouse Score</p>
                    </div>
                    <div>
                        <div class="text-4xl font-outfit font-bold theme-transition mb-1">&lt;0.1<span class="text-xl text-gray-400">s</span></div>
                        <p class="text-xs theme-transition" style="color: var(--text-secondary);">Theme Switch Delay</p>
                    </div>
                </div>
            </div>

            <!-- Code Block Showcase -->
            <div class="surface-card rounded-[2rem] overflow-hidden theme-transition flex flex-col h-full">
                <div class="px-6 py-4 flex items-center justify-between theme-transition" style="background: var(--accent-muted); border-bottom: 1px solid var(--border-color);">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-red-400"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                        <div class="w-3 h-3 rounded-full bg-green-400"></div>
                    </div>
                    <span class="text-xs font-mono theme-transition" style="color: var(--text-secondary);">styles.css</span>
                </div>
                <div class="p-6 overflow-x-auto flex-1">
                    <pre class="text-[13px] font-mono leading-loose theme-transition"><code style="color: var(--text-secondary);">/* Master Variables */
<span style="color: #ff7b72;">body</span> &#123;
  <span style="color: #79c0ff;">--bg-base</span>: <span style="color: #a5d6ff;">#050505</span>;
  <span style="color: #79c0ff;">--text-primary</span>: <span style="color: #a5d6ff;">#ffffff</span>;
  <span style="color: #d2a8ff;">transition</span>: all 0.6s ease;
&#125;

<span style="color: #ff7b72;">body.light</span> &#123;
  <span style="color: #79c0ff;">--bg-base</span>: <span style="color: #a5d6ff;">#f4f6f8</span>;
  <span style="color: #79c0ff;">--text-primary</span>: <span style="color: #a5d6ff;">#0f172a</span>;
&#125;

<span style="color: #8b949e;">/* Auto-updating component */</span>
<span style="color: #ff7b72;">.surface-card</span> &#123;
  <span style="color: #d2a8ff;">background</span>: <span style="color: #ff7b72;">var</span>(--bg-surface);
  <span style="color: #d2a8ff;">border-color</span>: <span style="color: #ff7b72;">var</span>(--border-color);
&#125;</code></pre>
                </div>
            </div>

        </div>
    </div>
</main>
