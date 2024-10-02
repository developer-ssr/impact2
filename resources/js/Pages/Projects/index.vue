<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Sidebar from "@/Components/Sidebar.vue";
import Content from "@/Components/content.vue";
import Cards from "@/Components/ProjectsComponent/card.vue";
import Pagination from "@/Components/pagination.vue";
import Drawer from "@/Components/Drawer.vue";
import { provide, ref } from "vue";
import { router, useForm } from "@inertiajs/vue3";

const props = defineProps(["menu", "data"]);
const conbox = ref(false);
const project_name = ref(null);
provide("props", { props });
const projects = () => {
    conbox.value = !conbox.value;
};
const form = useForm({
    project_name: null,
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
                        <a :href="route('projects_index')" class="block p-4"
                            >Home</a
                        >
                    </li>

                    <li>
                        <button @click="projects" class="block p-4">
                            Add Projects
                        </button>
                    </li>
                    <li><a href="#" class="block p-4">Settings</a></li>
                </ul>
            </div>

            <div
                v-if="conbox"
                class="grow-2 bg-gray-200 h-[calc(100vmin-4rem)] w-[50vmin]"
            >
                <div class="p-5 grid bg-blue-900 text-white">
                    <label>
                        Project Name
                        <input
                            class="rounded-lg"
                            type="text"
                            v-model="form.project_name"
                            @keyup.enter="save()"
                        />
                    </label>
                </div>
            </div>

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
