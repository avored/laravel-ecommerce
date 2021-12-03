<template>
  <div class="container mx-auto">
    <h1 class="text-2xl text-red-700 font-semibold my-5">Checkout PAge</h1>
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
                <avored-input field-label="First Name" field-name="first_name">
                </avored-input>
              </div>
            </div>
            <div class="w-1/2 ml-3">
              <div class="mt-3 flex w-full">
                <avored-input field-label="Last Name" field-name="last_name">
                </avored-input>
              </div>
            </div>
          </div>

          <div class="flex items-center">
            <div class="w-full">
              <avored-input field-label="Email Address" field-name="email">
              </avored-input>
            </div>
          </div>

          <div class="flex items-center">
            <div class="w-1/2">
              <avored-input
                field-label="Password"
                field-name="password"
                input-type="password"
              >
              </avored-input>
            </div>
            <div class="w-1/2 ml-3">
              <avored-input
                field-label="Password confirmation"
                field-name="password_confirmation"
                input-type="password"
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
                  field-name="shipping[first_name]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  field-label="Last Name"
                  field-name="shipping[last_name]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">
                <avored-input
                  field-label="Company Name"
                  field-name="shipping[company_name]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  field-label="Phone"
                  field-name="shipping[phone]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">
                <avored-input
                  field-label="Address1"
                  field-name="shipping[address1]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  field-label="Address 2"
                  field-name="shipping[address2]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">country dropdown goes here</div>
              <div class="w-1/2 ml-3">
                <avored-input
                  field-label="State"
                  field-name="shipping[state]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">
                <avored-input
                  field-label="Postcode"
                  field-name="shipping[postcode]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  field-label="City"
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
                  field-name="shipping[first_name]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  field-label="Last Name"
                  field-name="shipping[last_name]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">
                <avored-input
                  field-label="Company Name"
                  field-name="shipping[company_name]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  field-label="Phone"
                  field-name="shipping[phone]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">
                <avored-input
                  field-label="Address1"
                  field-name="shipping[address1]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  field-label="Address 2"
                  field-name="shipping[address2]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">country dropdown goes here</div>
              <div class="w-1/2 ml-3">
                <avored-input
                  field-label="State"
                  field-name="shipping[state]"
                ></avored-input>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-1/2">
                <avored-input
                  field-label="Postcode"
                  field-name="shipping[postcode]"
                ></avored-input>
              </div>
              <div class="w-1/2 ml-3">
                <avored-input
                  field-label="City"
                  field-name="shipping[city]"
                ></avored-input>
              </div>
            </div>
          </div>
        </div>
        <div class="w-1/2 ml-3">
          <div>
            <h4 class="text-sm text-gray-500 font-medium">Delivery method</h4>
            <div class="mt-6">
              <button
                class="
                  flex
                  items-center
                  justify-between
                  w-full
                  bg-white
                  rounded-md
                  border-2 border-blue-500
                  p-4
                  focus:outline-none
                "
              >
                <label class="flex items-center">
                  <input
                    type="radio"
                    class="form-radio h-5 w-5 text-blue-600"
                    checked
                  /><span class="ml-2 text-sm text-gray-700">MS Delivery</span>
                </label>

                <span class="text-gray-600 text-sm">$18</span>
              </button>
              <button
                class="
                  mt-6
                  flex
                  items-center
                  justify-between
                  w-full
                  bg-white
                  rounded-md
                  border
                  p-4
                  focus:outline-none
                "
              >
                <label class="flex items-center">
                  <input
                    type="radio"
                    class="form-radio h-5 w-5 text-blue-600"
                  /><span class="ml-2 text-sm text-gray-700">DC Delivery</span>
                </label>

                <span class="text-gray-600 text-sm">$26</span>
              </button>
            </div>
          </div>

          <div class="mt-8">
            <h4 class="text-sm text-gray-500 font-medium">Payment method</h4>
            <div class="mt-6">
              <button
                class="
                  flex
                  items-center
                  justify-between
                  w-full
                  bg-white
                  rounded-md
                  border-2 border-blue-500
                  p-4
                  focus:outline-none
                "
              >
                <label class="flex items-center">
                  <input
                    type="radio"
                    class="form-radio h-5 w-5 text-blue-600"
                  />
                  <span class="ml-2 text-sm text-gray-700">
                    Cash on Delivery
                  </span>
                </label>
                <span class="text-gray-600 text-sm"></span>
              </button>
              <button
                class="
                  mt-6
                  flex
                  items-center
                  justify-between
                  w-full
                  bg-white
                  rounded-md
                  border
                  p-4
                  focus:outline-none
                "
              >
                <label class="flex items-center">
                  <input
                    type="radio"
                    class="form-radio h-5 w-5 text-blue-600"
                  />
                  <span class="ml-2 text-sm text-gray-700"> Bank Deposit </span>
                </label>

                <span class="text-gray-600 text-sm"></span>
              </button>
            </div>
          </div>

          <div class="mt-8">
            <h4 class="text-sm text-gray-500 font-medium">Cart Items</h4>
            <div v-if="!fetching" class="flex mt-5 w-full ml-3">
              <div
                v-for="(cartItem, index) in data.cartItems"
                :key="`category-link-${index}`"
                class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5"
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
import { defineComponent } from "vue";
import VueFeather from "vue-feather";
import { useQuery } from "@urql/vue";
import AvoRedInput from "@/components/forms/AvoRedInput.vue";

export default defineComponent({
  components: {
    VueFeather,
    "avored-input": AvoRedInput,
  },
  setup() {
    const handleSubmit = () => {
      console.log("handle submit order");
    };
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
    });
    return {
      handleSubmit,
      fetching: result.fetching,
      data: result.data,
      error: result.error,
    };
  },
});
</script>
