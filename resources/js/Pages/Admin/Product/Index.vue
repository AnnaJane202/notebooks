<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";
export default {
    name: 'Index',

    props: {
        products: Array
    },

    data() {
        return {

            productsData: this.products
        }
    },

    layout: AdminLayout,

    components: {
        Link
    },


}
</script>

<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.products.create')" class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">Добавить</Link>
        </div>
        <div>
            <table class="border-collapse border border-gray-500 table-auto w-full text-sm">
                <thead class="bg-white dark:bg-slate-900">
                <tr>
                    <th class="text-center border-b dark:border-slate-600 font-medium p-4 pl-8 pb-3 text-slate-400 dark:text-slate-200">ID</th>
                    <th class="text-center border-b dark:border-slate-600 font-medium p-4 pl-8 pb-3 text-slate-400 dark:text-slate-200">Заголовок</th>
                    <th class="text-center border-b dark:border-slate-600 font-medium p-4 pl-8 pb-3 text-slate-400 dark:text-slate-200">Цена</th>
                    <th class="text-center border-b dark:border-slate-600 font-medium p-4 pl-8 pb-3 text-slate-400 dark:text-slate-200">Действие</th>


                </tr>
                </thead>
                <tbody class="bg-white">
                <template v-for="product in productsData">
                    <tr class="dark:bg-slate-700">
                        <td class="text-center border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ product.id }}</td>
                        <td class="text-center border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400"><Link :href="route('admin.products.show', product.id)">{{ product.title }}</Link></td>
                        <td class="text-center border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ product.price }}</td>
                        <td class="text-center border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                            <div class="flex items-center justify-center">
<!--                                <Link v-if="!product.parent_id" :href="route('admin.products.replicate', product.id)" method="post" class="mr-2">-->
<!--                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 cursor-pointer">-->
<!--                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />-->
<!--                                    </svg>-->
<!--                                </Link>-->
                                <Link :href="route('admin.products.edit', product.id)" class="mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" text-emerald-600 size-4 cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </Link>


                                <svg @click.prevent="deleteProduct(product)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-red-600 size-4 cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </div>

                        </td>
                    </tr>

                </template>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style scoped>

</style>
