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
              <account-side-nav />
            </div>

            <div class="flex-1 ml-5">
              <div>
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                  <div class="px-4 py-5 sm:px-6">
                    <div class="flex w-full">
                      <h3 class="text-lg leading-6 font-medium text-gray-900">
                          Orders Information
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
                          flex
                          w-full
                        "
                      >
                        <table class="min-w-full leading-normal">
                          <thead>
                            <tr>
                              <th
                                class="
                                  px-5
                                  py-3
                                  border-b-2 border-gray-200
                                  bg-gray-100
                                  text-left text-xs
                                  font-semibold
                                  text-gray-600
                                  uppercase
                                  tracking-wider
                                "
                              >
                                {{ t('shipping_option')  }}
                              </th>
                              <th
                                class="
                                  px-5
                                  py-3
                                  border-b-2 border-gray-200
                                  bg-gray-100
                                  text-left text-xs
                                  font-semibold
                                  text-gray-600
                                  uppercase
                                  tracking-wider
                                "
                              >
                                {{ t('payment_option')  }}
                              </th>
                              <th
                                class="
                                  px-5
                                  py-3
                                  border-b-2 border-gray-200
                                  bg-gray-100
                                  text-left text-xs
                                  font-semibold
                                  text-gray-600
                                  uppercase
                                  tracking-wider
                                "
                              >
                                {{ t('created_at') }}
                              </th>
                              <th
                                class="
                                  px-5
                                  py-3
                                  border-b-2 border-gray-200
                                  bg-gray-100
                                  text-left text-xs
                                  font-semibold
                                  text-gray-600
                                  uppercase
                                  tracking-wider
                                "
                              >
                                {{ t('quantity')  }}
                              </th>
                              <th
                                class="
                                  px-5
                                  py-3
                                  border-b-2 border-gray-200
                                  bg-gray-100
                                  text-left text-xs
                                  font-semibold
                                  text-gray-600
                                  uppercase
                                  tracking-wider
                                "
                              >
                                {{ t('status')  }}
                              </th>
                              <th
                                class="
                                  px-5
                                  py-3
                                  border-b-2 border-gray-200
                                  bg-gray-100
                                  text-left text-xs
                                  font-semibold
                                  text-gray-600
                                  uppercase
                                  tracking-wider
                                "
                              >
                                {{ t('action')  }}
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="order in data.allOrders" :key="order.id">
                              <td
                                class="
                                  px-5
                                  py-5
                                  border-b border-gray-200
                                  bg-white
                                  text-sm
                                "
                              >
                                  {{  order.shipping_option  }}
                              </td>
                              <td
                                class="
                                  px-5
                                  py-5
                                  border-b border-gray-200
                                  bg-white
                                  text-sm
                                "
                              >
                                <p class="text-gray-900 whitespace-no-wrap">
                                  {{  order.payment_option  }}
                                </p>
                              </td>
                              <td
                                class="
                                  px-5
                                  py-5
                                  border-b border-gray-200
                                  bg-white
                                  text-sm
                                "
                              >
                                <p class="text-gray-900 whitespace-no-wrap">
                                  {{ order.created_at }}
                                </p>
                              </td>
                              <td
                                class="
                                  px-5
                                  py-5
                                  border-b border-gray-200
                                  bg-white
                                  text-sm
                                "
                              >
                                <p class="text-gray-900 whitespace-no-wrap">
                                  43
                                </p>
                              </td>
                              <td
                                class="
                                  px-5
                                  py-5
                                  border-b border-gray-200
                                  bg-white
                                  text-sm
                                "
                              >
                                <span
                                  class="
                                    relative
                                    inline-block
                                    px-3
                                    py-1
                                    font-semibold
                                    text-green-900
                                    leading-tight
                                  "
                                >
                                  <span
                                    aria-hidden
                                    class="
                                      absolute
                                      inset-0
                                      bg-red-600
                                      
                                      opacity-50
                                      rounded-full
                                    "
                                  ></span>
                                  <span class="relative text-white">{{ order.order_status_name }}</span>
                                </span>
                              </td>
                              <td
                                class="
                                  px-5
                                  py-5
                                  border-b border-gray-200
                                  bg-white
                                  text-sm
                                "
                              > 
                                <router-link :to="{name: 'order.show', params: {order: order.id}}">
                                    <vue-feather type="eye"></vue-feather>
                                </router-link>
                              </td>
                            </tr>
                          </tbody>
                        </table>
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
import { defineComponent } from 'vue'
import VueFeather from 'vue-feather'
import { useQuery } from '@urql/vue'
import AccountSideNav from '@/components/account/AccountSideNav.vue'
import OrderAllQuery from '@/graphql/OrderAllQuery'
import { useI18n } from 'vue-i18n'

export default defineComponent({
  components: {
    'account-side-nav': AccountSideNav,
    'vue-feather': VueFeather,
  },
  setup() {
    const { t } = useI18n()
    const result = useQuery({ query: OrderAllQuery });
    return {
      t,
      fetching: result.fetching,
      data: result.data,
      error: result.error,
    };
  },
});
</script>
