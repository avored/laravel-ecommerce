<template>
  <section class="mx-auto">
    <nav class="flex justify-between shadow-md text-white">
      <div class="px-5 xl:px-12 py-4 flex w-full items-center">
        <router-link class="flex items-center" :to="{name: 'home'}">
          <img class="w-6 h-6" src="../../assets/logo_only.svg" alt="avored e commerce" />
          <span class="text-2xl ml-3 text-red-700">AvoRed</span>
        </router-link>


        <ul v-if="!fetching" class="hidden md:flex px-4 mx-auto font-semibold font-heading space-x-12">
            <li v-for="(category, index) in data.allCategory"
                :key="`category-link-${index}`"
            >
                <router-link class="text-gray-600" :to="{name: 'category', params: {slug: category.slug}}">
                    {{ category.name }}
                </router-link>
            </li>
        </ul>
        <div class="hidden xl:flex items-center space-x-5">
          
          <router-link class="flex items-center text-gray-600" :to="{name: 'cart'}">
              <vue-feature type="shopping-cart"></vue-feature>
              <span class="flex absolute -mt-5 ml-4">
                  <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-red-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
              </span>
          </router-link>
          <router-link class="flex items-center text-gray-600" :to="{name: 'account'}">
            <vue-feature type="user"></vue-feature>
          </router-link>
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
          <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500">
          </span>
        </span>
      </a>
      <router-link class="navbar-burger self-center mr-12 xl:hidden" :to="{name: 'account'}">
        <vue-feature type="user"></vue-feature>
      </router-link>
    </nav>
  </section>
</template>

<script lang="ts">
import { useQuery } from "@urql/vue";
import { defineComponent } from "vue"
import VueFeather from 'vue-feather'

export default defineComponent({
  components: {
    'vue-feature': VueFeather
  },
  setup() {
    const result = useQuery({
      query: `
        {
          allCategory {
            name
            slug
          }
        }
      `,
    })


    return {
      fetching: result.fetching,
      data: result.data,
      error: result.error, 
    }

  }
});
</script>