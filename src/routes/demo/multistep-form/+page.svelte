<script>
  import { onMount } from "svelte";

  onMount(() => {
    let currentStep = 1;
    const totalSteps = 3;
    const lineLengths = ["0%", "50%", "100%"];

    const line = document.getElementById("progress-line");
    const dots = document.querySelectorAll(".step-indicator");
    const panels = document.querySelectorAll(".step-panel");
    const btnNext = document.getElementById("btn-next");
    const btnPrev = document.getElementById("btn-prev");
    const navBar = document.getElementById("form-nav");

    const updateUI = () => {
      // Update panels
      panels.forEach((p, idx) => {
        if (idx + 1 === currentStep) p.classList.add("active");
        else p.classList.remove("active");
      });

      // Update line
      line.style.width = lineLengths[currentStep - 1];

      // Update dots
      dots.forEach((dot, idx) => {
        const stepNum = idx + 1;
        if (stepNum <= currentStep) {
          dot.className =
            "step-indicator w-8 h-8 rounded-full bg-lime-500 border border-lime-400 text-black flex items-center justify-center font-bold text-xs shadow-[0_0_15px_rgba(132,204,22,0.6)] relative z-10 transition-colors duration-500";
        } else {
          dot.className =
            "step-indicator w-8 h-8 rounded-full bg-[#0a0a0a] border border-white/20 text-white flex items-center justify-center font-bold text-xs relative z-10 transition-colors duration-500";
        }
      });

      // Update buttons
      if (currentStep === 1) {
        btnPrev.classList.add("opacity-0", "pointer-events-none");
        btnNext.textContent = "Continue";
      } else if (currentStep === 2) {
        btnPrev.classList.remove("opacity-0", "pointer-events-none");
        btnNext.textContent = "Complete Order";
      } else if (currentStep === 3) {
        navBar.style.display = "none"; // hide nav entirely on success
      }
    };

    btnNext.addEventListener("click", () => {
      if (currentStep < totalSteps) {
        currentStep++;
        updateUI();
      }
    });

    btnPrev.addEventListener("click", () => {
      if (currentStep > 1) {
        currentStep--;
        updateUI();
      }
    });
  });
</script>

<svelte:head>
  <title>Multi-step Form Demo — Sarham San</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet"
  />
  <style>
    body {
      font-family: "Plus Jakarta Sans", system-ui, sans-serif;
      background: #050505;
      color: #fff;
    }
    .glass-panel {
      background: rgba(255, 255, 255, 0.02);
      border: 1px solid rgba(255, 255, 255, 0.06);
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(10px);
      text-align: left;
    }
    .bg-grid {
      background-image: radial-gradient(
        circle,
        rgba(255, 255, 255, 0.05) 1px,
        transparent 1px
      );
      background-size: 32px 32px;
    }

    .step-panel {
      display: none;
      animation: fadeSlideUp 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275)
        forwards;
    }
    .step-panel.active {
      display: block;
    }

    @keyframes fadeSlideUp {
      from {
        opacity: 0;
        transform: translateY(15px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Progress line transition */
    .progress-line {
      transition: width 0.5s ease-in-out;
    }
  </style>
</svelte:head>

<!-- Floating Back Button -->
<a
  href="../../#skills"
  class="fixed top-6 left-6 z-50 inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#050505]/80 border border-white/10 shadow-xl backdrop-blur-md text-white/50 hover:text-white hover:bg-white/10 hover:border-white/20 transition-all font-medium text-[13px] group"
>
  <svg
    class="w-4 h-4 group-hover:-translate-x-1 transition-transform"
    fill="none"
    stroke="currentColor"
    viewBox="0 0 24 24"
    ><path
      stroke-linecap="round"
      stroke-linejoin="round"
      stroke-width="2"
      d="M10 19l-7-7m0 0l7-7m-7 7h18"
    /></svg
  >
  Kembali
</a>

<!-- Top bg glows -->
<div
  class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-[400px] bg-lime-600/10 blur-[120px] rounded-full pointer-events-none"
></div>

<div class="relative z-10 w-full max-w-xl mx-auto mt-12 md:mt-0">
  <div class="text-center mb-10">
    <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight mb-4">
      Wizard <span class="text-lime-500">Checkout</span>
    </h1>
    <p class="text-[13px] text-white/40 leading-relaxed max-w-sm mx-auto">
      Simulasi multi-step form wizard yang intuitif menggunakan JavaScript untuk
      validasi transisi antar tahap.
    </p>
  </div>

  <!-- Form Wrapper -->
  <div class="glass-panel rounded-[2rem] p-6 sm:p-10 w-full relative">
    <!-- Progress Bar -->
    <div
      class="flex items-center justify-between relative mb-12 max-w-[80%] mx-auto z-10"
    >
      <div
        class="absolute top-1/2 left-0 right-0 h-1 bg-white/[0.05] -translate-y-1/2 z-0 rounded-full"
      ></div>
      <!-- Line indicator -->
      <div
        id="progress-line"
        class="absolute top-1/2 left-0 w-[0%] h-1 bg-lime-500 shadow-[0_0_10px_rgba(132,204,22,0.5)] -translate-y-1/2 z-0 rounded-full progress-line"
      ></div>

      <!-- Steps -->
      <div
        class="step-indicator w-8 h-8 rounded-full bg-lime-500 border border-lime-400 text-black flex items-center justify-center font-bold text-xs shadow-[0_0_15px_rgba(132,204,22,0.6)] relative z-10 transition-colors duration-500"
        data-step="1"
      >
        1
      </div>
      <div
        class="step-indicator w-8 h-8 rounded-full bg-[#0a0a0a] border border-white/20 text-white flex items-center justify-center font-bold text-xs relative z-10 transition-colors duration-500"
        data-step="2"
      >
        2
      </div>
      <div
        class="step-indicator w-8 h-8 rounded-full bg-[#0a0a0a] border border-white/20 text-white flex items-center justify-center font-bold text-xs relative z-10 transition-colors duration-500"
        data-step="3"
      >
        3
      </div>
    </div>

    <form id="wizard-form" onsubmit={event.preventDefault()}>
      <!-- Step 1: Info -->
      <div class="step-panel active" id="step-1">
        <h2 class="text-lg font-bold mb-6 text-white/90">Personal Info</h2>
        <div class="space-y-4">
          <div>
            <label class="block text-xs font-semibold text-white/60 mb-1.5 ml-1"
              >Nama Lengkap</label
            >
            <input
              type="text"
              placeholder="John Doe"
              class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-sm outline-none focus:border-lime-500/50 focus:bg-white/[0.03] transition-all text-white"
            />
          </div>
          <div>
            <label class="block text-xs font-semibold text-white/60 mb-1.5 ml-1"
              >Email</label
            >
            <input
              type="email"
              placeholder="john@example.com"
              class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-sm outline-none focus:border-lime-500/50 focus:bg-white/[0.03] transition-all text-white"
            />
          </div>
        </div>
      </div>

      <!-- Step 2: Shipping -->
      <div class="step-panel" id="step-2">
        <h2 class="text-lg font-bold mb-6 text-white/90">Shipping Address</h2>
        <div class="space-y-4">
          <div>
            <label class="block text-xs font-semibold text-white/60 mb-1.5 ml-1"
              >Alamat Rumah</label
            >
            <textarea
              rows="2"
              placeholder="Jln. Mawar No 123..."
              class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-sm outline-none focus:border-lime-500/50 focus:bg-white/[0.03] transition-all text-white resize-none"
            ></textarea>
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label
                class="block text-xs font-semibold text-white/60 mb-1.5 ml-1"
                >Kota</label
              >
              <input
                type="text"
                placeholder="Jakarta"
                class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-sm outline-none focus:border-lime-500/50 focus:bg-white/[0.03] transition-all text-white"
              />
            </div>
            <div>
              <label
                class="block text-xs font-semibold text-white/60 mb-1.5 ml-1"
                >Kode Pos</label
              >
              <input
                type="text"
                placeholder="10230"
                class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-sm outline-none focus:border-lime-500/50 focus:bg-white/[0.03] transition-all text-white"
              />
            </div>
          </div>
        </div>
      </div>

      <!-- Step 3: Success -->
      <div class="step-panel" id="step-3">
        <div class="text-center py-6 flex flex-col items-center">
          <div
            class="w-16 h-16 rounded-full bg-lime-500/20 border border-lime-500/40 flex items-center justify-center text-lime-400 mb-6 shadow-[0_0_30px_rgba(132,204,22,0.3)]"
          >
            <svg
              class="w-8 h-8"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              ><path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M5 13l4 4L19 7"
              /></svg
            >
          </div>
          <h2 class="text-xl font-bold mb-2 text-white">Konfirmasi Selesai</h2>
          <p class="text-[13px] text-white/40 max-w-xs mx-auto">
            Terima kasih. Data Anda berhasil direkam untuk simulasi wizard ini.
          </p>
        </div>
      </div>

      <!-- Footer Nav -->
      <div
        class="flex items-center justify-between mt-10 pt-6 border-t border-white/[0.05]"
        id="form-nav"
      >
        <button
          type="button"
          id="btn-prev"
          class="px-5 py-2.5 rounded-xl border border-white/10 font-semibold text-sm text-white/60 hover:text-white hover:bg-white/5 transition-all opacity-0 pointer-events-none"
          >Back</button
        >
        <button
          type="button"
          id="btn-next"
          class="px-6 py-2.5 rounded-xl bg-lime-500 border border-lime-400 font-bold text-sm text-black hover:bg-lime-400 transition-all hover:shadow-[0_0_15px_rgba(132,204,22,0.4)]"
          >Continue</button
        >
      </div>
    </form>
  </div>
</div>
