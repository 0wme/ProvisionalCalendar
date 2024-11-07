<script setup lang="ts">
/**
 * @component PopupClose
 * @description Composant de boîte de dialogue de confirmation pour la fermeture d'une fenêtre
 * 
 * @emits confirm - Émis lorsque l'utilisateur confirme la fermeture
 * @emits cancel - Émis lorsque l'utilisateur annule la fermeture
 * 
 * @example
 * <PopupClose
 *   @confirm="handleConfirm"
 *   @cancel="handleCancel"
 * />
 */
import IconButton from '@/Components/IconButton.vue';

defineEmits(['confirm', 'cancel']);
</script>

<template>
  <div class="rounded-[20px] p-6 w-80 bg-white">
    <div class="flex flex-col gap-4">
      <div class="text-center">
        <h3 class="text-xl font-bold mb-2">Confirmation</h3>
        <p class="text-gray-600">Êtes-vous sûr de vouloir fermer cette fenêtre ?</p>
      </div>
      
      <div class="flex justify-center gap-4 mt-4">
        <button 
          @click="$emit('cancel')"
          class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100"
        >
          Annuler
        </button>
        <button 
          @click="$emit('confirm')"
          class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600"
        >
          Fermer
        </button>
      </div>
    </div>
  </div>
</template>
