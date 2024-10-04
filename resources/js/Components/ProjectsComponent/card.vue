<script setup>
import { provide, inject, ref, onMounted } from "vue";
import Modal from "@/Components/ProjectsComponent/Modal/Delmodal.vue";
import moment from "moment";
import Notifcation from "@/Components/Notification.vue";
import { router, useForm } from "@inertiajs/vue3";

const props = inject("props");
const isModalVisible = ref(false);
const isNotificationVisible = ref(false);
const timer = ref(null);
const editingText = ref(null);

const project = useForm({
    project_name: null,
    id: null,
});

const _method = {
    locateProjects: (id) => {
        window.location.replace(
            "http://impact2.test/tests_index/?uuid=" + id
        );
    },

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
            onBefore: () => {
                isModalVisible.value = false;
            },
        });
    },

    editProject: (id) => {
        project.project_name = document.querySelector(
            ".ProjectText" + id
        ).textContent;
        project.id = id;

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
};
</script>

<template>
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

    <Notifcation v-show="isNotificationVisible">
        <template v-slot:body>
            This project is updated to
            <strong>{{ project.project_name }}</strong></template
        >
    </Notifcation>

    <div class="grid grid-cols-4 gap-4">
        <div v-for="(data, index) in props.props.data.data" :key="index">
            <div
            class=" pl-5 max-w-sm p-2 ml-1 mr-1 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"

               
            >
                Project:
                <div
                    @blur="_method.editProject(data.id, data.project_name)"
                    contenteditable="true"
                    :class="'ProjectText' + data.id"
                >
                    <h5
                        class="truncate mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                    >
                        {{ data.project_name }}
                    </h5>
                </div>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    Date: {{ _method.dateTime(data.updated_at) }}
                </p>

                <button
                    @click="_method.locateProjects(data.uuid)"
                    class="inline-flex items-center px-3 py-2 mr-1 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                    View Project
                </button>
                <button
                    @click="_method.showModal(data.id)"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none"
                >
                    Delete
                </button>
            </div>
        </div>
    </div>
</template>
