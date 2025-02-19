<script setup lang="ts">
/**
 * A reusable form input component.
 *
 * Can be used for text, password, checkbox or select.
 *
 * @prop {string} [label] - The label to display next to the input
 * @prop {string} [error] - The error message to display below the input
 * @prop {FormInputType} [type] - The type of the input
 * @prop {number|string} [value] - The value of the input
 * @prop {string} [placeholder] - The placeholder text to display in the input
 * @prop {boolean} [checked] - Whether the checkbox is checked
 * @prop {SelectOption[]} [options] - The options to display in the select
 */
import { SelectOption, FormInputType } from "@/types/models/utils";
import { defineProps } from "vue";

defineProps<{
    label?: string;
    error?: string;
    type?: FormInputType;
    value?: number | string;
    placeholder?: string;
    checked?: boolean;
    options?: SelectOption[];
}>();
</script>

<template>
    <div class="flex flex-col gap-1">
        <label
            class="text-lg flex items-center gap-4"
            v-if="type === FormInputType.CHECKBOX"
        >
            <input
                class="border-gray-300 rounded-lg w-8 h-8 text-gray-500"
                type="checkbox"
                :checked
                @input="$emit('input', $event)"
            />
            {{ label }}
        </label>
        <label v-else class="flex flex-col gap-1 text-lg font-medium">
            {{ label }}
            <select
                v-if="type === FormInputType.SELECT"
                class="border-gray-300 rounded-lg p-2"
                :value
                @input="$emit('input', $event)"
            >
                <option
                    v-for="option in options"
                    :key="option.value"
                    :value="option.value"
                >
                    {{ option.label }}
                </option>
            </select>
            <input
                v-else
                class="border-gray-300 rounded-lg p-2"
                :value
                :type
                :placeholder
                @input="$emit('input', $event)"
            />
        </label>
        <span v-if="error" class="text-red-500">
            {{ error }}
        </span>
    </div>
</template>
