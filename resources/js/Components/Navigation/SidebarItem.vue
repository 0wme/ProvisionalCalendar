<template>
    <li class="sidebar-item" :class="{ spacer: isSpacer }" @click="activate">
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
    isSpacer: Boolean,
    isActive: Boolean,
  });
  
  const emit = defineEmits(['activate']);
  
  function activate() {
    emit('activate');
  }
  </script>
  
  <style scoped>
  .sidebar-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px 0;
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
  
  .sidebar-item:hover .icon-wrapper {
    background-color: #f0f0f0;
  }
  
  .icon-wrapper.active {
    background-color: #FFE5DA;
  }
  
  .spacer {
    margin-top: 40px; /* Ajoute un espace entre Service et Déconnexion */
  }
  </style>