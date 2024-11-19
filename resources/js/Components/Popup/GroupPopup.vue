<script setup lang="ts">
import Popup from '../Popup.vue';
import { ref } from 'vue';

interface Props {
  isEditing?: boolean;
  initialValue?: string;
  groups?: Array<{ id: number | string, name: string }>;
  isSubGroup?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
  isEditing: false,
  initialValue: '',
  groups: () => [],
  isSubGroup: false
});

const emit = defineEmits(['close', 'submit', 'delete']);
const inputValue = ref(props.initialValue);
const isChecked = ref(false);
const selectedGroup = ref('');

const handleSubmit = () => {
  emit('submit', {
    value: inputValue.value,
    isChecked: isChecked.value,
    selectedGroup: selectedGroup.value,
    isSubGroup: props.isSubGroup
  });
};

const handleDelete = () => {
  emit('delete');
};
</script>

<template>
  <Popup
    :title="isEditing 
      ? (isSubGroup ? 'Modifier un sous-groupe' : 'Modifier un groupe')
      : (isSubGroup ? 'Ajouter un sous-groupe' : 'Ajouter un groupe')"
    :button-text="isEditing ? 'Sauvegarder' : 'Valider'"
    :show-delete-button="isEditing"
    @close="$emit('close')"
    @submit="handleSubmit"
    @delete="handleDelete"
  >
    <template #content>
      <div class="flex flex-col gap-4">
        <label class="text-lg font-medium">
          {{ isSubGroup ? 'Nom du sous-groupe' : 'Nom du groupe' }}
        </label>
        <input 
          v-model="inputValue"
          type="text" 
          class="border border-gray-300 rounded-lg p-2"
          :placeholder="isSubGroup ? 'ex : TD1' : 'ex : G1'"
        />

        <div class="flex items-center gap-2">
          <input
            type="checkbox"
            v-model="isChecked"
            class="rounded border-gray-300 text-blue-600"
          >
          <span class="text-gray-700">
            Copier le prévisionnel à partir d'un {{ isSubGroup ? 'sous-groupe' : 'groupe' }}
          </span>
        </div>

        <div v-if="isChecked" class="flex flex-col gap-2">
          <label class="text-lg font-medium">
            Sélectionner un {{ isSubGroup ? 'sous-groupe' : 'groupe' }}
          </label>
          <select
            v-model="selectedGroup"
            class="border border-gray-300 rounded-lg p-2"
          >
            <option value="" class="text-gray-500">
              Sélectionnez un {{ isSubGroup ? 'sous-groupe' : 'groupe' }}
            </option>
            <option
              v-for="group in groups"
              :key="group.id"
              :value="group.id"
            >
              {{ group.name }}
            </option>
          </select>
        </div>
      </div>
    </template>
  </Popup>
</template> 