<script setup lang="ts">
/**
 * A script setup for a component that allows the user to add a promotion to a year.
 *
 * It emits a "success" event with the newly created promotion as argument when the
 * addition is successful.
 *
 * It uses the yearId prop to determine the year to which the promotion should be added.
 */
import FormInput from "@/Components/FormInput.vue";
import FormButton from "@/Components/FormButton.vue";
import { Promotion } from "@/types/models";
import axios, { AxiosError } from "axios";
import { API_ENDPOINTS, MESSAGES } from "@/constants";
import { ref } from "vue";
import ErrorPopup from "@/Features/Popup/ErrorPopup.vue";

const props = defineProps<{ yearId: number }>();

const promotion = ref<Promotion>({ id: 0, name: "" });
const nameError = ref<string | undefined>();

const errorMessage = ref<string | undefined>();

const emit = defineEmits(["success"]);

const updateName = (value: string) => {
    nameError.value = undefined;
    promotion.value.name = value;
};

const resetErrorMessage = () => {
    errorMessage.value = undefined;
};

const handleAdd = async () => {
    if (promotion.value.name.trim() === "") {
        nameError.value = MESSAGES.EMPTY_PROMOTION_NAME_ERROR_MESSAGE;
        return;
    }
    try {
        const response = await axios.post(
            `${API_ENDPOINTS.PROMOTION}/${props.yearId}`,
            promotion.value
        );
        emit("success", response.data.promotion);
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
            :value="promotion.name"
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
