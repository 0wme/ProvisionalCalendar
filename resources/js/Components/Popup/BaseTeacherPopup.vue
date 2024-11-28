<script setup lang="ts">
import type { Teacher } from '@/types/models';

const props = defineProps<{
  modelValue: Partial<Teacher>;
}>();

const emit = defineEmits(['update:modelValue']);

const updateField = (key: keyof Teacher, value: string) => {
  emit('update:modelValue', { 
    ...props.modelValue, 
    [key]: value 
  });
};
</script>

<template>
  <div class="flex flex-col gap-6">
    <!-- Prénom -->
    <div class="flex flex-col gap-2">
      <label class="text-lg font-medium">Prénom</label>
      <input 
        :value="modelValue.firstname"
        @input="updateField('firstname', ($event.target as HTMLInputElement).value)"
        type="text" 
        class="border border-gray-300 rounded-lg p-2"
        placeholder="ex : Jean"
      />
    </div>

    <!-- Nom -->
    <div class="flex flex-col gap-2">
      <label class="text-lg font-medium">Nom</label>
      <input 
        :value="modelValue.lastname"
        @input="updateField('lastname', ($event.target as HTMLInputElement).value)"
        type="text" 
        class="border border-gray-300 rounded-lg p-2"
        placeholder="ex : Dupont"
      />
    </div>

    <slot name="actions" />
  </div>
</template>