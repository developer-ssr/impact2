<template>
    <div class="container">
        <div
            class="fixed translate-x-[-50%] translate-y-[-50%] left-[50%] top-[50%]"
            v-if="expliIns"
        >
            <div
                class="bg-white h-[50vmin] w-[100vmin] shadow-xl border-2 border-gray-200"
                v-html="props.instruction"
            ></div>

            <div class="p-5 flex items-center justify-center">
                <button
                    id="selected_trial"
                    @click="_methods.startTest()"
                    class="bg-orange-500 p-4 rounded-lg w-40 text-white text-[2vmin]"
                >
                    Start
                </button>
            </div>
        </div>
    </div>

    <div class="container mx-auto relative">
        <div v-if="expligrid">
            <div v-for="(data, index) in props.image_grid" :key="index">
                <img
                    @click="_methods.search"
                    class="testImg bg-white translate-x-[-50%] translate-y-[-50%] fixed top-[50%] left-[50%] z-100"
                    :src="data.imagesrc"
                    :style="{
                        'aspect-ratio': data.image_ratio,
                        width: data.Hwidht,
                    }"
                />

                <div
                    :style="{
                        width: data.Hwidht,

                        fontSize: '2vmin',
                        display: 'grid',
                        'aspect-ratio': `${data.image_ratio}`,
                        'grid-template-columns': `repeat(${data.column}, minmax(0, 1fr))`,
                    }"
                    class="fixed top-[50%] left-[50%] transform -translate-x-1/2 -translate-y-1/2"
                >
                    <div
                        v-for="(cell, i) in data.cells"
                        :key="i"
                        class="cell"
                        :class="{ active: cell.active }"
                        @click="
                            _methods.detectCell({
                                cellid: cell.cellid,
                                index: cell.index,
                                active: cell.active,
                            })
                        "
                    >
                        <div class="text-center">
                            <div v-if="cell.active">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <g
                                        id="SVGRepo_bgCarrier"
                                        stroke-width="0"
                                    ></g>
                                    <g
                                        id="SVGRepo_tracerCarrier"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    ></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M9.15316 5.40838C10.4198 3.13613 11.0531 2 12 2C12.9469 2 13.5802 3.13612 14.8468 5.40837L15.1745 5.99623C15.5345 6.64193 15.7144 6.96479 15.9951 7.17781C16.2757 7.39083 16.6251 7.4699 17.3241 7.62805L17.9605 7.77203C20.4201 8.32856 21.65 8.60682 21.9426 9.54773C22.2352 10.4886 21.3968 11.4691 19.7199 13.4299L19.2861 13.9372C18.8096 14.4944 18.5713 14.773 18.4641 15.1177C18.357 15.4624 18.393 15.8341 18.465 16.5776L18.5306 17.2544C18.7841 19.8706 18.9109 21.1787 18.1449 21.7602C17.3788 22.3417 16.2273 21.8115 13.9243 20.7512L13.3285 20.4768C12.6741 20.1755 12.3469 20.0248 12 20.0248C11.6531 20.0248 11.3259 20.1755 10.6715 20.4768L10.0757 20.7512C7.77268 21.8115 6.62118 22.3417 5.85515 21.7602C5.08912 21.1787 5.21588 19.8706 5.4694 17.2544L5.53498 16.5776C5.60703 15.8341 5.64305 15.4624 5.53586 15.1177C5.42868 14.773 5.19043 14.4944 4.71392 13.9372L4.2801 13.4299C2.60325 11.4691 1.76482 10.4886 2.05742 9.54773C2.35002 8.60682 3.57986 8.32856 6.03954 7.77203L6.67589 7.62805C7.37485 7.4699 7.72433 7.39083 8.00494 7.17781C8.28555 6.96479 8.46553 6.64194 8.82547 5.99623L9.15316 5.40838Z"
                                            fill="#fff700"
                                        ></path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { inject, defineEmits, onMounted, ref } from "vue";
import axios from "axios";
const $emits = defineEmits(["done"]);
const props = inject("status");
const expligrid = ref(false);
const expliIns = ref(true);
const ResultCollector = ref({});
const counter = ref(0);
const _methods = {
    startTest: () => {
        expliIns.value = false;
        expligrid.value = true;
    },

    detectCell: (obj) => {
        counter.value++;
        const d = new Date();
        if (!Array.isArray(props.result)) {
            props.result = [];
        }

        Object.keys(props.image_grid.message.cells).forEach((indexKeys) => {
            let cellid = props.image_grid.message.cells;

            if (obj.cellid == cellid[indexKeys].cellid) {
                cellid[indexKeys].active = !cellid[indexKeys].active;
                let collectionItem = {
                    demoPart: props.index,
                    cellid: cellid[indexKeys].cellid,
                    devices: _methods.detectDevice(),
                    browser: _methods.detectBrowser(),
                    OS: _methods.getOS(),
                    index: cellid[indexKeys].index,
                    rt: d.getMilliseconds(),
                    MobileOS: _methods.getMobileOS(),
                    blocknumber: props.blocknumber,
                    methods: 2,
                };
                props.result.push(collectionItem);
            }
        });
        console.log(counter.value);
        if (counter.value == 3) {
            let temp = {};

            // let finalresult = {
            //     id: null,
            //     test_code: null,
            //     participant_id: null,
            //     config: {
            //         device: _methods.detectDevice(),
            //         browser: _methods.detectBrowser(),
            //         OS: _methods.getOS(),
            //     },
            //     result_data: Object.assign(temp, props.result),
            // };

            //             {
            //     "id": 1,
            //     "test_code": "jkasd",
            //     "participant_id": "SLZC2YFHQ9",
            //     "config": {
            //         "device": "PC",
            //         "browser": "Google Chrome",
            //         "OS": "Windows"
            //     },
            //     "result_data": [
            //         {
            //             "trial": "Practice",
            //             "cell_id": [60, 47, 65],
            //             "index": ["(4, 2)", "(5, 9)", "(2, 8)"],
            //             "rt": [7867.0999, 1000.899, 1190.7999]
            //         },
            //         {
            //             "trial": "MainTrial",
            //             "data":
            //             [
            //                 {
            //                     "block": 1,
            //                     "cell_id": [60, 47, 65],
            //                     "index": ["(4, 2)", "(5, 9)", "(2, 8)"],
            //                     "rt": [7867.0999, 1000.899, 1190.7999]
            //                 },
            //                 {
            //                     "block": 2,
            //                     "cell_id": [60, 47, 65],
            //                     "index": ["(4, 2)", "(5, 9)", "(2, 8)"],
            //                     "rt": [7867.0999, 1000.899, 1190.7999]
            //                 }
            //             ]
            //         },
            //         {
            //             "trial": "Explicit",
            //             "cell_id": [60, 47, 65],
            //             "index": ["(4, 2)", "(5, 9)", "(2, 8)"],
            //             "rt": [7867.0999, 1000.899, 1190.7999]
            //         }
            //     ],
            //     "created_at": "2024-10-01 07:05:50",
            //     "updated_at": "2024-10-01 07:05:50"
            // }

            console.log(props.result.join([,]));

            // axios({
            //     headers: { "X-Requested-With": "XMLHttpRequest" },
            //     method: "post",
            //     url: "/recieve",
            //     data: { data: props.result },
            //     responseType: "json",
            // });
            // alert("save data");
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
