<template>
    <div
        id="toast-top-right"
        class="fixed flex items-center text-white bg-blue-400 w-full max-w-xs p-4 space-x-4 divide-x rtl:divide-x-reverse rounded-lg shadow top-5 right-5"
        role="alert"
    >
        <div class="text-sm font-normal">
            <slot name="body"></slot>
        </div>
    </div>
</template>
