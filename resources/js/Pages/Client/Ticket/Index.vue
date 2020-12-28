<template>
    <client-layout>
      <div class="flex flex-row-reverse mb-4">
          <jet-button-link :href="route('client.ticket.create')">
            Create Ticket
          </jet-button-link>
      </div>
      <table class="w-full whitespace-no-wrap">
        <thead>
          <tr
            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
          >
            <th class="px-4 py-3">Subject</th>
            <th class="px-4 py-3">Client</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">Date</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          <tr v-for="ticket in tickets" :key="ticket.id" class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3">
              <div class="flex items-center text-sm">
                <div>
                  <p class="font-semibold">{{ticket.subject}}</p>
                </div>
              </div>
            </td>
            <td class="px-4 py-3 text-sm">
              {{ticket.content}}
            </td>
            <td class="px-4 py-3 text-xs">
              <span
                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
              >
                Approved
              </span>
            </td>
            <td class="px-4 py-3 text-sm">
              {{ticket.created_at}}
            </td>
          </tr>
        </tbody>
      </table>
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
