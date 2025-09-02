<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import { Link } from "@inertiajs/vue3";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

const canvasEl = ref(null);
const frameCount = 300;
const currentFrame = (i) =>
  `/images/pawnbg/PawnComp_${String(i).padStart(5, "0")}.jpg`;

onMounted(() => {
  const canvas = canvasEl.value;
  const context = canvas.getContext("2d");

  const images = [];
  const imgSeq = { frame: 0 };

  // preload frames
  let loadedImages = 0;
  for (let i = 0; i < frameCount; i++) {
    const img = new Image();
    img.src = currentFrame(i);
    img.onload = () => {
      loadedImages++;
      if (loadedImages === frameCount) {
        initAnimation();
        render();
      }
    };
    images.push(img);
  }

  // helper: draw image as "cover"
  function drawCoverImage(ctx, img, canvas) {
    const canvasRatio = canvas.width / canvas.height;
    const imgRatio = img.width / img.height;

    let renderWidth, renderHeight, xOffset, yOffset;

    if (imgRatio > canvasRatio) {
      // Image is wider → fit height
      renderHeight = canvas.height;
      renderWidth = img.width * (canvas.height / img.height);
      xOffset = (canvas.width - renderWidth) / 2;
      yOffset = 0;
    } else {
      // Image is taller → fit width
      renderWidth = canvas.width;
      renderHeight = img.height * (canvas.width / img.width);
      xOffset = 0;
      yOffset = (canvas.height - renderHeight) / 2;
    }

    const shiftX = -30; // adjust px as you like
    xOffset += shiftX;

    ctx.drawImage(img, xOffset, yOffset, renderWidth, renderHeight);
  }

  function initAnimation() {
    gsap.to(imgSeq, {
      frame: frameCount - 1,
      snap: "frame",
      ease: "none",
      scrollTrigger: {
        scrub: 1,
        trigger: ".animation-section",
        start: "top top",
        end: "bottom bottom",
      },
      onUpdate: render,
    });
  }

  function render() {
    const frameIndex = Math.floor(imgSeq.frame);
    const nextIndex = (frameIndex + 1) % frameCount;
    const progress = imgSeq.frame - frameIndex;

    context.clearRect(0, 0, canvas.width, canvas.height);
    
    // draw current frame
    context.globalAlpha = 1 - progress;
    drawCoverImage(context, images[frameIndex], canvas);

    // draw next frame blended
    context.globalAlpha = progress;
    drawCoverImage(context, images[nextIndex], canvas);

    context.globalAlpha = 1;
  }

  // responsive canvas
  function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    render();
  }

  resizeCanvas();
  window.addEventListener("resize", resizeCanvas);

  onBeforeUnmount(() => {
    window.removeEventListener("resize", resizeCanvas);
    ScrollTrigger.getAll().forEach((st) => st.kill());
  });
});
</script>
<template>
   <section class="animation-section relative h-[260vh] w-full">
    <!-- Sticky Canvas -->
    <canvas ref="canvasEl" class="sticky top-0 left-0 h-screen w-full"></canvas>

    <!-- Overlays (each takes 100vh inside the 500vh scroll area) -->
    <div class="absolute top-0 w-full h-screen flex items-center z-10">
      <div class="px-5 sm:px-0 mx-auto w-full md:max-w-3xl 2xl:max-w-4xl text-white">
        <h2 class="text-3xl sm:text-5xl font-bold tracking-tighter mb-7 flex flex-col gap-y-1 sm:gap-y-6">
          <span class="text-4xl sm:text-5xl font-display !font-light text-red-600/60 -ml-2 sm:-ml-5 -rotate-[6deg]">Message</span>
          Lời đầu từ The Tri Way
        </h2>
        <div class="max-w-[290px] sm:max-w-md text-base sm:text-lg font-medium leading-snug space-y-5">
          <p>Chào mừng bạn đến với mùa III của sự kiện lớn thuờng niên của Trí, với tên gọi <b>Metanoia</b> /<span>μετάνοῦς</span>/ <em>Thay Đổi Lớn</em>. Đây là dịp mỗi năm mà Trí đón hàng trăm bạn thính giả – từ nhiều nơi ở Việt Nam và thế giới – cùng hội tựu vể Sài Gòn để trải nghiệm không khí cộng đồng mà Việt Nam hiếm khi được thấy.</p>
          <p>Metanoia phát triển lớn dần qua mỗi năm, và là cột mốc tinh thần cho nhiều người: đó là những sự phát triển bản thân sau 1 năm nhìn lại, hoặc một chuỗi những người bạn đồng điệu được kết nối ngay tại event.</p>
          <p>Chương III chứng kiến sự đầu tư lớn nhất trước giờ của Trí, và đón chào sự tham gia của Triway Social Team. Tất cả cùng hướng đến việc tạo ra trải nghiệm tốt nhất cho người tham dự.</p>
        </div>
      </div>
    </div>

    <div class="absolute top-[80vh] w-full h-screen flex items-center justify-center z-10">
      <div class="px-5 sm:px-0 mx-auto w-full md:max-w-3xl 2xl:max-w-4xl text-white">
        <h2 class="text-3xl sm:text-5xl font-bold tracking-tighter mb-7 flex flex-col gap-y-1 sm:gap-y-6">
          <span class="text-4xl sm:text-5xl font-display !font-light -ml-2 sm:-ml-5 -rotate-[6deg]">Authenticity</span>
          Sự Chân Thực Cá Nhân
        </h2>
        <div class="max-w-[280px] sm:max-w-md text-base sm:text-lg font-medium leading-snug space-y-5">
          <p class="text-xl sm:text-2xl font-semibold">Là thông điệp chính của sự kiện.</p>
          <p>Nó là dấu vân tay trên quân tốt của bàn cờ. Bạn chọn một nước đi uy lực và đầy dũng khí, trong một hành trình mà bạn tin tưởng là nó dành cho mình.</p>
          <p>Các hoạt động chủ chốt của Metanoia Chương III sẽ xoay quanh tinh thần Authenticity này.</p>
        </div>
      </div>
    </div>

    <div class="absolute top-[140vh] w-full h-screen flex items-center justify-center z-10">
      <div class="px-5 sm:px-0 mx-auto w-full md:max-w-3xl 2xl:max-w-4xl text-white">
        <h2 class="text-3xl sm:text-5xl font-bold tracking-tighter mb-7 flex flex-col gap-y-1 sm:gap-y-6">
          <span class="text-4xl sm:text-5xl font-display !font-light -ml-2 sm:-ml-5 -rotate-[6deg]">Are you ready?</span>
          Bạn đã sẵn sàng chưa?
        </h2>
        <div class="max-w-[300px] sm:max-w-md text-base sm:text-lg font-medium leading-snug space-y-5">
          <p class="text-xl sm:text-2xl font-semibold">Cho một sự kiện 3-trong-1:<br>Góc Nhìn + Trình Diễn + Kết Nối.</p>
          <p>Hy vọng đây sẽ trở thành khoảnh khắc đáng nhớ nhất năm 2025 cho riêng bạn. Hãy đến và hoà vào nhịp đập chung của Metanoia Chương III.</p>
        </div>
      </div>
    </div>

    <div class="absolute top-[220vh] w-full h-[30vh] flex items-center justify-center z-10">
      <div class="px-5 sm:px-0 mx-auto w-full md:max-w-3xl 2xl:max-w-4xl text-white">
        <a href="#details" class="inline-block px-8 py-4 rounded-full text-lg font-bold transition-all ring-2 ring-white/60 hover:ring-white">
          Chi tiết và vé sự kiện
        </a>
      </div>
    </div>
    <!-- Keep adding folds -->
  </section>
</template>