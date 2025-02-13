<script setup lang="ts">
import { MCCCFormInput } from "@/types/models/teachings";

defineProps<{ mcccFormInput: MCCCFormInput }>();

const emit = defineEmits(["updateMCCCFormInput"]);

const updateMCCCFormInput = (newMCCCFormInput: MCCCFormInput) => {
    emit("updateMCCCFormInput", newMCCCFormInput);
};
</script>

<template>
    <table class="border-separate border-spacing-0 text-center w-full">
        <tbody>
            <tr>
                <td />
                <td class="border-y border-l border-gray-300 rounded-tl-lg">
                    Initial
                </td>
                <td class="border border-gray-300 rounded-tr-lg">Continue</td>
            </tr>
            <tr>
                <td class="bg-yellow-200 rounded-tl-lg w-1/3">CM</td>
                <td class="p-0 border-b border-l border-gray-300 w-1/3">
                    <input
                        :value="mcccFormInput.initial_cm"
                        type="number"
                        class="p-2 bg-gray-200 text-center border-none w-full"
                        @input="
                            updateMCCCFormInput({
                                ...mcccFormInput,
                                initial_cm: Number(
                                    ($event.target as HTMLInputElement).value
                                ),
                            })
                        "
                    />
                </td>
                <td class="p-0 border-b border-x border-gray-300 w-1/3">
                    <input
                        :value="mcccFormInput.continuing_cm"
                        type="number"
                        class="p-2 bg-gray-200 text-center border-none w-full"
                        @input="
                            updateMCCCFormInput({
                                ...mcccFormInput,
                                continuing_cm: Number(
                                    ($event.target as HTMLInputElement).value
                                ),
                            })
                        "
                    />
                </td>
            </tr>
            <tr class="w-1/3">
                <td class="bg-red-400 w-1/3">TD</td>
                <td class="p-0 border-b border-l border-gray-300 w-1/3">
                    <input
                        :value="mcccFormInput.initial_td"
                        type="number"
                        class="p-2 bg-gray-200 text-center border-none w-full"
                        @input="
                            updateMCCCFormInput({
                                ...mcccFormInput,
                                initial_td: Number(
                                    ($event.target as HTMLInputElement).value
                                ),
                            })
                        "
                    />
                </td>
                <td class="p-0 border-b border-x border-gray-300 w-1/3">
                    <input
                        :value="mcccFormInput.continuing_td"
                        type="number"
                        class="p-2 bg-gray-200 text-center border-none w-full"
                        @input="
                            updateMCCCFormInput({
                                ...mcccFormInput,
                                continuing_td: Number(
                                    ($event.target as HTMLInputElement).value
                                ),
                            })
                        "
                    />
                </td>
            </tr>
            <tr class="w-1/3">
                <td class="bg-blue-400 rounded-bl-lg w-1/3">TP</td>
                <td class="p-0 border-b border-l border-gray-300 w-1/3">
                    <input
                        :value="mcccFormInput.initial_tp"
                        type="number"
                        class="p-2 bg-gray-200 text-center border-none w-full"
                        @input="
                            updateMCCCFormInput({
                                ...mcccFormInput,
                                initial_tp: Number(
                                    ($event.target as HTMLInputElement).value
                                ),
                            })
                        "
                    />
                </td>
                <td
                    class="p-0 border-b border-x border-gray-300 rounded-br-lg w-1/3"
                >
                    <input
                        :value="mcccFormInput.continuing_tp"
                        type="number"
                        class="p-2 bg-gray-200 text-center border-none rounded-br-lg w-full"
                        @input="
                            updateMCCCFormInput({
                                ...mcccFormInput,
                                continuing_tp: Number(
                                    ($event.target as HTMLInputElement).value
                                ),
                            })
                        "
                    />
                </td>
            </tr>
        </tbody>
    </table>
</template>
