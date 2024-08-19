<script setup>
import { reactive, onMounted, ref, provide, inject, defineProps } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import MainDashboard from "@/Components/MainDashboardComponent/index.vue";
import templates_coponent from "@/Components/MainDashboardComponent/Templates/index.vue";
import demo_component from "@/Components/MainDashboardComponent/Selectdemo/index.vue";
import trial_component from "@/Components/MainDashboardComponent/Trial/index.vue";
import redirect_component from "@/Components/MainDashboardComponent/Redirect/index.vue";
import setupgrid_component from "@/Components/MainDashboardComponent/SetupGrid/index.vue";
import instructions_component from "@/Components/MainDashboardComponent/Instructions/index.vue";
import Sidebar2 from "@/Components/Sidebar2.vue";

const sidebarVisible = ref(false);
const activeElem = ref(false);
const insStatus = ref(false);
// const headerCount_Practice = ref(1);
// const headerCount_Dummy = ref(1);
// const headerCount_Main = ref(1);
// const demo = ref({});

const ImageCount = ref(1);

const Instructions = reactive({
    practiceTrial: {
        message: {
            id: 1,
            bgColor: "whitesmoke",
            Xaxis: "50%",
            Yaxis: "50%",
            content: "Practice Instruction",
            Hheight: "10",
            Hwidht: "50",
            textColor: "black",
            borderRadius: "10px",
            borderWidth: "5px",
            borderColor: "gray",
        },
    },
    DummyTrial: {
        message: {
            id: 2,
            bgColor: "whitesmoke",
            Xaxis: "50%",
            Yaxis: "50%",
            content: "Dummy Instruction",
            Hheight: "10",
            Hwidht: "50",
            textColor: "black",
            borderRadius: "10px",
            borderWidth: "5px",
            borderColor: "gray",
        },
    },

    MainTrial: {
        message: {
            id: 3,
            bgColor: "whitesmoke",
            Xaxis: "50%",
            Yaxis: "50%",
            content: "Main Instruction",
            Hheight: "10",
            Hwidht: "50",
            textColor: "black",
            borderRadius: "10px",
            borderWidth: "5px",
            borderColor: "gray",
        },
    },
});

const ins_visibility = ref(false);
provide("instruction_visible", ins_visibility);
provide("Instructions", Instructions);
</script>

<template>
    <AppLayout>
        <div>
            <MainDashboard
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
                <Sidebar2 v-show="sidebarVisible">
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
                </Sidebar2>
            </Transition>
        </div>
    </AppLayout>
</template>
