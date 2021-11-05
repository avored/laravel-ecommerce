import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import Home from '../views/Home.vue'
import isNil from 'lodash/isNil'
import guest from '../middleware/guest'
import auth from '../middleware/auth'

declare module 'vue-router' {
  interface RouteMeta {
    middleware: string
    layout: string
  }
}

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: {'middleware': 'guest', 'layout': 'app' }
  },
  
  {
    path: '/category/:slug',
    name: 'category',
    component: () => import('../views/Account.vue'),
    meta: {'middleware': 'guest', 'layout': 'app' }
  },
  {
    path: '/cart',
    name: 'cart',
    component: () => import('../views/Account.vue'),
    meta: {'middleware': 'guest', 'layout': 'app' }
  },
  {
    path: '/login',
    name: 'auth.login',
    component: () => import('../views/auth/Login.vue'),
    meta: {'middleware': 'guest', 'layout': 'app' }
  },
  {
    path: '/register',
    name: 'auth.register',
    component: () => import('../views/auth/Register.vue'),
    meta: {'middleware': 'guest', 'layout': 'app' }
  },



  {
    path: '/account',
    name: 'account',
    component: () => import('../views/Account.vue'),
    meta: {'middleware': 'auth', 'layout': 'app' }
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {
  if (!isNil(to.meta.middleware))
  {
      Object.keys(to.meta).map(function(objectKey) {
          if (objectKey === "middleware" && to.meta.middleware == 'guest' && guest()) {
              next()
          }
          if (objectKey === "middleware" && to.meta.middleware == 'auth') {
            if (auth()) {
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
