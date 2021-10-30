import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import Home from '../views/Home.vue'
import isNil from 'lodash/isNil'
import Guest from '../middleware/guest'
import Auth from '../middleware/auth'
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
    path: '/about',
    name: 'about',
    component: () => import('../views/About.vue'),
    meta: {'middleware': 'auth', 'layout': 'app' }
  },
  {
    path: '/login',
    name: 'auth.login',
    component: () => import('../views/auth/Login.vue'),
    meta: {'middleware': 'guest', 'layout': 'guest' }
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {
  if (!isNil(to.meta.middleware))
  {
      Object.keys(to.meta).map(function(objectKey) {
        console.log(objectKey === "middleware", to.meta.middleware == 'auth', auth())
          if (objectKey === "middleware" && to.meta.middleware == 'guest' && guest()) {
              next()
          }
          if (objectKey === "middleware" && to.meta.middleware == 'auth' && auth()) {
              next()
          } else {
            next('/login')
          }
      });
    } else {
      next()
    }
});
export default router
