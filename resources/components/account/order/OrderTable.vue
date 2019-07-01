<script>

const columns = [
    {
        title: 'Payment Options',
        dataIndex: 'payment_option',
        key: 'payment_option',
        sorter: true,
    }, 
    {
        title: 'Shipping Options',
        dataIndex: 'shipping_option',
        key: 'shipping_option',
        sorter: true,
    }, 
    {
        title: 'Status',
        dataIndex: 'order_status_id',
        key: 'order_status_id',
        sorter: true,
    }, 
    {
        title: 'Action',
        key: 'action',
        scopedSlots: { customRender: 'action' },
        sorter: false,
        width: "10%"
    }
];


export default {
  data () {
    return {
        columns
    };
  },
  methods: {
      getShowUrl(record) {
          return '/account/order/' + record.id;
      }
  }
};
</script>
