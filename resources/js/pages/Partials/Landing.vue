<script setup>
import { ref, computed } from "vue";

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
    class="relative flex h-screen w-full bg-black/97 text-white"
  >
    <div class="absolute z-30 top-0 w-full overflow-hidden bg-transparent sm:-mt-5">
      <div class="flex whitespace-nowrap animate-marquee">
        <span
          v-for="(word, i) in loopWords"
          :key="i"
          class="mx-2 sm:mx-5 xl:mx-6 2xl:mx-6 text-[3.5rem] sm:text-[6rem] xl:text-[7rem] 2xl:text-[7.5rem] tracking-tighter font-bold cursor-default select-none"
          :style="{ opacity: opacities[i] }"
        >
          {{ word }}
        </span>
      </div>
    </div>

    <div class="w-full sm:max-w-4xl xl:max-w-7xl z-10 px-4 mx-auto flex flex-col sm:flex-row sm:gap-x-10 xl:gap-x-16 items-center justify-center sm:justify-between">
      <div class="w-full sm:w-1/2 text-5xl font-bold">
        <img src="/images/window-of-metanoia.png" alt="Metanoia Logo" class="w-full" />
      </div>
      <div class="w-full sm:w-1/2">
        <div class="-mt-5">
          <div class="flex items-center justify-center sm:justify-start  gap-x-5 sm:gap-x-7 opacity-75">
            <h1 class="text-[6rem] sm:text-[7rem] xl:text-[9rem] font-extrabold tracking-tight">
              <span v-if="daysUntilTarget.length === 2">
                {{ daysUntilTarget[0] }}
              </span>
              <span class="bg-gradient-to-r from-gray-50 to-gray-400/50 bg-clip-text text-transparent">
                {{ daysUntilTarget.length === 2 ? daysUntilTarget[1] : daysUntilTarget[0] }}
              </span>
            </h1>
            <span class="text-[2.3rem] sm:text-[3rem] xl:text-[3.8rem] font-bold leading-11 sm:leading-13 xl:leading-17 tracking-tight -mt-1.5">
              ngày<br>
              <span class="bg-gradient-to-r from-gray-50 to-gray-300/50 bg-clip-text text-transparent">đến với</span>
            </span>
          </div>
          <div class="mx-auto sm:mx-0 -mt-5 sm:mt-0 block w-fit">
            <h1 class="text-3xl sm:text-4xl xl:text-5xl tracking-tight"><span class="font-bold">Metanoia</span> Chương III</h1>
            <span class="block font-display text-4xl sm:text-5xl xl:text-6xl text-center rotate-[-4deg] mx-auto">authenticity</span>
          </div>
          <div class="mt-10 sm:mt-24 text-center sm:text-left">
            <p>Thiết kế & tổ chức bởi</p>
            <p class="uppercase">
              <b>The Tri Way</b> x <b>Triway Social Team</b>
            </p>
          </div>
        </div>
      </div>
    </div>
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