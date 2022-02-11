<template>
  <div class="" v-if="!fetching">
    <div class="flex shadow-md my-10">
      <div class="w-3/4 bg-white px-10 py-10">
        <div class="flex justify-between border-b pb-8">
          <h1 class="font-semibold text-2xl">{{ t('shopping_cart') }}</h1>
          <h2 class="font-semibold text-2xl">
            <span> {{ data.cartItems.length }} {{ t('items') }} </span>
          </h2>
        </div>
        <div class="flex mt-10 mb-5">
          <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">
            {{ t('product_details') }}
          </h3>
          <h3
            class="
              font-semibold
              text-center text-gray-600 text-xs
              uppercase
              w-1/5
            "
          >
            {{ t('quantity') }}
          </h3>
          <h3
            class="
              font-semibold
              text-center text-gray-600 text-xs
              uppercase
              w-1/5
            "
          >
            {{ t('price') }}
          </h3>
          <h3
            class="
              font-semibold
              text-center text-gray-600 text-xs
              uppercase
              w-1/5
            "
          >
            {{ t('total') }}
          </h3>
        </div>
        <div>
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
                  :src="cartItem.product.main_image_url"
                  alt=""
                />
              </div>
              <div class="flex flex-col justify-between ml-4 flex-grow">
                  <span class="font-bold text-sm">{{ cartItem.product.name }}</span>
                  <button
                    type="button"
                    @click.prevent="deleteCartItemOnClick(cartItem.product.slug)"
                    class="font-semibold hover:text-red-500 text-gray-500 text-xs"
                    >{{ t('remove') }}
                  </button>
              </div>
            </div>
            <div class="flex justify-center w-1/5">
              <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512">
                <path
                  d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"
                />
              </svg>

              <input
                class="mx-2 border text-center w-8"
                type="text"
                v-model="cartItem.qty"
                @change="updateCartItemOnChange(cartItem.product.slug, cartItem.qty)"
              />

              <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512">
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

        <router-link
          :to="{name: 'home'}"
          class="flex font-semibold text-indigo-600 text-sm mt-10"
        >
          <svg
            class="fill-current mr-2 text-indigo-600 w-4"
            viewBox="0 0 448 512"
          >
            <path
              d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"
            />
          </svg>
          {{ t('continue_shopping') }}
        </router-link>
      </div>

      <div id="summary" class="w-1/4 px-8 py-10">
      <h1 class="font-semibold text-2xl border-b pb-8">{{ t('order_summary') }}</h1>
        <div class="flex justify-between mt-10 mb-5">
          <span class="font-semibold text-sm uppercase">Items {{ data.cartItems.length }}</span>
          <span class="font-semibold text-sm">$ {{ getTotal(data.cartItems) }}</span>
        </div>
        <div class="border-t mt-8">
          <div
            class="flex font-semibold justify-between py-6 text-sm uppercase"
          >
            <span>Total cost</span>
            <span>${{ getTotal(data.cartItems) }}</span>
          </div>
        </div>

        <router-link :to="{name: 'checkout'}" 
            class="bg-red-500 block font-semibold hover:bg-red-600 py-3 text-sm text-white uppercase w-full">
              <span class="flex justify-center">
                <vue-feather class="mr-5" type="shopping-cart"></vue-feather>
                {{ t('checkout') }}
              </span>
          </router-link>

      </div>
    </div>
  </div>
</template>

<script lang="ts">
import CartItemAllQuery from '@/graphql/CartItemAllQuery'
import { defineComponent } from 'vue'
import VueFeather from 'vue-feather'
import { useMutation, useQuery } from '@urql/vue'
import { useI18n } from 'vue-i18n'
import { CART_TOKEN } from '@/constants'
import DeleteCartMutation from '@/graphql/DeleteCartMutation'
import UpdateCartMutation from '@/graphql/UpdateCartMutation'

type CartItem = {
  id: string,
  qty: number,
  product: {
    id: string,
    price: number,
    name: string
  }

}

export default defineComponent({
  components: {
    'vue-feather' :VueFeather,
  },
  setup() {
      const { t } = useI18n()
      var variables: any = {}
      var deleteCartItemVariables: any = {}
      var updateCartItemVariables: any = {}
      const deleteCartMutation = useMutation(DeleteCartMutation)
      const updateCartMutation = useMutation(UpdateCartMutation)

      if (localStorage.getItem(CART_TOKEN)) {
        variables = {visitor_id: localStorage.getItem(CART_TOKEN)}
      }
      const result = useQuery({query: CartItemAllQuery, variables})

      const getTotal = (cartItems : Array <CartItem>) : number => {
          var total = 0.00
          cartItems.forEach (item => {
            total += item.product.price * item.qty
          })
          return total
      }


    const deleteCartItemOnClick = (slug: string) => {
        if (localStorage.getItem(CART_TOKEN)) {
            deleteCartItemVariables = {visitor_id: localStorage.getItem(CART_TOKEN), slug: slug}
            deleteCartMutation.executeMutation(deleteCartItemVariables)
              .then((result) => {
                  console.log(result)
              })
        }
    }
    const updateCartItemOnChange = (slug: string, qty: any) => {
        if (localStorage.getItem(CART_TOKEN)) {
            updateCartItemVariables = {visitor_id: localStorage.getItem(CART_TOKEN), slug: slug, qty: parseFloat(qty)}

            console.log(updateCartItemVariables)
            updateCartMutation.executeMutation(updateCartItemVariables)
              .then((result) => {
                  console.log(result)
              })
        }
    }


    return {
        t,
        getTotal,
        fetching: result.fetching,
        data: result.data,
        error: result.error,
        deleteCartItemOnClick,
        updateCartItemOnChange
    };
  },
});
</script>
