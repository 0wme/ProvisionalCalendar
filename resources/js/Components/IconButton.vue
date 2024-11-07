<script setup lang="ts">
import Icon from '@/Components/Icon.vue';

const props = defineProps<{
  iconClass: string,
  bgColor?: string,
  small?: boolean,
  hasShadow?: boolean
}>()
</script>

<template>
  <button 
    :class="['icon-button flex justify-center items-center cursor-pointer text-black hover:brightness-75', small ? 'w-8 h-8 rounded-full' : 'w-12 h-12 rounded-xl', { 'shadow-md': props.hasShadow }]"
    :style="{ '--bg-color': props.bgColor }"
  >
    <Icon :name="iconClass" :size="small ? 16 : 24" />
  </button>
</template>

<style scoped>
.icon-button {
  background-color: var(--bg-color);
}
</style>