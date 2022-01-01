<template>
  <a
    @click.prevent="addToCartOnClick"
    class="
      bg-gray-700
      px-3
      py-3
      hover:bg-red-500
      transition
      duration-300
      ease-in-out
    "
  >
    <VueFeather
        type="shopping-cart"
        class="
            transition
            duration-300
            ease-in-out
            flex
            justify-center
            items-center
            text-gray-100
        "
    ></VueFeather>
  </a>
</template>

<script lang="ts">
import LoginMutation from "@/graphql/LoginMutation"
import AddToCartMutation from "@/graphql/AddToCartMutation"
import { defineComponent } from "vue"
import VueFeather from "vue-feather"
import { createClient, provideClient, useMutation } from "@urql/vue"

export default defineComponent({
    components: {
        VueFeather,
    },
    props: {
        slug: {
            type: [String],
            required: true,
        },
    },
    setup(props) {
        
        
        const loginMutation = useMutation(LoginMutation)
        const addToCartMutation = useMutation(AddToCartMutation)

        const addToCartOnClick = async () => {
            if (!localStorage.getItem('access_token')) {
                const accessToken = await loginMutation.executeMutation({}).then((result) => {
                    return result.data.login.access_token
                })

                localStorage.setItem('access_token', accessToken)
                const client = createClient({
                    url: process.env.VUE_APP_GRAPHQL_API_ENDPOINT || 'https://docker-laravel.test/graphql',
                    fetchOptions: () => {
                        return accessToken ? { headers: { Authorization: `Bearer ${accessToken}` } } : {}
                    },
                })
                provideClient(client)
            }
            addToCartMutation
                .executeMutation({ slug: props.slug, qty: 1 })
                .then((result) => {
                    console.log(result.data);
                })
        }

        return {
            addToCartOnClick,
        }
    }
})
</script>
