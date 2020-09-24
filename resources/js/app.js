/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

import i18n from './services/i18n'
import './services/components'


/*************** AVORED CREATED VUE COMPONENTS ***************/

Vue.component('user-order-show', require('../components/account/order/OrderShow.vue').default)
Vue.component('address-save', require('../components/address/AddressSave.vue').default)
Vue.component('user-order-table', require('../components/account/order/OrderTable.vue').default)
Vue.component('account-upload', require('../components/account/AccountUpload.vue').default)
Vue.component('category-page', require('../components/CategoryPage.vue').default)
Vue.component('product-page', require('../components/ProductPage.vue').default)
Vue.component('checkout-page', require('../components/CheckoutPage.vue').default)
Vue.component('cart-page', require('../components/CartPage.vue').default)
Vue.component('avored-layout', require('../components/layout/Layout.vue').default)
Vue.component('login-fields', require('../components/auth/LoginFields.vue').default)
Vue.component('register-fields', require('../components/auth/RegisterFields.vue').default)

Vue.component('avored-nav', require('../components/AvoRedNav.vue').default)

const app = new Vue({
    el: '#app',
    i18n,
})
