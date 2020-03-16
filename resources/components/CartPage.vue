<script>

import axios from 'axios'

export default {
    props: ['items', 'couponUrl', 'cartDeleteUrl', 'cartUpdateUrl'],
    data () {
        return {
            form: this.$form.createForm(this),
            showCartActionBtn: false,
            cartActionProducts: [],
            cartUpdateModalVisibility: false
        };
    },
    methods: {
        handleCouponSubmit(e) {
            this.form.validateFields((err, values) => {
                if (err) {
                    e.preventDefault();
                }
          });
        },
        clickOnCheckBox(e, product) {
            if (e.target.checked) {
                this.cartActionProducts.push(product)
            } else {
                const index = this.cartActionProducts.findIndex(ele => ele.slug === product.slug);
                this.cartActionProducts.splice(index, 1)
            }
            if (this.cartActionProducts.length > 0) {
                this.showCartActionBtn = true
            } else {
                this.showCartActionBtn = false
            }
        },
        delteCartProductClick() {
            var app = this
            axios({
                method: 'delete',
            url: this.cartDeleteUrl,
                data: {'products' : this.cartActionProducts}
            }).then(response => {
                if (response.data.success == true) {
                    app.$notification.success({
                        key: 'cart.destroy.success',
                        message: response.data.message,
                    });
                    location.reload()
                } else {
                     app.$notification.error({
                        key: 'cart.destroy.error',
                        message: response.data.message,
                    });
                }
                
            })
        },
        updateCartProductClick() {
            this.cartUpdateModalVisibility = !this.cartUpdateModalVisibility
        },
        clickOnCartUpdateCancel() {
            this.cartUpdateModalVisibility = false
        },
        clickOnCartUpdateOk() {
            var app = this
            
            axios({
                method: 'put',
                url: this.cartUpdateUrl,
                data: {'products' : this.cartActionProducts}
            }).then(response => {
                if (response.data.success == true) {
                    app.$notification.success({
                        key: 'cart.update.success',
                        message: response.data.message,
                    });
                    location.reload()
                } else {
                     app.$notification.error({
                        key: 'cart.update.error',
                        message: response.data.message,
                    });
                }
            })
        }
    },
    mounted() {
    }
}
</script>
