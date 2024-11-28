<script setup lang="ts">
import Popup from '@/Components/Popup/Popup.vue';
import Button from '@/Components/Button.vue';
defineProps<{
    show?: boolean;
}>();
</script>

<template>
  <div class="fixed inset-0" style="z-index: 1100">
    <Popup 
      title="Confirmation" 
      :show="show"
      custom-class="max-w-sm"
      @close="$emit('close')"
    >
      <div class="flex flex-col gap-4">
        <p>Voulez-vous vraiment fermer sans sauvegarder ?</p>
        
        <div class="flex justify-end gap-4">
          <Button 
            class="bg-gray-500 text-white" 
            @click="$emit('cancel')"
          >
            Annuler
          </Button>
          <Button 
            class="bg-red-500 text-white" 
            @click="$emit('confirm')"
          >
            Fermer
          </Button>
        </div>
      </div>
    </Popup>
  </div>
</template>