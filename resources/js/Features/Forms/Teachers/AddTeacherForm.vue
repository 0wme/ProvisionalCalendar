<script setup lang="ts">
import FormInput from "@/Components/FormInput.vue";
import ErrorPopup from "@/Features/Popups/ErrorPopup.vue";
import FormButton from "@/Components/FormButton.vue";
import { FormInputType } from "@/types/models/utils";
import { ref } from "vue";
import { computed } from "vue";
import { MESSAGES } from "@/constants";
import { Teacher, User } from "@/types/models/teachers";
import { useTeacherService } from "@/services/teacherService";

const teacherService = useTeacherService();

const props = defineProps<{
    yearId: number;
    users: User[];
}>();

const teacher = ref<Teacher>({
    name: "",
    code: "",
    user: props.users?.[0],
});

const emit = defineEmits(["successfullyAdded", "edited"]);

const codeError = ref<string | undefined>();
const userError = ref<string | undefined>();

const userOptions = computed(() => {
    return props.users?.map((u) => ({ label: u.username, value: u.id })) || [];
});

const errorMessage = ref<string | undefined>();

const updateCode = (value: string) => {
    codeError.value = undefined;
    teacher.value.code = value;
    emit("edited");
};

const updateUser = (value: string) => {
    userError.value = undefined;
    teacher.value.user = props.users?.find((u) => u.id === parseInt(value));
    emit("edited");
};

const resetErrorMessage = () => {
    errorMessage.value = undefined;
};

const handleAdd = async () => {
    if (teacher.value.code.trim() === "") {
        codeError.value = MESSAGES.EMPTY_TEACHING_NAME_ERROR_MESSAGE;
    }
    teacherService
        .addTeacher(props.yearId, teacher.value)
        .then((returnedTeacher) => emit("successfullyAdded", returnedTeacher))
        .catch((error) => (errorMessage.value = error));
};
</script>

<template>
    <div class="flex flex-col gap-6">
        <FormInput
            label="Initiaux"
            placeholder="ex : CO"
            :error="codeError"
            @input="updateCode($event.target.value)"
        />
        <FormInput
            label="Utilisateur"
            :type="FormInputType.SELECT"
            :options="userOptions"
            :value="teacher?.user?.id"
            placeholder="ex : TIN13A1S"
            :error="userError"
            @input="updateUser($event.target.value)"
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
