<template>
  <div class="">
    <section class="mx-auto">
      <!-- navbar -->
      <nav class="flex justify-between shadow-md text-white">
        <div class="px-5 xl:px-12 py-4 flex w-full items-center">
          <a class="flex items-center" href="#">
            <img class="w-6 h-6" src="../assets/logo_only.svg" alt="avored e commerce">
            <span class="text-2xl ml-3 text-red-700">AvoRed</span>
          </a>
          <!-- Nav Links -->
          <ul
            class="
              hidden
              md:flex
              px-4
              mx-auto
              font-semibold font-heading
              space-x-12
            "
          >
            <li><a class="text-gray-600" href="#">Home</a></li>
            <li><a class="text-gray-600" href="#">Catagory</a></li>
            <li><a class="text-gray-600" href="#">Collections</a></li>
            <li><a class="text-gray-600" href="#">Contact Us</a></li>
          </ul>
          <!-- Header Icons -->
          <div class="hidden xl:flex items-center space-x-5 items-center">
            <a class="text-gray-600" href="#">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                />
              </svg>
            </a>
            <a class="flex items-center text-gray-600" href="#">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                />
              </svg>
              <span class="flex absolute -mt-5 ml-4">
                <span
                  class="
                    animate-ping
                    absolute
                    inline-flex
                    h-3
                    w-3
                    rounded-full
                    bg-red-400
                    opacity-75
                  "
                ></span>
                <span
                  class="relative inline-flex rounded-full h-3 w-3 bg-red-500"
                >
                </span>
              </span>
            </a>
            <!-- Sign In / Register      -->
            <a class="flex items-center text-gray-600" href="#">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 text-gray-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
            </a>
          </div>
        </div>
        <!-- Responsive navbar -->
        <a class="xl:hidden flex mr-6 items-center" href="#">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6 text-gray-600"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
            />
          </svg>
          <span class="flex absolute -mt-5 ml-4">
            <span
              class="
                animate-ping
                absolute
                inline-flex
                h-3
                w-3
                rounded-full
                bg-pink-400
                opacity-75
              "
            ></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-pink-500">
            </span>
          </span>
        </a>
        <a class="navbar-burger self-center mr-12 xl:hidden" href="#">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6 text-gray-600"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"
            />
          </svg>
        </a>
      </nav>
    </section>

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
    <div class="mt-12">
      <footer class="text-gray-600 body-font bg-gray-700">
        <div class="container px-5 py-24 mx-auto flex md:items-center lg:items-start md:flex-row md:flex-nowrap flex-wrap flex-col">
          <div class="w-64 flex-shrink-0 md:mx-0 mx-auto text-center md:text-left">
            <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white p-2 bg-red-700 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
              </svg>
              <span class="ml-3 text-xl text-white">DEV</span>
            </a>
            <p class="mt-2 text-sm text-white">Air plant banjo lyft occupy retro adaptogen indego</p>
          </div>
          <div class="flex-grow flex flex-wrap md:pl-20 -mb-10 md:mt-0 mt-10 md:text-left text-center">
            <div class="lg:w-1/4 md:w-1/2 w-full px-4">
              <h2 class="title-font font-bold text-white tracking-widest text-md mb-3">CATEGORIES</h2>
              <nav class="list-none mb-10">
                <li>
                  <a class="text-white hover:text-red-300" href="#">First Link</a>
                </li>
                <li>
                  <a class="text-white hover:text-red-300" href="#">Second Link</a>
                </li>
                <li>
                  <a class="text-white hover:text-red-300" href="#">Third Link</a>
                </li>
                <li>
                  <a class="text-white hover:text-red-300" href="#">Fourth Link</a>
                </li>
              </nav>
            </div>
            <div class="lg:w-1/4 md:w-1/2 w-full px-4">
              <h2 class="title-font font-bold text-white tracking-widest text-md mb-3">CATEGORIES</h2>
              <nav class="list-none mb-10">
                <li>
                  <a class="text-white hover:text-red-300" href="#">First Link</a>
                </li>
                <li>
                  <a class="text-white hover:text-red-300" href="#">Second Link</a>
                </li>
                <li>
                  <a class="text-white hover:text-red-300" href="#">Third Link</a>
                </li>
                <li>
                  <a class="text-white hover:text-red-300" href="#">Fourth Link</a>
                </li>
              </nav>
            </div>
            <div class="lg:w-1/4 md:w-1/2 w-full px-4">
              <h2 class="title-font font-bold text-white tracking-widest text-md mb-3">CATEGORIES</h2>
              <nav class="list-none mb-10">
                <li>
                  <a class="text-white hover:text-red-300" href="#">First Link</a>
                </li>
                <li>
                  <a class="text-white hover:text-red-300" href="#">Second Link</a>
                </li>
                <li>
                  <a class="text-white hover:text-red-300" href="#">Third Link</a>
                </li>
                <li>
                  <a class="text-white hover:text-red-300" href="#">Fourth Link</a>
                </li>
              </nav>
            </div>
            <div class="lg:w-1/4 md:w-1/2 w-full px-4">
              <h2 class="title-font font-bold text-white tracking-widest text-md mb-3">CATEGORIES</h2>
              <nav class="list-none mb-10">
                <li>
                  <a class="text-white hover:text-red-300" href="#">First Link</a>
                </li>
                <li>
                  <a class="text-white hover:text-red-300" href="#">Second Link</a>
                </li>
                <li>
                  <a class="text-white hover:text-red-300" href="#">Third Link</a>
                </li>
                <li>
                  <a class="text-white hover:text-red-300" href="#">Fourth Link</a>
                </li>
              </nav>
            </div>
          </div>
        </div>
        <div class="bg-red-500">
          <div class="container mx-auto py-4 px-5 flex flex-wrap flex-col sm:flex-row">
            <p class="text-white text-sm text-center sm:text-left">© 2020 Dev —
              <a href="https://twitter.com/knyttneve" rel="noopener noreferrer" class="ml-1" target="_blank">@Developer</a>
            </p>
            <span class="inline-flex sm:ml-auto sm:mt-0 mt-2 justify-center sm:justify-start">
              <a class="text-gray-200">
                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                  <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                </svg>
              </a>
              <a class="ml-3 text-gray-200">
                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                  <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                </svg>
              </a>
              <a class="ml-3 text-gray-200">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                  <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                  <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                </svg>
              </a>
              <a class="ml-3 text-gray-200">
                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                  <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
                  <circle cx="4" cy="4" r="2" stroke="none"></circle>
                </svg>
              </a>
            </span>
          </div>
        </div>
      </footer>
    </div>
  </div>
</template>

<script lang="ts">
import { useQuery } from "@urql/vue"
import { defineComponent } from "vue"
import VueFeather from 'vue-feather'

export default defineComponent({
  components: {
    VueFeather
  },
  setup() {
    const result = useQuery({
      query: `
        {
          allCategory {
            id
            name
          }
        }
      `,
    });

    const products = [1, 2, 3, 4, 5, 6, 7, 8]

    return {
      products: products,
      fetching: result.fetching,
      data: result.data,
      error: result.error,
    };
  },
});
</script>
