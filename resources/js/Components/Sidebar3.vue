<template>
    <div class="containerSidebar">
        <slot></slot>
    </div>
</template>

<style scoped>
.containerSidebar {
    height: 200vmin;
    width: 400px;
    background-color: gray;
    position: fixed;
    z-index: 9;
    left: 0px;
    transform: translateX(0%);
    padding-left: 6rem;
    padding-top: 64px;
    top: 0px;
}
</style>
