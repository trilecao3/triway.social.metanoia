<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import { Head } from "@inertiajs/vue3";
import Details from "./Partials/Details.vue";
import Landing from "./Partials/Landing.vue";
import Introduction from "./Partials/Introduction.vue";

const logoState = ref("hidden");
// states: "hidden", "white", "black"

onMounted(() => {
  const options = {
    threshold: 0.2,
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        if (entry.target.id === "landing") {
          logoState.value = "hidden";
        } else if (entry.target.id === "introduction") {
          logoState.value = "white";
        } else if (entry.target.id === "details") {
          logoState.value = "black";
        } else if (entry.target.id === "footer") {
          logoState.value = "hidden";
        }
      }
    });
  }, options);

  ["landing", "introduction", "details", "footer"].forEach((id) => {
    const el = document.getElementById(id);
    if (el) observer.observe(el);
  });

  onBeforeUnmount(() => observer.disconnect());
});
</script>
<template>
  <Head title="Welcome" />
  
  <div class="w-full min-h-screen">
    <!-- Floating Logo -->
    <div
      class="fixed hidden sm:block w-fit top-5 sm:right-5 md:left-5 z-20 transition-colors duration-700 ease-in-out"
      :class="{
        '!opacity-0': logoState === 'hidden',
        'opacity-100 text-white': logoState === 'white',
        'opacity-100 text-black': logoState === 'black',
      }"
    >
      <p class="tracking-tight sm:text-base xl:text-lg">
        <b class="font-extrabold">Metanoia</b> Chương III
      </p>
      <span
        class="-mt-1.5 text-xl block font-display text-center rotate-[-4deg] mx-auto"
      >
        authenticity
      </span>
    </div>

    <!-- Landing Section -->
    <section id="landing">
      <Landing />
    </section>

    <!-- Animated Introduction Section -->
    <section id="introduction">
      <Introduction />
    </section>

    <!-- Details Section -->
    <section id="details">
      <Details />
    </section>

    <section id="footer"
      class="relative flex min-h-[80vh] w-full bg-[#1C1D21] text-white py-32"
    >
      <div class="w-full max-w-4xl mx-auto text-center">
        <h1 class="font-bold tracking-tighter text-4xl sm:text-5xl text-center">
          AI hỏi đáp tất cả về<br><span class="font-light text-4xl tracking-tight">Metanoia Chương III</span>
        </h1>

        <div class="mt-24">
          <input type="text" placeholder="Nhập câu hỏi của bạn..." class="w-full max-w-md mx-auto px-6 py-5 rounded-lg bg-[#FEFBF6] text-black focus:outline-none font-medium text-xl" />
        </div>
      </div>

      <div class="absolute w-full bottom-0 left-0 py-8 px-6 border-t border-dashed border-white/30 flex flex-row items-start sm:items-center justify-between">
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
        <div class="sm:w-1/3 text-right">
          <a href="https://instagram.com/triway.social" target="_blank"><img src="/images/igicon.svg" alt="Instagram" class="inline-block w-8 h-8 sm:w-10 sm:h-10" /></a>
        </div>
      </div>
    </section>
  </div>
</template>