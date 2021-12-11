<template>
  <div class="">
    <div>
      <div class="my-5 container mx-auto">
        <div class="bg-white">
          <div v-if="!fetching" class="flex">
            <div class="w-40 bg-white shadow overflow-hidden sm:rounded-lg text-center">
              <account-side-nav />
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
import AccountSideNav from '@/components/account/AccountSideNav.vue'
import { useMutation, useQuery, gql } from "@urql/vue"

export default defineComponent({
  components: {
    'avored-input': AvoRedInput,
    'account-side-nav': AccountSideNav
  },
  setup() {
    const customerUpdateMutation =useMutation(gql `
                                    mutation UpdateCustomer(
                                          $first_name: String!,
                                          $last_name: String!,
                                      ) {
                                          customerUpdate(
                                            
                                              first_name: $first_name,
                                              last_name: $last_name
                                          )  {
                                              first_name
                                              last_name
                                          }
                                      }
                                `)
    
    const handleSubmit = () => {
        let mutationVariables = {
          first_name: result.data.value.customerQuery.first_name,
          last_name: result.data.value.customerQuery.last_name
        } 
        customerUpdateMutation.executeMutation(mutationVariables).then((result) => {
            console.log(result.data)
        })
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
