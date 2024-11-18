<script setup lang="ts">
import Popup from '../Popup.vue';
import { ref, watch } from 'vue';

interface Props {
  isEditing?: boolean;
  initialValues?: {
    firstname?: string;
    lastname?: string;
    email?: string;
  };
}

const props = withDefaults(defineProps<Props>(), {
  isEditing: false,
  initialValues: () => ({
    firstname: '',
    lastname: '',
    email: ''
  })
});

const emit = defineEmits(['close', 'submit', 'delete']);

// États réactifs pour les champs du formulaire
const firstname = ref(props.initialValues.firstname);
const lastname = ref(props.initialValues.lastname);
const email = ref(props.initialValues.email);

// État pour suivre les modifications
const hasChanges = ref(false);

// Surveiller les changements dans les champs
watch([firstname, lastname, email], () => {
  hasChanges.value = 
    firstname.value !== props.initialValues.firstname ||
    lastname.value !== props.initialValues.lastname ||
    email.value !== props.initialValues.email;
});

const handleSubmit = () => {
  const data = {
    firstname: firstname.value,
    lastname: lastname.value,
    email: email.value
  };

  if (props.isEditing) {
    emit('update', data);
  } else {
    emit('add', data);
  }
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
    :show-confirmation-on-close="hasChanges"
    @close="$emit('close')"
    @submit="handleSubmit"
    @delete="$emit('delete')"
  >
    <template #content>
      <div class="flex flex-col gap-6">
        <!-- Prénom -->
        <div class="flex flex-col gap-2">
          <label class="text-lg font-medium">Prénom</label>
          <input 
            v-model="firstname"
            type="text" 
            class="border border-gray-300 rounded-lg p-2"
            placeholder="ex : Jean"
          />
        </div>

        <!-- Nom -->
        <div class="flex flex-col gap-2">
          <label class="text-lg font-medium">Nom</label>
          <input 
            v-model="lastname"
            type="text" 
            class="border border-gray-300 rounded-lg p-2"
            placeholder="ex : Dupont"
          />
        </div>

        <!-- Email -->
        <div class="flex flex-col gap-2">
          <label class="text-lg font-medium">Email</label>
          <input 
            v-model="email"
            type="email" 
            class="border border-gray-300 rounded-lg p-2"
            placeholder="ex : jean.dupont@univ.fr"
          />
        </div>
      </div>
    </template>
  </Popup>
</template>