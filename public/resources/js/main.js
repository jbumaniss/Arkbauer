const app = Vue.createApp({
    data() {
        return {
            products: [],
            cartProducts: [],
            total:  0,
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
            .then(response => (this.products = response.data));


      axios
          .get("http://localhost:8000/cart/products")
          .then(response => (this.cartProducts = response.data));

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

        },

        cartVatAmount() {
            axios
                .get("http://localhost:8000/cart/vatAmount")
                .then(response => (this.vatAmount = response.data))
        },

        cartTotal() {
            axios
                .get("http://localhost:8000/cart/total")
                .then(response => (this.total = response.data))
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
       createProduct(e) {
            axios.post("http://localhost:8000/addProduct", this.postProduct)

            location.reload();
        },
        updateProduct(product) {
            axios.post("http://localhost:8000/update", product)

        },
        buy() {
            axios.post("http://localhost:8000/cart/buy", this.cartProducts)
            location.reload();

        },
        removeFromCart(product) {
            for (let i = 0; i < this.cartProducts.length; i++) {
                if (this.cartProducts[i].id === product.id) {

                    if (this.cartProducts[i].quantity !== 0) {
                        this.cartProducts[i].quantity--;
                        axios.post("http://localhost:8000/cart/removeProduct", product)
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
                            axios.post("http://localhost:8000/cart/removeProduct", product)
                            location.reload();
                        }
                    } else {
                        if (this.products[i].available !== 0) {
                            this.products[i].quantity++;
                            axios.post("http://localhost:8000/cart/addProduct", product)
                            location.reload();
                        }
                    }
                    break;
                }
            }
        },
        deleteProduct(product) {
            axios.post("http://localhost:8000/destroy", product)

        }
    }
}).mount('#app')

