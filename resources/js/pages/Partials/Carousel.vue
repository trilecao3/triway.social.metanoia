<script setup>
import { ref } from "vue";

// Helper to shuffle an array
function shuffle(array) {
  return array
    .map((value) => ({ value, sort: Math.random() }))
    .sort((a, b) => a.sort - b.sort)
    .map(({ value }) => value);
}

// Row 1: 1 → 17
const row1 = ref(shuffle([...Array(17).keys()].map(i => i + 1)));

// Row 2: 17 → 35
const row2 = ref(shuffle([...Array(19).keys()].map(i => i + 17)));
</script>
<template>
  <div class="w-full py-10 overflow-hidden">
    <!-- Row 1 -->
    <div class="flex space-x-3 sm:space-x-4 animate-marquee">
      <template v-for="i in row1" :key="'row1-' + i">
        <img :src="`/images/community/${i}.jpg`" class="h-40 w-56 object-cover rounded-xl shadow-md" />
      </template>
      <!-- duplicate for smooth loop -->
      <template v-for="i in row1" :key="'row1-dup-' + i">
        <img :src="`/images/community/${i}.jpg`" class="h-40 w-56 object-cover rounded-xl shadow-md" />
      </template>
    </div>

    <!-- Row 2 (slower & opposite direction if you want variety) -->
    <div class="flex space-x-3 sm:space-x-4 animate-marquee2 mt-3 sm:mt-4">
      <template v-for="i in row2" :key="'row2-' + i">
        <img :src="`/images/community/${i}.jpg`" class="h-40 w-56 object-cover rounded-xl shadow-md" />
      </template>
      <!-- duplicate -->
      <template v-for="i in row2" :key="'row2-dup-' + i">
        <img :src="`/images/community/${i}.jpg`" class="h-40 w-56 object-cover rounded-xl shadow-md" />
      </template>
    </div>
  </div>
</template>
<style scoped>
@keyframes marquee {
  0%   { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}
@keyframes marquee2 {
  0%   { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}
.animate-marquee {
  display: flex;
  width: max-content;
  animation: marquee 90s linear infinite;
}
.animate-marquee2 {
  display: flex;
  width: max-content;
  animation: marquee2 120s linear infinite reverse;
}
</style>