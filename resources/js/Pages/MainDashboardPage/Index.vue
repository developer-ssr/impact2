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

const props = defineProps(["data"]);
const sidebarVisible = ref(false);
const activeElem = ref(false);
const insStatus = ref(false);
// const headerCount_Practice = ref(1);
// const headerCount_Dummy = ref(1);
// const headerCount_Main = ref(1);
// const demo = ref({});

// const Image_Settings = reactive({
//     practiceTrial: {
//         message: {
//             id: 1,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "50%",
//             imagesrc: "Practice Header",
//             Hheight: "10",
//             Hwidht: "50",

//             borderRadius: "10px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },
//     DummyTrial: {
//         message: {
//             id: 2,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "50%",
//             imagesrc: "Dummy Header",
//             Hheight: "10",
//             Hwidht: "50",

//             borderRadius: "10px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },

//     MainTrial: {
//         message: {
//             id: 3,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "50%",
//             imagesrc: "Main Header",
//             Hheight: "10",
//             Hwidht: "50",

//             borderRadius: "10px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },
// });

// const Warning_Settings = reactive({
//     practiceTrial: {
//         message: {
//             id: 1,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "50%",
//             content: "Practice Header Warning",
//             Hheight: "10",
//             Hwidht: "50",
//             textColor: "black",
//             borderRadius: "10px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },
//     DummyTrial: {
//         message: {
//             id: 2,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "50%",
//             content: "Dummy Header Warning",
//             Hheight: "10",
//             Hwidht: "50",
//             textColor: "black",
//             borderRadius: "10px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },

//     MainTrial: {
//         message: {
//             id: 3,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "50%",
//             content: "Main Header Warning",
//             Hheight: "10",
//             Hwidht: "50",
//             textColor: "black",
//             borderRadius: "10px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },
// });
// const Footer_Settings = reactive({
//     practiceTrial: {
//         message: {
//             id: 1,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "92%",
//             content: "Practice Footer Text",
//             Hheight: "5vmin",
//             Hwidht: "60vmin",
//             textColor: "black",
//             borderRadius: "10px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },
//     DummyTrial: {
//         message: {
//             id: 2,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "92%",
//             content: "Dummy Footer Text",
//             Hheight: "5vmin",
//             Hwidht: "60vmin",
//             textColor: "black",
//             borderRadius: "10px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },

//     MainTrial: {
//         message: {
//             id: 3,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "92%",
//             content: "Main Footer Text",
//             Hheight: "5vmin",
//             Hwidht: "60vmin",
//             textColor: "black",
//             borderRadius: "10px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },
// });

// const Header_Settings = reactive({
//     practiceTrial: {
//         message: {
//             id: 1,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "25%",
//             content: "Practice Header",
//             Hheight: "12vmin",
//             Hwidht: "60vmin",
//             textColor: "black",
//             borderRadius: "0px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },
//     DummyTrial: {
//         message: {
//             id: 2,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "25%",
//             content: "Dummy Header",
//             Hheight: "12vmin",
//             Hwidht: "60vmin",
//             textColor: "black",
//             borderRadius: "10px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },

//     MainTrial: {
//         message: {
//             id: 3,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "25%",
//             content: "Main Header",
//             Hheight: "12vmin",
//             Hwidht: "60vmin",
//             textColor: "black",
//             borderRadius: "10px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },
// });

// const Instructions = reactive({
//     practiceTrial: {
//         message: {
//             id: 1,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "60%",
//             content: "Practice Instruction",
//             Hheight: "50vmin",
//             Hwidht: "50vmin",
//             textColor: "black",
//             borderRadius: "10px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },
//     DummyTrial: {
//         message: {
//             id: 2,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "60%",
//             content: "Dummy Instruction",
//             Hheight: "50vmin",
//             Hwidht: "50vmin",
//             textColor: "black",
//             borderRadius: "10px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },

//     MainTrial: {
//         message: {
//             id: 3,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "60%",
//             content: "Main Instruction",
//             Hheight: "50vmin",
//             Hwidht: "50vmin",
//             textColor: "black",
//             borderRadius: "10px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },
// });

provide("Image_Settings", props.data.images);
provide("Warning_Settings", props.data.warnings);
provide("Header_Settings", props.data.headers);
provide("Footer_Settings", props.data.footers);
provide("Instructions", props.data.instructions);
provide("DemoId", props.data.id);
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
                </Sidebar2>
            </Transition>
        </div>
    </AppLayout>
</template>
