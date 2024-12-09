<script setup lang="ts">
import { ref, watch } from "vue";
import axios from "axios";

import { Subgroup } from "@/types/models";
import { API_ENDPOINTS, MESSAGES } from "@/constants";

import Button from "@/Components/Button.vue";
import SubgroupPopup from "./SubgroupPopup.vue";
import DeleteConfirmationPopup from "@/Features/Popup/DeleteConfirmationPopup.vue";
import CloseWithoutSaveConfirmationPopup from "@/Features/Popup/CloseWithoutSaveConfirmationPopup.vue";

const emit = defineEmits(["cancel", "delete", "save", "error"]);

const props = defineProps<{
    subgroup?: Subgroup;
    show?: boolean;
}>();

const isDeleteConfirmationPopupVisible = ref<boolean>(false);
const editedSubgroup = ref<Subgroup | undefined>();
const isCloseWithoutSaveConfirmationPopupVisible = ref<boolean>(false);

const showDeleteConfirmationPopup = () =>
    (isDeleteConfirmationPopupVisible.value = true);

const hideDeleteConfirmationPopup = () =>
    (isDeleteConfirmationPopupVisible.value = false);

const handleCloseWithoutSaving = () => {
    hideCloseWithoutSaveConfirmationPopup();
    emit("cancel");
};

const handleCancelCloseWithoutSaving = () => {
    hideCloseWithoutSaveConfirmationPopup();
};

const hideCloseWithoutSaveConfirmationPopup = () =>
    (isCloseWithoutSaveConfirmationPopupVisible.value = false);

const handleUpdateSubgroupName = (groupName: string) =>
    (editedSubgroup.value!.name = groupName);

watch(
    () => props.show,
    () => {
        if (props.show && props.subgroup) {
            editedSubgroup.value = { ...props.subgroup };
        }
    }
);

const showCloseWithoutSaveConfirmationPopup = () =>
    (isCloseWithoutSaveConfirmationPopupVisible.value = true);

const handleClose = () =>
    editedSubgroup.value?.name !== props.subgroup?.name
        ? showCloseWithoutSaveConfirmationPopup()
        : emit("cancel");

const handleDelete = async () => {
    try {
        const response = await axios.delete(
            `${API_ENDPOINTS.SUBGROUP}/${props.subgroup!.id}`
        );
        hideDeleteConfirmationPopup();
        emit("delete", response.data.subgroup);
    } catch (error: any) {
        error.response?.data?.error
            ? emit("error", error.response.data.error)
            : emit("error", MESSAGES.DEFAULT_ERROR_MESSAGE);
    }
};

const handleSave = async () => {
    if (editedSubgroup.value?.name === "") {
        emit("error", MESSAGES.EMPTY_GROUP_NAME_ERROR_MESSAGE);
        return;
    }
    try {
        const response = await axios.put(
            `${API_ENDPOINTS.SUBGROUP}/${editedSubgroup.value!.id}`,
            editedSubgroup.value
        );
        emit("save", response.data.subgroup);
    } catch (error: any) {
        error.response?.data?.error
            ? emit("error", error.response.data.error)
            : emit("error", MESSAGES.DEFAULT_ERROR_MESSAGE);
    }
};
</script>

<template>
    <SubgroupPopup
        :subgroup="editedSubgroup"
        :show
        title="Modifier un sous-groupe"
        @updateSubgroupName="handleUpdateSubgroupName"
        @close="handleClose"
    >
        <div class="flex gap-4">
            <Button class="bg-green-500 text-white w-full" @click="handleSave"
                >Sauvegarder</Button
            >
            <Button
                class="bg-red-500 text-white w-full"
                @click="showDeleteConfirmationPopup"
                >Supprimer</Button
            >
        </div>
    </SubgroupPopup>
    <CloseWithoutSaveConfirmationPopup
        :show="isCloseWithoutSaveConfirmationPopupVisible"
        @close="handleCloseWithoutSaving"
        @cancel="handleCancelCloseWithoutSaving"
    />
    <DeleteConfirmationPopup
        :show="isDeleteConfirmationPopupVisible"
        @delete="handleDelete"
        @cancel="hideDeleteConfirmationPopup"
    />
</template>
