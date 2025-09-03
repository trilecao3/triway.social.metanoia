<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import { Head } from "@inertiajs/vue3";
import Details from "./Partials/Details.vue";
import Landing from "./Partials/Landing.vue";
import Introduction from "./Partials/Introduction.vue";
import Footer from "./Partials/Footer.vue";

const logoState = ref("hidden");
const isLoaded = ref(false);
const progress = ref(0);

onMounted(() => {
  preloadImages().then(() => {
    isLoaded.value = true;
  });

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

// Preload Site
const frameCount = 300;
const currentFrame = (i) =>
  `/images/pawnbg/PawnComp_${String(i).padStart(5, "0")}.jpg`;

function preloadImages() {
  return new Promise((resolve) => {
    let loaded = 0;
    for (let i = 0; i < frameCount; i++) {
      const img = new Image();
      img.src = currentFrame(i);
      const updateProgress = () => {
        loaded++;
        let percent = Math.round((loaded / frameCount) * 100);

        // Snap to nearest multiple of 5
        progress.value = Math.min(100, Math.ceil(percent / 5) * 5);

        if (loaded === frameCount) {
          progress.value = 100; // make sure we end exactly at 100%
          resolve();
        }
      };

      img.onload = updateProgress;
      img.onerror = updateProgress;
    }
  });
}
</script>
<template>
  <Head title="Sự Kiện Metanoia III – Triway Social" />

  <!-- Loader Screen -->
  <transition name="fade">
    <div
      v-if="!isLoaded"
      class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-[#FEFBF6]"
    >
      <div>
        <p class="tracking-tight text-2xl sm:text-3xl xl:text-5xl">
          <b class="font-extrabold">Metanoia</b> Chương III
        </p>
        <span
          class="text-3xl sm:text-4xl xl:text-6xl block font-display rotate-[-4deg] mx-auto text-center text-blue-700"
        >
          authenticity
        </span>
      </div>
      <div class="sm:mt-6 text-[6rem] sm:text-[6rem] xl:text-[8rem] font-bold opacity-90 tracking-tighter wave-text">{{ progress }}%</div>
    </div>
  </transition>
  
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

    <section id="footer">
      <Footer />
    </section>
  </div>
</template>
<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.8s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.wave-text {
  background: linear-gradient(90deg, #CB0404 20%, #111111 40%, #CB0404 100%);
  background-size: 200% 100%;
  background-clip: text;
  -webkit-background-clip: text;
  color: transparent;
  animation: waveText 5s linear infinite;
  white-space: nowrap;
  display: inline-block;
}

@keyframes waveText {
  0% {
    background-position: 200% 0;
  }
  100% {
    background-position: -200% 0;
  }
}
</style>