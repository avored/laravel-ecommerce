<template>
    <div class="bg-gray-200">
        <AppHeader></AppHeader>
            <slot />
        <Footer></Footer>
    </div>
</template>
<script setup lang="ts">
import AppHeader from '@/components/layouts/AppHeader.vue'
import Footer from '@/components/layouts/Footer.vue'

</script>
