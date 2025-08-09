<script>

import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";
import ProductItem from "@/Components/Client/Product/ProductItem.vue";
import {Head} from "@inertiajs/vue3";
import { ref } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
    export default {
        name: 'Index',
        layout: MainLayout,

        props: {
            categories: Array,
            products: Array,
            params: Array,
            ct: Number,
        },

        data() {
            return {
                productsData: this.products,
                filters: {
                    integer: {
                        from: {},
                        to: {},
                    },
                    select: {},
                    checkbox: {},
                    popular: [],
                },
                open: false,
                filter: false,
            }
        },

        components: {
            Link,
            ProductItem,
            Head,
            ref,
            Dialog,
            DialogPanel,
            DialogTitle,
            TransitionChild,
            TransitionRoot,

        },

        methods: {
            setFilter(param, value) {
                if (this.filters.checkbox[param.id]) {
                    this.toggleItem(this.filters.checkbox[param.id], value);
                    return;
                }
                this.filters.checkbox[param.id] = [];
                this.filters.checkbox[param.id].push(value);

            },
            setFilterPopular(param) {
                if (this.filters.popular.includes(param.id)) {
                    this.filters.popular = this.filters.popular.filter(elem => {
                        return elem !== param.id;
                    });
                } else {
                    this.filters.popular.push(param.id);
                }


            },

            toggleItem(arr, value) {
                let index = arr.indexOf(value);

                index === -1 ? arr.push(value) : arr.splice(index, 1);
            },

            getPosts() {
                this.clean(this.filters.integer.from);
                this.clean(this.filters.integer.to);
                console.log(this.filters);
                axios.get(route('client.products.index'), {

                    params: this.filters

                })
                    .then( res => {
                        console.log(res.data);
                        this.productsData = res.data;
                    })
            },

            clean(obj) {
                Object.keys(obj).forEach( key => {
                    if (!obj[key]) {
                        delete obj[key];
                    }

                })
            },
        },
    }
</script>

<template>
    <Head>
        <title>Каталог</title>
    </Head>
    <div class="hidden md:block bg-pink-700 p-4 text-white">
        <div class="flex place-content-around">
            <Link v-for="category in categories" :href="route('client.categories.products.index', category.id)" class="inline hover:scale-125 transition-transform duration-300 ease-in-out">{{ category.title }}</Link>
        </div>
    </div>

    <div class="md:hidden flex justify-between p-2">
        <div @click="open = true" >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-9 text-pink-600 cursor-pointer hover:text-pink-800">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </div>
        <div @click="filter = true" class="">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-9 text-pink-600 cursor-pointer hover:text-pink-800">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
            </svg>
        </div>
    </div>



    <div>
        <TransitionRoot as="template" :show="open">
            <Dialog class="relative z-10" @close="open = true">
                <TransitionChild as="template" enter="ease-in-out duration-500" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-500" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-500/75 transition-opacity" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-hidden">
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                            <TransitionChild as="template" enter="transform transition ease-in-out duration-500 sm:duration-700" enter-from="translate-x-full" enter-to="translate-x-0" leave="transform transition ease-in-out duration-500 sm:duration-700" leave-from="translate-x-0" leave-to="translate-x-full">
                                <DialogPanel class="pointer-events-auto relative w-screen max-w-md">
                                    <TransitionChild as="template"  enter="ease-in-out duration-500" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-500" leave-from="opacity-100" leave-to="opacity-0">
                                        <div class="absolute top-0 left-0 -ml-8 flex pt-4 pr-2 sm:-ml-10 sm:pr-4">
                                            <button type="button" class="relative rounded-md  text-gray-300 hover:text-white focus-visible:ring-2 focus-visible:ring-white focus-visible:outline-hidden" @click="open = false">
                                                <span class="absolute -inset-2.5" />
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>


                                            </button>
                                        </div>
                                    </TransitionChild>
                                    <div class="flex h-full flex-col overflow-y-auto bg-white py-6 shadow-xl">
                                        <div class="px-4 sm:px-6">
                                            <DialogTitle class="text-base font-semibold text-gray-900">Меню</DialogTitle>
                                        </div>
                                        <div class="relative mt-6 flex-1 px-4 sm:px-6">
                                            <div class=" p-4">
                                                <div class="flex flex-col place-content-around" >
                                                    <Link v-for="category in categories"  :href="route('client.categories.products.index', category.id)" class="inline text-lg md:text-xl border-b border-b-pink-200 hover:text-pink-600 p-5">{{ category.title }}</Link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>

    <div>
        <TransitionRoot as="template" :show="filter">
            <Dialog class="relative z-10" @close="filter = true">
                <TransitionChild as="template" enter="ease-in-out duration-500" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-500" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-500/75 transition-opacity" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-hidden">
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                            <TransitionChild as="template" enter="transform transition ease-in-out duration-500 sm:duration-700" enter-from="translate-x-full" enter-to="translate-x-0" leave="transform transition ease-in-out duration-500 sm:duration-700" leave-from="translate-x-0" leave-to="translate-x-full">
                                <DialogPanel class="pointer-events-auto relative w-screen max-w-md">
                                    <TransitionChild as="template"  enter="ease-in-out duration-500" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-500" leave-from="opacity-100" leave-to="opacity-0">
                                        <div class="absolute top-0 left-0 -ml-8 flex pt-4 pr-2 sm:-ml-10 sm:pr-4">
                                            <button type="button" class="relative rounded-md  text-gray-300 hover:text-white focus-visible:ring-2 focus-visible:ring-white focus-visible:outline-hidden" @click="filter = false">
                                                <span class="absolute -inset-2.5" />
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>


                                            </button>
                                        </div>
                                    </TransitionChild>
                                    <div class="flex h-full flex-col overflow-y-auto bg-white py-6 shadow-xl">
                                        <div class="px-4 sm:px-6">
                                            <DialogTitle class="text-base font-semibold text-gray-900">Меню</DialogTitle>
                                        </div>
                                        <div class="relative mt-6 flex-1 px-4 sm:px-6">
                                            <div class=" p-4">
                                                <div class="" >
                                                    <div class="lg:w-1/4  lg:block">
                                                        <div class="bg-white rounded-lg shadow-md p-4 sticky top-4">
                                                            <h2 class="text-lg font-semibold mb-4">Фильтры</h2>
                                                            <div class="">
                                                                <template v-for="param in params">
                                                                    <div v-if="param.filter_type === 3 && param.label !== '3'" class="mb-4 ml-5 pb-4 border-b border-gray-300">
                                                                        <div>
                                                                            <h3 class="mb-2 font-bold">{{ param.title }}</h3>
                                                                            <!--                                    <p>{{ param.label }}</p>-->
                                                                        </div>
                                                                        <!--                                <div class="">-->
                                                                        <!--                                    {{ this.filters.checkbox[param.id] }}-->
                                                                        <!--                                </div>-->
                                                                        <div>
                                                                            <div v-for="value in param.param_values" class="mb-2 flex items-center ">
                                                                                <input @change="setFilter(param, value)" class="mr-2 border border-gray-300 rounded-sm cursor-pointer hover:border-indigo-600" type="checkbox" :value="value" :id="value">
                                                                                <label :for="value" class="cursor-pointer hover:text-indigo-600">{{ value }}</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--                            <div v-if="param.filter_type === 1 && param.label !== '3'" class="mb-4 ml-5 pb-4 border-b border-gray-300">-->
                                                                    <!--                                <div>-->
                                                                    <!--                                    <h3 class="mb-2 font-bold">{{ param.title }}</h3>-->
                                                                    <!--                                </div>-->
                                                                    <!--                                <div>-->
                                                                    <!--                                    <div class="mb-2 flex items-center">-->
                                                                    <!--                                        <input v-model="filters.integer.from[param.id]" type="text" placeholder="От" class="w-1/3 border border-gray-300 p-2 mr-3">-->
                                                                    <!--                                        <input v-model="filters.integer.to[param.id]" type="text" placeholder="До" class="w-1/3 border border-gray-300 p-2">-->
                                                                    <!--                                    </div>-->
                                                                    <!--                                </div>-->
                                                                    <!--                            </div>-->
                                                                    <div v-if="param.filter_type === 2 && param.label !== '3'" class="mb-4 ml-5 pb-4 border-b border-gray-300">
                                                                        <div>
                                                                            <h3 class="mb-2 font-bold">{{ param.title }}</h3>
                                                                        </div>
                                                                        <div>
                                                                            <div class="mb-2 flex items-center">
                                                                                <select v-model="filters.select[param.id]" class="w-4/5 border rounded-sm border-gray-200 p-2 mr-3 cursor-pointer">
                                                                                    <option v-for="value in param.param_values" :value="value">{{ value }} {{ param.unit }}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div v-if="param.label === '3'" class="mb-4 ml-5 pb-4 border-b">
                                                                        <input @change="setFilterPopular(param, param.value)" class="mr-2 border border-gray-300 rounded-sm cursor-pointer hover:border-indigo-600" type="checkbox" :value="param.value" :id="param.value">
                                                                        <label :for="param.value" class="cursor-pointer hover:text-indigo-600">{{ param.title }}</label>
                                                                    </div>

                                                                </template>

                                                                <div>
                                                                    <a @click.prevent="getPosts" href="#" class="block text-center px-3 py-2 text-gray-300 bg-pink-700 border border-pink-700 hover:bg-pink-500">
                                                                        Фильтр
                                                                    </a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>


    <main class="flex-grow container mx-auto p-4">
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Основной контент с товарами (3/4 ширины) -->
            <div class="w-full lg:w-3/4">
                <h2 class="text-xl font-semibold mb-4">Наши товары</h2>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <!-- Товар 1 -->
                    <ProductItem v-for="product in productsData" :product="product"></ProductItem>
                </div>
            </div>

            <!-- Фильтры (1/4 ширины, скрыт на маленьких экранах) -->
            <div class="lg:w-1/4 hidden lg:block">
                <div class="bg-white rounded-lg shadow-md p-4 sticky top-4">
                    <h2 class="text-lg font-semibold mb-4">Фильтры</h2>
                    <div class="">
                        <template v-for="param in params">
                            <div v-if="param.filter_type === 3 && param.label !== '3'" class="mb-4 ml-5 pb-4 border-b border-gray-300">
                                <div>
                                    <h3 class="mb-2 font-bold">{{ param.title }}</h3>
                                    <!--                                    <p>{{ param.label }}</p>-->
                                </div>
                                <!--                                <div class="">-->
                                <!--                                    {{ this.filters.checkbox[param.id] }}-->
                                <!--                                </div>-->
                                <div>
                                    <div v-for="value in param.param_values" class="mb-2 flex items-center ">
                                        <input @change="setFilter(param, value)" class="mr-2 border border-gray-300 rounded-sm cursor-pointer hover:border-indigo-600" type="checkbox" :value="value" :id="value">
                                        <label :for="value" class="cursor-pointer hover:text-indigo-600">{{ value }}</label>
                                    </div>
                                </div>
                            </div>
<!--                            <div v-if="param.filter_type === 1 && param.label !== '3'" class="mb-4 ml-5 pb-4 border-b border-gray-300">-->
<!--                                <div>-->
<!--                                    <h3 class="mb-2 font-bold">{{ param.title }}</h3>-->
<!--                                </div>-->
<!--                                <div>-->
<!--                                    <div class="mb-2 flex items-center">-->
<!--                                        <input v-model="filters.integer.from[param.id]" type="text" placeholder="От" class="w-1/3 border border-gray-300 p-2 mr-3">-->
<!--                                        <input v-model="filters.integer.to[param.id]" type="text" placeholder="До" class="w-1/3 border border-gray-300 p-2">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            <div v-if="param.filter_type === 2 && param.label !== '3'" class="mb-4 ml-5 pb-4 border-b border-gray-300">
                                <div>
                                    <h3 class="mb-2 font-bold">{{ param.title }}</h3>
                                </div>
                                <div>
                                    <div class="mb-2 flex items-center">
                                        <select v-model="filters.select[param.id]" class="w-4/5 border rounded-sm border-gray-200 p-2 mr-3 cursor-pointer">
                                            <option v-for="value in param.param_values" :value="value">{{ value }} {{ param.unit }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div v-if="param.label === '3'" class="mb-4 ml-5 pb-4 border-b">
                                <input @change="setFilterPopular(param, param.value)" class="mr-2 border border-gray-300 rounded-sm cursor-pointer hover:border-indigo-600" type="checkbox" :value="param.value" :id="param.value">
                                <label :for="param.value" class="cursor-pointer hover:text-indigo-600">{{ param.title }}</label>
                            </div>

                        </template>

                        <div>
                            <a @click.prevent="getPosts" href="#" class="block text-center px-3 py-2 text-gray-300 bg-pink-700 border border-pink-700 hover:bg-pink-500">
                                Фильтр
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>


    <div class="hidden container mx-auto">
        <div class="flex">
            <article class=" w-3/4 bg-gray-50 p-4">
                <div class="grid grid-cols-4 gap-4">
                    <ProductItem v-for="product in productsData" :product="product"></ProductItem>
                </div>
            </article>
            <aside class="w-1/4 min-h-screen bg-white border border-l-gray-100">
                <nav>
                    <div class="p-5">
                        <template v-for="param in params">
                            <div v-if="param.filter_type === 3 && param.label !== '3'" class="mb-4 ml-5 pb-4 border-b border-gray-300">
                                <div>
                                    <h3 class="mb-2 font-bold">{{ param.title }}</h3>
                                    <!--                                    <p>{{ param.label }}</p>-->
                                </div>
<!--                                <div class="">-->
<!--                                    {{ this.filters.checkbox[param.id] }}-->
<!--                                </div>-->
                                <div>
                                    <div v-for="value in param.param_values" class="mb-2 flex items-center ">
                                        <input @change="setFilter(param, value)" class="mr-2 border border-gray-300 rounded-sm cursor-pointer hover:border-indigo-600" type="checkbox" :value="value" :id="value">
                                        <label :for="value" class="cursor-pointer hover:text-indigo-600">{{ value }}</label>
                                    </div>
                                </div>
                            </div>
                            <div v-if="param.filter_type === 1 && param.label !== '3'" class="mb-4 ml-5 pb-4 border-b border-gray-300">
                                <div>
                                    <h3 class="mb-2 font-bold">{{ param.title }}</h3>
                                </div>
                                <div>
                                    <div class="mb-2 flex items-center">
                                        <input v-model="filters.integer.from[param.id]" type="text" placeholder="От" class="w-1/3 border border-gray-300 p-2 mr-3">
                                        <input v-model="filters.integer.to[param.id]" type="text" placeholder="До" class="w-1/3 border border-gray-300 p-2">
                                    </div>
                                </div>
                            </div>
                            <div v-if="param.filter_type === 2 && param.label !== '3'" class="mb-4 ml-5 pb-4 border-b border-gray-300">
                                <div>
                                    <h3 class="mb-2 font-bold">{{ param.title }}</h3>
                                </div>
                                <div>
                                    <div class="mb-2 flex items-center">
                                        <select v-model="filters.select[param.id]" class="w-4/5 border rounded-sm border-gray-200 p-2 mr-3 cursor-pointer">
                                            <option v-for="value in param.param_values" :value="value">{{ value }} {{ param.unit }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div v-if="param.label === '3'" class="mb-4 ml-5 pb-4 border-b">
                                <input @change="setFilterPopular(param, param.value)" class="mr-2 border border-gray-300 rounded-sm cursor-pointer hover:border-indigo-600" type="checkbox" :value="param.value" :id="param.value">
                                <label :for="param.value" class="cursor-pointer hover:text-indigo-600">{{ param.title }}</label>
                            </div>

                        </template>

                        <div>
                            <a @click.prevent="getPosts" href="#" class="block text-center px-3 py-2 text-gray-300 bg-pink-700 border border-pink-700 hover:bg-pink-500">
                                Фильтр
                            </a>
                        </div>
                    </div>
                </nav>
            </aside>
        </div>
    </div>


</template>

<style scoped>


</style>
