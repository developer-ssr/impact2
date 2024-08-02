<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Sidebar from '@/Components/Sidebar.vue';

const prop = defineProps(['title'])
</script>

<template>
    <AppLayout :title="prop.title">
        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Sidebar :title="prop.title" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
