<script setup lang="ts">
import Popup from './Popup.vue'
import Button from '@/Components/Button.vue'
import { ref } from 'vue'

const emit = defineEmits(['close', 'update', 'delete'])

defineProps<{
  show?: boolean
}>()

const formData = ref({
  teacher: '',
  isEvaluation: false,
  isReplaced: false,
  isNeutralized: false
})

const teachers = [
  { id: 1, name: 'John Doe' },
  { id: 2, name: 'Jane Smith' },
  // À remplacer par vos vraies données
]
</script>

<template>
  <Popup 
    title="Modification calendrier prévisionnel"
    :show="show"
    @close="emit('close')"
  >
    <div class="flex flex-col gap-4">
      <!-- Sélection du professeur -->
      <div class="flex flex-col gap-2">
        <label class="text-lg font-medium">Professeur</label>
        <select 
          v-model="formData.teacher"
          class="border border-gray-300 rounded-lg p-2"
        >
          <option value="">Sélectionnez un professeur</option>
          <option 
            v-for="teacher in teachers" 
            :key="teacher.id" 
            :value="teacher.id"
          >
            {{ teacher.name }}
          </option>
        </select>
      </div>

      <!-- Checkboxes -->
      <div class="flex flex-col gap-2">
        <div class="flex items-center gap-2">
          <input 
            type="checkbox"
            v-model="formData.isEvaluation"
            class="w-5 h-5 rounded border-gray-300"
          >
          <label>Evaluation</label>
        </div>

        <div class="flex items-center gap-2">
          <input 
            type="checkbox"
            v-model="formData.isReplaced"
            class="w-5 h-5 rounded border-gray-300"
          >
          <label>Remplacé</label>
        </div>

        <div class="flex items-center gap-2">
          <input 
            type="checkbox"
            v-model="formData.isNeutralized"
            class="w-5 h-5 rounded border-gray-300"
          >
          <label>Neutralisé</label>
        </div>
      </div>

      <!-- Boutons d'action -->
      <div class="flex gap-4 justify-end">
        <Button 
          class="bg-red-500 text-white" 
          @click="emit('delete')"
        >
          Supprimer
        </Button>
        <Button 
          class="bg-green-500 text-white"
          @click="emit('update', formData)"
        >
          Modifier
        </Button>
      </div>
    </div>
  </Popup>
</template> 