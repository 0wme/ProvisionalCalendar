<script setup lang="ts">
defineProps<{
    title: string;
}>();
</script>

<template>
    <div class="flex w-full">
        <div>
            {{ title }}
        </div>
        <div class="flex flex-col">
            <slot />
        </div>
    </div>
  </template>
  
  <style scoped>
  .row {
    display: contents;
  }
  </style>