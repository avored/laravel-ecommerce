<template>
  <div class="w-full flex justify-center mx-auto">
    <div class="relative py-20 sm:max-w-md w-full">
      <div class="relative w-full rounded-3xl px-6 py-4 bg-gray-100 shadow-md">
        <div class="block mt-3 text-red-700 text-center text-2xl font-semibold">
          Login
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
              field-label="Email address"
              v-model="email"
            />
          </div>
          <div class="mt-5">
            <avored-input
              field-name="password"
              field-type="password"
              field-label="Password"
              v-model="password"
            />
          </div>

          <div class="mt-7 flex">
            <label
              for="remember_me"
              class="inline-flex items-center w-full cursor-pointer"
            >
              <input
                id="remember_me"
                type="checkbox"
                class="
                  rounded
                  border-gray-300
                  text-indigo-600
                  shadow-sm
                  focus:border-indigo-300
                  focus:ring
                  focus:ring-indigo-200
                  focus:ring-opacity-50
                "
                name="remember"
              />
              <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>

            <div class="w-full text-right">
              <a
                class="underline text-sm text-gray-600 hover:text-gray-900"
                href="#"
              >
                Forgot your password?
              </a>
            </div>
          </div>

          <div class="mt-7">
            <button
              class="
                bg-blue-500
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
              Login
            </button>
          </div>

          <div class="mt-7">
            <div class="flex justify-center items-center">
              <label class="mr-2">Don't have an account with us?</label>
              <router-link
                :to="{ name: 'auth.register' }"
                class="
                  text-blue-500
                  transition
                  duration-500
                  ease-in-out
                  transform
                  hover:-translate-x hover:scale-105
                "
              >
                Register
              </router-link>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>


<script lang="ts">
import { defineComponent, ref } from "vue";
import LoginMutation from "@/graphql/LoginMutation";
import AvoRedInput from "@/components/forms/AvoRedInput.vue";
import { useMutation } from "@urql/vue";
import { AUTH_TOKEN, CUSTOMER_LOGGED_IN } from "@/constants";
import { useRouter } from "vue-router";

export default defineComponent({
  components: {
    "avored-input": AvoRedInput,
  },
  setup() {
    const router = useRouter();
    const email = ref("");
    const password = ref("");

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
        `);

    const onFormSubmit = async () => {
      const variables = {
        email: email.value,
        password: password.value,
      };

      const accessToken = await loginMutation
        .executeMutation(variables)
        .then((result) => {
          return result.data.login.access_token;
        });

      localStorage.setItem(AUTH_TOKEN, accessToken);
      localStorage.setItem(CUSTOMER_LOGGED_IN, "true");
      router.push({ name: "home" });
    };
    return {
      onFormSubmit,
      email,
      password,
    };
  },
});
</script>
