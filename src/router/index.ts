import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import Home from '../views/Home.vue'
import isNil from 'lodash/isNil'
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
    component: () => import('../views/Category.vue'),
    meta: {'middleware': 'guest', 'layout': 'app' }
  },
  {
    path: '/cart',
    name: 'cart',
    component: () => import('../views/Cart.vue'),
    meta: {'middleware': 'guest', 'layout': 'app' }
  },
  {
    path: '/checkout',
    name: 'checkout',
    component: () => import('../views/Checkout.vue'),
    meta: { 'middleware': 'guest', 'layout': 'app' }
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
    path: '/logout',
    name: 'logout',
    component: () => import('../views/auth/Logout.vue'),
    meta: {'middleware': 'guest', 'layout': 'app' }
  },

  {
    path: '/account',
    name: 'account',
    component: () => import('../views/Account.vue'),
    meta: {'middleware': 'auth', 'layout': 'app' }
  },
  {
    path: '/orders',
    name: 'orders.index',
    component: () => import('../views/Orders.vue'),
    meta: { 'middleware': 'auth', 'layout': 'app' }
  },
  {
    path: '/account/address',
    name: 'address.index',
    component: () => import('../views/Address.vue'),
    meta: { 'middleware': 'auth', 'layout': 'app' }
  },
  {
    path: '/account/save-address/:id?',
    name: 'address.save',
    component: () => import('../views/SaveAddress.vue'),
    meta: { 'middleware': 'auth', 'layout': 'app' }
  },
  {
    path: '/account/edit',
    name: 'account.edit',
    component: () => import('../views/AccountEdit.vue'),
    meta: { 'middleware': 'auth', 'layout': 'app' }
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
          if (objectKey === "middleware" && to.meta.middleware == 'guest') {
              next()
          }
          if (objectKey === "middleware" && to.meta.middleware == 'auth') {
            if (auth.isAuth()) {
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
