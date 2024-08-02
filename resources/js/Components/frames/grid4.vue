<script setup>
import { computed, reactive, onMounted, watch, ref, inject } from "vue";
const props = inject("props");

const boxsizing = ref(null);

onMounted(() => {
    if (boxsizing.value != null) {
        boxsizing.value.forEach((element) => {
            if (element.textContent != "M") {
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
        <div>{{ data.keys }}</div>
    </div>
</template>
