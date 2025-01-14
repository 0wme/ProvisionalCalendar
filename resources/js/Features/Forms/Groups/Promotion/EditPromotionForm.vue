<script setup lang="ts">
/**
 * A script setup for a component that allows the user to edit a promotion.
 *
 * It emits a "successfullyEdited" event with the edited promotion as argument when the
 * edition is successful.
 *
 * It emits a "successfullyDeleted" event with the deleted promotion as argument when the
 * deletion is successful.
 *
 * It emits an "edited" event when the user has changed the promotion's name.
 *
 * It uses the yearId and promotion props to determine the year and promotion to edit.
 */
import FormInput from "@/Components/FormInput.vue";
import FormButton from "@/Components/FormButton.vue";
import { Promotion } from "@/types/models";
import axios, { AxiosError } from "axios";
import { API_ENDPOINTS, MESSAGES } from "@/constants";
import { ref } from "vue";
import ErrorPopup from "@/Features/Popup/ErrorPopup.vue";
import DeleteConfirmationPopup from "@/Features/Popup/DeleteConfirmationPopup.vue";

const props = defineProps<{ promotion: Promotion }>();

const emit = defineEmits([
    "successfullyEdited",
    "successfullyDeleted",
    "edited",
]);

const editedPromotion = ref<Promotion>(props.promotion);
const nameError = ref<string | undefined>();

const errorMessage = ref<string | undefined>();

const isDeleteConfirmationPopupVisible = ref<boolean>(false);

const showDeleteConfirmationPopup = () =>
    (isDeleteConfirmationPopupVisible.value = true);
const hideDeleteConfirmationPopup = () =>
    (isDeleteConfirmationPopupVisible.value = false);

const updateName = (value: string) => {
    nameError.value = undefined;
    editedPromotion.value.name = value;
    emit("edited");
};

const resetErrorMessage = () => {
    errorMessage.value = undefined;
};

const handleEdit = async () => {
    if (editedPromotion.value.name.trim() === "") {
        nameError.value = MESSAGES.EMPTY_PROMOTION_NAME_ERROR_MESSAGE;
        return;
    }
    try {
        const response = await axios.put(
            `${API_ENDPOINTS.PROMOTION}/${props.promotion.id}`,
            editedPromotion.value
        );
        emit("successfullyEdited", response.data.promotion);
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
            `${API_ENDPOINTS.PROMOTION}/${props.promotion.id}`
        );
        hideDeleteConfirmationPopup();
        emit("successfullyDeleted", response.data.promotion);
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
            label="Nom de la promotion"
            :value="editedPromotion.name"
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
