<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps<{
    biggestCM: number;
    biggestTD: number;
    biggestTP: number;
}>();

const cmWidth = computed(() => `${props.biggestCM * 100}px`);
const tdWidth = computed(() => `${props.biggestTD * 100}px`);
const tpWidth = computed(() => `${props.biggestTP * 100}px`);
</script>

<template>
    <div class="flex">
        <!-- Empty space for left sidebar alignment -->
        <div class="w-12"></div>
        
        <!-- Headers container -->
        <div class="flex">
            <!-- CM Header -->
            <div class="flex items-center justify-center font-semibold text-yellow-600 bg-yellow-100 border-b border-gray-200 h-10" :style="{ width: cmWidth }">
                CM
            </div>
            <!-- TD Header -->
            <div class="flex items-center justify-center font-semibold text-red-600 bg-red-100 border-b border-gray-200 h-10" :style="{ width: tdWidth }">
                TD
            </div>
            <!-- TP Header -->
            <div class="flex items-center justify-center font-semibold text-blue-600 bg-blue-100 border-b border-gray-200 h-10" :style="{ width: tpWidth }">
                TP
            </div>
        </div>

        <!-- Empty space for right sidebar alignment -->
        <div class="w-36"></div>
    </div>
</template>
