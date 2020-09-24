import Vue from 'vue'
import VueRouter from 'vue-router'
import isNil from 'lodash/isNil'

Vue.use(VueRouter)

let router =  new VueRouter({
	// mode: 'history',
	routes: []
})

// GLobal BEFORE hooks:
router.beforeEach((to, from, next) => { 
  
	if (!isNil(to.meta.middleware))
	{
		Object.keys(to.meta.middleware).map(function(objectKey) {
			if (objectKey === "guest" && to.meta.middleware[objectKey](to)) {
			  next()
			}
			if (objectKey === "auth" && !to.meta.middleware[objectKey](to)) {
			  next('/login');
			} else {
			  next()
			}
		})
	  } else {
		next()
	  }
  
  })
  
  export default router;
