<template>
    <component :is="layout">
        <router-view />
    </component>
</template>

<script lang="ts">
import AppLayout from '@/layouts/App.vue'
import GuestLayout from '@/layouts/Guest.vue'
import { defineComponent } from "vue"

const default_layout = "app"

export default defineComponent({
    components: {
        'app-layout' : AppLayout,
        'guest-layout': GuestLayout
    },
    computed: {
        layout() {
            return (this.$route.meta.layout || default_layout) + '-layout'
        }
    },
})
</script>
