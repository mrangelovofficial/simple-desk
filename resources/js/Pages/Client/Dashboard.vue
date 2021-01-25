<template>
    <client-layout>
        <div class="py-12 grid grid-cols-3 gap-x-15">
            <stat-message :head="'In progress'" :stat="pendingTickets" :background="'bg-orange-500'"></stat-message>
            <stat-message :head="'Today\'s Closed Tickets'" :stat="closedTicketsToday"></stat-message>
            <stat-message :head="'Monthly Closed Tickets'" :stat="closedTicketsMonth" :background="'bg-green-600'"></stat-message>
        </div>
    </client-layout>
</template>

<script>
    import ClientLayout from '@/Layouts/ClientLayout'
    import StatMessage from '@/Components/StatMessage'

    export default {
        props: {
            pendingTickets: Number,
            closedTicketsToday: Number,
            closedTicketsMonth: Number
        },
        components: {
            ClientLayout,
            StatMessage
        },
    }
</script>
