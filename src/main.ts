import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import './assets/tailwind.css'
import urql from '@urql/vue'

createApp(App).use(store).use(router).use(urql, {url: 'https://docker-laravel.test/graphql',}).mount('#app')
