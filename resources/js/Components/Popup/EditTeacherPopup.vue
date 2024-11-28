<script setup lang="ts">
import Popup from '../Popup/Popup.vue';
import Button from '@/Components/Button.vue';
import BaseTeacherForm from '@/Components/Popup/BaseTeacherPopup.vue';
import DeleteConfirmationPopup from '@/Components/DeleteConfirmationPopup.vue';
import CloseWithoutSaveConfirmationPopup from '@/Components/CloseWithoutSaveConfirmationPopup.vue';
import type { Teacher } from '@/types/models';
import { ref, watch } from 'vue';

const props = defineProps<{
  initialValues: Teacher;
}>();

const emit = defineEmits(['close', 'update', 'delete']);

const formData = ref<Teacher>({ ...props.initialValues });
const showConfirmation = ref({ delete: false, close: false });
const hasChanges = ref(false);

watch(formData, (newValue) => {
  hasChanges.value = 
    newValue.firstname !== props.initialValues.firstname ||
    newValue.lastname !== props.initialValues.lastname;
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
  <div class="fixed inset-0" style="z-index: 1000">
    <Popup 
      title="Modifier un enseignant" 
      :show="true"
      custom-class="max-w-md"
      @close="closePopup"
    >
      <BaseTeacherForm v-model="formData">
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
      </BaseTeacherForm>
    </Popup>

    <DeleteConfirmationPopup
      v-if="showConfirmation.delete"
      :show="showConfirmation.delete"
      class="fixed inset-0"
      style="z-index: 1100"
      @close="handlers.deleteClose"
      @cancel="handlers.deleteCancel"
      @delete="handlers.deleteConfirm"
    />
    
    <CloseWithoutSaveConfirmationPopup
      v-if="showConfirmation.close"
      :show="showConfirmation.close"
      class="fixed inset-0"
      style="z-index: 1100"
      @close="handlers.confirmationClose"
      @cancel="handlers.confirmationCancel"
      @confirm="handlers.confirmationConfirm"
    />
  </div>
</template> 