<template>
    <div
        class="bodyBoxCon fixed z-20 translate-x-[-50%] translate-y-[-50%] left-[50%] top-[50%]"
    >
        <div class="border-2 bg-white h-[50vmin] w-[100vmin] shadow-lg">
            <div
                v-for="(data, index) in props.image_grid"
                :key="index"
                id="selected_trial"
            >
                <img
                    v-if="data.imagesrc"
                    class="bg-gray-500 translate-x-[-50%] translate-y-[-50%] fixed top-[50%] left-[50%] h-[50vmin] w-[100vmin]"
                    :src="data.imagesrc"
                />

                <div
                    :style="{
                        width: data.Hwidht,
                        height: data.Hheight,
                        fontSize: '2vmin',
                        display: 'grid',
                        'grid-template-columns': `repeat(${data.column}, minmax(0, 1fr))`,
                    }"
                    class="bgimage translate-x-[-50%] translate-y-[-50%] fixed top-[50%] left-[50%]"
                >
                    <div
                        class="cell relative flex items-center justify-center"
                        :class="{ active: cell.active }"
                        v-for="(cell, i) in data.cells"
                        :key="i"
                    >
                        <div
                            id="selected_trial"
                            @click="_methods.detectCell(cell)"
                            v-if="cell.show"
                            :attrIndex="cell.index"
                            class="ladybug active:bg-red-500 p-5 flex items-center justify-center cells"
                        >
                            <img
                                src="http://newimpact2.test/targets_images/ladybug.png"
                                height="30"
                                width="30"
                                class="ladybug"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { inject, ref, onMounted, watch, defineEmits } from "vue";
import { router } from "@inertiajs/vue3";
const $emits = defineEmits(["done"]);
const props = inject("status");
const showEndMsm = ref(false);
const SchedCollection = ref([]);
const shufCell = ref(null);
const ResultCollection = ref({});
// const settings = ref({});
const d = ref(null);
const collect = ref([]);
// const collection = ref([]);
const devices = ref(null);
const browser = ref(null);
const OS = ref(null);
const MobileOS = ref(null);
const _methods = {
    detectCell: async (cell) => {
        const allHaveShowProperty = shufCell.value.every((obj) =>
            obj.hasOwnProperty("show")
        );

        if (allHaveShowProperty) {
            showEndMsm.value = true;
            props.index += 1;
            $emits("done", {
                part: props.index,
                onStart: () => { 
                
                }
            });
            
                _methods.filterActiveValues();

              
        }

        const selectRandomRow = () => {
            const availableRows = shufCell.value.filter(
                (row) => !row.hasOwnProperty("show") && row.active === true
            );
            console.log(availableRows);
            if (availableRows.length == 0) {
                console.log("No available rows to select from.");
                return; // Exit the function if no available rows
            }

            const randomIndex = Math.floor(
                Math.random() * availableRows.length
            );
            const selectedRow = availableRows[randomIndex];

            selectedRow.show = true;

            const d = new Date();
            ResultCollection.value = {
                demoPart: "Practice Trial",
                devices: devices.value,
                browser: browser.value,
                OS: OS.value,
                index: selectedRow.index,
                rt: d.getMilliseconds(),
                MobileOS: MobileOS.value,
            };

            collect.value.push(ResultCollection.value);
        };

        selectRandomRow();
        if (cell) {
            _methods.filterSelected(cell);
        }
    },

    detectDevice: () => {
        const isMobile =
            /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                navigator.userAgent
            );
        const isSmallScreen = window.matchMedia("(max-width: 760px)").matches;
        return isMobile || isSmallScreen;
    },

    filterSelected: (sel) => {
        Object.keys(shufCell.value).forEach((cll) => {
            if (shufCell.value[cll].index == sel.index) {
                shufCell.value[cll].show = false;
            }
        });
    },
    shuffleActiveObject: (array) => {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    },
    filterActiveValues: () => {
        Object.keys(props.image_grid).forEach((qd) => {
            let q = props.image_grid;
            let activeCells = q[qd]["cells"].filter(
                (obj) => obj.active === true
            );
            shufCell.value = _methods.shuffleActiveObject(activeCells);
        });
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

onMounted(() => {
    console.log(props);
    MobileOS.value = _methods.getMobileOS();
    OS.value = _methods.getOS();
    browser.value = _methods.detectBrowser();
    if (_methods.detectDevice()) {
        devices.value = "Mobile Phone";
    } else {
        devices.value = "PC";
    }

    _methods.filterActiveValues();
    _methods.detectCell(event);
});
</script>
<style>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
