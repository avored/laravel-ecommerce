/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
import Antd from 'ant-design-vue'

Vue.use(Antd);
// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('address-save', require('../components/address/AddressSave.vue').default);
Vue.component('user-order-table', require('../components/account/order/OrderTable.vue').default);

Vue.component('product-page', require('../components/ProductPage.vue').default);
Vue.component('checkout-page', require('../components/CheckoutPage.vue').default);

Vue.component('avored-layout', require('../components/layout/Layout.vue').default);
Vue.component('login-fields', require('../components/auth/LoginFields.vue').default);
Vue.component('register-fields', require('../components/auth/RegisterFields.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
