<template>
    <AdminLayout>
      <div class="h-full flex">
        <TeachersListManager :teachers="teachers" class="w-1/5" />
        <CalendarTable class="w-3/4 ml-4" />
      </div>
    </AdminLayout>
  </template>
  
  <script setup lang="ts">
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import AdminLayout from '@/Layouts/AdminLayout.vue';
  import TeachersListManager from '@/Features/ListManager/TeachersListManager.vue';
  import CalendarTable from '@/Calendar/CalendarTable.vue';
  
  const teachers = ref([]);
  
  onMounted(async () => {
    try {
      const teachersResponse = await axios.get('/api/enseignants/1');
      teachers.value = teachersResponse.data.map((teacher: any) => ({
        id: teacher.id,
        name: `${teacher.first_name} ${teacher.last_name}`,
      }));
    } catch (error) {
      console.error('Erreur lors de la récupération des enseignants:', error);
    }
  });
  </script>