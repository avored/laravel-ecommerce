import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import isNil from 'lodash/isNil'
import auth from '../middleware/auth'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta: {'middleware': 'guest', 'layout': 'app' }
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('@/views/AboutView.vue'),
      meta: {'middleware': 'guest', 'layout': 'app' }
    }
  ]
})
router.beforeEach((to, from, next) => {
  if (!isNil(to.meta.middleware))
  {
      Object.keys(to.meta).map(function(objectKey) {
          if (objectKey === "middleware" && to.meta.middleware == 'guest') {
              next()
          }
        if (objectKey === "middleware" && (to.meta.middleware == 'auth' || to.meta.middleware == 'customer')) {

            if (to.meta.middleware == 'auth' && auth.isAuth()) {
                next()
            } else if (to.meta.middleware == 'customer' && auth.isCustomer()) {
                next()
            } else {
              next('/login')
            }
        }
      });
    } else {
      next()
    }
});

export default router
