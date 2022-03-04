<template>
  <div v-if="!fetching" class="">
    <section class="px-10 mt-5 w-full mx-auto">
        <div v-if="!fetching" class="w-full max-w-6xl rounded bg-white shadow-xl p-10 lg:p-20 mx-auto text-gray-800 relative md:text-left">
        <div class="md:flex items-center -mx-10">
            <div class="w-full md:w-1/2 px-10 mb-10 md:mb-0">
                <div class="relative">
                    <img src="https://pngimg.com/uploads/raincoat/raincoat_PNG53.png" class="w-full relative z-10" alt="">
                    <div class="border-4 border-red-200 absolute top-10 bottom-10 left-10 right-10 z-0"></div>
                </div>
            </div>
            <div class="w-full md:w-1/2 px-10">
                <div class="mb-10">
                    <h1 class="font-bold uppercase text-2xl mb-5">
                        {{ data.product.name }}
                    </h1>
                    <p class="text-sm">
                            {{ data.product.description }}
                    </p>
                </div>
                <div>
                    <div class="inline-block align-bottom mr-5">
                        <span class="text-2xl leading-none align-baseline">$</span>
                        <span class="font-bold text-5xl leading-none align-baseline">
                            {{ data.product.price }}
                        </span>
                        <span class="align-bottom ml-5">
                            <AddToCart :slug="data.product.slug" />
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
  </div>
</template>

<script lang="ts">
import AddToCart from  '@/components/catalog/AddToCart.vue'
import { useQuery } from "@urql/vue"
import { defineComponent, ref } from "vue"
import { useI18n } from 'vue-i18n'
import ProductQuery from '@/graphql/ProductQuery'
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

        
        const result = useQuery({query: ProductQuery, variables: { slug: slug.value}})


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
