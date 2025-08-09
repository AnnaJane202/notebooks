<script>

import {Link} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import StoreOrUpdateCart from "@/Components/Client/Cart/StoreOrUpdateCart.vue";
import {Head} from "@inertiajs/vue3";


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
        StoreOrUpdateCart,
        Head,
    }
}

</script>

<template>
    <Head>
        <title>{{ product.title }}</title>
    </Head>

    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Первый блок (верхний) -->
        <div class="flex flex-col lg:flex-row gap-8 mb-12">
            <!-- Блок с изображениями -->
            <div class="flex flex-row-reverse md:flex-row gap-4 w-full lg:w-1/2">
                <!-- Миниатюры (вертикальные) -->
                <div  class="flex flex-col gap-2 w-16 md:w-20">
                    <template v-for="image in product.images">
                    <div @click="selectedImage = image" class="border rounded-md p-1 cursor-pointer hover:border-blue-500">
                        <img :src="image.url" :alt="product.title" class="cursor-pointer w-full">
                    </div>
                    </template>

                </div>

                <!-- Основное изображение -->
                <div v-if="selectedImage" class="flex-1 bg-white p-4 rounded-lg shadow-sm">
                    <img :src="selectedImage.url" :alt="product.title" class="w-full h-auto object-contain">
                </div>

            </div>

            <!-- Блок с основной информацией -->
            <div class="w-full lg:w-1/2">
                <h1 class="text-2xl md:text-3xl font-bold mb-4">{{ product.title }}</h1>

                <!-- Основные характеристики -->
                <div class="mb-6">
<!--                    <div class="flex items-center gap-2 mb-2">-->
<!--                        <span class="text-gray-500">Бренд:</span>-->
<!--                        <span class="font-medium">Example Brand</span>-->
<!--                    </div>-->
                    <template v-for="param in product.params">
                        <div v-if="param.title === 'Диагональ экрана'" class="flex justify-between items-center gap-2 mb-2">
                            <span class="text-gray-500">Диагональ экрана</span>
                            <span class="font-medium">{{ param.value }} {{ param.unit }}</span>
                        </div>
                        <div v-if="param.title === 'Разрешение экрана'" class="flex justify-between items-center gap-2 mb-2">
                            <span class="text-gray-500">Разрешение экрана</span>
                            <span class="font-medium">{{ param.value }}</span>
                        </div>
                        <div v-if="param.title === 'Частота обновления экрана'" class="flex justify-between items-center gap-2 mb-2">
                            <span class="text-gray-500">Частота обновления экрана</span>
                            <span class="font-medium">{{ param.value }} {{ param.unit }}</span>
                        </div>
                        <div v-if="param.title === 'Тип видеокарты'" class="flex justify-between items-center gap-2 mb-2">
                            <span class="text-gray-500">Тип видеокарты</span>
                            <span class="font-medium">{{ param.value }}</span>
                        </div>
                        <div v-if="param.title === 'Модель видеокарты'" class="flex justify-between items-center gap-2 mb-2">
                            <span class="text-gray-500">Модель видеокарты</span>
                            <span class="font-medium">{{ param.value }}</span>
                        </div>
                    </template>
                </div>

                <!-- Блок с ценой и кнопкой -->
                <div class="bg-gray-100 p-6 rounded-lg">
                    <div class="flex items-center gap-4 mb-4">
                        <span class="text-3xl font-bold text-gray-800">{{ product.price }} ₽</span>
                        <span class="text-lg text-gray-500 line-through">{{ product.old_price }} ₽</span>
<!--                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-sm">-16%</span>-->
                    </div>
                    <div>
                        <StoreOrUpdateCart :product="product"></StoreOrUpdateCart>
                    </div>
                </div>
            </div>
        </div>

        <!-- Второй блок (нижний) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Левая колонка характеристик -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-bold mb-4 pb-2 border-b">Основные характеристики</h2>
                <div class="space-y-4 mb-8">
                    <template v-for="param in params['Основные характеристики']">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-gray-500">{{ param.title }}</div>
                            <div>{{ param.value }}</div>
                        </div>
                    </template>
                </div>

                <h2 class="text-xl font-bold mb-4 pb-2 border-b">Процессор</h2>
                <div class="space-y-4 mb-8">
                    <template v-for="param in params['Процессор']">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-gray-500">{{ param.title }}</div>
                            <div>{{ param.value }}</div>
                        </div>
                    </template>
                </div>

                <h2 class="text-xl font-bold mb-4 pb-2 border-b">Экран</h2>
                <div class="space-y-4 mb-8">
                    <template v-for="param in params['Экран']">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-gray-500">{{ param.title }}</div>
                            <div>{{ param.value }}</div>
                        </div>
                    </template>
                </div>

                <h2 class="text-xl font-bold mb-4 pb-2 border-b">Оперативная память</h2>
                <div class="space-y-4 mb-8">
                    <template v-for="param in params['Оперативная память']">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-gray-500">{{ param.title }}</div>
                            <div>{{ param.value }}</div>
                        </div>
                    </template>
                </div>

                <h2 class="text-xl font-bold mb-4 pb-2 border-b">Видеокарта</h2>
                <div class="space-y-4 mb-8">
                    <template v-for="param in params['Видеокарта']">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-gray-500">{{ param.title }}</div>
                            <div>{{ param.value }}</div>
                        </div>
                    </template>
                </div>

                <h2 class="text-xl font-bold mb-4 pb-2 border-b">Хранение данных</h2>
                <div class="space-y-4 mb-8">
                    <template v-for="param in params['Хранение данных']">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-gray-500">{{ param.title }}</div>
                            <div>{{ param.value }}</div>
                        </div>
                    </template>
                </div>

                <h2 class="text-xl font-bold mb-4 pb-2 border-b">Интерфейсы и коммуникации</h2>
                <div class="space-y-4 mb-8">
                    <template v-for="param in params['Интерфейсы и коммуникации']">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-gray-500">{{ param.title }}</div>
                            <div>{{ param.value }}</div>
                        </div>
                    </template>
                </div>
            </div>


            <!-- Правая колонка характеристик -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-bold mb-4 pb-2 border-b">Конструкция</h2>
                <div class="space-y-4 mb-8">
                    <template v-for="param in params['Конструкция']">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-gray-500">{{ param.title }}</div>
                            <div>{{ param.value }}</div>
                        </div>
                    </template>
                </div>

                <h2 class="text-xl font-bold mb-4 pb-2 border-b">Камера и звук</h2>
                <div class="space-y-4 mb-8">
                    <template v-for="param in params['Камера и звук']">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-gray-500">{{ param.title }}</div>
                            <div>{{ param.value }}</div>
                        </div>
                    </template>
                </div>

                <h2 class="text-xl font-bold mb-4 pb-2 border-b">Устройства ввода</h2>
                <div class="space-y-4 mb-8">
                    <template v-for="param in params['Устройства ввода']">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-gray-500">{{ param.title }}</div>
                            <div>{{ param.value }}</div>
                        </div>
                    </template>
                </div>

                <h2 class="text-xl font-bold mb-4 pb-2 border-b">Аккумулятор</h2>
                <div class="space-y-4 mb-8">
                    <template v-for="param in params['Аккумулятор']">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-gray-500">{{ param.title }}</div>
                            <div>{{ param.value }}</div>
                        </div>
                    </template>
                </div>

                <h2 class="text-xl font-bold mb-4 pb-2 border-b">Дополнительные функции</h2>
                <div class="space-y-4 mb-8">
                    <template v-for="param in params['Дополнительные функции']">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-gray-500">{{ param.title }}</div>
                            <div>{{ param.value }}</div>
                        </div>
                    </template>
                </div>

                <h2 class="text-xl font-bold mb-4 pb-2 border-b">Комплектация</h2>
                <div class="space-y-4 mb-8">
                    <template v-for="param in params['Комплектация']">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-gray-500">{{ param.title }}</div>
                            <div>{{ param.value }}</div>
                        </div>
                    </template>
                </div>

                <h2 class="text-xl font-bold mb-4 pb-2 border-b">Размеры и вес</h2>
                <div class="space-y-4 mb-8">
                    <template v-for="param in params['Размеры и вес']">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-gray-500">{{ param.title }}</div>
                            <div>{{ param.value }}</div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>







    <article class=" hidden w-full bg-gray-50 p-4 min-h-screen">
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
