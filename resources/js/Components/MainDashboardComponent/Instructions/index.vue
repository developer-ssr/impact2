<script setup>
import { inject, onMounted, reactive, ref, defineEmits } from "vue";
const _methods = {
    hide_instruction: () => {
        document
            .querySelector("#selected_trial")
            .dispatchEvent(new CustomEvent("hide_data"));
    },
};
</script>
<template>
    <div class="bg-white h-[100%]">
        <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
            <div class="flex-shrink-0"></div>
            <h4 class="bg-gray-300">Instructions Settings</h4>
            <li class="pb-3 sm:p-2">
                <button
                    @click="_methods.hide_instruction"
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    Instructions Message
                </button>
                <button
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    Warning Message
                </button>
            </li>
        </ul>

        <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
            <div class="flex-shrink-0"></div>
            <h4 class="bg-gray-300">Images</h4>
            <li class="pb-3 sm:p-2">
                <button
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    Add Images
                </button>
                <button
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    Setup Image Grid
                </button>
            </li>
        </ul>
    </div>
</template>
