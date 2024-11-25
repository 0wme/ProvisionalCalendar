<script setup lang="ts">
import type { Teaching } from '@/types/models';

const props = defineProps<{
  modelValue: Partial<Teaching>;
}>();

const emit = defineEmits(['update:modelValue']);

const updateField = (key: keyof Teaching, value: string | number) => {
  emit('update:modelValue', { 
    ...props.modelValue, 
    [key]: value 
  });
};
</script>

<template>
  <div class="flex flex-col gap-6">
    <div class="flex flex-col gap-2">
      <label class="text-lg font-medium">Intitulé de la ressource</label>
      <input 
        :value="modelValue.name"
        @input="updateField('name', ($event.target as HTMLInputElement).value)"
        type="text"
        placeholder="ex : Développement web"
        class="border border-gray-300 rounded-lg p-2"
      />
    </div>

    <div class="flex flex-col gap-2">
      <label class="text-lg font-medium">Code Apogée</label>
      <input 
        :value="modelValue.apogee_code"
        @input="updateField('apogee_code', ($event.target as HTMLInputElement).value)"
        type="text"
        placeholder="ex : R1.01"
        class="border border-gray-300 rounded-lg p-2"
      />
    </div>

    <div class="flex flex-col gap-2">
      <label class="text-lg font-medium">Volume horaire</label>
      <div class="border-2 border-gray-400 rounded-lg overflow-hidden">
        <div class="grid grid-cols-3 border-b-2 border-gray-400 bg-gray-200">
          <div class="p-2" />
          <div class="p-2 font-medium text-center border-x-2 border-gray-400">Initial</div>
          <div class="p-2 font-medium text-center">Continue</div>
        </div>

        <div class="grid grid-cols-3 border-b-2 border-gray-400">
          <div class="p-2 font-medium text-center bg-yellow-300">CM</div>
          <div class="p-2 border-x-2 border-gray-400">
            <input 
              :value="modelValue.initial_cm"
              @input="updateField('initial_cm', Number(($event.target as HTMLInputElement).value))"
              type="number"
              min="0"
              class="w-full text-center border border-gray-300 rounded p-1"
            />
          </div>
          <div class="p-2">
            <input 
              :value="modelValue.continuing_cm"
              @input="updateField('continuing_cm', Number(($event.target as HTMLInputElement).value))"
              type="number"
              min="0"
              class="w-full text-center border border-gray-300 rounded p-1"
            />
          </div>
        </div>

        <div class="grid grid-cols-3 border-b-2 border-gray-400">
          <div class="p-2 font-medium text-center bg-red-400">TD</div>
          <div class="p-2 border-x-2 border-gray-400">
            <input 
              :value="modelValue.initial_td"
              @input="updateField('initial_td', Number(($event.target as HTMLInputElement).value))"
              type="number"
              min="0"
              class="w-full text-center border border-gray-300 rounded p-1"
            />
          </div>
          <div class="p-2">
            <input 
              :value="modelValue.continuing_td"
              @input="updateField('continuing_td', Number(($event.target as HTMLInputElement).value))"
              type="number"
              min="0"
              class="w-full text-center border border-gray-300 rounded p-1"
            />
          </div>
        </div>

        <div class="grid grid-cols-3">
          <div class="p-2 font-medium text-center bg-blue-400">TP</div>
          <div class="p-2 border-x-2 border-gray-400">
            <input 
              :value="modelValue.initial_tp"
              @input="updateField('initial_tp', Number(($event.target as HTMLInputElement).value))"
              type="number"
              min="0"
              class="w-full text-center border border-gray-300 rounded p-1"
            />
          </div>
          <div class="p-2">
            <input 
              :value="modelValue.continuing_tp"
              @input="updateField('continuing_tp', Number(($event.target as HTMLInputElement).value))"
              type="number"
              min="0"
              class="w-full text-center border border-gray-300 rounded p-1"
            />
          </div>
        </div>
      </div>
    </div>

    <slot name="actions" />
  </div>
</template>