<template>
    <div
        class="drag fixed border-4 border-yellow-500 grid-flow-row grid-cols-3-dense grid-rows-3 rounded-lg z-10 translate-x-[-50%] translate-y-[-50%] left-[50%] top-[70%]"
    >
        <div class="bg-gray-100 w-full pointer-events-none z-0 text-right p-2">
            Drag
        </div>

        <div class="bg-gray-300 h-auto w-auto grid grid-cols-4">
            <label class="block col-span-2">
                Height
                <input
                    class="block"
                    type="range"
                    v-model="divEditor_Data.height"
                    @change="_methods.updateHeight"
                />
            </label>

            <label class="block col-span-2">
                Width
                <input
                    class="block"
                    type="range"
                    v-model="divEditor_Data.width"
                    @change="_methods.updateWidth"
                />
            </label>
            <label class="block col-span-2">
                Border Radius
                <input
                    class="block"
                    type="range"
                    v-model="divEditor_Data.borderRadius"
                    @change="_methods.updateBorderSize"
                />
            </label>
            <label class="block col-span-2">
                Border Width
                <input
                    class="block"
                    type="range"
                    v-model="divEditor_Data.BorderWidth"
                    @change="_methods.updateBorderWidth"
                />
            </label>
            <label class="block col-span-2">
                Border Color

                <input
                    class="block"
                    type="color"
                    v-model="divEditor_Data.borderColor"
                    @change="_methods.updateBorderBGColor"
                />
            </label>
            <label class="block col-span-2">
                Background Color

                <input
                    class="block"
                    type="color"
                    v-model="divEditor_Data.bgColor"
                    @change="_methods.updateBgColor"
                />
            </label>

            <label class="block col-span-2">
                Font Color

                <input
                    class="block"
                    type="color"
                    v-model="divEditor_Data.textColor"
                    @change="_methods.UpdateFontColor"
                />
            </label>

            <label class="block col-span-2">
                Highlight Color

                <input
                    class="block"
                    type="color"
                    v-model="divEditor_Data.highlightColor"
                    @change="_methods.updateHighLightColor"
                />
            </label>
        </div>
        <div class="grid grid-rows-1 grid-flow-col bg-gray-400 p-1">
            <button @click="_methods.increaseFont">
                <svg
                    class="w-6 h-6 text-gray-800 dark:text-white"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 12h14m-7 7V5"
                    />
                </svg>
            </button>
            <button @click="_methods.decreaseFont">
                <svg
                    class="w-6 h-6 text-gray-800 dark:text-white"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 12h14"
                    />
                </svg>
            </button>
            <button
                onclick="
                    document.execCommand(
                        'bold',
                        false,
                        window.getSelection(toString())
                    )
                "
            >
                <svg
                    class="w-6 h-6 text-gray-800 dark:text-white"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M8 5h4.5a3.5 3.5 0 1 1 0 7H8m0-7v7m0-7H6m2 7h6.5a3.5 3.5 0 1 1 0 7H8m0-7v7m0 0H6"
                    />
                </svg>
            </button>
            <button
                onclick="
                    document.execCommand(
                        'italic',
                        false,
                        window.getSelection(toString())
                    )
                "
            >
                <svg
                    class="w-6 h-6 text-gray-800 dark:text-white"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m8.874 19 6.143-14M6 19h6.33m-.66-14H18"
                    />
                </svg>
            </button>
            <button
                onclick="
                    document.execCommand(
                        'underline',
                        false,
                        window.getSelection(toString())
                    )
                "
            >
                <svg
                    class="w-6 h-6 text-gray-800 dark:text-white"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-width="2"
                        d="M6 19h12M8 5v9a4 4 0 0 0 8 0V5M6 5h4m4 0h4"
                    />
                </svg>
            </button>
            <button
                onclick="
                    document.execCommand(
                        'justifyCenter',
                        false,
                        window.getSelection(toString())
                    )
                "
            >
                <svg
                    class="w-6 h-6 text-gray-800 dark:text-white"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M8 6h8M6 10h12M8 14h8M6 18h12"
                    />
                </svg>
            </button>
            <button
                onclick="
                    document.execCommand(
                        'justifyLeft',
                        false,
                        window.getSelection(toString())
                    )
                "
            >
                <svg
                    class="w-6 h-6 text-gray-800 dark:text-white"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-width="2"
                        d="M5 7h14M5 12h14M5 17h10"
                    />
                </svg>
            </button>
            <button
                onclick="
                    document.execCommand(
                        'justifyRight',
                        false,
                        window.getSelection(toString())
                    )
                "
            >
                <svg
                    class="w-6 h-6 text-gray-800 dark:text-white"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-width="2"
                        d="M5 7h14M5 12h14M5 17h14"
                    />
                </svg>
            </button>
        </div>
    </div>
</template>

<script setup>
import { inject, onMounted, reactive, ref, defineEmits } from "vue";
import { useForm } from "@inertiajs/vue3";
const $emits = defineEmits([
    "update:Height",
    "update:Width",
    "update:br",
    "update:brWidth",
    "update:brColor",
    "update:bgColor",
]);
const counter = ref(0);
const divEditor_Data = useForm({
    id: null,
    postX: null,
    postY: null,
    height: null,
    width: null,
    bgColor: null,
    content: null,
    borderRadius: null,
    BorderWidth: null,
    borderColor: null,
    textColor: null,
    highlightColor: null,
    blockTitle: null,
    Xaxis: null,
    Yaxis: null,
});
const _methods = {
    increaseFont: () => {
        document.execCommand("fontsize", false, counter.value++);
    },
    decreaseFont: () => {
        document.execCommand("fontsize", false, counter.value--);
    },
    updateHeight: () => {
        $emits("update:Height", divEditor_Data.height);
        //console.log(divEditor_Data.height);
    },
    updateWidth: () => {
        $emits("update:Width", divEditor_Data.width);
    },
    updateBorderSize: () => {
        $emits("update:br", divEditor_Data.borderRadius);
    },
    updateBorderWidth: () => {
        $emits("update:brWidth", divEditor_Data.BorderWidth);
    },
    updateBorderBGColor: () => {
        $emits("update:brColor", divEditor_Data.borderColor);
    },
    updateBgColor: () => {
        $emits("update:bgColor", divEditor_Data.bgColor);
    },
    UpdateFontColor: () => {
        document.execCommand("foreColor", false, divEditor_Data.textColor);
    },
    updateHighLightColor: () => {
        document.execCommand(
            "hiliteColor",
            false,
            divEditor_Data.highlightColor
        );
    },
};
window.addEventListener("keydown", function (event) {
    if (event.key == "]") {
        document.execCommand("fontsize", false, counter.value++);
    } else if (event.key == "[") {
        document.execCommand("fontsize", false, counter.value--);
    }
    // console.log(counter.value++, event.key);
});
</script>

<style></style>
