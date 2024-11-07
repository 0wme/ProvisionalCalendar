<script setup lang="ts">
import Icon from '@/Components/Icon.vue';
import IconButton from '@/Components/IconButton.vue';
</script>

<template>
  <div class="rounded-[20px] p-6 w-96">
    <!-- Première div avec titre et bouton de fermeture -->
    <div class="flex justify-between items-center mb-6">
      <label class="text-2xl font-bold">Ajouter unepromotion</label>
      <IconButton 
        icon-class="X"
        bg-color="#ff0000"
        color="#ffffff" 
        small
      />    
    </div>

    <!-- Deuxième div avec le formulaire -->
    <div class="flex flex-col gap-4">
      <label class="text-lg font-medium">Nom</label>
      <input 
        type="text" 
        class="border border-gray-300 rounded-lg p-2"
        placeholder="Ex : BUT 1"
      />
      <button class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 mt-2">
        Ajouter
      </button>
    </div>
  </div>
</template>