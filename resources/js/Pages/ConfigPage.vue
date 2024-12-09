<template>
    <AdminLayout>
        <TestComponent>
          <TestComponent><TestComponent /></TestComponent>
          <TestComponent><TestComponent /><TestComponent /></TestComponent>
        </TestComponent>
    </AdminLayout>
</template>
  
  <script setup lang="ts">
import TestComponent from '@/Components/TestComponent.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
</script>
  
  <style scoped>
  </style>