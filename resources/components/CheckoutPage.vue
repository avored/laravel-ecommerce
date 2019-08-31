<script>
import isNil from 'lodash/isNil'

export default {
    props: ['items', 'addresses'],
    data() {
        return {
            form: this.$form.createForm(this),
            submitStatus:false,
            newAccount: true,
            useDifferentBillingAddress: false,
            billingAddresses: [],
            shippingAddresses: [],
            selectedShippingAddress: null,
            selectedBillingAddress: null,
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
        },
        changeSelectedShippingAddress(val) {
            this.selectedShippingAddress = this.shippingAddresses[val];
        },
        changeSelectedBillingAddress(val) {
            this.selectedBillingAddress = this.billingAddresses[val];
        }
    },
    mounted() {
        if (!isNil(this.addresses)) {
            this.addresses.forEach(address => {
                if (address.type === 'SHIPPING') {
                    this.shippingAddresses.push(address);

                    if (isNil(this.selectedShippingAddress)) {
                        this.selectedShippingAddress = address;
                    }
                }
                if (address.type === 'BILLING') {
                    this.billingAddresses.push(address);
                    if (isNil(this.selectedBillingAddress)) {
                        this.selectedBillingAddress = address;
                    }
                }
                
            });
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
