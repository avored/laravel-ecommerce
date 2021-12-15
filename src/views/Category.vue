<template>
  <div v-if="!fetching" class="">
    <section class="px-10 mt-5 w-full mx-auto">
        <h1 class="my-5 text-2xl text-red-700">{{ data.category.name }}</h1>
        <div class="grid grid-cols-4 gap-6">
          <div v-for="(card, index) in data.category.products"
                  :key="`product-card-${index}`" class="shadow hover:shadow-lg transition duration-300 ease-in-out xl:mb-0 lg:mb-0 md:mb-0 mb-6 cursor-pointer group">
                      <div class="overflow-hidden relative">
                      <img class="w-full transition duration-700 ease-in-out group-hover:opacity-60" 
                          :src="card.main_image_url" 
                          :alt="card.name" />
                      <div class="w-full">
                          <div class="flex justify-center w-full absolute bottom-4 transition duration-500 ease-in-out opacity-0 group-hover:opacity-100">
                              <AddToCart :slug="card.slug" />
                          </div>
                      </div>
                  </div>
                  <div class="px-4 py-3 bg-white">
                      <a href="#" class="">
                          <h1 class="text-gray-800 font-semibold text-lg hover:text-red-500 transition duration-300 ease-in-out">
                              {{ card.name }}
                          </h1>
                      </a>
                      <div class="flex py-2">
                          <p class="text-red-600 font-bold text-2xl">${{ card.price }}</p>
                      </div>
                      <div class="flex">
                          <!-- <div class="">
                              <VueFeather class="text-yellow-300 h-4 w-4" fill="yellow" type="star"></VueFeather>
                              <VueFeather class="text-yellow-300 h-4 w-4" fill="yellow" type="star"></VueFeather>
                              <VueFeather class="text-yellow-300 h-4 w-4" type="star"></VueFeather>
                              <VueFeather class="text-yellow-300 h-4 w-4" type="star"></VueFeather>
                              <VueFeather class="text-yellow-300 h-4 w-4" type="star"></VueFeather>
                          </div> -->
                          <!-- <div class="ml-2">
                              <p class="text-gray-500 font-medium text-sm">(1)</p>
                          </div> -->
                      </div>
                  </div>
          </div>
        </div>
    </section>
  </div>
</template>

<script lang="ts">
import GetCategoryQuery from '@/graphql/GetCategory'
import AddToCart from  '@/components/catalog/AddToCart.vue'
import { useQuery } from "@urql/vue"
import { defineComponent, getCurrentInstance, ref, watch } from "vue"
import { useI18n } from 'vue-i18n'

// import AvoRedInput from '@/components/forms/AvoRedInput.vue'
// import { useMutation } from "@urql/vue"
// import { AUTH_TOKEN } from "@/constants"
import { useRouter } from "vue-router"

export default defineComponent({
    components: {
        // 'avored-input': AvoRedInput
        AddToCart
    },
  
    setup () {
        const { t } = useI18n() 
        const router = useRouter()
        const slug = ref(router.currentRoute.value.params.slug) 
        
        const result = useQuery({query: GetCategoryQuery, variables: { slug: slug.value}})


        watch(router.currentRoute, (newValue) => {
            // console.log('The new counter value is: ' + newValue.params.slug)
            slug.value = newValue.params.slug
            console.log(newValue.params.slug)
            result.executeQuery({
                variables: { slug: newValue.params.slug },
                requestPolicy: 'network-only',
            })

        })
        

        return {
          t,
          slug,
          fetching: result.fetching,
          data: result.data,
          error: result.error,
        }
    }
})
</script>
