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
import CloseWithoutSaveConfirmationPopup from "@/Features/Popups/CloseWithoutSaveConfirmationPopup.vue";
import Popup from "@/Components/Popup/PopupComponent.vue";
import { Promotion } from "@/types/models";
import { usePromotionService } from "@/services/groups/promotionService";
import ErrorPopup from "../../ErrorPopup.vue";

const props = defineProps<{ promotionId: number }>();

const emit = defineEmits([
    "cancel",
    "successfullyEdited",
    "successfullyDeleted",
]);

const promotionService = usePromotionService();

const promotion = ref<Promotion | undefined>();
const errorMessage = ref<string | undefined>();
const isCloseWithoutSaveConfirmationPopupVisible = ref<boolean>(false);
const hasBeenEdited = ref<boolean>(false);

const fetchPromotion = () =>
    promotionService
        .getPromotion(props.promotionId)
        .then((returnedPromotion) => (promotion.value = returnedPromotion))
        .catch((error) => (errorMessage.value = error));

onMounted(fetchPromotion);

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

const resetErrorMessage = () => (errorMessage.value = undefined);

const handleSuccessfullyEdited = (promotion: Promotion) => {
    hideCloseWithoutSaveConfirmationPopup();
    emit("successfullyEdited", promotion);
};

const handleSuccessfullyDeleted = (id: number) => {
    hideCloseWithoutSaveConfirmationPopup();
    emit("successfullyDeleted", id);
};
</script>

<template>
    <Popup title="Modifier une promotion" @close="handleCancel">
        <EditPromotionForm
            v-if="promotion"
            :promotion
            @successfullyEdited="handleSuccessfullyEdited"
            @successfullyDeleted="handleSuccessfullyDeleted"
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
