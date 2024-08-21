<style scoped>
font[size="1"] {
    font-size: 1vmin;
}
font[size="2"] {
    font-size: 2vmin;
}

font[size="3"] {
    font-size: 3vmin;
}
font[size="4"] {
    font-size: 4vmin;
}
font[size="5"] {
    font-size: 5vmin;
}
.editor_container {
    background-size: 40px 40px;
    background-image: linear-gradient(to right, grey 1px, transparent 1px),
        linear-gradient(to bottom, grey 1px, transparent 1px);
}
</style>
<template>
    <div class="bg-gray-100 relative h-full editor_container">
        <div
            id="selected_trial"
            class="fixed translate-x-[-50%] left-[50%] h-[5vmin] w-[20vmin] bg-yellow-500 text-center text-wrap inline-block align-middle rounded-b-lg"
        ></div>

        <select
            id="selected_Demo"
            class="float-right z-10 bg-gray-300 relative h-[4vmin] w-[20vmin]"
            v-model="demo.demoName"
            @change="_methods.displayDemo"
        >
            <option value="practiceTrial" selected="selected">
                Practice Trial
            </option>
            <option value="DummyTrial">Dummy Trial</option>
            <option value="MainTrial">Main Trial</option>
        </select>

        <Instructions_Component :demo="demo.demoName" v-if="vsIns" />
        <Warnings_Component :demo="demo.demoName" v-if="vsWarn" />
        <Header_Component :demo="demo.demoName" v-if="vsHead" />
        <Footer_Component :demo="demo.demoName" v-if="vsfooter" />
    </div>
</template>
<script setup>
import { onMounted, reactive, ref } from "vue";
import Instructions_Component from "@/Components/EngineComponent/Settings/instruction_settings.vue";
import Warnings_Component from "@/Components/EngineComponent/Settings/warning_settings.vue";
import Header_Component from "@/Components/EngineComponent/Settings/header_settings.vue";
import Footer_Component from "@/Components/EngineComponent/Settings/footer_settings.vue";

const vsIns = ref(true);
const vsWarn = ref(true);
const vsHead = ref(true);
const vsfooter = ref(true);
const demo = reactive({
    demoName: null,
});

const _methods = {
    displayDemo: () => {},
};
onMounted(() => {
    document
        .querySelector("#selected_trial")
        .addEventListener("hide_data", () => {
            vsIns.value = !vsIns.value;
        });

    document
        .querySelector("#selected_trial")
        .addEventListener("hide_warning", () => {
            vsWarn.value = !vsWarn.value;
        });

    document
        .querySelector("#selected_trial")
        .addEventListener("hide_footer", () => {
            vsfooter.value = !vsfooter.value;
        });

    document
        .querySelector("#selected_trial")
        .addEventListener("hide_header", () => {
            vsHead.value = !vsHead.value;
        });
});
</script>
<style scoped>
.draggable {
    width: 100px;
    height: 100px;
    background-color: lightblue;
    text-align: center;
    line-height: 100px;
    cursor: pointer;
    user-select: none;
}
</style>
