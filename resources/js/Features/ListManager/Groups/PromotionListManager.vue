<script setup lang="ts">
import ListManager from "@/Components/ListManager/ListManager.vue";
import { defineProps, defineEmits, onMounted, computed, ref } from "vue";
import { useLabelsStore } from "@/stores/labelsStore";
import { Item } from "@/types/models";
import { API_ENDPOINTS, MESSAGES } from "@/constants";
import axios, { AxiosError } from "axios";
import AddPromotionPopup from "@/Features/Popup/Groups/Promotion/AddPromotionPopup.vue";
import EditPromotionPopup from "@/Features/Popup/Groups/Promotion/EditPromotionPopup.vue";
import ErrorPopup from "@/Features/Popup/ErrorPopup.vue";

const labelsStore = useLabelsStore();

const props = defineProps<{ yearId: number; selectedPromotionId?: number }>();

const emit = defineEmits(["select"]);

const promotions = ref<Item[] | undefined>();

const promotionToEditId = ref<number | undefined>();

const isAddPromotionPopupVisible = ref<boolean>(false);
const isEditPromotionPopupVisible = ref<boolean>(false);

const errorMessage = ref<string>();

onMounted(async () => {
    try {
        const response = await axios.get(
            `${API_ENDPOINTS.PROMOTION}s/${props.yearId}`
        );
        promotions.value = response.data;
    } catch (error: unknown) {
        if (error instanceof AxiosError && error.response?.data?.error) {
            errorMessage.value = error.response.data.error;
        } else {
            errorMessage.value = MESSAGES.DEFAULT_ERROR_MESSAGE;
        }
    }
});

const title = computed(() => {
    return labelsStore.getLabel("Promotion");
});

onMounted(async () => {
    await labelsStore.fetchLabels();
});

const showAddPromotionPopup = () => (isAddPromotionPopupVisible.value = true);
const hideAddPromotionPopup = () => (isAddPromotionPopupVisible.value = false);

const showEditPromotionPopup = () => (isEditPromotionPopupVisible.value = true);
const hideEditPromotionPopup = () =>
    (isEditPromotionPopupVisible.value = false);

const handleSelect = (item: number) => {
    emit("select", item);
};

const handleEdit = (item: number) => {
    promotionToEditId.value = item;
    showEditPromotionPopup();
};

const handleAdd = () => {
    showAddPromotionPopup();
};
</script>

<template>
    <div>
        <ListManager
            :title="title"
            hasAdd
            :items="promotions"
            :selectedItemsId="
                selectedPromotionId ? [selectedPromotionId] : undefined
            "
            @select="handleSelect"
            @edit="handleEdit"
            @add="handleAdd"
        />
        <AddPromotionPopup
            v-if="isAddPromotionPopupVisible"
            :yearId
            @cancel="hideAddPromotionPopup"
        />
        <EditPromotionPopup
            v-if="isEditPromotionPopupVisible"
            :promotionId="promotionToEditId"
            @cancel="hideEditPromotionPopup"
        />
        <ErrorPopup v-if="errorMessage" :message="errorMessage" />
    </div>
</template>
