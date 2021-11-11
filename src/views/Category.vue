<template>
  <div class="">
    <h1>This is an category page</h1>
    <p>{{ data }}</p>
  </div>
</template>

<script lang="ts">
import { useQuery } from "@urql/vue"
import { defineComponent } from "vue"
// import AvoRedInput from '@/components/forms/AvoRedInput.vue'
// import { useMutation } from "@urql/vue"
// import { AUTH_TOKEN } from "@/constants"
// import { useRouter } from "vue-router"

export default defineComponent({
    components: {
        // 'avored-input': AvoRedInput
    },
    setup () {
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
                        variables: { slug: 'avored' }
                      });

    console.log(result.data)
    return {
      fetching: result.fetching,
      data: result.data,
      error: result.error, 
    }
    }
})
</script>