import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from './pages/Login.vue'
import PhotoList from './pages/PhotoList.vue'
import store from './store'
import SystemError from './pages/errors/System.vue'
import PhotoDetail from '../js/pages/PhotoDetail.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/login',
    component: Login,
    beforeEnter (to, from, next) {
      if (store.getters['auth/check']) {
        next('/')
      } else {
        next()
      }
    }
  },
  {
    path: '/',
    component: PhotoList,
    props: route => {
      const page = route.query.page
      return { page: /^[1-9][0-9]*$/.test(page) ? page * 1 : 1 }
    }
  },
  {
    path: '/photos/:id',
    component: PhotoDetail,
    props: true
  },
  {
    path: '/500',
    component: SystemError
  },
]

const router = new VueRouter({
  mode: 'history',
  routes
})

export default router