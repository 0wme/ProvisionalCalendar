<script setup lang="ts">
/**
 * A script setup for a component that allows the user to edit a group.
 *
 * It emits a "successfullyEdited" event with the edited group as argument when the
 * edition is successful.
 *
 * It emits a "successfullyDeleted" event with the deleted group as argument when the
 * deletion is successful.
 *
 * It emits an "edited" event when the user has changed the group's name.
 *
 * It uses the yearId and group props to determine the year and group to edit.
 */
import FormInput from "@/Components/FormInput.vue";
import FormButton from "@/Components/FormButton.vue";
import { Group } from "@/types/models";
import { MESSAGES } from "@/constants";
import { ref } from "vue";
import ErrorPopup from "@/Features/Popups/ErrorPopup.vue";
import DeleteConfirmationPopup from "@/Features/Popups/DeleteConfirmationPopup.vue";
import { useGroupService } from "@/services/groups/groupService";

const props = defineProps<{ group: Group }>();

const emit = defineEmits([
    "successfullyEdited",
    "successfullyDeleted",
    "edited",
]);

const groupService = useGroupService();

const editedGroup = ref<Group>(props.group);
const nameError = ref<string | undefined>();

const errorMessage = ref<string | undefined>();

const isDeleteConfirmationPopupVisible = ref<boolean>(false);

const showDeleteConfirmationPopup = () =>
    (isDeleteConfirmationPopupVisible.value = true);
const hideDeleteConfirmationPopup = () =>
    (isDeleteConfirmationPopupVisible.value = false);

const updateName = (value: string) => {
    nameError.value = undefined;
    editedGroup.value.name = value;
    emit("edited");
};

const resetErrorMessage = () => {
    errorMessage.value = undefined;
};

const handleEdit = async () => {
    if (editedGroup.value.name.trim() === "") {
        nameError.value = MESSAGES.EMPTY_GROUP_NAME_ERROR_MESSAGE;
        return;
    }
    groupService
        .updateGroup(editedGroup.value)
        .then((returnedGroup) => emit("successfullyEdited", returnedGroup))
        .catch((error) => (errorMessage.value = error));
};

const handleDelete = async () => {
    groupService
        .deleteGroup(props.group.id)
        .then(() => emit("successfullyDeleted", props.group.id))
        .catch((error) => (errorMessage.value = error));
};
</script>

<template>
    <div class="flex flex-col gap-6">
        <FormInput
            label="Nom du groupe"
            :value="editedGroup.name"
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
