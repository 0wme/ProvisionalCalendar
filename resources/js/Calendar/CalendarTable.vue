<template>
    <div class="calendar-table">
      <table class="table-fixed w-full border-collapse border border-gray-300">
        <thead>
          <tr>
            <th class="border border-gray-300 p-2 bg-gray-200 w-1/12">Semaines</th>
            <th class="border border-gray-300 p-2 bg-gray-200">CM</th>
            <th class="border border-gray-300 p-2 bg-gray-200">TD</th>
            <th class="border border-gray-300 p-2 bg-gray-200">TP</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="week in weeks" :key="week">
            <td class="border border-gray-300 p-2 bg-gray-50">S{{ week }}</td>
            <td class="border border-gray-300 p-2 bg-gray-50 h-20">
              <div class="relative w-full h-full"></div>
            </td>
            <td class="border border-gray-300 p-2 bg-gray-50 relative h-20">
              <div
                v-for="i in 2"
                :key="i"
                class="absolute border-b border-gray-400 left-0 right-0"
                :style="{ top: `${(i - 1) * (100 / 3)}%`, height: `${100 / 3}%` }"
              ></div>
            </td>
            <td class="border border-gray-300 p-2 bg-gray-50 relative h-20">
              <div
                v-for="i in 5"
                :key="i"
                class="absolute border-b border-gray-400 left-0 right-0"
                :style="{ top: `${(i - 1) * (100 / 6)}%`, height: `${100 / 6}%` }"
              ></div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  
  const weeks = Array.from({ length: 30 }, (_, i) => i + 1); 
  const groups = ref([]);
  const subgroups = ref([]);
  
  onMounted(async () => {
    try {
      const response = await axios.get('/api/groupes/promotion/1'); 
      const promotionData = response.data;
  
      groups.value = promotionData.groups;
      subgroups.value = promotionData.groups.flatMap(group => group.subgroups);
  
      console.log('Promotion:', promotionData);
      console.log('Groupes:', groups.value);
      console.log('Sous-groupes:', subgroups.value);
  
    } catch (error) {
      console.error('Erreur lors de la récupération des groupes:', error);
    }
  });
  </script>
  
  <style scoped>
  .table-fixed {
    table-layout: fixed;
  }
  .relative {
    position: relative;
  }
  .absolute {
    position: absolute;
    width: 100%;
    box-sizing: border-box; 
  }
  .h-20 {
    height: 10rem; 
  }
  </style>