<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { ref, defineProps } from "vue";
import Sidebar3 from "@/Components/Sidebar3.vue";
import FoldersComponent from "@/Components/FoldersComponent/index.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import templates_coponent from "@/Components/FoldersComponent/Templates/index.vue";
import demo_component from "@/Components/FoldersComponent/Selectdemo/index.vue";
import trial_component from "@/Components/FoldersComponent/Trial/index.vue";
import redirect_component from "@/Components/FoldersComponent/Redirect/index.vue";
import setupgrid_component from "@/Components/FoldersComponent/SetupGrid/index.vue";
import instructions_component from "@/Components/FoldersComponent/Instructions/index.vue";
import analysis_component from "@/Components/FoldersComponent/Analysis/index.vue";

const sidebarVisible = ref(false);
const activeElem = ref(false);

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

console.log(props);
function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("!hidden");
    document.getElementById("docs-card")?.classList.add("!row-span-1");
    document.getElementById("docs-card-content")?.classList.add("!flex-row");
    document.getElementById("background")?.classList.add("!hidden");
}
</script>

<template>
    <AppLayout>
        <div>
            <FoldersComponent
                @show:menu="
                    (active) => {
                        if (!active) {
                            sidebarVisible = false;
                        } else {
                            sidebarVisible = true;
                        }
                        activeElem = active;
                    }
                "
            />

            <Transition name="sidebar">
                <Sidebar3 v-show="sidebarVisible">
                    <demo_component v-if="activeElem === 'demo'">
                    </demo_component>
                    <templates_coponent
                        v-if="activeElem === 'templates'"
                    ></templates_coponent>

                    <trial_component
                        v-if="activeElem === 'trial'"
                    ></trial_component>
                    <redirect_component
                        v-if="activeElem === 'redirect'"
                    ></redirect_component>

                    <setupgrid_component
                        v-if="activeElem === 'setupgrid'"
                    ></setupgrid_component>

                    <instructions_component
                        v-if="activeElem === 'instructions'"
                    ></instructions_component>
                    <analysis_component v-if="activeElem === 'analysis'">
                    </analysis_component>
                </Sidebar3>
            </Transition>
        </div>
    </AppLayout>
</template>
