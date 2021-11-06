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
    
      <router-link class="navbar-burger self-center text-black mr-12" :to="{name: 'account'}">
          <vue-feature type="user"></vue-feature>
      </router-link>
      <router-link class="navbar-burger self-center text-black mr-12" :to="{name: 'logout'}">
          Logout
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