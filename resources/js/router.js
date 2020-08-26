import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from './pages/Login.vue'
import PhotoList from './pages/PhotoList.vue'
import store from './store'
import SystemError from './pages/errors/System.vue'
import PhotoDetail from '../js/pages/PhotoDetail.vue'
import NotFound from './pages/errors/NotFound.vue'

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
    component: PhotoList
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
  {
    path: '*',
    component: NotFound
  }
]

const router = new VueRouter({
  mode: 'history',
  routes
})

export default router