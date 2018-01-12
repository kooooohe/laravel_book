
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import router from './router'
import ElementUI from 'element-ui'
//import 'element-ui/lib/theme-default/index.css';
import 'element-ui/lib/theme-chalk/index.css';

import locale from 'element-ui/lib/locale/lang/ja'

import http from './services/http.js'

Vue.use(ElementUI, { locale })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/ExampleComponent.vue'));
//Vue.component('todo-item', require('./components/TodoItem.vue'));

Vue.component('todo-item', {
    props: ['todo'],
    template: '<li> {{ todo.text }} </li>'
})

const app = new Vue({
    router,

    created () {
      http.init()
    },
    el: '#app',
    render: h => h(require('./app.vue')),
})

//const app7 = new Vue({
//    el: '#app-7',
//    data: {
//        groceryList: [
//            {id:0, text: 'VegeTables'},
//            {id:1, text: 'Cheese'},
//            {id:2, text: 'Whatever else humans are supposed to eat'}
//        ]
//    }
//})

//const app = new Vue({
//    el: '#app',
//    data: {
//        tableData3: [{
//          date: '2016-05-03',
//          name: 'Tom',
//          address: 'No. 189, Grove St, Los Angeles'
//        }, {
//          date: '2016-05-02',
//          name: 'Tom',
//          address: 'No. 189, Grove St, Los Angeles'
//        }, {
//          date: '2016-05-04',
//          name: 'Tom',
//          address: 'No. 189, Grove St, Los Angeles'
//        }, {
//          date: '2016-05-01',
//          name: 'Tom',
//          address: 'No. 189, Grove St, Los Angeles'
//        }, {
//          date: '2016-05-08',
//          name: 'Tom',
//          address: 'No. 189, Grove St, Los Angeles'
//        }, {
//          date: '2016-05-06',
//          name: 'Tom',
//          address: 'No. 189, Grove St, Los Angeles'
//        }, {
//          date: '2016-05-07',
//          name: 'Tom',
//          address: 'No. 189, Grove St, Los Angeles'
//        }],
//    }
//})
//
//const app2 = new Vue({
//    el: '#app-2',
//    data: {
//        message: 'You loaded this page on' + new Date().toLocaleString()
//    }
//})
//
//const app3 = new Vue({
//   el: '#app-3',
//    data: {
//        seen: false
//    }
//})
//
//const app4 = new Vue({
//    el: '#app-4',
//    data: {
//        todos: [
//            { text:'kohe1' },
//            { text:'kohe2' },
//            { text:'kohe3' },
//            { text:'kohe4' }
//        ]
//    }
//})
//
//const app5 = new Vue({
//    el: '#app-5',
//    data: {
//        message: 'Hello Vue.js!'
//    },
//    methods: {
//        reverseMessage: function() {
//            this.message = this.message.split('').reverse().join('')
//        }
//    }
//})
//
//const app6 = new Vue({
//    el:'#app-6',
//    data: {
//        message: 'Hello'
//    }
//})


