<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';
import HeaderMenu from '@/Components/Navigation/HeaderMenu.vue';
import { sidebarMenuItems } from '@/config/navigation';
import MainLayout from './MainLayout.vue';
import Button from '@/Components/Button.vue';
import AddYearPopup from '@/Components/Popup/AddYearPopup.vue';

const contentHeight = ref<number>(0);
const mainLayout = ref<HTMLElement | null>(null);
const headerMenu = ref<HTMLElement | null>(null);
const observer = ref<MutationObserver | null>(null);
const currentPath = ref(window.location.pathname.split('/')[1]);
const showAddYearPopup = ref(false);

const getCurrentSubmenu = () => {
    const currentItem = sidebarMenuItems.find(item => item.route === currentPath.value);
    return currentItem?.submenu;
};

const updateMainContentHeight = () => {
    requestAnimationFrame(() => {
        const headerMenuHeight = headerMenu.value?.getBoundingClientRect().bottom ?? 0;
        contentHeight.value = window.innerHeight - headerMenuHeight - 80;
    });
};

const handleAddYear = () => {
    showAddYearPopup.value = true;
};

onMounted(() => {
    headerMenu.value = mainLayout.value!.querySelector('.header-menu');
    
    window.addEventListener('resize', updateMainContentHeight);
    
    observer.value = new MutationObserver(() => {
        setTimeout(updateMainContentHeight, 1);
    });
    
    observer.value.observe(mainLayout.value!, {
        attributes: true,
        subtree: true
    });
    
    updateMainContentHeight();
});

onUnmounted(() => {
    observer.value?.disconnect();
    window.removeEventListener('resize', updateMainContentHeight);
});
</script>

<template>
    <MainLayout>
        <div ref="mainLayout" class="flex flex-col gap-10 -mt-10">
            <div class="flex justify-between items-center px-6">
                <HeaderMenu :items="getCurrentSubmenu()!" />
                <Button class="bg-green-500 text-white" @click="handleAddYear">
                    Ajouter une année
                </Button>
            </div>
            <div class="content w-full" :style="{ '--header-menu-height': contentHeight + 'px' }">
                <slot />
            </div>
        </div>
    </MainLayout>

    <AddYearPopup 
        v-if="showAddYearPopup"
        :show="showAddYearPopup"
        @close="showAddYearPopup = false"
    />
</template>

<style scoped>
.content {
    height: var(--header-menu-height);
}
</style>