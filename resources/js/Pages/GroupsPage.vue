<script setup lang="ts">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ClassListManager from '@/Features/ListManager/Groups/ClassListManager.vue';
import GroupListManager from '@/Features/ListManager/Groups/GroupListManager.vue';
import SubgroupListManager from '@/Features/ListManager/Groups/SubgroupListManager.vue';
import { ref, computed, onMounted } from 'vue';
import { Class, Group, Subgroup } from '@/types/models';
import AddGroupPopup from '@/Features/Popup/Groups/Group/AddGroupPopup.vue';
import EditGroupPopup from '@/Features/Popup/Groups/Group/EditGroupPopup.vue';
import axios from 'axios';

const classes = ref<Class[]>([]);

onMounted(async () => {
    const response = await axios.get('/api/groupes/' + 1);
    classes.value = response.data;
});

const isAddGroupPopupVisible = ref<boolean>(false);
const isVisibleEditGroupPopup = ref<boolean>(false);
const groupToEdit = ref<Group | undefined>();

const selectedClassId = ref<number | undefined>();
const selectedGroupId = ref<number | undefined>();

const groups = computed(() => classes.value.find(c => c.id === selectedClassId.value)?.groups ?? []);
const subgroups = computed(() => groups.value?.find(g => g.id === selectedGroupId.value)?.subgroups ?? []);

const handleClassSelect = (id: number) => {
    if (id === selectedClassId.value) {
        selectedClassId.value = undefined;
        selectedGroupId.value = undefined;
    } else {
        selectedClassId.value = id;
        selectedGroupId.value = undefined;
    }
}

const handleGroupSelect = (id: number) => {
    if (id === selectedGroupId.value) {
        selectedGroupId.value = undefined;
    } else {
        selectedGroupId.value = id;
    }
}

const handleEditGroup = async (id: number) => {
    const response = await axios.get('/api/groupes/groupe/' + id);
    groupToEdit.value = response.data;
    showEditGroupPopup();
}

const showEditGroupPopup = () => {
    isVisibleEditGroupPopup.value = true;
}

const hideEditGroupPopup = () => {
    isVisibleEditGroupPopup.value = false;
}

const handleSaveEditedGroup = async (group: Group) => {
    hideEditGroupPopup();
    const response = await axios.put('/api/groupes/groupe/' + group.id, group);
    classes.value = classes.value.map(classe => {
        if (classe.id === selectedClassId.value) {
            return {
                ...classe,
                groups: classe.groups.map(g => 
                    g.id === group.id ? response.data.group : g
                )
            };
        }
        return classe;
    });
}

const hideAddGroupPopup = () => {
    isAddGroupPopupVisible.value = false;
}

const handleDeleteGroup = async (group: Group) => {
    hideEditGroupPopup();
    await axios.delete('/api/groupes/groupe/' + group.id);
    classes.value = classes.value.map(classe => {
        if (classe.id === selectedClassId.value) {
            return {
                ...classe,
                groups: classe.groups.filter(g => g.id !== group.id)
            };
        }
        return classe;
    });
}

const showAddGroupPopup = () => {
    if (selectedClassId.value) {
        isAddGroupPopupVisible.value = true;
    }
}

const handleAddGroup = async (group: Group) => {
    hideAddGroupPopup();
    const response = await axios.post('/api/groupes/groupe/' + selectedClassId.value, group);
    classes.value = classes.value.map(classe => {
        if (classe.id === selectedClassId.value) {
            return { ...classe, groups: [...classe.groups, response.data.group] };
        }
        return classe;
    });
}

const isAddSubgroupPopupVisible = ref<boolean>(false);
const isVisibleEditSubgroupPopup = ref<boolean>(false);
const subgroupToEdit = ref<Subgroup | undefined>();

const handleAddSubgroup = async (subgroup: Subgroup) => {
    hideAddSubgroupPopup();
    const response = await axios.post('/api/groupes/sous-groupe/' + selectedGroupId.value, subgroup);
}

const hideAddSubgroupPopup = () => {
    isAddSubgroupPopupVisible.value = false;
}

const showEditSubgroupPopup = () => {
    isVisibleEditSubgroupPopup.value = true;
}

const handleEditSubgroup = (id: number) => {
    subgroupToEdit.value = subgroups.value.find(s => s.id === id);
    showEditSubgroupPopup();
}

const hideEditSubgroupPopup = () => {
    isVisibleEditSubgroupPopup.value = false;
}

const handleSaveEditedSubgroup = async (subgroup: Subgroup) => {
    hideEditSubgroupPopup();
    const response = await axios.put('/api/groupes/sous-groupe/' + subgroup.id, subgroup);
}

const showAddSubgroupPopup = () => {
    isAddSubgroupPopupVisible.value = true;
}
</script>

<template>
    <AdminLayout>
        <div class="flex gap-10 w-full h-full">
            <ClassListManager class="w-full h-full" :classes :selectedClassId @select="handleClassSelect" />
            <GroupListManager class="w-full h-full" :groups :selectedGroupId @select="handleGroupSelect" @add="showAddGroupPopup" @edit="handleEditGroup" />
            <SubgroupListManager class="w-full h-full" :subgroups @add="showAddSubgroupPopup" @edit="handleEditSubgroup" />
        </div>
    </AdminLayout>
    <AddGroupPopup
        :groups
        :show="isAddGroupPopupVisible"
        @cancel="hideAddGroupPopup"
        @add="handleAddGroup"
    />
    <EditGroupPopup
        :group="groupToEdit"
        :show="isVisibleEditGroupPopup"
        @cancel="hideEditGroupPopup"
        @delete="handleDeleteGroup"
        @save="handleSaveEditedGroup"
    />
    <AddSubgroupPopup
        :subgroups
        :show="isAddSubgroupPopupVisible"
        @cancel="hideAddSubgroupPopup"
        @add="handleAddSubgroup"
    />
    <EditSubgroupPopup
        :subgroups
        :subgroup="subgroupToEdit"
        :show="isVisibleEditSubgroupPopup"
        @cancel="hideEditSubgroupPopup"
        @delete="handleDeleteSubgroup"
        @save="handleSaveEditedSubgroup"
    />
</template>
