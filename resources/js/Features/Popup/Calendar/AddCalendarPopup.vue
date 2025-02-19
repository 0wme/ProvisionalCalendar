<script setup lang="ts">
import { ref, computed, watch } from "vue";
import Popup from "@/Components/Popup/Popup.vue";
import CloseWithoutSaveConfirmationPopup from "@/Components/CloseWithoutSaveConfirmationPopup.vue";
import { useCalendarStore } from '@/stores/calendar';

const calendarStore = useCalendarStore();
const showPopup = computed(() => calendarStore.showingAddCalendarPopup);
const popupData = computed(() => calendarStore.addCalendarPopupData);

const professors = ref([
    { label: "POURSAT Anaïs", value: "poursat" },
    { label: "DUBREUIL Laurent", value: "laurent" },
]);

const initialState = {
    selectedProfessor: "",
    replacementProfessor: "",
    hours: "",
    evaluation: false,
    replaced: false,
    neutralized: false,
};

const selectedProfessor = ref(initialState.selectedProfessor);
const replacementProfessor = ref(initialState.replacementProfessor);
const hours = ref(initialState.hours);
const evaluation = ref(initialState.evaluation);
const replaced = ref(initialState.replaced);
const neutralized = ref(initialState.neutralized);
const showConfirmation = ref(false);

// Mettre à jour les données quand un enseignant est déposé
watch(popupData, (newData) => {
    if (newData?.teacherId) {
        const teacherData = JSON.parse(localStorage.getItem('lastTeacherDrag') || '{}');
        selectedProfessor.value = teacherData.name || '';
    }
}, { immediate: true });

const hasChanges = computed(() => {
    return (
        selectedProfessor.value !== initialState.selectedProfessor ||
        replacementProfessor.value !== initialState.replacementProfessor ||
        hours.value !== initialState.hours ||
        evaluation.value !== initialState.evaluation ||
        replaced.value !== initialState.replaced ||
        neutralized.value !== initialState.neutralized
    );
});

const confirmClose = () => {
    showConfirmation.value = false;
    calendarStore.hideAddCalendarPopup();
};

const cancelClose = () => {
    showConfirmation.value = false;
};

const closePopup = () => {
    if (hasChanges.value) {
        showConfirmation.value = true;
    } else {
        calendarStore.hideAddCalendarPopup();
    }
};

const isFormValid = computed(() => {
    return hours.value && hours.value.trim() !== '';
});

const modifyCalendar = async () => {
    if (!popupData.value) return;

    try {
        const payload = {
            teacherId: popupData.value.teacherId,
            hours: parseFloat(hours.value),
            isEvaluation: evaluation.value,
            isReplaced: replaced.value,
            isNeutralized: neutralized.value,
            type: popupData.value.type,
            promotionId: popupData.value.promotionId,
            groupId: popupData.value.groupId,
            subgroupId: popupData.value.subgroupId,
        };

        // TODO: Implémenter l'appel API
        // await axios.post('/api/calendar/add', payload);
        
        calendarStore.hideAddCalendarPopup();
    } catch (error) {
        console.error('Erreur lors de la sauvegarde:', error);
    }
};
</script>

<template>
    <Popup
        title="Ajout d'un horaire"
        :show="showPopup"
        @close="closePopup"
    >
        <template v-slot:content>
            <div class="space-y-4">
                <!-- Professeur -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Professeur</label>
                    <div class="relative">
                        <input 
                            type="text" 
                            v-model="selectedProfessor" 
                            disabled
                            class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100"
                        />
                    </div>
                </div>

                <!-- Heures -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre d'heures</label>
                    <input 
                        type="text" 
                        v-model="hours"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                        placeholder="Saisir le nombre d'heures"
                    />
                </div>

                <!-- Checkboxes -->
                <div class="space-y-4 mt-4">
                    <div class="flex items-center space-x-3">
                        <input
                            type="checkbox"
                            v-model="evaluation"
                            class="w-5 h-5 rounded border-gray-300 text-emerald-500 focus:ring-emerald-500"
                        />
                        <label class="text-lg font-medium text-gray-700">Évaluation</label>
                    </div>

                    <div class="flex items-center space-x-3">
                        <input
                            type="checkbox"
                            v-model="replaced"
                            class="w-5 h-5 rounded border-gray-300 text-emerald-500 focus:ring-emerald-500"
                        />
                        <label class="text-lg font-medium text-gray-700">Remplacé</label>
                    </div>

                    <div class="flex items-center space-x-3">
                        <input
                            type="checkbox"
                            v-model="neutralized"
                            class="w-5 h-5 rounded border-gray-300 text-emerald-500 focus:ring-emerald-500"
                        />
                        <label class="text-lg font-medium text-gray-700">Neutralisé</label>
                    </div>
                </div>
            </div>
        </template>

        <template v-slot:footer>
            <button 
                @click="modifyCalendar"
                :disabled="!isFormValid"
                :class="[
                    'w-full py-3 px-4 rounded-lg transition-colors',
                    isFormValid 
                        ? 'bg-emerald-500 hover:bg-emerald-600 text-white cursor-pointer' 
                        : 'bg-gray-300 text-gray-500 cursor-not-allowed'
                ]"
            >
                Valider
            </button>
        </template>
    </Popup>

    <CloseWithoutSaveConfirmationPopup
        :show="showConfirmation"
        @confirm="confirmClose"
        @cancel="cancelClose"
    />
</template>

<style scoped>
.bg-primary-600 {
    @apply bg-emerald-600;
}

.text-primary-600 {
    @apply text-emerald-600;
}

.focus\:ring-primary-500:focus {
    @apply ring-emerald-500;
}

.focus\:border-primary-500:focus {
    @apply border-emerald-500;
}
</style>
