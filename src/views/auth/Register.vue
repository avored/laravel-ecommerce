<template>
  <div class="w-full flex justify-center mx-auto">
    <div class="relative py-20 sm:max-w-md w-full">
      <div class="relative w-full rounded-3xl px-6 py-4 border shadow-md">
        <div class="block mt-3 text-red-700 text-center text-2xl font-semibold">
          {{ t('register') }}
        </div>
        
        <form method="#" action="#" @submit.prevent="onFormSubmit" class="mt-10">
          <div class="mt-5">
              <avored-input 
                  field-name="first_name" 
                  :field-label="t('first_name')"
                  :field-error="_.get(validationErrors, 'first_name.0')"
                  :placeholder="t('first_name')"
                  v-model="first_name"
              />
          </div>
          <div class="mt-5">
              <avored-input 
                  field-name="last_name" 
                  :field-label="t('last_name')"
                  :field-error="_.get(validationErrors, 'last_name.0')"
                  :placeholder="t('last_name')"
                  v-model="last_name"
              />
          </div>
          <div class="mt-5">
              <avored-input 
                  field-name="email" 
                  field-type="email" 
                  :field-label="t('email')"
                  :field-error="_.get(validationErrors, 'email.0')"
                  :placeholder="t('email')"
                  v-model="email"
              />
          </div>
          <div class="mt-5">
              <avored-input 
                  field-name="password" 
                  field-type="password" 
                  :field-label="t('password')"
                  :field-error="_.get(validationErrors, 'password.0')"
                  :placeholder="t('password')"
                  v-model="password"
              />
          </div>
          <div class="mt-5">
              <avored-input 
                  field-name="password_confirmation" 
                  field-type="password" 
                  :field-label="t('password_confirmation')"
                  :field-error="_.get(validationErrors, 'password_confirmation.0')"
                  :placeholder="t('password_confirmation')"
                  v-model="password_confirmation"
              />
          </div>

          <div class="mt-7">
            <button
              class="
                bg-red-500
                w-full
                py-3
                rounded-xl
                text-white
                shadow-xl
                hover:shadow-inner
                focus:outline-none
                transition
                duration-500
                ease-in-out
                transform
                hover:-translate-x hover:scale-105
              "
            >
              {{ t('register') }}
            </button>
          </div>
          <div class="mt-7">
            <div class="flex justify-center items-center">
              <label class="mr-2">{{ t('already_have_account_with_us') }}</label>
              <router-link
                :to="{name: 'auth.login'}"
                class="
                  text-red-500
                  transition
                  duration-500
                  ease-in-out
                  transform
                  hover:-translate-x hover:scale-105
                "
              >
                {{ t('login') }}
              </router-link>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>


<script lang="ts">
import { defineComponent, ref } from 'vue'
import AvoRedInput from '@/components/forms/AvoRedInput.vue'
import { useMutation } from '@urql/vue'
import { AUTH_TOKEN, CUSTOMER_LOGGED_IN } from '@/constants'
import { useRouter } from 'vue-router'
import { useI18n } from 'vue-i18n'
import _ from 'lodash'

export default defineComponent({
    components: {
        'avored-input': AvoRedInput
    },
    setup () {
        const { t } = useI18n()
        const router = useRouter()
        const email = ref('')
        const password = ref('')
        const password_confirmation = ref('')
        const first_name = ref('')
        const last_name = ref('')
        const validationErrors = ref({})

        const registerMutation = useMutation(`
            mutation CustomerRegistration( 
                $email: String!,
                $password: String!,
                $password_confirmation: String!,
                $firstName: String!
                $lastName: String!
            ) {
                register (
                    email: $email,
                    password: $password
                    password_confirmation: $password_confirmation
                    first_name: $firstName
                    last_name: $lastName
                ) {
                    token_type
                    access_token
                    expires_in
                    refresh_token
                }
            }
          `);

        const onFormSubmit = async () => {
            const variables = { 
                email: email.value, 
                password: password.value, 
                firstName: first_name.value, 
                lastName: last_name.value,
                password_confirmation: password_confirmation.value 
            }
            await registerMutation.executeMutation(variables).then((result) => {
                if (_.get(result, 'error.graphQLErrors.0.extensions.category') === 'validation') {
                    validationErrors.value =  _.get(result, 'error.graphQLErrors.0.extensions.validation')
                } else {
                    localStorage.setItem(AUTH_TOKEN, result.data.register.access_token)
                    localStorage.setItem(CUSTOMER_LOGGED_IN, 'true')
                    router.push({name: 'home'})
                }
            })
        };
        return {
            t,
            _,
            validationErrors,
            onFormSubmit,
            email,
            password,
            first_name,
            last_name,
            password_confirmation
        }
    }
})
</script>
