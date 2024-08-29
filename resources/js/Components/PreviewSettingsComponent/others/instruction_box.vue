<template>
   
</template>
<script setup>
import { ref, onMounted, inject } from "vue";
const props = inject("instructions");
const instruction = ref(props.practiceTrial.message.content);

onMounted(() => {
    console.log(props.practiceTrial.message.content);
});
</script>
