<script setup lang="ts">
import Popup from '../Popup.vue';
import { ref, watch } from 'vue';

interface Props {
  isEditing?: boolean;
  initialValues?: {
    title?: string;
    code?: string;
    hours?: {
      cm: { initial: number; continuous: number };
      td: { initial: number; continuous: number };
      tp: { initial: number; continuous: number };
    };
  };
}

const props = withDefaults(defineProps<Props>(), {
  isEditing: false,
  initialValues: () => ({
    title: '',
    code: '',
    hours: {
      cm: { initial: 0, continuous: 0 },
      td: { initial: 0, continuous: 0 },
      tp: { initial: 0, continuous: 0 }
    }
  })
});

const emit = defineEmits(['close', 'submit', 'delete']);

const title = ref(props.initialValues.title);
const code = ref(props.initialValues.code);
const hours = ref(props.initialValues.hours);

// Ajouter un état pour suivre les modifications
const hasChanges = ref(false);

// Surveiller les changements dans les champs
watch([title, code, hours], () => {
  hasChanges.value = 
    title.value !== props.initialValues.title ||
    code.value !== props.initialValues.code ||
    JSON.stringify(hours.value) !== JSON.stringify(props.initialValues.hours);
}, { deep: true });

const handleSubmit = () => {
  const data = {
    title: title.value,
    code: code.value,
    hours: hours.value
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
    :title="isEditing ? 'Modifier une ressource' : 'Ajouter une ressource'"
    :button-text="isEditing ? 'Sauvegarder' : 'Ajouter'"
    :show-delete-button="isEditing"
    :show-confirmation-on-close="hasChanges"
    @close="$emit('close')"
    @submit="handleSubmit"
    @delete="$emit('delete')"
  >
    <template #content>
      <div class="flex flex-col gap-6">
        <!-- Intitulé -->
        <div class="flex flex-col gap-2">
          <label class="text-lg font-medium">Intitulé de la ressource</label>
          <input 
            v-model="title"
            type="text" 
            class="border border-gray-300 rounded-lg p-2"
            placeholder="ex : Développement web"
          />
        </div>

        <!-- Code Apogée -->
        <div class="flex flex-col gap-2">
          <label class="text-lg font-medium">Code Apogée</label>
          <input 
            v-model="code"
            type="text" 
            class="border border-gray-300 rounded-lg p-2"
            placeholder="ex : R1.01"
          />
        </div>

        <!-- Tableau des heures -->
        <div class="flex flex-col gap-2">
          <label class="text-lg font-medium">Volume horaire</label>
          <div class="border-2 border-gray-400 rounded-lg overflow-hidden">
            <!-- En-tête du tableau -->
            <div class="grid grid-cols-3 border-b-2 border-gray-400 bg-gray-200">
              <div class="p-2"></div>
              <div class="p-2 font-medium text-center border-x-2 border-gray-400">Initial</div>
              <div class="p-2 font-medium text-center">Continue</div>
            </div>

            <!-- CM -->
            <div class="grid grid-cols-3 border-b-2 border-gray-400">
              <div class="p-2 font-medium bg-yellow-300 text-center">CM</div>
              <div class="p-2 border-x-2 border-gray-400">
                <input 
                  v-model="hours.cm.initial"
                  type="number"
                  min="0"
                  class="w-full text-center border border-gray-300 rounded p-1"
                />
              </div>
              <div class="p-2">
                <input 
                  v-model="hours.cm.continuous"
                  type="number"
                  min="0"
                  class="w-full text-center border border-gray-300 rounded p-1"
                />
              </div>
            </div>

            <!-- TD -->
            <div class="grid grid-cols-3 border-b-2 border-gray-400">
              <div class="p-2 font-medium bg-red-400 text-center">TD</div>
              <div class="p-2 border-x-2 border-gray-400">
                <input 
                  v-model="hours.td.initial"
                  type="number"
                  min="0"
                  class="w-full text-center border border-gray-300 rounded p-1"
                />
              </div>
              <div class="p-2">
                <input 
                  v-model="hours.td.continuous"
                  type="number"
                  min="0"
                  class="w-full text-center border border-gray-300 rounded p-1"
                />
              </div>
            </div>

            <!-- TP -->
            <div class="grid grid-cols-3">
              <div class="p-2 font-medium bg-blue-400 text-center">TP</div>
              <div class="p-2 border-x-2 border-gray-400">
                <input 
                  v-model="hours.tp.initial"
                  type="number"
                  min="0"
                  class="w-full text-center border border-gray-300 rounded p-1"
                />
              </div>
              <div class="p-2">
                <input 
                  v-model="hours.tp.continuous"
                  type="number"
                  min="0"
                  class="w-full text-center border border-gray-300 rounded p-1"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </template>
  </Popup>
</template>