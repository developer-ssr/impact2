<template>
    <div class="bg-white h-[100%]">
        <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
            <div class="flex-shrink-0"></div>
            <div class="bg-gray-300">
                <h2 class="text-center p-2">Analysis Settings</h2>
            </div>
            <li class="pb-3 sm:p-2">
                <button
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    Create Filter
                </button>
                <button
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    Sync Filter
                </button>

                <button
                    id="selected_trial"
                    @click="_methods.showAnalysis"
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    View All Result
                </button>
                <button
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    <a :href="'export'"> All Reponses </a>
                </button>
                <button
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    Logo & Watermarks
                </button>
            </li>
        </ul>
    </div>
</template>
<script setup>
import { onMounted } from "vue";
const _methods = {
    showAnalysis: () => {
        document
            .querySelector("#selected_trial")
            .dispatchEvent(new CustomEvent("display_analysis"));
    },
};
</script>
