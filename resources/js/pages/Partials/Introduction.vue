<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

const canvasEl = ref(null);

onMounted(() => {
  const canvas = canvasEl.value;
  const ctx = canvas.getContext("2d");

  // ---------- CONFIG ----------
  const frameCount = 300;
  const currentFrame = (i) =>
    `/images/pawnbg/PawnComp_${String(i).padStart(5, "0")}.jpg`;
  const isMobile = window.matchMedia("(max-width: 768px)").matches;
  const SCRUB_SMOOTHNESS = isMobile ? 0.4 : 0.8;
  // ----------------------------

  const images = [];
  let loaded = 0;
  const scrub = { frame: 0 };

  function preloadImages() {
    return new Promise((resolve) => {
      for (let i = 0; i < frameCount; i++) {
        const img = new Image();
        img.src = currentFrame(i);
        img.onload = img.onerror = () => {
          loaded++;
          if (loaded === frameCount) resolve();
        };
        images.push(img);
      }
    });
  }

  function drawFrame(index) {
    const img = images[index];
    if (!img) return;

    const canvasRatio = canvas.width / canvas.height;
    const imgRatio = img.width / img.height;

    let renderW, renderH, xOffset, yOffset;
    if (imgRatio > canvasRatio) {
      // image is wider → fit height
      renderH = canvas.height;
      renderW = img.width * (canvas.height / img.height);
      xOffset = (canvas.width - renderW) / 2;
      yOffset = 0;
    } else {
      // image is taller → fit width
      renderW = canvas.width;
      renderH = img.height * (canvas.width / img.width);
      xOffset = 0;
      yOffset = (canvas.height - renderH) / 2;
    }

    // --- dynamic mobile shift ---
    const isMobile = window.matchMedia("(max-width: 768px)").matches;
    if (isMobile) {
      const t = index / (frameCount - 1); // 0 → 1 across scroll
      // Start -120px, end -200px
      const shift = -120 - (t >= 2/3 ? (t - 2/3) / (1/3) * 150 : 0);
      xOffset += shift;
    }

    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.drawImage(img, xOffset, yOffset, renderW, renderH);
  }

  function resizeCanvas() {
    const dpr = window.devicePixelRatio || 1;
    canvas.width = Math.round(window.innerWidth * dpr);
    canvas.height = Math.round(window.innerHeight * dpr);
    canvas.style.width = `${window.innerWidth}px`;
    canvas.style.height = `${window.innerHeight}px`;

    // remove scaling transform — we already calculate with DPR
    ctx.setTransform(1, 0, 0, 1, 0, 0);

    // redraw current frame properly with cover fit
    drawFrame(Math.floor(scrub.frame));
  }

  preloadImages().then(() => {
    drawFrame(0);

    gsap.to(scrub, {
      frame: frameCount - 1,
      ease: "none",
      scrollTrigger: {
        scrub: SCRUB_SMOOTHNESS,
        trigger: ".animation-section",
        start: "top top",
        end: "bottom bottom",
      },
      onUpdate: () => {
        drawFrame(Math.floor(scrub.frame));
      },
    });
  });

  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  onBeforeUnmount(() => {
    window.removeEventListener("resize", resizeCanvas);
    ScrollTrigger.getAll().forEach((st) => st.kill());
    gsap.killTweensOf(scrub);
  });
});
</script>
<template>
   <div class="animation-section relative h-[260vh] w-full">
    <!-- Sticky Canvas -->
    <canvas ref="canvasEl" class="sticky top-0 left-0 h-screen w-full"></canvas>

    <!-- Overlays (each takes 100vh inside the 500vh scroll area) -->
    <div class="absolute top-0 w-full h-screen flex items-center z-10">
      <div class="px-5 sm:px-8 lg:px-0 mx-auto w-full md:max-w-3xl 2xl:max-w-4xl text-white">
        <h2 class="text-3xl sm:text-4xl xl:text-5xl font-bold tracking-tight mb-7 flex flex-col gap-y-0 sm:gap-y-5">
          <span class="text-4xl sm:text-4xl xl:text-5xl font-display !font-light text-red-600/90 -ml-2 sm:-ml-5 -rotate-[4deg]">From founder</span>
          Lời đầu từ The Tri Way
        </h2>
        <div class="max-w-[290px] sm:max-w-md text-base sm:text-base xl:text-lg font-medium leading-snug space-y-5">
          <img src="/images/tri-portrait.jpg" class="rounded-full w-20 sm:w-28">
          <p>Chào mừng bạn đến với mùa 3 sự kiện thuờng niên của The Tri Way, với tên gọi <b>Metanoia</b> / <em>Thay Đổi Lớn</em>. Đây là dịp mỗi năm mà Trí đón hàng trăm bạn thính giả – từ nhiều nơi ở Việt Nam và thế giới – cùng hội tụ vể Sài Gòn để trải nghiệm không khí cộng đồng mà Việt Nam hiếm khi được thấy.</p>
          <p>Metanoia phát triển lớn dần qua mỗi năm, và là cột mốc tinh thần cho nhiều người tham dự: đó là những sự phát triển bản thân sau 1 năm nhìn lại, hoặc một chuỗi những người bạn đồng điệu được kết nối ngay tại event.</p>
        </div>
      </div>
    </div>

    <div class="absolute top-[80vh] w-full h-screen flex items-center justify-center z-10">
      <div class="px-5 sm:px-8 lg:px-0 mx-auto w-full md:max-w-3xl 2xl:max-w-4xl text-white">
        <h2 class="text-3xl sm:text-4xl xl:text-5xl font-bold tracking-tight mb-9 flex flex-col gap-y-2 sm:gap-y-9">
          <span class="text-4xl sm:text-4xl xl:text-5xl font-display !font-light -ml-2 sm:-ml-5 -rotate-[6deg]">Authenticity</span>
          Sự Chân Thực
        </h2>
        <div class="max-w-[280px] sm:max-w-md text-base sm:text-base xl:text-lg font-medium leading-snug space-y-5">
          <p class="text-xl xl:text-2xl font-semibold leading-snug">Là thông điệp chính cho 3 phần trong sự kiện:</p>
          <div class="ml-4">
            <p class="text-xl xl:text-2xl font-semibold bg-gradient-to-r from-gray-50 to-gray-300/30 bg-clip-text text-transparent">1. Chia sẻ góc nhìn.</p>
            <p class="text-xl xl:text-2xl font-semibold bg-gradient-to-l from-gray-100 to-gray-300/50 bg-clip-text text-transparent">2. Tiết mục trình diễn.</p>
            <p class="text-xl xl:text-2xl font-semibold bg-gradient-to-b from-gray-50 to-gray-300/50 bg-clip-text text-transparent">3. Giao lưu kết nối.</p>
          </div>
          <p>Các hoạt động chủ chốt của Metanoia Chương III sẽ xoay quanh tinh thần Authenticity / Chân Thực này.</p>
        </div>
      </div>
    </div>

    <div class="absolute top-[140vh] sm:top-[150vh] w-full h-screen flex items-center justify-center z-10">
      <div class="px-5 sm:px-8 lg:px-0 mx-auto w-full md:max-w-3xl 2xl:max-w-4xl text-white">
        <h2 class="text-3xl sm:text-4xl xl:text-5xl font-bold tracking-tight mb-9 flex flex-col gap-y-2 sm:gap-y-9">
          <span class="text-4xl sm:text-4xl xl:text-5xl font-display !font-light -ml-2 sm:-ml-5 -rotate-[6deg]">Why join?</span>
          Tại Sao Bạn Nên Đến?
        </h2>
        <div class="max-w-[300px] sm:max-w-md text-base sm:text-base xl:text-lg font-medium leading-snug space-y-2">
          <p class="text-xl xl:text-2xl font-semibold bg-gradient-to-r from-gray-50 to-gray-300/30 bg-clip-text text-transparent">Gặp những người bạn mới.</p>
          <p class="text-xl xl:text-2xl font-semibold bg-gradient-to-l from-gray-100 to-gray-300/50 bg-clip-text text-transparent">Thêm những góc nhìn mới.</p>
          <p class="text-xl xl:text-2xl font-semibold bg-gradient-to-b from-gray-50 to-gray-300/50 bg-clip-text text-transparent">Thiết lập một chương mới.</p>
          <p class="!mt-5">Hy vọng đây sẽ trở thành khoảnh khắc đáng nhớ nhất năm 2025 cho riêng bạn. Hãy đến, cùng hoà vào nhịp đập chung của Metanoia Chương III.</p>
        </div>
      </div>
    </div>

    <div class="absolute top-[220vh] sm:top-[230vh] xl:top-[227vh] w-full h-[30vh] flex items-center justify-center z-10">
      <div class="px-5 sm:px-8 lg:px-0 mx-auto w-full md:max-w-3xl 2xl:max-w-4xl text-white">
        <a href="#details" class="inline-block px-8 py-4 rounded-full text-lg font-bold transition-all ring-2 ring-white/60 hover:ring-white">
          Chi tiết và vé sự kiện
        </a>
      </div>
    </div>
    <!-- Keep adding folds -->
  </div>
</template>