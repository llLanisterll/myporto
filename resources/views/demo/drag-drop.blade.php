<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag & Drop UI Demo — Sarham San</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; background: #050505; color: #fff; touch-action: none; }
        .glass-panel { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); box-shadow: 0 4px 30px rgba(0,0,0,0.5); backdrop-filter: blur(10px); }
        .bg-grid { background-image: linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px); background-size: 40px 40px; }
        
        .draggable { cursor: grab; background: rgba(236,72,153,0.1); border: 1px solid rgba(236,72,153,0.3); transition: transform 0.2s, box-shadow 0.2s; }
        .draggable:active { cursor: grabbing; transform: scale(1.05); box-shadow: 0 15px 30px rgba(236,72,153,0.2); }
        .draggable.dragging { opacity: 0.5; }
        
        .dropzone { border: 2px dashed rgba(255,255,255,0.1); transition: all 0.3s; min-height: 200px; }
        .dropzone.drag-over { border-color: rgba(236,72,153,0.5); background: rgba(236,72,153,0.05); }
    </style>
</head>
<body class="antialiased min-h-screen bg-grid relative overflow-x-hidden flex flex-col items-center justify-center p-8 sm:p-12 lg:p-16">
    <!-- Floating Back Button -->
    <a href="/#skills" class="fixed top-6 left-6 z-50 inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#050505]/80 border border-white/10 shadow-xl backdrop-blur-md text-white/50 hover:text-white hover:bg-white/10 hover:border-white/20 transition-all font-medium text-[13px] group">
        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>

    <!-- Top bg glows -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-[400px] bg-pink-600/10 blur-[120px] rounded-full pointer-events-none"></div>

    {{-- Content --}}
    <div class="relative z-10 pt-20 pb-24 px-8 sm:px-12 lg:px-16">
        <div class="max-w-4xl mx-auto text-center mb-16">
            <h1 class="text-4xl sm:text-5xl lg:text-5xl font-extrabold leading-tight mb-6">
                Drag & Drop <span class="text-pink-400">Interaction</span>
            </h1>
            <p class="text-[15px] text-white/40 leading-relaxed max-w-xl mx-auto">
                Implementasi natif HTML5 Drag and Drop API. Coba pindahkan kartu-kartu tugas di bawah ini antar kolom ala Kanban Board.
            </p>
        </div>

        <div class="max-w-4xl mx-auto grid md:grid-cols-3 gap-6">
            <!-- Column 1 -->
            <div class="glass-panel rounded-2xl flex flex-col overflow-hidden h-[450px]">
                <div class="px-5 py-4 border-b border-white/[0.05] bg-white/[0.01]">
                    <h3 class="text-sm font-bold text-white/80 flex items-center justify-between">
                        To Do
                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-white/10 text-white/50" id="count-todo">3</span>
                    </h3>
                </div>
                <div class="flex-1 p-4 dropzone flex flex-col gap-3 overflow-y-auto" id="todo" data-status="To Do">
                    <!-- Cards -->
                    <div class="draggable p-4 rounded-xl flex flex-col gap-3" draggable="true" id="task-1">
                        <div class="flex gap-2">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-pink-500/20 text-pink-300">Feature</span>
                        </div>
                        <h4 class="text-sm font-medium text-white/90">Desain UI/UX baru</h4>
                        <p class="text-[11px] text-white/40">Buat wireframe figma untuk homepage.</p>
                    </div>
                    
                    <div class="draggable p-4 rounded-xl flex flex-col gap-3" draggable="true" id="task-2">
                        <div class="flex gap-2">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-500/20 text-indigo-300">Backend</span>
                        </div>
                        <h4 class="text-sm font-medium text-white/90">Setup Database</h4>
                        <p class="text-[11px] text-white/40">Konfigurasi tabel user dan relasi.</p>
                    </div>

                    <div class="draggable p-4 rounded-xl flex flex-col gap-3" draggable="true" id="task-3">
                        <div class="flex gap-2">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-yellow-500/20 text-yellow-300">Bug</span>
                        </div>
                        <h4 class="text-sm font-medium text-white/90">Fix Navbar Mobile</h4>
                        <p class="text-[11px] text-white/40">Hamburger menu tidak bisa diklik di iOS.</p>
                    </div>
                </div>
            </div>

            <!-- Column 2 -->
            <div class="glass-panel rounded-2xl flex flex-col overflow-hidden h-[450px]">
                <div class="px-5 py-4 border-b border-white/[0.05] bg-white/[0.01]">
                    <h3 class="text-sm font-bold text-white/80 flex items-center justify-between">
                        In Progress
                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-white/10 text-white/50" id="count-inprogress">0</span>
                    </h3>
                </div>
                <div class="flex-1 p-4 dropzone flex flex-col gap-3 overflow-y-auto" id="inprogress" data-status="In Progress">
                    <!-- Empty initially -->
                </div>
            </div>

            <!-- Column 3 -->
            <div class="glass-panel rounded-2xl flex flex-col overflow-hidden h-[450px]">
                <div class="px-5 py-4 border-b border-white/[0.05] bg-white/[0.01]">
                    <h3 class="text-sm font-bold text-white/80 flex items-center justify-between">
                        Done
                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-white/10 text-white/50" id="count-done">1</span>
                    </h3>
                </div>
                <div class="flex-1 p-4 dropzone flex flex-col gap-3 overflow-y-auto" id="done" data-status="Done">
                    <div class="draggable p-4 rounded-xl flex flex-col gap-3 border-emerald-500/30 bg-emerald-500/10 opacity-60" draggable="true" id="task-4">
                        <div class="flex gap-2">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-white/10 text-white/60 line-through">Setup Repo</span>
                        </div>
                        <h4 class="text-sm font-medium text-white/50 line-through">Inisialisasi Git</h4>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const draggables = document.querySelectorAll('.draggable');
            const dropzones = document.querySelectorAll('.dropzone');

            // Update counts function
            const updateCounts = () => {
                document.getElementById('count-todo').textContent = document.getElementById('todo').querySelectorAll('.draggable').length;
                document.getElementById('count-inprogress').textContent = document.getElementById('inprogress').querySelectorAll('.draggable').length;
                document.getElementById('count-done').textContent = document.getElementById('done').querySelectorAll('.draggable').length;
            };

            draggables.forEach(draggable => {
                draggable.addEventListener('dragstart', () => {
                    draggable.classList.add('dragging');
                    setTimeout(() => draggable.style.display = 'none', 0); // Hide original immediately
                });

                draggable.addEventListener('dragend', () => {
                    draggable.classList.remove('dragging');
                    draggable.style.display = 'flex'; // Restore display
                    updateCounts();
                    
                    // Specific styling for 'Done'
                    if(draggable.parentElement.id === 'done') {
                        draggable.classList.add('border-emerald-500/30', 'bg-emerald-500/10', 'opacity-60');
                        draggable.classList.remove('border-pink-500/30', 'bg-pink-500/10');
                    } else {
                        draggable.classList.remove('border-emerald-500/30', 'bg-emerald-500/10', 'opacity-60');
                        draggable.classList.add('border-pink-500/30', 'bg-pink-500/10');
                    }
                });
            });

            dropzones.forEach(dropzone => {
                dropzone.addEventListener('dragover', e => {
                    e.preventDefault();
                    dropzone.classList.add('drag-over');
                });

                dropzone.addEventListener('dragleave', () => {
                    dropzone.classList.remove('drag-over');
                });

                dropzone.addEventListener('drop', e => {
                    e.preventDefault();
                    dropzone.classList.remove('drag-over');
                    const draggingIcon = document.querySelector('.dragging');
                    if(draggingIcon) {
                        dropzone.appendChild(draggingIcon);
                        draggingIcon.style.display = 'flex';
                    }
                });
            });
        });
    </script>
</body>
</html>
