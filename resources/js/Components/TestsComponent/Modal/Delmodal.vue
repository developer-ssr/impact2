<template>
    <div
        tabindex="-1"
        class="backdrop-grayscale bg-white/30 overflow-y-auto flex overflow-x-hidden fixed z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full round-lg"
    >
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div
                class="relative bg-white rounded-lg dark:bg-gray-700 shadow-lg shadow-black-500"
            >
                <button
                    type="button"
                    @click="close"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                >
                    <svg
                        class="w-3 h-3"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 14 14"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                        />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>

                <div class="p-4 md:p-5 text-center">
                    <slot name="header"> </slot>

                    <slot name="body"> </slot>

                    <slot name="footer"> </slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, defineEmits, defineExpose } from "vue";

const emits = defineEmits(["close"]);

const close = () => {
    emits("close");
};

defineExpose({
    close: () => {
        close();
    },
});
</script>
