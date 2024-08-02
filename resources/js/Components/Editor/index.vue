<template>
    <div v-for="(data, index) in props" :key="index">
        <li class="inline-flex items-center">
            {{ data.button }}
        </li>
        <li class="inline-flex items-center">
            {{ data }}
        </li>
    </div>
</template>
<script setup>
const props = defineProps(["data", 'code']);

</script>
