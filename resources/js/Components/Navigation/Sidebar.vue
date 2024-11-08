<template>
    <div :class="['sidebar', { collapsed: isCollapsed }]">
      <ul v-if="!isCollapsed">
        <SidebarItem
          v-for="item in items"
          :key="item.label"
          :icon="item.icon"
          :label="item.label"
          :isSpacer="item.isSpacer"
          :isActive="activeSidebarItem === item.label"
          @activate="handleItemClick(item)"
        />
      </ul>
      <button class="toggle-button" @click="toggleSidebar">
        <component :is="isCollapsed ? ChevronRight : ChevronLeft" class="toggle-icon" />
      </button>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref } from 'vue';
  import { router, usePage } from '@inertiajs/vue3';
  import SidebarItem from './SidebarItem.vue';
  import { Calendar, Clock, Settings, Power, ChevronLeft, ChevronRight } from 'lucide-vue-next';
  import type { User } from '@/types';
  
  const isCollapsed = ref(false);
  const activeSidebarItem = ref<string>('Calendrier Prévisionnel');
  const { props } = usePage<{ auth: { user: User } }>();
  
  // Déterminer la route du calendrier en fonction du rôle
  const calendarRoute = () => {
    switch (props.auth?.user?.role?.name) {
      case 'admin':
        return '/admin/calendar';
      case 'reader':
        return '/reader/calendar';
      case 'extended_reader':
        return '/extended/calendar';
      default:
        return '/admin/calendar';
    }
  };
  
  const items = [
    { icon: Calendar, label: 'Calendrier Prévisionnel', route: calendarRoute() },
    { icon: Clock, label: 'EDT', route: '/edt' },
    { icon: Settings, label: 'Service', route: '/service' },
    { icon: Power, label: 'Déconnexion', isSpacer: true },
  ];
  
  const toggleSidebar = () => {
    isCollapsed.value = !isCollapsed.value;
  };
  
  const handleItemClick = (item: any) => {
    if (item.label === 'Déconnexion') {
      router.post('/logout');
    } else {
      activeSidebarItem.value = item.label;
      router.get(item.route);
    }
  };
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
  }
  
  .toggle-icon {
    width: 24px;
    height: 24px;
  }
  
  ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  </style>