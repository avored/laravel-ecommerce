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
                            Save Address Information
                        </h3>
                    </div>
                  </div>
                  <div class="border-t border-gray-200">
                    <dl>
                      <div
                        class="
                          bg-gray-50
                          px-4
                          py-5
                        "
                      >
                            <div class="mt-3 flex w-full">
                              <div class="block w-full">
                                  <label class="text-sm w-full text-gray-700">Address Type</label>
                                  <select class="w-full px-4 py-2 text-md text-gray-700">
                                      <option>Billing</option>
                                      <option>Shipping</option>
                                  </select>
                              </div>
                          </div>

                          <div class="mt-3 flex w-full">
                              <div class="w-1/2">
                                  <avored-input
                                      field-label="First Name"
                                      field-name="first_name"
                                  >
                                  </avored-input>
                              </div>
                              <div class="w-1/2 ml-3">
                                  <avored-input
                                      field-label="Last Name"
                                      field-name="last_name"
                                  >
                                  </avored-input>
                              </div>
                          </div>
                          <div class="mt-3 flex w-full">
                              <div class="w-1/2">
                                  <avored-input
                                      field-label="Compant Name"
                                      field-name="company_name"
                                  >
                                  </avored-input>
                              </div>
                              <div class="w-1/2 ml-3">
                                  <avored-input
                                      field-label="Phone"
                                      field-name="phone"
                                  >
                                  </avored-input>
                              </div>
                          </div>
                          <div class="mt-3 flex w-full">
                              <div class="w-1/2">
                                  <avored-input
                                      field-label="Address1"
                                      field-name="address1"
                                  >
                                  </avored-input>
                              </div>
                              <div class="w-1/2 ml-3">
                                  <avored-input
                                      field-label="Address2"
                                      field-name="address2"
                                  >
                                  </avored-input>
                              </div>
                          </div>
                          <div class="mt-3 flex w-full">
                              <div class="w-1/2">
                                  <avored-input
                                      field-label="Postcode"
                                      field-name="postcode"
                                  >
                                  </avored-input>
                              </div>
                              <div class="flex ml-3 w-1/2">
                              <div class="w-full">
                                  <label class="text-sm text-gray-700">Country</label>
                                  <select class="w-full p-2 text-md text-gray-700">
                                      <option>New Zealand</option>
                                      <option>United States</option>
                                  </select>
                              </div>
                          </div>
                          </div>
                          <div class="mt-3 flex w-full">
                              <div class="w-1/2">
                                  <avored-input
                                      field-label="State"
                                      field-name="state"
                                  >
                                  </avored-input>
                              </div>
                              <div class="w-1/2 ml-3">
                                  <avored-input
                                      field-label="City"
                                      field-name="city"
                                  >
                                  </avored-input>
                              </div>
                          </div>
                      </div>
                    </dl>
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
                                  Save Address
                              </span>
                          </button>
                        </dd>
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
import { useQuery } from "@urql/vue"

import AvoRedInput from '@/components/forms/AvoRedInput.vue'
import AccountSideNav from '@/components/account/AccountSideNav.vue'

export default defineComponent({
  components: {
    'avored-input': AvoRedInput,
    'account-side-nav': AccountSideNav
  },
  setup() {

    const handleSubmit = () => {
      console.log("call mutation")
    }


    const result = useQuery({
      query: `
        query AllAddresses{
            allAddress {
                    id
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
