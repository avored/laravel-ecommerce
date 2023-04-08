<template>
  <div class="container mx-auto">
    <h1 class="text-2xl text-red-700 font-semibold my-5">
        {{ t('checkout_success_page') }}
    </h1>

    <div>
        {{ t('success_order_placed_message', {order_id: 1234}) }}

    </div>

  </div>
</template>

<script lang='ts'>
import { defineComponent } from 'vue'
import { useI18n } from 'vue-i18n'

export default defineComponent({
  components: {},
  setup() {
    const { t } = useI18n()

    return {
      t,
    }
  }
})
</script>
