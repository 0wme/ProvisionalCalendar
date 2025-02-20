<script setup lang="ts">
/**
 * A script setup for a component that allows the user to add a promotion to a year.
 *
 * It emits a "successfullyAdded" event with the newly created promotion as argument when the
 * addition is successful.
 *
 * It uses the yearId prop to determine the year to which the promotion should be added.
 */
import FormInput from "@/Components/FormInput.vue";
import FormButton from "@/Components/FormButton.vue";
import { Promotion } from "@/types/models/groups";
import { MESSAGES } from "@/constants";
import { ref } from "vue";
import ErrorPopup from "@/Features/Popups/ErrorPopup.vue";
import { usePromotionService } from "@/services/groups/promotionService";

const props = defineProps<{ yearId: number }>();

const emit = defineEmits(["successfullyAdded", "edited"]);

const promotionService = usePromotionService();
const promotion = ref<Promotion>({ id: 0, name: "" });
const nameError = ref<string | undefined>();

const errorMessage = ref<string | undefined>();

const updateName = (value: string) => {
    nameError.value = undefined;
    promotion.value.name = value;
    emit("edited");
};

const resetErrorMessage = () => {
    errorMessage.value = undefined;
};

const handleAdd = () => {
    if (promotion.value.name.trim() === "") {
        nameError.value = MESSAGES.EMPTY_PROMOTION_NAME_ERROR_MESSAGE;
        return;
    }
    promotionService
        .addPromotion(props.yearId, promotion.value)
        .then((returnedPromotion) =>
            emit("successfullyAdded", returnedPromotion)
        )
        .catch((error) => (errorMessage.value = error));
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
        <ErrorPopup
            v-if="errorMessage"
            :message="errorMessage!"
            @close="resetErrorMessage"
        />
    </div>
</template>
