<script setup lang="ts">
/**
 * Script setup for the add group popup.
 *
 * This popup is used to add a new group. It contains a form to enter the
 * group's name and year, and a button to save the group. When the user
 * clicks on the button, the popup emits a "success" event with the group's
 * details.
 *
 * The popup also contains a "cancel" button that emits a "cancel" event when
 * clicked.
 *
 * If the user has made changes to the form but has not saved them, a confirmation
 * popup is shown when the user clicks on the "cancel" button. If the user
 * confirms, the popup emits a "cancel" event. If the user cancels, the
 * confirmation popup is hidden.
 */
import { ref, onMounted } from "vue";
import EditGroupForm from "@/Features/Forms/Groups/Group/EditGroupForm.vue";
import CloseWithoutSaveConfirmationPopup from "@/Features/Popup/CloseWithoutSaveConfirmationPopup.vue";
import Popup from "@/Components/Popup/Popup.vue";
import { Group } from "@/types/models";
import { useGroupService } from "@/services/groups/groupService";
import ErrorPopup from "../../ErrorPopup.vue";

const props = defineProps<{ groupId: number }>();

const emit = defineEmits([
    "cancel",
    "successfullyEdited",
    "successfullyDeleted",
]);

const groupService = useGroupService();
const group = ref<Group | undefined>();
const isCloseWithoutSaveConfirmationPopupVisible = ref<boolean>(false);
const hasBeenEdited = ref<boolean>(false);
const errorMessage = ref<string | undefined>();

const fetchGroup = () =>
    groupService
        .getGroup(props.groupId)
        .then((returnedGroup) => (group.value = returnedGroup))
        .catch((error) => (errorMessage.value = error));

onMounted(fetchGroup);

const showCloseWithoutSaveConfirmationPopup = () =>
    (isCloseWithoutSaveConfirmationPopupVisible.value = true);

const hideCloseWithoutSaveConfirmationPopup = () =>
    (isCloseWithoutSaveConfirmationPopupVisible.value = false);

const handleCancel = () =>
    hasBeenEdited.value
        ? showCloseWithoutSaveConfirmationPopup()
        : emit("cancel");

const handleCloseWithoutSaving = () => {
    hideCloseWithoutSaveConfirmationPopup();
    emit("cancel");
};

const handleHasBeenEdited = () => {
    hasBeenEdited.value = true;
};

const resetErrorMessage = () => {
    errorMessage.value = undefined;
};
</script>

<template>
    <Popup title="Modifier un groupe" @close="handleCancel">
        <EditGroupForm
            v-if="group"
            :group
            @successfullyEdited="$emit('successfullyEdited')"
            @successfullyDeleted="$emit('successfullyDeleted')"
            @edited="handleHasBeenEdited"
        />
        <div v-else class="w-full flex justify-center">
            <div>Chargement...</div>
        </div>
    </Popup>
    <CloseWithoutSaveConfirmationPopup
        v-if="isCloseWithoutSaveConfirmationPopupVisible"
        @close="handleCloseWithoutSaving"
        @cancel="hideCloseWithoutSaveConfirmationPopup"
    />
    <ErrorPopup
        v-if="errorMessage"
        :message="errorMessage"
        @close="resetErrorMessage"
    />
</template>
