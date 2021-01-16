<template>
    <admin-layout :contentClasses="'py-10 px-10'">

        <div class="py-12 grid grid-cols-3 gap-x-15">
            <stat-message :head="'Pending Tickets'" :stat="pendingTickets" :background="'bg-red-500'"></stat-message>
            <stat-message :head="'Today\'s Closed Tickets'" :stat="closedTicketsToday"></stat-message>
            <stat-message :head="'Monthly Closed Tickets'" :stat="closedTicketsMonth" :background="'bg-green-600'"></stat-message>
        </div>
        
    </admin-layout>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout'
    import StatMessage from '@/Components/StatMessage'

    export default {
        props: {
            pendingTickets: Number,
            closedTicketsToday: Number,
            closedTicketsMonth: Number
        },
        components: {
            AdminLayout,
            StatMessage,
        },
    }
</script>
