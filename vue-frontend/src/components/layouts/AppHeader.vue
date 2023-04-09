<template>
  <section class="bg-white shadow-md">
    <div class="container mx-auto">
      <nav class="justify-between">
        <div class="py-4 flex w-full items-center">
          
          <router-link class="flex items-center" :to="{name: 'home'}">
            <img class="w-6 h-6" src="../../assets/logo_only.svg" alt="avored e commerce" />
            <span class="text-2xl ml-3 text-red-700">AvoRed</span>
          </router-link>
          <ul v-if="!loading" class="hidden ml-auto md:flex space-x-6">
              <li v-for="(category, index) in result.allCategory"
                  :key="`category-link-${index}`"
              >
                  <router-link class="text-gray-600 hover:text-red-500 font-semibold" 
                    :to="{name: 'category', params: {slug: category.slug}}">
                      {{ category.name }}
                  </router-link>
              </li>
              <li>
                <router-link class="self-center hover:text-red-500 " :to="{name: 'account'}">
                  <vue-feather type="user"></vue-feather>
                </router-link>
              </li>
              <li>
                <router-link class="self-center hover:text-red-500 " :to="{name: 'cart'}">
                  <vue-feather type="shopping-cart"></vue-feather>
                </router-link>
              </li>
              <li v-if="isAuth">
                <router-link class="self-center hover:text-red-500 " :to="{name: 'logout'}">
                  <vue-feather type="log-out"></vue-feather>
                </router-link>
              </li>
          </ul>
          <div v-else class="lds-ellipsis">
              <div></div>
              <div></div>
              <div></div>
              <div></div>
          </div>
        </div>
      </nav>
    </div>
  </section>
</template>

<script setup lang="ts">
import CategoryAllQuery from '@/graphql/CategoryAllQuery'
import isAuth from '@/middleware/auth'
import { useQuery } from '@vue/apollo-composable'

const { loading, result }  = useQuery(CategoryAllQuery)


</script>
