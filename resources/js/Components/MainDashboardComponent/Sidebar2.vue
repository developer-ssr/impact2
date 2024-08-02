<template>
    <div class="container">
        <slot></slot>
    </div>
    </template>
    
    <style scoped>
    .container{
        height: 200vmin;
        width: 400px;
        background-color: gray;
        position:fixed;
        z-index:9;
        left: 0px;
        transform:translateX(0%);
        padding-left: 6rem;
        padding-top: 64px;
    }
    </style>