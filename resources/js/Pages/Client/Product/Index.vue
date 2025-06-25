<script>

import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";
import ProductItem from "@/Components/Client/Product/ProductItem.vue";
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
            }
        },

        components: {
            Link,
            ProductItem,
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
    <div class=" bg-pink-700 p-4 text-white">
        <div class="flex place-content-around ">
            <Link v-for="category in categories" :href="route('client.categories.products.index', category.id)" class="inline">{{ category.title }}</Link>
        </div>
    </div>

    <div class="container mx-auto">
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
                                <div class="">
                                    {{ this.filters.checkbox[param.id] }}
                                </div>
                                <div>
                                    <div v-for="value in param.param_values" class="mb-2 flex items-center">
                                        <input @change="setFilter(param, value)" class="mr-2 border border-gray-300 rounded-sm" type="checkbox" :value="value" :id="value">
                                        <label :for="value">{{ value }}</label>
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
                                        <select v-model="filters.select[param.id]" class="w-4/5 border rounded-sm border-gray-200 p-2 mr-3">
                                            <option v-for="value in param.param_values" :value="value">{{ value }} {{ param.unit }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div v-if="param.label === '3'" class="mb-4 ml-5 pb-4 border-b border-gray-300">
                                <input @change="setFilterPopular(param, param.value)" class="mr-2 border border-gray-300 rounded-sm" type="checkbox" :value="param.value" :id="param.value">
                                <label :for="param.value">{{ param.title }}</label>
                            </div>

                        </template>

                        <div>
                            <a @click.prevent="getPosts" href="#" class="block text-center px-3 py-2 text-gray-300 bg-pink-700 border border-indigo-900">
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

    #title {
       height: 85px;
    }
</style>
