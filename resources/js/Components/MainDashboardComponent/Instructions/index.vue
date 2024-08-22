<script setup>
const _methods = {
    hide_instruction: () => {
        document
            .querySelector("#selected_trial")
            .dispatchEvent(new CustomEvent("hide_data"));
    },
    hide_warning: () => {
        document
            .querySelector("#selected_trial")
            .dispatchEvent(new CustomEvent("hide_warning"));
    },
    hide_header: () => {
        document
            .querySelector("#selected_trial")
            .dispatchEvent(new CustomEvent("hide_header"));
    },
    hide_footer: () => {
        document
            .querySelector("#selected_trial")
            .dispatchEvent(new CustomEvent("hide_footer"));
    },
    showgridModal: () => {
        document
            .querySelector("#selected_trial")
            .dispatchEvent(new CustomEvent("show_grid_modal"));
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
                    @click="_methods.hide_header"
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    Header Settings
                </button>

                <button
                    @click="_methods.hide_footer"
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    Footer Settings
                </button>

                <button
                    @click="_methods.hide_instruction"
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    Instructions Settings
                </button>
                <button
                    @click="_methods.hide_warning"
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    Warnings Settings
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
                    Images Settings
                </button>
                <button
                    @click="_methods.showgridModal"
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    Setup Image Grid
                </button>
            </li>
        </ul>
    </div>
</template>
