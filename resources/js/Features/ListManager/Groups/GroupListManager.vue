<script setup lang="ts">
import ListManager from "@/Components/ListManager/ListManager.vue";
import { defineProps, defineEmits, onMounted, computed, ref, watch } from "vue";
import { useLabelsStore } from "@/stores/labelsStore";
import { Item } from "@/types/models";
import { API_ENDPOINTS, MESSAGES } from "@/constants";
import axios, { AxiosError } from "axios";
import AddGroupPopup from "@/Features/Popup/Groups/Group/AddGroupPopup.vue";
import EditGroupPopup from "@/Features/Popup/Groups/Group/EditGroupPopup.vue";
import ErrorPopup from "@/Features/Popup/ErrorPopup.vue";

const labelsStore = useLabelsStore();

const props = defineProps<{ promotionId?: number; selectedGroupId?: number }>();

const emit = defineEmits(["select"]);

const groups = ref<Item[] | undefined>();

const groupToEditId = ref<number | undefined>();

const isAddGroupPopupVisible = ref<boolean>(false);
const isEditGroupPopupVisible = ref<boolean>(false);

const errorMessage = ref<string>();

watch(
    () => props.promotionId,
    async () => {
        try {
            const response = await axios.get(
                `${API_ENDPOINTS.GROUP}s/${props.promotionId}`
            );
            groups.value = response.data;
        } catch (error: unknown) {
            if (error instanceof AxiosError && error.response?.data?.error) {
                errorMessage.value = error.response.data.error;
            } else {
                errorMessage.value = MESSAGES.DEFAULT_ERROR_MESSAGE;
            }
        }
    }
);

const title = computed(() => {
    return labelsStore.getLabel("Groupe");
});

onMounted(async () => {
    await labelsStore.fetchLabels();
});

const showAddGroupPopup = () => {
    if (props.promotionId) isAddGroupPopupVisible.value = true;
};
const hideAddGroupPopup = () => (isAddGroupPopupVisible.value = false);

const showEditGroupPopup = () => (isEditGroupPopupVisible.value = true);
const hideEditGroupPopup = () => (isEditGroupPopupVisible.value = false);

const handleSelect = (item: number) => {
    emit("select", item);
};

const handleEdit = (item: number) => {
    groupToEditId.value = item;
    showEditGroupPopup();
};

const handleAdd = () => {
    showAddGroupPopup();
};
</script>

<template>
    <div>
        <ListManager
            :title="title"
            hasAdd
            :items="groups"
            :selectedItemsId="selectedGroupId ? [selectedGroupId] : undefined"
            @select="handleSelect"
            @edit="handleEdit"
            @add="handleAdd"
        />
        <AddGroupPopup
            v-if="isAddGroupPopupVisible"
            :promotionId="promotionId!"
            @cancel="hideAddGroupPopup"
        />
        <EditGroupPopup
            v-if="isEditGroupPopupVisible"
            :groupId="groupToEditId"
            @cancel="hideEditGroupPopup"
        />
        <ErrorPopup v-if="errorMessage" :message="errorMessage" />
    </div>
</template>
