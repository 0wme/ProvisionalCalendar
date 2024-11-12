<script setup lang="ts">
import IconButton from '@/Components/IconButton.vue';
import PopupClose from '@/Components/PopupClose.vue';
import { ref } from 'vue';

interface Props {
  title?: string;
  width?: string;
  bgColor?: string;
  buttonText?: string;
  buttonColor?: string;
  showDeleteButton?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
  title: 'Popup',
  width: 'w-96',
  bgColor: 'bg-white',
  buttonText: 'Valider',
  buttonColor: 'bg-green-500',
  showDeleteButton: false
});

const emit = defineEmits(['close', 'submit', 'delete']);

const showPopup = ref(true);
const showConfirmation = ref(false);

const handleClose = () => {
  showConfirmation.value = true;
};

const confirmClose = () => {
  showPopup.value = false;
  showConfirmation.value = false;
  emit('close');
};

const cancelClose = () => {
  showConfirmation.value = false;
};
</script>

<template>
  <div v-if="showPopup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <!-- Popup de confirmation -->
    <PopupClose 
      v-if="showConfirmation"
      class="absolute z-50"
      @confirm="confirmClose"
      @cancel="cancelClose"
    />

    <div :class="[
      'relative rounded-[20px] p-6',
      width,
      bgColor,
      { 'opacity-50': showConfirmation }
    ]">
      <!-- En-tête -->
      <div class="flex justify-between items-center mb-6">
        <label class="text-2xl font-bold">{{ title }}</label>
        <IconButton 
          icon-class="X"
          bg-color="#FF3B30"
          icon-color="#ffffff" 
          small
          @click="handleClose"
        />    
      </div>

      <!-- Contenu personnalisable -->    
      <div class="flex flex-col gap-4">
        <slot name="content"></slot>

        <!-- Boutons d'action personnalisables -->
        <div class="flex gap-4 mt-4">
          <slot name="actions">
            <template v-if="showDeleteButton">
              <button 
                class="w-full bg-red-500 text-white py-2 px-4 rounded-lg hover:brightness-90"
                @click="$emit('delete')"
              >
                Supprimer
              </button>
              <button 
                class="w-full bg-green-500 text-white py-2 px-4 rounded-lg hover:brightness-90"
                @click="$emit('submit')"
              >
                Sauvegarder
              </button>
            </template>
            <button 
              v-else
              :class="[
                buttonColor,
                'w-full text-white py-2 px-4 rounded-lg hover:brightness-90'
              ]"
              @click="$emit('submit')"
            >
              {{ buttonText }}
            </button>
          </slot>
        </div>
      </div>
    </div>
  </div>
</template>