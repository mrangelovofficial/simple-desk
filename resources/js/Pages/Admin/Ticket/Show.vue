<template>
    <admin-layout :contentClasses="'py-0 px-10 '">
      <div class="flex bg-white py-7">
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

      <div id="ticketDescription" class="shadow-lg py-5 px-4 mb-10 rounded-md">
        <div class="flex justify-between">
          <div class="flex items-center">
            <div class="relative w-15 h-15 mr-3">
              <img
                class="object-cover w-full h-full rounded-md"
                :src="ticket.user.profile_photo_url"
                alt=""
                loading="lazy"/>
            </div>
            <div class="text-md font-semibold text-gray-900">
              {{ticket.user.name}}
              <div class="text-xs font-light text-gray-400">{{ticket.created_at}}</div>
            </div>
          </div>
        </div>
        <div class="text-md mt-5">Hi Bob,<br><br>

With resrpect, i must disagree with Mr.Zinsser. We all know the most part of important part of any article is the title.Without a compelleing title, your reader won't even get to the first sentence.After the title, however, the first few sentences of your article are certainly the most important part.

Jornalists call this critical, introductory section the "Lede," and when bridge properly executed, it's the that carries your reader from an headine try at attention-grabbing to the body of your blog post, if you want to get it right on of these 10 clever ways to omen your next blog posr with a bang

<br><br>Best regards,<br>

<br>Jason Muller</div>
      </div>
      
      <div v-for="comment in comments" :key="comment.id" class="shadow-md bg-gray-50 mt-10 py-5 px-4 rounded-md">
        <div class="flex justify-between">
          <div class="flex items-center">
            <div class="relative w-15 h-15 mr-3">
              <img
                class="object-cover w-full h-full rounded-md"
                :src="comment.user.profile_photo_url"
                alt=""
                loading="lazy"/>
            </div>
            <div class="text-md font-semibold text-gray-900">
              {{comment.user.name}}
              <div class="text-xs font-light text-gray-400">{{comment.created_at}}</div>
            </div>
          </div>
        </div>
        <div class="text-md mt-5">{{comment.content}}</div>
      </div>          
             

    </admin-layout>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout'

    export default {
      props: {
        comments: Array,
        ticket: Object,
      },

      components: {
          AdminLayout,
      },
 
    }
</script>
