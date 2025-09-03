<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import { Head } from "@inertiajs/vue3";
import Details from "./Partials/Details.vue";
import Landing from "./Partials/Landing.vue";
import Introduction from "./Partials/Introduction.vue";
import Footer from "./Partials/Footer.vue";

const logoState = ref("hidden");

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

// Preload Site
const isLoaded = ref(false);
const progress = ref(0);
const VIDEO_SRC = "/images/sequence.mp4";
let videoBlobUrl = null;
let fetchAbort = null;

async function preloadVideo(src) {
  // create a hidden <video> element if you don't already use one
  const video = document.createElement("video");
  video.preload = "auto";
  video.muted = true;
  video.playsInline = true;
  video.style.display = "none";
  document.body.appendChild(video);

  // Helper: snap to nearest 5%
  const snap5 = (n) => Math.min(100, Math.ceil(n / 5) * 5);

  // Try streaming via fetch to get byte-level progress (best UX)
  try {
    const controller = new AbortController();
    fetchAbort = controller;
    const resp = await fetch(src, { signal: controller.signal });

    if (!resp.ok) throw new Error("Fetch failed");

    const contentLength = resp.headers.get("content-length");
    const total = contentLength ? Number(contentLength) : 0;

    // If body and total bytes are present, stream to track progress
    if (resp.body && total > 0) {
      const reader = resp.body.getReader();
      const chunks = [];
      let loadedBytes = 0;

      while (true) {
        const { done, value } = await reader.read();
        if (done) break;
        chunks.push(value);
        loadedBytes += value.length;

        // compute percent and snap to 5%
        const pct = Math.round((loadedBytes / total) * 100);
        progress.value = snap5(pct);
      }

      // assemble blob and create object URL for the video
      const blob = new Blob(chunks, { type: "video/mp4" });
      videoBlobUrl = URL.createObjectURL(blob);
      video.src = videoBlobUrl;

      // wait for metadata + first playable frame
      await new Promise((resolve) => {
        video.addEventListener("loadedmetadata", resolve, { once: true });
      });

      // optionally wait for canplaythrough for safer playback (may not always fire)
      try {
        await new Promise((resolve, reject) => {
          const t = setTimeout(resolve, 1500); // fallback timeout
          video.addEventListener(
            "canplaythrough",
            () => {
              clearTimeout(t);
              resolve();
            },
            { once: true }
          );
        });
      } catch (_) {
        // ignore
      }

      // finalize
      progress.value = 100;

      setTimeout(() => {
        isLoaded.value = true;
      }, 750);
      
      return { videoElement: video, blobUrl: videoBlobUrl };
    }

    // fallback: server didn't provide content-length so use element's events
    throw new Error("No content-length or streaming not supported");
  } catch (err) {
    // FALLBACK: assign src directly to video element and use events
    // (this will let browser manage download; we just show approximate progress)
    try {
      // If a fetch attempt created partial data, abort and ignore
      if (fetchAbort) {
        fetchAbort.abort();
        fetchAbort = null;
      }
    } catch (_) {}

    // Attach src to video element for native loading
    video.src = src;

    // Simple staged progress UX:
    // - loadedmetadata -> ~50-80%
    // - canplaythrough / loadeddata -> 100%
    progress.value = 5; // small visible change quickly
    const onMeta = () => {
      progress.value = 60; // metadata available, we can show it quicker
    };
    const onPlayable = () => {
      progress.value = 100;
      isLoaded.value = true;
      cleanupListeners();
    };
    const onError = () => {
      // if video fails, let loader finish anyway (or handle error differently)
      progress.value = 100;
      isLoaded.value = true;
      cleanupListeners();
    };

    function cleanupListeners() {
      video.removeEventListener("loadedmetadata", onMeta);
      video.removeEventListener("canplaythrough", onPlayable);
      video.removeEventListener("loadeddata", onPlayable);
      video.removeEventListener("error", onError);
    }

    video.addEventListener("loadedmetadata", onMeta);
    // listen for either loadeddata or canplaythrough
    video.addEventListener("loadeddata", onPlayable);
    video.addEventListener("canplaythrough", onPlayable);
    video.addEventListener("error", onError);

    // prime decoding for some browsers
    video.play().then(() => video.pause()).catch(() => { /* ignore */ });

    // resolve when loaded finally
    return new Promise((resolve) => {
      const finalCheck = () => {
        if (isLoaded.value) return resolve({ videoElement: video, blobUrl: null });
        // fallback timeout to avoid forever-waiting:
        setTimeout(() => {
          progress.value = 100;
          isLoaded.value = true;
          cleanupListeners();
          resolve({ videoElement: video, blobUrl: null });
        }, 5000);
      };
      video.addEventListener("canplaythrough", () => {
        finalCheck();
      }, { once: true });
      // also call finalCheck after small delay to not hang if canplaythrough never fires
      setTimeout(finalCheck, 3000);
    });
  }
}

// Call it from onMounted (example)
onMounted(async () => {
  await preloadVideo(VIDEO_SRC);
});

// Cleanup on unmount — revoke blob URL and abort fetch if any
onBeforeUnmount(() => {
  if (fetchAbort) {
    try { fetchAbort.abort(); } catch (_) {}
  }
  if (videoBlobUrl) {
    try { URL.revokeObjectURL(videoBlobUrl); } catch (_) {}
  }
});
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