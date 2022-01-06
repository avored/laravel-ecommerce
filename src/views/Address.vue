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
                          {{ t('address_information') }}
                      </h3>
                      <div class="ml-auto">
                          <router-link :to="{name:'address.save'}">
                              {{ t('create') }}
                          </router-link>
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
                        ADdress goes here
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
import { useI18n } from "vue-i18n"
import AddressAllQuery from "@/graphql/AddressAllQuery"

export default defineComponent({
  components: {
    'account-side-nav': AccountSideNav
  },
  setup() {
    const { t } = useI18n()
    const result = useQuery({query: AddressAllQuery})
    return {
      t,
      fetching: result.fetching,
      data: result.data,
      error: result.error,
    };
  },
});
</script>
