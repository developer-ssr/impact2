<template>
    <div class="bg-white h-[100%]">
        <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
            <div class="flex-shrink-0"></div>
            <div class="bg-gray-300">
                <h2 class="text-center p-2">Select Trial</h2>
            </div>

            <div
                class="grid grid-rows-3 gap-1 grid-flow-col bg-blue-800 rounded-md shadow-xl relative m-1"
            >
                <label
                    class="row-span-3 bg-yellow-500 p-10 border-2 m-1 rounded-sm text-white text-center"
                    >Practice Trial</label
                >

                <button
                    @click="_methods.display_pratice"
                    class="bg-gray-200 hover:bg-yellow-300 hover:text-white rounded-md h-8 mt-1 mr-1"
                >
                    Select
                </button>

                <button
                    @click="_methods.display_pratice"
                    class="bg-gray-200 hover:bg-yellow-300 hover:text-white rounded-md h-8 mr-1"
                >
                    Enable
                </button>
            </div>

            <div
                class="grid grid-rows-3 gap-1 grid-flow-col bg-blue-800 rounded-md shadow-xl relative m-1"
            >
                <label
                    class="row-span-3 bg-yellow-500 p-10 border-2 m-1 rounded-sm text-white text-center"
                    >Dummy Trial</label
                >

                <button
                    @click="_methods.display_dummy"
                    class="bg-gray-200 hover:bg-yellow-300 hover:text-white rounded-md h-8 mt-1 mr-1"
                >
                    Select
                </button>

                <button
                    @click="_methods.display_dummy"
                    class="bg-gray-200 hover:bg-yellow-300 hover:text-white rounded-md h-8 mr-1"
                >
                    Enable
                </button>
            </div>

            <div
                class="grid grid-rows-3 gap-1 grid-flow-col bg-blue-800 rounded-md shadow-xl relative m-1"
            >
                <label
                    class="row-span-3 bg-yellow-500 p-10 border-2 m-1 rounded-sm text-white text-center"
                    >Main Trial</label
                >

                <button
                    @click="_methods.display_main"
                    class="bg-gray-200 hover:bg-yellow-300 hover:text-white rounded-md h-8 mt-1 mr-1"
                >
                    Select
                </button>

                <button
                    @click="_methods.display_main"
                    class="bg-gray-200 hover:bg-yellow-300 hover:text-white rounded-md h-8 mr-1"
                >
                    Enable
                </button>
            </div>

            <div
                class="grid grid-rows-3 gap-1 grid-flow-col bg-blue-800 rounded-md shadow-xl relative m-1"
            >
                <label
                    class="row-span-3 bg-yellow-500 p-10 border-2 m-1 rounded-sm text-white text-center"
                    >Explicit Trial</label
                >

                <button
                    @click="_methods.display_explicit"
                    class="bg-gray-200 hover:bg-yellow-300 hover:text-white rounded-md h-8 mt-1 mr-1"
                >
                    Select
                </button>

                <button
                    @click="_methods.display_explicit"
                    class="bg-gray-200 hover:bg-yellow-300 hover:text-white rounded-md h-8 mr-1"
                >
                    Enable
                </button>
            </div>
        </ul>
    </div>
</template>

<script setup>
import { onMounted } from "vue";
const _methods = {
    display_pratice: () => {
        document
            .querySelector("#selected_trial")
            .dispatchEvent(new CustomEvent("display_practiceTrial"));
    },
    display_dummy: () => {
        document
            .querySelector("#selected_trial")
            .dispatchEvent(new CustomEvent("display_DummyTrial"));
    },
    display_main: () => {
        document
            .querySelector("#selected_trial")
            .dispatchEvent(new CustomEvent("display_MainTrial"));
    },

    display_explicit: () => {
        document
            .querySelector("#selected_trial")
            .dispatchEvent(new CustomEvent("display_explicit"));
    },
};
</script>
