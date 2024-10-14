<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

import Cards from "@/Components/ProjectsComponent/card.vue";
import Pagination from "@/Components/pagination.vue";
import Addmodal from "@/Addmodal.vue";
import { provide, ref } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import logo from "@/Components/img/logo.png";
const props = defineProps(["menu", "data"]);
const conbox = ref(false);
const settingsBox = ref(false);

provide("props", { props });
const projects = () => {
    conbox.value = !conbox.value;
    settingsBox.value = false;
};

const settings = () => {
    settingsBox.value = !settingsBox.value;
    conbox.value = false;
};

// const obj = {};
// Object.assign(obj, props.data.data);
// // console.log(props.data.data.settings);
// console.log(obj);
const form = useForm({
    project_name: null,
    settings: {
        cards: {
            cardHeaderBg: null,
            cardBodyBg: null,
            textColor: null,
            textBgcolor: null,
        },
    },
});
const save = async () => {
    form.post("project_store", {
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
                        <button @click="projects" class="block p-4">
                            Add Projects
                        </button>
                    </li>
                    <li>
                        <button @click="settings" class="block p-4">
                            Settings
                        </button>
                    </li>
                </ul>
            </div>
            <!-- 
            <div
                v-if="conbox"
                class="grow-2 bg-gray-200 h-[calc(100vmin-4rem)] w-[50vmin]"
            >
                <div class="p-5 grid bg-blue-900">
                    <label
                        class="text-white bg-purple-500 w-[20vmin] p-1 mb-1 rounded-md"
                    >
                        Project Name
                    </label>
                    <input
                        class="rounded-lg"
                        type="text"
                        v-model="form.project_name"
                        @keyup.enter="save()"
                    />
                </div>
            </div> -->

            <Addmodal v-if="conbox">
                <template #header> Add Project </template>
                <template #main>
                    <label>Project Name</label>
                    <input
                        class="rounded-lg w-full"
                        type="text"
                        v-model="form.project_name"
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

            <div
                v-if="settingsBox"
                class="grow-3 bg-gray-200 h-[calc(100vmin-4rem)] w-[50vmin]"
            >
                sdfgsfgsdf
            </div>

            <div class="grow-4 bg-gray-300 h-[calc(100vmin-4rem)] w-[200vmin]">
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
