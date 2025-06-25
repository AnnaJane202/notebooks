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
            paramGroup: {}
        }
    },

    methods: {
        storeParamGroup() {
            axios.post(route('admin.param-groups.store'), this.paramGroup)
                .then( res => {
                    console.log(res);
                    this.paramGroup = {};
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
            <Link :href="route('admin.param-groups.index')" class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">Назад</Link>
        </div>
        <div class="mb-4">
            <input type="text" v-model="paramGroup.title" class="border border-gray-200 p-2 w-1/4" placeholder="Заголовок">
        </div>
        <div class="mb-4">
            <a href="#" @click.prevent="storeParamGroup" class="inline-block py-2 px-3 bg-indigo-600 border border-indigo-700 text-white">Создать</a>
        </div>
    </div>
</template>

<style scoped>

</style>
