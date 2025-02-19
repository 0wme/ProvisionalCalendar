<script setup lang="ts">
import IconButton from '@/Components/IconButton.vue';

defineProps<{
    title: string;
    show?: boolean;
}>();

const emit = defineEmits(['close']);
</script>

<template>
<div v-if="show" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="rounded-2xl p-6 bg-white flex flex-col gap-4 w-[400px]">
        <!-- Header -->
        <div class="flex justify-between gap-10 items-center">
            <h1 class="text-2xl font-bold">{{ title }}</h1>
            <IconButton 
                iconClass="X"
                bgColor="#FF3B30"
                iconColor="white" 
                small
                @click="emit('close')"
            />    
        </div>

        <!-- Content -->
        <div class="flex-1">
            <slot name="content">
                <slot />
            </slot>
        </div>

        <!-- Footer -->
        <div class="mt-4">
            <slot name="footer" />
        </div>
    </div>
</div>
</template>

<style scoped>
.popup-enter-active,
.popup-leave-active {
  transition: opacity 0.3s ease;
}

.popup-enter-from,
.popup-leave-to {
  opacity: 0;
}
</style>