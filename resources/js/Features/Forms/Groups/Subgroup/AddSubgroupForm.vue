<script setup lang="ts">
/**
 * A script setup for a component that allows the user to add a subgroup to a year.
 *
 * It emits a "successfullyAdded" event with the newly created subgroup as argument when the
 * addition is successful.
 *
 * It uses the yearId prop to determine the year to which the subgroup should be added.
 */
import FormInput from "@/Components/FormInput.vue";
import FormButton from "@/Components/FormButton.vue";
import { Subgroup } from "@/types/models";
import axios, { AxiosError } from "axios";
import { API_ENDPOINTS, MESSAGES } from "@/constants";
import { ref } from "vue";
import ErrorPopup from "@/Features/Popup/ErrorPopup.vue";

const props = defineProps<{ groupId: number }>();

const emit = defineEmits(["successfullyAdded", "edited"]);

const subgroup = ref<Subgroup>({ id: 0, name: "" });
const nameError = ref<string | undefined>();

const errorMessage = ref<string | undefined>();

const updateName = (value: string) => {
    nameError.value = undefined;
    subgroup.value.name = value;
    emit("edited");
};

const resetErrorMessage = () => {
    errorMessage.value = undefined;
};

const handleAdd = async () => {
    if (subgroup.value.name.trim() === "") {
        nameError.value = MESSAGES.EMPTY_SUBGROUP_NAME_ERROR_MESSAGE;
        return;
    }
    try {
        const response = await axios.post(
            `${API_ENDPOINTS.SUBGROUP}/${props.groupId}`,
            subgroup.value
        );
        emit("successfullyAdded", response.data.subgroup);
    } catch (error: unknown) {
        if (error instanceof AxiosError && error.response?.data?.error) {
            errorMessage.value = error.response.data.error;
        } else {
            errorMessage.value = MESSAGES.DEFAULT_ERROR_MESSAGE;
        }
    }
};
</script>

<template>
    <div class="flex flex-col gap-6">
        <FormInput
            label="Nom de la subgroup"
            :value="subgroup.name"
            :error="nameError"
            @input="updateName($event.target.value)"
        />
        <FormButton class="bg-green-500 text-white" @click="handleAdd"
            >Ajouter</FormButton
        >
    </div>
    <ErrorPopup
        v-if="errorMessage"
        :message="errorMessage!"
        @close="resetErrorMessage"
    />
</template>
