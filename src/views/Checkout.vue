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
        <div class="w-1/2" v-if="!fetchingCustomer">
          <h4 class="text-lg text-red-700 font-semibold my-5">
              {{ t('personal_information') }}
          </h4>
          <div>
              <div v-if="!fetchingCustomer" class="bg-white p-5 border-2 border-blue-600 rounded-lg">
                  <div class="flex w-full">
                      <span class="text-xl">
                          {{ _.get(customerData, 'customerQuery.first_name') }}
                      </span>
                      <span class="text-xl ml-3">
                          {{ _.get(customerData, 'customerQuery.last_name') }}
                      </span>
                  </div>
                  <div class="w-full mt-2 flex">
                    <span class="text-sm text-gray-500">
                      {{ _.get(customerData, 'customerQuery.email') }}
                    </span>
                  </div>
              </div>
              <div v-else class="flex item-center w-full">
                  <div class="flex items-center">
                    <div class="w-1/2">
                      <div class="mt-3 flex w-full">
                        <avored-input 
                          :field-label="t('first_name')" 
                          :placeholder="t('first_name')" 
                          :field-error="_.get(customerValidationErrors, 'first_name.0')"
                          v-model="user.first_name" field-name="first_name">
                        </avored-input>
                      </div>
                    </div>
                    <div class="w-1/2 ml-3">
                      <div class="mt-3 flex w-full">
                        <avored-input 
                            :field-label="t('last_name')" 
                            :placeholder="t('last_name')" 
                            :field-error="_.get(customerValidationErrors, 'last_name.0')" 
                            v-model="user.last_name" 
                          >
                        </avored-input>
                      </div>
                    </div>
                  </div>

                  <div class="flex items-center">
                    <div class="w-full">
                      <avored-input 
                          :field-label="t('email')" 
                          :placeholder="t('email')" 
                          :field-error="_.get(customerValidationErrors, 'email.0')" 
                          v-model="user.email">
                      </avored-input>
                    </div>
                  </div>

                  <div class="flex items-center">
                    <div class="w-1/2">
                      <avored-input
                        :field-label="t('password')"
                        :placeholder="t('password')"
                        :field-error="_.get(customerValidationErrors, 'password.0')"
                        v-model="user.password" 
                        field-type="password"
                      >
                      </avored-input>
                    </div>
                    <div class="w-1/2 ml-3">
                      <avored-input
                        :field-label="t('password_confirmation')"
                        :placeholder="t('password_confirmation')"
                        :field-error="_.get(customerValidationErrors, 'password_confirmation.0')"
                        v-model="user.password_confirmation" 
                        field-type="password"
                      ></avored-input>
                    </div>
                  </div>
              </div>
          </div>

          <h4 class="text-lg text-red-700 font-semibold my-5">
              {{ t('shipping_address') }}
          </h4>
          <div>
            <div v-if="setShippingAddress(_.get(customerData, 'customerQuery.addresses'))">
              <div class="flex">
                <div class="w-1/2">
                  <avored-input
                    :field-label="t('first_name')"
                    :placeholder="t('first_name')"
                    :field-error="_.get(shippingAddressValidationErrors, 'first_name.0')"
                    v-model="shippingAddress.first_name"
                  ></avored-input>
                </div>
                <div class="w-1/2 ml-3">
                  <avored-input
                    :field-label="t('last_name')"
                    :placeholder="t('last_name')"
                    :field-error="_.get(shippingAddressValidationErrors, 'last_name.0')"
                    v-model="shippingAddress.last_name"
                    field-name="shipping[last_name]"
                  ></avored-input>
                </div>
              </div>

              <div class="flex items-center">
                <div class="w-1/2">
                  <avored-input
                    :field-label="t('company_name')"
                    :placeholder="t('company_name')"
                    :field-error="_.get(shippingAddressValidationErrors, 'company_name.0')"
                    v-model="shippingAddress.company_name"
                    field-name="shipping[company_name]"
                  ></avored-input>
                </div>
                <div class="w-1/2 ml-3">
                  <avored-input
                    :field-label="t('phone')"
                    :placeholder="t('phone')"
                    :field-error="_.get(shippingAddressValidationErrors, 'phone.0')"
                    v-model="shippingAddress.phone"
                    field-name="shipping[phone]"
                  ></avored-input>
                </div>
              </div>

              <div class="flex items-center">
                <div class="w-1/2">
                  <avored-input
                    :field-label="t('address1')"
                    :placeholder="t('address1')"
                    :field-error="_.get(shippingAddressValidationErrors, 'address1.0')"
                    v-model="shippingAddress.address1"
                    field-name="shipping[address1]"
                  ></avored-input>
                </div>
                <div class="w-1/2 ml-3">
                  <avored-input
                    :field-label="t('address2')"
                    :placeholder="t('address2')"
                    :field-error="_.get(shippingAddressValidationErrors, 'address2.0')"
                    v-model="shippingAddress.address2"
                    field-name="shipping[address2]"
                  ></avored-input>
                </div>
              </div>

              <div class="flex items-center">
                  <div class="w-1/2" v-if="!countryOptionsResultFetching">
                      <label class="text-sm text-gray-700">
                          {{ t('country') }}
                      </label>
                      <select v-model="shippingAddress.country_id" class="w-full p-2 text-md text-gray-700 focus:ring-1 focus:ring-red-600">
                          <template v-for="countryOption in countryOptionsResult.countryOptions" :key="countryOption.value" >
                              <option :value="countryOption.value">
                                {{ countryOption.label }}
                              </option>
                          </template>
                      </select>
                      <p v-if="_.get(shippingAddressValidationErrors, 'country_id.0')" 
                        class="text-red-500 mt-1 text-sm">
                          {{ _.get(shippingAddressValidationErrors, 'country_id.0') }}
                      </p>
                  </div>
                <div class="w-1/2 ml-3">
                  <avored-input
                    :field-label="t('state')"
                    :placeholder="t('state')"
                    :field-error="_.get(shippingAddressValidationErrors, 'state.0')"
                    v-model="shippingAddress.state"
                    field-name="shipping[state]"
                  ></avored-input>
                </div>
              </div>

              <div class="flex items-center">
                <div class="w-1/2">
                  <avored-input
                    :field-label="t('postcode')"
                    :placeholder="t('postcode')"
                    :field-error="_.get(shippingAddressValidationErrors, 'postcode.0')"
                    v-model="shippingAddress.postcode"
                    field-name="shipping[postcode]"
                  ></avored-input>
                </div>
                <div class="w-1/2 ml-3">
                  <avored-input
                    :field-label="t('city')"
                    :placeholder="t('city')"
                    :field-error="_.get(shippingAddressValidationErrors, 'city.0')"
                    v-model="shippingAddress.city"
                    field-name="shipping[city]"
                  ></avored-input>
                </div>
              </div>
            </div>
            <!-- <div v-else>
                <div class="border-2 border-blue-500 p-5">
                      <div class="flex w-full">
                          <span>{{ _.get(shippingAddress, 'first_name') }}</span>
                          <span class="ml-2">{{ _.get(shippingAddress, 'last_name') }}</span>
                      </div>
                      <div class="flex w-full">
                          <span>{{ _.get(shippingAddress, 'company_name')}}</span>
                          <span class="ml-2">{{ _.get(shippingAddress, 'phone') }}</span>
                      </div>
                      <div class="flex w-full">
                          <span>{{ _.get(shippingAddress, 'address1') }},</span>
                      </div>
                      <div class="flex w-full">
                          <span>{{ _.get(shippingAddress, 'address2') }},</span>
                      </div>
                      <div class="flex w-full">
                          <span>{{ _.get(shippingAddress, 'city') }} </span>
                      </div>
                      <div class="flex w-full">
                          <span>{{ _.get(shippingAddress, 'state') }},</span>
                      </div>
                      <div class="flex w-full">
                          <span>{{ _.get(shippingAddress, 'country_name') }} {{ _.get(shippingAddress, 'postcode') }}</span>
                      </div>
                  </div>
            </div> -->
          </div>
          
          <h4 class="text-lg text-red-700 font-semibold my-5">
              {{ t('billing_address') }}
          </h4>
          <div>
              <div v-if="setBillingAddress(_.get(customerData, 'customerQuery.addresses'))">
                    <div class="flex">
                      <div class="w-1/2">
                        <avored-input
                          :field-label="t('first_name')"
                          :placeholder="t('first_name')"
                          :field-error="_.get(billingAddressValidationErrors, 'first_name.0')"
                          v-model="billingAddress.first_name"
                          field-name="shipping[first_name]"
                        ></avored-input>
                      </div>
                      <div class="w-1/2 ml-3">
                        <avored-input
                          :field-label="t('last_name')"
                          :placeholder="t('last_name')"
                          :field-error="_.get(billingAddressValidationErrors, 'last_name.0')"
                          v-model="billingAddress.last_name"
                          field-name="shipping[last_name]"
                        ></avored-input>
                      </div>
                    </div>

                    <div class="flex items-center">
                      <div class="w-1/2">
                        <avored-input
                          :field-label="t('company_name')"
                          :placeholder="t('company_name')"
                          :field-error="_.get(billingAddressValidationErrors, 'company_name.0')"
                          v-model="billingAddress.company_name"
                          field-name="shipping[company_name]"
                        ></avored-input>
                      </div>
                      <div class="w-1/2 ml-3">
                        <avored-input
                          :field-label="t('phone')"
                          :phone="t('phone')"
                          :field-error="_.get(billingAddressValidationErrors, 'phone.0')"
                          v-model="billingAddress.phone"
                          field-name="shipping[phone]"
                        ></avored-input>
                      </div>
                    </div>

                    <div class="flex items-center">
                      <div class="w-1/2">
                        <avored-input
                          :field-label="t('address1')"
                          :placeholder="t('address1')"
                          :field-error="_.get(billingAddressValidationErrors, 'address1.0')"
                          v-model="billingAddress.address1"
                          field-name="shipping[address1]"
                        ></avored-input>
                      </div>
                      <div class="w-1/2 ml-3">
                        <avored-input
                          :field-label="t('address2')"
                          :placeholder="t('address2')"
                          :field-error="_.get(billingAddressValidationErrors, 'address2.0')"
                          v-model="billingAddress.address2"
                          field-name="shipping[address2]"
                        ></avored-input>
                      </div>
                    </div>

                    <div class="flex items-center">
                      <div class="w-1/2" v-if="!countryOptionsResultFetching">
                            <label class="text-sm text-gray-700">
                                {{ t('country') }}
                            </label>
                            <select v-model="billingAddress.country_id" class="w-full p-2 text-md text-gray-700 focus:ring-1 focus:ring-red-600">
                                <template v-for="countryOption in countryOptionsResult.countryOptions" :key="countryOption.value" >
                                    <option :value="countryOption.value">
                                      {{ countryOption.label }}
                                    </option>
                                </template>
                            </select>
                            <p v-if="_.get(billingAddressValidationErrors, 'country_id.0')" 
                              class="text-red-500 mt-1 text-sm">
                                {{ _.get(billingAddressValidationErrors, 'country_id.0') }}
                            </p>
                        </div>
                      <div class="w-1/2 ml-3">
                        <avored-input
                          :field-label="t('state')"
                          :placeholder="t('state')"
                          :field-error="_.get(billingAddressValidationErrors, 'state.0')"
                          v-model="billingAddress.state"
                          field-name="shipping[state]"
                        ></avored-input>
                      </div>
                    </div>

                    <div class="flex items-center">
                      <div class="w-1/2">
                        <avored-input
                          :field-label="t('postcode')"
                          :placeholder="t('postcode')"
                          :field-error="_.get(billingAddressValidationErrors, 'postcode.0')"
                          v-model="billingAddress.postcode"
                          field-name="shipping[postcode]"
                        ></avored-input>
                      </div>
                      <div class="w-1/2 ml-3">
                        <avored-input
                          :field-label="t('city')"
                          :placeholder="t('city')"
                          :field-error="_.get(billingAddressValidationErrors, 'city.0')"
                          v-model="billingAddress.city"
                          field-name="shipping[city]"
                        ></avored-input>
                      </div>
                    </div>
              </div>
              <!-- <div v-else>
                  <div class="border-2 border-blue-500 p-5">
                      <div class="flex w-full">
                          <span>{{ _.get(billingAddress, 'first_name') }}</span>
                          <span class="ml-2">{{ _.get(billingAddress, 'last_name') }}</span>
                      </div>
                      <div class="flex w-full">
                          <span>{{ _.get(billingAddress, 'company_name')}}</span>
                          <span class="ml-2">{{ _.get(billingAddress, 'phone') }}</span>
                      </div>
                      <div class="flex w-full">
                          <span>{{ _.get(billingAddress, 'address1') }},</span>
                      </div>
                      <div class="flex w-full">
                          <span>{{ _.get(billingAddress, 'address2') }},</span>
                      </div>
                      <div class="flex w-full">
                          <span>{{ _.get(billingAddress, 'city') }} </span>
                      </div>
                      <div class="flex w-full">
                          <span>{{ _.get(billingAddress, 'state') }},</span>
                      </div>
                      <div class="flex w-full">
                          <span>{{ _.get(billingAddress, 'country_name') }} {{ _.get(billingAddress, 'postcode') }}</span>
                      </div>
                  </div>
              </div> -->
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
                  <button
                    class="flex items-center justify-between w-full bg-white rounded-md border-2 border-blue-500 p-4 focus:outline-none">
                    <label class="flex items-center">
                        <input type="radio" v-model="placeOrderData.shipping_option" checked value="shipping.identifier" class="form-radio h-5 w-5 text-blue-600" />
                        <span class="ml-2 text-sm text-gray-700">
                            {{ shipping.name }}
                        </span>
                    </label>
                    <span class="text-gray-600 text-sm"></span>
                </button>
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
                  <button
                    class="flex items-center justify-between w-full bg-white rounded-md border-2 border-blue-500 p-4 focus:outline-none">
                    <label class="flex items-center">
                        <input type="radio" v-model="placeOrderData.payment_option" checked value="payment.identifier" class="form-radio h-5 w-5 text-blue-600" />
                        <span class="ml-2 text-sm text-gray-700">
                            {{ payment.name }}
                        </span>
                    </label>
                    <span class="text-gray-600 text-sm"></span>
                </button>

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
                      class="h-20 rounded object-cover"
                      :src="cartItem.product.main_image_url"
                      :alt="cartItem.product.name"
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
import CartItemAllQuery from '@/graphql/CartItemAllQuery'
import ShippingQuery from '@/graphql/ShippingQuery'
import PaymentQuery from '@/graphql/PaymentQuery'
import GetCustomerQuery from '@/graphql/GetCustomerQuery'
import CustomerRegister from '@/graphql/CustomerRegister'
import AddressCreate from '@/graphql/AddressCreate'
import PlaceOrder from '@/graphql/PlaceOrder'
import { defineComponent, ref } from 'vue'
import VueFeather from 'vue-feather'
import { useMutation, useQuery } from '@urql/vue'
import AvoRedInput from '@/components/forms/AvoRedInput.vue'
import _ from 'lodash'
import CountryOptionsQuery from '@/graphql/CountryOptionsQuery'
import { useI18n } from 'vue-i18n'
import { AUTH_TOKEN, CUSTOMER_LOGGED_IN, CART_TOKEN } from '@/constants'
import { useRouter } from 'vue-router'

export default defineComponent({
  components: {
    VueFeather,
    'avored-input': AvoRedInput
  },
  setup() {
    const { t } = useI18n() 
    const countryQueryResult = useQuery({query: CountryOptionsQuery})
    var variables: any = {}
    const customerValidationErrors = ref({})
    const customerId = ref('')
    const shipping_address_id = ref('')
    const shippingAddressValidationErrors = ref({})
    const billing_address_id = ref('')
    const billingAddressValidationErrors = ref({})
    const router = useRouter()
    // const customerQueryResult = ref({})

    const user = ref({
      first_name: '',
      last_name: '',
      email: '',
      password: '',
      password_confirmation: ''
    })
    const shippingAddress = ref({
      id: '',
      type: 'SHIPPING',
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
        shipping_option: 'pickup',
        payment_option: "cash-on-delivery", //@todo fix this
        customer_id : customerId.value,
        shipping_address_id: shipping_address_id.value,
        billing_address_id: billing_address_id.value   
    })
    
    const customerRegister = useMutation(CustomerRegister)
    const addressCreate = useMutation(AddressCreate)
    const placeOrder = useMutation(PlaceOrder)

    const handleSubmit = async () => {
        
        if (!localStorage.getItem(CUSTOMER_LOGGED_IN)) {
          await customerRegister.executeMutation(
            _.pick(user.value, ['first_name', 'last_name', 'email', 'password', 'password_confirmation'])
          ).then((result) => {
              if (_.get(result, 'error.graphQLErrors.0.extensions.category') === 'validation') {
                      customerValidationErrors.value =  _.get(result, 'error.graphQLErrors.0.extensions.validation')
              } else {
                  localStorage.setItem(AUTH_TOKEN, result.data.register.access_token)
                  localStorage.setItem(CUSTOMER_LOGGED_IN, 'true')
                  customerId.value = result.data.register.id
              }
          })
        }

        if (!shippingAddress.value.id) {
          await addressCreate.executeMutation(
            _.pick(shippingAddress.value, ['type', 'first_name', 'last_name', 'company_name', 'phone', 'address1', 'address2', 'country_id', 'state', 'postcode', 'city'])
          )
          .then((result) => {
              if (_.get(result, 'error.graphQLErrors.0.extensions.category') === 'validation') {
                  shippingAddressValidationErrors.value =  _.get(result, 'error.graphQLErrors.0.extensions.validation')
              } else {
                  shipping_address_id.value = result.data.createAddress.id
              }
          })
        }

        if (!billingAddress.value.id) {
          await addressCreate.executeMutation(_.pick(billingAddress.value, ['type', 'first_name', 'last_name', 'company_name', 'phone', 'address1', 'address2', 'country_id', 'state', 'postcode', 'city'])).then((result) => {
              if (_.get(result, 'error.graphQLErrors.0.extensions.category') === 'validation') {
                  billingAddressValidationErrors.value =  _.get(result, 'error.graphQLErrors.0.extensions.validation')
              } else {
                  billing_address_id.value = result.data.createAddress.id
              }
          })
        }

        placeOrderData.value.shipping_address_id = shippingAddress.value.id
        placeOrderData.value.billing_address_id = billingAddress.value.id
        
        await placeOrder.executeMutation(placeOrderData.value).then((result) => {
            console.log(result)
            router.push({name: 'checkout.successs'})

        })
    }

    var customerQueryResult = null
    if (localStorage.getItem(AUTH_TOKEN)) {
        customerQueryResult = useQuery({query: GetCustomerQuery})
    }

    if (localStorage.getItem(CART_TOKEN)) {
        variables = {visitor_id: localStorage.getItem(CART_TOKEN)}
    }
    const result = useQuery({query: CartItemAllQuery, variables})
    const paymentQuery = useQuery({query: PaymentQuery})
    const shippingQuery = useQuery({query: ShippingQuery})

      const billingAddress = ref({
          id: '',
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
    const setBillingAddress = (addresses: Array<any>|null) => {
        billingAddress.value = _.find(addresses, (address) => {
            if (address.type === 'BILLING') {
              return address
            }
        })
        if (billingAddress.value.id) {
          return true
        }

        return false
    }
    const setShippingAddress = (addresses: Array<any>|null) => {
        shippingAddress.value = _.find(addresses, (address) => {
            if (address.type === 'SHIPPING') {
              return address
            }
        })
        if (shippingAddress.value.id) {
          return true
        }

        return false
    }

    return {
      t,
      _,
      setBillingAddress,
      setShippingAddress,
      shippingAddress,
      customerValidationErrors,
      shippingAddressValidationErrors,
      billingAddressValidationErrors,
      user: user,
      billingAddress,
      handleSubmit,
      paymentFetching: paymentQuery.fetching,
      paymentOptions: paymentQuery.data,
      paymentError: paymentQuery.error,
      shippingFetching: shippingQuery.fetching,
      shippingOptions: shippingQuery.data,
      shippingError: shippingQuery.error,
      fetching: result.fetching,
      data: result.data,
      countryOptionsResult: countryQueryResult.data,
      countryOptionsResultFetching: countryQueryResult.fetching,
      error: result.error,
      placeOrderData,
      customerData: _.get(customerQueryResult, 'data'),
      fetchingCustomer: _.get(customerQueryResult, 'fetching')
    };
  },
});
</script>
