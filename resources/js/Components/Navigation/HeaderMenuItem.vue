<template>
    <li class="header-menu-item" @click="activate">
      <div :class="['icon-wrapper', { active: isActive }]">
        <component :is="icon" class="icon" />
      </div>
      <span class="label">{{ label }}</span>
    </li>
  </template>
  
  <script setup lang="ts">
  import { defineProps, defineEmits } from 'vue';
  
  const props = defineProps({
    icon: Object,
    label: String,
    isActive: Boolean,
  });
  
  const emit = defineEmits(['activate']);
  
  function activate() {
    emit('activate');
  }
  </script>
  
  <style scoped>
  .header-menu-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px;
    cursor: pointer;
    transition: transform 0.2s;
  }
  
  .icon-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 60px;
    height: 40px;
    border-radius: 20px;
    background-color: transparent;
    transition: background-color 0.3s;
  }
  
  .icon {
    width: 24px;
    height: 24px;
  }
  
  .label {
    text-align: center;
  }
  
  .header-menu-item:hover .icon-wrapper {
    background-color: #f0f0f0;
  }
  
  .icon-wrapper.active {
    background-color: #FFE5DA;
  }
  </style>