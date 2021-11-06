<template>
  <div class="w-full flex justify-center mx-auto">
    <div class="relative py-20 sm:max-w-md w-full">
      <div class="relative w-full rounded-3xl px-6 py-4 border shadow-md">
        <div class="block mt-3 text-red-700 text-center text-2xl font-semibold">
          Register
        </div>
        
        <form method="#" action="#" @submit.prevent="onFormSubmit" class="mt-10">
          <div class="mt-5">
              <avored-input 
                  field-name="first_name" 
                  field-label="First Name"
                  v-model="first_name"
              />
          </div>
          <div class="mt-5">
              <avored-input 
                  field-name="last_name" 
                  field-label="Last Name"
                  v-model="last_name"
              />
          </div>
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
              Register
            </button>
          </div>

          <div class="flex mt-7 items-center text-center">
            <hr class="border-gray-300 border-1 w-full rounded-md" />
            <label class="block font-medium text-sm text-gray-600 w-full">
              Login With
            </label>
            <hr class="border-gray-300 border-1 w-full rounded-md" />
          </div>
          <div class="mt-7">
            <div class="flex justify-center items-center">
              <label class="mr-2">Already have an account with us?</label>
              <router-link
                :to="{name: 'auth.login'}"
                class="
                  text-blue-500
                  transition
                  duration-500
                  ease-in-out
                  transform
                  hover:-translate-x hover:scale-105
                "
              >
                Login
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
import { AUTH_TOKEN } from "@/constants"
import { useRouter } from "vue-router"

export default defineComponent({
    components: {
        'avored-input': AvoRedInput
    },
    setup () {
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
                router.push({name: 'home'})
            })
        };
        return {
            onFormSubmit,
            email,
            password,
            first_name,
            last_name
        }
    }
})
</script>