<script setup lang="ts">
import AdminLayout from "@/Layouts/AdminLayout.vue";
import GroupListManager from "@/Features/ListManagers/Groups/GroupListManager.vue";
import SubgroupListManager from "@/Features/ListManagers/Groups/SubgroupListManager.vue";
import { ref } from "vue";
import PromotionListManager from "@/Features/ListManagers/Groups/PromotionListManager.vue";

const yearId = ref<number>(1);
const selectedPromotionId = ref<number | undefined>();
const selectedGroupId = ref<number | undefined>();

const unselectPromotion = () => {
    selectedPromotionId.value = undefined;
    selectedGroupId.value = undefined;
};

const unselectGroup = () => {
    selectedGroupId.value = undefined;
};

const handlePromotionSelect = (id: number) => {
    if (selectedPromotionId.value === id) {
        unselectPromotion();
        return;
    }
    selectedPromotionId.value = id;
    selectedGroupId.value = undefined;
};

const handleGroupSelect = (id: number) => {
    if (selectedGroupId.value === id) {
        selectedGroupId.value = undefined;
        return;
    }
    selectedGroupId.value = id;
};

const handlePromotionDeleted = (id: number) => {
    console.log(id);
    if (selectedPromotionId.value === id) {
        unselectPromotion();
    }
};

const handleGroupDeleted = (id: number) => {
    if (selectedGroupId.value === id) {
        unselectGroup();
    }
};
</script>

<template>
    <AdminLayout>
        <div class="flex gap-10 w-full h-full">
            <PromotionListManager
                class="w-full h-full"
                :yearId
                :selectedPromotionId="selectedPromotionId"
                @select="handlePromotionSelect"
                @successfullyDeleted="handlePromotionDeleted"
            />
            <GroupListManager
                class="w-full h-full"
                :promotionId="selectedPromotionId"
                :selectedGroupId="selectedGroupId"
                @select="handleGroupSelect"
                @successfullyDeleted="handleGroupDeleted"
            />
            <SubgroupListManager
                :groupId="selectedGroupId"
                class="w-full h-full"
            />
        </div>
    </AdminLayout>
</template>
