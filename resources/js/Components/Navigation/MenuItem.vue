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
    <li class="menu-item flex flex-col items-center cursor-pointer">
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
.icon-wrapper {
    filter: brightness(100%);
    transition: filter 0.3s ease-in-out;
}

.menu-item:hover .icon-wrapper {
    filter: brightness(90%);
}
</style>