<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation Demo — Sarham San</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            background: #080808;
            color: #fff;
        }
        .font-logo { font-family: 'Dancing Script', cursive; }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.03);
            color: #fff;
            font-size: 14px;
            transition: border-color 0.3s, box-shadow 0.3s;
            outline: none;
            font-family: inherit;
        }
        .form-input:focus {
            border-color: rgba(255,255,255,0.25);
            box-shadow: 0 0 0 3px rgba(255,255,255,0.04);
        }
        .form-input.error {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239,68,68,0.1);
        }
        .form-input.success {
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34,197,94,0.1);
        }
        .error-msg {
            color: #ef4444;
            font-size: 12px;
            margin-top: 6px;
            opacity: 0;
            transform: translateY(-4px);
            transition: all 0.3s ease;
        }
        .error-msg.show {
            opacity: 1;
            transform: translateY(0);
        }
        .success-msg {
            color: #22c55e;
            font-size: 12px;
            margin-top: 6px;
        }
        .submit-btn {
            width: 100%;
            padding: 14px 24px;
            border-radius: 10px;
            background: white;
            color: black;
            font-weight: 700;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: inherit;
        }
        .submit-btn:hover { opacity: 0.9; transform: translateY(-1px); }
        .submit-btn:disabled {
            background: rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.3);
            cursor: not-allowed;
            transform: none;
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
        .toast {
            position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%) translateY(20px);
            padding: 14px 28px; border-radius: 12px; font-size: 13px; font-weight: 600;
            opacity: 0; transition: all 0.4s cubic-bezier(0.22,1,0.36,1); z-index: 999;
            pointer-events: none;
        }
        .toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }
        .toast.success { background: #22c55e; color: white; }
        .toast.error { background: #ef4444; color: white; }
    </style>
</head>
<body class="antialiased min-h-screen bg-grid relative overflow-x-hidden p-0 m-0">
    <!-- Floating Back Button -->
    <a href="/#skills" class="fixed top-6 left-6 z-50 inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#050505]/80 border border-white/10 shadow-xl backdrop-blur-md text-white/50 hover:text-white hover:bg-white/10 hover:border-white/20 transition-all font-medium text-[13px] group">
        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>

    {{-- Toast --}}
    <div id="toast" class="toast"></div>

    <main class="pt-28 pb-20 px-8 sm:px-12 lg:px-16">
        <div class="max-w-5xl mx-auto">
            {{-- Header --}}
            <div class="text-center mb-14">
                <span class="text-xs text-white/30 uppercase tracking-[0.25em] font-medium">Skill Demo</span>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mt-4 mb-4">Form Validation</h1>
                <p class="text-white/40 text-sm max-w-md mx-auto leading-relaxed">
                    Validasi form real-time dengan feedback visual yang jelas — error, success, dan pesan bantuan.
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12">
                {{-- Form --}}
                <div class="bg-white/[0.02] border border-white/[0.06] rounded-2xl p-8">
                    <h2 class="text-lg font-bold mb-6">Coba Isi Form</h2>
                    <form id="demo-form" class="space-y-5" novalidate>
                        <div>
                            <label class="block text-xs text-white/40 mb-2 font-medium uppercase tracking-wider">Nama Lengkap</label>
                            <input type="text" id="name" class="form-input" placeholder="Masukkan nama lengkapmu" autocomplete="off">
                            <p class="error-msg" id="name-error">Nama minimal 3 karakter</p>
                        </div>
                        <div>
                            <label class="block text-xs text-white/40 mb-2 font-medium uppercase tracking-wider">Email</label>
                            <input type="email" id="email" class="form-input" placeholder="contoh@email.com" autocomplete="off">
                            <p class="error-msg" id="email-error">Format email tidak valid</p>
                        </div>
                        <div>
                            <label class="block text-xs text-white/40 mb-2 font-medium uppercase tracking-wider">Password</label>
                            <input type="password" id="password" class="form-input" placeholder="Minimal 8 karakter" autocomplete="off">
                            <p class="error-msg" id="password-error">Password minimal 8 karakter</p>
                            <div class="flex gap-1 mt-2" id="strength-bar">
                                <div class="h-1 flex-1 rounded-full bg-white/[0.06]"></div>
                                <div class="h-1 flex-1 rounded-full bg-white/[0.06]"></div>
                                <div class="h-1 flex-1 rounded-full bg-white/[0.06]"></div>
                                <div class="h-1 flex-1 rounded-full bg-white/[0.06]"></div>
                            </div>
                            <p class="text-[11px] text-white/20 mt-1" id="strength-text"></p>
                        </div>
                        <div>
                            <label class="block text-xs text-white/40 mb-2 font-medium uppercase tracking-wider">Pesan</label>
                            <textarea id="message" class="form-input" rows="3" placeholder="Tulis pesan singkat..." style="resize:none"></textarea>
                            <div class="flex justify-between mt-1">
                                <p class="error-msg" id="message-error">Pesan minimal 10 karakter</p>
                                <span class="text-[11px] text-white/20" id="char-count">0/200</span>
                            </div>
                        </div>
                        <button type="submit" class="submit-btn" id="submit-btn" disabled>Kirim Form</button>
                    </form>
                </div>

                {{-- Code --}}
                <div>
                    <h2 class="text-lg font-bold mb-4">Cara Implementasi</h2>
                    <div class="code-block mb-6">
                        <span class="code-comment">// Real-time validation</span><br>
                        <span class="code-keyword">function</span> validateEmail(email) {<br>
                        &nbsp;&nbsp;<span class="code-keyword">const</span> regex = <span class="code-string">/^[^\s@]+@[^\s@]+\.[^\s@]+$/</span>;<br>
                        &nbsp;&nbsp;<span class="code-keyword">return</span> regex.test(email);<br>
                        }<br><br>
                        <span class="code-comment">// Password strength checker</span><br>
                        <span class="code-keyword">function</span> checkStrength(pw) {<br>
                        &nbsp;&nbsp;<span class="code-keyword">let</span> score = 0;<br>
                        &nbsp;&nbsp;<span class="code-keyword">if</span> (pw.length >= 8) score++;<br>
                        &nbsp;&nbsp;<span class="code-keyword">if</span> (<span class="code-string">/[A-Z]/</span>.test(pw)) score++;<br>
                        &nbsp;&nbsp;<span class="code-keyword">if</span> (<span class="code-string">/[0-9]/</span>.test(pw)) score++;<br>
                        &nbsp;&nbsp;<span class="code-keyword">if</span> (<span class="code-string">/[^A-Za-z0-9]/</span>.test(pw)) score++;<br>
                        &nbsp;&nbsp;<span class="code-keyword">return</span> score;<br>
                        }<br><br>
                        <span class="code-comment">// Visual feedback</span><br>
                        input.classList.toggle(<span class="code-string">'error'</span>, !isValid);<br>
                        input.classList.toggle(<span class="code-string">'success'</span>, isValid);
                    </div>

                    <h3 class="text-sm font-semibold mb-3 text-white/60">Fitur Validasi:</h3>
                    <ul class="space-y-2 text-sm text-white/40">
                        <li class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-full bg-green-500/20 flex items-center justify-center text-[10px]">✓</span>
                            Validasi real-time saat mengetik
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-full bg-green-500/20 flex items-center justify-center text-[10px]">✓</span>
                            Password strength indicator
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-full bg-green-500/20 flex items-center justify-center text-[10px]">✓</span>
                            Error & success visual feedback
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-full bg-green-500/20 flex items-center justify-center text-[10px]">✓</span>
                            Character counter
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-full bg-green-500/20 flex items-center justify-center text-[10px]">✓</span>
                            Toast notification on submit
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <script>
        const form = document.getElementById('demo-form');
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const messageInput = document.getElementById('message');
        const submitBtn = document.getElementById('submit-btn');

        function validateEmail(v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v); }

        function checkStrength(pw) {
            let s = 0;
            if (pw.length >= 8) s++;
            if (/[A-Z]/.test(pw)) s++;
            if (/[0-9]/.test(pw)) s++;
            if (/[^A-Za-z0-9]/.test(pw)) s++;
            return s;
        }

        function setFieldState(input, errorEl, isValid) {
            input.classList.toggle('error', !isValid && input.value.length > 0);
            input.classList.toggle('success', isValid);
            if (errorEl) {
                errorEl.classList.toggle('show', !isValid && input.value.length > 0);
            }
        }

        function checkForm() {
            const valid =
                nameInput.value.length >= 3 &&
                validateEmail(emailInput.value) &&
                passwordInput.value.length >= 8 &&
                messageInput.value.length >= 10;
            submitBtn.disabled = !valid;
        }

        nameInput.addEventListener('input', () => {
            setFieldState(nameInput, document.getElementById('name-error'), nameInput.value.length >= 3);
            checkForm();
        });

        emailInput.addEventListener('input', () => {
            setFieldState(emailInput, document.getElementById('email-error'), validateEmail(emailInput.value));
            checkForm();
        });

        passwordInput.addEventListener('input', () => {
            const pw = passwordInput.value;
            setFieldState(passwordInput, document.getElementById('password-error'), pw.length >= 8);

            const strength = checkStrength(pw);
            const bars = document.querySelectorAll('#strength-bar > div');
            const colors = ['#ef4444', '#f59e0b', '#22c55e', '#22c55e'];
            const labels = ['Lemah', 'Cukup', 'Kuat', 'Sangat Kuat'];

            bars.forEach((bar, i) => {
                bar.style.background = i < strength ? colors[Math.min(strength-1, 3)] : 'rgba(255,255,255,0.06)';
            });
            document.getElementById('strength-text').textContent = pw.length > 0 ? labels[Math.min(strength-1, 3)] || 'Lemah' : '';
            checkForm();
        });

        messageInput.addEventListener('input', () => {
            const len = messageInput.value.length;
            document.getElementById('char-count').textContent = len + '/200';
            if (len > 200) messageInput.value = messageInput.value.substring(0, 200);
            setFieldState(messageInput, document.getElementById('message-error'), len >= 10);
            checkForm();
        });

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            showToast('Form berhasil dikirim! ✅', 'success');
            form.reset();
            document.querySelectorAll('.form-input').forEach(i => { i.classList.remove('success', 'error'); });
            document.querySelectorAll('.error-msg').forEach(m => m.classList.remove('show'));
            document.querySelectorAll('#strength-bar > div').forEach(b => b.style.background = 'rgba(255,255,255,0.06)');
            document.getElementById('strength-text').textContent = '';
            document.getElementById('char-count').textContent = '0/200';
            submitBtn.disabled = true;
        });

        function showToast(msg, type) {
            const toast = document.getElementById('toast');
            toast.textContent = msg;
            toast.className = 'toast ' + type + ' show';
            setTimeout(() => { toast.classList.remove('show'); }, 3000);
        }
    </script>
</body>
</html>
