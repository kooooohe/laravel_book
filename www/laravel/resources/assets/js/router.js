import VueRouter from 'vue-router'
import Vue from 'vue'

Vue.use(VueRouter)

export default new VueRouter({
  mode: 'history',
  routes: [
    { path: '/', name:'books', component: require('./components/Books.vue') },
    { path: '/addbook', name:'addBook', component: require('./components/addBook.vue') },
    { path: '/addjob', name:'addJob', component: require('./components/addJob.vue') },
    { path: '/joblist', name:'jobList', component: require('./components/JobList.vue') },
  ],
  scrollBehavior (to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    } else {
      return { x: 0, y: 0 }
    }
  },
})
