<template>
  <div>
    <div class="mt-3">
         <avored-table
            :columns="columns"
            :from="initOrders.from"
            :to="initOrders.to"
            :total="initOrders.total"
            :prev_page_url="initOrders.prev_page_url"
            :next_page_url="initOrders.next_page_url"
            :items="initOrders.data"
        >
          <template slot="action" slot-scope="{item}">
            <div class="flex items-center">
                <a :href="getShowUrl(item)">
                  <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"><path d="M19.8 10A11 11 0 0010 4a11 11 0 00-9.8 6 11 11 0 009.8 6 11 11 0 009.8-6zM10 14a4 4 0 100-8 4 4 0 000 8zm0-2a2 2 0 100-4 2 2 0 000 4z" fill="#000" fill-rule="evenodd"/></svg>
                </a>
            </div>
          </template>
        </avored-table>
    </div>
  </div>
</template>

<script>

const columns = [
  {
    label: "ID",
    fieldKey: "id"
  },
  {
    label: "Shipping Option",
    fieldKey: "shipping_option"
  },
  {
    label: "Payment Option",
    fieldKey: "payment_option"
  },
  {
    label: "Actions",
    slotName: "action"
  }
];

export default {
  props: ['baseUrl', 'initOrders'],
  components: {
    
  },
  data () {
    return {
        columns,    
    };
  },
  mounted() {

  },
  methods: {
      getShowUrl(record) {
          return this.baseUrl + '/' + record.id
      },
  }
};
</script>
