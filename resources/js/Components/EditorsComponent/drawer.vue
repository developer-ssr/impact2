<style scoped>
.draggable {
    position: absolute;
    cursor: move;
    border: 1px solid #ccc;
    background-color: #c81d1d;
    padding: 10px;
    height: 100px;
    width: 100px;
}
</style>

<script setup>
import {  reactive, onMounted } from "vue";
import $TempData from "@/Components/Plugins/TemplateData";



const reactiveTempData = reactive($TempData);

const _method = {
    AddTargets: () => {
        const newTarget = {
            id: 3,
            class: "draggable",
            name: "Target 3",
            equivalent: "Target 3",
            value: 3,
            style: {
                position: "fixed",
                transform: "translate(-50 %, -50 %)",
                backgroundColor: "red",
            },
        };
        reactiveTempData.targets.push(newTarget);

        $forceUpdate();
    },
};

const $forceUpdate = () => {
    const forceUpdate = () => {};
    return forceUpdate();
};

onMounted(() => {
    window.onmousedown = (event) => {
        let Newevent = event.target;
        let SetEvent = Newevent.getAttribute("class");
        if (SetEvent != "draggable") {
            console.log("dragging disabled");
        } else {
            
            let event2 = event
            //event.target.addEventListener("mousedown", (event2) => {
                window.onmousemove = (event) => {
                    var height = window.innerHeight;
                    var width = window.innerWidth;
                    var x = (event.clientX / width) * 100;
                    var y = (event.clientY / height) * 100;

                    event2.target.style.position = "fixed";
                    event2.target.style.top = y + "%";
                    event2.target.style.left = x + "%";
                    event2.target.style.transform = "translate(-50%,-50%)";

                    window.onmouseup = (event) => {
                        var height = window.innerHeight;
                        var width = window.innerWidth;
                        var x = (event.clientX / width) * 100;
                        var y = (event.clientY / height) * 100;
                        event2.target.style.position = "fixed";
                        event2.target.style.top = y + "%";
                        event2.target.style.left = x + "%";
                        event2.target.style.transform = "translate(-50%,-50%)";
                        window.onmousemove = null;
                        window.onmouseup = null;
                    };
                };
            //});
        }
    };
});
</script>

<template>
    <div class="bg-gray-200 min-h-screen flex">
        <div
            class="bg-gray-900 text-gray-100 flex-shrink-0 w-16 sm:w-32 md:w-48"
        >
            <ul class="space-y-2 font-medium">
                <li>
                    <a
                        @click="_method.AddTargets()"
                        href="#"
                        class="flex items-center p-2 text-gray-100 dark:text-white hover:bg-gray-500 dark:hover:bg-gray-900 group"
                    >
                        <span class="flex-1 ms-3 whitespace-nowrap"
                            >Add Targets</span
                        >
                    </a>
                </li>
            </ul>
        </div>

        <div v-for="target in reactiveTempData.targets" :key="target.id">
            <!-- <p>{{ target.name }}</p>
            <p>{{ target.equivalent }}</p> -->

            <div
                :class="target.class"
                style="position: 'fixed'; transform: translate(-50%, -50%)"
            >
                {{ target.name }}
            </div>
        </div>
    </div>
</template>
