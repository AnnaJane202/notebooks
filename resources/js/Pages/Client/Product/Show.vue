<script>

import {Link} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import StoreOrUpdateCart from "@/Components/Client/Cart/StoreOrUpdateCart.vue";

// import StoreOrUpdateCart from "@/Components/Client/Cart/StoreOrUpdateCart.vue";

export default {
    name: 'Index',
    layout: MainLayout,

    props: {
        product: Object,
        params: Object,
        ct: Number,
    },

    data() {
        return {
            selectedImage: {url: this.product.preview_image_url}
        }
    },

    components: {
        Link,
        StoreOrUpdateCart
    }
}

</script>

<template>
    <article class="w-full bg-gray-50 p-4 min-h-screen">
        <div class="w-4/5 mx-auto">
            <div class="text-3xl mb-4">
                <div>{{ product.title }}</div>
            </div>
            <div class="flex items-start mb-4">
                <div class="flex mr-4 p-4 bg-white border border-gray-200 w-2/5">
                    <div style="width: 100px" class="mr-4">
                        <div v-for="image in product.images" class="mb-4">
                            <img class="cursor-pointer" @click="selectedImage = image" :src="image.url" :alt="product.title">
                        </div>
                    </div>
                    <div style="width: 500px;" v-if="selectedImage">
                        <img :src="selectedImage.url" :alt="product.title">
                    </div>
                </div>
                <div class="w-2/5">
                    <div class="p-4 mb-4 bg-white border border-gray-200 mr-4">
                        <template v-for="param in product.params">
                            <div v-if="param.title === 'Диагональ экрана'" class="mb-4 flex">
                                <div class="mr-16 text-gray-400">Диагональ экрана</div>
                                <div>{{ param.value }} {{ param.unit }}</div>
                            </div>
                            <div v-if="param.title === 'Разрешение экрана'" class="mb-4 flex">
                                <div class="mr-16 text-gray-400">Разрешение экрана</div>
                                <div>{{ param.value }}</div>
                            </div>
                            <div v-if="param.title === 'Частота обновления экрана'" class="mb-4 flex">
                                <div class="mr-16 text-gray-400">Частота обновления экрана</div>
                                <div>{{ param.value }} {{ param.unit }}</div>
                            </div>
                            <div v-if="param.title === 'Тип видеокарты'" class="mb-4 flex">
                                <div class="mr-16 text-gray-400">Тип видеокарты</div>
                                <div>{{ param.value }}</div>
                            </div>
                            <div v-if="param.title === 'Модель видеокарты'" class="mb-4 flex">
                                <div class="mr-16 text-gray-400">Модель видеокарты</div>
                                <div>{{ param.value }}</div>
                            </div>
                        </template>
                        <div>
                            <p>{{ product.content }}</p>
                        </div>

                    </div>

                </div>
                <div class="w-1/5">
                    <div class="p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow-md">
                        <p class="text-3xl font-bold mb-3">{{ product.price }} <span class="text-xl">р.</span></p>
                        <p v-if="product.old_price" class="text-gray-400 line-through mb-5">{{ product.old_price }}</p>
                        <div>
                            <StoreOrUpdateCart :product="product"></StoreOrUpdateCart>
                        </div>
                    </div>

                </div>


            </div>
            <div class="flex mt-8">
                <div class="w-1/2 mr-5">
                    <div class="mb-4">
                        <p class="text-lg font-bold mb-3">Основные характеристики</p>
                        <div v-for="param in params['Основные характеристики']">
                            <div class="flex text-sm">
                                <div class="w-3/4 mb-2">{{ param.title }}</div>
                                <div class="w-1/4 mb-2">{{ param.value }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="text-xl font-bold mb-3">Процессор</p>
                        <div v-for="param in params['Процессор']">
                            <div class="flex text-sm">
                                <div class="w-3/4 mb-2">{{ param.title }}</div>
                                <div class="w-1/4 mb-2">{{ param.value }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="text-xl font-bold mb-3">Экран</p>
                        <div v-for="param in params['Экран']">
                            <div class="flex text-sm">
                                <div class="w-3/4 mb-2">{{ param.title }}</div>
                                <div class="w-1/4 mb-2">{{ param.value }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="text-xl font-bold mb-3">Оперативная память</p>
                        <div v-for="param in params['Оперативная память']">
                            <div class="flex text-sm">
                                <div class="w-3/4 mb-2">{{ param.title }}</div>
                                <div class="w-1/4 mb-2">{{ param.value }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="text-xl font-bold mb-3">Видеокарта</p>
                        <div v-for="param in params['Видеокарта']">
                            <div class="flex text-sm">
                                <div class="w-3/4 mb-2">{{ param.title }}</div>
                                <div class="w-1/4 mb-2">{{ param.value }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="text-xl font-bold mb-3">Хранение данных</p>
                        <div v-for="param in params['Хранение данных']">
                            <div class="flex text-sm">
                                <div class="w-3/4 mb-2">{{ param.title }}</div>
                                <div class="w-1/4 mb-2">{{ param.value }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="text-xl font-bold mb-3">Интерфейсы и коммуникации</p>
                        <div v-for="param in params['Интерфейсы и коммуникации']">
                            <div class="flex text-sm">
                                <div class="w-3/4 mb-2">{{ param.title }}</div>
                                <div class="w-1/4 mb-2">{{ param.value }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-1/2">
                    <div class="mb-4">
                        <p class="text-lg font-bold mb-3">Конструкция</p>
                        <div v-for="param in params['Конструкция']">
                            <div class="flex text-sm">
                                <div class="w-3/4 mb-2">{{ param.title }}</div>
                                <div class="w-1/4 mb-2">{{ param.value }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="text-lg font-bold mb-3">Камера и звук</p>
                        <div v-for="param in params['Камера и звук']">
                            <div class="flex text-sm">
                                <div class="w-3/4 mb-2">{{ param.title }}</div>
                                <div class="w-1/4 mb-2">{{ param.value }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="text-lg font-bold mb-3">Устройства ввода</p>
                        <div v-for="param in params['Устройства ввода']">
                            <div class="flex text-sm">
                                <div class="w-3/4 mb-2">{{ param.title }}</div>
                                <div class="w-1/4 mb-2">{{ param.value }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="text-lg font-bold mb-3">Аккумулятор</p>
                        <div v-for="param in params['Аккумулятор']">
                            <div class="flex text-sm">
                                <div class="w-3/4 mb-2">{{ param.title }}</div>
                                <div class="w-1/4 mb-2">{{ param.value }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="text-lg font-bold mb-3">Дополнительные функции</p>
                        <div v-for="param in params['Дополнительные функции']">
                            <div class="flex text-sm">
                                <div class="w-3/4 mb-2">{{ param.title }}</div>
                                <div class="w-1/4 mb-2">{{ param.value }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="text-lg font-bold mb-3">Комплектация</p>
                        <div v-for="param in params['Комплектация']">
                            <div class="flex text-sm">
                                <div class="w-3/4 mb-2">{{ param.title }}</div>
                                <div class="w-1/4 mb-2">{{ param.value }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="text-lg font-bold mb-3">Размеры и вес</p>
                        <div v-for="param in params['Размеры и вес']">
                            <div class="flex text-sm">
                                <div class="w-3/4 mb-2">{{ param.title }}</div>
                                <div class="w-1/4 mb-2">{{ param.value }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </article>
</template>

<style scoped>

</style>
