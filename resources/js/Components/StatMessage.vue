<template>
    <div :class="background" class="text-white rounded-md px-6 py-7 shadow-md">
        <div v-text="head" class="font-bold text-xl mb-5">Closed Tickets Today</div>
        <div v-text="stat" class="text-3xl font-extrabold">1576</div>
    </div>
</template>

<script>
    export default {
        props: {
            head: String,
            stat: Number,
            background: {
                type: String,
                default: 'bg-blue-500',
            }
        }
    }
</script>
