<template>
    <div>
        <div
            class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto"
        >
            <h2 class="title">Welcome to the Laravel Ecommerce</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div
                            class="col-md-4 card space-around mb-4"
                            v-for="(product, index) in products"
                            :key="index"
                        >
                            <router-link
                                :to="{ path: '/products/' + product.id }"
                            >
                                <img
                                    class="card-img-top"
                                    :src="product.image"
                                    :alt="product.name"
                                />
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <span v-html="product.name"></span>
                                    </h5>
                                    <p class="card-text">
                                        $ {{ product.price }}
                                    </p>
                                </div>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            products: [],
        };
    },
    mounted() {
        axios
            .get("api/products/")
            .then((response) => (this.products = response.data));
    },
};
</script>

<style scoped>
</style>