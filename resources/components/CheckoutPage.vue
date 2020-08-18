<script>
import isNil from 'lodash/isNil'

export default {
    props: ['items', 'addresses'],
    data() {
        return {
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
            stripeToken: '',
            initShippingAddress: null,
            initBillingAddress: null
        }
    },
    methods: {
        handleSubmit (e) {
            e.preventDefault()
            EventBus.$emit('placeOrderBefore')

            let beforSubmitResult = this.handleBeforeSubmit()

            
            if (typeof beforSubmitResult === 'undefined') {
                document.getElementById('checkout-form').submit()
                return true
            } else {
                beforSubmitResult.then(result => {
                    if (result.error) {
                        var errorElement = document.getElementById('card-errors')
                        errorElement.textContent = result.error.message
                        return falspe
                    } else {
                        app.stripeToken = result.token.id
                    }
                })
            }
        },
        stripePlaceOrderBefore() {
            console.log('here');    
        },
        handleBeforeSubmit() {
            if (typeof stripe === 'undefined') {
                return
            }
            return stripe.createToken(card)
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
        useDifferentBillingAddressSwitchChange() {
            this.useDifferentBillingAddress = !this.useDifferentBillingAddress
        },
        // handlePaymentChange(identifier) {
        //     console.log('i am listener', identifier)
        //     //this.paymentOption = val;
        // },
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
                    var addressLabel = ''
                    addressLabel += address.company_name + ', '
                    addressLabel += address.first_name + ' ' + address.last_name + ', '
                    addressLabel += address.address1 + ', '
                    addressLabel += address.address2 + ', '
                    addressLabel += address.city + ', '
                    addressLabel += address.state + ' ' + address.country.name
                    this.shippingAddresses.push(addressLabel)
                    this.initShippingAddress = 0

                    if (isNil(this.selectedShippingAddress)) {
                        this.selectedShippingAddress = address;
                    }
                }
                if (address.type === 'BILLING') {
                    var addressLabel = ''
                    addressLabel += address.company_name + ', '
                    addressLabel += address.first_name + ' ' + address.last_name + ', '
                    addressLabel += address.address1 + ', '
                    addressLabel += address.address2 + ', '
                    addressLabel += address.city + ', '
                    addressLabel += address.state + ' ' + address.country.name
                    this.billingAddresses.push(addressLabel)
                    this.initBillingAddress = 0
                    
                    if (isNil(this.selectedBillingAddress)) {
                        this.selectedBillingAddress = address
                    }
                }
                
            });
        }
        var app = this
        EventBus.$on('selectedPaymentIdentifier', function(identifier) {
            app.paymentOption = identifier
        })

        EventBus.$on('placeOrderAfter', function() {
            console.log('placeorder after')
            document.getElementById('checkout-form').submit()
        })
    }
}
</script>
