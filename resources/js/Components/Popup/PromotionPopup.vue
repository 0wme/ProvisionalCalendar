<script setup lang="ts">
import Popup from './Popup.vue';
import { ref } from 'vue';

interface Props {
  isEditing?: boolean;
  initialValue?: string;
}

const props = withDefaults(defineProps<Props>(), {
  isEditing: false,
  initialValue: ''
});

const emit = defineEmits(['close', 'submit', 'delete']);
const inputValue = ref(props.initialValue);

const handleSubmit = () => {
  emit('submit', { value: inputValue.value });
};

const handleDelete = () => {
  emit('delete');
};
</script>

<template>
  <Popup
    :title="isEditing ? 'Modifier une promotion' : 'Ajouter une promotion'"
    :button-text="isEditing ? 'Sauvegarder' : 'Ajouter'"
    :show-delete-button="isEditing"
    @close="$emit('close')"
    @submit="handleSubmit"
    @delete="handleDelete"
  >
    <template #content>
      <div class="flex flex-col gap-4">
        <label class="text-lg font-medium">Nom de la promotion</label>
        <input 
          v-model="inputValue"
          type="text" 
          class="border border-gray-300 rounded-lg p-2"
          placeholder="Ex : BUT 1"
        />
      </div>
    </template>
  </Popup>
</template> 