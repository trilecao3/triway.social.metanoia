<script setup>
import { ref } from "vue";

const props = defineProps({
  show: {
    type: String,
    default: "both",
    validator: (val) => ["row1", "row2", "both"].includes(val),
  },
});

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
  <div class="w-full overflow-hidden">
    <!-- Row 1 -->
    <div
      v-if="show === 'row1' || show === 'both'"
      class="flex animate-marquee"
    >
      <template v-for="i in row1" :key="'row1-' + i">
        <img :src="`/images/community/${i}.jpg`" class="h-24 w-36 sm:h-40 sm:w-56 object-cover shadow-md" />
      </template>
      <!-- duplicate for smooth loop -->
      <template v-for="i in row1" :key="'row1-dup-' + i">
        <img :src="`/images/community/${i}.jpg`" class="h-24 w-36 sm:h-40 sm:w-56 object-cover shadow-md" />
      </template>
    </div>

    <!-- Row 2 (slower & opposite direction if you want variety) -->
    <div
      v-if="show === 'row2' || show === 'both'"
      class="flex animate-marquee2"
    >
      <template v-for="i in row2" :key="'row2-' + i">
        <img :src="`/images/community/${i}.jpg`" class="h-24 w-36 sm:h-40 sm:w-56 object-cover shadow-md" />
      </template>
      <!-- duplicate -->
      <template v-for="i in row2" :key="'row2-dup-' + i">
        <img :src="`/images/community/${i}.jpg`" class="h-24 w-36 sm:h-40 sm:w-56 object-cover shadow-md" />
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