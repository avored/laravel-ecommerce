import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import i18n from './i18n'

import './assets/tailwind.css'


import urql from '@urql/vue'


// import auth from './middleware/auth'

const app = createApp(App)

declare global {
    interface Window { x: any; }
}



app.use(store)
app.use(router)
app.use(i18n)
app.use(urql, {
    url: process.env.VUE_APP_GRAPHQL_API_ENDPOINT || 'https://api.avored.com/graphql',
    fetchOptions: () => {
        // return auth.getToken().then((res) => {
        //     //@todo fixed this
        //     return res ? { headers: { Authorization: `Bearer ${res}` } } : {}
        // })

        const token = localStorage.getItem('access_token')
        // while (token === null) {
            // setTimeout(() => {
            //     auth.getToken()
            // }, 500);
        // }
        // const myToken = await auth.getToken()
        
        // console.info("ignore" + myToken)
        // const token = myToken// process.env.VUE_APP_ACCESS_TOKEN
        // console
        return token ? { headers: { Authorization: `Bearer ${token}` } } : {}
    },
})

app.mount('#app')
