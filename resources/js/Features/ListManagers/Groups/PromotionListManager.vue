<script setup lang="ts">
import ListManager from "@/Components/ListManager/ListManager.vue";
import { defineProps, defineEmits, onMounted, computed, ref } from "vue";
import { useLabelsStore } from "@/stores/labelsStore";
import { Item } from "@/types/models";
import AddPromotionPopup from "@/Features/Popups/Groups/Promotions/AddPromotionPopup.vue";
import EditPromotionPopup from "@/Features/Popups/Groups/Promotions/EditPromotionPopup.vue";
import ErrorPopup from "@/Features/Popups/ErrorPopup.vue";
import type { Promotion } from "@/types/models";
import { usePromotionService } from "@/services/groups/promotionService";

const labelsStore = useLabelsStore();

const props = defineProps<{ yearId: number; selectedPromotionId?: number }>();

const emit = defineEmits([
    "select",
    "successfullyAdded",
    "successfullyEdited",
    "successfullyDeleted",
]);

const promotionService = usePromotionService();
const promotions = ref<Item[] | undefined>();

const promotionToEditId = ref<number | undefined>();

const isAddPromotionPopupVisible = ref<boolean>(false);

const errorMessage = ref<string>();

onMounted(() => {
    fetchPromotions();
    labelsStore.fetchLabels();
});

const title = computed(() => {
    return labelsStore.getLabel("Promotion");
});

const showAddPromotionPopup = () => (isAddPromotionPopupVisible.value = true);
const hideAddPromotionPopup = () => (isAddPromotionPopupVisible.value = false);

const showEditPromotionPopup = (promotionId: number) =>
    (promotionToEditId.value = promotionId);
const hideEditPromotionPopup = () => (promotionToEditId.value = undefined);

const showError = (error: string) => (errorMessage.value = error);

const fetchPromotions = () => {
    promotionService
        .getPromotions(props.yearId)
        .then(
            (returnedPromotions: Promotion[]) =>
                (promotions.value = returnedPromotions)
        )
        .catch(showError);
};

const handleSelect = (item: number) => {
    emit("select", item);
};

const handleAdd = () => {
    showAddPromotionPopup();
};

const handleSuccessfullyAdded = () => {
    hideAddPromotionPopup();
    fetchPromotions();
    emit("successfullyAdded");
};

const handleSuccessfullyEdited = (promotion: Promotion) => {
    hideEditPromotionPopup();
    fetchPromotions();
    emit("successfullyEdited", promotion);
};

const handleSuccessfullyDeleted = (id: number) => {
    hideEditPromotionPopup();
    fetchPromotions();
    emit("successfullyDeleted", id);
};
</script>

<template>
    <div>
        <ListManager
            :title="title"
            hasAdd
            canAdd
            :items="promotions"
            :selectedItemsId="
                selectedPromotionId ? [selectedPromotionId] : undefined
            "
            @select="handleSelect"
            @edit="showEditPromotionPopup"
            @add="handleAdd"
        />
        <AddPromotionPopup
            v-if="isAddPromotionPopupVisible"
            :yearId
            @successfullyAdded="handleSuccessfullyAdded"
            @cancel="hideAddPromotionPopup"
        />
        <EditPromotionPopup
            v-if="promotionToEditId"
            :promotionId="promotionToEditId"
            @successfullyEdited="handleSuccessfullyEdited"
            @successfullyDeleted="handleSuccessfullyDeleted"
            @cancel="hideEditPromotionPopup"
        />
        <ErrorPopup v-if="errorMessage" :message="errorMessage" />
    </div>
</template>
