<script setup lang="ts">
/**
 * @component PopupClose
 * @description Composant de dialogue de confirmation hautement personnalisable
 * 
 * @props {string} title - Titre du popup de confirmation (défaut: 'Confirmation')
 * @props {string} message - Message de confirmation (défaut: 'Êtes-vous sûr de vouloir fermer cette fenêtre ?')
 * @props {string} width - Classe Tailwind pour la largeur (défaut: 'w-80')
 * @props {string} bgColor - Classe Tailwind pour la couleur de fond (défaut: 'bg-white')
 * @props {string} cancelText - Texte du bouton d'annulation (défaut: 'Annuler')
 * @props {string} confirmText - Texte du bouton de confirmation (défaut: 'Fermer')
 * @props {string} cancelButtonClass - Classes Tailwind pour le bouton d'annulation
 * @props {string} confirmButtonClass - Classes Tailwind pour le bouton de confirmation
 * 
 * @emits {void} confirm - Émis lors de la confirmation
 * @emits {void} cancel - Émis lors de l'annulation
 * 
 * @example
 * <PopupClose
 *   title="Attention"
 *   message="Voulez-vous vraiment quitter ?"
 *   width="w-96"
 *   confirm-text="Quitter"
 *   confirm-button-class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600"
 *   @confirm="handleConfirm"
 *   @cancel="handleCancel"
 * />
 */
import IconButton from '@/Components/IconButton.vue';

interface Props {
  title?: string;
  message?: string;
  width?: string;
  bgColor?: string;
  cancelText?: string;
  confirmText?: string;
  cancelButtonClass?: string;
  confirmButtonClass?: string;
}

const props = withDefaults(defineProps<Props>(), {
  title: 'Confirmation',
  message: 'Êtes-vous sûr de vouloir fermer cette fenêtre ?',
  width: 'w-80',
  bgColor: 'bg-white',
  cancelText: 'Annuler',
  confirmText: 'Fermer',
  cancelButtonClass: 'px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100',
  confirmButtonClass: 'px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600'
});

defineEmits<{
  (e: 'confirm'): void
  (e: 'cancel'): void
}>();
</script>

<template>
  <div :class="[
    'rounded-[20px] p-6',
    width,
    bgColor
  ]">
    <!-- Contenu -->
    <div class="flex flex-col gap-4">
      <div class="text-center">
        <h3 class="text-xl font-bold mb-2">{{ title }}</h3>
        <p class="text-gray-600">{{ message }}</p>
      </div>
      
      <!-- Boutons d'action -->
      <div class="flex justify-center gap-4 mt-4">
        <button 
          @click="$emit('cancel')"
          :class="cancelButtonClass"
        >
          {{ cancelText }}
        </button>
        <button 
          @click="$emit('confirm')"
          :class="confirmButtonClass"
        >
          {{ confirmText }}
        </button>
      </div>
    </div>
  </div>
</template>
