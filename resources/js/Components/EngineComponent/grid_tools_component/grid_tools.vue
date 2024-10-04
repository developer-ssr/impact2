<template>
    <div
        v-if="Savenot"
        id="toast-top-right"
        class="z-50 bg-blue-700 text-white fixed flex items-center w-full max-w-xs p-4 space-x-4 divide-x rtl:divide-x-reverse divide-gray-200 rounded-lg shadow top-5 right-5 dark:text-gray-400 dark:divide-gray-700 dark:bg-gray-800"
        role="alert"
    >
        <div class="text-sm font-normal">All settings has beed saved.</div>
    </div>

    <div class="relative bg-gray-400 grow-2 h-15 shadow-md z-1">
        <div class="float-end relative">
            <button
                class="bg-blue-600 p-2 text-white m-1"
                @click="_methods.save"
            >
                Save
            </button>
            <a
                :href="route('PreviewTest', { code: code })"
                class="bg-green-600 p-2 text-white"
            >
                Preview
            </a>
        </div>
    </div>
</template>
<script setup>
import { inject, onMounted, ref, defineProps } from "vue";
import { router, useForm } from "@inertiajs/vue3";
const Savenot = ref(false);

let url = window.location.href;
const urlObj = new URL(url);
const code = urlObj.searchParams.get("code");

// const form = useForm({
//     id: inject("DemoId"),
//     images: inject("Image_Settings"),
//     // warning: inject("Warning_Settings"),
//     // header: inject("Header_Settings"),
//     // footer: inject("Footer_Settings"),
//     instructions: inject("Instructions"),
// });

const form = useForm({
    id: null,
    images: null,
    instructions: null,
});

form.id = inject("DemoId");
form.images = inject("Image_Settings");
form.instructions = inject("Instructions");

const _methods = {
    save: () => {
        form.post("/update_Instruction_grid");
        Savenot.value = true;

        setTimeout(() => {
            // console.log("saved");
            Savenot.value = false;
        }, 5000);
    },
};
</script>
