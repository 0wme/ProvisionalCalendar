<template>
    <div :class="['cell', sizeClass]" :style="{ height: `${height}rem` }">
      <slot></slot>
    </div>
  </template>
  
  <script setup lang="ts">
  import { defineProps, computed } from 'vue';
  
  const props = defineProps<{
    size: 'full' | 'third' | 'sixth';
    height: number;
  }>();
  
  const sizeClass = computed(() => {
    switch (props.size) {
      case 'third':
        return 'w-1/3';
      case 'sixth':
        return 'w-1/6';
      default:
        return 'w-full';
    }
  });
  </script>
  
  <style scoped>

.cell {
  display: flex; 
  flex-grow: 1; 
  width: 100%; 
  align-items: stretch;
  justify-content: stretch;
  box-sizing: border-box;
  border: 1px solid #000000;
}
  </style>