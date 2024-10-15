<script setup>
import { defineProps, ref, provide, reactive, onUnmounted } from "vue";

import header_settings from "@/Components/PreviewSettingsComponent/header/index.vue";
import body_settings from "@/Components/PreviewSettingsComponent/body/index.vue";
import explicit_component from "@/Components/PreviewSettingsComponent/body/explicit.vue";
const props = defineProps(["data"]);
const countVisible = ref(false);
const boxCon = ref(false);
const insCon = ref(true);
const countdown = ref(3);
const limit = ref(props.data.images.MainTrial.message.blocknum);
const count = ref(0);
const explicitPart = ref(false);
const imagesgrid = ref(null);
const instruction = ref(null);
const indexPart = ref(null);

const block = ref(null);

let status = props.data.images.practiceTrial.message.status;
if (status == 1) {
    indexPart.value = 1;
    imagesgrid.value = props.data.images.practiceTrial;
    instruction.value = props.data.instructions.practiceTrial.message.content;
    block.value = props.data.instructions.practiceTrial.message.blockTitle;
} else {
    indexPart.value = 2;
    imagesgrid.value = props.data.images.DummyTrial;
    instruction.value = props.data.instructions.DummyTrial.message.content;
    block.value = props.data.instructions.DummyTrial.message.blockTitle;
}

const objStat = reactive({
    index: indexPart.value,
    props: null,
    image_grid: imagesgrid.value,
    instruction: instruction.value,
    result: [],
    block: block.value,
    endmessage: "Preparing for next part. Please wait",
    blocknumber: null,
    finalresult: {},
});

const changeTrial = (obj) => {
    const Blockchecker = () => {
        resetValues();
        mainTrialBlock();
        objStat.index = obj.part;
        if (limit.value > count.value) {
            count.value++;
        } else {
            resetValues();
            explicitPart.value = true;
            boxCon.value = false;
            objStat.block = "Explicit Trial";
            objStat.index = obj.part;
            objStat.instruction =
                props.data.instructions.ExplicitTrial.message.content;
            objStat.endmessage = "Preparing for last part. Please wait";
            objStat.image_grid = props.data.images.ExplicitTrial;
            console.log("Jump to explicit part");
            return;
        }
    };

    const resetValues = () => {
        objStat.index = null;
        objStat.endmessage = null;
        objStat.image_grid = null;
        objStat.instruction = null;
    };

    const mainTrialBlock = () => {
        objStat.blocknumber = count.value;
        objStat.index = obj.part;
        objStat.endmessage = "Preparing for last part. Please wait";
        objStat.image_grid = props.data.images.MainTrial;
        objStat.instruction = props.data.instructions.MainTrial.message.content;
        objStat.block = `Main Trial ${count.value} / ${limit.value}`;
    };

    if (obj.part == 2) {
        resetValues();
        objStat.index = obj.part;
        objStat.image_grid = props.data.images.DummyTrial;
        objStat.endmessage = "Preparing for next part. Please wait";
        objStat.instruction =
            props.data.instructions.DummyTrial.message.content;
        objStat.block = "Dummy Trial";
    } else {
        Blockchecker();
    }
};

provide("status", objStat);

const isRunning = ref(false);
let interval = null;

const _flow = {
    start: () => {
        countdown.value = 3;
        countVisible.value = true;
        insCon.value = false;
        isRunning.value = true;

        interval = setInterval(() => {
            if (countdown.value > 0) {
                countdown.value--;
            } else {
                _flow.stopTimer();
                countVisible.value = false;
                boxCon.value = true;
            }
        }, 1000);
    },

    stopTimer: () => {
        clearInterval(interval);
        isRunning.value = false;
        countdown.value = 3;
    },
};

onUnmounted(() => {
    clearInterval(interval);
});
</script>
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
    <header_settings :blockNum="objStat.index" />
    <explicit_component v-if="explicitPart" />
    <body_settings
        v-if="boxCon"
        @done="
            (res) => {
                changeTrial(res);
            }
        "
    />

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
        class="bodyBoxCon fixed z-20 translate-x-[-50%] translate-y-[-50%] left-[50%] top-[50%] shadow-2xl border-gray-400"
    >
        <div
            class="bg-white h-[50vmin] w-[100vmin] shadow-lg p-5"
            v-html="objStat.instruction"
        ></div>

        <div
            class="bg-white h-[10vmin] w-[100vmin] p-5 flex items-center justify-center"
        >
            <button
                id="selected_trial"
                @click="_flow.start"
                class="bg-orange-500 p-4 rounded-lg w-40 text-white text-[2vmin]"
            >
                Start
            </button>
        </div>
    </div>
</template>
