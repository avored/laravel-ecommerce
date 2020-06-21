
import Vue from 'vue'

/**************  VUE Draggable Component  ***************/

import draggable from 'vuedraggable'
Vue.component('draggable', draggable)

/**************  VUE TAILWIND SYSTEM  ***************/
import VueTailwind from 'vue-tailwind'
Vue.use(VueTailwind)


/**************  VUE SWEET ALERT  ***************/
import 'sweetalert2/dist/sweetalert2.min.css'
import VueSweetalert2 from 'vue-sweetalert2'
Vue.use(VueSweetalert2)


/**************  AVORED SYSTEM FORMS COMPONENTS ***************/

Vue.component('avored-table', require('@/modules/system/components/forms/AvoRedTable.vue').default)
Vue.component('avored-input', require('@/modules/system/components/forms/AvoRedInput.vue').default)
Vue.component('avored-select', require('@/modules/system/components/forms/AvoRedSelect.vue').default)
Vue.component('avored-toggle', require('@/modules/system/components/forms/AvoRedToggle.vue').default)
