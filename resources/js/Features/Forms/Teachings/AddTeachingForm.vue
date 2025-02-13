<script setup lang="ts">
import FormInput from "@/Components/FormInput.vue";
import ErrorPopup from "@/Features/Popups/ErrorPopup.vue";
import { Teaching, MCCCFormInput } from "@/types/models/teachings";
import FormMCCCTable from "@/Features/FormMCCCTable.vue";
import FormButton from "@/Components/FormButton.vue";
import { Period, PeriodType } from "@/types/models/periods";
import { FormInputType, SelectOption } from "@/types/models/utils";
import { ref, onMounted } from "vue";
import axios, { AxiosError } from "axios";
import { API_ENDPOINTS, MESSAGES } from "@/constants";

const props = defineProps<{
    yearId: number;
    periods: Period[];
    periodsType: PeriodType;
}>();

const teaching = ref<Teaching>({
    id: 0,
    name: "",
    apogee_code: "",
    mcccFormInput: {
        initial_cm: 0,
        initial_td: 0,
        initial_tp: 0,
        continuing_cm: 0,
        continuing_td: 0,
        continuing_tp: 0,
    },
});

const emit = defineEmits(["successfullyAdded", "edited"]);

onMounted(() => convertPeriodsToOptions());

const nameError = ref<string | undefined>();
const apogeeCodeError = ref<string | undefined>();
const periodError = ref<string | undefined>();

const errorMessage = ref<string | undefined>();

const periodsOptions = ref<SelectOption[]>();

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
    teaching.value.period = props.periods[0];
};

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

const updatePeriod = (value: string) => {
    teaching.value.period = props.periods?.find(
        (p) => p.id === parseInt(value)
    );
    emit("edited");
};

const updateMCCCFormInput = (value: MCCCFormInput) => {
    teaching.value.mcccFormInput = value;
    emit("edited");
};

const resetErrorMessage = () => {
    errorMessage.value = undefined;
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
            {
                title: teaching.value.name,
                apogee_code: teaching.value.apogee_code,
                tp_hours_initial: teaching.value.mcccFormInput.initial_tp,
                tp_hours_continued: teaching.value.mcccFormInput.continuing_tp,
                td_hours_initial: teaching.value.mcccFormInput.initial_td,
                td_hours_continued: teaching.value.mcccFormInput.continuing_td,
                cm_hours_initial: teaching.value.mcccFormInput.initial_cm,
                cm_hours_continued: teaching.value.mcccFormInput.continuing_cm,
                semester:
                    props.periodsType === PeriodType.SEMESTER
                        ? teaching.value.period?.id
                        : undefined,
                trimester:
                    props.periodsType === PeriodType.TRIMESTER
                        ? teaching.value.period?.id
                        : undefined,
            }
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
            @input="updateName($event.target.value)"
        />
        <FormInput
            label="Code Apogée"
            placeholder="ex : TIN13A1S"
            :error="apogeeCodeError"
            @input="updateApogeeCode($event.target.value)"
        />
        <FormInput
            label="Période"
            :type="FormInputType.SELECT"
            :options="periodsOptions"
            :value="teaching.period?.id"
            placeholder="ex : TIN13A1S"
            :error="periodError"
            @input="updatePeriod($event.target.value)"
        />
        <FormMCCCTable
            class="w-full h-full"
            :mcccFormInput="teaching.mcccFormInput"
            @updateMCCCFormInput="updateMCCCFormInput($event)"
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
