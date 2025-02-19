<script setup lang="ts">
import CalendarSlot from "@/Calendar/CalendarSlot.vue";
import { computed, ref } from "vue";
import { SlotType } from "@/types/models";
import { useCalendarStore } from "@/stores/calendar";

const calendarStore = useCalendarStore();

const props = defineProps<{
    groupData: any;
    biggestCM: number;
    biggestTD: number;
    biggestTP: number;
}>();

const isDragOver = ref<boolean>(false);

const getGroupType = (): SlotType | null => {
    // Si le groupe a des contenus, on prend le type du premier contenu
    if (props.groupData.contents && props.groupData.contents.length > 0) {
        return props.groupData.contents[0].type as SlotType;
    }
    return null;
};

const getSlotType = (element: HTMLElement): SlotType | null => {
    // Vérifier si l'élément a une classe spécifique ou est dans une colonne spécifique
    const rect = element.getBoundingClientRect();
    const cells = document.querySelectorAll('.calendar-cell');
    const index = Array.from(cells).indexOf(element);
    
    // Déterminer le type en fonction de la position
    if (rect.left < window.innerWidth / 3) return SlotType.CM;
    if (rect.left < (window.innerWidth * 2) / 3) return SlotType.TD;
    return SlotType.TP;
};

const handleDrop = (e: DragEvent) => {
    console.log('Drop event:', e);
    const teacherData = JSON.parse(e.dataTransfer?.getData('teacher') || '{}');
    console.log('Teacher data:', teacherData);
    
    // Obtenir l'élément sur lequel le drop a eu lieu
    const dropTarget = e.target as HTMLElement;
    const cellElement = dropTarget.closest('.calendar-cell');
    
    if (!cellElement) {
        console.log('No calendar cell found');
        return;
    }
    
    // Déterminer le type de cellule et l'ID
    const slotType = getSlotType(cellElement);
    console.log('Detected slot type:', slotType);
    
    if (teacherData.id && slotType) {
        // Sauvegarder les données de l'enseignant pour la popup
        localStorage.setItem('lastTeacherDrag', JSON.stringify(teacherData));
        
        // Créer les données pour la popup
        const popupData = {
            teacherId: teacherData.id,
            type: slotType,
            // Utiliser un ID temporaire pour les cellules vides
            [slotType === SlotType.CM ? 'promotionId' : 
             slotType === SlotType.TD ? 'groupId' : 'subgroupId']: props.groupData.id || Date.now()
        };
        
        console.log('Showing popup with data:', popupData);
        calendarStore.showAddCalendarPopup(popupData);
    }
    
    isDragOver.value = false;
};

const cellWidth = computed(() => {
    const type = getGroupType();
    switch (type) {
        case SlotType.CM:
            return props.biggestCM * 96;
        case SlotType.TD:
            return props.biggestTD * 96;
        case SlotType.TP:
            return props.biggestTP * 96;
        default:
            return 96;
    }
});
</script>

<template>
    <div 
        class="calendar-cell flex w-max h-full"
        :data-cell-type="getGroupType()"
    >
        <div
            :class="[
                'relative min-w-96 flex items-center justify-start border-r-2 bg-white border-b-2 border-gray-200 after:absolute after:top-0 after:bottom-0 after:right-0 after:left-0',
                { 'after:bg-blue-500 after:opacity-20': isDragOver },
            ]"
            :style="{ width: `${cellWidth}px` }"
            @dragover.prevent="isDragOver = true"
            @dragleave="isDragOver = false"
            @drop="handleDrop"
        >
            <CalendarSlot
                v-for="content in groupData.contents"
                :content="content"
                :contentType="getGroupType()"
            />
        </div>
        <div class="flex flex-col">
            <CalendarCell
                v-for="group in groupData.groups"
                :groupData="group"
                :biggestCM="props.biggestCM"
                :biggestTD="props.biggestTD"
                :biggestTP="props.biggestTP"
            />
        </div>
    </div>
</template>
