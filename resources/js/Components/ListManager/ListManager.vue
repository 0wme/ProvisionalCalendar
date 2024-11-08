<script setup lang="ts">
import { ref, computed, defineEmits, onMounted, onUnmounted } from 'vue';
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

const emit = defineEmits(['select']);

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
}

const handlePreviousPeriod = () => {
    selectedPeriodId.value = selectedPeriodId.value === 0 ? props.periods.length - 1 : (selectedPeriodId.value - 1);
}

const handleSearch = (event: Event) => {
    searchValue.value = (event.target as HTMLInputElement).value;
}

const listManager = ref<HTMLElement | null>(null)

const updateHeight = () => {
  const elements = listManager.value?.querySelectorAll(':scope > :not(.list-manager-items)');
  const elementsHeight = Array.from(elements || []).reduce((acc, el) => acc + el.clientHeight, 0);
  listManagerItemsHeight.value = `${listManager.value?.clientHeight - elementsHeight - (props.periods ? 96 : 80)}px`;
}

onMounted(() => {
  updateHeight();
  window.addEventListener('resize', updateHeight);
});

onUnmounted(() => {
  window.removeEventListener('resize', updateHeight);
});
</script>

<template>
  <div ref="listManager" class="list-manager p-6 bg-white rounded-3xl shadow-lg space-y-4" :style="{ '--list-manager-items-height': listManagerItemsHeight }">
    <h1 class="text-2xl font-bold">{{ title }}</h1>
    <SearchBar
        placeholder="Rechercher..." 
        :hasAdd
        :hasImport
        @input="handleSearch"
    />

    <Filter
        v-if="periods"
        class="w-52"
        hasBorder
        :selectedItemName="periods[selectedPeriodId].name"
        @previous="handlePreviousPeriod"
        @next="handleNextPeriod"
    />

    <div v-if="visibleItems.length > 0" class="list-manager-items overflow-y-scroll relative">
        <div class="absolute space-y-3 w-full">
            <SelectionnableEditableButton
                v-for="item in visibleItems"
                :item="item"
                :selected="selectedItemsId.includes(item.id)"
                @select="emit('select', item.id)"
            />
        </div>
    </div>

    <div v-else class="list-manager-items flex items-center justify-center">
        <p>Aucun élément trouvé</p>
    </div>
  </div>
</template>

<style scoped>
.list-manager-items {
    height: var(--list-manager-items-height);
}
</style>