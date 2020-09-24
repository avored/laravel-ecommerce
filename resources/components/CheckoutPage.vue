<script>
import isNil from 'lodash/isNil'

export default {
    props: ['items', 'addresses'],
    data() {
        return {
            submitStatus:false,
            newAccount: true,
            useDifferentBillingAddress: false,
            billingAddresses: {},
            shippingAddresses: {},
            selectedShippingAddress: null,
            selectedBillingAddress: null,
            paymentOption: '',
            shippingOption: '',
            shippingCountry: 0,
            billingCountry: 0,
            stripeToken: '',
            initShippingAddress: null,
            initBillingAddress: null,
            displayShippingAddressFields: false,
            shippingAddressId: null,
            billingAddressId: null,
            newBillingAddressId: null,
            displayShippingDropdown: false,
            displayBillingDropdown: false

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
            this.shippingOption = val
        },
        changeSelectedShippingAddress(val) {

            console.log(val[0])
            if (val[0] == this.newShippingAddressId) {
                this.displayShippingAddressFields = true
                this.selectedShippingAddress = null
                this.shippingAddressId = null
            } else {
                this.selectedShippingAddress = this.shippingAddresses[val[0]]
                this.shippingAddressId = val[0]
                this.displayShippingAddressFields = false
            }
        },
        changeSelectedBillingAddress(val) {
            if (val[0] == this.newBillingAddressId) {
                this.displayBillingAddressFields = true
                this.selectedBillingAddress = null
                this.billingAddressId = null
            } else {
                this.selectedBillingAddress = this.billingAddresses[val[0]]
                this.billingAddressId = val[0]
                this.displayBillingAddressFields = false
            }
        },
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
                    this.shippingAddresses[address.id] = addressLabel
                    this.shippingAddressId = address.id
                    this.initShippingAddress = address.id
                    this.displayShippingDropdown = true

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
                    this.billingAddresses[address.id] = addressLabel
                    this.initBillingAddress = address.id
                    this.billingAddressId = address.id
                    this.displayBillingDropdown = true
                    
                    if (isNil(this.selectedBillingAddress)) {
                        this.selectedBillingAddress = address
                    }
                }
            });
            let addNewAddressLabel = 'Add New Address'
            this.shippingAddresses['add_new'] = addNewAddressLabel
            this.newShippingAddressId = 'add_new'
            this.billingAddresses['add_new'] = addNewAddressLabel
            this.newBillingAddressId = 'add_new'
        }
        var app = this
        EventBus.$on('selectedPaymentIdentifier', function(identifier) {
            app.paymentOption = identifier
        })

        EventBus.$on('placeOrderAfter', function() {
            document.getElementById('checkout-form').submit()
        })
    }
}
</script>
