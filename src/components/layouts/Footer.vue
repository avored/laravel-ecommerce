<template>
  <div class="mt-12">
    <footer class="text-gray-600 body-font bg-white">
      <div
        class="
          container
          py-12
          mx-auto
          flex
          md:items-center
          lg:items-start
          w-full
        "
      >
        <div
          class="w-64 flex-shrink-0 md:mx-0 mx-auto text-center md:text-left"
        >
          <a
            class="
              flex
              title-font
              font-medium
              items-center
              md:justify-start
              justify-center
            "
          >
            <img class="w-10 h-10  p-2 bg-white rounded-full" src="../../assets/logo_only.svg" alt="avored e commerce" />
            <span class="ml-3 text-xl ">{{ t('avored') }}</span>
          </a>
          <p class="mt-2 text-sm ">
              {{ t('avored_tagline') }}
          </p>
        </div>
        <div
          class="
            flex-grow flex flex-wrap
            md:pl-20
            -mb-10
            md:mt-0
            mt-10
            md:text-left
            text-center
          "
        >
          <div v-if="!fetching" class="lg:w-1/4 md:w-1/2 w-full px-4">
            <h2
              class="
                font-semibold
                tracking-widest
                text-md
                mb-3
              "
            >
              {{ t('categories') }}
            </h2>
            <nav class="list-none mb-10">
              <li v-for="(category, index) in data.allCategory"
                  :key="`footer-category-link-${index}`">
                <router-link class=" hover:text-red-300" 
                    :to="{name: 'category', params: {slug: category.slug}}">
                      {{ category.name }}
                  </router-link>
              </li>
            </nav>
          </div>
          <div class="lg:w-3/4 md:w-1/2 w-full px-4">
              <h5 class=" tracking-widest font-semibold">{{ t('signup_for_our_newsletter') }}</h5>
              <div class="mt-5 flex w-full">
                  <div class="lg:w-2/4 md:w-3/4">
                      <input
                          v-model="subscriberEmail"
                          :placeholder="t('enter_your_email_address')"
                          type="email"
                          class="w-full px-4 py-3 ring-gray-300 ring-1 focus:ring-red-500 focus:outline-none rounded shadow-sm appearance-none text-gray-700"
                      />
                  </div>
                  <button @click="notifyMeOnClick" class="ml-3 px-4 py-3 ring-1 ring-red-500 shadow-lg text-white font-semibold bg-red-500 rounded-md ">
                      {{ t('notify_me') }}
                  </button>
              </div>
          </div>
        </div>
      </div>
      <div class="bg-red-500">
        <div
          class="
            container
            mx-auto
            py-4
            px-5
            flex flex-wrap flex-col
            sm:flex-row
          "
        >
          <p class="text-white text-sm text-center sm:text-left">
            © {{ year }} —
            <a
              href="https://www.avored.com/"
              rel="noopener noreferrer"
              class="ml-1"
              target="_blank"
              >@AvoRed E commerce</a
            >
          </p>
          <span
            class="
              inline-flex
              sm:ml-auto sm:mt-0
              mt-2
              justify-center
              sm:justify-start
            "
          >
            <a class="text-gray-200" href="https://www.facebook.com/avored" target="_blank">
              <svg
                fill="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                class="w-5 h-5"
                viewBox="0 0 24 24"
              >
                <path
                  d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"
                ></path>
              </svg>
            </a>
            <a class="ml-3 text-gray-200" href="https://twitter.com/avoredecommerce" target="_blank">
              <svg
                fill="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                class="w-5 h-5"
                viewBox="0 0 24 24"
              >
                <path
                  d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"
                ></path>
              </svg>
            </a>
            <a class="ml-3 text-gray-200" href="https://linkedin.com/company/avored-e-commerce" target="_blank">
              <svg
                fill="currentColor"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="0"
                class="w-5 h-5"
                viewBox="0 0 24 24"
              >
                <path
                  stroke="none"
                  d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"
                ></path>
                <circle cx="4" cy="4" r="2" stroke="none"></circle>
              </svg>
            </a>
          </span>
        </div>
      </div>
    </footer>
  </div>
</template>

<script lang="ts">
import CategoryAllQuery from '@/graphql/CategoryAllQuery'
import { useMutation, useQuery } from "@urql/vue"
import CreateSubscriberMutation from '@/graphql/CreateSubscriberMutation'
import { defineComponent, ref } from "vue"
import { useI18n } from "vue-i18n"

export default defineComponent({

  setup () {
    const createSubscriberMutation = useMutation(CreateSubscriberMutation)
    const result = useQuery({query: CategoryAllQuery})
    const { t } = useI18n() 
    const year = new Date().getFullYear()
    const subscriberEmail = ref('')

    const notifyMeOnClick = () => {
        createSubscriberMutation.executeMutation({email: subscriberEmail.value})
            .then((result) => {
                //@todo display succssfull message clear email once we got successfulll response
                subscriberEmail.value = ''
            })
    } 
    return {
      notifyMeOnClick,
      year,
      t,
      fetching: result.fetching,
      data: result.data,
      subscriberEmail
    }
  }
});
</script>
