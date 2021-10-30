import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import './assets/tailwind.css'
import urql from '@urql/vue'

createApp(App).use(store).use(router).use(urql, {url: process.env.VUE_APP_GRAPHQL_API_ENDPOINT}).mount('#app')
