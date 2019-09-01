/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


window.Vue = require('vue');

import Row from 'ant-design-vue/lib/row'
import Col from 'ant-design-vue/lib/col'
import Layout from 'ant-design-vue/lib/layout'
import Menu from 'ant-design-vue/lib/menu'
import Icon from 'ant-design-vue/lib/icon'
import Card from 'ant-design-vue/lib/card';
import Form from 'ant-design-vue/lib/form'
import Input from 'ant-design-vue/lib/input'
import Select from 'ant-design-vue/lib/select'
import Button from 'ant-design-vue/lib/button'
import Avatar from 'ant-design-vue/lib/avatar'
import Breadcrumb from 'ant-design-vue/lib/breadcrumb'
import Divider from 'ant-design-vue/lib/divider'
import Switch from 'ant-design-vue/lib/switch'
import Checkbox from 'ant-design-vue/lib/checkbox'
import ToolTip from 'ant-design-vue/lib/tooltip'
import Carousel from 'ant-design-vue/lib/carousel'


Vue.use(Row)
Vue.use(Col)
Vue.use(Layout)
Vue.use(Menu)
Vue.use(Icon)
Vue.use(Card)
Vue.use(Form)
Vue.use(Select)
Vue.use(Input)
Vue.use(Button)
Vue.use(Avatar)
Vue.use(Breadcrumb)
Vue.use(Divider)
Vue.use(Switch)
Vue.use(Checkbox)
Vue.use(ToolTip)
Vue.use(Carousel)


Vue.component('address-save', require('../components/address/AddressSave.vue').default);
Vue.component('user-order-table', require('../components/account/order/OrderTable.vue').default);

Vue.component('category-page', require('../components/CategoryPage.vue').default);
Vue.component('product-page', require('../components/ProductPage.vue').default);
Vue.component('checkout-page', require('../components/CheckoutPage.vue').default);
Vue.component('cart-page', require('../components/CartPage.vue').default);

Vue.component('avored-layout', require('../components/layout/Layout.vue').default);
Vue.component('login-fields', require('../components/auth/LoginFields.vue').default);
Vue.component('register-fields', require('../components/auth/RegisterFields.vue').default);

Vue.component('avored-nav', require('../components/AvoRedNav.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
