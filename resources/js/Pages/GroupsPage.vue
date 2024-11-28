<script setup lang="ts">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ClassListManager from '@/Features/ListManager/Groups/ClassListManager.vue';
import GroupListManager from '@/Features/ListManager/Groups/GroupListManager.vue';
import SubgroupListManager from '@/Features/ListManager/Groups/SubgroupListManager.vue';
import { ref, computed, onMounted } from 'vue';
import { Class, Group, Subgroup } from '@/types/models';
import AddClassPopup from '@/Features/Popup/Groups/Class/AddClassPopup.vue';
import EditClassPopup from '@/Features/Popup/Groups/Class/EditClassPopup.vue';
import AddGroupPopup from '@/Features/Popup/Groups/Group/AddGroupPopup.vue';
import EditGroupPopup from '@/Features/Popup/Groups/Group/EditGroupPopup.vue';
import AddSubgroupPopup from '@/Features/Popup/Groups/Subgroup/AddSubgroupPopup.vue';
import EditSubgroupPopup from '@/Features/Popup/Groups/Subgroup/EditSubgroupPopup.vue';
import axios from 'axios';
import ErrorPopup from '@/Features/Popup/ErrorPopup.vue';

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
                    g.id === group.id ? { ...g, name: response.data.group.name } : g
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
    if (selectedGroupId.value === group.id) {
        selectedGroupId.value = undefined;
    }
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
    classes.value = classes.value.map(classe => {
        if (classe.id === selectedClassId.value) {
            return { ...classe, groups: classe.groups.map(group => 
                group.id === selectedGroupId.value ? { ...group, subgroups: [...group.subgroups, response.data.subgroup] } : group
            ) };
        }
        return classe;
    });
}

const handleDeleteSubgroup = async (subgroup: Subgroup) => {
    hideEditSubgroupPopup();
    await axios.delete('/api/groupes/sous-groupe/' + subgroup.id);
    classes.value = classes.value.map(classe => {
        if (classe.id === selectedClassId.value) {
            return { ...classe, groups: classe.groups.map(group =>
                group.id === selectedGroupId.value ? { ...group, subgroups: group.subgroups.filter(s => s.id !== subgroup.id) } : group
            ) };
        }
        return classe;
    });
}

const hideAddSubgroupPopup = () => {
    isAddSubgroupPopupVisible.value = false;
}

const showEditSubgroupPopup = () => {
    isVisibleEditSubgroupPopup.value = true;
}

const handleEditSubgroup = async (id: number) => {
    const response = await axios.get('/api/groupes/sous-groupe/' + id);
    subgroupToEdit.value = response.data;
    showEditSubgroupPopup();
}

const hideEditSubgroupPopup = () => {
    isVisibleEditSubgroupPopup.value = false;
}

const handleSaveEditedSubgroup = async (subgroup: Subgroup) => {
    hideEditSubgroupPopup();
    const response = await axios.put('/api/groupes/sous-groupe/' + subgroup.id, subgroup);
    classes.value = classes.value.map(classe => {
        if (classe.id === selectedClassId.value) {
            return { ...classe, groups: classe.groups.map(group =>
                group.id === selectedGroupId.value ? { ...group, subgroups: group.subgroups.map(s => s.id === subgroup.id ? { ...s, name: response.data.subgroup.name } : s) } : group
            ) };
        }
        return classe;
    });
}

const showAddSubgroupPopup = () => {
    if (selectedGroupId.value) {
        isAddSubgroupPopupVisible.value = true;
    }
}

const isAddClassPopupVisible = ref<boolean>(false);
const isVisibleEditClassPopup = ref<boolean>(false);
const editedClass = ref<Class | undefined>();

const showAddClassPopup = () => {
    isAddClassPopupVisible.value = true;
}

const hideAddClassPopup = () => {
    isAddClassPopupVisible.value = false;
}

const showEditClassPopup = () => {
    isVisibleEditClassPopup.value = true;
}

const hideEditClassPopup = () => {
    isVisibleEditClassPopup.value = false;
}

const handleAddClass = async (classe: Class) => {
    hideAddClassPopup();
    classes.value = [...classes.value, classe];
}

const handleDeleteClass = async (classe: Class) => {
    hideEditClassPopup();
    classes.value = classes.value.filter(c => c.id !== classe.id);
    if (selectedClassId.value === classe.id) {
        selectedClassId.value = undefined;
        selectedGroupId.value = undefined;
    }
}

const handleSaveEditedClass = async (classe: Class) => {
    hideEditClassPopup();
    classes.value = classes.value.map(c => c.id === classe.id ? { ...c, name: classe.name } : c);
}

const handleEditClass = async (id: number) => {
    const response = await axios.get('/api/groupes/promotion/' + id);
    editedClass.value = response.data;
    showEditClassPopup();
}

const handleError = (error: string) => {
    errorMessage.value = error;
    showErrorPopup();
}

const showErrorPopup = () => {
    isErrorPopupVisible.value = true;
}

const hideErrorPopup = () => {
    isErrorPopupVisible.value = false;
}

const errorMessage = ref<string>('');
const isErrorPopupVisible = ref<boolean>(false);
</script>

<template>
    <AdminLayout>
        <div class="flex gap-10 w-full h-full">
            <ClassListManager class="w-full h-full" :classes :selectedClassId @select="handleClassSelect" @add="showAddClassPopup" @edit="handleEditClass" />
            <GroupListManager class="w-full h-full" :groups :selectedGroupId @select="handleGroupSelect" @add="showAddGroupPopup" @edit="handleEditGroup" />
            <SubgroupListManager class="w-full h-full" :subgroups @add="showAddSubgroupPopup" @edit="handleEditSubgroup" />
        </div>
    </AdminLayout>
    <AddClassPopup
        :show="isAddClassPopupVisible"
        @cancel="hideAddClassPopup"
        @add="handleAddClass"
        @error="handleError"
    />
    <EditClassPopup
        :classe="editedClass"
        :show="isVisibleEditClassPopup"
        @cancel="hideEditClassPopup"
        @delete="handleDeleteClass"
        @save="handleSaveEditedClass"
        @error="handleError"
    />
    <AddGroupPopup
        :show="isAddGroupPopupVisible"
        @cancel="hideAddGroupPopup"
        @add="handleAddGroup"
        @error="handleError"
    />
    <EditGroupPopup
        :group="groupToEdit"
        :show="isVisibleEditGroupPopup"
        @cancel="hideEditGroupPopup"
        @delete="handleDeleteGroup"
        @save="handleSaveEditedGroup"
        @error="handleError"
    />
    <AddSubgroupPopup
        :show="isAddSubgroupPopupVisible"
        @cancel="hideAddSubgroupPopup"
        @add="handleAddSubgroup"
        @error="handleError"
    />
    <EditSubgroupPopup
        :subgroup="subgroupToEdit"
        :show="isVisibleEditSubgroupPopup"
        @cancel="hideEditSubgroupPopup"
        @delete="handleDeleteSubgroup"
        @save="handleSaveEditedSubgroup"
        @error="handleError"
    />
    <ErrorPopup
        :message="errorMessage"
        :show="isErrorPopupVisible"
        @close="hideErrorPopup"
    />
</template>
