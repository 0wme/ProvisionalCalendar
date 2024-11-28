<script setup lang="ts">
import Popup from '../Popup/Popup.vue';
import Button from '@/Components/Button.vue';
import BaseTeacherForm from '@/Components/Popup/BaseTeacherPopup.vue';
import CloseWithoutSaveConfirmationPopup from '@/Components/CloseWithoutSaveConfirmationPopup.vue';
import type { Teacher } from '@/types/models';
import { ref, watch } from 'vue';

const emit = defineEmits(['close', 'add']);

const formData = ref<Partial<Teacher>>({
  firstname: '',
  lastname: ''
});

const showCloseConfirmation = ref(false);
const hasChanges = ref(false);

watch(formData, (newValue) => {
  hasChanges.value = newValue.firstname !== '' || newValue.lastname !== '';
}, { deep: true });

const closePopup = () => {
  if (hasChanges.value) {
    showCloseConfirmation.value = true;
  } else {
    emit('close');
  }
};

const handlers = {
  submit: () => emit('add', formData.value),
  confirmationClose: () => showCloseConfirmation.value = false,
  confirmationCancel: () => showCloseConfirmation.value = false,
  confirmationConfirm: () => {
    showCloseConfirmation.value = false;
    emit('close');
  }
};
</script>

<template>
  <div class="fixed inset-0" style="z-index: 1000">
    <Popup 
      title="Ajouter un enseignant" 
      :show="true"
      custom-class="max-w-md"
      @close="closePopup"
    >
      <BaseTeacherForm v-model="formData">
        <template #actions>
          <div class="flex justify-end">
            <Button class="bg-green-500 text-white" @click="handlers.submit">
              Ajouter
            </Button>
          </div>
        </template>
      </BaseTeacherForm>
    </Popup>

    <CloseWithoutSaveConfirmationPopup
      v-if="showCloseConfirmation"
      :show="showCloseConfirmation"
      class="fixed inset-0"
      style="z-index: 1100"
      @close="handlers.confirmationClose"
      @cancel="handlers.confirmationCancel"
      @confirm="handlers.confirmationConfirm"
    />
  </div>
</template> 