<script setup lang="ts">
import {ref} from 'vue';
import CalendarCell from '@/Components/CalendarCell.vue';

const weeks = Array.from({length: 15}, (_, i) => i + 1);

const testData = ref([
    {
        week: 1,
        promotion: {
            cm: [
                {
                    hours: 1,
                    teacherName: 'John Doe',
                },
                {
                    hours: 2,
                    teacherName: 'Jane Doe',
                },
            ]
        },
        groups: [
            {
                td: [
                    {
                        hours: 1,
                        teacherName: 'John Doe',
                    },
                    {
                        hours: 2,
                        teacherName: 'Jane',
                    },
                ],
                subgroups: [
                    {
                        tp: [
                            {
                                hours: 1,
                                teacherName: 'John Doe',
                            },
                            {
                                hours: 1,
                                teacherName: 'Jane',
                            },
                        ],
                    },
                ],
            },
            {
                td: [
                    {
                        hours: 3,
                        teacherName: 'Jack Doe',
                    },
                    {
                        hours: 2,
                        teacherName: 'Jane',
                    },
                ],
                subgroups: [
                    {
                        tp: [
                            {
                                hours: 1,
                                teacherName: 'John Doe',
                            },
                            {
                                hours: 1,
                                teacherName: 'Jane',
                            },
                        ],
                    },
                    {
                        tp: [
                            {
                                hours: 1,
                                teacherName: 'John Doe',
                            },
                            {
                                hours: 1,
                                teacherName: 'Jane',
                            },
                        ],
                    },
                ],
            },
        ],
    },
    {
        week: 2,
        promotion: {
            cm: [
                {
                    hours: 1,
                    teacherName: 'John Doe',
                },
                {
                    hours: 2,
                    teacherName: 'Jane Doe',
                },
            ]
        },
        groups: [
            {
                td: [
                    {
                        hours: 1,
                        teacherName: 'John Doe',
                    },
                    {
                        hours: 2,
                        teacherName: 'Jane',
                    },
                ],
                subgroups: [
                    {
                        tp: [
                            {
                                hours: 1,
                                teacherName: 'John Doe',
                            },
                            {
                                hours: 1,
                                teacherName: 'Jane',
                            },
                        ],
                    },
                ],
            },
            {
                td: [
                    {
                        hours: 3,
                        teacherName: 'Jack Doe',
                    },
                    {
                        hours: 2,
                        teacherName: 'Jane',
                    },
                ],
                subgroups: [
                    {
                        tp: [
                            {
                                hours: 1,
                                teacherName: 'John Doe',
                            },
                            {
                                hours: 1,
                                teacherName: 'Jane',
                            },
                        ],
                    },
                    {
                        tp: [
                            {
                                hours: 1,
                                teacherName: 'John Doe',
                            },
                            {
                                hours: 1,
                                teacherName: 'Jane',
                            },
                        ],
                    },
                ],
            },
        ],
    }
])
</script>

<template>
    <div class="tbody flex flex-col">
        <div class="border-2 border-r-gray-200 border-b-gray-200 rounded-l-lg flex items-center justify-center p-4">S{{ week.week }}</div>
        <div v-for="week in testData" :key="'week-' + week.week" class="flex">
            <CalendarCell :title="`${cm.hours}h - ${cm.teacherName}`" v-for="cm in week.promotion"
                           :key="'cm-' + cm.teacherName">
                <CalendarCell :title="`TD${td}`" v-for="td in 3" :key="'td-' + week + '-' + td">
                    <CalendarCell :title="`TP${tp}`" v-for="tp in 2" :key="'tp-' + week + '-' + tp"/>
                </CalendarCell>
            </CalendarCell>
        </div>
    </div>
</template>
