<script setup lang="ts">
import Popup from '../Popup.vue';
import { ref } from 'vue';

interface Props {
  isEditing?: boolean;
  initialValues?: {
    lastName?: string;
    firstName?: string;
    code?: string;
    email?: string;
  };
}

const props = withDefaults(defineProps<Props>(), {
  isEditing: false,
  initialValues: () => ({
    lastName: '',
    firstName: '',
    code: '',
    email: ''
  })
});

const emit = defineEmits(['close', 'submit', 'delete']);

const lastName = ref(props.initialValues.lastName);
const firstName = ref(props.initialValues.firstName);
const code = ref(props.initialValues.code);
const email = ref(props.initialValues.email);

const handleSubmit = () => {
  emit('submit', {
    lastName: lastName.value,
    firstName: firstName.value,
    code: code.value,
    email: email.value
  });
};

const handleDelete = () => {
  emit('delete');
};
</script>

<template>
  <Popup
    :title="isEditing ? 'Modifier un enseignant' : 'Ajouter un enseignant'"
    :button-text="isEditing ? 'Sauvegarder' : 'Ajouter'"
    :show-delete-button="isEditing"
    @close="$emit('close')"
    @submit="handleSubmit"
    @delete="handleDelete"
  >
    <template #content>
      <div class="flex flex-col gap-4">
        <!-- Nom -->
        <div class="flex flex-col gap-2">
          <label class="text-lg font-medium">Nom</label>
          <input 
            v-model="lastName"
            type="text" 
            class="border border-gray-300 rounded-lg p-2"
            placeholder="ex : Blanchard"
          />
        </div>

        <!-- Prénom -->
        <div class="flex flex-col gap-2">
          <label class="text-lg font-medium">Prénom</label>
          <input 
            v-model="firstName"
            type="text" 
            class="border border-gray-300 rounded-lg p-2"
            placeholder="ex : Rémi"
          />
        </div>

        <!-- Code -->
        <div class="flex flex-col gap-2">
          <label class="text-lg font-medium">Code</label>
          <input 
            v-model="code"
            type="text" 
            class="border border-gray-300 rounded-lg p-2"
            placeholder="ex : IUT"
          />
        </div>

        <!-- Email -->
        <div class="flex flex-col gap-2">
          <label class="text-lg font-medium">Email</label>
          <input 
            v-model="email"
            type="email" 
            class="border border-gray-300 rounded-lg p-2"
            placeholder="ex : remi.blanchard@iut.fr"
          />
        </div>
      </div>
    </template>
  </Popup>
</template>