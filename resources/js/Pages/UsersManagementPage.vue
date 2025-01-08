<template>
  <ConfigLayout>
  <div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Gestion des Utilisateurs</h1>
    
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
      <table class="min-w-full">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="user in users" :key="user.id">
            <td class="px-6 py-4 whitespace-nowrap">{{ user.firstname }} {{ user.lastname }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ user.username }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                {{ user.role.name }}
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
              <button class="text-indigo-600 hover:text-indigo-900 mr-3">Modifier</button>
              <button class="text-red-600 hover:text-red-900">Supprimer</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  </ConfigLayout>
</template>

<script setup>
import { defineProps } from 'vue'
import ConfigLayout from '@/Layouts/ConfigLayout.vue';

const props = defineProps({
  users: {
    type: Array,
    required: true
  }
})
</script>
