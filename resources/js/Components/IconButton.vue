<!--
/**
 * @component IconButton
 * @description Bouton personnalisable avec une icône intégrée
 * 
 * @example
 * // Bouton standard
 * <IconButton 
 *   icon-class="Plus"
 *   bg-color="#FF3B30"
 *   icon-color="white"
 * />
 * 
 * // Petit bouton avec ombre
 * <IconButton 
 *   icon-class="X"
 *   bg-color="#4CAF50"
 *   icon-color="white"
 *   small
 *   has-shadow
 * />
 */
  -->

<script setup lang="ts">
import Icon from '@/Components/Icon.vue';

/**
 * Props du composant
 * @typedef {Object} Props
 * @property {string} iconClass - Nom de l'icône à afficher (requis)
 * @property {string} [bgColor] - Couleur de fond du bouton
 * @property {string} [iconColor] - Couleur de l'icône
 * @property {boolean} [small] - Mode compact du bouton
 * @property {boolean} [hasShadow] - Ajoute une ombre portée
 */
defineProps<{
  iconClass: string,
  bgColor?: string,
  iconColor?: string,
  small?: boolean,
  hasShadow?: boolean
}>()
</script>

<template>
  <!-- 
    Classes:
    - icon-button: classe de base
    - flex justify-center items-center: centrage de l'icône
    - cursor-pointer: curseur au survol
    - hover:brightness-75: effet de survol
    - small ? 'p-2 rounded-full' : 'p-4 rounded-xl': taille et bordures selon mode
    - shadow-md: ombre conditionnelle
  -->
  <button 
    :class="[
      'icon-button flex justify-center items-center cursor-pointer text-black hover:brightness-75',
      small ? 'p-2 rounded-full' : 'p-4 rounded-xl',
      { 'shadow-md': hasShadow }
    ]"
    :style="{ 'background-color': bgColor }"
  >
    <!-- 
      Composant Icon:
      - size: 16px en mode small, 24px en mode normal
      - stroke-width: épaisseur du trait de l'icône
    -->
    <Icon 
      :name="iconClass" 
      :size="small ? 16 : 24" 
      :color="iconColor" 
      stroke-width="2" 
    />
  </button>
</template>
