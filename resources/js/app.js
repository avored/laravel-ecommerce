/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue')

import AvoRed from './avored'
window.AvoRed = AvoRed



/*************** ANT DESIGN VUE COMPONENTS ***************/
import Layout from 'ant-design-vue/lib/layout'
import Menu from 'ant-design-vue/lib/menu'
import Form from 'ant-design-vue/lib/form'
import Radio from 'ant-design-vue/lib/radio'
import Select from 'ant-design-vue/lib/select'
import Breadcrumb from 'ant-design-vue/lib/breadcrumb'
import Dropdown from 'ant-design-vue/lib/dropdown'
import Tabs from 'ant-design-vue/lib/tabs'
import Notification from 'ant-design-vue/lib/notification'

Vue.use(Layout)
Vue.use(Menu)
Vue.use(Form)
Vue.use(Radio)
Vue.use(Select)
Vue.use(Breadcrumb)
Vue.use(Dropdown)
Vue.use(Tabs)

Vue.prototype.$notification = Notification;

// Vue.component('a-radio', require('ant-design-vue/lib/radio').default)
// Vue.component('a-radio-group', require('ant-design-vue/lib/radio').default)

Vue.component('a-checkbox', require('ant-design-vue/lib/checkbox').default)
Vue.component('a-switch', require('ant-design-vue/lib/switch').default)
Vue.component('a-input', require('ant-design-vue/lib/input').default)
Vue.component('a-textarea', require('ant-design-vue/lib/input').default)
Vue.component('a-rate', require('ant-design-vue/lib/rate').default)
Vue.component('a-input-number', require('ant-design-vue/lib/input-number').default)
Vue.component('a-divider', require('ant-design-vue/lib/divider').default)
Vue.component('a-avatar', require('ant-design-vue/lib/avatar').default)
Vue.component('a-tooltip', require('ant-design-vue/lib/tooltip').default)
Vue.component('a-avatar', require('ant-design-vue/lib/avatar').default)
Vue.component('a-row', require('ant-design-vue/lib/row').default)
Vue.component('a-col', require('ant-design-vue/lib/col').default)
Vue.component('a-card', require('ant-design-vue/lib/card').default)
Vue.component('a-card', require('ant-design-vue/lib/card').default)
Vue.component('a-card-meta', require('ant-design-vue/lib/card').default)
Vue.component('a-button', require('ant-design-vue/lib/button').default)
Vue.component('a-icon', require('ant-design-vue/lib/icon').default)
Vue.component('a-carousel', require('ant-design-vue/lib/carousel').default)
Vue.component('a-upload', require('ant-design-vue/lib/upload').default)
Vue.component('a-modal', require('ant-design-vue/lib/modal').default)
Vue.component('a-table', require('ant-design-vue/lib/table').default)


/*************** AVORED CREATED VUE COMPONENTS ***************/
Vue.component('product-card', require('../components/product/ProductCard.vue').default)
Vue.component('address-save', require('../components/address/AddressSave.vue').default)
Vue.component('user-order-table', require('../components/account/order/OrderTable.vue').default)
Vue.component('account-save', require('../components/account/AccountSave.vue').default)
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
})
window.EventBus = new Vue();
