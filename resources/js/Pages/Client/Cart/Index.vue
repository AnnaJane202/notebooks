<script>

import {Link} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import StoreOrUpdateCart from "@/Components/Client/Cart/StoreOrUpdateCart.vue";
import {Head} from "@inertiajs/vue3";

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
                modal2: false,
            }
        },

        computed: {
            total: function() {
                return this.cartsData.reduce((acc, curr) => acc + curr.total_sum, 0);
            },
            totalQty: function() {
                return this.cartsData.reduce((sum, item) => sum + item.qty, 0);
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
                if(this.total !== 0){
                    this.modal = true;
                }else {
                    this.modal2 = true;
                }
            },

            closeModal() {
                this.modal = false;
                this.modal2 = false;
            },

        },



        components: {
            StoreOrUpdateCart,
            Link,
            Head,
        }
    }
</script>

<template>

    <Head>
        <title>Корзина</title>
    </Head>

    <body class="bg-gray-100 min-h-screen py-8 px-4">
    <div class="container mx-auto max-w-6xl">
        <h1 class="text-2xl md:text-3xl font-bold mb-8">Корзина</h1>

        <div class="text-xs md:text-base flex flex-col lg:flex-row gap-6">
            <!-- Блок с товарами -->
            <div class="lg:w-2/3 bg-white rounded-lg shadow-md p-4 md:p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
<!--                        <thead class="border-b">-->
<!--                        <tr class="text-left text-gray-500">-->
<!--                            <th class="pb-3 w-8"><input type="checkbox" class="rounded text-blue-500"></th>-->
<!--                            <th class="pb-3">Товар</th>-->
<!--                            <th class="pb-3 text-right">Количество</th>-->
<!--                            <th class="pb-3 text-right">Стоимость</th>-->
<!--                            <th class="pb-3 w-10"></th>-->
<!--                        </tr>-->
<!--                        </thead>-->
                        <tbody>
                        <!-- Товар 1 -->
                        <tr v-for="cart in cartsData"  class="border-b hover:bg-gray-50">
<!--                            <td class="py-4"><input type="checkbox" class="rounded text-blue-500" checked></td>-->
                            <td class="py-4">
                                <div class="flex items-center">
                                    <div class="w-16 h-16  rounded-md overflow-hidden mr-4">
<!--                                        <img src="https://via.placeholder.com/100" alt="Товар" class="w-full h-full object-cover">-->
                                        <div class="w-full h-full object-cover">
                                            <img class="" :src="cart.product_image_url" :alt="cart.product_title">
                                        </div>

                                    </div>
                                    <div>
                                        <h3 class="font-medium">
                                            <Link :href="route('client.products.show', cart.product_id)">{{ cart.product_title }}</Link>
                                        </h3>
<!--                                        <p class="text-gray-500 text-sm">Черный, 128 ГБ</p>-->
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 ">
                                <div class="flex justify-end items-center">
                                    <button class="text-gray-500 hover:text-gray-700 p-1">
<!--                                        <i class="fas fa-minus"></i>-->
                                        <svg @click.prevent="cart.qty > 1 ? cart.qty-- : ''; updateCartMinus(cart)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 md:size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>

                                    </button>
<!--                                    <span class="mx-2   text-center">-->
<!--                                        <input min="1" class="w-3/4  border border-white pl-6 text-gray-400" type="number" v-model="cart.qty" disabled>-->
<!--                                    </span>-->
                                    <input type="number" value="2" min="1" v-model="cart.qty" class="w-10 text-center border rounded mx-1 py-1" disabled>
                                    <button @click.prevent="cart.qty++; updateCartPlus(cart)" class="text-gray-500 hover:text-gray-700 p-1">
<!--                                        <i class="fas fa-plus"></i>-->
                                        <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 md:size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Мобильная версия - цена и корзина -->
                                <div class="md:hidden flex items-center ml-9 mt-6">
                                    <span class="font-medium mr-4">{{ cart.total_sum }} р.</span>
                                    <svg @click="destroyCart(cart)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-red-600 size-4 cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </div>
                            </td>
<!--                            <td class="py-4 text-right font-medium">{{ cart.total_sum }}</td>-->
                            <td class="py-4 text-right hidden md:table-cell">
                                <span class="font-medium">{{ cart.total_sum }}</span>
                            </td>

                            <td class="py-4 text-right hidden md:table-cell">
                                <svg @click="destroyCart(cart)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-red-600 size-4 cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>

<!--                <div class="mt-6 flex flex-col sm:flex-row justify-between items-center">-->
<!--                    <button class="mb-3 sm:mb-0 px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md text-gray-700">-->
<!--                        <i class="fas fa-arrow-left mr-2"></i> Продолжить покупки-->
<!--                    </button>-->
<!--                    <button class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md text-gray-700">-->
<!--                        Удалить выбранные-->
<!--                    </button>-->
<!--                </div>-->
            </div>

            <!-- Блок с итоговой ценой -->
            <div class="lg:w-1/3 bg-white rounded-lg shadow-md p-6 h-fit sticky top-6">
                <h2 class="text-xl font-bold mb-4">Итого</h2>

                <div class="space-y-3 mb-6">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Товары ({{ totalQty }})</span>
                        <span class="font-medium">{{ total }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Скидка</span>
                        <span class="text-green-500">0</span>
                    </div>
                    <div class="flex justify-between border-t pt-3">
                        <span class="font-bold">Общая стоимость</span>
                        <span class="font-bold text-lg">{{ total }} ₽</span>
                    </div>
                </div>

                <button @click="order" class="w-full bg-pink-700 hover:bg-pink-600 text-white py-3 px-4 rounded-md font-medium transition duration-200">
                    Оформить заказ
                </button>

                <div v-if="modal" class="fixed z-10 inset-0 overflow-y-auto">
                    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 transition-opacity">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                        <div
                            class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-green-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        Отлично! Ваш заказ успешно оформлен! 🎉
                                    </h3>
                                    <div class="mt-2">
                                        <p class="text-sm leading-5 text-gray-500">
                                            Однако, хотим вас предупредить: поскольку этот сайт является учебным проектом, ваш заказ, к сожалению, не будет доставлен. 😔

                                            Мы надеемся, вам понравилось изучать возможности нашего сайта!

                                            Если вы хотите сделать реальный заказ и получить желаемые товары, приглашаем вас посетить интернет-магазин <a href="https://www.21vek.by/notebooks" class="text-sky-600">21vek.by</a> – здесь вы точно сможете заказать все, что вам нужно!
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                    <button @click="closeModal" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Понятно
                    </button>
                </span>
                            </div>
                        </div>
                    </div>
                </div>


                <div v-if="modal2" class="fixed z-10 inset-0 overflow-y-auto">
                    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 transition-opacity">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                        <div
                            class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-green-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        Ваша корзина пуста
                                    </h3>
                                    <div class="mt-2">
                                        <p class="text-sm leading-5 text-gray-500">
                                            Для того, чтобы оформить заказ, положите в корзину товар
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                    <button @click="closeModal" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Понятно
                    </button>
                </span>

                            </div>
                        </div>
                    </div>
                </div>



<!--                <p class="mt-4 text-sm text-gray-500 text-center">-->
<!--                    Нажимая на кнопку, вы соглашаетесь с условиями оферты-->
<!--                </p>-->
            </div>
        </div>
    </div>
    </body>












    <div class="hidden">
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
                            <a @click="order" class="block p-4 text-white text-center bg-pink-700 border border-pink-700 rounded cursor-pointer hover:bg-pink-600">Оформить заказ</a>

                            <div v-if="modal" class="fixed z-10 inset-0 overflow-y-auto">
                                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                    <div class="fixed inset-0 transition-opacity">
                                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                    </div>
                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                                    <div
                                        class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                                        <div class="sm:flex sm:items-start">
                                            <div
                                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                                <svg class="h-6 w-6 text-green-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                    Отлично! Ваш заказ успешно оформлен! 🎉
                                                </h3>
                                                <div class="mt-2">
                                                    <p class="text-sm leading-5 text-gray-500">
                                                        Однако, хотим вас предупредить: поскольку этот сайт является учебным проектом, ваш заказ, к сожалению, не будет доставлен. 😔

                                                        Мы надеемся, вам понравилось изучать возможности нашего сайта!

                                                        Если вы хотите сделать реальный заказ и получить желаемые товары, приглашаем вас посетить интернет-магазин <a href="https://www.21vek.by/notebooks" class="text-sky-600">21vek.by</a> – здесь вы точно сможете заказать все, что вам нужно!
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                    <button @click="closeModal" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Понятно
                    </button>
                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div v-if="modal2" class="fixed z-10 inset-0 overflow-y-auto">
                                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                    <div class="fixed inset-0 transition-opacity">
                                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                    </div>
                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                                    <div
                                        class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                                        <div class="sm:flex sm:items-start">
                                            <div
                                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                                <svg class="h-6 w-6 text-green-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                    Ваша корзина пуста
                                                </h3>
                                                <div class="mt-2">
                                                    <p class="text-sm leading-5 text-gray-500">
                                                        Для того, чтобы оформить заказ, положите в корзину товар
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                    <button @click="closeModal" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Понятно
                    </button>
                </span>

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
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type="number"] {
    -moz-appearance: textfield;
}
</style>
