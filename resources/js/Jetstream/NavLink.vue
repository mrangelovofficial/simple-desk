<template>
    <inertia-link :href="href" :class="classes">
         <span :class="classesSpan">
             <svg :class="classesSVG" svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve">
             <slot name="svg"></slot>
             </svg>
             <slot></slot>
         </span>
        
    </inertia-link>
</template>

<script>
    export default {
        props: ['href', 'active'],

        computed: {
            classes() {
                return this.active
                            ? 'flex justify-between items-center py-2 px-3 '
                            : 'flex justify-between items-center py-2 px-3 '
            },classesSpan() {
                return this.active
                            ? 'text-md text-gray-50 flex font-bold'
                            : 'text-md text-gray-500 flex font-bold'
            },classesSVG() {
                return this.active
                            ? 'h-5 mr-3 fill-current text-green-400'
                            : 'h-5 mr-3 fill-current text-gray-500'
            }

        }
    }
</script>
