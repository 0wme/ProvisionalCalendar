<template>
    <div class="sidebar">
      <ul>
        <SidebarItem v-for="item in items" :key="item.label" :icon="item.icon" :label="item.label" />
      </ul>
    </div>
  </template>
  
  <script setup lang="ts">
  import SidebarItem from './SidebarItem.vue';
  import { Calendar, Power } from 'lucide-vue-next';
  
  const items = [
    { icon: Calendar, label: 'Calendrier Prévisionnel' },
    { icon: Calendar, label: 'EDT' },
    { icon: Calendar, label: 'Service' },
    { icon: Power, label: 'Déconnexion' },
  ];
  </script>
  
  <style scoped>
  .sidebar {
    width: 200px;
    background-color: #f8f9fa;
    padding: 10px;
  }
  </style>