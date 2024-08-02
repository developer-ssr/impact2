<script setup>
import { computed, reactive, onMounted, watch, ref, inject } from "vue";
import Modal from "@/Components/csmodal.vue";
import {
    router,
    Head,
    Link,
    useForm,
    usePage,
    useRemember,
} from "@inertiajs/vue3";
const props = defineProps(["grid1", "quadrants"]);
const boxcontainer = ref(null);
const boxsizing = ref(null);

const settingsCol = [];

const settings = useForm({
    id: null,
    title: null,
    rows: null,
    cols: null,
    keyPress: null,
    col: [],
});
const _method = {
    closeModal: () => {
        isSettingsVisible.value = true;
        isModalVisible.value = false;
    },

    showModal: (key) => {
        settings.keyPress = key;
        isModalVisible.value = true;
        isSettingsVisible.value = false;
    },

    add_trials: () => {
        settings.post("/add_trials", {
            preserveState: true,
            preserveScroll: true,
            onSuccess: (success) => {
                console.log(success);
            },
        });
    },

    updateRow: (id) => {
        settings.id = id;
        settings.post("/updateRow", {
            preserveState: true,
            preserveScroll: true,
            onSuccess: (success) => {
                console.log(success);
            },
        });
    },
    deleteMark: () => {
        settings.post("/deleteCollection", {
            preserveState: true,
            preserveScroll: true,
            onSuccess: (success) => {
                console.log(success);
            },
        });
    },
};
const isModalVisible = ref(false);
const isSettingsVisible = ref(true);

onMounted(() => {
    window.onmousedown = (event) => {
        let Newevent = event.target;
        let SetEvent = Newevent.getAttribute("class");

        if (SetEvent == "settings") {
            let event2 = event;

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
        }
    };

    let collectionArray = [];
    boxcontainer.value.addEventListener("click", (event) => {
        let Newevent = event.target;
        let SetEvent = Newevent.getAttribute("class");
        if (SetEvent == "boxsizing") {
            if (Newevent.style.backgroundColor === "red") {
                Newevent.style.backgroundColor = "";
            } else {
                Newevent.style = "background-color:red";
            }
            collectionArray.push(Newevent.getAttribute("boxId"));
            settings.col = collectionArray;
        }
        console.log(event.target);
    });
});
</script>
<style>
:root {
    --rows: 4;
}
.grid-container {
    display: grid;
    background-color: #949497;
    height: 100vh;
}

.grid-container > .quadrants {
    background-color: rgba(255, 255, 255, 0.623);
    text-align: center;
    font-size: 30px;
    display: grid;
    gap: 5px;
    grid-template-columns: repeat(var(--rows, 2), 1fr);
}
.quadrants > .boxsizing {
    background-color: rgb(255, 255, 255);
}

.settings {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 5vmin;
    border-radius: 16px;
    background-color: aqua;
}
.settings:hover {
    background: rgba(49, 52, 52, 0.29);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(0.3px);
    -webkit-backdrop-filter: blur(0.3px);
}
</style>
<template>
    <Modal v-show="isModalVisible" @close="_method.closeModal()">
        <template v-slot:header>
            <h1>{{ settings.title }}</h1>
        </template>

        <template v-slot:body>
            <div class="relative z-0 w-full mb-5 group">
                <input
                    v-model="settings.cols"
                    type="text"
                    placeholder="Columns"
                />

                <input
                    v-model="settings.keyPress"
                    type="text"
                    placeholder="Keys"
                />
                <br />
                <button @click="_method.add_trials()">Save Column</button>
            </div>
        </template>
    </Modal>

    <div ref="boxcontainer">
        <div
            class="grid-container"
            v-for="(quadrants, Qindex) in props.quadrants"
            :key="Qindex"
            ref="boxsizing"
            :keyPress="quadrants.key"
        >
            <div
                class="settings"
                v-show="isSettingsVisible"
                @close="_method.closeSettings"
            >
                <input v-model="settings.rows" />

                <br /><button
                    @click="_method.updateRow(quadrants.id)"
                    type="button"
                    class="px-3 py-2 text-xs font-medium text-center text-black"
                >
                    Save
                </button>

                <button
                    @click="_method.showModal(quadrants.key)"
                    type="button"
                    class="px-3 py-2 text-xs font-medium text-center text-black"
                >
                    Add Column
                </button>

                <br /><button
                    @click="_method.deleteMark()"
                    type="button"
                    class="px-3 py-2 text-xs font-medium text-center text-black"
                >
                    Delete Marked
                </button>
            </div>

            <div class="quadrants" :style="{ '--rows': quadrants.rows }">
                <div
                    v-for="(data, index) in props.grid1"
                    :key="index"
                    class="boxsizing"
                    :boxId="data.id"
                >
                    {{ data.keys + data.index }}
                </div>
            </div>
        </div>
    </div>
</template>
