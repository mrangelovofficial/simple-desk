<template>
    <admin-layout>
      <div class="-mt-7">
        <select @change="onChangeView($event)"  v-model="keyOnChangeView" class="px-4 py-2 mb-3 outline-none rounded-md text-white bg-gray-700">
          <option value="pending">Pending</option>
          <option value="closed">Closed</option>
        </select>
      </div>
      
      <table class="w-full whitespace-no-wrap">
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          <tr v-for="ticket in allTickets.data" :key="ticket.id" class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3">
              <div class="flex items-center text-sm">
                <!-- Avatar with inset shadow -->
                <div class="relative hidden w-8 h-8 mr-2 rounded-full md:block">
                  <img
                    class="object-cover w-full h-full rounded-full"
                    :src="ticket.user.profile_photo_url"
                    alt=""
                    loading="lazy"/>
                </div>
                <div>
                  <p class="font-semibold">{{ticket.user.name}}
                    <span :class="ticket.status.bg_color"
                    class="px-2 py-1 font-semibold leading-tight text-xs mr-2 text-white rounded-full ">
                      {{ticket.status.name}}
                    </span>
                  </p>
                </div>
              </div>
            </td>

            <td class="px-4 py-3 text-sm font-bold max-w-max overflow-hidden truncate">
              <span v-if="ticket.category" :style="'background-color:'+ticket.category.color"
                class="px-2 py-1 font-semibold leading-tight text-xs mr-2 text-white rounded-full "
              >
                {{ticket.category.name}}
              </span>
              {{ticket.subject}}
            </td>
         
            <td class="px-4 py-3 text-right text-xs font-semibold">
              {{ticket.created_at}}
            </td>
           
            <td class="px-4 py-3 text-sm ">
              <inertia-link :href="route('admin.ticket.show',ticket.id)">
                <svg class='h-4 fill-current text-gray-300 hover:text-gray-500 cursor-pointer' enable-background="new 0 0 515.555 515.555" viewBox="0 0 515.56 515.56" xmlns="http://www.w3.org/2000/svg"><path d="m496.68 212.21c25.167 25.167 25.167 65.971 0 91.138s-65.971 25.167-91.138 0-25.167-65.971 0-91.138 65.971-25.167 91.138 0"/><path d="m303.35 212.21c25.167 25.167 25.167 65.971 0 91.138s-65.971 25.167-91.138 0-25.167-65.971 0-91.138 65.971-25.167 91.138 0"/><path d="m110.01 212.21c25.167 25.167 25.167 65.971 0 91.138s-65.971 25.167-91.138 0-25.167-65.971 0-91.138 65.971-25.167 91.138 0"/></svg>
              </inertia-link>
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
          allTickets: this.tickets,
          keyOnChangeView: (route().current('admin.ticket.closed') ? "closed" : "pending"),
        }
      },
      components: {
          AdminLayout,
      },
      methods: {
        onChangeView(event) {
            if(event.target.value === "closed"){
              this.$inertia.visit(route('admin.ticket.closed'))
            }else{
              this.$inertia.visit(route('admin.ticket.index'))
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
