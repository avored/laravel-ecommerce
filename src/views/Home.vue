<template>
  <div class="" v-if="!fetching">
    <section class="px-10 mt-5 w-full mx-auto">
        <h1 class="my-5 text-2xl text-red-700">Latest Products</h1>
        <div class="grid grid-cols-4 gap-6">
            <div v-for="(card, index) in products.latestProductQuery"
              :key="`product-card-${index}`" class="shadow hover:shadow-lg transition duration-300 ease-in-out xl:mb-0 lg:mb-0 md:mb-0 mb-6 cursor-pointer group">
                  <div class="overflow-hidden relative">
                      <router-link :to="{name: 'product.show', params: {slug: card.slug}}" class="">
                          <img class="w-full transition duration-700 ease-in-out group-hover:opacity-60" 
                              :src="card.main_image_url" 
                              :alt="card.name" />
                          <div class="w-full">
                              <div class="flex justify-center w-full absolute bottom-4 transition duration-500 ease-in-out opacity-0 group-hover:opacity-100">
                                  <AddToCart :slug="card.slug" />
                              </div>
                          </div>
                      </router-link>
                  </div>
                  <div class="px-4 py-3 bg-white">
                      <router-link :to="{name: 'product.show', params: {slug: card.slug}}" class="">
                          <h1 class="text-gray-800 font-semibold text-lg hover:text-red-500 transition duration-300 ease-in-out">
                              {{ card.name }}
                          </h1>
                      </router-link>
                      <div class="flex py-2">
                          <p class="text-red-600 font-bold text-2xl">${{ card.price }}</p>
                      </div>
                  </div>
            </div>
        </div>
    </section>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue"
// import VueFeather from 'vue-feather'
import { useQuery } from "@urql/vue"
import AddToCart from  '@/components/catalog/AddToCart.vue'
import LatestProductQuery from '@/graphql/LatestProductQuery'


export default defineComponent({
  components: {
      AddToCart
  },
  setup() {
      const result = useQuery({query: LatestProductQuery})
      document.title = "AvoRed Laravel E commerce"
      return {
          fetching: result.fetching,
          products: result.data,
      }
  },
})
</script>
