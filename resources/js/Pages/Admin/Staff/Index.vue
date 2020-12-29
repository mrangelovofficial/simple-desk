<template>
    <admin-layout>
      <div class="flex flex-row-reverse mb-4">
        <jet-button-link :href="route('admin.staff.create')">
          Create Employee
        </jet-button-link>
      </div>
      <div class="flex flex-wrap">
        <div v-for="person in staff" :key="person.id" class="box-border px-5 w-1/3 flex-none my-4">
                <div class=" bg-white shadow-lg rounded-lg overflow-hidden">
                    <img class="w-full h-56 object-cover object-center" :src="person.profile_photo_url" alt="avatar">
                    <div class="py-4 px-6">
                        <h1 class="text-2xl font-semibold text-gray-800">{{person.name}}</h1>
                        <p v-if="person.is_superadmin" class="py-2 text-lg text-gray-700">SuperAdmin</p>
                        <p v-else class="py-2 text-lg text-gray-700">Employee</p>
                    </div>
                </div>
            </div>        
      </div>
              
    </admin-layout>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout'
    import JetButtonLink from '@/Jetstream/ButtonLink'

    export default {
      props: ['staff'],

      components: {
          AdminLayout,
          JetButtonLink
      },
    }
</script>
