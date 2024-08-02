<script setup>
import { computed, reactive, onMounted, watch, ref, inject } from "vue";
const props = inject("props");

const boxsizing = ref(null);

onMounted(() => {
    if (boxsizing.value != null) {
        boxsizing.value.forEach((element) => {
            // console.log((element.style.display = "none"));
            if (element.textContent != "C") {
                element.style.display = "none";
            }
        });
    }
});
</script>

<template>
    <div
        v-for="(data, index) in props.props.all_trials"
        :key="index"
        class="boxsizing"
        ref="boxsizing"
    >
        {{ data.keys }}
    </div>
</template>
