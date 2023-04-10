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
      path: '/category/:slug',
      name: 'category',
      component: () => import('../views/Category.vue'),
      meta: {'middleware': 'guest', 'layout': 'app' }
    },
   {
      path: '/product/:slug',
      name: 'product.show',
      component: () => import('../views/HomeView.vue'),
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
      component: () => import('../views/HomeView.vue'),
      meta: { 'middleware': 'guest', 'layout': 'app' }
    },
    {
      path: '/checkout/success',
      name: 'checkout.successs',
      component: () => import('../views/HomeView.vue'),
      meta: { 'middleware': 'customer', 'layout': 'app' }
    },
    {
      path: '/login',
      name: 'auth.login',
      component: () => import('../views/auth/Login.vue'),
      meta: {'middleware': 'guest', 'layout': 'app' }
    },
    {
      path: '/forgot-password',
      name: 'auth.forgot.password',
      component: () => import('../views/HomeView.vue'),
      meta: { 'middleware': 'guest', 'layout': 'app' }
    },
    {
      path: '/reset-password',
      name: 'auth.reset.password',
      component: () => import('../views/HomeView.vue'),
      meta: { 'middleware': 'guest', 'layout': 'app' }
    },
    {
      path: '/register',
      name: 'auth.register',
      component: () => import('../views/HomeView.vue'),
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
      meta: {'middleware': 'customer', 'layout': 'app' }
    },
    {
      path: '/orders',
      name: 'orders.index',
      component: () => import('../views/Orders.vue'),
      meta: { 'middleware': 'customer', 'layout': 'app' }
    },
    {
      path: '/order/:order',
      name: 'order.show',
      component: () => import('../views/OrderShow.vue'),
      meta: { 'middleware': 'customer', 'layout': 'app' }
    },
    {
      path: '/account/address',
      name: 'address.index',
      component: () => import('../views/Address.vue'),
      meta: { 'middleware': 'customer', 'layout': 'app' }
    },
    {
      path: '/account/update-address/:id?',
      name: 'address.update',
      component: () => import('../views/UpdateAddress.vue'),
      meta: { 'middleware': 'customer', 'layout': 'app' }
    },
    {
      path: '/account/create/',
      name: 'address.create',
      component: () => import('../views/CreateAddress.vue'),
      meta: { 'middleware': 'customer', 'layout': 'app' }
    },
    {
      path: '/account/edit',
      name: 'account.edit',
      component: () => import('../views/AccountEdit.vue'),
      meta: { 'middleware': 'customer', 'layout': 'app' }
    },
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
