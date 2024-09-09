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
            <button
                @click="_methods.preview"
                class="bg-green-600 p-2 text-white"
            >
                Preview
            </button>
        </div>
    </div>
</template>
<script setup>
import { inject, onMounted, ref, reactive } from "vue";
import { router } from "@inertiajs/vue3";
const Savenot = ref(false);
const props = reactive({
    id: inject("DemoId"),
    images: inject("Image_Settings"),
    warning: inject("Warning_Settings"),
    header: inject("Header_Settings"),
    footer: inject("Footer_Settings"),
    instructions: inject("Instructions"),
});

const _methods = {
    save: () => {
        router.post("/update_mainsettings", props);
        Savenot.value = true;
        setTimeout(() => {
            // console.log("saved");
            Savenot.value = false;
        }, 5000);
    },
    preview: () => {
        let url = window.location.href;
        let urlObj = new URL(url);
        let code = urlObj.searchParams.get("code");
        let baseURL = "   http://newimpact2.test/PreviewTest";

        let params = new URLSearchParams({ code: code });
        let fullURL = `${baseURL}?${params.toString()}`;
        console.log(fullURL);
        window.location.href = fullURL;
        //console.log(code);
    },
};
</script>
