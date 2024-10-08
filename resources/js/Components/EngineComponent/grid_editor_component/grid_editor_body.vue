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
.editor_container {
    background-size: 40px 40px;
    background-image: linear-gradient(to right, grey 1px, transparent 1px),
        linear-gradient(to bottom, grey 1px, transparent 1px);
}
</style>
<template>
    <Modal :show="vsBlock">
        <div class="h-[20vmin] container">
            <div class="bg-gray-500 h-[5vmin] text-white text-wrap">
                <button class="float-right m-2" @click="closeBlock">
                    Close
                </button>
                <h1 class="p-2">Block Settings</h1>
            </div>

            <div class="bg-gray-100 h-[50vmin]">
                <div class="m-[1vmin]">
                    <label>Block Number </label>
                    <select
                        @change="saveBlock"
                        class="rounded-lg w-[20vmin]"
                        v-model="blockSettings.blockNumber"
                    >
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                    </select>
                </div>
            </div>
        </div>
    </Modal>
    <div class="bg-gray-100 relative h-full editor_container">
        <div
            id="selected_trial"
            class="fixed translate-x-[-50%] left-[50%] h-[5vmin] w-[20vmin] bg-yellow-500 text-center text-wrap inline-block align-middle rounded-b-lg p-3 text-white"
        >
            <h1>
                {{ demo.blockTitle }}
            </h1>
        </div>

        <Instructions_Component :demo="demo.demoName" v-if="vsIns" />
        <!-- <Warnings_Component :demo="demo.demoName" v-if="vsWarn" />
        <Header_Component :demo="demo.demoName" v-if="vsHead" />
        <Footer_Component :demo="demo.demoName" v-if="vsfooter" /> -->
        <Images_Component :demo="demo.demoName" v-if="vsImg" />
        <Explicit_Component :demo="demo.demoName" v-if="vsExpl" />
    </div>
</template>
<script setup>
import { onMounted, reactive, ref, inject } from "vue";
import Modal from "@/Components/Modal.vue";
import Images_Component from "@/Components/EngineComponent/Settings/images_settings.vue";
import Instructions_Component from "@/Components/EngineComponent/Settings/instruction_settings.vue";
import Explicit_Component from "@/Components/EngineComponent/Settings/explicit_settings.vue";
// import Warnings_Component from "@/Components/EngineComponent/Settings/warning_settings.vue";
// import Header_Component from "@/Components/EngineComponent/Settings/header_settings.vue";
// import Footer_Component from "@/Components/EngineComponent/Settings/footer_settings.vue";
const props = inject("Alldata");
const vsIns = ref(false);
const vsBlock = ref(false);
const vsImg = ref(false);
const vsExpl = ref(false);
const vsWarn = ref(false);
const vsHead = ref(false);
const vsfooter = ref(false);
console.log(props);
const saveBlock = () => {
    props.images.MainTrial.message.blocknum = blockSettings.blockNumber;
    console.log(props.images.MainTrial.message);
};
const demo = reactive({
    demoName: null,
    blockTitle: null,
});
const blockSettings = reactive({
    blockNumber: props.images.MainTrial.message.blocknum,
});
const closeBlock = () => {
    vsBlock.value = false;
};

onMounted(() => {
   
    //console.log(props.instructions.MainTrial.message);
    document
        .querySelector("#selected_trial")
        .addEventListener("display_practiceTrial", () => {
            //vsIns.value = true;
            vsImg.value = true;
            vsExpl.value = false;

            demo.demoName = "practiceTrial";
            demo.blockTitle = "Practice Trial";
        });
    document
        .querySelector("#selected_trial")
        .addEventListener("display_DummyTrial", () => {
            vsImg.value = true;
            // vsIns.value = true;
            vsExpl.value = false;
            demo.demoName = "DummyTrial";
            demo.blockTitle = "Dummy Trial";
        });
    document
        .querySelector("#selected_trial")
        .addEventListener("display_MainTrial", () => {
            vsImg.value = true;
            //vsIns.value = true;
            vsExpl.value = false;
            demo.demoName = "MainTrial";
            demo.blockTitle = "Main Trial";
        });

    document
        .querySelector("#selected_trial")
        .addEventListener("display_explicit", () => {
            vsExpl.value = true;
            vsImg.value = false;
            //vsIns.value = true;

            demo.demoName = "ExplicitTrial";
            demo.blockTitle = "Explicit Trial";
        });

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

    document
        .querySelector("#selected_trial")
        .addEventListener("show_block_modal", () => {
            vsBlock.value = !vsBlock.value;
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
