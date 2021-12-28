<template>
  <div class="container mx-auto">
    <h1 class="text-2xl text-red-700 font-semibold my-5">Checkout Page</h1>
    <form
      @submit.prevent="handleSubmit"
      id="checkout-form"
      method="post"
      action="#"
    >
      <div class="flex">
        <div class="w-1/2">
          <h4 class="text-lg text-red-700 font-semibold my-5">
            Personal Information
          </h4>
          <div class="flex items-center">
            <div class="w-1/2">
              <div class="mt-3 flex w-full">
                <avored-input field-label="First Name" v-model="user.first_name" field-name="first_name">
                </avored-input>
              </div>
            </div>
            <div class="w-1/2 ml-3">
              <div class="mt-3 flex w-full">
                <avored-input field-label="Last Name" v-model="user.last_name" field-name="last_name">
                </avored-input>
              </div>
            </div>
          </div>

          <div class="flex items-center">
            <div class="w-full">
              <avored-input field-label="Email Address" v-model="user.email" field-name="email">
              </avored-input>
            </div>
          </div>

          <div class="flex items-center">
            <div class="w-1/2">
              <avored-input
                field-label="Password"
                field-name="password"
                v-model="user.password" 
                field-type="password"
              >
              </avored-input>
            </div>
            <div class="w-1/2 ml-3">
              <avored-input
                field-label="Password confirmation"
                v-model="user.confirm_password" 
                field-name="password_confirmation"
                field-type="password"
              ></avored-input>
            </div>
          </div>

          <h4 class="text-lg text-red-700 font-semibold my-5">
            Shipping Address
          </h4>
          <div>
            <div class="flex">
              <div class="w-1/2">
                <avored-input
                  field-label="First Name"
                  v-model="shippingAddress.first_name"
                  field-name="shipping[first_name]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  field-label="Last Name"
                  v-model="shippingAddress.last_name"
                  field-name="shipping[last_name]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">
                <avored-input
                  field-label="Company Name"
                  v-model="shippingAddress.company_name"
                  field-name="shipping[company_name]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  field-label="Phone"
                  v-model="shippingAddress.phone"
                  field-name="shipping[phone]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">
                <avored-input
                  field-label="Address1"
                  v-model="shippingAddress.address1"
                  field-name="shipping[address1]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  field-label="Address 2"
                  v-model="shippingAddress.address2"
                  field-name="shipping[address2]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">
                  <select v-model="shippingAddress.country_id">
                      <option value="7d58b6b1-9e26-4984-a3bf-99022a966307">New Zealand</option>
                      <option value="7d58b6b1-9e26-4984-a3bf-99022a966307">United State</option>
                  </select>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  field-label="State"
                  v-model="shippingAddress.state"
                  field-name="shipping[state]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">
                <avored-input
                  field-label="Postcode"
                  v-model="shippingAddress.postcode"
                  field-name="shipping[postcode]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  field-label="City"
                  v-model="shippingAddress.city"
                  field-name="shipping[city]"
                ></avored-input>
              </div>
            </div>
          </div>
          <h4 class="text-lg text-red-700 font-semibold my-5">
            Billing Address
          </h4>
          <div>
            <div class="flex">
              <div class="w-1/2">
                <avored-input
                  field-label="First Name"
                  v-model="billingAddress.first_name"
                  field-name="shipping[first_name]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  field-label="Last Name"
                  v-model="billingAddress.last_name"
                  field-name="shipping[last_name]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">
                <avored-input
                  field-label="Company Name"
                  v-model="billingAddress.company_name"
                  field-name="shipping[company_name]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  field-label="Phone"
                  v-model="billingAddress.phone"
                  field-name="shipping[phone]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">
                <avored-input
                  field-label="Address1"
                  v-model="billingAddress.address1"
                  field-name="shipping[address1]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  field-label="Address 2"
                  v-model="billingAddress.address2"
                  field-name="shipping[address2]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">
                  <select v-model="billingAddress.country_id">
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
                Delivery method
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
              Payment Method
            </h4>
            <div v-if="!paymentFetching" class="mt-6">
              <template v-for="(payment, index) in paymentOptions.paymentQuery" :key="index">
                  <span v-html="payment.view"></span>
              </template>
            </div>
          </div>

          <div class="mt-8">
            <h4 class="text-lg text-red-700 font-semibold my-5">
                Cart Items
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
                    <span class="font-bold text-sm">Iphone 6S</span>
                    <span class="text-red-500 text-xs">Apple</span>
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
                  >${{ cartItem.price }}</span
                >
                <span class="text-center w-1/5 font-semibold text-sm"
                  >${{ cartItem.price * cartItem.qty }}</span
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
            Place Order
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script lang="ts">

import CustomerRegister from '@/graphql/CustomerRegister'
import AddressCreate from '@/graphql/AddressCreate'
import { defineComponent, ref } from "vue"
import VueFeather from "vue-feather"
import { useMutation, useQuery } from "@urql/vue"
import AvoRedInput from "@/components/forms/AvoRedInput.vue"
import _ from 'lodash'


export default defineComponent({
  components: {
    VueFeather,
    "avored-input": AvoRedInput,
  },
  setup() {
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

    const customerRegister = useMutation(CustomerRegister)
    const addressCreate = useMutation(AddressCreate)

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
    }


    


    const result = useQuery({
      query: `
        query CartItems {
          cartItems  {
              visitor_id
              product_id
              price
              qty
          }
      }
      `,
    })
    const paymentQuery = useQuery({
      query: `
        query {
            paymentQuery {
                    name
                    identifier
                    view
            }
        }
      `,
    })
    const shippingQuery = useQuery({
      query: `
        query {
            shippingQuery {
                    name
                    identifier
                    view
            }
        }
      `,
    })

    return {
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
