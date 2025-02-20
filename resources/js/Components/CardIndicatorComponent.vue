<template>
    <div class="flex items-center p-4 bg-white border-gray-200 rounded-lg shadow bg-fucsia-500 text-white">
        <div class="p-3 mr-4 bg-fucsia-400 text-white rounded-full">
            <slot/>
        </div>
        <div>
            <span class="text-2xl sm:text-3xl leading-none font-bold mb-2">
                {{ value }}
            </span>
            <div class="font-normal  leading-5">{{ title }}</div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: {
            default: '0'
        },
        title: {
            type: String,
            default: 'title'
        },
    }
}
</script>
