<template>
  <div class="container mx-auto">
    <h1 class="text-2xl text-red-700 font-semibold my-5">
        {{ t('checkout_page') }}
    </h1>
    <form
      @submit.prevent="handleSubmit"
      id="checkout-form"
      method="post"
      action="#"
    >
      <div class="flex">
        <div class="w-1/2">
          <h4 class="text-lg text-red-700 font-semibold my-5">
              {{ t('personal_information') }}
          </h4>
          <div class="flex items-center">
            <div class="w-1/2">
              <div class="mt-3 flex w-full">
                <avored-input :field-label="t('first_name')" v-model="user.first_name" field-name="first_name">
                </avored-input>
              </div>
            </div>
            <div class="w-1/2 ml-3">
              <div class="mt-3 flex w-full">
                <avored-input :field-label="t('last_name')" v-model="user.last_name" field-name="last_name">
                </avored-input>
              </div>
            </div>
          </div>

          <div class="flex items-center">
            <div class="w-full">
              <avored-input :field-label="t('email')" v-model="user.email" field-name="email">
              </avored-input>
            </div>
          </div>

          <div class="flex items-center">
            <div class="w-1/2">
              <avored-input
                :field-label="t('password')"
                field-name="password"
                v-model="user.password" 
                field-type="password"
              >
              </avored-input>
            </div>
            <div class="w-1/2 ml-3">
              <avored-input
                :field-label="t('password_confirmation')"
                v-model="user.confirm_password" 
                field-name="password_confirmation"
                field-type="password"
              ></avored-input>
            </div>
          </div>

          <h4 class="text-lg text-red-700 font-semibold my-5">
              t('shipping_address')
          </h4>
          <div>
            <div class="flex">
              <div class="w-1/2">
                <avored-input
                  :field-label="t('first_name')"
                  v-model="shippingAddress.first_name"
                  field-name="shipping[first_name]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  :field-label="t('last_name')"
                  v-model="shippingAddress.last_name"
                  field-name="shipping[last_name]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">
                <avored-input
                  :field-label="t('company_name')"
                  v-model="shippingAddress.company_name"
                  field-name="shipping[company_name]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  :field-label="t('phone')"
                  v-model="shippingAddress.phone"
                  field-name="shipping[phone]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">
                <avored-input
                  :field-label="t('address1')"
                  v-model="shippingAddress.address1"
                  field-name="shipping[address1]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  :field-label="t('address2')"
                  v-model="shippingAddress.address2"
                  field-name="shipping[address2]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">
                  <label class="text-gray-500 block text-sm">{{ t('country') }}</label>
                  <select class="block w-full px-3 focus:ring-1 focus:ring-red-500 py-2 text-gray-600" v-model="shippingAddress.country_id">
                      <option value="7d58b6b1-9e26-4984-a3bf-99022a966307">New Zealand</option>
                      <option value="7d58b6b1-9e26-4984-a3bf-99022a966307">United State</option>
                  </select>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  :field-label="t('state')"
                  v-model="shippingAddress.state"
                  field-name="shipping[state]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">
                <avored-input
                  :field-label="t('postcode')"
                  v-model="shippingAddress.postcode"
                  field-name="shipping[postcode]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  :field-label="t('city')"
                  v-model="shippingAddress.city"
                  field-name="shipping[city]"
                ></avored-input>
              </div>
            </div>
          </div>
          <h4 class="text-lg text-red-700 font-semibold my-5">
              {{ t('billing_address') }}
          </h4>
          <div>
            <div class="flex">
              <div class="w-1/2">
                <avored-input
                  :field-label="t('first_name')"
                  v-model="billingAddress.first_name"
                  field-name="shipping[first_name]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  :field-label="t('last_name')"
                  v-model="billingAddress.last_name"
                  field-name="shipping[last_name]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">
                <avored-input
                  :field-label="t('company_name')"
                  v-model="billingAddress.company_name"
                  field-name="shipping[company_name]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  :field-label="t('phone')"
                  v-model="billingAddress.phone"
                  field-name="shipping[phone]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">
                <avored-input
                  :field-label="t('address1')"
                  v-model="billingAddress.address1"
                  field-name="shipping[address1]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  :field-label="t('address2')"
                  v-model="billingAddress.address2"
                  field-name="shipping[address2]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">
                  <label class="text-gray-500 block text-sm">{{ t('country') }}</label>
                  <select class="block w-full px-3 focus:ring-1 focus:ring-red-500 py-2 text-gray-600" v-model="billingAddress.country_id">
                      <option value="7d58b6b1-9e26-4984-a3bf-99022a966307">New Zealand</option>
                      <option value="7d58b6b1-9e26-4984-a3bf-99022a966307">United State</option>
                  </select>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  field-label="State"
                  v-model="billingAddress.state"
                  field-name="shipping[state]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">
                <avored-input
                  field-label="Postcode"
                  v-model="billingAddress.postcode"
                  field-name="shipping[postcode]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  field-label="City"
                  v-model="billingAddress.city"
                  field-name="shipping[city]"
                ></avored-input>
              </div>
            </div>
          </div>
        </div>
        <div class="w-1/2 ml-3">
          <div>
            <h4 class="text-lg text-red-700 font-semibold my-5">
                {{ t('delivery_method') }}
            </h4>
            <div class="mt-6">
              <div v-if="!shippingFetching" class="mt-6">
              <template v-for="(shipping, index) in shippingOptions.shippingQuery" :key="index">
                  <span v-html="shipping.view"></span>
              </template>
            </div>
            </div>
          </div>

          <div class="mt-8">
            <h4 class="text-lg text-red-700 font-semibold my-5">
                {{ t('payment_method') }}
            </h4>
            <div v-if="!paymentFetching" class="mt-6">
              <template v-for="(payment, index) in paymentOptions.paymentQuery" :key="index">
                  <span v-html="payment.view"></span>
              </template>
            </div>
          </div>

          <div class="mt-8">
            <h4 class="text-lg text-red-700 font-semibold my-5">
                {{ t('cart_items')  }}
            </h4>
            <div v-if="!fetching" class="mt-5 ml-3">
              <div
                v-for="(cartItem, index) in data.cartItems"
                :key="`category-link-${index}`"
                class="flex items-center hover:bg-gray-100 px-6 py-5"
              >
                <div class="flex w-2/5">
                  <!-- product -->
                  <div class="w-20">
                    <img
                      class="h-24"
                      src="https://drive.google.com/uc?id=18KkAVkGFvaGNqPy2DIvTqmUH_nk39o3z"
                      alt=""
                    />
                  </div>
                  <div class="flex flex-col justify-between ml-4 flex-grow">
                    <span class="font-bold text-sm">{{ cartItem.product.name }}</span>
                    <a
                      href="#"
                      class="
                        font-semibold
                        hover:text-red-500
                        text-gray-500 text-xs
                      "
                      >Remove</a
                    >
                  </div>
                </div>
                <div class="flex justify-center w-1/5">
                  <svg
                    class="fill-current text-gray-600 w-3"
                    viewBox="0 0 448 512"
                  >
                    <path
                      d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"
                    />
                  </svg>

                  <input
                    class="mx-2 border text-center w-8"
                    type="text"
                    :value="cartItem.qty"
                  />

                  <svg
                    class="fill-current text-gray-600 w-3"
                    viewBox="0 0 448 512"
                  >
                    <path
                      d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"
                    />
                  </svg>
                </div>
                <span class="text-center w-1/5 font-semibold text-sm"
                  >${{ cartItem.product.price }}</span
                >
                <span class="text-center w-1/5 font-semibold text-sm"
                  >${{ cartItem.product.price * cartItem.qty }}</span
                >
              </div>
            </div>
          </div>

          <button
            type="submit"
            class="
              px-3
              mt-8
              ml-5
              py-1
              bg-red-500
              text-white text-sm
              font-semibold
              leading-10
              rounded
            "
          >
            <VueFeather class="h-6 w-6 leading-norma l" type="shopping-cart" />
            {{ t('place_order') }}
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script lang="ts">
import CartItemAllQuery from "@/graphql/CartItemAllQuery"
import ShippingQuery from "@/graphql/ShippingQuery"
import PaymentQuery from "@/graphql/PaymentQuery"
import CustomerRegister from '@/graphql/CustomerRegister'
import AddressCreate from '@/graphql/AddressCreate'
import PlaceOrder from '@/graphql/PlaceOrder'
import { defineComponent, ref } from "vue"
import VueFeather from "vue-feather"
import { useMutation, useQuery } from "@urql/vue"
import AvoRedInput from "@/components/forms/AvoRedInput.vue"
import _ from 'lodash'
import { useI18n } from "vue-i18n"


export default defineComponent({
  components: {
    VueFeather,
    "avored-input": AvoRedInput,
  },
  setup() {
    const { t } = useI18n() 

    const user = ref({
      first_name: '',
      last_name: '',
      email: '',
      password: '',
      confirm_password: ''
    })

    const shippingAddress = ref({
      type: 'SHIPPING',
      customer_id: '',
      first_name: '',
      last_name: '',
      company_name: '',
      phone: '',
      address1: '',
      address2: '',
      state: '',
      city: '',
      postcode: '',
      country_id: ''
    })

    const billingAddress = ref({
      type: 'BILLING',
      customer_id: '',
      first_name: '',
      last_name: '',
      company_name: '',
      phone: '',
      address1: '',
      address2: '',
      state: '',
      city: '',
      postcode: '',
      country_id: ''
    })

    const placeOrderData = ref({
      shipping_option: "pickup", //@todo fixed this 
      payment_option: "cash-on-delivery", //@todo fix this
      order_status_id: "817e28e2-1708-466d-b88e-a596a44e5317",
      customer_id : "71339c41-13a7-4b01-8fab-3375f15c9e39",
      shipping_address_id: "ac2ed320-0cae-4b2c-a628-bf7ed111c955",
      billing_address_id: "ac2ed320-0cae-4b2c-a628-bf7ed111c955"     
    })
    const customerRegister = useMutation(CustomerRegister)
    const addressCreate = useMutation(AddressCreate)
    const placeOrder = useMutation(PlaceOrder)

    const handleSubmit = () => {
        console.log("handle submit order")
  
        customerRegister.executeMutation(
          _.pick(user.value, ['first_name', 'last_name', 'email', 'password'])
        ).then((result) => {
            //@todo assign customer_id to a billingAddress and shippingAddress
            console.log(result.data)
        })

        shippingAddress.value.customer_id = '71339c41-13a7-4b01-8fab-3375f15c9e39'
        addressCreate.executeMutation(shippingAddress.value)
          .then((result) => {
              console.log(result.data)
          })

        billingAddress.value.customer_id = '71339c41-13a7-4b01-8fab-3375f15c9e39'
        addressCreate.executeMutation(billingAddress.value).then((result) => {
            console.log(result.data)
        })


        placeOrder.executeMutation(placeOrderData.value).then((result) => {
            console.log(result.data)
        })
    }

    const result = useQuery({query: CartItemAllQuery})
    const paymentQuery = useQuery({query: PaymentQuery})
    const shippingQuery = useQuery({query: ShippingQuery})

    return {
      t,
      user: user,
      shippingAddress: shippingAddress,
      billingAddress: billingAddress,
      handleSubmit,
      paymentFetching: paymentQuery.fetching,
      paymentOptions: paymentQuery.data,
      paymentError: paymentQuery.error,
      shippingFetching: shippingQuery.fetching,
      shippingOptions: shippingQuery.data,
      shippingError: shippingQuery.error,
      fetching: result.fetching,
      data: result.data,
      error: result.error,
    };
  },
});
</script>
