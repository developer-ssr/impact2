<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Sidebar from '@/Components/Sidebar.vue';

const props = defineProps(['menu','data'])

</script>

<template>
    <AppLayout :title="props.menu.title">
        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Sidebar :menu="props.menu" :data="props.data"  />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
