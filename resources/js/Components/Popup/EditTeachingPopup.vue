<script setup lang="ts">
import Popup from '../Popup/Popup.vue';
import Button from '@/Components/Button.vue';
import BaseTeachingForm from '@/Components/Popup/BaseTeachingPopup.vue';
import DeleteConfirmationPopup from '@/Components/DeleteConfirmationPopup.vue';
import CloseWithoutSaveConfirmationPopup from '@/Components/CloseWithoutSaveConfirmationPopup.vue';
import type { Teaching } from '@/types/models';
import { ref, watch } from 'vue';

const props = defineProps<{
  initialValues: Teaching;
}>();

const emit = defineEmits(['close', 'update', 'delete']);

const formData = ref<Teaching>({ ...props.initialValues });
const showConfirmation = ref({ delete: false, close: false });
const hasChanges = ref(false);

watch(formData, (newValue) => {
  hasChanges.value = 
    newValue.name !== props.initialValues.name ||
    newValue.apogee_code !== props.initialValues.apogee_code ||
    newValue.initial_cm !== props.initialValues.initial_cm ||
    newValue.initial_td !== props.initialValues.initial_td ||
    newValue.initial_tp !== props.initialValues.initial_tp ||
    newValue.continuing_cm !== props.initialValues.continuing_cm ||
    newValue.continuing_td !== props.initialValues.continuing_td ||
    newValue.continuing_tp !== props.initialValues.continuing_tp;
}, { deep: true });

const closePopup = () => {
  if (hasChanges.value) {
    showConfirmation.value.close = true;
  } else {
    emit('close');
  }
};

const handlers = {
  delete: () => showConfirmation.value.delete = true,
  submit: () => emit('update', formData.value),
  
  confirmationClose: () => showConfirmation.value.close = false,
  confirmationCancel: () => showConfirmation.value.close = false,
  confirmationConfirm: () => {
    showConfirmation.value.close = false;
    emit('close');
  },
  
  deleteClose: () => showConfirmation.value.delete = false,
  deleteCancel: () => showConfirmation.value.delete = false,
  deleteConfirm: () => {
    showConfirmation.value.delete = false;
    emit('delete');
    emit('close');
  }
};
</script>

<template>
  <div>
    <Popup 
      title="Modifier une ressource" 
      :show="true"
      @close="closePopup"
    >
      <BaseTeachingForm v-model="formData">
        <template #actions>
          <div class="flex gap-4 justify-end">
            <Button class="bg-red-500 text-white" @click="handlers.delete">
              Supprimer
            </Button>
            <Button class="bg-green-500 text-white" @click="handlers.submit">
              Sauvegarder
            </Button>
          </div>
        </template>
      </BaseTeachingForm>
    </Popup>

    <DeleteConfirmationPopup
      v-if="showConfirmation.delete"
      :show="showConfirmation.delete"
      @close="handlers.deleteClose"
      @cancel="handlers.deleteCancel"
      @delete="handlers.deleteConfirm"
    />
    
    <CloseWithoutSaveConfirmationPopup
      v-if="showConfirmation.close"
      :show="showConfirmation.close"
      @close="handlers.confirmationClose"
      @cancel="handlers.confirmationCancel"
      @confirm="handlers.confirmationConfirm"
    />
  </div>
</template>