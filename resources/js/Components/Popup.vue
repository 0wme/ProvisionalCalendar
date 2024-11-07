<!--
/**
 * @component Popup
 * @description Composant de popup modal pour ajouter une promotion avec confirmation de fermeture
 * 
 * @example
 * // Popup standard
 * <Popup />
 * 
 * // Popup avec gestion de la fermeture
 * <Popup 
 *   @close="handleClose"
 * />
 */
 -->

<script setup lang="ts">
import Icon from '@/Components/Icon.vue';
import IconButton from '@/Components/IconButton.vue';
import PopupClose from '@/Components/PopupClose.vue';
import { ref } from 'vue';

/**
 * États du composant
 * @property {Ref<boolean>} showPopup - Contrôle l'affichage de la popup principale
 * @property {Ref<boolean>} showConfirmation - Contrôle l'affichage de la popup de confirmation
 */
const showPopup = ref(true);
const showConfirmation = ref(false);

/**
 * Méthodes de gestion des popups
 * @method handleClose - Affiche la popup de confirmation
 * @method confirmClose - Ferme les deux popups
 * @method cancelClose - Ferme uniquement la popup de confirmation
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
  <!-- 
    Popup principale:
    - relative: pour le positionnement
    - v-if: contrôle l'affichage
  -->
  <div v-if="showPopup" class="relative">
    <!-- 
      Container principal:
      - rounded-[20px]: coins arrondis
      - p-6: padding interne
      - w-96: largeur fixe
      - bg-white: fond blanc
    -->
    <div class="rounded-[20px] p-6 w-96 bg-white">
      <!-- 
        En-tête de la popup:
        - flex justify-between: espacement entre titre et bouton
        - items-center: alignement vertical
        - mb-6: marge bas
      -->
      <div class="flex justify-between items-center mb-6">
        <label class="text-2xl font-bold">Ajouter une promotion</label>
        <IconButton 
          icon-class="X"
          bg-color="#FF3B30"
          icon-color="#ffffff" 
          small
          @click="handleClose"
        />    
      </div>

      <!-- 
        Contenu du formulaire:
        - flex flex-col: disposition verticale
        - gap-4: espacement entre éléments
      -->
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

    <!-- 
      Popup de confirmation:
      - fixed inset-0: couvre tout l'écran
      - bg-black bg-opacity-50: overlay semi-transparent
      - flex items-center justify-center: centrage
    -->
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