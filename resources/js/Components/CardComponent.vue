<template>
    <div class="rounded shadow relative z-0 transform transition duration-200 hover:scale-105">
        <div class="flex justify-center items-center text-lg md:text-2xl uppercase text-maroon-600 bg-white p-16 rounded">
            <div class="opacity-100 hover:opacity-0 transition duration-300">
                <slot name="title"></slot>
            </div>
            <div class="absolute z-0 w-full h-full opacity-0 hover:opacity-100 transition duration-300">
                <slot name="image"></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  name: "GridComponent"
}
</script>

<style scoped>

</style>
