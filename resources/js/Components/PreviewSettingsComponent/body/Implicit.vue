<template>
    <Modal :show="showModal">
        <div class="h-[50vmin]">
            <div
                class="translate-x-[-50%] translate-y-[-50%] relative top-[50%] left-[80%]"
            >
                {{ props.endmessage }}
            </div>
        </div>
    </Modal>
    <div
        class="bodyBoxCon fixed translate-x-[-50%] translate-y-[-50%] left-[50%] top-[50%] border-slate-800"
    >
        <div v-if="insCon">
            <div
                class="border-2 bg-white h-[50vmin] w-[100vmin] shadow-2xl border-gray-300"
                v-html="props.instruction"
            ></div>
            <div
                class="bg-white h-[10vmin] w-[100vmin] shadow-lg p-5 flex items-center justify-center"
            >
                <button
                    id="selected_trial"
                    @click="_methods.startTest"
                    class="bg-orange-500 p-4 rounded-lg w-40 text-white text-[2vmin]"
                >
                    Start
                </button>
            </div>
        </div>

        <div
            v-if="testCon"
            class="border-2 bg-white h-[50vmin] w-[100vmin] shadow-2xl border-gray-300"
        >
            <div
                v-for="(data, index) in props.image_grid"
                :key="index"
                id="selected_trial"
                :style="{ '--imageratio': data.image_ratio }"
            >
                <img
                    v-if="targets"
                    class="testImg bg-white translate-x-[-50%] translate-y-[-50%] fixed top-[50%] left-[50%] h-[50vmin] w-[100vmin] z-100"
                    :src="data.imagesrc"
                />

                <div
                    :style="{
                        width: data.Hwidht,
                        height: data.Hheight,
                        fontSize: '2vmin',
                        display: 'grid',
                        'aspect-ratio': `${data.image_ratio}`,
                        'grid-template-columns': `repeat(${data.column}, minmax(0, 1fr))`,
                    }"
                    class="bgimage translate-x-[-50%] translate-y-[-50%] fixed top-[50%] left-[50%] z-10"
                >
                    <div
                        class="cell relative flex items-center justify-center"
                        :class="{ active: cell.active }"
                        v-for="(cell, i) in data.cells"
                        :key="i"
                    >
                        <div
                            v-if="ladybug"
                            class="active:bg-red-200 "
                            @click="_methods.detectCell(cell)"
                        >
                            <img
                                v-if="cell.show"
                                id="selected_trial"
                                class="ladybug cells z-10"
                                src="http://newimpact2.test/targets_images/ladybug.png"
                                height="30"
                                width="30"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { inject, ref, onMounted, defineEmits } from "vue";
import Modal from "@/Components/Modal.vue";
import { router } from "@inertiajs/vue3";
const $emits = defineEmits(["done"]);
const props = inject("status");

const showModal = ref(false);
const shufCell = ref(null);
const ResultCollection = ref({});
const testCon = ref(true);
const insCon = ref(false);
const devices = ref(null);
const browser = ref(null);
const OS = ref(null);
const MobileOS = ref(null);
const ladybug = ref(false);
const targets = ref(false);
const collections = ref([]);
const _methods = {
    startTest: () => {
        targets.value = true;
        ladybug.value = false;
        setTimeout(() => {
            targets.value = false;
            ladybug.value = true;
        }, 1000);

        insCon.value = false;
        testCon.value = true;
     
    },
  

    detectDevice: () => {
        const isMobile =
            /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                navigator.userAgent
            );
        const isSmallScreen = window.matchMedia("(max-width: 760px)").matches;
        return isMobile || isSmallScreen;
    },

   
   
  
    detectBrowser: () => {
        const userAgent = navigator.userAgent;

        if (userAgent.indexOf("Chrome") > -1) {
            return "Google Chrome";
        } else if (userAgent.indexOf("Edg") > -1) {
            return "Microsoft Edge";
        } else if (userAgent.indexOf("Firefox") > -1) {
            return "Mozilla Firefox";
        } else if (userAgent.indexOf("Safari") > -1) {
            return "Apple Safari";
        } else if (
            userAgent.indexOf("MSIE") > -1 ||
            userAgent.indexOf("Trident") > -1
        ) {
            return "Internet Explorer";
        } else if (
            userAgent.indexOf("Opera") > -1 ||
            userAgent.indexOf("OPR") > -1
        ) {
            return "Opera";
        } else {
            return "Other";
        }
    },
    getOS: () => {
        var OSName = "Unknown OS";
        if (navigator.appVersion.indexOf("Win") != -1) OSName = "Windows";
        if (navigator.appVersion.indexOf("Linux") != -1) OSName = "Linux";
        if (navigator.appVersion.indexOf("iPhone") != -1) OSName = "iPhone";
        if (navigator.appVersion.indexOf("iPad") != -1) OSName = "iPad";
        if (navigator.appVersion.indexOf("Android") != -1) OSName = "Android";
        return OSName;
    },
    getMobileOS: () => {
        const userAgent = navigator.userAgent;

        if (/android/i.test(userAgent)) {
            return "Android";
        } else if (/iPhone|iPad|iPod/i.test(userAgent)) {
            return "iOS";
        } else if (/Windows Phone/i.test(userAgent)) {
            return "Windows Phone";
        } else if (/BlackBerry/i.test(userAgent)) {
            return "BlackBerry";
        } else if (/webOS/i.test(userAgent)) {
            return "webOS";
        } else {
            return "Unknown OS";
        }
    },
};


</script>
<style>

</style>
