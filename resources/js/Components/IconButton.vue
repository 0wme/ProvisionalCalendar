<script setup lang="ts">

import Icon from '@/Components/Icon.vue';
const props = defineProps<{
  iconClass: string
}>()
</script>

<template>
  <button 
    class="icon-button"
    >
    <Icon :name="iconClass" />
  </button>
</template>

<style scoped>
.icon-button {
  display: flex;
  justify-content: center;
  justify-content: center;
  align-items: center;
  width: 80px;
  height: 80px;
  padding: 0;
  width: 80px;
  height: 80px;
  padding: 0;
  border: none;
  margin: 100px;
  border-radius: 20px;
  margin: 100px;
  border-radius: 20px;
  cursor: pointer;
  background-color: #ffc0cb;
  color: black;
  background-color: #ffc0cb;
  color: black;
}

.icon-button:hover {
  filter: brightness(0.8);
  filter: brightness(0.8);
}

.icon {
  font-size: 35px;
  font-size: 35px;
}
</style>