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
  const SHIFT_X_PX = -30; // optional horizontal shift
  const SCRUB_SMOOTHNESS = 0.6;
  // -------------------------------------------

  // DPR and offscreen buffer
  let dpr = /Mobi|Android/i.test(navigator.userAgent) ? 1 : window.devicePixelRatio || 1;
  const offscreen = document.createElement("canvas");
  const offCtx = offscreen.getContext("2d");

  // create hidden video
  const video = document.createElement("video");
  video.src = VIDEO_SRC;
  video.preload = "auto";
  video.autoplay = true;
  video.muted = true;
  video.playsInline = true;
  video.style.display = "none";
  document.body.appendChild(video);

  // scrub object
  const scrub = { progress: 0 };

  // Resize both canvases for DPR
  function resizeCanvas() {
    dpr = /Mobi|Android/i.test(navigator.userAgent) ? 1 : window.devicePixelRatio || 1;

    // visible canvas
    canvas.width = Math.round(window.innerWidth * dpr);
    canvas.height = Math.round(window.innerHeight * dpr);
    canvas.style.width = `${window.innerWidth}px`;
    canvas.style.height = `${window.innerHeight}px`;
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

    // offscreen canvas sized in CSS pixels (we'll draw using same CSS units)
    offscreen.width = Math.round(window.innerWidth);
    offscreen.height = Math.round(window.innerHeight);
  }

  // "cover" draw logic but for arbitrary ctx & target sizes (css px)
  function computeCoverParams(videoWidth, videoHeight, targetW, targetH) {
    const canvasRatio = targetW / targetH;
    const videoRatio = videoWidth / videoHeight;
    let renderW, renderH, xOffset, yOffset;

    if (videoRatio > canvasRatio) {
      // video wider -> fit height, crop sides
      renderH = targetH;
      renderW = (videoWidth * targetH) / videoHeight;
      xOffset = (targetW - renderW) / 2;
      yOffset = 0;
    } else {
      // video taller -> fit width, crop top/bottom
      renderW = targetW;
      renderH = (videoHeight * targetW) / videoWidth;
      xOffset = 0;
      yOffset = (targetH - renderH) / 2;
    }

    return { renderW, renderH, xOffset, yOffset };
  }

  // Draw video onto offscreen canvas (CSS pixels)
  function drawVideoToOffscreen() {
    const vw = video.videoWidth;
    const vh = video.videoHeight;
    if (!vw || !vh) return;

    const cw = offscreen.width;
    const ch = offscreen.height;

    const { renderW, renderH, xOffset, yOffset } = computeCoverParams(vw, vh, cw, ch);

    // clear offscreen then draw the video frame into offscreen
    offCtx.clearRect(0, 0, cw, ch);
    // apply SHIFT_X_PX in CSS pixels
    offCtx.drawImage(video, xOffset + (SHIFT_X_PX / dpr), yOffset, renderW, renderH);
  }

  // Copy offscreen (CSS pixels) to visible canvas (we're using ctx.setTransform for DPR)
  function copyOffscreenToVisible() {
    // Do not clear visible canvas to avoid flicker — just paint over
    ctx.drawImage(offscreen, 0, 0, offscreen.width, offscreen.height, 0, 0, offscreen.width, offscreen.height);
  }

  // Draw-ready handler: run this ONLY when a decoded frame is available
  function onFrameReady() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    // 1) paint to offscreen using CSS pixel dims
    drawVideoToOffscreen();
    // 2) copy to main canvas (visible)
    copyOffscreenToVisible();
  }

  // rVFC path (preferred)
  let rVFC_handle = null;
  function startRVFC() {
    if (!video.requestVideoFrameCallback) return false;
    // continuous chain of rVFC callbacks
    const cb = (now, metadata) => {
      onFrameReady();
      rVFC_handle = video.requestVideoFrameCallback(cb);
    };
    rVFC_handle = video.requestVideoFrameCallback(cb);
    return true;
  }

  function stopRVFC() {
    // no direct cancel API, but we can ignore handle; browser handles lifecycle
    rVFC_handle = null;
  }

  // Fallback path (for browsers without rVFC like older FF or when rVFC not available)
  // We'll listen to 'seeked' and 'timeupdate' events and draw only in their callbacks.
  let pendingSeek = false;
  function onSeekedOrTimeUpdate() {
    // draw after seek completes (browser decoded frame ready)
    onFrameReady();
    pendingSeek = false;
  }

  // Called when video metadata is ready
  function onVideoReady() {
    // size canvases
    resizeCanvas();

    // prime decoding: play/pause to encourage decoder allocation (helps Safari/Chrome)
    video.play().then(() => video.pause()).catch(() => {});

    // GSAP scrub drives scrub.progress -> map to video.currentTime
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
        const dur = video.duration || 0.0001;
        const t = Math.min(Math.max(scrub.progress, 0), 1) * dur;
        // seek only if difference is significant (avoid tiny seeks)
        if (Math.abs(video.currentTime - t) > 0.02) {
          pendingSeek = true;
          // If rVFC available, setting currentTime will trigger next rVFC when decoded
          video.currentTime = t;
        }
      },
    });

    // Prefer rVFC (most robust) — if available start it
    if (startRVFC()) {
      // rVFC will call onFrameReady continuously as frames are decoded
    } else {
      // fallback: use seeked/timeupdate event
      video.addEventListener("seeked", onSeekedOrTimeUpdate);
      video.addEventListener("timeupdate", onSeekedOrTimeUpdate);
      // also try an initial draw (if video has a frame ready)
      onFrameReady();
    }
  }

  // Attach event and fallback handling
  video.addEventListener("loadedmetadata", onVideoReady);

  // If metadata already ready (rare), call immediately
  if (video.readyState >= 1 && video.videoWidth && video.videoHeight) {
    onVideoReady();
  }

  window.addEventListener("resize", resizeCanvas);

  // CLEANUP
  onBeforeUnmount(() => {
    window.removeEventListener("resize", resizeCanvas);
    video.removeEventListener("loadedmetadata", onVideoReady);
    video.removeEventListener("seeked", onSeekedOrTimeUpdate);
    video.removeEventListener("timeupdate", onSeekedOrTimeUpdate);
    stopRVFC();
    if (video.parentNode) video.parentNode.removeChild(video);
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
        <h2 class="text-3xl sm:text-5xl font-bold tracking-tight mb-7 flex flex-col gap-y-2 sm:gap-y-9">
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
        <h2 class="text-3xl sm:text-5xl font-bold tracking-tight mb-9 flex flex-col gap-y-2 sm:gap-y-9">
          <span class="text-4xl sm:text-5xl font-display !font-light -ml-2 sm:-ml-5 -rotate-[6deg]">Authenticity</span>
          Sự Chân Thực Cá Nhân
        </h2>
        <div class="max-w-[280px] sm:max-w-md text-base sm:text-lg font-medium leading-snug space-y-5">
          <p class="text-xl sm:text-2xl font-semibold">Là thông điệp chính của sự kiện.</p>
          <p>Bao gồm 3 phần chính: Góc Nhìn (The Speech) + Trình Diễn (The Performance) + Kết Bạn (The Connection).</p>
          <p>Các hoạt động chủ chốt của Metanoia Chương III sẽ xoay quanh tinh thần Authenticity / Chân Thực này.</p>
        </div>
      </div>
    </div>

    <div class="absolute top-[140vh] w-full h-screen flex items-center justify-center z-10">
      <div class="px-5 sm:px-8 lg:px-0 mx-auto w-full md:max-w-3xl 2xl:max-w-4xl text-white">
        <h2 class="text-3xl sm:text-5xl font-bold tracking-tight mb-9 flex flex-col gap-y-2 sm:gap-y-9">
          <span class="text-4xl sm:text-5xl font-display !font-light -ml-2 sm:-ml-5 -rotate-[6deg]">Why?</span>
          Tại sao bạn nên tham gia?
        </h2>
        <div class="max-w-[300px] sm:max-w-md text-base sm:text-lg font-medium leading-snug space-y-2">
          <p class="text-xl sm:text-2xl font-semibold bg-gradient-to-r from-gray-50 to-gray-300/30 bg-clip-text text-transparent">Gặp những người bạn mới.</p>
          <p class="text-xl sm:text-2xl font-semibold bg-gradient-to-l from-gray-100 to-gray-300/50 bg-clip-text text-transparent">Thêm những góc nhìn mới.</p>
          <p class="text-xl sm:text-2xl font-semibold bg-gradient-to-b from-gray-50 to-gray-300/50 bg-clip-text text-transparent">Thiết lập một chương mới.</p>
          <p class="!mt-5">Hy vọng đây sẽ trở thành khoảnh khắc đáng nhớ nhất năm 2025 cho riêng bạn. Hãy đến, cùng hoà vào nhịp đập chung của Metanoia Chương III.</p>
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