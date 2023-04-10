<template>
  <div></div>
</template>
<script setup lang="ts">
import { AUTH_TOKEN, CUSTOMER_LOGGED_IN } from "@/constants"
import { onMounted } from "vue"
import { useRouter } from "vue-router"
    console.log('sdfdsfds')
    
    onMounted(() => {
      const router = useRouter()
          localStorage.removeItem(AUTH_TOKEN)
          localStorage.removeItem(CUSTOMER_LOGGED_IN)
          router.push({name: 'home'})
      })
</script>
