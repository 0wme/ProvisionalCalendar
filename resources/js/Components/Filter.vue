<!--
/**
 * @component Filter
 * @description Composant de filtrage permettant de naviguer entre différentes valeurs avec des boutons précédent/suivant
 * 
 * @example Avec bordure
 * <Filter 
 *   :items="['Semestre 1', 'Semestre 2', 'Semestre 3']"
 *   hasBorder
 *   @change="handleFilterChange"
 * />
 * 
 * @example Sans bordure
 * <Filter 
 *   :items="['2023', '2024', '2025']"
 *   @change="handleFilterChange"
 * />
 */
-->
<script setup lang="ts">
import IconButton from './IconButton.vue';
import { ref } from 'vue';

const emit = defineEmits(['change']);

const props = defineProps<{
    items: string[],
    hasBorder: boolean
}>()

const selectedItemId = ref(0);

const handleNext = () => {
    selectedItemId.value = selectedItemId.value < (props.items.length - 1) ? (selectedItemId.value + 1) : 0;
    emit('change', selectedItemId.value);
}

const handlePrevious = () => {
    selectedItemId.value = selectedItemId.value === 0 ? props.items.length - 1 : (selectedItemId.value - 1);
    emit('change', selectedItemId.value);
}
</script>

<template>
    <div :class="['flex items-center justify-between gap-2', { 'border border-black rounded-xl p-1 shadow-lg bg-gray-100': props.hasBorder }]">
        <IconButton iconClass="ChevronLeft" bgColor="#FFD8E4" small @click="handlePrevious" />
        <p>{{ props.items[selectedItemId] }}</p>
        <IconButton iconClass="ChevronRight" bgColor="#FFD8E4" small @click="handleNext" />
    </div>
</template>
