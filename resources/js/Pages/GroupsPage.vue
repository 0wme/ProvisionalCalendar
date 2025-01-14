<script setup lang="ts">
import AdminLayout from "@/Layouts/AdminLayout.vue";
import ClassListManager from "@/Features/ListManager/Groups/PromotionListManager.vue";
import GroupListManager from "@/Features/ListManager/Groups/GroupListManager.vue";
import SubgroupListManager from "@/Features/ListManager/Groups/SubGroupListManager.vue";
import { ref, computed, onMounted } from "vue";
import { Class, Group, Subgroup } from "@/types/models";
import axios from "axios";

onMounted(async () => {
    const response = await axios.get("/api/groupes/1");
    classes.value = response.data;
});

const classes = ref<Class[]>([]);

const selectedClassId = ref<number | undefined>();
const selectedGroupId = ref<number | undefined>();

const isAddClassPopupVisible = ref<boolean>(false);
const isEditClassPopupVisible = ref<boolean>(false);
const isAddGroupPopupVisible = ref<boolean>(false);
const isEditGroupPopupVisible = ref<boolean>(false);
const isAddSubgroupPopupVisible = ref<boolean>(false);
const isEditSubgroupPopupVisible = ref<boolean>(false);
const isErrorPopupVisible = ref<boolean>(false);

const classToEditId = ref<number | undefined>();
const groupToEditId = ref<number | undefined>();
const subgroupToEditId = ref<number | undefined>();

const errorMessage = ref<string>("");

const groups = computed(
    () =>
        classes.value.find((c) => c.id === selectedClassId.value)?.groups ?? []
);
const subgroups = computed(
    () =>
        groups.value?.find((g) => g.id === selectedGroupId.value)?.subgroups ??
        []
);

const showAddClassPopup = () => (isAddClassPopupVisible.value = true);
const hideAddClassPopup = () => (isAddClassPopupVisible.value = false);
const showEditClassPopup = () => (isEditClassPopupVisible.value = true);
const hideEditClassPopup = () => (isEditClassPopupVisible.value = false);

const showAddGroupPopup = () =>
    selectedClassId.value && (isAddGroupPopupVisible.value = true);
const hideAddGroupPopup = () => (isAddGroupPopupVisible.value = false);
const showEditGroupPopup = () => (isEditGroupPopupVisible.value = true);
const hideEditGroupPopup = () => (isEditGroupPopupVisible.value = false);

const showAddSubgroupPopup = () =>
    selectedGroupId.value && (isAddSubgroupPopupVisible.value = true);
const hideAddSubgroupPopup = () => (isAddSubgroupPopupVisible.value = false);
const showEditSubgroupPopup = () => (isEditSubgroupPopupVisible.value = true);
const hideEditSubgroupPopup = () => (isEditSubgroupPopupVisible.value = false);

const showErrorPopup = () => (isErrorPopupVisible.value = true);
const hideErrorPopup = () => (isErrorPopupVisible.value = false);

const handleClassSelect = (id: number) => {
    if (id === selectedClassId.value) {
        selectedClassId.value = undefined;
        selectedGroupId.value = undefined;
    } else {
        selectedClassId.value = id;
        selectedGroupId.value = undefined;
    }
};

const handleGroupSelect = (id: number) =>
    id === selectedGroupId.value
        ? (selectedGroupId.value = undefined)
        : (selectedGroupId.value = id);

const handleAddClass = async (classe: Class) => {
    hideAddClassPopup();
    classes.value = [...classes.value, classe];
};

const handleEditClass = async (id: number) => {
    classToEditId.value = id;
    showEditClassPopup();
};

const handleSaveEditedClass = async (classe: Class) => {
    hideEditClassPopup();
    classes.value = classes.value.map((c) =>
        c.id === classe.id ? { ...c, name: classe.name } : c
    );
};

const handleDeleteClass = async (classe: Class) => {
    hideEditClassPopup();
    classes.value = classes.value.filter((c) => c.id !== classe.id);
    if (selectedClassId.value === classe.id) {
        selectedClassId.value = undefined;
        selectedGroupId.value = undefined;
    }
};

const handleAddGroup = async (group: Group) => {
    hideAddGroupPopup();
    classes.value = classes.value.map((classe) => {
        if (classe.id === selectedClassId.value) {
            return {
                ...classe,
                groups: [...classe.groups, group],
            };
        }
        return classe;
    });
};

const handleEditGroup = async (id: number) => {
    groupToEditId.value = id;
    showEditGroupPopup();
};

const handleSaveEditedGroup = async (group: Group) => {
    hideEditGroupPopup();
    classes.value = classes.value.map((classe) => {
        if (classe.id === selectedClassId.value) {
            return {
                ...classe,
                groups: classe.groups.map((g) =>
                    g.id === group.id ? { ...g, name: group.name } : g
                ),
            };
        }
        return classe;
    });
};

const handleDeleteGroup = async (group: Group) => {
    hideEditGroupPopup();
    classes.value = classes.value.map((classe) => {
        if (classe.id === selectedClassId.value) {
            return {
                ...classe,
                groups: classe.groups.filter((g) => g.id !== group.id),
            };
        }
        return classe;
    });
    selectedGroupId.value === group.id && (selectedGroupId.value = undefined);
};

const handleAddSubgroup = async (subgroup: Subgroup) => {
    hideAddSubgroupPopup();
    classes.value = classes.value.map((classe) => {
        if (classe.id === selectedClassId.value) {
            return {
                ...classe,
                groups: classe.groups.map((group) =>
                    group.id === selectedGroupId.value
                        ? {
                              ...group,
                              subgroups: [...group.subgroups, subgroup],
                          }
                        : group
                ),
            };
        }
        return classe;
    });
};

const handleEditSubgroup = async (id: number) => {
    subgroupToEditId.value = id;
    showEditSubgroupPopup();
};

const handleSaveEditedSubgroup = async (subgroup: Subgroup) => {
    hideEditSubgroupPopup();
    classes.value = classes.value.map((classe) => {
        if (classe.id === selectedClassId.value) {
            return {
                ...classe,
                groups: classe.groups.map((group) =>
                    group.id === selectedGroupId.value
                        ? {
                              ...group,
                              subgroups: group.subgroups.map((s) =>
                                  s.id === subgroup.id
                                      ? {
                                            ...s,
                                            name: subgroup.name,
                                        }
                                      : s
                              ),
                          }
                        : group
                ),
            };
        }
        return classe;
    });
};

const handleDeleteSubgroup = async (subgroup: Subgroup) => {
    hideEditSubgroupPopup();
    classes.value = classes.value.map((classe) => {
        if (classe.id === selectedClassId.value) {
            return {
                ...classe,
                groups: classe.groups.map((group) =>
                    group.id === selectedGroupId.value
                        ? {
                              ...group,
                              subgroups: group.subgroups.filter(
                                  (s) => s.id !== subgroup.id
                              ),
                          }
                        : group
                ),
            };
        }
        return classe;
    });
};

const handleError = (error: string) => {
    errorMessage.value = error;
    showErrorPopup();
};
</script>

<template>
    <AdminLayout>
        <div class="flex gap-10 w-full h-full">
            <ClassListManager
                class="w-full h-full"
                :classes
                :selectedClassId
                @select="handleClassSelect"
            />
            <GroupListManager
                class="w-full h-full"
                :groups
                :selectedGroupId
                @select="handleGroupSelect"
            />
            <SubgroupListManager class="w-full h-full" />
        </div>
    </AdminLayout>
</template>
