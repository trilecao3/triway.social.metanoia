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
    class="relative flex h-screen w-full bg-[#FEFBF6]"
  >
    <div class="absolute top-8 w-full flex flex-col justify-center items-center gap-y-1 xl:gap-y-2 text-sm xl:text-base">
      <p>Thiết kế và tổ chức bởi</p>
      <img src="/images/logo/on-light/tws-logo.png" alt="Triway Social Logo" class="w-16 sm:w-16 xl:w-20" />
    </div>
    <div class="-mt-[90px] w-full sm:max-w-4xl xl:max-w-7xl z-10 px-4 mx-auto flex flex-col sm:gap-x-10 xl:gap-x-16 items-center justify-center">
      <div class="w-full flex justify-center">
        <div class="-mt-8 sm:-mt-5">
          <div class="w-full flex items-center justify-center gap-x-5 sm:gap-x-7">
            <h1 class="text-[3.5rem] leading-15 text-center sm:text-[4rem] xl:text-[5rem] font-bold tracking-tighter">
              Còn 
              <span v-if="daysUntilTarget.length === 2"
              class="text-blue-700">
                {{ daysUntilTarget[0] }}
              </span>
              <span class="text-blue-700">
                {{ daysUntilTarget.length === 2 ? daysUntilTarget[1] : daysUntilTarget[0] }}
              </span> 
              <span class="text-blue-700"> ngày </span>
              <span class="bg-gradient-to-r from-black to-black/20 bg-clip-text text-transparent">đến với</span>
            </h1>
          </div>
          <div class="mx-auto sm:mx-0 mt-7 xl:mt-12 block w-full text-center">
            <h1 class="text-3xl sm:text-4xl tracking-tight"><span class="font-bold">Metanoia</span> Chương III</h1>
            <span class="block mt-0 font-display text-4xl sm:text-5xl text-center rotate-[-4deg] mx-auto text-red-500">authenticity</span>
          </div>
        </div>
      </div>
    </div>

    <div class="absolute z-30 bottom-5 sm:bottom-10 xl:bottom-20 w-full">
      <div class="hidden sm:block sm:space-y-5 w-full">
        <div class="flex flex-wrap items-center justify-center gap-x-12">
          <img src="/images/logo/on-light/tgc-logo.png" alt="The Global City Logo" class="h-10 sm:h-13" />
          <img src="/images/logo/on-light/mh-logo.png" alt="Masterise Homes Logo" class="h-14 sm:h-20" />
        </div>
        <div class="flex flex-wrap items-center justify-center gap-x-12">
          <img src="/images/logo/on-light/vnth-logo.png" alt="Viet Nam Tinh Hoa Primary School Logo" class="h-14 sm:h-9" />
          <img src="/images/logo/on-light/sia-logo.png" alt="Soul Institute of Arts Logo" class="h-14 sm:h-14" />
          <img src="/images/logo/on-light/mss-logo.png" alt="Men Stay Simplicity Logo" class="h-14 sm:h-5" />
          <img src="/images/logo/on-light/thrii-logo.png" alt="Thrii Logo" class="h-14 sm:h-7" />
        </div>
        <div class="flex flex-wrap items-center justify-center gap-x-12">
          <img src="/images/logo/on-light/fonos-logo.png" alt="Viet Nam Tinh Hoa Primary School Logo" class="h-14 sm:h-7" />
          <img src="/images/logo/on-light/gaonau-logo.png" alt="Soul Institute of Arts Logo" class="h-14 sm:h-10" />
        </div>
      </div>
      <div class="block sm:hidden w-full space-y-3">
        <div class="flex flex-wrap items-center justify-center gap-x-6 mb-5">
          <img src="/images/logo/on-light/tgc-logo.png" alt="The Global City Logo" class="h-11" />
          <img src="/images/logo/on-light/mh-logo.png" alt="Masterise Homes Logo" class="h-16" />
        </div>
        <div class="flex flex-wrap items-center justify-center gap-x-6">
          <img src="/images/logo/on-light/vnth-logo.png" alt="Viet Nam Tinh Hoa Primary School" class="h-8" />
        </div>
        <div class="flex flex-wrap items-center justify-center gap-x-6">
          <img src="/images/logo/on-light/mss-logo.png" alt="Men Stay Simplicity Logo" class="h-4" />
          <img src="/images/logo/on-light/sia-logo.png" alt="Soul Institute of Arts" class="h-12" />
          <img src="/images/logo/on-light/thrii-logo.png" alt="Men Stay Simplicity Logo" class="h-5" />
        </div>
        <div class="flex flex-wrap items-center justify-center gap-x-6">
          <img src="/images/logo/on-light/fonos-logo.png" alt="Viet Nam Tinh Hoa Primary School Logo" class="h-5.5" />
          <img src="/images/logo/on-light/gaonau-logo.png" alt="Soul Institute of Arts Logo" class="h-7" />
        </div>
      </div>
    </div>

    <!-- <Carousel class="absolute z-30 bottom-0 w-full overflow-hidden bg-transparent" :show="`row2`" /> -->
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