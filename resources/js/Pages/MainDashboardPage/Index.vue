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
import analysis_component from "@/Components/MainDashboardComponent/Analysis/index.vue";
import Sidebar2 from "@/Components/Sidebar2.vue";

const props = defineProps(["data", "test_result", "rt_values", "mainData"]);

const sidebarVisible = ref(false);
const activeElem = ref(false);
const insStatus = ref(false);
const mainCell = ref(props.data.images.MainTrial.message.cells);
const resultCell = ref({});

provide("Image_Settings", props.data.images);
provide("Warning_Settings", props.data.warnings);
provide("Header_Settings", props.data.headers);
provide("Footer_Settings", props.data.footers);
provide("Instructions", props.data.instructions);
provide("DemoId", props.data.id);
// provide("test_result", props.test_result);
// provide("rt_values", props.rt_values);

console.log(props.rt_values);
onMounted(() => {
    Object.keys(props.test_result).forEach((cell) => {
        let cellid = props.test_result[cell].cellid;
        let maincell = props.data.images.MainTrial.message.cells[cell].cellid;
        resultCell.value = props.data.images.MainTrial.message.cells[cell];
        // console.log(props.data.images.MainTrial.message.cells[cell]);
        let color;

        if (props.test_result[cell].total_rt == props.rt_values["median"]) {
            color = "blue";
        } else if (
            props.test_result[cell].total_rt <= props.rt_values["median"]
        ) {
            color = "red";
        } else if (
            props.test_result[cell].total_rt >= props.rt_values["median"]
        ) {
            color = "gray";
        }
        let analyse = [];
        //dre ko taman
        if (maincell == cellid) {
            let resultdata = {
                index: props.data.images.MainTrial.message.cells[cell].index,
                cellid: props.data.images.MainTrial.message.cells[cell].cellid,
                rt: props.test_result[cell].total_rt,
                color: color,
            };
            analyse.push(resultdata);
        }
        console.log(analyse);

        // console.log(props.test_result);
    });

    // Object.keys(props.data.images.MainTrial.message.cells).forEach((cell) => {
    //     mainCell.value = props.data.images.MainTrial.message.cells[cell];
    //     resultCell.value = props.test_result;
    //     // console.log(resultCell.value);
    //     //console.log(props.data.images.MainTrial.message.cells[cell]);
    // });
});
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
                    <analysis_component v-if="activeElem === 'analysis'">
                    </analysis_component>
                </Sidebar2>
            </Transition>
        </div>
    </AppLayout>
</template>
