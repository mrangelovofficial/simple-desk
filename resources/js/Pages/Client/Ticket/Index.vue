<template>
    <client-layout>
                <div class="-mt-7">
                  <select  @change="onChangeView($event)" v-model="keyOnChangeView" class="p-4 mb-3 outline-none rounded-l-md">
                    <option value="pending">Pending</option>
                    <option value="closed">Closed</option>
                  </select>
                </div>
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Subject</th>
                      <th class="px-4 py-3">Status</th>
                      <th class="px-4 py-3">Priority</th>
                      <th class="px-4 py-3">Category</th>
                      <th class="px-4 py-3">Created On</th>
                      <th class="px-4 py-3">Last Reply</th>
                      <th class="px-4 py-3">Action</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr v-for="ticket in allTickets.data" :key="ticket.id" class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm max-w-max overflow-hidden truncate">
                        {{ticket.subject}}
                      </td>
                      <td class="px-4 py-3 text-xs">
                        <span :class="ticket.status.bg_color + ' ' + ticket.status.text_color"
                          class="px-2 py-1 font-semibold leading-tight  rounded-full"
                        >
                          {{ticket.status.name}}
                        </span>
                      </td>
                      <td class="px-4 py-4 text-sm flex align-bottom">
                        <svg version="1.1" class="h-5 mr-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                          viewBox="0 0 403.04 403.04" style="enable-background:new 0 0 403.04 403.04;" xml:space="preserve">
                            <path :class="ticket.priority.color" class="fill-current" d="M370.604,50.16L370.604,50.16c-2.948-1.487-6.507-1.011-8.96,1.2c-21.68,19.44-41.6,28.88-60.96,28.88
                              s-38.16-8.96-61.52-29.2c-50.72-43.28-100.56-43.2-158.8-1.84c-4.08,2.88-4.08,2.88-3.36,86.16c0,32.72,0.56,73.28,0,78.96
                              c-1.106,4.278,1.465,8.642,5.742,9.748c2.572,0.665,5.306,0.01,7.298-1.748c20.301-15.662,45.085-24.409,70.72-24.96
                              c16.693,0.091,33.132,4.092,48,11.68c16.247,8.709,34.294,13.529,52.72,14.08c96.64,0,112.56-158.16,113.2-164.88
                              C375.125,54.962,373.504,51.751,370.604,50.16z"/>
                            <path d="M52.364,0h-7.52c-9.146,0-16.56,7.414-16.56,16.56v369.92c0,9.146,7.414,16.56,16.56,16.56h7.52
                              c9.146,0,16.56-7.414,16.56-16.56V16.56C68.924,7.414,61.51,0,52.364,0z"/>
                        </svg>
                          {{ticket.priority.name}}                        
                      </td>
                      <td class="px-4 py-3 text-sm max-w-xs overflow-hidden">
                          <span :style="'background-color:'+ticket.category.color"
                          class="px-2 py-1 font-semibold leading-tight  text-white rounded-full "
                        >
                          {{ticket.category.name}}
                        </span>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{ticket.created_at}}
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{ticket.updated_at}}
                      </td>
                      <td class="px-4 py-3 text-sm ">
                        <inertia-link :href="route('client.ticket.show',ticket.id)">
                          <svg class='h-5 fill-current ml-2 text-gray-500 hover:text-gray-700 cursor-pointer' enable-background="new 0 0 515.555 515.555" viewBox="0 0 515.56 515.56" xmlns="http://www.w3.org/2000/svg"><path d="m496.68 212.21c25.167 25.167 25.167 65.971 0 91.138s-65.971 25.167-91.138 0-25.167-65.971 0-91.138 65.971-25.167 91.138 0"/><path d="m303.35 212.21c25.167 25.167 25.167 65.971 0 91.138s-65.971 25.167-91.138 0-25.167-65.971 0-91.138 65.971-25.167 91.138 0"/><path d="m110.01 212.21c25.167 25.167 25.167 65.971 0 91.138s-65.971 25.167-91.138 0-25.167-65.971 0-91.138 65.971-25.167 91.138 0"/></svg>
                        </inertia-link>
                      </td>
                    </tr>
                  </tbody>
                </table>
             

    </client-layout>
</template>

<script>
    import ClientLayout from '@/Layouts/ClientLayout'
    import {debounce}  from 'lodash/function'

    export default {
      props: {
        tickets: Object
      },

      data(){
        return {
          allTickets: this.tickets,
          keyOnChangeView: (route().current('client.ticket.closed') ? "closed" : "pending"),
        }
      },
      components: {
          ClientLayout,
      },
      methods: {
        onChangeView(event) {
            if(event.target.value === "closed"){
              this.$inertia.visit(route('client.ticket.closed'))
            }else{
              this.$inertia.visit(route('client.ticket.index'))
            }
        }
      },
      mounted() {
        window.addEventListener('scroll', debounce((e) => {
          let pixelsFromBottom = document.documentElement.offsetHeight - document.documentElement.scrollTop - window.innerHeight;
         
          if(pixelsFromBottom < 200) {
            axios.get(this.allTickets.next_page_url).then(response => {
              this.allTickets = {
                ...response.data,
                data: [...this.allTickets.data, ...response.data.data]
              }  
            });
          }
        }, 50));
      }
    }
</script>
