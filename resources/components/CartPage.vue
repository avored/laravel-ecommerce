
<script>
import axios from "axios"

export default {
    props: ["items", "couponUrl", "cartDeleteUrl", "cartUpdateUrl", 'defaultCurrency', 'checkoutUrl', 'cartTotal', 'discountTotal'],
    data() {
        return {
            showCartActionBtn: false,
            cartActionProducts: [],
            cartUpdateModalVisibility: false,
            totalTax: 0,
            subtotal: 0,
            total: 0,
            promotionCode: '',
            cartUpdateDisplay: false,
            cartItems: null
        };
    },
    methods: {
        checkboxChange(event, product) {
            if (event.target.checked) {
                this.cartActionProducts.push(product)
            } else {
                const index = this.cartActionProducts.findIndex(
                    ele => ele.slug === product.slug
                )
                this.cartActionProducts.splice(index, 1)
            }

             if (this.cartActionProducts.length > 0) {
                this.showCartActionBtn = true;
            } else {
                this.showCartActionBtn = false;
            }
        },
        applyPromotionCodeClicked() {
            var app = this
            axios({
                method: "post",
                url: this.couponUrl + '/' + this.promotionCode
            }).then(response => {
                if (response.data.success == true) {
                    app.$alert(response.data.message)
                    location.reload();
                } else {
                    app.$alert(response.data.message)
                }
            });
        },
        delteCartProductClick() {
            var app = this
            axios({
                method: "delete",
                url: this.cartDeleteUrl,
                data: { products: this.cartActionProducts }
            }).then(response => {
                if (response.data.success == true) {
                    app.$alert(response.data.message)
                    location.reload();
                } else {
                    app.$alert(response.data.message)
                }
            });
        },
        updateCartProductClick() {
            this.cartUpdateModalVisibility = !this.cartUpdateModalVisibility;
        },
        clickOnCartUpdateCancel() {
            this.cartUpdateModalVisibility = false;
        },
        clickOnCartUpdate() {
            var app = this
            axios({
                method: "put",
                url: this.cartUpdateUrl,
                data: { products: this.cartActionProducts }
            }).then(response => {
                if (response.data.success == true) {
                    app.$alert(response.data.message)
                    location.reload();
                } else {
                    app.$alert(response.data.message)
                }
            });
        }
    },
    mounted() {
        this.cartItems = this.items
        if (this.items.length > 0 ) {
            this.items.forEach((item) => {
                this.subtotal += item.price * item.qty
                this.total += item.tax
                this.totalTax += item.tax
            })
            this.total = this.subtotal + this.totalTax
        }
    }
};
</script>
