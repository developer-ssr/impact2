<script setup>
import { provide, inject, ref, onMounted } from "vue";
import Modal from "@/Components/TestsComponent/Modal/Delmodal.vue";
import moment from "moment";
import Notifcation from "@/Components/Notification.vue";
import { router, useForm } from "@inertiajs/vue3";

const props = inject("props");

const isModalVisible = ref(false);
const isNotificationVisible = ref(false);
const timer = ref(null);
const editingText = ref(null);

const tests = useForm({
    test_name: null,
    id: null,
});

const _method = {
    locateProjects: (id) => {
        window.location.replace(
            "http://impact2.test/maindashboard/?code=" + id
        );
    },

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
        <label class="text-white"> Search Test</label>
        <input
            type="text"
            class="rounded-md w-[50vmin]"
            placeholder="Test Test"
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
                class="p-2 ml-1 mr-1 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
            >
                Tests:
                <div
                    @blur="
                        _method.editTests({
                            id: data.id,
                            test_name: data.test_name,
                        })
                    "
                    contenteditable="true"
                    :class="'TestsText' + data.id"
                >
                    <h5
                        class="truncate mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                    >
                        {{ data.test_name }}
                    </h5>
                </div>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    Code:{{ data.code }}<br />
                    Date: {{ _method.dateTime(data.updated_at) }}
                </p>

                <a
                    :href="route('maindashboard', { code: data.code })"
                    class="inline-flex items-center px-3 py-2 mr-1 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                    View Tests
                </a>
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
