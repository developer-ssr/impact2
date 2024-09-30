<template>
    <button class="bg-red-500 text-white p-5" @click="_methods.start">
        start
    </button>
    <button class="bg-blue-500 text-white p-5" @click="_methods.next">
        next
    </button>

    <div v-for="(data, index) in settings.grids" :key="index">
        {{ data }}
    </div>
</template>

<script setup>
import { defineProps, reactive, ref } from "vue";
const props = defineProps(["data"]);
const limit = ref(5);
const count = ref(0);
const Parts = ref(1);
const settings = reactive({
    instructions: null,
    grids: null,
    index: 1,
});

const practiceTrial = reactive({
    instructions: props.data.instructions.practiceTrial.message,
    grid: props.data.images.practiceTrial.message.cells,
});

const DummyTrial = reactive({
    instructions: props.data.instructions.DummyTrial.message,
    grid: props.data.images.DummyTrial.message.cells,
});

const MainTrial = reactive({
    instructions: props.data.instructions.MainTrial.message,
    grid: props.data.images.MainTrial.message.cells,
});

const _methods = {
    setup: () => {
        if (Parts.value == 1) {
            console.log("practice Trial");
            settings.grids = practiceTrial.grid;
            settings.instructions = practiceTrial.instructions;
        } else if (Parts.value == 2) {
            console.log("dummy Trial");
            settings.grids = DummyTrial.grid;
            settings.instructions = DummyTrial.instructions;
        } else {
            console.log("checking Trial");
            _methods.Blockchecker();
        }
    },
    mainTrialBlock: () => {
        console.log("main Trial" + count.value);
        settings.grids = MainTrial.grid;
        settings.instructions = MainTrial.instructions;
    },
    Blockchecker: () => {
        if (limit.value > count.value) {
            count.value++;
            _methods.mainTrialBlock();
        } else {
            console.log("jump to explicit part");
            return;
        }
    },

    start: () => {
        _methods.setup();
    },

    next: () => {
        Parts.value++;
        _methods.setup();
    },
};
</script>
