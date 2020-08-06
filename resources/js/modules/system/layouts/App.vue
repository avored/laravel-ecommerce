
<template>
  <div>
    <div class="bg-gray-200">
      <div class="">
        <app-header @toggleSideBarClicked="collapsed = !collapsed"></app-header>
        <main class="my-5 container mx-auto focus:outline-none" tabindex="0">
          <div class="m-auto">
            <h1 class="text-2xl font-semibold text-gray-900">
              {{ pageTitle }}
            </h1>
          </div>
          <div class="m-auto">
            <!-- Replace with your content -->
            <div class="py-4">
                <slot />
            </div>
            <!-- /End replace -->
          </div>
        </main>
      </div>
      <div class="">
        <app-footer></app-footer>
      </div>
    </div>
  </div>
</template>
<script>
import Header from '../components/system/layout/Header'
import Breadcrumb from '../components/system/layout/Breadcrumb'
import Footer from '../components/system/layout/Footer'
import { mapGetters } from 'vuex'

export default {
  components: {
    "app-header": Header,
    "app-breadcrumb": Breadcrumb,
    "app-footer": Footer
  },
  computed: {
    ...mapGetters({
      pageTitle: ['system/pageTitle']
    })
  },
  data() {
    return {
      collapsed: false
    };
  },
  methods: {
  }
};
</script>
