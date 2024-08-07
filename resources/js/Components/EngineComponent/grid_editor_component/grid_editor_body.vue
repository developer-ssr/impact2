<template>
    <input type="range" v-model="header.Hheight" />
    <input type="range" v-model="header.Hwidht" />

    <div class="bg-gray-700 h-[8vmin] relative ">
        <div
            class="drag headerStyling h-[8vmin]"
            :style="{
                '--BgColor': header.bgColor,
                // height: header.Hheight + '%',
                // width: header.Hwidht + '%',
            }"
        >
            {{ header.content }}
        </div>
    </div>

    <div class="bg-gray-500 relative h-[70vmin]">editor body</div>
    <div class="bg-gray-400 h-[10%] relative">Footer</div>
</template>
<script setup>
import { inject, reactive, onMounted } from "vue";

const props = inject("testData");
const header = reactive({
    content: props.grid.header.content,
    bgColor: props.grid.header.bgColor,
    textColor: props.grid.header.textColor,
    Xaxis: props.grid.header.Xaxis,
    Yaxis: props.grid.header.Yaxis,
    Hheight: props.grid.header.Hheight,
    Hwidht: props.grid.header.Hwidht,
});
onMounted(() => {
    window.onmousedown = (event2) => {
        let Newevent = event2.target;
        let SetEvent = Newevent.classList.contains("drag");
        if (SetEvent) {
            window.onmousemove = (event) => {
                var height = window.innerHeight;
                var width = window.innerWidth;
                var x = (event.clientX / width) * 100;
                var y = (event.clientY / height) * 100;

                Newevent.dataset.currentX = x;
                Newevent.dataset.currentY = y;

                Newevent.style.position = "fixed";

                Newevent.style.top = y + "%";
                Newevent.style.left = x + "%";

                window.onmouseup = (event) => {
                    var height = window.innerHeight;
                    var width = window.innerWidth;
                    var x = (event.clientX / width) * 100;
                    var y = (event.clientY / height) * 100;

                    Newevent.style.position = "fixed";

                    Newevent.style.top = y + "%";
                    Newevent.style.left = x + "%";

                    window.onmousemove = null;
                    window.onmouseup = null;
                };
            };
        }
    };
});
</script>
<style scoped>
.headerStyling {
    background-color: var(--BgColor);
}
</style>
