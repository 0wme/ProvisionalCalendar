<script setup lang="ts">
import SubgroupListManager from "@/Features/ListManager/Groups/SubGroupListManager.vue";
</script>

<template>
    <div class="m-10">
        <SubgroupListManager
            class="w-full h-full"
            :groupId="6"
            :selectedSubgroupId="12"
        />
    </div>
</template>
