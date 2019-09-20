<script>

export default {
  props: [],
  data () {
    return {
        form: this.$form.createForm(this)
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
      cancelBtnClick(e) {
        e.preventDefault();

        location = '/account'
      }
      
  },
  mounted() {
  }
};
</script>
