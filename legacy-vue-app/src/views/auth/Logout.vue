<template>
  <div></div>
</template>
<script lang="ts">
import { AUTH_TOKEN } from "@/constants"
import { defineComponent, onMounted } from "vue"
import { useRouter } from "vue-router"


export default defineComponent({
    setup() {
      onMounted(() => {
          const router = useRouter()
          localStorage.removeItem(AUTH_TOKEN)
          router.push({name: 'home'})
      })
    }
})
</script>