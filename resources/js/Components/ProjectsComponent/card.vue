<script setup>
import { provide, inject, ref, onMounted } from "vue";
import Modal from "@/Components/ProjectsComponent/Modal/Delmodal.vue";
import moment from "moment";
import Notifcation from "@/Components/Notification.vue";
import testimg from "@/Components/img/test.png";
import { useForm, router } from "@inertiajs/vue3";

const props = inject("props");
const ProjectsData = ref(props.props.data.data);
const isModalVisible = ref(false);
const isNotificationVisible = ref(false);
const timer = ref(null);
const editingText = ref(null);
const searchProj = ref(null);
//const testimg = require("@/assets/img/test.jpg");
const project = useForm({
    project_name: null,
    id: null,

    cards: {
        cardHeaderBg: null,
        cardBodyBg: null,
        textColor: null,
        textBgcolor: null,
    },
});

// console.log(props.props.data.data);
const _method = {
    dateTime: (value) => {
        return moment(value).format("MMMM Do YYYY, h:mm:ss a");
    },
    closeModal: () => {
        isModalVisible.value = false;
    },
    showModal: (id) => {
        project.id = id;
        isModalVisible.value = true;
    },

    deleteProject: () => {
        project.delete("/project_delete", {
            preserveState: false,
            preserveScroll: false,
            onSuccess: (response) => {
                console.log(response);
                isModalVisible.value = false;
            },
        });
    },

    editProject: (obj) => {
        project.project_name = document.querySelector(
            ".ProjectText" + obj.id
        ).textContent;
        project.id = obj.id;

        project.post("/project_update", {
            method: "post",
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
    SearcProject: () => {
        router.get("searchProject", { projectName: searchProj.value });
    },
};
</script>

<template>
    <div class="grid relative bg-blue-900 p-2">
        <label class="text-white bg-purple-500 w-[20vmin] p-1 mb-1 rounded-md">
            Search Project</label
        >
        <input
            type="text"
            class="rounded-md w-[50vmin]"
            placeholder="Project Name"
            @keypress.enter="_method.SearcProject"
            v-model="searchProj"
        />
    </div>

    <Modal v-show="isModalVisible" @close="_method.closeModal()">
        <template v-slot:header>
            <h1>Data Information</h1>
        </template>

        <template v-slot:body>
            <div>
                <div class="relative z-0 w-full mb-5 group">
                    Are you sure you want to delete this project?
                </div>
            </div>
        </template>

        <template v-slot:footer>
            <button
                @click="_method.deleteProject"
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

    <Teleport to="body">
        <Notifcation v-show="isNotificationVisible">
            <template v-slot:body>
                This project is updated to
                <strong>{{ project.project_name }}</strong></template
            >
        </Notifcation>
    </Teleport>

    <div class="grid grid-cols-4 gap-4 p-2">
        <div v-for="(data, index) in ProjectsData" :key="index">
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
                            _method.editProject({
                                id: data.id,
                                project_name: data.project_name,
                            })
                        "
                        contenteditable="true"
                        :class="'ProjectText' + data.id"
                    >
                        {{ data.project_name }}
                    </div>
                </div>

                <!-- Card Body -->
                <div class="px-4 py-3">
                    <p class="text-gray-700 mb-2 text-[.5vw]">
                        Content inside the folder.
                    </p>
                    <ul
                        class="list-disc list-inside text-gray-600 mb-2 text-[.7vw]"
                    >
                        <li>Date: {{ _method.dateTime(data.updated_at) }}</li>
                        <li>Created by: {{ data.createby }}</li>
                    </ul>

                    <a
                        :href="route('tests_index', { uuid: data.uuid })"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-1.5 px-3 rounded-full transition duration-200 ease-in-out shadow-md hover:shadow-lg text-[.7vw]"
                    >
                        View Project
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
<style scoped>
.folder {
    background: #f9d74e; /* Folder color */
    height: 150px; /* Height of the folder */
    width: 250px; /* Width of the folder */
    clip-path: polygon(
        0% 0%,
        0% 100%,
        100% 100%,
        100% 11%,
        46% 11%,
        46% 0
    ); /* Shape definition */
    filter: drop-shadow(0 0 10px rgba(0, 0, 0, 0.5)); /* Shadow effect */
    position: relative; /* Positioning context for child elements */
}

.content {
    padding: 10px; /* Padding inside the folder */
}
</style>
