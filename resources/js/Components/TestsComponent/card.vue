<script setup>
import { provide, inject, ref, onMounted, reactive } from "vue";
import Modal from "@/Components/TestsComponent/Modal/Delmodal.vue";
import moment from "moment";
import Notifcation from "@/Components/Notification.vue";
import practiceImg from "@/Components/img/practice.jpg";
import { router, useForm } from "@inertiajs/vue3";

const props = inject("props");

const isModalVisible = ref(false);
const isNotificationVisible = ref(false);
const timer = ref(null);
const editingText = ref(null);

const Image_Settings = reactive({
    practiceTrial: {
        message: {
            id: 1,
            bgColor: "whitesmoke",
            Xaxis: "50%",
            Yaxis: "50%",
            imagesrc: practiceImg,
            Hheight: "10",
            Hwidht: "50",
            borderRadius: "10px",
            borderWidth: "5px",
            borderColor: "gray",
            image_ratio: null,
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
            imagesrc: null,
            Hheight: "10",
            Hwidht: "50",

            borderRadius: "10px",
            borderWidth: "5px",
            borderColor: "gray",
            image_ratio: null,
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
            imagesrc: null,
            Hheight: "10",
            Hwidht: "50",
            borderRadius: "10px",
            borderWidth: "5px",
            borderColor: "gray",
            image_ratio: null,
            blocknum: null,
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
            imagesrc: null,
            Hheight: "10",
            Hwidht: "50",
            borderRadius: "10px",
            borderWidth: "5px",
            borderColor: "gray",
            image_ratio: null,
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

const tests = useForm({
    id: null,
    test_name: null,
    uuid: null,
    images: Image_Settings,
    // Warning_Settings: Warning_Settings,
    // Footer_Settings: Footer_Settings,
    // Header_Settings: Header_Settings,
    Instructions: Instructions,
});

const _method = {
    dateTime: (value) => {
        return moment(value).format("MMMM Do YYYY, h:mm:ss a");
    },
    closeModal: () => {
        isModalVisible.value = false;
    },
    showModal: (id) => {
        tests.id = id;
        isModalVisible.value = true;
    },

    deleteTests: () => {
        tests.delete("/tests_delete", {
            preserveState: false,
            preserveScroll: false,
            onBefore: () => {
                isModalVisible.value = false;
            },
        });
    },

    editTests: (obj) => {
        tests.test_name = document.querySelector(
            ".TestsText" + obj.id
        ).textContent;
        tests.id = obj.id;

        tests.post("/update_mainsettings", {
            onSuccess: () => {
                let timer = 4;
                let interval = setInterval(() => {
                    isNotificationVisible.value = false;
                    if (timer === 0) {
                        clearInterval(interval);
                    } else {
                        timer--;

                        isNotificationVisible.value = true;
                    }
                }, 1000);
            },
        });
    },

    Searchtest: () => {
        router.get("searchTest", { testName: tests.test_name });
    },
};
</script>

<template>
    <div class="grid relative bg-blue-900 p-2">
        <label class="text-white bg-purple-500 w-[20vmin] p-1 mb-1 rounded-md">
            Search Test</label
        >
        <input
            type="text"
            class="rounded-md w-[50vmin]"
            placeholder="Test name"
            @keypress.enter="_method.Searchtest"
            v-model="tests.test_name"
        />
    </div>
    <Modal v-show="isModalVisible" @close="_method.closeModal()">
        <template v-slot:header>
            <h1>Data Information</h1>
        </template>

        <template v-slot:body>
            <div>
                <div class="relative z-0 w-full mb-5 group">
                    Are you sure you want to delete this test?
                </div>
            </div>
        </template>

        <template v-slot:footer>
            <button
                @click="_method.deleteTests"
                type="button"
                class="px-3 py-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
            >
                Yes
            </button>
            <button
                @click="_method.closeModal()"
                type="button"
                class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                No
            </button>
        </template>
    </Modal>

    <Notifcation v-show="isNotificationVisible">
        <template v-slot:body>
            This Test is updated to
            <strong>{{ tests.test_name }}</strong></template
        >
    </Notifcation>

    <div class="grid grid-cols-4 gap-4 p-5">
        <div
            class="test-container"
            v-for="(data, index) in props.props.data.data"
            :key="index"
        >
            <div
                class="max-w-md mx-auto bg-gray-100 rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:scale-105"
            >
                <!-- Folder Flap -->
                <div
                    class="bg-gradient-to-r from-blue-400 to-blue-500 px-4 py-2 flex items-center border-b-2 border-blue-600"
                >
                    📁
                    <div
                        class="font-bold text-lg text-white text-[1vw]"
                        @blur="
                            _method.editTests({
                                id: data.id,
                                test_name: data.test_name,
                            })
                        "
                        contenteditable="true"
                        :class="'TestsText' + data.id"
                    >
                        {{ data.test_name }}
                    </div>
                </div>

                <!-- Card Body -->
                <div class="px-4 py-3">
                    <p class="text-gray-700 text-sm mb-2 text-[.5vw]">
                        Content inside the folder.
                    </p>
                    <ul
                        class="list-disc list-inside text-gray-600 mb-2 text-[.7vw]"
                    >
                        <li>Code: {{ data.code }}</li>
                        <li>Date: {{ _method.dateTime(data.updated_at) }}</li>
                        <li>Created by: {{ data.createby }}</li>
                    </ul>

                    <a
                        :href="route('maindashboard', { code: data.code })"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-1.5 px-3 rounded-full transition duration-200 ease-in-out shadow-md hover:shadow-lg text-[.7vw]"
                    >
                        View Test
                    </a>
                    <button
                        @click="_method.showModal(data.id)"
                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-full transition duration-200 ease-in-out w-[10vmin] shadow-md hover:shadow-lg mr-1 text-[.7vw]"
                    >
                        Delete
                    </button>
                </div>

                <!-- Card Footer -->
            </div>
        </div>
    </div>
</template>
