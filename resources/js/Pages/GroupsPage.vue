<script setup lang="ts">
import AdminLayout from "@/Layouts/AdminLayout.vue";
import GroupListManager from "@/Features/ListManager/Groups/GroupListManager.vue";
import SubgroupListManager from "@/Features/ListManager/Groups/SubgroupListManager.vue";
import { ref } from "vue";
import PromotionListManager from "@/Features/ListManager/Groups/PromotionListManager.vue";

const yearId = ref<number>(1);
const selectedPromotionId = ref<number | undefined>();
const selectedGroupId = ref<number | undefined>();

const handlePromotionSelect = (id: number) => (selectedPromotionId.value = id);

const handleGroupSelect = (id: number) => (selectedGroupId.value = id);
</script>

<template>
    <AdminLayout>
        <div class="flex gap-10 w-full h-full">
            <PromotionListManager
                class="w-full h-full"
                :yearId
                :selectedPromotionId="selectedPromotionId"
                @select="handlePromotionSelect"
            />
            <GroupListManager
                class="w-full h-full"
                :promotionId="selectedPromotionId"
                :selectedGroupId="selectedGroupId"
                @select="handleGroupSelect"
            />
            <SubgroupListManager
                :groupId="selectedGroupId"
                class="w-full h-full"
            />
        </div>
    </AdminLayout>
</template>
