<script setup lang="ts">
/**
 * A script setup for a component that allows the user to edit a subgroup.
 *
 * It emits a "successfullyEdited" event with the edited subgroup as argument when the
 * edition is successful.
 *
 * It emits a "successfullyDeleted" event with the deleted subgroup as argument when the
 * deletion is successful.
 *
 * It emits an "edited" event when the user has changed the subgroup's name.
 *
 * It uses the yearId and subgroup props to determine the year and subgroup to edit.
 */
import FormInput from "@/Components/FormInput.vue";
import FormButton from "@/Components/FormButton.vue";
import { Subgroup } from "@/types/models";
import axios, { AxiosError } from "axios";
import { API_ENDPOINTS, MESSAGES } from "@/constants";
import { ref } from "vue";
import ErrorPopup from "@/Features/Popup/ErrorPopup.vue";
import DeleteConfirmationPopup from "@/Features/Popup/DeleteConfirmationPopup.vue";

const props = defineProps<{ subgroup: Subgroup }>();

const emit = defineEmits([
    "successfullyEdited",
    "successfullyDeleted",
    "edited",
]);

const editedSubgroup = ref<Subgroup>(props.subgroup);
const nameError = ref<string | undefined>();

const errorMessage = ref<string | undefined>();

const isDeleteConfirmationPopupVisible = ref<boolean>(false);

const showDeleteConfirmationPopup = () =>
    (isDeleteConfirmationPopupVisible.value = true);
const hideDeleteConfirmationPopup = () =>
    (isDeleteConfirmationPopupVisible.value = false);

const updateName = (value: string) => {
    nameError.value = undefined;
    editedSubgroup.value.name = value;
    emit("edited");
};

const resetErrorMessage = () => {
    errorMessage.value = undefined;
};

const handleEdit = async () => {
    if (editedSubgroup.value.name.trim() === "") {
        nameError.value = MESSAGES.EMPTY_SUBGROUP_NAME_ERROR_MESSAGE;
        return;
    }
    try {
        const response = await axios.put(
            `${API_ENDPOINTS.SUBGROUP}/${props.subgroup.id}`,
            editedSubgroup.value
        );
        emit("successfullyEdited", response.data.subgroup);
    } catch (error: unknown) {
        if (error instanceof AxiosError && error.response?.data?.error) {
            errorMessage.value = error.response.data.error;
        } else {
            errorMessage.value = MESSAGES.DEFAULT_ERROR_MESSAGE;
        }
    }
};

const handleDelete = async () => {
    try {
        const response = await axios.delete(
            `${API_ENDPOINTS.SUBGROUP}/${props.subgroup.id}`
        );
        hideDeleteConfirmationPopup();
        emit("successfullyDeleted", response.data.subgroup);
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
            label="Nom du sous-groupe"
            :value="editedSubgroup.name"
            :error="nameError"
            @input="updateName($event.target.value)"
        />
        <div class="flex gap-4 w-full">
            <FormButton
                class="bg-green-500 text-white w-full"
                @click="handleEdit"
                >Sauvegarder</FormButton
            >
            <FormButton
                class="bg-red-500 text-white w-full"
                @click="showDeleteConfirmationPopup"
                >Supprimer</FormButton
            >
        </div>
        <DeleteConfirmationPopup
            v-if="isDeleteConfirmationPopupVisible"
            @delete="handleDelete"
            @cancel="hideDeleteConfirmationPopup"
        />
        <ErrorPopup
            v-if="errorMessage"
            :message="errorMessage!"
            @close="resetErrorMessage"
        />
    </div>
</template>
