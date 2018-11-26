
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
import App from './App'
import Element from 'element-ui'
Vue.use(Element)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import axios from 'axios';
import VueRouter from 'vue-router';
import goods from './components/goods/goods';
import './common/sass/index.scss';
Vue.use(VueRouter);
Vue.config.productionTip = false
Vue.prototype.$http= axios;
const router = new VueRouter({
  linkActiveClass: 'active',
  routes: [
        {
          path: '/',
          redirect: '/goods'
        },
        {
          path: '/goods',
          component: goods
        }
      ]
});


const app = new Vue({
  el: '#app',
   router: router,
  data: {
    eventHub: new Vue()
  },
  render: h => h(App)
});

