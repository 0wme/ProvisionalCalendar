<script setup lang="ts">
import { ref, computed } from 'vue'
import IconButton from '@/Components/IconButton.vue'
import Filter from '@/Components/Filter.vue'
import Popup from '@/Components/Popup/Popup.vue'
import Button from '@/Components/Button.vue'

const props = defineProps<{
  years: string[]
}>()

const currentYearId = ref(0)
const showPopup = ref(false)
const showPreviousYears = ref(false)
const duplicateOption = ref('non')
const decrementYear = () => {
  if (currentYearId.value > 0) {
    currentYearId.value--
  } else {
    currentYearId.value = props.years.length - 1
  }
}

const incrementYear = () => {
  if (currentYearId.value < props.years.length - 1) {
    currentYearId.value++
  } else {
    currentYearId.value = 0
  }
}

const emit = defineEmits(['update:year', 'add'])
</script> 

<template>
  <div class="flex items-center gap-4">
    <Filter 
      :selected-item-name="years[currentYearId]"
      :has-border="true"
      @previous="decrementYear"
      @next="incrementYear"
    />

    <IconButton 
      @click="showPopup = true"
      icon-class="Plus"
      bg-color="#FFD8E4"
      icon-color="black"
      :small="false"
      :style="{ borderRadius: '8px', height: '42px', width: '42px', padding: '0' }"
    />

    <Popup 
      title="Ajout d'un calendrier prévisionnel"
      :show="showPopup"
      @close="showPopup = false"
    >
      <div class="flex flex-col gap-4">
        <div class="flex flex-col gap-2">
          <div class="flex items-center gap-4">
            <label class="text-lg font-medium">Dupliquer une année précédente</label>
            <div class="flex items-center gap-2">
              <label>
                <input type="radio" value="oui" v-model="duplicateOption" class="mr-1"/>Oui
              </label>
              <label>
                <input type="radio" value="non" v-model="duplicateOption" class="mr-1"/>Non
              </label>
            </div>
          </div>

          <div v-if="duplicateOption === 'oui'" class="flex flex-col gap-2">
            <label class="text-lg font-medium">Calendriers précédents</label>
            <select class="border border-gray-300 rounded-lg p-2">
              <option v-for="year in years" :key="year" :value="year">
                {{ year }}
              </option>
            </select>
          </div>

          <div v-if="duplicateOption === 'non'" class="flex flex-col gap-2">
            <label class="text-lg font-medium">Périodicité</label>
            <select class="border border-gray-300 rounded-lg p-2">
              <option value="semestre">Semestre</option>
            </select>
          </div>
        </div>

        <!-- Bouton Ajouter -->
        <div class="flex justify-center w-full">
          <Button @click="emit('add')" class="bg-green-500 text-white w-full">Ajouter</Button>
        </div>
      </div>
    </Popup>
  </div>
</template>