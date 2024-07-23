import { createRouter, createWebHistory } from 'vue-router'
import store from '@/store';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: () => import('../views/HomeView.vue'),
      meta: {
        title: 'Login'
      }
    },
    {

      path: '/forgotpassword',
      name: 'forgotpassword',
      component: () => import('../views/ForgotPassword.vue'),
      meta: {
        title: 'ForgotPassword'
      }
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: () => import('../views/Dashboard.vue'),
      meta: {
        title: 'Dashboard'
      },
      beforeEnter: (to, from, next) => {
        if (store.getters.Logged) {
          next();
        } else {
          next({ name: 'login' });
        }
      }
    },
    {
      path: '/funil/:id',
      name: 'funil',
      component: () => import('../views/FunilView.vue'),
      meta: {
        title: 'Funil'
      },
      beforeEnter: (to, from, next) => {
        if (store.getters.Logged) {
          next();
        } else {
          next({ name: 'login' });
        }
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
  document.title = to.meta.title;
  next();
});

export default router
