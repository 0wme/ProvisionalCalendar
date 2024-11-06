<template>
    <div :class="['sidebar', { collapsed: isCollapsed }]">
      <ul v-if="!isCollapsed">
        <SidebarItem
          v-for="item in items"
          :key="item.label"
          :icon="item.icon"
          :label="item.label"
          :isSpacer="item.isSpacer"
          :isActive="activeItem === item.label"
          @activate="setActiveItem(item.label)"
        />
      </ul>
      <button class="toggle-button" @click="toggleSidebar">
        <span v-if="isCollapsed">></span>
        <span v-else><</span>
      </button>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref } from 'vue';
  import SidebarItem from './SidebarItem.vue';
  import { Calendar, Clock, Settings, Power } from 'lucide-vue-next';
  
  const items = [
    { icon: Calendar, label: 'Calendrier Prévisionnel' },
    { icon: Clock, label: 'EDT' },
    { icon: Settings, label: 'Service' },
    { icon: Power, label: 'Déconnexion', isSpacer: true },
  ];
  
  const activeItem = ref<string>('');
  const isCollapsed = ref(false);
  
  function setActiveItem(label: string) {
    activeItem.value = label;
  }
  
  function toggleSidebar() {
    isCollapsed.value = !isCollapsed.value;
  }
  </script>
  
  <style scoped>
  .sidebar {
    width: 110px;
    background-color: #ffffff;
    padding: 10px;
    position: fixed;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: width 0.3s;
  }
  
  .sidebar.collapsed {
    width: 0;
    padding: 0;
  }
  
  .toggle-button {
    position: absolute;
    right: -20px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    font-size: 18px;
    margin-bottom: 10px;
  }
  
  ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  </style>