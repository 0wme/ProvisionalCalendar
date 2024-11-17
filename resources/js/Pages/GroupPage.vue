<template>
    <div class="page-content">
      <HeaderMenu />
      <Sidebar />
      <div class="main-content">
        <div class="list-container">
          <ClassListManager :classes="classes" @select="handleClassSelect" />
          <GroupListManager :groups="groups" @select="handleGroupSelect" />
          <SubGroupManager :subGroups="subGroups" @select="handleSubGroupSelect" />
        </div>
      </div>
    </div>
  </template>
  
  <script setup lang="ts">
  import Sidebar from '../Components/Navigation/Sidebar.vue';
  import HeaderMenu from '../Components/Navigation/HeaderMenu.vue';
  import ClassListManager from '../Features/ListManager/ClassListManager.vue';
  import GroupListManager from '../Features/ListManager/GroupListManager.vue';
  import SubGroupManager from '../Features/ListManager/SubGroupListManager.vue';
  import { ref } from 'vue';
  import { Item } from '@/types/models';
  
  const classes = ref<Item[]>([
    { id: 1, name: 'BUT 1' },
    { id: 2, name: 'BUT 2' },
    { id: 3, name: 'BUT 3' },
  ]);
  
  const groups = ref<Item[]>([]);
  const subGroups = ref<Item[]>([]);
  
  const handleClassSelect = (id: number) => {
    console.log('Class selected:', id);
  }
  
  const handleGroupSelect = (id: number) => {
    console.log('Group selected:', id);
  }
  
  const handleSubGroupSelect = (id: number) => {
    console.log('SubGroup selected:', id);
  }
  </script>
  
  <style scoped>
  .page-content {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }
  
  .main-content {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
  }
  
  .list-container {
    display: flex;
    gap: 20px;
  }
  
  .list-container > * {
    height: 60vh;
  }
  </style>