
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import zh_CN from './locale/zh_CN';
import store from './store/index'
import jwtToken from './helpers/jwt'
import VeeValidate, { Validator } from 'vee-validate';
import router from './routes'
import App from './components/App'

axios.interceptors.request.use(function (config) {
    if(jwtToken.getToken()){
        config.headers['Authorization'] = 'Bearer '+jwtToken.getToken()
    }
    return config;
}, function (error) {
    // Do something with request error
    return Promise.reject(error);
});

Vue.use(VueRouter)
Vue.use(VeeValidate);
Validator.localize('zh_CN', zh_CN);
Vue.component('app', App)

new Vue({
    el: '#app',
    router,
    store
});
