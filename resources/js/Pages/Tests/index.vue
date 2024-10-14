<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

import Cards from "@/Components/TestsComponent/card.vue";
import Pagination from "@/Components/pagination.vue";
import practiceImg from "@/Components/img/practice.jpg";
import { provide, ref, reactive } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import Addmodal from "@/Addmodal.vue";
const props = defineProps(["menu", "data"]);
const conbox = ref(false);
import logo from "@/Components/img/logo.png";

provide("props", { props });
const testname = () => {
    conbox.value = !conbox.value;
};

const Image_Settings = reactive({
    practiceTrial: {
        message: {
            id: 1,
            bgColor: "whitesmoke",
            Xaxis: "50%",
            Yaxis: "50%",
            imagesrc: practiceImg,
            Hheight: "10vmin",
            Hwidht: "50vmin",
            borderRadius: "10px",
            borderWidth: "5px",
            borderColor: "gray",
            image_ratio: null,
            column: 2,
            cells: [
                {
                    cellid: "1",
                    index: "(0, 0)",
                    active: false,
                    ladybug: false,
                },
                {
                    cellid: "2",
                    index: "(0, 1)",
                    active: false,
                    ladybug: false,
                },
                {
                    cellid: "3",
                    index: "(1, 0)",
                    active: false,
                    ladybug: false,
                },
                {
                    cellid: "4",
                    index: "(1, 1)",
                    active: false,
                    ladybug: false,
                },
            ],
        },
    },
    DummyTrial: {
        message: {
            id: 2,
            bgColor: "whitesmoke",
            Xaxis: "50%",
            Yaxis: "50%",
            imagesrc: practiceImg,
            Hheight: "10vmin",
            Hwidht: "50vmin",

            borderRadius: "10px",
            borderWidth: "5px",
            borderColor: "gray",
            image_ratio: null,
            column: 2,
            cells: [
                {
                    cellid: "1",
                    index: "(0, 0)",
                    active: false,
                    ladybug: false,
                },
                {
                    cellid: "2",
                    index: "(0, 1)",
                    active: false,
                    ladybug: false,
                },
                {
                    cellid: "3",
                    index: "(1, 0)",
                    active: false,
                    ladybug: false,
                },
                {
                    cellid: "4",
                    index: "(1, 1)",
                    active: false,
                    ladybug: false,
                },
            ],
        },
    },

    MainTrial: {
        message: {
            id: 3,
            bgColor: "whitesmoke",
            Xaxis: "50%",
            Yaxis: "50%",
            imagesrc: practiceImg,
            Hheight: "10vmin",
            Hwidht: "50vmin",
            borderRadius: "10px",
            borderWidth: "5px",
            borderColor: "gray",
            image_ratio: null,
            blocknum: null,
            column: 2,
            cells: [
                {
                    cellid: "1",
                    index: "(0, 0)",
                    active: false,
                    ladybug: false,
                },
                {
                    cellid: "2",
                    index: "(0, 1)",
                    active: false,
                    ladybug: false,
                },
                {
                    cellid: "3",
                    index: "(1, 0)",
                    active: false,
                    ladybug: false,
                },
                {
                    cellid: "4",
                    index: "(1, 1)",
                    active: false,
                    ladybug: false,
                },
            ],
        },
    },
    ExplicitTrial: {
        message: {
            id: 4,
            bgColor: "whitesmoke",
            Xaxis: "50%",
            Yaxis: "50%",
            imagesrc: practiceImg,
            Hheight: "10vmin",
            Hwidht: "50vmin",
            borderRadius: "10px",
            borderWidth: "5px",
            borderColor: "gray",
            image_ratio: null,
            column: 2,
            cells: [
                {
                    cellid: "1",
                    index: "(0, 0)",
                    active: false,
                    ladybug: false,
                },
                {
                    cellid: "2",
                    index: "(0, 1)",
                    active: false,
                    ladybug: false,
                },
                {
                    cellid: "3",
                    index: "(1, 0)",
                    active: false,
                    ladybug: false,
                },
                {
                    cellid: "4",
                    index: "(1, 1)",
                    active: false,
                    ladybug: false,
                },
            ],
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
    test_name: null,
    uuid: null,
    Image_Settings: Image_Settings,
    // Warning_Settings: Warning_Settings,
    // Footer_Settings: Footer_Settings,
    // Header_Settings: Header_Settings,

    Instructions: Instructions,
});

const save = async () => {
    form.post("store_mainsettings", {
        preserveState: false,
        preserveScroll: false,
        onSuccess: (response) => {
            console.log(response);
        },
    });
};
</script>

<template>
    <AppLayout>
        <div class="flex">
            <!-- Sidebar -->
            <div
                class="grow-0 w-[20vmin] bg-gray-800 h-[calc(100vmin-4rem)] text-white relative"
            >
                <ul>
                    <li>
                        <img :src="logo" class="block p-4" />
                    </li>
                    <li>
                        <a :href="route('projects_index')" class="block p-4"
                            >Home</a
                        >
                    </li>

                    <li>
                        <button @click="testname" class="block p-4">
                            Add Test
                        </button>
                    </li>
                    <li><a href="#" class="block p-4">Settings</a></li>
                </ul>
            </div>

            <!-- <div
                v-if="conbox"
                class="grow-2 bg-gray-200 h-[calc(100vmin-4rem)] w-[50vmin]"
            >
                <div class="p-5 grid bg-blue-900">
                    <label
                        class="text-white bg-purple-500 w-[20vmin] p-1 mb-1 rounded-md"
                    >
                        Test Name
                    </label>
                    <input
                        class="rounded-lg"
                        type="text"
                        v-model="form.test_name"
                        @keyup.enter="save()"
                    />
                </div>
            </div> -->

            <Addmodal v-if="conbox">
                <template #header> Add Test </template>
                <template #main>
                    <label>Test Name</label>
                    <input
                        class="rounded-lg w-full"
                        type="text"
                        v-model="form.test_name"
                        @keyup.enter="save()"
                /></template>
                <template #footer>
                    <button
                        @click="conbox = false"
                        class="rounded bg-blue-500 px-4 py-2 text-white transition duration-200 hover:bg-blue-600"
                    >
                        Cancel
                    </button>
                    <button
                        @click="save()"
                        class="ml-2 rounded bg-green-500 px-4 py-2 text-white transition duration-200 hover:bg-green-600"
                    >
                        Add
                    </button>
                </template>
            </Addmodal>

            <div class="grow-3 bg-gray-300 h-[calc(100vmin-4rem)] w-[200vmin]">
                <Cards> </Cards>
                <Pagination />
            </div>

            <!-- Main Content -->
        </div>
    </AppLayout>

    <!-- <AppLayout :title="props.menu.title">
        <div class="">
            <div class="max-w-full max-h-full">
                <div
                    class="bg-gray-500 overflow-hidden shadow-xl sm:rounded-lg"
                >
                   
                </div>
            </div>
        </div>
    </AppLayout> -->
</template>
