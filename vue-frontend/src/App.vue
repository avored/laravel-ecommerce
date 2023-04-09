<script setup lang="ts">
import { RouterView, useRouter } from 'vue-router'
import App from '@/layouts/App.vue'
import Guest from '@/layouts/Guest.vue'

const router = useRouter()

const layout =  (router.currentRoute.value.meta.layout == 'guest') ? Guest : App
        
</script>

<template>
  <component :is="layout">
        <router-view />
    </component>
</template>
