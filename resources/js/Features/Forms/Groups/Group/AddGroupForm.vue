<script setup lang="ts">
/**
 * A script setup for a component that allows the user to add a group to a year.
 *
 * It emits a "successfullyAdded" event with the newly created group as argument when the
 * addition is successful.
 *
 * It uses the yearId prop to determine the year to which the group should be added.
 */
import FormInput from "@/Components/FormInput.vue";
import FormButton from "@/Components/FormButton.vue";
import { Group } from "@/types/models";
import axios, { AxiosError } from "axios";
import { API_ENDPOINTS, MESSAGES } from "@/constants";
import { ref } from "vue";
import ErrorPopup from "@/Features/Popup/ErrorPopup.vue";

const props = defineProps<{ promotionId: number }>();

const emit = defineEmits(["successfullyAdded", "edited"]);

const group = ref<Group>({ id: 0, name: "" });
const nameError = ref<string | undefined>();

const errorMessage = ref<string | undefined>();

const updateName = (value: string) => {
    nameError.value = undefined;
    group.value.name = value;
    emit("edited");
};

const resetErrorMessage = () => {
    errorMessage.value = undefined;
};

const handleAdd = async () => {
    if (group.value.name.trim() === "") {
        nameError.value = MESSAGES.EMPTY_GROUP_NAME_ERROR_MESSAGE;
        return;
    }
    try {
        const response = await axios.post(
            `${API_ENDPOINTS.GROUP}/${props.promotionId}`,
            group.value
        );
        emit("successfullyAdded", response.data.group);
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
            label="Nom du groupe"
            :value="group.name"
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
