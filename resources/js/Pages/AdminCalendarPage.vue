<script setup lang="ts">
import { ref, onMounted } from "vue";
import axios from "axios";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import TeachersListManager from "@/Features/ListManager/TeachersListManager.vue";
import CalendarTable from "@/Calendar/CalendarTable.vue";
import AddCalendarPopup from "@/Features/Popup/Calendar/AddCalendarPopup.vue";

const teachers = ref([]);
const selectedTeacherIds = ref<number[]>([]);
const isAddCalendarPopupVisible = ref<boolean>(false);

onMounted(async () => {
    try {
        const teachersResponse = await axios.get("/api/enseignants/1");
        teachers.value = teachersResponse.data
            .filter(
                (teacher: any) =>
                    teacher.teachings && teacher.teachings.length > 0
            )
            .map((teacher: any) => ({
                id: teacher.id,
                name: `${teacher.first_name} ${teacher.last_name}`,
            }));
    } catch (error) {
        console.error("Erreur lors de la récupération des enseignants:", error);
    }
});
</script>

<template>
    <AdminLayout>
        <div class="h-full w-full flex gap-4">
            <TeachersListManager
                :teachers="teachers"
                :selectedTeacherIds="selectedTeacherIds"
                class="w-1/4"
            />
            <CalendarTable class="w-3/4" />
        </div>
    </AdminLayout>
    <AddCalendarPopup :show="isAddCalendarPopupVisible" />
</template>
