<template>
  <div v-if="!fetching" class="">
    <h1>This is an category page {{ slug.value }}</h1>
    <p>{{ data }}</p>
  </div>
</template>

<script lang="ts">
import { useQuery } from "@urql/vue"
import { defineComponent, getCurrentInstance, ref, watch } from "vue"
// import AvoRedInput from '@/components/forms/AvoRedInput.vue'
// import { useMutation } from "@urql/vue"
// import { AUTH_TOKEN } from "@/constants"
import { useRouter } from "vue-router"

export default defineComponent({
    components: {
        // 'avored-input': AvoRedInput
    },
  
    setup () {
        const router = useRouter()
        const slug = ref(router.currentRoute.value.params.slug) 
        
        const result = useQuery({
                          query: `
                            query ($slug: String!) {
                              category(slug: $slug,) {
                                id
                                name
                                products {
                                  id
                                  name
                                  price
                                }
                              }
                            }
                          `,
                        variables: { slug: slug.value}
                      })


        watch(router.currentRoute, (newValue) => {
            // console.log('The new counter value is: ' + newValue.params.slug)
            slug.value = newValue.params.slug
            console.log(newValue.params.slug)
            result.executeQuery({
                variables: { slug: newValue.params.slug },
                requestPolicy: 'network-only',
            })

            // console.log(result.executeQuery({
            //   requestPolicy: 'network-only',
            //   variables: { slug: newValue.params.slug }
            // }))
            // console.log(result)
            // instance.proxy.$forceUpdate();
        })
        // console.log(router.currentRoute.value.params.slug)
        

        return {
          slug,
          fetching: result.fetching,
          data: result.data,
          error: result.error, 
         
        }
    }
})
</script>
