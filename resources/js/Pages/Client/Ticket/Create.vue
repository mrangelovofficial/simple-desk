<template>
    <client-layout>
      <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
          <jet-form-section @submitted="createTicket">

        <template #form>

            <!-- Subject -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="subject" value="Subject" />
                <jet-input id="subject" type="text" class="mt-1 block w-full" v-model="form.subject" autocomplete="subject" />
                <jet-input-error :message="form.error('subject')" class="mt-2" />
            </div>
            <!-- Content -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="content" value="Content" />
                <textarea name="content" id="content" autocomplete="content" v-model="form.content" class="mt-1 block w-full"></textarea>
                <jet-input-error :message="form.error('content')" class="mt-2" />
            </div>


        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </jet-button>
        </template>
    </jet-form-section>
      </div>
    </client-layout>
</template>

<script>
    import ClientLayout from '@/Layouts/ClientLayout'
    import JetButtonLink from '@/Jetstream/ButtonLink'
     import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'


    export default {
      props: ['tickets','user'],

      components: {
          ClientLayout,
          JetButtonLink,
          JetActionMessage,
          JetButton,
          JetFormSection,
          JetInput,
          JetInputError,
          JetLabel,
          JetSecondaryButton,
      },

      data() {
            return {
                form: this.$inertia.form({
                    _method: 'POST',
                    subject: null,
                    content: null,
                }),
            }
        },

        methods: {
            createTicket() {

                this.form.post(route('client.ticket.store'), {
                    errorBag: 'createTicket',
                    preserveScroll: true
                });
            },

        },
    }
</script>
