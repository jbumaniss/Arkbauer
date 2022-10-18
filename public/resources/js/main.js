const app = Vue.createApp({
    data() {
        return {
            products: [],
            cartProducts: [],
            total: 0,
            quantity: 0,
            showCart: false,
            showAddProduct: false,
            showManageProducts: false,
            postProduct: {
                productName: null,
                productImage: null,
                productAvailable: null,
                productPrice: null,
                productVatRate: null,
                productDescription: null
            }
        };
    },
    created() {
        axios
            .get("http://localhost:8000/products")
            .then(response => (this.products = response.data))
            .catch(function (e) {
                console.log(e)
            });


        axios
            .get("http://localhost:8000/cart/products")
            .then(response => (this.cartProducts = response.data))
            .catch(function (e) {
                console.log(e)
            });

    },

    computed: {

        totalQuantity() {
            return this.cartProducts.reduce(
                (subtotal, product) => subtotal + product.quantity,
                0
            );
        },

        cartSubtotal() {
            axios
                .get("http://localhost:8000/cart/subtotal")
                .then(response => (this.subtotal = response.data))
                .catch(function (e) {
                    console.log(e)
                });
        },

        cartVatAmount() {
            axios
                .get("http://localhost:8000/cart/vatAmount")
                .then(response => (this.vatAmount = response.data))
                .catch(function (e) {
                    console.log(e)
                });
        },

        cartTotal() {
            axios
                .get("http://localhost:8000/cart/total")
                .then(response => (this.total = response.data))
                .catch(function (e) {
                    console.log(e)
                });
        },

        pvn() {
            let sum = 0
            if (this.products.filter(product => product.quantity > 0)) {
                this.products.map(x => {
                    sum = sum + (x.vatPrice * x.quantity)
                })
                return sum
            }
        },
        subtotal() {
            let sum = 0
            if (this.products.filter(product => product.quantity > 0)) {
                this.products.map(x => {
                    sum = sum + (x.price * x.quantity)
                })
                return sum
            }
        },

    },
    methods: {
        refresh() {
            location.reload();
        },
        createProduct() {
            axios.post("http://localhost:8000/create", this.postProduct).then(res => console.log(res))
                .catch(function (e) {
                    console.log(e)
                });
            location.reload();
        },
        updateProduct(product) {
            axios.post("http://localhost:8000/update", product)
                .catch(function (e) {
                    console.log(e)
                });
        },
        buy() {
            axios.post("http://localhost:8000/cart/buy", this.cartProducts)
                .catch(function (e) {
                    console.log(e)
                });
            location.reload();

        },
        removeFromCart(product) {
            for (let i = 0; i < this.cartProducts.length; i++) {
                if (this.cartProducts[i].id === product.id) {
                    if (this.cartProducts[i].quantity !== 0) {
                        this.cartProducts[i].quantity--;
                        axios.post("http://localhost:8000/cart/destroy", product)
                            .catch(function (e) {
                                console.log(e)
                            });
                    }
                    break;
                }
            }
        },
        updateCart(product, updateType) {
            for (let i = 0; i < this.products.length; i++) {
                if (this.products[i].id === product.id) {
                    if (updateType === 'subtract') {
                        if (this.products[i].quantity !== 0) {
                            this.products[i].quantity--;
                            axios.post("http://localhost:8000/cart/destroy", product)
                                .catch(function (e) {
                                    console.log(e)
                                });
                            location.reload();
                        }
                    } else {
                        if (this.products[i].available !== 0) {
                            this.products[i].quantity++;
                            axios.post("http://localhost:8000/cart/create", product)
                                .catch(function (e) {
                                    console.log(e)
                                });
                            location.reload();
                        }
                    }
                    break;
                }
            }
        },
        deleteProduct(product) {
            axios.post("http://localhost:8000/destroy", product)
                .catch(function (e) {
                    console.log(e)
                });
            location.reload();
        }
    }
}).mount('#app')
