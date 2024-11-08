<!--
/**
 * @component Popup
 * @description Composant modal réutilisable pour afficher un formulaire ou du contenu avec confirmation de fermeture
 * 
 * @props {string} title - Titre du popup (défaut: 'Ajouter une promotion')
 * @props {string} width - Classe Tailwind pour la largeur (défaut: 'w-96')
 * @props {string} bgColor - Classe Tailwind pour la couleur de fond (défaut: 'bg-white')
 * @props {string} inputLabel - Label du champ de saisie (défaut: 'Nom')
 * @props {string} inputPlaceholder - Texte placeholder de l'input (défaut: 'Ex : BUT 1')
 * @props {string} buttonText - Texte du bouton principal (défaut: 'Ajouter')
 * @props {string} buttonColor - Classe Tailwind pour la couleur du bouton (défaut: 'bg-green-500')
 * 
 * @example
 * <Popup 
 *   title="Nouvelle promotion"
 *   width="w-[500px]"
 *   bg-color="bg-gray-50"
 *   input-label="Promotion"
 *   button-text="Créer"
 *   button-color="bg-blue-500"
 * />
 */
-->

<script setup lang="ts">
import Icon from '@/Components/Icon.vue';
import IconButton from '@/Components/IconButton.vue';
import PopupClose from '@/Components/PopupClose.vue';
import { ref } from 'vue';

interface Props {
  title?: string;
  width?: string;
  bgColor?: string;
  inputLabel?: string;
  inputPlaceholder?: string;
  buttonText?: string;
  buttonColor?: string;
}

const props = withDefaults(defineProps<Props>(), {
  title: 'Ajouter une promotion',
  width: 'w-96',
  bgColor: 'bg-white',
  inputLabel: 'Nom',
  inputPlaceholder: 'Ex : BUT 1',
  buttonText: 'Ajouter',
  buttonColor: 'bg-green-500'
});

/**
 * États du composant
 */
const showPopup = ref(true);
const showConfirmation = ref(false);

/**
 * Gestion des actions de fermeture
 */
const handleClose = () => {
  showConfirmation.value = true;
};

const confirmClose = () => {
  showPopup.value = false;
  showConfirmation.value = false;
};

const cancelClose = () => {
  showConfirmation.value = false;
};
</script>

<template>
  <div v-if="showPopup" class="relative">
    <!-- Container principal -->
    <div :class="[
      'rounded-[20px] p-6',
      width,
      bgColor
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

      <!-- Formulaire -->
      <div class="flex flex-col gap-4">
        <label class="text-lg font-medium">{{ inputLabel }}</label>
        <input 
          type="text" 
          class="border border-gray-300 rounded-lg p-2"
          :placeholder="inputPlaceholder"
        />
        <button :class="[
          buttonColor,
          'text-white py-2 px-4 rounded-lg hover:brightness-90 mt-2'
        ]">
          {{ buttonText }}
        </button>
      </div>
    </div>

    <!-- Popup de confirmation -->
    <div 
      v-if="showConfirmation" 
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center"
    >
      <PopupClose 
        @confirm="confirmClose"
        @cancel="cancelClose"
      />
    </div>
  </div>
</template>