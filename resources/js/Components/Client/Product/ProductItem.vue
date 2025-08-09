<script>


import {Link} from "@inertiajs/vue3";
import StoreOrUpdateCart from "@/Components/Client/Cart/StoreOrUpdateCart.vue";


export default {
    name: 'ProductItem',

    props: {
        product: Object,
    },
    components: {
        Link,
        StoreOrUpdateCart,


    }

}
</script>

<template>
    <div class="flex flex-col bg-white rounded-lg shadow-md overflow-hidden h-full">
        <div class="p-4 flex justify-center items-center h-48">
<!--            <img src="https://via.placeholder.com/400x200" alt="Товар 3" class="max-h-full max-w-full object-contain">-->
            <a :href="route('client.products.show', product.id)"><div class="max-h-full max-w-full object-contain"><img :src="product.preview_image_url" :alt="product.title" class="m-auto cursor-pointer hover:scale-125 transition-transform duration-300 ease-in-out"></div></a>
        </div>
        <div class="p-4 flex flex-col flex-grow text-xs md:text-lg">
            <div class="flex justify-between items-center mb-2">
                <span class="text-lg font-bold">{{ product.price }}</span>
                <span class="text-sm text-gray-500 line-through">{{ product.old_price }}</span>
            </div>
            <h3 class="text-md font-medium mb-4 flex-grow">
                <Link :href="route('client.products.show', product.id)" class="hover:text-pink-700"><h3>{{ product.title }}</h3></Link>
            </h3>
<!--            <button class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded transition w-full">-->
<!--                Купить-->
<!--            </button>-->
            <StoreOrUpdateCart :product="product"></StoreOrUpdateCart>
        </div>
    </div>


    <div class="hidden p-4 border border-gray-200 bg-white">
        <a :href="route('client.products.show', product.id)"><div class="h-52"><img :src="product.preview_image_url" :alt="product.title" class="m-auto cursor-pointer hover:scale-125 transition-transform duration-300 ease-in-out"></div></a>

        <div class="flex items-center justify-between">
            <p class="text-xl font-bold mb-5">{{ product.price }}</p>
            <p class="text-gray-400 line-through mb-5">{{ product.old_price }}</p>
        </div>
        <!--                <Link :href="route('client.products.show', product.id)"><h3>{{ product.title }}</h3></Link>-->
        <div class="mb-5" id="title">
<!--            <h3 class="text-base mb-5">{{ product.title }}</h3>-->
            <Link :href="route('client.products.show', product.id)" class="hover:text-pink-700"><h3>{{ product.title }}</h3></Link>
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
