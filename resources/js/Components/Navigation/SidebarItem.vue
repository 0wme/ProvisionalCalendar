<template>
    <li class="sidebar-item">
      <component :is="icon" class="icon" />
      <span>{{ label }}</span>
    </li>
  </template>
  
  <script setup lang="ts">
  import { defineProps } from 'vue';
  
  const props = defineProps({
    icon: Object,
    label: String,
  });
  </script>
  
  <style scoped>
  .sidebar-item {
    display: flex;
    align-items: center;
    padding: 10px;
    cursor: pointer;
  }
  
  .icon {
    margin-right: 10px;
  }
  </style>