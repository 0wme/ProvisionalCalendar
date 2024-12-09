<script setup lang="ts">
import ClassPopup from "./ClassPopup.vue";
import DeleteConfirmationPopup from "@/Features/Popup/DeleteConfirmationPopup.vue";
import { Class } from "@/types/models";
import Button from "@/Components/Button.vue";
import { ref, watch } from "vue";
import CloseWithoutSaveConfirmationPopup from "@/Features/Popup/CloseWithoutSaveConfirmationPopup.vue";
import axios from "axios";
import { API_ENDPOINTS } from "@/constants";
import { MESSAGES } from "@/constants";

const props = defineProps<{ classe?: Class; show?: boolean }>();
const emit = defineEmits(["cancel", "delete", "save", "error"]);

const isDeleteConfirmationPopupVisible = ref<boolean>(false);
const editedClass = ref<Class | undefined>();
const isCloseWithoutSaveConfirmationPopupVisible = ref<boolean>(false);

const clonePropsClass = () => {
    if (props.classe) {
        editedClass.value = { ...props.classe };
    }
};

watch(
    () => props.show,
    () => {
        if (props.show) {
            clonePropsClass();
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

const handleUpdateClassName = (groupName: string) => {
    editedClass.value!.name = groupName;
};

const handleCloseWithoutSaving = () => {
    hideCloseWithoutSaveConfirmationPopup();
    emit("cancel");
};

const handleCancelCloseWithoutSaving = () => {
    hideCloseWithoutSaveConfirmationPopup();
};

const handleCancel = () => {
    if (editedClass.value?.name !== props.classe?.name) {
        showCloseWithoutSaveConfirmationPopup();
    } else {
        emit("cancel");
    }
};

const handleDelete = async () => {
    try {
        const response = await axios.delete(
            `${API_ENDPOINTS.PROMOTION}/${props.classe!.id}`
        );
        hideDeleteConfirmationPopup();
        emit("delete", response.data.promotion);
    } catch (error: any) {
        if (error.response?.data?.error) {
            emit("error", error.response.data.error);
        } else {
            emit("error", MESSAGES.DEFAULT_ERROR_MESSAGE);
        }
    }
};

const handleSave = async () => {
    if (editedClass.value?.name === "") {
        emit("error", MESSAGES.EMPTY_GROUP_NAME_ERROR_MESSAGE);
        return;
    }
    try {
        const response = await axios.put(
            "/api/groupes/promotion/" + editedClass.value!.id,
            editedClass.value
        );
        emit("save", response.data.promotion);
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
    <ClassPopup
        :classe="editedClass"
        :show
        title="Modifier un sous-groupe"
        @updateClassName="handleUpdateClassName"
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
    </ClassPopup>
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
