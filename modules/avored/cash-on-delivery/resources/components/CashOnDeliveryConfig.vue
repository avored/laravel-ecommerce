<template>
    <div>
        <a-form-item label="Status">
            <a-select @change="statusChange" :default-value="data.a_cash_on_delivery_status">
                <a-select-option value="true">Enabled</a-select-option>
                <a-select-option value="false">Disabled</a-select-option>
            </a-select>
        </a-form-item>
        <input type="hidden" name="a_cash_on_delivery_status" v-model="status" />
    </div>
</template>

<script>

export default {
    name: 'cash-on-delivery-config',
    props: ['data'],
    data () {
        return {
            status: false 
        }
    },
    methods: {
        statusChange(val) {
            this.status = val
        }
    },
    mounted() {
    }
}
</script>
