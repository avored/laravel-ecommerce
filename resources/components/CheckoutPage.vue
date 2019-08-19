<script>
    export default {
        props: ['items'],
        data() {
            return {
                form: this.$form.createForm(this),
                submitStatus:false,
                newAccount: true,
                useDifferentBillingAddress: false,
                paymentOption: '',
                shippingOption: '',
                shippingCountry: 0,
                billingCountry: 0,
            }
        },
        methods: {
           handleSubmit (e) {
               this.submitStatus = true;
                this.form.validateFields((err, values) => {
                    if (err) {
                        this.submitStatus = false;
                        e.preventDefault();
                    }
                });
            },
            shippingCountryOptionChange(val) {
                this.shippingCountry = val;
            },
            billingCountryOptionChange(val) {
                this.billingCountry = val;
            },
            newAccountSwitchChange(val) {
                this.newAccount = val;
            },
            useDifferentBillingAddressSwitchChange(val) {
                this.useDifferentBillingAddress = !val;
            },
            handlePaymentChange(e, val) {
                this.paymentOption = val;
            },
            handleShippingChange(e, val) {
                this.shippingOption = val;
            }
        }
    }
</script>
<style lang="less">
.checkout-right {
    background: #e9e6e6;
    min-height: 400px;
    border-radius: 5px;
}
.mt-1 {
    margin-top: 1rem;
}
</style>
