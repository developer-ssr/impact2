<script setup>
import {
    defineProps,
    onMounted,
    ref,
    provide,
    reactive,
    onUnmounted,
} from "vue";

import Modal from "@/Components/Modal.vue";
import header_settings from "@/Components/PreviewSettingsComponent/header/index.vue";
import body_settings from "@/Components/PreviewSettingsComponent/body/index.vue";
import explicit_component from "@/Components/PreviewSettingsComponent/body/explicit.vue";
const props = defineProps(["data"]);
const countVisible = ref(false);
const boxCon = ref(false);
const insCon = ref(true);
const countdown = ref(3);
const limit = ref(props.data.images.MainTrial.message.blocknum);
const count = ref(1);
const explicitPart = ref(false);

// const explicitdata = reactive({
//     image_grid: props.data.images.ExplicitTrial,
//     instruction: props.data.instructions.ExplicitTrial.message,
//     block: "Explicit Trial",
//     endmessage: "Preparing for next part. Please wait",
// });
const objStat = reactive({
    index: 1,
    props: null,
    image_grid: props.data.images.practiceTrial,
    instruction: props.data.instructions.practiceTrial.message.content,
    result: [],
    block: "Practice Trial",
    endmessage: "Preparing for next part. Please wait",
    blocknumber: null,
    finalresult: {},
});

//console.log(props.data.images.MainTrial.message.blocknum);
const changeTrial = (obj) => {
    const Blockchecker = () => {
        // console.log(objStat.result);
        resetValues();
        mainTrialBlock();

        objStat.index = obj.part;
        objStat.image_grid;
        console.log(objStat.image_grid);
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
        // console.log(objStat.image_grid);
        // let result = objStat.result;

        // Object.keys(result).forEach((gridcell) => {
        //     let cellid = objStat.result[gridcell].cellid;
        //     let gridresult = objStat.image_grid.message.cells[cellid];
        //     gridresult.active = true;
        //     gridresult.ladybug = false;
        // });
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
// onMounted(() => {
//     // document
//     //     .querySelector("#selected_trial")
//     //     .addEventListener("manageDisplay", () => {});
// });
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
