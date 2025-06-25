<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";
export default {
    name: 'Create',

    props: {
        // categories: Array
    },

    data() {
        return {
            category: {}
        }
    },

    methods: {
        storeCategory() {
            axios.post(route('admin.categories.store'), this.category)
                .then( res => {
                    console.log(res);
                    this.category = {};
                });
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
            <Link :href="route('admin.categories.index')" class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">Назад</Link>
        </div>
        <div class="mb-4">
            <input type="text" v-model="category.title" class="border border-gray-200 p-2 w-1/4" placeholder="Заголовок">
        </div>
        <div class="mb-4">
            <a href="#" @click.prevent="storeCategory" class="inline-block py-2 px-3 bg-indigo-600 border border-indigo-700 text-white">Создать</a>
        </div>
    </div>
</template>

<style scoped>

</style>
