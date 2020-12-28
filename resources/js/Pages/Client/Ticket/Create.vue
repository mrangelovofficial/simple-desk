<template>
    <client-layout>
      <div class="flex flex-row-reverse mb-4">
          <jet-button-link :href="route('client.ticket.create')">
            Create Ticket
          </jet-button-link>
      </div>
    </client-layout>
</template>

<script>
    import ClientLayout from '@/Layouts/ClientLayout'
    import JetButtonLink from '@/Jetstream/ButtonLink'

    export default {
      props: ['tickets'],

      components: {
          ClientLayout,
          JetButtonLink
      },
    }
</script>
