<script setup lang="ts">
import IconButton from '@/Components/IconButton.vue';

defineProps<{
    show: boolean;
    title: string;
    customClass?: string;
}>();

const emit = defineEmits(['close']);
</script>

<template>
<div v-if="show" class="fixed inset-0">
    <div class="fixed inset-0 bg-black/50"></div>
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div :class="['bg-white rounded-lg p-6 relative w-full mx-auto', customClass]">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">{{ title }}</h2>
                <button @click="$emit('close')" class="text-gray-500 hover:text-gray-700">
                    <span class="sr-only">Fermer</span>
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <slot />
        </div>
    </div>
</div>
</template>