
import Guest from '@/modules/system/middleware/guest'

export default [
	{
		path: '/login',
		name: 'login',
		component: () => import('./views/auth/Login.vue'),
		meta: { 'middleware': { guest: Guest }, 'layout': 'app' }
	},
	{
		path: '/logout',
		name: 'logout',
		component: () => import('./views/auth/Logout.vue'),
		meta: { 'middleware': { guest: Guest }, 'layout': 'login' }
	},
]
