<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import { Link } from "@inertiajs/vue3";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

const canvasEl = ref(null);

onMounted(() => {
  const canvas = canvasEl.value;
  const ctx = canvas.getContext("2d");

  // ---------- CONFIG (change these) ----------
  const VIDEO_SRC = "/images/sequence.mp4"; // <-- change to your video file path
  const SHIFT_X_PX = -30; // <-- optional horizontal shift like your old code
  const SCRUB_SMOOTHNESS = 0.6; // lower = tighter, higher = smoother
  // -------------------------------------------

  // DPR-aware canvas sizing variables
  let dpr = window.devicePixelRatio || 1;

  // Create & append hidden video element
  const video = document.createElement("video");
  video.src = VIDEO_SRC;
  video.preload = "auto";
  video.muted = true;
  video.playsInline = true;
  video.controls = false;
  video.style.display = "none";
  document.body.appendChild(video);

  // small object we animate with GSAP
  const scrub = { progress: 0 };

  // render loop RAF id
  let rafId = null;

  // utility: resize canvas to window and set DPR correctly
  function resizeCanvas() {
    dpr = window.devicePixelRatio || 1;
    // set internal pixel buffer size
    canvas.width = Math.round(window.innerWidth * dpr);
    canvas.height = Math.round(window.innerHeight * dpr);
    // keep CSS size as device independent pixels
    canvas.style.width = `${window.innerWidth}px`;
    canvas.style.height = `${window.innerHeight}px`;
    // map drawing operations to CSS pixels
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }

  // draw video with "cover" behaviour (preserve aspect, crop)
  function drawVideoCover() {
    // logical canvas size (CSS px)
    const cw = canvas.width / dpr;
    const ch = canvas.height / dpr;

    const vw = video.videoWidth;
    const vh = video.videoHeight;
    if (!vw || !vh) return;

    const canvasRatio = cw / ch;
    const videoRatio = vw / vh;

    let renderW, renderH, xOffset, yOffset;

    if (videoRatio > canvasRatio) {
      // video wider than canvas → fit height, crop sides
      renderH = ch;
      renderW = (vw * ch) / vh;
      xOffset = (cw - renderW) / 2;
      yOffset = 0;
    } else {
      // video taller than canvas → fit width, crop top/bottom
      renderW = cw;
      renderH = (vh * cw) / vw;
      xOffset = 0;
      yOffset = (ch - renderH) / 2;
    }

    // apply optional horizontal pixel shift
    xOffset += SHIFT_X_PX;

    // clear & draw
    ctx.clearRect(0, 0, cw, ch);
    // drawImage expects CSS px coordinates when using setTransform(dpr,...)
    ctx.drawImage(video, xOffset, yOffset, renderW, renderH);
  }

  // continuous render loop — redraw as video.time changes
  function startRenderLoop() {
    function loop() {
      // If requestVideoFrameCallback is available you could use it for more reliability,
      // but we keep RAF for broad compatibility:
      drawVideoCover();
      rafId = requestAnimationFrame(loop);
    }
    if (!rafId) loop();
  }

  function stopRenderLoop() {
    if (rafId) cancelAnimationFrame(rafId);
    rafId = null;
  }

  // Called when video metadata is available (dimensions + duration)
  function onVideoReady() {
    // ensure canvas sized correctly
    resizeCanvas();

    // Try to prime decoding on some platforms (helps iOS / Safari)
    // (muted + playsInline allows autoplay)
    video.play().then(() => video.pause()).catch(() => { /* ignore */ });

    // GSAP drives scrub.progress from 0 -> 1
    gsap.to(scrub, {
      progress: 1,
      ease: "none",
      scrollTrigger: {
        scrub: SCRUB_SMOOTHNESS,
        trigger: ".animation-section",
        start: "top top",
        end: "bottom bottom",
      },
      onUpdate: () => {
        // map progress to video time (clamp)
        const dur = video.duration || 0.0001;
        const t = Math.min(Math.max(scrub.progress, 0), 1) * dur;
        // assign currentTime (seeking). keep small threshold to reduce unnecessary seeks:
        if (Math.abs(video.currentTime - t) > 0.01) {
          video.currentTime = t;
        }
      },
    });

    // start RAF render loop that draws the current video frame onto canvas
    startRenderLoop();
  }

  // event listeners
  video.addEventListener("loadedmetadata", onVideoReady);
  window.addEventListener("resize", resizeCanvas);

  // If video has already loaded metadata before listener attached:
  if (video.readyState >= 1 && video.videoWidth && video.videoHeight) {
    onVideoReady();
  }

  // ---------- cleanup ----------
  onBeforeUnmount(() => {
    stopRenderLoop();
    window.removeEventListener("resize", resizeCanvas);
    video.removeEventListener("loadedmetadata", onVideoReady);
    // remove appended video element
    if (video.parentNode) video.parentNode.removeChild(video);
    // kill ScrollTrigger instances
    ScrollTrigger.getAll().forEach((st) => st.kill());
    // kill GSAP tweens on scrub object
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
        <h2 class="text-3xl sm:text-5xl font-bold tracking-tighter mb-7 flex flex-col gap-y-1 sm:gap-y-6">
          <span class="text-4xl sm:text-5xl font-display !font-light text-red-600/60 -ml-2 sm:-ml-5 -rotate-[6deg]">Message</span>
          Lời đầu từ The Tri Way
        </h2>
        <div class="max-w-[290px] sm:max-w-md text-base sm:text-lg font-medium leading-snug space-y-5">
          <p>Chào mừng bạn đến với mùa 3 của sự kiện lớn thuờng niên của The Tri Way, với tên gọi <b>Metanoia</b> /<span>μετάνοῦς</span>/ <em>Thay Đổi Lớn</em>. Đây là dịp mỗi năm mà Trí đón hàng trăm bạn thính giả – từ nhiều nơi ở Việt Nam và thế giới – cùng hội tựu vể Sài Gòn để trải nghiệm không khí cộng đồng mà Việt Nam hiếm khi được thấy.</p>
          <p>Metanoia phát triển lớn dần qua mỗi năm, và là cột mốc tinh thần cho nhiều người tham dự: đó là những sự phát triển bản thân sau 1 năm nhìn lại, hoặc một chuỗi những người bạn đồng điệu được kết nối ngay tại event.</p>
          <p>Chương III chứng kiến sự đầu tư lớn nhất trước giờ của Trí, và đón chào sự tham gia của Triway Social Team. Tất cả cùng hướng đến việc tạo ra trải nghiệm tốt nhất cho người tham dự.</p>
        </div>
      </div>
    </div>

    <div class="absolute top-[80vh] w-full h-screen flex items-center justify-center z-10">
      <div class="px-5 sm:px-8 lg:px-0 mx-auto w-full md:max-w-3xl 2xl:max-w-4xl text-white">
        <h2 class="text-3xl sm:text-5xl font-bold tracking-tighter mb-7 flex flex-col gap-y-1 sm:gap-y-6">
          <span class="text-4xl sm:text-5xl font-display !font-light -ml-2 sm:-ml-5 -rotate-[6deg]">Authenticity</span>
          Sự Chân Thực Cá Nhân
        </h2>
        <div class="max-w-[280px] sm:max-w-md text-base sm:text-lg font-medium leading-snug space-y-5">
          <p class="text-xl sm:text-2xl font-semibold">Là thông điệp chính của sự kiện.</p>
          <p>Nó là dấu vân tay trên quân tốt. Bạn chọn một nước đi uy lực và đầy dũng khí, trong một hành trình mà bạn tin tưởng là nó dành cho mình.</p>
          <p>Các hoạt động chủ chốt của Metanoia Chương III sẽ xoay quanh tinh thần Authenticity này.</p>
        </div>
      </div>
    </div>

    <div class="absolute top-[140vh] w-full h-screen flex items-center justify-center z-10">
      <div class="px-5 sm:px-8 lg:px-0 mx-auto w-full md:max-w-3xl 2xl:max-w-4xl text-white">
        <h2 class="text-3xl sm:text-5xl font-bold tracking-tighter mb-7 flex flex-col gap-y-1 sm:gap-y-6">
          <span class="text-4xl sm:text-5xl font-display !font-light -ml-2 sm:-ml-5 -rotate-[6deg]">Are you ready?</span>
          Bạn đã sẵn sàng chưa?
        </h2>
        <div class="max-w-[300px] sm:max-w-md text-base sm:text-lg font-medium leading-snug space-y-5">
          <p class="text-xl sm:text-2xl font-semibold">Cho một sự kiện 3-trong-1:<br>Góc Nhìn + Trình Diễn + Kết Bạn.</p>
          <p>Hy vọng đây sẽ trở thành khoảnh khắc đáng nhớ nhất năm 2025 cho riêng bạn. Hãy đến, cùng hoà vào nhịp đập chung của Metanoia Chương III, và tìm gặp thêm những người bạn mới đồng điệu.</p>
        </div>
      </div>
    </div>

    <div class="absolute top-[220vh] w-full h-[30vh] flex items-center justify-center z-10">
      <div class="px-5 sm:px-8 lg:px-0 mx-auto w-full md:max-w-3xl 2xl:max-w-4xl text-white">
        <a href="#details" class="inline-block px-8 py-4 rounded-full text-lg font-bold transition-all ring-2 ring-white/60 hover:ring-white">
          Chi tiết và vé sự kiện
        </a>
      </div>
    </div>
    <!-- Keep adding folds -->
  </div>
</template>