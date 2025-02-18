<script setup lang="ts">
import { ref, onMounted, computed, defineEmits } from "vue";
import axios from "axios";
import SearchBar from '@/Components/SearchBar.vue';
import Filter from '@/Components/Filter.vue';

const emit = defineEmits(['teachingSelected']);

const selectedTeaching = ref(null);
const teachings = ref([]);
const searchQuery = ref('');
const showTeachingsList = ref(false);
const selectedPeriodId = ref(0);

const periods = [
    { id: 1, name: 'Semestre 1' },
    { id: 2, name: 'Semestre 2' },
    { id: 3, name: 'Semestre 3' },
    { id: 4, name: 'Semestre 4' },
    { id: 5, name: 'Semestre 5' },
    { id: 6, name: 'Semestre 6' }
];

// Filtrer les enseignements par semestre et recherche
const filteredTeachings = computed(() => {
    const currentPeriodId = periods[selectedPeriodId.value].id;
    let filtered = teachings.value.filter(teaching => 
        teaching.semester === currentPeriodId || teaching.trimester === currentPeriodId
    );
    
    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase();
        filtered = filtered.filter(teaching => 
            teaching.title.toLowerCase().includes(query) || 
            teaching.apogee_code.toLowerCase().includes(query)
        );
    }
    
    return filtered;
});

const handleSearch = (event: Event) => {
    const target = event.target as HTMLInputElement;
    searchQuery.value = target.value;
};

const handlePreviousPeriod = () => {
    selectedPeriodId.value = selectedPeriodId.value === 0 ? (periods.length - 1) : (selectedPeriodId.value - 1);
};

const handleNextPeriod = () => {
    selectedPeriodId.value = selectedPeriodId.value < (periods.length - 1) ? (selectedPeriodId.value + 1) : 0;
};

const selectTeaching = (teaching: any) => {
    console.log(' Enseignement sélectionné:', {
        id: teaching.id,
        title: teaching.title,
        apogee_code: teaching.apogee_code
    });
    selectedTeaching.value = teaching;
    showTeachingsList.value = false;
    emit('teachingSelected', teaching.id);
};

const toggleTeachingsList = () => {
    showTeachingsList.value = !showTeachingsList.value;
};

const fetchTeachings = async () => {
    try {
        const response = await axios.get('/api/enseignements/1');
        teachings.value = response.data;
        console.log('Enseignements reçus:', response.data);
    } catch (error) {
        console.error('Erreur lors de la récupération des enseignements:', error);
    }
};

onMounted(() => {
    fetchTeachings();
    // Fermer la liste quand on clique ailleurs
    document.addEventListener('click', (e) => {
        const target = e.target as HTMLElement;
        if (!target.closest('.teachings-container')) {
            showTeachingsList.value = false;
        }
    });
});
</script>

<template>
    <div class="teachings-container relative">
        <!-- Bouton par défaut ou affichage compact -->
        <div @click="toggleTeachingsList"
             class="flex items-center cursor-pointer border rounded-lg overflow-hidden bg-white shadow-sm">
            <template v-if="selectedTeaching">
                <!-- Semestre -->
                <div class="bg-pink-100 p-2 text-center">
                    <div>S</div>
                    <div>{{ selectedTeaching.semester }}</div>
                </div>
                <!-- Code et type -->
                <div class="flex-1 p-2">
                    <div class="flex justify-between items-center">
                        <div>{{ selectedTeaching.apogee_code }}</div>
                        <div class="text-purple-700 bg-purple-100 px-2 rounded">CM</div>
                    </div>
                </div>
            </template>
            <template v-else>
                <div class="p-3 text-gray-700 flex items-center justify-between w-full hover:bg-gray-50">
                    <span class="font-medium">Sélectionner un enseignement</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </template>
        </div>

        <!-- Liste des enseignements -->
        <div v-if="showTeachingsList" 
             class="absolute top-full left-0 w-80 mt-2 bg-white border rounded-lg shadow-lg z-50">
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-4">Enseignements</h3>
                
                <!-- Barre de recherche -->
                <SearchBar 
                    placeholder="Rechercher un enseignement..."
                    @input="handleSearch"
                    :value="searchQuery"
                    class="mb-4"
                />

                <!-- Sélecteur de semestre -->
                <div class="flex items-center justify-between mb-4">
                    <button @click="handlePreviousPeriod" class="text-pink-500">&lt;</button>
                    <span>{{ periods[selectedPeriodId].name }}</span>
                    <button @click="handleNextPeriod" class="text-pink-500">&gt;</button>
                </div>

                <!-- Liste des enseignements filtrés -->
                <div class="max-h-60 overflow-y-auto">
                    <div v-for="teaching in filteredTeachings" 
                         :key="teaching.id"
                         @click="selectTeaching(teaching)"
                         class="p-2 hover:bg-gray-100 cursor-pointer">
                        {{ teaching.apogee_code }} {{ teaching.title }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.teachings-container {
    min-width: 200px;
}
</style>
