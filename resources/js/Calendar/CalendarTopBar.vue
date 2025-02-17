<script setup lang="ts">
import { ref, onMounted } from "vue";
import axios from "axios";

const selectedTeaching = ref('');
const teachings = ref([]);

const fetchTeachings = async () => {
    try {
        console.log('Récupération des enseignements...');
        const response = await axios.get('/api/enseignements/1');
        console.log('Réponse:', response.data);
        teachings.value = response.data;
    } catch (error) {
        console.error('Erreur lors de la récupération des enseignements:', error);
    }
};

onMounted(() => {
    fetchTeachings();
});
</script>

<template>
    <div class="mb-2">
        <select 
            v-model="selectedTeaching"
            class="p-2 bg-white border border-gray-300 rounded-lg min-w-[300px]"
        >
            <option value="">Sélectionner un enseignement</option>
            <option 
                v-for="teaching in teachings" 
                :key="teaching.id" 
                :value="teaching.id"
            >
                {{ teaching.title }}
            </option>
        </select>
    </div>
</template>
