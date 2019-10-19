<script>

export default {
    props: ['items', 'couponUrl'],
    data () {
        return {
            form: this.$form.createForm(this),
            showCartActionBtn: false,
            cartActionProducts: []
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
            console.log(this.cartActionProducts)
        }
    },
    mounted() {
    }
}
</script>
