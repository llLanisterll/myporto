<script>
  import { onMount } from 'svelte';

  onMount(() => {

        function setSize(btn) {
            const width = btn.dataset.width;
            const frame = document.getElementById('demo-frame');
            const label = document.getElementById('size-label');
            frame.style.width = width;

            document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            label.textContent = btn.textContent.trim() + ' — ' + width;
        }
    
  });
</script>

<svelte:head>
  <title>Responsive Design Demo — Sarham San</title>
  <style>

        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            background: #080808;
            color: #fff;
        }
        .font-logo { font-family: 'Dancing Script', cursive; }
        .demo-frame {
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            overflow: hidden;
            background: #111;
            transition: width 0.5s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .demo-frame iframe {
            width: 100%;
            height: 500px;
            border: 0;
        }
        .size-btn {
            padding: 8px 20px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
            border: 1px solid rgba(255,255,255,0.12);
            color: rgba(255,255,255,0.5);
            background: transparent;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .size-btn:hover, .size-btn.active {
            background: white;
            color: black;
            border-color: white;
        }
        .code-block {
            background: #0d0d0d;
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 12px;
            padding: 20px 24px;
            font-family: 'JetBrains Mono', ui-monospace, monospace;
            font-size: 13px;
            color: rgba(255,255,255,0.6);
            line-height: 1.7;
            overflow-x: auto;
        }
        .code-keyword { color: #c084fc; }
        .code-string { color: #86efac; }
        .code-comment { color: rgba(255,255,255,0.2); }
    
  </style>
</svelte:head>

<!-- Floating Back Button -->
    <a href="/#skills" class="fixed top-6 left-6 z-50 inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#050505]/80 border border-white/10 shadow-xl backdrop-blur-md text-white/50 hover:text-white hover:bg-white/10 hover:border-white/20 transition-all font-medium text-[13px] group">
        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>

    <main class="pt-28 pb-20 px-8 sm:px-12 lg:px-16">
        <div class="max-w-5xl mx-auto">
            
            <div class="text-center mb-14">
                <span class="text-xs text-white/30 uppercase tracking-[0.25em] font-medium">Skill Demo</span>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mt-4 mb-4">Responsive Design</h1>
                <p class="text-white/40 text-sm max-w-md mx-auto leading-relaxed">
                    Lihat bagaimana layout beradaptasi secara otomatis untuk berbagai ukuran layar — dari desktop hingga mobile.
                </p>
            </div>

            
            <div class="flex items-center justify-center gap-3 mb-8">
                <button class="size-btn active" data-width="100%" onclick="setSize(this)">
                    🖥️ Desktop
                </button>
                <button class="size-btn" data-width="768px" onclick="setSize(this)">
                    📱 Tablet
                </button>
                <button class="size-btn" data-width="375px" onclick="setSize(this)">
                    📲 Mobile
                </button>
            </div>

            
            <div class="flex justify-center mb-16">
                <div id="demo-frame" class="demo-frame" style="width: 100%;">
                    <div class="bg-white/5 px-4 py-2 flex items-center gap-2 border-b border-white/[0.06]">
                        <div class="flex gap-1.5">
                            <div class="w-2.5 h-2.5 rounded-full bg-red-500/50"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-yellow-500/50"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-green-500/50"></div>
                        </div>
                        <span id="size-label" class="text-[11px] text-white/25 ml-2">Desktop — 100%</span>
                    </div>
                    <iframe src="https://ppid-sulselprov.vercel.app/" loading="lazy"></iframe>
                </div>
            </div>

            
            <div class="max-w-2xl mx-auto">
                <h2 class="text-lg font-bold mb-4">Cara Implementasi</h2>
                <div class="code-block">
                    <span class="code-comment">/* Responsive grid dengan Tailwind CSS */</span><br>
                    &lt;div <span class="code-keyword">class</span>=<span class="code-string">"grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"</span>&gt;<br>
                    &nbsp;&nbsp;&lt;div <span class="code-keyword">class</span>=<span class="code-string">"p-6 rounded-xl bg-white/5"</span>&gt;<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;Card content<br>
                    &nbsp;&nbsp;&lt;/div&gt;<br>
                    &lt;/div&gt;<br><br>
                    <span class="code-comment">/* Responsive typography */</span><br>
                    &lt;h1 <span class="code-keyword">class</span>=<span class="code-string">"text-2xl sm:text-3xl lg:text-5xl"</span>&gt;<br>
                    &nbsp;&nbsp;Heading<br>
                    &lt;/h1&gt;<br><br>
                    <span class="code-comment">/* Breakpoints: sm(640) md(768) lg(1024) xl(1280) */</span>
                </div>
            </div>
        </div>
    </main>
