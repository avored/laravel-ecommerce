<template>
  <div class="">
    
    <section class="px-10 mt-5 w-full mx-auto">
        <h1 class="my-5 text-2xl text-red-700">Latest Products</h1>
        <div class="grid grid-cols-4 gap-6">
          
          <div v-for="(card, index) in products"
            :key="`product-card-${index}`" class="shadow hover:shadow-lg transition duration-300 ease-in-out xl:mb-0 lg:mb-0 md:mb-0 mb-6 cursor-pointer group">
                <div class="overflow-hidden relative">
                <img class="w-full transition duration-700 ease-in-out group-hover:opacity-60" src="https://klbtheme.com/shopwise/fashion/wp-content/uploads/2020/04/product_img10-1.jpg" alt="image" />
                <div class="w-full">
                    <div class="flex justify-center w-full absolute bottom-4 transition duration-500 ease-in-out opacity-0 group-hover:opacity-100">
                        <a href="cart.html" class="bg-gray-700 px-3 py-3 hover:bg-red-500 transition duration-300 ease-in-out">
                            <VueFeather type="shopping-cart" class="transition duration-300 ease-in-out flex justify-center items-center text-gray-100"></VueFeather>
                        </a>
                        <a href="random.html" class="bg-gray-700 px-3 py-3 hover:bg-red-500 transition duration-300 ease-in-out">
                            <VueFeather type="heart" class="transition duration-300 ease-in-out flex justify-center items-center text-gray-100"></VueFeather>
                        </a>
                        
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 bg-white">
                <a href="#" class=""><h1 class="text-gray-800 font-semibold text-lg hover:text-red-500 transition duration-300 ease-in-out">White Line Dress</h1></a>
                <div class="flex py-2">
                    <p class="mr-2 text-xs text-gray-600">$45.00</p>
                        <p class="mr-2 text-xs text-red-600 line-through">$15.00</p>
                </div>
                <div class="flex">
                    <div class="">
                        <VueFeather class="text-yellow-300 h-4 w-4" fill="yellow" type="star"></VueFeather>
                        <VueFeather class="text-yellow-300 h-4 w-4" fill="yellow" type="star"></VueFeather>
                        <VueFeather class="text-yellow-300 h-4 w-4" type="star"></VueFeather>
                        <VueFeather class="text-yellow-300 h-4 w-4" type="star"></VueFeather>
                        <VueFeather class="text-yellow-300 h-4 w-4" type="star"></VueFeather>
                    </div>
                    <div class="ml-2">
                        <p class="text-gray-500 font-medium text-sm">(1)</p>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue"
import VueFeather from 'vue-feather'

export default defineComponent({
  components: {
    VueFeather,
  },
  setup() {
    const products = [1, 2, 3, 4, 5, 6, 7, 8]

    return {
      products: products,
    };
  },
});
</script>
