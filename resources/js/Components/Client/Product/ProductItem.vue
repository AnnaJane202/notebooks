<script>

import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";
import StoreOrUpdateCart from "@/Components/Client/Cart/StoreOrUpdateCart.vue";
export default {
    name: 'ProductItem',

    props: {
        product: Object,
    },
    components: {
        Link,
        StoreOrUpdateCart
    }

}
</script>

<template>
    <div class="p-4 border border-gray-200 bg-white">
        <div class="h-52"><img :src="product.preview_image_url" :alt="product.title" class="mb-5"></div>

        <div class="flex items-center justify-between">
            <p class="text-xl font-bold mb-5">{{ product.price }}</p>
            <p class="text-gray-400 line-through mb-5">{{ product.old_price }}</p>
        </div>
        <!--                <Link :href="route('client.products.show', product.id)"><h3>{{ product.title }}</h3></Link>-->
        <div class="mb-5" id="title">
<!--            <h3 class="text-base mb-5">{{ product.title }}</h3>-->
            <Link :href="route('client.products.show', product.id)"><h3>{{ product.title }}</h3></Link>
        </div>

        <div>
<!--            <a href="#" class="block p-4 text-white text-center bg-pink-700">В корзину</a>-->
            <StoreOrUpdateCart :product="product"></StoreOrUpdateCart>
        </div>

<!--        <StoreOrUpdateCart :product="product"></StoreOrUpdateCart>-->
    </div>
</template>

<style scoped>

</style>
