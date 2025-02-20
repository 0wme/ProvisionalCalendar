<script setup lang="ts">
import { ref, onMounted } from "vue";
import axios from "axios";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import TeachersListManager from "../Features/ListManagers/TeachersListManager.vue";
import TeachingsListManager from "../Features/ListManagers/TeachingsListManager.vue";
import { Teacher } from "@/types/models/teachers";
import { EditedItem, EditedItemStatus } from "@/types/models/utils";
import Button from "@/Components/FormButton.vue";
import ErrorPopup from "@/Features/Popups/ErrorPopup.vue";
import SaveConfirmationPopup from "@/Features/Popups/SaveConfirmationPopup.vue";

const teachers = ref<Teacher[]>([]);
const yearId = ref<number>(1);

const selectedTeacherIds = ref<number[]>([]);
const selectedTeachingIds = ref<number[]>([]);
const errorMessage = ref("");
const isErrorPopupVisible = ref(false);
const modifications = ref<EditedItem[] | undefined>();
const isSaveConfirmationPopupVisible = ref(false);

const fetchModifications = () => {
    modifications.value = [
        ...(
            teachers.value.find((teacher) =>
                selectedTeacherIds.value.includes(teacher.id)
            )?.teachings || []
        )
            .filter(
                (teaching) => !selectedTeachingIds.value.includes(teaching.id)
            )
            .map((teaching) => ({
                ...teaching,
                editStatus: EditedItemStatus.DELETED,
            })),
        ...selectedTeachingIds.value
            .filter((id) => {
                const teaching = teachings.value.find((t) => t.id === id);
                return (
                    teaching &&
                    !teachers.value
                        .find((teacher) =>
                            selectedTeacherIds.value.includes(teacher.id)
                        )
                        ?.teachings?.some((t) => t.id === id)
                );
            })
            .map((id) => {
                const teaching = teachings.value.find((t) => t.id === id)!;
                return {
                    ...teaching,
                    editStatus: EditedItemStatus.ADDED,
                };
            }),
    ];
};

const handleTeacherSelect = (selectedItemId: number) => {
    if (!selectedTeacherIds.value.length) {
        if (selectedTeacherIds.value.includes(selectedItemId)) {
            selectedTeacherIds.value = selectedTeacherIds.value.filter(
                (id) => id !== selectedItemId
            );
            selectedTeachingIds.value = [];
        } else {
            selectedTeacherIds.value = [selectedItemId];
            selectedTeachingIds.value =
                teachers.value
                    .find((teacher) => teacher.id === selectedItemId)
                    ?.teachings.map((teaching) => teaching.id) || [];
        }
    } else {
        if (!selectedTeacherIds.value.includes(selectedItemId)) {
            if (modifications.value?.length) {
                showSaveConfirmationPopup();
            } else {
                if (selectedTeacherIds.value.includes(selectedItemId)) {
                    selectedTeacherIds.value = selectedTeacherIds.value.filter(
                        (id) => id !== selectedItemId
                    );
                    selectedTeachingIds.value = [];
                } else {
                    selectedTeacherIds.value = [selectedItemId];
                    selectedTeachingIds.value =
                        teachers.value
                            .find((teacher) => teacher.id === selectedItemId)
                            ?.teachings.map((teaching) => teaching.id) || [];
                }
            }
        }
    }
};

const handleTeachingSelect = (selectedItemId: number) => {
    if (selectedTeacherIds.value.length) {
        if (selectedTeachingIds.value.includes(selectedItemId)) {
            selectedTeachingIds.value = selectedTeachingIds.value.filter(
                (id) => id !== selectedItemId
            );
        } else {
            selectedTeachingIds.value = [
                ...selectedTeachingIds.value,
                selectedItemId,
            ];
        }
    }
};

const showSaveConfirmationPopup = () => {
    fetchModifications();
    isSaveConfirmationPopupVisible.value = true;
};

const hideSaveConfirmationPopup = () => {
    isSaveConfirmationPopupVisible.value = false;
};

const handleSave = async () => {
    fetchModifications();
    if (modifications.value) {
        for (const modification of modifications.value) {
            if (modification.editStatus === EditedItemStatus.ADDED) {
                const response = await axios.post(
                    `/api/enseignant/enseignement/${
                        teachers.value.find((teacher) =>
                            selectedTeacherIds.value.includes(teacher.id)
                        )?.id
                    }/${modification.id}`
                );
            } else if (modification.editStatus === EditedItemStatus.DELETED) {
                const response = await axios.delete(
                    `/api/enseignant/enseignement/${
                        teachers.value.find((teacher) =>
                            selectedTeacherIds.value.includes(teacher.id)
                        )?.id
                    }/${modification.id}`
                );
            }
        }
    }
};

const handleQuitWithoutSave = () => {
    console.log("quitWithoutSave");
};

const handleCancel = () => {
    selectedTeachingIds.value =
        teachers.value
            .find((teacher) => teacher.id === selectedTeacherIds.value[0])
            ?.teachings.map((teaching) => teaching.id) || [];
};

const showErrorPopup = (message: string) => {
    errorMessage.value = message;
    isErrorPopupVisible.value = true;
};

const hideErrorPopup = () => {
    isErrorPopupVisible.value = false;
};
</script>

<template>
    <AdminLayout>
        <div class="flex flex-col h-full gap-8 items-end">
            <div class="flex gap-8 flex-1 h-full w-full">
                <TeachersListManager
                    class="h-[700px] w-1/3"
                    :yearId
                    :selectedTeacherIds
                    @select="handleTeacherSelect"
                />
                <TeachingsListManager
                    class="h-[700px] w-2/3"
                    :yearId
                    :selectedTeachingIds
                    @select="handleTeachingSelect"
                />
            </div>
            <div class="flex gap-4 h-min">
                <Button class="text-gray-500 underline" @click="handleCancel"
                    >Réinitialiser les modifications</Button
                >
                <Button class="bg-green-400 text-white" @click="handleSave"
                    >Valider</Button
                >
            </div>
        </div>
    </AdminLayout>
    <SaveConfirmationPopup
        v-if="isSaveConfirmationPopupVisible"
        :modifications="modifications"
        @save="handleSave"
        @quitWithoutSave="handleQuitWithoutSave"
        @cancel="handleCancel"
    />
    <ErrorPopup
        :message="errorMessage"
        v-if="isErrorPopupVisible"
        @close="hideErrorPopup"
    />
</template>
