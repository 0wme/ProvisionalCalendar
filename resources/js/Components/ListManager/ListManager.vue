<script setup lang="ts">
import { ref, computed, defineEmits, onMounted } from 'vue';
import Filter from '@/Components/Filter.vue';
import SearchBar from '@/Components/SearchBar.vue';
import SelectionnableEditableButton from './SelectionnableEditableButton.vue';
import { Period, Item } from '@/types/models';

const props = defineProps<{
  title: string;
  periods: Period[];
  items: Item[];
  hasFilter: boolean;
  hasAdd: boolean;
  hasImport: boolean;
}>();

const emit = defineEmits(['select', 'add', 'import', 'edit']);

const selectedPeriodId = ref(0);
const selectedItemsId = ref<number[]>([]);
const searchValue = ref('');
const listManagerItemsHeight = ref('0px');

const visibleItems = computed(() => {
  if (props.periods) 
    return props.items
      .filter(item => item.period.id === selectedPeriodId.value)
      .filter(item => item.name.toLowerCase().includes(searchValue.value.toLowerCase()));
  else
    return props.items
      .filter(item => item.name.toLowerCase().includes(searchValue.value.toLowerCase()));
});

const handleNextPeriod = () => {
  selectedPeriodId.value = selectedPeriodId.value < (props.periods.length - 1) ? (selectedPeriodId.value + 1) : 0;
};

const handlePreviousPeriod = () => {
  selectedPeriodId.value = selectedPeriodId.value === 0 ? props.periods.length - 1 : (selectedPeriodId.value - 1);
};

const handleSearch = (event: Event) => {
  searchValue.value = (event.target as HTMLInputElement).value;
};

const listManager = ref<HTMLElement | null>(null);

let isHeightSet = false; // Garde une trace si la hauteur est fixée

const updateHeight = () => {
  if (!listManager.value || isHeightSet) return; 

  // Sélectionne tous les enfants sauf `.list-manager-items`
  const elements = listManager.value.querySelectorAll(':scope > :not(.list-manager-items)');
  
  // Calcule la hauteur totale des autres éléments
  const elementsHeight = Array.from(elements).reduce((acc, el) => {
    const element = el as HTMLElement;
    return acc + element.offsetHeight;
  }, 0);

  // Hauteur disponible pour `.list-manager-items`
  const newHeight = listManager.value.offsetHeight - elementsHeight;

  // Fixe la hauteur initiale
  listManagerItemsHeight.value = `${Math.max(newHeight, 0)}px`;

  // Marque la hauteur comme fixée
  isHeightSet = true;
};

onMounted(() => {
  updateHeight();
});
</script>

<template>
  <div ref="listManager" class="list-manager p-6 bg-white rounded-3xl shadow-lg space-y-4">
    <h1 class="text-2xl font-bold">{{ title }}</h1>
    <SearchBar
      placeholder="Rechercher..."
      :hasAdd
      :hasImport
      @input="handleSearch"
      @add="emit('add')"
      @import="emit('import')"
    />
  
    <Filter
      v-if="periods"
      class="w-52"
      hasBorder
      :selectedItemName="periods[selectedPeriodId].name"
      @previous="handlePreviousPeriod"
      @next="handleNextPeriod"
    />
  
    <div 
      v-if="visibleItems.length > 0" 
      class="list-manager-items overflow-y-auto relative"
      :style="{ height: listManagerItemsHeight }"
    >
      <div class="space-y-3 w-full">
        <SelectionnableEditableButton
          v-for="item in visibleItems"
          :key="item.id"
          :item="item"
          :selected="selectedItemsId.includes(item.id)"
          @select="emit('select', item.id)"
          @edit="emit('edit', item)"
        />
      </div>
    </div>
  
    <div v-else class="list-manager-items flex items-center justify-center">
      <p>Aucun élément trouvé</p>
    </div>
  </div>
</template>

<style scoped>
.list-manager {
  max-width: 100%;
  width: 100%;
  box-sizing: border-box;
  min-height: 300px; 
  display: flex;
  flex-direction: column;
}

.list-manager-items {
  height: auto; 
  overflow-y: auto;
  box-sizing: border-box;
}
</style>
