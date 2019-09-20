<script>
import isNil from 'lodash/isNil';

export default {
  props: ['address'],
  data () {
    return {
        form: this.$form.createForm(this),
        country_id: '',
        type: ''
    };
  },
  methods: {
      handleSubmit(e) {
        this.form.validateFields((err, values) => {
            if (err) {
              e.preventDefault();
            }
          });
      },
      handleTypeChange(val) {
        this.type = val;
      },
      handleCountryChange(val) {
        this.country_id = val;
      },
      
      cancelAddress() {
          window.location = 'account/address';
      }
  },
  mounted() {
      if (!isNil(this.address)) {
        this.type = this.address.type;
        this.country_id = this.address.country_id;
      }
  }
};
</script>
