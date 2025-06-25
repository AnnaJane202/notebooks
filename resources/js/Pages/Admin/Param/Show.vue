<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";
export default {
    name: 'Show',

    props: {
        param: Object,
        paramGroup: Object,
    },

    layout: AdminLayout,

    components: {
        Link
    }
}
</script>

<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.params.index')" class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">Назад</Link>
        </div>
        <div>
            <table class="border-collapse table-auto w-full text-sm">

                <tbody class="bg-white dark:bg-slate-700">
                <tr>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">ID</td>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ param.id }}</td>
                </tr>
                <tr>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">Заголовок</td>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ param.title }}</td>
                </tr>
                <tr>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">Тип фильтра</td>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ param.filter_type}}</td>
                </tr>
                <tr>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">Заголовок типа фильтра</td>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ param.filter_type_title }}</td>
                </tr>
                <tr>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">Группа характеристики</td>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ paramGroup.title }}</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</template>

<style scoped>

</style>
