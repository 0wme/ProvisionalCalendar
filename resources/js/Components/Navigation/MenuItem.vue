<script setup lang="ts">
import { defineProps, onMounted, ref } from 'vue';
import Icon from '../Icon.vue';
import { MenuItem } from '@/types/models';

defineProps<{
    item: MenuItem,
    active: boolean,
}>();
</script>

<template>
    <li :class="['menu-item flex flex-col items-center', { 'disabled': item.disable }]">
        <div :class="[
            'icon-wrapper flex justify-center items-center w-14 h-10 rounded-3xl',
            ( active ? 'bg-red-100' : 'bg-white' )
        ]">
            <Icon :name="item.iconClass" :size="24" :strokeWidth="2" />
        </div>
        <span class="text-center">{{ item.label }}</span>
    </li>
</template>

<style scoped>
.disabled {
    opacity: 0.3 !important;
    cursor: default !important;
    pointer-events: none !important;
}

.icon-wrapper {
    filter: brightness(100%);
    transition: filter 0.3s ease-in-out;
}

.disabled {
    opacity: 0.5;
}

.menu-item:hover:not(.disabled) {
    cursor: pointer;
}

.menu-item:hover:not(.disabled) .icon-wrapper {
    filter: brightness(90%);
}
</style>