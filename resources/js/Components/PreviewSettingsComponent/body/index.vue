<template>
    <Modal :show="showModal">
        <div class="h-[25vmin]">
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
        <div v-if="insCon" class="bg-white shadow-2xl border-gray-300">
            <div
                v-html="props.instruction"
                :style="{
                    width: props.image_grid.message.Hwidht,
                    'aspect-ratio': props.image_grid.message.image_ratio,
                }"
            ></div>
            <div
                class=" p-5 flex items-center justify-center"
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
            class="border-2 bg-white shadow-2xl border-gray-300"
        >
            <div
                v-for="(data, index) in props.image_grid"
                :key="index"
                id="selected_trial"
            >
                <img
                    v-if="targets"
                    class="testImg bg-white translate-x-[-50%] translate-y-[-50%] fixed top-[50%] left-[50%] z-100"
                    :src="data.imagesrc"
                    :style="{
                        'aspect-ratio': data.image_ratio,
                        width: data.Hwidht,
                    }"
                />

                <div
                    :style="{
                        // width: data.Hwidht,
                        width: data.Hwidht,
                        height: data.Hheight,
                        fontSize: '2vmin',
                        display: 'grid',
                        'aspect-ratio': `${data.image_ratio}`,
                        'grid-template-columns': `repeat(${data.column}, minmax(0, 1fr))`,
                    }"
                >
                    <div
                        class="cell relative flex items-center justify-center"
                        :class="{ active: cell.active }"
                        v-for="(cell, i) in data.cells"
                        :key="i"
                        @click="_methods.detectCell(cell)"
                    >
                        <div v-if="ladybug" class="active:bg-red-200">
                            <img
                                v-if="cell.ladybug"
                                id="selected_trial"
                                class="ladybug cells z-99"
                                :src="ladybugImg"
                                height="30"
                                width="30"
                            />
                        </div>
                        <!-- {{ cell.index }} -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { inject, ref, onMounted, defineEmits, reactive } from "vue";
import Modal from "@/Components/Modal.vue";
import ladybugImg from "@/Components/img/ladybug.png";

const $emits = defineEmits(["done"]);
const props = inject("status");
const showModal = ref(false);

// const shufCell = ref(null);
const testCon = ref(true);
const insCon = ref(false);
const devices = ref(null);
const browser = ref(null);
const OS = ref(null);
const MobileOS = ref(null);
const ladybug = ref(true);
const targets = ref(false);
const Tempcollections = ref([]);
const count = ref(1);
const ResultCollection = ref({});
const d = reactive({ rt: null, end: null });
const bgimageWidth = ref("100vmin");
const bgimageHeight = ref("50vmin");

const _methods = {
    startTest: () => {
        targets.value = true;
        ladybug.value = false;
        setTimeout(() => {
            _methods.filterActiveValues();
            targets.value = false;
            ladybug.value = true;
        }, 1000);

        insCon.value = false;
        testCon.value = true;
    },
    demoPart: (parts) => {
        let part;
        if (parts == 1) {
            part = "Practice Trial";
        } else if (parts == 2) {
            part = "Dummy Trial";
        } else if (parts == 3) {
            part = "Main Trial";
        }
        return part;
    },
    showMOd: () => {
        if (props.index != 1) {
            showModal.value = true;

            setTimeout(() => {
                showModal.value = false;
            }, 1000);
        } else {
            showModal.value = true;

            setTimeout(() => {
                showModal.value = false;
            }, 1000);
        }
    },
    detectCell: (cell) => {
        if (cell.ladybug == true) {
            targets.value = true;
            ladybug.value = false;

            setTimeout(() => {
                targets.value = false;
                ladybug.value = true;
                d.rt = performance.now();
            }, 1000);

            const selectedCellId = cell.cellid;
            cell.ladybug = false;

            _methods.filterActiveValues();
        } else {
            return false;
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

    // filterSelected: (obj) => {
    //     const d = new Date();

    //     Object.keys(props.image_grid.message.cells).forEach((cell) => {
    //         const Propscell = props.image_grid.message.cells;
    //         const selectedCellId = obj.cellid;

    //         if (Propscell[cell].cellid == selectedCellId) {
    //             ResultCollection.value = {
    //                 demoPart: props.index,
    //                 cellid: Propscell[cell].cellid,
    //                 devices: devices.value,
    //                 browser: browser.value,
    //                 OS: OS.value,
    //                 index: obj.index,
    //                 rt: d.getMilliseconds(),
    //                 MobileOS: MobileOS.value,
    //                 blocknumber: props.blocknumber,
    //                 methods: 1,
    //             };
    //         }
    //     });
    //     props.result.push(ResultCollection.value);
    // },

    shuffleActiveObject: (array) => {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * i + 1);
            [array[i], array[j]] = [array[j], array[i]];
        }

        return array;
    },

    filterActiveValues: () => {
        Object.keys(props.image_grid).forEach((qd) => {
            const q = props.image_grid;

            const activeCells = q[qd]["cells"].filter(
                (obj) => obj.active === true
            );
            // console.log(activeCells);
            if (activeCells.length === 0) {
                props.index += 1;

                const Propscelldata = props.image_grid.message.cells;
                const tempCollection = {};
                /*const Tempresult = Object.assign(
                    {},
                    Propscelldata,
                    tempCollection
                );*/
                const Tempresult = {};
                Object.assign(Tempresult, Propscelldata);

                // Object.keys(props.image_grid.message.cells).forEach((index) => {
                //     let cell = props.image_grid.message.cells;
                //     // console.log(cell[index].cellid);
                //     let newCellid = cell[index].cellid;
                //     console.log(props.result[newCellid]["cellid"]);
                //     if (props.result[newCellid]["cellid"]) {
                //         cell[index].active = true;
                //         cell[index].ladybug = false;
                //     } else {
                //         return false;
                //     }
                // });
                // console.log(props.result);
                console.log(Tempresult);
                Object.keys(props.result).forEach((cellid) => {
                    console.log(props.result[cellid]);
                    const newCellId = props.result[cellid].cellid;

                    if (props.result[cellid].demoPart >= 3) {
                        /*parseInt(newCellId) - 1;*/

                        let TempIndex =
                            props.image_grid.message.cells.findIndex((o) => {
                                return o.cellid == newCellId;
                            });

                        console.log(
                            "mainid" +
                                Tempresult[TempIndex].cellid +
                                "Resultid:" +
                                newCellId
                        );
                        Tempresult[TempIndex].active = true;
                        Tempresult[TempIndex].ladybug = false;
                    }
                });
                console.log(props.result);
                testCon.value = false;
                insCon.value = true;

                $emits("done", {
                    part: props.index, // Emitting part based on index
                    onStart: (event) => {
                        //console.log(event);
                    },
                });

                _methods.showMOd();
                return;
            }

            // Shuffle active cells to find the next one
            function shuffle(array) {
                for (let i = array.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [array[i], array[j]] = [array[j], array[i]];
                }
                return array;
            }

            const shuffledObjects = shuffle(activeCells);
            const randomObject =
                shuffledObjects[
                    Math.floor(Math.random() * shuffledObjects.length)
                ];
            d.end = performance.now();
            let reactiontime = d.end - d.rt;
            randomObject.ladybug = true;
            randomObject.active = false;

            ResultCollection.value = {
                demoPart: props.index,
                cellid: randomObject.cellid,
                devices: devices.value,
                browser: browser.value,
                OS: OS.value,
                index: randomObject.index,
                rt: reactiontime,
                MobileOS: MobileOS.value,
                blocknumber: props.blocknumber,
                methods: 1,
            };

            props.result.push(ResultCollection.value);
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

// onMounted(() => {
//     bgimageWidth.value = document.querySelector(".bgimage").offsetWidth + "px";
//     bgimageHeight.value =
//         document.querySelector(".bgimage").offsetHeight + "px";
// });

onMounted(() => {
    targets.value = true;
    ladybug.value = false;
    setTimeout(() => {
        _methods.filterActiveValues();
        targets.value = false;
        ladybug.value = true;
    }, 1000);

    MobileOS.value = _methods.getMobileOS();
    OS.value = _methods.getOS();
    browser.value = _methods.detectBrowser();

    if (_methods.detectDevice()) {
        devices.value = "Mobile Phone";
    } else {
        devices.value = "PC";
    }

    // _methods.detectCell(event);
});
</script>

<style>
.bgimage {
    aspect-ratio: var(--imageratio);
}
.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
