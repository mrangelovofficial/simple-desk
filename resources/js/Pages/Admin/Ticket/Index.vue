<template>
    <admin-layout>
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Subject</th>
                      <th class="px-4 py-3">Client</th>
                      <th class="px-4 py-3">Status</th>
                      <th class="px-4 py-3">Priority</th>
                      <th class="px-4 py-3">Category</th>
                      <th class="px-4 py-3">Created On</th>
                      <th class="px-4 py-3">Last Reply</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr v-for="ticket in allTickets.data" :key="ticket.id" class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm max-w-0 overflow-hidden">
                        {{ticket.subject}}
                      </td>
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                          <!-- Avatar with inset shadow -->
                          <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                            <img
                              class="object-cover w-full h-full rounded-full"
                              :src="ticket.user.profile_photo_url"
                              alt=""
                              loading="lazy"/>
                            <div
                              class="absolute inset-0 rounded-full shadow-inner"
                              aria-hidden="true"
                            ></div>
                          </div>
                          <div>
                            <p class="font-semibold">{{ticket.user.name}}</p>
                          </div>
                        </div>
                      </td>
                      
                      <td class="px-4 py-3 text-xs">
                        <span :class="ticket.status.bg_color + ' ' + ticket.status.text_color"
                          class="px-2 py-1 font-semibold leading-tight  rounded-full dark:bg-green-700 dark:text-green-100"
                        >
                          {{ticket.status.name}}
                        </span>
                      </td>
                      <td class="px-4 py-3 text-sm flex align-bottom">
                        <svg version="1.1" class="h-5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
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
                          {{ticket.category.name}}
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{ticket.created_at}}
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{ticket.updated_at}}
                      </td>
                    </tr>
                  </tbody>
                </table>
             

    </admin-layout>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout'
    import {debounce}  from 'lodash/function'

    export default {
      props: {
        tickets: Object
      },

      data(){
        return {
          allTickets: this.tickets
        }
      },
      components: {
          AdminLayout,
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
