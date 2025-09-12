<script setup>
import Carousel from './Carousel.vue';

</script>
<template>
  <div class="relative w-full bg-[#15181B] text-white py-32">
    <div class="w-full max-w-4xl mx-auto text-center">
      <h1 class="font-bold tracking-tighter text-4xl sm:text-5xl text-center">
        AI hỏi đáp tất cả về<br><span class="font-light text-4xl tracking-tight">Metanoia Chương III</span>
      </h1>

      <div class="w-[320px] sm:w-[450px] mx-auto flex justify-center mt-8">
        <thrii-widget 
          api-key="thrii_bm3IIDzT9b8EDDWSHbltCKaT" 
          widget-type="inline"
          class="w-full"
        ></thrii-widget>
      </div>
    </div>

    <div class="w-full mt-32 mb-10 sm:mb-0">
      <Carousel />
    </div>

    <div class="absolute w-full bottom-0 left-0 px-5 py-7 sm:py-8 sm:px-6 border-dashed border-white/30 flex flex-row items-start sm:items-center justify-between">
      <div class="hidden sm:block w-1/3">
        <p class="tracking-tight sm:text-lg xl:text-xl">
          <b class="font-extrabold">Metanoia</b> Chương III
        </p>
        <span
          class="-mt-4 sm:text-2xl xl:text-3xl block font-display rotate-[-4deg] mx-auto"
        >
          authenticity
        </span>
      </div>
      <div class="w-full sm:w-1/3 text-left sm:text-center text-sm md:text-base xl:text-lg">
        <div class="block sm:hidden mb-6">
          <p class="tracking-tight text-lg">
            <b class="font-extrabold">Metanoia</b> Chương III
          </p>
          <span
            class="-mt-4 text-2xl sm:text-lg xl:text-xl block font-display rotate-[-4deg] mx-auto"
          >
            authenticity
          </span>
        </div>
        <p>&copy; 2025 Triway Social. All rights reserved.</p>
        <a href="https://triway.social/metanoia" class="font-bold">triway.social/metanoia</a>
      </div>
      <div class="sm:w-1/3 text-right shrink-0">
        <a href="https://instagram.com/triway.social" target="_blank"><img src="/images/logo/tws-logo.png" alt="Instagram" class="inline-block w-auto h-11 sm:h-12" /></a>
      </div>
    </div>
  </div>
</template>