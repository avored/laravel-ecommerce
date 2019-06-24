<script>

export default {
  data () {
    return {
      form: this.$form.createForm(this),
      loadingSubmitBtn: false
    };
  },
  methods: {
    handleSubmit (e) {
      this.loadingSubmitBtn = true;
      this.form.validateFields((err, values) => {
        if (err) {
          this.loadingSubmitBtn = false;
          e.preventDefault();
        }
      });
    }
  },
};
</script>
