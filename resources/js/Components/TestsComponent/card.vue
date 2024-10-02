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
        <label class="text-white bg-purple-500 w-[20vmin] p-1 mb-1 rounded-md">
            Search Test</label
        >
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
            <div class="bg-white rounded-lg">
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
                    <div
                        class="bg-gray-900 h-13 p-3 text-white rounded-lg shadow-xl"
                    >
                        <div
                            class="bg-gradient-to-r from-teal-400 to-blue-500 hover:from-pink-500 hover:to-orange-500 w-[10vmin] pt-1 pl-5 pb-1 rounded-xl"
                        >
                            {{ data.test_name }}
                        </div>
                    </div>
                </div>
                <div class="p-5 mb-10">
                    Code:{{ data.code }}<br />
                    Date: {{ _method.dateTime(data.updated_at) }}
                </div>
                <div class="bg-gray-200 p-2 rounded-sm">
                    <a
                        :href="route('maindashboard', { code: data.code })"
                        class="inline-flex items-center bg-blue-400 p-1 rounded-md text-white"
                    >
                        View Tests
                    </a>
                    <button
                        @click="_method.showModal(data.id)"
                        class="inline-flex items-center text-white bg-red-400 p-1 rounded-md m-1 shadow-md"
                    >
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
