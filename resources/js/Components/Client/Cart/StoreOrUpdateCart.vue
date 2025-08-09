<script>
export default {
    name: 'StoreOrUpdateCart',

    props: {
        product: Object
    },

    data() {
        return {
            cart: {
                qty:  1,
                product_id: this.product.id,
            },

        }
    },

    methods: {
        storeCart() {
            axios.post(route('client.carts.store'), this.cart)
                .then( res => {
                    this.product.cart = res.data.cart;
                    this.$page.props.ct = res.data.ct;
                    // this.$page.props.auth.user.carts_total_sum = res.data.carts_total_sum;
                    console.log(res);
                })
        },

        // updateCart() {
        //     axios.patch(route('client.carts.update', this.product.cart.id), this.cart)
        //         .then( res => {
        //             this.$page.props.auth.user.carts_total_sum = res.data.carts_total_sum;
        //             // console.log(res.data.auth.user.carts_total_sum);
        //         })
        // }

    },
}
</script>

<template>

    <button v-if="product.cart.qty" class="bg-white hover:bg-pink-100 text-pink-700 py-2 px-4 rounded transition w-full border border-pink-700">
        <a  @click.prevent="storeCart" :href="route('client.carts.index')" class="">В корзине</a>
    </button>
    <button v-if="!product.cart.qty" class="bg-pink-700 hover:bg-pink-600 text-white py-2 px-4 rounded transition w-full border border-pink-700">
        <a  @click.prevent="storeCart" href="#" class="">В корзину</a>
    </button>

<!--    <a v-if="product.cart.qty" @click.prevent="storeCart" :href="route('client.carts.index')" class="block p-4 text-pink-700 text-center bg-white hover:bg-pink-100 border border-pink-700 rounded">В корзине</a>-->
<!--    <a v-if="!product.cart.qty" @click.prevent="storeCart" href="#" class="block p-4 text-white text-center bg-pink-700 hover:bg-pink-600 border border-pink-700 rounded">В корзину</a>-->

</template>

<style scoped>

</style>
