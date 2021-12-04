<template>
  <div class="">
    <div>
      <div class="my-5 container mx-auto">
        <div class="bg-white">
          <div v-if="!fetching" class="flex">
            <div
              class="
                w-40
                bg-white
                shadow
                overflow-hidden
                sm:rounded-lg
                text-center
              "
            >
              <nav class="">
                <ul class="block text-center">
                  <li class="py-3 border-b block">
                    <router-link :to="{name: 'account.edit'}" class="py-3">Edit Profile </router-link>
                  </li>
                  <li class="py-3 border-b block">
                    <a class="py-3" href="#"> Addresses </a>
                  </li>
                  <li class="py-3 border-b block">
                    <a class="py-3" href="#"> Orders </a>
                  </li>
                  <li class="py-3 border-b block">
                    <a class="py-3" href="#"> My Wishlist </a>
                  </li>
                  <li class="py-3 border-b block">
                    <a class="py-3" href="#"> Logout </a>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="flex-1 ml-5">
              <div>
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                  <div class="px-4 py-5 sm:px-6">
                    <div class="flex w-full">
                      <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Edit Personal Information
                      </h3>
                    </div>
                  </div>
                  <div class="border-t border-gray-200">
                    <dl>
                      <div
                        class="
                          px-4
                          py-5
                          sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
                        "
                      >
                        <dd
                          class="
                            mt-1
                            text-sm text-gray-900
                            sm:mt-0 sm:col-span-2
                          "
                        >
                          <avored-input
                            field-label="First Name"
                            :model-value="data.customerQuery.first_name"
                          ></avored-input>
                        </dd>
                      </div>
                      <div
                        class="
                          px-4J
                          py-5
                          sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
                        "
                      >
                        <dd
                          class="
                            mt-1
                            text-sm text-gray-900
                            sm:mt-0 sm:col-span-2
                          "
                        >
                          <avored-input
                            field-label="Last Name"
                            :model-value="data.customerQuery.last_name"
                          ></avored-input>
                        </dd>
                      </div>
                      <div
                        class="
                          px-4
                          py-5
                          sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
                        "
                      >
                        <dd
                          class="
                            mt-1
                            text-sm text-gray-900
                            sm:mt-0 sm:col-span-2
                          "
                        >
                          <avored-input
                            field-label="Email Address"
                            :model-value="data.customerQuery.email"
                            :is-disabled="true"
                          ></avored-input>
                        </dd>
                      </div>
                      <div
                        class="
                          px-4
                          py-5
                          sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
                        "
                      >
                        <dd
                          class="
                            mt-1
                            text-sm text-gray-900
                            sm:mt-0 sm:col-span-2
                          "
                        >
                          <button @click="handleSubmit"
                            class="bg-red-500 block font-semibold hover:bg-red-600 py-3 text-sm text-white uppercase w-full">
                              <span class="flex justify-center">
                                <vue-feather class="mr-5" type="shopping-cart"></vue-feather>
                                Update Profile
                              </span>
                          </button>
                        </dd>
                      </div>
                    </dl>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue"
import AvoRedInput from '@/components/forms/AvoRedInput.vue'
import { useQuery } from "@urql/vue"

export default defineComponent({
  components: {
    'avored-input': AvoRedInput
  },
  setup() {
    const handleSubmit = () => {
      console.log("call mutation")
    }
    const result = useQuery({
      query: `
        query GetCustomer{
            customerQuery {
                    id
                    first_name
                    last_name
                    email
                    created_at
                    updated_at
            }
        }
      `,
    });
    return {
      handleSubmit,
      fetching: result.fetching,
      data: result.data,
      error: result.error,
    };
  },
});
</script>
