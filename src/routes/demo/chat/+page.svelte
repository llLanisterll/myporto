<script>
  import { onMount } from 'svelte';

  onMount(() => {

        const form = document.getElementById('chat-form');
        const input = document.getElementById('chat-input');
        const container = document.getElementById('chat-container');

        const appendMessage = (text, isSelf) => {
            const time = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
            const div = document.createElement('div');
            
            if (isSelf) {
                div.className = 'chat-bubble self-end max-w-[85%] bg-teal-500/20 border border-teal-500/30 p-4 rounded-2xl rounded-tr-sm';
                div.innerHTML = `<p class="text-[13px] leading-relaxed text-teal-50">${text}</p><span class="text-[9px] text-teal-200/50 block mt-2 text-right">${time}</span>`;
            } else {
                div.className = 'chat-bubble self-start max-w-[85%] bg-white/[0.05] border border-white/10 p-4 rounded-2xl rounded-tl-sm';
                div.innerHTML = `<p class="text-[13px] leading-relaxed text-white/90">${text}</p><span class="text-[9px] text-white/30 block mt-2">${time}</span>`;
            }
            container.appendChild(div);
            container.scrollTop = container.scrollHeight;
        };

        const showTyping = () => {
            const div = document.createElement('div');
            div.id = 'typing-indicator';
            div.className = 'chat-bubble self-start bg-white/[0.05] border border-white/10 px-4 py-3 rounded-2xl rounded-tl-sm flex gap-1';
            div.innerHTML = '<div class="w-1.5 h-1.5 bg-white/40 rounded-full typing-dot"></div><div class="w-1.5 h-1.5 bg-white/40 rounded-full typing-dot"></div><div class="w-1.5 h-1.5 bg-white/40 rounded-full typing-dot"></div>';
            container.appendChild(div);
            container.scrollTop = container.scrollHeight;
            return div;
        };

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const text = input.value.trim();
            if(!text) return;
            
            appendMessage(text, true);
            input.value = '';

            // Simulate reply
            const indicator = showTyping();
            setTimeout(() => {
                indicator.remove();
                appendMessage(
                    ["Mantap🔥", "Keren banget", "Oke, entar sekalian push ya", "Good job!" ][Math.floor(Math.random()*4)],
                    false
                );
            }, 2000);
        });
    
  });
</script>

<svelte:head>
  <title>Realtime Chat UI Demo — Sarham San</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>

        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; background: #050505; color: #fff; }
        .glass-panel { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); box-shadow: 0 4px 30px rgba(0,0,0,0.5); backdrop-filter: blur(10px); }
        .bg-grid { background-image: radial-gradient(circle, rgba(255,255,255,0.03) 1px, transparent 1px); background-size: 32px 32px; }
        
        .chat-bubble { opacity: 0; transform: translateY(10px); animation: popIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; }
        @keyframes popIn { to { opacity: 1; transform: translateY(0); } }
        
        .typing-dot { animation: typing 1.4s infinite ease-in-out both; }
        .typing-dot:nth-child(1) { animation-delay: -0.32s; }
        .typing-dot:nth-child(2) { animation-delay: -0.16s; }
        @keyframes typing { 0%, 80%, 100% { transform: scale(0); } 40% { transform: scale(1); } }
    
  </style>
</svelte:head>

<!-- Floating Back Button -->
    <a href="/#skills" class="fixed top-6 left-6 z-50 inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#050505]/80 border border-white/10 shadow-xl backdrop-blur-md text-white/50 hover:text-white hover:bg-white/10 hover:border-white/20 transition-all font-medium text-[13px] group">
        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>

    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-teal-600/10 blur-[120px] rounded-full pointer-events-none"></div>

    <!-- Phone Mockup container -->
    <div class="flex-1 w-full max-w-sm mx-auto glass-panel rounded-[2rem] border-white/10 shadow-2xl relative z-10 flex flex-col overflow-hidden bg-[#0a0a0a] ring-8 ring-white/[0.02]">
        
        <!-- Header -->
        <div class="px-6 py-4 border-b border-white/[0.05] bg-white/[0.02] flex items-center gap-4 backdrop-blur-xl">
            <div class="relative">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-teal-400 to-emerald-600 flex items-center justify-center font-bold">A</div>
                <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-[#0a0a0a] rounded-full"></div>
            </div>
            <div>
                <h2 class="text-sm font-bold">Alex (Tech Lead)</h2>
                <p class="text-[11px] text-white/40">Online</p>
            </div>
            <button aria-label="Cari pesan" class="ml-auto text-white/40 hover:text-teal-400 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </button>
        </div>

        <!-- Chat Area -->
        <div class="flex-1 p-6 flex flex-col gap-4 overflow-y-auto" id="chat-container">
            <div class="chat-bubble self-start max-w-[85%] bg-white/[0.05] border border-white/10 p-4 rounded-2xl rounded-tl-sm" style="animation-delay: 0.1s;">
                <p class="text-[13px] leading-relaxed text-white/90">Hei, bagaimana progres redesign front-endnya?</p>
                <span class="text-[9px] text-white/30 block mt-2">10:42 AM</span>
            </div>
            
            <div class="chat-bubble self-end max-w-[85%] bg-teal-500/20 border border-teal-500/30 p-4 rounded-2xl rounded-tr-sm" style="animation-delay: 0.4s;">
                <p class="text-[13px] leading-relaxed text-teal-50">Lancar. Layout grid udah rapi dan saya tambahin CSS animations biar lebih premium.</p>
                <span class="text-[9px] text-teal-200/50 block mt-2 text-right">10:45 AM</span>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-4 border-t border-white/[0.05] bg-white/[0.01]">
            <form id="chat-form" class="relative flex items-center">
                <input type="text" id="chat-input" aria-label="Input pesan" placeholder="Tulis pesan..." class="w-full bg-white/[0.05] border border-white/10 rounded-full py-3 px-5 pr-14 text-[13px] outline-none focus:border-teal-500/50 focus:bg-white/[0.08] transition-all text-white placeholder-white/30">
                <button type="submit" aria-label="Kirim pesan" class="absolute right-2 w-8 h-8 rounded-full bg-teal-500 flex items-center justify-center text-black hover:scale-105 transition-transform">
                    <svg class="w-4 h-4 ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M2 21l21-9L2 3v7l15 2-15 2v7z"/></svg>
                </button>
            </form>
        </div>
    </div>
