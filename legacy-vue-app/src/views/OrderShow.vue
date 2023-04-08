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
                        {{ data }}
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
// import VueFeather from 'vue-feather'
import { useQuery } from '@urql/vue'
import AccountSideNav from '@/components/account/AccountSideNav.vue'
import OrderQuery from '@/graphql/OrderQuery'
import { useI18n } from 'vue-i18n'
import { useRouter } from 'vue-router'

export default defineComponent({
  components: {
    'account-side-nav': AccountSideNav,
    // 'vue-feather': VueFeather,
  },
  setup() {
    const { t } = useI18n()
    const router = useRouter()
    const order_id = router.currentRoute.value.params.order
    console.log(order_id)
    const result = useQuery({ query: OrderQuery, variables: { order_id: order_id },  });
    return {
      t,
      fetching: result.fetching,
      data: result.data,
      error: result.error,
    };
  },
});
</script>
