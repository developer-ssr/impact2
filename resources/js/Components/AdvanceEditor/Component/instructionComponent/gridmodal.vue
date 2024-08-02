<script setup>
import { defineEmits, inject, onMounted, ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    rows: null,
    column: null,
    testPart: null,
});

const editorDiv = ref(null);
const $Emits = defineEmits([
    "update:state",
    "edit:editCell",
    "save:cellSettings",
]);

const $Props = defineProps({
    state: { default: false },
    demoPart: "demoPart",
});

const hide = () => {
    $Emits("update:state", false);
};

const updateCell = (obj) => {
    $Emits("edit:editCell", obj); 
};

if ($Props.demoPart == "practice") {
    form.testPart = "practice_instruction";
} else if ($Props.demoPart == "main") {
    form.testPart = "main_instruction";
}
onMounted(() => {
    console.log($Props.demoPart);
});
</script>

<style scoped>
.closingX {
    background-color: rgb(152, 146, 146);
    width: 3vmin;
    height: 3vmin;
    position: relative;
}
.move {
    background-color: rgb(148, 147, 147);
    width: 5vmin;
    height: 3vmin;
    position: relative;
    z-index: 999;
}
.editorDiv {
    z-index: 100;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
label {
    background-color: transparent;
    color: black;
}
</style>
<template>
    <div class="drag editorDiv" ref="editorDiv" v-if="$Props.state">
        <button class="closingX" @click="hide()">X</button>
        <button class="move">Move</button>

        <div
            class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700"
        >
            <h5 class="text-xl font-medium text-gray-900 dark:text-white">
                {{ $Props.demoPart }} trial
            </h5>

            <!-- <form class="max-w-sm mx-auto">
                <label
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Select an option</label
                >
                <select
                    v-model="form.testPart"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                >
                    <option selected value="main_instruction">
                        Main Instruction
                    </option>
                    <option value="practice_instruction">
                        Practice Instruction
                    </option>
                </select>
            </form> -->

            <div>
                <label>Column</label>
                <input
                    type="text"
                    v-model="form.column"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    placeholder="Column"
                />
            </div>
            <div>
                <label>Rows</label>
                <input
                    type="text"
                    v-model="form.rows"
                    placeholder="Rows"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                />
            </div>

            <button
                @click="
                    updateCell({
                        column: form.rows,
                        rows: form.column,
                        testPart: form.testPart,
                    })
                "
                type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                Update Cells
            </button>
        </div>
    </div>
</template>
