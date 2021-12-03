<template>
    <a @click.prevent="addToCartOnClick" class="bg-gray-700 px-3 py-3 hover:bg-red-500 transition duration-300 ease-in-out">
        <VueFeather type="shopping-cart" class="transition duration-300 ease-in-out flex justify-center items-center text-gray-100"></VueFeather>
    </a>
</template>

<script lang="ts">
import { defineComponent } from "vue"
import VueFeather from 'vue-feather'
import { gql, useMutation } from '@urql/vue'


export default defineComponent({
  components: {
      VueFeather
  },
   props: {
    slug: {
      type: [String],
      required: true
    }
  },
  setup(props) {
      const addToCartMutation =useMutation(gql `
                                    mutation AddToCart($slug: String!, $qty: Float!) {
                                        addToCart(slug: $slug, qty: $qty)  {
                                            visitor_id
                                            product_id
                                            price
                                            qty
                                        }
                                    }
                                `)

      const addToCartOnClick = () => {
            addToCartMutation.executeMutation({slug: props.slug, qty: 1}).then((result) => {
                console.log(result.data)
            })
      }
    return {
        addToCartOnClick
    };
  },
});
</script>