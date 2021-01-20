<template>
    <client-layout :contentClasses="'py-10 px-10 bg-gray-100'">
      <div class="flex bg-white border-b-2 border-gray-50 py-7 px-5">
        <div class="flex">
          <div class="text-lg font-bold">
          {{ticket.subject}}
          </div>

          <div>
            <span :class="ticket.status.bg_color + ' ' + ticket.status.text_color"
            class="px-2 py-1 font-semibold leading-tight text-xs ml-3  rounded-full">
              {{ticket.status.name}}
            </span>
          </div>

        </div>
      </div>

      <div id="ticketDescription" class="shadow-lg py-5 px-4 border-b-2 border-gray-50 bg-white">
        <div class="flex justify-between">
          <div class="flex items-center">
            <div class="relative w-15 h-15 mr-3">
              <img
                class="object-cover w-full h-full rounded-md"
                :src="ticket.user.profile_photo_url"
                alt=""
                loading="lazy"/>
            </div>
            <div>
              <div class="flex">
                <div class="text-md font-semibold text-gray-900">{{ticket.user.name}}</div>
                <span v-if="!ticket.user.is_admin" class="bg-yellow-200 text-white p-1 ml-2 text-xs rounded">Client</span>
              </div>
              <div class="text-xs font-light text-gray-400">{{ticket.created_at}}</div>
            </div>
          </div>
        </div>
        <div class="text-md mt-5">{{ticket.content}}</div>
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
      

    </client-layout>
</template>

<script>
    import ClientLayout from '@/Layouts/ClientLayout'
    import Editor from '@tinymce/tinymce-vue'

    export default {
      props: {
        ticket: Object,
        user: Object,
        comments: Array,
        tinymce_app_key: String,
      },
      data() {
            return {
                tinymceKEY: this.tinymce_app_key,
                commentsData: this.comments,
                errorEditor: '',
            }
        },

      components: {
          ClientLayout,
          'editor': Editor
      },

      methods: {
        submit() {

          let content = tinymce.get("contentEditor").getContent();
          let token  = document.querySelector('meta[name="csrf-token"]').content;

          if(content != ''){

            axios.post(route('client.comment.store'), {
              content: content,
              ticket_id: this.ticket.id,
              _token: token
            })
            .then((response) => {
              this.commentsData.push(response.data);
              tinymce.get("contentEditor").setContent('');
            }, (error) => {
              this.errorEditor = "Something went wrong. Please try later.";
              console.log(error);
            });
          }else{
            this.errorEditor = "Ticket message can't be empty.";
          }

        },
      }
 
    }
</script>
