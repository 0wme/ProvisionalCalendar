<script setup lang="ts">
import { ref } from 'vue';
import ListComponent from '@/Components/ListComponent.vue';
import InputComponent from '@/Components/InputComponent.vue';
import Button from '@/Components/Button.vue';
import IconButton from '@/Components/IconButton.vue';

const professors = ref([
  { label: 'Professeur A', value: 'profA' },
  { label: 'Professeur B', value: 'profB' },
  { label: 'Professeur C', value: 'profC' },
]);

const selectedProfessor = ref('');
const calendarName = ref('');
const evaluation = ref(false);
const replaced = ref(false);
const neutralized = ref(false);

const closePopup = () => {
  // Logic to close the popup
};

const modifyCalendar = () => {
  // Logic to modify the calendar
};
</script>


<template>
  <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Ajouter calendrier prévisionnel</h2>
        <IconButton icon-class="X" bg-color="#FF3B30" icon-color="white" @click="closePopup" />
      </div>

      <div class="mb-4">
        <ListComponent 
          label="Professeur" 
          :options="professors" 
          v-model="selectedProfessor" 
        />
      </div>

      <div class="mb-4">
        <InputComponent 
          label="Nom du calendrier" 
          v-model="calendarName" 
        />
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-black mb-1">Options</label>
        <div class="flex items-center mb-2">
          <input type="checkbox" id="evaluation" v-model="evaluation" class="mr-2">
          <label for="evaluation">Évaluation</label>
        </div>
        <div class="flex items-center mb-2">
          <input type="checkbox" id="replaced" v-model="replaced" class="mr-2">
          <label for="replaced">Remplacé</label>
        </div>
        <div class="flex items-center mb-2">
          <input type="checkbox" id="neutralized" v-model="neutralized" class="mr-2">
          <label for="neutralized">Neutralisé</label>
        </div>
      </div>

      <div class="flex justify-end">
        <Button @click="modifyCalendar">Modifier</Button>
      </div>
    </div>
  </div>
</template>
