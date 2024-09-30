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
    showimageModal: () => {
        document
            .querySelector("#selected_trial")
            .dispatchEvent(new CustomEvent("show_image_modal"));
    },

    showblockModal: () => {
        document
            .querySelector("#selected_trial")
            .dispatchEvent(new CustomEvent("show_block_modal"));
    },
};
</script>
<template>
    <div class="bg-white h-[100%]">
        <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
            <div class="flex-shrink-0"></div>
            <div class="bg-gray-300">
                <h2 class="text-center p-2">Instructions Settings</h2>
            </div>
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
            <div class="bg-gray-300">
                <h2 class="text-center p-2">Images Settings</h2>
            </div>
            <li class="pb-3 sm:p-2">
                <button
                    @click="_methods.showimageModal"
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

        <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
            <div class="flex-shrink-0"></div>
            <div class="bg-gray-300">
                <h2 class="text-center p-2">Block Settings</h2>
            </div>
            <li class="pb-3 sm:p-2">
                <button
                    @click="_methods.showblockModal"
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    Add Block
                </button>
            </li>
        </ul>

        <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
            <div class="flex-shrink-0"></div>
            <div class="bg-gray-300">
                <h2 class="text-center p-2">Ladybug Settings</h2>
            </div>
            <li class="pb-3 sm:p-2">
                <button
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    Change Ladybug
                </button>
            </li>
        </ul>
    </div>
</template>
