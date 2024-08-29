<style>
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
</style>
<template>
    <header_settings />
    <!-- <body_settings v-if="boxCon" /> -->
    <body_settings v-if="boxCon" />
    <!-- <instructionBox v-if="insCon" /> -->

    <div
        v-if="countVisible"
        class="bg-blue-900 rounded-full h-[20vmin] w-[20vmin] fixed translate-x-[-50%] translate-y-[-50%] z-50 top-[50%] left-[50%]"
    >
        <div
            class="bg-blue-600 rounded-full h-[18vmin] w-[18vmin] fixed translate-x-[-50%] translate-y-[-50%] z-50 top-[50%] left-[50%] shadow-lg"
        >
            <div
                class="text-center align-middle p-[6.5vmin] font-semibold text-[3vmin] text-white"
            >
                {{ countdown }}
            </div>
        </div>
    </div>

    <div
        v-if="insCon"
        class="bodyBoxCon fixed z-20 translate-x-[-50%] translate-y-[-50%] left-[50%] top-[50%]"
    >
        <div
            class="bg-white h-[50vmin] w-[100vmin] shadow-lg p-5"
            v-html="instruction"
        ></div>
        <div
            class="bg-white h-[10vmin] w-[100vmin] shadow-lg p-5 flex items-center justify-center"
        >
            <button
                @click="_flow.start"
                class="bg-orange-500 p-4 rounded-lg w-40 text-white text-[2vmin]"
            >
                Start
            </button>
        </div>
    </div>
</template>

<script setup>
import { defineProps, onMounted, ref, provide } from "vue";
import header_settings from "@/Components/PreviewSettingsComponent/header/index.vue";
import body_settings from "@/Components/PreviewSettingsComponent/body/index.vue";
import countdownComponent from "@/Components/PreviewSettingsComponent/others/countdown.vue";
import instructionBox from "@/Components/PreviewSettingsComponent/others/instruction_box.vue";

const props = defineProps(["data"]);
const countVisible = ref(false);
const boxCon = ref(false);
const insCon = ref(true);
const countdown = ref(3);
const instruction = ref(props.data.instructions.practiceTrial.message.content);

// provide("instructions", props.data.instructions);
provide("image_grid", props.data.images);
const _flow = {
    start: () => {
        countVisible.value = true;
        insCon.value = false;
        setInterval(() => {
            if (countdown.value > 1) {
                countdown.value--;
                //console.log(countdown.value);
            } else {
                countVisible.value = false;
                boxCon.value = true;
            }
        }, 1000);
    },
};
onMounted(() => {});
</script>
