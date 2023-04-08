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
                          {{ t('personal_information') }}
                      </h3>
                      <div class="ml-auto">
                        <router-link :to="{name: 'account.edit'}"> {{ t('edit') }} </router-link>
                      </div>
                    </div>
                  </div>
                  <div class="border-t border-gray-200">
                    <dl>
                      <div
                        class="
                          bg-gray-50
                          px-4
                          py-5
                          sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
                        "
                      >
                        <dt class="text-sm font-medium text-gray-500">
                            {{ t('first_name') }}
                        </dt>
                        <dd
                          class="
                            mt-1
                            text-sm text-gray-900
                            sm:mt-0 sm:col-span-2
                          "
                        >
                          {{ data.customerQuery.first_name  }}
                        </dd>
                      </div>
                      <div
                        class="
                          bg-white
                          px-4
                          py-5
                          sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
                        "
                      >
                        <dt class="text-sm font-medium text-gray-500">
                            {{ t('last_name') }}
                        </dt>
                        <dd
                          class="
                            mt-1
                            text-sm text-gray-900
                            sm:mt-0 sm:col-span-2
                          "
                        >
                          {{ data.customerQuery.last_name  }}
                        </dd>
                      </div>
                      <div
                        class="
                          bg-gray-50
                          px-4
                          py-5
                          sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
                        "
                      >
                        <dt class="text-sm font-medium text-gray-500">
                            {{ t('email') }}
                        </dt>
                        <dd
                          class="
                            mt-1
                            text-sm text-gray-900
                            sm:mt-0 sm:col-span-2
                          "
                        >
                          {{ data.customerQuery.email }}
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
import { useQuery } from "@urql/vue"
import AccountSideNav from '@/components/account/AccountSideNav.vue'
import GetCustomerQuery from "@/graphql/GetCustomerQuery"
import { useI18n } from "vue-i18n"

export default defineComponent({
  components: {
      'account-side-nav': AccountSideNav
  },
  setup() {
      const result = useQuery({query: GetCustomerQuery})
      const { t } = useI18n()
      return {
          t,
          fetching: result.fetching,
          data: result.data,
          error: result.error,
      }
  },
});
</script>
