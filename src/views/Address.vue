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
                          <router-link :to="{name:'address.create'}">
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
                          sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6
                        "
                      >
                        <div class="border p-5 w-full" v-for="address in data.allAddress" :key="address.id">
                            <div class="flex p-3 mb-5 border-b">
                                <span>{{ address.type}}</span>
                                <span class="ml-auto">
                                    <router-link :to="{name: 'address.update', params: {id: address.id}}">
                                        {{ t('edit') }}
                                    </router-link>
                                </span>
                            </div>
                            <p>{{  address.first_name }} {{  address.last_name }}</p>
                            <p>{{  address.company_name }} {{  address.phone }}</p>
                            <p>{{  address.address1 }}, </p>
                            <p>{{  address.address2 }}</p>
                            <p>{{  address.city }}</p>
                            <p>{{  address.state }} {{  address.postcode }}</p>
                        </div>
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
