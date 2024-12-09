<script setup lang="ts">
import GroupPopup from "./GroupPopup.vue";
import DeleteConfirmationPopup from "@/Features/Popup/DeleteConfirmationPopup.vue";
import { Group } from "@/types/models";
import Button from "@/Components/Button.vue";
import { ref, watch } from "vue";
import CloseWithoutSaveConfirmationPopup from "@/Features/Popup/CloseWithoutSaveConfirmationPopup.vue";
import axios from "axios";
import { API_ENDPOINTS, MESSAGES } from "@/constants";

const props = defineProps<{ group?: Group; show?: boolean }>();
const emit = defineEmits(["cancel", "delete", "save", "error"]);

const isDeleteConfirmationPopupVisible = ref<boolean>(false);
const editedGroup = ref<Group | undefined>();
const isCloseWithoutSaveConfirmationPopupVisible = ref<boolean>(false);

const clonePropsGroup = () => {
    if (props.group) {
        editedGroup.value = { ...props.group };
    }
};

watch(
    () => props.show,
    () => {
        if (props.show) {
            clonePropsGroup();
        }
    }
);

const showCloseWithoutSaveConfirmationPopup = () => {
    isCloseWithoutSaveConfirmationPopupVisible.value = true;
};

const hideCloseWithoutSaveConfirmationPopup = () => {
    isCloseWithoutSaveConfirmationPopupVisible.value = false;
};

const showDeleteConfirmationPopup = () => {
    isDeleteConfirmationPopupVisible.value = true;
};

const hideDeleteConfirmationPopup = () => {
    isDeleteConfirmationPopupVisible.value = false;
};

const updateGroupName = (groupName: string) => {
    editedGroup.value!.name = groupName;
};

const handleCloseWithoutSaving = () => {
    hideCloseWithoutSaveConfirmationPopup();
    emit("cancel");
};

const handleCancel = () => {
    if (editedGroup.value?.name !== props.group?.name) {
        showCloseWithoutSaveConfirmationPopup();
    } else {
        emit("cancel");
    }
};

const handleDelete = async () => {
    try {
        const response = await axios.delete(
            `${API_ENDPOINTS.PROMOTION}/${props.group!.id}`
        );
        hideDeleteConfirmationPopup();
        emit("delete", response.data.group);
    } catch (error: any) {
        if (error.response?.data?.error) {
            emit("error", error.response.data.error);
        } else {
            emit("error", MESSAGES.DEFAULT_ERROR_MESSAGE);
        }
    }
};

const handleSave = async () => {
    if (editedGroup.value?.name === "") {
        emit("error", MESSAGES.EMPTY_GROUP_NAME_ERROR_MESSAGE);
        return;
    }
    try {
        const response = await axios.put(
            "/api/groupes/groupe/" + editedGroup.value!.id,
            editedGroup.value
        );
        emit("save", response.data.group);
    } catch (error: any) {
        if (error.response?.data?.error) {
            emit("error", error.response.data.error);
        } else {
            emit("error", MESSAGES.DEFAULT_ERROR_MESSAGE);
        }
    }
};
</script>

<template>
    <GroupPopup
        :group="editedGroup"
        :show
        title="Modifier un groupe"
        @updateGroupName="updateGroupName"
        @close="handleCancel"
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
    </GroupPopup>
    <CloseWithoutSaveConfirmationPopup
        :show="isCloseWithoutSaveConfirmationPopupVisible"
        @close="handleCloseWithoutSaving"
        @cancel="hideCloseWithoutSaveConfirmationPopup"
    />
    <DeleteConfirmationPopup
        :show="isDeleteConfirmationPopupVisible"
        @delete="handleDelete"
        @cancel="hideDeleteConfirmationPopup"
    />
</template>
