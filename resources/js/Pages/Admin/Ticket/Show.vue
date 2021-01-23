<template>
    <admin-layout>
      <div class="flex bg-white border-b-2 border-gray-50 py-7 px-5">
        <div class="flex">
          <div class="text-lg font-bold">
          {{ticketData.subject}}
          </div>

          <div>
            <span :class="ticketData.status.bg_color + ' ' + ticketData.status.text_color"
            class="px-2 py-1 font-semibold leading-tight text-xs ml-3  rounded-full">
              {{ticketData.status.name}}
            </span>
          </div>

        </div>
         <div class="ml-auto">
            <select @change="onChangeStatus($event)"  class="px-4 py-2 mb-3 outline-none rounded-md text-white bg-gray-700">
            <option :selected="(status.id == ticketData.status.id)" v-for="status in statuses" :key="status.id" :value="status.id">{{status.name}}</option>
          </select>
          </div>
      </div>

      <div id="ticketDescription" class="shadow-lg py-5 px-4 border-b-2 border-gray-50 bg-white">
        <div class="flex justify-between">
          <div class="flex items-center">
            <div class="relative w-15 h-15 mr-3">
              <img
                class="object-cover w-full h-full rounded-md"
                :src="ticketData.user.profile_photo_url"
                alt=""
                loading="lazy"/>
            </div>
            <div>
              <div class="flex">
                <div class="text-md font-semibold text-gray-900">{{ticketData.user.name}}</div>
                <span v-if="!ticketData.user.is_admin" class="bg-yellow-200 text-white p-1 ml-2 text-xs rounded">Client</span>
              </div>
              <div class="text-xs font-light text-gray-400">{{ticketData.created_at}}</div>
            </div>
          </div>
        </div>
        <div class="text-md mt-5">{{ticketData.content}}</div>
      </div>
      
      <div v-for="comment in this.commentsData" :key="comment.id" class="shadow-md border-b-2 border-gray-50 bg-white py-5 px-4 ">
        <div class="flex justify-between">
          <div class="flex items-center">
            <div class="relative w-15 h-15 mr-3">
              <img
                class="object-cover w-full h-full rounded-md"
                :src="comment.user.profile_photo_url"
                alt=""
                loading="lazy"/>
            </div>
            <div>
              <div class="flex">
                <div class="text-md font-semibold text-gray-900">{{comment.user.name}}</div>
                <span v-if="!comment.user.is_admin" class="bg-yellow-200 text-white p-1 ml-2 text-xs rounded">Client</span>
              </div>
              
              <div class="text-xs font-light text-gray-400">{{comment.created_at}}</div>
            </div>
          </div>
        </div>
        <div class="text-md mt-5" v-html="comment.content"></div>
      </div>
      <div class="shadow-lg py-5 px-4 border-b-2 border-gray-50 bg-white">
         <div class="flex justify-between mb-5">
          <div class="flex items-center">
            <div class="relative w-15 h-15 mr-3">
              <img
                class="object-cover w-full h-full rounded-md"
                :src="user.profile_photo_url"
                alt=""
                loading="lazy"/>
            </div>
            <div>
              <div class="flex">
                <div class="text-md font-semibold text-gray-900">{{user.name}}</div>
              </div>
            </div>
          </div>
        </div>
         <form @submit.prevent="submit">
            <editor
            id="contentEditor"
         :api-key="tinymceKEY"
          :init="{
            height: 200,
            menubar: false,
            forced_root_block: '',
            plugins: [
              'advlist autolink lists link image charmap preview anchor',
              'searchreplace visualblocks code fullscreen',
              'insertdatetime media table paste code wordcount'
            ],
            toolbar:
              'bold italic backcolor | \
                bullist numlist outdent indent | removeformat'
          }"
        />
          <span id="errorEditor"  class="text-red-500" v-text="this.errorEditor"></span>

          <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white text-lg py-2 px-8 mt-3 ml-5 rounded">Send</button>
          </div>
      </form>

      </div>          
      

    </admin-layout>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout'
    import Editor from '@tinymce/tinymce-vue'

    export default {
      props: {
        ticket: Object,
        user: Object,
        comments: Array,
        statuses: Array,
        tinymce_app_key: String,
      },
      data() {
            return {
                ticketData: this.ticket,
                tinymceKEY: this.tinymce_app_key,
                commentsData: this.comments,
                errorEditor: '',
                keyOnChangeStatus: this.ticket.status.name,
            }
        },

      components: {
          AdminLayout,
          'editor': Editor
      },

      methods: {
        submit() {

          let content = tinymce.get("contentEditor").getContent();
          let token  = document.querySelector('meta[name="csrf-token"]').content;

          if(content != ''){

            axios.post(route('admin.comment.store'), {
              content: content,
              ticket_id: this.ticketData.id,
              _token: token
            })
            .then((response) => {
              this.commentsData.push(response.data);
              tinymce.get("contentEditor").setContent('');
            }, (error) => {
              this.errorEditor = "Something went wrong. Please try later.";
            });
          }else{
            this.errorEditor = "Ticket message can't be empty.";
          }

        },
        onChangeStatus(event) {
          const status = event.target.value;
          let token  = document.querySelector('meta[name="csrf-token"]').content;
            axios.put(route('admin.ticket.update',this.ticketData.id), {
              status: status,
              _token: token
            }).then((response) => {
                this.ticketData = response.data;
            });
        }
      }
 
    }
</script>
