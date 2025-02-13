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
import { ref, onMounted } from "vue";
import EditSubgroupForm from "@/Features/Forms/Groups/Subgroup/EditSubgroupForm.vue";
import CloseWithoutSaveConfirmationPopup from "@/Features/Popup/CloseWithoutSaveConfirmationPopup.vue";
import Popup from "@/Components/Popup/Popup.vue";
import { Subgroup } from "@/types/models";
import { useSubgroupService } from "@/services/groups/subgroupService";
import ErrorPopup from "../../ErrorPopup.vue";

const props = defineProps<{ subgroupId: number }>();

const emit = defineEmits([
    "cancel",
    "successfullyEdited",
    "successfullyDeleted",
]);

const subgroupService = useSubgroupService();
const subgroup = ref<Subgroup | undefined>();
const isCloseWithoutSaveConfirmationPopupVisible = ref<boolean>(false);
const hasBeenEdited = ref<boolean>(false);
const errorMessage = ref<string | undefined>();

const fetchSubgroup = () =>
    subgroupService
        .getSubgroup(props.subgroupId)
        .then(
            (returnedSubgroup: Subgroup) => (subgroup.value = returnedSubgroup)
        )
        .catch(showErrorPopup);

onMounted(fetchSubgroup);

const showErrorPopup = (error: string) => (errorMessage.value = error);

const showCloseWithoutSaveConfirmationPopup = () =>
    (isCloseWithoutSaveConfirmationPopupVisible.value = true);

const hideCloseWithoutSaveConfirmationPopup = () =>
    (isCloseWithoutSaveConfirmationPopupVisible.value = false);

const resetErrorMessage = () => (errorMessage.value = undefined);

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
</script>

<template>
    <Popup title="Modifier un sous-groupe" @close="handleCancel">
        <EditSubgroupForm
            v-if="subgroup"
            :subgroup
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
