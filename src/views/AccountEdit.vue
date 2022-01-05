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
                          {{ t('edit') }} {{ t('personal_information') }}
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
                            :field-label="t('first_name')"
                            v-model="data.customerQuery.first_name"
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
                            :field-label="t('last_name')"
                            v-model="data.customerQuery.last_name"
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
                                {{ t('update_profile') }}
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
import CustomerEditMutation from "@/graphql/CustomerEditMutation"
import GetCustomerQuery from "@/graphql/GetCustomerQuery"
import AvoRedInput from '@/components/forms/AvoRedInput.vue'
import AccountSideNav from '@/components/account/AccountSideNav.vue'
import { useMutation, useQuery } from "@urql/vue"
import { useI18n } from "vue-i18n"
import { useRouter } from "vue-router"
import VueFeather from "vue-feather"

export default defineComponent({
  components: {
    'avored-input': AvoRedInput,
    'account-side-nav': AccountSideNav,
    'vue-feather': VueFeather
  },
  setup() {
    const { t } =  useI18n()
    const router = useRouter()
    const customerUpdateMutation = useMutation(CustomerEditMutation)
    const handleSubmit = () => {
        let mutationVariables = {
          first_name: result.data.value.customerQuery.first_name,
          last_name: result.data.value.customerQuery.last_name
        } 
        customerUpdateMutation.executeMutation(mutationVariables).then((result) => {
            //@todo check for error
            console.log(result)
            router.push({name: 'account'})  
        })
    }
    const result = useQuery({query: GetCustomerQuery})

    return {
      t,
      handleSubmit,
      fetching: result.fetching,
      data: result.data,
      error: result.error,
    };
  },
});
</script>
