import './bootstrap'
import Vue from 'vue'
import router from './router'
import store from './store'
import App from './App.vue'
import VuePaginate from 'vue-paginate';

const createApp = async () => {

  await store.dispatch('auth/currentUser')

  Vue.use(VuePaginate)

  new Vue({
    el: '#app',
    router,
    store,
    components: { App },
    template: '<App />',
  })
}

createApp()