<template>
    <label class="block font-medium  text-gray-700">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>

<script>
export default {
    props: ['value']
}
</script>
