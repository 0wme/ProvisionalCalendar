<script setup lang="ts">
/**
 * Script setup for the add promotion popup.
 *
 * This popup is used to add a new promotion. It contains a form to enter the
 * promotion's name and year, and a button to save the promotion. When the user
 * clicks on the button, the popup emits a "success" event with the promotion's
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
import EditPromotionForm from "@/Features/Forms/Groups/Promotion/EditPromotionForm.vue";
import CloseWithoutSaveConfirmationPopup from "@/Features/Popup/CloseWithoutSaveConfirmationPopup.vue";
import Popup from "@/Components/Popup/Popup.vue";
import { Promotion } from "@/types/models";
import { API_ENDPOINTS } from "@/constants";
import axios from "axios";

const props = defineProps<{ promotionId: number | undefined }>();

const emit = defineEmits([
    "cancel",
    "successfullyEdited",
    "successfullyDeleted",
]);

const promotion = ref<Promotion | undefined>();
const isCloseWithoutSaveConfirmationPopupVisible = ref<boolean>(false);
const hasBeenEdited = ref<boolean>(false);

onMounted(async () => {
    const response = await axios.get(
        `${API_ENDPOINTS.PROMOTION}/${props.promotionId}`
    );
    promotion.value = response.data;
});

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
    <Popup title="Modifier une promotion" @close="handleCancel">
        <EditPromotionForm
            v-if="promotion"
            :promotion
            @successfullyEdited="$emit('successfullyEdited')"
            @successfullyDeleted="$emit('successfullyDeleted')"
            @edited="hasBeenEdited = true"
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
</template>
