<script setup lang="ts">
import FormInput from "@/Components/FormInput.vue";
import ErrorPopup from "@/Features/Popup/ErrorPopup.vue";
import { FormInputType, MCCCFormInput } from "@/types/models";
import FormMCCCTable from "@/Features/FormMCCCTable.vue";
import FormButton from "@/Components/FormButton.vue";
import { Teaching, Period, SelectOption, PeriodType } from "@/types/models";
import { ref, onMounted } from "vue";
import axios, { AxiosError } from "axios";
import { API_ENDPOINTS, MESSAGES } from "@/constants";
import DeleteConfirmationPopup from "@/Features/Popup/DeleteConfirmationPopup.vue";

const props = defineProps<{
    teaching: Teaching;
    periods: Period[];
    periodsType: PeriodType;
}>();

const emit = defineEmits([
    "successfullyEdited",
    "successfullyDeleted",
    "edited",
]);

const editedTeaching = ref<Teaching>(props.teaching);

onMounted(() => convertPeriodsToOptions());

const nameError = ref<string | undefined>();
const apogeeCodeError = ref<string | undefined>();
const periodError = ref<string | undefined>();

const errorMessage = ref<string | undefined>();

const periodsOptions = ref<SelectOption[]>();

const isDeleteConfirmationPopupVisible = ref<boolean>(false);

const showDeleteConfirmationPopup = () =>
    (isDeleteConfirmationPopupVisible.value = true);
const hideDeleteConfirmationPopup = () =>
    (isDeleteConfirmationPopupVisible.value = false);

const convertPeriodsToOptions = () => {
    if (props.periodsType === PeriodType.SEMESTER) {
        periodsOptions.value = props.periods?.map((period) => ({
            value: period.id,
            label: `Semestre ${period.number}`,
        }));
    } else if (props.periodsType === PeriodType.TRIMESTER) {
        periodsOptions.value = props.periods?.map((period) => ({
            value: period.id,
            label: `Trimestre ${period.number}`,
        }));
    }
};

const updateName = (value: string) => {
    nameError.value = undefined;
    editedTeaching.value.name = value;
    emit("edited");
};

const updateApogeeCode = (value: string) => {
    apogeeCodeError.value = undefined;
    editedTeaching.value.apogee_code = value;
    emit("edited");
};

const updatePeriod = (value: string) => {
    editedTeaching.value.period = props.periods?.find(
        (p) => p.id === parseInt(value)
    );
    emit("edited");
};

const updateMCCCFormInput = (value: MCCCFormInput) => {
    editedTeaching.value.mcccFormInput = value;
    emit("edited");
};

const resetErrorMessage = () => {
    errorMessage.value = undefined;
};

const handleEdit = async () => {
    if (editedTeaching.value.name.trim() === "") {
        nameError.value = MESSAGES.EMPTY_TEACHING_NAME_ERROR_MESSAGE;
    }
    if (editedTeaching.value.apogee_code.trim() === "") {
        apogeeCodeError.value = MESSAGES.EMPTY_APOGEE_CODE_ERROR_MESSAGE;
    }
    if (editedTeaching.value.period === undefined) {
        periodError.value = MESSAGES.EMPTY_PERIOD_ERROR_MESSAGE;
    }
    if (nameError.value || apogeeCodeError.value || periodError.value) {
        return;
    }
    try {
        const response = await axios.put(
            `${API_ENDPOINTS.TEACHING}/${props.teaching.id}`,
            {
                title: editedTeaching.value.name,
                apogee_code: editedTeaching.value.apogee_code,
                tp_hours_initial: editedTeaching.value.mcccFormInput.initial_tp,
                tp_hours_continued:
                    editedTeaching.value.mcccFormInput.continuing_tp,
                td_hours_initial: editedTeaching.value.mcccFormInput.initial_td,
                td_hours_continued:
                    editedTeaching.value.mcccFormInput.continuing_td,
                cm_hours_initial: editedTeaching.value.mcccFormInput.initial_cm,
                cm_hours_continued:
                    editedTeaching.value.mcccFormInput.continuing_cm,
                semester:
                    props.periodsType === PeriodType.SEMESTER
                        ? editedTeaching.value.period?.id
                        : undefined,
                trimester:
                    props.periodsType === PeriodType.TRIMESTER
                        ? editedTeaching.value.period?.id
                        : undefined,
            }
        );
        emit("successfullyEdited", response.data.teaching);
    } catch (error: unknown) {
        if (error instanceof AxiosError && error.response?.data?.error) {
            errorMessage.value = error.response.data.error;
        } else {
            errorMessage.value = MESSAGES.DEFAULT_ERROR_MESSAGE;
        }
    }
};

const handleDelete = async () => {
    try {
        const response = await axios.delete(
            `${API_ENDPOINTS.TEACHING}/${props.teaching.id}`
        );
        hideDeleteConfirmationPopup();
        emit("successfullyDeleted", response.data.teaching);
    } catch (error: unknown) {
        if (error instanceof AxiosError && error.response?.data?.error) {
            errorMessage.value = error.response.data.error;
        } else {
            errorMessage.value = MESSAGES.DEFAULT_ERROR_MESSAGE;
        }
    }
};
</script>

<template>
    <div class="flex flex-col gap-6">
        <FormInput
            label="Intitulé de la ressource"
            placeholder="ex : R1.01 - Développement web"
            :value="editedTeaching.name"
            :error="nameError"
            @input="updateName($event.target.value)"
        />
        <FormInput
            label="Code Apogée"
            placeholder="ex : TIN13A1S"
            :value="editedTeaching.apogee_code"
            :error="apogeeCodeError"
            @input="updateApogeeCode($event.target.value)"
        />
        <FormInput
            label="Période"
            :type="FormInputType.SELECT"
            :options="periodsOptions"
            :value="editedTeaching.period?.id"
            placeholder="ex : TIN13A1S"
            :error="periodError"
            @input="updatePeriod($event.target.value)"
        />
        <FormMCCCTable
            class="w-full h-full"
            :mcccFormInput="editedTeaching.mcccFormInput"
            @updateMCCCFormInput="updateMCCCFormInput($event)"
        />
        <div class="flex gap-4 w-full">
            <FormButton
                class="bg-green-500 text-white w-full"
                @click="handleEdit"
                >Sauvegarder</FormButton
            >
            <FormButton
                class="bg-red-500 text-white w-full"
                @click="showDeleteConfirmationPopup"
                >Supprimer</FormButton
            >
        </div>
        <DeleteConfirmationPopup
            v-if="isDeleteConfirmationPopupVisible"
            @delete="handleDelete"
            @cancel="hideDeleteConfirmationPopup"
        />
        <ErrorPopup
            v-if="errorMessage"
            :message="errorMessage!"
            @close="resetErrorMessage"
        />
    </div>
</template>
