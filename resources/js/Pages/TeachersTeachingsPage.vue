<script setup lang="ts">
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import TeachersListManager from '../Features/ListManager/TeachersListManager.vue';
import TeachingsListManager from '../Features/ListManager/TeachingsListManager.vue';
import { Teacher, Teaching, Period, EditedItem, EditedItemStatus } from '@/types/models';
import AddTeachingPopup from '@/Features/Popup/Teachings/AddTeachingPopup.vue';
import EditTeachingPopup from '@/Features/Popup/Teachings/EditTeachingPopup.vue';
import Button from '@/Components/Button.vue';
import ErrorPopup from '@/Features/Popup/ErrorPopup.vue';
import SaveConfirmationPopup from '@/Features/Popup/SaveConfirmationPopup.vue';

const teachers = ref<Teacher[]>([]);
const teachings = ref<Teaching[]>([]);
const periods = ref<Period[]>([
    {
        id: 1,
        name: 'Semestre 1'
    },
    {
        id: 2,
        name: 'Semestre 2'
    },
    {
        id: 3,
        name: 'Semestre 3'
    },
    {
        id: 4,
        name: 'Semestre 4'
    },
    {
        id: 5,
        name: 'Semestre 5'
    },
    {
        id: 6,
        name: 'Semestre 6'
    }
]);

const selectedTeacherIds = ref<number[]>([]);
const selectedTeachingIds = ref<number[]>([]);
const errorMessage = ref('');
const isErrorPopupVisible = ref(false);
const modifications = ref<EditedItem[] | undefined>();
const isSaveConfirmationPopupVisible = ref(false);

const handleTeacherSelect = (selectedItemId: number) => {
    if (isTeachingMode.value) {
        if (selectedTeachingIds.value.length) {
            if (selectedTeacherIds.value.includes(selectedItemId)) {
                selectedTeacherIds.value = selectedTeacherIds.value.filter(id => id !== selectedItemId);
            } else {
                selectedTeacherIds.value = [...selectedTeacherIds.value, selectedItemId];
            }
        }
    } else {
        // if (!selectedTeacherIds.value.length) {
            if (selectedTeacherIds.value.includes(selectedItemId)) {
                selectedTeacherIds.value = selectedTeacherIds.value.filter(id => id !== selectedItemId);
            selectedTeachingIds.value = [];
            } else {
                selectedTeacherIds.value = [selectedItemId];
                selectedTeachingIds.value = teachers.value.find(teacher => teacher.id === selectedItemId)?.teachings.map(teaching => teaching.id) || [];
            }
        // } else {
            // if (!selectedTeacherIds.value.includes(selectedItemId)) {
            //     modifications.value = [
            //         ...teachers.value
            //             .filter(teacher => !selectedTeachingIds.value.find(ids => ids === teacher.id))
            //             .flatMap(teacher => teacher.teachings.filter(teaching => 
            //                 !selectedTeachingIds.value.find(ids => ids === teaching.id))
            //                 .map(teaching => ({
            //                     ...teaching,
            //                     editStatus: EditedItemStatus.DELETED
            //                 }))),
            //         ...selectedTeachingIds.value
            //             .filter(id => !teachers.value.find(teacher =>selectedTeacherIds.value.includes(teacher.id))?.teachings.some(t => t.id !== id))
            //             .map(id => ({
            //                 ...teachings.value.find(t => t.id === id)!,
            //                 editStatus: EditedItemStatus.ADDED
            //             }))
            //     ];
            //     showSaveConfirmationPopup(modifications.value);
            // }
        // }
    }
}

const handleTeachingSelect = (selectedItemId: number) => {
    if (isTeachingMode.value) {
        // if (!selectedTeachingIds.value.length) {
            if (selectedTeachingIds.value.includes(selectedItemId)) {
                selectedTeachingIds.value = selectedTeachingIds.value.filter(id => id !== selectedItemId);
                selectedTeacherIds.value = [];
            } else {
                selectedTeachingIds.value = [selectedItemId];
                selectedTeacherIds.value = teachers.value.find(teacher => teacher.teachings.some(teaching => teaching.id === selectedItemId))?.id ?
                    [teachers.value.find(teacher => teacher.teachings.some(teaching => teaching.id === selectedItemId))!.id] : [];
            }
        // } else {
        //     modifications.value = teachings.value.find(teaching => teaching.id === selectedItemId)?.teachers.filter(teacher => teacher.editStatus !== undefined);
        // }
    } else {
        if (selectedTeacherIds.value.length) {
            if (selectedTeachingIds.value.includes(selectedItemId)) {
                selectedTeachingIds.value = selectedTeachingIds.value.filter(id => id !== selectedItemId);
            } else {
                selectedTeachingIds.value = [...selectedTeachingIds.value, selectedItemId];
            }
        }
    }
}

const showSaveConfirmationPopup = (newModifications: EditedItem[]) => {
    modifications.value = newModifications;
    isSaveConfirmationPopupVisible.value = true;
}

const hideSaveConfirmationPopup = () => {
    isSaveConfirmationPopupVisible.value = false;
}

const handleSave = async () => {
    // TODO
}

const handleQuitWithoutSave = () => {
    console.log('quitWithoutSave');
}

const handleCancel = () => {
    if (isTeachingMode.value) {
        // selectedTeacherIds.value = teachings.value.find(teaching => teaching.id === selectedTeachingIds.value[0])?.teachers.map(teacher => teacher.id) || [];
        //     .map(teaching => teaching.teachers.map(teacher => teacher.id));
    } else {
        selectedTeachingIds.value = teachers.value.find(teacher => teacher.id === selectedTeacherIds.value[0])?.teachings.map(teaching => teaching.id) || [];
    }
}

onMounted(async () => {
    try {
        const teachersResponse = await axios.get('/api/enseignants/1');
        teachers.value = teachersResponse.data.map((teacher: any) => {
            return {
                id: teacher.id,
                name: `${teacher.first_name} ${teacher.last_name}`,
                acronym: teacher.acronym,
                teachings: teacher.teachings
            };
        });
    } catch (error: any) {
        if (error?.response?.data?.message) {
            showErrorPopup(errorMessage.value);
        } else {
            showErrorPopup('Une erreur est survenue');
        }
    }

    try {
        const teachingsResponse = await axios.get('/api/enseignements/1');
        teachings.value = teachingsResponse.data.map((teaching: any) => {
            return {
                id: teaching.id,
                name: teaching.title,
                period: periods.value.find((period) => period.id === teaching.semester || teaching.trimester),
                year: teaching.year_id,
                semester: teaching.semester,
                trimester: teaching.trimester,
                apogee_code: teaching.apogee_code,
                initial_cm: teaching.tp_hours_initial,
                initial_td: teaching.td_hours_intial,
                initial_tp: teaching.tp_hours_initial,
                continuing_cm: teaching.cm_hours_continued,
                continuing_td: teaching.td_hours_continued,
                continuing_tp: teaching.tp_hours_continued
            };
        });
    } catch (error: any) {
        if (error?.response?.data?.message) {
            showErrorPopup(errorMessage.value);
        } else {
            showErrorPopup('Une erreur est survenue');
        }
    }
});

const showErrorPopup = (message: string) => {
    errorMessage.value = message;
    isErrorPopupVisible.value = true;
}

const hideErrorPopup = () => {
    isErrorPopupVisible.value = false;
}

const isTeachingMode = ref(false);
const toggleTeachingMode = () => {
    isTeachingMode.value = !isTeachingMode.value;
};
</script>

<template>
    <AdminLayout>
        <div class="flex flex-col h-full gap-8 items-end">
            <Button
                :class="['text-white', isTeachingMode ? 'bg-red-300' : 'bg-blue-400']"
                @click="toggleTeachingMode"
            >
                {{ isTeachingMode ? 'Mode Enseignements' : 'Mode Enseignants' }}
            </Button>

            <div :class="['flex gap-8 flex-1 w-full min-h-0', {'flex-row-reverse': isTeachingMode}]">
                <TeachersListManager
                    class="h-full w-1/3"
                    :teachers
                    :selectedTeacherIds
                    @select="handleTeacherSelect"
                />
                <TeachingsListManager
                    class="h-full w-2/3"
                    :teachings
                    :periods
                    :selectedTeachingIds
                    @select="handleTeachingSelect"
                />
            </div>
            <div class="flex gap-4 min-h-0 h-min">
                <Button class="text-gray-500 underline" @click="handleCancel">Réinitialiser les modifications</Button>
                <Button class="bg-green-400 text-white" @click="handleSave">Valider</Button>
            </div>
        </div>
    </AdminLayout>
    <AddTeachingPopup
        :show="false"
    />
    <EditTeachingPopup
        :show="false"
    />
    <SaveConfirmationPopup
        :show="isSaveConfirmationPopupVisible"
        :modifications="modifications"
        @save="handleSave"
        @quitWithoutSave="handleQuitWithoutSave"
        @cancel="handleCancel"
    />
    <ErrorPopup
        :message="errorMessage"
        :show="isErrorPopupVisible"
        @close="hideErrorPopup"
    />
</template>
