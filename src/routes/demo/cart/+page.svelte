<script>
  import { onMount } from 'svelte';

  onMount(() => {

        const products = [
            { id: 1, name: "Premium Wireless Headphones", desc: "Noise cancelling & hi-res audio focus.", price: 299.99, icon: "🎧" },
            { id: 2, name: "Mechanical Keyboard", desc: "Tactile switches with custom RGB.", price: 149.50, icon: "⌨️" },
            { id: 3, name: "Ergonomic Mouse", desc: "Vertical design for pro comfort.", price: 89.99, icon: "🖱️" }
        ];

        let cart = [];

        const badge = document.getElementById('cart-badge');
        const cartBtn = document.getElementById('cart-btn');
        const cartOverlay = document.getElementById('cart-overlay');
        const cartSidebar = document.getElementById('cart-sidebar');
        const closeCartBtn = document.getElementById('close-cart');
        const cartItemsContainer = document.getElementById('cart-items');
        const cartTotalEl = document.getElementById('cart-total');

        // Render products
        document.getElementById('products').innerHTML = products.map(p => `
            <div class="product-card glass-panel rounded-2xl p-6 flex flex-col border border-white/[0.04]">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-orange-500/10 to-orange-500/5 border border-orange-500/20 flex items-center justify-center text-3xl mb-5 mx-auto">
                    ${p.icon}
                </div>
                <div class="text-center flex-1">
                    <h3 class="font-bold text-white/90 mb-1 leading-snug">${p.name}</h3>
                    <p class="text-[11px] text-white/40 mb-4">${p.desc}</p>
                </div>
                <div class="flex items-center justify-between pt-4 border-t border-white/[0.05]">
                    <span class="font-mono font-semibold text-orange-400 text-lg">$${p.price.toFixed(2)}</span>
                    <button onclick="addToCart(${p.id})" class="px-4 py-2 rounded-lg bg-white/[0.05] hover:bg-orange-500 hover:text-black font-semibold text-xs transition-colors border border-white/10 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg> Add
                    </button>
                </div>
            </div>
        `).join('');

        const updateCartUI = () => {
            const totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
            const totalPrice = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
            
            badge.textContent = totalItems;
            
            // Pop effect
            badge.classList.remove('cart-pop');
            void badge.offsetWidth;
            badge.classList.add('cart-pop');

            cartTotalEl.textContent = '$' + totalPrice.toFixed(2);

            if (cart.length === 0) {
                cartItemsContainer.innerHTML = `
                    <div class="h-full flex flex-col items-center justify-center opacity-50">
                        <svg class="w-12 h-12 text-white/20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        <p class="text-sm">Keranjang masih kosong</p>
                    </div>`;
                return;
            }

            cartItemsContainer.innerHTML = cart.map(item => `
                <div class="flex items-center gap-4 bg-white/[0.02] border border-white/[0.05] p-3 rounded-xl">
                    <div class="w-12 h-12 rounded-lg bg-white/5 flex items-center justify-center text-xl border border-white/10">${item.icon}</div>
                    <div class="flex-1">
                        <h4 class="text-xs font-semibold text-white/90 truncate">${item.name}</h4>
                        <span class="text-[11px] text-orange-400 font-mono">$${item.price.toFixed(2)}</span>
                    </div>
                    <div class="flex items-center gap-2 bg-black/50 border border-white/10 rounded-lg p-1">
                        <button onclick="updateQty(${item.id}, -1)" class="w-6 h-6 rounded flex items-center justify-center text-white/50 hover:bg-white/10 transition-colors">-</button>
                        <span class="text-xs font-bold w-4 text-center">${item.qty}</span>
                        <button onclick="updateQty(${item.id}, 1)" class="w-6 h-6 rounded flex items-center justify-center text-white/50 hover:bg-white/10 transition-colors">+</button>
                    </div>
                </div>
            `).join('');
        };

        window.addToCart = (id) => {
            const product = products.find(p => p.id === id);
            const existing = cart.find(i => i.id === id);
            if (existing) {
                existing.qty++;
            } else {
                cart.push({ ...product, qty: 1 });
            }
            updateCartUI();
        };

        window.updateQty = (id, change) => {
            const item = cart.find(i => i.id === id);
            if (!item) return;
            item.qty += change;
            if (item.qty <= 0) {
                cart = cart.filter(i => i.id !== id);
            }
            updateCartUI();
        };

        // Open/Close Cart
        cartBtn.addEventListener('click', () => {
            cartOverlay.classList.remove('pointer-events-none', 'opacity-0');
            cartSidebar.classList.remove('translate-x-full');
        });
        
        const close = () => {
            cartOverlay.classList.add('pointer-events-none', 'opacity-0');
            cartSidebar.classList.add('translate-x-full');
        };

        closeCartBtn.addEventListener('click', close);
        cartOverlay.addEventListener('click', (e) => {
            if (e.target === cartOverlay) close();
        });
    
  });
</script>

<svelte:head>
  <title>E-Commerce Cart State Demo — Sarham San</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>

        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; background: #050505; color: #fff; }
        .glass-panel { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); box-shadow: 0 4px 30px rgba(0,0,0,0.5); backdrop-filter: blur(10px); }
        .bg-grid { background-image: radial-gradient(circle, rgba(255,255,255,0.03) 1px, transparent 1px); background-size: 32px 32px; }
        
        .product-card { transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .product-card:hover { transform: translateY(-5px); }

        .cart-pop { animation: pop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        @keyframes pop { 0% { transform: scale(1); } 50% { transform: scale(1.3); } 100% { transform: scale(1); } }
    
  </style>
</svelte:head>

<!-- Floating Back Button -->
    <a href="/#skills" class="fixed top-6 left-6 z-50 inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#050505]/80 border border-white/10 shadow-xl backdrop-blur-md text-white/50 hover:text-white hover:bg-white/10 hover:border-white/20 transition-all font-medium text-[13px] group">
        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>

    <!-- Top bg glows -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-[400px] bg-orange-600/10 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="relative z-10 w-full max-w-5xl mt-12 md:mt-0">
        <div class="flex items-center justify-end mb-12">
            <button id="cart-btn" class="glass-panel px-5 py-2.5 rounded-full flex items-center gap-3 hover:bg-white/5 transition-colors relative cursor-pointer">
                <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                <span class="font-semibold text-sm">Cart</span>
                <div class="absolute -top-1.5 -right-1.5 w-5 h-5 bg-orange-500 rounded-full flex items-center justify-center text-[10px] font-bold text-black border-2 border-[#050505]" id="cart-badge">0</div>
            </button>
        </div>

        <div class="text-center mb-12">
            <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight mb-4">
                Global State <span class="text-orange-500">Cart</span>
            </h1>
            <p class="text-white/40 text-[15px] max-w-xl mx-auto">Demonstrasi fundamental manajemen *global state* dalam UI. Menambahkan keranjang mengupdate *badge counter* dan total harga di keranjang secara reaktif.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16" id="products">
            <!-- Products injected by JS -->
        </div>

    </div>

    <!-- Cart Sidebar Overlay -->
    <div id="cart-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 opacity-0 pointer-events-none transition-opacity duration-300">
        <div id="cart-sidebar" class="absolute top-0 right-0 bottom-0 w-full max-w-md glass-panel bg-[#0a0a0a]/95 border-l border-white/[0.05] shadow-2xl translate-x-full transition-transform duration-500 flex flex-col">
            <div class="px-6 py-5 border-b border-white/[0.05] flex items-center justify-between">
                <h2 class="text-lg font-bold">Keranjang Belanja</h2>
                <button id="close-cart" class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center hover:bg-white/10 transition-colors">
                    <svg class="w-4 h-4 text-white/50 hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div id="cart-items" class="flex-1 overflow-y-auto p-6 flex flex-col gap-4">
                <div class="h-full flex flex-col items-center justify-center opacity-50">
                    <svg class="w-12 h-12 text-white/20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    <p class="text-sm">Keranjang masih kosong</p>
                </div>
            </div>
            <div class="p-6 border-t border-white/[0.05] bg-white/[0.01]">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-white/50 text-sm font-medium">Total:</span>
                    <span class="text-xl font-bold font-mono text-orange-400" id="cart-total">$0.00</span>
                </div>
                <button class="w-full py-3.5 rounded-xl bg-orange-500 text-black font-bold hover:bg-orange-400 hover:shadow-[0_0_20px_rgba(249,115,22,0.4)] transition-all">Checkout</button>
            </div>
        </div>
    </div>
