<template>
    <a
        @click.prevent="addToCartOnClick"
        class="
        bg-gray-700
        inline-block
        px-3
        py-3
        hover:bg-red-500
        transition
        duration-300
        ease-in-out
        "
    >
        <VueFeather type="shopping-cart" class="transition duration-300 ease-in-out flex justify-center items-center text-gray-100">
            Test
        </VueFeather>
    </a>
</template>

<script lang="ts">
import AddToCartMutation from "@/graphql/AddToCartMutation"
import { defineComponent } from "vue"
import VueFeather from "vue-feather"
import { useMutation } from "@urql/vue"
import { CART_TOKEN } from "@/constants"


type CartVariables = {
  slug: string,
  qty: number,
  visitor_id: string | null
}

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
        const addToCartMutation = useMutation(AddToCartMutation)

        const addToCartOnClick = async () => {
            var variables : CartVariables = {
                slug: '',
                qty: 1,
                visitor_id: ''
            }
            variables.slug = props.slug

            if (localStorage.getItem(CART_TOKEN)) {
                variables.visitor_id = localStorage.getItem(CART_TOKEN)
            }
            addToCartMutation
                .executeMutation(variables)
                .then((result) => {
                    const items = result.data.addToCart
                    console.log(items)
                    localStorage.setItem(CART_TOKEN, items[0].visitor_id)
                })
            }

        return {
            addToCartOnClick,
        }
    }
})
</script>
