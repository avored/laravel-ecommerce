<template>
    <div>
       
        <avored-select
            field-name="a_cash_on_delivery_status"
            :options="options"
            :init-value="data.a_cash_on_delivery_status"
        ></avored-select>
    </div>
</template>

<script>

export default {
    name: 'cash-on-delivery-config',
    props: ['data', 'options'],
    data () {
        return {
            status: false 
        }
    },
    methods: {
       
    },
    mounted() {
    }
}
</script>
