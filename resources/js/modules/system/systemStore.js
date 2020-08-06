import Store from '@/services/store'
import Router from '@/services/router'

import userModule from './../user'

export default {
	namespaced: true,
	
	state: {
		title: ''
	},
	
	getters: {
		pageTitle (state) {
			return state.title
		}
	},
	
	mutations: {
		pageTitle (state, payload) {
			state.title = payload
		}
	},
	
	actions: {
		initialize ({ dispatch }) {
			dispatch('initializeModule', userModule)
		},
		initializeModule ({ dispatch }, module) {
			Store.registerModule(module.name, module.store)
			Router.addRoutes(module.routes)
			dispatch(module.name + '/initialize', null, { root: true })
		},
		setPageTitle ({ commit, state }, title) {
			commit('pageTitle', title)
		}
	}
}
