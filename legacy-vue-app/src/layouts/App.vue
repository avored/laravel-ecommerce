<template>
    <div class="bg-gray-200">
        <app-header></app-header>
            <slot />
        <app-footer></app-footer>
    </div>
</template>
<script lang="ts">
import Header from '@/components/layouts/Header.vue'
import Footer from '@/components/layouts/Footer.vue'

import { defineComponent } from "vue"

export default defineComponent({
    components: {
        'app-header': Header,
        'app-footer': Footer
    }
})
</script>
