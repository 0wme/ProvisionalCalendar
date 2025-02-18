<script setup lang="ts">
import { ref, onMounted, computed } from "vue";
import axios from "axios";
import SearchBar from '@/Components/SearchBar.vue';

const selectedTeaching = ref(null);
const teachings = ref([]);
const searchQuery = ref('');
const showResults = ref(false);

// Filtrer les enseignements en fonction de la recherche
const filteredTeachings = computed(() => {
    if (!searchQuery.value) return [];
    const query = searchQuery.value.toLowerCase();
    return teachings.value.filter(teaching => 
        teaching.title.toLowerCase().includes(query)
    );
});

const handleSearch = (event: Event) => {
    const target = event.target as HTMLInputElement;
    searchQuery.value = target.value;
    showResults.value = true;
};

const selectTeaching = (teaching: any) => {
    selectedTeaching.value = teaching;
    searchQuery.value = teaching.title;
    showResults.value = false;
};

const fetchTeachings = async () => {
    try {
        const response = await axios.get('/api/enseignements/1');
        teachings.value = response.data;
    } catch (error) {
        console.error('Erreur lors de la récupération des enseignements:', error);
    }
};

onMounted(() => {
    fetchTeachings();
    // Fermer les résultats quand on clique ailleurs
    document.addEventListener('click', (e) => {
        const target = e.target as HTMLElement;
        if (!target.closest('.search-container')) {
            showResults.value = false;
        }
    });
});
</script>

<template>
    <div class="mb-2 search-container relative">
        <SearchBar 
            placeholder="Rechercher un enseignement..."
            @input="handleSearch"
            :value="searchQuery"
        />
        
        <!-- Liste des résultats -->
        <div v-if="showResults && filteredTeachings.length > 0" 
             class="absolute w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg z-50 max-h-60 overflow-y-auto">
            <div v-for="teaching in filteredTeachings" 
                 :key="teaching.id"
                 @click="selectTeaching(teaching)"
                 class="p-2 hover:bg-gray-100 cursor-pointer">
                {{ teaching.title }}
            </div>
        </div>

        <!-- Affichage de l'enseignement sélectionné -->
        <div v-if="selectedTeaching" class="mt-2 p-2 bg-gray-100 rounded-lg">
            Enseignement sélectionné : {{ selectedTeaching.title }}
        </div>
    </div>
</template>

<style scoped>
.search-container {
    min-width: 300px;
}
</style>
