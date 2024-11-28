<script setup lang="ts">
import Popup from '@/Components/Popup/Popup.vue';
import Button from '@/Components/Button.vue';
import CloseWithoutSaveConfirmationPopup from '@/Components/CloseWithoutSaveConfirmationPopup.vue';
import type { Teaching } from '@/types/models';
import { ref, watch } from 'vue';

const emit = defineEmits(['close', 'add']);

const formData = ref<Partial<Teaching>>({
  name: '',
  apogee_code: '',
  initial_cm: 0,
  initial_td: 0,
  initial_tp: 0,
  continuing_cm: 0,
  continuing_td: 0,
  continuing_tp: 0
});

const showCloseConfirmation = ref(false);
const hasChanges = ref(false);

watch(formData, (newValue) => {
  hasChanges.value = newValue.name !== '' || 
                     newValue.apogee_code !== '' ||
                     newValue.initial_cm !== 0 ||
                     newValue.initial_td !== 0 ||
                     newValue.initial_tp !== 0 ||
                     newValue.continuing_cm !== 0 ||
                     newValue.continuing_td !== 0 ||
                     newValue.continuing_tp !== 0;
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
  <div>
    <Popup 
      title="Ajouter une ressource" 
      :show="true"
      @close="closePopup"
    >
      <BaseTeachingForm v-model="formData">
        <template #actions>
          <div class="flex justify-end">
            <Button class="bg-green-500 text-white" @click="handlers.submit">
              Ajouter
            </Button>
          </div>
        </template>
      </BaseTeachingForm>
    </Popup>

    <CloseWithoutSaveConfirmationPopup
      v-if="showCloseConfirmation"
      :show="showCloseConfirmation"
      @close="handlers.confirmationClose"
      @cancel="handlers.confirmationCancel"
      @confirm="handlers.confirmationConfirm"
    />
  </div>
</template>