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
import { MESSAGES } from "@/constants";
import { ref } from "vue";
import ErrorPopup from "@/Features/Popup/ErrorPopup.vue";
import { useGroupService } from "@/services/groups/groupService";

const props = defineProps<{ promotionId: number }>();

const emit = defineEmits(["successfullyAdded", "edited"]);

const groupService = useGroupService();
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
    groupService
        .addGroup(props.promotionId, group.value)
        .then((returnedGroup) => emit("successfullyAdded", returnedGroup))
        .catch((error) => (errorMessage.value = error));
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
        <ErrorPopup
            v-if="errorMessage"
            :message="errorMessage!"
            @close="resetErrorMessage"
        />
    </div>
</template>
