<script setup lang="ts">
import CloseWithoutSaveConfirmationPopup from "@/Components/CloseWithoutSaveConfirmationPopup.vue";
import { onMounted, ref } from "vue";
import Popup from "@/Components/Popup/Popup.vue";
import EditTeachingForm from "@/Features/Forms/Teaching/EditTeachingForm.vue";
import { API_ENDPOINTS } from "@/constants";
import axios from "axios";
import { Period, PeriodType } from "@/types/models";
import { Teaching } from "@/types/models";

const props = defineProps<{ yearId: number; teachingId: number }>();

const emit = defineEmits([
    "cancel",
    "successfullyEdited",
    "successfullyDeleted",
]);

const isCloseWithoutSaveConfirmationPopupVisible = ref(false);
const hasBeenEdited = ref<boolean>(false);
const teaching = ref<Teaching | undefined>();
const periods = ref<Period[] | undefined>();
const periodsType = ref<PeriodType | undefined>();

onMounted(async () => {
    await fetchPeriods();
    const response = await axios.get(
        `${API_ENDPOINTS.TEACHING}/${props.teachingId}`
    );
    teaching.value = {
        id: response.data.id,
        name: response.data.title,
        period:
            periods.value?.find((p) => p.id === response.data.semester) ??
            periods.value?.find((p) => p.id === response.data.trimester),
        apogee_code: response.data.apogee_code,
        mcccFormInput: {
            initial_tp: response.data.tp_hours_initial,
            continuing_tp: response.data.tp_hours_continued,
            initial_td: response.data.td_hours_initial,
            continuing_td: response.data.td_hours_continued,
            initial_cm: response.data.cm_hours_initial,
            continuing_cm: response.data.cm_hours_continued,
        },
    };
});

const showCloseWithoutSaveConfirmationPopup = () => {
    isCloseWithoutSaveConfirmationPopupVisible.value = true;
};

const hideCloseWithoutSaveConfirmationPopup = () => {
    isCloseWithoutSaveConfirmationPopupVisible.value = false;
};

const handleCancel = () =>
    hasBeenEdited.value
        ? showCloseWithoutSaveConfirmationPopup()
        : emit("cancel");

const handleCloseWithoutSaving = () => {
    hideCloseWithoutSaveConfirmationPopup();
    emit("cancel");
};

const handleHasBeenEdited = () => {
    hasBeenEdited.value = true;
};

const fetchPeriods = async () => {
    const response = await axios.get(
        `${API_ENDPOINTS.PERIOD}s/${props.yearId}`
    );
    if (response.data.semesters) {
        periodsType.value = PeriodType.SEMESTER;
        periods.value = response.data.semesters;
    } else if (response.data.trimesters) {
        periodsType.value = PeriodType.TRIMESTER;
        periods.value = response.data.trimesters;
    }
};
</script>

<template>
    <Popup title="Ajouter un enseignement" @close="handleCancel">
        <EditTeachingForm
            v-if="teaching && periods && periodsType !== undefined"
            :periods
            :periodsType
            :teaching
            @successfullyEdited="$emit('successfullyEdited')"
            @successfullyDeleted="$emit('successfullyDeleted')"
            @edited="handleHasBeenEdited"
        />
        <div v-else class="w-full flex justify-center">
            <div>Chargement...</div>
        </div>
    </Popup>
    <CloseWithoutSaveConfirmationPopup
        v-if="isCloseWithoutSaveConfirmationPopupVisible"
        @close="handleCloseWithoutSaving"
        @cancel="hideCloseWithoutSaveConfirmationPopup"
    />
</template>
