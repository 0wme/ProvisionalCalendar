<script setup lang="ts">
import GroupPopup from "./GroupPopup.vue";
import { Group } from "@/types/models";
import Button from "@/Components/Button.vue";
import { ref, watch } from "vue";
import CloseWithoutSaveConfirmationPopup from "@/Features/Popup/CloseWithoutSaveConfirmationPopup.vue";

const emit = defineEmits(["cancel", "add"]);

const props = defineProps<{
    show?: boolean;
}>();

const group = ref<Group>({
    id: 0,
    name: "",
    subgroups: [],
});

watch(
    () => props.show,
    () => {
        if (props.show) {
            group.value = {
                id: 0,
                name: "",
                subgroups: [],
            };
        }
    }
);

const isCloseWithoutSaveConfirmationPopupVisible = ref<boolean>(false);

const handleUpdateGroupName = (newGroupName: string) => {
    group.value.name = newGroupName;
};

const handleCloseWithoutSaving = () => {
    hideCloseWithoutSaveConfirmationPopup();
    emit("cancel");
};

const handleCancelCloseWithoutSaving = () => {
    hideCloseWithoutSaveConfirmationPopup();
};

const showCloseWithoutSaveConfirmationPopup = () => {
    isCloseWithoutSaveConfirmationPopupVisible.value = true;
};

const hideCloseWithoutSaveConfirmationPopup = () => {
    isCloseWithoutSaveConfirmationPopupVisible.value = false;
};

const handleClose = () => {
    if (group.value.name !== "") {
        showCloseWithoutSaveConfirmationPopup();
    } else {
        emit("cancel");
    }
};

const handleAdd = () => {
    emit("add", group.value);
};
</script>

<template>
    <GroupPopup
        :show
        :group
        title="Ajouter un groupe"
        @updateGroupName="handleUpdateGroupName"
        @close="handleClose"
    >
        <div class="flex gap-4">
            <Button class="bg-green-500 text-white w-full" @click="handleAdd"
                >Ajouter</Button
            >
        </div>
        <CloseWithoutSaveConfirmationPopup
            :show="isCloseWithoutSaveConfirmationPopupVisible"
            @close="handleCloseWithoutSaving"
            @cancel="handleCancelCloseWithoutSaving"
        />
    </GroupPopup>
</template>
