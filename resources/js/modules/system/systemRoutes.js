
import Home from './views/Home.vue'
import Guest from '@/modules/system/middleware/guest'

export default [
  
	{
		path: '/',
		name: 'home',
		component: Home,
		meta: { 'middleware': { guest: Guest }, 'layout': 'app' }
	},
]
