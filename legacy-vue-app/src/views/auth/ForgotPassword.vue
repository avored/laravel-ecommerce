<template>
  <div class="w-full flex justify-center mx-auto">
    <div class="relative py-20 sm:max-w-md w-full">
      <div class="relative w-full rounded-3xl px-6 py-4 bg-gray-100 shadow-md">
        <div class="block mt-3 text-red-700 text-center text-2xl font-semibold">
            {{  t('forgot_your_password') }}
        </div>

        <form
          method="#"
          action="#"
          @submit.prevent="onFormSubmit"
          class="mt-10"
        >
          <div class="mt-5">
            <avored-input
              field-name="email"
              field-type="email"
              :placeholder="t('email')"
              :field-label="t('email')"
              v-model="email"
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
import { useI18n } from "vue-i18n"
import ForgotPasswordMutation from "@/graphql/ForgotPasswordMutation"

export default defineComponent({
  components: {
    "avored-input": AvoRedInput,
  },
  setup() {
    const { t } = useI18n()
    const email = ref("")

    const forgotPasswordMutation = useMutation(ForgotPasswordMutation)

    const onFormSubmit = async () => {
      const variables = {
        email: email.value
      }

      const mutationResult = await forgotPasswordMutation
        .executeMutation(variables)
        .then((result) => {
          return result.data.login.access_token
        })

        console.log(mutationResult)
      // router.push({ name: "home" })
    }

    return {
      t,
      onFormSubmit,
      email,
    };
  },
});
</script>
