<script>
  import { onMount } from 'svelte';

  const templateUrls = [
    'templates/ecommerce', 'templates/dashboard', 'templates/blog',
    'templates/saas', 'templates/portfolio', 'templates/restaurant',
    'templates/admin', 'templates/social', 'templates/travel', 'templates/music'
  ];
  const cols = [
    [...templateUrls],
    [...templateUrls].reverse(),
    [...templateUrls.slice(5), ...templateUrls.slice(0, 5)],
    [...templateUrls.slice(3), ...templateUrls.slice(0, 3), ...templateUrls.slice(6), ...templateUrls.slice(0, 1)],
    [...templateUrls.slice(7), ...templateUrls.slice(0, 7)]
  ];
  const overlayLinks = [['01','Beranda','#'],['02','Proyek','#projects'],['03','Skills','#skills'],['04','Tentang','#about'],['05','Kontak','#contact']];
  const heroStats = [['2+','Tahun Pengalaman'],['5+','Proyek Selesai'],['99%','Kepuasan Klien']];
  const marqueeItems = ['Laravel','Tailwind CSS','PHP','JavaScript','MySQL','Figma','Git','Vite'];
  const techs = ['Laravel','PHP','Python','Java','Svelte','Tailwind','JavaScript','HTML/CSS','MySQL','Figma','Git'];
  const roles = ['Web Developer','Frontend Developer','Backend Developer','UI/UX Enthusiast'];
  const currentYear = new Date().getFullYear();

  let menuOpen = $state(false);
  let isExpanded = $state(false);
  let showIframes = $state(false);
  let navbar, roleText, parallaxText, scrollTopBtn, bar1, bar2, overlayMenu;

  function toggleMenu() {
    menuOpen = !menuOpen;
    overlayMenu?.classList.toggle('active');
    if (menuOpen) {
      bar1.style.transform = 'rotate(45deg) translateY(3.75px)';
      bar2.style.transform = 'rotate(-45deg) translateY(-3.75px)';
      document.body.style.overflow = 'hidden';
    } else {
      bar1.style.transform = '';
      bar2.style.transform = '';
      document.body.style.overflow = '';
    }
  }
  function closeOverlay() {
    menuOpen = false;
    overlayMenu?.classList.remove('active');
    if(bar1) bar1.style.transform = '';
    if(bar2) bar2.style.transform = '';
    document.body.style.overflow = '';
  }
  function toggleDemos() {
    isExpanded = !isExpanded;
    document.querySelectorAll('.hidden-demo').forEach(d => {
      if(isExpanded) { d.classList.remove('hidden'); setTimeout(()=>d.classList.add('opacity-100'),50); }
      else d.classList.add('hidden');
    });
    if(!isExpanded) document.getElementById('skills')?.scrollIntoView({behavior:'smooth',block:'start'});
  }
  function scrollToTop() { window.scrollTo({top:0,behavior:'smooth'}); }

  onMount(() => {
    const handleScroll = () => {
      if(window.scrollY>80){navbar.style.background='rgba(8,8,8,0.85)';navbar.style.backdropFilter='blur(12px)';navbar.style.borderBottom='1px solid rgba(255,255,255,0.04)';}
      else{navbar.style.background='transparent';navbar.style.backdropFilter='none';navbar.style.borderBottom='1px solid transparent';}
      let current='';
      document.querySelectorAll('section[id]').forEach(s=>{if(scrollY>=s.offsetTop-250)current=s.getAttribute('id');});
      document.querySelectorAll('.nav-link').forEach(l=>{l.classList.remove('active');if(l.getAttribute('href')==='#'+current)l.classList.add('active');});
      if(window.scrollY>600)scrollTopBtn?.classList.add('visible');else scrollTopBtn?.classList.remove('visible');
    };
    window.addEventListener('scroll',handleScroll);

    let roleIndex=0;
    const roleInterval=setInterval(()=>{
      if(!roleText)return;
      roleText.style.transition='opacity 0.4s, transform 0.4s';roleText.style.opacity='0';roleText.style.transform='translateY(-8px)';
      setTimeout(()=>{roleIndex=(roleIndex+1)%roles.length;roleText.textContent=roles[roleIndex];roleText.style.transform='translateY(8px)';
        requestAnimationFrame(()=>{roleText.style.opacity='1';roleText.style.transform='translateY(0)';});},400);
    },3000);

    setTimeout(() => {
      const observer=new IntersectionObserver(entries=>{entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('visible');observer.unobserve(e.target);}});},{threshold:0.06,rootMargin:'0px 0px -30px 0px'});
      document.querySelectorAll('.reveal,.stagger').forEach(el=>observer.observe(el));
    }, 300);

    const pl=document.getElementById('preloader'),bw=document.getElementById('body-wrapper');
    if(sessionStorage.getItem('portfolioLoaded')){
      if(pl)pl.style.display='none';
      if(bw){bw.classList.remove('overflow-hidden');bw.classList.add('overflow-x-hidden');}
      showIframes = true; // Inject immedately on subsequent navigation
    }
    else{
      sessionStorage.setItem('portfolioLoaded','true');
      setTimeout(()=>{
        if(pl){
          pl.style.opacity='0';
          setTimeout(()=>{
            pl.style.display='none';
            if(bw){
              bw.classList.remove('overflow-hidden');
              bw.classList.add('overflow-x-hidden');
            }
            showIframes = true; // Trigger iframe injection exactly when preloader is removed
          },700);
        }
      },3500); // Wait 3.5s (before 4.2s failsafe)
    }

    const handleAnchorClick = (e) => {
      const anchor = e.target.closest('a[href^="#"]');
      if (!anchor) return;
      const href = anchor.getAttribute('href');
      if (href === '#') {
        e.preventDefault();
        window.scrollTo({top:0, behavior:'smooth'});
        return;
      }
      try {
        const t = document.querySelector(href);
        if (t) {
          e.preventDefault();
          t.scrollIntoView({behavior:'smooth', block:'start'});
        }
      } catch (err) {
        console.error('Invalid selector:', href);
      }
    };
    document.addEventListener('click', handleAnchorClick);

    const handleMouse=e=>{if(window.scrollY<window.innerHeight&&parallaxText){const x=(e.clientX/window.innerWidth-0.5)*20,y=(e.clientY/window.innerHeight-0.5)*20;requestAnimationFrame(()=>{parallaxText.style.transform=`translate(${x}px, ${y}px)`;});}};
    document.addEventListener('mousemove',handleMouse);

    return()=>{window.removeEventListener('scroll',handleScroll);clearInterval(roleInterval);observer.disconnect();document.removeEventListener('mousemove',handleMouse);document.removeEventListener('click',handleAnchorClick);};
  });
</script>

<svelte:head>
  <title>Sarham San — Web Developer</title>
  <meta name="description" content="Sarham San — Web Developer profesional. Membangun website berkualitas tinggi dan aplikasi web modern." />
</svelte:head>

<!-- PRELOADER -->
<div id="preloader" class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-[#050505] transition-opacity duration-700 ease-in-out">
    <div class="absolute inset-y-0 -left-[18%] w-[35%] rounded-full blur-[120px] bg-[radial-gradient(ellipse,_rgba(255,255,255,0.04)_0%,_transparent_70%)] pointer-events-none"></div>
    <div class="absolute inset-y-0 -right-[18%] w-[35%] rounded-full blur-[120px] bg-[radial-gradient(ellipse,_rgba(255,255,255,0.03)_0%,_transparent_70%)] pointer-events-none"></div>
    <div class="relative flex items-center justify-center w-full h-full overflow-hidden">
        <div id="pl-phase-1" class="absolute flex gap-[6px] sm:gap-[10px] text-[15px] sm:text-[18px] text-white/90 tracking-widest pl-text-anim">
            <span class="font-light">Building</span>
            <span class="font-bold">Digital</span>
            <span class="font-light">Experiences</span>
        </div>
        <div id="pl-phase-2" class="absolute text-4xl sm:text-5xl font-logo text-white font-bold pl-reveal-anim">
            <span class="relative z-10 pl-reveal-text">Sarham San</span>
            <div class="pl-reveal-block"></div>
        </div>
    </div>
</div>

<!-- OVERLAY MENU -->
<div id="overlay-menu" bind:this={overlayMenu} class="overlay-menu fixed inset-0 z-[60] bg-[#0a0a0a] flex flex-col justify-between">
    <div class="absolute bottom-0 left-0 right-0 h-1/3 bg-gradient-to-t from-blue-950/15 to-transparent pointer-events-none"></div>
    <div class="relative z-10 flex-1 flex items-center px-8 sm:px-12 lg:px-20">
        <nav class="space-y-3">
            {#each overlayLinks as [num, label, href]}
                <a {href} class="overlay-link flex items-baseline gap-5 group py-1" onclick={closeOverlay}>
                    <span class="text-xs text-white/20 font-medium tabular-nums">{num}</span>
                    <span class="text-5xl sm:text-7xl lg:text-8xl font-extrabold text-white/85 group-hover:text-white group-hover:tracking-wide transition-all duration-300">{label}</span>
                </a>
            {/each}
        </nav>
    </div>
    <div class="relative z-10 flex items-center justify-between px-8 sm:px-12 lg:px-20 py-6 text-xs text-white/20">
        <span>&copy; {currentYear} Sarham San</span>
        <a href="mailto:sarhamsan32@gmail.com" class="hover:text-white/40 transition-colors flex items-center gap-2">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            sarhamsan32@gmail.com
        </a>
    </div>
</div>

<!-- NAVBAR -->
<nav id="navbar" bind:this={navbar} class="fixed top-0 left-0 right-0 z-[70] px-8 sm:px-12 lg:px-16 transition-all duration-300">
    <div class="flex items-center justify-between h-20">
        <a href="./" class="font-logo text-2xl text-white shrink-0">Sarham San</a>
        <div class="hidden md:flex items-center gap-8">
            <a href="#projects" class="nav-link">Proyek</a>
            <a href="#skills" class="nav-link">Skills</a>
            <a href="#about" class="nav-link">Tentang</a>
            <a href="#contact" class="nav-link">Kontak</a>
        </div>
        <button id="menu-toggle" onclick={toggleMenu} class="relative z-[70] w-10 h-10 flex md:hidden flex-col items-center justify-center gap-[6px]" aria-label="Menu">
            <span id="bar1" bind:this={bar1} class="block w-6 h-[1.5px] bg-white transition-all duration-300 origin-center"></span>
            <span id="bar2" bind:this={bar2} class="block w-6 h-[1.5px] bg-white transition-all duration-300 origin-center"></span>
        </button>
    </div>
</nav>

<!-- HERO -->
<section id="hero" class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden">
    <div class="hero-showcase">
        <div class="showcase-rows">
            {#each cols as colUrls}
                <div class="showcase-row">
                    {#each [0, 1] as _r}
                        {#each colUrls as url}
                            <div class="web-card">
                                <div class="web-card-chrome">
                                    <span class="chrome-dot r"></span>
                                    <span class="chrome-dot y"></span>
                                    <span class="chrome-dot g"></span>
                                    <div class="chrome-url"></div>
                                </div>
                                <div class="web-card-body">
                                    {#if showIframes}
                                        <iframe src={url} loading="lazy" sandbox="allow-same-origin" tabindex="-1" title="Preview"></iframe>
                                    {/if}
                                </div>
                            </div>
                        {/each}
                    {/each}
                </div>
            {/each}
        </div>
    </div>

    <div id="parallax-text" bind:this={parallaxText} class="relative z-10 w-full px-8 sm:px-12 lg:px-16 max-w-7xl mx-auto flex flex-col items-start text-left mt-10 lg:mt-20">
        <div class="reveal inline-flex items-center gap-3 px-5 py-2.5 rounded-full border border-white/10 bg-white/[0.03] backdrop-blur-md mb-8 sm:mb-10 shadow-2xl">
            <span class="relative flex h-2.5 w-2.5">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
            </span>
            <span class="text-[10px] sm:text-xs font-bold uppercase tracking-[0.2em] text-white/50">Tersedia untuk Berkolaborasi</span>
        </div>

        <h1 class="reveal text-5xl sm:text-7xl lg:text-[6rem] font-extrabold tracking-[-0.02em] leading-[1.05] mb-8 text-white">
            <span class="text-white/30 block mb-3 text-2xl sm:text-4xl font-medium tracking-normal">Sarham San —</span>
            Merancang <br>
            <span id="role-text" bind:this={roleText} class="text-transparent bg-clip-text bg-gradient-to-r from-white via-white/90 to-white/40 inline-block font-black italic mt-1 pr-4">Web Developer</span>
        </h1>

        <div class="reveal flex flex-col sm:flex-row items-start sm:items-center gap-8 sm:gap-14 mb-16">
            <p class="text-[15px] sm:text-base text-white/40 leading-relaxed max-w-md border-l-2 border-white/20 pl-6 sm:pl-8">
                Mari wujudkan ide bisnis Anda menjadi produk digital kelas atas. Saya merancang website <strong class="text-white/70 font-semibold">tangguh</strong> dengan estetika premium untuk memaksimalkan kredibilitas dan tingkat konversi <em>(ROI)</em> Anda.
            </p>
            <a href="#projects" class="group relative inline-flex items-center justify-center gap-3 px-8 py-4 rounded-full bg-white text-black font-bold text-sm overflow-hidden transition-transform hover:scale-105 active:scale-95 duration-300 shrink-0">
                <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/50 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></span>
                <span>Lihat Portfolio</span>
                <svg class="w-4 h-4 group-hover:rotate-45 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        <div class="reveal flex flex-wrap items-center gap-10 sm:gap-14">
            {#each heroStats as [stat, label]}
                <div class="text-left">
                    <span class="block text-3xl sm:text-4xl font-extrabold">{stat}</span>
                    <span class="text-[11px] sm:text-xs text-white/35 mt-1.5 block tracking-wide">{label}</span>
                </div>
            {/each}
        </div>
    </div>

    <div class="absolute bottom-0 left-0 right-0 border-t border-white/[0.05] py-4 overflow-hidden">
        <div class="marquee-track flex whitespace-nowrap">
            {#each [0, 1, 2] as _i}
                <div class="flex items-center gap-12 mx-8 shrink-0">
                    {#each marqueeItems as tech}
                        <span class="text-xs sm:text-sm text-white/20 font-medium tracking-wide">{tech}</span>
                    {/each}
                </div>
            {/each}
        </div>
    </div>
</section>

    <section id="projects" class="py-28 lg:py-36 dot-grid relative">
        <div class="section-backdrop">
            <!-- Side vignette glows -->
            <div class="edge-glow-left"></div>
            <div class="edge-glow-right"></div>
            <!-- Wireframe cube -->
            <div class="wireframe-shape" style="width:320px;height:320px;top:8%;right:5%;animation:wireframe-rotate 45s linear infinite">
                <svg viewBox="0 0 200 200">
                    <polygon points="60,30 140,30 170,80 170,150 140,180 60,180 30,150 30,80"/>
                    <line x1="60" y1="30" x2="100" y2="100"/>
                    <line x1="140" y1="30" x2="100" y2="100"/>
                    <line x1="170" y1="80" x2="100" y2="100"/>
                    <line x1="170" y1="150" x2="100" y2="100"/>
                    <line x1="140" y1="180" x2="100" y2="100"/>
                    <line x1="60" y1="180" x2="100" y2="100"/>
                    <line x1="30" y1="150" x2="100" y2="100"/>
                    <line x1="30" y1="80" x2="100" y2="100"/>
                </svg>
            </div>
            <!-- Glow orbs -->
            <div class="glow-orb" style="width:500px;height:500px;background:rgba(99,102,241,0.035);top:-15%;right:-10%"></div>
            <div class="glow-orb" style="width:350px;height:350px;background:rgba(139,92,246,0.025);bottom:5%;left:-5%"></div>
            <!-- Dot grid -->
            <div class="ashley-dots"></div>
            <!-- Light streak -->
            <div class="light-streak" style="width:60%;top:35%;left:5%"></div>
        </div>
        <span class="star" style="top:6%;left:4%">✦</span>
        <span class="star" style="top:18%;right:8%">✦</span>
        <span class="star" style="top:60%;right:25%">✦</span>

        <div class="w-full px-8 sm:px-12 lg:px-16 xl:px-24 relative z-10">
            
            <div class="reveal flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-16 lg:mb-20">
                <div>
                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-8 h-px bg-white/15"></div>
                        <span class="text-[11px] text-white/30 uppercase tracking-[0.3em] font-medium">Karya Pilihan</span>
                    </div>
                    <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-[0.95]">
                        Pilihan<br>Website<span class="text-white/30">.</span>
                    </h2>
                </div>
                <div class="max-w-xs">
                    <p class="text-[13px] text-white/35 leading-relaxed">Eksplorasi mahakarya portofolio saya. Setiap proyek diarsiteki dengan orientasi pada <strong class="font-medium text-white/50">tingkat konversi</strong>, keindahan UI, serta struktur <em>scaleable</em> untuk bisnis jangka panjang.</p>
                    <p class="flex items-center gap-2 text-[13px] text-white/50 font-medium mt-4">
                        <svg class="w-4 h-4 text-white/25" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                        Scroll untuk jelajahi
                    </p>
                </div>
            </div>

            
            <div class="stagger grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6">
                
                <div class="project-card group rounded-2xl overflow-hidden bg-[#050505] border border-white/[0.06] flex flex-col hover:border-[#8B5CF6]/30 transition-all duration-500 hover:shadow-[0_15px_40px_-15px_rgba(139,92,246,0.15)] relative">
                    <!-- Abstract Visual Representation -->
                    <div class="h-48 relative overflow-hidden border-b border-white/[0.04] bg-[#080808]">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/10 via-transparent to-transparent opacity-50 group-hover:opacity-100 transition-opacity duration-700 blur-xl"></div>
                        <div class="absolute inset-0 bg-[radial-gradient(circle,_rgba(255,255,255,0.03)_1px,_transparent_1px)]" style="background-size: 16px 16px;"></div>
                        
                        <!-- UI Wireframe -->
                        <div class="absolute top-8 left-1/2 -translate-x-1/2 w-[85%] border border-white/10 rounded-xl bg-[#0a0a0a] shadow-2xl overflow-hidden group-hover:-translate-y-2 transition-transform duration-500">
                            <!-- Window Chrome -->
                            <div class="h-6 border-b border-white/[0.06] flex items-center px-3 gap-1.5 bg-white/[0.01]">
                                <div class="w-2 h-2 rounded-full bg-red-500/30"></div>
                                <div class="w-2 h-2 rounded-full bg-yellow-500/30"></div>
                                <div class="w-2 h-2 rounded-full bg-green-500/30"></div>
                            </div>
                            <div class="p-4 flex gap-4 h-32">
                                <div class="w-1/4 h-full bg-white/[0.03] rounded-lg border border-white/[0.02] flex flex-col gap-2 p-2">
                                    <div class="w-full h-2 bg-white/10 rounded-sm mb-2"></div>
                                    <div class="w-3/4 h-1.5 bg-white/5 rounded-sm"></div>
                                    <div class="w-1/2 h-1.5 bg-white/5 rounded-sm"></div>
                                    <div class="w-2/3 h-1.5 bg-white/5 rounded-sm"></div>
                                </div>
                                <div class="flex-1 flex flex-col gap-3">
                                    <div class="w-full h-8 bg-white/[0.04] rounded-lg border border-white/[0.02]"></div>
                                    <div class="flex gap-2">
                                        <div class="flex-1 h-12 bg-white/[0.02] rounded-lg border border-white/[0.02]"></div>
                                        <div class="flex-1 h-12 bg-white/[0.02] rounded-lg border border-white/[0.02]"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 p-5 sm:p-6 flex flex-col bg-gradient-to-b from-white/[0.02] to-transparent relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[10px] text-white/30 px-2.5 py-1 rounded-full border border-white/[0.08] uppercase tracking-wider font-medium group-hover:border-blue-500/30 group-hover:text-blue-400 transition-colors">Pemerintahan</span>
                            <div class="w-8 h-8 rounded-full bg-white/[0.04] border border-white/[0.06] flex items-center justify-center group-hover:bg-blue-500/10 group-hover:border-blue-500/20 transition-all">
                                <svg class="w-3.5 h-3.5 text-white/40 group-hover:text-blue-400 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                            </div>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold mb-2 group-hover:text-white transition-colors">PPID Sulsel</h3>
                        <p class="text-[13px] text-white/40 leading-relaxed mb-6 flex-1">
                            Website Pejabat Pengelola Informasi dan Dokumentasi (PPID) Provinsi Sulawesi Selatan. Menyediakan layanan informasi publik secara transparan dan akuntabel.
                        </p>
                        <a href="https://ppid-sulselprov.vercel.app/" target="_blank" rel="noopener"
                           class="inline-flex items-center justify-center gap-2 w-full px-5 py-2.5 rounded-xl border border-white/10 text-[13px] font-semibold text-white/60 hover:text-white hover:bg-white/[0.06] hover:border-white/20 transition-all duration-300">
                            Buka Web
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>

                
                <div class="project-card group rounded-2xl overflow-hidden bg-[#050505] border border-white/[0.06] flex flex-col hover:border-orange-500/30 transition-all duration-500 hover:shadow-[0_15px_40px_-15px_rgba(249,115,22,0.15)] relative">
                    <!-- Abstract Visual Representation -->
                    <div class="h-48 relative overflow-hidden border-b border-white/[0.04] bg-[#080808]">
                        <div class="absolute inset-0 bg-gradient-to-tr from-orange-500/10 via-transparent to-transparent opacity-50 group-hover:opacity-100 transition-opacity duration-700 blur-xl"></div>
                        <div class="absolute inset-0 bg-[radial-gradient(circle,_rgba(255,255,255,0.03)_1px,_transparent_1px)]" style="background-size: 16px 16px;"></div>
                        
                        <!-- Mobile UI Wireframes -->
                        <!-- Right Mobile Mockup -->
                        <div class="absolute -bottom-8 right-[10%] w-28 h-44 border border-white/10 rounded-2xl bg-[#0a0a0a] shadow-[0_0_30px_rgba(0,0,0,0.8)] rotate-12 transform origin-bottom-right group-hover:rotate-6 group-hover:-translate-y-3 transition-transform duration-700 flex flex-col p-2.5 z-10 hover:z-20">
                            <!-- Notch -->
                            <div class="w-10 h-1.5 bg-white/10 rounded-full mx-auto mb-3"></div>
                            <!-- Image Placeholder -->
                            <div class="w-full h-16 bg-white/[0.03] rounded-lg mb-2 border border-white/[0.02]"></div>
                            <!-- Lines -->
                            <div class="w-full h-3 bg-white/10 rounded-sm mb-1.5"></div>
                            <div class="w-2/3 h-2 bg-white/5 rounded-sm mb-3"></div>
                            <!-- Button -->
                            <div class="w-full h-6 bg-orange-500/20 rounded-md border border-orange-500/30"></div>
                        </div>

                        <!-- Left Mobile Mockup -->
                        <div class="absolute -bottom-10 left-[15%] w-28 h-44 border border-white/10 rounded-2xl bg-[#0d0d0d] shadow-2xl -rotate-6 transform origin-bottom-left group-hover:-rotate-0 group-hover:-translate-y-1 transition-transform duration-700 flex flex-col p-2.5 opacity-80 group-hover:opacity-100 z-0">
                            <!-- Header -->
                            <div class="flex gap-2 mb-3 items-center">
                                <div class="w-6 h-6 rounded-full bg-white/10"></div>
                                <div class="flex-1 h-3 bg-white/5 rounded-sm"></div>
                            </div>
                            <!-- List -->
                            <div class="flex flex-col gap-2">
                                <div class="w-full h-10 bg-white/[0.02] rounded-lg border border-white/[0.02]"></div>
                                <div class="w-full h-10 bg-white/[0.02] rounded-lg border border-white/[0.02]"></div>
                                <div class="w-full h-10 bg-white/[0.02] rounded-lg border border-white/[0.02]"></div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 p-5 sm:p-6 flex flex-col bg-gradient-to-b from-white/[0.02] to-transparent relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[10px] text-white/30 px-2.5 py-1 rounded-full border border-white/[0.08] uppercase tracking-wider font-medium group-hover:border-orange-500/30 group-hover:text-orange-400 transition-colors">Kantin Digital</span>
                            <div class="w-8 h-8 rounded-full bg-white/[0.04] border border-white/[0.06] flex items-center justify-center group-hover:bg-orange-500/10 group-hover:border-orange-500/20 transition-all">
                                <svg class="w-3.5 h-3.5 text-white/40 group-hover:text-orange-400 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                            </div>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold mb-2 group-hover:text-white transition-colors">Canteeners</h3>
                        <p class="text-[13px] text-white/40 leading-relaxed mb-6 flex-1">
                            Platform kantin digital yang memudahkan pengguna memesan makanan dan minuman secara online dengan sistem yang cepat dan efisien.
                        </p>
                        <a href="https://canteeners.com" target="_blank" rel="noopener"
                           class="inline-flex items-center justify-center gap-2 w-full px-5 py-2.5 rounded-xl border border-white/10 text-[13px] font-semibold text-white/60 hover:text-white hover:bg-white/[0.06] hover:border-white/20 transition-all duration-300">
                            Buka Web
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>

                
                <div class="project-card rounded-2xl overflow-hidden bg-[#050505] border border-dashed border-white/[0.06] hidden lg:flex flex-col h-full opacity-60 hover:opacity-100 transition-opacity duration-300 cursor-not-allowed">
                    <div class="flex-1 flex flex-col items-center justify-center p-8 bg-gradient-to-b from-white/[0.01] to-transparent">
                        <div class="w-14 h-14 rounded-full border border-white/[0.06] bg-white/[0.02] flex items-center justify-center mb-5 mt-4">
                            <svg class="w-5 h-5 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        </div>
                        <h3 class="text-sm font-semibold text-white/40 mb-1.5">Proyek Baru Sedang Dirancang</h3>
                        <p class="text-[10px] text-white/20 uppercase tracking-[0.2em] text-center mb-4">In Development</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="skills" class="py-28 lg:py-36 border-t border-white/[0.05] relative">
        <div class="section-backdrop">
            <!-- Side vignette glows -->
            <div class="edge-glow-left"></div>
            <div class="edge-glow-right"></div>
            <!-- Wireframe hexagonal ring -->
            <div class="wireframe-shape" style="width:280px;height:280px;top:15%;left:3%;animation:wireframe-rotate-reverse 55s linear infinite">
                <svg viewBox="0 0 200 200">
                    <polygon points="100,10 178,45 178,115 100,150 22,115 22,45"/>
                    <polygon points="100,35 155,55 155,105 100,125 45,105 45,55"/>
                    <line x1="100" y1="10" x2="100" y2="35"/>
                    <line x1="178" y1="45" x2="155" y2="55"/>
                    <line x1="178" y1="115" x2="155" y2="105"/>
                    <line x1="100" y1="150" x2="100" y2="125"/>
                    <line x1="22" y1="115" x2="45" y2="105"/>
                    <line x1="22" y1="45" x2="45" y2="55"/>
                </svg>
            </div>
            <!-- Wireframe small triangle -->
            <div class="wireframe-shape" style="width:150px;height:150px;bottom:20%;right:8%;animation:wireframe-float 12s ease-in-out infinite">
                <svg viewBox="0 0 200 200">
                    <polygon points="100,20 180,170 20,170"/>
                    <polygon points="100,60 150,150 50,150"/>
                    <line x1="100" y1="20" x2="100" y2="60"/>
                    <line x1="180" y1="170" x2="150" y2="150"/>
                    <line x1="20" y1="170" x2="50" y2="150"/>
                </svg>
            </div>
            <!-- Glow orbs -->
            <div class="glow-orb" style="width:450px;height:450px;background:rgba(59,130,246,0.025);top:10%;left:40%"></div>
            <div class="glow-orb" style="width:300px;height:300px;background:rgba(168,85,247,0.02);top:0;left:5%"></div>
            <!-- Light streaks -->
            <div class="light-streak" style="width:50%;bottom:30%;right:0"></div>
            <div class="light-streak" style="width:35%;top:20%;left:10%"></div>
        </div>
        <div class="w-full px-8 sm:px-12 lg:px-16 xl:px-24 relative z-10">
            
            <div class="reveal flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-16 lg:mb-20">
                <div>
                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-8 h-px bg-white/15"></div>
                        <span class="text-[11px] text-white/30 uppercase tracking-[0.3em] font-medium">Interaktif</span>
                    </div>
                    <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-[0.95]">
                        Skill<br>Demo<span class="text-white/30">.</span>
                    </h2>
                </div>
                <p class="text-[13px] text-white/35 leading-relaxed max-w-xs">Jangan hanya percaya pada portofolio pasif. Rasakan <em>kehalusan</em> interaksi mikro-komponen di bawah ini sebagai jaminan <strong>standar kualitas</strong> kode yang akan saya sediakan.</p>
            </div>

            
            <div class="stagger grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6">

                
                <a data-sveltekit-reload href="/demo/darkmode" class="project-card group block rounded-2xl bg-[#050505] border border-white/[0.06] overflow-hidden hover:border-indigo-500/30 transition-all duration-500 hover:-translate-y-1 hover:shadow-[0_15px_40px_-15px_rgba(99,102,241,0.15)] relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 blur-xl"></div>
                    <div class="aspect-[16/10] flex items-center justify-center p-8 relative border-b border-white/[0.04]">
                        <div class="absolute inset-0 bg-[radial-gradient(circle,_rgba(255,255,255,0.03)_1px,_transparent_1px)]" style="background-size: 16px 16px;"></div>
                        <div class="flex gap-4 relative z-10">
                            <!-- Dark card -->
                            <div class="w-16 h-24 rounded-lg bg-[#0d0d0d] border border-white/10 p-2.5 group-hover:-translate-y-1 group-hover:-translate-x-1 group-hover:-rotate-3 transition-transform duration-500 shadow-2xl">
                                <div class="w-full h-2 rounded-sm bg-indigo-500/50 mb-1.5"></div>
                                <div class="w-3/4 h-1.5 rounded-sm bg-white/10 mb-1"></div>
                                <div class="w-full h-1.5 rounded-sm bg-white/10 mb-2"></div>
                                <div class="w-8 h-3 rounded-md border border-white/20"></div>
                            </div>
                            <!-- Light card -->
                            <div class="w-16 h-24 rounded-lg bg-gray-100 border border-gray-300 p-2.5 group-hover:translate-y-1 group-hover:translate-x-1 group-hover:rotate-3 transition-transform duration-500 shadow-2xl transform origin-bottom">
                                <div class="w-full h-2 rounded-sm bg-indigo-500/80 mb-1.5"></div>
                                <div class="w-3/4 h-1.5 rounded-sm bg-gray-300 mb-1"></div>
                                <div class="w-full h-1.5 rounded-sm bg-gray-300 mb-2"></div>
                                <div class="w-8 h-3 rounded-md border border-gray-400"></div>
                            </div>
                        </div>
                        <!-- Toggle switch -->
                        <div class="absolute bottom-5 right-5 w-10 h-5 rounded-full bg-white/[0.05] border border-white/10 overflow-hidden group-hover:border-indigo-500/30 transition-colors">
                            <div class="absolute top-0.5 left-0.5 w-4 h-4 rounded-full bg-white/40 group-hover:left-[calc(100%-18px)] group-hover:bg-indigo-400 transition-all duration-500"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-4 bg-gradient-to-b from-white/[0.02] to-transparent relative z-10">
                        <div>
                            <h3 class="text-sm font-semibold text-white/70 group-hover:text-white transition-colors">Dark & Light Mode</h3>
                            <p class="text-[11px] text-white/30 mt-0.5">Toggle tema dinamis</p>
                        </div>
                        <div class="w-8 h-8 rounded-full border border-white/[0.08] flex items-center justify-center group-hover:bg-indigo-500/10 group-hover:border-indigo-500/20 group-hover:text-indigo-400 transition-all text-white/20">
                            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </div>
                </a>

                
                <a data-sveltekit-reload href="/demo/responsive" class="project-card group block rounded-2xl bg-[#050505] border border-white/[0.06] overflow-hidden hover:border-violet-500/30 transition-all duration-500 hover:-translate-y-1 hover:shadow-[0_15px_40px_-15px_rgba(139,92,246,0.15)] relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-violet-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 blur-xl"></div>
                    <div class="aspect-[16/10] flex items-center justify-center p-8 relative border-b border-white/[0.04]">
                        <div class="absolute inset-0 bg-[radial-gradient(circle,_rgba(255,255,255,0.03)_1px,_transparent_1px)]" style="background-size: 16px 16px;"></div>
                        <div class="flex items-end gap-3 relative z-10">
                            <!-- Desktop -->
                            <div class="w-24 h-16 rounded-lg bg-white/[0.03] border border-white/10 p-1.5 shadow-xl group-hover:scale-105 group-hover:-translate-y-1 transition-transform duration-500 relative z-20">
                                <div class="w-full h-full border border-white/5 rounded-sm flex flex-col gap-1 p-1">
                                    <div class="w-full h-1 bg-white/10 rounded-full"></div>
                                    <div class="flex gap-1 flex-1">
                                        <div class="w-1/3 bg-white/5 rounded-sm"></div>
                                        <div class="flex-1 bg-white/5 rounded-sm"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Tablet -->
                            <div class="w-12 h-16 rounded-lg bg-[#0a0a0a] border border-white/20 p-1 shadow-2xl group-hover:-translate-x-2 group-hover:translate-y-1 group-hover:rotate-[-5deg] transition-transform duration-500 relative z-30">
                                <div class="w-full h-full border border-white/5 rounded-sm flex flex-col gap-1 p-1">
                                    <div class="w-full h-1 bg-white/10 rounded-full"></div>
                                    <div class="flex-1 bg-white/5 rounded-sm"></div>
                                </div>
                            </div>
                            <!-- Mobile -->
                            <div class="w-8 h-12 rounded-md bg-[#111] border border-white/30 p-0.5 shadow-2xl group-hover:-translate-x-4 group-hover:translate-y-2 group-hover:rotate-[10deg] transition-transform duration-500 relative z-40">
                                <div class="w-full h-full border border-white/5 flex flex-col gap-0.5 p-0.5">
                                    <div class="w-full h-0.5 bg-white/20 rounded-full"></div>
                                    <div class="flex-1 bg-white/10 rounded-sm"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-4 bg-gradient-to-b from-white/[0.02] to-transparent relative z-10">
                        <div>
                            <h3 class="text-sm font-semibold text-white/70 group-hover:text-white transition-colors">Responsive Design</h3>
                            <p class="text-[11px] text-white/30 mt-0.5">Adaptif di semua layar</p>
                        </div>
                        <div class="w-8 h-8 rounded-full border border-white/[0.08] flex items-center justify-center group-hover:bg-violet-500/10 group-hover:border-violet-500/20 group-hover:text-violet-400 transition-all text-white/20">
                            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </div>
                </a>

                
                <a data-sveltekit-reload href="/demo/form-validation" class="project-card group block rounded-2xl bg-[#050505] border border-white/[0.06] overflow-hidden hover:border-emerald-500/30 transition-all duration-500 hover:-translate-y-1 hover:shadow-[0_15px_40px_-15px_rgba(16,185,129,0.15)] relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 blur-xl"></div>
                    <div class="aspect-[16/10] flex items-center justify-center p-8 relative border-b border-white/[0.04]">
                        <div class="absolute inset-0 bg-[radial-gradient(circle,_rgba(255,255,255,0.03)_1px,_transparent_1px)]" style="background-size: 16px 16px;"></div>
                        <div class="w-full max-w-[160px] space-y-3 relative z-10 -rotate-2 group-hover:rotate-0 transition-transform duration-500">
                            <!-- Valid field -->
                            <div class="h-8 rounded-lg bg-white/[0.02] border border-emerald-500/30 flex items-center px-3 justify-between shadow-lg group-hover:translate-x-1 transition-transform">
                                <div class="w-16 h-1.5 rounded-sm bg-white/20"></div>
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <!-- Invalid field -->
                            <div class="h-8 rounded-lg bg-white/[0.02] border border-red-500/30 flex items-center px-3 justify-between shadow-lg group-hover:-translate-x-1 transition-transform">
                                <div class="w-8 h-1.5 rounded-sm bg-white/20"></div>
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </div>
                            <!-- Typing field -->
                            <div class="h-8 rounded-lg bg-white/[0.02] border border-white/10 flex items-center px-3 shadow-lg group-hover:border-blue-500/30 transition-colors">
                                <div class="w-0.5 h-3 bg-white/40 animate-pulse"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-4 bg-gradient-to-b from-white/[0.02] to-transparent relative z-10">
                        <div>
                            <h3 class="text-sm font-semibold text-white/70 group-hover:text-white transition-colors">Form Validation</h3>
                            <p class="text-[11px] text-white/30 mt-0.5">Interaktif & live feedback</p>
                        </div>
                        <div class="w-8 h-8 rounded-full border border-white/[0.08] flex items-center justify-center group-hover:bg-emerald-500/10 group-hover:border-emerald-500/20 group-hover:text-emerald-400 transition-all text-white/20">
                            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </div>
                </a>

                
                <a data-sveltekit-reload href="/demo/api-fetch" class="project-card group block rounded-2xl bg-[#050505] border border-white/[0.06] overflow-hidden hover:border-cyan-500/30 transition-all duration-500 hover:-translate-y-1 hover:shadow-[0_15px_40px_-15px_rgba(6,182,212,0.15)] relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 blur-xl"></div>
                    <div class="aspect-[16/10] flex items-center justify-center p-8 relative border-b border-white/[0.04] overflow-hidden">
                        <div class="absolute inset-0 bg-[radial-gradient(circle,_rgba(255,255,255,0.03)_1px,_transparent_1px)]" style="background-size: 16px 16px;"></div>
                        <!-- Abstract Data Streams -->
                        <div class="flex gap-2 relative z-10">
                            <!-- Column 1 -->
                            <div class="flex flex-col gap-2 translate-y-4 group-hover:-translate-y-2 transition-transform duration-700 ease-in-out">
                                <div class="w-12 h-6 rounded-md bg-white/[0.05] border border-white/[0.08]"></div>
                                <div class="w-12 h-10 rounded-md bg-cyan-500/20 border border-cyan-500/30 shadow-[0_0_15px_rgba(6,182,212,0.3)]"></div>
                                <div class="w-12 h-6 rounded-md bg-white/[0.05] border border-white/[0.08]"></div>
                            </div>
                            <!-- Column 2 -->
                            <div class="flex flex-col gap-2 -translate-y-2 group-hover:translate-y-2 transition-transform duration-500 delay-75 ease-in-out">
                                <div class="w-12 h-8 rounded-md bg-white/[0.05] border border-white/[0.08]"></div>
                                <div class="w-12 h-6 rounded-md bg-white/[0.05] border border-white/[0.08]"></div>
                                <div class="w-12 h-8 rounded-md bg-white/[0.05] border border-white/[0.08]"></div>
                            </div>
                            <!-- Column 3 -->
                            <div class="flex flex-col gap-2 translate-y-2 group-hover:-translate-y-4 transition-transform duration-700 delay-150 ease-in-out">
                                <div class="w-12 h-6 rounded-md bg-cyan-500/10 border border-cyan-500/20"></div>
                                <div class="w-12 h-6 rounded-md bg-white/[0.05] border border-white/[0.08]"></div>
                                <div class="w-12 h-10 rounded-md bg-white/[0.05] border border-white/[0.08]"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-4 bg-gradient-to-b from-white/[0.02] to-transparent relative z-10">
                        <div>
                            <h3 class="text-sm font-semibold text-white/70 group-hover:text-white transition-colors">API & Fetching</h3>
                            <p class="text-[11px] text-white/30 mt-0.5">Manipulasi data async</p>
                        </div>
                        <div class="w-8 h-8 rounded-full border border-white/[0.08] flex items-center justify-center group-hover:bg-cyan-500/10 group-hover:border-cyan-500/20 group-hover:text-cyan-400 transition-all text-white/20">
                            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </div>
                </a>

                
                <a data-sveltekit-reload href="/demo/drag-drop" class="project-card group block rounded-2xl bg-[#050505] border border-white/[0.06] overflow-hidden hover:border-pink-500/30 transition-all duration-500 hover:-translate-y-1 hover:shadow-[0_15px_40px_-15px_rgba(236,72,153,0.15)] relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-pink-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 blur-xl"></div>
                    <div class="aspect-[16/10] flex items-center justify-center p-8 relative border-b border-white/[0.04]">
                        <div class="absolute inset-0 bg-[radial-gradient(circle,_rgba(255,255,255,0.03)_1px,_transparent_1px)]" style="background-size: 16px 16px;"></div>
                        <!-- Kanban / Drag Layout -->
                        <div class="flex gap-4 w-full h-full p-2 relative z-10">
                            <!-- Column 1 -->
                            <div class="flex-1 border border-white/5 bg-white/[0.01] rounded-lg p-1.5 flex flex-col gap-2">
                                <div class="w-full h-6 rounded bg-white/[0.05]"></div>
                                <!-- Draggable block -->
                                <div class="w-full h-8 rounded bg-pink-500/20 border border-pink-500/30 shadow-[0_0_15px_rgba(236,72,153,0.3)] group-hover:rotate-6 group-hover:translate-x-[110%] group-hover:-translate-y-2 transition-all duration-700 z-10 cursor-grab"></div>
                            </div>
                            <!-- Column 2 -->
                            <div class="flex-1 border border-white/5 bg-white/[0.01] rounded-lg p-1.5 flex flex-col gap-2">
                                <div class="w-full h-6 rounded bg-white/[0.05]"></div>
                                <!-- Drop target placeholder -->
                                <div class="w-full h-8 rounded border border-dashed border-white/20"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-4 bg-gradient-to-b from-white/[0.02] to-transparent relative z-10">
                        <div>
                            <h3 class="text-sm font-semibold text-white/70 group-hover:text-white transition-colors">Drag & Drop UI</h3>
                            <p class="text-[11px] text-white/30 mt-0.5">Interaktivitas mouse event</p>
                        </div>
                        <div class="w-8 h-8 rounded-full border border-white/[0.08] flex items-center justify-center group-hover:bg-pink-500/10 group-hover:border-pink-500/20 group-hover:text-pink-400 transition-all text-white/20">
                            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </div>
                </a>

                
                <a data-sveltekit-reload href="/demo/animations" class="project-card group block rounded-2xl bg-[#050505] border border-white/[0.06] overflow-hidden hover:border-yellow-500/30 transition-all duration-500 hover:-translate-y-1 hover:shadow-[0_15px_40px_-15px_rgba(234,179,8,0.15)] relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 blur-xl"></div>
                    <div class="aspect-[16/10] flex items-center justify-center p-8 relative border-b border-white/[0.04]">
                        <div class="absolute inset-0 bg-[radial-gradient(circle,_rgba(255,255,255,0.03)_1px,_transparent_1px)]" style="background-size: 16px 16px;"></div>
                        <!-- Abstract Animation -->
                        <div class="relative w-16 h-16 z-10">
                            <!-- Outer pulsing ring -->
                            <div class="absolute inset-0 rounded-full border border-yellow-500/50 group-hover:scale-150 group-hover:opacity-0 transition-all duration-1000 ease-out"></div>
                            <!-- Middle rotating square -->
                            <div class="absolute inset-2 border border-white/20 group-hover:rotate-180 transition-transform duration-1000 bg-yellow-500/10 backdrop-blur-sm"></div>
                            <!-- Center dot -->
                            <div class="absolute inset-6 rounded-full bg-white/50 group-hover:bg-yellow-400 group-hover:shadow-[0_0_15px_rgba(234,179,8,1)] transition-colors duration-500"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-4 bg-gradient-to-b from-white/[0.02] to-transparent relative z-10">
                        <div>
                            <h3 class="text-sm font-semibold text-white/70 group-hover:text-white transition-colors">Web Animations</h3>
                            <p class="text-[11px] text-white/30 mt-0.5">Transisi & keyframes halus</p>
                        </div>
                        <div class="w-8 h-8 rounded-full border border-white/[0.08] flex items-center justify-center group-hover:bg-yellow-500/10 group-hover:border-yellow-500/20 group-hover:text-yellow-400 transition-all text-white/20">
                            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </div>
                </a>

                
                <a data-sveltekit-reload href="/demo/charts" class="project-card hidden-demo hidden group rounded-2xl bg-[#050505] border border-white/[0.06] overflow-hidden hover:border-blue-500/30 transition-all duration-500 hover:-translate-y-1 hover:shadow-[0_15px_40px_-15px_rgba(59,130,246,0.15)] relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 blur-xl"></div>
                    <div class="aspect-[16/10] flex items-center justify-center p-8 relative border-b border-white/[0.04]">
                        <div class="absolute inset-0 bg-[radial-gradient(circle,_rgba(255,255,255,0.03)_1px,_transparent_1px)]" style="background-size: 16px 16px;"></div>
                        <!-- Abstract Chart -->
                        <div class="flex items-end gap-2 h-16 relative z-10 w-full max-w-[120px]">
                            <div class="w-1/4 bg-blue-500/20 rounded-t-sm border-t border-blue-500/30 h-[40%] group-hover:h-[60%] transition-all duration-700"></div>
                            <div class="w-1/4 bg-white/10 rounded-t-sm border-t border-white/20 h-[70%] group-hover:h-[40%] transition-all duration-700"></div>
                            <div class="w-1/4 bg-blue-500/60 rounded-t-sm border-t border-blue-400 h-[30%] group-hover:h-[90%] transition-all duration-700 shadow-[0_0_15px_rgba(59,130,246,0.4)]"></div>
                            <div class="w-1/4 bg-white/5 rounded-t-sm border-t border-white/10 h-[50%] group-hover:h-[20%] transition-all duration-700"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-4 bg-gradient-to-b from-white/[0.02] to-transparent relative z-10">
                        <div>
                            <h3 class="text-sm font-semibold text-white/70 group-hover:text-white transition-colors">Data Visualization</h3>
                            <p class="text-[11px] text-white/30 mt-0.5">Grafik interaktif & analitik</p>
                        </div>
                        <div class="w-8 h-8 rounded-full border border-white/[0.08] flex items-center justify-center group-hover:bg-blue-500/10 group-hover:border-blue-500/20 group-hover:text-blue-400 transition-all text-white/20">
                            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </div>
                </a>

                
                <a data-sveltekit-reload href="/demo/chat" class="project-card hidden-demo hidden group rounded-2xl bg-[#050505] border border-white/[0.06] overflow-hidden hover:border-teal-500/30 transition-all duration-500 hover:-translate-y-1 hover:shadow-[0_15px_40px_-15px_rgba(20,184,166,0.15)] relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-teal-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 blur-xl"></div>
                    <div class="aspect-[16/10] flex flex-col justify-end p-6 relative border-b border-white/[0.04]">
                        <div class="absolute inset-0 bg-[radial-gradient(circle,_rgba(255,255,255,0.03)_1px,_transparent_1px)]" style="background-size: 16px 16px;"></div>
                        <!-- Chat bubbles -->
                        <div class="w-full flex flex-col gap-2 relative z-10 mt-auto">
                            <div class="self-start max-w-[80%] px-3 py-2 rounded-2xl rounded-tl-sm bg-white/[0.05] border border-white/10 group-hover:-translate-y-1 transition-transform duration-500">
                                <div class="w-16 h-1.5 bg-white/20 rounded-full mb-1"></div>
                                <div class="w-24 h-1.5 bg-white/10 rounded-full"></div>
                            </div>
                            <div class="self-end max-w-[80%] px-3 py-2 rounded-2xl rounded-tr-sm bg-teal-500/20 border border-teal-500/30 group-hover:-translate-y-2 transition-transform duration-500 delay-75 shadow-[0_0_15px_rgba(20,184,166,0.2)]">
                                <div class="w-20 h-1.5 bg-teal-200/50 rounded-full mb-1"></div>
                                <div class="w-12 h-1.5 bg-teal-200/30 rounded-full"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-4 bg-gradient-to-b from-white/[0.02] to-transparent relative z-10">
                        <div>
                            <h3 class="text-sm font-semibold text-white/70 group-hover:text-white transition-colors">Chat Interface</h3>
                            <p class="text-[11px] text-white/30 mt-0.5">Simulasi messenger</p>
                        </div>
                        <div class="w-8 h-8 rounded-full border border-white/[0.08] flex items-center justify-center group-hover:bg-teal-500/10 group-hover:border-teal-500/20 group-hover:text-teal-400 transition-all text-white/20">
                            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </div>
                </a>

                
                <a data-sveltekit-reload href="/demo/image-filters" class="project-card hidden-demo hidden group rounded-2xl bg-[#050505] border border-white/[0.06] overflow-hidden hover:border-purple-500/30 transition-all duration-500 hover:-translate-y-1 hover:shadow-[0_15px_40px_-15px_rgba(168,85,247,0.15)] relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 blur-xl"></div>
                    <div class="aspect-[16/10] flex items-center justify-center p-8 relative border-b border-white/[0.04]">
                        <div class="absolute inset-0 bg-[radial-gradient(circle,_rgba(255,255,255,0.03)_1px,_transparent_1px)]" style="background-size: 16px 16px;"></div>
                        <!-- Split image effect -->
                        <div class="w-24 h-16 relative z-10 rounded-lg overflow-hidden border border-white/10 shadow-xl group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-br from-gray-700 to-gray-900"></div>
                            <div class="absolute inset-y-0 left-0 w-1/2 bg-gradient-to-br from-purple-400 to-pink-600 mix-blend-color group-hover:w-full transition-all duration-1000"></div>
                            <!-- Separator line -->
                            <div class="absolute top-0 bottom-0 left-1/2 w-[1px] bg-white text-white group-hover:left-full transition-all duration-1000 shadow-[0_0_5px_rgba(255,255,255,0.8)]"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-4 bg-gradient-to-b from-white/[0.02] to-transparent relative z-10">
                        <div>
                            <h3 class="text-sm font-semibold text-white/70 group-hover:text-white transition-colors">Image Processing</h3>
                            <p class="text-[11px] text-white/30 mt-0.5">Filter CSS & manipulasi kanvas</p>
                        </div>
                        <div class="w-8 h-8 rounded-full border border-white/[0.08] flex items-center justify-center group-hover:bg-purple-500/10 group-hover:border-purple-500/20 group-hover:text-purple-400 transition-all text-white/20">
                            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </div>
                </a>

                
                <a data-sveltekit-reload href="/demo/cart" class="project-card hidden-demo hidden group rounded-2xl bg-[#050505] border border-white/[0.06] overflow-hidden hover:border-orange-500/30 transition-all duration-500 hover:-translate-y-1 hover:shadow-[0_15px_40px_-15px_rgba(249,115,22,0.15)] relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 blur-xl"></div>
                    <div class="aspect-[16/10] flex items-center justify-center p-8 relative border-b border-white/[0.04]">
                        <div class="absolute inset-0 bg-[radial-gradient(circle,_rgba(255,255,255,0.03)_1px,_transparent_1px)]" style="background-size: 16px 16px;"></div>
                        <!-- Cart Icon -->
                        <div class="relative z-10">
                            <div class="w-12 h-12 rounded-xl bg-white/[0.02] border border-white/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-500 shadow-xl">
                                <svg class="w-6 h-6 text-white/50 group-hover:text-orange-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            </div>
                            <div class="absolute -top-2 -right-2 w-5 h-5 rounded-full bg-orange-500 border border-[#050505] flex items-center justify-center text-[10px] font-bold text-black translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 delay-100">
                                3
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-4 bg-gradient-to-b from-white/[0.02] to-transparent relative z-10">
                        <div>
                            <h3 class="text-sm font-semibold text-white/70 group-hover:text-white transition-colors">Global State / Cart</h3>
                            <p class="text-[11px] text-white/30 mt-0.5">Manajemen keranjang belanja</p>
                        </div>
                        <div class="w-8 h-8 rounded-full border border-white/[0.08] flex items-center justify-center group-hover:bg-orange-500/10 group-hover:border-orange-500/20 group-hover:text-orange-400 transition-all text-white/20">
                            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </div>
                </a>

                
                <a data-sveltekit-reload href="/demo/multistep-form" class="project-card hidden-demo hidden group rounded-2xl bg-[#050505] border border-white/[0.06] overflow-hidden hover:border-lime-500/30 transition-all duration-500 hover:-translate-y-1 hover:shadow-[0_15px_40px_-15px_rgba(132,204,22,0.15)] relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-lime-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 blur-xl"></div>
                    <div class="aspect-[16/10] flex items-center justify-center p-8 relative border-b border-white/[0.04]">
                        <div class="absolute inset-0 bg-[radial-gradient(circle,_rgba(255,255,255,0.03)_1px,_transparent_1px)]" style="background-size: 16px 16px;"></div>
                        <!-- Progress Steps -->
                        <div class="w-full max-w-[140px] flex items-center justify-between relative z-10 group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-1/2 left-0 right-0 h-[1px] bg-white/10 -translate-y-1/2 z-0"></div>
                            <div class="absolute top-1/2 left-0 w-1/2 h-[1px] bg-lime-500 -translate-y-1/2 z-0 group-hover:w-full transition-all duration-1000"></div>
                            
                            <div class="w-4 h-4 rounded-full bg-lime-500 shadow-[0_0_10px_rgba(132,204,22,0.5)] z-10"></div>
                            <div class="w-4 h-4 rounded-full bg-lime-500 shadow-[0_0_10px_rgba(132,204,22,0.5)] z-10 transition-colors duration-500 delay-300"></div>
                            <div class="w-4 h-4 rounded-full bg-[#050505] border border-white/20 z-10 group-hover:bg-lime-500 group-hover:border-lime-500 group-hover:shadow-[0_0_10px_rgba(132,204,22,0.5)] transition-all duration-500 delay-700"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-4 bg-gradient-to-b from-white/[0.02] to-transparent relative z-10">
                        <div>
                            <h3 class="text-sm font-semibold text-white/70 group-hover:text-white transition-colors">Multi-step Form</h3>
                            <p class="text-[11px] text-white/30 mt-0.5">Wizard & progress indicator</p>
                        </div>
                        <div class="w-8 h-8 rounded-full border border-white/[0.08] flex items-center justify-center group-hover:bg-lime-500/10 group-hover:border-lime-500/20 group-hover:text-lime-400 transition-all text-white/20">
                            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </div>
                </a>

                
                <a data-sveltekit-reload href="/demo/skeleton" class="project-card hidden-demo hidden group rounded-2xl bg-[#050505] border border-white/[0.06] overflow-hidden hover:border-gray-400/30 transition-all duration-500 hover:-translate-y-1 hover:shadow-[0_15px_40px_-15px_rgba(156,163,175,0.15)] relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-gray-500/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 blur-xl"></div>
                    <div class="aspect-[16/10] flex items-center justify-center p-8 relative border-b border-white/[0.04]">
                        <div class="absolute inset-0 bg-[radial-gradient(circle,_rgba(255,255,255,0.03)_1px,_transparent_1px)]" style="background-size: 16px 16px;"></div>
                        <!-- Skeletons -->
                        <div class="w-full max-w-[160px] flex gap-3 relative z-10">
                            <div class="w-10 h-10 rounded-full bg-white/5 group-hover:bg-white/10 transition-colors duration-1000 overflow-hidden relative">
                                <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/10 to-transparent group-hover:animate-[shimmer_1.5s_infinite]"></div>
                            </div>
                            <div class="flex-1 space-y-2 py-1">
                                <div class="h-3 w-3/4 rounded-sm bg-white/5 group-hover:bg-white/10 transition-colors duration-1000 overflow-hidden relative">
                                    <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/10 to-transparent group-hover:animate-[shimmer_1.5s_infinite]"></div>
                                </div>
                                <div class="h-3 w-1/2 rounded-sm bg-white/5 group-hover:bg-white/10 transition-colors duration-1000 overflow-hidden relative">
                                    <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/10 to-transparent group-hover:animate-[shimmer_1.5s_infinite]"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-4 bg-gradient-to-b from-white/[0.02] to-transparent relative z-10">
                        <div>
                            <h3 class="text-sm font-semibold text-white/70 group-hover:text-white transition-colors">Skeleton Loading</h3>
                            <p class="text-[11px] text-white/30 mt-0.5">Shimmer effect & placeholder</p>
                        </div>
                        <div class="w-8 h-8 rounded-full border border-white/[0.08] flex items-center justify-center group-hover:bg-gray-400/10 group-hover:border-gray-500/20 group-hover:text-gray-300 transition-all text-white/20">
                            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </div>
                </a>

            </div>

            <!-- View All Toggle Button -->
            <div class="mt-12 flex justify-center w-full z-20 relative">
                <button id="btn-toggle-demos" onclick={toggleDemos} class="group relative px-6 py-3 rounded-full bg-white/[0.02] border border-white/[0.08] hover:bg-white/[0.05] hover:border-white/20 transition-all duration-300 flex items-center gap-3">
                    <span id="btn-toggle-text" class="text-[13px] font-semibold text-white/70 tracking-wide uppercase group-hover:text-white transition-colors">{isExpanded ? "Sembunyikan Sebagian" : "Lihat Semua Demo (12)"}</span>
                    <svg id="btn-toggle-icon" class="w-4 h-4 text-white/40 group-hover:text-white transition-transform duration-300" style:transform={isExpanded ? "rotate(180deg)" : "rotate(0deg)"} fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
            </div>

            
        </div>
    </section>
    <section id="about" class="py-28 lg:py-36 border-t border-white/[0.05] relative">
        <div class="section-backdrop">
            <!-- Side vignette glows -->
            <div class="edge-glow-left"></div>
            <div class="edge-glow-right"></div>
            <!-- Wireframe diamond -->
            <div class="wireframe-shape" style="width:260px;height:260px;top:5%;right:12%;animation:wireframe-float 15s ease-in-out infinite">
                <svg viewBox="0 0 200 200">
                    <polygon points="100,10 190,100 100,190 10,100"/>
                    <polygon points="100,40 160,100 100,160 40,100"/>
                    <line x1="100" y1="10" x2="100" y2="40"/>
                    <line x1="190" y1="100" x2="160" y2="100"/>
                    <line x1="100" y1="190" x2="100" y2="160"/>
                    <line x1="10" y1="100" x2="40" y2="100"/>
                    <line x1="100" y1="10" x2="190" y2="100"/>
                    <line x1="10" y1="100" x2="100" y2="190"/>
                </svg>
            </div>
            <!-- Glow orbs -->
            <div class="glow-orb" style="width:400px;height:400px;background:rgba(79,70,229,0.03);top:-10%;left:15%"></div>
            <div class="glow-orb" style="width:350px;height:350px;background:rgba(139,92,246,0.02);bottom:-5%;right:5%"></div>
            <!-- Dot grid -->
            <div class="ashley-dots"></div>
            <!-- Light streak -->
            <div class="light-streak" style="width:55%;top:55%;left:20%"></div>
        </div>
        <div class="w-full px-8 sm:px-12 lg:px-16 xl:px-24">
            <div class="reveal flex items-center gap-4 mb-5">
                <div class="w-8 h-px bg-white/15"></div>
                <span class="text-[11px] text-white/30 uppercase tracking-[0.3em] font-medium">Tentang Saya</span>
            </div>

            <div class="grid lg:grid-cols-2 gap-16 lg:gap-20">
                
                <div class="reveal">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight mb-8">
                        Arsitek Produk<br>Digital Berdampak<span class="text-white/30">.</span>
                    </h2>
                    <div class="space-y-5 text-[15px] text-white/40 leading-[1.8]">
                        <p>
                            Saya tidak sekadar menulis baris kode—saya merancang <strong class="text-white/75 font-semibold">investasi digital jangka panjang</strong> untuk bisnis Anda. Sebagai Full-Stack Developer, tugas utama saya adalah mengotomatisasi proses bisnis yang rumit menjadi sistem web antar-perusahaan lintas platform yang efisien, super aman, dan siap berekspansi seiring lonjakan audiens dan transaksi Anda.
                        </p>
                        <p>
                            Dengan menyatukan keahlian intuisi desain <strong class="text-white/75 font-semibold">UI/UX mewah</strong> di Figma dan fondasi rancangan <em>backend</em> skala enterprise menggunakan <strong class="text-white/75 font-semibold">Laravel</strong>, saya menjamin setiap sentuhan interaksi pelanggan (*Customer Journey*) di web Anda dirancang penuh metodologi psikologi marketing untuk melipatgandakan <strong class="text-white/75 font-semibold">engagement dan persentase konversi (penjualan)</strong>.
                        </p>
                        <p>
                            Berbekal visi memajukan industri web tanah air, mulai dari arsitektur platform <em>e-commerce</em> yang canggih hingga aplikasi manajemen internal instansi eksklusif, komitmen dasar saya selalu satu: Membangun solusi teknologi elegan yang <em>zero-friction</em>, memecahkan seluruh masalah kompleks operasional, hingga mencetak keuntungan finansial nyata (*ROI*) tiada tara bagi organisasi Anda.
                        </p>
                    </div>
                </div>

                
                <div class="reveal">
                    <h3 class="text-[11px] text-white/30 uppercase tracking-[0.3em] font-medium mb-8">Tech Stack</h3>
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-3">
                        {#each techs as tech, index}
                            <div class="group relative p-4 rounded-2xl bg-white/[0.02] border border-white/[0.05] hover:bg-white/[0.04] hover:border-[#8B5CF6]/40 transition-all duration-500 overflow-hidden hover:-translate-y-1 hover:shadow-[0_8px_24px_rgba(139,92,246,0.12)] flex flex-col h-[100px] justify-between">
                                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-700 bg-gradient-to-br from-[#6366F1]/10 via-transparent to-[#8B5CF6]/10 blur-xl"></div>
                                <div class="absolute -right-2 -top-2 w-16 h-16 opacity-10 group-hover:opacity-30 transition-opacity duration-500 pointer-events-none">
                                    <svg viewBox="0 0 100 100" class="w-full h-full text-white group-hover:text-[#A58CFF] transition-colors" fill="none" stroke="currentColor" stroke-width="1.5">
                                    {#if index % 3 === 0}
                                        <circle cx="80" cy="20" r="25" stroke-dasharray="4 4" />
                                    {:else if index % 3 === 1}
                                        <rect x="60" y="0" width="30" height="30" transform="rotate(25 75 15)" />
                                    {:else}
                                        <polygon points="90,0 90,45 45,0" fill="currentColor" fill-opacity="0.05" stroke="none" />
                                    {/if}
                                    </svg>
                                </div>
                                <div class="relative z-10 w-8 h-8 rounded-lg bg-white/[0.03] border border-white/[0.08] flex items-center justify-center group-hover:bg-[#8B5CF6]/20 group-hover:border-[#8B5CF6]/40 transition-all duration-500 shadow-sm">
                                    <span class="text-[10px] font-mono font-bold text-white/50 group-hover:text-[#A58CFF] transition-colors uppercase">
                                        {tech.replace(/[ \/]/g, '').substring(0, 2)}
                                    </span>
                                </div>
                                <div class="relative z-10 flex items-center justify-between mt-auto">
                                    <span class="text-[13px] text-white/70 group-hover:text-white transition-colors font-semibold tracking-wide">{tech}</span>
                                    <div class="w-1.5 h-1.5 rounded-full bg-white/10 group-hover:bg-[#A58CFF] group-hover:shadow-[0_0_8px_rgba(165,140,255,0.8)] transition-all duration-500 scale-50 group-hover:scale-100"></div>
                                </div>
                            </div>
                        {/each}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="contact" class="py-28 lg:py-36 border-t border-white/[0.05] dot-grid relative">
        <div class="section-backdrop">
            <!-- Side vignette glows -->
            <div class="edge-glow-left"></div>
            <div class="edge-glow-right"></div>
            <!-- Wireframe octagon / star -->
            <div class="wireframe-shape" style="width:300px;height:300px;bottom:10%;left:5%;animation:wireframe-rotate 60s linear infinite">
                <svg viewBox="0 0 200 200">
                    <polygon points="70,20 130,20 170,60 170,140 130,180 70,180 30,140 30,60"/>
                    <circle cx="100" cy="100" r="55"/>
                    <line x1="70" y1="20" x2="100" y2="45"/>
                    <line x1="130" y1="20" x2="100" y2="45"/>
                    <line x1="170" y1="60" x2="155" y2="100"/>
                    <line x1="170" y1="140" x2="155" y2="100"/>
                    <line x1="130" y1="180" x2="100" y2="155"/>
                    <line x1="70" y1="180" x2="100" y2="155"/>
                    <line x1="30" y1="140" x2="45" y2="100"/>
                    <line x1="30" y1="60" x2="45" y2="100"/>
                </svg>
            </div>
            <!-- Wireframe small diamond -->
            <div class="wireframe-shape" style="width:120px;height:120px;top:15%;right:15%;animation:wireframe-rotate-reverse 40s linear infinite">
                <svg viewBox="0 0 200 200">
                    <polygon points="100,10 190,100 100,190 10,100"/>
                    <line x1="100" y1="10" x2="100" y2="190"/>
                    <line x1="10" y1="100" x2="190" y2="100"/>
                </svg>
            </div>
            <!-- Glow orbs -->
            <div class="glow-orb" style="width:450px;height:450px;background:rgba(99,102,241,0.035);top:5%;right:-8%"></div>
            <div class="glow-orb" style="width:300px;height:300px;background:rgba(59,130,246,0.025);bottom:0;left:10%"></div>
            <!-- Dot grid -->
            <div class="ashley-dots"></div>
            <!-- Light streak -->
            <div class="light-streak" style="width:45%;top:25%;left:30%"></div>
        </div>
        <span class="star" style="top:12%;left:8%">✦</span>
        <span class="star" style="top:45%;right:12%">·</span>
        <span class="star" style="bottom:18%;left:30%">✦</span>

        <div class="w-full px-8 sm:px-12 lg:px-16 xl:px-24 relative z-10">
            <div class="reveal max-w-6xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <!-- Left: Text and CTA -->
                    <div class="text-center lg:text-left">
                        <div class="flex items-center gap-4 justify-center lg:justify-start mb-6">
                            <div class="w-8 h-px bg-white/15"></div>
                            <span class="text-[11px] text-white/30 uppercase tracking-[0.3em] font-medium">Bekerja Sama</span>
                        </div>
                        <h2 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-extrabold leading-[1.1] mb-6">
                            Mari<br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 filter drop-shadow-[0_0_20px_rgba(168,85,247,0.4)]">Kolaborasi</span><span class="text-white/30">.</span>
                        </h2>
                        <p class="text-[15px] sm:text-base text-white/40 leading-relaxed mb-10 max-w-md mx-auto lg:mx-0">
                            Jangan biarkan gagasan raksasa bisnis Anda cuma tertahan. Mari kita jadwalkan diskusi eksklusif gratis sejenak untuk menemukan rancangan strategi teknologi paling jitu guna meroketkan kepemimpinan dan valuasi pasar usaha Anda!
                        </p>
                        <div class="flex items-center justify-center lg:justify-start gap-4">
                            <!-- Status indicator -->
                            <div class="flex items-center gap-3 px-5 py-2.5 rounded-full bg-white/[0.03] border border-white/10 w-fit backdrop-blur-md">
                                <span class="relative flex h-2.5 w-2.5">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75 shadow-[0_0_10px_rgba(52,211,153,0.8)]"></span>
                                  <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500 shadow-[0_0_10px_rgba(52,211,153,0.8)]"></span>
                                </span>
                                <span class="text-xs font-semibold text-white/80 tracking-wide uppercase">Tersedia untuk Freelance</span>
                            </div>
                        </div>
                    </div>
        
                    <!-- Right: Contact Cards (Bento-Grid) -->
                    <div class="grid sm:grid-cols-2 gap-4">
                        <!-- Email Card -->
                        <a href="mailto:sarhamsan32@gmail.com" class="group p-6 rounded-3xl bg-white/[0.02] border border-white/[0.05] hover:bg-white/[0.04] hover:border-blue-500/40 transition-all duration-500 hover:-translate-y-1 relative overflow-hidden flex flex-col items-start shadow-[0_15px_40px_-15px_rgba(0,0,0,0.5)] hover:shadow-[0_15px_40px_-15px_rgba(59,130,246,0.2)]">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 blur-xl"></div>
                            <div class="w-12 h-12 rounded-2xl bg-white/[0.03] border border-white/10 flex items-center justify-center mb-8 group-hover:scale-110 group-hover:bg-blue-500/20 group-hover:border-blue-500/40 group-hover:text-blue-400 transition-all z-10">
                                <svg class="w-5 h-5 text-white/50 group-hover:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div class="z-10">
                                <h3 class="font-bold text-lg text-white/90 mb-1 group-hover:text-white transition-colors">Email</h3>
                                <p class="text-[12px] text-white/40 group-hover:text-blue-400 transition-colors font-medium">sarhamsan32@gmail.com</p>
                            </div>
                        </a>
        
                        <!-- WhatsApp Card -->
                        <a href="https://wa.me/6289694923810?text=Halo%20Sarham%20San,%20saya%20ingin%20berdiskusi%20mengenai%20proyek..." target="_blank" rel="noopener" class="group p-6 rounded-3xl bg-emerald-500/[0.03] border border-emerald-500/10 hover:bg-emerald-500/[0.08] hover:border-emerald-500/40 transition-all duration-500 hover:-translate-y-1 relative overflow-hidden flex flex-col items-start shadow-[0_15px_40px_-15px_rgba(0,0,0,0.5)] hover:shadow-[0_15px_40px_-15px_rgba(16,185,129,0.2)]">
                            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 blur-xl"></div>
                            <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center mb-8 group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-white group-hover:border-emerald-400 text-emerald-500 transition-all z-10 group-hover:shadow-[0_0_20px_rgba(16,185,129,0.6)]">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            </div>
                            <div class="z-10">
                                <h3 class="font-bold text-lg text-white/90 mb-1 group-hover:text-white transition-colors">WhatsApp</h3>
                                <p class="text-[12px] text-white/40 group-hover:text-emerald-400/80 transition-colors font-medium">Respon Cepat</p>
                            </div>
                        </a>
        
                        <!-- Abstract Globe Map visual spanning full width -->
                        <div class="sm:col-span-2 group p-6 rounded-3xl bg-[#030303] border border-white/[0.04] hover:border-purple-500/30 transition-all duration-500 relative overflow-hidden flex items-center justify-between shadow-[0_15px_40px_-15px_rgba(0,0,0,0.5)] hover:shadow-[0_15px_40px_-15px_rgba(168,85,247,0.15)] mt-2">
                            <div class="absolute inset-0 bg-[radial-gradient(circle,_rgba(255,255,255,0.03)_1px,_transparent_1px)]" style="background-size: 16px 16px;"></div>
                            
                            <!-- Animated Map Overlay -->
                            <div class="absolute inset-y-0 right-0 w-[60%] opacity-20 group-hover:opacity-40 transition-opacity duration-1000 mix-blend-screen pointer-events-none">
                                <svg class="w-full h-full object-cover" viewBox="0 0 200 100" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="none" stroke="currentColor" stroke-width="0.5" stroke-dasharray="2 4" class="text-purple-400/30" d="M10,50 Q40,10 100,50 T190,50" />
                                    <path fill="none" stroke="currentColor" stroke-width="0.5" stroke-dasharray="2 4" class="text-blue-400/30" d="M10,70 Q60,30 130,70 T190,40" />
                                    <circle cx="100" cy="50" r="30" fill="none" stroke="currentColor" stroke-width="0.2" class="text-white/20"/>
                                    <circle cx="100" cy="50" r="45" fill="none" stroke="currentColor" stroke-width="0.2" class="text-white/20"/>
                                    <line x1="100" y1="5" x2="100" y2="95" stroke="currentColor" stroke-width="0.2" class="text-white/20"/>
                                    <line x1="15" y1="50" x2="185" y2="50" stroke="currentColor" stroke-width="0.2" class="text-white/20"/>
                                    
                                    <!-- Dynamic Nodes -->
                                    <circle cx="100" cy="50" r="2" fill="currentColor" class="text-purple-500 shadow-[0_0_10px_rgba(168,85,247,1)]" />
                                    <circle cx="40" cy="30" r="1.5" fill="currentColor" class="text-blue-500" />
                                    <circle cx="160" cy="40" r="1" fill="currentColor" class="text-pink-500 animate-pulse" />
                                </svg>
                            </div>
        
                            <div class="relative z-10 flex items-center gap-6">
                                <div class="relative w-16 h-16 rounded-full border border-white/10 flex items-center justify-center shrink-0 bg-white/[0.02]">
                                    <!-- Ripple effect -->
                                    <div class="absolute inset-0 rounded-full border border-purple-500/80 animate-ping opacity-30 shadow-[0_0_20px_rgba(168,85,247,0.5)]"></div>
                                    <div class="absolute inset-2 rounded-full border border-purple-400/40 animate-pulse"></div>
                                    <svg class="w-6 h-6 text-purple-400 drop-shadow-[0_0_8px_rgba(168,85,247,0.8)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg text-white/90 mb-1 group-hover:text-purple-400 transition-colors">Digital Base</h3>
                                    <p class="text-xs text-white/50 font-medium">Indonesia <span class="text-white/30">(GMT+7)</span></p>
                                    <p class="text-[10px] text-white/40 mt-1.5 uppercase tracking-[0.2em] font-bold">Remote-First Workflow</p>
                                </div>
                            </div>
                            
                            <div class="hidden sm:flex relative z-10 w-10 h-10 rounded-full border border-white/10 items-center justify-center group-hover:bg-purple-500/10 transition-colors">
                                <svg class="w-4 h-4 text-white/30 group-hover:text-purple-400 group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="py-8 border-t border-white/[0.05]">
        <div class="w-full px-8 sm:px-12 lg:px-16 xl:px-24 flex flex-col sm:flex-row items-center justify-between gap-6 text-[12px] text-white/30">
            <span>&copy; {currentYear} Sarham San. Hak cipta dilindungi.</span>
            
            <div class="flex items-center gap-5">
                <a href="https://github.com/sarhamsan" target="_blank" rel="noopener" aria-label="GitHub" class="hover:text-white transition-colors duration-300 hover:scale-110 transform">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                </a>
                <a href="https://linkedin.com/in/sarhamsan" target="_blank" rel="noopener" aria-label="LinkedIn" class="hover:text-blue-400 transition-colors duration-300 hover:scale-110 transform">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                </a>
                <a href="mailto:sarhamsann32@email.com" aria-label="Email" class="hover:text-pink-400 transition-colors duration-300 hover:scale-110 transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </a>
            </div>
        </div>
    </footer>

<!-- SCROLL TO TOP -->
<button id="scrollToTopBtn" bind:this={scrollTopBtn} onclick={scrollToTop} class="scroll-top-btn" aria-label="Kembali ke atas">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
</button>
