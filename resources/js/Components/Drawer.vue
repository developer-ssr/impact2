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
        },
    },
});

const Warning_Settings = reactive({
    practiceTrial: {
        message: {
            id: 1,
            bgColor: "whitesmoke",
            Xaxis: "50%",
            Yaxis: "50%",
            content: "Practice Header Warning",
            Hheight: "10",
            Hwidht: "50",
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
            Yaxis: "50%",
            content: "Dummy Header Warning",
            Hheight: "10",
            Hwidht: "50",
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
            Yaxis: "50%",
            content: "Main Header Warning",
            Hheight: "10",
            Hwidht: "50",
            textColor: "black",
            borderRadius: "10px",
            borderWidth: "5px",
            borderColor: "gray",
        },
    },
});
const Footer_Settings = reactive({
    practiceTrial: {
        message: {
            id: 1,
            bgColor: "whitesmoke",
            Xaxis: "50%",
            Yaxis: "92%",
            content: "Practice Footer Text",
            Hheight: "5vmin",
            Hwidht: "60vmin",
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
            Yaxis: "92%",
            content: "Dummy Footer Text",
            Hheight: "5vmin",
            Hwidht: "60vmin",
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
            Yaxis: "92%",
            content: "Main Footer Text",
            Hheight: "5vmin",
            Hwidht: "60vmin",
            textColor: "black",
            borderRadius: "10px",
            borderWidth: "5px",
            borderColor: "gray",
        },
    },
});

const Header_Settings = reactive({
    practiceTrial: {
        message: {
            id: 1,
            bgColor: "whitesmoke",
            Xaxis: "50%",
            Yaxis: "25%",
            content: "Practice Header",
            Hheight: "12vmin",
            Hwidht: "60vmin",
            textColor: "black",
            borderRadius: "0px",
            borderWidth: "5px",
            borderColor: "gray",
        },
    },
    DummyTrial: {
        message: {
            id: 2,
            bgColor: "whitesmoke",
            Xaxis: "50%",
            Yaxis: "25%",
            content: "Dummy Header",
            Hheight: "12vmin",
            Hwidht: "60vmin",
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
            Yaxis: "25%",
            content: "Main Header",
            Hheight: "12vmin",
            Hwidht: "60vmin",
            textColor: "black",
            borderRadius: "10px",
            borderWidth: "5px",
            borderColor: "gray",
        },
    },
});

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
        },
    },
});

const form = useForm({
    folder_name: null,
    uuid: null,
    Image_Settings: Image_Settings,
    Warning_Settings: Warning_Settings,
    Footer_Settings: Footer_Settings,
    Header_Settings: Header_Settings,
    Instructions: Instructions,
});

const save = () => {
    form.post(props.props.menu.save, {
        onSuccess: (success) => {
            console.log(success);
        },
        onError: (errors) => {
            console.log(errors);
        },
    });
};
</script>
<template>
    <div
        id="drawer-right-example"
        class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800"
        tabindex="-1"
        aria-labelledby="drawer-right-label"
    >
        <h5
            id="drawer-right-label"
            class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"
        >
            <svg
                class="w-4 h-4 me-2.5"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 20 20"
            >
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"
                />
            </svg>
        </h5>

        <div class="grid grid-cols-2 gap-4">
            <label
                >{{ props.props.menu.placeholder }}
                <input
                    type="text"
                    v-model="form.folder_name"
                    @keyup.enter="save()"
                />
            </label>
        </div>
    </div>
</template>
