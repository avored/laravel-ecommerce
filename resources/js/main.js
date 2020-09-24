import Vue from 'vue'
import App from './App.vue'


import './services/components'

import i18n from './services/i18n'
import apolloProvider from './services/apollo'
import Router from './services/router'
import Store from './services/store'

import system from './modules/system'

/* Initialize System Module */

Store.registerModule('system', system.store)
Router.addRoutes(system.routes)
Store.dispatch('system/initialize', null, { root: true })

Vue.config.productionTip = false

new Vue({
  i18n,
  router: Router,
	store: Store,
  apolloProvider,
  render: h => h(App)
}).$mount('#app')
