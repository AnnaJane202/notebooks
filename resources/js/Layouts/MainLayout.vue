<script>

import {Link} from "@inertiajs/vue3";
import {Head} from "@inertiajs/vue3";
import { ref } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'

export default {
    name: 'MainLayout',

    components: {
        Link,
        Head,
        ref,
        Dialog,
        DialogPanel,
        DialogTitle,
        TransitionChild,
        TransitionRoot,
    },

    props: {
        // count: {}
    },

    data() {
      return {
        count: null,
        open: false,

      }
    },

    methods: {
        getCarts() {
            // axios.get(route('client.index.count'))
            //     .then ( res => {
            //         // console.log(res.data.counter);
            //         // this.count = res.data.counter;
            //
            //         console.log(this.$page.props.ct);
            //
            //     })
        },

    },

    mounted() {
        this.getCarts();
    }

}
</script>

<template>
    <body class="flex flex-col min-h-screen">
    <section class="w-full border-b border-gray-100 p-4">
        <header class="w-3/4 mx-auto flex justify-between">
            <div>
                <div class="">
                    <Link :href="route('client.products.index')">
                        <h1>Notebooks</h1>
                    </Link>
                </div>



            </div>
            <div>
                <Link :href="route('client.carts.index')" class="flex">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hover:scale-125 transition-transform duration-300 ease-in-out">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />

                    </svg>
                    <sup class="text-red-600 font-semibold">{{ this.$page.props.ct }}</sup>
                </Link>
            </div>

        </header>



    </section>
    <section class="">
        <slot/>
    </section>

        <footer class="bg-gray-500 text-white p-4 mt-auto">
            <div class="container mx-auto">

                <div class="container mx-auto">
                    <div class="text-center">
                        <p>© 2025 Ноутбуки. Анна Тютина.</p>
                    </div>
                </div>


            </div>
        </footer>

    </body>
</template>

<style scoped>

</style>
