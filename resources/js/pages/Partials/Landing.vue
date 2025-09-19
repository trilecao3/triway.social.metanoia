<script setup>
import { ref, computed } from "vue";
import Carousel from "./Carousel.vue";

const daysUntilTarget = computed(() => {
  const today = new Date();
  const target = new Date("2025-10-26");

  // calculate difference in milliseconds
  const diffTime = target.getTime() - today.getTime();

  // convert to days (rounded down)
  const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));

  // convert to array of digits
  return diffDays.toString().split("").map(Number);
});

const words = [
  "Góc Nhìn",
  "Trình Diễn",
  "Trải Nghiệm",
  "Kết Nối",
  "Giao Lưu",
  "Thêm Bạn",
]

// returns a random number between 0.10 and 0.20
function randomOpacity() {
  return (Math.random() * (0.1 - 0.03) + 0.07).toFixed(2);
}

const loopWords = [...words, ...words, ...words, ...words];

const opacities = ref(loopWords.map(() => randomOpacity()))
</script>
<template>
  <div
    class="relative flex h-screen w-full bg-gradient-to-br from-zinc-900 to-black/85 text-white"
  >
    <div class="absolute top-8 w-full flex flex-col justify-center items-center gap-y-0.5 sm:gap-y-1 text-sm sm:text-base">
      <p>Thiết kế và tổ chức bởi</p>
      <p class="uppercase font-bold">The Tri Way x Triway Social</p>
    </div>
    <div class="-mt-[20px] sm:-mt-[50px] w-full sm:max-w-4xl xl:max-w-7xl z-10 px-4 mx-auto flex flex-col sm:gap-x-10 xl:gap-x-16 items-center justify-center">
      <div class="w-full flex justify-center">
        <div class="-mt-8 sm:-mt-5">
          <div class="w-full flex items-center justify-center gap-x-5 sm:gap-x-7 opacity-70 sm:opacity-60">
            <h1 class="text-[7rem] sm:text-[11rem] xl:text-[14rem] font-extrabold tracking-tight">
              <span v-if="daysUntilTarget.length === 2">
                {{ daysUntilTarget[0] }}
              </span>
              <span class="bg-gradient-to-r from-gray-50 to-gray-400/30 bg-clip-text text-transparent">
                {{ daysUntilTarget.length === 2 ? daysUntilTarget[1] : daysUntilTarget[0] }}
              </span>
            </h1>
            <span class="text-[2.75rem] sm:text-[4.4rem] xl:text-[5.5rem] font-bold leading-13 sm:leading-20 xl:leading-26 tracking-tight -mt-1 sm:-mt-2 xl:-mt-3">
              ngày<br>
              <span class="bg-gradient-to-r from-gray-50 to-gray-300/40 bg-clip-text text-transparent">đến với</span>
            </span>
          </div>
          <div class="mx-auto sm:mx-0 mt-0 block w-full text-center">
            <h1 class="text-3xl sm:text-4xl xl:text-5xl tracking-tight"><span class="font-bold">Metanoia</span> Chương III</h1>
            <span class="block mt-0 font-display text-4xl sm:text-5xl xl:text-6xl text-center rotate-[-4deg] mx-auto text-red-500">authenticity</span>
          </div>
        </div>
      </div>
      <div class="w-full mt-20 sm:mt-32 space-y-6">
        <div class="mt-3 flex flex-wrap items-center justify-center gap-x-6 gap-y-5 sm:gap-x-12 sm:gap-y-6">
          <img src="/images/logo/tws-logo.png" alt="Triway Social Logo" class="w-16 sm:w-24 xl:w-28" />
          <img src="/images/logo/tgc-logo.png" alt="Triway Social Logo" class="h-8 sm:h-11 xl:h-13" />
          <img src="/images/logo/mh-logo.png" alt="Triway Social Logo" class="h-10 sm:h-14 xl:h-16" />
          <img src="/images/logo/fonos-logo.png" alt="Triway Social Logo" class="h-8 sm:h-10 xl:h-12" />
          <img src="/images/logo/gaonau-logo.png" alt="Triway Social Logo" class="h-9 sm:h-12 xl:h-13" />
        </div>
      </div>
    </div>

    <Carousel class="absolute z-30 bottom-0 w-full overflow-hidden bg-transparent" :show="`row2`" />
  </div>
</template>
<style scoped>
@keyframes marquee {
  0%   { transform: translateX(0%); }
  100% { transform: translateX(-50%); }
}

.animate-marquee {
  display: inline-flex;
  min-width: 200%;
  animation: marquee 60s linear infinite;
}
</style>