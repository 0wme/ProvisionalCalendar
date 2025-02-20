<script setup lang="ts">
import CloseWithoutSaveConfirmationPopup from "@/Components/CloseWithoutSaveConfirmationPopup.vue";
import { onMounted, ref } from "vue";
import Popup from "@/Components/Popup/PopupComponent.vue";
import AddTeachingForm from "@/Features/Forms/Teachings/AddTeachingForm.vue";
import { API_ENDPOINTS } from "@/constants";
import axios from "axios";
import { Period, PeriodType } from "@/types/models/periods";

const props = defineProps<{ yearId: number }>();

const emit = defineEmits(["cancel", "successfullyAdded"]);

const isCloseWithoutSaveConfirmationPopupVisible = ref(false);
const hasBeenEdited = ref<boolean>(false);
const periods = ref<Period[] | undefined>();
const periodsType = ref<PeriodType | undefined>();

onMounted(() => fetchPeriods());

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
        <AddTeachingForm
            v-if="periods !== undefined && periodsType !== undefined"
            :periods
            :periodsType
            :yearId
            @successfullyAdded="$emit('successfullyAdded')"
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
