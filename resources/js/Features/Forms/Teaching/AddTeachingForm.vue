<script setup lang="ts">
import FormInput from "@/Components/FormInput.vue";
import ErrorPopup from "@/Features/Popup/ErrorPopup.vue";
import { FormInputType, MCCCFormInput } from "@/types/models";
import FormMCCCTable from "@/Features/FormMCCCTable.vue";
import FormButton from "@/Components/FormButton.vue";
import { Teaching, Period, SelectOption } from "@/types/models";
import { onMounted, ref } from "vue";
import axios, { AxiosError } from "axios";
import { API_ENDPOINTS, MESSAGES } from "@/constants";

const props = defineProps<{ yearId: number }>();

const teaching = ref<Teaching>({
    name: "",
    apogee_code: "",
    mcccFormInput: {},
});

const emit = defineEmits(["successfullyAdded", "edited"]);

const nameError = ref<string | undefined>();
const apogeeCodeError = ref<string | undefined>();
const periodError = ref<string | undefined>();

const errorMessage = ref<string | undefined>();

const periodsOptions = ref<SelectOption[]>();

onMounted(() => {
    fetchPeriods();
});

const updateName = (value: string) => {
    nameError.value = undefined;
    teaching.value.name = value;
    emit("edited");
};

const updateApogeeCode = (value: string) => {
    apogeeCodeError.value = undefined;
    teaching.value.apogee_code = value;
    emit("edited");
};

const updateSemester = (value: string) => {
    teaching.value.semester = parseInt(value);
    emit("edited");
};

const updateMCCCFormInput = (value: MCCCFormInput) => {
    teaching.value.mcccFormInput = value;
    emit("edited");
};

const resetErrorMessage = () => {
    errorMessage.value = undefined;
};

const fetchPeriods = async () => {
    try {
        const response = await axios.get(
            `${API_ENDPOINTS.PERIOD}s/${props.yearId}`
        );
        if (response.data.semesters) {
            periodsOptions.value = response.data.semesters.map(
                (semester: Period) => ({
                    value: semester.id,
                    label: `Semestre ${semester.number}`,
                })
            );
            teaching.value.period = response.data.semesters[0];
        } else if (response.data.trimesters) {
            periodsOptions.value = response.data.trimesters.map(
                (trimester: Period) => ({
                    value: trimester.id,
                    label: `Trimestre ${trimester.number}`,
                })
            );
            teaching.value.period = response.data.trimesters[0];
        }
    } catch (error: unknown) {
        if (error instanceof AxiosError && error.response?.data?.error) {
            errorMessage.value = error.response.data.error;
        } else {
            errorMessage.value = MESSAGES.DEFAULT_ERROR_MESSAGE;
        }
    }
};

const handleAdd = async () => {
    if (teaching.value.name.trim() === "") {
        nameError.value = MESSAGES.EMPTY_TEACHING_NAME_ERROR_MESSAGE;
    }
    if (teaching.value.apogee_code.trim() === "") {
        apogeeCodeError.value = MESSAGES.EMPTY_APOGEE_CODE_ERROR_MESSAGE;
    }
    if (teaching.value.period === undefined) {
        periodError.value = MESSAGES.EMPTY_PERIOD_ERROR_MESSAGE;
    }
    if (nameError.value || apogeeCodeError.value || periodError.value) {
        return;
    }
    try {
        const response = await axios.post(
            `${API_ENDPOINTS.TEACHING}/${props.yearId}`,
            teaching.value
        );
        emit("successfullyAdded", response.data.teaching);
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
            :error="nameError"
            @input="updateName"
        />
        <FormInput
            label="Code Apogée"
            placeholder="ex : TIN13A1S"
            :error="apogeeCodeError"
            @input="updateApogeeCode"
        />
        <FormInput
            label="Semestre"
            :type="FormInputType.SELECT"
            :options="periodsOptions"
            :value="teaching.period?.id"
            placeholder="ex : TIN13A1S"
            :error="periodError"
            @input="updateSemester"
        />
        <FormMCCCTable
            class="w-full h-full"
            :mccc-form-input="teaching.mcccFormInput"
            @updateMCCCFormInput="updateMCCCFormInput"
        />
        <FormButton class="bg-green-500 text-white" @click="handleAdd"
            >Ajouter</FormButton
        >
        <ErrorPopup
            v-if="errorMessage"
            :message="errorMessage!"
            @close="resetErrorMessage"
        />
    </div>
</template>
