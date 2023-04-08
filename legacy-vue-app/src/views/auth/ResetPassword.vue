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
              field-type="email"
              :placeholder="t('email')"
              :field-label="t('email')"
              v-model="email"
            />
          </div>
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
import { useRouter } from "vue-router"
import { useI18n } from "vue-i18n"
import ResetPasswordMutation from "@/graphql/ResetPasswordMutation"

export default defineComponent({
  components: {
    "avored-input": AvoRedInput,
  },
  setup() {
    const { t } = useI18n()
    const router = useRouter()
    const password_confirmation = ref("")
    const password = ref("")
    const email = ref("")
    const resetPasswordMutation = useMutation(ResetPasswordMutation)

    const onFormSubmit = async () => {
      const variables = {
        email: email.value,
        token: router.currentRoute.value.query.token,
        password_confirmation: password_confirmation.value,
        password: password.value,
      }

      const result = await resetPasswordMutation
        .executeMutation(variables)
        .then((result) => {
          return result.data.success
        })

      if (result) {
          router.push({ name: "auth.login" });
      }
    }
    return {
      t,
      onFormSubmit,
      password_confirmation,
      password,
      email
    };
  },
});
</script>
