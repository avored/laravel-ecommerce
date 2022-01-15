<template>
  <div class="w-full flex justify-center mx-auto">
    <div class="relative py-20 sm:max-w-md w-full">
      <div class="relative w-full rounded-3xl px-6 py-4 bg-gray-100 shadow-md">
        <div class="block mt-3 text-red-700 text-center text-2xl font-semibold">
            {{  t('reset_password') }}
        </div>

        <form
          method="#"
          action="#"
          @submit.prevent="onFormSubmit"
          class="mt-10"
        >
          <div class="mt-5">
            <avored-input
              field-name="password"
              field-type="password"
              :placeholder="t('new_password')"
              :field-label="t('new_password')"
              v-model="password"
            />
          </div>
          <div class="mt-5">
            <avored-input
              field-name="password_confirmation"
              field-type="password"
              :placeholder="t('password_confirmation')"
              :field-label="t('password_confirmation')"
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
              {{ t('submit') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>


<script lang="ts">
import { defineComponent, ref } from "vue"
import AvoRedInput from "@/components/forms/AvoRedInput.vue"
import { useMutation } from "@urql/vue"
import { AUTH_TOKEN, CUSTOMER_LOGGED_IN } from "@/constants"
import { useRouter } from "vue-router"
import { useI18n } from "vue-i18n"

export default defineComponent({
  components: {
    "avored-input": AvoRedInput,
  },
  setup() {
    const { t } = useI18n()
    const router = useRouter()
    const password_confirmation = ref("")
    const password = ref("")

    const loginMutation = useMutation(`
          mutation VisitorLogin (
                  $password: String!
                  $email: String!
              ){
              login (
                  email: $email
                  password: $password
              ){
                  token_type
                  access_token
                  expires_in
                  refresh_token
              }
          }
        `)

    const onFormSubmit = async () => {
      const variables = {
        password_confirmation: password_confirmation.value,
        password: password.value,
      }

      const accessToken = await loginMutation
        .executeMutation(variables)
        .then((result) => {
          return result.data.login.access_token;
        })

      localStorage.setItem(AUTH_TOKEN, accessToken);
      localStorage.setItem(CUSTOMER_LOGGED_IN, "true");
      router.push({ name: "home" });
    }
    return {
      t,
      onFormSubmit,
      password_confirmation,
      password,
    };
  },
});
</script>
