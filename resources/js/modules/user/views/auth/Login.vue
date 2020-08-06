<template>
  <div>
    <div class="min-h-screen bg-gray-300 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
      
      <div class="sm:mx-auto py-10 bg-white shadow-lg sm:rounded-lg sm:w-full sm:max-w-md">
        <div class="">
          <img class="mx-auto h-12 w-auto" 
            src="/vendor/avored/images/logo.svg" alt="AvoRed" />
          <h2
            class="mt-6 text-center text-blue-600 text-3xl leading-9 font-semibold text-gray-900"
          >{{ $t('system.pages.user.login.title') }}</h2>
        </div>
        
        <div class="py-8 px-6 sm:px-10">
          <form action="#" method="POST" @submit.prevent="handleLoginSubmit">
            <div>
              <label
                for="email"
                class="block text-sm font-medium leading-5 text-gray-700"
              >{{ $t('system.fields.email') }}</label>
              <div class="mt-1 rounded-md shadow-sm">
                <input
                  id="email"
                  type="email"
                   v-model="user.email"
                  required
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5"
                />
              </div>
            </div>

            <div class="mt-6">
              <label
                for="password"
                class="block text-sm font-medium leading-5 text-gray-700"
              >{{ $t('system.fields.password') }}</label>
              <div class="mt-1 rounded-md shadow-sm">
                <input
                  id="password"
                  type="password"
                  v-model="user.password"
                  required
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5"
                />
              </div>
            </div>

            <div class="mt-6 flex items-center justify-between">
              <div class="flex items-center">
                <input
                  id="remember_me"
                  type="checkbox"
                  class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out"
                />
                <label
                  for="remember_me"
                  class="ml-2 block text-sm leading-5 text-gray-900"
                >{{ $t('system.pages.user.login.remember_me') }}</label>
              </div>

              <div class="text-sm leading-5">
                <a
                  href="#"
                  class="font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                >{{ $t('system.pages.user.login.forgot_password') }}</a>
              </div>
            </div>

            <div class="mt-6">
              <span class="block w-full rounded-md shadow-sm">
                <button
                  type="submit"
                  class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out"
                >{{ $t('system.btn.sign_in') }}</button>
              </span>
            </div>
          </form>
        </div>
       
      </div>
    </div>
  </div>
</template>
<script>
import Zondicon from 'vue-zondicons'
import gql from 'graphql-tag'
import UserAuth from '../../graphql/UserAuth.graphql'
import isNil from 'lodash/isNil'
import { AUTH_TOKEN } from '@/modules/system/constants'

export default {
  name: "admin-login",
  components: {},
  data() {
    return {
      user: {}
    };
  },
  methods: {
    async handleLoginSubmit(e) {
      var result = await this.authMutation(this.user);
      if (!isNil(result.adminAuth.access_token)) {
        localStorage.setItem(AUTH_TOKEN, result.adminAuth.access_token);
        this.$router.push({name: 'admin.dashboard'});
      }
    },

    async authMutation(values) {
      return this.$apollo
        .mutate({
          mutation: UserAuth,
          variables: values
        })
        .then(({data}) => {
          return data;
        })
        .catch(error => {
          window.y = error;
          //console.error(error);
        });
    }
  }
};
</script>
