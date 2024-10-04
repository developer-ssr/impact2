<script setup>
import { router, useForm } from "@inertiajs/vue3";
import { reactive } from "vue";
import { provide, inject } from "vue";
const props = inject("props");
const Image_Settings = reactive({
    practiceTrial: {
        message: {
            id: 1,
            bgColor: "whitesmoke",
            Xaxis: "50%",
            Yaxis: "50%",
            imagesrc: null,
            Hheight: "10",
            Hwidht: "50",
            borderRadius: "10px",
            borderWidth: "5px",
            borderColor: "gray",
            image_ratio: null,
        },
    },
    DummyTrial: {
        message: {
            id: 2,
            bgColor: "whitesmoke",
            Xaxis: "50%",
            Yaxis: "50%",
            imagesrc: null,
            Hheight: "10",
            Hwidht: "50",

            borderRadius: "10px",
            borderWidth: "5px",
            borderColor: "gray",
            image_ratio: null,
        },
    },

    MainTrial: {
        message: {
            id: 3,
            bgColor: "whitesmoke",
            Xaxis: "50%",
            Yaxis: "50%",
            imagesrc: null,
            Hheight: "10",
            Hwidht: "50",
            borderRadius: "10px",
            borderWidth: "5px",
            borderColor: "gray",
            image_ratio: null,
            blocknum: null,
        },
    },
    ExplicitTrial: {
        message: {
            id: 4,
            bgColor: "whitesmoke",
            Xaxis: "50%",
            Yaxis: "50%",
            imagesrc: null,
            Hheight: "10",
            Hwidht: "50",
            borderRadius: "10px",
            borderWidth: "5px",
            borderColor: "gray",
            image_ratio: null,
        },
    },
});

// const Warning_Settings = reactive({
//     practiceTrial: {
//         message: {
//             id: 1,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "50%",
//             content: "Practice Header Warning",
//             Hheight: "10",
//             Hwidht: "50",
//             textColor: "black",
//             borderRadius: "10px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },
//     DummyTrial: {
//         message: {
//             id: 2,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "50%",
//             content: "Dummy Header Warning",
//             Hheight: "10",
//             Hwidht: "50",
//             textColor: "black",
//             borderRadius: "10px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },

//     MainTrial: {
//         message: {
//             id: 3,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "50%",
//             content: "Main Header Warning",
//             Hheight: "10",
//             Hwidht: "50",
//             textColor: "black",
//             borderRadius: "10px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },
// });
// const Footer_Settings = reactive({
//     practiceTrial: {
//         message: {
//             id: 1,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "92%",
//             content: "Practice Footer Text",
//             Hheight: "5vmin",
//             Hwidht: "60vmin",
//             textColor: "black",
//             borderRadius: "10px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },
//     DummyTrial: {
//         message: {
//             id: 2,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "92%",
//             content: "Dummy Footer Text",
//             Hheight: "5vmin",
//             Hwidht: "60vmin",
//             textColor: "black",
//             borderRadius: "10px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },

//     MainTrial: {
//         message: {
//             id: 3,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "92%",
//             content: "Main Footer Text",
//             Hheight: "5vmin",
//             Hwidht: "60vmin",
//             textColor: "black",
//             borderRadius: "10px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },
// });

// const Header_Settings = reactive({
//     practiceTrial: {
//         message: {
//             id: 1,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "25%",
//             content: "Practice Header",
//             Hheight: "12vmin",
//             Hwidht: "60vmin",
//             textColor: "black",
//             borderRadius: "0px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },
//     DummyTrial: {
//         message: {
//             id: 2,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "25%",
//             content: "Dummy Header",
//             Hheight: "12vmin",
//             Hwidht: "60vmin",
//             textColor: "black",
//             borderRadius: "10px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },

//     MainTrial: {
//         message: {
//             id: 3,
//             bgColor: "whitesmoke",
//             Xaxis: "50%",
//             Yaxis: "25%",
//             content: "Main Header",
//             Hheight: "12vmin",
//             Hwidht: "60vmin",
//             textColor: "black",
//             borderRadius: "10px",
//             borderWidth: "5px",
//             borderColor: "gray",
//         },
//     },
// });

const Instructions = reactive({
    practiceTrial: {
        message: {
            id: 1,
            bgColor: "whitesmoke",
            Xaxis: "50%",
            Yaxis: "60%",
            blockTitle: "Practice Trial",
            content: "Practice Instruction",
            Hheight: "50vmin",
            Hwidht: "50vmin",
            textColor: "black",
            borderRadius: "10px",
            borderWidth: "5px",
            borderColor: "gray",
        },
    },
    DummyTrial: {
        message: {
            id: 2,
            bgColor: "whitesmoke",
            Xaxis: "50%",
            Yaxis: "60%",
            blockTitle: "Dummy Trial",
            content: "Dummy Instruction",
            Hheight: "50vmin",
            Hwidht: "50vmin",
            textColor: "black",
            borderRadius: "10px",
            borderWidth: "5px",
            borderColor: "gray",
        },
    },

    MainTrial: {
        message: {
            id: 3,
            bgColor: "whitesmoke",
            Xaxis: "50%",
            Yaxis: "60%",
            blockTitle: "Main Trial",
            content: "Main Instruction",
            Hheight: "50vmin",
            Hwidht: "50vmin",
            textColor: "black",
            borderRadius: "10px",
            borderWidth: "5px",
            borderColor: "gray",
            blocknum: null,
        },
    },

    ExplicitTrial: {
        message: {
            id: 4,
            bgColor: "whitesmoke",
            Xaxis: "50%",
            Yaxis: "60%",
            blockTitle: "Explicit Trial",
            content: "Explicit Instruction",
            Hheight: "50vmin",
            Hwidht: "50vmin",
            textColor: "black",
            borderRadius: "10px",
            borderWidth: "5px",
            borderColor: "gray",
        },
    },
});

const form = useForm({
    folder_name: null,
    uuid: null,
    Image_Settings: Image_Settings,
    // Warning_Settings: Warning_Settings,
    // Footer_Settings: Footer_Settings,
    // Header_Settings: Header_Settings,

    Instructions: Instructions,
});

const save = () => {
    router.post("project_store", {
        data: { form: form },
        preserveState: false,
        preserveScroll: false,
    });
};
</script>
<template>
    <div class="p-5">
        <label>
            <input
                class="rounded-lg"
                type="text"
                v-model="form.folder_name"
                @keyup.enter="save()"
            />
        </label>
    </div>
</template>
