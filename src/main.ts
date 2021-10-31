import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import './assets/tailwind.css'
import urql from '@urql/vue'

const app = createApp(App)

app.use(store)
app.use(router)
app.use(urql, {url: process.env.VUE_APP_GRAPHQL_API_ENDPOINT})

app.mount('#app')
