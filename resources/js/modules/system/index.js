import Vue from 'vue'
import routes from './systemRoutes'
import store from './systemStore'

import LoginLayout from './layouts/Login'
import AppLayout from './layouts/App'

Vue.component('app-layout', AppLayout)
Vue.component('login-layout', LoginLayout)


export default {
	name: 'system',
	routes: routes,
	store: store
}
