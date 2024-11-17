<script setup lang="ts">
import Icon from '@/Components/Icon.vue';

defineProps<{
  iconClass: string,
  bgColor?: string,
  iconColor?: string,
  small?: boolean,
  hasShadow?: boolean
}>()
</script>

<template>
  <button 
    :class="[
      'icon-button flex justify-center items-center cursor-pointer text-black brightness-100 transition-brightness duration-300 hover:brightness-75',
      small ? 'p-2 rounded-full' : 'p-4 rounded-xl',
      { 'shadow-md': hasShadow }
    ]"
    :style="{ 'background-color': bgColor }"
  >
    <Icon :name="iconClass" :size="small ? 16 : 24" :color="iconColor ?? 'black'" :strokeWidth="2" />
  </button>
</template>