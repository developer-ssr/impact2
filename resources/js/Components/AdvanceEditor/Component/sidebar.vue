<script setup>
import { ref, defineEmits, inject, onMounted } from "vue";
import Panel from "@/Components/Editor/panel.vue";
import imgEditor from "@/Components/AdvanceEditor/Component/instructionComponent/imagesEditor.vue";

const test = inject("test");
const practice_instruction =
    test.value.settings.instruction.practice_instruction;
const main_instruction = test.value.settings.instruction.main_instruction;

const dataCollections = ref({});

const insMenu = ref(false);
const data = ref({});
const targetVisible = ref(false);

const panelVisible = ref(false);

const $Emits = defineEmits([
    "update:gridState",
    "update:gridcell",
    "load:demoPart",
]);

const _methods = {
    addTarget: () => {
        targetVisible.value = !targetVisible.value;
    },
    btSettings: () => {
        insMenu.value = !insMenu.value;
        targetVisible.value = false;
    },
    toggleGridState: () => {
        $Emits("update:gridState");
    },
    practice: () => {
        data.value = practice_instruction;
        Object.assign(data.value, {
            DemoPart: "practice",
        });

        $Emits("load:demoPart", data.value["DemoPart"]);
        $Emits("update:gridcell", practice_instruction);
        targetVisible.value = false;
    },
    main: () => {
        data.value = main_instruction;
        Object.assign(data.value, {
            DemoPart: "main",
        });

        $Emits("load:demoPart", data.value["DemoPart"]);
        $Emits("update:gridcell", main_instruction);
        targetVisible.value = false;
    },

    PanelStatus: (obj) => {
        let collections = {};

        panelVisible.value = !panelVisible.value;

        Object.keys(obj).forEach((ObjKeys) => {
            collections[ObjKeys] = data.value[ObjKeys];
        });

        dataCollections.value = collections;

        if (data.value["DemoPart"] == "main") {
            Object.assign(dataCollections.value, { DemoPart: "main" });
        } else if (data.value["DemoPart"] == "practice") {
            Object.assign(dataCollections.value, { DemoPart: "practice" });
        }
        targetVisible.value = false;
    },
};
</script>

<template>
    <Teleport to="body">
        <!-- drawer component -->
        <div
            id="drawer-navigation"
            class="fixed top-0 left-0 z-40 w-64 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white dark:bg-gray-800"
            tabindex="-1"
            aria-labelledby="drawer-navigation-label"
        >
            <h5
                id="drawer-navigation-label"
                class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400"
            >
                Menu
            </h5>
            <button
                type="button"
                data-drawer-hide="drawer-navigation"
                aria-controls="drawer-navigation"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 end-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
            >
                <svg
                    aria-hidden="true"
                    class="w-5 h-5"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    ></path>
                </svg>
                <span class="sr-only">Close menu</span>
            </button>
            <div class="py-4 overflow-y-auto">
                <ul class="space-y-2 font-medium">
                    <li>
                        <button
                            id="dropdownDefaultButton"
                            data-dropdown-toggle="dropdown"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button"
                        >
                            Select Demo
                            <svg
                                class="w-2.5 h-2.5 ms-3"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 10 6"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m1 1 4 4 4-4"
                                />
                            </svg>
                        </button>

                        <div
                            id="dropdown"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700"
                        >
                            <ul
                                class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownDefaultButton"
                            >
                                <li>
                                    <button
                                        @click="_methods.practice"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                    >
                                        Practice Instruction
                                    </button>
                                </li>
                                <li>
                                    <button
                                        @click="_methods.main"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                    >
                                        Main Instruction
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a
                            @click="_methods.addTarget"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                        >
                            <span class="ms-3">Targets</span>
                        </a>
                    </li>

                    <li>
                        <a
                            href="#"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                        >
                            <span class="ms-3">Trials</span>
                        </a>
                    </li>

                    <li>
                        <a
                            href="#"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                        >
                            <span class="ms-3">Explicit Attention</span>
                        </a>
                    </li>

                    <li>
                        <a
                            href="#"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                        >
                            <span class="ms-3">Redirects</span>
                        </a>
                    </li>

                    <li>
                        <a
                            href="#"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                        >
                            <span class="ms-3"
                                ><button @click="_methods.toggleGridState()">
                                    Setup Grid
                                </button></span
                            >
                        </a>
                    </li>

                    <li>
                        <a
                            href="#"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                        >
                            <span class="ms-3">Analysis</span>
                        </a>
                    </li>
                    <hr
                        class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700"
                    />
                    <li>
                        <a
                            @click="_methods.btSettings"
                            href="#"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                        >
                            <span class="ms-3"> Instructions</span>
                        </a>

                        <div class="ins-container" v-if="insMenu">
                            <button
                                class="Ins-menu"
                                @click="
                                    _methods.PanelStatus({
                                        title: 'title',
                                        message: 'message',
                                        button: 'button',
                                        style: 'style',
                                    })
                                "
                            >
                                Message
                            </button>
                            <button
                                class="Ins-menu"
                                @click="
                                    _methods.PanelStatus({
                                        warnings: 'warnings',
                                        button: 'button',
                                        style: 'style',
                                    })
                                "
                            >
                                Warnings
                            </button>
                            <button
                                class="Ins-menu"
                                @click="
                                    _methods.PanelStatus({
                                        saving: 'saving',
                                        button: 'button',
                                        style: 'style',
                                    })
                                "
                            >
                                Savings
                            </button>
                            <button
                                class="Ins-menu"
                                @click="
                                    _methods.PanelStatus({
                                        savingFail: 'savingFail',
                                        button: 'button',
                                        style: 'style',
                                    })
                                "
                            >
                                Saving Fail
                            </button>
                            <button
                                class="Ins-menu"
                                @click="
                                    _methods.PanelStatus({
                                        loading: 'loading',
                                        button: 'button',
                                        style: 'style',
                                    })
                                "
                            >
                                Loading
                            </button>
                            <button
                                class="Ins-menu"
                                @click="
                                    _methods.PanelStatus({
                                        redirect: 'redirect',
                                        button: 'button',
                                        style: 'style',
                                    })
                                "
                            >
                                Redirect
                            </button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <Panel v-if="panelVisible" :data="dataCollections" />
        <imgEditor v-if="targetVisible" :data="data" />
    </Teleport>
</template>
<style scoped>
.ins-container {
    background-color: #d5d5d5;
    padding: 1vmin;
    border-radius: 2px;
}
.Ins-menu {
    margin: 1vmin;
    display: flex;
}

.Ins-menu:hover {
    background-color: dimgrey;
    color: white;
    padding: 0.5vmin;
    border-radius: 5px;
}
</style>
