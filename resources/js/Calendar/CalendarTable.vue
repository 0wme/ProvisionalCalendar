<script setup lang="ts">
import Data from "./data.json";
import CalendarLeftSidebar from "./CalendarLeftSidebar.vue";
import CalendarContent from "./CalendarContent.vue";
import CalendarRightSidebar from "./CalendarRightSidebar.vue";
import { computed } from "vue";

const weeksData = Data;

const biggestCM = computed(() => {
    let biggest = 0;
    weeksData.forEach((week) => {
        week.groups.forEach((promotion) => {
            let contentSize = 0;
            promotion.contents.forEach((content) => {
                contentSize += content.hours;
            });
            if (contentSize > biggest) {
                biggest = contentSize;
            }
        });
    });
    return biggest;
});

const biggestTD = computed(() => {
    let biggest = 0;
    weeksData.forEach((week) => {
        week.groups.forEach((promotion) => {
            promotion.groups.forEach((tdGroup) => {
                let contentSize = 0;
                tdGroup.contents.forEach((content) => {
                    contentSize += content.hours;
                });
                if (contentSize > biggest) {
                    biggest = contentSize;
                }
            });
        });
    });
    return biggest;
});

const biggestTP = computed(() => {
    let biggest = 0;
    weeksData.forEach((week) => {
        week.groups.forEach((promotion) => {
            promotion.groups.forEach((tdGroup) => {
                tdGroup.groups.forEach((tpGroup) => {
                    let contentSize = 0;
                    tpGroup.contents.forEach((content) => {
                        contentSize += content.hours;
                    });
                    if (contentSize > biggest) {
                        biggest = contentSize;
                    }
                });
            });
        });
    });
    return biggest;
});
</script>

<template>
    <div class="relative overflow-y-scroll scrollbar-visible">
        <CalendarLeftSidebar :weeks-data="weeksData" class="absolute" />
        <CalendarContent
            :weeks-data="weeksData"
            :biggestCM="biggestCM"
            :biggestTD="biggestTD"
            :biggestTP="biggestTP"
            class="absolute left-12 right-36"
        />
        <CalendarRightSidebar
            :weeks-data="weeksData"
            class="absolute right-0"
        />
    </div>
</template>

<style scoped>
.scrollbar-visible {
    scrollbar-gutter: stable;
}

.scrollbar-visible::-webkit-scrollbar {
    width: 15px;
    display: block;
}

.scrollbar-visible::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.scrollbar-visible::-webkit-scrollbar-thumb {
    background: #9ca3af;
    border-radius: 5px;
}

.scrollbar-visible::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
