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
  import { ref, onMounted } from 'vue';
  import SidebarItem from './SidebarItem.vue';
  import { Calendar, Clock, Settings, Power } from 'lucide-vue-next';
  
  const items = [
    { icon: Calendar, label: 'Calendrier Prévisionnel', route: '/admin-calendar' },
    { icon: Clock, label: 'EDT', route: '/edt' },
    { icon: Settings, label: 'Service', route: '/service' },
    { icon: Power, label: 'Déconnexion', isSpacer: true },
  ];
  
  const activeItem = ref<string>('');
  const isCollapsed = ref(false);
  
  function setActiveItem(label: string) {
    activeItem.value = label;
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
      activeItem.value = currentItem.label;
    }
  });
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
  right: -25px;
  top: 50%;
  transform: translateY(-50%);
  background: #e7e7e7;
  border: 2px solid #e7e7e7;
  border-radius: 50%;
  width: 30px;
  height: 30px;
  display: flex;
  justify-content: center;
  align-items: center;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  cursor: pointer;
}

ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
</style>