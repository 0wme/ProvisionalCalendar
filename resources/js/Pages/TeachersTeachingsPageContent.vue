<template>
    <div class="page-content">
      <Sidebar />
      <div class="main-content">
      </div>
    </div>
  </template>
  
  <script setup lang="ts">
  import Sidebar from '../Components/Navigation/Sidebar.vue';
  </script>
  
  <style scoped>
  .page-content {
    display: flex;
  }
  
  .main-content {
    flex-grow: 1;
    padding: 20px;
  }
  </style>