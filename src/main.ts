import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import './assets/tailwind.css'
import urql from '@urql/vue'
import auth from './middleware/auth'

const app = createApp(App)

declare global {
    interface Window { x: any; }
}


app.use(store)
app.use(router)
app.use(urql, {
    url: process.env.VUE_APP_GRAPHQL_API_ENDPOINT || 'https://docker-laravel.test/graphql',
    fetchOptions: () => {
        // return auth.getToken().then((res) => {
        //     //@todo fixed this
        //     return res ? { headers: { Authorization: `Bearer ${res}` } } : {}
        // })
        const token = process.env.ACCESS_TOKEN
        return token ? { headers: { Authorization: `Bearer ${token}` } } : {}
    },
})

app.mount('#app')
