<script setup>
import { reactive, onMounted, ref, inject,defineEmits } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import MainDashboard from "@/Components/MainDashboardComponent/index.vue"
import templates_coponent from "@/Components/MainDashboardComponent/Templates/index.vue"
import demo_component from "@/Components/MainDashboardComponent/Selectdemo/index.vue"
import trial_component from "@/Components/MainDashboardComponent/Trial/index.vue"
import redirect_component from "@/Components/MainDashboardComponent/Redirect/index.vue"
import setupgrid_component from "@/Components/MainDashboardComponent/SetupGrid/index.vue"
import instructions_component from "@/Components/MainDashboardComponent/Instructions/index.vue"
import Sidebar2 from "@/Components/Sidebar2.vue"

const sidebarVisible = ref(false)
const activeElem = ref(false)

</script>

<template>
    <AppLayout >
        <div class="pb-10">

            <MainDashboard        
                @show:menu="(active)=>{
                    if(!active){
                        sidebarVisible = false
                    }else{
                        sidebarVisible =true
                    }
                    activeElem = active
                }"
            />
<Transition name="sidebar">  
    <Sidebar2 v-show="sidebarVisible">
        <templates_coponent v-if="activeElem === 'templates'"></templates_coponent>
        <demo_component v-if="activeElem === 'demo'"></demo_component>
        <trial_component v-if="activeElem === 'trial'"></trial_component>
        <redirect_component v-if="activeElem === 'redirect'"></redirect_component>
        <setupgrid_component v-if="activeElem === 'setupgrid'"></setupgrid_component>
        <instructions_component v-if="activeElem === 'instructions'"></instructions_component>
    </Sidebar2>
</Transition>



           
        </div>
    </AppLayout>
</template>
