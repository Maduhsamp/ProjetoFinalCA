import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta: {
        title: 'Home'
      }
    },
    {

      path: '/forgotpassword',
      name: 'forgotpassword',
      component: () => import ('../views/ForgotPassword.vue'),
      meta:{
        title: 'ForgotPassword'
      }
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: () => import('../views/Dashboard.vue'),
      meta: {
        title: 'Dashboard',
        needsAuth: false
      }
    },
    {
      path: '/password-reset/:token',
      name: 'reset',
      component: () => import('../views/ResetPasswordView.vue'),
      meta: {
        title: 'ResetPassword'
      }
    }
  ]
})

router.beforeEach((to, from, next) => {
  if(to.meta.needsAuth) {
    next('/');
  } else {
    next();
  }
});

export default router
