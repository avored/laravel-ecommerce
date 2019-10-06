<script>
import isNil from 'lodash/isNil'

const columns = [
    {
        title: 'Name',
        dataIndex: 'name',
        key: 'name',
        sorter: true,
    },
    {
        title: 'Email',
        dataIndex: 'email',
        key: 'email',
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
  props: ['baseUrl', 'reviews'],
  data () {
    return {
        columns
    };
  },
  methods: {
      handleTableChange(pagination, filters, sorter) {
        this.banners.sort(function(a, b){
            let columnKey = sorter.columnKey
            let order = sorter.order
            
            if (isNil(a[columnKey])) {
                a[columnKey] = ''
            }
            if (isNil(b[columnKey])) {
                b[columnKey] = ''
            }
            if (order === 'ascend'){
                if(a[columnKey] < b[columnKey]) return -1;
                if(a[columnKey] > b[columnKey]) return 1;
            }
            if (order === 'descend') {
                if(a[columnKey] > b[columnKey]) return -1;
                if(a[columnKey] < b[columnKey]) return 1;
            }
            return 0;
        });
      },
      getApprovedUrl(record) {
          return this.baseUrl + '/review/' + record.id + '/approved';
      },
      clickOnApproved(record, e) {
        var url = this.baseUrl + '/review/' + record.id + '/approved';
        var app = this;
        this.$confirm({
            title: 'Do you Want to approved this review',
            okType: 'success',
            onOk() {    
                axios.post(url)
                    .then(response =>  {
                        if (response.data.success === true) {
                            app.$notification.success({
                                key: 'review.approved.success',
                                message: response.data.message,
                            });
                            window.location.reload();
                        }
                    })
                    .catch(errors => {
                        app.$notification.error({
                            key: 'review.approved.error',
                            message: errors.message
                        });
                    });
            },
            onCancel() {
                // Do nothing
            },
        });
    },
  }
};
</script>
