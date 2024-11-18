<template>
    <div :class="['header-menu', { collapsed: isCollapsed }]">
      <ul v-if="!isCollapsed">
        <HeaderMenuItem
          v-for="item in items"
          :key="item.label"
          :icon="item.icon"
          :label="item.label"
          :isActive="activeHeaderMenuItem === item.label"
          @activate="setActiveHeaderMenuItem(item.label)"
        />
      </ul>
      <button class="toggle-button" @click="toggleSidebar">
        <component :is="isCollapsed ? ChevronDown : ChevronUp" class="toggle-icon" />
      </button>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref, onMounted } from 'vue';
  import HeaderMenuItem from './HeaderMenuItem.vue';
  import { User, Book, Calendar, AlertCircle, Settings, ChevronUp, ChevronDown } from 'lucide-vue-next';
  
  const items = [
    { icon: User, label: 'Groupes', route: '/groupes' },
    { icon: Book, label: 'Enseignants/Enseignements', route: '/enseignants' },
    { icon: Calendar, label: 'Calendrier Prévisionnel', route: '/admin-calendar' },
    { icon: AlertCircle, label: 'Alertes', route: '/alertes' },
    { icon: Settings, label: 'Configurations', route: '/configurations' },
  ];
  
  const activeHeaderMenuItem = ref<string>('');
  const isCollapsed = ref(false);
  
  function setActiveHeaderMenuItem(label: string) {
    activeHeaderMenuItem.value = label;
    const item = items.find(i => i.label === label);
    if (item && item.route) {
      window.location.href = item.route;
    }
  }
  
  function toggleSidebar() {
    isCollapsed.value = !isCollapsed.value;
  }
  
  onMounted(() => {
    const currentPath = window.location.pathname;
    const currentItem = items.find(item => currentPath === item.route);
    if (currentItem) {
      activeHeaderMenuItem.value = currentItem.label;
    }
  });
  </script>
  
  <style scoped>
  .header-menu {
    width: 800px;
    background-color: #ffffff;
    padding: 10px;
    position: fixed;
    top: 10px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: max-height 0.3s ease;
  }
  
  .header-menu.collapsed {
    height: 0;
    padding: 0;
  }
  
  .toggle-button {
    position: absolute;
    bottom: -25px;
    left: 50%;
    transform: translateX(-50%);
    background: none;
    border: none;
    cursor: pointer;
    width: 40px;
    height: 40px;
    border-radius: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f0f0f0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
  
  .toggle-icon {
    width: 24px;
    height: 24px;
  }
  
  ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: space-around;
    width: 100%;
  }
  </style>