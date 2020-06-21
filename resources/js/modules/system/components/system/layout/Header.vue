<template>
  <header class="text-gray-700 shadow">
  <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
    <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
     
      <img src="/images/logo.svg" class="w-8 h-8" alt="AvoRed Ecommerce" />
      <span class="text-xl leading-7 text-red-600">AvoRed</span>
    </a>
    <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
      <a class="mr-5 hover:text-gray-900">First Link</a>
      <a class="mr-5 hover:text-gray-900">Second Link</a>
      <a class="mr-5 hover:text-gray-900">Third Link</a>
      <a class="mr-5 hover:text-gray-900">Fourth Link</a>
    </nav>
    
  </div>
</header>
</template>
<script>
import meQuery from '@/modules/system/graphql/meQuery.gql'
import { AUTH_TOKEN } from '@/modules/system/constants'

export default {
  data() {
    return {
      collapsed: false,
    };
  },
  methods: {
    sideBarToggle() {
      this.$emit("toggleSideBarClicked");
    },
  },
  apollo: {
    meQuery: {
      query() {
        return meQuery;
      },
      error(error) {
          
          //this.$router.push({ name: "admin.login" });
      },
      result({ data }) {}
    }
  }
};
</script>
