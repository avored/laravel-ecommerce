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
                            {{ t('save_address_information') }}
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
                                  <label class="text-sm w-full text-gray-700">
                                      {{ t('address_type') }}
                                  </label>
                                  <select 
                                    v-model="address.type" 
                                    class="w-full px-4 py-2 text-md text-gray-700">
                                      <option value="BILLING">{{ t('billing') }}</option>
                                      <option value="SHIPPING">{{ t('shipping') }}</option>
                                  </select>
                                  <p v-if="_.get(validationErrors, 'type.0')" 
                                    class="text-red-500 mt-1 text-sm">
                                      {{ _.get(validationErrors, 'type.0') }}
                                  </p>
                              </div>
                          </div>

                          <div class="mt-3 flex w-full">
                              <div class="w-1/2">
                                  <avored-input
                                      v-model="address.first_name"
                                      :field-error="_.get(validationErrors, 'first_name.0')"
                                      :field-label="t('first_name')"
                                      :placeholder="t('first_name')"
                                      field-name="first_name"
                                  >
                                  </avored-input>
                              </div>
                              <div class="w-1/2 ml-3">
                                  <avored-input
                                      v-model="address.last_name"
                                      :field-error="_.get(validationErrors, 'last_name.0')"
                                      :field-label="t('last_name')"
                                      :placeholder="t('last_name')"
                                      field-name="last_name"
                                  >
                                  </avored-input>
                              </div>
                          </div>
                          <div class="mt-3 flex w-full">
                              <div class="w-1/2">
                                  <avored-input
                                      v-model="address.company_name"
                                      :field-label="t('company_name')"
                                      :field-error="_.get(validationErrors, 'company_name.0')"
                                      :placeholder="t('company_name')"
                                      field-name="company_name"
                                  >
                                  </avored-input>
                              </div>
                              <div class="w-1/2 ml-3">
                                  <avored-input
                                      v-model="address.phone"
                                      :field-label="t('phone')"
                                      :field-error="_.get(validationErrors, 'phone.0')"
                                      :placeholder="t('phone')"
                                      field-name="phone"
                                  >
                                  </avored-input>
                              </div>
                          </div>
                          <div class="mt-3 flex w-full">
                              <div class="w-1/2">
                                  <avored-input
                                      v-model="address.address1"
                                      :field-error="_.get(validationErrors, 'address1.0')"
                                      :field-label="t('address1')"
                                      :placeholder="t('address1')"
                                      field-name="address1"
                                  >
                                  </avored-input>
                              </div>
                              <div class="w-1/2 ml-3">
                                  <avored-input
                                      v-model="address.address2"
                                      :field-error="_.get(validationErrors, 'address2.0')"
                                      :field-label="t('address2')"
                                      :placeholder="t('address2')"
                                      field-name="address2"
                                  >
                                  </avored-input>
                              </div>
                          </div>
                          <div class="mt-3 flex w-full">
                              <div class="w-1/2">
                                  <avored-input
                                      v-model="address.postcode"
                                      :field-label="t('postcode')"
                                      :field-error="_.get(validationErrors, 'postcode.0')"
                                      :placeholder="t('postcode')"
                                      field-name="postcode"
                                  >
                                  </avored-input>
                              </div>
                              <div class="flex ml-3 w-1/2">
                              <div class="w-full"  v-if="!countryOptionsResultFetching">
                                  <label class="text-sm text-gray-700">
                                      {{ t('country') }}
                                  </label>
                                  <select v-model="address.country_id" class="w-full p-2 text-md text-gray-700 focus:ring-1 focus:ring-red-600">
                                      <template v-for="countryOption in countryOptionsResult.countryOptions" :key="countryOption.value">
                                          <option :value="countryOption.value">
                                            {{ countryOption.label }}
                                          </option>
                                      </template>
                                  </select>
                                  <p v-if="_.get(validationErrors, 'country_id.0')" 
                                    class="text-red-500 mt-1 text-sm">
                                      {{ _.get(validationErrors, 'country_id.0') }}
                                  </p>
                              </div>
                          </div>
                          </div>
                          <div class="mt-3 flex w-full">
                              <div class="w-1/2">
                                  <avored-input
                                      v-model="address.state"
                                      :field-error="_.get(validationErrors, 'state.0')"
                                      :field-label="t('state')"
                                      :placeholder="t('state')"
                                      field-name="state"
                                  >
                                  </avored-input>
                              </div>
                              <div class="w-1/2 ml-3">
                                  <avored-input
                                      v-model="address.city"
                                      :field-label="t('city')"
                                      :field-error="_.get(validationErrors, 'city.0')"
                                      :placeholder="t('city')"
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
                                  <vue-feather class="mr-5" type="save"></vue-feather>
                                  {{  t('save_address') }}
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
import { defineComponent, ref } from 'vue'
import { useMutation, useQuery } from '@urql/vue'

import AvoRedInput from '@/components/forms/AvoRedInput.vue'
import AccountSideNav from '@/components/account/AccountSideNav.vue'
import { useI18n } from 'vue-i18n'
import CountryOptionsQuery from '@/graphql/CountryOptionsQuery'
import CreateAddressMutation from '@/graphql/CreateAddressMutation'
import VueFeather from 'vue-feather'
import { useRouter } from 'vue-router'
import _ from 'lodash'

export default defineComponent({
  components: {
    'avored-input': AvoRedInput,
    'account-side-nav': AccountSideNav,
    'vue-feather': VueFeather
  },
  setup() {
    const { t } = useI18n()
    const router = useRouter()
    const validationErrors = ref({})
    const address = ref({
        type: '',
        first_name: '',
        last_name: '',
        company_name: '',
        phone: '',
        address1: '',
        address2: '',
        postcode: '',
        country_id: '',
        state: '',
        city: ''
    })
    
    const handleSubmit = () => {
        createAddressMutation.executeMutation(address).then((result) => {
            if (_.get(result, 'error.graphQLErrors.0.extensions.category') === 'validation') {
                validationErrors.value =  _.get(result, 'error.graphQLErrors.0.extensions.validation')
            } else {
                router.push({name: 'account'})
            }
        })
    }

    const createAddressMutation = useMutation(CreateAddressMutation)
    const countryQueryResult = useQuery({query: CountryOptionsQuery})

    return {
      _,
      t,
      address,
      validationErrors,
      handleSubmit,
      countryOptionsResult: countryQueryResult.data,
      countryOptionsResultFetching: countryQueryResult.fetching,
      fetching: false,
    }
  },
});
</script>
