<template>
    <div class="grid grid-cols-1 md:grid-cols-5 gap-3 bg-white rounded-lg shadow">
        <div class="space-y-0 col-span-1 md:col-span-2">
            <div class="w-full h-full rounded">
                <slot name="video"></slot>
            </div>
        </div>
        <div class="col-span-1 md:col-span-3 text-center md:text-left space-y-4  block md:flex flex-wrap content-between p-4">
            <div class="space-y-2 block w-full">
                <slot name="title"></slot>
                <slot name="description"></slot>
            </div>
            <div class="block w-full flex space-x-4 text-maroon-600  justify-center md:justify-start content-end">
                <div class="flex w-full block space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="12" cy="12" r="9"></circle>
                        <polyline points="12 7 12 12 15 15"></polyline>
                    </svg>
                    <slot name="duration"></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "VideoCardComponent"
}
</script>
