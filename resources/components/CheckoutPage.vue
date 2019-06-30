<script>
    export default {
        data() {
            return {
                form: this.$form.createForm(this),
                submitStatus:false,
                newAccount: false,
                useDifferentBillingAddress: false,
                paymentOption: '',
                shippingOption: ''
            }
        },
        methods: {
           handleSubmit (e) {
               this.submitStatus = true;
                this.form.validateFields((err, values) => {
                    if (err) {
                        this.handleSubmit = false;
                        e.preventDefault();
                    }
                });
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
