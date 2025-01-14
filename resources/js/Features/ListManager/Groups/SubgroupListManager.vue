<script setup lang="ts">
import ListManager from "@/Components/ListManager/ListManager.vue";
import { defineProps, defineEmits, onMounted, computed, ref } from "vue";
import { useLabelsStore } from "@/stores/labelsStore";
import { Item } from "@/types/models";
import { API_ENDPOINTS, MESSAGES } from "@/constants";
import axios, { AxiosError } from "axios";
import AddSubgroupPopup from "@/Features/Popup/Groups/Subgroup/AddSubgroupPopup.vue";
import EditSubgroupPopup from "@/Features/Popup/Groups/Subgroup/EditSubgroupPopup.vue";
import ErrorPopup from "@/Features/Popup/ErrorPopup.vue";

const labelsStore = useLabelsStore();

const props = defineProps<{ groupId: number; selectedSubgroupId: number }>();

const emit = defineEmits(["select"]);

const subgroups = ref<Item[] | undefined>();

const subgroupToEditId = ref<number | undefined>();

const isAddSubgroupPopupVisible = ref<boolean>(false);
const isEditSubgroupPopupVisible = ref<boolean>(false);

const errorMessage = ref<string>();

onMounted(async () => {
    try {
        const response = await axios.get(
            `${API_ENDPOINTS.SUBGROUP}s/${props.groupId}`
        );
        subgroups.value = response.data;
    } catch (error: unknown) {
        if (error instanceof AxiosError && error.response?.data?.error) {
            errorMessage.value = error.response.data.error;
        } else {
            errorMessage.value = MESSAGES.DEFAULT_ERROR_MESSAGE;
        }
    }
});

const title = computed(() => {
    return labelsStore.getLabel("Demi-groupe");
});

onMounted(async () => {
    await labelsStore.fetchLabels();
});

const showAddSubgroupPopup = () => (isAddSubgroupPopupVisible.value = true);
const hideAddSubgroupPopup = () => (isAddSubgroupPopupVisible.value = false);

const showEditSubgroupPopup = () => (isEditSubgroupPopupVisible.value = true);
const hideEditSubgroupPopup = () => (isEditSubgroupPopupVisible.value = false);

const handleSelect = (item: number) => {
    emit("select", item);
};

const handleEdit = (item: number) => {
    subgroupToEditId.value = item;
    showEditSubgroupPopup();
};

const handleAdd = () => {
    showAddSubgroupPopup();
};
</script>

<template>
    <div>
        <ListManager
            :title="title"
            hasAdd
            :items="subgroups"
            :selectedItemsId="
                selectedSubgroupId ? [selectedSubgroupId] : undefined
            "
            @select="handleSelect"
            @edit="handleEdit"
            @add="handleAdd"
        />
        <AddSubgroupPopup
            v-if="isAddSubgroupPopupVisible"
            :groupId
            @cancel="hideAddSubgroupPopup"
        />
        <EditSubgroupPopup
            v-if="isEditSubgroupPopupVisible"
            :subgroupId="subgroupToEditId"
            @cancel="hideEditSubgroupPopup"
        />
        <ErrorPopup v-if="errorMessage" :message="errorMessage" />
    </div>
</template>
