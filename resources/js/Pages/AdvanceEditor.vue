<style scoped>
.circle {

    height: 20vmin;
    width: 20vmin;
    background: gold;
    border-radius: 100px;
}
</style>
<template>
    <div class="circle">Circle</div>
    <div class="circle">Circle</div>
    <div class="circle">Circle</div>
    <div class="circle">Circle</div>
    <div class="circle">Circle</div>
    <div class="circle">Circle</div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

onMounted( () =>
{
    document.querySelectorAll( ".circle" ).forEach( ( circle ) =>
    {

        circle.addEventListener( "mousedown", ( event2 ) =>
        {
            window.onmousemove = ( event ) =>
            {
                var height = window.innerHeight;
                var width = window.innerWidth;
                var x = ( event.clientX * width ) / 100;

                event2.target.style.position = "absolute";
                event2.target.style.top = event.clientY + "px";
                event2.target.style.left = x + "%";
                event2.target.style.transform = 'translate(-50%,-50%)';

            }
            window.onmouseup = ( event ) =>
            {
                var height = window.innerHeight;
                var width = window.innerWidth;
                var x = ( event.clientX * width ) / 100;
                event2.target.style.position = "absolute";
                event2.target.style.top = event.clientY + "px";
                event2.target.style.left = x + "%";
                event2.target.style.transform = 'translate(-50%,-50%)';
                window.onmousemove = null
            }

        } )
    } )
} );
</script>
