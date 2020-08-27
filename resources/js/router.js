import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from './pages/Login.vue'
import PhotoList from './pages/PhotoList.vue'
import store from './store'
import SystemError from './pages/errors/System.vue'
import PhotoDetail from '../js/pages/PhotoDetail.vue'
import Contact from './pages/Contact.vue'
import TermsOfService from './pages/TermsOfService.vue'
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
    path: '/contact',
    component: Contact
  },
  {
    path: '/terms_of_service',
    component: TermsOfService
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