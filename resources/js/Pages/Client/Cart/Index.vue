<script>

import {Link} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import StoreOrUpdateCart from "@/Components/Client/Cart/StoreOrUpdateCart.vue";

    export default {
        name: 'Index',
        layout:MainLayout,

        props: {
            carts: Array,
            ct: Number,
        },

        data() {
            return {
                cartsData: this.carts,
                modal: false,
            }
        },

        computed: {
            total: function() {
                return this.cartsData.reduce((acc, curr) => acc + curr.total_sum, 0);
            }
        },

        methods: {

            updateCartMinus(cart) {
                axios.patch(route('client.carts.update', cart.id), {qty: cart.qty, action: 'minus'})
                    .then( res => {
                        cart.total_sum = res.data.cart.total_sum;
                        this.$page.props.ct = res.data.ct;
                        // this.$page.props.auth.user.carts_total_sum = res.data.carts_total_sum;
                        console.log(res);

                    })
            },
            updateCartPlus(cart) {
                axios.patch(route('client.carts.update', cart.id), {qty: cart.qty, action: 'plus'})
                    .then( res => {
                        cart.total_sum = res.data.cart.total_sum;
                        this.$page.props.ct = res.data.ct;

                    })
            },

            destroyCart(cart)
            {
                axios.delete(route('client.carts.destroy', cart.id))
                    .then( res => {
                        this.cartsData =this.cartsData.filter(cartData => cartData.id !== cart.id);
                        this.$page.props.ct = res.data.ct;
                    })
            },

            order() {
               this.modal = true;
            },

            closeModal() {
                this.modal = false;
            },

        },



        components: {
            StoreOrUpdateCart,
            Link,
        }
    }
</script>

<template>
    <div>
        <article class="w-full bg-white p-4 min-h-screen">
            <div class="w-3/4 mx-auto">
                <div class="mb-4">


                    <div class="flex">
                        <table class="border-collapse table-auto  text-sm w-3/4 mr-9">
                            <tbody class="bg-white">
                                <tr v-for="cart in cartsData">
                                    <td class="p-4 pl-8">
                                        <img class="w-24" :src="cart.product_image_url" :alt="cart.product_title">
                                    </td>
                                    <td class="p-4 pl-8">
                                        <Link :href="route('client.products.show', cart.product_id)">{{ cart.product_title }}</Link>
                                    </td>

                                    <td class="p-4 pl-8 text-slate-500">
                                        <div class="flex">
                                            <a @click.prevent="cart.qty > 1 ? cart.qty-- : ''; updateCartMinus(cart)" href="#" class="inline-block px-4 py-2 bg-white border border-gray-200 rounded-full">-</a>
                                            <input min="1" class="w-2/3 text-center border border-white pl-6" type="number" v-model="cart.qty" disabled>
                                            <a @click.prevent="cart.qty++; updateCartPlus(cart)" href="#" class="inline-block px-4 py-2 bg-white border border-gray-200 rounded-full">+</a>
                                        </div>
                                    </td>
                                    <td class="p-4 pl-8 text-slate-500">{{ cart.total_sum }}</td>
                                    <td class="p-4 pl-8 text-slate-500">
                                        <svg @click="destroyCart(cart)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-red-600 size-4 cursor-pointer">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </td>
                                </tr>
                            </tbody>

                        </table>

                        <div class="p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow-md w-1/4">
                            <div class="flex mb-7">
                                <p class="text-2xl font-bold mb-3 text-left mr-5">Итого:</p>
                                <p class="text-2xl font-bold mb-3 text-right">{{ total }}<span class="text-xl">р.</span></p>
                            </div>
                            <a @click="order" class="block p-4 text-white text-center bg-pink-700 border border-pink-700 rounded cursor-pointer">Оформить заказ</a>

                            <div v-if="modal" class="relative">
                            <!-- Main modal -->
                            <div v-if="modal" tabindex="-1" aria-hidden="true" class="overflow-y-auto text-white overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-blue-500 rounded-lg shadow-sm ">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                            <h3 class="text-xl font-semibold text-white">
                                                Отлично! Ваш заказ успешно оформлен!
                                            </h3>
                                            <button @click="closeModal" type="button" class=" bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5 space-y-4">
                                            <p class="text-base leading-relaxed text-white">
                                                Однако, хотим вас предупредить: поскольку этот сайт является учебным проектом, ваш заказ, к сожалению, не будет доставлен.
                                                Мы надеемся, вам понравилось изучать возможности нашего сайта!
                                                Если вы хотите сделать реальный заказ и получить желаемые товары, приглашаем вас посетить интернет-магазин 21vek.by: 21vek.by – здесь вы точно сможете заказать все, что вам нужно!
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            </div>








                        </div>
                    </div>


                </div>
            </div>

        </article>
    </div>
</template>

<style scoped>

</style>
