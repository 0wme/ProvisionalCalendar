<script setup lang="ts">

import Icon from '@/Components/Icon.vue';
const props = defineProps<{
  iconClass: string
}>()
</script>

<template>
  <button 
    class="flex justify-center items-center w-20 h-20 rounded-[20px] cursor-pointer bg-pink-200 text-black hover:brightness-75"
    >
    <Icon :name="iconClass" class="text-4xl"  />
  </button>
</template>