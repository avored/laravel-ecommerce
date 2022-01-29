<template>
    <div class="text-gray-500">
        {{ t('pagination_result_text', {from: from, to: to, total: total}) }}
    </div>
    <div class="ml-auto">
        <button type="button" @click.prevent="$emit('previous')" class="px-2 py-3 border border-gray-400 text-gray-600 bg-gray-100 rounded-md">
            {{ t('previous') }}
        </button>
        <button type="button" @click.prevent="$emit('next')" class="px-2 py-3 border border-gray-400 text-gray-600 bg-gray-100 rounded-md ml-5">
            {{ t('next') }}
        </button>
    </div>
</template>

<script lang="ts">
import { defineComponent } from "vue"
import { useI18n } from "vue-i18n"

export default defineComponent({
    props: {
        from: {
            type: [Number],
            required: true,
        },
        to: {
            type: [Number],
            required: true,
        },
        total: {
            type: [Number],
            required: true,
        },
    },
    setup() {
        const { t } = useI18n()

        return {
            t
        }
    }
})
</script>
