<script setup lang="ts">
/**
 * Script setup for the add subgroup popup.
 *
 * This popup is used to add a new subgroup. It contains a form to enter the
 * subgroup's name and year, and a button to save the subgroup. When the user
 * clicks on the button, the popup emits a "success" event with the subgroup's
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
import { ref } from "vue";
import EditSubgroupForm from "@/Features/Forms/Groups/Subgroup/EditSubgroupForm.vue";
import CloseWithoutSaveConfirmationPopup from "@/Features/Popup/CloseWithoutSaveConfirmationPopup.vue";
import Popup from "@/Components/Popup/Popup.vue";
import { Subgroup } from "@/types/models";

defineProps<{ yearId: number; subgroup: Subgroup }>();

const emit = defineEmits([
    "cancel",
    "successfullyEdited",
    "successfullyDeleted",
]);

const isCloseWithoutSaveConfirmationPopupVisible = ref<boolean>(false);
const hasBeenEdited = ref<boolean>(false);

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
</script>

<template>
    <Popup title="Modifier une subgroup" @close="handleCancel">
        <EditSubgroupForm
            :yearId
            :subgroup
            @successfullyEdited="$emit('successfullyEdited')"
            @successfullyDeleted="$emit('successfullyDeleted')"
            @edited="hasBeenEdited = true"
        />
    </Popup>
    <CloseWithoutSaveConfirmationPopup
        v-if="isCloseWithoutSaveConfirmationPopupVisible"
        @close="handleCloseWithoutSaving"
        @cancel="hideCloseWithoutSaveConfirmationPopup"
    />
</template>
