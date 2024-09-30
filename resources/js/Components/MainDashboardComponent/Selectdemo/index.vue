<template>
    <div class="bg-white h-[100%]">
        <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
            <div class="flex-shrink-0"></div>
            <div class="bg-gray-300">
                <h2 class="text-center p-2">Select Trial</h2>
            </div>
            <li class="pb-3 sm:p-2">
                <button
                    @click="_methods.display_pratice"
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    Practice Trial
                </button>

                <button
                    @click="_methods.display_dummy"
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    Dummy Trial
                </button>

                <button
                    @click="_methods.display_main"
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    Main Trial
                </button>

                <button
                    @click="_methods.display_explicit"
                    class="bg-gray-200 w-full h-[5vmin] hover:bg-yellow-300 hover:text-white"
                >
                    Explicit Trial
                </button>
                
            </li>
        </ul>
    </div>
</template>

<script setup>
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
