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
                  :placeholder="t('first_name')"
                  v-model="first_name"
              />
          </div>
          <div class="mt-5">
              <avored-input 
                  field-name="last_name" 
                  :field-label="t('last_name')"
                  :placeholder="t('last_name')"
                  v-model="last_name"
              />
          </div>
          <div class="mt-5">
              <avored-input 
                  field-name="email" 
                  field-type="email" 
                  :field-label="t('email')"
                  :placeholder="t('email')"
                  v-model="email"
              />
          </div>
          <div class="mt-5">
              <avored-input 
                  field-name="password" 
                  field-type="password" 
                  :field-label="t('password')"
                  :placeholder="t('password')"
                  v-model="password"
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
import { defineComponent, ref } from "vue"
import AvoRedInput from '@/components/forms/AvoRedInput.vue'
import { useMutation } from "@urql/vue"
import { AUTH_TOKEN, CUSTOMER_LOGGED_IN } from "@/constants"
import { useRouter } from "vue-router"
import { useI18n } from "vue-i18n"

export default defineComponent({
    components: {
        'avored-input': AvoRedInput
    },
    setup () {
        const { t } = useI18n()
        const router = useRouter()
        const email = ref('')
        const password = ref('')
        const first_name = ref('')
        const last_name = ref('')

        const registerMutation = useMutation(`
            mutation CustomerRegistration( 
                $email: String!,
                $password: String!,
                $firstName: String!
                $lastName: String!
            ) {
                register (
                    email: $email,
                    password: $password
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
              lastName: last_name.value 
            };

            await registerMutation.executeMutation(variables).then((result) => {
                localStorage.setItem(AUTH_TOKEN, result.data.register.access_token)
                localStorage.setItem(CUSTOMER_LOGGED_IN, 'true')
                router.push({name: 'home'})
            })
        };
        return {
            t,
            onFormSubmit,
            email,
            password,
            first_name,
            last_name
        }
    }
})
</script>
