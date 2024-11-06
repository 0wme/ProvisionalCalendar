<script setup lang="ts">

import { Pen } from 'lucide-vue-next';
const props = defineProps<{
  iconClass: string
}>()
</script>

<template>
  <button 
    class="icon-button"
    @click="$emit('click')"
    >
    <Pen size="32" /> 
    <Icon :name="iconClass" />
  </button>
</template>

<style scoped>
.icon-button {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 80px;
  height: 80px;
  padding: 0;
  border: none;
  margin: 100px;
  border-radius: 20px;
  cursor: pointer;
  background-color: #ffc0cb;
  color: black;
}

.icon-button:hover {
  filter: brightness(0.8);
}

.icon {
  font-size: 35px;
}
</style>