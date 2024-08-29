<template>
    <div class="header-container">
        <div
            class="dheader bg-[#fff] text-sm h-[5.3vmin] shadow-md fixed w-[100%] flex items-center justify-center"
        >
            <img
                src="http://newimpact2.test/targets_images/logo.png"
                class="max-w-[100%] max-h-[100%]"
            />
            <div
                class="blockHeader fixed z-10 top-[5.2vmin] bg-[#ffc107] min-w-[20vmin] pt-[0.4vmin] pr-[3vmin] pb-[0.4vmin] pl-[3vmin] rounded-bl-[2.5vmin] rounded-br-[2.5vmin] text-[1.3vmin] text-center text-lg"
            >
                block
            </div>
        </div>
    </div>
</template>
<style>
.dheader {
    display: flex;
    align-items: center;
    justify-content: center;
}

.dheader > img {
    vertical-align: middle;
}
.dheader > .blockHeader {
    vertical-align: middle;
}
</style>
