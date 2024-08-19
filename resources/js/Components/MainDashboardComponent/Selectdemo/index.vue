<template>
    <div class="bg-white h-[100%]">
        <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
            <h4 class="bg-gray-300">Text Settings</h4>
            <li class="p-1">
                <button
                    @click="_methods.selectDemo('practiceTrial')"
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    Select Practice Trial
                </button>
                <button
                    @click="_methods.selectDemo('DummyTrial')"
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    Select Dummy Trial
                </button>

                <button
                    @click="_methods.selectDemo('MainTrial')"
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    Select Main Trial
                </button>
            </li>
        </ul>
    </div>
</template>
<script setup>
import { reactive, onMounted, ref, provide, inject, defineEmits } from "vue";
const $emits = defineEmits(["select:demo"]);

const _methods = {
    selectDemo: (obj) => {
        $emits("select:demo", obj);
    },
};
</script>
